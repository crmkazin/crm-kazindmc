<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>KazinDMC CRM</title>
    <?php include ('admin_head_css.php'); ?>

</head>
<!-- END HEAD -->

<body class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md header-white dark-sidebar-color logo-dark">
    <div class="modal fade" id="myModalpricing" role="dialog">
    <div class="modal-dialog modal-lg" style="max-width:1140px;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Prices</h4>
                <button type="button" class="close close-modal" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body ui-front">
                <div class="row">
                    <div class="col-md-12">
                        <div id="msg"></div>                        
                        <form method="post" id="add-form-guide" enctype="multipart/form-data">
                            <input type="hidden" name="guide_id" id="guide_id" value="">
                            <div class="card-body row">
                                <div class="col-lg-12 text-center" style="margin-top:-20px;">
                                    <h4 id="guide-name" class="bold"></h4>
                                </div>
                                <div class="col-lg-6">
                                    <h5 class="bold center" style="background-color: #eff3f6;padding: 7px 7px;">Day Shift Prices</h5>
                                </div>
                                <div class="col-lg-6">                                      
                                    <h5 class="bold center" style="background-color: #eff3f6;padding: 7px 7px;">Night Shift Prices</h5>
                                </div>
                                <div class="row col-lg-12 text-center guide-prices-heading hide">
                                        <div class="col-lg-2 p-t-20">
                                              <label class="bold">Fixed Prices</label>
                                        </div>
                                          <div class="col-lg-2 p-t-20">
                                            <label class="bold">Hourly Prices</label> 
                                          </div>
                                        <div class="col-lg-2 p-t-20">
                                                <label class="bold">Dated</label> 
                                      </div>
                                        <div class="col-lg-2 p-t-20">
                                              <label class="bold">Fixed Prices</label>                                          
                                      </div>
                                      <div class="col-lg-2 p-t-20">                                          
                                               <label class="bold">Hourly Prices</label>                                          
                                      </div>
                                        <div class="col-lg-2 p-t-20">
                                                <label class="bold">Dated</label>                                          
                                      </div>
                                </div>
                                <div class="row col-lg-12 guide-prices">
                                    <div class="col-lg-6 text-center">
                                        <div class="row guide-prices-day"></div>
                                    </div>
                                    <div class="col-lg-6 text-center">
                                        <div class="row guide-prices-night"></div>
                                    </div>
                                </div>
                                <br>
                                <div class="col-lg-6 p-t-20">
                                    <div class="row">
                                      <div class="col-lg-6 p-t-20">
                                          <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width" style="display:flex;">
                                              <?php echo form_input(['type'=>'number','name' => 'day_fixed_prices', 'id' => 'day_fixed_prices', 'placeholder' => 'Prices', 'class' => 'mdl-textfield__input', 'value' => '','min'=>'0']) ?>
                                              <label class="mdl-textfield__label">Fixed Prices</label>
                                          </div>
                                      </div>
                                      <div class="col-lg-6 p-t-20">
                                          <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width" style="display:flex;">
                                                <?php echo form_input(['type'=>'number','name' => 'day_hourly_prices', 'id' => 'day_hourly_prices', 'placeholder' => 'Prices', 'class' => 'mdl-textfield__input', 'value' => '','min'=>'0']) ?>
                                                <label class="mdl-textfield__label">Hourly Prices</label>
                                          </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-lg-6 p-t-20">                                      
                                  
                                      <div class="row">
                                        <div class="col-lg-6 p-t-20">
                                          <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width" style="display:flex;">
                                              <?php echo form_input(['type'=>'number','name' => 'night_fixed_prices', 'id' => 'night_fixed_prices', 'placeholder' => 'Prices', 'class' => 'mdl-textfield__input', 'value' => '','min'=>'0']) ?>
                                              <label class="mdl-textfield__label">Fixed Prices</label>
                                          </div>
                                        </div>
                                        <div class="col-lg-6 p-t-20">
                                          <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width" style="display:flex;">
                                                <?php echo form_input(['type'=>'number','name' => 'night_hourly_prices', 'id' => 'night_hourly_prices', 'placeholder' => 'Prices', 'class' => 'mdl-textfield__input', 'value' => '','min'=>'0']) ?>
                                                <label class="mdl-textfield__label">Hourly Prices</label>
                                          </div>
                                        </div>
                                      </div>
                                  </div>
                                  
                                
                                <div class="col-lg-12 p-t-20">
                                    <button type="submit" id="btn_prices" class="btn btn-primary float-right">Add</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
           
        </div>
    </div>
