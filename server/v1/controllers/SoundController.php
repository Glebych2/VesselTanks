<?php

    class SoundController extends BaseController
    {

        public $title;
        private $soundModel;
        public $role;

        public function  __construct()
        {
            $this->soundModel = new  Sound();
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
                $this->answer = $this->soundModel->getAll();
                return $this->success();
            }else{
                $this->answer = $this->soundModel->getById($id);
                if (empty($this->answer)){
                    return $this->notFound();
                }else{
                    return $this->success();
                }
            }
        }


        private function post()
        {
            //var_dump($_POST);

            $data = json_decode(file_get_contents('php://input'), true);
            // TODO: сделать проверку, что были переданы title и description
            if($_FILES) {
                $tankId = htmlentities($_POST['tankId2']); //==id танка, который был занесен в скрытый инпут на форме
                if($_FILES['csv']['type'] != 'application/vnd.ms-excel' || $_FILES['csv']['type'] == '') {
                    $this->pageData['errors'] = "Ошибка! Возможно данный файл имеет некорректный формат";
                } else {
                    $dir = $_SERVER[ 'DOCUMENT_ROOT'].'/vsltanks2/server/v1/assets/upload/csv/'.$_FILES['csv']['name'];
                   // die($dir);
                    if(move_uploaded_file($_FILES['csv']['tmp_name'],$dir)) {
                        $fileCSV = $dir;
                        $file = fopen($fileCSV, "r");
                        while($data = fgetcsv($file, 200, ";")) {
//                            echo '<pre>';
//                                print_r($data);
//                            echo '</pre>';
                            $str = explode(",", $data[0]); //==преобразуем строку в массив
                            array_push($str, $tankId);      //==добавляем в конец id танка
//                               echo '<pre>';
//                                   print_r($str);
//                               echo '</pre>';
                            $this->answer = $this->soundModel->addFromCSV($str);
                        }
                        fclose($file);
                    }
                }
            }

            if ($this->answer !== 'OK') {
                return $this->theTableExist();
            }
            header('Location: http://localhost/vsltanks2/client/tables.php');
          //  return $this->success();
        }

        private  function patch($id){
            $data = json_decode(file_get_contents('php://input'), true);

            $this->answer = $this->soundModel->updateById($id, $data);

            if ($this->answer !== 'OK') {
                return $this->badRequest();
            }

            return $this->success();
        }

        private  function remove($id = -1){
            $this->answer = $this->soundModel->deleteById($id);
            if ($this->answer !== 'OK') {
                return $this->badRequest();
            }

            return $this->success();

        }

    }