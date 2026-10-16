<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta content="width=device-width, initial-scale=1" name="viewport" />
  <title>KazinDMC CRM</title>
  <?php include('admin_head_css.php');?>
  <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
  <script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>
  <link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet" />
  
  <script type="text/javascript" src="<?php echo base_url(); ?>/ckeditor/ckeditor.js"></script>  
  <link href="https://cdn.jsdelivr.net/gh/djibe/material@4.6.2-1.0/css/material-plugins.min.css" rel="stylesheet"/> 
  <script>
CKEDITOR.config.toolbar = [
	{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Strike', '-', 'RemoveFormat' ] },
	{ name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize'] },
        { name: 'colors', items: [ 'TextColor', 'BGColor' ] },
        { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language' ] },
	'/',
	{ name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
	{ name: 'insert', items: ['Table' ] }
    ];
</script>
  <style>.mdl-textfield { position:relative !important; }</style>
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
                <div class="page-title">Masters Creation</div>
              </div>
              <ol class="breadcrumb page-breadcrumb pull-right">
                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                    href="<?=base_url();?>dashboard">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                </li>
                <li class="active">Masters Creation</li>
              </ol>
            </div>
          </div>
          <?php echo $this->session->flashdata('message'); unset($_SESSION['message']); ?>
          <div class="row">
            <div class="col-sm-12">
              <div class="card-box">
                <div class="card-head">
                  <header>Masters Creation</header>
                  <div class="tools">
                    <a href="all-masters" class="btn btn-success" style="padding: 6px;"><i class="fa fa-file-text-o"></i>
                      List</a>
                    <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                  </div>
                </div>
                <?php echo form_open_multipart(); ?>
                <div class="card-body row">
                  
                    <div class="col-lg-4 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <?php
                      $readonly=[];
                      if($this->session->userdata('admin_type') != 'superadmin' && $this->session->userdata('locations')!='all'){
                          $readonly = ['readonly'=>'readonly'];
                      }
                      echo form_input(['name'=>'country','id'=>'country', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>$country['label']]+$readonly)?>
                      <label class="mdl-textfield__label">Select Country</label>
                      <?php echo form_error('country_id'); ?>
                    </div>
                  </div>
                    <input type="hidden" name="country_id" id="country_id" value="<?php echo $country['country_id']; ?>">
                    <div class="col-lg-4 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <?php echo form_input(['name' => 'city', 'id' => 'city', 'class' => 'mdl-textfield__input', 'value' => set_value('city')]); ?>
                      <label class="mdl-textfield__label">City</label>
                      <?php echo form_error('city'); ?>
                    </div>
                  </div>
                    
                    <div class="col-lg-4 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <?php echo form_input(['name' => 'name', 'id' => 'name', 'class' => 'mdl-textfield__input', 'required' => 'required', 'value' => set_value('name')]); ?>
                      <label class="mdl-textfield__label">Name</label>
                      <?php echo form_error('name'); ?>
                    </div>
                  </div>

                <div class="col-lg-4 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <select name="category" class="mdl-textfield__input" style="padding-top:13px;" required>
                            <option value=""></option>      
                            <option value="sitescene">Sightseeing</option>
                            <option value="activity">Activity</option>
                            <option value="night-life">Night Life</option>
                            <option value="transfers">Transfers</option>
                            <option value="miscellaneous">Miscellaneous</option>
                        </select>
                      <label class="mdl-textfield__label">Category</label>
                      <?php echo form_error('category'); ?>
                    </div>
                  </div>

                  <div class="col-lg-2 p-t-20">
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <select name="entry_ticket" id="entryTicketSelect" class="mdl-textfield__input" style="padding-top:13px;" required>
                                                <option value=""></option>      
                                                <option value="yes">Yes</option>
                                                <option value="no">No</option>
                                            </select>
                                            <label class="mdl-textfield__label">Entry Ticket</label>
                                            <?php echo form_error(''); ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 p-t-20" id="ticketInputField" style="display:none;">
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <input type="text" name="ticket_for"  class="mdl-textfield__input" id="ticketNumber">
                                            <label class="mdl-textfield__label">Entry Ticket For</label>
                                            </div>
                                        </div>
                                        <!-- <div class="col-lg-2 p-t-20" id="PersonsTypeContainer" style="display:none;">
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <select name="ticket_type" id="personsTypeDropdown" class="mdl-textfield__input" style="padding-top:13px;">
                                                <option value=""></option>      
                                                <option value="per_person" >Per Person</option>
                                                <option value="group" >Group</option>
                                            </select>
                                            <label class="mdl-textfield__label">Ticket Type</label>
                                            </div>
                                        </div> -->
                                        <div class="col-lg-2 p-t-20" id="Numberofpersons" style="display:none;">
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <input type="text" name="number_of_persons" value="0" class="mdl-textfield__input" id="PersonsNumber">
                                            <label class="mdl-textfield__label">Number of Persons (Group)</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 p-t-20" id="price" style="display:none;">
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width" >
                                                <input type="text" id="priceinput" value="0" name="price" class="mdl-textfield__input" >
                                                <label class="mdl-textfield__label">Group Entry Fee</label>
                                            </div>
                                        </div>

                                    <div id="entry-fee-adult" class="col-lg-2 p-t-20"style="display:none;" >
                                            <!-- Adult Entry Fee -->
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width" >
                                                <input type="text" id="entry_fee" value="0" name="entry_fee" class="mdl-textfield__input">
                                                <label class="mdl-textfield__label">Per Person Adult Entry Fee</label>
                                            </div>
                                    </div>
                                    <div id="entry-fee-child" class="col-lg-2 p-t-20" style="display:none;">
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width" >
                                                <input type="text" id="child_entry_fee" value="0" name="child_entry_fee" class="mdl-textfield__input">
                                                <label class="mdl-textfield__label" style="">Per Person Child Entry Fee</label>
                                            </div>
                                        </div>

                <div class="col-lg-4 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <input type="time" id="departing_time" name="departing_time" class="mdl-textfield__input" >
                        <label class="mdl-textfield__label">Departing Time From Hotel</label>
                    </div>
                </div>
                
                <div class="col-lg-4 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <input type="text" id="duration" name="duration" class="mdl-textfield__input">
                        <label class="mdl-textfield__label">Duration</label>
                    </div>
                </div>

                <div class="col-lg-4 p-t-20">
                    <div class="" style="font-weight:500;font-size:14px;">
                        <label class="">Days Of Operation</label>&nbsp;&nbsp;<input type="checkbox" name="" value="" id="all-days"> All days<br>
                        <input type="checkbox" class="week-days" name="operational_days[]" value="monday"> Monday <input type="checkbox" class="week-days" name="operational_days[]" value="tuesday"> Tuesday
                        <input type="checkbox" class="week-days" name="operational_days[]" value="wednesday"> Wednesday <input type="checkbox" class="week-days" name="operational_days[]" value="thursday"> Thursday
                        <input type="checkbox" class="week-days" name="operational_days[]" value="friday"> Friday <br><input type="checkbox" class="week-days" name="operational_days[]" value="saturday"> Saturday
                        <input type="checkbox" class="week-days" name="operational_days[]" value="sunday"> Sunday
                    </div>
                    <?php echo form_error('operational_days[]'); ?>
                </div>
                
                <div class="col-lg-4 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width is-focused">
                        <select id="destination_type" name="destination_type" class="mdl-textfield__input" style="padding-top:13px;">
                            <option value="intercity">Intercity</option>
                            <option value="outsidecity">Outside City</option>
                        </select>
                        <label class="mdl-textfield__label">Destination Type</label>
                    </div>
                </div>
                
                <div class="col-lg-4 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">                                            
                        <select name="location_ids[]" id="location_ids" class="mdl-textfield__input js-example-basic-multiple" multiple="" style="padding: 10px;">
                            <option value="">Select..</option>
                            <?php foreach($location_masters AS $list){ ?>
                                <option value="<?=$list->id?>"><?=$list->location?></option>
                            <?php } ?>
                        </select>
                        <label class="mdl-textfield__label">Locations</label>
                        <?php echo form_error('location_ids[]'); ?>
                    </div>
                </div>
                
                <div class="col-lg-4 p-t-20">
                    <div
                        class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <input type="text" id="new_location_ids" name="new_location_id"
                            class="mdl-textfield__input"
                            value="">
                        <label class="mdl-textfield__label">Create New Locations</label>
                    </div>
                </div>
                
                <div class="col-lg-12 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <textarea class="form-control txt_description" name="description" id="description"><?php echo set_value('description') ?></textarea>
                        <script>CKEDITOR.replace( 'description');</script>
                    </div>
                </div>
                  
                <div class="col-lg-4 p-t-20" id="">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
						<textarea class="form-control txt_remarks" name="remarks[]" id="remarks"></textarea>                        
                        <label class="mdl-textfield__label">Remarks</label>
                    </div>
                </div>
                <script>CKEDITOR.replace( 'remarks');</script>
                <div class="col-lg-4 p-t-20" id="addnew">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <button type="button" class="btn btn-success add_new"><i class="fa fa-plus"></i></button>
                    </div>
                </div>  
                  
                <div class="col-lg-12 p-t-20 text-center">
                  <?php echo form_submit(['name'=>'submit','id'=>'submit', 'class'=>'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-pink', 'value'=>'Submit']);?>
                </div>
                <?php echo form_close(); ?>
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


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <!-- jQuery UI -->
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
        <script>
            $(document).ready(function () {
                $("#type").on("change", function () {
                  $("#rights").css("display", "none");
                  if ($(this).val() === "2") {
                    $("#rights").css("display", "block");
                  }
                });
                
                $(".add_new").on("click",function(){
                    event.preventDefault();
					var html = '<div class="col-lg-4 p-t-20" id="">';
						html += '<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">';
						html += '<textarea class="form-control txt_remarks" name="remarks[]" id=""></textarea>';                        
						html += '<label class="mdl-textfield__label">Remarks</label></div></div>';
					var $h = $(html);			
					var x = Math.floor((Math.random() * 1000) + 1);
					//let clone_ele = $("#div_remarks").clone();
                    $h.find(".txt_remarks").attr("id","remarks_"+x);
					$h.insertBefore("#addnew");
					CKEDITOR.replace( 'remarks_'+x);
                });
              
              
            });

          $(document).ready(function () {

            $("#country").autocomplete({
              source: function (request, response) {
                // Fetch data
                $.ajax({
                  url: "<?=base_url()?>admin/company/get_country_ajax_new",
                  type: 'post',
                  dataType: "json",
                  data: {
                    search: request.term
                  },
                  success: function (data) {
                    response(data);
                    
                  }
                });
              },
              select: function (event, ui) {
                // Set selection
                $('#country').val(ui.item.label); // display the selected text
                $('#country_id').val(ui.item.country_id); // save selected id to input
                get_locations(ui.item.label);
                return false;
              }
            });

            $("#city").autocomplete({
              source: function (request, response) {
                // Fetch data
                $.ajax({
                  url: "<?=base_url()?>admin/itinerary/get_city",
                  type: 'post',
                  dataType: "json",
                  data: {
                    search: request.term,
                    country_id: $('#country_id').val()
                  },
                  success: function (data) {

                    response(data);
                  }
                });
              },
              select: function (event, ui) {
                // Set selection
                $('#city').val(ui.item.label); // display the selected text
                //   $('#company_id').val(ui.item.company_id); // save selected id to input

                return false;
              }
            });
            
            $("#all-days").on("click",function(){
                $(".week-days").prop("checked",false);
                if($("#all-days").prop('checked') == true){
                  $(".week-days").each(function(){
                        $(this).prop("checked",true);
                    });
                }
            });
            $(".week-days").on("click",function(){
                $("#all-days").prop("checked",false);
            });
            $('.js-example-basic-multiple').select2({
                //theme: 'filled',
                placeholder: 'Select..',
                
            });

          });
          
          function get_locations(country){
              $.ajax({
                  url: "<?php echo site_url('admin/masters/get_locations'); ?>",
                  type: "post",
                  data: { 'country': country },
                  dataType: 'JSON',
                  //contentType : false,
                  //processData: false,
                  beforeSend: function () { },
                  success: function (res) {
                      if (res.response === "s") {
                          $("#location_ids").empty();
                          $.each(res.details, function (index, item) {
                              $("#location_ids").append('<option value="' + item
                              .id + '">' + item.location +
                              '</option>');
                          });
                      }
                  }
              });
          }
          
        </script>
                    <script>
                $(document).ready(function() {
                    // Initially check if there are selected locations
                    toggleNewLocationField();

                    // When a location is selected or deselected, toggle the "Create New Location" input
                    $('#destination_type').on('change', function() {
                        toggleNewLocationField();
                    });

                    // When user types something in the "Create New Location" input, disable the dropdown
                    $('#new_location_ids').on('input', function() {
                        toggleLocationSelectField();
                    });

                    function toggleNewLocationField() {
                        // If any location is selected, disable the "Create New Location" input
                        if($("#destination_type").val() == "outsidecity"){
                            $('#new_location_ids').prop('disabled', false).parent().css("background-color","");
                            $('#location_ids').prop('disabled', false).parent().css("background-color","");                            
                        }else{
                            $('#new_location_ids').val('').prop('disabled', true).parent().css("background-color","#f7f7f7");
                            $('#location_ids').val('').trigger('change').prop('disabled', true).parent().css("background-color","#f7f7f7");
                        } 
                    }

                    function toggleLocationSelectField() {
                        // If something is typed in the "Create New Location" input, disable the location select dropdown
                        if ($('#new_location_ids').val() !== '') {
                            $('#location_ids').val('').trigger('change').prop('disabled', true); // Disable location select
                        } else {
                            $('#location_ids').prop('disabled', false); // Enable location select
                        }
                    }
                });

                $(document).ready(function() 
                {
                        $('form').submit(function() 
                        {
                          if ($('#entry-fee-adult').css('display') === 'none') {
                              $('#entry_fee').val('');
                          }
                          if ($('#entry-fee-child').css('display') === 'none') {
                              $('#child_entry_fee').val('');
                          }
                          if ($('#Numberofpersons').css('display') === 'none') {
                              $('#PersonsNumber').val('');
                          }
                          if ($('#price').css('display') === 'none') {
                              $('#priceinput').val('');
                          }
                      });
                      $('#entryTicketSelect').change(function() 
                      {
                          var selectedValue = $(this).val();

                          if (selectedValue === 'yes') {
                              $('#ticketInputField').show();
                              $('#price').show();
                              $('#entry-fee-adult').show();
                              $('#entry-fee-child').show();
                              $('#Numberofpersons').show();
                              $('#entry_fee').attr("required","required");
                              $('#child_entry_fee').attr("required","required");
                              $('#priceinput').attr("required","required");
                              $('#PersonsNumber').attr("required","required");
                              $('#ticketNumber').attr("required","required");
                          } else {
                              $('#ticketInputField').hide();
                              $('#Numberofpersons').hide();
                              $('#entry-fee-adult').hide();
                              $('#entry-fee-child').hide();
                              $('#price').hide();
                              $('#entry_fee').removeAttr("required").val(0);
                              $('#child_entry_fee').removeAttr("required").val(0);
                              $('#priceinput').removeAttr("required").val(0);
                              $('#PersonsNumber').removeAttr("required").val(0);
                              $('#ticketNumber').removeAttr("required").val('');
                          }
                      });
                  });

</script>
</body>

</html>