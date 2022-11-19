<?php
//echo __FILE__;
// echo '<h1> Hello world! 5</h1>';

    $routes = array(

       'TankControllerProxy'=> array(
           'tank' => 'main',
           'tank/([0-9]+)' => 'main/$1',
           'sounding/([0-9]+)' => 'main/$1',
           'sounding' => 'main'

       ),

        'VesselControllerProxy'=> array(
            'vessel/([0-9]+)' => 'main/$1',
            'vessel' => 'main',
        ),

       // 'AuthController' => array(
           // 'reg' => 'register',
        //    'auth' => 'authorize'
       // ),

        'UserController' => array(
            'reg' => 'register',
            'auth' => 'authorize',
            'logout' => 'logout',
            'users' => 'admin',
            'user/([0-9]+)' => 'user/$1',
            'user/update/([0-9]+)' => 'update/$1',
            'userVessel/([0-9]+)' => 'uservessel/$1',
            'userVessel/delete/([0-9]+)' => 'delete/$1',
            'userVessel/update/([0-9]+)' => 'vesselupdate/$1',

        ),

        'SoundControllerProxy'=> array(
            'sound/([0-9]+)' => 'main/$1',
            'sound' => 'main',
        ),

        'DtsoundController'=> array(
            'date/([0-9]+)' => 'main/$1',
            'date' => 'main',
        ),

        'VconfigController'=> array(
            'config/([0-9]+)' => 'config/$1',
            'config' => 'config',
        ),

        'MessageControllerProxy'=> array(
            'message/([0-9]+)' => 'message/$1',
            'message' => 'message',
        ),

//        'VesselControllerProxy'=> array(
//            '' => 'main',
//        ),
    );
