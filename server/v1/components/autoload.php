<?php

//spl_autoload_register — Регистрирует заданную функцию в качестве реализации метода __autoload()
 //echo '<h1> Hello world! 2</h1>';
    spl_autoload_register(function ($class)
    {

        $dirs = ['controllers', 'models', 'components'];

        foreach ($dirs as $dir) {
            $fullClassPath = "$dir/$class.php";
            if (file_exists($fullClassPath)) {
              //  echo $fullClassPath; //components/Router.php
                                        //controllers/VesselControllerProxy.php
                                        //  models/User.php
                                        //controllers/VesselController.php
                                        // controllers/BaseController.php
                                        //models/Vessel.php
                                        //components/DB.php
                include_once($fullClassPath);
            }
        }
    });