<?php if(!defined('BASEPATH')) exit('No direct script access allowed..');
/*************************************************************************
	> File Name: m_common.php
	> Author: sprink
	> Mail: tangjing951@gmail.com 
	> Created Time: 2013年08月21日 星期三 10时03分22秒
 ************************************************************************/

/************************************************************************
 * 公共模型
 * **********************************************************************/
class M_common extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
   
   /***********************************************************************
    *获取单条数据
    *@access public
    *@param  string  $table 表名
    *@param  array   $where 条件数组
    *@param  string  $fields查询字段
    *@return array          一维数组
    **********************************************************************/

    function get_one($table,$where=array(),$fields='*')
    {
        if ($where)
        {
            $this->db->where($where);
        }
        return $this->db->select($fields)->from($table)->get()->row_array();
    } 

   /**********************************************************************
    *获取多条数据
    *@access public
    *@param  string  $table 表名
    *@param  string  $fields查询字段
    *@return array          一维数组
    **********************************************************************/
    
    function get_all($table,$where=array(),$fields='*')
    {
        if ($where)
        {
            $this->db->where($where);
        }
        return $this->db->select($fields)->from($table)->get()->result_array();
    }

    /*********************************************************************
     * 获取每页记录数
     * @access pbulic
     * @param  string $limit   
     * @param  string $offset
     * @return arrary
     * *******************************************************************/
    
    function get_page($table,$limit=0,$offset=0,$fields='*')
    {
        $this->db->select($fields);
        $result = $this->db->get($table,$limit,$offset);
        return $result->result_array();
    }

    /**********************************************************************
    *获取多条数据剔除重复部分
    *@access public
    *@param  string  $table 表名
    *@param  array   $where 条件数组
    *@param  string  $fields查询字段
    *@return array          一维数组
    **********************************************************************/
    function get_all_distinct($table,$field='*') 
    {
        $this->db->select($field);
        $this->db->distinct();
        $this->db->from($table);
        return $this->db->get()->result_array();
    }    

    function get_total_num($table){
        return $this->db->count_all_results($table);
    }
       
   /**********************************************************************
    *添加数据
    *@access public
    *@param  string  $table 表名
    *@param  array   $post  数据数组
    *@return num            添加的记录ID
    **********************************************************************/
    
    function insert($table, $post)
    {
        $this->db->insert($table,$post);
        return $this->db->insert_id();
    }

   /**********************************************************************
    *删除数据
    *@access public
    *@param  string  $table 表名
    *@param  array   $where 条件数组
    *@return num            影响行数
    **********************************************************************/

    function delete($table,$where)
    {
        $this->db->delete($table,$where);
        return $this->db->affected_rows();
    }

   /**********************************************************************
    *更新数据
    *@access public
    *@param  string  $table 表名
    *@param  array   $post  数据数组
    *@param  array   $where 条件数组
    *@return num            影响行数
    **********************************************************************/

    function update($table,$post,$where=array())
    {
        if($where)
        {
            $this->db->where($where);
        }
        $this->db->update($table,$post);
        return $this->db->affected_rows();
    } 
}
?>
