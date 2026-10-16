  <?php include('admin_head_css.php');?>  
  <link href="https://cdn.jsdelivr.net/gh/djibe/material@4.6.2-1.0/css/material-plugins.min.css" rel="stylesheet">

  <div class="page-wrapper">
    <!-- start page container -->
    <div class="container-fluid">
      <!-- start page content -->
      <div class="page-content-wrapper">
        <div class="page-bar">
            <div class="row page-titles">
                <div class="col-lg-3 col-sm-6  col-6 align-self-center">
                    <h4 class="text-themecolor">Add Guide</h4>
                </div>
                <div class="col-lg-2 only-for-dashbord">
                </div>
                <div class="col-lg-7 col-sm-6 col-6 align-self-center text-end">
                    <div class="d-flex justify-content-end align-items-center">
                        <ol class="breadcrumb justify-content-end">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Home</a></li>
                            <li class="breadcrumb-item"><a href="<?php echo base_url('all-guide'); ?>">Guide List</a></li>
                            <li class="breadcrumb-item active">Add Guide</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-content">
          <?php echo $this->session->flashdata('message'); unset($_SESSION['message']); ?>
          <div class="row">
            <div class="col-sm-12">
              <div class="card-box">
               
                <?php echo form_open_multipart(); ?>
                  <div class="card-body row">
                    
                    <div class="col-lg-4 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <label class="mdl-textfield__label">Country</label>
                      <?php echo form_input(['name' => 'country', 'id' => 'country', 'class' => 'mdl-textfield__input', 'required' => 'required', 'value' => set_value('country')]); ?>
                      <?php echo form_error('country'); ?>
                    </div>
                  </div>
                      
                    <div class="col-lg-4 p-t-20">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                          <label class="mdl-textfield__label">State</label>
                            <?php echo form_input(['name' => 'state', 'id' => 'state', 'class' => 'mdl-textfield__input',  'value' => set_value('state')]); ?>
                            <?php echo form_error('state'); ?>
                        </div>
                    </div>
                      
                    <div class="col-lg-4 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <label class="mdl-textfield__label">City</label>
                      <?php echo form_input(['name' => 'city', 'id' => 'city', 'class' => 'mdl-textfield__input',  'value' => set_value('city')]); ?>
                      <?php echo form_error('city'); ?>
                    </div>
                    </div>
                      
                    <div class="col-lg-2 p-t-20">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <label class="mdl-textfield__label">First Name</label>
                        <?php echo form_input(['name'=>'name','id'=>'name','class'=>'mdl-textfield__input','required'=>'required','value'=>set_value('name')])?>
                        <?php echo form_error('name');?>
                      </div>
                    </div>
                    <div class="col-lg-2 p-t-20">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <label class="mdl-textfield__label">Last Name</label>
                        <?php echo form_input(['name'=>'last_name','id'=>'last_name','class'=>'mdl-textfield__input','value'=>set_value('last_name')])?>
                        <?php echo form_error('last_name');?>
                      </div>
                    </div>

                    <div class="col-lg-4 p-t-20">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <label class="mdl-textfield__label">Gender</label>
                        <?php
                            $gender_options = [
                              '' => '',
                              'male' => 'Male',
                              'female' => 'Female',
                            ];

                            echo form_dropdown('gender', $gender_options, set_value('gender'), 'id="gender" class="mdl-textfield__input" style="padding-top:13px;" required');
                          ?>
                        <?php echo form_error('gender');?>
                      </div>
                    </div>


                    <div class="col-lg-4 p-t-20">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <label class="mdl-textfield__label">Photo</label>
                        <?php
                            echo form_upload([
                              'name' => 'photo',
                              'id' => 'photo',
                              'class' => 'mdl-textfield__input',
                            ]);
                          ?>
                        <?php echo form_error('photo');?>
                      </div>
                    </div>

                    <div class="col-lg-4 p-t-20">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <label class="mdl-textfield__label">Location</label>
                        <?php
                          echo form_input([
                            'name' => 'location',  // Set the 'name' attribute
                            'id' => 'location',
                            'class' => 'mdl-textfield__input',
                            'value' => set_value('location')
                          ]);
                        ?>
                        <?php echo form_error('location');?>
                      </div>
                    </div>

                    <div class="col-lg-4 p-t-20">
                      <div>
                        <div class="d-flex">
                              <label class = "mdl-textfield__label">ISD &nbsp;&nbsp; Mobile</label><?php echo form_error('isd_codes');?>
                            <!-- <label class = "mdl-textfield__label"></label> -->
                        </div>
                        
                          <div class="d-flex" style="border: 1px solid #ccc;border-radius: 5px;">
                                  <select name="isd_codes" class="" style="border-width: 0 !important;width: 100px;border-radius: 6px;">
                                <?php 
                                $selected = '+91';
                                $allowed_countries = ['AZ','BY','IN','KZ','GE','AE','AM', 'UZ','CZ'];
                                foreach($country_isd_codes AS $list){  
                                      if(in_array($list->country_code,$allowed_countries)){
                                    ?>
                                          <option value="<?=$list->isd_codes?>" <?php echo ($list->isd_codes==$selected)?'selected':''; ?> ><?=$list->isd_codes.' ('.$list->country.')'; ?></option>
                                <?php } } ?>
                              </select>
                              <div class = " mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                          
                                <?php echo form_input(['name'=>'mobile','id'=>'mobile','class'=>'mdl-textfield__input','type'=>'number','required'=>'required','value'=>set_value('mobile')])?>
                                  <?php echo form_error('mobile'); ?>	 
                              </div>
                          </div>
                            
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
                        <label class="mdl-textfield__label">Remark</label>
                        <?php echo form_input(['name'=>'remarks','id'=>'remarks', 'class'=>'mdl-textfield__input', 'value'=>set_value('remarks')])?>
                        <?php echo form_error('remarks'); ?>
                      </div>
                    </div>
                    <input type="hidden" name="state_id" id="state_id" value="">

                    <div class="col-lg-12 p-t-20 text-center">
                      <?php echo form_submit(['name'=>'submit','id'=>'submit', 'class'=>'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-info', 'value'=>'Submit']);?>
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
  </div>

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