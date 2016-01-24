<?php
/*WARNING: MUST VALIDATE REQUESTS*/
session_start();

if(isset($_GET['function']) && isset($_GET['id']))
{
	$dir = dirname(__FILE__);
	include_once($dir . "/../functions/database_functions.php");

	switch ($_GET['function']) {
		case 'delete':
			try {
				delete_beat($_GET['id']);
				http_response_code(201);
			} catch(Exception $e) {
				http_response_code(500);
			}
			break;

		case 'undo':
			try {
				restore_beat($_GET['id']);
				http_response_code(201);
			} catch(Exception $e) {
				http_response_code(500);
			}
			break;

		default:
			http_response_code(500);
			break;
	}
}
else
	http_response_code(404);