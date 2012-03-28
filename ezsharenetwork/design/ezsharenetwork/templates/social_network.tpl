{def $social_network = get_preferred_share_api()}

{switch match=$social_network}
	{case match='addthis'}
		{include uri='design:block/addthis_social_network.tpl'}
	{/case}
	{case match='sharethis'} 
		{include uri='design:block/sharethis_social_network.tpl'}
	{/case}
	{case}
		{* Nothing *}
	{/case}
{/switch}

{undef $social_network}