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
                <div class="page-title">Edit Hotel</div>
              </div>
              <ol class="breadcrumb page-breadcrumb pull-right">
                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                    href="<?=base_url();?>dashboard">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                </li>
                <li class="active">Edit Hotel</li>
              </ol>
            </div>
          </div>
          <?php echo $this->session->flashdata('message'); unset($_SESSION['message']); ?>
          <div class="row">
            <div class="col-sm-12">
              <div class="card-box">
                <div class="card-head">
                  <header>Add Hotel</header>
                  <div class="tools">
                    <a href="all-hotel" class="btn btn-success" style="padding: 6px;"><i class="fa fa-file-text-o"></i>
                      List</a>
                    <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                  </div>
                </div>
                <?php echo form_open_multipart(current_url().'?'.$_SERVER['QUERY_STRING']); ?>
                <div class="card-body row">
                  <div class="col-lg-4 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <?php echo form_input(['name' => 'name', 'id' => 'name', 'class' => 'mdl-textfield__input', 'required' => 'required', 'value' => $hotels->name]); ?>
                      <label class="mdl-textfield__label">Hotel Name</label>
                      <?php echo form_error('name'); ?>
                    </div>
                  </div>
                
                    <div class="col-lg-4 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <select name="category" class="mdl-textfield__input" style="padding-top:13px;">
                        <option value="">Select Category..</option>  
                        <option value="3 Star" <?php echo ($hotels->category == '3 Star')?'selected':''; ?>>3 Star</option>
                        <option value="4 Star" <?php echo ($hotels->category == '4 Star')?'selected':''; ?>>4 Star</option>
                        <option value="5 Star" <?php echo ($hotels->category == '5 Star')?'selected':''; ?>>5 Star</option>
                        <option value="5 Star Luxury" <?php echo ($hotels->category == '5 Star Luxury')?'selected':''; ?>>5 Star Luxury</option>
                      </select>
                      <label class="mdl-textfield__label">Category</label>
                      <?php echo form_error('isd_codes'); ?>
                    </div>
                  </div>
                
                    <div class="col-lg-4 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <?php 
                      $readonly=[];
                      if($this->session->userdata('admin_type') != 'superadmin' && $this->session->userdata('locations')!='all'){
                          $readonly = ['readonly'=>'readonly'];
                      }
                      echo form_input(['name'=>'country','id'=>'country', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>$hotels->country]+$readonly)?>
                      <label class="mdl-textfield__label">Select Country</label>
                      <?php echo form_error('country'); ?>
                    </div>
                  </div>

                    
                  <div class="col-lg-4 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <?php echo form_input(['name' => 'state', 'id' => 'state', 'class' => 'mdl-textfield__input', 'value' => $hotels->state]); ?>
                      <label class="mdl-textfield__label">State</label>
                      <?php echo form_error('state'); ?>
                    </div>
                  </div>

                    
                  <div class="col-lg-4 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <?php echo form_input(['name' => 'city', 'id' => 'city', 'class' => 'mdl-textfield__input', 'value' => $hotels->city]); ?>
                      <label class="mdl-textfield__label">City</label>
                      <?php echo form_error('city'); ?>
                    </div>
                  </div>
            
                    
                  <div class="col-lg-4 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <?php echo form_input(['name' => 'pincode', 'id' => 'pincode', 'class' => 'mdl-textfield__input', 'type' => 'number', 'value' => $hotels->pincode]); ?>
                      <label class="mdl-textfield__label">Pincode</label>
                      <?php echo form_error('pincode'); ?>
                    </div>
                  </div>
            
                  <div class="col-lg-4 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <?php echo form_input(['name' => 'address_1', 'id' => 'address_1', 'class' => 'mdl-textfield__input', 'value' => $hotels->address_1]); ?>
                      <label class="mdl-textfield__label">Address 1</label>
                      <?php echo form_error('address_1'); ?>
                    </div>
                  </div>

                  <div class="col-lg-4 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <?php echo form_input(['name' => 'address_2', 'id' => 'address_2', 'class' => 'mdl-textfield__input', 'value' => $hotels->address_2]); ?>
                      <label class="mdl-textfield__label">Address 2</label>
                      <?php echo form_error('address_2'); ?>
                    </div>
                  </div>

                  <div class="col-lg-4 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <?php echo form_input(['name' => 'contact_person_name', 'id' => 'contact_person_name', 'class' => 'mdl-textfield__input', 'value' => $hotels->contact_person_name]); ?>
                      <label class="mdl-textfield__label">Contact Person Name</label>
                      <?php echo form_error('contact_person_name'); ?>
                    </div>
                  </div>

                  <div class="col-lg-4 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <select name="isd_codes" class="mdl-textfield__input" style="padding-top:13px;">
                        <?php 
                          $selected = $hotels->isd_codes;
                          $allowed_countries = ['AZ','BY','IN','KZ','GE'];
                          foreach($country_isd_codes AS $list){  
                            if(in_array($list->country_code,$allowed_countries)){
                        ?>
                        <option value="<?=$list->isd_codes?>"
                          <?php echo ($list->isd_codes == $selected) ? 'selected' : ''; ?>>
                          <?=$list->isd_codes.' ('.$list->country.')'; ?></option>
                        <?php } } ?>
                      </select>
                      <label class="mdl-textfield__label">ISD</label>
                      <?php echo form_error('isd_codes'); ?>
                    </div>
                  </div>

                    <div class="col-lg-4 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <?php echo form_input(['name' => 'mobile', 'id' => 'mobile', 'class' => 'mdl-textfield__input', 'type' => 'number', 'required' => 'required', 'value' => $hotels->mobile]); ?>
                      <label class="mdl-textfield__label">Telephone</label>
                      <?php echo form_error('mobile'); ?>
                    </div>
                  </div>

                  <div class="col-lg-4 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <?php echo form_input(['name' => 'email', 'id' => 'email', 'class' => 'mdl-textfield__input', 'value' => $hotels->email]); ?>
                      <label class="mdl-textfield__label">Email</label>
                      <?php echo form_error('email'); ?>
                    </div>
                  </div>

                  <div class="col-lg-4 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <?php echo form_input(['name' => 'remarks', 'id' => 'remarks', 'class' => 'mdl-textfield__input', 'value' => $hotels->remarks]); ?>
                      <label class="mdl-textfield__label">Remarks</label>
                      <?php echo form_error('remarks'); ?>
                    </div>
                  </div>
                  
                  <div class="col-lg-4 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <?php echo form_input(['name' => 'map', 'id' => 'map', 'class' => 'mdl-textfield__input', 'value' => $hotels->map]); ?>
                      <label class="mdl-textfield__label">Map</label>
                      <?php echo form_error('map'); ?>
                    </div>
                  </div>
                   
                   <div class="col-lg-4 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width is-focused">
                      <input type="file" name="hotel_image" id="hotel_image" class="mdl-textfield__input"/>
                      <label class="mdl-textfield__label">Image</label>
                    </div>
                  </div>
                  
                  <div class="col-lg-4">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width is-focused">
                      <img src="<?php echo base_url('uploads/hotels/'.$hotels->image); ?>" height="75" width="75">
                    </div>
                  </div>

                    <div class="col-lg-12 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width is-focused">
                        <?php echo $hotels->map; ?>
                    </div>
                  </div>

                  <div class="col-lg-12 p-t-20 text-center">
                    <?php echo form_submit(['name'=>'submit','id'=>'submit', 'class'=>'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-pink', 'value'=>'Submit']);?>
                  </div>


                  <div <?php echo form_close(); ?> </div>
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

            $("#state").autocomplete({
              source: function (request, response) {
                // Fetch data
                $.ajax({
                  url: "<?=base_url()?>admin/company/get_state_ajax",
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
                $('#state').val(ui.item.label); // display the selected text
                $('#state_id').val(ui.item.state_id); // save selected id to input

                return false;
              }
            });

            $("#city").autocomplete({
              source: function (request, response) {
                // Fetch data
                $.ajax({
                  url: "<?=base_url()?>admin/company/get_city_ajax",
                  type: 'post',
                  dataType: "json",
                  data: {
                    search: request.term,
                    state_id: $('#state_id').val()
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