<?php
    //load config
    require_once "config/config.php";
    require_once "config/functions.php";
    require_once "models/Auth.php";
//load libraries
     require_once "lib/Database.php";
    require_once "lib/Controller.php";
    require_once "lib/Core.php";
    require_once "lib/Model.php";
    require_once "lib/Mail.php";
// Autoload Core Libraries
        require_once "models/User.php";
$init = new Core;
?>