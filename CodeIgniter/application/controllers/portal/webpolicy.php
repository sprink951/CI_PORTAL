<?php if(!defined('BASEPATH')) exit('No direct script access allowed..');
/*************************************************************************
	> File Name: controllers/portal/webauth.php
	> Author: sprink
	> Mail: tangjing951@gmail.com 
	> Created Time: 2013年08月21日 星期三 15时32分47秒
    ************************************************************************/
class Webpolicy extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('portal/m_webpolicy');

    }

    function index()
    {
	   $session = $this->m_index->get_session();
      if (!$session['admin_login_time'])
      {
        	 redirect('index');
      }	
      else {	
		   $this->load->view('webpolicy/policy_up');
         $this->load->view('webpolicy/policy_mid');
		   $this->load->view('webpolicy/policy_low');
		   $session = $this->m_index->get_session();
      }
    }
	
	function contains()
	{
		$tmp['rows'] = $this->m_webpolicy->trans_array();
		
		echo json_encode($tmp['rows']);
	}
	
	function delete()
	{
		$profile = $_POST['profile'];
		$group = $this->m_webpolicy->getgroup($profile);
		foreach ($group->result() as $row)
		{
		   $groupname = $row->groupname;
		}
		$sql= $this->m_webpolicy->delgroup($groupname);
		$result = true;
		if ($result)
		{
			echo json_encode(array('success'=>true));
		} else {
			echo json_encode(array('msg'=>'Some errors occured.'));
		}
	}
	
	
	function saveuser()
	{
		$usergroup['username'] = $_REQUEST['profile'];
		$usergroup['groupname'] = $_REQUEST['groupname'];
		$radgroupcheck[0]['groupname'] = $usergroup['groupname'];
		$radgroupcheck[0]['attribute'] = 'FHM-Reset-Type';
		$radgroupcheck[0]['op'] = ':=';
		$radgroupcheck[0]['value'] = $_REQUEST['FHM-Reset-Type'];
		
		$radgroupcheck[1]['groupname'] = $usergroup['groupname'];
		$radgroupcheck[1]['attribute'] = 'Login-Time';
		$radgroupcheck[1]['op'] = ':=';
		$radgroupcheck[1]['value'] = $_REQUEST['Login-Time'];
		
		$radgroupcheck[2]['groupname'] = $usergroup['groupname'];
		$radgroupcheck[2]['attribute'] = 'FHM-Total-Time';
		$radgroupcheck[2]['op'] = ':=';
		$radgroupcheck[2]['value'] = $_REQUEST['FHM-Total-Time'];
		
		$radgroupreply[0]['groupname'] = $usergroup['groupname'];
		$radgroupreply[0]['attribute'] = 'ChilliSpot-Bandwidth-Max-Up';
		$radgroupreply[0]['op'] = ':=';
		$radgroupreply[0]['value'] = $_REQUEST['ChilliSpot-Bandwidth-Max-Up'];
		
		$radgroupreply[1]['groupname'] = $usergroup['groupname'];
		$radgroupreply[1]['attribute'] = 'ChilliSpot-Bandwidth-Max-Down';
		$radgroupreply[1]['op'] = ':=';
		$radgroupreply[1]['value'] = $_REQUEST['ChilliSpot-Bandwidth-Max-Down'];
		
		$radgroupreply[2]['groupname'] = $usergroup['groupname'];
		$radgroupreply[2]['attribute'] = 'WIPr-Session-Terminate';
		$radgroupreply[2]['op'] = ':=';
		$radgroupreply[2]['value'] = $_REQUEST['WIPr-Session-Terminate'];
		
		$this->m_webpolicy->insert('radusergroup',$usergroup);
		
		foreach($radgroupcheck as $row)
		{
			$this->m_webpolicy->insert('radgroupcheck',$row);
		}
		
		foreach($radgroupreply as $row)
		{
			$this->m_webpolicy->insert('radgroupreply',$row);
		}
		
		$result = true;
		if ($result)
		{
			echo json_encode(array('success'=>true));
		} else {
			echo json_encode(array('msg'=>'Some errors occured.'));
		}
	}
	
	function updateuser()
	{
		$usergroup['username'] = $_REQUEST['profile'];
		$usergroup['groupname'] = $_REQUEST['groupname'];
		$radgroupcheck[0]['groupname'] = $usergroup['groupname'];
		$radgroupcheck[0]['attribute'] = 'FHM-Reset-Type';
		$radgroupcheck[0]['op'] = ':=';
		$radgroupcheck[0]['value'] = $_REQUEST['FHM-Reset-Type'];
		
		$radgroupcheck[1]['groupname'] = $usergroup['groupname'];
		$radgroupcheck[1]['attribute'] = 'Login-Time';
		$radgroupcheck[1]['op'] = ':=';
		$radgroupcheck[1]['value'] = $_REQUEST['Login-Time'];
		
		$radgroupcheck[2]['groupname'] = $usergroup['groupname'];
		$radgroupcheck[2]['attribute'] = 'FHM-Total-Time';
		$radgroupcheck[2]['op'] = ':=';
		$radgroupcheck[2]['value'] = $_REQUEST['FHM-Total-Time'];
		
		$radgroupreply[0]['groupname'] = $usergroup['groupname'];
		$radgroupreply[0]['attribute'] = 'ChilliSpot-Bandwidth-Max-Up';
		$radgroupreply[0]['op'] = ':=';
		$radgroupreply[0]['value'] = $_REQUEST['ChilliSpot-Bandwidth-Max-Up'];
		
		$radgroupreply[1]['groupname'] = $usergroup['groupname'];
		$radgroupreply[1]['attribute'] = 'ChilliSpot-Bandwidth-Max-Down';
		$radgroupreply[1]['op'] = ':=';
		$radgroupreply[1]['value'] = $_REQUEST['ChilliSpot-Bandwidth-Max-Down'];
		
		$radgroupreply[2]['groupname'] = $usergroup['groupname'];
		$radgroupreply[2]['attribute'] = 'WIPr-Session-Terminate';
		$radgroupreply[2]['op'] = ':=';
		$radgroupreply[2]['value'] = $_REQUEST['WIPr-Session-Terminate'];

		$this->m_webpolicy->update('radusergroup',$usergroup,array('groupname'=>$usergroup['groupname']));
		
		foreach($radgroupcheck as $row)
		{
			$where = array('groupname'=>$usergroup['groupname'],'attribute'=>$row['attribute']);
			$this->m_webpolicy->update('radgroupcheck',$row,$where);
		}
		
		foreach($radgroupreply as $row)
		{
			$where = array('groupname'=>$usergroup['groupname'],'attribute'=>$row['attribute']);
			$this->m_webpolicy->update('radgroupreply',$row,$where);
		}
		$result = true;
		if ($result)
		{
			echo json_encode(array('success'=>true));
		} else {
			echo json_encode(array('msg'=>'Some errors occured.'));
		}
	}
}

?>
