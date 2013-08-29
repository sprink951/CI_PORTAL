<?php if(!defined('BASEPATH')) exit('No direct script access allowed..');
/*************************************************************************
	> File Name: models/portal/m_webpolicy.php
	> Author: sprink
	> Mail: tangjing951@gmail.com 
	> Created Time: 2013年08月21日 星期三 17时24分36秒
 ************************************************************************/

class M_webpolicy extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function add($post)
    {
        $exist = $this->m_common->get_one('webpolicy',array('name'=>$post['name']));
        if ($exist)
        {
            return 'exist';
        }
        return $this->m_common->insert('webpolicy',$post);
    }
	
	function insert($table,$data=array())
	{
		return $this->db->insert($table, $data); 
	}
	
    function delgroup($where)
    {
       	$tables = array('radgroupcheck', 'radgroupreply','radusergroup');
		$this->db->where('groupname',$where);
		return $this->db->delete($tables);
    }

    function update($table,$data,$where)
    {
		return $this->db->update($table, $data, $where);
		
    }
	
	function getgroup($where)
	{
		$sql = "SELECT * FROM radusergroup WHERE username = ?";
		return $this->db->query($sql,array($where));
	}

	function trans_array()
	{
		$query = $this->db->get('radusergroup');
		$table = array(array());
		$i=0;
		foreach ($query->result() as $row)
		{
			$table[$i]['profile'] = $row->username;
			$table[$i]['groupname'] = $row->groupname;
			$sql = "SELECT * FROM radgroupcheck WHERE groupname = ? UNION SELECT * FROM radgroupreply WHERE groupname = ?";
			$subtable=$this->db->query($sql, array($row->groupname,$row->groupname));
			foreach ($subtable->result() as $r)
			{
				$table[$i][$r->attribute] = $r->value;
			}
			$i++;
		}
		return $table;
	}
	

}
?>
