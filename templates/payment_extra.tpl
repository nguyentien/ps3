<table>
<tr>
<th>Tên thực đơn</th>
<th>ĐVT</th>
<th>SL</th>
<th>T. tiền</th>
</tr>
<tr>
<td>Row 1: Col 1</td>
<td>Row 1: Col 2</td>
<td>Row 1: Col 1</td>
<td>Row 1: Col 2</td>
</tr>
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
</script>