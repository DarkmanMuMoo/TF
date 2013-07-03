<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of thailand_util
 *
 * @author Dark
 */
class thailand_util {
    //put your code here


   
  public static function dropdownprovince( $tablename,$name='',$extra=''){
      
      $CI =&get_instance(); 
      $CI->load->helper('form');
      $query = $CI->db->get($tablename);
      $array = array();
      $array[0]='--กรุณาเลือกจังหวัด--';
        foreach ($query->result() as  $row) {
           $array[$row->PROVINCE_ID]=$row->PROVINCE_NAME;
        } 
        
        return form_dropdown($name, $array,0, $extra);
  }
  
  
  public static function dropdownamphur($tablename,$provinceID,$name='',$extra=''){
       $CI =&get_instance(); 
      $CI->load->helper('form');
      $CI->db->where('PROVINCE_ID',$provinceID);
      $query = $CI->db->get($tablename);
      $array = array();
      $array[0]='--กรุณาเลือกอำเภอ/เขต--';
        foreach ($query->result() as $row) {
           $array[$row->AMPHUR_ID]=$row->AMPHUR_NAME;
        } 
        
        return form_dropdown($name, $array,0, $extra);
      
      
  }
     public static function dropdowndistrict($tablename,$amphurID,$name='',$extra=''){
       $CI =&get_instance(); 
      $CI->load->helper('form');
      $CI->db->where('AMPHUR_ID',$amphurID);
      $query = $CI->db->get($tablename);
      $array = array();
      $array[0]='--กรุณาเลือกแขวง--';
        foreach ($query->result() as $row) {
           $array[$row->DISTRICT_ID]=$row->DISTRICT_NAME;
        } 
        
        return form_dropdown($name, $array,0, $extra);
      
      
  }
}

?>
