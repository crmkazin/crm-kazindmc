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
              <h4 class="text-themecolor">Add / Edit Hotel Room Category</h4>
            </div>
            <div class="col-lg-2 only-for-dashbord">
            </div>
            <div class="col-lg-7 col-sm-6 col-6 align-self-center text-end">
              <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb justify-content-end">
                  <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Home</a></li>  
                  <li class="breadcrumb-item"><a href="<?php echo base_url('all-hotel'); ?>">Hotel List</a></li>  
                  <li class="breadcrumb-item active">Add Category</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <div class="page-content">
          <?php echo $this->session->flashdata('message');
          unset($_SESSION['message']); ?>
          <div class="row">
            <div class="col-md-12">
              <div class="card card-box">
                <div class="card-head">
                  <header>All Room Categories : <?php echo $categories[0]->name; ?></header>
                  <div class="tools">
                    <a href="" class="add-category-cost btn btn-info" data-toggle="modal" data-target="#modalAddCategory" data-hotel_id="<?= base64_encode($categories[0]->hotel_id) ?>" class="btn btn-info" style="padding:6px;" id="add-category"><i class="fa fa-plus"></i>
                      Add Category</a>
                    <?php
                    $allowed_users = ['13', '8', '33', '14', '51'];
                    if (in_array($this->session->userdata('id'), $allowed_users)) { ?>
                      <a href="#" data-toggle="modal" data-target="#modalAdd" class="btn  btn-info" style="padding:6px;">Import CSV</a>
                      <a href="hotel-pricing-download?hotel_id=<?= $this->input->get('hotel_id'); ?>" class="btn  btn-info" style="padding:6px;"><i class="fa fa-download"></i></a>
                    <?php } ?>
                    <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                  </div>
                </div>
                <div class="card-body">
                  <div class="table-scrollable">
                    <table class="table table-hover table-checkable order-column full-width" id="room_category">
                      <thead>
                        <tr>
                          <th class="center">Sr.No</th>
                          <th class="center">Category Name</th>
                          <th class="center">Room Size</th>
                          <th class="center">Max Accomodation</th>
                          <th class="center">Number Of Adults</th>
                          <th class="center">Number Of Childs</th>
                          <th class="center">Child Bed Option</th>
                          <th class="center">Image & Description</th>
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
                              <?php
                                  // Fetch all child types for this category_id and hotel_id
                                  $this->db->select('child_type1, child_type2, child_type3, child_type4');
                                  $this->db->from('room_category_costing');
                                  $this->db->where('category_id', $list->id);
                                  $this->db->where('hotel_id', $list->hotel_id);
                                  $childRows = $this->db->get()->result();

                                  $hasCWB = false;
                                  $hasCNB = false;

                                  foreach ($childRows as $row) {
                                      $types = [
                                          strtoupper($row->child_type1),
                                          strtoupper($row->child_type2),
                                          strtoupper($row->child_type3),
                                          strtoupper($row->child_type4)
                                      ];
                                      if (in_array('CWB', $types)) {
                                          $hasCWB = true;
                                      }
                                      if (in_array('CNB', $types)) {
                                          $hasCNB = true;
                                      }
                                  }

                                  if ($hasCWB) {
                                      echo 'CWB';
                                  } elseif ($hasCNB) {
                                      echo 'CNB';
                                  } else {
                                      echo '-';
                                  }
                              ?>
                              </td>
                              <td class="center">
                                <?php
                                $hasImage = !empty($list->category_image);
                                $hasDescription = !empty($list->category_description);
                                $hasData = $hasImage || $hasDescription;
                                ?>
                                
                                <!-- Add/Edit Button -->
                                <button class="btn btn-primary btn-xs manage-category-media" 
                                        data-category-id="<?= $list->id ?>" 
                                        data-category-name="<?= htmlspecialchars($list->category_name) ?>"
                                        data-existing-image="<?= $list->category_image ?>"
                                        data-existing-description="<?= htmlspecialchars($list->category_description) ?>"
                                        title="<?= $hasData ? 'Edit Category Media' : 'Add Category Media' ?>">
                                    <i class="fa <?= $hasData ? 'fa-edit' : 'fa-plus' ?>"></i> 
                                    <?= $hasData ? 'Edit ' : 'Add ' ?>
                                </button>
                                
                                <!-- View Button (only show if data exists) -->
                                <?php if ($hasData): ?>
                                <button class="btn btn-info btn-xs view-category-media" 
                                        data-category-id="<?= $list->id ?>"
                                        data-category-name="<?= htmlspecialchars($list->category_name) ?>"
                                        data-existing-image="<?= $list->category_image ?>"
                                        data-existing-description="<?= htmlspecialchars($list->category_description) ?>"
                                        title="View Category Media">
                                    <i class="fa fa-eye"></i> View
                                </button>
                                <?php endif; ?>
                            </td>



                              <!--td style="text-align:center;"><a
                                  href="<?php //echo base_url('room-category-cost?hotel_id=' . $this->input->get('hotel_id') . '&category_id=' . base64_encode($list->id)); 
                                        ?>"
                                  class="" title="Cost List"><i class="fa fa-money" aria-hidden="true"></i></a></td-->
                              <!-- <td class="center"> -->
                                <?php //if ($list->status === 'active' && $list->price_with_breakfast <> '' && $list->price_with_breakfast > 0) {
                                  // $btn = 'color:#49d701;';
                                  // $status = 'Active';
                                // } else if ($list->status === 'active' && ($list->price_with_breakfast == '' || $list->price_with_breakfast == 0)) {
                                  // $btn = 'color:#ffa500;';
                                  // $status = 'Active - No Prices';
                                // } else if ($list->status === 'inactive') {
                                  // $btn = 'color:#ff1a02;';
                                  // $status = 'In-Active';
                                // }
                                ?>
                                <!-- <span style="<?php //echo $btn ?>"><?php //echo $status ?></span> -->
                                <?php //echo ($list->status === 'active') ? '<a class="btn btn-success btn-xs">' . ucfirst($list->status) . '</a>' : '<a class="btn btn-warning btn-xs">' . ucfirst($list->status) . '</a>';
                                ?>
                              <!-- </td> -->

                              <td class="center">
                                <?php
                                // Fetch all price rows for the current category_id and hotel_id
                                // $this->db->select('price_with_breakfast,weekDays_adult_price,weekend_adult_price');
                                // $this->db->from('room_category_costing');
                                // $this->db->where('category_id', $list->id);
                                // $this->db->where('hotel_id', $list->hotel_id);
                                // $prices = $this->db->get()->result();

                                // $hasValidPrice = false;
                                // foreach ($prices as $p) {
                                //     if ((float)$p->price_with_breakfast > 0) {
                                //         $hasValidPrice = true;
                                //         break;
                                //     }
                                // }
                                
                                // foreach ($prices as $p) {
                                //     if ((float)$p->weekend_adult_price > 0) {
                                //         $hasValidPrice = true;
                                //         break;
                                //     }
                                // }

                                // foreach ($prices as $p) {
                                //     if ((float)$p->weekDays_adult_price > 0) {
                                //         $hasValidPrice = true;
                                //         break;
                                //     }
                                // }

                                // Set status
                                if ($list->status === 'inactive') {
                                    $btn = 'color:#ff1a02;';
                                    $status = 'In-Active';
                                } elseif ($list->status === 'active') {
                                    $btn = 'color:#49d701;';
                                    $status = 'Active';
                                }
                                ?>
                                <span style="<?= $btn ?>"><?= $status ?></span>
                            </td>

                              <td class="center">
                                <button class="btn btn-primary btn-xs room_category_info"
                                    data-category-id="<?= $list->id ?>"
                                    data-category-name="<?= htmlspecialchars($list->category_name) ?>"
                                    data-room-size="<?= $list->room_size ?>"
                                    data-max-accom="<?= $list->max_accomodation ?>"
                                    data-adults="<?= $list->number_adults ?>"
                                    data-childs="<?= $list->number_childs ?>"
                                    data-status="<?= $list->status ?>">
                                    Edit
                                </button>
                                
                                <a href="#" class="add-category-cost category-edit" data-adults="<?= $list->number_adults ?>" data-childs="<?= $list->number_childs ?>" data-max-accommodation="<?= $list->max_accomodation ?>" data-edit="true" data-toggle="modal" data-target="#modalAddCategory" data-hotel_id="<?= base64_encode($list->hotel_id) ?>" data-category_name="<?php echo ucwords(strtolower($list->category_name)); ?>" data-room_size="<?= $list->room_size ?>" data-category_id="<?= base64_encode($list->id); ?>" title="Edit" class="btn btn-tbl-edit btn-xs">
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

                    <!-- <div class="row m-b-10">
                      <div class="col-md-4">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width is-focused">
                            <select name="Special_days" class="mdl-textfield__input" style="padding-top:13px;">
                                <option value="">Select..</option>
                                <option value="sd">Special days</option>
                                <option value="weekends">Weekends</option>
                                <option value="general">General</option>
                            </select>
                            <label class="mdl-textfield__label">Special Days</label>
                        </div>
                      </div>
                    </div> -->
                    <span id="errorMessage"></span>
                    <div class="col-lg-3 p-t-20">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width is-focused">
                        <label class="mdl-textfield__label">Date from</label>
                        <?php echo form_input(['type' => 'date', 'name' => 'from_date', 'id' => 'from_date', 'class' => 'date_from mdl-textfield__input dt-search', 'required' => 'required', 'data-group' => 'checkin']); ?>
                        <input type="hidden" name="old_from_date" id="old_from_date" value="">
                        <?php echo form_error('from_date'); ?>
                      </div>
                    </div>

                    <div class="col-lg-3 p-t-20">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width is-focused">
                        <label class="mdl-textfield__label">Date to</label>
                        <?php echo form_input(['type' => 'date', 'name' => 'to_date', 'id' => 'to_date', 'class' => 'date_to mdl-textfield__input dt-search', 'required' => 'required', 'data-group' => 'checkin']); ?>
                        <input type="hidden" name="old_to_date" id="old_to_date" value="">
                        <?php echo form_error('to_date'); ?>
                      </div>
                    </div>

                    <div class="col-lg-3 p-t-20">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <label class="mdl-textfield__label">Category Name</label>
                        <?php echo form_input(['name' => 'category_name', 'id' => 'category_name', 'class' => 'mdl-textfield__input', 'required' => 'required']); ?>
                        <?php echo form_error('category_name'); ?>
                      </div>
                    </div>

                    <div class="col-lg-3 p-t-20">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <label class="mdl-textfield__label">Room Size</label>
                        <?php echo form_input(['name' => 'room_size', 'id' => 'room_size', 'class' => 'mdl-textfield__input']); ?>
                      </div>
                    </div>

                    <div class="col-lg-3 p-t-20">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <label class="mdl-textfield__label">Max Accomodation</label>
                        <?php echo form_input(['type' => 'text', 'min' => '0', 'name' => 'max_accomodation', 'id' => 'max_accomodation', 'required' => 'required', 'class' => 'mdl-textfield__input']) ?>
                      </div>
                    </div>

                    <div class="col-lg-3 p-t-20">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <label class="mdl-textfield__label">Number Of Adults</label>
                        <?php echo form_input(['type' => 'text', 'min' => '0', 'name' => 'adult_number', 'id' => 'adult_number', 'required' => 'required', 'class' => 'mdl-textfield__input']) ?>
                      </div>
                    </div>
                 
                    <div class="col-lg-3 p-t-20">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                          <label class="mdl-textfield__label">Number Of Child</label>
                            <input type="number" min="0" name="child_number" id="child_number" pattern="^[1-4]{1}$" required class="mdl-textfield__input">
                        </div>
                    </div>

                     <div class="col-lg-3 p-t-20">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                          <label class="mdl-textfield__label">Free Breakfast (Age)</label>
                            <input type="text" name="freebreakfast" id="freebreakfast" required class="mdl-textfield__input" value="">
                        </div>
                    </div>
                     <span id="room_accommodationss" class=""></span>
                    <span id="room_accommodation" class="text-danger"></span>
                    <!-- Container for generated child fields -->
                    
                    <?php $weekendPriceChk = isset($hotel_weekend[0]['status']) && $hotel_weekend[0]['status'] === '1'; ?>
                      <script>
                        var weekendPriceChk = <?php echo $weekendPriceChk ? 'true' : 'false'; ?>;
                      </script>

                   
                    <div id="child_fields_container" class="col-lg-12 p-t-20"></div>
        
                    <?php
                        $currency = $currency[0]->currency_name ?? '';
                    ?>
                     <?php if(!$weekendPriceChk):
                         $required = $weekendPriceChk ? '' : 'required';
                    ?>
                    <div class="col-lg-4 p-t-20" id="adultprice_with_breakfasts">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                            <label class="mdl-textfield__label adult_label_name">Single Occupancy Price (<?= $currency ?>)</label>
                            <?php echo form_input(['type' => 'text', 'name' => 'adultprice_with_breakfast[]', 'id' => 'adultprice_with_breakfast', 'placeholder' => 'Price', 'class' => 'mdl-textfield__input', 'value' => '', 'required' => $required]) ?>
                        </div>
                    </div>
                    <?php endif; ?>
                    
                    <?php if($weekendPriceChk): ?>
                    <div class="col-lg-4 p-t-20">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                          <label class="mdl-textfield__label">WeekEnd Price</label>
                            <input type="text" name="weekend_adult_price[]" id="weekend_price" required class="mdl-textfield__input" value="">
                        </div>
                    </div>

                    <div class="col-lg-4 p-t-20">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                          <label class="mdl-textfield__label">WeekDays Price</label>
                            <input type="text" name="weekdays_adult_price[]" id="weekdays_price" required class="mdl-textfield__input" value="">
                        </div>
                    </div>
                    <?php endif; ?>

                    <div id="childPriceContainer" class="col-lg-6 p-t-20" style="display: none;">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <label class="mdl-textfield__label child_label_name">Child Occupancy Price (<?= $currency ?>)</label>
                        <?php echo form_input(['type' => 'text', 'name' => 'childprice_with_breakfast[]', 'id' => 'childprice_with_breakfast', 'placeholder' => 'Price', 'class' => 'mdl-textfield__input', 'value' => '']) ?>
                        <?php echo form_error('childprice_with_breakfast'); ?>
                      </div>
                    </div>
                    <input type="hidden" id="editingCategoryId" value="">
                    <input type="hidden" id="editingRowId" value="">
                    <input type="hidden" id="editingRowFromDate" name="editingRowFromDate">
                    <input type="hidden" id="editingRowToDate" name="editingRowToDate">

                    <div id="adultPriceContainer" class="col-lg-12">
                   </div>
                  </div>
                  <div class="row" id="child_container">

                  </div>
                  <div class="col-lg-12 p-t-20 text-center">
                    <?php echo form_submit(['name' => 'submit', 'id' => 'submit', 'class' => 'submit mdl-button mdl-js-button mdl-js-ripple-effect m-b-10 m-r-20', 'value' => 'ADD']); ?>
                  </div>
                </form>
              </div>

              <div class="row">
                <div class="col-md-12">
                  <div class="table-scrollable">
                    <table class="table table-hover table-checkable order-column full-width" id="hotel_room_category">
                      <thead>
                        <tr>
                          <th class="center">Sr.No</th>
                          <th class="center">Date From</th>
                          <th class="center">Date to</th>
                          <th class="center">Max Accomodation</th>
                          <th class="center">Adult</th>
                          <th class="center">Child</th>
                          <th class="center">FBA</th>
                          <th class="center">Single</th>
                          <th class="center">Double</th>
                          <th class="center">Triple</th>
                          <th class="center">Four</th>
                          <th class="center">Five</th>
                          <th class="center">Six</th>
                          <th class="center">Single Weekend price</th>
                          <th class="center">Single Weekdays price</th>
                          <th class="center">Double Weekend price</th>
                          <th class="center">Double Weekdays price</th>
                          <th class="center">Triple Weekend price</th>
                          <th class="center">Triple Weekdays price</th>
                          <th class="center">Four Weekend price</th>
                          <th class="center">Four Weekdays price</th>
                          <th class="center">Five Weekend price</th>
                          <th class="center">Five Weekdays price</th>
                          <th class="center">Six Weekend price</th>
                          <th class="center">Six Weekdays price</th>
                          <th class="center">Child1 Type</th>
                          <th class="center">Child1 From</th>
                          <th class="center">Child1 TO</th>
                          <th class="center">Child1 Price</th>
                          <th class="center">Child1 Weekend Price</th>
                          <th class="center">Child1 Weekdays Price</th>
                          <th class="center">Child2 Type</th>
                          <th class="center">Child2 From</th>
                          <th class="center">Child2 TO</th>
                          <th class="center">Child2 Price</th>
                          <th class="center">Child2 Weekend Price</th>
                          <th class="center">Child2 Weekdays Price</th>
                          <th class="center">Child3 Type</th>
                          <th class="center">Child3 From</th>
                          <th class="center">Child3 TO</th>
                          <th class="center">Child3 Price</th>
                          <th class="center">Child3 Weekend Price</th>
                          <th class="center">Child3 Weekdays Price</th>
                          <th class="center">CNB Child</th>
                          <th class="center">CNB Child From</th>
                          <th class="center">CNB Child TO</th>
                          <th class="center">CNB Child Price</th>
                          <th class="center">Child4 Weekend Price</th>
                          <th class="center">Child4 Weekdays Price</th>
                          <th class="center">Action</th>
                          <th></th>
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
  </div>
