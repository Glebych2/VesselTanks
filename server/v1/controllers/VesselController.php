<?php

    class VesselController extends BaseController
    {

        public $title;
        private $vesselModel;
        public $role;


        public function  __construct()
        {
            $this->vesselModel = new  Vessel();
            $this->title = 'Vessel';
        }

        public  function  actionMain($id = 0, $imgTrig = -1){
            $method = $_SERVER['REQUEST_METHOD'];
            switch($method){
                case 'GET':
                    $this->get($id, $imgTrig);
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

//        public  function  actionSecond($id = 0, $imgTrig = -1){
//            $method = $_SERVER['REQUEST_METHOD'];
//            switch($method){
//                case 'GET':
//                    $this->get($id, $imgTrig);
//                    break;
//                case 'POST':
//                    $this->post();
//                    break;
//                case 'PATCH':
//                    $this->patch($id);
//                    break;
//                case 'PUT':
//                    $this->put($id);
//                    break;
//                case 'REMOVE':
//                    $this->remove($id);
//                    break;
//                default:
//                    $this->notAllowed();
//            }
//        }

        private  function get($id, $imgTrig){
            if($id === 0){
                $this->answer = $this->vesselModel->getAll();
                return $this->success();
            }elseif ($id === -1){
                $this->answer = $this->vesselModel->getAllVessel();
                return $this->success();
            }else if($imgTrig === -1){
               // echo ('$id = ' . $id . ', $imgTrig = '. $imgTrig);
                $this->answer = $this->vesselModel->getById($id);
                if (empty($this->answer)){
                   // echo ('$id = ' . $id . ', $imgTrig = '. $imgTrig);
                    return $this->notFound();
                }else{
                   // die ('GOOOD!!!');
                    return $this->success();
                }
            }else{
                $this->answer = $this->vesselModel->getImg($id, $imgTrig);
                if (empty($this->answer)){
                    return $this->notFound();
                }else{
                    return $this->success();
                }
            }
        }


        private function post()
        {
            if(isset($_POST['vessel'])){
                $data['vessel'] = htmlentities($_POST['vessel']);
                $data['imo'] = htmlentities($_POST['imo']);
                $data['call'] = htmlentities($_POST['call']);
                $data['officialNumber'] = htmlentities($_POST['officialNumber']);
                $data['port'] = htmlentities($_POST['port']);
                $data['flag'] = htmlentities($_POST['flag']);
                $data['user'] = htmlentities($_COOKIE['user']);

                $pathScan = 'assets/upload/images/'.$data['imo'];
                $data['path'] = $pathScan;
                //==Создаем новую директорию, если еще не существует, название которой ИМО номер========================================
                if (!file_exists($pathScan)){
                    mkdir($pathScan, 0777);
                   // die('No Exist!!!');
                }
                $data['imgName'] = $_FILES['image']["name"];
                if (!file_exists($_FILES['image']["name"])){
                    move_uploaded_file($_FILES['image']["tmp_name"], $pathScan.'/'.$_FILES['image']["name"]);
                    //  var_dump($_FILES);
                    // die('No Exist!!!');
                }

            }
//            $get = file_get_contents('php://input')
//            $data = json_decode($get);
//            var_dump($get);
//            echo '<pre>';
//           print_r($data);
//            echo '</pre>';
           // die();
//          //  $name = $data['user'];

            // TODO: сделать проверку, что были переданы title и description
            $this->answer = $this->vesselModel->addOne($data);
            if ($this->answer !== 'OK') {
                if ($this->answer === 'Exists'){
                    return $this->exists();
                }
                return $this->badRequest();
            }
            return $this->configured();
        }



        private  function patch($id){
            $data = json_decode(file_get_contents('php://input'), true);

            $this->answer = $this->vesselModel->updateById($id, $data);

            if ($this->answer !== 'OK') {
                return $this->badRequest();
            }

            return $this->success();
        }

        private  function remove($id){
            $this->answer = $this->vesselModel->deleteById($id);
            if ($this->answer !== 'OK') {
                return $this->badRequest();
            }

            return $this->success();

        }

    }