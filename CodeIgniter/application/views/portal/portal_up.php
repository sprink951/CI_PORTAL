<!DOCTYPE html>
<html lang="en">
  <head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <meta charset="utf-8">
    <title>ZKCOM</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="sprink" >

    <!-- Le styles -->
	
    <link href='<?=base_url().'css/bootstrap.css'?>' rel="stylesheet">
	 <link href='<?=base_url().'css/bootstrap-responsive.css'?>' rel="stylesheet">
	 <link href='<?=base_url().'easyui/themes/bootstrap/easyui.css'?>' rel="stylesheet">
    <link href='<?=base_url().'easyui/themes/icon.css'?>' rel="stylesheet">
    <script src="<?=base_url().'js/bootstrap.js'?>"></script>
	 <script src='<?=base_url().'easyui/jquery.min.js'?>'></script>
	 <script src='<?=base_url().'easyui/jquery.easyui.min.js'?>'></script>
	 

    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
      .sidebar-nav {
        padding: 9px 0;
      }
	  
	 .table td, .table thead th{
		text-align: center;
		vertical-align: middle;
	  }
	  #footer {
		   position:fixed;
		   left:0px;
		   bottom:10px;
		   height:60px;
		   width:100%;
	}

      @media (max-width: 980px) {
        /* Enable use of floated navbar text */
        .navbar-text.pull-right {
          float: none;
          padding-left: 5px;
          padding-right: 5px;
        }
      }
    </style>

  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="#">ZKCOM</a>
          <div class="nav-collapse collapse">
            <p class="navbar-text pull-right">
               <a href=<?php echo site_url('portal/index/logout');?>  class="navbar-link">logout</a>            </p>
          </div>
          <!--/.nav-collapse -->
        </div>
      </div>
    </div>

    
			 
