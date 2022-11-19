<?php

    class TableController extends BaseController
    {

        private $tableModel;

        public function  __construct()
        {
            $this->tableModel = new  Table();
        }



        public  function  actionMain($id = 0){
            $method = $_SERVER['REQUEST_METHOD'];
            switch($method){
                case 'GET':
                    $this->get($id);
                    break;
                case 'POST':
                    $this->post();
                    break;
                case 'PATCH':
                    $this->patch($id);
                    break;
                case 'PUT':
                    $this->put($id);
                    break;
                case 'REMOVE':
                    $this->remove($id);
                    break;
                default:
                    $this->notAllowed();
            }
        }

        private  function get($id){
            if($id === 0){
                $this->answer = $this->tableModel->getAll();
                return $this->success();
            }else{
                $this->answer = $this->tableModel->getTankById($id);
                if (empty($this->answer)){
                    return $this->notFound();
                }else{
                    return $this->success();
                }
            }
        }


        private function post()
        {
            $data = json_decode(file_get_contents('php://input'), true);
            // TODO: сделать проверку, что были переданы title и description
            $this->answer = $this->tableModel->addOne($data);
            if ($this->answer !== 'OK') {
                return $this->badRequest();
            }
            return $this->success();
        }

        private  function patch($id){
            $data = json_decode(file_get_contents('php://input'), true);

            $this->answer = $this->tableModel->updateById($id, $data);

            if ($this->answer !== 'OK') {
                return $this->badRequest();
            }

            return $this->success();
        }

        private  function remove($id){
           // echo $id;
            $this->answer = $this->tableModel->deleteById($id);
            if ($this->answer !== 'OK') {
                return $this->badRequest();
            }

            return $this->success();

        }

    }