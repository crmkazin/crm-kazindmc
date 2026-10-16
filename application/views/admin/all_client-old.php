<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>KazinDMC CRM</title>
<?php include('admin_head_css.php');?> 
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
 </head>
 <!-- END HEAD -->
<body class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md header-white dark-sidebar-color logo-dark">
    <div class="page-wrapper">
        <!-- start header -->
<?php include('header.php'); ?>
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
                                <div class="page-title">Agents</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?=base_url();?>dashboard">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">Agents</li>
                            </ol>
                        </div>
                        
                    </div>			
            <?php echo $this->session->flashdata('message'); unset($_SESSION['message']); ?>
            <div class="row">
                    <div class="col-md-12">
                        <div class="card card-box">
                            <div class="card-head">
                                <header>Add/Remove Column Fields</header>
                                <input type="checkbox" name="" class="view_all"/>
                                <label style="color:#000 !important;font-weight: 500;font-size: 15px !important;">View All</label>
                            </div>
                            <div class="card-body">
                                <div class="row"> 
                                <div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="1" name="oname" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;" checked="checked">
                                        <label for="oname" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Company Name</label>
                                    </div>
                                </div>	
                                
                                <div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="2" name="cperson" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;" checked="checked">
                                        <label for="cperson" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Agent</label>
                                    </div>
                                </div>
						
                                <div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="3" name="cnumber" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;" checked="checked">
                                        <label for="cnumber" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Contact Number</label>
                                    </div>
                                </div>
						
                                <div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="4" name="email" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;" checked="checked">
                                        <label for="email" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Email</label>
                                    </div>
                                </div>
                                
                                <div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="5" name="address" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="address" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Address</label>
                                    </div>
                                </div>
                                
                                <div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="6" name="city" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;" checked="checked">
                                        <label for="city" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">City</label>
                                    </div>
                                </div>
                                <div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="7" name="state" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;" >
                                        <label for="state" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">State</label>
                                    </div>
                                </div>
                                
                                <div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="8" name="country" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;" checked="checked">
                                        <label for="country" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Country</label>
                                    </div>
                                </div>
						
                                <div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="9" name="date" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="date" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Date</label>
                                    </div>
                                </div>
				<div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="10" name="action" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="action" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Designation</label>
                                    </div>
                                </div>		
                                <div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="11" name="action" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;" checked="checked">
                                        <label for="action" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Action</label>
                                    </div>
                                </div>			
			    </div>                            
                        </div>
                            
                        </div>
                    </div>
                </div>
                     <div class="row">
                        <div class="col-md-12">
                            <div class="card card-box">
                                <div class="card-head">
                                    <header>All Agents</header>
                                    <div class="tools">
                                        <a href="<?=base_url();?>company" class="btn btn-success" style="padding:6px;" title="Add Client"><i class="fa fa-plus"></i> Add </a>
                                        <!--a id="export_to_excel" style="padding:6px;" class="btn btn-info" title="Export"><i class="fa fa-download"></i> Export </a-->
	                                <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-scrollable">
                                    <table class="table table-hover table-checkable order-column full-width" id="example4">
                                        <thead>
                                            <tr>
                                                <th class="center">Sr.No</th>
                                                <th class="center">Company Name</th>                                                
                                                <th class="center">Agent</th>
                                                <th class="center">Contact Number</th>	
                                                <th class="center">Email</th>
                                                <th class="center">Address</th>
                                                <th class="center">City</th>
                                                <th class="center">State</th>
                                                <th class="center">Country</th>
                                                <th class="center">Date</th>
                                                <th class="center">Designation</th>
                                                <th class="center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            //echo '<pre>';print_r($company); print_r($this->session->userdata); die;
                                            $i=1;
                                            if(!empty($company)) {
                                            foreach($company as $companies) {
                                            ?>
                                                    <tr class="odd gradeX">
                                                        <td class="center"><?=$i++?></td>
                                                            <td class="center">
                                                            <?php 
                                                                echo ucwords(strtolower($companies->name)); 	
                                                            ?>
                                                            </td>                                                            
                                                            <td class="center"><?=$companies->contact_person?></td>
                                                            <td class="center"><?=$companies->contact_person_number?></td>
                                                            <td class="center"><?=$companies->email?></td>
                                                            <td class="center">
                                                             <?php echo (trim($companies->address)<>'')?$companies->address:'';
                                                                    ?>
                                                            </td>
                                                            <td class="center"><?=ucwords(strtolower($companies->city)); ?></td>
                                                            <td class="center"><?=ucwords(strtolower($companies->state)); ?></td>
                                                            <td class="center"><?=ucwords(strtolower($companies->country)); ?></td>
                                                            <td class="center"> <?php $d = strtotime($companies->creation_date); 
                                                                    echo date('d-M-Y',$d);
                                                                ?></td>
                                                            <td class="center"><?=ucwords(strtolower($companies->designation)); ?></td>
                                                            <td class="center">
                                                                <?php if($this->session->userdata('type') == 1) { ?>
                                                                <a href="<?php echo base_url().$companies->company_id; ?>/edit-client" class="btn btn-tbl-edit btn-xs" title="Edit"><i class="fa fa-edit"></i></a>
                                                                <?php }
                                                                else if($companies->user_id == $this->session->userdata('id')){ ?>
                                                                <a href="<?php echo base_url().$companies->company_id; ?>/edit-client" class="btn btn-tbl-edit btn-xs" title="Edit"><i class="fa fa-edit"></i></a>
                                                                <?php } ?>
                                                            <?php if($this->session->userdata('type') == 1){?>  
                                                                <a href="<?=base_url().$companies->company_id?>/delete-client"  onclick="return confirm('Are you sure you want to delete this ?');" class="btn btn-tbl-delete btn-xs" title="Delete"> 
                                                            <i class="fa fa-trash-o "></i> </a>													
                                                            <?php }?>
                                                            </td>
                                                    </tr>
                                            <?php } }?>	
                                            </tbody>
                                    </table>
                                    </div>
                                </div>
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
  <!-- Script -->
</body>
<script>
    $('#export_to_excel').click(function () {
        $("#example4").table2excel({
            filename: "data.xls"
        });
    });
    
    $(document).ready(function() {
        var table = $('#example4').DataTable({
            "scrollX": true
            //"scrollY": "200px",
            //"paging": false
        });
        table.columns( [ 5,7,9,10 ] ).visible( false, false );
        table.columns.adjust().draw( false );
        $('.mdl-textfield__input').on( 'click', function (e) {
            // Get the column API object
            var column = table.column( $(this).attr('data-column') );
            // Toggle the visibility
            column.visible( ! column.visible() );
            table.columns.adjust().draw( false );
            $('.view_all').prop("checked",false);
            $(".dataTables_info").parent().parent('div').show();
        });
        
        $(".view_all").on('click',function(){
            if($(this).prop("checked") === true){
                $('.mdl-textfield__input').prop('checked',true);
                table.columns( '.center' ).visible( true );
                $(".dataTables_info").parent().parent('div').show();
            }else{
                $('.mdl-textfield__input').prop("checked",false);
                table.columns( '.center' ).visible( false );
                $(".dataTables_info").parent().parent('div').hide();
            }
        });
        
    });
    
</script>
</html>