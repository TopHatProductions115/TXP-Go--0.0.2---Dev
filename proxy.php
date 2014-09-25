<?php
header('Access-Control-Allow-Origin: *');
 
if (isset($_GET['url']) && preg_match('`^http://`', $_GET['url'])) {
   echo file_get_contents($_GET['url']);
}
?>