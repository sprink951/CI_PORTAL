<?php if(!defined('BASEPATH')) exit('No direct script access allowed..');
/*************************************************************************
	> File Name: index.php
	> Author: sprink
	> Mail: tangjing951@gmail.com 
	> Created Time: 2013年08月21日 星期三 13时02分56秒
 ************************************************************************/

class Index extends CI_Controller
{
    function __construct()
    {
        parent::__construct(); 
    }

    function index()
    {
        //TODO
        $this->load->view('index');
    }
    
    function login()
    { 
        if (strtolower($_SERVER['REQUEST_METHOD']) == 'post')
        {
            //$this->load->helper('my_md5');
            $post['username']=$this->input->post('inputName');
            $post['password']=$this->input->post('inputPasswd');
            
            $action = $this->m_index->login($post);

            if ($action)
            {
                //基于根目录
                redirect('portal/usertable/index');
            }
            else
            {
                 echo 'password or username error.';
                    //密码用户名错误
            }
        }
        $this->load->view('login');
    }

    function logout()
    {
        $this->m_index->logout();
        redirect('portal/index');
    }
}
?>
