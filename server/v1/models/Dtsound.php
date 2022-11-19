<?php


class Dtsound
{
    public  function getAll(){
        $connect = DB::getConnection();
        $query = (new Select('sound_dates'))
            ->build();

        $result = mysqli_query($connect, $query);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public  function getByVslId($id, $vslId){
        $connect = DB::getConnection();
        //echo 'has gotten getById';
        $query = "
                        SELECT `user_vessel_id`, `user_vessel_user_id`, `user_vessel_vessel_is`,  `user_vessel_user_role`
                        FROM `users_vessels`
                        WHERE `user_vessel_vessel_is` = $vslId AND `user_vessel_user_id` = $id
        ";
        $result = mysqli_query($connect, $query);
        $userVesselLevel = mysqli_fetch_assoc($result);
        //print_r($userVesselLevel);

        if (isset($userVesselLevel['user_vessel_user_role'])){
            if ($userVesselLevel['user_vessel_user_role'] == 2 ){
                $query =  "
                           SELECT DISTINCT `sound_date_id` as dateId, `sound_date_time` as dateTime, `sound_date_comment` as comment, `sound_date_trim` as trim,
                                           `user_vessel_user_id`, `vessel_id`
                            FROM `sound_dates`
                            LEFT JOIN `parameters` ON `sound_date_id` = `parameter_sound_date_id`
                            LEFT JOIN `tanks` ON `parameter_tank_id` = `tank_id`
                            LEFT JOIN `vessels` ON `tank_vessel_id` = `vessel_id`
                            LEFT JOIN `users_vessels` ON `vessel_id` = `user_vessel_vessel_is` 
                            WHERE `vessel_id` = $vslId AND `user_vessel_user_id` = $id
                    ";
            }elseif ($userVesselLevel['user_vessel_user_role'] == 1){
                $query =  "
                           SELECT DISTINCT `sound_date_id` as dateId, `sound_date_time` as dateTime, `sound_date_comment` as comment, `sound_date_trim` as trim,
                                           `user_vessel_user_id`, `vessel_id`, `user_vessel_user_role` as roleId
                            FROM `sound_dates`
                            LEFT JOIN `parameters` ON `sound_date_id` = `parameter_sound_date_id`
                            LEFT JOIN `tanks` ON `parameter_tank_id` = `tank_id`
                            LEFT JOIN `vessels` ON `tank_vessel_id` = `vessel_id`
                            LEFT JOIN `users_vessels` ON `vessel_id` = `user_vessel_vessel_is` 
                            WHERE `vessel_id` = $vslId AND `user_vessel_user_id` = $id AND `sound_date_user_id` = $id
                    ";
              //  setcookie('user_vessel_id', 444, time() + 3600, '/');
            }
        }
        if ($id == 4){
            $query =  "
                           SELECT DISTINCT `sound_date_id` as dateId, `sound_date_time` as dateTime, `sound_date_comment` as comment, `sound_date_trim` as trim,
                                           `user_vessel_user_id`, `vessel_id`
                            FROM `sound_dates`
                            LEFT JOIN `parameters` ON `sound_date_id` = `parameter_sound_date_id`
                            LEFT JOIN `tanks` ON `parameter_tank_id` = `tank_id`
                            LEFT JOIN `vessels` ON `tank_vessel_id` = `vessel_id`
                            LEFT JOIN `users_vessels` ON `vessel_id` = `user_vessel_vessel_is` 
                            WHERE `vessel_id` = $vslId
                            GROUP BY `sound_date_id`
                    ";
        }

        //echo $query;
        $result = mysqli_query($connect, $query);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public  function getById($id){
        $connect = DB::getConnection();
        //echo 'has gotten getById';
        $query =  "
                        SELECT `sound_date_id` as dateId, `sound_date_time` as dateTime, `sound_date_comment` as comment, `sound_date_trim` as trim,
                               `parameter_level` as level, `parameter_temp` as temp, `parameter_density` as density, `parameter_tank_id` as tankId,
                               `tank_name`, `tank_abbrev`
                        FROM `sound_dates`
                        LEFT JOIN `parameters` ON `sound_date_id` = `parameter_sound_date_id`
                        LEFT JOIN `tanks` ON `parameter_tank_id` = `tank_id`
                        WHERE `sound_date_id` = $id
                ";
        //  echo $query;

        $result = mysqli_query($connect, $query);
        $soundDate = mysqli_fetch_all($result, MYSQLI_ASSOC);
       // $soundDate['ttt']='2313';
       // echo($erqw);
        return $soundDate;
    }


    public function  addOne($newData){
        $connect = DB::getConnection();
        $query = "
                        INSERT INTO `sound_dates`
                                SET `sound_date_time` = '$newData[date]',
                                    `sound_date_comment` = '$newData[comment]',
                                    `sound_date_trim` = $newData[trim],
                                    `sound_date_user_id` = $newData[dateSoundUserId];
        ";
        mysqli_query($connect, $query);
        $soundDateId = mysqli_insert_id($connect);

    //    $query ="
    //                    INSERT INTO `infos`
   //                             SET `info_sound_date_id` := $soundDateId,
   //                                 `info_comment` = '$newData[comment]',
   //                                 `info_trim` = $newData[trim];
   //     ";
   //     mysqli_query($connect, $query);
   //     $infoId = mysqli_insert_id($connect);

        $query ="        INSERT INTO `parameters` (`parameter_sound_date_id`, `parameter_level`, `parameter_temp`, `parameter_density`, `parameter_tank_id`) VALUES ";
        $length = count($newData['tankParam'][0]);
        for ($i=0; $i < $length; $i++){
            if (!empty($newData['tankParam'][0][$i])){
                $level = $newData['tankParam'][0][$i];
            }else{
                $level = 0;
            }

            $temp = $newData['tankParam'][1][$i];
            $dens = $newData['tankParam'][2][$i];
            $tankId = $newData['tankParam'][3][$i];
            $query .= "($soundDateId, $level, $temp, $dens, $tankId), ";
        }

        $query = rtrim($query, ', ');
   //     echo $query;
  //      var_dump(mysqli_query($connect, $query));
        if (mysqli_query($connect, $query)){
            return 'OK';
        }
        return 'Error';
    }



    public function  updateById($id, $newData){
        $connect = DB::getConnection();
//            $query = (new Select('recipies'))
//                ->where(array(["col1"=>"`recipe_id`" ]), $id, null, 1)
//                ->build();
//            $result = mysqli_query($connect, $query);
//            $oldData =  mysqli_fetch_all($result, MYSQLI_ASSOC);

        $query = "
                    UPDATE `sound_dates`
                                SET `sound_date_time` = '$newData[date]',
                                    `sound_date_comment` = '$newData[comment]',
                                    `sound_date_trim` = $newData[trim],
                                    `sound_date_user_id` = $newData[dateSoundUserId];
            ";

//        $query ="        UPDATE `parameters`
//                        SET (`parameter_sound_date_id`, `parameter_level`, `parameter_temp`, `parameter_density`, `parameter_tank_id`) VALUES ";
//        $length = count($newData['tankParam'][0]);
//        for ($i=0; $i < $length; $i++){
//            if (!empty($newData['tankParam'][0][$i])){
//                $level = $newData['tankParam'][0][$i];
//            }else{
//                $level = 0;
//            }
//
//            $temp = $newData['tankParam'][1][$i];
//            $dens = $newData['tankParam'][2][$i];
//            $tankId = $newData['tankParam'][3][$i];
//            $query .= "($soundDateId, $level, $temp, $dens, $tankId), ";
//        }
//
//        $query = rtrim($query, ', ');
        // echo $query;
        // die(print_r($query));

        if (mysqli_query($connect, $query)){
            return 'OK';
        }
        return 'Error';
    }

    public function  deleteById($id){
        $connect = DB::getConnection();

        $query = "
                DELETE FROM `sound_dates`
                    WHERE `sound_date_id` = $id;
    ";
        mysqli_query($connect, $query);
        $soundDateId = mysqli_insert_id($connect);

      //  $query ="
      //          DELETE FROM `infos`
      //                  WHERE `info_sound_date_id` = $soundDateId;
       // ";
       // mysqli_query($connect, $query);
      //  $infoId = mysqli_insert_id($connect);

        $query ="        
                DELETE FROM `parameters`
                        WHERE `parameter_sound_date_id` = $soundDateId;
            ";
        //echo $query;

        if (mysqli_query($connect, $query)){
            return 'OK';
        }
        return 'Error';
    }

}