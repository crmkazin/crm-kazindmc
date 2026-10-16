<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta content="width=device-width, initial-scale=1" name="viewport" />
  <title>KazinDMC CRM</title>
  <?php include ('admin_head_css.php'); ?>
  <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
  <script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>
  <link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet" />

</head>
<!-- END HEAD -->

<body
  class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md header-white dark-sidebar-color logo-dark">
  <div class="page-wrapper">
    <!-- start header -->
    <?php include ('header.php'); ?>
    <!-- end header -->
    <!-- start page container -->
    <div class="page-container">
      <!-- start sidebar menu -->
      <?php include ('side_bar.php'); ?>
      <!-- end sidebar menu -->
      <!-- start page content -->
      <div class="page-content-wrapper">
        <div class="page-content">
          <div class="page-bar">
            <div class="page-title-breadcrumb">
              <div class=" pull-left">
                <div class="page-title">Add Currency Value</div>
              </div>
              <ol class="breadcrumb page-breadcrumb pull-right">
                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                    href="<?= base_url(); ?>dashboard">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                </li>
                <li class="active">Add Currency Value</li>
              </ol>
            </div>
          </div>
          <?php echo $this->session->flashdata('message');
          unset($_SESSION['message']); ?>
          <div class="row">
            <div class="col-sm-12">
              <div class="card-box">
                <div class="card-head">
                  <header>Add Currency Value</header>
                  <div class="tools">
                    <a href="currency_list" class="btn btn-success" style="padding: 6px;"><i
                        class="fa fa-file-text-o"></i>
                      List</a>
                    <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                  </div>
                </div>
                <?php echo form_open_multipart(); ?>
                <div class="card-body row">

                  <div class="col-lg-3 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <?php echo form_input(['name' => 'usd_value', 'id' => 'usd_value', 'class' => 'mdl-textfield__input', 'value' => '1', 'required' => 'required', 'readonly' => 'readonly']); ?>
                      <label class="mdl-textfield__label">USD</label>
                    </div>
                  </div>

                  <div class="col-lg-1 p-t-20">
                  </div>

                  <div class="col-lg-3 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <select name="country" id="country" class="mdl-textfield__input" required>
                        <option value="">Select..</option>
                        <?php
                        foreach ($countries as $list) { ?>
                          <option
                            data-currency="<?php echo $currency_name[strtolower($list->name)]['name'] . '_' . $currency_name[strtolower($list->name)]['abbr']; ?>"
                            value="<?php echo strtolower($list->name); ?>">
                            <?php echo $list->name; ?>
                          </option>
                        <?php } ?>
                      </select>
                      <label class="mdl-textfield__label">Select Country</label>
                      <?php echo form_error('country_id'); ?>
                    </div>
                  </div>
                  <input type="hidden" name="country_id" id="country_id" value="">
                  <div class="col-lg-2 p-t-20">
                    <div
                      class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width currency_lbl">
                    </div>
                  </div>
                  <div class="col-lg-3 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <?php echo form_input(['name' => 'country_currency_value', 'id' => 'country_currency_value', 'class' => 'mdl-textfield__input', 'value' => set_value('country_currency_value'), 'required' => 'required', 'autocomplete' => 'off']); ?>
                      <label class="mdl-textfield__label">Currency Value</label>
                      <?php echo form_error('country_currency_value'); ?>
                    </div>
                  </div>

                  <div class="col-lg-12 p-t-20 text-center">
                    <?php echo form_submit(['name' => 'submit', 'id' => 'submit', 'class' => 'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-pink', 'value' => 'Submit']); ?>
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
        <?php include ('admin_footer.php'); ?>
        <!-- end footer -->
      </div>
      <!-- start js include path -->
      <?php include ('admin_footer_js.php'); ?>
      <!-- end js include path -->


      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <!-- jQuery UI -->
      <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
      <script>
        $(document).ready(function () {
          $("#country").on("change", function () {
            $(".currency_lbl").html("");
            if ($(this).val() != "") {
              var d = $("#country option:selected").attr("data-currency").split("_");
              $(".currency_lbl").html("<label class='label label-success'> " + d[0] + " (" +
                d[1] + ")</label>");
            }
          });
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

</body>

</html>