</div>
    
    <div class="page-wrapper">
        <!-- start header -->
        <?php include ('header.php'); ?>
        <!-- end header -->
        <!-- start page container -->
        <div class="page-container">
            <!-- start sidebar menu -->
            <?php include ('side_bar.php'); ?>
            <!-- end sidebar menu -->
            <!-- start page content -->
            <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title">All Guides</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                        href="<?= base_url(); ?>dashboard">Home</a>&nbsp;<i
                                        class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">All Guides</li>
                            </ol>
                        </div>
                    </div>
                    <?php echo $this->session->flashdata('message');
                    unset($_SESSION['message']); ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-box">
                                <div class="card-head">
                                    <header>All Guides</header>
                                    <div class="tools">
                                        <a href="add-guide" class="btn btn-success" style="padding: 6px;"><i
                                                class="fa fa-plus"></i> Add New </a>
                                        <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-scrollable">
                                        <table class="table table-hover table-checkable order-column full-width"
                                            id="example4">
                                            <thead>
                                                <tr>
                                                    <th class="center">Sr.No</th>
                                                    <th class="center">Country</th>
                                                    <th class="center">State</th>
                                                    <th class="center">City</th>
                                                    <th class="center">First Name</th>
                                                    <th class="center">Last Name</th>
                                                    <th class="center">Gender</th>
                                                    <th class="center">ISD Code</th>
                                                    <th class="center">Contact Number</th>
                                                    <th class="center">Remark</th>
                                                    <th class="center">Languages</th>
                                                    <th class="center">Location</th>
                                                    <th class="center">Photo</th>
                                                    <th class="center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $i = 1;
                                                $base_url = base_url();
                                                $super_admins = ['rohit@kazindmc.com', 'pankaj@thavertech.com'];
                                                if (!empty($guides)) {
                                                    foreach ($guides as $guide) {

                                                        ?>
                                                <form method="post">
                                                    <tr class="odd gradeX">
                                                        <td class="center"><?= $i++ ?></td>
                                                        <td class="center"><?= $guide->country ?></td>
                                                        <td class="center"><?= $guide->state ?></td>
                                                        <td class="center"><?= $guide->city ?></td>
                                                        <td class="center"><?= $guide->name ?></td>
                                                        <td class="center"><?= $guide->last_name ?></td>
                                                        <td class="center"><?= strtoupper($guide->gender) ?></td>
                                                        <td class="center"><?= $guide->isd_codes ?></td>
                                                        <td class="center"><?= $guide->contact_number ?></td>
                                                        <td class="center"><?= $guide->remarks ?></td>
                                                        <td class="center">
                                                            <?= str_replace(',', ' | ', $guide->languages) ?>
                                                        </td>
                                                        <td class="center"><?= $guide->location ?></td>
                                                        <td class="center">
                                                            <?php if ($guide->photo <> '') { ?>
                                                            <img class="rounded"
                                                                src="<?= $base_url . 'assets/guide/' . $guide->photo ?>"
                                                                width="60" height="60">
                                                            <?php } ?>
                                                        </td>
                                                        <td class="center" style="display:flex;">
                                                            <button class="btn btn-primary btn-xs pricing" data-guide-name="<?php echo $guide->name.' '.$guide->last_name; ?>" data-guide-id="<?php echo base64_encode($guide->id); ?>" title="Pricing" style="padding:4px 4px;">Prices</button>
                                                            <a href="<?php echo base_url('edit-guide?id=' . base64_encode($guide->id)); ?>"
                                                                class="btn btn-tbl-edit btn-xs" title="Edit"><i
                                                                    class="fa fa-edit"></i></a>
                                                            <a href="<?php echo base_url('delete-guide?id=' . base64_encode($guide->id)); ?>"
                                                                onclick="return confirm('Are you sure you want to delete this Guide?');"
                                                                class="btn btn-tbl-delete btn-xs" title="Delete"><i
                                                                    class="fa fa-trash-o "></i></a>
                                                            <a href="print-guide-details?id=<?php echo base64_encode($guide->id); ?>" target="_blank">
                                                                <i class="fa fa-file-pdf-o" style="color:#ff0000;" title="Pdf"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                </form>
                                                <?php }
                                                } ?>
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
        <?php include ('admin_footer.php'); ?>
        <!-- end footer -->
    </div>
    <!-- start js include path -->
    <?php include ('admin_footer_js.php'); ?>
    <!-- end js include path -->

