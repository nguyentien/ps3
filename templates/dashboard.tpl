{include file="header.tpl"}

<div class="content">
{section name=r loop=$ranges}
	<div class="range" style="width: {$width}px">
	<h3>{$ranges[r]->get_name()}</h3>
	<ul>
{section name=d loop=$devices}
{if $devices[d]['range_id'] eq $ranges[r]->get_id()}
	<li>
		<a href="detail?id={$devices[d]['id']}">
{if $devices[d]['status']}
			<img src="{$baseUrl}/images/ps4.jpg" alt="PS3" height="100" width="100">
{else}
			<img src="{$baseUrl}/images/ps3.jpg" alt="PS3" height="100" width="100">
{/if}
		</a>
		<a href="detail?id={$devices[d]['id']}" class="name">{$devices[d]['name']}</a>
	</li>
{/if}
{/section}
	</ul>
	</div>
{/section}
<div class="clear"></div>
</div>

{include file="footer.tpl"}