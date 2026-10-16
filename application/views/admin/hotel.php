yes<?php include('admin_head_css.php');?>
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
                  <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Home</a></li>
                  <li class="breadcrumb-item"><a href="<?php echo base_url('all-hotel'); ?>">Hotel List</a></li>
                  <li class="breadcrumb-item active">Add Hotel</li>
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
                        <label class="mdl-textfield__label">Hotel Name</label>
                        <?php echo form_input(['name' => 'name', 'id' => 'name', 'class' => 'mdl-textfield__input', 'required' => 'required', 'value' => set_value('name')]); ?>
                        <?php echo form_error('name'); ?>
                      </div>
                    </div>

                    <div class="col-lg-4 p-t-20">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <label class="mdl-textfield__label">Category</label>
                        <select name="category" class="mdl-textfield__input" style="padding-top:13px;">
                          <option value="">Select Category..</option>  
                          <option value="3 Star">3 Star</option>
                          <option value="4 Star">4 Star</option>
                          <option value="4 Star">Boutique Resort</option>
                          <option value="5 Star">5 Star</option>
                          <option value="5 Star Luxury">5 Star Luxury</option>
                        </select>
                        <?php echo form_error('isd_codes'); ?>
                      </div>
                    </div>
                    
                    <input type="hidden" name="booting_resort" value="no" id="booting_resort">

                    <div class="col-lg-4 p-t-20">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <label class="mdl-textfield__label">Select Country</label>
                        <?php 
                          $readonly=[];
                          $country = '';
                          if($this->session->userdata('admin_type') != 'superadmin' && $this->session->userdata('locations')!='all'){
                              $readonly = ['readonly'=>'readonly'];
                              $country = ucfirst($this->session->userdata('locations'));
                          }
                          echo form_input(['name'=>'country','id'=>'country', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>$country]+$readonly)?>
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
                        <label class="mdl-textfield__label">Pincode</label>
                        <?php echo form_input(['name' => 'pincode', 'id' => 'pincode', 'class' => 'mdl-textfield__input', 'type' => 'number', 'value' => set_value('pincode')]); ?>
                        <?php echo form_error('pincode'); ?>
                      </div>
                    </div>
              
                    <div class="col-lg-4 p-t-20">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <label class="mdl-textfield__label">Address 1</label>
                        <?php echo form_input(['name' => 'address_1', 'id' => 'address_1', 'class' => 'mdl-textfield__input', 'value' => set_value('address_1')]); ?>
                        <?php echo form_error('address_1'); ?>
                      </div>
                    </div>

                    <div class="col-lg-4 p-t-20">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <label class="mdl-textfield__label">Address 2</label>
                        <?php echo form_input(['name' => 'address_2', 'id' => 'address_2', 'class' => 'mdl-textfield__input', 'value' => set_value('address_2')]); ?>
                        <?php echo form_error('address_2'); ?>
                      </div>
                    </div>

                    <div class="col-lg-4 p-t-20">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <label class="mdl-textfield__label">Contact Person Name</label>
                        <?php echo form_input(['name' => 'contact_person_name', 'id' => 'contact_person_name', 'class' => 'mdl-textfield__input', 'value' => set_value('contact_person_name')]); ?>
                        <?php echo form_error('contact_person_name'); ?>
                      </div>
                    </div>

                    <div class="col-lg-4 p-t-20">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <label class="mdl-textfield__label">ISD</label>
                        <select name="isd_codes" class="mdl-textfield__input" style="padding-top:13px;">
                          <?php 
                            $selected = '+91';
                            $allowed_countries = ['AM','AZ','BY','IN','KZ','GE', 'UZ'];
                            foreach($country_isd_codes AS $list){  
                              if(in_array($list->country_code,$allowed_countries)){
                          ?>
                          <option value="<?=$list->isd_codes?>"
                            <?php echo ($list->isd_codes == $selected) ? 'selected' : ''; ?>>
                            <?=$list->isd_codes.' ('.$list->country.')'; ?></option>
                          <?php } } ?>
                        </select>
                        <?php echo form_error('isd_codes'); ?>
                      </div>
                    </div>

                    <div class="col-lg-4 p-t-20">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <label class="mdl-textfield__label">Telephone</label>
                        <?php echo form_input(['name' => 'mobile', 'id' => 'mobile', 'class' => 'mdl-textfield__input', 'type' => 'number', 'required' => 'required', 'value' => set_value('mobile')]); ?>
                        <?php echo form_error('mobile'); ?>
                      </div>
                    </div>

                    <div class="col-lg-4 p-t-20">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <label class="mdl-textfield__label">Email</label>
                        <?php echo form_input(['name' => 'email', 'id' => 'email', 'class' => 'mdl-textfield__input', 'value' => set_value('email')]); ?>
                        <?php echo form_error('email'); ?>
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
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <label class="mdl-textfield__label">Map</label>
                        <?php echo form_input(['name' => 'map', 'id' => 'map', 'class' => 'mdl-textfield__input', 'value' => set_value('map')]); ?>
                        <?php echo form_error('map'); ?>
                      </div>
                    </div>
                    
                    <div class="col-lg-4 p-t-20">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width is-focused">
                        <label class="mdl-textfield__label">Building Image</label>
                        <input type="file" name="hotel_image" id="hotel_image" class="mdl-textfield__input"/>
                      </div>
                    </div>
                    
                    <div class="col-lg-4 p-t-20">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <label class="mdl-textfield__label">Destination Location</label>
                        <select name="destination" class="mdl-textfield__input" style="padding-top:13px;">
                          <option value="inside">Inside</option>
                          <option value="outside">Outside</option>
                          <option value="overnight">Overnight</option>
                        </select>
                      </div>
                    </div>
                    
                    <div class="col-lg-4 p-t-20">
                      <label>Upload Reception Images</label>
                      <input type="file" name="reception_images[]" multiple class="mdl-textfield__input">
                    </div>
                    
                    <div class="col-lg-4 p-t-20">
                      <label>Upload Lobby Images</label>
                      <input type="file" name="building_images[]" multiple class="mdl-textfield__input">
                    </div>
                    
                    <div class="col-lg-4 p-t-20">
                      <label>Upload Pool Images</label>
                      <input type="file" name="pool_images[]" multiple class="mdl-textfield__input">
                    </div>

                    
                    <div class="col-lg-4 p-t-20">
                      <label>Upload Spa Images</label>
                      <input type="file" name="spa_images[]" multiple class="mdl-textfield__input">
                    </div>

                    <div class="col-lg-4 p-t-20">
                      <label>Description</label>
                      <textarea name="description" class="mdl-textfield__input" rows="4"></textarea>
                    </div>
                    
                     <!-- Yes / No Selection -->
                    <div class="col-lg-4 p-t-20">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <label><strong>Hotel WeekEnd/WeekDays:</strong></label><br>
                        <label><input type="radio" name="weekend_enable" value="yes"> Yes</label>
                        <label class="ml-3"><input type="radio" name="weekend_enable" value="no" checked> No</label>
                      </div>
                    </div>

                    <div class="col-lg-4 p-t-20 weekend-section" style="display:none;">
                        <label class="mdl-textfield__label"><strong>Hotel Weekend:</strong></label>
                        <div class="" style="font-weight:500;font-size:14px;">
                            <input type="checkbox" class="week-days" name="weekend[]" value="monday"> Monday <input type="checkbox" class="week-days" name="weekend[]" value="tuesday"> Tuesday <input type="checkbox" class="week-days" name="weekend[]" value="wednesday"> Wednesday <input type="checkbox" class="week-days" name="weekend[]" value="thursday"> Thursday <input type="checkbox" class="week-days" name="weekend[]" value="friday"> Friday <input type="checkbox" class="week-days" name="weekend[]" value="saturday"> Saturday <input type="checkbox" class="week-days" name="weekend[]" value="sunday"> Sunday
                        </div>
                    </div>

                    <div class="col-lg-4 p-t-20 weekdays-section" style="display:none;">
                        <label class="mdl-textfield__label"><strong>Hotel Weekdays:</strong></label>
                        <div class="" style="font-weight:500;font-size:14px;">
                            <input type="checkbox" class="week-days" name="weekdays[]" value="monday"> Monday <input type="checkbox" class="week-days" name="weekdays[]" value="tuesday"> Tuesday <input type="checkbox" class="week-days" name="weekdays[]" value="wednesday"> Wednesday <input type="checkbox" class="week-days" name="weekdays[]" value="thursday"> Thursday <input type="checkbox" class="week-days" name="weekdays[]" value="friday"> Friday <input type="checkbox" class="week-days" name="weekdays[]" value="saturday"> Saturday <input type="checkbox" class="week-days" name="weekdays[]" value="sunday"> Sunday
                        </div>
                    </div>
                    <!--<div class="col-lg-2 p-t-20">-->
                    <!--    <label class="mdl-textfield__label"><strong>Per Person Tourist TAX</strong></label>-->
                    <!--    <div class="" style="font-weight:500;font-size:14px;">-->
                    <!--      <label class="ml-3"><input type="radio" class="per_person_cost" name="per_person_cost" value="yes"> Yes</label>-->
                    <!--      <label class="ml-3"><input type="radio" class="per_person_cost" name="per_person_cost" value="no" checked> No</label>-->
                    <!--    </div>-->
                    <!--</div>-->

                    <!--<div class="col-lg-2 p-t-20 tourist_tax_cost" style="display:none;">-->
                    <!--    <label class="mdl-textfield__label"><strong>Tourist TAX Cost</strong></label>-->
                    <!--    <div class="" style="font-weight:500;font-size:14px;">-->
                    <!--      <input type="text" name="tourist_tax_cost" class="mdl-textfield__input" placeholder="Enter Tourist Tax Cost">-->
                    <!--    </div>-->
                    <!--</div>-->
                    <div class="col-lg-2 p-t-20">
                        <label id="tax_label" class="mdl-textfield__label"><strong>Per Person Tourist TAX</strong></label>
                        <div class="" style="font-weight:500;font-size:14px;">
                          <label class="ml-3"><input type="radio" class="per_person_cost" name="per_person_cost" value="yes"> Yes</label>
                          <label class="ml-3"><input type="radio" class="per_person_cost" name="per_person_cost" value="no" checked> No</label>
                        </div>
                    </div>

                    <div class="col-lg-2 p-t-20 tourist_tax_cost" style="display:none;">
                        <label class="mdl-textfield__label"><strong>Tourist TAX Cost</strong></label>
                        <div class="" style="font-weight:500;font-size:14px;">
                          <input type="text" name="tourist_tax_cost" class="mdl-textfield__input" placeholder="Enter Tourist Tax Cost">
                        </div>
                    </div>

                    <div class="col-lg-12 p-t-20 text-center">
                      <?php echo form_submit(['name'=>'submit','id'=>'submit', 'class'=>'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-pink', 'value'=>'Submit']);?>
                    </div>

                    <div> <?php echo form_close(); ?> </div>
                    </div>
                  </div>

              </div>
            </div>
            <!-- end page content -->
          </div>
          <!-- end page container -->
        </div>
      </div>
    </div>
