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
<td>
	<a href="javascript: menu_update_layout({$menus[m]->get_id()}, '{$menus[m]->get_name()}', '{$menus[m]->get_unit()}', {$menus[m]->get_cost()})">Sửa</a>
	<a href="javascript: menu_delete({$menus[m]->get_id()})">Xoá</a></td>
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
<a href="javascript: menu_update()" id="update" class="hidden">Cập nhật</a>
<a href="javascript: menu_save()" id="insert">Thêm mới</a>
</td>
</tr>
</table>
<!-- Hidden -->
<input type="hidden" name="id" id="id">
<!-- End -->
<script type="text/javascript">
/**
 * Save
 */
function menu_save() {
	if (!jQuery('#name').val() || !jQuery('#unit').val() || !jQuery('#cost').val()) {
		alert('Vui lòng nhập đầy đủ thông tin!');
		return false;
	}
	jQuery.ajax({
		url: 'menu',
		data: 'insert=1&name=' + jQuery('#name').val() + '&unit='+jQuery('#unit').val() + '&cost='+jQuery('#cost').val(),
		type: 'POST',
		success: function(result) {
			loadContent(2);
		}
	});
}

/**
 * Update layout
 */
function menu_update_layout(id, name, unit, cost) {
	jQuery('#id').val(id);
	jQuery('#name').val(name);
	jQuery('#unit').val(unit);
	jQuery('#cost').val(cost);
	
	jQuery('#update').removeClass('hidden');
	jQuery('#insert').addClass('hidden');
}

/**
 * Update
 */
function menu_update() {
	jQuery.ajax({
		url: 'menu',
		data: 'update=1&id=' + jQuery('#id').val() + '&name=' + jQuery('#name').val() + '&unit=' + jQuery('#unit').val() + '&cost=' + jQuery('#cost').val(),
		type: 'POST',
		success: function(result) {
			if (result) {
				alert('Cập nhật thành công!');
				loadContent(2);
			}
		}
	});
}

/**
 * Delete
 */
function menu_delete(id) {
	if (confirm('Bạn muốn xoá thực đơn này?')) {
		jQuery.ajax({
			url: 'menu',
			data: 'delete=1&id=' + id,
			type: 'POST',
			success: function(result) {
				if (result) {
					loadContent(2);
				}
			}
		});
	}
}
</script>
