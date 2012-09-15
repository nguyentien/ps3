{include file="header.tpl"}

<div id="system">
<ul>
<li><a href="" id="sys_range">Dãy</a></li>
<li><a href="" id="sys_device">Máy</a></li>
<li><a href="" id="sys_menu">Thực đơn</a></li>
<li><a href="" id="sys_diff">Thông tin khác</a></li>
<li><a href="" id="sys_report">Báo cáo</a></li>
</ul>
<div class="clear"></div>

<!-- Content -->
<div id="content"></div>
<!-- End Content -->

<!-- Insert, Update Rangle-->
<div id="action_range">
<form id="form_range" action="" method="post">
<table>
<tr>
<td colspan="2"><p>Tên *</p></td>
</tr>
<tr>
<td colspan="2"><input type="text" name="name_range" id="name_range"></td>
</tr>
<tr>
<td colspan="2"><span></span></td>
</tr>
</table>
<!-- Hidden -->
<input type="hidden" name="id_range" id="id_range">
<!-- End -->
<input class="submit" type="submit">
</form>
</div>
<!-- End Insert, Update -->

<!-- Insert, Update Device-->
<div id="action_device">
<form id="form_device" action="" method="post">
<table>
<tr>
<td colspan="2"><p>Mã máy *</p></td>
</tr>
<tr>
<td colspan="2"><input type="text" name="uid" id="uid"></td>
</tr>
<tr>
<td colspan="2"><span></span></td>
</tr>
<tr>
<td colspan="2"><p>Tên máy *</p></td>
</tr>
<tr>
<td colspan="2"><input type="text" name="name_device" id="name_device"></td>
</tr>
<tr>
<td colspan="2"><span></span></td>
</tr>
<tr>
<td colspan="2"><p>Giá tiền *</p></td>
</tr>
<tr>
<td colspan="2">
<input type="text" name="cost" id="cost" style="width: 200px">
<input type="checkbox" name="default" id="default" value=0 style="width: 20px">
<span style="display: inline; border: none">Mặc định</span>
</td>
</tr>
<tr>
<td colspan="2"><span></span></td>
</tr>
<tr>
<td colspan="2"><p>Dãy</p></td>
</tr>
<tr>
<td colspan="2">
<select name="range" id="range">
{section name=r loop=$ranges}
<option value="{$ranges[r]->get_id()}">{$ranges[r]->get_name()}</option>
{/section}
</select>
</td>
</tr>
<tr>
<td colspan="2"><span></span></td>
</tr>
</table>
<!-- Hidden -->
<input type="hidden" name="id_device" id="id_device">
<!-- End -->
<input class="submit" type="submit">
</form>
</div>
<!-- End Insert, Update -->

<!-- Div action menu -->
<div id="action_menu">
<form id="form_menu" action="" method="post">
<table>
<tr>
<td colspan="2"><p>Tên thực đơn *</p></td>
</tr>
<tr>
<td colspan="2"><input type="text" name="name_menu" id="name_menu"></td>
</tr>
<tr>
<td colspan="2"><span></span></td>
</tr>
<tr>
<td colspan="2"><p>Đơn vị tính *</p></td>
</tr>
<tr>
<td colspan="2"><input type="text" name="unit" id="unit"></td>
</tr>
<tr>
<td colspan="2"><span></span></td>
</tr>
<tr>
<td colspan="2"><p>Đơn giá *</p></td>
</tr>
<tr>
<td colspan="2"><input type="text" name="cost_menu" id="cost_menu"></td>
</tr>
<tr>
<td colspan="2"><span></span></td>
</tr>
</table>
<!-- Hidden -->
<input type="hidden" name="id_menu" id="id_menu">
<!-- End -->
<input class="submit" type="submit">
</form>
</div>
<!-- End div action menu -->
</div>

