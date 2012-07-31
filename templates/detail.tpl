{include file="header.tpl"}
{if $status}
<a href="">Bắt đầu</a>
{else}
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
<td><input type="text"></td>
<td>Kết thúc</td>
<td><input type="text"></td>
</tr>
<tr>
<td>Tiền giờ</td>
<td><input type="text"></td>
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

{/if}
{include file="footer.tpl"}