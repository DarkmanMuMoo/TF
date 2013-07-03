<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of listener
 *
 * @author Dark
 */
class Listener {

    //put your code here

    public function presystem() {

        include './application/third_party/ChromePhp.php';
        spl_autoload_register(function ($class) {

                    $dao = './application/models/dao/' . strtolower($class) . '.php';
                    $obj = './application/models/obj/' . strtolower($class) . '.php';
                    if (file_exists($dao)) {
                        require_once $dao;
                    } else if (file_exists($obj)) {
                        require_once $obj;
                    }
                });

        session_start();
        ChromePhp::log('session..init');
        //  ChromePhp::log(get_class(get_instance()));
    }

    public function post_controller_constructor() {
        $segment = get_instance()->uri->segment(1);
        if ($segment != false && $segment === 'Backend') {

            ChromePhp::log('Backend');
            $controllername = get_class(get_instance());
            if (!isset($_SESSION['commitee'])) {
                if ($controllername != 'usercontrol') {
                    redirect('Backend/usercontrol/login');
                }
            }
        }
    }

}

?>
