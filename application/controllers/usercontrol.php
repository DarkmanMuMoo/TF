<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of login
 *
 * @author Dark
 */
class Usercontrol extends CI_Controller {
    //put your code here
    
    private   $loginuser=null;
    public function __construct() {
        parent::__construct();
         $this->load->library('form_validation');
    }

    public function  login(){
        
        $password=$this->input->post('password');
         $this->form_validation->set_rules('username','user_check','callback_user_check['.$password.']');
         
        if($this->form_validation->run()== false){
           
            $this->session->set_flashdata('Msg',$this->form_validation->error_string(' ', ' '));
            
        }else{
           
            $_SESSION['user']=$this->loginuser;
          
        }
        
        redirect('home');
    }
    public function logout(){
        
        session_destroy();
        redirect('typeface');
    }
    
     public function user_check($username, $password) {
        $this->load->helper('security');
        $user = null;

        $user = User_dao::findbymultifield_return_one_rows(array('Username'=>$username));
         
        if ($user == null) {

            $this->form_validation->set_message('user_check', 'username หรือ password ไม่ถุกต้อง');
            return FALSE;
        } else if ($user->Password != do_hash($password)) {

            $this->form_validation->set_message('user_check', 'username หรือ password ไม่ถุกต้อง');
            return FALSE;
        } else {
            $this->loginuser=$user;
            return TRUE;
        }
    }
}

?>
