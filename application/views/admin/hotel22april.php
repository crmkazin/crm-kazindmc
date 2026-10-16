<?php include('admin_head_css.php');?>
 <div class="page-wrapper">
    <div class="container-fluid">
      <div class="page-content-wrapper">
        <div class="page-bar">
          <div class="row page-titles">
            <div class="col-lg-3 col-sm-6  col-6 align-self-center">
              <h4 class="text-themecolor">Add Hotel</h4>
            </div>
            <div class="col-lg-2 only-for-dashbord">
            </div>
            <div class="col-lg-7 col-sm-6 col-6 align-self-center text-end">
              <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb justify-content-end">
                  <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Home</a></li>                  <li class="breadcrumb-item active">Add Hotel</li>
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
                <div class="card-head">
                  <header>Add Hotel</header>
                  <div class="tools">
                    <a href="all-hotel" class="btn btn-success" style="padding: 6px;"><i class="fa fa-file-text-o"></i>
                      List</a>
                    <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                  </div>
                </div>
                <?php echo form_open_multipart(); ?>
                <div class="card-body row">
                  <div class="col-lg-4 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <?php echo form_input(['name' => 'name', 'id' => 'name', 'class' => 'mdl-textfield__input', 'required' => 'required', 'value' => set_value('name')]); ?>
                      <label class="mdl-textfield__label">Hotel Name</label>
                      <?php echo form_error('name'); ?>
                    </div>
                  </div>

                <div class="col-lg-4 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <select name="category" class="mdl-textfield__input" style="padding-top:13px;">
                        <option value="">Select Category..</option>  
                        <option value="3 Star">3 Star</option>
                        <option value="4 Star">4 Star</option>
                        <option value="5 Star">5 Star</option>
                        <option value="5 Star Luxury">5 Star Luxury</option>
                      </select>
                      <label class="mdl-textfield__label">Category</label>
                      <?php echo form_error('isd_codes'); ?>
                    </div>
                  </div>

                    <div class="col-lg-4 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <?php 
                        $readonly=[];
                        $country = '';
                        if($this->session->userdata('admin_type') != 'superadmin' && $this->session->userdata('locations')!='all'){
                            $readonly = ['readonly'=>'readonly'];
                            $country = ucfirst($this->session->userdata('locations'));
                        }
                        echo form_input(['name'=>'country','id'=>'country', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>$country]+$readonly)?>
                      <label class="mdl-textfield__label">Select Country</label>
                      <?php echo form_error('country'); ?>
                    </div>
                  </div>

                    
                  <div class="col-lg-4 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <?php echo form_input(['name' => 'state', 'id' => 'state', 'class' => 'mdl-textfield__input', 'value' => set_value('state')]); ?>
                      <label class="mdl-textfield__label">State</label>
                      <?php echo form_error('state'); ?>
                    </div>
                  </div>

                    
                  <div class="col-lg-4 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <?php echo form_input(['name' => 'city', 'id' => 'city', 'class' => 'mdl-textfield__input', 'value' => set_value('city')]); ?>
                      <label class="mdl-textfield__label">City</label>
                      <?php echo form_error('city'); ?>
                    </div>
                  </div>
            
                    
                  <div class="col-lg-4 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <?php echo form_input(['name' => 'pincode', 'id' => 'pincode', 'class' => 'mdl-textfield__input', 'type' => 'number', 'value' => set_value('pincode')]); ?>
                      <label class="mdl-textfield__label">Pincode</label>
                      <?php echo form_error('pincode'); ?>
                    </div>
                  </div>
            
                  <div class="col-lg-4 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <?php echo form_input(['name' => 'address_1', 'id' => 'address_1', 'class' => 'mdl-textfield__input', 'value' => set_value('address_1')]); ?>
                      <label class="mdl-textfield__label">Address 1</label>
                      <?php echo form_error('address_1'); ?>
                    </div>
                  </div>

                  <div class="col-lg-4 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <?php echo form_input(['name' => 'address_2', 'id' => 'address_2', 'class' => 'mdl-textfield__input', 'value' => set_value('address_2')]); ?>
                      <label class="mdl-textfield__label">Address 2</label>
                      <?php echo form_error('address_2'); ?>
                    </div>
                  </div>

                  <div class="col-lg-4 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <?php echo form_input(['name' => 'contact_person_name', 'id' => 'contact_person_name', 'class' => 'mdl-textfield__input', 'value' => set_value('contact_person_name')]); ?>
                      <label class="mdl-textfield__label">Contact Person Name</label>
                      <?php echo form_error('contact_person_name'); ?>
                    </div>
                  </div>

                  <div class="col-lg-4 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <select name="isd_codes" class="mdl-textfield__input" style="padding-top:13px;">
                        <?php 
                          $selected = '+91';
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
                      <?php echo form_input(['name' => 'mobile', 'id' => 'mobile', 'class' => 'mdl-textfield__input', 'type' => 'number', 'required' => 'required', 'value' => set_value('mobile')]); ?>
                      <label class="mdl-textfield__label">Telephone</label>
                      <?php echo form_error('mobile'); ?>
                    </div>
                  </div>

                  <div class="col-lg-4 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <?php echo form_input(['name' => 'email', 'id' => 'email', 'class' => 'mdl-textfield__input', 'value' => set_value('email')]); ?>
                      <label class="mdl-textfield__label">Email</label>
                      <?php echo form_error('email'); ?>
                    </div>
                  </div>

                  <div class="col-lg-4 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <?php echo form_input(['name' => 'remarks', 'id' => 'remarks', 'class' => 'mdl-textfield__input', 'value' => set_value('remarks')]); ?>
                      <label class="mdl-textfield__label">Remarks</label>
                      <?php echo form_error('remarks'); ?>
                    </div>
                  </div>
                  
                  <div class="col-lg-4 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <?php echo form_input(['name' => 'map', 'id' => 'map', 'class' => 'mdl-textfield__input', 'value' => set_value('map')]); ?>
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
