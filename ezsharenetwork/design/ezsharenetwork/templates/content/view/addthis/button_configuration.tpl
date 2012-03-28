{if is_set($object)}
    <span class="addthis_share_button">
        
        {if is_set($custom_buttons)}
            {def $is_custom = $custom_buttons}
        {else}
            {def $is_custom = 'none'}
            {if ezini_hasvariable('Configuration', 'CustomButtons', 'addthis.ini')}
                {set $is_custom = ezini('Configuration', 'CustomButtons', 'addthis.ini')}
            {/if}
        {/if}

        {def $button_conf = concat($object,'_button')}
        {def $exclude_buttons = array()}
        {if ezini_hasvariable( 'Configuration', 'CustomButtonsExclude', 'addthis.ini' )}
            {set $exclude_buttons = ezini( 'Configuration', 'CustomButtonsExclude', 'addthis.ini' )|explode(',')}
        {/if}
        
        {* Set the button parameters *}
        {if ezini_hassection( $button_conf, 'addthis.ini')}
            <a class="addthis_button_{$object}{if ezini_hasvariable($button_conf, 'type', 'addthis.ini')}_{ezini($button_conf, 'type', 'addthis.ini')}{/if}"
                {foreach ezini_section( $button_conf, 'addthis.ini' ) as $name => $value}
                    {if $name|eq('type')}{skip}{/if}
                    {$name}="{$value}"
                    {delimiter} {/delimiter}
                {/foreach}
            >
        {else}
            <a class="addthis_button_{$object}">
        {/if}
        
        {* Set the content *}
        {if and( $exclude_buttons|contains( $object )|not(), or( $is_custom|contains('text'), $is_custom|contains('image') ) )}
            {if $is_custom|contains('image')}
                <img src="{concat('addthis/', $object, '.png')|ezimage('no')}"
                     class="addthis_custom_image"
                     alt="{if $is_custom|contains('text')}{$object|i18n('design/ezsharenetwork/addthis/buttons')}{/if}" />
            {/if}
            {if $is_custom|contains('text')}
                <span class="addthis_custom_text">{$object|i18n('design/ezsharenetwork/addthis/buttons')}</span>
            {/if}
        {/if}
        
        {* close a tag *}
        </a>
        
        {undef $button_conf $exclude_buttons $is_custom}
        
    </span>
{/if}