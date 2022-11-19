<?php

    class User
    {
        public $user_level;

        public function checkIfEmailExists($email)
        {
            $connect = DB::getConnection();
            $query = (new Select('users'))
                        ->what(['count' => 'COUNT(*)'])
                       // ->where("WHERE `user_email` = '$email'")
                       ->where(array(["col2"=>"`user_email`"]), $email, NULL, 2)
                        ->build();
            //   print_r($query);
            //   die;
            $result = mysqli_query($connect, $query);
            return mysqli_fetch_assoc($result)['count'];
        }

        public function getAllUsers(){
            $connect = DB::getConnection();
            $query = "
            SELECT `user_id`, `user_email`, `user_role_id`, `role_name`                  
            FROM `users`
            LEFT JOIN `roles` ON `role_id` = `user_role_id`
        ";
            $result = mysqli_query($connect, $query);
            $admin = mysqli_fetch_all($result, MYSQLI_ASSOC);
//                  echo ('<pre>');
//                  print_r($admin);
//                  echo ('</pre>');
//    $userInfo['count'] = 1;
//    $userInfo['user_id'] = 19;
            return $admin;
        }



        public function getAllUserVessels($id){
            $connect = DB::getConnection();
            $query = "
            SELECT `user_id`, `vessel_id`, `vessel_name`, `user_vessel_user_role`, `users_vessels_role_name`, `user_vessel_id`                 
            FROM `users`
            LEFT JOIN `users_vessels` ON `user_vessel_user_id` = `user_id`
            LEFT JOIN `vessels` ON `vessel_id` = `user_vessel_vessel_is`
            LEFT JOIN `users_vessels_role` ON `users_vessels_role_id` = `user_vessel_user_role`
            WHERE `user_id` = $id 
        ";
           // echo($query);
            $result = mysqli_query($connect, $query);
            $userVessel = mysqli_fetch_all($result, MYSQLI_ASSOC);
//                  echo ('<pre>');
//                  print_r($admin);
//                  echo ('</pre>');
//    $userInfo['count'] = 1;
//    $userInfo['user_id'] = 19;
            return $userVessel;
        }



        public function getUserInfo($email, $password) {

            $password = md5($password);

            $connect = DB::getConnection();
          //  echo ($password);
            $query = "
            SELECT COUNT(*) AS `count`,
                   `user_id`
            FROM `users`
            WHERE `user_email` = '$email' AND
                  `user_password` = '$password';
        ";
            $result = mysqli_query($connect, $query);
            $userInfo = mysqli_fetch_assoc($result);
      //      echo ('<pre>');
     //      print_r($userInfo);
      //      echo ('</pre>');
//    $userInfo['count'] = 1;
//    $userInfo['user_id'] = 19;
            return $userInfo;
        }


        public function registerUser($email, $password)
        {
            $connect = DB::getConnection();
            $query = "
                INSERT INTO `users`
                    SET `user_email` = '$email',
                        `user_login` = '$email',
                        `user_password` = '$password';
            ";
           // print_r($query);
           // die;
            mysqli_query($connect, $query);
            return mysqli_insert_id($connect);
        }


        public function authorizeUser($email, $password)
        {
            $connect = DB::getConnection();
            $query = "
                SELECT  `user_id`, `user_email`, `user_password`, `user_role_id`
                    FROM `users`
                    WHERE `user_email` = '$email' AND `user_password` = '$password';
            ";
            // print_r($query);
            // die;

            $result = mysqli_query($connect, $query);
            $per = mysqli_fetch_assoc($result);
            $userInfo = $per['user_id'];
            $this->user_level = $per['user_role_id'];
          //  var_dump($per);
            return $userInfo;
        }

        public function authUser($userId)
        {
            $helper = new Helper();
            $token = $helper->generateToken();
            $tokenTime = time() + 15 * 60;
            $wer = $this->user_level;

            setcookie('user', $userId, time() + 2 * 24 * 60 * 60, '/');
            setcookie('token', $token, time() + 2 * 24 * 60 * 60, '/');
            setcookie('token_time', $tokenTime, time() + 2 * 24 * 60 * 60, '/');
            setcookie('user_role', $wer, time() + 2 * 24 * 60 * 60, '/');

            $connect = DB::getConnection();
            $query = "
                INSERT INTO `connects`
                    SET `connect_token` = '$token',
                        `connect_user_id` = $userId,
                        `connect_token_time` = FROM_UNIXTIME($tokenTime);
            ";
            return mysqli_query($connect, $query);
        }


        public function getUserRole()
        {
            if (isset($_COOKIE['user']) && isset($_COOKIE['token'])
                && isset($_COOKIE['token_time'])) {
                    $userId = $_COOKIE['user'];
                    $token = $_COOKIE['token'];
                    $tokenTime = $_COOKIE['token_time'];
                    $connect = DB::getConnection();
                    //$arr = array("col1"=>"`connect_user_id`", "col2"=>"`connect_token`");
//                    $query = (new Select('`connects`'))
//                                ->what(['`connect_id`', 'role' => '`user_role_id`', 'count' => 'COUNT(*)'])
//                                ->join([
//                                    array('type' => 'LEFT', 'table' => '`users`',
//                                        'key1' => '`user_id`', 'key2' => '`connect_user_id`'
//                                    )
//                                ])
                              //  ->where(array($arr), $userId, `$token`, 1)
                                //->build();

                    $query = "SELECT `connect_id`, `user_role_id` as role, COUNT(*) as count
                                FROM `connects`
                                LEFT JOIN `users` ON `user_id` = `connect_user_id`  
                                WHERE `connect_user_id` = $userId AND `connect_token` = '$token'";


                   //print_r($query);
                    /* проверка соединения */
                    if (mysqli_connect_errno()) {
                        printf("Не удалось подключиться: %s\n", mysqli_connect_error());
                        exit();
                    }else{
                        $result = mysqli_query($connect, $query);
                    }

                    $userInfo = mysqli_fetch_assoc($result);
                    // print_r($userInfo);

                    if ($userInfo['count']) {
                        if (time() > $tokenTime) {
                            $helper = new Helper();
                            $newToken = $helper->generateToken();
                            $newTokenTime = time() + 1 * 24 * 60 * 60;
                            $count = $userInfo['count'];
                            setcookie('user', $userId, time() + 2 * 24 * 60 * 60, '/');
                            setcookie('user_role', $userInfo['role'], time() + 2 * 24 * 60 * 60, '/');

                            setcookie('token', $newToken, time() + 2 * 24 * 60 * 60, '/');
                            setcookie('tokenOld', $token, time() + 2 * 24 * 60 * 60, '/');
                            setcookie('token_time', $newTokenTime, time() + 2 * 24 * 60 * 60, '/');
                            setcookie('connectID', $userInfo['connect_id'], time() + 2 * 24 * 60 * 60, '/');
                            setcookie('count', $count, time() + 2 * 24 * 60 * 60, '/');
                         //   setcookie('user_vessel_id', 444, time() + 2 * 24 * 60 * 60, '/');
                         //   $connect = DB::getConnection();
                            $query = "
                                UPDATE `connects`
                                    SET `connect_token` = '$newToken',
                                        `connect_token_time` = FROM_UNIXTIME($newTokenTime)
                                WHERE `connect_id` = $userInfo[connect_id];
                            ";
                            mysqli_query($connect, $query);
                        }
                        if ($userInfo['role'] === '3') {
                            return 'Admin';
                        } else if ($userInfo['role'] === '2'){
                            return 'Superuser';
                        } else if ($userInfo['role'] === '1'){
                            return 'User';
                        } else {
                            return 'Guest';
                        }
                    }
            }else{
                //var_dump($_COOKIE);
                // var_dump($userInfo[connect_id]);
                return 'Guest';
                // return 'User';
            }
            return 'Guest';
        }


        public function checkPasswordCorrect($password, $strUrl) {
            $str = '';
            //$patternPassword  = '~^(?=.*[A-Z].*[A-Z])(?=.*[!@#$&*])(?=.*[0-9].*[0-9])(?=.*[a-z].*[a-z].*[a-z]).{3,30}~';
            //$patternPassword  = '~^(((?=[A-Z]+)|(?=[!@#$&*]+)|(?=[a-z]+))(?=[0-9]+)){4,30}~';
            $patternPassword  = '~^\S*(?=\S{3,21})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$~';
            if (strlen($password) > 2 && strlen($password) < 21){
                if(preg_match($patternPassword, $password)){
                    //echo "Ваш пароль: ". $password."<br>";
                    //header('Location:' . $strUrl);
                    return;
                }else {
                   // echo "Ваш пароль: ". $password."<br>";
                    $str = "The password must include numbers, lowercase letters and uppercase letters. The following characters are allowed: «-», «_», «+», «#», «\$».<br>";
                    header('Location:' . $strUrl.'?'.$str);
                    return $str;

                }
            }else {
                $str = "The password must have from 3 to 20 characters!<br>";
                header('Location:' . $strUrl);
                return $str;
            }
        }

        public function addVesselForUser($id, $vesselId){
            $connect = DB::getConnection();
            $query = "
            SELECT `user_id`, `vessel_id`, `vessel_name`, `user_vessel_user_role`                  
            FROM `users`
            LEFT JOIN `users_vessels` ON `user_vessel_user_id` = `user_id`
            LEFT JOIN `vessels` ON `vessel_id` = `user_vessel_vessel_is`
            WHERE `user_id` = $id AND `vessel_id` = $vesselId
        ";
            $result = mysqli_query($connect, $query);
            $userVessel = mysqli_fetch_all($result, MYSQLI_ASSOC);
//                  echo ('<pre>');
//                  print_r($admin);
//                  echo ('</pre>');
//    $userInfo['count'] = 1;
//    $userInfo['user_id'] = 19;

            if(empty($userVessel)){
                $query = "
                    INSERT INTO `users_vessels`
                        SET `user_vessel_user_id` = $id,
                            `user_vessel_vessel_is` = $vesselId,
                            `user_vessel_user_role` = 1
                ";

                $result = mysqli_query($connect, $query);
                if ($result){
                    $query = "
                            SELECT `user_id`, `vessel_id`, `vessel_name`, `vessel_imo`, `user_vessel_user_role`                  
                            FROM `users`
                            LEFT JOIN `users_vessels` ON `user_vessel_user_id` = `user_id`
                            LEFT JOIN `vessels` ON `vessel_id` = `user_vessel_vessel_is`
                            WHERE `user_id` = $id AND `vessel_id` = $vesselId
                            ";
                }
                $result = mysqli_query($connect, $query);
                $newUserVessel = mysqli_fetch_all($result, MYSQLI_ASSOC);
                return $newUserVessel;
            }else{
                return $userVessel;
            }
            return $userVessel;
        }


        public function removeVesselForUser($id, $vesselId){
            $connect = DB::getConnection();
            $query ="        
                DELETE FROM `users_vessels`
                        WHERE `user_vessel_user_id` = $id AND `user_vessel_vessel_is` =  $vesselId;
            ";
           // echo $query;
            if (mysqli_query($connect, $query)){
                return 'OK';
            }
            return 'Error';
        }

        public function updateUserRole($id, $roleId){
            $connect = DB::getConnection();
            $query = "
                    UPDATE `users`
                        SET `user_role_id` = $roleId
                        WHERE `user_id` = $id
            ";
            // echo $query;
            // die(print_r($query));

            if (mysqli_query($connect, $query)){
                return 'OK';
            }
            return 'Error';
        }


        public function updateUserVesselRole($vesselId, $roleId){
            $connect = DB::getConnection();
            $query = "
                    UPDATE `users_vessels`
                        SET `user_vessel_user_role` = $roleId
                        WHERE `user_vessel_id` = $vesselId
            ";
            // echo $query;
            // die(print_r($query));

            if (mysqli_query($connect, $query)){
                return 'OK';
            }
            return 'Error';
        }
    }