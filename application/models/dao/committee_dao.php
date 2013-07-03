<?php

class Committee_dao {

    /** @return  Committee */
    public static function findbyPk($CommitID) {
        get_instance()->db->where('CommitID', $CommitID);

        $query = get_instance()->db->get('committee');


        foreach ($query->result() as $row) {


            return $row;
        }

        return null;
    }

    /** @return  Committee */
    public static function findall() {


        $query = get_instance()->db->get('committee');

        $array = array();
        foreach ($query->result() as $row) {



            array_push($array, $row);
        }


        return $array;
    }

    /** @return  Committee */
    public static function findbymultifield($condition) {
        foreach ($condition as $index => $row) {

            get_instance()->db->where($index, $row);
        }

        $query = get_instance()->db->get('committee');
        $condition = array();

        foreach ($query->result() as $row) {

            array_push($condition, $row);
        }
        // echo var_dump($obj);
        // var_dump($this->db->last_query());
        return $condition;
    }
/** @return  Committee */
     public static function findbymultifield_return_one_rows($condition) {
        foreach ($condition as $index => $row) {

            get_instance()->db->where($index, $row);
        }

        $query = get_instance()->db->get('committee');
     
       if ($query->num_rows() > 0){
        return $query->row();
        
        }
        else{
            
            return null;
        }
    }
    public static function update($obj) {

        get_instance()->db->where('CommitID', $obj->CommitID);
        return get_instance()->db->update('committee', $obj);
    }

    public static function delete($CommitID) {

        return get_instance()->db->delete('committee', array(
                    'CommitID' => $CommitID));
    }

    public static function insert($obj) {

        return get_instance()->db->insert('committee', $obj);
    }

}

?>