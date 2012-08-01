{include file="header.tpl"}

<h3>Máy {$device->get_name()}</h3>
<!-- Payment -->
<div id="payment" class="float">
{include file="payment.tpl"}
</div>
<!-- End Payment -->

<!-- Menu -->
<div id="payment_menu" class="float">
{include file="payment_menu.tpl"}
</div>
<!-- End Menu -->

<!-- List menu -->
<div id="list_menu">
<table>
<tr>
<td></td>
<th>Tên thực đơn</th>
<th>Đơn vị tính</th>
<th>Đơn giá</th>
<th></th>
</tr>
{section name=m loop=$list_menu}
<tr>
<td>
<input type="checkbox" name="menu_id" value="{$list_menu[m]->get_id()}" onclick="displayNumber(this, {$list_menu[m]->get_id()})">
</td>
<td>{$list_menu[m]->get_name()}</td>
<td>{$list_menu[m]->get_unit()}</td>
<td>{$list_menu[m]->get_cost()|number_format:0:",":","}</td>
<td><input style="width: 40px" type="text" class="hidden" id="number_{$list_menu[m]->get_id()}" value=1></td>
</tr>
{/section}
</table>
</div>
<!-- End list menu -->

<!-- List device -->
<div id="list_device">
<table>
<tr>
<td>Chọn máy: </td>
<td>
<select id="device_id">
{section name=d loop=$list_device}
<option value="{$list_device[d]['id']}">{$list_device[d]['name']}</option>
{/section}
</select>
</td>
</tr>
</table>
</div>
<!-- End list device -->
<script type="text/javascript">
jQuery(document).ready(function() {
	jQuery('#list_menu').dialog({
		autoOpen: false,
		modal: true,
		width: 400,
		title: 'Danh sách thực đơn',
		resizable: false,
		buttons: {
			'Thêm': function () {
				var	arr = new Array();
				var	arr1 = new Array();
				jQuery('#list_menu :checked').each(function() {
					arr.push(jQuery(this).val());
					arr1.push(jQuery('#number_' + jQuery(this).val()).val());
				});
				jQuery('#payment_menu').load(
					'payment_menu',
					'add=1&payment_id=' + jQuery('#payment_id').val() + '&menus=' + arr.toString() +
					'&numbers=' + arr1.toString()
				);
				jQuery('#list_menu :checked').each(function() {
					jQuery(this).attr('checked', false);
					jQuery('#number_' + jQuery(this).val()).val('1');
					jQuery('#number_' + jQuery(this).val()).addClass('hidden');
				});
				jQuery('#list_menu').dialog('close');
			},
			'Huỷ bỏ': function () {
				jQuery('#list_menu :checked').each(function() {
					jQuery(this).attr('checked', false);
					jQuery('#number_' + jQuery(this).val()).val('1');
					jQuery('#number_' + jQuery(this).val()).addClass('hidden');
				});
				jQuery('#list_menu').dialog('close');
			}
		}
	});
	
	jQuery('#list_device').dialog({
		autoOpen: false,
		modal: true,
		title: 'Danh sách máy',
		width: 300,
		resizable: false,
		buttons: {
			'Đồng ý': function () {
				if (jQuery('#payment_id').val()) {
					jQuery.ajax({
						url: 'payment',
						data: 'device_id={$device->get_id()}' +
								'&payment_id=' + jQuery('#payment_id').val() +
								'&new_device_id=' + jQuery('#device_id').val() +
								'&switch=1',
						success: function(result) {
							location = '/detail?id=' + result
						}
					});
				}
				jQuery('#list_device').dialog('close');
			},
			'Huỷ bỏ': function () {
				jQuery('#list_device').dialog('close');
			}
		}
	});
});

function displayNumber(it, id) {
	if (jQuery(it).is(':checked')) {
		jQuery('#number_' + id).removeClass('hidden');
	} else {
		jQuery('#number_' + id).addClass('hidden');
	}
}
</script>

{include file="footer.tpl"}