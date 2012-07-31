{include file="header.tpl"}
{section name=r loop=$ranges}
	<div class="range" style="width: {$width}px">
	<h3>{$ranges[r]->get_name()}</h3>
	<ul>
{section name=d loop=$devices}
{if $devices[d]['range_id'] eq $ranges[r]->get_id()}
	<li>
		<a href="detail?id={$devices[d]['id']}"><img src="{$baseUrl}/images/ps3.jpg" alt="PS3" height="100" width="100"></a>
		<a href="detail?id={$devices[d]['id']}" class="name">{$devices[d]['name']}</a>
	</li>
{/if}	
{/section}
	</ul>
	</div>
{/section}
{include file="footer.tpl"}