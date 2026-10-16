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
                <div class="page-title">Masters Creation Create Restaurants</div>
              </div>
              <ol class="breadcrumb page-breadcrumb pull-right">
                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                    href="<?=base_url();?>dashboard">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                </li>
                <li class="active">Masters Creation Create Restaurants</li>
              </ol>
            </div>
          </div>
          <?php echo $this->session->flashdata('message'); unset($_SESSION['message']); ?>
          <div class="row">
            <div class="col-sm-12">
              <div class="card-box">
                <div class="card-head">
                  <header>Masters Creation Create Restaurants</header>
                  <div class="tools">
                    <a href="all-masters-restaurants" class="btn btn-success" style="padding: 6px;"><i class="fa fa-file-text-o"></i>
                      List</a>
                    <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                  </div>
                </div>
                <?php echo form_open_multipart(); ?>
                <div class="card-body row">
                  
                                    <div class="col-lg-3 p-t-20">
                                        <div
                                            class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <?php
                      $readonly = [];
                      if ($this->session->userdata('admin_type') != 'superadmin' && $this->session->userdata('locations') != 'all') {
                        $readonly = ['readonly' => 'readonly'];
                      }
                      echo form_input(['name' => 'country', 'id' => 'country', 'required' => 'required', 'class' => 'mdl-textfield__input', 'value' => $country['label']] + $readonly) ?>
                                            <label class="mdl-textfield__label">Select Country</label>
                                            <?php echo form_error('country'); ?>
                                        </div>
                                    </div>
                                    <input type="hidden" name="country_id" id="country_id"
                                        value="<?php echo $country['country_id']; ?>">
                                    <div class="col-lg-3 p-t-20">
                                        <div
                                            class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <?php echo form_input(['name' => 'city', 'id' => 'city', 'class' => 'mdl-textfield__input', 'value' => set_value('city')]); ?>
                                            <label class="mdl-textfield__label">City</label>
                                            <?php echo form_error('city'); ?>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 p-t-20">
                                        <div
                                            class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <?php echo form_input(['name' => 'map', 'id' => 'map', 'class' => 'mdl-textfield__input', 'value' => set_value('map')]); ?>
                                            <label class="mdl-textfield__label">Map</label>
                                            <?php echo form_error('map'); ?>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 p-t-20">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <?php echo form_input(['name' => 'name', 'id' => 'name', 'class' => 'mdl-textfield__input', 'required' => 'required', 'value' => set_value('name')]); ?>
                                            <label class="mdl-textfield__label">Restaurant Name</label>
                                            <?php echo form_error('name'); ?>
                                        </div>
                                    </div>
                
                                    <div class="col-lg-3 p-t-20">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <textarea class="mdl-textfield__input" name="restaurant_address"></textarea>
                                            <label class="mdl-textfield__label">Restaurant Address</label>
                                            <?php echo form_error('restaurant_address'); ?>
                                        </div>
                                    </div>

                  <div class="col-lg-3 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <?php //echo form_input(['name' => 'price_range', 'id' => 'price_range', 'class' => 'mdl-textfield__input', 'value' => set_value('price_range')]); ?>
                        <select name="price_range" id="price_range" class="mdl-textfield__input">
                            <option value="">Select..</option>
                            <?php for($i=5;$i<=150;$i=$i+5){ ?>
                            <option value="<?php echo '$'.$i.' To $'.($i+5).' Per Person'; ?>"><?php echo '$'.$i.' To $'.($i+5).' Per Person'; ?></option>
                            <?php } ?>
                        </select> 
                      <label class="mdl-textfield__label">Price Range</label>
                      <?php echo form_error('price_range'); ?>
                    </div>
                  </div>
                  
                  <div class="col-lg-3 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <?php echo form_input(['name' => 'seating_capacity', 'id' => 'seating_capacity', 'class' => 'mdl-textfield__input', 'value' => set_value('seating_capacity')]); ?>
                      <label class="mdl-textfield__label">Seating Capacity</label>
                      <?php echo form_error('seating_capacity'); ?>
                    </div>
                  </div>
                  
                  <div class="col-lg-3 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width is-focused">
                      <input type="file" name="image" id="image" class="mdl-textfield__input"/>
                      <label class="mdl-textfield__label">Image</label>
                    </div>
                  </div>
                  
                  <div class="col-lg-12 p-t-20"><label class="bold">Cuisines: </label>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                            <input type="checkbox" value="indian" name="cuisine[]" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                            <label for="oname" class="" >Indian</label>
                            <input type="checkbox" value="asian" name="cuisine[]" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                            <label for="oname" class="" >Asian</label>
                            <input type="checkbox" value="pan asian" name="cuisine[]" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                            <label for="oname" class="" >Pan Asian</label>
                            <input type="checkbox" value="chinese" name="cuisine[]" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                            <label for="oname" class="" >Chinese</label>
                            <input type="checkbox" value="italian" name="cuisine[]" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                            <label for="oname" class="" >Italian</label>
                            <input type="checkbox" value="georgian" name="cuisine[]" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                            <label for="oname" class="" >Georgian</label>
                            <input type="checkbox" value="kazakh" name="cuisine[]" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                            <label for="oname" class="" >Kazakh</label>
                            <input type="checkbox" value="uzbek" name="cuisine[]" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                            <label for="oname" class="" >Uzbek</label>
                            <input type="checkbox" value="japanese" name="cuisine[]" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                            <label for="oname" class="" >Japanese</label>
                            <input type="checkbox" value="fast food" name="cuisine[]" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                            <label for="oname" class="" >Fast Food</label>
                            <input type="checkbox" value="european" name="cuisine[]" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                            <label for="oname" class="" >European</label>
                            <input type="checkbox" value="korean" name="cuisine[]" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                            <label for="oname" class="" >Korean</label>
                            <input type="checkbox" value="azerbaijani" name="cuisine[]" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                            <label for="oname" class="">Azerbaijani</label>
                        </div>
                    </div>
                </div>    
                
                <div class="col-lg-12 p-t-20"><label class="bold">Description: </label>
                    <textarea class="form-control txt_description" name="description" id="description"></textarea>
                    <script>CKEDITOR.replace( 'description');</script>
                    <br>
                </div>
                
                <div class="col-lg-4 p-t-20" id="div_remarks">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <input type="text" id="" name="remarks[]" class="mdl-textfield__input">
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