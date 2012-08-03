<!-- List -->
{if $devices}
<h3>Danh sách máy</h3>
<table class="table">
<tr>
<th style="width: 40px">STT</th>
<th style="width: 100px">Mã máy</th>
<th style="width: 300px">Tên máy</th>
<th style="width: 100px">Giá</th>
<th style="width: 100px">Dãy</th>
<th></th>
<th style="width: 115px"></th>
</tr>
{section name=d loop=$devices}
<tr>
<td><span>{$smarty.section.d.index + 1}</span></td>
<td>{$devices[d]['uid']}</td>
<td>{$devices[d]['name']}</td>
<td>{$devices[d]['cost']|number_format:0:",":","}</td>
<td>{$devices[d]['range_name']}</td>
<td></td>
<td>
	<a href="javascript: device_update_layout({$devices[d]['id']}, '{$devices[d]['uid']}', '{$devices[d]['name']}', {$devices[d]['cost']}, {$devices[d]['range_id']})">Sửa</a>
	<a href="javascript: device_delete({$devices[d]['id']})">Xoá</a></td>
</td>
</tr>
{/section}
<tr>
<td colspan="6"></td>
<td><a style="float: right; margin-right: 13px" href="" id="insert">Thêm mới</a></td>
</tr>
</table>
{/if}
<!-- End List -->

<script type="text/javascript">

jQuery('#insert').click(function() {
	jQuery('#id_device').val('');
	jQuery('#uid').val('');
	jQuery('#name_device').val('');
	jQuery('#cost').val('');
	jQuery('#cost').attr('disabled', false);
	
	jQuery('#action_device').dialog('open');
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
 * Update layout
 */
function device_update_layout(id, uid, name, cost, range) {
	jQuery('#id_device').val(id);
	jQuery('#uid').val(uid);
	jQuery('#name_device').val(name);
	jQuery('#cost').val(cost);
	jQuery('#cost').attr('disabled', false);
	jQuery('#default').attr('checked', false);
	jQuery('#default').val(0);
	jQuery('#range option[value=' + range +']').attr('selected', 'selected');
	
	jQuery('#action_device').dialog('open');
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