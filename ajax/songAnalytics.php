<?php
$dir = dirname(__FILE__);
include_once($dir . "/../functions/database_functions.php");
include_once($dir . "/../functions/helper_functions.php");

$baseUrl = get_base_url();

if(@isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER']=="{$baseUrl}ajax/songAnalytics.php")
{
 //HTTP_REFERER verification
  if($_POST['token'] == $_SESSION['token']) {
    $browser = get_browser(null, true);

    $name = $browser['browser'];
    $version = $browser['version'];
    $os = $browser['platform'];
  }
}