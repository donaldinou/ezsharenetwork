{def $social_network = 'addthis'}
{if ezini_hasvariable('social_share', 'social_share_network', 'ezsharenetwork.ini')}
	{set $social_network = ezini('social_share', 'social_share_network', 'ezsharenetwork.ini')}
{/if}

{switch match=$social_network}
	{case match='addthis'}
		{include uri='design:block/addthis_social_network.tpl'}
	{/case}
	{case match='sharethis'} 
		{include uri='design:block/sharethis_social_network.tpl'}
	{/case}
	{case}
		
	{/case}
{/switch}

{undef $social_network}