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
<td>{$devices[d]['uid']}</td>
<td>{$devices[d]['name']}</td>
<td>{$devices[d]['cost']|number_format:0:",":","}</td>
<td>{$devices[d]['range_name']}</td>
<td>
	<a href="javascript: device_update_layout({$devices[d]['id']}, '{$devices[d]['uid']}', '{$devices[d]['name']}', {$devices[d]['cost']}, {$devices[d]['range_id']})">Sửa</a>
	<a href="javascript: device_delete({$devices[d]['id']})">Xoá</a></td>
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
<input type="checkbox" name="default" id="default" value=0>
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
<a href="javascript: device_update()" id="update" class="hidden">Cập nhật</a>
<a href="javascript: device_save()" id="insert">Thêm mới</a>
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
		device_update();
	} else {
		device_save();
	}
	return false;
});

jQuery('#default').click(function(){
	if (jQuery(this).is(':checked')) {
		jQuery('#cost').attr('disabled', true);
		jQuery(this).val(1);
	} else {
		jQuery('#cost').attr('disabled', false);
		jQuery(this).val(0);
	}
});

/**
 * Save
 */
function device_save() {
	if (!jQuery('#uid').val() || !jQuery('#name').val() || (!jQuery('#cost').val() && !jQuery('#default').is(':checked'))) {
		alert('Vui lòng nhập đầy đủ thông tin!');
		return false;
	}
	jQuery.ajax({
		url: 'device',
		data: 'insert=1&uid=' + jQuery('#uid').val() + '&name=' + jQuery('#name').val() + '&cost='+jQuery('#cost').val() + '&range='+jQuery('#range').val() + '&default=' + jQuery('#default').val(),
		type: 'POST',
		success: function(result) {
			loadContent(1);
		}
	});
}

/**
 * Update layout
 */
function device_update_layout(id, uid, name, cost, range) {
	jQuery('#id').val(id);
	jQuery('#uid').val(uid);
	jQuery('#name').val(name);
	jQuery('#cost').val(cost);
	jQuery('#range option[value=' + range +']').attr('selected', 'selected');
	
	jQuery('#update').removeClass('hidden');
	jQuery('#insert').addClass('hidden');
}

/**
 * Update
 */
function device_update() {
	if (!jQuery('#uid').val() || !jQuery('#name').val() || (!jQuery('#cost').val() && !jQuery('#default').is(':checked'))) {
		alert('Vui lòng nhập đầy đủ thông tin!');
		return false;
	}
	jQuery.ajax({
		url: 'device',
		data: 'update=1&id=' + jQuery('#id').val() + '&uid=' + jQuery('#uid').val() + '&name=' + jQuery('#name').val() + '&cost=' + jQuery('#cost').val() + '&range=' + jQuery('#range').val() + '&default=' + jQuery('#default').val(),
		type: 'POST',
		success: function(result) {
			if (result) {
				loadContent(1);
			}
		}
	});
}

/**
 * Delete
 */
function device_delete(id) {
	if (confirm('Bạn muốn xoá máy này?')) {
		jQuery.ajax({
			url: 'device',
			data: 'delete=1&id=' + id,
			type: 'POST',
			success: function(result) {
				if (result) {
					loadContent(1);
				}
			}
		});
	}
}
</script>