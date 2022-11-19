<?php

    class Select
    {

        private $what = '*';
        private $from;
        private $where = '';
        private $join = '';
        private $group = '';
        private $having = '';
        private $order = '';
        private $limit = '';

        public function __construct($from)
        {
            $this->from = $from;
            return $this;
        }

        public function what($what)
        {
            $str = '';
            foreach ($what as $alias => $value) {
                if (is_numeric($alias)) {
                    $str .= "$value, ";
                } else {
                    $str .= "$value as $alias, ";
                }
            }
            $str = rtrim($str, ', ');
            $this->what = $str;
            return $this;
        }

        public function join($joins)
        {
            $str = '';
            foreach ($joins as $join) {
                $str .= "$join[type] JOIN $join[table] ON $join[key1] = $join[key2] ";
           //     $str .= "LEFT JOIN books_authors ON book_id = books_author_book_id ";
            }
            $this->join = $str;
 //           echo '<pre>';
 //           print_r($str);
 //           echo '</pre>';
            return $this;
        }


        // TODO: make more complex
        public function where($where, $per1, $per2, $mark)
        {
            $str = '';
            foreach ($where as $whr) {
                if ($mark === 1){
                    if (isset($per2)){
                        $str .= "WHERE $whr[col1] = $per1 AND $whr[col2] = $per2";
                    }else{
                        $str .= "WHERE $whr[col1] = $per1";
                    }
                }elseif ($mark === 2){
                    if (isset($per1)){
                        $str .= "WHERE $whr[col2] = '$per1'";
                    }
                }elseif ($mark === 3){
                    if (isset($per1) && isset($per2)){
                        $str .= "WHERE $whr[col1] = '$per1' AND $whr[col2] IN ($per2)";
                    }
                }
                //     $str .= "LEFT JOIN books_authors ON book_id = books_author_book_id ";
            }
            $this->where = $str;
            //           echo '<pre>';
            //           print_r($per2);
             //          echo '</pre>';
            return $this;

          //  $this->where = $where;
          //  return $this;
        }

        public function having($having)
        {
            $this->having = $having;
            return $this;
        }

        public function group($group)
        {
            $this->group = "GROUP BY $group";
            return $this;
        }

        public function order($orders)
        {
            $str = '';
            foreach ($orders as $order) {
                $str .= "$order[column] $order[direction], ";
            }
            $str = rtrim($str, ', ');
            $this->order = "ORDER BY $str";
            return $this;
        }

        public function limit($count, $offset = 0)
        {
            $this->limit = "LIMIT $offset, $count";
            return $this;
        }

        public function build()
        {
            return "
                SELECT $this->what
                FROM $this->from
                $this->join
                $this->where
                $this->group
                $this->having
                $this->order
                $this->limit;
            ";
        }


    }