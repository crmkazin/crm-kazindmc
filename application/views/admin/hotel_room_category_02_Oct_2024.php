<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta content="width=device-width, initial-scale=1" name="viewport" />
  <title>KazinDMC CRM</title>
  <?php include('admin_head_css.php'); ?>
  <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">

  <script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>
  <link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet" />
  <style>
    .hide-accessible {
      position: absolute;
      opacity: 0;
      pointer-events: none;
    }
  </style>
</head>
<!-- END HEAD -->


<body class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md header-white dark-sidebar-color logo-dark">

  <div class="modal fade" id="myModalpricing" role="dialog">
    <div class="modal-dialog modal-lg" style="">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Add Prices</h4>
          <button type="button" class="close close-modal" data-dismiss="modal">&times;</button>
        </div>
        <div id="response-message"></div>
        <div class="modal-body ui-front">
          <div class="row">
            <div class="col-md-12">
              <div id="msg"></div>
              <form method="post" id="add-form-category" enctype="multipart/form-data">
                <input type="hidden" name="category_id" id="category_id" value="">
                <input type="hidden" name="hotel_id" id="hotel_id" value="">

                <div class="d-flex">
                  <div class="col-lg-6 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width" style="">
                      <?php echo form_input(['type' => 'date', 'name' => 'from_date', 'id' => 'from_date', 'placeholder' => '', 'class' => 'mdl-textfield__input', 'value' => '', 'required' => 'required']) ?>
                    </div>
                  </div>

                  <div class="col-lg-6 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width" style="">
                      <?php echo form_input(['type' => 'date', 'name' => 'to_date', 'id' => 'to_date', 'placeholder' => '', 'class' => 'mdl-textfield__input', 'value' => '', 'required' => 'required']) ?>
                    </div>
                    <div id="date-error-message" class="alert alert-danger text-center" style="display: none;">From date must be earlier than To date.</div>
                  </div>
                </div>


                <div class="card-body row">
                  <div class="col-lg-12 text-center" style="margin-top:-20px;">
                    <h4 id="category-name" class="bold"></h4>
                  </div>
                  <!-- <input type="text" name="data_id" id="data-id"> -->
                  <div class="col-lg-6">
                    <div class="row adult_occupany">
                      <input type="hidden" class="mdl-textfield__input" name="adultpriceid[]" id="adultprice_id">
                      <div class="col-lg-12 p-t-20">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width" style="display:flex;">
                          <?php echo form_input(['type' => 'number', 'name' => 'adultprice_with_breakfast[]', 'id' => 'adultprice_with_breakfast', 'placeholder' => 'Price', 'class' => 'mdl-textfield__input', 'value' => '', 'required' => 'required']) ?>
                          <label class="mdl-textfield__label">Single Occupany Price</label>
                        </div>
                      </div>
                      <div class="col-lg-6 p-t-20 hide-accessible">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width adult_occupany_btn" style="display:flex;">
                          <?php echo form_input(['type' => 'number', 'name' => 'adultprice_without_breakfast[]', 'id' => 'adultprice_without_breakfast', 'placeholder' => 'Without Breakfast', 'class' => 'mdl-textfield__input', 'value' => '0']) ?>
                        </div>
                      </div>
                    </div>
                    <div class="row adult_occupany_div"></div>
                  </div>
                  <div class="col-lg-6 child_occupancy_row">
                    <div class="row child_occupancy">
                      <input type="hidden" class="mdl-textfield__input" name="childpriceid[]" id="childprice_id">
                      <div class="col-lg-4 p-t-20">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width" style="display:flex;">
                          <select name="" class="mdl-textfield__input select_child_bed" style="padding-top:13px;">
                            <option value="">Select..</option>
                            <option value="CWB">
                              Child With Bed</option>
                            <option value="CNB">
                              Child No Bed</option>
                          </select>
                          <input type="hidden" name="child_bed[]" class="child_bed_value" value="">
                          <label class="mdl-textfield__label">Child Bed</label>
                        </div>
                      </div>
                      <div class="col-lg-8 p-t-20">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width" style="display:flex;">
                          <?php echo form_input(['type' => 'number', 'name' => 'childprice_with_breakfast[]', 'id' => 'childprice_with_breakfast', 'placeholder' => 'Price', 'class' => 'mdl-textfield__input', 'value' => '', 'required' => 'required']) ?>
                        </div>
                      </div>
                      <div class="col-lg-4 p-t-20 hide-accessible">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width" style="display:flex;">
                          <?php echo form_input(['type' => 'number', 'name' => 'childprice_without_breakfast[]', 'id' => 'childprice_without_breakfast', 'placeholder' => 'Without Breakfast', 'class' => 'mdl-textfield__input', 'value' => '0']) ?>
                        </div>
                      </div>
                    </div>
                    <div class="row child_occupancy_div"></div>
                  </div>


                  <div class="col-lg-12 p-t-20">
                    <button type="submit" class="btn btn-primary float-right" id="add-pricing">Add</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
  <div class="page-wrapper">
    <!-- start header -->
    <?php include('header.php'); ?>
    <!-- end header -->
    <!-- start page container -->
    <div class="page-container">
      <!-- start sidebar menu -->
      <?php include('side_bar.php'); ?>
      <!-- end sidebar menu -->
      <!-- start page content -->
      <div class="page-content-wrapper">
        <div class="page-content">
          <div class="page-bar">
            <div class="page-title-breadcrumb">
              <div class=" pull-left">
                <div class="page-title">Add / Edit Hotel Room Category</div>
              </div>
              <ol class="breadcrumb page-breadcrumb pull-right">
                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?= base_url(); ?>dashboard">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                </li>
                <li class="active">Add Hotel</li>
              </ol>
            </div>
          </div>
          <?php echo $this->session->flashdata('message');
          unset($_SESSION['message']); ?>
          <div class="row">
            <div class="col-md-12">
              <div class="card card-box">
                <div class="card-head">
                  <header>All Room Categories</header>
                  <div class="tools">
                    <a href="#" data-toggle="modal" data-target="#modalAdd" class="btn  btn-info" style="padding:6px;">Import CSV</a>
                    <a href="hotel-pricing-download?hotel_id=<?= $this->input->get('hotel_id'); ?>" class="btn  btn-default" style="padding:6px;">Export to excel</a>
                    <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                  </div>
                </div>
                <div class="card-body">
                  <div class="table-scrollable">
                    <table class="table table-hover table-checkable order-column full-width" id="example4">
                      <thead>
                        <tr>
                          <th class="center">Sr.No</th>
                          <th class="center">Category Name</th>
                          <th class="center">Max Accomodation</th>
                          <th class="center">Number Of Adults</th>
                          <th class="center">Number Of Childs</th>
                          <th class="center">Child Bed Option</th>
                          <th class="center">Status</th>
                          <th class="center">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $i = 1;
                        if (!empty($categories)) {
                          foreach ($categories as $list) {
                        ?>
                            <tr class="odd gradeX">
                              <td class="center"><?= $i++ ?></td>
                              <td class="center">
                                <?php
                                echo ucwords(strtolower($list->category_name));
                                ?>
                              </td>
                              <td class="center"><?= $list->max_accomodation ?></td>
                              <td class="center"><?= $list->number_adults ?></td>
                              <td class="center"><?= $list->number_childs ?></td>
                              <td class="center">
                                <?= ($list->child_bed <> '') ? ucfirst(str_replace('_', ' ', $list->child_bed)) : ''; ?>
                              </td>
                              <!--td style="text-align:center;"><a
                                  href="<?php //echo base_url('room-category-cost?hotel_id=' . $this->input->get('hotel_id') . '&category_id=' . base64_encode($list->id)); 
                                        ?>"
                                  class="" title="Cost List"><i class="fa fa-money" aria-hidden="true"></i></a></td-->
                              <td class="center">
                              <?= ($list->status === 'active') ? '<a class="btn btn-success btn-xs">' . ucfirst($list->status) . '</a>' : '<a class="btn btn-warning btn-xs">'.ucfirst($list->status).'</a>'; 
?>                              </td>    
                              <td class="center">
                                <button class="btn btn-primary btn-xs pricing" data-adults="<?= $list->number_adults ?>" data-child="<?= $list->number_childs ?>" data-cat-name="<?php echo $list->category_name; ?>" data-cat-id="<?php echo base64_encode($list->id); ?> " data-hotel-id="<?php echo base64_encode($list->hotel_id); ?>" data-child-bed="<?php echo $list->child_bed; ?>" title="Pricing" style="padding:4px 4px;">Prices</button>
                                <a title="Edit" class="btn btn-tbl-edit btn-xs" href="<?php echo current_url() . '?hotel_id=' . $this->input->get('hotel_id') . '&category_id=' . base64_encode($list->id); ?>"><i class="fa fa-edit"></i></a>
                              </td>
                            </tr>
                        <?php }
                        } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-12">
              <div class="card-box">
                <div class="card-head">
                  <header>Add / Edit Room Category</header>
                  <div class="tools">
                    <a href="all-hotel" class="btn btn-success" style="padding: 6px;"><i class="fa fa-file-text-o"></i>
                      Hotels List</a>
                    <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                  </div>
                </div>
                <?php echo form_open_multipart(current_url() . '?' . $_SERVER['QUERY_STRING'], ['onsubmit' => 'return check_total();']); ?>
                <div class="card-body row">
                  <div class="col-lg-4 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <?php echo form_input(['name' => 'category_name', 'id' => 'category_name', 'class' => 'mdl-textfield__input', 'required' => 'required', 'value' => isset($category->category_name) ? $category->category_name : set_value('category_name')]); ?>
                      <label class="mdl-textfield__label">Category Name</label>
                      <?php echo form_error('category_name'); ?>
                    </div>
                  </div>

                  <div class="col-lg-4 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <?php echo form_input(['name' => 'room_size', 'id' => 'room_size', 'class' => 'mdl-textfield__input', 'value' => isset($category->room_size) ? $category->room_size : set_value('room_size')]); ?>
                      <label class="mdl-textfield__label">Room Size</label>
                      <?php echo form_error('room_size'); ?>
                    </div>
                  </div>

                  <div class="col-lg-4 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <?php echo form_input(['type' => 'number', 'min' => '0', 'name' => 'max_accomodation', 'id' => 'max_accomodation', 'required' => 'required', 'class' => 'mdl-textfield__input', 'value' => isset($category->max_accomodation) ? $category->max_accomodation : set_value('max_accomodation')]) ?>
                      <label class="mdl-textfield__label">Max Accomodation</label>
                      <?php echo form_error('max_accomodation'); ?>
                    </div>
                  </div>

                  <div class="col-lg-4 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <?php echo form_input(['type' => 'number', 'min' => '0', 'name' => 'adult_number', 'id' => 'adult_number', 'required' => 'required', 'class' => 'mdl-textfield__input', 'value' => isset($category->number_adults) ? $category->number_adults : set_value('adult_number')]) ?>
                      <label class="mdl-textfield__label">Number Of Adults</label>
                      <?php echo form_error('adult_number'); ?>
                    </div>
                  </div>

                  <div class="col-lg-4 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <?php echo form_input(['type' => 'number', 'min' => '0', 'name' => 'child_number', 'id' => 'child_number', 'required' => 'required', 'class' => 'mdl-textfield__input', 'value' => isset($category->number_childs) ? $category->number_childs : set_value('child_number')]); ?>
                      <label class="mdl-textfield__label">Number Of Child</label>
                      <?php echo form_error('child_number'); ?>
                    </div>
                  </div>

                  <div class="col-lg-4 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width is-focused">
                      <select name="child_bed" id="child_bed" class="mdl-textfield__input" style="padding-top:13px;">
                        <option value="">Select..</option>
                        <option value="CWB" <?php echo (isset($category->child_bed) && $category->child_bed == 'CWB') ? 'selected="selected"' : ''; ?>>
                          Child With Bed</option>
                        <option value="CNB" <?php echo (isset($category->child_bed) && $category->child_bed == 'CNB') ? 'selected="selected"' : ''; ?>>
                          Child No Bed</option>
                      </select>
                      <label class="mdl-textfield__label">Child Bed</label>
                      <?php echo form_error('isd_codes'); ?>
                    </div>
                  </div>

                  <div class="col-lg-12 p-t-20 text-center">
                    <?php echo form_submit(['name' => 'submit', 'id' => 'submit', 'class' => 'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-pink', 'value' => 'Submit']); ?>
                  </div>

                </div>
                <?php echo form_close(); ?>
              </div>

            </div>
          </div>
          <!-- end page content -->
        </div>
        <!-- end page container -->

        <div class="modal fade" id="modalAdd" role="dialog">
        <div class="modal-dialog modal-md" >
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="title-id">Import CSV</h4>
                    <button type="button" class="close" data-dismiss="modal" id="close-restaurant">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="response-messages" class="text-center"></div>
                            <div id="msgDiv"></div>
                            <form enctype="multipart/form-data" action="<?= base_url().'csv-upload?hotel_id=' . $this->input->get('hotel_id') ?>" method="post">
                                <div class="card-body row">
                                    <div class="col-lg-9 p-t-20">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <input type="file" id="csv_file" class="mdl-textfield__input" name="csv_file" required >
                                            <label class="mdl-textfield__label ml-3">File Upload</label>
                                        </div>
                                    </div>

                                    <div class="offset-1 col-lg-2 p-t-20" style="margin-top:20px;">
                                        <button type="submit" class="btn btn-primary" id="">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- <div class="card-body">
                    <div class="table-scrollable">
                        <table class="table table-hover table-checkable order-column full-width restaurant-table"
                            id="example2">
                            <thead>
                                <tr>
                                    <th class="">Sr.No</th>
                                    <th class="center">Date</th>
                                    <th class="center">Buffet</th>
                                    <th class="center">Start Time</th>
                                    <th class="center">End Time</th>
                                    <th class="center">Restaurant</th>
                                    <th class="center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $records_cnt = 1;
                                if (!empty($arrival_restaurants)) {
                                    foreach ($arrival_restaurants as $list) { ?>
                                <tr>
                                    <td class="center"><?= $records_cnt++ ?></td>
                                    <td class="center"><?= date('d-m-Y', strtotime($list->date)) ?></td>
                                    <td class="center"><?= $list->buffet ?></td>
                                    <td class="center"><?= $list->opening_time ?></td>
                                    <td class="center"><?= $list->closing_time ?></td>
                                    <td class="center"><?= $list->names ?></td>
                                </tr>
                                <?php }
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div> -->
            </div>
        </div>
    </div>

        <!-- start footer -->
        <?php include('admin_footer.php'); ?>
        <!-- end footer -->
      </div>
      <!-- start js include path -->
      <?php include('admin_footer_js.php'); ?>
      <!-- end js include path -->


      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <!-- jQuery UI -->
      <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
      <script src="assets/js/bootstrap.js"></script>
      <script>
        function check_total() {
          if ((parseInt($("#max_accomodation").val()) < parseInt($("#adult_number").val())) || (parseInt($("#max_accomodation").val()) - parseInt($("#child_number").val()) == 0)) {
            alert("Accomodation must be equal to number of adults and greater than number of child.");
            return false;
          }
        }

        $(document).ready(function() {
          $("#type").on("change", function() {
            $("#rights").css("display", "none");
            if ($(this).val() === "2") {
              $("#rights").css("display", "block");
            }
          });

          $("#child_number").on("keyup", function() {
            $("#child_bed option[value='CNB']").removeAttr('disabled');
            if ($(this).val() > 1) {
              $("#child_bed option[value='CNB']").attr('disabled', true);
              $("#child_bed").val("CWB");
            }
          })

        });

        $(document).ready(function() {

          $("#country").autocomplete({
            source: function(request, response) {
              // Fetch data
              $.ajax({
                url: "<?= base_url() ?>admin/company/get_country_ajax",
                type: 'post',
                dataType: "json",
                data: {
                  search: request.term
                },
                success: function(data) {

                  response(data);
                }
              });
            },
            select: function(event, ui) {
              // Set selection
              $('#country').val(ui.item.label); // display the selected text
              $('#country_id').val(ui.item.country_id); // save selected id to input

              return false;
            }
          });

          $("#state").autocomplete({
            source: function(request, response) {
              // Fetch data
              $.ajax({
                url: "<?= base_url() ?>admin/company/get_state_ajax",
                type: 'post',
                dataType: "json",
                data: {
                  search: request.term,
                  country_id: $('#country_id').val()
                },
                success: function(data) {

                  response(data);
                }
              });
            },
            select: function(event, ui) {
              // Set selection
              $('#state').val(ui.item.label); // display the selected text
              $('#state_id').val(ui.item.state_id); // save selected id to input

              return false;
            }
          });

          $("#city").autocomplete({
            source: function(request, response) {
              // Fetch data
              $.ajax({
                url: "<?= base_url() ?>admin/company/get_city_ajax",
                type: 'post',
                dataType: "json",
                data: {
                  search: request.term,
                  state_id: $('#state_id').val()
                },
                success: function(data) {

                  response(data);
                }
              });
            },
            select: function(event, ui) {
              // Set selection
              $('#city').val(ui.item.label); // display the selected text
              //   $('#company_id').val(ui.item.company_id); // save selected id to input

              return false;
            }
          });


          $(".pricing").on("click", function() {
            $("#myModalpricing input").val('');
            $('#response-message').html('');
            $("#myModalpricing select").val('');
            $("#myModalpricing").modal("toggle");
            $("#category-name").html("").html($(this).attr("data-cat-name"));
            $("#category_id").val("").val($(this).attr("data-cat-id"));
            $("#hotel_id").val("").val($(this).attr("data-hotel-id"));
            var children = parseInt($(this).attr("data-child"));

            var h = $(".adult_occupany").clone();
            var label = {
              "2": "Double",
              "3": "Triple",
              "4": "Four",
              "5": "Five"
            };
            var html = '';
            for (var i = 1; i < parseInt($(this).attr("data-adults")); i++) {
              h.find('label').text(label[i + 1] + " Occupany Price");
              html = html + h.html();
            }
            $(".adult_occupany_div").html("").html(html);

            var children = parseInt($(this).attr("data-child"), 10);
            var childBedValue = $(this).attr("data-child-bed");

            if (children === 0) {
              $('.child_occupancy_row').addClass('hide-accessible');
              $(".child_occupancy_row :input[name='childprice_with_breakfast[]']").removeAttr("required");
            } else {
              $('.child_occupancy_row').removeClass('hide-accessible');
              $(".child_occupancy_row :input[name='childprice_with_breakfast[]']").attr("required", true);
              var h1 = $(".child_occupancy").first().clone();
              var childHtml = '';
              $(".select_child_bed").eq(0).val(childBedValue).prop("disabled", true);
              $(".child_bed_value").eq(0).val(childBedValue);

              // Loop to create multiple child occupancy rows
              for (var i = 1; i <= children - 1; i++) {
                // Ensure each cloned element has a unique ID by appending a counter
                h1.find(".select_child_bed option[value=CNB]").attr('selected', 'selected');
                h1.find(".select_child_bed").prop("disabled", true);
                h1.find(".child_bed_value").val("CNB");
                var newHtml = h1.html().replace(/childprice_id/g, 'childprice_id_' + i);
                childHtml += newHtml;
              }

              $(".child_occupancy_div").html(childHtml);
              //$(".select_child_bed").val(childBedValue).prop("disabled", true);
              //$(".child_bed_value").val(childBedValue);
            }

            // Send an AJAX request to fetch additional data
            $.ajax({
              url: 'edit-room-category-costing',
              type: 'GET',
              dataType: 'json',
              data: {
                category_id: $('#category_id').val(),
                hotel_id: $('#hotel_id').val()
              },
              success: function(response) {

                if (response.response === "success" && response.details.length > 0) {
                  $("#add-form-category").attr("id", "edit-form-category");

                  // Change modal title from "Add Prices" to "Edit Prices"
                  $(".modal-title").text("Edit Prices");

                  // Change button text from "Add" to "Edit"
                  $("#add-pricing").text("Edit").attr("id", "edit-pricing");

                  // Update from_date and to_date fields
                  $('#from_date').val(response.details[0].from_date);
                  $('#to_date').val(response.details[0].to_date);

                  /*if (response.details[0].type === "adult") {
                    $(".mdl-textfield__input[name='adultpriceid[]']").val(response.details[0].id);
                    $('#adultprice_with_breakfast').val(response.details[0].price_with_breakfast);
                    $('#adultprice_without_breakfast').val(response.details[0].price_without_breakfast);
                  }
                  if (response.details[1].type === "child") {
                    $(".mdl-textfield__input[name='childpriceid[]']").val(response.details[1].id);
                    $(".select_child_bed").val(response.details[1].child_bed);
                    $(".child_bed_value").val(response.details[1].child_bed);
                    $('#childprice_with_breakfast').val(response.details[1].price_with_breakfast);
                    $('#childprice_without_breakfast').val(response.details[1].price_without_breakfast);
                  }
                  if (response.details[2].type === "child") {
                    $(".mdl-textfield__input[name='childpriceid[]']").val(response.details[2].id);
                    $(".select_child_bed").val(response.details[2].child_bed);
                    $(".child_bed_value").val(response.details[2].child_bed);
                    $('#childprice_with_breakfast').val(response.details[2].price_with_breakfast);
                    $('#childprice_without_breakfast').val(response.details[2].price_without_breakfast);
                  }*/

                  // Populate fields with the response data
                  response.details.forEach(function(detail) {
                    if (detail.type === "adult") {
                      var index = parseInt(detail.person_count) - 1; // Adjusting index to 0-based
                      $("#edit-form-category input[name='adultpriceid[]']").eq(index).val(detail.id);
                      $("#edit-form-category input[name='adultprice_with_breakfast[]']").eq(index).val(detail.price_with_breakfast);
                      $("#edit-form-category input[name='adultprice_without_breakfast[]']").eq(index).val(detail.price_without_breakfast);
                    } else if (detail.type === "child") {
                      var index = parseInt(detail.person_count) - 1; // Adjusting index to 0-based
                      $("#edit-form-category input[name='childpriceid[]']").eq(index).val(detail.id);
                      $("#edit-form-category input[name='childprice_with_breakfast[]']").eq(index).val(detail.price_with_breakfast);
                      $("#edit-form-category input[name='childprice_without_breakfast[]']").eq(index).val(detail.price_without_breakfast);
                      $("#edit-form-category .select_child_bed").eq(index).val(detail.child_bed);
                      $("#edit-form-category .child_bed_value").eq(index).val(detail.child_bed);
                    }
                  });

                }
              },
              error: function(xhr, status, error) {
                console.error("AJAX Request Failed: ", status, error);
              }
            });
          });

          $('.close-modal').on('click', function(e) {
            location.reload(true);
          });

          function validateDates() {
            var fromDate = new Date($('#from_date').val());
            var toDate = new Date($('#to_date').val());
            if (fromDate >= toDate) {
              $('#date-error-message').show();
              return false;
            } else {
              $('#date-error-message').hide();
              return true;
            }
          }

          // Validate dates on input change
          $('#from_date, #to_date').change(function() {
            validateDates();
          });

          $('#add-form-category').submit(function(e) {
            if (!validateDates()) {
              e.preventDefault();
            } else {
              e.preventDefault();
            }

            var formData = new FormData(this);
            var hotel_id = $('#hotel_id').val();
            var category_id = $('#category_id').val();
            var id = $('#adultprice_id').val();
            formData.append('category_id', category_id);
            formData.append('hotel_id', hotel_id);

            var url;
            if (id) {
              var url = 'edit-room-category-estimation'
            } else {
              var url = 'costing-room-category-estimation'
            }

            // Extract dates and validate
            var fromDate = $('#from_date').val();
            var toDate = $('#to_date').val();

            if (new Date(fromDate) >= new Date(toDate)) {
              $('#response-message').html(
                '<div class="alert alert-danger text-center" role="alert">From date must be earlier than to date.</div>'
              );
              return; // Stop form submission
            }

            $.ajax({
              type: 'POST',
              url: url,
              data: formData,
              processData: false,
              contentType: false,
              dataType: 'json',
              success: function(response) {
                $('#response-message').html(
                  '<div class="alert alert-success text-center" role="alert">' + response.msg + '</div>'
                );
                window.location.reload();
              },
              error: function() {
                $('#response-message').html(
                  '<div class="alert alert-danger text-center" role="alert">Failed to submit form. Please try again.</div>'
                );
              }
            });
          });


        });
      </script>
</body>

</html>