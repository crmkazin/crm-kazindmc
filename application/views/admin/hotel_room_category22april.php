 <?php include('admin_head_css.php'); ?>
  <style>
    .hide-accessible {
      position: absolute;
      opacity: 0;
      pointer-events: none;
    }
  </style>
  <div class="page-wrapper">
    <div class="container-fluid">
      <!-- start page content -->
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
                    <a href="" class="add-category-cost" data-toggle="modal" data-target="#modalAddCategory" data-hotel_id="<?= base64_encode($categories[0]->hotel_id) ?>" class="btn btn-info" style="padding:6px;" id="add-category"><i class="fa fa-plus"></i>
                      Add Category</a>
                    <?php
                    $allowed_users = ['13', '8', '33', '14', '51'];
                    if (in_array($this->session->userdata('id'), $allowed_users)) { ?>
                      <a href="#" data-toggle="modal" data-target="#modalAdd" class="btn  btn-info" style="padding:6px;">Import CSV</a>
                      <a href="hotel-pricing-download?hotel_id=<?= $this->input->get('hotel_id'); ?>" class="btn  btn-default" style="padding:6px;">Export to excel</a>
                    <?php } ?>
                    <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                  </div>
                </div>
                <div class="card-body">
                  <div class="table-scrollable">
                    <table class="table table-hover table-checkable order-column full-width" id="">
                      <thead>
                        <tr>
                          <th class="center">Sr.No</th>
                          <th class="center">Category Name</th>
                          <th class="center">Room Size</th>
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
                        if (!empty($categories && $categories[0]->category_name <> '')) {
                          foreach ($categories as $list) {
                        ?>
                            <tr class="odd gradeX">
                              <td class="center"><?= $i++ ?></td>
                              <td class="center"><?php echo ucwords(strtolower($list->category_name)); ?></td>
                              <td class="center"><?= $list->room_size ?></td>
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
                                <?php if ($list->status === 'active' && $list->price_with_breakfast <> '' && $list->price_with_breakfast > 0) {
                                  $btn = 'color:#49d701;';
                                  $status = 'Active';
                                } else if ($list->status === 'active' && ($list->price_with_breakfast == '' || $list->price_with_breakfast == 0)) {
                                  $btn = 'color:#ffa500;';
                                  $status = 'Active - No Prices';
                                } else if ($list->status === 'inactive') {
                                  $btn = 'color:#ff1a02;';
                                  $status = 'In-Active';
                                }
                                ?>
                                <span style="<?= $btn ?>"><?= $status ?></span>
                                <?php //echo ($list->status === 'active') ? '<a class="btn btn-success btn-xs">' . ucfirst($list->status) . '</a>' : '<a class="btn btn-warning btn-xs">' . ucfirst($list->status) . '</a>';
                                ?>
                              </td>
                              <td class="center">
                                <!-- <button class="btn btn-primary btn-xs pricing" data-adults="<?= $list->number_adults ?>" data-child="<?= $list->number_childs ?>" data-cat-name="<?php echo $list->category_name; ?>" data-cat-id="<?php echo base64_encode($list->id); ?> " data-hotel-id="<?php echo base64_encode($list->hotel_id); ?>" data-child-bed="<?php echo $list->child_bed; ?>" title="Pricing" style="padding:4px 4px;">Prices</button> -->
                                <a href="#" class="add-category-cost" data-toggle="modal" data-target="#modalAddCategory" data-hotel_id="<?= base64_encode($list->hotel_id) ?>" data-category_id="<?= base64_encode($list->id); ?>" title="Edit" class="btn btn-tbl-edit btn-xs">
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

        <div class="modal fade" id="modalAddCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  data-keyboard="false" data-backdrop="static">
          <div class="modal-dialog" style="max-width:1000px">
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
                  <div class="row add-edit">

                    <?php echo form_input(['type' => 'hidden', 'name' => 'hotel_id', 'id' => 'hotel_id', 'class' => 'mdl-textfield__input', 'required' => 'required']); ?>
                    <?php echo form_input(['type' => 'hidden', 'name' => 'category_id', 'id' => 'category_id', 'class' => 'mdl-textfield__input', 'required' => 'required']); ?>

                    <div class="col-lg-3 p-t-20">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <?php echo form_input(['type' => 'date', 'name' => 'from_date', 'id' => 'from_date', 'class' => 'mdl-textfield__input', 'required' => 'required']); ?>
                        <label class="mdl-textfield__label">Date from</label>
                        <?php echo form_error('from_date'); ?>
                      </div>
                    </div>

                    <div class="col-lg-3 p-t-20">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <?php echo form_input(['type' => 'date', 'name' => 'to_date', 'id' => 'to_date', 'class' => 'mdl-textfield__input', 'required' => 'required']); ?>
                        <label class="mdl-textfield__label">Date to</label>
                        <?php echo form_error('to_date'); ?>
                      </div>
                    </div>

                    <div class="col-lg-3 p-t-20">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <?php echo form_input(['name' => 'category_name', 'id' => 'category_name', 'class' => 'mdl-textfield__input', 'required' => 'required']); ?>
                        <label class="mdl-textfield__label">Category Name</label>
                        <?php echo form_error('category_name'); ?>
                      </div>
                    </div>

                    <div class="col-lg-3 p-t-20">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <?php echo form_input(['name' => 'room_size', 'id' => 'room_size', 'class' => 'mdl-textfield__input']); ?>
                        <label class="mdl-textfield__label">Room Size</label>
                      </div>
                    </div>

                    <div class="col-lg-3 p-t-20">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <?php echo form_input(['type' => 'text', 'min' => '0', 'name' => 'max_accomodation', 'id' => 'max_accomodation', 'required' => 'required', 'class' => 'mdl-textfield__input']) ?>
                        <label class="mdl-textfield__label">Max Accomodation</label>
                      </div>
                    </div>

                    <div class="col-lg-3 p-t-20">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <?php echo form_input(['type' => 'text', 'min' => '0', 'name' => 'adult_number', 'id' => 'adult_number', 'required' => 'required', 'class' => 'mdl-textfield__input']) ?>
                        <label class="mdl-textfield__label">Number Of Adults</label>
                      </div>
                    </div>

                    <div class="col-lg-3 p-t-20">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <?php echo form_input(['type' => 'text', 'min' => '0', 'name' => 'child_number', 'id' => 'child_number', 'required' => 'required', 'class' => 'mdl-textfield__input']); ?>
                        <label class="mdl-textfield__label">Number Of Child</label>
                      </div>
                    </div>

                    <div class="col-lg-3 p-t-20">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width is-focused">
                        <select name="child_bed" id="child_bed" class="mdl-textfield__input" style="padding-top:13px;">
                          <option value="">Select..</option>
                          <option value="CWB">
                            Child With Bed</option>
                          <option value="CNB">
                            Child No Bed</option>
                        </select>
                        <label class="mdl-textfield__label">Child Bed</label>
                      </div>
                    </div>

                    <?php
                    $currency = $currency[0]->currency_name; ?>

                    <div class="col-lg-6 p-t-20">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <?php echo form_input(['type' => 'text', 'name' => 'adultprice_with_breakfast[]', 'id' => 'adultprice_with_breakfast', 'placeholder' => 'Price', 'class' => 'mdl-textfield__input', 'value' => '', 'required' => 'required']) ?>
                        <label class="mdl-textfield__label adult_label_name">Single Occupancy Price (<?= $currency ?>)</label>
                        <?php echo form_error('adultprice_with_breakfast'); ?>
                      </div>
                    </div>

                    <div id="childPriceContainer" class="col-lg-6 p-t-20" style="display: none;">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <?php echo form_input(['type' => 'text', 'name' => 'childprice_with_breakfast[]', 'id' => 'childprice_with_breakfast', 'placeholder' => 'Price', 'class' => 'mdl-textfield__input', 'value' => '']) ?>
                        <label class="mdl-textfield__label child_label_name">Child Occupancy Price (<?= $currency ?>)</label>
                        <?php echo form_error('childprice_with_breakfast'); ?>
                      </div>
                    </div>

                    <div id="adultPriceContainer" class="col-lg-6">
                      <!-- Dynamically added adult price fields will appear here -->
                    </div>

                  </div>
                  <div class="col-lg-12 p-t-20 text-center">
                    <?php echo form_submit(['name' => 'submit', 'id' => 'submit', 'class' => 'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20', 'value' => 'Submit','disabled'=>'disabled']); ?>
                  </div>
                </form>
              </div>


              <div class="row">
                <div class="col-md-12">
                  <div class="table-scrollable">
                    <table class="table table-hover table-checkable order-column full-width" id="example4">
                      <thead>
                        <tr>
                          <th class="center">Sr.No</th>
                          <th class="center">Date From</th>
                          <th class="center">Date to</th>
                          <th class="center">Max Accomodation</th>
                          <th class="center">Adult</th>
                          <th class="center">Child</th>
                          <th class="center">Single</th>
                          <th class="center">Double</th>
                          <th class="center">Triple</th>
                          <th class="center">Four</th>
                          <th class="center">Child Price</th>
                          <th class="center">Action</th>
                        </tr>
                      </thead>
                      <tbody class="room-category-prices">

                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

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
    <script>
      $(document).ready(function() {

        $(document).on('click', '.add-category-cost', function(e) {
          e.preventDefault();
          var hotelId = $(this).data('hotel_id');
          var categoryId = $(this).data('category_id');
          get_price(hotelId, categoryId);
          $("#submit").removeAttr("disabled").addClass("btn-pink");  
        });

        $(document).on('click', 'tr[id]', function() {
          $("#submit").removeAttr("disabled").addClass("btn-pink");  
          // Clear previous data
          $('.add-edit').children('div').slice(8).remove();
          $('#from_date').val(''); // Reset from_date field
          $('#to_date').val(''); // Reset to_date field

          // Get the category ID from the row class
          var categoryId = $(this).attr('class');

          // Extract data from the row
          var fromDate = $(this).find('[data-from_date]').data('from_date');
          var toDate = $(this).find('[data-to_date]').data('to_date');
          var single = $(this).find('#price_with_breakfast_adult_person_count_1').text().trim();
          var single_adult_uid = $(this).find('#price_with_breakfast_adult_person_count_1').attr("data-update-id-adult-count-1").trim();
          var double = $(this).find('#price_with_breakfast_adult_person_count_2').text().trim();
          var double_adult_uid = $(this).find('#price_with_breakfast_adult_person_count_2').attr("data-update-id-adult-count-2").trim();
          var triple = $(this).find('#price_with_breakfast_adult_person_count_3').text().trim();
          var triple_adult_uid = $(this).find('#price_with_breakfast_adult_person_count_3').attr("data-update-id-adult-count-3").trim();
          var four = $(this).find('#price_with_breakfast_adult_person_count_4').text().trim();
          var four_adult_uid = $(this).find('#price_with_breakfast_adult_person_count_4').attr("data-update-id-adult-count-4").trim();
          var child = $(this).find('#price_with_breakfast_child_person_count_1').text().trim().split("(")[0];
          var child_uid = $(this).find('#price_with_breakfast_child_person_count_1').attr("data-update-id-child-count-1").trim();
          // Initialize input fields
          var $inputField = '';

          if (single !== '-') {
            $inputField += `
      <div class="col-lg-6 p-t-20 single-occupancy">
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
          <input type="text" name="adultprice_with_breakfast[]" class="mdl-textfield__input" value="${single}" required>
          <input type="hidden" name="adultprice_update_id[]" value="${single_adult_uid}">
          <label class="mdl-textfield__label">Single Occupancy Price</label>
        </div>
      </div>`;
          }

          if (child !== '-') {
            $inputField += `
      <div class="col-lg-6 p-t-20 child-occupancy">
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
          <input type="text" name="childprice_with_breakfast[]" class="mdl-textfield__input" value="${child}" required>
          <input type="hidden" name="childprice_update_id[]" value="${child_uid}">
          <label class="mdl-textfield__label">Child Occupancy Price</label>
        </div>
      </div>`;
          }

          if (double !== '-') {
            $inputField += `
      <div class="col-lg-6 p-t-20 double-occupancy">
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
          <input type="text" name="adultprice_with_breakfast[]" class="mdl-textfield__input" value="${double}" required>
          <input type="hidden" name="adultprice_update_id[]" value="${double_adult_uid}">
          <label class="mdl-textfield__label">Double Occupancy Price</label>
        </div>
      </div>`;
          }

          if (triple !== '-') {
            $inputField += `
      <div class="col-lg-6 p-t-20 triple-occupancy">
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
          <input type="text" name="adultprice_with_breakfast[]" class="mdl-textfield__input" value="${triple}" required>
          <input type="hidden" name="adultprice_update_id[]" value="${triple_adult_uid}">
          <label class="mdl-textfield__label">Triple Occupancy Price</label>
        </div>
      </div>`;
          }

          if (four !== '-') {
            $inputField += `
      <div class="col-lg-6 p-t-20 four-occupancy">
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
          <input type="text" name="adultprice_with_breakfast[]" class="mdl-textfield__input" value="${four}" required>
          <input type="hidden" name="adultprice_update_id[]" value="${four_adult_uid}">
          <label class="mdl-textfield__label">Four Occupancy Price</label>
        </div>
      </div>`;
          }

          // Append the new input fields to the edit container
          $('.add-edit').append($inputField);

          // Update the hidden fields with the new data
          $('#from_date').val(fromDate || '');
          $('#to_date').val(toDate || '');
        });

        function get_price(hotelId, categoryId) {
          $.ajax({
            url: '<?= base_url() ?>admin/hotel/room_category_prices',
            type: 'POST',
            data: {
              hotel_id: hotelId,
              category_id: categoryId
            },
            dataType: "json",
            success: function(response) {
              var tableBody = $('#example4 tbody');
              tableBody.empty(); // Clear the table body

              // Check if details exist and populate the form fields
              if (response.details && Object.keys(response.details).length > 0) {
                $('#hotel_id').val(hotelId || '');
                $('#category_id').val(categoryId || '');
                $('#category_name').val(response.details.category_name || '');
                $('#room_size').val(response.details.room_size || '');
                $('#max_accomodation').val(response.details.max_accomodation || '');
                $('#adult_number').val(response.details.number_adults || '');
                $('#child_number').val(response.details.number_childs || '');

                var childBedValue = response.details.child_bed || '';

                if ($('#child_bed option[value="' + childBedValue + '"]').length === 0) {
                  $('#child_bed').append(new Option(childBedValue, childBedValue));
                }
                $('#child_bed').val(childBedValue);
              }

              // Check if price array exists and is non-empty
              if (response.price && response.price.length > 0) {
                $.each(response.price, function(index, item) {
                  // Construct the table row with the data
                  var row = `
                <tr id="${item.category_id}">
                    <td class="center">${index + 1}</td>
                    <td class="center">${item.from_date.split('-').reverse().join('-') || '-'}</td>
                    <td class="center">${item.to_date.split('-').reverse().join('-') || '-'}</td>
                    <td class="center">${item.max_accomodation || '-'}</td>
                    <td class="center">${item.number_adults || '-'}</td>
                    <td class="center">${item.number_childs || '-'}</td>
                    <td class="center" data-update-id-adult-count-1="${item.update_id_adult_person_count_1}" id="price_with_breakfast_adult_person_count_1">${item.price_with_breakfast_adult_person_count_1 ? item.price_with_breakfast_adult_person_count_1 : '-'}</td>
                    <td class="center" data-update-id-adult-count-2="${item.update_id_adult_person_count_2}" id="price_with_breakfast_adult_person_count_2">${item.price_with_breakfast_adult_person_count_2 ? item.price_with_breakfast_adult_person_count_2 : '-'}</td>
                    <td class="center" data-update-id-adult-count-3="${item.update_id_adult_person_count_3}" id="price_with_breakfast_adult_person_count_3">${item.price_with_breakfast_adult_person_count_3 ? item.price_with_breakfast_adult_person_count_3 : '-'}</td>
                    <td class="center" data-update-id-adult-count-4="${item.update_id_adult_person_count_4}" id="price_with_breakfast_adult_person_count_4">${item.price_with_breakfast_adult_person_count_4 ? item.price_with_breakfast_adult_person_count_4 : '-'}</td>
                    <td class="center" data-update-id-child-count-1="${item.update_id_child_person_count_1}" id="price_with_breakfast_child_person_count_1">${item.price_with_breakfast_child_person_count_1 ? item.price_with_breakfast_child_person_count_1 : '-'}</td>
                    <td class="center">
                        <a class="btn btn-tbl-edit btn-xs btn_edit_price" data-from_date="${item.from_date}" data-to_date="${item.to_date}" data-single="${item.price_with_breakfast_adult_person_count_1}" data-single_child="${item.price_with_breakfast_child_person_count_1}" data-double="${item.price_with_breakfast_adult_person_count_2}" 
                        data-triple="${item.price_with_breakfast_adult_person_count_3}" data-four="${item.price_with_breakfast_adult_person_count_4}" data-category_id="${item.category_id}">
                            <i class="fa fa-edit"></i>
                        </a>
                    </td>
                </tr>`;
                  tableBody.append(row); // Append the constructed row to the table
                });
              }
            },
            error: function() {
            }
          });
        }
      });

      // document.addEventListener("DOMContentLoaded", function() {
      //   // Get references to input fields
      //   const maxAccomodation = document.getElementById("max_accomodation");
      //   const adultNumber = document.getElementById("adult_number");
      //   const childNumber = document.getElementById("child_number");

      //   function updateMaxAccomodation() {
      //     // Get values of adults and children, default to 0 if empty
      //     let adults = parseInt(adultNumber.value) || 0;
      //     let children = parseInt(childNumber.value) || 0;

      //     // Limit values: max 4 adults and 1 child or 1 adult and 4 children
      //     if (adults + children > 5) {
      //       if (adults > 4) adults = 4;
      //       if (children > 1) children = 1;
      //       if (adults + children > 5) children = 5 - adults;
      //     }

      //     // Update input fields with restricted values
      //     adultNumber.value = adults;
      //     childNumber.value = children;

      //     // Set max accommodation
      //     maxAccomodation.value = adults + children;
      //   }

      //   // Add event listeners to adult and child number inputs
      //   adultNumber.addEventListener("input", updateMaxAccomodation);
      //   childNumber.addEventListener("input", updateMaxAccomodation);

      //   // Initialize the values on page load
      //   updateMaxAccomodation();
      // });
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
          if (adultPriceContainer) {
            adultPriceContainer.innerHTML = ""; // Clear existing fields

            for (let i = 2; i <= count; i++) {
              const wrapper = document.createElement("div");
              wrapper.classList.add("col-lg-12", "p-t-20");

              const field = document.createElement("div");
              field.classList.add("mdl-textfield", "mdl-js-textfield", "mdl-textfield--floating-label", "txt-full-width");

              let label =
                i === 2 ?
                "Double Occupancy Price" :
                i === 3 ?
                "Triple Occupancy Price" :
                "Four Occupancy Price";

              field.innerHTML = `
              <input type="text" name="adultprice_with_breakfast[]" class="mdl-textfield__input" placeholder="Price" required>
              <label class="mdl-textfield__label">${label} (<?= $currency ?>)</label>
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

        // Initialize fields based on current values
        function initializeFields() {
          const initialAdultValue = parseInt(adultNumber.value) || 0;
          const initialChildValue = parseInt(childNumber.value) || 0;

          adultNumber.value = initialAdultValue;
          childNumber.value = initialChildValue;

          updateMaxAccomodation();
        }

        // Trigger initialization on load
        initializeFields();

        if (childPriceContainer && childBedSelect) {
          childPriceContainer.style.display = childBedSelect.value === "CWB" ? "block" : "none";
        }
      });

      $(document).on('click', '.close', function(e) {
            location.reload();
        });
    </script>
</body>

</html>