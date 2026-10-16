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
                      <h4 class="text-themecolor">Add Ancillary Guide</h4>
                  </div>
                  <div class="col-lg-2 only-for-dashbord">
                  </div>
                  <div class="col-lg-7 col-sm-6 col-6 align-self-center text-end">
                      <div class="d-flex justify-content-end align-items-center">
                          <ol class="breadcrumb justify-content-end">
                              <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Home</a></li>
                              <li class="breadcrumb-item">Ancillary Masters</li>
                              <li class="breadcrumb-item active">Add Ancillary Guide</li>
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
                    
                    <div class="col-lg-4 p-t-20" id="country-wrapper">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <label class="mdl-textfield__label">Country</label>
                      <?php echo form_input(['name' => 'country', 'id' => 'country', 'class' => 'mdl-textfield__input mb-2', 'required' => 'required', 'value' => set_value('country')]); ?>
                      <?php echo form_error('country'); ?>
                    </div>
                  </div>
                  <div class="col-lg-4 p-t-20" id="guide-wrapper">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <label class="mdl-textfield__label">Guide Type</label><?php echo form_error('guide_type');?>
                        <select name="guide_type" id="guide_type" class="mdl-textfield__input mb-2" style="padding-top:13px;" required>
                            <option value="">Select Guide Type</option>
                        </select>
                      </div>
                    </div>
                    <!-- <div class="col-lg-4 p-t-20">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width"> -->
                        <?php
                            // $gender_options = [
                            //   '' => '',
                            //   'male' => 'Male',
                            //   'female' => 'Female',
                            // ];

                            // echo form_dropdown('gender', $gender_options, set_value('gender'), 'id="gender" class="mdl-textfield__input" style="padding-top:13px;" required');
                          ?>
                        <!-- <label class="mdl-textfield__label">Gender</label><?php //echo form_error('gender');?>
                      </div>
                    </div> -->
                    
                    <div class="col-lg-4 p-t-20" id="vehicle-wrapper" style="display:none;"> 
                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                            <label class="mdl-textfield__label" ><b>Vehicles</b></label>
                            <select name="vehicles[]" id="vehicles" class="mb-2 mdl-textfield__input js-example-basic-multiples" multiple=""> 
                               
                            </select>
                        </div>
                    </div>
                    
                    <?php $languages = ['kazakh','russian','korean','german','polish','yiddish','ukrainian','turkish','uzbek','uyghur','arabic','english','hindi','azerbaijani',' azeri','azeri turkish','georgian','belarusian']; ?>
                    
                    <div class="col-lg-4 p-t-20" id="language-wrapper"> 
                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                            <label class="mdl-textfield__label" ><b>Languages</b></label>
                            <select name="languages[]" id="languages" class="mb-2 mdl-textfield__input js-example-basic-multiple" multiple="" required> 
                                <option value="all">All</option>
                                <?php foreach($languages AS $list){ ?>
                                <option value="<?=$list; ?>"><?php echo ucfirst($list); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-2 p-t-5">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <label class="mdl-textfield__label" ><b>Day Charges</b></label>
                      </div>
                    </div>
                    <div class="col-lg-4 p-t-5">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <?php echo form_input(['name'=>'day_charge','id'=>'day_charge','class'=>'mdl-textfield__input','type'=>'number','required'=>'required','value'=>set_value('day_charge')])?>
                      </div>
                    </div>
                    <div class="col-lg-2 p-t-5">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <div id="currency-display" style="margin-top: 10px;"></div>                     
                       <label class="mdl-textfield__label">Currency</label>
                      </div>
                    </div>
                    <div class="col-lg-2 p-t-5">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <label class="mdl-textfield__label">Start Timing</label>
                        <?php echo form_input(['name'=>'day_starttime','id'=>'day_starttime','class'=>'mdl-textfield__input','type'=>'time','required'=>'required','value'=>set_value('day_starttime')])?>
                        <?php echo form_error('day_starttime'); ?>
                      </div>
                    </div>
                    <div class="col-lg-2 p-t-5">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <label class="mdl-textfield__label">Finish Timing</label>
                        <?php echo form_input(['name'=>'day_finishtime','id'=>'day_finishtime','class'=>'mdl-textfield__input','type'=>'time','required'=>'required','value'=>set_value('day_finishtime')])?>
                        <?php echo form_error('day_finishtime'); ?>
                      </div>
                    </div>
                    <div class="col-lg-2 p-t-5">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <label class="mdl-textfield__label" ><b>Night Charges</b></label>
                      </div>
                    </div>
                    <div class="col-lg-4 p-t-5">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <?php echo form_input(['name'=>'night_charge','id'=>'night_charge','class'=>'mdl-textfield__input','type'=>'number','required'=>'required','value'=>set_value('night_charge')])?>
                      </div>
                    </div>
                    <div class="col-lg-2 p-t-5">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <div id="currency-display1" style="margin-top: 10px;"></div> 
                      <label class="mdl-textfield__label">Currency</label>
                      </div>
                    </div>
                    <div class="col-lg-2 p-t-5">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <label class="mdl-textfield__label">Start Timing</label>
                        <?php echo form_input(['name'=>'night_starttime','id'=>'night_starttime','class'=>'mdl-textfield__input','type'=>'time','required'=>'required','value'=>set_value('night_starttime')])?>
                        <?php echo form_error('night_starttime'); ?>
                      </div>
                    </div>
                    <div class="col-lg-2 p-t-5">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <label class="mdl-textfield__label">Finish Timing</label>
                        <?php echo form_input(['name'=>'night_finishtime','id'=>'night_finishtime','class'=>'mdl-textfield__input','type'=>'time','required'=>'required','value'=>set_value('night_finishtime')])?>
                        <?php echo form_error('night_finishtime'); ?>
                      </div>
                    </div>
                    <span class="col-md-12"><b> OutStation Charges</b></span>
                    </div>
                    <div class="card-body row">
                    <div class="col-lg-2 p-t-5">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <label class="mdl-textfield__label" ><b>Day Trip</b></label>
                      </div>
                    </div>
                    <div class="col-lg-4 p-t-5">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <?php echo form_input(['name'=>'outday_charge','id'=>'outday_charge','class'=>'mdl-textfield__input','type'=>'number','required'=>'required','value'=>set_value('outday_charge')])?>
                      </div>
                    </div>
                    <div class="col-lg-2 p-t-5">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <div id="currency-display2" style="margin-top: 10px;"></div> 
                      <label class="mdl-textfield__label">Currency</label>
                      </div>
                    </div>
                    <div class="col-lg-2 p-t-5">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <label class="mdl-textfield__label">Start Timing</label>
                        <?php echo form_input(['name'=>'outday_starttime','id'=>'outday_starttime','class'=>'mdl-textfield__input','type'=>'time','required'=>'required','value'=>set_value('outday_starttime')])?>
                        <?php echo form_error('outday_starttime'); ?>
                      </div>
                    </div>
                    <div class="col-lg-2 p-t-5">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <label class="mdl-textfield__label">Finish Timing</label>
                        <?php echo form_input(['name'=>'outday_endtime','id'=>'outday_endtime','class'=>'mdl-textfield__input','type'=>'time','required'=>'required','value'=>set_value('outday_endtime')])?>
                        <?php echo form_error('outday_endtime'); ?>
                      </div>
                    </div>
                    </div>
                    <span class="col-md-12 ms-4"><b> Overnight Trip</b></span>
                    
                    <div class="card-body row">
                    <div class="col-lg-2 p-t-5">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <label class="mdl-textfield__label" ><b>Guide Charges</b></label>
                      </div>
                    </div>
                    <div class="col-lg-4 p-t-5">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <?php echo form_input(['name'=>'guide_charge','id'=>'guide_charge','class'=>'mdl-textfield__input','type'=>'number','required'=>'required','value'=>set_value('guide_charge')])?>
                      </div>
                    </div>
                    <div class="col-lg-2 p-t-5">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <div id="currency-display3" style="margin-top: 10px;"></div> 
                      <label class="mdl-textfield__label">Currency</label>
                      </div>
                    </div>
                    </div>
                    <div class="card-body row">
                    <div class="col-lg-2 p-t-5">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <label class="mdl-textfield__label" ><b>Food Charges</b></label>
                      </div>
                    </div>
                    <div class="col-lg-4 p-t-5">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <?php echo form_input(['name'=>'food_charge','id'=>'food_charge','class'=>'mdl-textfield__input','type'=>'number','required'=>'required','value'=>set_value('food_charge')])?>
                      </div>
                    </div>
                    <div class="col-lg-2 p-t-5">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <div id="currency-display4" style="margin-top: 10px;"></div> 
                      <label class="mdl-textfield__label">Currency</label>
                      </div>
                    </div>
                    </div>
                    <div class="card-body row">
                    <div class="col-lg-2 p-t-5">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <label class="mdl-textfield__label" ><b>Accomodation Charges</b></label>
                      </div>
                    </div>
                    <div class="col-lg-4 p-t-5">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <?php echo form_input(['name'=>'accommodation_charge','id'=>'accommodation_charge','class'=>'mdl-textfield__input','type'=>'number','required'=>'required','value'=>set_value('accommodation_charge')])?>
                      </div>
                    </div>
                    <div class="col-lg-2 p-t-5">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <div id="currency-display5" style="margin-top: 10px;"></div> 
                      <label class="mdl-textfield__label">Currency</label>
                      </div>
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
      </div>
      <!-- end page content -->
    </div>
    <!-- end page container -->

  </div>
  <script>
    $(function() {
        $('.js-example-basic-multiple').select2({
          //theme: 'filled',
          placeholder: 'Languages',
          width: '400px'
        });
        
        $('.js-example-basic-multiples').select2({
          placeholder: 'Vehicle',
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
        
      function loadTransportation(country) {
          $.ajax({
              url: "<?= base_url() ?>admin/masters/get_transportation_by_country",
              type: "POST",
              dataType: "json",
              data: { country: country },
              success: function (response) {
                  $('#vehicles').empty();

                  if (response.length > 0) {
                      $.each(response, function (i, item) {
                          $('#vehicles').append(
                              `<option value="${item.id}">${item.vehicle_name}</option>`
                          );
                      });
                  }
              }
          });
      }

      function toggleVehicleDropdown(countryId) {
        const guideType = $('#guide_type').val();

        if (countryId == 'Georgia' && guideType === 'guide') {
            $('#vehicle-wrapper').show();
            $('#vehicle-wrapper').removeClass("col-lg-4").addClass('col-lg-3');
            $('#language-wrapper').removeClass("col-lg-4").addClass('col-lg-3');
            $('#guide-wrapper').removeClass("col-lg-4").addClass('col-lg-3');
            $('#country-wrapper').removeClass("col-lg-4").addClass('col-lg-3');
        } else {
            $('#vehicle-wrapper').hide();
            $('#language-wrapper').removeClass("col-lg-3").addClass('col-lg-4');
            $('#guide-wrapper').removeClass("col-lg-3").addClass('col-lg-4');
            $('#country-wrapper').removeClass("col-lg-3").addClass('col-lg-4');
            $('#vehicles').val([]).trigger('change'); // reset selection
        }
      }

      $('#guide_type').on('change', function () {
        const countryId = $('#country').val();
        toggleVehicleDropdown(countryId);
      });

      const countryToCurrency = {
          "Azerbaijan": "Manat",
          "Belarus": "Ruble",
          "Georgia": "Lari",
          "India": "INR",
          "Kazakhstan": "Tenge",
          'Uzbekistan': "Uzbekistan Som",
          'Armenia': "Armenian dram"
        };

    $("#country").autocomplete({
      source: function (request, response) {
        $.ajax({
          url: "<?= base_url() ?>admin/company/get_country_ajax_new",
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
        $('#country').val(ui.item.label);
        $('#country_id').val(ui.item.country_id);
        const countryId = ui.item.country_id;
        const $guideType = $('#guide_type');
        // Reset selection
        $guideType.empty();
        $guideType.append('<option value="">Select Guide Type</option>');
        
        if (countryId == 81) {
        $guideType.empty();
        // India → Guide + Driver
        $guideType.append('<option value="guide">Guide</option>');
        $guideType.append('<option value="driver">Driver</option>');
        } else {
        $guideType.empty();
        // Other countries → Guide + Driver Cum Guide
        $guideType.append('<option value="guide">Guide</option>');
        $guideType.append('<option value="driver_cum_guide">Driver Cum Guide</option>');
        $guideType.append('<option value="driver">Driver</option>');
        }
        
        loadTransportation(ui.item.label);
        toggleVehicleDropdown(ui.item.label)
        // Show currency based on selected country
        const currency = countryToCurrency[ui.item.label];
        if (currency) {
          $('#currency-display').text('' + currency);
          $('#currency-display1').text('' + currency);
          $('#currency-display2').text('' + currency);
          $('#currency-display3').text('' + currency);
          $('#currency-display4').text('' + currency);
          $('#currency-display5').text('' + currency);
        } else {
          $('#currency-display').text('Currency not found');
        }
    
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