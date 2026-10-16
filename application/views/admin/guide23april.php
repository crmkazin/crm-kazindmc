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
  <link href="https://cdn.jsdelivr.net/gh/djibe/material@4.6.2-1.0/css/material-plugins.min.css" rel="stylesheet">
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
                <div class="page-title">Add Guide</div>
              </div>
              <ol class="breadcrumb page-breadcrumb pull-right">
                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                    href="<?=base_url();?>dashboard">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                </li>
                <li class="active">Add Guide</li>
              </ol>
            </div>
          </div>
          <?php echo $this->session->flashdata('message'); unset($_SESSION['message']); ?>
          <div class="row">
            <div class="col-sm-12">
              <div class="card-box">
                <div class="card-head">
                  <header>Add Guide</header>
                  <div class="tools">
                    <a href="all-guide" class="btn btn-success" style="padding: 6px;"><i class="fa fa-file-text-o"></i>
                      List</a>
                    <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                  </div>
                </div>
                <?php echo form_open_multipart(); ?>
                  <div class="card-body row">
                    
                    <div class="col-lg-4 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <?php echo form_input(['name' => 'country', 'id' => 'country', 'class' => 'mdl-textfield__input', 'required' => 'required', 'value' => set_value('country')]); ?>
                      <label class="mdl-textfield__label">Country</label>
                      <?php echo form_error('country'); ?>
                    </div>
                  </div>
                      
                    <div class="col-lg-4 p-t-20">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                            <?php echo form_input(['name' => 'state', 'id' => 'state', 'class' => 'mdl-textfield__input',  'value' => set_value('state')]); ?>
                            <label class="mdl-textfield__label">State</label>
                            <?php echo form_error('state'); ?>
                        </div>
                    </div>
                      
                    <div class="col-lg-4 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <?php echo form_input(['name' => 'city', 'id' => 'city', 'class' => 'mdl-textfield__input',  'value' => set_value('city')]); ?>
                      <label class="mdl-textfield__label">City</label>
                      <?php echo form_error('city'); ?>
                    </div>
                    </div>
                    
                      
                      
                    <div class="col-lg-2 p-t-20">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <?php echo form_input(['name'=>'name','id'=>'name','class'=>'mdl-textfield__input','required'=>'required','value'=>set_value('name')])?>
                        <label class="mdl-textfield__label">First Name</label><?php echo form_error('name');?>
                      </div>
                    </div>
                    <div class="col-lg-2 p-t-20">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <?php echo form_input(['name'=>'last_name','id'=>'last_name','class'=>'mdl-textfield__input','value'=>set_value('last_name')])?>
                        <label class="mdl-textfield__label">Last Name</label><?php echo form_error('last_name');?>
                      </div>
                    </div>

                    <div class="col-lg-4 p-t-20">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <?php
                            $gender_options = [
                              '' => '',
                              'male' => 'Male',
                              'female' => 'Female',
                            ];

                            echo form_dropdown('gender', $gender_options, set_value('gender'), 'id="gender" class="mdl-textfield__input" style="padding-top:13px;" required');
                          ?>
                        <label class="mdl-textfield__label">Gender</label><?php echo form_error('gender');?>
                      </div>
                    </div>


                    <div class="col-lg-4 p-t-20">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <?php
                            echo form_upload([
                              'name' => 'photo',
                              'id' => 'photo',
                              'class' => 'mdl-textfield__input',
                            ]);
                          ?>
                        <label class="mdl-textfield__label">Photo</label><?php echo form_error('photo');?>
                      </div>
                    </div>

                    <div class="col-lg-4 p-t-20">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">

                        <?php
                          echo form_input([
                            'name' => 'location',  // Set the 'name' attribute
                            'id' => 'location',
                            'class' => 'mdl-textfield__input',
                            'value' => set_value('location')
                          ]);
                        ?>
                        <label class="mdl-textfield__label">Location</label><?php echo form_error('location');?>
                      </div>
                    </div>


                    <div class="col-lg-2 p-t-20">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <select name="isd_codes" class="mdl-textfield__input" style="padding-top:13px;">
                          <?php 
                                                  $selected = '+91';
                                                  $allowed_countries = ['AZ','BY','IN','KZ','GE'];
                                                  foreach($country_isd_codes AS $list){  
                                                        if(in_array($list->country_code,$allowed_countries)){
                                                      ?>
                          <option value="<?=$list->isd_codes?>"
                            <?php echo ($list->isd_codes==$selected)?'selected':''; ?>>
                            <?=$list->isd_codes.' ('.$list->country.')'; ?></option>
                          <?php } } ?>
                        </select>
                        <label class="mdl-textfield__label">ISD</label><?php echo form_error('isd_codes');?>
                      </div>
                    </div>

                    <div class="col-lg-2 p-t-20">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <?php echo form_input(['name'=>'mobile','id'=>'mobile','class'=>'mdl-textfield__input','type'=>'number','required'=>'required','value'=>set_value('mobile')])?>
                        <label class="mdl-textfield__label">Mobile</label><?php echo form_error('mobile'); ?>
                      </div>
                    </div>
                    <?php $languages = ['kazakh','russian','korean','german','polish','yiddish','ukrainian','turkish','uzbek','uyghur','arabic','english','hindi','azerbaijani',' azeri','azeri turkish','georgian','belarusian']; ?>
                    <div class="col-lg-4 p-t-20"> 
                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                            <select name="languages[]" id="languages" class="mdl-textfield__input js-example-basic-multiple" multiple=""> 
                                <option value="all">All</option>
                                <?php foreach($languages AS $list){ ?>
                                <option value="<?=$list; ?>"><?php echo ucfirst($list); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>


                    <div class="col-lg-4 p-t-20">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">

                        <?php echo form_input(['name'=>'remarks','id'=>'remarks', 'class'=>'mdl-textfield__input', 'value'=>set_value('remarks')])?>
                        <label class="mdl-textfield__label">Remark</label><?php echo form_error('remarks'); ?>
                      </div>
                    </div>
                    <input type="hidden" name="state_id" id="state_id" value="">

                    <div class="col-lg-12 p-t-20 text-center">
                      <?php echo form_submit(['name'=>'submit','id'=>'submit', 'class'=>'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-pink', 'value'=>'Submit']);?>
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


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <!-- jQuery UI -->
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script> 
  <script>
    $(function() {
        $('.js-example-basic-multiple').select2({
          //theme: 'filled',
          placeholder: 'Languages',
          width: '400px'
        });
    });  
      
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