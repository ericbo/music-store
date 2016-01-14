<?php
define('WEBSERVER_ROOT', '');

function get_base_url() {
	if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off')
		return 'https://' . $_SERVER['SERVER_NAME'] . '/' . WEBSERVER_ROOT;
	else
		return 'http://' . $_SERVER['SERVER_NAME'] . '/' .WEBSERVER_ROOT;
}

function gen_token() {
	$token = md5(uniqid($your_user_login, true));
  $_SESSION['token'] = $token;
}

function is_ipv4($ip)
{
	return filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4);
}

function is_ipv6($ip)
{
	return filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6);
}