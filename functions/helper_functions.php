<?php
define('WEBSERVER_ROOT', 'store/');

function get_base_url() {
	if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off')
		return 'https://' . $_SERVER['SERVER_NAME'] . '/' . WEBSERVER_ROOT;
	else
		return 'http://' . $_SERVER['SERVER_NAME'] . '/' .WEBSERVER_ROOT;
}