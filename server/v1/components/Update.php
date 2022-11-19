<?php


class Update
{

    private $what = '*';
    private $from;
    private $where = '';

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
                $str .= "$alias = $value, ";
            }
        }
        $str = rtrim($str, ', ');
        $this->what = $str;
        return $this;
    }

//    public function where($where)
//    {
//        $this->where = $where;
//        return $this;
//    }

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

    public function limit($count, $offset = 0)
    {
        $this->limit = "LIMIT $offset, $count";
        return $this;
    }

    public function build()
    {
        return "
                UPDATE $this->from
                SET $this->what
                $this->where   
            ";
    }


}