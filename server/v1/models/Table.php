<?php

    class  Table
    {

        public function getAll()
        {
            $connect = DB::getConnection();
            $query = (new Select('tables'))
                ->build();
            $result = mysqli_query($connect, $query);
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        }

        public function  addOne($newData){
              // print_r($newData);
              // die();
            $connect = DB::getConnection();
            $query = "
                    INSERT INTO `vessels`
                        SET `vessel_name` = '$newData[vessel]',
                            `vessel_imo` = '$newData[imo]',
                            `vessel_call_sign` = '$newData[call]',
                            `vessel_official_number` = '$newData[officialNumber]',
                            `vessel_port_registry` = '$newData[port]',
                            `vessel_flag` = '$newData[flag]'
            ";
            //  echo $query;
            //  die();
            if (mysqli_query($connect, $query)){
                return 'OK';
            }
            return 'Error';
        }


    }