<table class="table">
<tr>
<th>Tên thực đơn</th>
<th>ĐVT</th>
<th>SL</th>
<th>T. tiền</th>
<th></th>
<th style="width: 115px"></th>
</tr>
{section name=p loop=$list_payment_menu}
<tr>
<td>{$list_payment_menu[p]['name']}</td>
<td>{$list_payment_menu[p]['unit']}</td>
<td>{$list_payment_menu[p]['number']}</td>
<td>{$list_payment_menu[p]['total']|number_format:0:",":","}</td>
<td></td>
<td><a style="float: right;" href="javascript: deleteExtra({$list_payment_menu[p]['id']})">Xóa</a></td>
</tr>
{/section}
<tr>
<td colspan="5">
</td>
<td>
<a style="float: right;" href="" id="menu_add">Thêm mới</a>
</td>
</tr>
</table>
<script type="text/javascript">
jQuery('#menu_add').click(function() {
	if (jQuery('#payment_id').val()) {
		jQuery('#list_menu').dialog('open');
	}
	return false;
});

function deleteExtra(id) {
	if (confirm('Bạn có chắc muốn xóa!')) {
		jQuery('#payment_menu').load(
			'payment_menu',
			'delete=1&payment_id=' + jQuery('#payment_id').val() + 
			'&payment_menu_id=' + id
		);
	}
}
</script>