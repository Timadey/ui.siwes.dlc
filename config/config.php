<?php
/** Edit database connection settings here */
$environmentType = getenv("ITCC_ENV");
if ($environmentType === "dev")
{
    $configFile = "config.dev.json";
}
else
{
    $configFile = "config.prod.json";
}
$document_root =__DIR__;while(true){if (file_exists($document_root."/$configFile")){break;}else{$document_root=dirname($document_root);}}

$settings = json_decode(file_get_contents($document_root."/$configFile"));

global $dbHost; global $dbName; global $dbUser; global $dbPassword;

$dbHost = isset($settings->mysql->host)?$settings->mysql->host:"localhost";

$dbName = $settings->mysql->databases[0];

$dbUser = $settings->mysql->username;

$dbPassword = $settings->mysql->password;

$phpmyadmin_auth_key = isset($settings->mysql->phpmyadmin_auth_key)?$settings->mysql->phpmyadmin_auth_key:"";

$file_manager_auth_key = isset($settings->file_manager_auth_key)?$settings->file_manager_auth_key:"";

$rel_dirname;
if (!isset($portal_type)){
	$rel_dirname =  $settings->rel_dirname;
}else if($portal_type==='admissions'){
	$rel_dirname = $settings->admissions_rel_dirname;
}


?>
