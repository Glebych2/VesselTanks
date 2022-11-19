<?php

    class VconfigController extends BaseController
    {

        private $vconfigModel;

        public function  __construct()
        {
            $this->vconfigModel = new  Vconfig();
          //  $this->authModel = new Auth();
        }



        public  function  actionConfig($id = 0){
            $method = $_SERVER['REQUEST_METHOD'];
//            if (!isset($_GET['token'])) {
//                return $this->notAuthorized();
//            }
//            $token = $_GET['token'];
//            if (!$this->authModel->checkToken($token)) {
//                return $this->notAuthorized();
//            }
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
                $this->answer = $this->vconfiModel->getAll();
                return $this->success();
            }else {
                $this->answer = $this->vconfiModel->getById($id);
                if (empty($this->answer)) {
                    return $this->notFound();
                } else {
                    return $this->success();
                }
            }
        }


        private function post()
        {
            $data = json_decode(file_get_contents('php://input'), true);
            print_r($data) ;
            // TODO: сделать проверку, что были переданы title и description
            $this->answer = $this->vconfiModel->addOne($data);
            if ($this->answer !== 'OK') {
                return $this->badRequest();
            }
            return $this->success();
        }

        private  function patch($id){
            $data = json_decode(file_get_contents('php://input'), true);

            $this->answer = $this->vconfiModel->updateById($id, $data);

            if ($this->answer !== 'OK') {
                return $this->badRequest();
            }

            return $this->success();
        }

        private  function remove($id){
            $this->answer = $this->vconfiModel->deleteById($id);
            if ($this->answer !== 'OK') {
                return $this->badRequest();
            }

            return $this->success();

        }

    }