{def $display_social_share = 'enabled'}
{if ezini_hasvariable('social_share', 'social_share', 'ezsharenetwork.ini')}
	{set $display_social_share = ezini('social_share', 'social_share', 'ezsharenetwork.ini')}
{/if}
{def $templating = 'default'}
{if ezini_hasvariable('social_share', 'templating', 'ezsharenetwork.ini')}
	{set $templating = ezini('social_share', 'templating', 'ezsharenetwork.ini')}
{/if}

{if $display_social_share|ne('disabled')}
	{def $publisher       = ezini('options', 'publisher', 'sharethis.ini')}
	{def $default_size    = ezini('options', 'default_size', 'sharethis.ini')}
	{def $default_text    = ezini('options', 'default_text', 'sharethis.ini')}
	{def $buttons         = ezini('buttons', 'sharethis_button', 'sharethis.ini')}
	
	{def $url=''}
	{def $title=''}
	{if is_set($url_toshare)}{set $url = $url_toshare}{/if}
	{if is_set($title_toshare)}{set $title = $title_toshare}{/if}
	
	{* HTML begin *}
	<div id="sharethis_box">
	    {def $btn_size = $default_size}
	    {def $display_text = $default_text|i18n('design/dukan/social')}
	    {foreach $buttons as $btn_key => $btn_name}
	        {if and( ezini_hasvariable( $btn_name, 'count_enable', 'sharethis.ini'), ezini_hasvariable( $btn_name, 'alignment', 'sharethis.ini') )}
	            {def $alignment = ezini( $btn_name, 'alignment', 'sharethis.ini' )}
	            {if int(ezini( $btn_name, 'count_enable', 'sharethis.ini' ))|eq(1)}
		            {switch match=$alignment}
		                {case match='vertical'}
		                    {set $btn_size = 'vcount'}
		                    {undef $display_text}
		                {/case}
		                {case match='horizontal'}
	                        {set $btn_size = 'hcount'}
	                        {undef $display_text}
	                    {/case}
		                {case}
		                    {set $btn_size = $default_size}
		                    {undef $display_text}
		                {/case}
		            {/switch}
		        {else}
		            {switch match=$alignment}
	                    {case match='small'}
	                        {set $btn_size = 'small'}
	                    {/case}
	                    {case match='large'}
	                        {set $btn_size = 'large'}
	                    {/case}
	                    {case match='button'}
	                        {set $btn_size = 'button'}
	                    {/case}
	                    {case match='custom'}
	                        {set $btn_size = 'custom'}
	                    {/case}
	                    {case}
	                        {set $btn_size = $default_size}
	                    {/case}
	                {/switch}
		        {/if}
		        {undef $alignment}
	        {/if}
	        {if ezini_hasvariable( $btn_name, 'display_text', 'sharethis.ini' )}
	            {set $display_text = ezini( $btn_name, 'display_text', 'sharethis.ini' )|i18n('design/dukan/social')}
	        {/if}
	        {if ezini_hasvariable( $btn_name, 'url', 'sharethis.ini' )}
	            {set $url = ezini( $btn_name, 'url', 'sharethis.ini' )}
	        {/if}
	        {if ezini_hasvariable( $btn_name, 'title', 'sharethis.ini' )}
	            {set $title = ezini( $btn_name, 'title', 'sharethis.ini' )}
	        {/if}
	        <span class="st_{$btn_name}{if $btn_size|eq('')|not()}_{$btn_size}{/if}"{if and( is_set($display_text), $display_text|eq('')|not() )} displayText="{$display_text}"{/if}{if and( is_set($url), $url|eq('')|not() )} st_url="{$url}"{/if}{if and( is_set($title), $title|eq('')|not() )} st_title="{$title}"{/if}></span>
	    {/foreach}
	</div>
	{* HTML End *}
	{undef $btn_size}
	{if is_set($display_text)}{undef $display_text}{/if}
	{if is_set($url)}{undef $url}{/if}
	{if is_set($title)}{undef $title}{/if}
	
	
	{if and(ezini_hasvariable( 'colors', 'theme', 'sharethis.ini' ), ezini('colors', 'theme', 'sharethis.ini')|eq(0)|not())}
	    {def $theme        = ezini('colors', 'theme', 'sharethis.ini')}
	{/if}
	{if and(ezini_hasvariable( 'colors', 'colors', 'sharethis.ini' ), ezini('colors', 'colors', 'sharethis.ini')|is_array() )}
	    {def $colors       = ezini('colors', 'colors', 'sharethis.ini')}
	{/if}
	{if ezini_hasvariable( 'options', 'header_title', 'sharethis.ini' )}
	    {def $header_title = ezini('options', 'header_title', 'sharethis.ini')}
	{/if}
	{if ezini_hasvariable( 'options', 'offset_top', 'sharethis.ini' )}
	    {def $offset_top   = ezini('options', 'offset_top', 'sharethis.ini')}
	{/if}
	{if ezini_hasvariable( 'options', 'offset_left', 'sharethis.ini' )}
	    {def $offset_left  = ezini('options', 'offset_left', 'sharethis.ini')}
	{/if}
	{if ezini_hasvariable( 'options', 'popup', 'sharethis.ini' )}
	    {def $popup  = ezini('options', 'popup', 'sharethis.ini')}
	{/if}
	
	{* JS begin *}
	<script type="text/javascript">var switchTo5x=true;</script>
	<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
	<script type="text/javascript">
	        stLight.options({ldelim}
	                            publisher:'{$publisher}',
	                            {if is_set($theme)}theme:'{$theme}',{/if}
	                            {if is_set($header_title)}headerTitle:'{$header_title}',{/if}
	                            {if is_set($offset_top)}offsetTop:'{$offset_top}',{/if}
	                            {if is_set($offset_left)}offsetLeft:'{$offset_left}',{/if}
	                            {if is_set($popup)}{if $popup|eq('true')}popup:'{$popup}'{else}popup='false'{/if},{/if}
	                            {if is_set($colors)}
		                            {foreach $colors as $color_key => $color_code}
		                                {if $color_code|eq('')|not()}
		                                    {$color_key}:'{$color_code}',
		                                {/if}
		                            {/foreach}
	                            {/if}
	                        {rdelim});
	</script>
	{* JS end *}
	{if is_set($theme)}{undef $theme}{/if}
	{if is_set($header_title)}{undef $header_title}{/if}
	{if is_set($offset_top)}{undef $offset_top}{/if}
	{if is_set($offset_left)}{undef $offset_left}{/if}
	{if is_set($colors)}{undef $colors}{/if}
	
	{def $authorized_lib = array( 'jquery' )}{* TODO: Manage authorized lib with file parsing helper in futur *}
    {def $preferred_lib = ezini('eZJSCore', 'PreferredLibrary', 'ezjscore.ini')}{if $authorized_lib|contains( $preferred_lib )|not()}{set $preferred_lib = 'jquery'}{/if}
    {ezscript_require( array( concat( 'ezjsc::', $preferred_lib ), concat( 'ezjsc::', $preferred_lib, 'io' ), concat( 'sharethis_', $preferred_lib, '.js' ) ) )}
    {undef $authorized_lib $preferred_lib}
{/if}
{undef $display_social_share $templating}