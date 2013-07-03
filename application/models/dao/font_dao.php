<?php

class Font_dao {

    /** @return  Font */
    public static function findbyPk($FontID) {
        get_instance()->db->where('FontID', $FontID);

        $query = get_instance()->db->get('font');


        foreach ($query->result() as $row) {


            return $row;
        }

        return null;
    }

    /** @return  Font */
    public static function findall() {


        $query = get_instance()->db->get('font');

        $array = array();
        foreach ($query->result() as $row) {



            array_push($array, $row);
        }


        return $array;
    }

    /** @return  Font */
    public static function findbymultifield($condition) {
        foreach ($condition as $index => $row) {

            get_instance()->db->where($index, $row);
        }

        $query = get_instance()->db->get('font');
        $condition = array();

        foreach ($query->result() as $row) {

            array_push($condition, $row);
        }
        // echo var_dump($obj);
        // var_dump($this->db->last_query());
        return $condition;
    }
   /** @return  User */
    public static function joinuser($condition, $keyword,$select_con,$CommitID) {
       
        get_instance()->db->join('user', 'user.UserID=font.UserID');
        if ($keyword != '') {
            $where = "(font.FontCode like '%$keyword%'
                or  font.Fontname like '%$keyword%'  or   font.Description like '%$keyword%' )";
            get_instance()->db->where($where);
        }
       if ($condition['UserID'] != 0) {
            get_instance()->db->where('user.UserID', $condition['UserID']);
        }
               if ($select_con != 0) {

            switch ($select_con) {
                case 1:
                    get_instance()->db->where("font.FontID NOT IN (select FontID from selection where CommitID = $CommitID)", NULL, FALSE);

                    break;
                case 2:
                    get_instance()->db->where("font.FontID  IN (select FontID from selection where CommitID = $CommitID )", NULL, FALSE);

                    break;
                case 3:
                    get_instance()->db->where("font.FontID NOT IN (select FontID from selection)", NULL, FALSE);


                    break;
            }
        }
        get_instance()->db->order_by("Uploadtime", "desc"); 
        $query = get_instance()->db->get('font');
     
        return $query->result();
    }

    public static function update($obj) {

        get_instance()->db->where('FontID', $obj->FontID);
        return get_instance()->db->update('font', $obj);
    }

    public static function delete($FontID) {

        return get_instance()->db->delete('font', array(
                    'FontID' => $FontID));
    }

    public static function insert($obj) {

        return get_instance()->db->insert('font', $obj);
    }

}

?>