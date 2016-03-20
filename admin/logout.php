<?php
session_start();
session_destroy();

//Includes
$dir = dirname(__FILE__);
include_once($dir . "/../functions/helper_functions.php");

header('Location: '. get_base_url() . 'admin/index.php');