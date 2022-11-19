<?php

    class  Sound{



        public  function getAll(){
            $connect = DB::getConnection();
            $query = " 
                    SELECT `COLUMN_NAME` 
                    FROM `INFORMATION_SCHEMA`.`COLUMNS` 
                    WHERE table_name = 'sounding' AND `COLUMN_NAME` != 'sound' AND `COLUMN_NAME` != 'sounding_id' AND `COLUMN_NAME` != 'ullage'
                          AND `COLUMN_NAME` != 'table_tank_id' AND `COLUMN_NAME` != 'sounding_id';
            ";
            // SHOW columns FROM `sounding`
            //     WHERE `Field` != 'sound' AND `Field` != 'ullage' AND `Field` != 'sounding_id' AND `Field` != 'table_tank_id';
            // SELECT `COLUMN_NAME`
            //FROM `INFORMATION_SCHEMA`.`COLUMNS`
            //WHERE table_name = 'sounding' AND `COLUMN_NAME` != 'sound' AND `COLUMN_NAME` != 'sounding_id' AND `COLUMN_NAME` != 'ullage'
            //              AND `COLUMN_NAME` != 'table_tank_id' AND `COLUMN_NAME` != 'sounding_id';
            $result = mysqli_query($connect, $query);
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        }

        public  function getById($id){
            $connect = DB::getConnection();
            $query = " 
                    SELECT  `sound`, `-2` as 'negativeTwo', `-1` as 'negativeOne', `-0.5` as 'negativeHalf', `0` as 'zero', `0.5` as 'half', 
                           `1` as 'One', `2` as 'Two', `3` as 'Three', `4` as 'Four', `5` as 'Five', `ullage`, `tank_name`  
                    FROM `sounding`
                    LEFT JOIN `tanks` ON `table_tank_id` = `tank_id`
                    WHERE table_tank_id = $id 
            
            ";
            $result = mysqli_query($connect, $query);
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        }

        public function addFromCSV($newData){
            //   print_r($newData);
            //   die();
           // echo '<pre>';
           // print_r($_FILES);
           // echo '</pre>';
            $connect = DB::getConnection();
            $query = "
                        INSERT INTO `sounding`
                        SET `sound` = $newData[0],
                            `-2` = $newData[1],
                            `-1` = $newData[2],
                            `-0.5` = $newData[3],
                            `0` = $newData[4],
                            `0.5` = $newData[5],
                            `1` = $newData[6],
                            `2` = $newData[7],
                            `3` = $newData[8],
                            `4` = $newData[9],
                            `5` = $newData[10],
                            `ullage` = $newData[11],
                            `table_tank_id` = $newData[12];
                            ";
             // echo $query;
             // die();
            if (mysqli_query($connect, $query)){
                return 'OK';
            }
            return 'Error';
        }



        public function deleteById($id){
            $connect = DB::getConnection();
            $query ="        
                DELETE FROM `sounding`
                        WHERE `table_tank_id` = $id;
            ";
          //  echo $query;
            if (mysqli_query($connect, $query)){
                return 'OK';
            }
            return 'Error';
        }

}