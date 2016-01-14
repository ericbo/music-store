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

function get_ip() {

  $client  = @$_SERVER['HTTP_CLIENT_IP'];
  $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
  $remote  = $_SERVER['REMOTE_ADDR'];

  if(filter_var($client, FILTER_VALIDATE_IP))
    $ip = $client;
  elseif(filter_var($forward, FILTER_VALIDATE_IP))
    $ip = $forward;
  elseif(filter_var($remote, FILTER_VALIDATE_IP))
    $ip = $remote;
  else
  	$ip = null;

  return $ip;
}

function is_ipv4($ip)
{
	if(filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4))
		return true;
	return false;
}

function is_ipv6($ip)
{
	return filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6);
}