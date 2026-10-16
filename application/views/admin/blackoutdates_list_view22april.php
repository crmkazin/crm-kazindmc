<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>KazinDMC CRM</title>
<?php include('admin_head_css.php'); ?> 
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>
    <link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/gh/djibe/material@4.6.2-1.0/css/material-plugins.min.css" rel="stylesheet">
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
                                <div class="page-title">Masters</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?=base_url();?>dashboard">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li><a class="parent-item" href="<?=base_url();?>masters">Masters</a></li> &nbsp;<i class="fa fa-angle-right"></i>&nbsp;
								<li class="active"><a class="parent-item" href="<?=base_url();?>blackout-dates">Black Out Dates</a></li>
                            </ol>
                        </div>
                        
                    </div>			
            <?php echo $this->session->flashdata('message'); unset($_SESSION['message']); ?>
            
                     <div class="row">
                        <div class="col-md-12">
                            <div class="card card-box">
                                <div class="card-head">
                                    <header>List Black Out Dates</header>
                                    <div class="tools">
										<a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-scrollable">
                                    <table class="table table-hover table-checkable order-column full-width" id="example4">
                                        <thead>
                                            <tr>
                                                <th class="center">Sr.No</th>
                                                <th class="center">Name</th>                                                
                                                <th class="center">From</th>
                                                <th class="center">To</th>
                                                <th class="center">Status</th>
                                                <th class="center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            //echo '<pre>';print_r($company); print_r($this->session->userdata); die;
                                            $i=1;
                                            if(!empty($result)) {
                                            foreach($result as $list) {
                                            ?>
                                                <tr class="odd gradeX">
                                                    <td class="center"><?=$i++?></td>
                                                        <td class="center"><?php echo $list->name; ?></td>                                                            
                                                        <td class="center"><?= date('d-M-Y',strtotime($list->from_date)); ?></td>
                                                        <td class="center"><?= date('d-M-Y',strtotime($list->to_date)); ?></td>                                                        
                                                        <td class="center"><?=ucwords($list->status); ?></td>
                                                        <td class="center">
                                                            <a href="<?php echo base_url('blackout-dates?id='.base64_encode($list->id)); ?>" class="btn btn-tbl-edit btn-xs" title="Edit"><i class="fa fa-edit"></i></a>
                                                        <?php if($this->session->userdata('type') == 1){?>  
                                                            <a href="<?=base_url('delete-blackout-dates?id='.base64_encode($list->id))?>"  onclick="return confirm('Are you sure you want to delete this ?');" class="btn btn-tbl-delete btn-xs" title="Delete"> 
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
					
        <div class="row">
            <div class="col-sm-12">
              <div class="card-box">
                <div class="card-head">
                  <header>Add / Edit Black Out Dates</header>
                  <div class="tools">
                    
                  </div>
                </div>
                <?php echo form_open_multipart(current_url() . '?' . $_SERVER['QUERY_STRING'],['id'=>'frm-blackout-dates']); ?>
                <div class="card-body row">
                  <div class="col-lg-3 p-t-20">
                    <!--div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <?php //echo form_input(['type'=>'date', 'name' => 'from_date', 'id' => 'from_date', 'class' => 'mdl-textfield__input', 'required' => 'required', 'value' => isset($blackout_dates->from_date) ? $blackout_dates->from_date : set_value('from_date')]); ?>
                      <label class="mdl-textfield__label">From</label>
                      <?php //echo form_error('from_date'); ?>
                    </div-->
					
					<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width"
						style="display:inline-flex;">
						<input type="text" name=""
							class="mdl-textfield__input dt-search-show" style="width:90%;"
							value="<?php echo isset($blackout_dates->from_date) ? date('d M Y',strtotime($blackout_dates->from_date)) :''; ?>"
							readonly>
						<?php echo form_input(['type' => 'date', 'name' => 'from_date', 'placeholder' => '', 'id' => 'from_date', 'class' => 'dts mdl-textfield__input dt-search', 'required' => 'required', 'value' => isset($blackout_dates->from_date) ? $blackout_dates->from_date : set_value('from_date'), 'style' => 'width:20px;float:right;']) ?>
						<label class="mdl-textfield__label">From</label>
					</div>
					
                  </div>

                  <div class="col-lg-3 p-t-20">
                    <!--div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <?php //echo form_input(['type'=>'date','name' => 'to_date', 'id' => 'to_date', 'class' => 'mdl-textfield__input', 'value' => isset($blackout_dates->to_date) ? $blackout_dates->to_date : set_value('to_date')]); ?>
                      <label class="mdl-textfield__label">To</label>
                      <?php //echo form_error('to_date'); ?>
                    </div-->
					
					<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width"
						style="display:inline-flex;">
						<input type="text" name=""
							class="mdl-textfield__input dt-search-show" style="width:90%;"
							value="<?php echo isset($blackout_dates->to_date) ? date('d M Y',strtotime($blackout_dates->to_date)) :''; ?>"
							readonly>
						<?php echo form_input(['type' => 'date', 'name' => 'to_date', 'placeholder' => '', 'id' => 'to_date', 'class' => 'dts mdl-textfield__input dt-search', 'required' => 'required', 'value' => isset($blackout_dates->to_date) ? $blackout_dates->to_date : set_value('to_date'), 'style' => 'width:20px;float:right;']) ?>
						<label class="mdl-textfield__label">To</label>
					</div>					
					
                  </div>
                  
                  <div class="col-lg-3 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <?php echo form_input(['name' => 'event_name', 'id' => 'event_name', 'required' => 'required', 'class' => 'mdl-textfield__input', 'value' => isset($blackout_dates->name) ? $blackout_dates->name : set_value('name')]) ?>
                      <label class="mdl-textfield__label">Name</label>
                      <?php echo form_error('event_name'); ?>
                    </div>
                  </div>
                  
                  <div class="col-lg-3 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width is-focused">
                      <select name="status" class="mdl-textfield__input" style="padding-top:13px;">
                        <option value="active" <?php echo (isset($blackout_dates->status) && $blackout_dates->status == 'active') ? 'selected="selected"' : ''; ?>>
                          Active</option>
                        <option value="inactive" <?php echo (isset($blackout_dates->status) && $blackout_dates->status == 'inactive') ? 'selected="selected"' : ''; ?>>
                          In-active</option>
                      </select>
                      <label class="mdl-textfield__label">Status</label>
                      <?php echo form_error('status'); ?>
                    </div>
                  </div>
                    
                    <div class="col-lg-3 p-t-20">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                            <select name="location" id="location" class="mdl-textfield__input"
                                style="padding: 10px;">
                                <option value="">Select..</option>
                                <?php
                                asort($locations);
                                foreach ($locations as $key => $val) {
                                    if ($key != 'all') {  ?>
                                        <option value="<?= $key ?>" <?php echo ($this->input->get('location')==$key)?'selected="selected"':''; ?>>
                                            <?= ucfirst($key) ?>
                                        </option>
                                <?php }
                                } ?>
                            </select>
                            <label class="mdl-textfield__label">Location</label>
                        </div>
                    </div>
                    <div class="col-lg-3 p-t-20">
                        <div
                            class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                            <select name="hotel" id="hotel" class="mdl-textfield__input js-example-basic-multiple" style="padding: 10px;">
                                <option value="">Select Hotel</option>
                            </select>
                            <label class="mdl-textfield__label">Hotel</label>
                        </div>
                    </div>
                    <div class="col-lg-6 p-t-20" style="border: 1px solid #ccc; padding: 10px; display: inline-block; min-width: 200px; min-height: 100px;">
                        <p style="margin-top:-15px;" class="text-center bold">Hotels</p>
                        <div id="err-msg"></div>
                        <div class="row hotels-list">
                            <?php if(!empty($blackout_dates_hotels)){
                                    foreach($blackout_dates_hotels AS $list){
                                        echo '<div class="col-md-10 mb-1 ml-3" style="background-color: #fafafb;"><input type="hidden" value="'.$list->hotel_id.'" name="edit_hotel_id[]">'.$list->name.'<i data-id='.$list->id.' title="Remove" class="fa fa-remove hotel-delete float-right mt-1" style="color:red;cursor:pointer;"></i></div>';
                            }} ?>
                        </div>
                    </div>
                  <div class="col-lg-12 p-t-20 text-center">
                    <?php echo form_submit(['name' => 'submit', 'id' => 'submit', 'class' => 'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-pink', 'value' => 'Submit']); ?>
                  </div>

                  </div>
                  <?php echo form_close(); ?>
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
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script>
    
    $(document).ready(function() {
        var table = $('#example4').DataTable({
            "scrollX": true
            //"scrollY": "200px",
            //"paging": false
        });
        $('.js-example-basic-multiple').select2({
            //theme: 'filled',
            placeholder: 'Select..',
            //width: '450px'
        });
        
        $("#location").on("change", function() {
            var v = $(this).val();
            $("#hotel").empty().parent().removeClass("is-dirty");
            $.ajax({
                type: "POST",
                url: "<?= base_url('get_hotels'); ?>",
                data: {
                    'location': v
                },
                dataType: "JSON",
                success: function(data) {
                    var opts = data.details;
                    $('#hotel').append('<option value="">Select..</option>');
                    $.each(opts, function(i, d) {
                        $('#hotel').append('<option value="' + d.id + '">' + d.name + '</option>');
                    });
                },
                error: function(jqXHR, textStatus, errorThrown) {}
            });

        });
        
        $("#hotel").on("change",function(){
            var data = $(this).select2('data');
            var flag = true;
            $('input[name^="hotel_id"]').each(function() {
                if($(this).val() == data[0].id) {
                    flag = false; 
                    return false;
                }
            });
            $('input[name^="edit_hotel_id"]').each(function() {
                if($(this).val() == data[0].id) {
                    flag = false; 
                    return false;
                }
            });
            if(flag){
                var html = '<div class="col-md-10 mb-1 ml-3" style="background-color: #fafafb;"><input type="hidden" value="'+data[0].id+'" name="hotel_id[]">'+data[0].text+'<i title="Remove" class="fa fa-remove hotel-remove float-right mt-1" style="color:red;cursor:pointer;"></i></div>';
                $(".hotels-list").append(html);
                $("#err-msg").fadeIn(2000).html('<div class="alert alert-success"><i class="fa fa-check"></i> Added Successfully!</div>').fadeOut(2000);
            }else{ $("#err-msg").fadeIn(2000).html('<div class="alert alert-warning"><i class="fa fa-ban"></i> Already Added!</div>').fadeOut(2000); }
        });
        
        $("#frm-blackout-dates").on('click', '.hotel-remove', function (e) {
			e.preventDefault();
			$(this).parent().remove(); //Remove field html
		});
        
        $(".hotel-delete").on("click",function(e){
            e.preventDefault();
            if(!confirm('Are you sure you want to delete this ?')) return false;
            var idx = $(this).index(".hotel-delete");
            var hotel_id = $('input[name="edit_hotel_id[]"]').eq(idx).val();
            var id = $('.hotel-delete').eq(idx).attr("data-id");
            $.ajax({
                type: "POST",
                url: "<?= base_url('admin/masters/delete_blackout_hotels'); ?>",
                data: { 'black_out_dates_hotels_id': id,'hotel_id':hotel_id  },
                dataType: "JSON",
                success: function(data) {
                    $("#err-msg").html(data.msg);
                    if(data.response === "s"){
                        $(".hotel-delete").eq(idx).parent().remove();
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {}
            });
        });
        
		$(".dt-search").on("change", function () {
			var idx = $(this).index(".dt-search");
			const selectedDate = new Date($(".dt-search").eq(idx).val());
			if(selectedDate == "Invalid Date"){ selectedDate = new Date(); }
			//const lastDayDate = new Date(selectedDate.getFullYear(), selectedDate.getMonth() + 1, 0);
			const options = {
				year: 'numeric',
				month: 'short',
				day: '2-digit'
			};
			const formattedDate = selectedDate.toLocaleDateString('en-IN', options);
			$(".dt-search-show").eq(idx).val(formattedDate).parent().addClass('is-focused');

			if ($(this).attr("id") === "from_date" && $("#to_date").val() === "") {
				$("#to_date").attr("min", $(this).val());
			} else if ($(this).attr("id") === "from_date" && $("#to_date").val() !== "") {
				const selectedToDate = new Date($("#to_date").val());
				if (parseInt(selectedToDate.getTime()) < parseInt(selectedDate.getTime())) {
					$("#to_date").val('').attr("min", $(this).val());
					$(".dt-search-show").eq($("#to_date").index(".dt-search")).val('');
				}
			}
			if ($(this).attr("id") === "to_date" && $("#from_date").val() === "") {
				$("#from_date").attr("max", $(this).val());
			} else if ($(this).attr("id") === "to_date" && $("#from_date").val() !== "") {
				const selectedFromDate = new Date($("#from_date").val());
				if (parseInt(selectedFromDate.getTime()) > parseInt(selectedDate.getTime())) {
					$("#from_date").val('').attr("max", $(this).val());
					$(".dt-search-show").eq($("#from_date").index(".dt-search")).val('');
				}
			}

		});
		
    });
    
</script>
</html>