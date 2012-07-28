<!-- List -->
{if $ranges}
<h3>Danh sách dãy máy</h3>
<table>
<tr>
<th>STT</th>
<th>Tên</th>
<th></th>
</tr>
{section name=r loop=$ranges}
<tr>
<td>{$smarty.section.r.index + 1}</td>
<td>{$ranges[r]->get_name()}</td>
<td><a href="">Sửa</a><a href="">Xoá</a></td>
</tr>
{/section}
</table>
{/if}
<!-- End List -->

<!-- Insert, Update -->
<table>
<tr>
<td>Tên:</td>
<td><input type="text" name="name" id="name"></td>
</tr>
<tr>
<td colspan="2">
<a href="">Cập nhật</a>
<a href="">Thêm mới</a>
</td>
</tr>
</table>
<!-- End Insert, Update -->