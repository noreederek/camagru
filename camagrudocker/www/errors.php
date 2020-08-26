<?php
session_start();

function error_register()
{
	if ($_SESSION['register-username'] == "FAIL")
	echo "<h5 style='color: #e54c4c'> Please enter an username</h5>";
	else if ($_SESSION['flag-user-exists'] == "FAIL")
	echo "<h5 style='color: #e54c4c'>This username already exists</h5>";
	if ($_SESSION['register-mail'] == "FAIL")
	echo "<h5 style='color: #e54c4c'>Please enter an email address</h5>";
	else if ($_SESSION['flag-regex-mail'] == "FAIL")
	echo "<h5 style='color: #e54c4c'>Please enter a valid email address</h5>";
	else if ($_SESSION['flag-mail-exists'] == "FAIL")
	echo "<h5 style='color: #e54c4c'>This email address is already in use</h5>";
	if ($_SESSION['register-password1'] == "FAIL")
	echo "<h5 style='color: #e54c4c'>Please enter a password</h5>";
	else if ($_SESSION['flag-regex-password'] == "FAIL")
	echo "<h5 style='color: #e54c4c'>Your password must contain at least 6 characters and include at least 1 number</h5>";
	if ($_SESSION['register-password2'] == "FAIL")
	echo "<h5 style='color: #e54c4c'>Please reenter your password</h5>";
	if ($_SESSION['same-password'] == "FAIL")
	echo "<h5 style='color: #e54c4c'>Please reenter the same password</h5>";
	if ($_SESSION['flag-register'] == "SUCCESS"){
		echo "<h5 style='color: #75ce75'>Your registration complete</h5>";
		echo "<h5 style='color: #75ce75'>You will receive a confirmation email in a few moments.</h5>";
	}
}

function delete_error_register()
{
	$_SESSION['register-username'] = NULL;
	$_SESSION['flag-user-exists'] = NULL;
	$_SESSION['register-mail'] = NULL;
	$_SESSION['flag-regex-mail'] = NULL;
	$_SESSION['flag-mail-exists'] = NULL;
	$_SESSION['register-password1'] = NULL;
	$_SESSION['flag-regex-password'] = NULL;
	$_SESSION['register-password2'] = NULL;
	$_SESSION['same-password'] = NULL;
	$_SESSION['flag-register'] = NULL;
}

function	error_signin()
{
	if ($_SESSION['signin-mail'] == "FAIL")
	echo "<h5 style='color: #e54c4c'>Please enter an email address</h5>";
	else if ($_SESSION['signin-mail-exists'] == "FAIL")
	echo "<h5 style='color: #e54c4c'>Unknown email address</h5>";
	if ($_SESSION['signin-password'] == "FAIL")
	echo "<h5 style='color: #e54c4c'>Please enter a password</h5>";
	if ($_SESSION['signin-good-password'] == "FAIL")
	echo "<h5 style='color: #e54c4c'>Wrong password</h5>";
	if ($_SESSION['account-active'] == "FAIL")
	echo "<h5 style='color: #e54c4c'>Your account is not activated! Check your e-mail</h5>";
}

function delete_error_signin()
{
	$_SESSION['signin-mail'] = NULL;
	$_SESSION['signin-mail-exists'] = NULL;
	$_SESSION['signin-password'] = NULL;
	$_SESSION['signin-good-password'] = NULL;
	$_SESSION['account-active'] = NULL;
}

function	error_reset_password()
{
	if ($_SESSION['flag-reset-password-mail-exists'] == "FAIL")
	echo "<h5 style='color: #e54c4c'>Unknown email address</h5>";
	if ($_SESSION['mail-reinit-password'] == "SUCCESS"){
		echo "<h5 style='color: #75ce75'>Your request has been taken into account.</h5>";
		echo "<h5 style='color: #75ce75'>You will receive a reset email in a few moments.</h5>";
	}
	if ($_SESSION['flag-mail-exists-reset-my-password'] == "FAIL")
	echo "<h5 style='color: #e54c4c'>Unknown email address</h5>";
	if ($_SESSION['reset-password1'] == "FAIL")
	echo "<h5 style='color: #e54c4c'>Please enter a password</h5>";
	else if ($_SESSION['reset-flag-regex-password'] == "FAIL")
	echo "<h5 style='color: #e54c4c'>Your password must contain at least 6 characters and include at least 1 number</h5>";
	if ($_SESSION['reset-password2'] == "FAIL")
	echo "<h5 style='color: #e54c4c'>Please copy your password</h5>";
	else if ($_SESSION['reset-same-password'] == "FAIL")
	echo "<h5 style='color: #e54c4c'>Please copy your password the same</h5>";
	if ($_SESSION['reset-good-token'] == "FAIL")
	echo "<h5 style='color: #e54c4c'>Reset link is wrong (Token Error)</h5>";
	if ($_SESSION['reinit-password-in-db'] == "SUCCESS"){
		echo "<h5 style='color: #75ce75'>Your password has been reset.</h5>";
		echo "<h5 style='color: #75ce75'>You will be redirected to home in 5 seconds.</h5>";
	}
}

