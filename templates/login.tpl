<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="SHORTCUT ICON" href="images/favicon.ico"/>
<link href="style/login.css" type="text/css" rel="stylesheet">
<link href="style/jquery-ui-1.8.22.custom.min.css" type="text/css" rel="stylesheet">
<title>PS3</title>
</head>
<body>
<div id="login">
<form method="post" action="login" name="form_login">
<label>Người dùng</label>
<input type="text" name="user" id="user">
<br>
<label>Mật khẩu</label>
<input type="password" name="pass">
<button id="button_login">Đăng nhập</button>
</form>
</div>
</body>
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.22.custom.min.js"></script>
<script type="text/javascript">
jQuery(document).ready(function() {
	jQuery('#button_login').button().click(function() {
		if (jQuery('#user').val() == '') {
			return false;
		}
		jQuery('#form_login').submit();
	});
	
	jQuery('#login').dialog({
		modal: true,
		title: 'Đăng nhập',
		resizable: false
	});
});
</script>
</html>