<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ScoreReport
 *
 * @author Dark
 */
class ScoreReport  extends CI_Controller{
    //put your code here

    public function index(){

     $data['scorereport'] =Selection_dao::score_report();

     $this->load->view('Back/scorereport', $data);
 }
 public function view_all()
 {
    $data['scorereport'] =Selection_dao::score_report(false);

    $this->load->view('Back/scorereport_all', $data);
}

public function  getdata_chart(){
  $scorereport=Selection_dao::score_report();
  $label=array();
  $value=array();
  foreach ($scorereport as $row) {
   array_push($label, $row->FontCode);
  array_push($value, intval($row->score));
  }
  $this->output->set_content_type('application/json');
  $this->output->set_output(json_encode(array('label'=>$label,'value'=>$value)));

}
}

?>
