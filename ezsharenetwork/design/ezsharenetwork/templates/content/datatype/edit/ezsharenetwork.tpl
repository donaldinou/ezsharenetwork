{def 
     $base = 'ContentObjectAttribute'
     $class_name = 'ezsharenetwork'
     $attr_hasspecificsocialbar = 'hasspecificsocialbar'
     $attr_socialbar = 'socialbar'
     $attr_buttons = 'buttons'
}
{if is_set($attribute_base)}{set $base = $attribute_base}{/if}

{if is_set($attribute)}
    {def $AuthorizedLibrary = array()}
    {if ezini_hasvariable( 'SocialShareNetwork', 'AuthorizedLibrary', 'ezsharenetwork.ini' )}
        {set $AuthorizedLibrary = ezini( 'SocialShareNetwork', 'AuthorizedLibrary', 'ezsharenetwork.ini' )}
    {/if}
    
    {def $preferred_api = get_preferred_share_api()}
    
    {def $AuthorizedButtons = array()}
    {if ezini_hasvariable( concat($preferred_api, 'Configuration'), 'AuthorizedButtons', 'ezsharenetwork.ini' )}
        {set $AuthorizedButtons = ezini( concat($preferred_api, 'Configuration'), 'AuthorizedButtons', 'ezsharenetwork.ini' )}
    {/if}

	<div class="block">
	    <fieldset>
	        <legend>{'Social Network Bar Configuration'|i18n( 'design/ezsharenetwork/class/datatype/ezsharenetwork' )}</legend>
	        
	        <label for="{concat('ezcoa', '-', $attribute.contentclassattribute_id, $attribute.contentclass_attribute_identifier, '_', $attr_hasspecificsocialbar)}">
	            {'Specific Social Bar'|i18n( 'design/ezsharenetwork/class/datatype/ezsharenetwork' )}
	        </label>
	        <input type="checkbox" 
	               id="{concat('ezcoa', '-', $attribute.contentclassattribute_id, $attribute.contentclass_attribute_identifier, '_', $attr_hasspecificsocialbar)}" 
	               name="{concat($base, '-', $class_name, '_', $attr_hasspecificsocialbar, '_', $attribute.id )}" 
	               class="box {concat('ezcc', '-', $attribute.object.content_class.identifier, $attribute.contentclass_attribute_identifier)} {concat('ezcca', '-', $attribute.object.content_class.identifier, $attribute.contentclass_attribute_identifier)}"
	               value="true" 
	               title="{'Use this checkbox to personalize the social bar displayed in this object'|i18n( 'design/ezsharenetwork/class/datatype/ezsharenetwork' )}">
	        
	        {* Always set the .._selected_array_.. variable, this circumvents the problem when nothing is selected. *} 
	        <input type="hidden"
	               id="{concat('ezcoa', '-', $attribute.contentclassattribute_id, $attribute.contentclass_attribute_identifier, '_', $attr_socialbar)}"
	               name="{concat($base, '-', $class_name, '_', $attr_socialbar, '_', $attribute.id )}" 
	               value="" />
	        <label for="{concat('ezcoa', '-', $attribute.contentclassattribute_id, $attribute.contentclass_attribute_identifier, '_', $attr_socialbar, '_array')}">
	            {'Select the Sharing API'|i18n( 'design/ezsharenetwork/class/datatype/ezsharenetwork' )}
	        </label>
	        <select id="{concat('ezcoa', '-', $attribute.contentclassattribute_id, $attribute.contentclass_attribute_identifier, '_', $attr_socialbar, '_array')}"
	                name="{concat($base, '-', $class_name, '_', $attr_socialbar, '_', $attribute.id, '[]' )}"
	                class="box {concat('ezcc', '-', $attribute.object.content_class.identifier, $attribute.contentclass_attribute_identifier)} {concat('ezcca', '-', $attribute.object.content_class.identifier, $attribute.contentclass_attribute_identifier)}"
	                size="1">
	            {def $library_selected = $attribute.data_text}{if $library_selected|eq('')}{set $library_selected = $preferred_api()}{/if}
	            {if $AuthorizedLibrary|is_array()}
	               {foreach $AuthorizedLibrary as $libray}
	                   <option value="{$library}" {if $library_selected|eq($library)}selected="selected"{/if}>{$library|i18n('design/ezsharenetwork/class/datatype/ezsharenetwork')}</option>
	               {/foreach}
	            {/if}
	            {undef $library_selected}
	        </select>
	        
	        {* TODO Ajax for refreshing list *}
	        {* Always set the .._selected_array_.. variable, this circumvents the problem when nothing is selected. *} 
            <input type="hidden"
                   id="{concat('ezcoa', '-', $attribute.contentclassattribute_id, $attribute.contentclass_attribute_identifier, '_', $attr_buttons)}"
                   name="{concat($base, '-', $class_name, '_', $attr_buttons, '_', $attribute.id )}" 
                   value="" />
	        <label for="{concat('ezcoa', '-', $attribute.contentclassattribute_id, $attribute.contentclass_attribute_identifier, '_', $attr_buttons, '_array')}">
	            {'Select the available buttons'|i18n( 'design/ezsharenetwork/class/datatype/ezsharenetwork' )}
	        </label>
	        <select id="{concat('ezcoa', '-', $attribute.contentclassattribute_id, $attribute.contentclass_attribute_identifier, '_', $attr_buttons, '_array')}" 
	                name="{concat($base, '-', $class_name, '_', $attr_buttons, '_', $attribute.id, '[]' )}"
	                class="box {concat('ezcc', '-', $attribute.object.content_class.identifier, $attribute.contentclass_attribute_identifier)} {concat('ezcca', '-', $attribute.object.content_class.identifier, $attribute.contentclass_attribute_identifier)}"
	                multiple="multiple"
	                size="10">
	            {if $AuthorizedButtons|is_array()}
                   {foreach $Authorizedbuttons as $button}
                       <option value="{$buttons}" {if array()|contains($button)}selected="selected"{/if}>{$buttons|i18n('design/ezsharenetwork/class/datatype/ezsharenetwork')}</option>
                   {/foreach}
                {/if}
	        </select>
	        
	    </fieldset>
	</div>
	
	{undef $AuthorizedLibrary $AuthorizedButtons $preferred_api}
{/if}

{undef $base $class_name $attr_hasspecificsocialbar $attr_socialbar $attr_buttons}