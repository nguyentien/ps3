{if $menus}
<h3>Danh sách thực đơn</h3>
<table class="table">
<tr>
<th style="width: 40px">STT</th>
<th>Tên thực đơn</th>
<th>ĐVT</th>
<th>Đơn giá</th>
<th></th>
<th style="width: 115px"></th>
</tr>
{section name=m loop=$menus}
<tr>
<td><span>{$smarty.section.m.index + 1}</span></td>
<td>{$menus[m]->get_name()}</td>
<td>{$menus[m]->get_unit()}</td>
<td>{$menus[m]->get_cost()|number_format:0:",":","}</td>
<td></td>
<td>
	<a href="javascript: menu_update_layout({$menus[m]->get_id()}, '{$menus[m]->get_name()}', '{$menus[m]->get_unit()}', {$menus[m]->get_cost()})">Sửa</a>
	<a href="javascript: menu_delete({$menus[m]->get_id()})">Xoá</a></td>
</tr>
{/section}
<tr>
<td colspan="5"></td>
<td><a style="float: right; margin-right: 13px" href="" id="insert">Thêm mới</a></td>
</tr>
</table>
{/if}
<script type="text/javascript">

jQuery('#insert').click(function() {
	jQuery('#id_menu').val('');
	jQuery('#name_menu').val('');
	jQuery('#unit').val('');
	jQuery('#cost_menu').val('');
	
	jQuery('#action_menu').dialog('open');
	return false;
});

/**
 * Update layout
 */
function menu_update_layout(id, name, unit, cost) {
	jQuery('#id_menu').val(id);
	jQuery('#name_menu').val(name);
	jQuery('#unit').val(unit);
	jQuery('#cost_menu').val(cost);
	
	jQuery('#action_menu').dialog('open');
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
