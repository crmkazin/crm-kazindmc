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
                    <h4 class="text-themecolor">Edit Ancillary Guide</h4>
                </div>
                <div class="col-lg-2 only-for-dashbord">
                </div>
                <div class="col-lg-7 col-sm-6 col-6 align-self-center text-end">
                    <div class="d-flex justify-content-end align-items-center">
                        <ol class="breadcrumb justify-content-end">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Home</a></li>
                            <li class="breadcrumb-item">Ancillary Masters</li>
                            <li class="breadcrumb-item active">Edit Ancillary Guide</li>
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
                  <?php $countryToCurrency = ['Azerbaijan' => 'Manat', 'Belarus' => 'Ruble', 'Georgia' => 'Lari', 'India' => 'INR', 'Kazakhstan' => 'Tenge', 'Uzbekistan' => 'Uzbekistan Som', 'Armenia' => 'Armenian dram']; ?>
                  <input type="hidden" name="id" id="id" value="<?=$guide->id?>">
                    <div class="col-lg-4 p-t-20" id="country-wrapper">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <label class="mdl-textfield__label">Country</label>
                      <?php echo form_input(['name' => 'country', 'id' => 'country', 'class' => 'mb-2 mdl-textfield__input', 'required' => 'required', 'value' => $guide->location]); ?>
                      <?php echo form_error('country'); ?>
                    </div>
                  </div>
                  <div class="col-lg-4 p-t-20" id="guide-wrapper">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <label class="mdl-textfield__label">Guide Type</label>
                        <select name="guide_type" id="guide_type" class="mdl-textfield__input mb-2" style="padding-top:13px;" required>
                        </select>
                        <?php echo form_error('guide_type');?>
                      </div>
                    </div>
                    
                    <div class="col-lg-3 p-t-20" id="vehicle-wrapper"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                          <label class="mdl-textfield__label" ><b>Vehicles</b></label>
                          <select name="vehicles[]" id="vehicles" class="mb-2 mdl-textfield__input js-example-basic-multiples" multiple=""> 
                              
                          </select>
                      </div>
                    </div>
                    
                    <?php $languages = ['all','kazakh','russian','korean','german','polish','yiddish','ukrainian','turkish','uzbek','uyghur','arabic','english','hindi','azerbaijani',' azeri','azeri turkish','georgian','belarusian']; ?>
                    <div class="col-lg-4 p-t-20" id="language-wrapper"> 
                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                            <label class="mdl-textfield__label" ><b>Languages</b></label>
                            <select name="languages[]" id="languages" class="mdl-textfield__input js-example-basic-multiple" multiple="" required> 
                                <!-- <option value="all">All</option> -->
                                <?php 
                                 $guide_languages = explode(',',$guide->languages);
                                foreach($languages AS $list){ ?>
                                <option value="<?=$list; ?>" <?php echo (in_array($list,$guide_languages))?'selected="selected"':''; ?>><?php echo ucfirst($list); ?></option>
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
                        <?php echo form_input(['name'=>'day_charge','id'=>'day_charge','class'=>'mdl-textfield__input','type'=>'number','required'=>'required', 'value'=> $guide->day_charge])?>
                      </div>
                    </div>
                    <div class="col-lg-2 p-t-5">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <div id="currency-display"><?= isset($guide->location) && isset($countryToCurrency[$guide->location]) ? $countryToCurrency[$guide->location] : 'Currency not found' ?></div>
                      <label class="mdl-textfield__label">Currency</label>
                      </div>
                    </div>
                    <div class="col-lg-2 p-t-5">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <label class="mdl-textfield__label">Start Timing</label>
                        <?php echo form_input(['name'=>'day_starttime','id'=>'day_starttime','class'=>'mdl-textfield__input','type'=>'time','required'=>'required','value'=> $guide->day_start_time])?>
                        <?php echo form_error('day_starttime'); ?>
                      </div>
                    </div>
                    <div class="col-lg-2 p-t-5">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <label class="mdl-textfield__label">Finish Timing</label>
                        <?php echo form_input(['name'=>'day_finishtime','id'=>'day_finishtime','class'=>'mdl-textfield__input','type'=>'time','required'=>'required','value'=>$guide->day_finish_time])?>
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
                        <?php echo form_input(['name'=>'night_charge','id'=>'night_charge','class'=>'mdl-textfield__input','type'=>'number','required'=>'required','value'=>$guide->night_charge])?>
                      </div>
                    </div>
                    <div class="col-lg-2 p-t-5">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <div id="currency-display1"><?= isset($guide->location) && isset($countryToCurrency[$guide->location]) ? $countryToCurrency[$guide->location] : 'Currency not found' ?></div>
                      <label class="mdl-textfield__label">Currency</label>
                      </div>
                    </div>
                    <div class="col-lg-2 p-t-5">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <label class="mdl-textfield__label">Start Timing</label>
                        <?php echo form_input(['name'=>'night_starttime','id'=>'night_starttime','class'=>'mdl-textfield__input','type'=>'time','required'=>'required','value'=>$guide->night_start_time])?>
                        <?php echo form_error('night_starttime'); ?>
                      </div>
                    </div>
                    <div class="col-lg-2 p-t-5">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <label class="mdl-textfield__label">Finish Timing</label>
                        <?php echo form_input(['name'=>'night_finishtime','id'=>'night_finishtime','class'=>'mdl-textfield__input','type'=>'time','required'=>'required','value'=>$guide->night_finish_time])?>
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
                        <?php echo form_input(['name'=>'outday_charge','id'=>'outday_charge','class'=>'mdl-textfield__input','type'=>'number','required'=>'required','value'=>$guide->outday_charge])?>
                      </div>
                    </div>
                    <div class="col-lg-2 p-t-5">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <div id="currency-display2"><?= isset($guide->location) && isset($countryToCurrency[$guide->location]) ? $countryToCurrency[$guide->location] : 'Currency not found' ?></div>
                      <label class="mdl-textfield__label">Currency</label>
                      </div>
                    </div>
                    <div class="col-lg-2 p-t-5">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <label class="mdl-textfield__label">Start Timing</label>
                        <?php echo form_input(['name'=>'outday_starttime','id'=>'outday_starttime','class'=>'mdl-textfield__input','type'=>'time','required'=>'required','value'=>$guide->outday_start_time])?>
                        <?php echo form_error('outday_starttime'); ?>
                      </div>
                    </div>
                    <div class="col-lg-2 p-t-5">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <label class="mdl-textfield__label">Finish Timing</label>
                        <?php echo form_input(['name'=>'outday_endtime','id'=>'outday_endtime','class'=>'mdl-textfield__input','type'=>'time','required'=>'required','value'=>$guide->outday_end_time])?>
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
                        <?php echo form_input(['name'=>'guide_charge','id'=>'guide_charge','class'=>'mdl-textfield__input','type'=>'number','required'=>'required','value'=>$guide->guide_charge])?>
                      </div>
                    </div>
                    <div class="col-lg-2 p-t-5">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <div id="currency-display3"><?= isset($guide->location) && isset($countryToCurrency[$guide->location]) ? $countryToCurrency[$guide->location] : 'Currency not found' ?></div>
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
                        <?php echo form_input(['name'=>'food_charge','id'=>'food_charge','class'=>'mdl-textfield__input','type'=>'number','required'=>'required','value'=>$guide->food_charge])?>
                      </div>
                    </div>
                    <div class="col-lg-2 p-t-5">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <div id="currency-display4"><?= isset($guide->location) && isset($countryToCurrency[$guide->location]) ? $countryToCurrency[$guide->location] : 'Currency not found' ?></div>
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
                        <?php echo form_input(['name'=>'accommodation_charge','id'=>'accommodation_charge','class'=>'mdl-textfield__input','type'=>'number','required'=>'required','value'=>$guide->accommodation_charge])?>
                      </div>
                    </div>
                    <div class="col-lg-2 p-t-5">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <div id="currency-display5"><?= isset($guide->location) && isset($countryToCurrency[$guide->location]) ? $countryToCurrency[$guide->location] : 'Currency not found' ?></div>
                      <label class="mdl-textfield__label">Currency</label>
                      </div>
                    </div>
                    </div>
                    <div class="col-lg-12 p-t-20 text-center">
                      <?php echo form_submit(['name'=>'submit','id'=>'submit', 'class'=>'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-pink', 'value'=>'Submit']);?>
                    </div>
                  </div>
                  <?php echo form_close(); ?>
              
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
        
        
        $('.js-example-basic-multiples').select2({
          placeholder: 'Vehicles',
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

    const countryToCurrency = {
    "Azerbaijan": "Manat",
    "Belarus": "Ruble",
    "Georgia": "Lari",
    "India": "INR",
    "Kazakhstan": "Tenge",
    "Uzbekistan": "Uzbekistan Som",
    "Armenia": "Armenian dram"
  };

  function updateCurrencyDisplay(countryName) {
    const currency = countryToCurrency[countryName] || 'Currency not found';
    $('#currency-display').text('' + currency);
    $('#currency-display1').text('' + currency);
    $('#currency-display2').text('' + currency);
    $('#currency-display3').text('' + currency);
    $('#currency-display4').text('' + currency);
    $('#currency-display5').text('' + currency);
  }

   function loadTransportation(country) {
      const savedVehicleIds = "<?php echo $guide->vehicle_name; ?>".split(',').map(Number);

        $.ajax({
            url: "<?= base_url() ?>admin/masters/get_transportation_by_country",
            type: "POST",
            dataType: "json",
            data: { country: country },
            success: function (response) {
                $('#vehicles').empty();

                if (response.length > 0) {
                    $.each(response, function (i, item) {
                        const isSelected = savedVehicleIds.includes(Number(item.id))
                          ? 'selected'
                          : '';
                        $('#vehicles').append(
                            `<option value="${item.id}" ${isSelected}>${item.vehicle_name}</option>`
                        );
                    });
                }
            }
        });
    }

    function toggleGuideTypeByCountry(savedCountry) {
      const $guideType = $('#guide_type');
      const savedGuideType = '<?php echo $guide->guide_type;?>';

      // Reset selection
      $guideType.empty();

      if (savedCountry == 'Georgia') {
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

      if (savedGuideType === 'driver_cum_guide') {
          $guideType.find('option[value="driver_cum_guide"]').prop('selected', true);
      } else if (savedGuideType === 'driver') {
          $guideType.find('option[value="driver"]').prop('selected', true);
      } else if (savedGuideType === 'guide') {
          $guideType.find('option[value="guide"]').prop('selected', true);
      }

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

    // 1. Show currency on page load for existing saved country
    $(document).ready(function () {
      const savedCountry = $('#country').val();
      if (savedCountry) {
          toggleGuideTypeByCountry(savedCountry);
          updateCurrencyDisplay(savedCountry);
          loadTransportation(savedCountry);
          toggleVehicleDropdown(savedCountry)
      }
    });

  // 2. Setup autocomplete for changing country
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
        toggleGuideTypeByCountry(ui.item.label);
        updateCurrencyDisplay(ui.item.label);
        loadTransportation(ui.item.label);
        toggleVehicleDropdown(ui.item.label)
      return false;
    }
  });

</script>