</div>
  <!-- </div> -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Category Media Modal -->
<div class="modal fade" id="categoryMediaModal" tabindex="-1" role="dialog" aria-labelledby="categoryMediaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="categoryMediaModalLabel">Manage Category Media</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="categoryMediaForm" enctype="multipart/form-data">
                    <input type="hidden" name="category_id" id="modal_category_id">
                    
                    <div class="form-group">
                        <label for="category_image">Category Image</label>
                        <input type="file" class="form-control" id="category_image" name="category_image" accept="image/*">
                        <small class="form-text text-muted">Recommended size: 500x300px</small>
                        <div id="image_preview" class="mt-2"></div>
                    </div>
                    
                    <div class="form-group">
                        <label for="category_description">Category Description</label>
                        <textarea class="form-control" id="category_description" name="category_description" rows="4" placeholder="Enter category description..."></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveCategoryMedia">Save Changes</button>
            </div>
        </div>
    </div>
</div>

<!-- View Category Media Modal -->
<div class="modal fade" id="viewCategoryMediaModal" tabindex="-1" role="dialog" aria-labelledby="viewCategoryMediaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewCategoryMediaModalLabel">View Category Media</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="media_content">
                    <!-- Content will be loaded here -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Room Category Modal -->
<div class="modal fade" id="editRoomCategoryModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Edit Room Category</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body">
        <form id="updateRoomCategoryForm">

          <input type="hidden" name="id" class="category_id" id="category_id">

        <div class="row">
          <div class="col-md-12 form-group">
            <label><b>Category Name</b></label>
            <input type="text" name="category_name" id="category_name" class="category_name form-control" required >
          </div>

          <div class="col-md-6 form-group">
            <label><b>Room Size</b></label>
            <input type="text" name="room_size" id="room_size" class="room_size form-control">
          </div>

          <div class="col-md-6 form-group">
            <label><b>Max Accommodation</b></label>
            <input type="number" name="max_accomodation" id="max_accomodation" class="max_accomodation form-control">
          </div>

          <div class="col-md-6 form-group">
            <label><b>Adults</b></label>
            <input type="number" name="number_adults" id="number_adults" class="number_adults form-control">
          </div>

          <div class="col-md-6 form-group">
            <label><b>Childs</b></label>
            <input type="number" name="number_childs" id="number_childs" class="number_childs form-control">
          </div>

          <div class="col-md-6 form-group">
            <label><b>Status</b></label>
            <select name="status" id="status" class="status form-control">
              <option value="active">Active</option>
              <option value="inactive">Inactive</option>
            </select>
          </div>
        </div>  

        </form>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-success" id="updateRoomCategoryBtn">
          Update
        </button>
      </div>

    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- edit room category js -->
<script>
  $(document).on('click', '.room_category_info', function () {

      $('.category_id').val($(this).data('category-id'));
      $('.category_name').val($(this).data('category-name'));
      $('.room_size').val($(this).data('room-size'));
      $('.max_accomodation').val($(this).data('max-accom'));
      $('.number_adults').val($(this).data('adults'));
      $('.number_childs').val($(this).data('childs'));
      $('.status').val($(this).data('status'));

      $('#editRoomCategoryModal').modal('show');
  });

  $('#updateRoomCategoryBtn').on('click', function () {
      $.ajax({
          url: "<?= base_url('admin/hotel/update_category') ?>",
          type: "POST",
          data: $('#updateRoomCategoryForm').serialize(),
          dataType: "json",
          success: function (res) {
              if (res.status === 'success') {
                  alert('Updated successfully');
                   location.reload();
              } else {
                  alert(res.message);
              }
          }
      });
  });
