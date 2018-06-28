<?php
// config.php
$http_host = getenv('HTTP_HOST');
switch($http_host){
  case('dev.motorrepublic.com') :
    define("MR_DB_USERNAME", 'teamplayer');
    define("MR_DB_PASSWORD", 'Mx664#nn0~');
    define("MR_DB_SERVER", "localhost");
    define("MR_DB_DATABASE", "vehicles");
    define("MR_PATH", "/var/www/vhosts/motorrepublic.com/dev.motorrepublic.com");
    break;

  default :
    define("MR_DB_USERNAME", 'teamplayer');
    define("MR_DB_PASSWORD", 'Mx664#nn0~');
    define("MR_DB_SERVER", "localhost");
    define("MR_DB_DATABASE", "vehicles");
    define("MR_PATH", "/var/www/vhosts/motorrepublic.com/dev.motorrepublic.com");
    break;
}