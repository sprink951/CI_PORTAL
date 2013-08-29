<?php if(!defined('BASEPATH')) exit('No direct script access allowed..');
/*************************************************************************
	> File Name: models/portal/m_usertable.php
	> Author: sprink
	> Mail: tangjing951@gmail.com 
	> Created Time: 2013年08月22日 星期四 09时55分17秒
 ************************************************************************/
class M_usertable extends CI_Model
{
    public $table_name;

    function __construct()
    {
        parent::__construct();
        $this->table_name = 'users';
    }

    /********************************************************************
     *从users表中获取数据
     *@acess public
     *******************************************************************/	
    function get_usertable($limit,$offset)
	{
		$usertable = array();
		$result  = $this->m_common->get_page($this->table_name,$limit,$offset);
		
		foreach($result as $users)
		{
			//Get password from
            $id       = $users['id'];        
            $username = $users['username'];
			   $active   = $users['active'];
			   $password = $users['password'];
            $usertable[] = array('id'=>$id,'username'=>$username,'password'=>$password,'active'=>$active);
        }
        //print_r($usertable);
        //$result['usertable'] = $usertable;
        return $usertable;
    }
     /*******************************************************************
     *根据ID获取用户
     *@access public 
     *@return num
     * ****************************************************************/ 
    function get_username_by_id($id)
    {
        $where = array('id'=>$id);
        $result = $this->m_common->get_one($this->table_name,$where);
        return $result;
    }
     /*******************************************************************
     *添加用户
     *@access public 
     *@return num
     * ****************************************************************/    
    function get_total_num()
    {
        return $this->db->count_all_results($this->table_name);
    }
    
    /*******************************************************************
     *添加用户
     *@access public 
     *@param array $info 
     *@return string
     * ****************************************************************/
    function add_user($info=array())
    {
        $where = array('username'=>$info['username']);
        $exist = $this->m_common->get_one($this->table_name,$where);
        if ($exist)
        {
            return 'exist';
        }

        $result = $this->m_common->insert($this->table_name,$info);
        if  ($result)
        return $result['username'];
    }

    /******************************************************************
     * 更新用户
     * @access pubic
     * @param string $post 更新内容
     * @param string $where 更新地点
     * @return num
     * suggest by id 
     * ***************************************************************/
    function update_user($post,$where=array())
    {
        return $this->m_common->update($this->table_name,$post,$where);
    }


    /******************************************************************
     * 删除用户
     * @access public
     * @param string $where
     * @return num
     * ***************************************************************/
    function delete_user($where=array())
    {
        $error = $this->db->delete($this->table_name,$where);
    }
    

}
?>