</script>
<!-- Added script for add category image and description start here -->
<script>
    $(document).ready(function() {
    // Handle Add/Edit Category Media
    $('.manage-category-media').click(function() {
        var categoryId = $(this).data('category-id');
        var categoryName = $(this).data('category-name');
        var existingImage = $(this).data('existing-image');
        var existingDescription = $(this).data('existing-description');
        
        $('#modal_category_id').val(categoryId);
        $('#categoryMediaModalLabel').text('Manage Media - ' + categoryName);
        $('#category_description').val(existingDescription);
        
        // Clear and set up image preview
        $('#image_preview').empty();
        if (existingImage) {
            $('#image_preview').html('<img src="<?= base_url() ?>assets/admin/hotel_category/' + existingImage + '" style="max-width: 100%; max-height: 200px;" class="img-thumbnail">');
        }
        
        $('#categoryMediaModal').modal('show');
    });
    
    // Handle View Category Media
    $('.view-category-media').click(function() {
        var categoryId = $(this).data('category-id');
        var categoryName = $(this).data('category-name');
        var existingImage = $(this).data('existing-image');
        var existingDescription = $(this).data('existing-description');
        
        $('#viewCategoryMediaModalLabel').text('View Media - ' + categoryName);
        
        var content = '';
        if (existingImage) {
            content += '<div class="text-center mb-3">';
            content += '<img src="<?= base_url() ?>assets/admin/hotel_category/' + existingImage + '" style="max-width: 100%; max-height: 300px;" class="img-thumbnail">';
            content += '</div>';
        }
        
        if (existingDescription) {
            content += '<div class="form-group">';
            content += '<label><strong>Description:</strong></label>';
            content += '<label>' + existingDescription + '</label>';
            content += '</div>';
        }
        
        if (!existingImage && !existingDescription) {
            content = '<p class="text-center">No media available for this category.</p>';
        }
        
        $('#media_content').html(content);
        $('#viewCategoryMediaModal').modal('show');
    });
    
    // Handle image preview
    $('#category_image').change(function() {
        var file = this.files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#image_preview').html('<img src="' + e.target.result + '" style="max-width: 100%; max-height: 200px;" class="img-thumbnail">');
            }
            reader.readAsDataURL(file);
        }
    });
    
    // Save category media
    $('#saveCategoryMedia').click(function() {
        var formData = new FormData($('#categoryMediaForm')[0]);
        
        $.ajax({
            url: '<?= base_url("admin/hotel/save_category_media") ?>',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                var result = JSON.parse(response);
                if (result.success) {
                    alert('Category media saved successfully!');
                    $('#categoryMediaModal').modal('hide');
                    location.reload();
                } else {
                    alert('Error saving category media: ' + result.message);
                }
            },
            error: function() {
                alert('Error saving category media. Please try again.');
            }
        });
    });
});
</script>
<!--updated js start from here-->
<script>
  $(document).ready(function () {
    // start code for validate input field when new category will be created
    const requiredFields = [
      '#from_date',
      '#to_date',
      '#category_name',
      '#room_size',
      '#max_accomodation',
      '#adult_number',
      '#child_number',
    ];

    // Add conditionally
    if (!weekendPriceChk) {
        requiredFields.push('#adultprice_with_breakfast');
    }

    // Validate when modal opens
    $('#modalAddCategory').on('shown.bs.modal', function () {
        const isEditing = $('#editingCategoryId').val() !== '';
        let rowCount = $('#hotel_room_category tbody.room-category-prices tr').length;
        if (rowCount == 0) {
          validateFormInputs();
        }

      // Validate on input/change if editing
      if (rowCount == 0) {
        $(document).off('input change.validate') // Prevent multiple bindings
          .on('input.validate change.validate', requiredFields.join(','), function () {
            validateFormInputs();
            console.log(rowCount, 'rowCount');
          });
      }
    });

    function validateFormInputs() {
      let isValid = true;
        for (let i = 0; i < requiredFields.length; i++) {
            let $field = $(requiredFields[i]);
            if (!$field.length) {
            console.warn('Missing field:', requiredFields[i]);
            isValid = false;
            break;
            }

            let val = $.trim($field.val());

            if (val === '') {
            isValid = false;
            break;
            }
       }

      // Enable or disable submit button(s)
      $('#modalAddCategory').find('input[type="submit"], input[type="submit"]').prop('disabled', !isValid);

      console.log('Submit button disabled:', !isValid);
    }
    // End code for validate input field when new category will be created
  });

  $(document).ready(function () {
    // Start code here for validation input field of max accommodation and others
    let isEditMode = false;
    $('#modalAddCategory').on('shown.bs.modal', function () {
        var rowCount = $('#hotel_room_category tbody.room-category-prices tr').length;
    
        if (rowCount > 1) {
            $('#max_accomodation, #adult_number, #child_number, #room_size, #category_name').each(function () {
                var $input = $(this);
                var id = $input.attr('id');
                var val = $input.val().trim();
    
                // If adult_number or child_number is empty or 0, make editable
                if ((id === 'adult_number' || id === 'child_number') && (val === '' || val === '0')) {
                    $input.removeAttr('readonly');
                } else {
                    $input.attr('readonly', true);
                }
            });
        }
    });


    // start code from here for append child type catgory fields
    const container = $('#child_fields_container');
    const adultPriceContainer = document.getElementById("adultPriceContainer");

    $('.category-edit').on('click', function () {
        const childCount = parseInt($(this).data('childs')) || 0;
        const adultCount = parseInt($(this).data('adults')) || 0;
        console.log(adultCount,'adultCount');
        // Clear previous child fields
        container.empty();
        // Add child rows
        for (let i = 1; i <= childCount; i++) {
            container.append(createChildRow(i));
        }

        generateAdultPriceFields(adultCount);
    });

    function createChildRow(i, prefill = '', isCNBExtra = false) {
      if (isCNBExtra) {
        return `
          <div class="row m-b-10 child-row ss2" data-index="${i}">
            <div class="${weekendPriceChk ? `col-md-2` : `col-md-4`}">
              <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                <label class="mdl-textfield__label">CNB Child</label>
                <input type="text" name="child_bed4" class="mdl-textfield__input" value="CNB" readonly />
              </div>
            </div>
            <div class="col-md-4">
              <div class="row">
                <div class="col-6">
                  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                    <label class="mdl-textfield__label">Age From</label>
                    <input type="number" name="child_age_from4" class="mdl-textfield__input child-age-range" min="0" max="17" placeholder="From Age" />
                  </div>
                </div>
                <div class="col-6">
                  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                    <label class="mdl-textfield__label">Age To</label>
                    <input type="number" name="child_age_to4" class="mdl-textfield__input child-age-range" min="0" max="17" placeholder="To Age" />
                  </div>
                </div>
              </div>
            </div>
            <div class="${weekendPriceChk ? `col-md-2` : `col-md-4`}" ${weekendPriceChk ? `style="display:none"` : ``}>
              <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                <label class="mdl-textfield__label">Child Price</label>
                <input type="number" name="childprice_with_breakfast4" class="mdl-textfield__input" min="0" placeholder="Enter price" />
              </div>
            </div>
            ${weekendPriceChk ? `
            <div class="col-md-2">
              <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                <label class="mdl-textfield__label">WeekEnd Price</label>
                <input type="number" name="child_weekend_price_4" class="weekend_price mdl-textfield__input" min="0" placeholder="Enter price" />
              </div>
            </div>
            <div class="col-md-2">
              <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                <label class="mdl-textfield__label">WeekDays Price</label>
                <input type="number" name="child_weekdays_price_4" class="weekend_price mdl-textfield__input" min="0" placeholder="Enter price" />
              </div>
            </div>
            ` : ''}
          </div>
        `;
      }
      return `
        <div class="row m-b-10 child-row ss3" data-index="${i}">
          <div class="${weekendPriceChk ? `col-md-2` : `col-md-4`}">
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width is-focused">
              <label class="mdl-textfield__label">Child ${i} Bed</label>
              <select name="child_bed${i}" class="mdl-textfield__input child-bed-select" style="padding-top:13px;">
                <option value="">Select..</option>
                <option value="CWB" ${prefill === 'CWB' ? 'selected' : ''}>Child With Bed</option>
                <option value="CNB" ${prefill === 'CNB' ? 'selected' : ''}>Child No Bed</option>
              </select>
            </div>
          </div>
          <div class="col-md-4">
            <div class="row">
              <div class="col-6">
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                  <label class="mdl-textfield__label">Age From</label>
                  <input type="number" name="child_age_from${i}" class="mdl-textfield__input child-age-range" min="0" max="17" placeholder="From Age" />
                </div>
              </div>
              <div class="col-6">
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                  <label class="mdl-textfield__label">Age To</label>
                  <input type="number" name="child_age_to${i}" class="mdl-textfield__input child-age-range" min="0" max="17" placeholder="To Age" />
                </div>
              </div>
            </div>
          </div>
          <div class="${weekendPriceChk ? `col-md-2` : `col-md-4`}" ${weekendPriceChk ? `style="display:none"` : ``}>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
              <label class="mdl-textfield__label">Child ${i} Price</label>
              <input type="number" name="childprice_with_breakfast${i}" class="mdl-textfield__input" min="0" placeholder="Enter price" />
            </div>
          </div>
          ${weekendPriceChk ? `
          <div class="col-md-2">
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
              <label class="mdl-textfield__label">WeekEnd Price</label>
              <input type="number" name="child_weekend_price_${i}" class="weekend_price mdl-textfield__input" min="0" placeholder="Enter price" />
            </div>
          </div>
          <div class="col-md-2">
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
              <label class="mdl-textfield__label">WeekDays Price</label>
              <input type="number" name="child_weekdays_price_${i}" class="weekdays_price mdl-textfield__input" min="0" placeholder="Enter price" />
            </div>
          </div>
          ` : ''}
        </div>
      `;
    }

    function generateAdultPriceFields(count) {
      if (adultPriceContainer) {
        adultPriceContainer.innerHTML = "";
        for (let i = 2; i <= count; i++) {
          const wrapper = document.createElement("div");
          wrapper.classList.add("row");
          wrapper.style.marginBottom = "15px";
          let label =
            i === 2 ? "Double Occupancy" :
            i === 3 ? "Triple Occupancy" :
            i === 4 ? "Four Occupancy" :
            i === 5 ? "Five Occupancy" :
            "Six Occupancy";
          const fieldOccupancy = document.createElement("div");
          fieldOccupancy.classList.add("col-lg-4", "p-t-20");
          // hide/show col-lg-4
          if (weekendPriceChk) {
            fieldOccupancy.style.display = "none";
          }
          fieldOccupancy.innerHTML = `
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width" ${weekendPriceChk ? `style="display:none"` : ``}>
              <label class="mdl-textfield__label">${label} Price (<?= $currency ?>)</label>
              <input type="text" name="adultprice_with_breakfast[]" class="breakfast_price mdl-textfield__input" placeholder="Price">
            </div>
          `;
          wrapper.appendChild(fieldOccupancy);
          if (weekendPriceChk) {
            const fieldWeekend = document.createElement("div");
            fieldWeekend.classList.add("col-lg-4", "p-t-20");
            fieldWeekend.innerHTML = `
              <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                <label class="mdl-textfield__label">${label} Weekend Price (<?= $currency ?>)</label>
                <input type="text" name="weekend_adult_price[]" class="mdl-textfield__input" placeholder="Weekend Price">
              </div>
            `;
            wrapper.appendChild(fieldWeekend);
            const fieldWeekdays = document.createElement("div");
            fieldWeekdays.classList.add("col-lg-4", "p-t-20");
            fieldWeekdays.innerHTML = `
              <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                <label class="mdl-textfield__label">${label} Weekdays Price (<?= $currency ?>)</label>
                <input type="text" name="weekdays_adult_price[]" class="mdl-textfield__input" placeholder="Weekdays Price">
              </div>
            `;
            wrapper.appendChild(fieldWeekdays);
          }
          adultPriceContainer.appendChild(wrapper);
        }
      }
    }

    $('#child_number').on('input', function () {
      let value = $(this).val().replace(/\D/g, '');
      value = value ? parseInt(value) : '';

      if (value > 4) value = 4;
      if (value < 0 && value !== '') value = 0;
      $(this).val(value);

      // --- Preserve previous child data ---
      let childData = {};
      container.find('.child-row').each(function () {
        let idx = $(this).data('index');
        childData[idx] = {
          bed: $(this).find('[name="child_bed'+idx+'"]').val(),
          age_from: $(this).find('[name="child_age_from'+idx+'"]').val(),
          age_to: $(this).find('[name="child_age_to'+idx+'"]').val(),
          price: $(this).find('[name="childprice_with_breakfast'+idx+'"]').val(),
          weekend: $(this).find('[name="child_weekend_price_'+idx+'"]').val(),
          weekdays: $(this).find('[name="child_weekdays_price_'+idx+'"]').val()
        };
      });

      container.empty();
      for (let i = 1; i <= value; i++) {
        let prefill = childData[i] ? childData[i].bed : '';
        let row = $(createChildRow(i, prefill));
        // Restore previous values if available
        if (childData[i]) {
          row.find('[name="child_age_from'+i+'"]').val(childData[i].age_from);
          row.find('[name="child_age_to'+i+'"]').val(childData[i].age_to);
          row.find('[name="childprice_with_breakfast'+i+'"]').val(childData[i].price);
          row.find('[name="child_weekend_price_'+i+'"]').val(childData[i].weekend);
          row.find('[name="child_weekdays_price_'+i+'"]').val(childData[i].weekdays);
        }
        container.append(row);
      }
    });

    $(document).on('input', '.child-age-range', function () {
        let val = parseInt($(this).val());
        if (val > 17) $(this).val(17);
        else if (val < 0 && val !== '') $(this).val(0);
    });

    $(document).on('change', '.child-bed-select', function () {
        const childCount = parseInt($('#child_number').val());
        const selectedValues = $('.child-bed-select').map(function () {
            return $(this).val();
        }).get();

        const cwbCount = selectedValues.filter(val => val === 'CWB').length;
        const hasCNB = selectedValues.includes('CNB');

        const currentRows = container.find('.child-row').length;
        const extraCNBExists = currentRows > childCount;

        if (childCount >= 1 && childCount <= 3) {
            if (cwbCount === childCount && !hasCNB && !extraCNBExists) {
                container.append(createChildRow(childCount + 1, '', true));
            } else if (hasCNB && extraCNBExists) {
                container.find(`.child-row:gt(${childCount - 1})`).remove();
            }
        }
    });
    // end here of child type category fields
  });
</script>

