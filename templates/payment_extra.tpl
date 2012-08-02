<table>
<tr>
<th>Tên thực đơn</th>
<th>ĐVT</th>
<th>SL</th>
<th>T. tiền</th>
<th></th>
</tr>
{section name=p loop=$payment_extra}
<tr>
<td>{$payment_extra[p]['name']}</td>
<td>{$payment_extra[p]['unit']}</td>
<td>{$payment_extra[p]['number']}</td>
<td>{$payment_extra[p]['tt']|number_format:0:",":","}</td>
<td><a href="javascript: deleteExtra({$payment_extra[p]['id']})">Xóa</a></td>
</tr>
{/section}
<tr>
<td colspan="4">
<a href="" id="menu_add">Thêm mới</a>
</td>
</tr>
</table>
<script type="text/javascript">
jQuery('#menu_add').click(function() {
	jQuery('#list_menu').dialog('open');
	return false;
});

function deleteExtra(id) {
	if (confirm('Bạn có chắc muốn xóa!')) {
		jQuery('#payment_extra').load(
			'payment_extra',
			'delete=1&id=' + id
		);
	}
}
</script>