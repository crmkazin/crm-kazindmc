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
                <div class="page-title">Masters Creation Edit</div>
              </div>
              <ol class="breadcrumb page-breadcrumb pull-right">
                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                    href="<?=base_url();?>dashboard">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                </li>
                <li class="active">Masters Creation Edit</li>
              </ol>
            </div>
          </div>
          <?php echo $this->session->flashdata('message'); unset($_SESSION['message']); ?>
          <div class="row">
            <div class="col-sm-12">
              <div class="card-box">
                <div class="card-head">
                  <header>Masters Creation Edit</header>
                  <div class="tools">
                    <a href="all-masters" class="btn btn-success" style="padding: 6px;"><i class="fa fa-file-text-o"></i>
                      List</a>
                    <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                  </div>
                </div>
                <?php echo form_open_multipart(current_url().'?'.$_SERVER['QUERY_STRING']); ?>
                <div class="card-body row">
                  
                    <div class="col-lg-4 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <?php 
                      $readonly=[];
                      if($this->session->userdata('admin_type') != 'superadmin' && $this->session->userdata('locations')!='all'){
                          $readonly = ['readonly'=>'readonly'];
                      }
                      echo form_input(['name'=>'country','id'=>'country', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>$result->country]+$readonly)?>
                      <label class="mdl-textfield__label">Select Country</label>
                      <?php echo form_error('country'); ?>
                    </div>
                  </div>
                    <input type="hidden" name="country_id" id="country_id" value="<?php echo $country_id; ?>">
                    <div class="col-lg-4 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <?php echo form_input(['name' => 'city', 'id' => 'city', 'class' => 'mdl-textfield__input', 'value' => $result->city]); ?>
                      <label class="mdl-textfield__label">City</label>
                      <?php echo form_error('city'); ?>
                    </div>
                  </div>
                    
                    <div class="col-lg-4 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <?php echo form_input(['name' => 'name', 'id' => 'name', 'class' => 'mdl-textfield__input', 'required' => 'required', 'value' => $result->site_name]); ?>
                      <label class="mdl-textfield__label">Name</label>
                      <?php echo form_error('name'); ?>
                    </div>
                  </div>

                <div class="col-lg-4 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <select name="category" class="mdl-textfield__input" style="padding-top:13px;" required="">
                            <option value=""></option>      
                            <option value="sitescene" <?=($result->category=='sitescene')?'selected="selected"':''; ?> >Sightseeing</option>
                            <option value="activity" <?=($result->category=='activity')?'selected="selected"':''; ?>>Activity</option>
                            <option value="night-life" <?=($result->category=='night-life')?'selected="selected"':''; ?>>Night Life</option>
                            <option value="transfers" <?=($result->category=='transfers')?'selected="selected"':''; ?>>Transfers</option>
                            <option value="miscellaneous" <?=($result->category=='miscellaneous')?'selected="selected"':''; ?>>Miscellaneous</option>
                        </select>
                      <label class="mdl-textfield__label">Category</label>
                      <?php echo form_error('category'); ?>
                    </div>
                  </div>

                <div class="col-lg-4 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <select name="entry_ticket" class="mdl-textfield__input" style="padding-top:13px;">
                            <option value=""></option>      
                            <option value="yes" <?=($result->entry_ticket=='yes')?'selected="selected"':''; ?>>Yes</option>
                            <option value="no" <?=($result->entry_ticket=='no')?'selected="selected"':''; ?>>No</option>
                        </select>
                      <label class="mdl-textfield__label">Entry Ticket</label>
                      <?php echo form_error(''); ?>
                    </div>
                  </div>
                <div class="col-lg-4 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <input type="time" id="departing_time" name="departing_time" class="mdl-textfield__input" value="<?php echo $result->departing_time_from_hotel; ?>">
                        <label class="mdl-textfield__label">Departing Time From Hotel</label>
                    </div>
                </div>
                
                <div class="col-lg-4 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <input type="text" id="duration" name="duration" class="mdl-textfield__input" value="<?php echo $result->duration; ?>">
                        <label class="mdl-textfield__label">Duration</label>
                    </div>
                </div>    
                    
                <div class="col-lg-12 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <textarea class="form-control txt_description" name="description" id="description"><?php echo $result->description; ?></textarea>
                        <script>CKEDITOR.replace( 'description');</script>
                    </div>
                </div>
                  <input type="hidden" name="" id="sites_id" value="<?php echo $result->id; ?>">
                <?php foreach($result_remarks AS $list){ ?>
                <div class="col-lg-4 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <input type="text" id="" name="edit_remarks[]" value="<?php echo $list->remarks; ?>" class="mdl-textfield__input">
                        <input type="hidden" id="" name="edit_id_remarks[]" value="<?php echo $list->id; ?>" class="mdl-textfield__input">
                        <label class="mdl-textfield__label">Remarks</label>
                    </div>
                    <i title="Remove" class="fa fa-window-close edit-remove" style="color:red;cursor: pointer;float: right;margin-top: -15px;position:relative;" data-id="<?=$list->id?>"></i>
                </div>
                <?php } ?>
                
                <div class="col-lg-4 p-t-20" id="div_remarks">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <input type="text" id="" name="remarks[]" value="" class="mdl-textfield__input">
                        <label class="mdl-textfield__label">Remarks</label>
                    </div>
                </div>  
                
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
                $($("#div_remarks").clone()).insertBefore("#addnew"); 
            });
            
            
            $(".edit-remove").on("click",function(e){
                if(!confirm('Are You Sure?')){
                    return false;
                }
                e.preventDefault();
                var ele = $(this);
                $.ajax({
                    url: "<?php echo site_url('edit_remove_masters_remarks'); ?>",
                    type: "post",
                    data: { 'id': ele.attr("data-id"),'sites_id':$("#sites_id").val() },
                    dataType : 'JSON',
                    //contentType : false,
                    //processData: false,
                    beforeSend: function(){
                    },
                    success: function (res) {
                        if(res.response === "s"){
                            ele.parent().remove();                     
                        }
                    }
                });
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


          });
        </script>
</body>

</html>