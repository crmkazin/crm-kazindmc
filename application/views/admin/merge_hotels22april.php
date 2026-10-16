<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>KazinDMC CRM</title>
    <style>
    .img-width {
        max-width: 80px;
    }
    </style>
    <!-- Include CSS files -->
    <?php include ('admin_head_css.php'); ?>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
</head>

<body
    class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md header-white dark-sidebar-color logo-dark">
    <div class="page-wrapper">
        <!-- Include header -->
        <?php include ('header.php'); ?>

        <div class="page-container">
            <!-- Include sidebar menu -->
            <?php include ('side_bar.php'); ?>

            <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title">Merge / Revoke(Rollback) Hotels</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                        href="<?= base_url(); ?>dashboard">Home</a>&nbsp;<i
                                        class="fa fa-angle-right"></i>
                                </li>
                                <li class="active"><a class="parent-item" href="<?= base_url(); ?>all-hotel">Hotels</a>
                                </li>
                            </ol>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card card-box">
                                <div class="card-head">
                                    <header>Merge Hotels</header>
                                </div>
                                <div class="card-body">
                                    <form method="post" autocomplete="off" id="frm-hotels-merge" onsubmit="return confirm('Merge Hotels. Are You Sure?')">
                                        <div class="card-body row">
                                                <div class="col-lg-12">
                                                    <?php echo $this->session->flashdata('message');
                                                        unset($_SESSION['message']);
                                                         ?>
                                                 </div>
                                            <div class="col-lg-6 p-t-20">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <?php echo form_input(['name' => 'hotel', 'id' => 'hotel', 'placeholder' => 'Hotel Name', 'class' => 'mdl-textfield__input']) ?>
                                                    <label class="mdl-textfield__label">Main Hotel</label>													
                                                </div>
												<?php echo form_error('main_hotel_id'); ?>
                                                <input type="hidden" name="main_hotel_id" id="main_hotel_id">
                                            </div>
											<div class="col-lg-6 p-t-20">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <?php echo form_input(['name' => '', 'id' => 'hotel_merge', 'placeholder' => 'Click To Add Hotel', 'class' => 'mdl-textfield__input']) ?>
                                                    <label class="mdl-textfield__label">Duplicate Hotel</label>
                                                </div>
                                            </div>
											
											<div class="col-lg-12 p-t-20">
                                                <div class="panel panel-info">
												  <div class="panel-heading" style="background-color: #188ae2;color: #FFF;">Duplicate Hotels List</div>
												  <div class="panel-body row" id="merge-hotels">
														
												  </div>
												</div>
												<?php echo form_error('hotels_merger[]'); ?>
                                            </div>
											
                                            <div class="col-lg-12 p-t-20">
                                                <?php echo form_submit(['name' => 'submit', 'id' => 'submit', 'class' => 'btn btn-md btn-primary m-t-20', 'style' => 'float:right;', 'value' => 'Merge']); ?>
                                            </div>
                                        </div>
                                    </form>
                                    
                                </div>
                               
                            </div>
                        </div>
                        
                        
                        <div class="col-md-6">
                            <div class="card card-box">
                                <div class="card-head">
                                    <header>Revoke(Rollback) Merged Hotels</header>
                                </div>
                                <div class="card-body">
                                    <form method="post" autocomplete="off" id="frm-hotels-revoke">
                                        <div class="card-body row">
                                            <div class="col-lg-12 msg"></div>
                                            <div class="col-lg-12 p-t-20">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <?php echo form_input(['name' => 'revoke_main_hotel', 'id' => 'revoke_main_hotel', 'placeholder' => 'Hotel Name', 'class' => 'mdl-textfield__input']) ?>
                                                    <label class="mdl-textfield__label">Main Hotel</label>													
                                                </div>
												<?php echo form_error('revoke_main_hotel'); ?>
                                                <input type="hidden" name="revoke_main_hotel_id" id="revoke_main_hotel_id">
                                            </div>
											
											
											<div class="col-lg-12 p-t-20">
                                                <div class="panel panel-info">
												  <div class="panel-heading" style="background-color: #188ae2;color: #FFF;">Merged Hotels List</div>
												  <div class="panel-body row" id="merged-hotels-list">
														
												  </div>
												</div>												
                                            </div>
                                            
                                        </div>
                                    </form>
                                    
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
        <?php include ('admin_footer.php'); ?>
        <!-- end footer -->
    </div>
    <!-- start js include path -->
    <?php include ('admin_footer_js.php'); ?>
    <!-- end js include path -->
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-table2excel/dist/jquery.table2excel.min.js"></script>


    <script>
    $(document).ready(function() {
        $("#hotel").autocomplete({
            source: function(request, response) {
                // Fetch data
                $.ajax({
                    url: "<?= base_url() ?>admin/hotel/hotel_name_suggesstion",
                    type: 'POST',
                    dataType: "json",
                    data: {
                        search: request.term
                    },
                    success: function(data) {
                        response(data);
                        dt = data;
                    }
                });
            },
            select: function(event, ui) {
                // Set selection
                $('#hotel').val(ui.item.label); // display the selected text
                $('#main_hotel_id').val(ui.item.hotel_id); // save selected id to input
            },
			close: function(event, ui)  {
				$("#merge-hotels").empty();
			}
        });
		
		$("#hotel_merge").autocomplete({
            source: function(request, response) {
                // Fetch data
				let myForm = document.getElementById("frm-hotels-merge");
				var frm_data = new FormData(myForm);
				frm_data.set("search",request.term);
                $.ajax({
                    url: "<?= base_url() ?>admin/hotel/hotel_names_merge",
                    type: 'POST',
                    dataType: "json",
					contentType: false,
                    processData: false,
                    data: frm_data,
                    success: function(data) {
                        response(data);
                        dt = data;                        
                    }
                });
            },
            select: function(event, ui) {
                var html = '<div class="col-md-12"><input type="checkbox" value="'+ui.item.hotel_id+'" checked="checked" name="hotels_merger[]"> '+ui.item.label+' <i title="Remove" class="fa fa-remove" style="color:red;cursor:pointer;"></i></div>';
				$("#merge-hotels").append(html);				
            },
			close: function(event, ui)  {
			  // Close event fires when selection options closes
			  $("#hotel_merge").val(""); // Clear the input field 
			}
        });
		
		$("#frm-hotels-merge").on('click', '.fa-remove', function (e) {
			e.preventDefault();
			$(this).parent().remove(); //Remove field html
		});
		
        
        $("#revoke_main_hotel").autocomplete({
            source: function(request, response) {
                // Fetch data
                $.ajax({
                    url: "<?= base_url() ?>admin/hotel/hotel_name_suggesstion",
                    type: 'POST',
                    dataType: "json",
                    data: {
                        search: request.term
                    },
                    success: function(data) {
                        response(data);
                        dt = data;
                    }
                });
            },
            select: function(event, ui) {
                // Set selection
                $('#revoke_main_hotel').val(ui.item.label); // display the selected text
                $('#revoke_main_hotel_id').val(ui.item.hotel_id); // save selected id to input
                get_merge_hotels();
            }
        });
        
        $("#frm-hotels-revoke").on("click",".revoke",function(){
            if(!confirm("Rollback Hotels. Are You Sure?")){
                return false;
            }
            event.preventDefault();
            var ele = $(this);
            var h_id = ele.attr("data-id");
            $.ajax({
                url: "<?= base_url() ?>admin/hotel/revoke_merged_hotel",
                type: 'POST',
                dataType: "json",
                //contentType: false,
                //processData: false,
                data: {'hotel_id':h_id,'revoke_main_hotel_id':$("#revoke_main_hotel_id").val()},
                success: function(data) {
                    $(".msg").html(data.msg);
                    if(data.response === "s"){
                        ele.parent().remove();
                    }
                }
            });
            
            
        });
        
    });
    
    function get_merge_hotels(){
        let myForm = document.getElementById("frm-hotels-revoke");
        var frm_data = new FormData(myForm);
        $.ajax({
            url: "<?= base_url() ?>admin/hotel/get_merged_hotels",
            type: 'POST',
            dataType: "json",
            contentType: false,
            processData: false,
            data: frm_data,
            success: function(data) {
                $.each(data.merged_hotels,function(i,d){
                    var html = '<div class="col-md-12" style="font-weight:500;"><i class="fa fa-check" aria-hidden="true"></i> '+d.name+' <button type="button" title="Revoke" class="btn btn-xs btn-primary revoke" data-id="'+d.id+'" style="float: right;padding: 4px;">Revoke</button></div>';
                    $("#merged-hotels-list").append(html);
                });
            }
        });
    }
    
    </script>

</body>

</html>