<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of home
 *
 * @author Dark
 */
class Typeface extends CI_Controller {

    //put your code here


    public function index() {
        include APPPATH . 'libraries/Form_util.php';
        $userlist = User_dao::findall();
        $selected = '';
        $data['select_con'] = 0;
        if (isset($_COOKIE['Font_cache_condition'])) {
            $defaultvalue = explode(',', $_COOKIE['Font_cache_condition']);
            $data['text'] = $defaultvalue[0];
            $data['select_con'] = $defaultvalue[2];
            $selected = ($defaultvalue[1] == 0) ? '' : $defaultvalue[1];
        }

        $data['userdropdown'] = Form_util::dropdownfromlist('user', $userlist, array("{UserID}", "{Username} {Name} {Lastname}"), $selected, 'id="user"  class="chzn-select" ');
        $this->load->view('Back/typeface', $data);
    }

    public function ajax_getquery() {

        $this->load->library('pagination');
        $condition = explode(',', $this->input->post('condition'));
        $condition[1] = intval($condition[1]);
        $config['per_page'] = 10;
        $startrow = $this->input->post('startrow');
        $config['total_rows'] = $this->gettotalpage(array('UserID' => $condition[1]), $condition[0], $condition[2], $_SESSION['commitee']->CommitID);
        $this->pagination->setOnclickmethod('App.generatequery');
        $this->pagination->initialize($config);
        $this->db->limit($config['per_page'], $startrow);
        $userlist = Font_dao::joinuser(array('UserID' => $condition[1]), $condition[0], $condition[2], $_SESSION['commitee']->CommitID);
        $this->output->set_content_type('application/json')
                ->set_output(json_encode(array('index' => $startrow, 'link' => $this->pagination->create_onclick_links(), 'data' => $userlist)));
    }

    private function gettotalpage($condition, $keyword, $select_con, $CommitID) {


        $this->db->select("COUNT(*) AS Countrow");
        $this->db->from('font');
        $this->db->join('user', 'user.UserID=font.UserID');
        if ($keyword != '') {
            $where = "(font.FontCode like '%$keyword%'
                or  font.Fontname like '%$keyword%'  or   font.Lasteditedtime like '%$keyword%' )";
            $this->db->where($where);
        }
        if ($condition['UserID'] != 0) {
            $this->db->where('user.UserID', $condition['UserID']);
        }
        if ($select_con != 0) {

            switch ($select_con) {
                case 1:
                    $this->db->where("font.FontID NOT IN (select FontID from selection where CommitID = $CommitID)", NULL, FALSE);

                    break;
                case 2:
                    $this->db->where("font.FontID  IN (select FontID from selection where CommitID = $CommitID )", NULL, FALSE);

                    break;
                case 3:
                    $this->db->where("font.FontID NOT IN (select FontID from selection)", NULL, FALSE);


                    break;
            }
        }

        $query = $this->db->get();
        if ($query->num_rows() == 0)
            return 0;


        return $query->row()->Countrow;
    }

    public function rendertypeface($FontID) {
        $this->load->helper('file');

        $typeface = Font_dao::findbyPk($FontID);

        $pdf = read_file($typeface->Filelocation);
        $this->output->set_content_type('application/pdf');
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
        $this->output->set_header("Pragma: no-cache");
        $this->output->set_header('Expires: 0');
        $this->output->set_output($pdf);
    }

    public function viewtypeface($FontID) {

        $typeface = Font_dao::findbyPk($FontID);
        if ($typeface == null) {

            show_error('invalid operation ', 500);
        }
        $user = User_dao::findbymultifield_return_one_rows(array('UserID' => $typeface->UserID));
        $data['username'] = $user->Username . '  ' . $user->Name . '  ' . $user->Lastname;
        $data['typeface'] = $typeface;
        $data['canmark'] = $this->canmark($FontID, $_SESSION['commitee']->CommitID);
        $this->load->view('Back/viewtypeface', $data);
    }

    private function canmark($FontID, $CommitID) {
        $canmark = true;
        $result = Selection_dao::findbymultifield_return_one_rows(array('FontID' => $FontID, 'CommitID' => $CommitID));
        if ($result != null) {
            $canmark = false;
        }

        return $canmark;
    }

    public function marktypeface($FontID) {
        include './application/libraries/Seq_util.php';
        $committeid = $_SESSION['commitee']->CommitID;
        $typeface = Font_dao::findbyPk($FontID);
        if ($typeface == null) {

            show_error('invalid operation ', 500);
        }

        $selection = new Selection();
        $selection->CommitID = $committeid;
        $selection->FontID = $typeface->FontID;
        $selection->SelectionCode = Seq_util::getNextseq('selection');
        $result = Selection_dao::insert($selection);
        $_SESSION['commitee']->SelectionRemain = $_SESSION['commitee']->SelectionRemain - 1;

        $result = $result && Committee_dao::update($_SESSION['commitee']);
        if ($result == true) {
            redirect("Backend/typeface/viewtypeface/$FontID");
            // var_dump($uploadata);
        }
    }

}

?>
