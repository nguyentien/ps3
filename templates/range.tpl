<!-- List -->
{if $ranges}
<h3>Danh sách dãy máy</h3>
<table class="table">
<tr>
<th style="width: 40px">STT</th>
<th style="width: 130px">Tên</th>
<th></th>
<th style="width: 115px"></th>
</tr>
{section name=r loop=$ranges}
<tr>
<td><span>{$smarty.section.r.index + 1}</span></td>
<td>{$ranges[r]->get_name()}</td>
<td></td>
<td>
	<a href="javascript: range_update_layout({$ranges[r]->get_id()}, '{$ranges[r]->get_name()}')">Sửa</a>
	<a href="javascript: range_delete({$ranges[r]->get_id()})">Xoá</a></td>
</td>
</tr>
{/section}
<tr>
<td colspan="3"></td>
<td><a style="float: right; margin-right: 13px" href="" id="insert">Thêm mới</a></td>
</tr>
</table>
{/if}
<!-- End List -->

<script type="text/javascript">
/**
 * Open
 */
jQuery('#insert').click(function() {
	jQuery('#id_range').val('');
	jQuery('#name_range').val('');
	
	jQuery('#action_range').dialog('open');
	return false;
});

/**
 * Update layout
 */
function range_update_layout(id, name) {
	jQuery('#id_range').val(id);
	jQuery('#name_range').val(name);
	
	jQuery('#action_range').dialog('open');
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