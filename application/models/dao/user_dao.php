<?php

class User_dao {

    /** @return  User */
    public static function findbyPk($UserID) {
        get_instance()->db->where('UserID', $UserID);

        $query = get_instance()->db->get('user');


        foreach ($query->result() as $row) {


            return $row;
        }

        return null;
    }

    /** @return  User */
    public static function findall() {


        $query = get_instance()->db->get('user');




        return $query->result();
    }

    /** @return  User */
    public static function findbymultifield($condition) {
        foreach ($condition as $index => $row) {

            get_instance()->db->where($index, $row);
        }

        $query = get_instance()->db->get('user');

        // echo var_dump($obj);
        // var_dump($this->db->last_query());
        return $query->result();
    }

    /** @return  User */
    public static function findbymultifield_return_one_rows($condition) {
        foreach ($condition as $index => $row) {

            get_instance()->db->where($index, $row);
        }

        $query = get_instance()->db->get('user');

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {

            return null;
        }
    }

    public function Query_user($condition, $keyword) {

        get_instance()->db->from('user');
        if ($keyword != '') {
            $where = "(Username like '%$keyword%'
                or  name like '%$keyword%'  or   Lastname like '%$keyword%' )";
            get_instance()->db->where($where);
        }
        if ($condition['Sex'] != 0) {
            switch ($condition['Sex']) {
                case 1:
                   $value = 'M';
                    break;
                case 2:
                    $value = 'F';
                    break;
            }
            get_instance()->db->where('Sex', $value);
        }
        $query = $this->db->get();
        if ($query->num_rows() == 0)
            return 0;
        return $query->result();
    }

    public static function update($obj) {

        get_instance()->db->where('UserID', $obj->UserID);
        return get_instance()->db->update('user', $obj);
    }

    public static function delete($UserID) {

        return get_instance()->db->delete('user', array(
                    'UserID' => $UserID));
    }

    public static function insert($obj) {

        return get_instance()->db->insert('user', $obj);
    }

}

?>