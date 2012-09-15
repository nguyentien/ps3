<div id="report">
<fieldset>
<legend>Báo cáo ngày</legend>
<p>Chọn ngày</p>
<input type="text" id="date_date" value="{$smarty.now|date_format:'%d/%m/%Y'}"><br>
<input id="report_date" type="button" value="Báo cáo">
</fieldset>
<fieldset>
<legend>Báo cáo tuần</legend>
<p>Từ ngày</p>
<input type="text" id="date_week_from" value="{($smarty.now-604800)|date_format:'%d/%m/%Y'}">
<p>Đến ngày</p>
<input type="text" id="date_week_to" value="{$smarty.now|date_format:'%d/%m/%Y'}"><br>
<input id="report_week" type="button" value="Báo cáo">
</fieldset>
<fieldset>
<legend>Báo cáo tháng</legend>
<p>Chọn tháng</p>
<select>
{section name=foo loop=12}
	<option {if $smarty.section.foo.iteration eq $smarty.now|date_format:'%m'} selected="selected" {/if}>{$smarty.section.foo.iteration}</option>
{/section}
</select>
<br>
<input id="report_month" type="button" value="Báo cáo">
</fieldset>
<div class="clear"></div>
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
	jQuery('input:button').button();
});
</script>