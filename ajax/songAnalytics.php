<?php
$dir = dirname(__FILE__);
include_once($dir . "/../functions/database_functions.php");
include_once($dir . "/../functions/helper_functions.php");

$baseUrl = get_base_url();

if(@isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER']=="{$baseUrl}ajax/songAnalytics.php")
{
  if($_POST['token'] == $_SESSION['token'] && isset($_POST['beatID']) && is_int($_POST['beatID'])) {
    $browser = get_browser(null, true);

    //Get browser information.
    if($browser['browser'] != "unknown")
      $name = $browser['browser'];
    else
      $name = null;

    if($browser['version'] != "unknown")
      $version = $browser['version'];
    else
      $version = null;

    if($browser['platform'] != "unknown")
      $os = $browser['platform'];
    else
      $os = null;

    //Store IP, IP version and lookup (if possible).
    $ip['address'] = get_ip();
    if($ip['address'] != null)
    {
      $ip['ipv4'] = is_ipv4($ip['address']);
      $lookup = gethostbyaddr($ip['address']);

      if($lookup)
        $ip['lookup'] = $lookup;
    }
    try {
      add_song_analytic($_POST['beatID'], $name, $version, $os, $ip);
    }
    catch (Exception $e)
    {
      echo "error!";
    }

  }
}