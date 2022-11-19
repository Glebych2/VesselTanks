<?php

    class VesselControllerProxy
    {
        private $role;
        private $userModel;
        private $vesselsController;

        public function __construct()
        {
            $this->userModel = new User();
            $role = $this->userModel->getUserRole();
            $this->role = $role;
            $this->vesselsController = new VesselController();
            $this->vesselsController->role = $role;
        }

        public function actionMain($id = 0, $imgTrig = -1)
        {
            //echo ('$id = ' . $id . ', $imgTrig = '. $imgTrig);
           // echo($this->role);
            if ($this->role === 'Admin') {
                if ($id == -1){
                    $this->vesselsController->actionMain(-1, $imgTrig); //==Для запросов с Admin страницы=============
                }else{
                    $this->vesselsController->actionMain(0, $imgTrig); //==Хотя id пользователя не 0, мы его обнуляем. Admin получает все суда с картинками
//                    $this->vesselsController->actionMain($id, $imgTrig);
                }
            }elseif($this->role === 'User' || $this->role === 'Admin'){
               // echo ('$id = ' . $id . ', $imgTrig = '. $imgTrig);
               // echo ($this->vesselsController->role);
                $this->vesselsController->actionMain($id, $imgTrig);
            }else{
                //echo ($this->vesselsController->role);
                $this->vesselsController->actionMain(1, 1);
                // TODO: сделать перенаправление на 403 страницу
                // echo 'У вас нет прав для такого экшена VesselControllerProxy';
            }
        }

//        public function actionSecond($id, $imgTrig = -1)
//        {
//            if ($this->role === 'Admin') {
//                // echo ($this->vesselsController->role);
//                $this->vesselsController->actionSecond(0, $imgTrig);
//            } elseif($this->role === 'User') {
//                $this->vesselsController->actionSecond($id, $imgTrig);
//            }else{
//                // echo ($this->vesselsController->title);
//                $this->vesselsController->actionSecond(1, 1);
//                // TODO: сделать перенаправление на 403 страницу
//                // echo 'У вас нет прав для такого экшена';
//            }
//        }
    }
