{def $display_social_share = 'enabled'}
{if ezini_hasvariable('social_share', 'social_share', 'ezsharenetwork.ini')}
	{set $display_social_share = ezini('social_share', 'social_share', 'ezsharenetwork.ini')}
{/if}
{def $templating = 'default'}
{if ezini_hasvariable('social_share', 'templating', 'ezsharenetwork.ini')}
	{set $templating = ezini('social_share', 'templating', 'ezsharenetwork.ini')}
{/if}

{if $display_social_share|ne('disabled')}
	{def $var_is_string = true()}
	{def $addthis_config = ezini('config', 'addthis_config', 'addthis.ini')}
	<script type="text/javascript">
	    var addthis_config = {ldelim}
		                         {foreach $addthis_config as $kc => $vc}
		                             {set $var_is_string = true()}
	                                 {if or( $vc|is_numeric(), $vc|is_boolean(), $vc|eq('true'), $vc|eq('false') )}{set $var_is_string = false()}{/if}
		                             {$kc}: {if $var_is_string}'{/if}{$vc}{if $var_is_string}'{/if}
		                             {delimiter},{/delimiter}
		                         {/foreach}
	                         {rdelim}
	</script>
	<noscript></noscript>
	{undef $addthis_config}
	
	{def $addthis_share = ezini('share', 'addthis_share', 'addthis.ini')}
	{def $addthis_templates = ezini('templates', 'addthis_template', 'addthis.ini')}
	{def $addthis_transform = ezini('url_transforms', 'addthis_transform', 'addthis.ini')}
	<script type="text/javascript">
	    var addthis_share = {ldelim}
	                             {foreach $addthis_share as $ks => $vs}
	                                 {set $var_is_string = true()}
	                                 {if or( $vs|is_numeric(), $vs|is_boolean(), $vs|eq('true'), $vs|eq('false') )}{set $var_is_string = false()}{/if}
	                                 {$ks}: {if $var_is_string}'{/if}{$vs}{if $var_is_string}'{/if}
	                                 {delimiter},{/delimiter}
	                             {/foreach}
	                             {if $addthis_templates|count()|gt(0)}
		                             templates: {ldelim}
		                             {foreach $addthis_templates as $kt => $vt}
		                                 {set $var_is_string = true()}
		                                 {if or( $vt|is_numeric(), $vt|is_boolean(), $vt|eq('true'), $vt|eq('false') )}{set $var_is_string = false()}{/if}
		                                 {$kt}: {if $var_is_string}'{/if}{$vt}{if $var_is_string}'{/if}
		                                 {delimiter},{/delimiter}
		                             {/foreach}
		                             {rdelim}{if $addthis_transform|count()|gt(0)},{/if}
	                             {/if}
	                             {if $addthis_transform|count()|gt(0)}
	                                 url_transforms: {ldelim}
	                                 {foreach $addthis_transform as $ku => $vu}
	                                     {set $var_is_string = true()}
	                                     {if or( $vu|is_numeric(), $vu|is_boolean(), $vu|eq('true'), $vu|eq('false') )}{set $var_is_string = false()}{/if}
	                                     {$ku}: {if $var_is_string}'{/if}{$vu}{if $var_is_string}'{/if}
	                                     {delimiter},{/delimiter}
	                                 {/foreach}
	                                 {rdelim}
	                             {/if}
	                        {rdelim}
	</script>
	<noscript></noscript>
	{undef $addthis_share $addthis_templates $addthis_transform}
	
	{* init constants *}
	{def $addthis_btn = array()}
	{if ezini_hasvariable('buttons', 'addthis_button', 'addthis.ini')}
		{set $addthis_btn = ezini('buttons', 'addthis_button', 'addthis.ini')}
	{/if}
	{def $fblike = 'disabled'}
	{if ezini_hasvariable('buttons', 'addthis_button', 'addthis.ini')}
		{set $fblike = ezini('buttons', 'facebook_like', 'addthis.ini')}
	{/if}
	{def $twlike = 'disabled'}
	{if ezini_hasvariable('buttons', 'addthis_button', 'addthis.ini')}
		{set $twlike = ezini('buttons', 'twitter_like', 'addthis.ini')}
	{/if}
	{* END *}
	
	<!-- ADDTHIS BUTTON BEGIN -->
	<div id="addthis_box" 
	     class="addthis_toolbox addthis_default_style"
	     {if is_set($url_toshare)}addthis:url="{$url_toshare}"{/if}
	     {if is_set($title_toshare)}addthis:title="{$title_toshare}"{/if}
	     {if is_set($desc_toshare)}addthis:description="{$desc_toshare}"{/if}>
	     {foreach $addthis_btn as $kb => $vb}
	         {if or( $vb|eq('facebook'), $vb|eq('facebook_like') ) }
	             <span class="fb-share-button cursor">
	                 <a class="addthis_button_{$vb}{if and($fblike|eq('enabled'), $vb|eq('facebook_like')|not())}_like{/if}" {if or($vb|eq('facebook_like'), $fblike|eq('enabled'))}fb:like:layout="button_count"{/if} fb:like:action="like"></a>
	             </span>
	         {elseif and(or($vb|eq('twitter'), $vb|eq('tweet')), $twlike|eq('enabled'))}
	             <span class="fb-share-button cursor">
	                 <a class="addthis_button_tweet" tw:count="horizontal"></a>
	             </span>
	         {else}
	         	 {if $templating|ne('custom')}
	         	     <span class="share-button cursor">
	         	         <a class="addthis_button_{$vb}"></a>
	         	     </span>
	         	 {else}
		             {def $text = $vb|i18n('design/ezsharenetwork/social')}
		             <span class="share-button cursor">
			             <a class="addthis_button_{$vb}">
			                 <img src={concat('social/', $vb, '.png')|ezimage()}
			                      width="14" 
			                      height="14" 
			                      border="0" 
			                      class="left"
			                      alt="{$text}" />
		                     <span class="right">{$text}</span>
		                     <div class="clear"></div>
			             </a>
			         </span>
			         {undef $text}
		         {/if}
		     {/if}
	     {/foreach}
	</div>
	{undef $addthis_share $fblike $twlike}
	<!-- ADDTHIS BUTTON END -->
	
	{literal}
	{* TODO : put this in a config file *}
	<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#async=1"></script>
	<noscript></noscript>
	{/literal}
	
	{def $authorized_lib = array( 'jquery' )}{* TODO: Manage authorized lib with file parsing helper in futur *}
	{def $preferred_lib = ezini('eZJSCore', 'PreferredLibrary', 'ezjscore.ini')}{if $authorized_lib|contains( $preferred_lib )|not()}{set $preferred_lib = 'jquery'}{/if}
	{ezscript_require( array( concat( 'ezjsc::', $preferred_lib ), concat( 'ezjsc::', $preferred_lib, 'io' ), concat( 'addthis_', $preferred_lib, '.js' ) ) )}
	{undef $authorized_lib $preferred_lib}
	
{/if}
{undef $display_social_share $templating}