<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of typeface
 *
 * @author Dark
 */
class Typeface extends CI_Controller {

    //put your code here
private $nextseq=null;
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index() {
        if (isset($_SESSION['user'])) {
            $this->typeface_page();
        } else {
            redirect('home');
        }
    }

    private function typeface_page() {
        //$this->load->library('pagination');

        $user = $_SESSION['user'];
        $data['typelist'] = Font_dao::findbymultifield(array('UserID' => $user->UserID));
       
        $this->load->view('Front/typeface', $data);
    }

    public function viewtypeface($FontID) {
        if (!isset($_SESSION['user'])) {
            show_error('please Login to apply font ', 500);
            return;
        }
        $typeface = Font_dao::findbyPk($FontID);
        if ($typeface->UserID != $_SESSION['user']->UserID) {
            show_error('insufficient previlege ', 500);
            return;
        }

        $data['typeface'] = $typeface;
        $this->load->view('Front/viewtypeface', $data);
    }

    public function addfont() {
        ChromePhp::log(print_r($_FILES, true));
        if (!isset($_SESSION['user'])) {
            show_error('please Login to apply font ', 500);
            return;
        }
        $this->form_validation->set_rules('fontname', 'fontname', 'required');
        $this->form_validation->set_rules('fontfile', 'fontfile', 'callback_checkupload[fontfile]');
        if ($this->form_validation->run() == FALSE) {

            $this->typeface_page();
        } else {

            $font = new Font();

            $uploadata = $this->upload->data();
            $font->FontID = $this->nextseq;
            $font->FontCode = sprintf('Fo-%04d', $font->FontID);
            $font->Fontname = $this->input->post('fontname');
            $font->Uploadtime = date('Y-m-d h:i:s');
            $font->Description = trim($this->input->post('description'));

            $font->Filelocation = $uploadata['full_path'];


            $font->UserID = $_SESSION['user']->UserID;
            $result = Font_dao::insert($font);
            if ($result == true) {
                $this->typeface_page();
                // var_dump($uploadata);
            }
        }
    }

    public function checkupload($file, $filename) {
        $this->load->library('upload');
        include './application/libraries/Seq_util.php';
        $this->load->library('uploadutil');
        $nexseq = Seq_util::getNextseq('font');
        $config = array();
        $config['upload_path'] = './uploads/Font';
        $config['allowed_types'] = 'pdf';
        $config['file_name'] = $_SESSION['user']->Username . '-' . sprintf('Fo-%04d', $nexseq);
        ChromePhp::log($filename);
        ChromePhp::log('file' . $file);
        $upload = $this->uploadutil->upload($config, $filename);
        if ($upload === true) {
            $this->nextseq = $nexseq;
            return true;
        } else {

            ChromePhp::log($upload);
            $this->form_validation->set_message('checkupload', $upload);
            return false;
        }
    }

    public function editfontinfo() {
        if (!isset($_SESSION['user'])) {
            show_error('please Login to do any futhure ', 500);
            return;
        }
        $updateFont = Font_dao::findbyPk($this->input->post('FontID'));
        if ($updateFont == null || $_SESSION['user']->UserID != $updateFont->UserID) {

            show_error('insufficint Previlege ', 500);
            return;
        }
        $updateFont->Fontname = $this->input->post('fontname');
        $updateFont->Description = $this->input->post('description');
        $updateFont->Lasteditedtime = date('Y-m-d h:i:s');

        $result = Font_dao::update($updateFont);
        if ($result === true) {

            $this->viewtypeface($this->input->post('FontID'));
        }
    }

    public function checkchangefile($val, $params) {
        $this->load->library('uploadutil');
        list($fieldname, $filename) = explode(',', $params);
        $config['upload_path'] = './uploads/Font';
        $config['allowed_types'] = 'pdf';
        $config['overwrite']=TRUE;
        $config['file_name'] = $filename;
        $upload = $this->uploadutil->upload($config, $fieldname);
        if ($upload === true) {

            return true;
        } else {
            log_message($upload);
            ChromePhp::log($upload);
            $this->form_validation->set_message('checkupload', $upload);
            return false;
        }
    }

    public function changefile() {
       
        if (!isset($_SESSION['user'])) {
            show_error('please Login to apply font ', 500);
            return;
        }
        $updateFont = Font_dao::findbyPk($this->input->post('FontID'));
        if ($updateFont == null || $_SESSION['user']->UserID != $updateFont->UserID) {

            show_error('insufficint Previlege ', 500);
            return;
        }
        $filename= pathinfo($updateFont->Filelocation);
        
        $this->form_validation->set_rules('fontfile', 'fontfile', 'callback_checkchangefile[fontfile,' . $filename['basename'] . ']');

        if($this->form_validation->run()==true){
        $updateFont->Lasteditedtime = date('Y-m-d h:i:s');
        Font_dao::update($updateFont);
       redirect('typeface/viewtypeface/'.$this->input->post('FontID'));
        }
      $this->viewtypeface($this->input->post('FontID'));
      
    }
public function rendertypeface($FontID){
     $this->load->helper('file');
      if (!isset($_SESSION['user'])) {
            show_error('please Login to go futhure ', 500);
            return;
        }
        $typeface = Font_dao::findbyPk($FontID);
        if ($typeface->UserID != $_SESSION['user']->UserID) {
            show_error('insufficient previlege ', 500);
            return;
        }
        
        
        $pdf = read_file($typeface->Filelocation);
        $this->output->set_content_type('application/pdf');
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
        $this->output->set_header("Pragma: no-cache");
        $this->output->set_header('Expires: 0');
        $this->output->set_output($pdf);
    
}
}

?>
