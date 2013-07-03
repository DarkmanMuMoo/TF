<?php

class Selection_dao {

    /** @return  Selection */
    public static function findbyPk($SelectionCode) {
        get_instance()->db->where('SelectionCode', $SelectionCode);

        $query = get_instance()->db->get('selection');


        foreach ($query->result() as $row) {


            return $row;
        }

        return null;
    }

    /** @return  Selection */
    public static function findall() {


        $query = get_instance()->db->get('selection');

        $array = array();
        foreach ($query->result() as $row) {



            array_push($array, $row);
        }


        return $array;
    }

    /** @return  Selection */
    public static function findbymultifield($condition) {
        foreach ($condition as $index => $row) {

            get_instance()->db->where($index, $row);
        }

        $query = get_instance()->db->get('selection');
        $condition = array();

        foreach ($query->result() as $row) {

            array_push($condition, $row);
        }
        // echo var_dump($obj);
        // var_dump($this->db->last_query());
        return $condition;
    }
/** @return  Selection */
     public static function findbymultifield_return_one_rows($condition) {
        foreach ($condition as $index => $row) {

            get_instance()->db->where($index, $row);
        }

        $query = get_instance()->db->get('selection');
     
       if ($query->num_rows() > 0){
        return $query->row();
        
        }
        else{
            
            return null;
        }
    }


    public static function score_report($limit=true)
    {
            $limittext="";
            if ($limit===true) {
                 $limittext = ' limit 0,10 ';
                ChromePhp::log($limittext.'dsf');
            }
      
        $query=get_instance()->db->query(" select user.Username,user.Name,user.Lastname,font.FontCode,Report.fontID,Report.score
            from font join  (select fontID, count(*) as score from selection  
                group by fontID order by score desc 
                 $limittext) Report 
        on Report.fontID = font.fontID 
        join user on  font.UserID = user.UserID");
       
        return $query->result();

    }
    public static function update($obj) {

        get_instance()->db->where('SelectionCode', $obj->SelectionCode);
        return get_instance()->db->update('selection', $obj);
    }

    public static function delete($SelectionCode) {

        return get_instance()->db->delete('selection', array(
                    'SelectionCode' => $SelectionCode));
    }

    public static function insert($obj) {

        return get_instance()->db->insert('selection', $obj);
    }

}

?>