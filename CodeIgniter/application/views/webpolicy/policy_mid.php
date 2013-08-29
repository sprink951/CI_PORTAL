    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span2">
          <div class="well sidebar-nav">
            <ul class="nav nav-list">
              <li class="nav-header">Menu list</li>
              <li><a href=<?php echo base_url("portal/usertable/index");?>>userlist</a></li>
              <li><a href="#">webauth</a></li>
              <li class="active"><a href=<?php echo base_url("portal/webpolicy/index");?>>webpolicy</a></li>
              <li><a href="#">vocher</a></li>
              <li class="nav-header"></li>
            </ul>
          </div><!--/.well -->
        </div><!--/span-->
        <div id="div1" class="span10">
	<table id="dg" title="WebPolicy" class="easyui-datagrid" 
			url=<?php echo base_url("portal/webpolicy/contains");?>
			toolbar="#toolbar" pagination="true"
			rownumbers="true" fitColumns="true" singleSelect="true">
		<thead>
			<tr>
				<th field="profile" width="50">profile</th>
				<th field="FHM-Reset-Type" width="50">Reset-Type</th>
				<th field="Login-Time" width="50">Login-Time</th>
				<th field="FHM-Total-Time" width="50">Total-Time</th>
				<th field="ChilliSpot-Bandwidth-Max-Up" width="50">Bandwidth-Max-Up</th>
				<th field="ChilliSpot-Bandwidth-Max-Down" width="50">Bandwidth-Max-Down</th>
				<th field="WIPr-Session-Terminate" width="50">Session-Terminate</th>
			</tr>
		</thead>
	</table>
    <div  id="toolbar" class="btn-group pull-right">
        <a href="javascript:void(0)" class="btn"  plain="true" onclick="newUser()"><i class="icon-plus">  </i></a>
        <a href="javascript:void(0)" class="btn"  plain="true" onclick="editUser()"><i class="icon-pencil">  </i></a>
        <a href="javascript:void(0)" class="btn"  plain="true" onclick="removeUser()"><i class="icon-trash">  </i></a>
    </div>
	
	<div id="dlg" class="easyui-dialog" style="width:400px;height:280px;padding:10px 20px"
			closed="true" buttons="#dlg-buttons">
		<div class="ftitle">User Information</div>
		<form id="fm" method="post" novalidate>
			<div class="fitem">
				<label>Profile:</label>
				<input name="profile" class="easyui-validatebox" >
			</div>
			<div class="fitem">
				<label>GroupName:</label>
				<input name="groupname" class="easyui-validatebox" >
			</div>
			<div class="fitem">
				<label>Reset-Type:</label>
				<input name="FHM-Reset-Type" class="easyui-validatebox" >
			</div>
			<div class="fitem">
				<label>Login-Time:</label>
				<input name="Login-Time">
			</div>
			<div class="fitem">
				<label>Total-Time:</label>
				<input name="FHM-Total-Time" class="easyui-validatebox" >
			</div>
			<div class="fitem">
				<label>Bandwidth-Max-Up:</label>
				<input name="ChilliSpot-Bandwidth-Max-Up" class="easyui-validatebox" >
			</div>
			<div class="fitem">
				<label>Bandwidth-Max-Down:</label>
				<input name="ChilliSpot-Bandwidth-Max-Down" class="easyui-validatebox">
			</div>
			<div class="fitem">
				<label>Session-Terminate:</label>
				<input name="WIPr-Session-Terminate" class="easyui-validatebox" >
			</div>
		</form>
	</div>
    <div id="dlg-buttons">
        <a href="javascript:void(0)" class="btn" onclick="saveUser()"><i class="icon-ok-sign"></i>&nbsp;Save</a>
        <a href="javascript:void(0)" class="btn" onclick="javascript:$('#dlg').dialog('close')"><i class="icon-remove-sign"></i>Cancel</a>
    </div>
	
	<script type="text/javascript">
		var url;
		function newUser(){
			$('#dlg').dialog('open').dialog('setTitle','New User');
			$('#fm').form('clear');
			url = 'saveuser';
		}
		function editUser(){
			var row = $('#dg').datagrid('getSelected');
			if (row){
				$('#dlg').dialog('open').dialog('setTitle','Edit User');
				$('#fm').form('load',row);
				url = 'updateuser';
			}
		}
		function saveUser(){
			$('#fm').form('submit',{
				url: url,
				onSubmit: function(){
					return $(this).form('validate');
				},
				success: function(result){
					var result = eval('('+result+')');
					if (result.success){
						$('#dlg').dialog('close');		// close the dialog
						$('#dg').datagrid('reload');	// reload the user data
					} else {
						$.messager.show({
							title: 'Error',
							msg: result.msg
						});
					}
				}
			});
		}
		function removeUser(){
			var row = $('#dg').datagrid('getSelected');
			if (row){
				$.messager.confirm('Confirm','Are you sure you want to remove this user?',function(r){
					if (r){
						$.post('delete',{profile:row.profile},function(result){
							if (result.success){
								$('#dg').datagrid('reload');	// reload the user data
							} else {
								$.messager.show({	// show error message
									title: 'Error',
									msg: result.msg
								});
							}
						},'json');
					}
				});
			}
		}
</script>