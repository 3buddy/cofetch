<?php
$url = "http://localhost/cofetch/";
$auth_key = "123";
?>
<!---------signup-------------->
Sign up
<form action = "<?php echo $url;?>UserServices/index" method="POST" style="border-bottom: 2px solid #333; margin-bottom: 20px; padding-bottom: 20px;"enctype="multipart/form-data">
email<input type="text" name="email"/>
name<input type="text" name="name"/>
password<input type="password" name="password"/>
profile image<input type="file" name="profile_image"/><br><br>
school id<input type="text" name="school_id"/>
device id<input type="text" name="device_id"/>
device Token<input type="text" name="device_token"/>
<input name="method" type="hidden" value="signup" />
	<input name="auth_key" type="hidden" value="<?php echo $auth_key; ?>" />
<input type="submit" name="signup" value="signup"/>
</form>

<!-----------signin------------->
signin
<form action = "<?php echo $url;?>UserServices/index" method="POST" style="border-bottom: 2px solid #333; margin-bottom: 20px; padding-bottom: 20px;"enctype="multipart/form-data">
email<input type="text" name="email"/>
password<input type="password" name="password"/>
device id<input type="text" name="device_id"/>
device Token<input type="text" name="device_token"/>
<input name="method" type="hidden" value="signin" />
	<input name="auth_key" type="hidden" value="<?php echo $auth_key; ?>" />
<input type="submit" name="signin" value="signin"/>
</form>

<!----------forgot password---------->
Forgot Password 
<form action = "<?php echo $url;?>UserServices/index" method="POST" style="border-bottom: 2px solid #333; margin-bottom: 20px; padding-bottom: 20px;">
	Email Id <input name="email" type="text" />
    <input name="method" type="hidden" value="forgot_password" />
	<input name="auth_key" type="hidden" value="<?php echo $auth_key; ?>" />
	<input type="submit" value="forgot_password">
</form>

<!-------------update device------->
update device  
<form action = "<?php echo $url;?>UserServices/index" method="POST" style="border-bottom: 2px solid #333; margin-bottom: 20px; padding-bottom: 20px;">
       id  <input name="id" type="text" />
  device id <input name="device_id" type="text" />
   device token<input name="device_token" type="text" />
   
    <input name="method" type="hidden" value="update_device" />
	<input name="auth_key" type="hidden" value="<?php echo $auth_key; ?>" />
	<input type="submit" value="update">
</form>

<!--------- get school list--------->
Get school list 
<form action = "<?php echo $url;?>UserServices/index" method="POST" style="border-bottom: 2px solid #333; margin-bottom: 20px; padding-bottom: 20px;">
     
    <input name="method" type="hidden" value="school_list" />
	<input name="auth_key" type="hidden" value="<?php echo $auth_key; ?>" />
	<input type="submit" value="get school list">
</form>
