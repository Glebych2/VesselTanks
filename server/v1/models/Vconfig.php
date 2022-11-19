<?php

    class  Vconfig{

        public  function getAll(){
            $connect = DB::getConnection();
            $query = (new Select('vessels'))
                ->build();
            $result = mysqli_query($connect, $query);
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        }

        public  function getById($id){
            $connect = DB::getConnection();
            $query = " 
                    SELECT `vessel_id`, `vessel_name`, COUNT(*) as count
                    FROM `vessels`
                    LEFT JOIN `tanks` ON `vessel_id` = `tank_vessel_id`
                    WHERE `vessel_id` = $id AND `tank_type_id` = 0
            ";
            $result = mysqli_query($connect, $query);
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        }

}