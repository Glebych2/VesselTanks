<?php

    class TankControllerProxy
    {

        private $role;
        private $user;
        private $userModel;
        private $tanksController;

        public function  __construct()
        {
            $this->userModel = new User();
            $role = $this->userModel->getUserRole();
            $this->role = $role;
            $this->tanksController = new TankController();
            $this->tanksController->role = $role;
        }

        public function actionMain($id = 0, $vslId = 0, $lvl = -1, $ulg = -1, $vlm = -1, $trim1 = 0, $trim2 = 0, $tblName = '')
        {
            if ($this->role === 'Admin' || $this->role === 'User') {
               // echo ($this->tanksController->role);
                $this->tanksController->actionMain($id, $vslId, $lvl, $ulg, $vlm, $trim1, $trim2, $tblName);
            } else {
                $this->tanksController->actionMain($id, 1, $lvl, $ulg, $vlm, $trim1, $trim2, $tblName);
               // echo ($this->tanksController->role);
               // $this->tanksController->actionMain(1, $lvl, $ulg, $vlm, $trim1, $trim2, $tblName);
                // TODO: сделать перенаправление на 403 страницу
                //header('Location: http://localhost/vsltanks/client/test.php');

                //include_once('C:\xampp\htdocs\vsltanks\client\test.php');
               // return;

               // echo 'У вас нет прав для такого экшена2';
                return;


            }
        }
    }
