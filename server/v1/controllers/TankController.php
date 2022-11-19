<?php

    class TankController extends BaseController
    {

        private $title;
        private $tankModel;
        public $role;

        public function  __construct()
        {
            $this->tankModel = new  Tank();
            $this->title = 'Tanks';
        }



        public  function  actionMain($id = 0, $vslId = -1, $lvl = -1, $ulg = -1, $vlm = -1, $trim1 = 0, $trim2 = 0, $tblName = ''){
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
                    $this->get($id, $vslId, $lvl, $ulg, $vlm, $trim1, $trim2, $tblName);
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



        private  function get($id, $vslId, $lvl, $ulg, $vlm, $trim1, $trim2, $tblName){
            if (!isset($trim1)){
                $trim1 = 1;
            }
            if (!isset($trim2)){
                $trim2 = 1;
            }
            if($id === 0){
                $this->answer = $this->tankModel->getAll();
                return $this->success();
            }else if($lvl < 0 && $ulg < 0 && $vlm < 0 && $vslId >= 0){
                $this->answer = $this->tankModel->getById($id);
                if (empty($this->answer)){
                    return $this->notFound();
                }else{
                    return $this->success();
                }
            } else if($lvl < 0 && $ulg < 0 && $vlm < 0 && $vslId < 0){
               // echo ('id = '.$id.' ; vslId = '.$vslId);
                $this->answer = $this->tankModel->getByTankId($id);
                if (empty($this->answer)){
                    return $this->notFound();
                }else{
                    return $this->success();
                }
            }else if($lvl >= 0 && $ulg < 0 && $vlm < 0){
                $this->answer = $this->tankModel->getByLvl($id, $vslId, $lvl, $ulg, $vlm, $trim1, $trim2, $tblName);
                if (empty($this->answer)){
                    return $this->notFound();
                }else{
                    return $this->success();
                }
            } else if($ulg >= 0 && $lvl < 0 && $vlm < 0){
                $this->answer = $this->tankModel->getByUllage($id, $vslId, $lvl, $ulg, $vlm, $trim1, $trim2, $tblName);
                if (empty($this->answer)){
                    return $this->notFound();
                }else{
                    return $this->success();
                }
            }else {
                $this->answer = $this->tankModel->getByVol($id, $vslId, $lvl, $ulg, $vlm, $trim1, $trim2, $tblName);
                if (empty($this->answer)) {
                    return $this->notFound();
                } else {
                    return $this->success();
                }
            }
        }


        private function post()
        {
            $get = file_get_contents('php://input'); //==php://input возвращает все необработанные данные после HTTP-заголовков запроса, независимо от типа контента.

            $get = json_encode($get);
            $data = explode("&", json_decode($get));
//            $data = json_decode($get, true);
//            echo ('govno');
//            var_dump($data);
//            echo '<pre>';
//            var_dump($data);
//            echo '</pre>';
//            die();
//            $name = $data['user'];
            if(isset($_POST['name'])){
                $data['vesselId'] = htmlentities($_POST['vesselId']);
                $data['name'] = htmlentities($_POST['name']);
                $data['volume'] = htmlentities($_POST['volume']);
                $data['height'] = htmlentities($_POST['height']);
                $data['abbrev'] = htmlentities($_POST['abbrev']);
                $data['tankType'] = htmlentities($_POST['tankType']);
                $data['tableName'] = htmlentities($_POST['tableName']);
                $data['tankId'] = htmlentities($_POST['tankId']);
            }
            // TODO: сделать проверку, что были переданы title и description
            $this->answer = $this->tankModel->addOne($data);
            if ($this->answer !== 'OK') {
                return $this->badRequest();
            }
            header('Location: http://localhost/vsltanks2/client/sounding.php');
            // return $this->success();
        }


        private  function patch($id){
            $data = json_decode(file_get_contents('php://input'), true);

            $this->answer = $this->tankModel->updateById($id, $data);

            if ($this->answer !== 'OK') {
                return $this->badRequest();
            }

            return $this->success();
        }

        private  function remove($id){
            $this->answer = $this->tankModel->deleteById($id);
            if ($this->answer !== 'OK') {
                return $this->badRequest();
            }

            return $this->success();

        }

    }