</div>
<script>
document.querySelectorAll('input[name="weekend_enable"]').forEach((el) => {
  el.addEventListener("change", function() {
    if (this.value === "1") {
      document.querySelector(".weekend-section").style.display = "block";
      document.querySelector(".weekdays-section").style.display = "block";
    } else {
      document.querySelector(".weekend-section").style.display = "none";
      document.querySelector(".weekdays-section").style.display = "none";
    }
  });
});
</script>
 <script>
  $(document).ready(function () {
    $(".per_person_cost").on("change", function () {
      $(".tourist_tax_cost").css("display", "none");
      if ($(this).val() === "yes") {
        $(".tourist_tax_cost").css("display", "block");
      }
    });
      
    $("#type").on("change", function () {
      $("#rights").css("display", "none");
      if ($(this).val() === "2") {
        $("#rights").css("display", "block");
      }
    });
    
    $(".category").on("change", function () {
      if ($(this).val() === "4 Star" && $(this).find("option:selected").text() === "Boutique Resort") {
        $("#booting_resort").val('yes');
      } else {
        $("#booting_resort").val('no');
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
  
  $(document).ready(function () {

    function handleTaxUI() {
        var country = $('#country').val().toLowerCase().trim();

        // Default hide
        $('#tax_label').closest('.col-lg-2').hide();
        $('.tourist_tax_cost').hide();

        // Reset radio to NO
        $('input[name="per_person_cost"][value="no"]').prop('checked', true);

        if (country === 'uzbekistan') {
            $('#tax_label strong').text('Per Person Tourist TAX');
            $('.tourist_tax_cost label strong').text('Tourist TAX Cost');
            $('input[name="tourist_tax_cost"]').attr('placeholder', 'Enter Tourist Tax Cost');

            $('#tax_label').closest('.col-lg-2').show();
        } 
        else if (country === 'azerbaijan') {
            $('#tax_label strong').text('Per Person Municipality TAX');
            $('.tourist_tax_cost label strong').text('Municipality TAX Cost');
            $('input[name="tourist_tax_cost"]').attr('placeholder', 'Enter Municipality Tax Cost');

            $('#tax_label').closest('.col-lg-2').show();
        }
    }

    // Country change
    $('#country').on('keyup change', function () {
        handleTaxUI();
    });

    // Radio change
    $('input[name="per_person_cost"]').on('change', function () {
        if ($(this).val() === 'yes') {
            $('.tourist_tax_cost').show();
        } else {
            $('.tourist_tax_cost').hide();
        }
    });

    // Page load
    handleTaxUI();
});
</script>


