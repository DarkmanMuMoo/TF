<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	http://codeigniter.com/user_guide/general/hooks.html
|
*/
$hook['pre_system'] = array(
                                'class'    => 'Listener',
                                'function' => 'presystem',
                                'filename' => 'listener.php',
                                'filepath' => 'hooks'
                                
                                );
$hook['post_controller_constructor'] = array(
                                'class'    => 'Listener',
                                'function' => 'post_controller_constructor',
                                'filename' => 'listener.php',
                                'filepath' => 'hooks'
                                
                                );

/* End of file hooks.php */
/* Location: ./application/config/hooks.php */