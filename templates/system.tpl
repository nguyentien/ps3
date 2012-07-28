{include file="header.tpl"}
<div id="system">
<ul>
<li><a href="" id="sys_range">Dãy</a></li>
<li><a href="" id="sys_device">Máy</a></li>
<li><a href="" id="sys_menu">Thực đơn</a></li>
<li><a href="" id="sys_diff">Thông tin khác</a></li>
</ul>
<div class="clear"></div>
<div id="content"></div>
</div>

<script type="text/javascript">
jQuery(document).ready(function() {
	// Run at first
	loadContent(0);
	
	// Click menu "day"
	jQuery('#sys_range').click(function() {
		loadContent(0);
		return false;
	});
	
	// Click menu "may"
	jQuery('#sys_device').click(function() {
		loadContent(1);
		return false;
	});
	
	// Click menu "thuc don"
	jQuery('#sys_menu').click(function() {
		loadContent(2);
		return false;
	});
	
	// Click menu "thong tin khac"
	jQuery('#sys_diff').click(function() {
		loadContent(3);
		return false;
	});
});
</script>
{include file="footer.tpl"}