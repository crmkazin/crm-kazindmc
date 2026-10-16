 <?php include ('admin_head_css.php'); ?>
 <div class="page-wrapper">
    <!-- start page container -->
    <div class="container-fluid">
      <!-- start page content -->
      <div class="page-content-wrapper">
        <div class="page-bar">
            <div class="row page-titles">
                <div class="col-lg-3 col-sm-6  col-6 align-self-center">
                    <h4 class="text-themecolor">Add Currency Value</h4>
                </div>
                <div class="col-lg-2 only-for-dashbord">
                </div>
                <div class="col-lg-7 col-sm-6 col-6 align-self-center text-end">
                    <div class="d-flex justify-content-end align-items-center">
                        <ol class="breadcrumb justify-content-end">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Home</a></li>   
                            <li class="breadcrumb-item"><a href="<?php echo base_url('currency_list'); ?>">Currency List</a></li>
                            <li class="breadcrumb-item active">Add Currency Value</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-content">
          <?php echo $this->session->flashdata('message');
          unset($_SESSION['message']); ?>
          <div class="row">
            <div class="col-sm-12">
              <div class="card-box">
             
                <?php echo form_open_multipart(); ?>
                <div class="card-body row">

                  <div class="col-lg-3 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <label class="mdl-textfield__label">USD</label>
                      <?php echo form_input(['name' => 'usd_value', 'id' => 'usd_value', 'class' => 'mdl-textfield__input', 'value' => '1', 'required' => 'required', 'readonly' => 'readonly']); ?>
                    </div>
                  </div>

                  <!-- <div class="col-lg-1 p-t-20">
                  </div> -->

                  <div class="col-lg-3 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <label class="mdl-textfield__label">Select Country</label>
                       <select name="country" id="country" class="country mdl-textfield__input" required>
                        <option value="">Select..</option>
                        <?php foreach ($countries as $list) {
                            $countryKey = strtolower($list->name);
                            $currencyData = isset($currency_name[$countryKey]) 
                                ? $currency_name[$countryKey] 
                                : ['name' => '', 'abbr' => ''];
                        ?>
                            <option
                              data-currency="<?php echo $currencyData['name'] . '_' . $currencyData['abbr']; ?>"
                              value="<?php echo $countryKey; ?>">
                              <?php echo $list->name; ?>
                            </option>
                        <?php } ?>
                      </select>
                      <?php echo form_error('country_id'); ?>
                    </div>
                  </div>
                  <input type="hidden" name="country_id" id="country_id" value="">
              
                  <div class="col-lg-3 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <label class="mdl-textfield__label">Currency Value</label>
                      <?php echo form_input(['name' => 'country_currency_value', 'id' => 'country_currency_value', 'class' => 'mdl-textfield__input', 'value' => set_value('country_currency_value'), 'required' => 'required', 'autocomplete' => 'off']); ?>
                      <?php echo form_error('country_currency_value'); ?>
                    </div>
                  </div>
                  <div class="col-lg-3 p-t-20">
                    <div
                      class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width currency_lbl">
                    </div>
                  </div>

                  <div class="col-lg-12 p-t-20 text-center">
                    <?php echo form_submit(['name' => 'submit', 'id' => 'submit', 'class' => 'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-info', 'value' => 'Submit']); ?>
                  </div>
                  <?php echo form_close(); ?>
                </div>
              </div>

            </div>
          </div>
          <!-- end page content -->
        </div>
    </div>
  </div>
</div>
<script>
  $(document).ready(function () {
    function updateCurrencyLabel() {
      $(".currency_lbl").html("");
      if ($(".country").val() != "") {
        var d = $(".country option:selected").attr("data-currency").split("_");
        $(".currency_lbl").html("<label class='label label-success'> " + d[0] + " (" + d[1] + ")</label>");
      }
    }
    $(".country").on("change", updateCurrencyLabel);
    setTimeout(updateCurrencyLabel, 1000);
});
</script>

<script>
    $(document).ready(function () {
      // Get URL parameters
      const urlParams = new URLSearchParams(window.location.search);

      // Get values from URL parameters
      const countryName = urlParams.get('name');
      const currencyValue = urlParams.get('value');

      // Set values to select and input fields
      $('#country').val(countryName.toLowerCase()); // Assuming lowercase matches option values
      $('#country_currency_value').val(currencyValue);
    });
  </script>
