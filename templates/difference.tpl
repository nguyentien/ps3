<h3>Thông tin khác</h3>
<form id="form1" action="" method="post">
<table>
<tr>
<td>Giá mặc định cho mỗi máy:</td>
<td><input type="text" name="cost" id="cost" {if $default_cost} value="{$default_cost|number_format:0:",":","}" {/if}></td>
</tr>
<tr>
<tr>
<td>Đơn vị tính tiền mặc định:</td>
<td><input type="text" name="unit" id="unit" {if $default_unit} value="{$default_unit|number_format:0:",":","}" {/if}> giờ</td>
</tr>
<tr>
<td colspan="2">
<a href="" id="update">Cập nhật</a>
</td>
</tr>
</table>
<input class="submit" type="submit">
</form>
<script type="text/javascript">

/**
 * Save
 */
function save() {
	var data;
	data = 'save=1&cost=' + jQuery('#cost').val() + '&unit=' + jQuery('#unit').val();
	jQuery.ajax({
		url: 'difference',
		data: data,
		type: 'POST',
		success: function(result) {
			if (result) {
				alert('Cập nhật thành công!');
				loadContent(3);
			}
		}
	});
}

jQuery('#update').click(function() {
	save();
	return false;
});

jQuery('#form1').submit(function() {
	save();
	return false;
});

</script>