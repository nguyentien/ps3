<table>
<tr>
<td colspan="4">
	<span>Tổng các lần trước</span>
	<input type="text" style="width: 200px">
	<a href="javascript: alert('Chuc nang nay chua hoan thanh!')" style="float: right; margin: 0px">Chi tiết</a>
</td>
</tr>
<tr>
<td>Bắt đầu</td>
<td>
{if $start}
<input type="text" disabled="disabled" value="{$payment->get_start()|date_format:'%H:%M:%S'}">
{else}
<a href="" id="begin">Bắt đầu</a>
{/if}
</td>
<td>Kết thúc</td>
<td>
{if $stop}
<input id="stop" type="text" disabled="disabled" value="{$payment->get_stop()|date_format:'%H:%M:%S'}">
{elseif $start}
<a href="" id="end">Kết thúc</a>
{else}
<input id="stop" type="text" disabled="disabled">
{/if}
</td>
</tr>
<tr>
<td>Tiền giờ</td>
<td><input type="text" disabled="disabled" value="{$device->get_cost()|number_format:0:',':','}"></td>
<td>Phụ thu</td>
<td><input type="text" id="surcharge" {if $payment and $payment->get_surcharge()} value="{$payment->get_surcharge()|number_format:0:",":","}" {/if}></td>
</tr>
<tr>
<td>Tổng tiền</td>
<td><input type="text" disabled="disabled" {if $total} value="{$total|number_format:0:",":","}" {/if}></td>
<td>Giảm giá</td>
<td><input type="text" id="discount" {if $payment and $payment->get_discount()} value="{$payment->get_discount()|number_format:0:",":","}" {/if}></td>
</tr>
<tr>
<td>Phải trả</td>
<td><input type="text" disabled="disabled" {if $total1} value="{$total1|number_format:0:",":","}" {/if}></td>
<td>Ghi chú</td>
<td><input type="text" id="comment" {if $payment} value="{$payment->get_comment()}" {/if}></td>
</tr>
<tr>
<td colspan="4">
	<a href="" id="save_new">Lưu lượt này, Tạo lượt mới</a>
	<a href="javascript: alert('Chuc nang nay chua hoan thanh!')">In phiếu</a>
</td>
</tr>
<tr>
<td colspan="4">
	<a href="" id="switch">Chuyển máy</a>
	<a href="" id="pay_machine">Trả máy</a>
	<a href="" id="cash" style="float: right; margin: 0px">Thu tiền</a>
</td>
</tr>
</table>
<input id="payment_id" type="hidden" {if $payment} value="{$payment->get_id()}" {/if}>
<script type="text/javascript">
jQuery('#begin').click(function() {
	jQuery('#payment').load(
		'payment',
		'device_id={$device->get_id()}&start=1'
	);
	return false;
});

jQuery('#end').click(function() {
	jQuery('#payment').load(
		'payment',
		'device_id={$device->get_id()}&end=1' +
		'&payment_id=' + jQuery('#payment_id').val()
	);
	return false;
});

jQuery('#cash').click(function() {
	if (!jQuery('#payment_id').val()) {
		return false;
	}
	if (!jQuery('#stop').val()) {
		return false;
	}
	jQuery('#payment').load(
		'payment',
		'device_id={$device->get_id()}' +
		'&payment_id=' + jQuery('#payment_id').val() +
		'&cash=1' +
		'&surcharge=' + jQuery('#surcharge').val() +
		'&discount=' + jQuery('#discount').val() +
		'&comment=' + jQuery('#comment').val()
	);
	return false;
});

jQuery('#pay_machine').click(function() {
	if (!jQuery('#payment_id').val()) {
		return false;
	}
	if (jQuery('#stop').val()) {
		jQuery('#payment').load(
			'payment',
			'device_id={$device->get_id()}' +
			'&payment_id=' + jQuery('#payment_id').val() +
			'&pay=1',
			function(response,status,xhr) {
				if (status == 'success') {
					location.reload();
				}
			}
		);
	} else {
		if (confirm('Bạn có chắc làm điều này, hoá đơn này hiện tại chưa tính tiền!')) {
			jQuery('#payment').load(
				'payment',
				'device_id={$device->get_id()}' +
				'&payment_id=' + jQuery('#payment_id').val() +
				'&pay=1',
				function(response,status,xhr) {
					if (status == 'success') {
						location.reload();
					}
				}
			);
		}
	}
	return false;
});

jQuery('#save_new').click(function() {
	if (!jQuery('#payment_id').val()) {
		return false;
	}
	if (jQuery('#stop').val()) {
		jQuery('#payment').load(
			'payment',
			'device_id={$device->get_id()}' +
			'&payment_id=' + jQuery('#payment_id').val() +
			'&saew=1',
			function(response,status,xhr) {
				if (status == 'success') {
					location.reload();
				}
			}
		);
	} else {
		if (confirm('Bạn có chắc làm điều này, hoá đơn này hiện tại chưa tính tiền!')) {
			jQuery('#payment').load(
				'payment',
				'device_id={$device->get_id()}' +
				'&payment_id=' + jQuery('#payment_id').val() +
				'&saew=1',
				function(response,status,xhr) {
					if (status == 'success') {
						location.reload();
					}
				}
			);
		}
	}
	return false;
});

jQuery('#switch').click(function() {
	jQuery('#list_device').dialog('open');
	return false;
});
</script>