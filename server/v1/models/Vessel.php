<?php
    class  Vessel{

        public  function getAll(){
            $connect = DB::getConnection();
//            $query = (new Select('vessels'))
//                ->build();
            $query = "
            SELECT `vessel_id`, `vessel_name`, `vessel_imo`, `vessel_call_sign`, `vessel_official_number`, 
                   `vessel_port_registry`, `vessel_flag`, `image_id`, `image_name`, `directory_path`
                    FROM `vessels`
                    LEFT JOIN `directories` ON `vessel_id` = `directory_vessel_id`
                    LEFT JOIN `images` ON `directory_id` = `image_directory_id`
                    ORDER BY vessel_id ASC 

            ";
            $result = mysqli_query($connect, $query);
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        }


        public  function getAllVessel(){
            $connect = DB::getConnection();
//            $query = (new Select('vessels'))
//                ->build();
            $query = "
            SELECT `vessel_id`, `vessel_name`, `vessel_imo`
                    FROM `vessels`
            ";
            $result = mysqli_query($connect, $query);
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        }


        public  function getById($id){
            $connect = DB::getConnection();
            $query = "
            SELECT `vessel_id`, `vessel_name`, `user_vessel_user_role`
                    FROM `vessels`
                    LEFT JOIN `users_vessels` ON `vessel_id` = `user_vessel_vessel_is`
                    LEFT JOIN `users` ON `user_vessel_user_id` = `user_id`
                    WHERE `user_id` = $id 

            ";
           //echo($query);
            $result = mysqli_query($connect, $query);
            //echo ($result);
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        }

        public  function getImg($id, $imgTrig){
            $connect = DB::getConnection();
            $query = "
            SELECT `image_id`, `vessel_id`, `vessel_name`, `vessel_imo`, `vessel_call_sign`, `vessel_official_number`, 
                   `vessel_port_registry`, `vessel_flag`, `image_name`, `directory_path`
                    FROM `vessels`
                    LEFT JOIN `directories` ON `vessel_id` = `directory_vessel_id`
                    LEFT JOIN `images` ON `directory_id` = `image_directory_id`
                    WHERE `vessel_id` = $id ORDER BY `image_id` DESC 

            ";
           // echo ($query);
           // die();
            $result = mysqli_query($connect, $query);
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        }

//====================================================================================================================
        public function  addOne($newData){

            $connect = DB::getConnection();

            //==Проверяем по ИМО номеру существует ли в БД судно с таким же ИМО номером=================================
            $query = "
                    SELECT *
                    FROM `vessels`
                    WHERE `vessel_imo` = '$newData[imo]'
            ";
            //  echo $query;
            $result = mysqli_query($connect, $query);
            $info = mysqli_fetch_assoc($result);
            if (isset($info['vessel_id'])){
                $vesselId = $info['vessel_id'];
            }

           // die('$vesselId = '.$vesselId);

            //==Формируем запрос для добавления судна в БД=================================
            $query = "
                    INSERT INTO `vessels`
                        SET `vessel_name` = '$newData[vessel]',
                            `vessel_imo` = '$newData[imo]',
                            `vessel_call_sign` = '$newData[call]',
                            `vessel_official_number` = '$newData[officialNumber]',
                            `vessel_port_registry` = '$newData[port]',
                            `vessel_flag` = '$newData[flag]'
            ";

            //==Если судно с таким ИМО номером не существует в БД то отправляем запрос========================================
            $user_level = 1; //==Если судно уже существует в БД то доступ к нему будет уровня User============================
            if (!isset($vesselId)) {
                $user_level = 2;  //==Если пользователь заносит новое судно  в БД то доступ к нему будет уровня Superuser======
                $vesselResult = mysqli_query($connect, $query);
//                echo ('pre');
//                echo ('<pre>');
//                print_r($vesselResult);
//                echo ('<pre>');
                //==Находим по ИМО номеру вновь занесеное в БД судно =================================
                $query = "
                    SELECT *
                    FROM `vessels`
                    WHERE `vessel_imo` = '$newData[imo]'
                ";
                //  echo $query;
                $result = mysqli_query($connect, $query);
                $info = mysqli_fetch_assoc($result);

//                echo ('user'.$newData['user']);
//                echo ('vessel'.$info['vessel_id']);
//                die('user'.$newData['user']);
            }

           // die('$info = '.$newlyInstalledVessel['vessel_id'] .' , $vesselResult = '. $vesselResult);
            if ($info['vessel_id'] !== '1'){
               // die('The vessel exists in DB already!!!  '.$vesselId);
                $query = "
                    INSERT INTO `users_vessels`
                        SET `user_vessel_user_id` = '$newData[user]',
                            `user_vessel_vessel_is` = $info[vessel_id],
                            `user_vessel_user_role` = $user_level
                ";
               // die($query);
                $result = mysqli_query($connect, $query);
            }




            //==Проверяем по id судна существует ли в БД путь к директории с файлами для этого судна====================
            $query = "
                    SELECT *
                    FROM `directories`
                    WHERE `directory_vessel_id` = $info[vessel_id]
            ";
            $result = mysqli_query($connect, $query);
            $dir = mysqli_fetch_assoc($result);
            //print_r($dir);

            $newPath = '/'.$newData['path'].'/';
                $query = "
                    INSERT INTO `directories`
                        SET `directory_path` = '$newPath',
                            `directory_vessel_id` = $info[vessel_id]
            ";

            //==Заносим в БД путь к директории с файлами для этого судна====================
            if (!isset($dir['directory_vessel_id'])) {
                $result = mysqli_query($connect, $query);
                //  die('The vessel exists in DB already!!!');
            }

            //==Находим по id судна существует ли в БД путь к директории с файлами для этого судна====================
            $query = "
                    SELECT *
                    FROM `directories`
                    WHERE `directory_vessel_id` = $info[vessel_id]
            ";
            $result = mysqli_query($connect, $query);
            $dir = mysqli_fetch_assoc($result);
            //print_r($dir);
            //die();

            //==Проверяем существует ли в БД файл с таким же именем в директории для этого судна====================
            $query = "
                    SELECT *
                    FROM `images`
                    WHERE `image_name` = '$newData[imgName]' AND `image_directory_id` = $dir[directory_id]
            ";
            $result = mysqli_query($connect, $query);
            $img = mysqli_fetch_assoc($result);

            $query = "
                    INSERT INTO `images`
                        SET `image_name` = '$newData[imgName]',
                            `image_directory_id` = $dir[directory_id]
            ";

            if (!isset($img) && $newData['imgName'] !== '') {
                $result = mysqli_query($connect, $query);
            }
           // echo $query;
           // die();


            if (!isset($vesselId)) {
                if (isset($info['vessel_id'])){
                    return 'OK';
                }
                //header('Location: http://localhost/vsltanks/client/configuration.php');
                //  die('The vessel exists in DB already!!!');
            }else{
                return 'Exists';
            }

        }



}