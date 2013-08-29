<?php if(!defined('BASEPATH')) exit('No direct script access allowed..');
/*************************************************************************
	> File Name: m_index.php
	> Author: sprink
	> Mail: tangjing951@gmail.com 
	> Created Time: 2013年08月21日 星期三 12时43分14秒
    ************************************************************************/

/************************************************************************
 * 后端模型
 * *********************************************************************/
class M_index extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    /******************************************************************
     * 用户登陆
     *
     * @access pbulic
     * @param  array      数组形式验证数据
     * @return boolean    是否成功
     * ***************************************************************/

    function login($post)
    {
        //查找数据库中是否有此列
        $data = $this->m_common->get_one('portal_acct',$post);
        if ($data)
        {
            $session['admin_uid']=$data['id'];
            $session['admin_username']=$data['username'];
            $session['admin_login_time']=date('Y-m-d H:i:s',$_SERVER['REQUEST_TIME']);
            $this->session->set_userdata($session);
            
            $login_time = date('Y-m-d H:i:s',$_SERVER['REQUEST_TIME']);
            $where      = array('username'=>$data['username']);
            $post1 = array('status'=>1,
                           'last_login_time'=>$login_time);
                    
            
            $this->m_common->update('portal_acct',$post1,$where);          
            return TRUE;
        }
        return FALSE;
    }

    /*****************************************************************
     * 获取登陆会话
     *
     * @access public
     * $return array  登陆会话
     * **************************************************************/
    function get_session()
    {
        $session['admin_uid'] = $this->session->userdata('admin_uid');
        $session['admin_username'] = $this->session->userdata('admin_username');
        $session['admin_login_time'] = $this->session->userdata('admin_login_time');
        return $session;
    }

    /******************************************************************
     * 用户注销
     *
     * @access pbulic
     * @return boolean    是否成功
     * ***************************************************************/

    function logout()
    {
    	
    	  $username = $this->session->userdata('admin_username');
        $session['admin_uid'] ='';
        $session['admin_username']='';
        $session['admin_login_time']='';
        $this->session->unset_userdata($session);
        $where      = array('username'=>$username);
        $logout_time = date('Y-m-d H:i:s',$_SERVER['REQUEST_TIME']);
        $post = array('status'=>0,
                       'last_logout_time'=>$logout_time);
                       
        $this->m_common->update('portal_acct',$post,$where); 
        return TRUE;
    }
       
}
?>
