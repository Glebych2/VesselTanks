<?php
   //  echo '<h1> Hello world! 1 </h1>';
    include_once('./components/autoload.php'); //==подгружаем нужные файлы
    include_once('./config/constants.php');  //==подгружаем константы с путями

    $router = new Router();
    $router->run();