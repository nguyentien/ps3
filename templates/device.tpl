<!-- List -->
{if $devices}
<h3>Danh sách máy</h3>
<table class="table">
<tr>
<th style="width: 10px">STT</th>
<th style="width: 100px">Mã máy</th>
<th style="width: 100px">Tên máy</th>
<th style="width: 100px">Giá</th>
<th style="width: 100px">Dãy</th>
<th style="width: 100px"></th>
</tr>
{section name=d loop=$devices}
<tr>
<td>{$smarty.section.d.index + 1}</td>
<td>{$devices[d]->get_uid()}</td>
<td>{$devices[d]->get_name()}</td>
<td>{$devices[d]->get_cost()}</td>
<td>{$devices[d]->get_range()}</td>
<td><a href="javascript: void()">Sửa</a><a href="javascript: void()">Xoá</a></td>
</tr>
{/section}
</table>
{/if}
<!-- End List -->
<!-- Insert, Update -->
<table>
<tr>
<td>Mã máy:</td>
<td><input type="text" name="uid" id="uid"></td>
</tr>
<tr>
<td>Tên máy:</td>
<td><input type="text" name="name" id="name"></td>
</tr>
<tr>
<td>Giá tiền:</td>
<td>
<input type="text" name="cost" id="cost">
<input type="checkbox" value=1 name="default">
<span>Mặc định</span>
</td>
</tr>
<tr>
<td>Dãy:</td>
<td>
<select name="range" id="range">
{section name=r loop=$ranges}
<option value="{$ranges[r]->get_id()}">{$ranges[r]->get_name()}</option>
{/section}
</select>
</td>
</tr>
<tr>
<td colspan="2">
<a href="">Cập nhật</a>
<a href="">Thêm mới</a>
</td>
</tr>
</table>
<!-- End Insert, Update -->