<script>
  $(document).ready(function () {
      let isEditMode = false;
      // When the edit link is clicked, enable edit mode
      $('.category-edit').on('click', function () {
          const hotelId = $(this).data('hotel_id');
          const categoryId = $(this).data('category_id');

          $('#form_Data').attr('data-hotel_id', hotelId);
          $('#form_Data').attr('data-category_id', categoryId);

          isEditMode = true;
      });

      function checkAvailability() {
          if (!isEditMode) return;

          let hotelId = $('#form_Data').data('hotel_id');
          let categoryId = $('#form_Data').data('category_id');
          let fromDate = $('#from_date').val();
          let toDate = $('#to_date').val();
          let currentRowFrom = $('#editingRowFromDate').val();
          let currentRowTo = $('#editingRowToDate').val();

          $('#errorMessage').html('');
          $('#submit').prop('disabled', true);

          if (!fromDate || !toDate) return;

          let from = new Date(fromDate);
          let to = new Date(toDate);

          if (from > to) {
              $('#errorMessage').html('<p class="text-danger" style="margin:0px !important; padding:0px!important;">From Date cannot be after To Date.</p>');
              return;
          }

          $.ajax({
              url: '<?= base_url() ?>admin/hotel/check_room_category_availability',
              type: 'POST',
              data: {
                  hotel_id: hotelId,
                  category_id: categoryId,
                  from_date: fromDate,
                  to_date: toDate,
                  current_from: currentRowFrom,
                  current_to: currentRowTo
              },
              dataType: 'json',
              success: function(response) {
                  if (response.status === 'error') {
                      $('#errorMessage').html('<p class="text-danger" style="margin:0px !important; padding:0px!important;">' + response.message + '</p>');
                      $('#submit').prop('disabled', true);
                  } else {
                      $('#errorMessage').html('<p class="text-success" style="margin:0px !important; padding:0px!important;">' + response.message + '</p>');
                      $('#submit').prop('disabled', false);
                  }
              },
              error: function() {
                  $('#errorMessage').html('<p class="text-danger">Server error. Please try again later.</p>');
                  $('#submit').prop('disabled', true);
              }
          });
      }

      $('#modalAddCategory').on('shown.bs.modal', function () {
        let intervalId;

        // In edit mode — wait for both values to be available
        setTimeout(() => {
            intervalId = setInterval(function () {
                const currentEditingCategoryId = $('#editingCategoryId').val();
                const currentEditingRowId = $('#editingRowId').val();
                const rowCount = $('#hotel_room_category tbody.room-category-prices tr').length;

                console.log('Category ID:', currentEditingCategoryId);
                console.log('Row ID:', currentEditingRowId);
                console.log('Row rowCount:', rowCount);

                if (currentEditingRowId === '' || rowCount > 1) {
                    console.log('Validation binding allowed');

                    $('#from_date, #to_date').off('change').on('change', function () {
                        checkAvailability();
                    });
                } else {
                    console.log('Validation skipped (edit mode with 1 row)');
                    $('#from_date, #to_date').off('change'); // Ensure it's not bound
                }
            }, 300);
        }, 100);

        // Clean up when modal is closed
        $('#modalAddCategory').on('hidden.bs.modal', function () {
            clearInterval(intervalId);
            $('#from_date, #to_date').off('change');
            $('#errorMessage').html('');
            $('#submit').prop('disabled', false);
        });
      });
  });
</script>

