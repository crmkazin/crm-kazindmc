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
                <div class="page-title">Edit Ancillary Guide</div>
              </div>
              <ol class="breadcrumb page-breadcrumb pull-right">
                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                    href="<?=base_url();?>dashboard">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                </li>
                <li><a class="parent-item" href="<?= base_url(); ?>masters">Masters</a></li> &nbsp;<i class="fa fa-angle-right"></i>&nbsp;
                <li><a class="parent-item" href="<?= base_url('auxiliary-master'); ?>">Ancillary Masters</a></li> &nbsp;<i class="fa fa-angle-right"></i>&nbsp;
                <li><a class="parent-item" href="<?= base_url('auxiliary-guide-master'); ?>">Ancillary Guide</a></li>&nbsp;<i class="fa fa-angle-right"></i>&nbsp;
                <li class="active">Edit Ancillary Guide</li>
              </ol>
            </div>
          </div>
          <?php echo $this->session->flashdata('message'); unset($_SESSION['message']); ?>
          <div class="row">
            <div class="col-sm-12">
              <div class="card-box">
                <div class="card-head">
                  <header>Edit Ancillary Guide</header>
                  <div class="tools">
                    <a href="<?=base_url('auxiliary-guide-master');?>" class="btn btn-success" style="padding: 6px;"><i class="fa fa-file-text-o"></i>
                      List</a>
                    <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                  </div>
                </div>
                <?php echo form_open_multipart(); ?>
                  <div class="card-body row">
                  <?php $countryToCurrency = ['Azerbaijan' => 'Manat', 'Belarus' => 'Ruble', 'Georgia' => 'Lari', 'India' => 'INR', 'Kazakhstan' => 'Tenge']; ?>
                  <input type="hidden" name="id" id="id" value="<?=$guide->id?>">
                    <div class="col-lg-4 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <?php echo form_input(['name' => 'country', 'id' => 'country', 'class' => 'mdl-textfield__input', 'required' => 'required', 'value' => $guide->location]); ?>
                      <label class="mdl-textfield__label">Country</label>
                      <?php echo form_error('country'); ?>
                    </div>
                  </div>
                  <div class="col-lg-4 p-t-20">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <select name="guide_type" class="mdl-textfield__input" style="padding-top:13px;" required>
                            
                          <option value=""></option>
                          <option value="guide" <?php if($guide->guide_type=='guide'){ echo "selected";} ?>>Guide</option>
                          <option value="driver_cum_guide" <?php if($guide->guide_type=='driver_cum_guide'){ echo "selected";} ?>>Driver Cum Guide</option>
                        </select>
                        <label class="mdl-textfield__label">Guide Type</label><?php echo form_error('guide_type');?>
                      </div>
                    </div>
                    
                    <?php $languages = ['all','kazakh','russian','korean','german','polish','yiddish','ukrainian','turkish','uzbek','uyghur','arabic','english','hindi','azerbaijani',' azeri','azeri turkish','georgian','belarusian']; ?>
                    <div class="col-lg-4 p-t-20"> 
                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
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
                        <?php echo form_input(['name'=>'day_starttime','id'=>'day_starttime','class'=>'mdl-textfield__input','type'=>'time','required'=>'required','value'=> $guide->day_start_time])?>
                        <label class="mdl-textfield__label">Start Timing</label><?php echo form_error('day_starttime'); ?>
                      </div>
                    </div>
                    <div class="col-lg-2 p-t-5">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <?php echo form_input(['name'=>'day_finishtime','id'=>'day_finishtime','class'=>'mdl-textfield__input','type'=>'time','required'=>'required','value'=>$guide->day_finish_time])?>
                        <label class="mdl-textfield__label">Finish Timing</label><?php echo form_error('day_finishtime'); ?>
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
                        <?php echo form_input(['name'=>'night_starttime','id'=>'night_starttime','class'=>'mdl-textfield__input','type'=>'time','required'=>'required','value'=>$guide->night_start_time])?>
                        <label class="mdl-textfield__label">Start Timing</label><?php echo form_error('night_starttime'); ?>
                      </div>
                    </div>
                    <div class="col-lg-2 p-t-5">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <?php echo form_input(['name'=>'night_finishtime','id'=>'night_finishtime','class'=>'mdl-textfield__input','type'=>'time','required'=>'required','value'=>$guide->night_finish_time])?>
                        <label class="mdl-textfield__label">Finish Timing</label><?php echo form_error('night_finishtime'); ?>
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
                        <?php echo form_input(['name'=>'outday_starttime','id'=>'outday_starttime','class'=>'mdl-textfield__input','type'=>'time','required'=>'required','value'=>$guide->outday_start_time])?>
                        <label class="mdl-textfield__label">Start Timing</label>
                        <?php echo form_error('outday_starttime'); ?>
                      </div>
                    </div>
                    <div class="col-lg-2 p-t-5">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <?php echo form_input(['name'=>'outday_endtime','id'=>'outday_endtime','class'=>'mdl-textfield__input','type'=>'time','required'=>'required','value'=>$guide->outday_end_time])?>
                        <label class="mdl-textfield__label">Finish Timing</label>
                        <?php echo form_error('outday_endtime'); ?>
                      </div>
                    </div>
                    </div>
                    <span class="col-md-12"><b> Overnight Trip</b></span>
                    
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

    const countryToCurrency = {
    "Azerbaijan": "Manat",
    "Belarus": "Ruble",
    "Georgia": "Lari",
    "India": "INR",
    "Kazakhstan": "Tenge"
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

  // 1. Show currency on page load for existing saved country
  $(document).ready(function () {
    const savedCountry = $('#country').val();
    updateCurrencyDisplay(savedCountry);
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
      updateCurrencyDisplay(ui.item.label);
      return false;
    }
  });

    </script>
</body>

</html>