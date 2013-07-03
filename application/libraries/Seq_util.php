<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Seq_util
 *
 * @author Dark
 */
class Seq_util {
    //put your code here
    
    public static  function  getNextseq($table){
        
           $query= get_instance()->db->query("select nextval('$table') as value");
          $row = $query->row();
        return  $row->value;
    }
     public static  function  getcurent($table){
        
           $query= get_instance()->db->query("select s_value  from sequences where s_name ='$table'");
          $row = $query->row();
        return  $row->s_value;
    }
}

?>
