<?php if(!defined('BASEPATH')) exit('No direct script access allowed..');
/*************************************************************************
	> File Name: controllers/portal/webauth.php
	> Author: sprink
	> Mail: tangjing951@gmail.com 
	> Created Time: 2013年08月21日 星期三 20时06分27秒
 ************************************************************************/
class Webauth extends CI_Controller
{
      function __construct() 
      {
      	parent::__construct();
      }	
      
      function index()
    {
        $this->load->view('portal/portal_up');
        $this->load->view('portal/portal_mid_webauth');
        $this->load->view('portal/portal_low');
	}
}
?>
