<?php
//session_start();
    class BaseController
    {

        protected $answer;
        public $errors;

        protected  function success()
        {
            $_SESSION['info'] = '';

            //   header('Location: http://localhost/vsltanks/client/sounding.php');

            header('HTTP/1.1 200 SUCCESS');
            echo json_encode($this->answer, JSON_UNESCAPED_UNICODE);

        }

        protected  function  configured(){
            $_SESSION['info'] = 'The vessel has registered successfully. Now you can use it as a super user';
            header('Location: http://localhost/vsltanks2/client/configuration.php');
         //   echo json_encode($this->answer, JSON_UNESCAPED_UNICODE);
        }

        protected  function  inserted(){
         //   header('HTTP/1.1 200 SUCCESS');
            header('Location: ' . FULL_CLIENT_ROOT . 'connect.php');
            echo json_encode($this->answer, JSON_UNESCAPED_UNICODE);
        }

        protected  function  tableInserted(){
               header('HTTP/1.1 200 SUCCESS');
          //  header('Location: ' . FULL_CLIENT_ROOT . 'connect.php');
            echo json_encode($this->answer, JSON_UNESCAPED_UNICODE);
        }

        protected  function  notFound(){
          //  include_once ('http://localhost/vsltanks/client/test.php');
          //  header('Location: ' . FULL_CLIENT_ROOT . 'error.php');
            header('HTTP/1.1 404 NOT FOUND');
         //   header('Location: ' . FULL_CLIENT_ROOT . 'connect.php');
            echo json_encode('Error 404 NOT FOUND', JSON_UNESCAPED_UNICODE);
        }

        protected  function  notAllowed(){
            header('HTTP/1.1 405 METHOD NOT ALLOWED');
            echo json_encode('Error 405 METHOD NOT ALLOWED', JSON_UNESCAPED_UNICODE);
        }

        protected  function  badRequest(){
            header('HTTP/1.1 400 BAD REQUEST');
            header('Location: ' . FULL_CLIENT_ROOT . 'error.php');
            echo json_encode('Error 400 BAD REQUEST', JSON_UNESCAPED_UNICODE);
        }

        protected  function  theTableExist(){
            header('Location: ' . FULL_CLIENT_ROOT . 'error_exist.php');
            echo json_encode('Error 400 BAD REQUEST', JSON_UNESCAPED_UNICODE);
        }

        protected function notAuthorized()
        {
            header('HTTP/1.1 401 UNAUTHORIZED');
        }

        protected function forbidden()
        {
            header('HTTP/1.1 403 FORBIDDEN');
        }

        protected function exists()
        {
           // die('$this->answer= '.$this->answer);
            $_SESSION['info'] = 'The vessel has already been registered somebody. Now you can use it as an ordinary user';
           // echo json_encode($this->answer, JSON_UNESCAPED_UNICODE);
            header('Location: http://localhost/vsltanks2/client/configuration.php');
            echo json_encode('The vessel has been registered somebody. Now you can use it as ordinary user', JSON_UNESCAPED_UNICODE);

        }

        protected function loadPage(){
            header('Location: ' . FULL_CLIENT_ROOT . 'main.php');
        }

        protected  function  errorsReg(){

           // $_SESSION['session_messages'][] = '$this->content';
            //  include_once ('http://localhost/vsltanks/client/test.php');
           // echo 'У вас нет прав для такого экшена';
            header('Location: ' . FULL_CLIENT_ROOT . 'registration.php');
          //  header('Location: ' . FULL_CLIENT_ROOT . 'error.php');

            //  header('HTTP/1.1 404 NOT FOUND');
         //   $this->errors = '<h1>Вступайте в наш виртуальный клуб</h1>';
         //   header('<h1>Вступайте в наш виртуальный клуб</h1>');
             // echo('<h1>Вступайте в наш виртуальный клуб</h1>');
        }

        protected  function  error(){

            header('Location: ' . FULL_CLIENT_ROOT . 'error.php');
            echo json_encode($this->answer, JSON_UNESCAPED_UNICODE);
        }
    }
