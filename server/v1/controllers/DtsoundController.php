<?php


class DtsoundController extends BaseController
{
    private $dtsoundModel;
    public $role;

    public function  __construct()
    {
        $this->dtsoundModel = new  Dtsound();

    }



    public  function  actionMain($id = 0, $vslId = 0){
        $method = $_SERVER['REQUEST_METHOD'];
        switch($method){
            case 'GET':
                $this->get($id, $vslId);
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

    private  function get($id, $vslId){
        if($id === 0 AND $vslId === 0){
            $this->answer = $this->dtsoundModel->getAll();
            return $this->success();
        }else if($vslId === 0){
            $this->answer = $this->dtsoundModel->getById($id);
            if (empty($this->answer)){
                return $this->notFound();
            }else{
                return $this->success();
            }
        }else{
            $this->answer = $this->dtsoundModel->getByVslId($id, $vslId);
            if(isset($_COOKIE['user_level'])){
              //  if (isset($_COOKIE['user']))
                    setcookie('user_level', rand(1, 6556), time() + 2 * 24 * 60 * 60, '/');
              //  else
              //      setcookie('user_level', rand(1, 6556), time() -3600);
            }
            if (empty($this->answer)){
                return $this->notFound();
            }else{
                return $this->success();
            }
        }

    }


    private function post()
    {
        $newData = json_decode(file_get_contents('php://input'), true);
//        echo '<pre>';
//        print_r($newData);
//        echo '</pre>';
//        die();
        // TODO: сделать проверку, что были переданы title и description
        $this->answer = $this->dtsoundModel->addOne($newData);
        if ($this->answer !== 'OK') {
            return $this->badRequest();
        }
        return $this->success();
    }



    private  function patch($id){
        $data = json_decode(file_get_contents('php://input'), true);

        $this->answer = $this->dtsoundModel->updateById($id, $data);

        if ($this->answer !== 'OK') {
            return $this->badRequest();
        }

        return $this->success();
    }

    private  function remove($id){
        $this->answer = $this->dtsoundModel->deleteById($id);
        if ($this->answer !== 'OK') {
            return $this->badRequest();
        }

        return $this->success();

    }

}