function	delete_error_reset_password()
{
	$_SESSION['flag-reset-password-mail-exists'] = NULL;
	$_SESSION['mail-reinit-password'] = NULL;
	$_SESSION['flag-mail-exists-reset-my-password'] = NULL;
	$_SESSION['reset-password1'] = NULL;
	$_SESSION['reset-flag-regex-password'] = NULL;
	$_SESSION['reset-password2'] = NULL;
	$_SESSION['reset-same-password'] = NULL;
	$_SESSION['reset-good-token'] = NULL;
	$_SESSION['reinit-password-in-db'] = NULL;
}

function	error_post_comment()
{
	if ($_SESSION['comment-send'] == "FAIL")
		echo "<h5 style='color: #e54c4c'>Error in sending comment!</h5>";
	else if ($_SESSION['comment-send'] == "SUCCESS"){
		echo "<h5 style='color: #75ce75'>Your comment has been sent!</h5>";
		if ($_SESSION['login'] != $_SESSION['login-target'] && $_SESSION['login-target-commentflag'] == 'send')
		{
			echo "<h5 style='color: #75ce75'>".$_SESSION['login-target']." will be informed by email</h5>";
		}
		else {
			echo "</br>";
		}
	}
	$_SESSION['comment-send'] = NULL;
}



function	error_change_password()
{
	if ($_SESSION['change-pass-old_pass'] == "FAIL")
		echo "<h5 style='color: #e54c4c'>Please enter your old password</h5>";
	else if ($_SESSION['flag-old-pass'] == "FAIL")
		echo "<h5 style='color: #e54c4c'>Password does not match</h5>";
	if ($_SESSION['change-pass-pass1'] == "FAIL")
		echo "<h5 style='color: #e54c4c'>You must enter your new password</h5>";
	else if ($_SESSION['flag-regex-password'] == "FAIL")
		echo "<h5 style='color: #e54c4c'>Your password must contain at least 6 characters and including a number</h5>";
	if ($_SESSION['change-pass-pass2'] == "FAIL")
		echo "<h5 style='color: #e54c4c'>Please reenter your new password</h5>";
	else if ($_SESSION['same-password'] == "FAIL")
		echo "<h5 style='color: #e54c4c'>Please copy the password the same</h5>";
	if ($_SESSION['flag-password-changed'] == "SUCCESS"){
		echo "<h5 style='color: #75ce75'>Your password has been changed!</h5>";
		echo "<h5 style='color: #75ce75'>You will be redirected to your personal space in 5 seconds.</h5>";
	}
}

function delete_error_change_password()
{
	$_SESSION['change-pass-old_pass'] = NULL;
	$_SESSION['change-pass-pass1'] = NULL;
	$_SESSION['change-pass-pass2'] = NULL;
	$_SESSION['flag-regex-password'] = NULL;
	$_SESSION['same-password'] = NULL;
	$_SESSION['flag-old-pass'] = NULL;
	$_SESSION['flag-password-changed'] = NULL;
}

function	send_image_error()
{
	if ($_SESSION['send-image-error'] == "FAIL")
	{
		echo "<h5 style='color: #e54c4c'>Error transferring file</h5>";
		$_SESSION['send-image-error'] = NULL;
	}
	if ($_SESSION['send-image-size'] == "FAIL")
	{
		echo "<h5 style='color: #e54c4c'>File is too large</h5>";
		$_SESSION['send-image-size'] = NULL;
	}
	if ($_SESSION['send-image-extension'] == "FAIL")
	{
		echo "<h5 style='color: #e54c4c'>Invalid Extension</h5>";
		$_SESSION['send-image-extension'] = NULL;
	}
	if ($_SESSION['send-image-dimensions'] == "FAIL")
	{
		echo "<h5 style='color: #e54c4c'>Invalid Dimensions</h5>";
		$_SESSION['send-image-dimensions'] = NULL;
	}
}
?>
