<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of usercontrol
 *
 * @author Dark
 */
class usercontrol extends CI_Controller {
    
     private   $logincommitee=null;
    public function __construct() {
        parent::__construct();
         $this->load->library('form_validation');
    }

    public function login(){
        $password=$this->input->post('password');
        $this->form_validation->set_rules('username','user_check','callback_user_check['.$password.']'); 
        if($this->form_validation->run() == false){
            
            $this->load->view('Back/loginview');
        }else{
            
                $_SESSION['commitee']=$this->logincommitee;
                
                redirect('Backend');
        }
        
        
    }
     public function logout(){
        
        session_destroy();
        redirect('Backend/usercontrol/login');
    }
    
    
         public function user_check($username, $password) {
        $this->load->helper('security');
        $committe = null;

        $committe = Committee_dao::findbymultifield_return_one_rows(array('Loginname'=>$username));
        
        if ($committe == null) {

            $this->form_validation->set_message('user_check', 'username หรือ password ไม่ถุกต้อง');
            return FALSE;
        } else if ($committe->Password != do_hash($password)) {

            $this->form_validation->set_message('user_check', 'username หรือ password ไม่ถุกต้อง');
            return FALSE;
        } else {
            $this->logincommitee=$committe;
            return TRUE;
        }
    }
    //put your code here
}

?>
