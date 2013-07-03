<?php

include APPPATH . 'third_party/recaptchalib.php';
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends CI_Controller {

    public $publickey = "6Lfya90SAAAAAJRgHw7txILaWRfG90bL8ha6gcbs";
    private $privatekey = "6Lfya90SAAAAALKEPcokNbohgrfvduzO0wAS-Xyf";

    // for production 
    // public $publickey = '6LcQyOISAAAAAOyi9xjgRNiSA78V49ihKaWDU9lB';
    // private $privatekey = "6LcQyOISAAAAAKvHELKaoTHY77F-pEn2Y5in7f8B";

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('uploadutil');
        $this->load->library('upload');
    }

    public function index() {
        $this->load->view('Front/home');
    }

    public function checkcaptcha($recaptcha_challenge_field, $recaptcha_response_field) {
        ChromePhp::log('recaptcha_challenge_field' . $recaptcha_challenge_field);
        ChromePhp::log('$recaptcha_response_field' . $recaptcha_response_field);
        $resp = recaptcha_check_answer($this->privatekey, $_SERVER["REMOTE_ADDR"], $recaptcha_challenge_field, $recaptcha_response_field);

        if (!$resp->is_valid) {
            ChromePhp::log($resp->error);

            $this->form_validation->set_message('checkcaptcha', 'invalid captcha');
            return false;
        } else {
            return true;
            // Your code here to handle a successful verification
        }
    }

    public function application() {

        include './application/libraries/Form_util.php';
        $Univer = $this->db->get('university')->result();
        $data['univerdropdown'] = Form_util::dropdownfromlist('univer', $Univer, array("{U_id}", "{U_name}"), '', 'id="univer" class="input-xlarge"');
        $data['captcha'] = recaptcha_get_html($this->publickey);
        $this->load->view('Front/application', $data);
    }

    public function register() {
        include './application/libraries/Seq_util.php';
        $this->load->helper('string');
        $this->load->helper('security');



        $this->form_validation->set_rules('recaptcha_challenge_field', 'Captcha', 'callback_checkcaptcha[' . $this->input->post('recaptcha_response_field') . ']');
        $this->form_validation->set_rules('Email', 'Email', 'required|valid_email|is_unique[user.Email]');


        if ($this->form_validation->run() == FALSE) {

            $this->application();
        } else {
            $user = new User();
            $user->Name = $this->input->post('Name');
            $user->Lastname = $this->input->post('Lastname');
            $user->IDnumber = $this->input->post('ID_Card');
            $user->Email = $this->input->post('Email');
            $user->Address = $this->input->post('address');
            $user->Telephone = $this->input->post('phone');
            $user->Mobile = $this->input->post('mphone');
            $user->Sex = $this->input->post('sex');
            $user->Company = $this->input->post('company');
            $user->Age = $this->input->post('age');
            $user->Facebook = $this->input->post('facebook');

            if (intval($this->input->post('univer')) == 0) {
                $user->University = $this->input->post('otherU');
            } else {
                $query = $this->db->get_where('university', array('U_id' => intval($this->input->post('univer'))));
                $univer = $query->row();
                $user->University = $univer->U_name;
            }
            $nexseq = Seq_util::getNextseq('user');
            $config = array();
            $config['upload_path'] = './uploads/user_img';
            $config['allowed_types'] = 'jpg|png';
            $config['file_name'] = sprintf('TF-%04d', $nexseq);
            $upload = $this->uploadutil->upload($config, 'photo');
            ChromePhp::log('upload' . $upload);
            if ($upload === true) {
                $data = $this->upload->data();
                $user->UserID = $nexseq;
                $user->Username = sprintf('TF-%04d', $user->UserID);
                $visiblepassword = random_string('alnum', 10);
                $user->Password = do_hash($visiblepassword);
                $user->Photo = $data['file_name'];
                $result = User_dao::insert($user);
                //ChromePhp::log(var_dump($user,true)); 
                if ($result === true) {
                    $this->sendmail_form_template($user->Email, 'mail_template/registration_complete.html', array(
                        'name' => $user->Name,
                        'lastname' => $user->Lastname,
                        'username' => $user->Username,
                        'password' => $visiblepassword,
                        'go_back_link' => anchor('home')
                    ));
                }
                $this->load->view('Front/register_complete');
            } else {
                log_message('limit_upload');
                $this->application();
            }
        }
    }

    private function sendmail_form_template($to, $template, $data) {
        $this->load->library('parser');
        $this->load->library('emailutil');
        $content = $this->parser->parse($template, $data, true);

        $this->emailutil->sendemail($this->emailutil->getSmtpconfig(), $this->config->item('admin_email'), $to, 'TFace_contest', $content);
        ChromePhp::log($this->emailutil->getDebugmessage());
    }

    public function checkemail_unavaliable($email) {
        $user = User_dao::findbymultifield_return_one_rows(array('Email' => $email));
        if ($user == null) {
            $this->form_validation->set_message('checkemail_unavaliable', 'ไม่มี Emailนี้ในระบบ');
            return false;
        }
        return true;
    }

    public function ajax_check_email() {

        $result['msg'] = 'คุณสามารถใช้Emailนี้ได้';
        $result['result'] = true;
        $this->form_validation->set_rules('Email', 'Email', 'is_unique[user.Email]');
        if ($this->form_validation->run() == FALSE) {
            $result['msg'] = 'Email นี้มีคนใช้แล้ว';
            $result['result'] = false;
        }

        $this->output->set_content_type('application/json')
                ->set_output(json_encode($result));
    }

    public function resetpassword() {
        $this->load->helper('string');
        $this->load->helper('security');

        $this->form_validation->set_rules('recaptcha_challenge_field', 'Captcha', 'callback_checkcaptcha[' . $this->input->post('recaptcha_response_field') . ']');
        $this->form_validation->set_rules('Email', 'Email', 'required|valid_email|callback_checkemail_unavaliable');
        if ($this->form_validation->run() == FALSE) {
            ChromePhp::log('error');
            $data['captcha'] = recaptcha_get_html($this->publickey);
            $this->load->view('Front/resetpassword', $data);
        } else {
            ChromePhp::log('pass');
            $user = User_dao::findbymultifield_return_one_rows(array('Email' => $this->input->post('Email')));
            $new_visible_password = random_string('alnum', 10);
            $user->Password = do_hash($new_visible_password);
            $result = User_dao::update($user);

            if ($result === true) {
                $this->sendmail_form_template($user->Email, 'mail_template/Reset_password.html', array('new_password' => $new_visible_password));
                $this->session->set_flashdata('Msg', 'password ใหม่ จะถูกส่งไปยัง Emailนี้');
                redirect('home/resetpassword');
            }
        }
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */