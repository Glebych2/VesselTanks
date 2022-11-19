<?php

    class SoundControllerProxy
    {
        private $role;
        private $userModel;
        private $soundsController;

        public function __construct()
        {
            $this->userModel = new User();
            $role = $this->userModel->getUserRole();
            $this->role = $role;
            $this->soundsController = new SoundController();
            $this->soundsController->role = $role;
        }

        public function actionMain($id = 0)
        {
            if ($this->role === 'Admin' || $this->role === 'User' || $this->role === 'Guest') {
               // echo ($this->soundsController->role);
                $this->soundsController->actionMain($id);
           // }elseif($this->role === 'Guest'){
               // $this->soundsController->actionMain(1);
                // TODO: сделать перенаправление на 403 страницу
                //
            }else{
                echo 'У вас нет прав для такого экшена1';
            }
        }
    }
