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
<td>
	<a href="javascript: range_update_layout({$ranges[r]->get_id()}, '{$ranges[r]->get_name()}')">Sửa</a>
	<a href="javascript: range_delete({$ranges[r]->get_id()})">Xoá</a></td>
</td>
</tr>
{/section}
</table>
{/if}
<!-- End List -->

<!-- Insert, Update -->
<form id="form1" action="" method="post">
<table>
<tr>
<td>Tên:</td>
<td><input type="text" name="name" id="name"></td>
</tr>
<tr>
<td colspan="2">
	<a href="javascript: range_update()" id="update" class="hidden">Cập nhật</a>
	<a href="javascript: range_save()" id="insert">Thêm mới</a>
</td>
</tr>
</table>
<!-- Hidden -->
<input type="hidden" name="id" id="id">
<!-- End -->
<input class="submit" type="submit">
</form>
<!-- End Insert, Update -->
<script type="text/javascript">
jQuery('#form1').submit(function() {
	if (jQuery('#id').val()) {
		range_update();
	} else {
		range_save();
	}
	return false;
});

/**
 * Save
 */
function range_save() {
	if (!jQuery('#name').val()) {
		alert('Vui lòng nhập tên của dãy!');
		return false;
	}
	jQuery.ajax({
		url: 'range',
		data: 'insert=1&name=' + jQuery('#name').val(),
		type: 'POST',
		success: function(result) {
			loadContent(0);
		}
	});
}

/**
 * Update layout
 */
function range_update_layout(id, name) {
	jQuery('#id').val(id);
	jQuery('#name').val(name);
	
	jQuery('#update').removeClass('hidden');
	jQuery('#insert').addClass('hidden');
}

/**
 * Update
 */
function range_update() {
	if (!jQuery('#name').val()) {
		alert('Vui lòng nhập tên của dãy!');
		return false;
	}
	jQuery.ajax({
		url: 'range',
		data: 'update=1&id=' + jQuery('#id').val() + '&name=' + jQuery('#name').val(),
		type: 'POST',
		success: function(result) {
			if (result) {
				loadContent(0);
			}
		}
	});
}

/**
 * Delete
 */
function range_delete(id) {
	if (confirm('Bạn muốn xoá dãy này?')) {
		jQuery.ajax({
			url: 'range',
			data: 'delete=1&id=' + id,
			type: 'POST',
			success: function(result) {
				if (result) {
					loadContent(0);
				}
			}
		});
	}
}
</script>