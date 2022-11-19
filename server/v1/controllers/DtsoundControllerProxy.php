<?php

class DtsoundControllerProxy
{
    private $role;
    private $userModel;
    private $vesselsController;

    public function __construct()
    {
        $this->userModel = new User();
        $role = $this->userModel->getUserRole();
        $this->role = $role;
        $this->dtsoundsController = new DtsoundController();
        $this->dtsoundsController->role = $role;
    }

    public function actionMain($id = 0, $vslId = 0)
    {
        if ($this->role === 'Admin') {
        // echo ($this->vesselsController->role);
            $this->dtsoundsController->actionMain(0, $vslId);
        } elseif($this->role === 'User') {
            $this->dtsoundsController->actionMain($id, $vslId);
        }elseif($this->role === 'Guest') {
            // echo ($this->vesselsController->title);
            $this->dtsoundsController->actionMain(1, 1);
        }else{
         // TODO: сделать перенаправление на 403 страницу
             echo 'У вас нет прав для такого экшена';
         }
    }

}