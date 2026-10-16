<?php $users_modules_mapping = [
    '1' => ['database', 'query-board', 'reports', 'arrival-chart', 'party-bus', 'itinerary-masters', 'restaurants-master', 'restaurants-menu-master', 'hotels', 'currency', 'live-tracking'],
    '2' => ['database','party-bus','query-board', 'arrival-chart', 'itinerary-masters', 'restaurants-master', 'restaurants-menu-master', 'hotels', 'live-tracking'],
    '3' => ['database', 'arrival-chart', 'query-board', 'reports', 'party-bus', 'itinerary-masters', 'restaurants-master', 'restaurants-menu-master', 'hotels', 'currency', 'live-tracking'],
    '4' => ['arrival-chart', 'party-bus', 'itinerary-masters', 'restaurants-master', 'restaurants-menu-master', 'hotels', 'live-tracking'],
    '5' => ['database', 'query-board', 'arrival-chart', 'currency', 'live-tracking'],
    '6' => ['database', 'query-board', 'arrival-chart', 'live-tracking']
]; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-name" content="<?= $this->security->get_csrf_token_name(); ?>">
    <meta name="csrf-hash" content="<?= $this->security->get_csrf_hash(); ?>">


    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?=base_url();?>assets/images/login-logo.png">
    <title>KAZIN CRM</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css"
        href="<?=base_url();?>assets/node_modules/datatables.net-bs4/css/responsive.dataTables.min.css">
            
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script> -->

 <!-- select2 -->
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" /> -->
    <!-- Font Awesome 5 -->
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet"> -->

    <!-- select2-bootstrap4-theme -->
    <!-- <link href="https://raw.githack.com/ttskch/select2-bootstrap4-theme/mas/ter/dist/select2-bootstrap4.css"  rel="stylesheet"> -->
       
        <!-- for live demo page -->
    <!-- <link href="select2-bootstrap4.css" rel="stylesheet"> -->
    <link href="<?=base_url();?>assets/dist/css/pages/login-register-lock.css" rel="stylesheet">
	<link href="<?=base_url();?>assets/dist/css/style.min.css" rel="stylesheet">
    <link href="<?=base_url();?>assets/css/form_input.css" rel="stylesheet">
   <!-- chartist CSS -->
    <link href="<?=base_url();?>assets/node_modules/morrisjs/morris.css" rel="stylesheet">
    <!--Toaster Popup message CSS -->
    <link href="<?=base_url();?>assets/node_modules/toast-master/css/jquery.toast.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
    <!-- Dashboard 1 Page CSS -->
    <link href="<?=base_url();?>assets/dist/css/pages/dashboard1.css" rel="stylesheet">
    <link rel="stylesheet" href="<?=base_url();?>assets/dist/css/extra.css">
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <!-- <link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/gh/djibe/material@4.6.2-1.0/css/material-plugins.min.css" rel="stylesheet"> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>	
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <style> 
    .img-width {
        max-width: 80px;
    }

    #file {
        max-height: 200px;
        /* Adjust height as needed */
        overflow-y: auto;
    }

    .page-bar{
        background-color: transparent !important;
    }

    p{
        color: white !important;
        margin: 85px !important;
    }

    .custom-link {
        font-size: 35px;
        color: black;
        margin-left: 40px;
    }

    /* Hover state */
    .custom-link:hover {
        color: green; /* Change text color on hover */
        text-decoration: none; /* Remove underline */
    }
    .only-for-dashbord {
        display: flex;
        justify-content: end;
        align-items: center;
    }

    .only-for-dashbord ul {
        display: flex;
        margin-bottom: 0;
        column-gap: 20px;
    }

    .only-for-dashbord ul li {
        list-style: none !important;
    }

    .only-for-dashbord ul li a {
        color: #005559;
        font-weight: 800;
        text-transform: uppercase;
    }

    .dataTables_filter>label input{
        border:none !important;
        padding:0 !important;
    }
    .dataTables_filter>label:before{
        display: none !important;
    }


    @media screen and (max-width:991px) {
        .only-for-dashbord {
            justify-content: center;
            padding-top: 13px;
            margin-top: 8px;
            order: 2;
            border-top: solid 14px #ecf0f4;
        }

        .only-for-dashbord ul {
            padding: 0 !important;
        }
    }

    @media screen and (max-width:575px) {
        .only-for-dashbord ul {
            justify-content: space-between;
            width: 80%;

        }

        .only-for-dashbord ul li a {
            font-size: 12px;
            font-weight: 600;
        }

        .only-for-dashbord ul li a span {
            width: 100%;
            display: block;
            margin-top: 13px;
        }
    }

    @media screen and (max-width:575px) {

        .only-for-dashbord ul li a {
            font-size: 12px;
            font-weight: 600;
        }

        .only-for-dashbord ul {
            justify-content: space-between;
            width: 95%;
        }
    }

    @media screen and (max-width:479px) {
        .only-for-dashbord ul li a img {
            max-width: 80px !important;
        }
    }

    a.btn.active_link{
        border-radius: 20px;
        width: 160px;
        font-size: x-small;
    }

    a.btn.btn-warning.waves-effect{
        border-radius: 20px;
        width: 160px;
        font-size: x-small;
    }

    a.btn.btn-dark.waves-effect{
        border-radius: 20px;
        width: 160px;
        font-size: x-small;
    }
    
    a.btn.btn-info.waves-effect{
        border-radius: 20px;
        width: 160px;
        font-size: x-small;
    }

    a.btn.btn-primary.waves-effect{
        border-radius: 20px;
        width: 160px;
        font-size: x-small;
    }
    .only-for-dashbord{
        justify-content: center;
        padding-top: 0px !important;
        margin-top: 0px !important;
        border-top: solid 0px #ecf0f4 !important;
    }
</style>

</head>
<body class="skin-megna fixed-layout" style="font-size:12px;">
    <?php $this->load->view('admin/header-new'); ?>

    <div id="main-wrapper">
        <?php $this->load->view('admin/side_bar'); ?>
        <?php $this->load->view($content); ?>
    </div>

    <?php $this->load->view('admin/admin_footer'); ?>
</body>
</html>
<script>
  $(document).ready(function() {
      $('#config-table').DataTable();
  });

  $(document).ready(function(){
    $('.close').click(function(){
        $('#myModal').modal('hide');
    });
});
</script>
