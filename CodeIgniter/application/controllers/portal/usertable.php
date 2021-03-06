<?php if(!defined('BASEPATH')) exit('No direct script access allowed..');
/*************************************************************************
	> File Name: controllers/portal/usertable.php
	> Author: sprink
	> Mail: tangjing951@gmail.com 
	> Created Time: 2013年08月21日 星期三 15时32分47秒
    ************************************************************************/
class Usertable extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('portal/m_usertable');
        $this->load->model('portal/m_radcheck');
       // $this->load->model('portal/m_webpolicy');

    }

   function index()
   {
        $session = $this->m_index->get_session();
        if (!$session['admin_login_time'])
        {
        	   redirect('index');
        }
        else {
            $this->load->view("portal/portal_up");
    	      $this->load->view("portal/portal_mid");
            $this->load->view("portal/portal_low");
        }
	 
	}

    function update_user()
    {
    	 $id = $this->input->post('id');
    	 $username = $this->input->post('username');
    	 $password = $this->input->post('password');
    	 $active   = $this->input->post('active');
    	 $profiles     = $this->input->post('profiles');   	 
       if  ($id <= 0)
       {
       	  echo json_encode(array('errorMsg'=>'id error.'));
    	     return;
       }
    	 $old_username = $this->m_usertable->get_username_by_id($id);
       
       if  (!$old_username)
       {
       	  echo json_encode(array('errorMsg'=>'old username error.'));
    	     return;
       }
    	 //for users
    	 $post_users = array('username'=>$username,
    	  							'password'=>$password,
    	  							'active'=>$active);
    	 $where_users = array('id'=>$id);
       $error = $this->m_usertable->update_user($post_users,$where_users);
       if ($error<0)
       {
       	  echo json_encode(array('errorMsg'=>'Some errors occured in users.'));
    	     return;
       }
       
       //for radcheck password
       $post_radcheck = array('username'=>$username,
                              'value'=>$password);
       $where_radcheck = array('username'=>$old_username['username'],'attribute'=>'Cleartext-Password');
       $error = $this->m_radcheck->update_user($post_radcheck,$where_radcheck);
       
       //for radcheck profile
       $post_radcheck = array('username'=>$username,
                              'value'=>$profiles);
       $where_radcheck = array('username'=>$old_username['username'],'attribute'=>'User-Profile');  
       $error = $this->m_radcheck->update_user($post_radcheck,$where_radcheck);    
       if ($error<0)
       {
       	  echo json_encode(array('errorMsg'=>'Some errors occured radcheck.'.$id));
    	     return;
       }
       echo json_encode(array('success'=>true));
    }
    

	 function get_usertable()
	 {
       $profile = array();	 	
	 	
		 $page  = $this->input->post('page');
		 $rows  = $this->input->post('rows');
		 
		 $offset = ($page-1) * $rows ;
		 $result['total'] = $this->m_usertable->get_total_num();
		 $rows  = $this->m_usertable->get_usertable($rows,$offset);
		 
		 foreach($rows as $data) 
       {
			 $where = array('username'=>$data['username'],'attribute'=>'User-Profile');
			 $profile_name = $this->m_radcheck->get_value($where,'value');
          $profile[] = array('id'=>$data['id'],
                             'username'=>$data['username'],
                             'password'=>$data['password'],
                             'active'=>$data['active'],
                             'profiles'=>$profile_name);
		 } 
		 $result['rows'] = $profile;
		 echo json_encode($result);
	 }


    function create_user()
    {
    	 $id = $this->input->post('id');
    	 $username = $this->input->post('username');//  radcheck users
    	 $password = $this->input->post('password');//  radcheck users
    	 $active   = $this->input->post('active');  //  radcheck users
    	 $profile  = $this->input->post('profiles');//  radcheck 
    	 $user = array('id'=>$id,
    	               'username'=>$username,
    	               'password'=>$password,
    	               'active'=>$active);
    	 $error = $this->m_usertable->add_user($user);
    	 if ($error == 'exist')
    	 {
    	 	   echo json_encode(array('errorMsg'=>'username exist.'));
    	 	   return;
    	 	   
    	 }
    	 else if (intval($error) < 0)    	 
    	 {
    	      echo json_encode(array('errorMsg'=>'Some errors occured.'));
    	      return;
    	 }
    	
       $radcheck[] =  array('username'=>$username,
                          'attribute'=>'Cleartext-Password',
                          'op'=>':=',
                          'value'=>$password);  
       $radcheck[] =  array('username'=>$username,
                           'attribute'=>'FHM-Account-Disabled',
                           'op'=>':=',
                           'value'=>$active);
       $radcheck[] =   array('username'=>$username,
                           'attribute'=>'User-Profile',
                           'op'=>':=',
                           'value'=>$profile);
       foreach($radcheck as $post)
       		$error = $this->m_radcheck->add_user($post);
       if (intval($error) < 0)    	 
    	 {
    	     echo json_encode(array('errorMsg'=>'Some errors occured.'));
			  return;
    	 }	 
    	 
    	 echo json_encode(array('success'=>true)); 
    } 
    
    
    function destroy_user()
    {
    	 $id = $this->input->post('id');
    	 if  ($id <= 0)
       {
       	  echo json_encode(array('errorMsg'=>'id error.'.$id));
    	     return;
       }
       
    	 $old_username = $this->m_usertable->get_username_by_id($id);
       if  (!$old_username)
       {
       	  echo json_encode(array('errorMsg'=>'old username error.'.$id));
    	     return;
       }
       
       $where_users = array('id'=>$id);
       $where_radcheck = array('username'=>$old_username['username']);
       $error = $this->m_usertable->delete_user($where_users);
                   
       $error1 = $this->m_radcheck->delete_user($where_radcheck);

       echo json_encode(array('success'=>true)); 
    } 
    
    function get_profile()
    {
    	 $profile = array();
    	 $count = 0;
       $radusergroup = $this->m_common->get_all('radusergroup');
       foreach($radusergroup as $data)
       {
       	  $profile[] = array('profilevalue'=>$data['username'],'profiletext'=>$data['username']); 
       }       
       
		 echo json_encode($profile);
    }
}

?>
