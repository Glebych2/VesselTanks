<?php

    class MessageControllerProxy
    {
        private $role;
        private $userModel;
        private $messageController;

        public function __construct()
        {
            $this->userModel = new User();
            $role = $this->userModel->getUserRole();
            $this->role = $role;
            $this->messageController = new MessageController();
            $this->messageController->role = $role;
        }

        public function actionMessage($id = 0)
        {
            if ($this->role === 'Admin' || $this->role === 'User') {
              //  echo ($this->messageController->role);
                $this->messageController->actionMessage($id);
            }else{
                // TODO: сделать перенаправление на 403 страницу
                 echo 'У вас нет прав для такого экшена1';
            }
        }
    }
