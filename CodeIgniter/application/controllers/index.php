<?php if(!defined('BASEPATH')) exit('No direct script access allowed..');
/*************************************************************************
	> File Name: index.php
	> Author: sprink
	> Mail: tangjing951@gmail.com 
	> Created Time: 2013年08月21日 星期三 14时23分16秒
 ************************************************************************/

class Index extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        $this->load->view('index');
    }
}
?>