<script type="text/javascript">
jQuery(document).ready(function() {
	// Run at first
	loadContent(0);
	
	// Click menu "day"
	jQuery('#sys_range').click(function() {
		loadContent(0);
		return false;
	});
	
	// Click menu "may"
	jQuery('#sys_device').click(function() {
		loadContent(1);
		return false;
	});
	
	// Click menu "thuc don"
	jQuery('#sys_menu').click(function() {
		loadContent(2);
		return false;
	});
	
	// Click menu "thong tin khac"
	jQuery('#sys_diff').click(function() {
		loadContent(3);
		return false;
	});

	// Click menu "Bao cao"
	jQuery('#sys_report').click(function() {
		loadContent(4);
		return false;
	});
	
	// Dialog update
	jQuery('#action_range').dialog({
		autoOpen: false,
		modal: true,
		title: 'Cập nhật dãy',
		resizable: false,
		buttons: {
			'Đồng ý': function() {
				jQuery('#form_range').submit();
			},
			'Huỷ bỏ': function() {
				jQuery('#action_range').dialog('close');
			}
		}
	});
	
	// Dialog device
	jQuery('#action_device').dialog({
		autoOpen: false,
		modal: true,
		title: 'Cập nhật danh sách máy',
		resizable: false,
		width: 400,
		buttons: {
			'Đồng ý': function() {
				jQuery('#form_device').submit();
			},
			'Huỷ bỏ': function() {
				jQuery('#action_device').dialog('close');
			}
		}
	});
	
	// Dialog menu
	jQuery('#action_menu').dialog({
		autoOpen: false,
		modal: true,
		title: 'Cập nhật danh sách thực đơn',
		resizable: false,
		width: 400,
		buttons: {
			'Đồng ý': function() {
				jQuery('#form_menu').submit();
			},
			'Huỷ bỏ': function() {
				jQuery('#action_menu').dialog('close');
			}
		}
	});
});

// Submit form_range
jQuery('#form_range').submit(function() {
	if (jQuery('#id_range').val()) {
		if (!jQuery('#name_range').val()) {
			alert('Vui lòng nhập tên của dãy!');
			return false;
		}
		jQuery.ajax({
			url: 'range',
			data: 'update=1&id=' + jQuery('#id_range').val() + '&name=' + jQuery('#name_range').val(),
			type: 'POST',
			success: function(result) {
				if (result) {
					loadContent(0);
				}
			}
		});
	} else {
		if (!jQuery('#name_range').val()) {
			alert('Vui lòng nhập tên của dãy!');
			return false;
		}
		jQuery.ajax({
			url: 'range',
			data: 'insert=1&name=' + jQuery('#name_range').val(),
			type: 'POST',
			success: function(result) {
				loadContent(0);
			}
		});
	}
	jQuery('#action_range').dialog('close');
	return false;
});

// Submit form device
jQuery('#form_device').submit(function() {
	if (jQuery('#id_device').val()) {
		if (!jQuery('#uid').val() || !jQuery('#name_device').val() || (!jQuery('#cost').val() && !jQuery('#default').is(':checked'))) {
			alert('Vui lòng nhập đầy đủ thông tin!');
			return false;
		}
		jQuery.ajax({
			url: 'device',
			data: 'update=1&id=' + jQuery('#id_device').val() + '&uid=' + jQuery('#uid').val() + '&name=' + jQuery('#name_device').val() + '&cost=' + jQuery('#cost').val() + '&range=' + jQuery('#range').val() + '&default=' + jQuery('#default').val(),
			type: 'POST',
			success: function(result) {
				if (result) {
					loadContent(1);
				}
			}
		});
	} else {
		if (!jQuery('#uid').val() || !jQuery('#name_device').val() || (!jQuery('#cost').val() && !jQuery('#default').is(':checked'))) {
			alert('Vui lòng nhập đầy đủ thông tin!');
			return false;
		}
		jQuery.ajax({
			url: 'device',
			data: 'insert=1&uid=' + jQuery('#uid').val() + '&name=' + jQuery('#name_device').val() + '&cost='+jQuery('#cost').val() + '&range='+jQuery('#range').val() + '&default=' + jQuery('#default').val(),
			type: 'POST',
			success: function(result) {
				loadContent(1);
			}
		});
	}
	jQuery('#action_device').dialog('close');
	return false;
});

// Submit menu
jQuery('#form_menu').submit(function() {
	if (jQuery('#id_menu').val()) {
		if (!jQuery('#name_menu').val() || !jQuery('#unit').val() || !jQuery('#cost_menu').val()) {
			alert('Vui lòng nhập đầy đủ thông tin!');
			return false;
		}
		jQuery.ajax({
			url: 'menu',
			data: 'update=1&id=' + jQuery('#id_menu').val() + '&name=' + jQuery('#name_menu').val() + '&unit=' + jQuery('#unit').val() + '&cost=' + jQuery('#cost_menu').val(),
			type: 'POST',
			success: function(result) {
				if (result) {
					loadContent(2);
				}
			}
		});
	} else {
		if (!jQuery('#name_menu').val() || !jQuery('#unit').val() || !jQuery('#cost_menu').val()) {
			alert('Vui lòng nhập đầy đủ thông tin!');
			return false;
		}
		jQuery.ajax({
			url: 'menu',
			data: 'insert=1&name=' + jQuery('#name_menu').val() + '&unit='+jQuery('#unit').val() + '&cost='+jQuery('#cost_menu').val(),
			type: 'POST',
			success: function(result) {
				loadContent(2);
			}
		});
	}
	jQuery('#action_menu').dialog('close');
	return false;
});

</script>

{include file="footer.tpl"}