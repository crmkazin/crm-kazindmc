<!-- old -->
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
                <li><a class="parent-item" href="<?= base_url(); ?>all-hotel">Hotel List</a>&nbsp;<i class="fa fa-angle-right"></i>
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
                  <header>All Room Categories : <?php echo $categories[0]->name; ?></header>
                  <div class="tools">
                    <a href="<?php echo base_url() . 'room-category-hotel?hotel_id=' . $this->input->get('hotel_id'); ?>&modal=1" class="btn btn-info" style="padding:6px;" id="add-category"><i class="fa fa-plus"></i>
                      Add Category</a>
                    <?php 
                    $allowed_users = ['13','8','33','14','51'];
                    if(in_array($this->session->userdata('id'),$allowed_users)){ ?>
                    <a href="#" data-toggle="modal" data-target="#modalAdd" class="btn  btn-info" style="padding:6px;">Import CSV</a>
                    <a href="hotel-pricing-download?hotel_id=<?= $this->input->get('hotel_id'); ?>" class="btn  btn-default" style="padding:6px;">Export to excel</a>
                    <?php } ?>
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
                        if (!empty($categories && $categories[0]->category_name<>'')) {
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
                                <?php if($list->status === 'active' && $list->price_with_breakfast <> '' && $list->price_with_breakfast > 0){
                                        $btn = 'color:#49d701;';
                                        $status = 'Active';
                                      }else if($list->status === 'active' && ($list->price_with_breakfast == '' || $list->price_with_breakfast == 0)){
                                          $btn = 'color:#ffa500;';
                                          $status = 'Active - No Prices';
                                      }else if($list->status === 'inactive'){
                                          $btn = 'color:#ff1a02;';
                                          $status = 'In-Active';
                                      }
                                    ?>
                                <span style="<?=$btn ?>"><?=$status ?></span>
                                <?php //echo ($list->status === 'active') ? '<a class="btn btn-success btn-xs">' . ucfirst($list->status) . '</a>' : '<a class="btn btn-warning btn-xs">' . ucfirst($list->status) . '</a>';
                                ?> </td>
                              <td class="center">
                                <!-- <button class="btn btn-primary btn-xs pricing" data-adults="<?= $list->number_adults ?>" data-child="<?= $list->number_childs ?>" data-cat-name="<?php echo $list->category_name; ?>" data-cat-id="<?php echo base64_encode($list->id); ?> " data-hotel-id="<?php echo base64_encode($list->hotel_id); ?>" data-child-bed="<?php echo $list->child_bed; ?>" title="Pricing" style="padding:4px 4px;">Prices</button> -->
                                <a href="<?php echo base_url() . 'room-category-hotel?hotel_id=' . base64_encode($list->hotel_id) . '&category_id=' . base64_encode($list->id); ?>&modal=1" title="Edit" class="btn btn-tbl-edit btn-xs">
                                  <i class="fa fa-edit"></i>
                                </a>
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

          <!-- end page content -->
        </div>
        <!-- end page container -->

        <div class="modal fade" id="modalAdd" role="dialog">
          <div class="modal-dialog modal-md">
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
                    <form enctype="multipart/form-data" action="<?= base_url() . 'csv-upload?hotel_id=' . $this->input->get('hotel_id') ?>" method="post">
                      <div class="card-body row">
                        <div class="col-lg-9 p-t-20">
                          <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                            <input type="file" id="csv_file" class="mdl-textfield__input" name="csv_file" required>
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
            </div>
          </div>
        </div>

        <div class="modal fade" id="modalAddCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content" style="padding: 15px;">
              <div class="modal-header">
                <h4 class="modal-title" id="title-id">
                  <h4><?php echo empty($this->input->get('category_id')) ? 'Add' : 'Edit'; ?>
                    Room Category</h4>
                  <button type="button" class="close" data-dismiss="modal" id="close-modal">&times;</button>
              </div>
              <div class="modal-body">
                <?php // echo form_open_multipart(current_url() . '?' . $_SERVER['QUERY_STRING'], ['id' => 'form_Data']); 
                ?>
                <form id="form_Data" enctype="multipart/form-data" method="POST" action="<?php echo current_url() . '?' . $_SERVER['QUERY_STRING'] ?>">
                  <div class="row">
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
                        <?php echo form_input(['type' => 'text', 'min' => '0', 'name' => 'max_accomodation', 'id' => 'max_accomodation', 'required' => 'required', 'class' => 'mdl-textfield__input', 'value' => isset($category->max_accomodation) ? $category->max_accomodation : set_value('max_accomodation')]) ?>
                        <label class="mdl-textfield__label">Max Accomodation</label>
                        <?php echo form_error('max_accomodation'); ?>
                      </div>
                    </div>

                    <div class="col-lg-4 p-t-20">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <?php echo form_input(['type' => 'text', 'min' => '0', 'name' => 'adult_number', 'id' => 'adult_number', 'required' => 'required', 'class' => 'mdl-textfield__input', 'value' => isset($category->number_adults) ? $category->number_adults : set_value('adult_number')]) ?>
                        <label class="mdl-textfield__label">Number Of Adults</label>
                        <?php echo form_error('adult_number'); ?>
                      </div>
                    </div>

                    <div class="col-lg-4 p-t-20">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <?php echo form_input(['type' => 'text', 'min' => '0', 'name' => 'child_number', 'id' => 'child_number', 'required' => 'required', 'class' => 'mdl-textfield__input', 'value' => isset($category->number_childs) ? $category->number_childs : set_value('child_number')]); ?>
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
                        <?php echo form_error('child_bed'); ?>
                      </div>
                    </div>

                    <?php 
                    $currency = isset($currency[0]->currency_name) ? $currency[0]->currency_name : '';
                    
                    if (empty($category_costing)): ?>
                      <div class="col-lg-6 p-t-20">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                          <?php echo form_input(['type' => 'text', 'name' => 'adultprice_with_breakfast[]', 'id' => 'adultprice_with_breakfast', 'placeholder' => 'Price', 'class' => 'mdl-textfield__input', 'value' => '', 'required' => 'required']) ?>
                          <label class="mdl-textfield__label adult_label_name">Single Occupancy Price (<?=$currency ?>)</label>
                          <?php echo form_error('adultprice_with_breakfast'); ?>
                        </div>
                      </div>

                      <div id="childPriceContainer" class="col-lg-6 p-t-20" style="display: none;">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                          <?php echo form_input(['type' => 'text', 'name' => 'childprice_with_breakfast[]', 'id' => 'childprice_with_breakfast', 'placeholder' => 'Price', 'class' => 'mdl-textfield__input', 'value' => '']) ?>
                          <label class="mdl-textfield__label child_label_name">Child Occupancy Price (<?=$currency ?>)</label>
                          <?php echo form_error('childprice_with_breakfast'); ?>
                        </div>
                      </div>

                      <div id="adultPriceContainer" class="col-lg-6">
                        <!-- Dynamically added adult price fields will appear here -->
                      </div>
                    <?php endif; ?>

                    <?php if (!empty($category_costing)): ?>
                      <!-- Show adult price for person_count == 1 -->
                      <?php foreach ($category_costing as $price): ?>
                        <?php if ($price->type === 'adult' && $price->person_count == 1): ?>
                          <div class="col-lg-6 p-t-20">
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                              <input type="text" name="adultprice_with_breakfast[]" class="mdl-textfield__input" placeholder="Price" value="<?php echo $price->price_with_breakfast; ?>" required>
                              <label class="mdl-textfield__label">Single Occupancy Price (<?=$currency ?>)</label>
                            </div>
                          </div>
                        <?php endif; ?>
                      <?php endforeach; ?>

                      <?php $childPriceDisplayed = false; ?>

                      <!-- Show child price for person_count == 1 statically -->
                      <?php foreach ($category_costing as $price): ?>
                        <?php if ($price->type === 'child' && $price->person_count == 1 && $price->child_bed === 'CWB'): ?>
                          <div id="childPriceContainer" class="col-lg-6 p-t-20">
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                              <input type="text" name="childprice_with_breakfast[]" class="mdl-textfield__input" placeholder="Price" value="<?php echo $price->price_with_breakfast; ?>" required>
                              <label class="mdl-textfield__label">Child Occupancy Price (<?=$currency ?>)</label>
                            </div>
                          </div>
                        <?php endif; ?>
                      <?php endforeach; ?>

                      <?php if (!$childPriceDisplayed): ?>
                        <div id="childPriceContainerClone" class="col-lg-6 p-t-20" style="display:none;">
                          <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                            <input type="text" name="childprice_with_breakfast[]" class="mdl-textfield__input" placeholder="Price" value="">
                            <label class="mdl-textfield__label">Child Occupancy Price (<?=$currency ?>)</label>
                          </div>
                        </div>
                      <?php endif; ?>

                      <div class="col-lg-6 p-t-20">
                        <!-- Dynamically show other person counts for both adult -->
                        <?php foreach ($category_costing as $price): ?>
                          <?php if (($price->type === 'adult') && $price->person_count > 1): ?>
                            <div class="col-lg-12 p-t-20">
                              <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                <?php
                                // Determine label based on person_count
                                $label = ($price->person_count == 2) ? "Double Occupancy Price" : (($price->person_count == 3) ? "Triple Occupancy Price" : "Four Occupancy Price");
                                ?>
                                <input type="text" name="<?php echo $price->type === 'adult' ? 'adultprice_with_breakfast[]' : 'childprice_with_breakfast[]'; ?>" class="mdl-textfield__input" placeholder="Price" value="<?php echo $price->price_with_breakfast; ?>" required>
                                <input type="hidden" name="person_count" id="person_count" value="<?= $price->person_count ?>">
                                <label class="mdl-textfield__label"><?php echo $label; ?> (<?=$currency ?>)</label>
                              </div>
                            </div>
                          <?php endif; ?>
                        <?php endforeach; ?>
                      </div>

                      <div id="adultPriceContainerDynamic" class="col-lg-6">
                        <!-- Dynamically added adult price fields will appear here -->
                      </div>
                    <?php endif; ?>


                    <div class="col-lg-12 p-t-20 text-center">
                      <?php echo form_submit(['name' => 'submit', 'id' => 'submit', 'class' => 'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-pink', 'value' => 'Submit']); ?>
                    </div>

                  </div>
                  <?php // echo form_close(); 
                  ?>
                </form>
              </div>
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
        });
      </script>

      <script>
        document.addEventListener("DOMContentLoaded", function() {
          // Get references to relevant fields
          const maxAccomodation = document.getElementById("max_accomodation");
          const adultNumber = document.getElementById("adult_number");
          const childNumber = document.getElementById("child_number");
          const adultPriceContainer = document.getElementById("adultPriceContainer");
          const childBedSelect = document.getElementById("child_bed");
          const childPriceContainer = document.getElementById("childPriceContainer");
          const childPriceContainerClone = document.getElementById("childPriceContainerClone");


          function updateMaxAccomodation() {
            const adultValue = Math.min(parseInt(adultNumber.value) || 0, 4);
            const childValue = Math.min(parseInt(childNumber.value) || 0, 1);
            const totalOccupancy = adultValue + childValue;

            maxAccomodation.value = totalOccupancy;
            generateAdultPriceFields(adultValue);
          }

          function generateAdultPriceFields(count) {
            // Ensure adultPriceContainer exists before attempting to modify its content
            if (adultPriceContainer) {
              adultPriceContainer.innerHTML = ""; // Clear existing fields

              for (let i = 2; i <= count; i++) {
                const wrapper = document.createElement("div");
                wrapper.classList.add("col-lg-12", "p-t-20");

                const field = document.createElement("div");
                field.classList.add("mdl-textfield", "mdl-js-textfield", "mdl-textfield--floating-label", "txt-full-width");

                let label = i === 2 ? "Double Occupancy Price" : i === 3 ? "Triple Occupancy Price" : "Four Occupancy Price";

                field.innerHTML = `
          <input type="text" name="adultprice_with_breakfast[]" class="mdl-textfield__input" placeholder="Price" required>
          <label class="mdl-textfield__label">${label} (<?=$currency ?>)</label>
        `;
                wrapper.appendChild(field);
                adultPriceContainer.appendChild(wrapper);
              }
            }
          }

          if (childBedSelect && childPriceContainer) {
            childBedSelect.addEventListener("change", function() {
              childPriceContainer.style.display = childBedSelect.value === "CWB" ? "block" : "none";
            });
          }

          if (childBedSelect && childPriceContainerClone) {
            childBedSelect.addEventListener("change", function() {
              childPriceContainerClone.style.display = childBedSelect.value === "CWB" ? "block" : "none";
            });
          }

          if (adultNumber) {
            adultNumber.addEventListener("input", function() {
              adultNumber.value = Math.min(parseInt(adultNumber.value) || 0, 4);
              updateMaxAccomodation();
            });
          }

          if (childNumber) {
            childNumber.addEventListener("input", updateMaxAccomodation);
          }

          updateMaxAccomodation();

          if (childPriceContainer && childBedSelect) {
            childPriceContainer.style.display = childBedSelect.value === "CWB" ? "block" : "none";
          }

          //Event listener for the 'Add' buttons
          document.getElementById('add-category')?.addEventListener('click', function() {
            // Set a flag to sessionStorage before the page reloads
            sessionStorage.setItem('showModal', 'true');
          });

          //Event listener for the 'Edit' buttons
          document.querySelectorAll('.btn.btn-tbl-edit').forEach(function(element) {
            element.addEventListener('click', function(event) {
              // Reset the form
              $('#form_Data')[0].reset();

              const adultInput = document.getElementById('adult_number');
              const personCount = document.getElementById('person_count');
              const personCountNumber = parseInt(personCount.value) || 0;

              // Clear previous fields
              const container = document.getElementById('adultPriceContainerDynamic');
              container.innerHTML = ''; // Clear existing fields before resetting

              // Add listener to adult number input
              adultInput.addEventListener('input', function() {
                const currentAdultNumber = parseInt(this.value) || 0;
                const difference = currentAdultNumber - personCountNumber;

                // Function to add new fields
                function addFields(count) {
                  for (let i = 0; i < count; i++) {
                    const newFieldIndex = personCountNumber + i + 1;

                    const wrapper = document.createElement("div");
                    wrapper.classList.add("col-lg-12", "p-t-20");

                    const newInputField = document.createElement('div');
                    newInputField.classList.add('mdl-textfield', 'mdl-js-textfield', 'mdl-textfield--floating-label', 'txt-full-width');

                    // Set occupancy label
                    const occupancyLabel = newFieldIndex === 1 ? 'Single' :
                      newFieldIndex === 2 ? 'Double' :
                      newFieldIndex === 3 ? 'Triple' :
                      newFieldIndex === 4 ? 'Quadruple' :
                      `${newFieldIndex} Occupancy`;

                    newInputField.innerHTML = `
                                  <label class="mdl-textfield__label adult_label_name">${occupancyLabel} Occupancy Price</label>
                                  <input type="text" name="adultprice_with_breakfast[]" id="adultprice_with_breakfast_${newFieldIndex}" placeholder="Price" class="mdl-textfield__input" required>
                              `;

                    wrapper.appendChild(newInputField);
                    container.appendChild(wrapper);
                  }
                }

                // Add or remove fields based on the difference
                if (difference > 0) {
                  addFields(difference);
                } else if (difference < 0) {
                  const fieldsToRemove = Math.abs(difference);
                  const existingFields = container.querySelectorAll('.mdl-textfield');
                  for (let i = 0; i < fieldsToRemove && existingFields.length > 0; i++) {
                    existingFields[existingFields.length - 1].remove();
                  }
                }
              });
            });
            //sessionStorage.setItem('showModal', 'true');
          });

          window.addEventListener('load', function() {
            const currentUrl = new URL(window.location.href);
            const params = currentUrl.searchParams;

            // Check if 'modal' parameter is set to '1'
            if (params.get('modal') === '1') {
              $('#modalAddCategory').modal('show');

              // Remove the modal parameter from the URL
              params.delete('modal');
              window.history.replaceState({}, document.title, currentUrl);
            }

          });

          $('#close-modal').on('click', function(e) {
            $('#form_Data')[0].reset();
            const currentUrl = new URL(window.location.href);
            const params = currentUrl.searchParams;
            params.delete('modal');
            window.history.replaceState({}, document.title, currentUrl);
          });

        });
      </script>

</body>

</html>