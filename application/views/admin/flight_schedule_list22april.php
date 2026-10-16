<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>KazinDMC CRM</title>
    <?php include('admin_head_css.php');?>

</head>
<!-- END HEAD -->

<body
    class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md header-white dark-sidebar-color logo-dark">
    <div class="page-wrapper">
        <!-- start header -->
        <?php include('header.php');?>
        <!-- end header -->
        <!-- start page container -->
        <div class="page-container">
            <!-- start sidebar menu -->
            <?php include('side_bar.php');?>
            <!-- end sidebar menu -->
            <!-- start page content -->
            <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title">All Flight Schedule List</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                        href="<?=base_url();?>dashboard">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">All Flight Schedule List</li>
                            </ol>
                        </div>
                    </div>
                    <?php echo $this->session->flashdata('message'); unset($_SESSION['message']); ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-box">
                                <div class="card-head">
                                    <header>All Flight Schedule List</header>
                                    <div class="tools">
                                        <a href="add-flight-schedule" class="btn btn-success" style="padding: 6px;"><i class="fa fa-plus"></i> Add Flight Schedule</a>
                                        <a href="add-flight" class="btn btn-success" style="padding: 6px;"><i class="fa fa-plus"></i> Add New</a>
	                                    <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <form method="get">
                                        <div class="row">
                                            <div class="col-lg-1">
                                                <h4>Search</h4>
                                            </div>
                                            <div class="col-lg-2">
                                                 <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <?php echo form_input(['name'=>'flight_number','id'=>'','class'=>'mdl-textfield__input','value'=>($this->input->get('flight_number')<>'')?$this->input->get('flight_number'):''])?>
                                                    <label class="mdl-textfield__label">Flight Number</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <?php echo form_submit(['name'=>'submit','id'=>'submit', 'class'=>'btn btn-md btn-primary', 'value'=>'Search']);?>
                                                     <a href="<?php echo base_url('all-flight-schedule'); ?>" class="btn btn-md btn-danger">Clear</a>
                                                </div>
                                            </div>
                                           
                                        </div>
                                    </form>
                                    <div class="table-scrollable">
                                        <table class="table table-hover table-checkable order-column full-width" id="">
                                            <thead>
                                                <tr>
                                                    <th class="center">Sr.No</th>
                                                    <th class="center">Airline Name</th>
                                                    <th class="center">Code</th>
                                                    <th class="center">Flight Number</th>
                                                    <th class="center">Departure Airport / City</th>
                                                    <th class="center">Departure Time</th>
                                                    <th class="center">Arrival Airport / City</th>
                                                    <th class="center">Arrival Time</th>
                                                    <th class="center">Days Of Operations</th>
                                                    <th class="center">Status</th>
                                                    <th class="center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php                                            
                                            $super_admins = ['rohit@kazindmc.com','pankaj@thavertech.com'];
                                            if(!empty($result)) {
                                                 $i=$offset+1;
                                            foreach($result as $list) {

                                            ?>
                                                <form method="post">
                                                    <tr class="odd gradeX">
                                                        <td class="center"><?=$i++?></td>
                                                        <td class="center"><?=$list->name?></td>
                                                        <td class="center"><?=$list->code?></td>
                                                        <td class="center"><?=$list->flight_number?></td>
                                                        <td class="center"><?=$list->departure_airport.' / '.$list->departure_city ?></td>
                                                        <td class="center"><?=$list->departure_time ?></td>
                                                        <td class="center"><?=$list->arrival_airport.' / '.$list->arrival_city ?></td>
                                                        <td class="center"><?=$list->arrival_time ?></td>
                                                        <td class="center"><?=$list->days_of_operations ?></td>
                                                        <td class="center"><?=ucfirst($list->status) ?></td>
                                                        <td class="center"  style="display:flex;">
                                                            <a href="<?php echo base_url('edit-flight-schedule?id='.base64_encode($list->id)); ?>" class="btn btn-tbl-edit btn-xs" title="Edit"><i class="fa fa-edit"></i></a> 
                                                            <!--a href="<?php //echo base_url('delete-flight-schedule?id='.base64_encode($list->id)); ?>" onclick="return confirm('Are you sure you want to delete this Flight Schedule?');" class="btn btn-tbl-delete btn-xs" title="Delete"><i class="fa fa-trash-o "></i></a-->
                                                            <a href="<?php echo base_url('delete-flight-schedule?id='.base64_encode($list->id).'&flight_num='.base64_encode($list->flight_number).'&airline_id='.base64_encode($list->airline_id)); ?>" onclick="return confirm('Are you sure you want to delete this Flight Schedule?');" class="btn btn-tbl-delete btn-xs" title="Delete"><i class="fa fa-trash-o "></i></a>
                                                        </td>
                                                    </tr>
                                                </form>
                                                <?php } }?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-12 dataTables_paginate paging_simple_numbers" id="">
                                    <?php //echo 'Showing '.$records_cnt.' of '.$total.' Records'; ?>
                                    <?php echo $links; ?></div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- end page content -->
        </div>
        <!-- end page container -->
        <!-- start footer -->
        <?php include('admin_footer.php');?>
        <!-- end footer -->
    </div>
    <!-- start js include path -->
    <?php include('admin_footer_js.php');?>
        <!-- end js include path -->
</body>
</html>