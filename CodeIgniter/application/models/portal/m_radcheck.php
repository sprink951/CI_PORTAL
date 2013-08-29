<?php if(!defined('BASEPATH')) exit('No direct script access allowed..');
/*************************************************************************
	> File Name: models/portal/m_radcheck.php
	> Author: sprink
	> Mail: tangjing951@gmail.com 
	> Created Time: 2013年08月22日 星期四 17时08分06秒
 ************************************************************************/
class M_radcheck extends CI_Model
{
    public $table_name;
    function __construct()
    {
        parent::__construct();
        $this->table_name='radcheck';
    }

    /*******************************************************************
     *添加用户
     *@access public 
     *@param array $info 
     *@return string
     * ****************************************************************/
    function get_value($where = array())
    {
    	 $fields = 'value';
       $result = $this->m_common->get_one($this->table_name,$where,$fields); 
       return $result['value']; 	
    }     
    
    
    function add_user($info=array())
    {
        $result = $this->m_common->insert($this->table_name,$info);
        return $result;
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
        return $this->db->delete($this->table_name,$where);
    } 
}
?>
