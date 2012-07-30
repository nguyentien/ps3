{include file="header.tpl"}

<!-- Payment -->
<div id="payment" class="float">
{include file="payment.tpl"}
</div>
<!-- End Payment -->

<!-- Menu -->
<div id="payment_extra" class="float">
{include file="payment_extra.tpl"}
</div>
<!-- End Menu -->

<!-- List menu -->
<div id="list_menu">
<table>
<tr>
<td></td>
<th>Tên thực đơn</th>
<th>Đơn vị tính</th>
<th>Đơn giá</th>
</tr>
{section name=m loop=$menus}
<tr>
<td>
<input type="checkbox" name="menu_id" value="{$menus[m]->get_id()}">
</td>
<td>{$menus[m]->get_name()}</td>
<td>{$menus[m]->get_unit()}</td>
<td>{$menus[m]->get_cost()|number_format:0:",":","}</td>
</tr>
{/section}
</table>
</div>
<!-- End list menu -->

<script type="text/javascript">
jQuery(document).ready(function() {
	jQuery('#list_menu').dialog({
		autoOpen: false,
		modal: true,
		width: 400,
		title: 'Danh sách thực đơn',
		resizable: false,
		buttons: {
			'Thêm': function () {
				var	arr = new Array();
				jQuery('#list_menu :checked').each(function() {
					arr.push(jQuery(this).val());
				});
				jQuery('#payment_extra').load(
					'detail',
					'menu_add=1&menu_id=' + arr.toString()
				);
				jQuery('#list_menu').dialog('close');
			},
			'Huỷ bỏ': function () {
				jQuery('#list_menu').dialog('close');
			}
		}
	});
});
</script>

{include file="footer.tpl"}