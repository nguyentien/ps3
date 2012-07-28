<h3>Thông tin khác</h3>
<table>
<tr>
<td>Giá mặc định cho mỗi máy:</td>
<td><input type="text" name="default" id="default" {if $default_cost} value="{$default_cost|number_format:0:",":","}" {/if}></td>
</tr>
<tr>
<td colspan="2">
<a href="javascript:save()">Cập nhật</a>
</td>
</tr>
</table>
<script type="text/javascript">
function save() {
	var data;
	data = 'save=1&default=' + jQuery('#default').val();
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
</script>