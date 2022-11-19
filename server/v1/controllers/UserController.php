<?php
session_start();
    class UserController extends BaseController
    {
        private $title;
        private $role;
        private $userModel;

        public function __construct()
        {
            $this->userModel = new User();
            $this->role = $this->userModel->getUserRole();

        }


        public function actionAdmin()
        {
//            if(extension_loaded('gd')&&function_exists('gd_info')){
//                echo ('GD installed');
//            }else {
//                echo('GD not installed');
//            }
          //  phpinfo();
            $this->title = 'Admin';
            $userModel = new User();
            $userModel->getAllUsers();
                $users = $userModel->getAllUsers();
             //   include_once('./views/common/header.php');?>
                <table class="table table-striped .table-hover table-sm  .table-responsive table_sort" id="usersTable">
                            <thead class="thead-dark">
                            <tr>
                                <th data-sort="user" data-alg="number" scope="col">ID</a></th>
                                <th data-sort="mail" data-alg="string" scope="col">e-mail</th>
                                <th data-sort="role" data-alg="string" scope="col">Role</th>
                                <? if ($this->role === 'Admin'): ?>
                                    <th scope="col"><a class="btn btn-secondary btn-sm" href="http://localhost/vsltanks2/client/registration.php">Add</a></th>
                                <? endif; ?>

                            </tr>
                            </thead>
                            <tbody id="usersList">
                            <? foreach ($users as $user): ?>
                                <tr>
                                    <th scope="row" style="padding-right: 2rem"><?= $user['user_id']; ?></th>
                                    <td id="user<?= $user['user_id']; ?>"><input type="button" value="<?= $user['user_email']; ?>" onclick="userPressed('<?= $user['user_id']; ?>')" ></td>
                                    <td>
                                        <select type="text" class="user-role"  name="ab" onchange="changeUserLevel(this.value)">
                                            <? if ($user['user_role_id'] === '1'): ?>
                                                <option value = '1' selected><?= $user['role_name']; ?></option>
                                                <option value = '2'>Superuser</option>
                                                <option value = '3'>Administrator</option>
                                                <option value = '4'>Guest</option>
                                            <? elseif ($user['user_role_id'] === '2'): ?>
                                                <option value = '1'>User</option>
                                                <option value = '2' selected><?= $user['role_name']; ?></option>
                                                <option value = '3'>Administrator</option>
                                                <option value = '4'>Guest</option>
                                            <? elseif ($user['user_role_id'] === '3'): ?>
                                                <option value = '1'>User</option>
                                                <option value = '2'>Superuser</option>
                                                <option value = '3' selected><?= $user['role_name']; ?></option>
                                                <option value = '4'>Guest</option>
                                            <? elseif ($user['user_role_id'] === '4'): ?>
                                                <option value = '1'>User</option>
                                                <option value = '2'>Superuser</option>
                                                <option value = '3'>Administrator</option>
                                                <option value = '4' selected><?= $user['role_name']; ?></option>
                                            <? endif; ?>
                                    </td>
                                    <? if ($this->role === 'Admin'): ?>
                                    <td><a class="btn btn-secondary btn-sm">Change</a>
<!--                                            <button class="btn btn-danger" onclick="remove()">Удалить</button>-->
                                    </td>
                                    <? endif; ?>
                                </tr>
                            <? endforeach; ?>
                            </tbody>
                        </table>
                <?  //  echo($str);

            return;
        }


        public  function actionUser($id){
            $this->title = 'Admin';
            $userModel = new User();
            $userVessel = $userModel->getAllUserVessels($id);
            ?>
            <table class="table table-striped .table-hover table-sm table_sort" id="vesselsTable">
                <thead class="thead-dark">
                <tr style="background: #ebf1f5">
                    <th data-sort="user" data-alg="number" scope="col">ID</th>
                    <th data-sort="vessel" data-alg="string" scope="col" id="vesselNameTH">Vessel name</th>
                    <th data-sort="role" data-alg="number" scope="col">Role</th>
                    <? if ($this->role === 'Admin'): ?>
                        <th scope="col"><a class="btn btn-secondary btn-sm" onclick="addVessel()">Add</a></th>
                    <? endif; ?>

                </tr>
                </thead>
                <tbody id="vesselsList">
                <? foreach ($userVessel as $userVessels): ?>
                    <tr>
                        <th scope="row" style="padding-right: 2rem" id="<?= $userVessels['vessel_id']; ?>"><?= $userVessels['vessel_id']; ?></th>
<!--                        <td><img src="http://localhost/vsltanks/server/api/v1/components/captcha.php" width="120" height="40" alt="dermo"/><br /></td>-->
                        <td id="userVessel<?= $userVessels['vessel_id']; ?>"><?= $userVessels['vessel_name']; ?></td>
                        <td>
                            <select class="user-role" name="<?= $userVessels['user_vessel_id']; ?>" onchange="changeUserVesselLevel(this.value, this.name)">
                                <? if ($userVessels['user_vessel_user_role'] === '1'): ?>
                                    <option value = '1' selected><?= $userVessels['users_vessels_role_name']; ?></option>
                                    <option value = '2'>super</option>
                                    <option value = '3'>spare</option>
                                    <option value = '4'>guest</option>
                                <? elseif ($userVessels['user_vessel_user_role'] === '2'): ?>
                                    <option value = '1'>user</option>
                                    <option value = '2' selected><?= $userVessels['users_vessels_role_name']; ?></option>
                                    <option value = '3'>spare</option>
                                    <option value = '4'>guest</option>
                                <? elseif ($userVessels['user_vessel_user_role'] === '3'): ?>
                                    <option value = '1'>user</option>
                                    <option value = '2'>super</option>
                                    <option value = '3' selected><?= $userVessels['users_vessels_role_name']; ?></option>
                                    <option value = '4'>guest</option>
                                <? elseif ($userVessels['user_vessel_user_role'] === '4'): ?>
                                    <option value = '1'>user</option>
                                    <option value = '2'>super</option>
                                    <option value = '3'>spare</option>
                                    <option value = '4' selected><?= $userVessels['users_vessels_role_name']; ?></option>
                                <? endif; ?>
                        </td>
                        <? if ($this->role === 'Admin'): ?>
                            <td><a class="btn btn-secondary btn-sm" href="">Change</a>
                                <!--                                            <button class="btn btn-danger" onclick="remove()">Удалить</button>-->
                            </td>
                        <? endif; ?>
                    </tr>
                <? endforeach; ?>
                </tbody>
            </table>
            <?  //  echo($str);
            return;
        }


        public function actionRegister()
        {
           // echo ('actionRegister');
            $this->title = 'Регистрация';
            $errors = [];
            if (isset($_POST['email']) && !empty($_POST['email'])) {
                $email = htmlentities($_POST['email']);
                $password = htmlentities($_POST['password']);
                $repeatPassword = htmlentities($_POST['repeat_password']);
                $userModel = new User();
                $strUrl = $_SERVER['HTTP_REFERER'];
                //echo $strUrl;
                //проверка на регулярки - т.е. проверка на валидность пароля, email
                $passwordChecked = $userModel->checkPasswordCorrect($password, $strUrl);

                if ($userModel->checkIfEmailExists($email)) {
                    $errors[] = 'Такой пользователь уже существует!';
                }

                if ($password !== $repeatPassword) {
                    $errors[] = 'Пароли не совпадают!';

                }elseif ($passwordChecked != 0){
                    $errors[] = $passwordChecked;
                }
                if (empty($errors)) {
                    $password = md5($password);
                    $userId = $userModel->registerUser($email, $password);
                  //  if ($userModel->authUser($userId)) {
                        $_SESSION['success'] = 'OK';
                        $_SESSION['message'] = 'Registration was successful1';

                        header('Location: http://localhost/vsltanks/client/auth.php');
                  //  }else{
                  //      $errors[] = 'Could not register. Try again later';
                  //  }

                }else{
                  //  return $this->errors();
                    $_SESSION['message'] = array_shift($errors); //==из массива извлекается первый элемент====
                    $_SESSION['success'] = 'NO';
                    return $this->errorsReg();
                }
            }else{
                $errors[] = 'Login is empty!';
                $_SESSION['message'] = array_shift($errors); //==из массива извлекается первый элемент====
                $_SESSION['success'] = 'NO';
                return $this->errorsReg();
            }
           // header('Location: http://localhost/vsltanks/client/registration.html');
            $_SESSION['success'] = 'OK';
            $_SESSION['message'] = 'Registration was successful!';

            header('Location: http://localhost/vsltanks/client/auth.php');
            return;
        }

        public function actionAuthorize()
        {
           // echo 'Мы в авторизации';
            $errors = [];
            if (isset($_POST['email'])) {
                $email = htmlentities($_POST['email']);
                $password = htmlentities($_POST['password']);
                $captcha = md5(htmlentities($_POST['captcha']));
                $random = $_SESSION['randomnr2'];
               // echo('$captcha = '.$captcha.', $random = '.$random);
                $userModel = new User();
                if ($userModel->checkIfEmailExists($email)) {
                   // echo 'Такой пользователь существует';
                    $password = md5($password);
                   // $_SESSION['capture'] = rand(10000, 99999);
                    if ($captcha == $random){
                        $userId = $userModel->authorizeUser($email, $password);
                    }else{
                        $errors[] = 'Wrong captcha!';
                    }

                    if ($userModel->authUser($userId)) {
                        $userModel->getUserRole();
                        return $this->loadPage();
                    }else{
                        $errors[] = 'Wrong password!';

                       // header('Location: ' . FULL_CLIENT_ROOT . 'auth.php');
                    }
                }else{
                    $errors[] = 'There is no such user!';
                   // header('Location: ' . FULL_CLIENT_ROOT . 'auth.php');
                }
            }
            if (empty($errors)){
                $this->loadPage();
            }else{
                $_SESSION['success'] = 'NO';
                $_SESSION['message'] = array_shift($errors); //==из массива извлекается первый элемент====
                header('Location: ' . FULL_CLIENT_ROOT . 'auth.php');
            }
            // print_r($errors);
          //  include_once('./views/users/authorize.php');
            return;
        }



        public function actionError(){
            echo 'Location: ' . FULL_SITE_ROOT . 'errors';
            header('Location: ' . FULL_SITE_ROOT . 'errors');
        }

        public function actionLogout(){
            setcookie('user', $_COOKIE['user'], time()-86400, '/');
            //setcookie('user', 1, time()+86400, '/');
            setcookie('token',$_COOKIE['token'], time()-86400, '/');
            setcookie('token_time', $_COOKIE['token_time'], time()-864000, '/');
            setcookie('user_role', $_COOKIE['user_role'], time()-86400, '/');

            header('Location: ' . FULL_CLIENT_ROOT . 'main.php');
        }

        public function actionUservessel($id, $vesselId){
            if ($this->role === 'Admin'){
                $userModel = new User();
               // echo ('......rabotaet.......'.$id.'.....'.$vesselId.'...........'.$this->role);
                $this->answer = $this->userModel->addVesselForUser($id, $vesselId);
               //-  echo ('......rabotaet.......'.$id.'.....'.$vesselId.'...........'.$this->answer);
                return $this->success();

            }
        }

        public function actionDelete($id, $vesselId){
            if ($this->role === 'Admin'){
                $userModel = new User();
               //  echo ('......rabotaet.......'.$id.'.....'.$vesselId.'...........'.$this->role);
                $this->answer = $this->userModel->removeVesselForUser($id, $vesselId);
                if ($this->answer === 'OK') {
                    return $this->success();
                }

            }
        }

        public function actionUpdate($id, $roleId){
            if ($this->role === 'Admin'){
                $userModel = new User();
                //  echo ('......rabotaet.......'.$id.'.....'.$vesselId.'...........'.$this->role);
                $this->answer = $this->userModel->updateUserRole($id, $roleId);
                if ($this->answer === 'OK') {
                    return $this->success();
                }

            }
        }

        public function actionVesselupdate($vesselId, $roleId){
            if ($this->role === 'Admin'){
                $userModel = new User();
                //  echo ('......rabotaet.......'.$vesselId.'.....'.$vesselId.'...........'.$this->role);
                $this->answer = $this->userModel->updateUserVesselRole($vesselId, $roleId);
                if ($this->answer === 'OK') {
                    return $this->success();
                }

            }
        }
    }