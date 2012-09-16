<div id="report">
<h3>Báo cáo</h3>
<fieldset>
<legend>Báo cáo ngày</legend>
<form action="" method="post">
<p>Chọn máy</p>
<select name="device">
	<option value="0">Tất cả</option>
{section name=d loop=$device}
	<option value="{$device[d]['id']}">{$device[d]['name']}</option>
{/section}
</select>
<p>Chọn ngày</p>
<input type="text" id="date" name="date" value="{$smarty.now|date_format:'%d/%m/%Y'}"><br>
<input type="submit" value="Báo cáo">
<input type="hidden" name="report" value="1">
</form>
</fieldset>
<fieldset>
<legend>Báo cáo tuần</legend>
<form action="" method="post">
<p>Chọn máy</p>
<select name="device">
	<option value="0">Tất cả</option>
{section name=d loop=$device}
	<option value="{$device[d]['id']}">{$device[d]['name']}</option>
{/section}
</select>
<p>Từ ngày</p>
<input type="text" id="date_from" value="{($smarty.now-604800)|date_format:'%d/%m/%Y'}">
<p>Đến ngày</p>
<input type="text" id="date_to" value="{$smarty.now|date_format:'%d/%m/%Y'}"><br>
<input type="submit" value="Báo cáo">
<input type="hidden" name="report" value="2">
</form>
</fieldset>
<fieldset>
<legend>Báo cáo tháng</legend>
<form action="" method="post">
<p>Chọn máy</p>
<select name="device">
<option value="0">Tất cả</option>
	{section name=d loop=$device}
	<option value="{$device[d]['id']}">{$device[d]['name']}</option>
{/section}
</select>
<p>Chọn tháng</p>
<select name="month">
{section name=foo loop=12}
	<option {if $smarty.section.foo.iteration eq $smarty.now|date_format:'%m'} selected="selected" {/if}>{$smarty.section.foo.iteration}</option>
{/section}
</select>
<br>
<input type="submit" value="Báo cáo">
<input type="hidden" name="report" value="3">
</form>
</fieldset>
<div class="clear"></div>
</form>
</div>
<script type="text/javascript">
jQuery(document).ready(function() {
	jQuery('#date_date').datepicker({
		dateFormat: 'dd/mm/yy',
	});
	jQuery('#date_week_from').datepicker({
		dateFormat: 'dd/mm/yy',
	});
	jQuery('#date_week_to').datepicker({
		dateFormat: 'dd/mm/yy',
	});
	jQuery('input:submit').button();
});

// Report date
jQuery('#report_date').click(function() {
	jQuery.ajax({
		url: 'report',
		type: 'POST',
		data: 'report=1'
	});
});

//Report date
jQuery('#report_week').click(function() {
	
});

//Report date
jQuery('#report_month').click(function() {
	
});
</script>