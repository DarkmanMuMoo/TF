<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of test
 *
 * @author Dark
 */
class Test extends CI_Controller {

    //put your code here
    public function index() {

        $this->__listmethod();
    }

  
    private function __listmethod() {

        $clasename = get_class(get_instance());

        $methodlist = get_class_methods($clasename);
        foreach ($methodlist as $method_name) {
            if ($method_name[0] != '_' && $method_name != 'get_instance' && $method_name != 'index') {
                echo anchor($clasename . '/' . $method_name, $method_name) . '<br>';
            }
        }
    }
public function testsessionExpire(){
    
   var_dump($_COOKIE);
    
}
    public function __construct() {
        parent::__construct();
        $this->load->library('unit_test');
    }
  public function testsentmail(){
      
     $this->load->library('emailutil');
       
        $to = 'darkmanmumoonaja@gmail.com';
        $this->emailutil->sendemail($this->emailutil->getServerconfig(), $this->config->item('admin_email'), $to, 'TFace_contest', 'test');
        ChromePhp::log($this->emailutil->getDebugmessage());
  }
    public function testRenderPdf() {
        $this->load->helper('file');
        $pdf = read_file('./uploads/Font/TF-0001-Fo-0001.pdf');
        $this->output->set_content_type('application/pdf');
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
        $this->output->set_header("Pragma: no-cache");
        $this->output->set_header('Expires: 0');
        $this->output->set_output($pdf);
    }

    public function testnextvalfunction() {
        $query = $this->db->query("select nextval('font') as value");
        $row = $query->row();
        var_dump($row);
    }

    public function viewsession() {
        var_dump($_SESSION);
    }

    public function testtimestamp() {

        echo date('Y-m-d h:i:s');
    }

    public function test() {
        /* session_start();
          ChromePhp::log('session start');
          if(isset($_SESSION['user'])){

          echo 'found';
          }else{

          echo 'not found';
          } */
        $this->load->helper('security');
        echo do_hash('darkman55#');
    }

    public function testfilename() {
       
      // echo read_file('./uploads/Font/TF-0001-Fo-0001.pdf');
  var_dump(pathinfo('./uploads/Font/TF-0001-Fo-0001.pdf'));
    }

    public function testupload() {


        print_r($_FILES);
        print_r($_POST);
        $this->load->view('testupload');
    }

    public function daotest() {
        echo sprintf('User-%04d', 5);
    }

    public function test_mailtemplate() {
        $this->load->library('parser');

        $data = array(
            'name' => 'test',
            'lastname' => 'test',
            'username' => 'test',
            'password' => 'sfdsfsdf',
            'go_back_link' => anchor('home')
        );

        $this->parser->parse('mail_template/registration_complete.html', $data);
    }

}

?>
