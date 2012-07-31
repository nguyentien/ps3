<table>
<tr>
<td colspan="4">
	<span>Tổng các lần trước</span>
	<input type="text">
	<a href="">Chi tiết</a>
</td>
</tr>
<tr>
<td>Bắt đầu</td>
<td>
{if $status}
<input type="text" disabled="disabled">
{else}
<a href="" id="begin">Bắt đầu</a>
{/if}
</td>
<td>Kết thúc</td>
<td>
{if $status}
<a href="" id="end">Kết thúc</a>
{else}
<input type="text" disabled="disabled">
{/if}
</td>
</tr>
<tr>
<td>Tiền giờ</td>
<td><input type="text" value="{$cost|number_format:0:",":","}"></td>
<td>Phụ thu</td>
<td><input type="text"></td>
</tr>
<tr>
<td>Tổng tiền</td>
<td><input type="text"></td>
<td>Giảm giá</td>
<td><input type="text"></td>
</tr>
<tr>
<td>Phải trả</td>
<td><input type="text"></td>
<td>Ghi chú</td>
<td><input type="text"></td>
</tr>
<tr>
<td colspan="4">
	<a href="">Lưu lượt này, Tạo lượt mới</a>
	<a href="">In phiếu</a>
</td>
</tr>
<tr>
<td colspan="4">
	<a href="">Chuyển máy</a>
	<a href="">Trả máy</a>
	<a href="">Thu tiền</a>
</td>
</tr>
</table>
<script type="text/javascript">
jQuery('#begin').click(function() {
	jQuery('#payment').load(
		'detail',
		'payment=1&id={$id}&start=1'
	);
	return false;
});

jQuery('#end').click(function() {
	jQuery('#payment').load(
		'detail',
		'payment=1&id={$id}&end=1'
	);
	return false;
});
</script>