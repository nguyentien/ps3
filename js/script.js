/**
 * 
 * @param id
 */
function loadContent(id) {
	switch (id) {
		case 0:
			jQuery('#sys_range').addClass('selected');
			jQuery('#sys_device').removeClass('selected');
			jQuery('#sys_menu').removeClass('selected');
			jQuery('#sys_report').removeClass('selected');
			jQuery('#sys_diff').removeClass('selected');
			jQuery.ajax ({
				url: 'range',
				success: function (result) {
					jQuery('#content').html(result);
				}
			});
			break;
		case 1:
			jQuery('#sys_range').removeClass('selected');
			jQuery('#sys_device').addClass('selected');
			jQuery('#sys_menu').removeClass('selected');
			jQuery('#sys_report').removeClass('selected');
			jQuery('#sys_diff').removeClass('selected');
			jQuery.ajax ({
				url: 'device',
				success: function (result) {
					jQuery('#content').html(result);
				}
			});
			break;	
		case 2:
			jQuery('#sys_range').removeClass('selected');
			jQuery('#sys_device').removeClass('selected');
			jQuery('#sys_menu').addClass('selected');
			jQuery('#sys_report').removeClass('selected');
			jQuery('#sys_diff').removeClass('selected');
			jQuery.ajax ({
				url: 'menu',
				success: function (result) {
					jQuery('#content').html(result);
				}
			});
			break;
		case 3:
			jQuery('#sys_range').removeClass('selected');
			jQuery('#sys_device').removeClass('selected');
			jQuery('#sys_menu').removeClass('selected');
			jQuery('#sys_report').addClass('selected');
			jQuery('#sys_diff').removeClass('selected');
			jQuery.ajax ({
				url: 'report',
				success: function (result) {
					jQuery('#content').html(result);
				}
			});
			break;
		case 4:
			jQuery('#sys_range').removeClass('selected');
			jQuery('#sys_device').removeClass('selected');
			jQuery('#sys_menu').removeClass('selected');
			jQuery('#sys_report').removeClass('selected');
			jQuery('#sys_diff').addClass('selected');
			jQuery.ajax ({
				url: 'difference',
				success: function (result) {
					jQuery('#content').html(result);
				}
			});
			break;
	}
}