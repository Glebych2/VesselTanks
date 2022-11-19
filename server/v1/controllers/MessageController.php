<?php


class MessageController extends BaseController
{
    public $title;
    private $messageModel;
    public $role;

    public function  __construct()
    {
        $this->messageModel = new Message();
    }



    public  function  actionMessage($id = 0){
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
        if($id === '0'){
            $this->answer = $this->messageModel->getAll();
            return $this->success();
        }else{
            $this->answer = $this->messageModel->getNewMsg($id);
            if (empty($this->answer)){
                return $this->notFound();
            }else{
                return $this->success();
            }
        }
    }


    private function post()
    {
        if(isset($_POST['email'])){
            $data['email'] = htmlentities($_POST['email']);
            $data['message'] = htmlentities($_POST['message']);
            $data['userId'] = htmlentities($_POST['userId']);
        }
        // TODO: сделать проверку, что были переданы title и description
        $this->answer = $this->messageModel->addOne($data);
        if ($this->answer !== 'OK') {
            return $this->badRequest();
        }
         return $this->inserted();
    }

    private  function patch($id){
      //  $data = json_decode(file_get_contents('php://input'), true);

        $this->answer = $this->messageModel->markAsRead($id);

        if ($this->answer !== 'OK') {
            return $this->badRequest();
        }

        return $this->success();
    }
}