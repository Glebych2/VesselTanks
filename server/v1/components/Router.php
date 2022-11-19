<?php

    class Router
    {

        private $routes;

        public function __construct()
        {
            include_once('./config/routes.php');
            $this->routes = $routes;
        }

        public function run()
        {
           //  echo '<h1> Hello world! 4</h1>';
            $requestedUrl = $_SERVER['REQUEST_URI']; //[REQUEST_URI] => /vsltanks/server/api/v1/vessel/0

 //           if ($_SERVER['REQUEST_URI'] === 'http://localhost/vsltanks/client/main.php'){
 //               $_SERVER['HTTP_REFERER'] = 'http://localhost/vsltanks/client/main.php';
//                echo '<pre>';
//                print_r($_SERVER);
//                echo '</pre>';
//                die('<h1> Hello world! 4</h1>');
 //           }

//             echo '<pre>';
//             print_r($_SERVER['HTTP_REFERER']);
//             echo '</pre>';
//            echo '<pre>';
//            print_r($this->routes) ;
//            echo '</pre>';

            foreach ($this->routes as $controller => $availableRoutes) {
               // print_r($controller); //TankControllerProxy VesselControllerProxy
                foreach ($availableRoutes as $availableRoute => $actionWithParameters) {
                    $fullAvailableRoute = SITE_ROOT . $availableRoute;
                   // echo $fullAvailableRoute; // /vsltanks/server/api/v1/tank  /vsltanks/server/api/v1/tank/([0-9]+)  /vsltanks/server/api/v1/sounding/([0-9]+)  /vsltanks/server/api/v1/sounding  /vsltanks/server/api/v1/vessel/([0-9]+)
                    if (preg_match("~^$fullAvailableRoute~", $requestedUrl)) {
                        //echo ('=='.$requestedUrl.'=='); //==/vsltanks/server/api/v1/vessel/1/1==  ==/vsltanks/server/api/v1/vessel/0==
                        $actionWithParameters = preg_replace("~$fullAvailableRoute~",
                            $actionWithParameters, $requestedUrl);
                       // echo $actionWithParameters; // Запрос с клиента - request.open('GET', `${serverUrl}/vessel/${id}/${imgTrig}`, $actionWithParameters = main/1/1
                        $actionWithParametersSegments = explode('/', $actionWithParameters);
                       // print_r($actionWithParametersSegments); // Array( [0] => main   [1] => 1   [2] => 1 )
                        $action = array_shift($actionWithParametersSegments);
                        $requestedController = new $controller();
                       // echo '<pre>';
                       // print_r($requestedController); //VesselControllerProxy
                       // echo '</pre>';
                        $requestedAction = 'action' . ucfirst($action);
                        //echo '==='.ucfirst($action); // ===Main

//                        echo '<pre>';
//                        print_r(array($requestedController, $requestedAction));
//                        echo '</pre>';
//                        Array
//                        (
//                            [0] => VesselControllerProxy Object
//                                (
//                                    [role:VesselControllerProxy:private] => Guest
//                                    [userModel:VesselControllerProxy:private] => User Object()
//                                    [vesselsController:VesselControllerProxy:private] => VesselController Object
//                                        (
//                                            [title] => Vessel
//                                            [vesselModel:VesselController:private] => Vessel Object()
//                                            [role] => Guest
//                                            [answer:protected] =>
//                                        )
//                                )
//                            [1] => actionMain
//                        )


                        call_user_func_array(array($requestedController, $requestedAction), $actionWithParametersSegments);
                        break 2;
                    }
                }
            }
            // TODO: сделать обработчик ошибок - т.е. вывести 404
            // if ($requestedUrl === )
        }
    }