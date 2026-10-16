  <?php include('admin_head_css.php');?>
  <div class="page-wrapper">
    <!-- start page container -->
    <div class="container-fluid">
      <div class="page-content-wrapper">
        <div class="page-bar">
            <div class="row page-titles">
                <div class="col-lg-3 col-sm-6  col-6 align-self-center">
                    <h4 class="text-themecolor">Add Transport</h4>
                </div>
                <div class="col-lg-2 only-for-dashbord">
                </div>
                <div class="col-lg-7 col-sm-6 col-6 align-self-center text-end">
                    <div class="d-flex justify-content-end align-items-center">
                        <ol class="breadcrumb justify-content-end">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Home</a></li>
                            <li class="breadcrumb-item"><a href="<?php echo base_url('all-transport'); ?>">Transport List</a></li>
                            <li class="breadcrumb-item active">Add Transport</li>
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
                      <?php 
                        $readonly=[];
                        $country = '';
                        if($this->session->userdata('admin_type') != 'superadmin' && $this->session->userdata('locations')!='all'){
                            $readonly = ['readonly'=>'readonly'];
                            $country = ucfirst($this->session->userdata('locations'));
                        }
                      echo form_input(['name' => 'country', 'id' => 'country', 'class' => 'mdl-textfield__input', 'required' => 'required', 'value' => $country]+$readonly); ?>
                      <?php echo form_error('country'); ?>
                    </div>
                  </div>
                  
                  <div class="col-lg-4 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <label class="mdl-textfield__label">State</label>
                      <?php echo form_input(['name' => 'state', 'id' => 'state', 'class' => 'mdl-textfield__input', 'value' => set_value('state')]); ?>
                      <?php echo form_error('state'); ?>
                    </div>
                  </div>
                  
                  <div class="col-lg-4 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <label class="mdl-textfield__label">City</label>
                      <?php echo form_input(['name' => 'city', 'id' => 'city', 'class' => 'mdl-textfield__input', 'value' => set_value('city')]); ?>
                      <?php echo form_error('city'); ?>
                    </div>
                  </div>
                  
                  <div class="col-lg-4 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <label class="mdl-textfield__label">Vehicle Name</label>
                      <?php echo form_input(['name' => 'vehicle_name', 'id' => 'vehicle_name', 'class' => 'mdl-textfield__input', 'required' => 'required', 'value' => set_value('vehicle_name')]); ?>
                      <?php echo form_error('vehicle_name'); ?>
                    </div>
                  </div>
                  
                  <div class="col-lg-4 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <label class="mdl-textfield__label">Vehicle Type</label>
                      <?php echo form_input(['name' => 'vehicle_type', 'id' => 'vehicle_type', 'class' => 'mdl-textfield__input', 'required' => 'required', 'value' => set_value('vehicle_type')]); ?>
                      <?php echo form_error('vehicle_type'); ?>
                    </div>
                  </div>

                  <div class="col-lg-4 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <label class="mdl-textfield__label">Capacity</label>
                      <?php echo form_input(['name' => 'capacity', 'id' => 'capacity', 'class' => 'mdl-textfield__input', 'required' => 'required', 'type' => 'number', 'value' => set_value('capacity')]); ?>
                      <?php echo form_error('capacity'); ?>
                    </div>
                  </div>
                  
                  <div class="col-lg-4 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <label class="mdl-textfield__label">Year Of Make</label>
                      <?php echo form_input(['name' => 'year', 'id' => 'year', 'class' => 'mdl-textfield__input', 'required' => 'required', 'type' => 'text', 'value' => set_value('year')]); ?>
                      <?php echo form_error('year'); ?>
                    </div>
                  </div>
                  
                  <div class="col-lg-4 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <label class="mdl-textfield__label">Make</label>
                      <?php echo form_input(['name' => 'make', 'id' => 'make', 'class' => 'mdl-textfield__input', 'required' => 'required', 'type' => 'text', 'value' => set_value('make')]); ?>
                      <?php echo form_error('make'); ?>
                    </div>
                  </div>
                  
                  <div class="col-lg-2 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <label class="mdl-textfield__label" style="padding:22px 35px;">Luggage vehicle</label>
                      <input type="checkbox" name="luggage_transport" style="display: inline-block;padding-right: 100px;width: 30px;/* margin-bottom: 40px; */position: relative;bottom: 41px;" />
                    </div>
                  </div>

                  <div class="col-lg-2 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <label class="mdl-textfield__label">Luggage Capacity</label>
                      <?php echo form_input(['name' => 'luggage', 'id' => 'luggage', 'class' => 'mdl-textfield__input', 'required' => 'required', 'type' => 'text', 'value' => set_value('luggage')]); ?>
                      <?php echo form_error('luggage'); ?>
                    </div>
                  </div>
                  

                  <div class="col-lg-4 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <label class="mdl-textfield__label">Remarks</label>
                      <?php echo form_input(['name' => 'remarks', 'id' => 'remarks', 'class' => 'mdl-textfield__input', 'value' => set_value('remarks')]); ?>
                      <?php echo form_error('remarks'); ?>
                    </div>
                  </div>

                    <div class="col-lg-4 p-t-20"> 
                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width is-focused">
                          <label class = "mdl-textfield__label">Images (Maximum:4 Images Allowed Of 2MB Each)</label>	 	 
                          <input type="file" name="upload_images[]" class="mdl-textfield__input" style="" multiple/>
                        </div>
                    </div>
                    
                  <div class="col-lg-12 p-t-20 text-center">
                    <?php echo form_submit(['name' => 'submit', 'id' => 'submit', 'class' => 'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-info', 'value' => 'Submit']); ?>
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
  </div>
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
