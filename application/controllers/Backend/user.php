<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of user
 *
 * @author Dark
 */
class User extends CI_Controller {

    //put your code here
    public function index() {
        $data = array();


        $data['select_con'] = 0;
        if (isset($_COOKIE['User_cache_condition'])) {
            $defaultvalue = explode(',', $_COOKIE['User_cache_condition']);
            $data['text'] = $defaultvalue[0];
            $data['selected'] = $defaultvalue[1];
        }
        $this->load->view('Back/user', $data);
    }

    public function ajax_getquery() {

        $this->load->library('pagination');
        $condition = explode(',', $this->input->post('condition'));
        $condition[1] = intval($condition[1]);
        $config['per_page'] = 10;
        $startrow = $this->input->post('startrow');
        $config['total_rows'] = $this->gettotalpage(array('Sex' => $condition[1]), $condition[0]);
        $this->pagination->setOnclickmethod('App.generatequery');
        $this->pagination->initialize($config);
        $this->db->limit($config['per_page'], $startrow);
        $userlist = User_dao::Query_user(array('Sex' => $condition[1]), $condition[0]);
        // var_dump( $condition[1] );
        //  var_dump( $this->db->last_query() );
        $this->output->set_content_type('application/json')
                ->set_output(json_encode(array('index' => $startrow, 'link' => $this->pagination->create_onclick_links(), 'data' => $userlist)));
    }

    private function gettotalpage($condition, $keyword) {
        $this->db->select("COUNT(*) AS Countrow");
        $this->db->from('user');
        if ($keyword != '') {
            $where = "(Username like '%$keyword%'
                or  name like '%$keyword%'  or   Lastname like '%$keyword%' )";
            $this->db->where($where);
        }
          if ($condition['Sex'] != 0) {
            switch ($condition['Sex']) {
                case 1:
                    $value = 'M';
                    break;
                case 2:
                    $value = 'F';
                    break;
            }
            $this->db->where('Sex', $value);
        }
        $query = $this->db->get();
        if ($query->num_rows() == 0)
            return 0;


        return $query->row()->Countrow;
    }

    
    public function viewuser($UserID){
        
        $user= User_dao::findbyPk($UserID);
          if ($user == null) {

            show_error('invalid operation ', 500);
        }
        $data['user']=$user;
        $this->load->view('Back/viewuser',$data);
    }
}

?>