<script>
  $(document).ready(function() {
    $('#room_category').DataTable({
      responsive: true
    });

    $(document).on('click', '.add-category-cost', function(e) {
      e.preventDefault();
      var hotelId = $(this).data('hotel_id');
      var categoryId = $(this).data('category_id');
      get_price(hotelId, categoryId);
      $("#submit").removeAttr("disabled").addClass("btn-pink");  
    });

    function createChildRow(i, prefill = '', isCNBExtra = false) {
     
        if (isCNBExtra) {
            return `
                <div class="row m-b-10 child-row ss1" data-index="${i}">
                    <div class="col-md-4">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                            <label class="mdl-textfield__label">CNB Child</label>
                            <input type="text" name="child_bed4" class="mdl-textfield__input" value="CNB" readonly />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-6">
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                    <label class="mdl-textfield__label">Age From</label>
                                    <input type="number" name="child_age_from4" class="mdl-textfield__input child-age-range" min="0" max="17" placeholder="From Age" />
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                    <label class="mdl-textfield__label">Age To</label>
                                    <input type="number" name="child_age_to4" class="mdl-textfield__input child-age-range" min="0" max="17" placeholder="To Age" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width" ${weekendPriceChk ? `style="display:none"` : ``}>
                            <label class="mdl-textfield__label">Child Price</label>
                            <input type="number" name="childprice_with_breakfast4" class="mdl-textfield__input" min="0" placeholder="Enter price" />
                        </div>
                    </div>
                    ${weekendPriceChk ? `
                    <div class="col-md-2">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <label class="mdl-textfield__label">WeekEnd Price</label>
                        <input type="number" name="child_weekend_price_4" class="weekend_price mdl-textfield__input" min="0" placeholder="Enter price" />
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <label class="mdl-textfield__label">WeekDays Price</label>
                        <input type="number" name="child_weekdays_price_4" class="weekend_price mdl-textfield__input" min="0" placeholder="Enter price" />
                      </div>
                    </div>
                    ` : ''}
                </div>
            `;
        }

        return `
            <div class="row m-b-10 child-row sss" data-index="${i}">
                <div class="${weekendPriceChk ? `col-md-2` : `col-md-4`}">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width is-focused">
                        <label class="mdl-textfield__label">Child ${i} Bed</label>
                        <select name="child_bed${i}" class="mdl-textfield__input child-bed-select" style="padding-top:13px;">
                            <option value="">Select..</option>
                            <option value="CWB" ${prefill === 'CWB' ? 'selected' : ''}>Child With Bed</option>
                            <option value="CNB" ${prefill === 'CNB' ? 'selected' : ''}>Child No Bed</option>
                        </select>
                    </div>
                </div>
                <div class="${weekendPriceChk ? `col-md-2` : `col-md-4`}">
                    <div class="row">
                        <div class="col-6">
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                <label class="mdl-textfield__label">Age From</label>
                                <input type="number" name="child_age_from${i}" class="mdl-textfield__input child-age-range" min="0" max="17" placeholder="From Age" />
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                <label class="mdl-textfield__label">Age To</label>
                                <input type="number" name="child_age_to${i}" class="mdl-textfield__input child-age-range" min="0" max="17" placeholder="To Age" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="${weekendPriceChk ? `col-md-2` : `col-md-4`}" ${weekendPriceChk ? `style="display:none"` : ``}>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <label class="mdl-textfield__label">Child ${i} Price</label>
                        <input type="number" name="childprice_with_breakfast${i}" class="mdl-textfield__input" min="0" placeholder="Enter price" />
                    </div>
                </div>
                ${weekendPriceChk ? `
                <div class="col-md-2">
                  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                    <label class="mdl-textfield__label">WeekEnd Price</label>
                    <input type="number" name="child_weekend_price_${i}" class="weekend_price mdl-textfield__input" min="0" placeholder="Enter price" />
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                    <label class="mdl-textfield__label">WeekDays Price</label>
                    <input type="number" name="child_weekdays_price_${i}" class="weekend_price mdl-textfield__input" min="0" placeholder="Enter price" />
                  </div>
                </div>
                ` : ''}
            </div>
        `;
    }

    $(document).on('click', 'tr[id]', function () {
      $('#errorMessage').html('');
      $('.submit').val('EDIT').text('EDIT');
      const modal = $('#modalAddCategory');
      const countRow = modal.find('#hotel_room_category tbody.room-category-prices tr').length;
      // console.log("Row count11111111:", allRows);
      const childClasses = ['child1-row', 'child2-row', 'child3-row', 'child4-row'];
      const anyChildRowExists = childClasses.some(className => modal.find('.' + className).length > 0);

      // Set readonly on child_number based on conditions
      if (countRow === 1) {
          modal.find('#child_number').removeAttr('readonly');
      } else if (countRow > 1 && anyChildRowExists) {
          modal.find('#child_number').attr('readonly', true);
      } else {
          modal.find('#child_number').removeAttr('readonly');
      }

      const classesToChecks = [
          'single-occupancy',
          'double-occupancy',
          'triple-occupancy',
          'four-occupancy',
          'five-occupancy',
          'six-occupancy'
      ];

      const anyOccupancyClassExists = classesToChecks.some(className => modal.find('.' + className).length > 0);

      // 🔁 REVERSED your existing condition
      if (countRow === 1) {
          modal.find('#adult_number').removeAttr('readonly');
      } else if (countRow > 1 && anyOccupancyClassExists) {
          modal.find('#adult_number').attr('readonly', true);
      } else {
          modal.find('#adult_number').removeAttr('readonly');
      }


      const $form = $('#form_Data');
      const $submitBtn = $('.submit');
      
      let initialFormState = "";

      // Prevent multiple bindings
      $form.off('input change').on('input change', 'input, select, textarea', function () {
          const currentState = $form.serialize();
          $submitBtn.prop('disabled', currentState === initialFormState);
      });

      // Delayed execution to allow modal render
      setTimeout(() => {
          // Occupancy field logic
          const classesToCheck = [
              'single-occupancy',
              'double-occupancy',
              'triple-occupancy',
              'four-occupancy',
              'five-occupancy',
              'six-occupancy'
          ];

          const defaultExisting = {};
          classesToCheck.forEach(className => {
              const exists = modal.find('.' + className).length > 0;
              defaultExisting[className] = exists;
              console.log(`${className} ${exists ? 'exists' : 'NOT found'}`);
          });

          // Always bind input event regardless of readonly
          $(document).on('input', '#adult_number', function () {
              const totalRequired = parseInt($(this).val()) || 0;
              const container = $('#modalAddCategory');

              // Try to find the main target div
              let targetDiv = container.find('#adultPriceDiv');
              // If not found, fallback to #room_accommodation span
              if (!targetDiv.length) {
                  targetDiv = container.find('#room_accommodation');
              }

              const occupancyMap = {
                  1: { label: "Single Occupancy Price", class: "single-occupancy" },
                  2: { label: "Double Occupancy Price", class: "double-occupancy" },
                  3: { label: "Triple Occupancy Price", class: "triple-occupancy" },
                  4: { label: "Four Occupancy Price", class: "four-occupancy" },
                  5: { label: "Five Occupancy Price", class: "five-occupancy" },
                  6: { label: "Six Occupancy Price", class: "six-occupancy" }
              };

              for (let i = 1; i <= 6; i++) {
                  const occ = occupancyMap[i];
                  let $element = container.find(`.${occ.class}`);

                  // If not exists and needed, create and append
                  if (!$element.length && i <= totalRequired) {
                      const $wrapper = $(`
                      <div class="col-lg-12 p-t-20 ${occ.class}" data-dynamic="true">
                        <div class="row">
                          <div class="col-lg-4" ${weekendPriceChk ? `style="display:none"` : ``}>
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                              <label class="mdl-textfield__label">${occ.label}</label>
                              <input type="text" name="adultprice_with_breakfast[]" class="breakfast_price mdl-textfield__input" placeholder="Price">
                            </div>
                          </div>
                          ${weekendPriceChk ? `
                          <div class="col-lg-4">
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                              <label class="mdl-textfield__label">Weekend Price</label>
                              <input type="text" name="weekend_adult_price[]" class="mdl-textfield__input" placeholder="Weekend Price">
                            </div>
                          </div>
                            <div class="col-lg-4">
                              <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                <label class="mdl-textfield__label">Weekdays Price</label>
                                <input type="text" name="weekdays_adult_price[]" class="mdl-textfield__input" placeholder="Weekdays Price">
                              </div>
                            </div>
                            ` : ''}
                        </div>
                      </div>
                      `);
            
                      // Append after the last existing occupancy element if any
                      let $last = null;
                      Object.values(occupancyMap).forEach(o => {
                        const $found = container.find(`.${o.class}`);
                        if ($found.length) $last = $found.last();
                      });
            
                      if ($last) {
                        $last.after($wrapper);
                      } else {
                        // Append below the fallback target span
                        targetDiv.after($wrapper);
                      }
            
                    } else {
                      // Show or hide based on the input value
                      if (i <= totalRequired) {
                          $element.show();
                      } else {
                          $element.hide();
                      }
                  }
              }
          });

          // Handle dynamic child fields
          const defaultChildFields = {};
          for (let i = 1; i <= 4; i++) {
              const exists = modal.find(`.child${i}-type`).length > 0 &&
                            modal.find(`.child${i}-agefrom`).length > 0 &&
                            modal.find(`.child${i}-ageto`).length > 0 &&
                            modal.find(`.child${i}-price`).length > 0;

              if (exists) {
                  defaultChildFields[i] = true;
                  console.log(`Child ${i} already exists`);
              }
          }

          $('#child_fields_data').remove();
          const childFieldsDiv = $('<div id="child_fields_data" class="col-lg-12 p-t-20"></div>');
          $('#room_accommodationss').prepend(childFieldsDiv);

          $('#child_number').off('input').on('input', function () {
              let value = $(this).val().replace(/\D/g, '');
              value = value ? parseInt(value) : '';
              value = Math.min(Math.max(value, 0), 3);
              $(this).val(value);
              $('#child_fields_data').empty();

              for (let i = 1; i <= value; i++) {
                if (!defaultChildFields[i]) {
                  // Add weekday/weekend price fields to child row
                  let childRow = $(createChildRow(i));
                  // // Find the price column and append extra fields
                  // let priceCol = childRow.find('.mdl-textfield:has(input[name="childprice_with_breakfast' + i + '"])');

                  // if (priceCol.length) {
                  //   priceCol.append(`
                  //   ${weekendPriceChk ? `
                  //     <label class="mdl-textfield__label">Child ${i} Weekend Price</label>
                  //     <input type="text" name="child_weekend_price_${i}" class="mdl-textfield__input" placeholder="Weekend Price">
                  //     <label class="mdl-textfield__label">Child ${i} Weekdays Price</label>
                  //     <input type="text" name="child_weekdays_price_${i}" class="mdl-textfield__input" placeholder="Weekdays Price">
                  //   ` : ''}
                  //     `);
                  // }
                  childFieldsDiv.append(childRow);
                }
              }

              if (value === 0) {
                  for (let i = 1; i <= 4; i++) $(`.child${i}-row`).hide();
                  return;
              }

              let cwbRows = [], cnbRows = [];
              for (let i = 1; i <= 4; i++) {
                  const $row = $(`.child${i}-row`);
                  const bedType = $row.find('.child-bed-select').val();
                  (bedType === 'CWB') ? cwbRows.push($row) : (bedType === 'CNB') ? cnbRows.push($row) : null;
              }

              if (value === 1 && cnbRows.length && cwbRows.length) {
                  cwbRows.forEach($row => $row.hide());
                  cnbRows[0].show();
              } else {
                  for (let i = 1; i <= 4; i++) {
                      const $row = $(`.child${i}-row`);
                      const bedType = $row.find('.child-bed-select').val();
                      (i <= value || bedType === 'CNB') ? $row.show() : $row.hide();
                  }
              }
          });

          // Child bed change handler
          $(document).off('change', '.child-bed-select').on('change', '.child-bed-select', function () {
              const childCount = parseInt($('#child_number').val());
              const selectedValues = $('.child-bed-select').map(function () {
                  return $(this).val();
              }).get();

              const cwbCount = selectedValues.filter(val => val === 'CWB').length;
              const hasCNB = selectedValues.includes('CNB');
              const extraCNBExists = childFieldsDiv.find('.child-row').length > childCount;

              if (childCount >= 1 && childCount <= 3) {
                  if (cwbCount === childCount && !hasCNB && !extraCNBExists) {
                      childFieldsDiv.append(createChildRow(childCount + 1, '', true));
                  } else if (extraCNBExists) {
                      childFieldsDiv.find(`.child-row:gt(${childCount - 1})`).remove();
                  }
              }
          });

          // Age field validation
          $(document).off('input', '.child-age-range').on('input', '.child-age-range', function () {
              let val = parseInt($(this).val());
              if (val > 17) $(this).val(17);
              else if (val < 0 && val !== '') $(this).val(0);
          });

          initialFormState = $form.serialize();
          $submitBtn.prop('disabled', true);
      }, 2000);

      $(document).off('click', '.submit').on('click', '.submit', function () {
          $('.single-occupancy, .double-occupancy, .triple-occupancy, .four-occupancy, .five-occupancy, .six-occupancy, .child1-row, .child2-row, .child3-row, .child4-row').each(function () {
              if (!$(this).is(':visible')) {
                  $(this).find('input[type="text"], select').val('');
              }
          });

          $('#form_Data')[0].submit();
      });
    });

    $(document).on('click', 'tr[id]', function() {
        // Fetch child weekend/weekday prices
        var child1_weekend = $(this).find('#child_weekend_price_1').text().trim();
        var child1_weekdays = $(this).find('#child_weekdays_price_1').text().trim();
        var child2_weekend = $(this).find('#child_weekend_price_2').text().trim();
        var child2_weekdays = $(this).find('#child_weekdays_price_2').text().trim();
        var child3_weekend = $(this).find('#child_weekend_price_3').text().trim();
        console.log('child3_weekend', child3_weekend);
        var child3_weekdays = $(this).find('#child_weekdays_price_3').text().trim();
        console.log('child3_weekdays', child3_weekdays);
        var child4_weekend = $(this).find('#child_weekend_price_4').text().trim();
        var child4_weekdays = $(this).find('#child_weekdays_price_4').text().trim();
      $("#submit").removeAttr("disabled").addClass("btn-pink");  
      // Clear previous data
      $('.add-edit').children('div').slice(8).remove();
      $('#child_container').empty();
      $('#from_date').val('');
      $('#to_date').val('');

      // Get the category ID from the row class
      var categoryId = $(this).attr('class');
      let fba = $(this).find('td[data-fba]').data('fba');
      console.log(fba, 'fba');
      $('#freebreakfast').val(fba);
      let categoryIds = $(this).data('category-id');
      const uniqueId = $(this).attr('id');
      $('#editingCategoryId').val(categoryIds);
      $('#editingRowId').val(uniqueId);
      // console.log(categoryIds,'hhhhh');
      // console.log(uniqueId,'uniqueId');
      // Extract data from the row
      var fromDate = $(this).find('[data-from_date]').data('from_date');
      var toDate = $(this).find('[data-to_date]').data('to_date');
      $('#editingRowFromDate').val(fromDate);
      $('#editingRowToDate').val(toDate);
      var single = $(this).find('#price_with_breakfast_adult_person_count_1').text().trim();
      var single_adult_uid = $(this).find('#price_with_breakfast_adult_person_count_1').attr("data-update-id-adult-count-1").trim();
      var single_weekend = $(this).find('#adult_weekend_price_1').text().trim();
      var single_weekdays = $(this).find('#adult_weekdays_price_1').text().trim();
      var double = $(this).find('#price_with_breakfast_adult_person_count_2').text().trim();
      var double_adult_uid = $(this).find('#price_with_breakfast_adult_person_count_2').attr("data-update-id-adult-count-2").trim();
      var double_weekend = $(this).find('#adult_weekend_price_2').text().trim();
      var double_weekdays = $(this).find('#adult_weekdays_price_2').text().trim();
      var triple = $(this).find('#price_with_breakfast_adult_person_count_3').text().trim();
      var triple_adult_uid = $(this).find('#price_with_breakfast_adult_person_count_3').attr("data-update-id-adult-count-3").trim();
      var triple_weekend = $(this).find('#adult_weekend_price_3').text().trim();
      var triple_weekdays = $(this).find('#adult_weekdays_price_3').text().trim();
      var four = $(this).find('#price_with_breakfast_adult_person_count_4').text().trim();
      var four_adult_uid = $(this).find('#price_with_breakfast_adult_person_count_4').attr("data-update-id-adult-count-4").trim();
      var four_weekend = $(this).find('#adult_weekend_price_4').text().trim();
      var four_weekdays = $(this).find('#adult_weekdays_price_4').text().trim();
      var five = $(this).find('#price_with_breakfast_adult_person_count_5').text().trim();
      var five_adult_uid = $(this).find('#price_with_breakfast_adult_person_count_5').attr("data-update-id-adult-count-5").trim();
      var five_weekend = $(this).find('#adult_weekend_price_5').text().trim();
      var five_weekdays = $(this).find('#adult_weekdays_price_5').text().trim();
      var six = $(this).find('#price_with_breakfast_adult_person_count_6').text().trim();
      var six_adult_uid = $(this).find('#price_with_breakfast_adult_person_count_6').attr("data-update-id-adult-count-6").trim();
      var six_weekend = $(this).find('#adult_weekend_price_6').text().trim();
      var six_weekdays = $(this).find('#adult_weekdays_price_6').text().trim();
 
      var child = $(this).find('#price_with_breakfast_child_person_count_1').text().trim().split("(")[0];
      var child_uid = $(this).find('#price_with_breakfast_child_person_count_1').attr("data-update-id-child-count-1").trim();
    
      var child1 = $(this).find('#price_with_breakfast_child_person_count_1').text().trim().split("(")[0];
      var child1_uid = $(this).find('#price_with_breakfast_child_person_count_1').attr("data-update-id-child-count-1").trim();
      var child_type1 = $(this).find('#child_type1').text().trim().split("(")[0];
      var child_type1_uid = $(this).find('#child_type1').attr("data-update-id-child-type-1").trim();
      var child1agefrom= $(this).find('#child1_age_from').text().trim().split("(")[0];
      var child1agefrom_uid = $(this).find('#child1_age_from').attr("data-update-id-child-agefrom-1").trim();
      var child1ageto = $(this).find('#child1_age_to').text().trim().split("(")[0];
      var child1ageto_uid = $(this).find('#child1_age_to').attr("data-update-id-adult-ageto-1").trim();

      var child2 = $(this).find('#price_with_breakfast_child_person_count_2').text().trim();
      var child2_uid = $(this).find('#price_with_breakfast_child_person_count_2').attr("data-update-id-child-count-2").trim();
      var child_type2 = $(this).find('#child_type2').text().trim().split("(")[0];
      var child_type2_uid = $(this).find('#child_type2').attr("data-update-id-child-type-2").trim();
      var child2agefrom= $(this).find('#child2_age_from').text().trim().split("(")[0];
      var child2agefrom_uid = $(this).find('#child2_age_from').attr("data-update-id-child-agefrom-2").trim();
      var child2ageto = $(this).find('#child2_age_to').text().trim().split("(")[0];
      var child2ageto_uid = $(this).find('#child2_age_to').attr("data-update-id-adult-ageto-2").trim();

      var child_type3 = $(this).find('#child_type3').text().trim().split("(")[0];
      var child_type3_uid = $(this).find('#child_type3').attr("data-update-id-child-type-3").trim();
      var child3agefrom= $(this).find('#child3_age_from').text().trim().split("(")[0];
      var child3agefrom_uid = $(this).find('#child3_age_from').attr("data-update-id-child-agefrom-3").trim();
      var child3ageto = $(this).find('#child3_age_to').text().trim().split("(")[0];
      var child3ageto_uid = $(this).find('#child3_age_to').attr("data-update-id-adult-ageto-3").trim();
      var child3 = $(this).find('#price_with_breakfast_child_person_count_3').text().trim();
      var child3_uid = $(this).find('#price_with_breakfast_child_person_count_3').attr("data-update-id-child-count-3").trim();

      var child_type4 = $(this).find('#child_type4').text().trim().split("(")[0];
      var child_type4_uid = $(this).find('#child_type4').attr("data-update-id-child-type-4").trim();
      var child4agefrom= $(this).find('#child4_age_from').text().trim().split("(")[0];
      var child4agefrom_uid = $(this).find('#child4_age_from').attr("data-update-id-child-agefrom-4").trim();
      var child4ageto = $(this).find('#child4_age_to').text().trim().split("(")[0];
      var child4ageto_uid = $(this).find('#child4_age_to').attr("data-update-id-adult-ageto-4").trim();
      var child4 = $(this).find('#price_with_breakfast_child_person_count_4').text().trim();
      var child4_uid = $(this).find('#price_with_breakfast_child_person_count_4').attr("data-update-id-child-count-4").trim();

      // Initialize input fields
      var $inputField = '';
      var $childInputField = '';

      if (single !== '-' || single_weekend !== '-' || single_weekdays !== '-') {
        $inputField += `
        <div class="col-lg-12 p-t-20 single-occupancy">
          <div class="row">
            <div class="col-lg-4" ${weekendPriceChk ? `style="display:none"` : ``}>
              <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                <label class="mdl-textfield__label">Single Occupancy Price</label>
                <input type="text" name="adultprice_with_breakfast[]" class="breakfast_price mdl-textfield__input" value="${single}" >
                <input type="hidden" name="adultprice_update_id[]" value="${single_adult_uid}">
              </div>
            </div>
            ${weekendPriceChk ? `
            <div class="col-lg-4">
              <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                <label class="mdl-textfield__label">Single Weekend Price</label>
                <input type="text" name="weekend_adult_price[]" class="mdl-textfield__input" value="${single_weekend}">
              </div>
            </div>   
            <div class="col-lg-4">
              <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
            <label class="mdl-textfield__label">Single Weekdays Price</label>
            <input type="text" name="weekdays_adult_price[]" class="mdl-textfield__input" value="${single_weekdays}">
              </div>
            </div>
            ` : ''}
          </div>
        </div>`;
      }

      if (double !== '-' || double_weekend !== '-' || double_weekdays !== '-') {
        $inputField += `
      <div class="col-lg-12 p-t-20 double-occupancy">
        <div class="row">
          <div class="col-lg-4" ${weekendPriceChk ? `style="display:none"` : ``}>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
              <label class="mdl-textfield__label">Double Occupancy Price</label>
              <input type="text" name="adultprice_with_breakfast[]" class="breakfast_price mdl-textfield__input" value="${double}" >
              <input type="hidden" name="adultprice_update_id[]" value="${double_adult_uid}">
            </div>
          </div>
            ${weekendPriceChk ? `
          <div class="col-lg-4">
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">  
              <label class="mdl-textfield__label">Double Weekend Price</label>
              <input type="text" name="weekend_adult_price[]" class="mdl-textfield__input" value="${double_weekend}">
            </div>
          </div>
          <div class="col-lg-4">
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">  
            <label class="mdl-textfield__label">Double Weekdays Price</label>
            <input type="text" name="weekdays_adult_price[]" class="mdl-textfield__input" value="${double_weekdays}">
            </div>
          </div>
            ` : ''}
        </div>
      </div>`;
      }

      if (triple !== '-' || triple_weekend !== '-' || triple_weekdays !== '-') {
        $inputField += `
      <div class="col-lg-12 p-t-20 triple-occupancy">
        <div class="row">
          <div class="col-lg-4" ${weekendPriceChk ? `style="display:none"` : ``}>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
              <label class="mdl-textfield__label">Triple Occupancy Price</label>
              <input type="text" name="adultprice_with_breakfast[]" class="breakfast_price mdl-textfield__input" value="${triple}" >
              <input type="hidden" name="adultprice_update_id[]" value="${triple_adult_uid}">
            </div>  
          </div>
            ${weekendPriceChk ? `
          <div class="col-lg-4">
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
              <label class="mdl-textfield__label">Triple Weekend Price</label>
              <input type="text" name="weekend_adult_price[]" class="mdl-textfield__input" value="${triple_weekend}">
            </div>
          </div>
          <div class="col-lg-4">
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
              <label class="mdl-textfield__label">Triple Weekdays Price</label>
              <input type="text" name="weekdays_adult_price[]" class="mdl-textfield__input" value="${triple_weekdays}">
            </div>  
          </div>
            ` : ''}
        </div>
      </div>`;
      }

      if (four !== '-' || four_weekend !== '-' || four_weekdays !== '-') {
        $inputField += `
      <div class="col-lg-12 p-t-20 four-occupancy">
        <div class="row">
          <div class="col-lg-4" ${weekendPriceChk ? `style="display:none"` : ``}>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
            <label class="mdl-textfield__label">Four Occupancy Price</label>
            <input type="text" name="adultprice_with_breakfast[]" class="breakfast_price mdl-textfield__input" value="${four}" >
            <input type="hidden" name="adultprice_update_id[]" value="${four_adult_uid}">
            </div>
          </div>
            ${weekendPriceChk ? `
          <div class="col-lg-4">
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
              <label class="mdl-textfield__label">Four Weekend Price</label>
              <input type="text" name="weekend_adult_price[]" class="mdl-textfield__input" value="${four_weekend}">
            </div>
          </div>
          <div class="col-lg-4">
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
              <label class="mdl-textfield__label">Four Weekdays Price</label>
              <input type="text" name="weekdays_adult_price[]" class="mdl-textfield__input" value="${four_weekdays}">
            </div>
          </div>
            ` : ''}
          </div>
        </div>`;
      }

      if (five !== '-' || five_weekend !== '-' || five_weekdays !== '-') {
        $inputField += `
      <div class="col-lg-12 p-t-20 five-occupancy">
        <div class="row">
          <div class="col-lg-4" ${weekendPriceChk ? `style="display:none"` : ``}>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
              <label class="mdl-textfield__label">Five Occupancy Price</label>
              <input type="text" name="adultprice_with_breakfast[]" class="breakfast_price mdl-textfield__input" value="${five}" >
              <input type="hidden" name="adultprice_update_id[]" value="${five_adult_uid}">
            </div>
          </div>
            ${weekendPriceChk ? `
          <div class="col-lg-4">
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
              <label class="mdl-textfield__label">Five Weekend Price</label>
              <input type="text" name="weekend_adult_price[]" class="mdl-textfield__input" value="${five_weekend}">
            </div>
          </div>
          <div class="col-lg-4">
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
            <label class="mdl-textfield__label">Five Weekdays Price</label>
            <input type="text" name="weekdays_adult_price[]" class="mdl-textfield__input" value="${five_weekdays}">
            </div>
          </div>
            ` : ''}
          </div>
        </div>`;
      }

      if (six !== '-' || six_weekend !== '-' || six_weekdays !== '-') {
        $inputField += `
      <div class="col-lg-12 p-t-20 six-occupancy">
        <div class="row">
          <div class="col-lg-4" ${weekendPriceChk ? `style="display:none"` : ``}>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
              <label class="mdl-textfield__label">Six Occupancy Price</label>
              <input type="text" name="adultprice_with_breakfast[]" class="breakfast_price mdl-textfield__input" value="${six}" >
              <input type="hidden" name="adultprice_update_id[]" value="${six_adult_uid}">
            </div>
          </div>
            ${weekendPriceChk ? `
          <div class="col-lg-4">
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt
              <label class="mdl-textfield__label">Six Weekend Price</label>
              <input type="text" name="weekend_adult_price[]" class="mdl-textfield__input" value="${six_weekend}">
            </div>
          </div>
          <div class="col-lg-4">
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
            <label class="mdl-textfield__label">Six Weekdays Price</label>
            <input type="text" name="weekdays_adult_price[]" class="mdl-textfield__input" value="${six_weekdays}">
            </div>
          </div>
            ` : ''}
          </div>
        </div>`;
      }

      if (child_type1 !== '-') {
        let child_type1CWB = child_type1 === 'CWB' ? 'selected' : '';
        let child_type1CNB = child_type1 === 'CNB' ? 'selected' : '';
        $childInputField += `
            <div class="col-lg-2 p-t-20 child1-type child1-row">
              <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
              <label class="mdl-textfield__label">Child1 Type</label>
                <select name="child_bed1" class="mdl-textfield__input child-bed-select" style="padding-top:13px;">
                    <option value="">Select..</option>
                    <option value="CWB" ${child_type1CWB}>Child With Bed</option>
                    <option value="CNB" ${child_type1CNB}>Child No Bed</option>
                </select>
              </div>
              </div>`;
            }
            // <button type="button" class="btn btn-danger remove-child-group" style="position:absolute;top:5px;right:10px;">Remove</button>

      if (child1agefrom !== '-') {
        $childInputField += `
          <div class="col-lg-2 p-t-20 child1-agefrom child1-row">
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
            <label class="mdl-textfield__label">Child1 Age From</label>
              <input type="text" name="child_age_from1" class="mdl-textfield__input" value="${child1agefrom}">
              <input type="hidden" name="child1agefrom[]" value="${child1agefrom_uid}">
            </div>
            </div>`;
          }
          // <button type="button" class="btn btn-danger remove-child-group" style="position:absolute;top:5px;right:10px;">Remove</button>

      if (child1ageto !== '-') {
        $childInputField += `
          <div class="col-lg-2 p-t-20 child1-ageto child1-row">
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
            <label class="mdl-textfield__label">Child1 Age To</label>
              <input type="text" name="child_age_to1" class="mdl-textfield__input" value="${child1ageto}">
              <input type="hidden" name="child1ageto[]" value="${child1ageto_uid}">
            </div>
            </div>`;
          }
          // <button type="button" class="btn btn-danger remove-child-group" style="position:absolute;top:5px;right:10px;">Remove</button>

      if (child1 !== '-' || child1_weekend !== '-' || child1_weekdays !== '-') {
        $childInputField += `
          <div class="col-lg-6 p-t-20 child1-price child1-row">
            <div class="row">
              <div class="col-md-4" ${weekendPriceChk ? `style="display:none"` : ``}>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                  <label class="mdl-textfield__label">Child 1 Price</label>
                    <input type="text" name="childprice_with_breakfast1" class="mdl-textfield__input" value="${child1}">
                    <input type="hidden" name="childprice_update_id[]" value="${child1_uid}">
                </div>
              </div>
                ${weekendPriceChk ? `
              <div class="col-md-4">  
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width" >
                  <label class="mdl-textfield__label">Child 1 Weekend Price</label>
                  <input type="text" name="child_weekend_price_1" class="mdl-textfield__input" value="${child1_weekend}">
                </div>
              </div>
              <div class="col-md-4">  
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                  <label class="mdl-textfield__label">Child 1 Weekdays Price</label>
                  <input type="text" name="child_weekdays_price_1" class="mdl-textfield__input" value="${child1_weekdays}">
                </div>  
              </div>
                  ` : ''}
            </div>
          </div>`;
      }
          // <button type="button" class="btn btn-danger remove-child-group" style="position:absolute;top:5px;right:10px;">Remove</button>

      if (child_type2 !== '-') {
        let selectedCWB = child_type2 === 'CWB' ? 'selected' : ''; 
        let selectedCNB = child_type2 === 'CNB' ? 'selected' : '';

        $childInputField += `
          <div class="col-lg-2 p-t-20 child2-type child2-row">
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
            <label class="mdl-textfield__label">Child2 Type</label>
              <select name="child_bed2" class="mdl-textfield__input child-bed-select" style="padding-top:13px;">
                  <option value="">Select..</option>
                  <option value="CWB" ${selectedCWB}>Child With Bed</option>
                  <option value="CNB" ${selectedCNB}>Child No Bed</option>
              </select>
            </div>
            </div>`;
          }
          // <button type="button" class="btn btn-danger remove-child-group" style="position:absolute;top:5px;right:10px;">Remove</button>

      if (child2agefrom !== '-') {
        $childInputField += `
          <div class="col-lg-2 p-t-20 child2-agefrom child2-row">
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
            <label class="mdl-textfield__label">Child2 Age From</label>
              <input type="text" name="child_age_from2" class="mdl-textfield__input" value="${child2agefrom}">
              <input type="hidden" name="child2agefrom[]" value="${child2agefrom_uid}">
            </div>
            </div>`;
          }
          // <button type="button" class="btn btn-danger remove-child-group" style="position:absolute;top:5px;right:10px;">Remove</button>

      if (child2ageto !== '-') {
        $childInputField += `
          <div class="col-lg-2 p-t-20 child2-ageto child2-row">
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
            <label class="mdl-textfield__label">Child2 Age To</label>
              <input type="text" name="child_age_to2" class="mdl-textfield__input" value="${child2ageto}">
              <input type="hidden" name="child2ageto[]" value="${child2ageto_uid}">
            </div>
            </div>`;
          }
          // <button type="button" class="btn btn-danger remove-child-group" style="position:absolute;top:5px;right:10px;">Remove</button>

      if (child2 !== '-' || child2_weekend !== '-' || child2_weekdays !== '-') {
        $childInputField += `
          <div class="col-lg-6 p-t-20 child2-price child2-row">
            <div class="row">
              <div class="col-md-4" ${weekendPriceChk ? `style="display:none"` : ``}>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                  <label class="mdl-textfield__label">Child 2 Price</label>
                  <input type="text" name="childprice_with_breakfast2" class="mdl-textfield__input" value="${child2}">
                  <input type="hidden" name="childprice_update_id[]" value="${child2_uid}">
                </div>
              </div>
              ${weekendPriceChk ? `
              <div class="col-md-4">
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                  <label class="mdl-textfield__label">Child 2 Weekend Price</label>
                  <input type="text" name="child_weekend_price_2" class="mdl-textfield__input" value="${child2_weekend}">
                </div>  
              </div>
              <div class="col-md-4">
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                  <label class="mdl-textfield__label">Child 2 Weekdays Price</label>
                  <input type="text" name="child_weekdays_price_2" class="mdl-textfield__input" value="${child2_weekdays}">
                </div>  
              </div>
              ` : ''}
            </div>
          </div>`;
      }
          // <button type="button" class="btn btn-danger remove-child-group" style="position:absolute;top:5px;right:10px;">Remove</button>


      if (child_type3 !== '-') {
        let selectedCWB = child_type3 === 'CWB' ? 'selected' : ''; 
        let selectedCNB = child_type3 === 'CNB' ? 'selected' : '';

        $childInputField += `
          <div class="col-lg-2 p-t-20 child3-type child3-row">
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
            <label class="mdl-textfield__label">Child3 Type</label>
              <select name="child_bed3" class="mdl-textfield__input child-bed-select" style="padding-top:13px;">
                  <option value="">Select..</option>
                  <option value="CWB" ${selectedCWB}>Child With Bed</option>
                  <option value="CNB" ${selectedCNB}>Child No Bed</option>
              </select>
            </div>
          </div>`;
      }

      if (child3agefrom !== '-') {
        $childInputField += `
          <div class="col-lg-2 p-t-20 child3-agefrom child3-row">
          <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
            <label class="mdl-textfield__label">Child3 Age From</label>
              <input type="text" name="child_age_from3" class="mdl-textfield__input" value="${child3agefrom}">
              <input type="hidden" name="child3agefrom[]" value="${child3agefrom_uid}">
            </div>
          </div>`;
      }

      if (child3ageto !== '-') {
        $childInputField += `
          <div class="col-lg-2 p-t-20 child3-ageto child3-row">
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
              <label class="mdl-textfield__label">Child3 Age To</label>
              <input type="text" name="child_age_to3" class="mdl-textfield__input" value="${child3ageto}">
              <input type="hidden" name="child3ageto[]" value="${child3ageto_uid}">
            </div>
          </div>`;
      }

      if (child3 !== '-' || child3_weekend !== '-' || child3_weekdays !== '-') {
        $childInputField += `
          <div class="col-lg-6 p-t-20 child3-price child3-row">
            <div class="row">
              <div class="col-md-4" ${weekendPriceChk ? `style="display:none"` : ``}>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                  <label class="mdl-textfield__label">Child 3 Price</label>
                  <input type="text" name="childprice_with_breakfast3" class="mdl-textfield__input" value="${child3}">
                  <input type="hidden" name="childprice_update_id[]" value="${child3_uid}">
                </div>
              </div>
              ${weekendPriceChk ? `
              <div class="col-md-4">
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                  <label class="mdl-textfield__label">Child 3 Weekend Price</label>
                  <input type="text" name="child_weekend_price_3" class="mdl-textfield__input" value="${child3_weekend}">
                </div>  
              </div>
              <div class="col-md-4">
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                  <label class="mdl-textfield__label">Child 3 Weekdays Price</label>
                  <input type="text" name="child_weekdays_price_3" class="mdl-textfield__input" value="${child3_weekdays}">
                </div>  
              </div>
              ` : ''}
            </div>
          </div>`;
      }

      if (child_type4 !== '-') {
        let selectedCWB = child_type4 === 'CWB' ? 'selected' : ''; 
        let selectedCNB = child_type4 === 'CNB' ? 'selected' : '';

        $childInputField += `
          <div class="col-lg-2 p-t-20 child4-type child4-row">
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
            <label class="mdl-textfield__label">Child4 Type</label>
              <select name="child_bed4" class="mdl-textfield__input child-bed-select" style="padding-top:13px;">
                  <option value="">Select..</option>
                  <option value="CWB" ${selectedCWB}>Child With Bed</option>
                  <option value="CNB" ${selectedCNB}>Child No Bed</option>
              </select>
            </div>
          </div>`;
      }
      
      if (child4agefrom !== '-') {
        $childInputField += `
        <div class="col-lg-2 p-t-20 child4-agefrom child4-row">
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
            <label class="mdl-textfield__label">Child4 Age From</label>
              <input type="text" name="child_age_from4" class="mdl-textfield__input" value="${child4agefrom}">
              <input type="hidden" name="child4agefrom[]" value="${child4agefrom_uid}">
            </div>
          </div>`;
      }

      if (child4ageto !== '-') {
        $childInputField += `
          <div class="col-lg-2 p-t-20 child4-ageto child4-row">
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
            <label class="mdl-textfield__label">Child4 Age To</label>
              <input type="text" name="child_age_to4" class="mdl-textfield__input" value="${child4ageto}">
              <input type="hidden" name="child4ageto[]" value="${child4ageto_uid}">
            </div>
          </div>`;
      }

      if (child4 !== '-' || child4_weekend !== '-' || child4_weekdays !== '-') {
        $childInputField += `
          <div class="col-lg-6 p-t-20 child4-price child4-row">
            <div class="row">
              <div class="col-md-4" ${weekendPriceChk ? `style="display:none"` : ``}>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                  <label class="mdl-textfield__label">Child 4 Price</label>
                  <input type="text" name="childprice_with_breakfast4" class="mdl-textfield__input" value="${child4}">
                  <input type="hidden" name="childprice_update_id[]" value="${child4_uid}">
                </div>
              </div>
              ${weekendPriceChk ? `
              <div class="col-md-4">
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                  <label class="mdl-textfield__label">Child 4 Weekend Price</label>
                  <input type="text" name="child_weekend_price_4" class="mdl-textfield__input" value="${child4_weekend}">
                </div>  
              </div>
              <div class="col-md-4">
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                  <label class="mdl-textfield__label">Child 4 Weekdays Price</label>
                  <input type="text" name="child_weekdays_price_4" class="mdl-textfield__input" value="${child4_weekdays}">
                </div>  
              </div>  
              ` : ''}
            </div>
          </div>`;
      }

      // Append the new input fields to the edit container
      $('.add-edit').append($inputField);
      $('#child_container').append($childInputField);
      // Update the hidden fields with the new data
      $('#from_date').val(fromDate || '');
      $('#to_date').val(toDate || '');
      $('#old_from_date').val(fromDate || '');
      $('#old_to_date').val(toDate || '');
    });

    $('#modalAddCategory').on('shown.bs.modal', function () {
      // Destroy existing DataTable to avoid conflict
      if ($.fn.DataTable.isDataTable('#hotel_room_category')) {
          $('#hotel_room_category').DataTable().clear().destroy();
      }

      // Initialize again after a short delay (to ensure table is rendered)
      setTimeout(() => {
          $('#hotel_room_category').DataTable({
              responsive: {
                  details: {
                      type: 'column',
                      target: -1
                  }
              },
              columnDefs: [
                  {
                      className: 'control',
                      orderable: false,
                      targets: -1
                  }
              ],
              order: [0, 'asc']
          });
      }, 100);
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
          var tableBody = $('#hotel_room_category tbody');
          tableBody.empty();
          // tableBody.empty(); // Clear the table body
          console.log(response,'response');

          // Check if details exist and populate the form fields
          if (response.details && Object.keys(response.details).length > 0) {
            $('#hotel_id').val(hotelId || '');
            $('#category_id').val(categoryId || '');
            $('#category_name').val(response.details.category_name || '');
            $('#room_size').val(response.details.room_size || '');
            $('#max_accomodation').val(response.details.max_accomodation || '');
            $('#adult_number').val(response.details.number_adults || '');
            $('#child_number').val(response.details.number_childs || '');
          }

          // Check if price array exists and is non-empty
          if (response.price && response.price.length > 0) {
            $.each(response.price, function(index, item) {
              // Construct the table row with the data
              const uniqueId = `row-${item.category_id}-${index}`;
          
              var row = `
              <tr data-category-id="${item.category_id}" id="${uniqueId}">
                  <td class="center">${index + 1}</td>
                  <td class="center">${item.from_date.split('-').reverse().join('-') || '-'}</td>
                  <td class="center">${item.to_date.split('-').reverse().join('-') || '-'}</td>
                  <td class="center">${item.max_accomodation || '-'}</td>
                  <td class="center">${item.number_adults || '-'}</td>
                  <td class="center">${item.number_childs || '-'}</td>
                  <td class="center" data-fba="${item.freebreakfast || '3'}">${item.freebreakfast || '-'}</td>
                  <td class="center" data-update-id-adult-count-1="${item.update_id_adult_person_count_1}" id="price_with_breakfast_adult_person_count_1">${(item.price_with_breakfast_adult_person_count_1 != null && item.price_with_breakfast_adult_person_count_1 != 0) ? item.price_with_breakfast_adult_person_count_1 : '-'}</td>
                  <td class="center" data-update-id-adult-count-2="${item.update_id_adult_person_count_2}" id="price_with_breakfast_adult_person_count_2">${(item.price_with_breakfast_adult_person_count_2 != null && item.price_with_breakfast_adult_person_count_2 != 0) ? item.price_with_breakfast_adult_person_count_2 : '-'}</td>
                  <td class="center" data-update-id-adult-count-3="${item.update_id_adult_person_count_3}" id="price_with_breakfast_adult_person_count_3">${(item.price_with_breakfast_adult_person_count_3 != null && item.price_with_breakfast_adult_person_count_3 != 0) ? item.price_with_breakfast_adult_person_count_3 : '-'}</td>
                  <td class="center" data-update-id-adult-count-4="${item.update_id_adult_person_count_4}" id="price_with_breakfast_adult_person_count_4">${(item.price_with_breakfast_adult_person_count_4 != null && item.price_with_breakfast_adult_person_count_4 != 0) ? item.price_with_breakfast_adult_person_count_4 : '-'}</td>
                  <td class="center" data-update-id-adult-count-5="${item.update_id_adult_person_count_5}" id="price_with_breakfast_adult_person_count_5">${(item.price_with_breakfast_adult_person_count_5 != null && item.price_with_breakfast_adult_person_count_5 != 0) ? item.price_with_breakfast_adult_person_count_5 : '-'}</td>
                  <td class="center" data-update-id-adult-count-6="${item.update_id_adult_person_count_6}" id="price_with_breakfast_adult_person_count_6">${(item.price_with_breakfast_adult_person_count_6 != null && item.price_with_breakfast_adult_person_count_6 != 0) ? item.price_with_breakfast_adult_person_count_6 : '-'}</td>
                  <td class="center" data-update-id-adult-weekend-count-1="${item.adult_weekend_price_1}" id="adult_weekend_price_1">${(item.adult_weekend_price_1 != null && item.adult_weekend_price_1 != 0) ? item.adult_weekend_price_1 : '-'}</td>
                  <td class="center" data-update-id-adult-weekdays-count-1="${item.adult_weekdays_price_1}" id="adult_weekdays_price_1">${(item.adult_weekdays_price_1 != null && item.adult_weekdays_price_1 != 0) ? item.adult_weekdays_price_1 : '-'}</td>
                  <td class="center" data-update-id-adult-weekend-count-2="${item.adult_weekend_price_2}" id="adult_weekend_price_2">${(item.adult_weekend_price_2 != null && item.adult_weekend_price_2 != 0) ? item.adult_weekend_price_2 : '-'}</td>
                  <td class="center" data-update-id-adult-weekdays-count-2="${item.adult_weekdays_price_2}" id="adult_weekdays_price_2">${(item.adult_weekdays_price_2 != null && item.adult_weekdays_price_2 != 0) ? item.adult_weekdays_price_2 : '-'}</td>
                  <td class="center" data-update-id-adult-weekend-count-3="${item.adult_weekend_price_3}" id="adult_weekend_price_3">${(item.adult_weekend_price_3 != null && item.adult_weekend_price_3 != 0) ? item.adult_weekend_price_3 : '-'}</td>
                  <td class="center" data-update-id-adult-weekdays-count-3="${item.adult_weekdays_price_3}" id="adult_weekdays_price_3">${(item.adult_weekdays_price_3 != null && item.adult_weekdays_price_3 != 0) ? item.adult_weekdays_price_3 : '-'}</td>
                  <td class="center" data-update-id-adult-weekend-count-4="${item.adult_weekend_price_4}" id="adult_weekend_price_4">${(item.adult_weekend_price_4 != null && item.adult_weekend_price_4 != 0) ? item.adult_weekend_price_4 : '-'}</td>
                  <td class="center" data-update-id-adult-weekdays-count-4="${item.adult_weekdays_price_4}" id="adult_weekdays_price_4">${(item.adult_weekdays_price_4 != null && item.adult_weekdays_price_4 != 0) ? item.adult_weekdays_price_4 : '-'}</td>
                  <td class="center" data-update-id-adult-weekend-count-5="${item.adult_weekend_price_5}" id="adult_weekend_price_5">${(item.adult_weekend_price_5 != null && item.adult_weekend_price_5 != 0) ? item.adult_weekend_price_5 : '-'}</td>
                  <td class="center" data-update-id-adult-weekdays-count-5="${item.adult_weekdays_price_5}" id="adult_weekdays_price_5">${(item.adult_weekdays_price_5 != null && item.adult_weekdays_price_5 != 0) ? item.adult_weekdays_price_5 : '-'}</td>
                  <td class="center" data-update-id-adult-weekend-count-6="${item.adult_weekend_price_6}" id="adult_weekend_price_6">${(item.adult_weekend_price_6 != null && item.adult_weekend_price_6 != 0) ? item.adult_weekend_price_6 : '-'}</td>
                  <td class="center" data-update-id-adult-weekdays-count-6="${item.adult_weekdays_price_6}" id="adult_weekdays_price_6">${(item.adult_weekdays_price_6 != null && item.adult_weekdays_price_6 != 0) ? item.adult_weekdays_price_6 : '-'}</td>

                  <td class="center" data-update-id-child-type-1="${item.child_type1}" id="child_type1">${item.child_type1 ? item.child_type1 : '-'}</td>
                  <td class="center" data-update-id-child-agefrom-1="${item.child1_age_from}" id="child1_age_from">
                    ${(item.child1_age_from != null &&  item.child1_age_from != '')? item.child1_age_from : '-'}
                  </td>
                  <td class="center" data-update-id-adult-ageto-1="${item.child1_age_to}" id="child1_age_to">
                    ${(item.child1_age_to != null && item.child1_age_to != '') ? item.child1_age_to : '-'}
                  </td>
                  <td class="center" data-update-id-child-count-1="${item.chid1_price}" id="price_with_breakfast_child_person_count_1">
                    ${(item.chid1_price != null && item.chid1_price != '') ? item.chid1_price : '-'}
                  </td>
                  
                  <td class="center" data-update-id-child-weekend-count-1="${item.child_weekend_price_1}" id="child_weekend_price_1">
                  ${(item.child_weekend_price_1 != null && item.child_weekend_price_1 != '') ? item.child_weekend_price_1 : '-'}
                  </td>
                  <td class="center" data-update-id-child-weekdays-count-1="${item.child_weekdays_price_1}" id="child_weekdays_price_1">
                    ${(item.child_weekdays_price_1 != null && item.child_weekdays_price_1 != '') ? item.child_weekdays_price_1 : '-'}
                  </td>

                  <td class="center" data-update-id-child-type-2="${item.child_type2}" id="child_type2">${item.child_type2 ? item.child_type2 : '-'}</td>
                  <td class="center" data-update-id-child-agefrom-2="${item.child2_age_from}" id="child2_age_from">
                    ${(item.child2_age_from != null && item.child2_age_from != '') ? item.child2_age_from : '-'}
                  </td>
                  <td class="center" data-update-id-adult-ageto-2="${item.child2_age_to}" id="child2_age_to">
                    ${(item.child2_age_to != null && item.child2_age_to != '') ? item.child2_age_to : '-'}
                  </td>
                  <td class="center" data-update-id-child-count-2="${item.chid2_price}" id="price_with_breakfast_child_person_count_2">
                    ${(item.chid2_price != null && item.chid2_price != '') ? item.chid2_price : '-'}
                  </td>

                  <td class="center" data-update-id-child-weekend-count-1="${item.child_weekend_price_2}" id="child_weekend_price_2">
                  ${(item.child_weekend_price_2 != null && item.child_weekend_price_2 != '') ? item.child_weekend_price_2 : '-'}
                  </td>
                  <td class="center" data-update-id-child-weekdays-count-1="${item.child_weekdays_price_2}" id="child_weekdays_price_2">
                    ${(item.child_weekdays_price_2 != null && item.child_weekdays_price_2 != '') ? item.child_weekdays_price_2 : '-'}
                  </td>

                  <td class="center" data-update-id-child-type-3="${item.child_type3}" id="child_type3">${item.child_type3 ? item.child_type3 : '-'}</td>
                  <td class="center" data-update-id-child-agefrom-3="${item.child3_age_from}" id="child3_age_from">
                    ${(item.child3_age_from != null && item.child3_age_from != '') ? item.child3_age_from : '-'}
                  </td>
                  <td class="center" data-update-id-adult-ageto-3="${item.child3_age_to}" id="child3_age_to">
                    ${(item.child3_age_to != null && item.child3_age_to != '') ? item.child3_age_to : '-'}
                  </td>
                  <td class="center" data-update-id-child-count-3="${item.chid3_price}" id="price_with_breakfast_child_person_count_3">
                    ${(item.chid3_price != null && item.chid3_price != '') ? item.chid3_price : '-'}
                  </td>

                  <td class="center" data-update-id-child-weekend-count-1="${item.child_weekend_price_3}" id="child_weekend_price_3">
                  ${(item.child_weekend_price_3 != null && item.child_weekend_price_3 != '') ? item.child_weekend_price_3 : '-'}
                  </td>
                  <td class="center" data-update-id-child-weekdays-count-1="${item.child_weekdays_price_3}" id="child_weekdays_price_3">
                    ${(item.child_weekdays_price_3 != null && item.child_weekdays_price_3 != '') ? item.child_weekdays_price_3 : '-'}
                  </td>

                  <td class="center" data-update-id-child-type-4="${item.child_type4}" id="child_type4">${item.child_type4 ? item.child_type4 : '-'}</td>
                  <td class="center" data-update-id-child-agefrom-4="${item.child4_age_from}" id="child4_age_from">
                    ${(item.child4_age_from != null && item.child4_age_from != '') ? item.child4_age_from : '-'}
                  </td>
                  <td class="center" data-update-id-adult-ageto-4="${item.child4_age_to}" id="child4_age_to">
                    ${(item.child4_age_to != null && item.child4_age_to != '') ? item.child4_age_to : '-'}
                  </td>
                  <td class="center" data-update-id-child-count-4="${item.chid4_price}" id="price_with_breakfast_child_person_count_4">
                    ${(item.chid4_price != null && item.chid4_price != '') ? item.chid4_price : '-'}
                  </td>

                  <td class="center" data-update-id-child-weekend-count-1="${item.child_weekend_price_4}" id="child_weekend_price_4">
                  ${(item.child_weekend_price_4 != null && item.child_weekend_price_4 != '') ? item.child_weekend_price_4 : '-'}
                  </td>
                  <td class="center" data-update-id-child-weekdays-count-1="${item.child_weekdays_price_4}" id="child_weekdays_price_4">
                    ${(item.child_weekdays_price_4 != null && item.child_weekdays_price_4 != '') ? item.child_weekdays_price_4 : '-'}
                  </td>

                  <td class="center">
                      <a class="btn btn-tbl-edit btn-xs btn_edit_price" data-from_date="${item.from_date}" data-to_date="${item.to_date}" data-single="${item.price_with_breakfast_adult_person_count_1}" data-single_child="${item.price_with_breakfast_child_person_count_1}" data-double="${item.price_with_breakfast_adult_person_count_2}" 
                      data-triple="${item.price_with_breakfast_adult_person_count_3}" data-four="${item.price_with_breakfast_adult_person_count_4}" data-category_id="${item.category_id}">
                          <i class="fa fa-edit"></i>
                      </a>
                  </td>
                  <td></td>
              </tr>`;
              tableBody.append(row);
            });
          }
        },
        error: function() {
        }
      });
    }
    
    // date validation
    $(document).on("change", ".dt-search", function () {
        const $this = $(this);
        const group = $this.data("group");
        const isFrom = $this.hasClass("date_from");

        const $fromInput = $(`.date_from[data-group='${group}']`);
        const $toInput = $(`.date_to[data-group='${group}']`);

        const fromVal = $fromInput.val();
        const toVal = $toInput.val();

        const fromDate = fromVal ? new Date(fromVal) : null;
        const toDate = toVal ? new Date(toVal) : null;

        // Validation logic
        if (isFrom) {
            if (!toVal) {
                $toInput.attr("min", $this.val());
            } else if (fromDate && toDate && fromDate > toDate) {
                $toInput.val('').attr("min", $this.val());
            }
        } else {
            if (!fromVal) {
                $fromInput.attr("max", $this.val());
            } else if (fromDate && toDate && fromDate > toDate) {
                $fromInput.val('').attr("max", $this.val());
            }
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
    // console.log(childNumber,'childNumber');
    const adultPriceContainer = document.getElementById("adultPriceContainer");
    const childBedSelect = document.getElementById("child_bed");
    const childPriceContainer = document.getElementById("childPriceContainer");
    const childPriceContainerClone = document.getElementById("childPriceContainerClone");

    function updateMaxAccomodation() {
      const adultValue = Math.min(parseInt(adultNumber.value) || 0, 6);
      const childValue = Math.min(parseInt(childNumber.value) || 0, 3);
      const totalOccupancy = adultValue + childValue;

      // maxAccomodation.value = ;
      generateAdultPriceFields(adultValue);
    }

    
    function generateAdultPriceFields(count) {
      if (adultPriceContainer) {
        adultPriceContainer.innerHTML = "";
        for (let i = 2; i <= count; i++) {
          const wrapper = document.createElement("div");
          wrapper.classList.add("row");
          wrapper.style.marginBottom = "15px";
          let label =
            i === 2 ? "Double Occupancy" :
            i === 3 ? "Triple Occupancy" :
            i === 4 ? "Four Occupancy" :
            i === 5 ? "Five Occupancy" :
            "Six Occupancy";
          const fieldOccupancy = document.createElement("div");
          fieldOccupancy.classList.add("col-lg-4", "p-t-20");
          // hide/show col-lg-4
          if (weekendPriceChk) {
            fieldOccupancy.style.display = "none";
          }
          fieldOccupancy.innerHTML = `
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
              <label class="mdl-textfield__label">${label} Price (<?= $currency ?>)</label>
              <input type="text" name="adultprice_with_breakfast[]" class="breakfast_price mdl-textfield__input" placeholder="Price">
            </div>
          `;
          wrapper.appendChild(fieldOccupancy);
          if (weekendPriceChk) {
            const fieldWeekend = document.createElement("div");
            fieldWeekend.classList.add("col-lg-4", "p-t-20");
            fieldWeekend.innerHTML = `
              <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                <label class="mdl-textfield__label">${label} Weekend Price (<?= $currency ?>)</label>
                <input type="text" name="weekend_adult_price[]" class="mdl-textfield__input" placeholder="Weekend Price">
              </div>
            `;
            wrapper.appendChild(fieldWeekend);
            const fieldWeekdays = document.createElement("div");
            fieldWeekdays.classList.add("col-lg-4", "p-t-20");
            fieldWeekdays.innerHTML = `
              <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                <label class="mdl-textfield__label">${label} Weekdays Price (<?= $currency ?>)</label>
                <input type="text" name="weekdays_adult_price[]" class="mdl-textfield__input" placeholder="Weekdays Price">
              </div>
            `;
            wrapper.appendChild(fieldWeekdays);
          }
          adultPriceContainer.appendChild(wrapper);
        }
      }
    }

    if (adultNumber) {
      adultNumber.addEventListener("input", function() {
        adultNumber.value = Math.min(parseInt(adultNumber.value) || 0, 6);
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
