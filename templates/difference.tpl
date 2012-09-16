<h3>Thông tin khác</h3>
<form id="form1" action="" method="post" class="form">
<table id="difference">
<tr>
<td style="width: 200px;">Giá mặc định cho mỗi máy:</td>
<td><input style="width: 100px" type="text" name="cost" id="cost" {if $default_cost} value="{$default_cost|number_format:0:",":","}" {/if}></td>
</tr>
<tr>
<tr>
<td>Đơn vị tính tiền mặc định:</td>
<td><input style="width: 100px" type="text" name="unit" id="unit" {if $default_unit} value="{$default_unit|number_format:0:",":","}" {/if}> giờ</td>
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
 * Update
 */
jQuery('#update').click(function() {
	jQuery('#form1').submit();
	return false;
});

/**
 * Submit form
 */
jQuery('#form1').submit(function() {
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
	return false;
});

</script>