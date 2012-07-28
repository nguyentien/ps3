{if $menus}
<h3>Danh sách thực đơn</h3>
<table>
<tr>
<th>STT</th>
<th>Tên thực đơn</th>
<th>ĐVT</th>
<th>Đơn giá</th>
</tr>
{section name=m loop=$menus}
<tr>
<td>{$smarty.section.m.index + 1}</td>
<td>{$menus[m]->get_name()}</td>
<td>{$menus[m]->get_unit()}</td>
<td>{$menus[m]->get_cost()}</td>
<td><a href="javascript: void()">Sửa</a><a href="javascript: void()">Xoá</a></td>
</tr>
{/section}
</table>
{/if}
<table>
<tr>
<td>Tên thực đơn:</td>
<td><input type="text" name="name" id="name"></td>
</tr>
<tr>
<td>Đơn vị tính:</td>
<td><input type="text" name="unit" id="unit"></td>
</tr>
<tr>
<td>Đơn giá:</td>
<td><input type="text" name="cost" id="cost"></td>
</tr>
<tr>
<td colspan="2">
{if $menus}
<a href="">Cập nhật</a>
{/if}
<a href="">Thêm mới</a>
</td>
</tr>
</table>
