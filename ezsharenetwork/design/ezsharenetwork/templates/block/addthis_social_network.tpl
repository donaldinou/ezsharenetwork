{def $custom_buttons = 'none'}
{if ezini_hasvariable('Configuration', 'CustomButtons', 'addthis.ini')}
    {set $custom_buttons = ezini('Configuration', 'CustomButtons', 'addthis.ini')}
{/if}

{if social_share_enabled()}
    
    {* init constants *}
    {def $addthis_btn = array()}
    {if ezini_hasvariable('buttons', 'addthis_button', 'addthis.ini')}
        {set $addthis_btn = ezini('buttons', 'addthis_button', 'addthis.ini')}
    {/if}
    {* END *}
    
    <!-- ADDTHIS BUTTON BEGIN -->
    {if $addthis_btn|count()|gt(0)}
        {ezcss_load( array( 'addthis/addthis.css' ))}
    
	    <div id="addthis_box" 
	         class="addthis_toolbox addthis_default_style"
	         {if is_set($url_toshare)}addthis:url="{$url_toshare}"{/if}
	         {if is_set($title_toshare)}addthis:title="{$title_toshare}"{/if}
	         {if is_set($desc_toshare)}addthis:description="{$desc_toshare}"{/if}>
	         
	        {foreach $addthis_btn as $button}
	            {content_view_gui view='addthis/button_configuration' content_object=$button custom_buttons=$custom_buttons}
	        {/foreach}
	         
	    </div>
	    
	    {ezscript_addthis_api()}
	    {ezscript_addthis_location()}
	{/if}
    <!-- ADDTHIS BUTTON END -->
    
    {def $preferred_lib = get_preferred_library( 'jquery' )}
    {ezscript_require( array( concat( 'ezjsc::', $preferred_lib ), concat( 'ezjsc::', $preferred_lib, 'io' ), concat( 'addthis/addthis_', $preferred_lib, '.js' ) ) )}
    {undef $preferred_lib}
    
{/if}
{undef $custom_buttons}