</body>
<script>
$(document).ready(function() {
    var table = $('#example4').DataTable({
        "scrollX": true
        //"scrollY": "200px",
        //"paging": false
    });
    
    $("#example4_wrapper").on("click",".pricing",function(e){
        e.preventDefault();
        $("#myModalpricing").modal("toggle");
        $("#guide-name").html("").html($(this).attr("data-guide-name"));
        $("#guide_id").val("").val($(this).attr("data-guide-id"));
        $(".guide-prices-heading").addClass("hide")
        $("#msg, .guide-prices-day, .guide-prices-night").html('');
        let myForm = document.getElementById("add-form-guide");
        var formData = new FormData(myForm);
        var html_day = '';
        var html_night = '';
        $.ajax({
            url: 'admin/guide/get_prices',
            type: 'POST',
            data: formData,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function(response) {
                if(response.details.length > 0){
                    $(".guide-prices-heading").removeClass("hide");
                    $.each(response.details, function(index, item) {                        
                        if(item.shift_type=='day'){
                            html_day += '<input type="hidden" name="hdn_guide_costing_id[]" value="'+item.id+'">';
                            html_day += '<div class="col-lg-4"><label class="">'+item.fixed_prices+'</label></div>';
                            html_day += '<div class="col-lg-4"><label class="">'+item.hourly_prices+'</label></div>';
                            html_day += '<div class="col-lg-4"><label class="">'+item.created+'</label></div>';
                        }else if(item.shift_type=='night'){
                            html_night += '<input type="hidden" name="hdn_guide_costing_id[]" value="'+item.id+'">';
                            html_night += '<div class="col-lg-4"><label class="">'+item.fixed_prices+'</label></div>';
                            html_night += '<div class="col-lg-4"><label class="">'+item.hourly_prices+'</label></div>';
                            html_night += '<div class="col-lg-4"><label class="">'+item.created+'</label></div>';
                        }
                    });
                    $(".guide-prices-day").html('').html(html_day);
                    $(".guide-prices-night").html('').html(html_night);
                }
            },
            error: function() {}
        });
          
    });
    
    $("#btn_prices").on("click", function() {
        let myForm = document.getElementById("add-form-guide");
        var dataForm = new FormData(myForm);
        $("#btn_prices").html('Adding..').attr('disabled', 'disabled');
        $.ajax({
            url: "<?php echo base_url('admin/guide/add_prices'); ?>",
            type: "post",
            data: dataForm,
            dataType: 'JSON',
            contentType: false,
            processData: false,
            beforeSend: function() {},
            success: function(data) {
                $("#msg").html('').html(data.msg);
                $("#btn_prices").html('Submit').removeAttr('disabled', 'disabled');
                if (data.response === "e") {} else if (data.response === "s") {
                    $("#add-form-guide")[0].reset();
                    $("#myModalpricing").fadeOut(2800,function() {
                        $(this).modal('hide');
                    });                    
                }
            }
        });
    });
    
    
});
</script>

</html>