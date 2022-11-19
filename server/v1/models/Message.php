<?php
session_start();

class Message
{
    public function getAll()
    {
        $connect = DB::getConnection();
        $query = (new Select('feedback'))
            ->join(array(['type'=>'LEFT', 'table'=>'`users`', 'key1'=>'`user_id`', 'key2'=>'`feedback_user_id`']))
            ->order(array(['column'=>'feedback_time', 'direction'=>'DESC']))
            ->build();
        //echo $query;
        $result = mysqli_query($connect, $query);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function getNewMsg($read)
    {
        $connect = DB::getConnection();
        $query = (new Select('feedback'))
            ->join(array(['type'=>'LEFT', 'table'=>'`users`', 'key1'=>'`user_id`', 'key2'=>'`feedback_user_id`']))
            ->where(array(['col1'=>'`feedback_read`']), 0, NULL, 1)
            ->order(array(['column'=>'feedback_time', 'direction'=>'DESC']))
            ->build();
        //echo $query;
        $result = mysqli_query($connect, $query);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function  addOne($newData){
      //  print_r($newData);
      //  die();
        $messageDate = date('Y.m.d H:i:s');
      //  print_r($messageDate);
        $connect = DB::getConnection();
        $query = "
                    INSERT INTO `feedback`
                        SET `feedback_message` = '$newData[message]',
                           `feedback_time` = '$messageDate',
                            `feedback_user_id` = $newData[userId]
            ";
        //  echo $query;
        //  die();
        if (mysqli_query($connect, $query)){
            $_SESSION['message'] = 'Your message sent! Thank you!';
            return 'OK';
        }
        return 'Error';
    }

    public function  markAsRead($id){
        $connect = DB::getConnection();
//            $query = (new Select('recipies'))
//                ->where(array(["col1"=>"`recipe_id`" ]), $id, null, 1)
//                ->build();
//            $result = mysqli_query($connect, $query);
//            $oldData =  mysqli_fetch_all($result, MYSQLI_ASSOC);

        $query = "
                    UPDATE `feedback`
                        SET `feedback_read` = 1
                        WHERE `feedback_id` = $id
            ";
        // echo $query;
        // die(print_r($query));

        if (mysqli_query($connect, $query)){
            return 'OK';
        }
        return 'Error';
    }
}