<?php include('admin_head_css.php');?>

<style>
     /*.div_color {*/
     /*       background-color: #f8f8f9;*/
     /*   }*/

        .cuisine-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 5px 10px;
            margin-bottom: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .index {
            margin-right: 10px;
            font-weight: bold;
        }

        .delete-btn-for-cuisine {
            background-color: #dc3545;
            color: white;
            border: none;
            border-radius: 3px;
            padding: 3px 8px;
            cursor: pointer;
        }

        .delete-btn:hover {
            background-color: #c82333;
        }

        #modalAddRestaurant,
        #modalCost-show {
            z-index: 10051;
            /* Ensure this value is higher than the default Bootstrap modal z-index */
        }
        
        .btn.btn-xs {
        font-size: 10px;
        padding: 1px 1px;
        }
        .select2-container{
            z-index: 99999;
        }
        .select2-results__options{
            overflow-x:auto ;
        }
        .select2-selection__rendered{
            display:flex !important;
            flex-wrap: wrap;
        }
        .select2-selection__choice{
            border: solid 1px #aaa;
    border-radius: 11px;
    font-size: 12px;
    padding: 0 5px;
        }
        .select2-selection__choice__remove{
                margin-right: 2px;
    border: none;
    border-radius: 11px;
    font-size: 12px;
    padding: 0 7px;
        }
        span.select2-search.select2-search--inline {
    border: solid 1px #ccc;
    max-width: 300px;
    min-width: 200px;
    padding: 5px;
    border-radius: 6px;
    display: block;
}
.select2-container--open.select2-dropdown {
    left: 0;
    top: 1px;
    border-top: solid 1px #ccc !important;
    border-radius: 5px !important;
}
.select2-dropdown.select2-dropdown--below{
    max-width: 300px;
}
.select2-dropdown.select2-dropdown--above{
    max-width: 300px;
}
.redonly-color{
    background-color:#f5f5f5;
}

  .hidden {
    display: none;
  }
  .show {
    display: block;

.fa-window-close.edit-remove{
        top: 0;
    right: -21px;
}
.div-person-details+.fa-remove {
    color: #fff !important;
    position: absolute !important;
    right: 0 !important;
    background-color: red;
    font-size: 9px;
    min-width: 12px;
    height: 12px;
    text-align: center;
}
.row.div_color{
    border: solid 1px #ccc;
    margin-bottom: 20px;
    padding-bottom: 20px;
    border-radius: 6px;
    background-color: #f6fbff;
    position: relative;
}
.row.div_color .edit-remove{
    position: absolute !important;
    top: 50%;
}
.flight-details_cls{
        padding: 0px 24px 0px 24px;
}
.flight-details_cls .fa-remove {
    position: absolute !important;
    top: 50%;
    right: -4px;
    color: #fff !important;
    background-color: red;
    width: 12px;
    text-align: center;
    font-size: 9px;
    height: 12px;
}
</style>

<div class="modal fade" id="modalCost-show" role="dialog">
    <div class="modal-dialog modal-lg" style="max-width:1150px;border:5px solid #d6deff;">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#eff3f6;">
                <h4 class="modal-title">Costing</h4>
                <button type="button" class="btn-close btn pricing-modal" data-bs-dismiss="modal" id="close-button">&times;</button>
            </div>
            <div class="modal-body">
                <div id="response-message"></div>
                <div class="row">
                    <div class="col-md-6 for-data">
                        <div class="col-md-12">
                            <h5 class="bold center" id="pricing_title" style="background-color: #eff3f6;padding: 7px 7px;">Add Pricing</h5>
                        </div>
                        <div class="col-md-12">
                            <form id="costing-form" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="hdn_arrival_id" value="<?php echo base64_encode($arrivals->id); ?>" />
                                <div class="" id="repeated-form">
                                </div>
                                <div class="col-lg-12 p-t-20 text-center">
                                    <div class="row">
                                        <div class="col-lg-3 text-left ml-4">
                                            <label class=""><strong>Rooms:</strong></label>
                                            <label class=""><strong>Total Price:</strong></label>
                                        </div>
                                        <div class="col-lg-4 text-center p-0">
                                            <label id="rooms" style="margin-right:100px">1</label><br>
                                            <label id="total_label">0.00</label>
                                            <input type="hidden" name="total" id="total_price" required value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 p-t-20 text-center">
                                    <input type="submit" name="submit" id="submit" class="btn m-b-10 m-r-20 btn-pink" value="Submit">
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12">
                                <h5 class="bold center" style="background-color: #eff3f6;padding: 7px 7px;">Costing Details</h5>
                                <div class="row" id="">
                                    <div class="col-sm-2 text-center"><strong>Adult</strong></div>
                                    <div class="col-sm-2 text-center"><strong>Child</strong></div>
                                    <div class="col-sm-3 text-center"><strong>Child Bed</strong></div>
                                    <div class="col-sm-3 text-center"><strong>Breakfast</strong></div>
                                    <div class="col-sm-2 text-center"><strong>Nights</strong></div>
                                </div>
                                <div class="row mt-3" id="costing-data">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <h5 class="bold center" style="background-color: #eff3f6;padding: 7px 7px;">Added Prices</h5>
                                <div class="row">
                                    <div class="col-sm-4 text-center"><strong>Occupancy</strong></div>
                                    <div class="col-sm-4 text-center"><strong>Adult (With Breakfast)</strong></div>
                                    <div class="col-sm-4 text-center" id="child_breakfast_prices"><strong>Child (With Breakfast)</strong></div>
                                </div>
                                <div class="row" id="costing-details">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

<div class="modal fade" id="modalAddRestaurant" role="dialog">
    <div class="modal-dialog modal-lg" style="max-width:1150px;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="title-id">Add Restaurant</h4>
                <button type="button" class="close" data-dismiss="modal" id="close-restaurant">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div id="response-messages" class="text-center"></div>
                        <div id="msgDiv"></div>
                        <form enctype="multipart/form-data" id="form-restaurant" method="post">
                            <?php 
                                if(substr($arrivals->enquiry_abbr,0,1) == 'G' && $arrivals->split_number != 0){
                                    $qry = 'SELECT min(arrival_hotel_details.checkin_date) AS chk_in,max(arrival_hotel_details.checkout_date) AS chk_out FROM `arrival_hotel_details` WHERE arrival_id = '.$arrivals->id;
                                    $qry_result = $this->common_model->custom_query($qry);
                                    if(!empty($qry_result)){
                                        $arrivals->check_in_date = $qry_result[0]->chk_in;
                                        $arrivals->check_out_date = $qry_result[0]->chk_out;
                                    }
                                }
                            ?>
                            <div class="card-body row">
                                <div class="col-lg-4 p-t-20">
                                    <input type="hidden" value="<?php echo $arrivals->id; ?>" name="arrival_ids" id="arrival_ids">
                                    <input type="hidden" value="" id="arrival_restaurant_id">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width ">
                                        <label class="mdl-textfield__label">Date
                                        </label>
                                        <select class="mdl-textfield__input" name="dates" id="dates" required>
                                            <option value="">Select Date
                                                <?php
                                                
                                                $this->db->select('*');
                                                $this->db->from('combo_enquiry');
                                                $this->db->where('combo_enquiry.id', $arrivals->combo_enquiry_id);
                                                $cmb_data = $this->db->get()->result_array();
                                                
                                                // Check if combo_enquiry_id is not null or empty
                                                if (!empty($arrivals->combo_enquiry_id)) {
                                                    // Use combo_enquiry dates if available
                                                    $cmb_checkin = strtotime($cmb_data[0]['check_in_date']);
                                                    $cmb_checkout = strtotime($cmb_data[0]['check_out_date']);
                                                    $start_date = $cmb_checkin;
                                                    $end_date = $cmb_checkout;
                                                } else {
                                                    // Otherwise use arrival dates
                                                    $start_date = strtotime($arrivals->check_in_date);
                                                    $end_date = strtotime($arrivals->check_out_date);
                                                }

                                                while ($start_date <= $end_date) {
                                                ?>
                                            <option value="<?php echo date('Y-m-d', $start_date); ?>">
                                                <?php echo date('d-M-Y', $start_date); ?>
                                            </option>
                                        <?php
                                                    $start_date = strtotime('+1 day', $start_date);
                                                }
                                        ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 p-t-20">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width ">
                                        <label class="mdl-textfield__label">
                                            Buffet</label>
                                        <select class="mdl-textfield__input" name="buffets" id="buffets" required>
                                            <option value="">Select
                                                Buffet</option>
                                            <option value="Breakfast">
                                                Breakfast
                                            </option>
                                            <option value="Lunch">Lunch
                                            </option>
                                            <option value="High-Tea">Sides Or
                                                High Tea</option>
                                            <option value="Early-Dinner">Early-Dinner</option>
                                            <option value="Dinner">Dinner</option>
                                            <option value="Gala-Dinner">Gala-Dinner</option>
                                            <option value="Cocktail-Dinner">Cocktail-Dinner</option>
                                            <option value="Snacks">Snacks</option>
                                            <option value="Evening-Snacks">Evening-Snacks</option>
                                            <option value="Late-Night-Snacks">Late-Night-Snacks</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-4 p-t-20">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width ">
                                        <label class="mdl-textfield__label">Restaurant
                                        </label>
                                        <select class="mdl-textfield__input" name="restaurants" id="restaurants" required>
                                            <option value="">Select Restaurant
                                            </option>
                                            <?php foreach ($res as $r) : ?>
                                                <option value="<?= $r->id; ?>">
                                                    <?= $r->names; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <input type="hidden" value="" name="restaurant_ids" id="restaurant_ids">

                                <div class="col-lg-2 p-t-20">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <label class="mdl-textfield__label">Start Time</label>
                                        <input type="time" id="opening_times" class="mdl-textfield__input" name="opening_times" pattern="([01]?[0-9]|2[0-3]):[0-5][0-9]" placeholder="HH:mm" required maxlength="5">
                                        <!-- <span class="mdl-textfield__error">Please enter a valid
                                                                time in HH:mm format.</span> -->
                                    </div>
                                </div>

                                <div class="col-lg-2 p-t-20">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <label class="mdl-textfield__label">End Time</label>
                                        <input type="time" name="closing_times" pattern="([01]?[0-9]|2[0-3]):[0-5][0-9]" placeholder="HH:mm" required id="closing_times" class="mdl-textfield__input" maxlength="5">
                                        <!-- <span class="mdl-textfield__error">Please enter a valid
                                                                time in HH:mm format.</span>
                                                            <span class="mdl-textfield__error">Closing time must be
                                                                greater than opening time.</span> -->
                                    </div>
                                </div>

                                <div class="col-lg-2 p-t-20" style="margin-top:20px;">
                                    <button type="submit" class="btn btn-primary" id="btn_restaurant">Submit</button>
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

<!---this change-->
<div class="modal fade" id="modalAddRestaurantMenu" role="dialog">
    <div class="modal-dialog modal-lg" style="max-width:1150px;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">All Restaurant</h4>
                <button type="button" class="close" data-dismiss="modal" id="close-button">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div id="msgDiv"></div>

                        <!-- <button type="button" data-toggle="modal" data-target="#modalAddMenu" class="btn-info p-2"
                            style="float:right;cursor:pointer;margin-right:5px;" id="add-menu">Add Menu
                        </button> -->

                        <button type="button" data-toggle="modal" data-dismiss="modal" data-target="#modalAddRestaurant" class="close btn-info p-2" style="float:right;cursor:pointer;margin-right:20px;" id="add-restaurant">
                            Add Restaurant
                        </button>

                        <button type="button" class="btn-info p-1" style="float:right; cursor: pointer; margin-right:20px;" id="refresh-restaurant">
                            <i class="fas fa-sync-alt p-2"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-checkable order-column full-width restaurant-table" id="example1">
                        <thead>
                            <tr>
                                <th class="">Sr.No</th>
                                <th class="center">Date</th>
                                <th class="center" style="padding-left: 40px;">Buffet</th>
                                <th class="center">Start Time</th>
                                <th class="center">End Time</th>
                                <th class="center">Restaurant</th>
                                <th class="center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $records_cnt = 1;
                            if (!empty($menu_result)) {
                                foreach ($menu_result as $item) { ?>
                                    <tr>
                                        <td class="center"><?= $records_cnt++ ?></td>
                                        <td class="center"><?= date('d-M-Y', strtotime($item->date)) ?> </td>
                                        <td class="center"><?= $item->buffet ?></td>
                                        <td class="center"><?= $item->opening_time ?></td>
                                        <td class="center"><?= $item->closing_time ?></td>
                                        <td class="center"><?= $item->names ?></td>
                                        <td class="center">
                                            <a href="#" class="btn btn-xs btn-primary p-1 edit-menu" data-toggle="modal" data-target="#modalUpdateRestaurantMenu" data-arrivalsid="<?= $item->arr_id ?>" data-date="<?= $item->date ?>" data-buffet="<?= $item->buffet ?>" data-restaurant="<?= $item->restaurant_id ?>" data-restaurant_name="<?= $item->names ?>" data-opening="<?= $item->opening_time ?>" data-closing="<?= $item->closing_time ?>" data-person="<?= $item->no_of_person ?>" data-veg="<?= $item->no_of_veg_person ?>" data-non_veg="<?= $item->no_of_non_veg_person ?>" data-vegan="<?= $item->no_of_vegan_person ?>" data-jain="<?= $item->no_of_jain_meal ?>" data-packed="<?= $item->packed ?>" data-final_remark="<?= $item->final_remark ?>" data-veg_remark="<?= $item->veg_remark ?>" data-non_veg_remark="<?= $item->non_veg_remark ?>" data-vegan_remark="<?= $item->vegan_remark ?>" data-jain_meal_remark="<?= $item->jain_meal_remark ?>">
                                                Menu
                                            </a>
                                            <a href="#" class="btn btn-danger btn-xs p-1 delete-menus" data-arrivalsid="<?= $item->arr_id ?>" data-date="<?= $item->date ?>" data-buffet="<?= $item->buffet ?>" data-restaurant="<?= $item->restaurant_id ?>">
                                                Delete
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

<!---this change 2-->
<div class="modal fade" id="modalAddMenu" role="dialog">
    <div class="modal-dialog modal-lg" style="max-width:1150px;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Restaurant Menu</h4>
                <button type="button" class="close" data-dismiss="modal" id="close-button">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div id="msgDiv"></div>

                        <button type="button" data-toggle="modal" data-target="#modalUpdateRestaurantMenu" class="btn-info btn-xs p-2" style="float:right;cursor:pointer;margin-right:5px;" id="add-menu">Add
                        </button>

                        <button type="button" class="btn-info p-2 refresh-menu" style="float:right; cursor: pointer; margin-right:20px;" id="refresh-menu">
                            <i class="fas fa-sync-alt p-2"></i>
                        </button>

                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-scrollable">
                    <table class="table table-hover table-checkable order-column full-width" id="example3">
                        <thead>
                            <tr>
                                <th class="">Sr.No</th>
                                <th class="center">Date</th>
                                <th class="center" style="padding-left: 40px;">Buffet</th>
                                <th class="center">Start Time</th>
                                <th class="center">End Time</th>
                                <th class="center">No of Person</th>
                                <th class="center">Restaurant</th>
                                <th class="center">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="myModaldriver" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add driver</h4>
                <button type="button" class="close close-modal" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body ui-front">
                <div class="row">
                    <div class="col-md-12">
                    <div id="response-message-driver"></div>
                    <form method="post" id="add-form-driver" enctype="multipart/form-data" action="<?= site_url('update-driver-for-arrival') ?>">
                        <input type="hidden" name="arrival_id_driver" value="<?= $arrivals->id ?>">
                        <div class="card-body row">
                            <div class="col-lg-10">
                                    <label class="mdl-textfield__label">Driver</label>
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                    <?= form_input([
                                        'name' => 'driver_name',
                                        'id' => 'driver_name',
                                        'placeholder' => 'Driver',
                                        'class' => 'mdl-textfield__input',
                                        'value' => ''
                                    ]) ?>
                                </div>
                                <input type="hidden" name="driver_id" id="driver_id" value="">
                            </div>

                            <div class="col-lg-2 p-t-20">
                                <button type="submit" class="btn btn-primary" id="btn_driver" data-id="<?= $arrivals->enq_id ?>">Add</button>
                                <button type="button" class="btn-info p-2" style="display: none;" id="refresh-menu-driver">
                                    <i class="fas fa-sync-alt p-2"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-scrollable">
                    <table class="table table-hover driver-table">
                        <thead>
                            <tr>
                                <th class="center">Sr.No</th>
                                <th class="center">Driver Name</th>
                                <th class="center">Driver Number</th>
                                <th class="center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                           
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalUpdateRestaurantMenu" role="dialog">
    <div class="modal-dialog modal-lg" style="max-width:1150px;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="udh4">Add Restaurant Menu</h4>
                <button type="button" id="btn-dismiss" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div id="response-message" class="text-center mt-2"></div>
            <div class="modal-body ui-front">
                <div class="row">
                    <div class="col-md-12">
                        <div id="msgflightDiv"></div>

                        <div class="card-header" id="udch">Add Restaurant Menu</div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div id="msgDiv"></div>
                                    <form enctype="multipart/form-data" id="form-id">
                                        <input type="hidden" value="<?php echo base64_encode($arrivals->id); ?>" name="arr_id" id="arr_id">
                                        <div class="card-body row">

                                            <div class="col-lg-4 p-t-20">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <label class="mdl-textfield__label">Date
                                                    </label>
                                                    <select class="mdl-textfield__input date wow date_id" name="date[]" id="date" required>
                                                        <option value="">Select Date
                                                            <?php
                                                            $start_date = strtotime($arrivals->check_in_date);
                                                            $end_date = strtotime($arrivals->check_out_date);
                                                            while ($start_date <= $end_date) {
                                                            ?>
                                                        <option value="<?php echo date('Y-m-d', $start_date); ?>">
                                                            <?php echo date('d-M-Y', $start_date); ?>
                                                        </option>
                                                    <?php
                                                                $start_date = strtotime('+1 day', $start_date);
                                                            }
                                                    ?>
                                                    </select>
                                                    
                                                </div>
                                            </div>
                                            <div class="col-lg-4 p-t-20">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <label class="mdl-textfield__label">
                                                        Buffet</label>
                                                    <select class="mdl-textfield__input wow buffet_id" name="buffet[]" id="buffet" required>
                                                        <option value="">Select
                                                            Buffet</option>
                                                        <option value="Breakfast">
                                                            Breakfast
                                                        </option>
                                                        <option value="Lunch">Lunch
                                                        </option>
                                                        <option value="High-Tea">Sides Or
                                                            High-Tea</option>
                                                        <option value="Early-Dinner">Early-Dinner</option>
                                                        <option value="Dinner">Dinner</option>
                                                        <option value="Gala-Dinner">Gala-Dinner</option>
                                                        <option value="Cocktail-Dinner">Cocktail-Dinner</option>
                                                        <option value="Snacks">Snacks</option>
                                                        <option value="Evening-Snacks">Evening-Snacks</option>
                                                        <option value="Late-Night-Snacks">Late-Night-Snacks</option>
                                                    </select>
                                                    
                                                </div>
                                            </div>
                                            <div class="col-lg-4 p-t-20">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <label class="mdl-textfield__label">Restaurant
                                                    </label>
                                                    <select class="mdl-textfield__input wow " name="restaurant[]" id="restaurant" required>
                                                        <option value="">Select Restaurant
                                                        </option>
                                                        <?php if (!empty($restaurants_data)) {
                                                            foreach ($restaurants_data as $r) : ?>
                                                                <option value="<?= $r->restaurant_id; ?>">
                                                                    <?= $r->names; ?>
                                                                </option>
                                                        <?php endforeach;
                                                        } ?>
                                                    </select>
                                                    
                                                </div>
                                            </div>

                                            <div class="col-lg-2 p-t-20">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                  <label class="mdl-textfield__label">Start Time</label>
                                                    <input type="time" id="opening_time" class="mdl-textfield__input wow opening_time" name="opening_time[]" pattern="([01]?[0-9]|2[0-3]):[0-5][0-9]" placeholder="HH:mm" required maxlength="5">
                                                    <!-- <span class="mdl-textfield__error">Please enter a valid
                                                                time in HH:mm format.</span> -->
                                                </div>
                                            </div>

                                            <div class="col-lg-2 p-t-20">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <label class="mdl-textfield__label">End Time</label>
                                                    <input type="time" name="closing_time[]" pattern="([01]?[0-9]|2[0-3]):[0-5][0-9]" placeholder="HH:mm" required id="closing_time" class="mdl-textfield__input wow closing_time" maxlength="5">
                                                    <!-- <span class="mdl-textfield__error">Please enter a valid
                                                                time in HH:mm format.</span>
                                                            <span class="mdl-textfield__error">Closing time must be
                                                                greater than opening time.</span> -->
                                                </div>
                                            </div>

                                            <div class="col-lg-2 p-t-20">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <label class="mdl-textfield__label">No. of Person
                                                    </label>
                                                    <input type="text" name="no_of_person[]" id="no_of_person" class="mdl-textfield__input wow" value="" required>
                                                </div>
                                            </div>

                                            <div class="col-lg-2 p-t-20">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <label class="mdl-textfield__label">No. of Veg Person
                                                    </label>
                                                    <input type="text" name="no_of_veg_person[]" id="no_of_veg_person" class="mdl-textfield__input wow" value="">
                                                </div>
                                            </div>

                                            <div class="col-lg-2 p-t-20">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <label class="mdl-textfield__label">No. of Non-Veg
                                                        Person
                                                    </label>
                                                    <input type="text" name="no_of_non_veg_person[]" id="no_of_non_veg_person" class="mdl-textfield__input wow" value="">
                                                </div>
                                            </div>

                                            <div class="col-lg-2 p-t-20">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <label class="mdl-textfield__label">No. of Vegan Person
                                                    </label>
                                                    <input type="text" name="no_of_vegan_person[]" id="no_of_vegan_person" class="mdl-textfield__input wow" value="">
                                                </div>
                                            </div>

                                            <div class="col-lg-2 p-t-20">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <label class="mdl-textfield__label">No. of Jain Meal
                                                    </label>
                                                    <input type="text" name="no_of_jain_meal[]" id="no_of_jain_meal" class="mdl-textfield__input wow" value="">
                                                </div>
                                            </div>

                                            <div class="col-lg-4 p-t-20">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <label class="mdl-textfield__label" for="cuisine_type">Meal
                                                        Type</label>
                                                    <select class="mdl-textfield__input" name="meal_cuisine_type[]" id="meal_cuisine_type" required>
                                                        <option value="" disabled selected>Select Meal Type
                                                        </option>
                                                        <?php foreach ($meals as $meal) : ?>
                                                            <option value="<?= $meal->id ?>">
                                                                <?= ucwords(str_replace('-', ' ', $meal->meals)) ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 p-t-20">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <label class="mdl-textfield__label">Menu Type
                                                    </label>
                                                    <select class="mdl-textfield__input wow" name="meal_type[]" id="meal_type" required>
                                                        <option value="">Select Meal
                                                            Type</option>
                                                        <?php foreach ($menus as $menu) : ?>
                                                            <option value="<?= $menu->id ?>">
                                                                <?= str_replace('_', ' ', strtoupper($menu->menu_type)) ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>

                                                </div>
                                            </div>
                                            <div class="col-lg-2 p-t-20">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <label class="mdl-textfield__label">
                                                        Cuisine type</label>
                                                    <select class="mdl-textfield__input wow" name="cuisine_type[]" id="cuisine_type" required>
                                                        <option value="">Select
                                                            Cuisine Type</option>
                                                        <option value="veg">
                                                            Veg
                                                        </option>
                                                        <option value="non_veg">
                                                            Non-Veg
                                                        </option>
                                                        <option value="vegan">
                                                            Vegan</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <!--    <div class="col-lg-2 p-t-20">-->
                                            <!--        <div-->
                                            <!--            class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">-->
                                            <!--            <input type="text" name="veg_remark"-->
                                            <!--                id="veg_remark" class="mdl-textfield__input wow"-->
                                            <!--                value="">-->
                                            <!--            <label class="mdl-textfield__label">Veg Person Remark-->
                                            <!--            </label>-->
                                            <!--        </div>-->
                                            <!--    </div>-->

                                            <!--<div class="col-lg-2 p-t-20">-->
                                            <!--        <div-->
                                            <!--            class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">-->
                                            <!--            <input type="text" name="non_veg_remark"-->
                                            <!--                id="non_veg_remark" class="mdl-textfield__input wow"-->
                                            <!--                value="">-->
                                            <!--            <label class="mdl-textfield__label">Non-Veg Remark-->
                                            <!--            </label>-->
                                            <!--        </div>-->
                                            <!--    </div>-->

                                            <!--<div class="col-lg-2 p-t-20">-->
                                            <!--        <div-->
                                            <!--            class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">-->
                                            <!--            <input type="text" name="vegan_remark"-->
                                            <!--                id="vegan_remark" class="mdl-textfield__input wow"-->
                                            <!--                value="">-->
                                            <!--            <label class="mdl-textfield__label">Vegan Remark-->
                                            <!--            </label>-->
                                            <!--        </div>-->
                                            <!--    </div>-->
                                            <!--<div class="col-lg-2 p-t-20">-->
                                            <!--        <div-->
                                            <!--            class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">-->
                                            <!--            <input type="text" name="jain_meal_remark" id="jain_meal_remark"-->
                                            <!--                class="mdl-textfield__input wow" value="">-->
                                            <!--            <label class="mdl-textfield__label">Jain Meal Remark-->
                                            <!--            </label>-->
                                            <!--        </div>-->
                                            <!--    </div>    -->

                                            <div class="col-lg-11 p-t-20">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <label class="mdl-textfield__label">Final Remark
                                                    </label>
                                                    <input type="text" name="final_remark" id="final_remark" class="mdl-textfield__input wow" value="">
                                                </div>
                                            </div>

                                            <div class="col-lg-1 p-t-20">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <label class="mdl-textfield__label">Packed
                                                    </label>
                                                    <input type="checkbox" name="packed" id="packed" class="mdl-textfield__input wow">
                                                </div>
                                            </div>


                                        </div>

                                        <div class="modal-body" style="padding:10px 26px;">
                                            <div class="row">
                                                <div class="col-lg-8 p-t-20">
                                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                        <?php
                                                        //echo form_input(['name' => 'cuisine_field', 'id' => 'cuisine_field', 'placeholder' => 'Search Cuisine', 'class' => 'mdl-textfield__input', 'value' => '', 'readonly' => 'readonly']);
                                                        ?>
                                                       
                                                        <select name="cuisine_field[]" id="cuisine_field"
                                                            class="form-control js-example-basic-multi"
                                                            multiple style="padding: 10px; width: 100%;">
                                                        </select>

                                                        <button type="button" class="btn-info p-2 mt-2 add-item-btn" style="float:right; cursor: pointer; margin-left:20px;" id="">
                                                            Add >>
                                                        </button>
                                                    </div>
                                                    <div id="msg"></div>
                                                    <!--div class="table-scrollable table-wrapper">
                                                        <table
                                                            class="table table-hover table-checkable order-column full-width example_table"
                                                            id="example4">
                                                            <thead>
                                                                <tr>
                                                                    <th class="center">Sr.No</th>
                                                                    <th class="center">Cuisine</th>
                                                                    <th class="center">Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody class="tbody">
                                                            </tbody>
                                                        </table>
                                                    </div-->
                                                </div>
                                                <div class="col-lg-4 p-t-20 last" style="border: 1px solid #ccc; padding: 10px; display: inline-block; min-width: 200px; min-height: 100px;">
                                                    <!-- Your content here -->
                                                </div>

                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-lg-11"></div>

                                            <div class="col-lg-1 p-t-20">
                                                <button type="sumit" class="btn btn-primary" id="btn_company">Submit</button>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="myModalhotel" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Hotel</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div id="msgDiv"></div>
                        <form method="post" id="frm_hotel">
                            <div class="card-body row">
                                <div class="col-lg-6 p-t-20">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <?php echo form_input(['name' => 'hotel_name', 'id' => 'hotel_name', 'placeholder' => 'Name', 'required' => 'required', 'class' => 'mdl-textfield__input', 'value' => '']) ?>
                                        <label class="mdl-textfield__label">Hotel Name</label>
                                    </div>
                                </div>

                                <div class="col-lg-6 p-t-20">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <select name="category" class="mdl-textfield__input" style="padding-top:13px;">
                                            <?php for ($i = 1; $i <= 6; $i++) { ?>
                                                <option value="<?= $i ?>"><?= $i ?> Star</option>
                                            <?php } ?>
                                        </select>
                                        <label class="mdl-textfield__label">Hotel Category</label>
                                    </div>
                                </div>

                                <div class="col-lg-6 p-t-20">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <?php echo form_input(['name' => 'person_name', 'id' => 'person_name', 'placeholder' => 'Contact Person Name', 'required' => 'required', 'class' => 'mdl-textfield__input', 'value' => '']) ?>
                                        <label class="mdl-textfield__label">Contact Person Name</label>
                                    </div>
                                </div>

                                <div class="col-lg-6 p-t-20">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <?php echo form_input(['name' => 'hotel_email', 'placeholder' => 'Email Address', 'type' => 'email', 'id' => 'hotel_email', 'required' => 'required', 'class' => 'mdl-textfield__input', 'value' => '']) ?>
                                        <label class="mdl-textfield__label">Email Address</label>
                                    </div>
                                </div>

                                <div class="col-lg-2 p-t-20">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <select name="isd_codes" class="mdl-textfield__input" style="padding-top:13px;">
                                            <?php
                                            $char = substr($arrivals->enquiry_abbr, 1, 1);
                                            $selected = '+91';
                                            if ($char == 'K') {
                                                $selected = 'KZ';
                                            } else if ($char == 'A') {
                                                $selected = 'AZ';
                                            } else if ($char == 'B') {
                                                $selected = 'BY';
                                            }
                                            //$allowed_countries = ['AZ','BY','IN','KZ'];
                                            foreach ($country_isd_codes as $list) {
                                            ?>
                                                <option value="<?= $list->isd_codes ?>" <?php echo ($list->country_code == $selected) ? 'selected' : ''; ?>>
                                                    <?= $list->isd_codes . ' (' . $list->country . ')'; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                        <label class="mdl-textfield__label">ISD Code</label>
                                    </div>
                                </div>

                                <div class="col-lg-4 p-t-20">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <?php echo form_input(['name' => 'contact_number', 'id' => 'contact_number', 'placeholder' => 'Contact Number', 'required' => 'required', 'type' => 'number', 'class' => 'mdl-textfield__input', 'value' => '']) ?>
                                        <label class="mdl-textfield__label">Contact Number</label>
                                    </div>
                                </div>

                                <div class="col-lg-3 p-t-20">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <textarea class="mdl-textfield__input" id="address_1" name="address_1" required> </textarea>
                                        <label class="mdl-textfield__label">Address 1</label>
                                    </div>
                                </div>

                                <div class="col-lg-3 p-t-20">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <textarea class="mdl-textfield__input" id="address_2" name="address_2"> </textarea>
                                        <label class="mdl-textfield__label">Address 2</label>
                                    </div>
                                </div>

                                <div class="col-lg-6 p-t-20">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">

                                        <?php echo form_input(['name' => 'country', 'id' => 'country', 'placeholder' => 'Country', 'required' => 'required', 'class' => 'mdl-textfield__input', 'value' => '']) ?>
                                        <label class="mdl-textfield__label">Select Country</label>
                                    </div>
                                </div>
                                <input type="hidden" name="country_id" id="country_id" value="">

                                <div class="col-lg-6 p-t-20">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">

                                        <?php echo form_input(['name' => 'state', 'id' => 'state', 'placeholder' => 'State', 'class' => 'mdl-textfield__input', 'value' => set_value('state')]) ?>
                                        <label class="mdl-textfield__label">State</label>
                                    </div>
                                </div>
                                <input type="hidden" name="state_id" id="state_id" value="">

                                <div class="col-lg-6 p-t-20">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">

                                        <?php echo form_input(['name' => 'city', 'id' => 'city', 'placeholder' => 'City', 'class' => 'mdl-textfield__input', 'value' => set_value('city')]) ?>
                                        <label class="mdl-textfield__label">City</label>
                                    </div>
                                </div>

                                <div class="col-lg-6 p-t-20">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <?php echo form_input(['name' => 'pincode', 'id' => 'pincode', 'placeholder' => 'Pincode', 'class' => 'mdl-textfield__input', 'value' => set_value('pincode')]) ?>
                                        <label class="mdl-textfield__label">Pincode</label>
                                    </div>
                                </div>

                                <div class="col-lg-6 p-t-20">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <textarea class="mdl-textfield__input" id="remarks" name="remarks"> </textarea>
                                        <label class="mdl-textfield__label">Remarks</label>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btn_hotel">Submit</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="myModalAddTransportation" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Transportation</h4>
                <button type="button" class="close close-modal" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body ui-front">
                <div class="row">
                    <div class="col-md-12">
                        <div id="response-message"></div>
                        <form method="post" id="add-enquiry-transportation-form" enctype="multipart/form-data">
                            <div class="card-body row">
                                <input type="hidden" name="enquiry_id" value="<?= $arrivals->enq_id ?>">
                                <input type="hidden" name="arrival_id" value="<?= $arrivals->id ?>">
                                <div class="col-lg-4">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <label class="mdl-textfield__label">Transportation</label>
                                        <?php
                                        echo form_input(['name' => 'transportation', 'id' => 'transportation', 'placeholder' => 'Transportation', 'class' => 'mdl-textfield__input', 'value' => '', 'required' => 'required']);
                                        ?>
                                    </div>
                                </div>
                                <input type="hidden" name="transportation_id" id="transportation_id" value="">

                                <div class="col-lg-1 p-t-20">
                                    &#10005;
                                </div>

                                <div class="col-lg-2">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <label class="mdl-textfield__label">Quantity</label>
                                        <?php echo form_input(['name' => 'capacity', 'id' => 'capacity', 'placeholder' => '', 'class' => 'mdl-textfield__input', 'value' => '', 'pattern' => '[0-9]*', 'title' => 'Please enter only numeric values', 'required' => 'required']) ?>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <label class="mdl-textfield__label">Luggage Vehicle</label>
                                        <input name="luggage_vehicle" id="luggage_vehicle" type="checkbox">
                                    </div>
                                </div>
                                <div class="col-lg-2  p-t-20">
                                    <button type="submit" class="btn btn-primary" id="add-btn-transportation" data-id="<?= $arrivals->enq_id ?>">Add</button>

                                    <button type="button" class="btn-info p-2" style="display: none;" id="refresh-menu-transport">
                                        <i class="fas fa-sync-alt p-2"></i>
                                    </button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-scrollable">
                    <table class="table table-hover table-checkable order-column full-width transport-table" id="example4">
                        <thead>
                            <tr>
                                <th class="center">Sr.No</th>
                                <th class="center">Tranportation Vehicle</th>
                                <th class="center">Vehicle Type</th>
                                <th class="center">Quantity</th>
                                <th class="center">Luggage Vehicle</th>
                                <th class="center">City</th>
                                <th class="center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Table body content -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="myModalguide" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Guide</h4>
                <button type="button" class="close close-modal" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body ui-front">
                <div class="row">
                    <div class="col-md-12">
                        <div id="response-message-guide"></div>
                        <div id="msgDivguide"></div>
                        <form method="post" id="add-form-guide" enctype="multipart/form-data">
                            <input type="hidden" name="enquiry_g_id" value="<?= $arrivals->enq_id ?>">
                            <input type="hidden" name="arrival_g_id" value="<?= $arrivals->id ?>">
                            <div class="card-body row">
                                <div class="col-lg-10">
                                        <label class="mdl-textfield__label">Guide</label>
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <?php
                                        echo form_input(['name' => 'guide', 'id' => 'guide', 'placeholder' => 'Guide', 'class' => 'mdl-textfield__input', 'value' => '']);
                                        ?>
                                    </div>
                                </div>
                                <input type="hidden" name="guide_id" id="guide_id" value="">

                                <div class="col-lg-2 p-t-20">
                                    <button type="submit" class="btn btn-primary" id="btn_guide" data-id="<?= $arrivals->enq_id ?>">Add</button>
                                    <button type="button" class="btn-info p-2" style="display: none;" id="refresh-menu-guide">
                                        <i class="fas fa-sync-alt p-2"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-scrollable">
                    <table class="table table-hover table-checkable order-column full-width guide-table" id="example4">
                        <thead>
                            <tr>
                                <th class="center">Sr.No</th>
                                <th class="center">Guide Name</th>
                                <th class="center">Guide Contact Number</th>
                                <th class="center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Table body content -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="myModalrooms" role="dialog">
    <div class="modal-dialog modal-lg" style="max-width:95%;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit / Create Rooming List</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body ui-front">
                <div class="row">
                    <div class="col-md-4"><select class="mdl-textfield__input" id="roominglist_hotels"></select>
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-md-12">
                        <div id="msgDivroom"></div>
                        <form method="post" id="frm_roomdetails" onsubmit="formSubmitRooms()">

                            <div class="card-body" style="background-color:#fbfbfb;">
                                <?php if (!empty($arrival_room)) {
                                    foreach ($arrival_room as $list) {
                                ?>

                                        <div class="row">
                                            <div class="col-lg-7" style="background-color:#f1efeb;padding:4px 15px;">
                                                <input type="radio" name="rdo_list" class="rdo-select" checked="checked">
                                                <label class="card-header" style="padding:0.10rem 1.0rem;font-weight: 500;background-color: #ffffff !important;"><?php echo $list->hotel_name; ?></label>
                                            </div>

                                            <div class="col-lg-1" style="background-color:#f1efeb;padding:4px 15px;text-align:right;">

                                                <?php if ($list->category_id != 0) {
                                                    $checkin_date = new DateTime($list->checkin_date);
                                                    $checkout_date = new DateTime($list->checkout_date);

                                                    // Calculate the difference
                                                    $interval = $checkin_date->diff($checkout_date);
                                                    $nightDifference = $interval->days;
                                                    $allowed_ids = ['33','14','13','8'];
                                                ?>
                                                                
                                                    <button type="button" data-bs-dismiss="modal" class="close btn btn-sm btn-primary costing <?php echo (!in_array($this->session->userdata('id'),$allowed_ids))?'hide':''; ?>" data-file="<?= $list->enquiry_abbr ?>" data-rooms="<?= $list->number_of_rooms ?>" data-breakfast="<?php echo $list->breakfast ?>" data-adults="<?php echo $list->number_adults ?>" data-childs="<?php echo $list->number_child ?>" data-hotel_id="<?= $list->hotel_id ?>" data-category_id="<?= $list->category_id ?>" data-checkin="<?= $list->checkin_date ?>" data-checkout="<?= $list->checkout_date ?>" data-nights="<?= $nightDifference ?>">Costing</button>
                                                <?php } ?>
                                            </div>

                                            <div class="col-lg-4" style="background-color:#f1efeb;text-align:right;">
                                                <label class="" style="font-weight: 400;">Hotel Confirmation Number
                                                    : </label>
                                                <input type="text" name="edit_confirmation_number[]" autocomplete="off" placeholder="" id="" value="<?php echo isset($list->hotel_confirmation_num) ? $list->hotel_confirmation_num : ''; ?>" class="" required="">
                                            </div>
                                            <input type="hidden" name="edit_hotel_details_ids[]" class="hotel-details-ids" value="<?php echo $list->hotel_id; ?>">
                                            <input type="hidden" name="edit_arrival_hotel_details_ids[]" class="arrival-hotel-details-ids" value="<?php echo $list->arrival_hotel_details_id; ?>">

                                            <!--div class="col-lg-2 p-t-20"> 
                <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
            <input type="text" name="edit_hotel_names[]" value="<?php //echo $list->hotel_name; 
                                                                ?>" placeholder="" id="" class="mdl-textfield__input hotel-names" required>
            <label class = "mdl-textfield__label">Hotel</label>
            </div>
            <input type="hidden" name="edit_hotel_ids[]" value="<?php //echo $list->hotel_id; 
                                                                ?>" class="hotel-ids">
            </div-->

                                            <!--div class="col-lg-2 p-t-20"> 
                <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
            <input type="date" name="edit_physical_arrival_date[]" placeholder="" id="" value="<?php //echo $list->physical_arrival_date; 
                                                                                                ?>" class="mdl-textfield__input" required>
            <label class = "mdl-textfield__label">Physical Arrival Date</label>
            </div>
            </div-->

                                            <div class="col-lg-2 p-t-20">
                                                    <label class="mdl-textfield__label">Check-in Date</label>
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width" style="display:inline-flex;">
                                                    <input type="text" name="" class="mdl-textfield__input dt-dateformat-rooms-show" value="<?php echo ($list->checkin_date <> '') ? date('d-M-Y', strtotime($list->checkin_date)) : ''; ?>" style="width:100%;" readonly>
                                                    <input type="date" name="edit_rooms_check_in[]" value="<?php echo $list->checkin_date; ?>" placeholder="" id="" class="dt-room check-in dt-dateformat-rooms" data-operator="plus" required style="width:17px;float:right;position: absolute; right: 5%; border: none; background-color: transparent; top: 50%; transform: translateY(-50%);">
                                                </div>
                                            </div>
                                            <input type="hidden" name="edit_roomdetails[]" value="<?= $list->id ?>" />
                                            <div class="col-lg-2 p-t-20">
                                                    <label class="mdl-textfield__label">Check-out Date</label>
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width" style="display:inline-flex;">
                                                    <input type="text" name="" class="mdl-textfield__input dt-dateformat-rooms-show" value="<?php echo ($list->checkout_date <> '') ? date('d-M-Y', strtotime($list->checkout_date)) : ''; ?>" style="width:100%;" readonly>
                                                    <input type="date" name="edit_rooms_check_out[]" value="<?php echo $list->checkout_date; ?>" placeholder="" id="" class="dt-room check-out dt-dateformat-rooms" data-operator="minus" required style="width:17px;float:right;position: absolute; right: 5%; border: none; background-color: transparent; top: 50%; transform: translateY(-50%);">
                                                </div>
                                            </div>

                                            <div class="col-lg-2 p-t-20">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <label class="mdl-textfield__label">Category</label>
                                                    <select name="edit_room_category[]" id="room_category_select" class="mdl-textfield__input room-category" style="padding:8px;" required>

                                                        <?php
                                                        /*$adult_max = $child_max = $child_bed = '';
                                                        foreach($hotel_room_categories AS $room_list){ 
                                                                if($room_list->category_name==$list->category){
                                                                    $adult_max = $room_list->number_adults;
                                                                    $child_max = $room_list->number_childs;
                                                                    $child_bed = $room_list->child_bed;
                                                                }*/
                                                        $adult_max = (!empty($list->number_adults)) ? $list->number_adults : '';
                                                        $child_max = (!empty($list->number_childs)) ? $list->number_childs : '';
                                                        $child_bed = (!empty($list->child_bed)) ? $list->child_bed : '';
                                                        ?>
                                                        <option value="<?php echo $list->category . '_' . $list->category_id; ?>" data-adults="<?php //echo $room_list->number_adults; 
                                                                                                                                                ?>" data-childs="<?php //echo $room_list->number_childs; 
                                                                                                                                                                    ?>" data-childbed="<?php //echo $room_list->child_bed; 
                                                                                                                                                                                        ?>">
                                                            <?php echo $list->category; ?>
                                                        </option>
                                                        <?php //} 
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <input type="hidden" id="room_category_id" name="room_category_id[]" value="<?php echo $list->category_id; ?>">

                                            <div class="col-lg-1 p-t-20">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <label class="mdl-textfield__label">Adults</label>
                                                    <?php echo form_input(['type' => 'number', 'name' => 'edit_number_adults[]', 'id' => '', 'placeholder' => 'Adults', 'required' => 'required', 'class' => 'mdl-textfield__input room-adults', 'value' => $list->number_adults, 'max' => $adult_max, 'readonly' => 'readonly']) ?>
                                                </div>
                                            </div>

                                            <div class="col-lg-1 p-t-20">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <label class="mdl-textfield__label">Childs/Infants</label>
                                                    <?php echo form_input(['type' => 'number', 'name' => 'edit_number_child[]', 'id' => '', 'placeholder' => 'Childs/Infants', 'required' => 'required', 'class' => 'mdl-textfield__input room-childs', 'value' => $list->number_child, 'max' => $child_max, 'readonly' => 'readonly']) ?>
                                                </div>

                                            </div>

                                            <div class="col-lg-1 p-t-20">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <label class="mdl-textfield__label">Child Bed</label>
                                                    <select name="edit_child_bed[]" class="mdl-textfield__input room-childbed" style="padding:8px;" required>
                                                        <option value="N/A">N/A</option>
                                                        <option value="<?php echo $child_bed; ?>">
                                                            <?php echo $child_bed; ?>
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>

                                            <?php $first_character = substr($arrivals->enquiry_no, 0, 1);
                                            if ($first_character == 'G') {
                                            ?>
                                                <div class="col-lg-1 p-t-20">
                                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                        <label class="mdl-textfield__label">No. Of Rooms</label>
                                                        <?php echo form_input(['type' => 'number', 'name' => 'edit_number_rooms[]', 'id' => '', 'placeholder' => 'Number Of Rooms', 'class' => 'mdl-textfield__input', 'value' => $list->number_of_rooms, 'min' => '1']) ?>
                                                    </div>
                                                </div>
                                            <?php } ?>

                                            <div class="col-lg-2 p-t-20">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <label class="mdl-textfield__label">Breakfast Included</label>
                                                    <select name="edit_breakfast[]" class="mdl-textfield__input" style="padding:8px;" required>
                                                        <option value="yes" <?php echo ($list->breakfast == 'yes') ? 'selected="selected"' : ''; ?>>
                                                            Yes</option>
                                                        <option value="no" <?php echo ($list->breakfast == 'no') ? 'selected="selected"' : ''; ?>>
                                                            No</option>
                                                    </select>
                                                </div>
                                                <i title="Remove" class="fa fa-window-close edit-remove" style="color:red;cursor: pointer;float: right;margin-top: -15px;position:relative;" data-id="<?= $list->id ?>" data-module="room_details"></i>
                                            </div>

                                            <div class="mt-2 container-fluid div-person-details" style="background-color:#f5fbff;padding: 0 15px;">
                                                <?php if (array_key_exists($list->id, $arrival_persons)) {
                                                    foreach ($arrival_persons[$list->id] as $persons_list) { ?>

                                                        <input type="hidden" name="edit_person_details[]" value="<?php echo $persons_list->id; ?>" />
                                                        <div class="row">
                                                            <div class="col-lg-1">
                                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                                    <label class="mdl-textfield__label">First Name</label>
                                                                    <input type="text" name="edit_first_name[]" placeholder="" id="" value="<?= $persons_list->first_name ?>" class="mdl-textfield__input" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                                    <label class="mdl-textfield__label">Last Name</label>
                                                                    <input type="text" name="edit_last_name[]" placeholder="" id="" value="<?= $persons_list->last_name ?>" class="mdl-textfield__input" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                                    <label class="mdl-textfield__label">Category</label>
                                                                    <select name="edit_person_category[]" class="mdl-textfield__input person-category" style="padding:8px;" required>
                                                                        <option value="adult" <?php echo ($persons_list->category == 'adult') ? 'selected="selected"' : ''; ?>>
                                                                            Adult</option>
                                                                        <option value="child" <?php echo ($persons_list->category == 'child') ? 'selected="selected"' : ''; ?>>
                                                                            Child</option>
                                                                        <option value="infant" <?php echo ($persons_list->category == 'infant') ? 'selected="selected"' : ''; ?>>
                                                                            Infant</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-1">
                                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                                    <label class="mdl-textfield__label">Age</label>
                                                                    <select name="edit_age[]" class="mdl-textfield__input child-age" style="padding:8px;">
                                                                        <option value="<?php echo $persons_list->age; ?>">
                                                                            <?php echo $persons_list->age; ?>
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-2">
                                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                                    <label class="mdl-textfield__label">Passport No.</label>
                                                                    <input type="text" name="edit_passport_number[]" placeholder="" id="" value="<?php echo $persons_list->passport_number; ?>" class="mdl-textfield__input" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                                    <label class="mdl-textfield__label">Nationality</label>
                                                                    <input type="text" name="edit_nationality[]" placeholder="" id="" value="<?php echo $persons_list->nationality; ?>" class="mdl-textfield__input" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-2">
                                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                                    <label class="mdl-textfield__label">Smoking</label>
                                                                    <select name="edit_smoking[]" class="mdl-textfield__input" style="padding:8px;" required>
                                                                        <option value="smoking" <?php echo ($persons_list->smoking_status == 'smoking') ? 'selected="selected"' : ''; ?>>
                                                                            Smoking</option>
                                                                        <option value="non-smoking" <?php echo ($persons_list->smoking_status == 'non-smoking') ? 'selected="selected"' : ''; ?>>
                                                                            Non-smoking</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-1">
                                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                                    <label class="mdl-textfield__label">Meals</label>
                                                                    <select name="edit_meals[]" class="mdl-textfield__input" style="padding:8px;" required>
                                                                        <option value="veg" <?php echo ($persons_list->meals == 'veg') ? 'selected="selected"' : ''; ?>>
                                                                            Veg</option>
                                                                        <option value="non-veg" <?php echo ($persons_list->meals == 'non-veg') ? 'selected="selected"' : ''; ?>>
                                                                            Non-veg</option>
                                                                        <option value="other" <?php echo ($persons_list->meals == 'other') ? 'selected="selected"' : ''; ?>>
                                                                            Other</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-2">
                                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                                    <label class="mdl-textfield__label">Remarks</label>
                                                                    <input type="text" name="edit_remarks[]" placeholder="" id="" value="<?php echo $persons_list->remarks; ?>" class="mdl-textfield__input">
                                                                </div>
                                                            </div>
                                                        </div>

                                                    <?php } ?>
                                                    <button class="btn btn-xs add-person-details" style="float:right;background-color: #ffffff;border: 0;"></button>
                                                <?php } ?>
                                            </div>
                                        </div>

                                <?php }
                                } ?>
                            </div>

                            <div class="card-body room-details_cls position-relative" id="room-details">
                                <div class="row">
                                    <div class="col-lg-6" style="background-color:#f1efeb;padding:7px 15px;">
                                        <input type="radio" name="rdo_list" class="rdo-select" checked="checked">
                                    </div>
                                    <div class="col-lg-6" style="background-color:#f1efeb;text-align:right;">
                                        <label class="" style="font-weight: 400;">Hotel Confirmation Number
                                            : </label>
                                        <input type="text" name="confirmation_number[]" autocomplete="off" placeholder="" id="" value="" class="">
                                    </div>
                                </div>
                                <div class="row">
                                    <!--div class="col-lg-2 p-t-20"> 
                <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
            <input type="text" name="hotel_names[]" value="" placeholder="" id="" class="mdl-textfield__input hotel-names" >
            <label class = "mdl-textfield__label">Hotel</label>
            </div>
            <input type="hidden" name="hotel_ids[]" class="hotel-ids">
            </div-->
                                    <input type="hidden" name="hotel_details_ids[]" class="hotel-details-ids">
                                    <input type="hidden" name="arrival_hotel_details_ids[]" class="arrival-hotel-details-ids">
                                    <!--div class="col-lg-2 p-t-20"> 
                <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
            <input type="date" name="physical_arrival_date[]" placeholder="" id="" value="" class="mdl-textfield__input">
            <label class = "mdl-textfield__label">Physical Arrival Date</label>
            </div>
            </div-->

                                    <div class="col-lg-2 p-t-20">
                                            <label class="mdl-textfield__label">Check-in Date</label>
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width" style="display:inline-flex;">
                                            <input type="text" name="" class="mdl-textfield__input dt-dateformat-rooms-show" value="" style="width:100%;" readonly>
                                            <input type="date" name="rooms_check_in[]" value="" placeholder="" id="" class="dt-room check-in dt-dateformat-rooms" data-operator="plus" style="width:17px;float:right;position: absolute; right: 5%; border: none; background-color: transparent; top: 50%; transform: translateY(-50%);">
                                        </div>
                                    </div>

                                    <div class="col-lg-2 p-t-20">
                                            <label class="mdl-textfield__label">Check-out Date</label>
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width" style="display:inline-flex;">
                                            <input type="text" name="" class="mdl-textfield__input dt-dateformat-rooms-show" value="" style="width:100%;" readonly>
                                            <input type="date" name="rooms_check_out[]" value="" placeholder="" id="" class="dt-room check-out dt-dateformat-rooms" data-operator="minus" style="width:17px;float:right;position: absolute; right: 5%; border: none; background-color: transparent; top: 50%; transform: translateY(-50%);">
                                        </div>
                                    </div>

                                    <div class="col-lg-2 p-t-20">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <label class="mdl-textfield__label">Category</label>
                                            <select name="room_category[]" id="room_category_select" class="mdl-textfield__input room-category" style="padding:8px;">

                                            </select>
                                        </div>
                                    </div>
                                    <input type="hidden" id="room_category_id" name="room_category_id[]" value="">

                                    <div class="col-lg-1 p-t-20">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <label class="mdl-textfield__label">Adults</label>
                                            <?php echo form_input(['type' => 'number', 'name' => 'number_adults[]', 'id' => '', 'placeholder' => 'Adults', 'class' => 'mdl-textfield__input room-adults', 'value' => '']) ?>
                                        </div>
                                    </div>

                                    <div class="col-lg-1 p-t-20">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <label class="mdl-textfield__label">Childs/Infants</label>
                                            <?php echo form_input(['type' => 'number', 'name' => 'number_child[]', 'id' => '', 'placeholder' => 'Childs/Infants', 'class' => 'mdl-textfield__input room-childs', 'value' => '']) ?>
                                        </div>
                                    </div>

                                    <div class="col-lg-1 p-t-20">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width is-focused">
                                            <label class="mdl-textfield__label">Child Bed</label>
                                            <select name="child_bed[]" class="mdl-textfield__input room-childbed" style="padding:8px;">

                                            </select>
                                        </div>
                                    </div>
                                    <?php $first_character = substr($arrivals->enquiry_no, 0, 1);
                                    if ($first_character == 'G') {
                                    ?>
                                        <div class="col-lg-1 p-t-20">
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <label class="mdl-textfield__label">No. Of Rooms</label>
                                                <?php echo form_input(['type' => 'number', 'name' => 'number_rooms[]', 'id' => '', 'placeholder' => 'No. of Rooms', 'class' => 'mdl-textfield__input', 'value' => '', 'min' => '1']) ?>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <div class="col-lg-2 p-t-20">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <label class="mdl-textfield__label">Breakfast Included</label>
                                            <select name="breakfast[]" class="mdl-textfield__input" style="padding:8px;" required>
                                                <option value="yes">Yes</option>
                                                <option value="no">No</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-1 p-t-20">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width is-focused">
                                            <button class="btn btn-xs btn-success add-person-details" style="float:right;">Persons Details</button>
                                        </div>
                                    </div>

                                </div>
                                <div class="div-person-details" style="background-color:#f5fbff;padding: 0 15px;">


                                </div>

                            </div>
                            <div class="row">
                                <div class="col-lg-12"><button class="btn btn-xs btn-success" style="float:right;" onclick="add_element('room-details')"><i class="fa fa-plus"></i></button></div>
                            </div>
                            <div class="row">
                                <div class="col-lg-7"><button type="submit" class="btn btn-primary" style="float:right;" id="btn_roomdetails">Update</button></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="myModalflightdetails" role="dialog">
    <div class="modal-dialog modal-lg" style="max-width:1200px;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Flight Details</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body ui-front">
                <!--div class="row">
        <div class="col-md-12">
            <form method="post" id="frm_add_airline">
                <div class="card-header">Add New Airline</div>
                <div class="card-body" id="">                            
                    <div class="row" >
                        <div class="col-lg-4 p-t-20"> 
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                <input type="text" name="airline_name" value="" placeholder="" id="" class="mdl-textfield__input" required>
                                <label class = "mdl-textfield__label">Airline Name</label>
                            </div>
                        </div>
                        <div class="col-lg-2 p-t-20"> 
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                <input type="text" name="airline_code" value="" placeholder="" id="" class="mdl-textfield__input" required>
                                <label class = "mdl-textfield__label">Code</label>
                            </div>
                        </div>
                        <div class="col-lg-2 p-t-20"> 
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                <button type="button" class="btn btn-success" id="btn-addairline">Add</button>
                            </div>
                        </div>
                        <div class="col-lg-4 p-t-20"> 
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                <div id="msgAirlineDiv"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <hr-->

                <div class="row">
                    <div class="col-md-12">
                        <div id="msgflightDiv"></div>
                        <form method="post" id="frm_flightdetails" onsubmit="formSubmitFlights()">
                            <div class="card-header">Edit Flight Details</div>
                            <div class="card-body" id="">
                                <?php foreach ($arrival_flights as $list) { ?>
                                    <div class="row div_color">
                                        <div class="col-lg-2 p-t-20">
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <label class="mdl-textfield__label">Airline</label>
                                                <input type="text" name="edit_airline_name[]" value="<?php echo $list->name; ?>" placeholder="" id="" class="mdl-textfield__input airline-names" required>
                                            </div>
                                            <input type="hidden" name="edit_airline_ids[]" value="<?php echo $list->a_id; ?>" class="airline-ids">
                                        </div>
                                        <input type="hidden" name="edit_flightdetails[]" value="<?php echo $list->id; ?>">

                                        <div class="col-lg-2 p-t-20">
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <label class="mdl-textfield__label">Departure Airport</label>
                                                <select name="edit_departure_airport[]" id="" class="mdl-textfield__input" style="padding:8px;" required>
                                                    <option value="">Select..</option>
                                                    <?php foreach ($departure_airports as $list_airports) { ?>
                                                        <option value="<?php echo $list_airports->departure_airport; ?>" <?php echo ($list_airports->departure_airport == $list->departure_airport) ? 'selected="selected"' : ''; ?>>
                                                            <?php echo $list_airports->departure_airport; ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-2 p-t-20">
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <label class="mdl-textfield__label">Flight Number</label>
                                                <!--input type="text" name="edit_flight_number[]" value="<?php echo $list->flight_number; ?>" placeholder="" id="" class="mdl-textfield__input" required-->
                                                <select name="edit_flight_number[]" id="" class="mdl-textfield__input" style="padding:8px;" required>
                                                    <option value="<?php echo $list->flight_number; ?>">
                                                        <?php echo $list->flight_number; ?>
                                                    </option>
                                                </select>
                                            </div>
                                        </div>

                                        <!--div class="col-lg-2 p-t-20"> 
                <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                    <select name="edit_flight_type[]" class="mdl-textfield__input" style="padding:8px;" required>
                    <option value="arrival" <?php //echo ($list->flight_type=='arrival')?'selected="selected"':''; 
                                            ?>>Arrival</option>
                    <option value="departure" <?php //echo ($list->flight_type=='departure')?'selected="selected"':''; 
                                                ?>>Departure</option>
                </select>
            <label class = "mdl-textfield__label">Type</label>	 	 
            </div>
            </div-->

                                        <div class="col-lg-2 p-t-20">
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <label class="mdl-textfield__label">Departure City</label>
                                                <input type="text" name="edit_departure_city[]" placeholder="" id="" value="<?php echo $list->departure_city; ?>" class="mdl-textfield__input">
                                            </div>
                                        </div>

                                        <div class="col-lg-2 p-t-20">
                                            <label class="mdl-textfield__label">Departure Date</label>
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width" style="display:inline-flex;">
                                                <input type="text" name="" class="mdl-textfield__input dt-dateformat-flights-show" value="<?php echo ($list->departure_date != '0000-00-00' && $list->departure_date != '') ? date('d-M-Y', strtotime($list->departure_date)) : ''; ?>" style="width:100%;" readonly>
                                                <input type="date" name="edit_departure_date[]" placeholder="" id="" value="<?php echo ($list->departure_date != '0000-00-00' && $list->departure_date != '') ? $list->departure_date : ''; ?>" class="dts-flight dt-dateformat-flights" data-operator="plus" style="width:17px;float:right;position: absolute; right: 5%; border: none; background-color: transparent; top: 50%; transform: translateY(-50%);">
                                            </div>
                                        </div>

                                        <div class="col-lg-2 p-t-20">
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <label class="mdl-textfield__label">Departure Time</label>
                                                <input type="time" name="edit_departure_time[]" placeholder="" id="" value="<?php echo $list->departure_time; ?>" class="mdl-textfield__input">
                                            </div>
                                        </div>

                                        <div class="col-lg-2 p-t-20">
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <label class="mdl-textfield__label">Arrival City</label>
                                                <input type="text" name="edit_arrival_city[]" placeholder="" id="" value="<?php echo $list->arrival_city; ?>" class="mdl-textfield__input">
                                            </div>
                                        </div>

                                        <div class="col-lg-2 p-t-20">
                                            <label class="mdl-textfield__label">Arrival Date</label>
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width" style="display:inline-flex;">
                                                <input type="text" name="" class="mdl-textfield__input dt-dateformat-flights-show" value="<?php echo ($list->arrival_date != '0000-00-00' && $list->arrival_date != '') ? date('d-M-Y', strtotime($list->arrival_date)) : ''; ?>" style="width:100%;" readonly>
                                                <input type="date" name="edit_arrival_date[]" value="<?php echo ($list->arrival_date != '0000-00-00' && $list->arrival_date != '') ? $list->arrival_date : ''; ?>" placeholder="" id="" class="dts-flight dt-dateformat-flights" data-operator="minus" style="width:17px;float:right;position: absolute; right: 5%; border: none; background-color: transparent; top: 50%; transform: translateY(-50%);">
                                            </div>

                                        </div>

                                        <div class="col-lg-2 p-t-20">
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <label class="mdl-textfield__label">Arrival Time</label>
                                                <input type="time" name="edit_arrival_time[]" value="<?php echo $list->arrival_time; ?>" placeholder="" id="" class="mdl-textfield__input">
                                            </div>
                                        </div>

                                        <div class="col-lg-2 p-t-20">
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <label class="mdl-textfield__label">Number Of Persons</label>
                                                <input type="text" name="edit_number_persons[]" value="<?php echo $list->number_persons; ?>" placeholder="" id="" class="mdl-textfield__input">
                                            </div>
                                        </div>

                                        <div class="col-lg-2 p-t-20">
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <label class="mdl-textfield__label">Flight Mode</label>
                                                <select name="edit_flight_mode[]" class="mdl-textfield__input flight-modes" style="padding:8px;" required>
                                                    <option value="inbound" <?php echo ($list->flight_mode == 'inbound') ? 'selected="selected"' : ''; ?>>
                                                        Inbound</option>
                                                    <option value="outbound" <?php echo ($list->flight_mode == 'outbound') ? 'selected="selected"' : ''; ?>>
                                                        Out-Bound</option>
                                                </select>
                                            </div>
                                            <i title="Remove" class="fa fa-window-close edit-remove" style="color:red;cursor: pointer;float: right;margin-top: -15px;position:relative;" data-id="<?= $list->id ?>" data-module="flight_details"></i>
                                        </div>

                                    </div>
                                <?php } ?>
                            </div>

                            <div class="card-body flight-details_cls" id="flight-details">
                                <div class="row div_color">
                                    <div class="col-lg-2 p-t-20">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <label class="mdl-textfield__label">Airline</label>
                                            <input type="text" name="airline_name[]" value="" placeholder="" id="" class="mdl-textfield__input airline-names">
                                        </div>
                                        <input type="hidden" name="airline_ids[]" class="airline-ids">
                                    </div>

                                    <div class="col-lg-2 p-t-20">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <label class="mdl-textfield__label">Departure Airport</label>
                                            <select name="departure_airport[]" id="" class="mdl-textfield__input" style="padding:8px;">
                                                <option value="">Select..</option>
                                                <?php foreach ($departure_airports as $list) { ?>
                                                    <option value="<?php echo $list->departure_airport; ?>">
                                                        <?php echo $list->departure_airport; ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-2 p-t-20">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <label class="mdl-textfield__label">Flight Number</label>
                                            <!--input type="text" name="flight_number[]" value="" placeholder="" id="" class="mdl-textfield__input"-->
                                            <select name="flight_number[]" id="" class="mdl-textfield__input" style="padding:8px;">

                                            </select>
                                        </div>
                                    </div>

                                    <!--div class="col-lg-2 p-t-20"> 
                <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                    <select name="flight_type[]" class="mdl-textfield__input" style="padding:8px;">
                    <option value="arrival">Arrival</option>
                    <option value="departure">Departure</option>
                </select>
            <label class = "mdl-textfield__label">Type</label>	 	 
            </div>
            </div-->

                                    <div class="col-lg-2 p-t-20">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <label class="mdl-textfield__label">Departure City</label>
                                            <input type="text" name="departure_city[]" placeholder="" id="" value="" class="mdl-textfield__input">
                                        </div>
                                    </div>

                                    <div class="col-lg-2 p-t-20">
                                        <label class="mdl-textfield__label">Departure Date</label>
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width" style="display:inline-flex;">
                                            <input type="text" name="" class="mdl-textfield__input dt-dateformat-flights-show" value="" style="width:100%;" readonly>
                                            <input type="date" name="departure_date[]" placeholder="" id="" value="" class="dts-flight dt-dateformat-flights" data-operator="plus" style="width:17px;float:right;position: absolute; right: 5%; border: none; background-color: transparent; top: 50%; transform: translateY(-50%);">
                                        </div>
                                    </div>

                                    <div class="col-lg-2 p-t-20">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <label class="mdl-textfield__label">Departure Time</label>
                                            <input type="time" name="departure_time[]" placeholder="" id="" value="" class="mdl-textfield__input">
                                        </div>
                                    </div>

                                    <div class="col-lg-2 p-t-20">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <label class="mdl-textfield__label">Arrival City</label>
                                            <input type="text" name="arrival_city[]" placeholder="" id="" value="" class="mdl-textfield__input">
                                        </div>
                                    </div>

                                    <div class="col-lg-2 p-t-20">
                                        <label class="mdl-textfield__label">Arrival Date</label>
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width" style="display:inline-flex;">
                                            <input type="text" name="" class="mdl-textfield__input dt-dateformat-flights-show" value="" style="width:100%;" readonly>
                                            <input type="date" name="arrival_date[]" value="" placeholder="" id="" class="dts-flight dt-dateformat-flights" data-operator="minus" style="width:17px;float:right;position: absolute; right: 5%; border: none; background-color: transparent; top: 50%; transform: translateY(-50%);">
                                        </div>
                                    </div>

                                    <div class="col-lg-2 p-t-20">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <label class="mdl-textfield__label">Arrival Time</label>
                                            <input type="time" name="arrival_time[]" value="" placeholder="" id="" class="mdl-textfield__input">
                                        </div>
                                    </div>

                                    <div class="col-lg-2 p-t-20">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <label class="mdl-textfield__label">Number Of Persons</label>
                                            <input type="text" name="number_persons[]" value="" placeholder="" id="" class="mdl-textfield__input">
                                        </div>
                                    </div>

                                    <div class="col-lg-2 p-t-20">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <label class="mdl-textfield__label">Flight Mode</label>
                                            <select name="flight_mode[]" class="mdl-textfield__input flight-modes" style="padding:8px;">
                                                <option value="inbound">Inbound</option>
                                                <option value="outbound">Out-Bound</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12"><button class="btn btn-xs btn-success" style="float:right;" onclick="add_element('flight-details')"><i class="fa fa-plus"></i></button></div>
                            </div>
                            <div class="row">
                                <div class="col-lg-7"><button type="submit" class="btn btn-primary" style="float:right;" id="btn_flightdetails">Submit</button></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addPaymentDetails" role="dialog">
    <div class="modal-dialog modal-lg" style="max-width:600px;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Payment Details</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body ui-front">
                <div class="row">
                    <div class="col-md-12">
                        <form method="post" action="payment-details">
                            <input type="hidden" value="<?php echo base64_encode($arrivals->id); ?>" name="arr_id" id="">
                            <div class="card-body" id="">
                                <div class="row div_color">
                                    <div class="col-lg-4 p-t-20">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <label class="mdl-textfield__label">Client Billing
                                                Amount</label>
                                            <input type="text" name="billing_amount_text" value="<?php echo $arrivals->client_billing; ?>" class="mdl-textfield__input" required>

                                            <input type="hidden" name="billing_amount_text_previous" value="<?php echo $arrivals->client_billing; ?>" class="mdl-textfield__input" required>

                                        </div>
                                    </div>
                                    <?php if ($arrivals->currency !== '') : ?>
                                        <input type="hidden" name="main_currency" value="<?php echo $arrivals->currency; ?>">
                                    <?php endif; ?>
                                    <div class="col-lg-4 p-t-20">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <label class="mdl-textfield__label mb-2">Currency</label>
                                            <select name="main_currency" id="select_currency_static" class="mdl-textfield__input" style="padding-top:13px;" required onchange="updateCurrency()" <?php echo ($arrivals->currency !== '') ? 'disabled' : ''; ?>>
                                                <option value="dollar" <?php echo ($arrivals->currency == 'dollar') ? 'selected' : ''; ?>>
                                                    USD ($)</option>
                                                <option value="inr" <?php echo ($arrivals->currency == 'inr') ? 'selected' : ''; ?>>
                                                    INR (&#8377;)</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 p-t-20">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <label class="mdl-textfield__label">Date</label>
                                            <input type="date" name="pay_date" placeholder="" id="" class="mdl-textfield__input" required="">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body" id="">
                                <div class="row div_color">
                                    <div class="col-lg-12 p-t-20">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width is-focused">
                                            <label class="mdl-textfield__label">Payment Mode</label>
                                            <select name="select_payment_mode" class="mdl-textfield__input" style="padding-top:30px;">
                                                <option value="">Select Payment Mode</option>
                                                <option value="cash_on_arrival">Cash On Arrival</option>
                                                <option value="bank_in_india">Bank In India</option>
                                                <option value="cash_in_india">Cash In India</option>
                                                <option value="remittance">Remittance</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!--div class="col-lg-12 p-t-20">
                                    <div
                                        class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <select name="" id="selected_currency"
                                            class="mdl-textfield__input" style="padding-top:30px;">
                                            <option value="">Select Currency</option>
                                            <option value="dollar">USD (&dollar;)</option>
                                            <option value="inr">INR (&#8377;)</option>
                                        </select>
                                        <label class="mdl-textfield__label">Currency</label>
                                    </div>
                                </div-->
                                    <div class="col-lg-6 p-t-20">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <label class="mdl-textfield__label">Payment Received in
                                                India</label>
                                            <input type="text" name="payment_india" placeholder="" id="" class="mdl-textfield__input">
                                        </div>
                                    </div>
                                    <!--div class="col-lg-4">
                                    <div
                                        class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <select name="other_country" id="other_country"
                                            class="mdl-textfield__input" style="padding-top:30px;">
                                            <option value="">Select Country</option>
                                            <?php
                                            //asort($locations);
                                            //unset($locations['all']);
                                            //foreach ($locations as $key => $val) { 
                                            //if(substr($key,0,1) == strtolower(substr($arrivals->enquiry_no,1,1))){
                                            ?>
                                                <option value="<?php //echo $key 
                                                                ?>" data-abbr="<?php //echo implode(',', $val) 
                                                                                ?>"><?php //echo ucfirst($key) 
                                                                                    ?>
                                                </option>
                                            <?php //}} 
                                            ?>
                                        </select>
                                        <label class="mdl-textfield__label">Country</label>
                                    </div>
                                </div-->
                                    <?php
                                    $payment_country = '';
                                    asort($locations);
                                    unset($locations['all']);
                                    foreach ($locations as $key => $val) {
                                        if (substr($key, 0, 1) == strtolower(substr($arrivals->enquiry_no, 1, 1))) {
                                            $payment_country = ucfirst($key);
                                        }
                                    } ?>
                                    <input type="hidden" name="other_country" value="<?= $payment_country ?>">
                                    <div class="col-lg-6 p-t-20">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <label class="mdl-textfield__label">Payment Received in
                                                <?= $payment_country ?></label>
                                            <input type="text" name="payment_other" placeholder="" id="payment_other" class="mdl-textfield__input">
                                        </div>
                                    </div>

                                    <div class="col-lg-12 p-t-20">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <label class="mdl-textfield__label">Remarks</label>
                                            <input type="text" name="remarks" placeholder="" id="" class="mdl-textfield__input">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body" id="">
                                <div class="row">
                                    <div class="col-lg-12 mt-1">
                                        <button class="btn btn-md btn-primary" style="float:right;" type="submit">Add</button>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <label class="mdl-textfield__label">Balanced Amount</label>
                                            <input type="text" value="<?= $arrivals->balance_amount; ?>" placeholder="" id="" class="mdl-textfield__input" readonly="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="viewPaymentDetails" role="dialog">
    <div class="modal-dialog modal-lg" style="max-width:1000px;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Payment Details</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body ui-front">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-body" id="">
                            <div class="row div_color">
                                <div class="col-lg-12 p-t-10">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <th>
                                                    Client Billing Amount
                                                </th>
                                                <td>
                                                    <?php echo $arrivals->client_billing; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>
                                                    Currency
                                                </th>
                                                <td>
                                                    <?php echo strtoupper($arrivals->currency); ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>
                                                    Balance Amount
                                                </th>
                                                <td>
                                                    <?php echo $arrivals->balance_amount; ?>
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-body pt-2 p-0" id="">
                                <div class="row div_color">
                                    <div class="col-lg-12 p-t-10">
                                        <table class="table table-responsive">
                                            <tbody>
                                                <tr>
                                                    <th>
                                                        Sr. No.
                                                    </th>
                                                    <th>
                                                        Payment mode
                                                    </th>
                                                    <th>
                                                        Currency
                                                    </th>
                                                    <th>
                                                        Payment India
                                                    </th>
                                                    <th>
                                                        Other country
                                                    </th>
                                                    <th>
                                                        Other country Payment
                                                    </th>
                                                    <th>
                                                        Payment Date
                                                    </th>
                                                    <th>
                                                        Client Billing Amount <br>
                                                        (Previous)
                                                    </th>
                                                    <th>
                                                        Client Billing Amount <br>
                                                        (New)
                                                    </th>
                                                    <th>
                                                        Remarks
                                                    </th>
                                                    <th>
                                                        Action
                                                    </th>
                                                </tr>
                                                <?php $count = 0;
                                                if ($arrivals->payment_received_india <> '0' || $arrivals->payment_received_almaty <> '0') { ?>
                                                    <tr style="background-color:#ffeed6;">
                                                        <td><?php echo ++$count; ?></td>
                                                        <td></td>
                                                        <td>
                                                            <?= strtoupper($arrivals->currency); ?>
                                                        </td>
                                                        <td>
                                                            <?= $arrivals->payment_received_india ?>
                                                        </td>
                                                        <td>None</td>
                                                        <td>
                                                            <?= $arrivals->payment_received_almaty ?>
                                                        </td>
                                                        <td></td>
                                                        <td><?= $arrivals->client_billing ?>
                                                        </td>
                                                        <td>
                                                            <?= $arrivals->client_billing ?>
                                                        </td>
                                                        <td></td>
                                                        <td> </td>
                                                    </tr>

                                                <?php } ?>
                                                <?php if ($payment_data) : ?>

                                                    <?php foreach ($payment_data as $payment) : ?>
                                                        <tr>
                                                            <td>
                                                                <?php echo ++$count; ?>
                                                            </td>
                                                            <td>
                                                                <?= str_replace('_', ' ', strtoupper($payment->payment_mode)); ?>

                                                            </td>
                                                            <td>
                                                                <?= strtoupper($payment->currency); ?>
                                                            </td>
                                                            <td>
                                                                <?= $payment->payment_recieved_in_india ?>
                                                            </td>
                                                            <td>
                                                                <?= ucfirst($payment->other_country) ?>
                                                            </td>
                                                            <td>
                                                                <?= $payment->payment_recieved_in_other ?>
                                                            </td>
                                                            <td>
                                                                <?= date('d-M-Y',strtotime($payment->date)) ?>
                                                            </td>
                                                            <td>
                                                                <?= $payment->client_billing_previous ?>
                                                            </td>
                                                            <td>
                                                                <?= $payment->client_billing_new ?>
                                                            </td>
                                                            <td>
                                                                <?= $payment->remarks ?>
                                                            </td>
                                                            <td>
                                                                <?php
                                                                $allowed_types = ['superadmin', 'accounts_admin'];
                                                                if (in_array($this->session->userdata('admin_type'), $allowed_types)) { ?>
                                                                    <button type="button" class="btn btn-info p-2 edit-payment" data-payment="<?= $payment->id ?>" data-payment_mode="<?= $payment->payment_mode ?>" data-currency="<?= $payment->currency ?>" data-country="<?= $payment->other_country ?>" data-payment_india="<?= $payment->payment_recieved_in_india ?>" data-payment_in_other="<?= $payment->payment_recieved_in_other ?>" data-date="<?= $payment->date ?>" data-pay_client="<?= $payment->client_billing ?>" data-pay_balance="<?= $payment->balance_amount ?>" data-pay_remark="<?= $payment->remarks ?>">
                                                                        <i class="fas fa-edit"></i>
                                                                    </button>
                                                                <?php } ?>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
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
</div>

<div class="modal fade" id="editPaymentDetails" role="dialog">
    <div class="modal-dialog modal-lg" style="max-width:600px;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Payment Details</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body ui-front">
                <div class="row">
                    <div class="col-md-12">
                        <form method="post" action="edit-payment-details">
                            <input type="hidden" value="<?php echo base64_encode($arrivals->id); ?>" name="arrs_id" id="arr_id">
                            <input type="hidden" name="payment_edit_id" id="payment" value="">
                            <div class="card-body" id="">
                                <div class="row div_color">
                                    <div class="col-lg-4 p-t-20">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <input type="text" name="billing_amount_text" id="pay_cilent_billing" value="" class="mdl-textfield__input" required>
                                            <label class="mdl-textfield__label">Client Billing
                                                Amount</label>
                                        </div>
                                    </div>
                                    <input type="hidden" name="main_currency" value="" id="currency">
                                    <div class="col-lg-4 p-t-20">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <select name="main_currency" id="currency" class="mdl-textfield__input" style="padding-top:13px;" required onchange="updateCurrency()" disabled>
                                                <option value="dollar">USD ($)</option>
                                                <option value="inr">INR (&#8377;)</option>
                                            </select>
                                            <label class="mdl-textfield__label mb-2">Currency</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 p-t-20">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <input type="date" name="pay_date" placeholder="" id="payment_date" class="mdl-textfield__input" required="">
                                            <label class="mdl-textfield__label">Date</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body" id="">
                                <div class="row div_color">
                                    <div class="col-lg-12 p-t-20">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width is-focused">
                                            <select name="select_payment_mode" id="payment_mode" class="mdl-textfield__input" style="padding-top:30px;">
                                                <option value="">Select Payment Mode</option>
                                                <option value="cash_on_arrival">Cash On Arrival</option>
                                                <option value="bank_in_india">Bank In India</option>
                                                <option value="cash_in_india">Cash In India</option>
                                                <option value="remittance">Remittance</option>
                                            </select>
                                            <label class="mdl-textfield__label">Payment Mode</label>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 p-t-20">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <input type="text" name="payment_india" placeholder="" id="payment_india" class="mdl-textfield__input" readonly>
                                            <label class="mdl-textfield__label">Payment Received in
                                                India</label>
                                        </div>
                                    </div>
                                    <input type="hidden" name="other_country" value="" id="oth_country">
                                    <div class="col-lg-6 p-t-20">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <input type="text" name="payment_other" placeholder="" id="payment_oth" class="mdl-textfield__input" readonly>
                                            <label class="mdl-textfield__label" id="payment_received_label">
                                        </div>
                                    </div>

                                    <div class="col-lg-12 p-t-20">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <input type="text" name="remarks" placeholder="" id="pay_remark" class="mdl-textfield__input">
                                            <label class="mdl-textfield__label">Remarks</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body" id="">
                                <div class="row">
                                    <div class="col-lg-12 mt-1">
                                        <button class="btn btn-md btn-primary" style="float:right;" type="submit">Add</button>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <input type="text" value="" placeholder="" id="pay_balance_amount" class="mdl-textfield__input" readonly="">
                                            <label class="mdl-textfield__label">Balanced Amount</label>
                                        </div>
                                    </div>
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
    <div class="container-fluid">
        <?php
        //$allowed_users = ['1','2'];
        $readonly = '';
        $disabled = '';
        if (!in_array($this->session->userdata('type'), $allowed_users)) {
            $readonly = 'readonly';
            $disabled = 'disabled="disabled"';
        }
        ?>
        <!-- start page content -->
        <div class="page-content-wrapper">
            <div class="">
                <div class="page-bar">
                    <div class="row page-titles">
                        <div class="col-md-5 col-5 align-self-center">
                            <h4 class="text-themecolor">Edit Arrival</h4>
                        </div>
                        <div class="col-md-7 col-7 align-self-center text-end">
                            <div class="d-flex justify-content-end align-items-center">
                                <ol class="breadcrumb justify-content-end">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard');?>">Home</a></li>
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('arrivals');?>">Arrival Chart</a></li>
                                    <li class="breadcrumb-item active"><a href="">Edit Arrival</a></li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <?php echo $this->session->flashdata('message');
                unset($_SESSION['message']);
                echo validation_errors(); ?>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box">
                            <div class="card-head">
                                
                                <?php if (in_array($this->session->userdata('type'), $allowed_users)) { ?>
                                    <!--button type="button" style="float:right;cursor:pointer;" id="add_company" data-toggle="modal" data-target="#myModalhotel" class="btn-success">Add New Hotel</button-->
                                    <button type="button" style="float:right;cursor:pointer;margin-right:5px;" id="edit_flight_details" data-toggle="modal" data-target="#myModalflightdetails" class="btn-info">Edit Flight Details</button>
                                    <button type="button" onclick="rooms_model()" class="btn-info" style="float:right;cursor:pointer;margin-right:5px;">Edit/Create Rooming
                                        List</button>
                                    <button type="button" data-toggle="modal" data-target="#modalAddRestaurantMenu" id="addRestaurantMenu" class="btn-info" style="float:right;cursor:pointer;margin-right:5px;">Add
                                        Restaurant Menu
                                    </button>
                                <?php } ?>
                            </div>

                            <div class="card-body">
                                <form method="post" id="frm_hoteldetails" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-lg-3 p-t-20 m-b-10">
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <label class="mdl-textfield__label_s" style="width:100%;font-weight: 600;
    color: #aaa;
    font-size: 13px;">Physical Arrival Date</label>
                                                <input type="text" name="" class="mdl-textfield__input dt-dateformat-show" value="<?php echo ($arrivals->arrival_date <> '') ? date('d-M-Y', strtotime($arrivals->arrival_date)) : ''; ?>" style="width:100%;" >
                                                <?php echo form_input(['type' => 'date', 'name' => 'arrival_date', 'placeholder' => '', 'id' => 'arrival_date', 'required' => 'required', 'class' => 'dt-dateformat', 'value' => $arrivals->arrival_date/*,'readonly'=>$readonly*/, 'style'=>"width:17px;float:right;position: absolute; right: 5%; border: none; background-color: transparent; top: 50%;"]) ?>
                                                    <?php //echo form_error('arrival_date'); 
                                                                ?>
                                                </div>
                                        </div>
                                    </div>

                                    <?php
                                    $edit_checkout = '';
                                    if (!empty($arrival_hotel_details)) { ?>
                                        <?php foreach ($arrival_hotel_details as $list) { ?>
                                            <div class="row">
                                                <input type="hidden" name="edit_hotel_details_id[]" value="<?php echo $list->id; ?>" />
                                                <div class="col-lg-3 div_color" style="border-top: 1px solid #b7c0c7;border-bottom: 1px solid #b7c0c7;border-left: 1px solid #b7c0c7;">
                                                    <label class="mdl-textfield__label">Check In
                                                        Date</label>
                                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width" style="display:inline-flex;">
                                                        <input type="text" name="" class="mdl-textfield__input dt-dateformat-show" value="<?php echo ($list->checkin_date <> '') ? date('d-M-Y', strtotime($list->checkin_date)) : ''; ?>" style="width:100%;" readonly>
                                                        <?php echo form_input(['type' => 'date', 'name' => 'edit_checkin[]', 'placeholder' => '', 'id' => '', 'class' => 'dts check-dts dt-dateformat', 'value' => $list->checkin_date, 'style'=>"width:17px;float:right;position: absolute; right: 5%; border: none; background-color: transparent; top: 50%; transform: translateY(-50%);"]) ?>
                                                            <?php echo form_error(''); ?>
                                                    </div>
                                                </div>

                                                <div class="col-lg-3 div_color" style="border-top: 1px solid #b7c0c7;border-bottom: 1px solid #b7c0c7;border-left: 1px solid #b7c0c7;">
                                                    <label class="mdl-textfield__label">Check Out
                                                        Date</label>
                                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width" style="display:inline-flex;">
                                                        <input type="text" name="" class="mdl-textfield__input dt-dateformat-show" value="<?php echo ($list->checkout_date <> '') ? date('d-M-Y', strtotime($list->checkout_date)) : ''; ?>" style="width:100%;" readonly>
                                                        <?php echo form_input(['type' => 'date', 'name' => 'edit_checkout[]', 'placeholder' => '', 'id' => '', 'class' => 'dts dt-dateformat', 'value' => $list->checkout_date, 'style'=>"width:17px;float:right;position: absolute; right: 5%; border: none; background-color: transparent; top: 50%; transform: translateY(-50%);"]) ?>
                                                            <?php echo form_error(''); ?>
                                                        <?php $edit_checkout = $list->checkout_date; ?>
                                                    </div>
                                                </div>

                                                <div class="col-lg-4 div_color" style="border: 1px solid #b7c0c7;">
                                                    <label class="mdl-textfield__label">Hotel</label>
                                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                        <?php
                                                        echo form_input(['name' => 'edit_hotel[]', 'id' => '', 'placeholder' => 'Hotel', 'class' => 'mdl-textfield__input hotel-names', 'value' => $list->hotel_name]);
                                                        ?>
                                                        <input type="hidden" name="edit_hotel_ids[]" value="<?php echo $list->hotel_id; ?>" class="hotel-ids">
                                                    </div>
                                                </div>
                                                <div class="col-lg-1 div_color" style="border-top: 1px solid #b7c0c7;border-bottom: 1px solid #b7c0c7;border-right: 1px solid #b7c0c7;padding:22px;">
                                                    <button type="button" data-module="arrival_hotels" class="btn btn-danger btn-xs arrival-hotel-remove" data-id="<?php echo $list->id; ?>" title="Remove">Remove</button>
                                                </div>
                                            </div>
                                    <?php }
                                    } ?>

                                    <div class="row hotel_details_cls" id="hotel_details" style="padding-top:10px;">
                                        <div class="col-lg-3 div_color_new" style="border-top: 1px solid #b7c0c7;border-bottom: 1px solid #b7c0c7;border-left: 1px solid #b7c0c7;">
                                            <label class="mdl-textfield__label">Check In
                                                Date</label>
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width" style="display:inline-flex;">
                                                <input type="text" name="" class="mdl-textfield__input dt-dateformat-show" value="<?php echo ($edit_checkout != '') ? date('d-M-Y', strtotime($edit_checkout)) : date('d-M-Y', strtotime($arrivals->arrival_date)); ?>" style="width:100%;" readonly>
                                                <?php echo form_input(['type' => 'date', 'name' => 'check_in[]', 'placeholder' => '', 'id' => '', 'class' => 'dts check-dts dt-dateformat', 'value' => ($edit_checkout != '') ? $edit_checkout : $arrivals->arrival_date, 'onkeydown' => "return false", 'style'=>"width:17px;float:right;position: absolute; right: 5%; border: none; background-color: transparent; top: 50%; transform: translateY(-50%);", 'data-operator' => 'plus']) ?>
                                                    <?php echo form_error('check_in'); ?>

                                            </div>
                                        </div>

                                        <div class="col-lg-3 div_color_new" style="border-top: 1px solid #b7c0c7;border-bottom: 1px solid #b7c0c7;border-left: 1px solid #b7c0c7;">
                                            <label class="mdl-textfield__label">Check Out
                                                Date</label>
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width" style="display:inline-flex;">
                                                <input type="text" name="" class="mdl-textfield__input dt-dateformat-show" value="<?php echo ($arrivals->check_out_date != '') ? date('d-M-Y', strtotime($arrivals->check_out_date)) : ''; ?>" style="width:100%;" readonly>
                                                <?php echo form_input(['type' => 'date', 'name' => 'check_out[]', 'placeholder' => '', 'id' => '', 'class' => 'dts dt-dateformat', 'value' => $arrivals->check_out_date, 'onkeydown' => "return false", 'style'=>"width:17px;float:right;position: absolute; right: 5%; border: none; background-color: transparent; top: 50%; transform: translateY(-50%);", 'data-operator' => 'minus']) ?>
                                                    <?php echo form_error('check_out'); ?>

                                            </div>
                                        </div>

                                        <div class="col-lg-4 div_color_new" style="border: 1px solid #b7c0c7;">
                                            <label class="mdl-textfield__label">Hotel</label>
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <?php
                                                echo form_input(['name' => 'hotel[]', 'id' => '', 'placeholder' => 'Hotel', 'class' => 'mdl-textfield__input hotel-names', 'value' => '', 'required' => 'required']);
                                                ?>
                                                <input type="hidden" name="hotel_ids[]" class="hotel-ids">
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-lg-10" id="msgDivHotel">

                                        </div>
                                        <div class="col-lg-2">
                                            <button class="btn btn-xs btn-success" onclick="add_ele_hotel('hotel_details')"><i class="fa fa-plus"></i></button>
                                            <button type="button" class="btn btn-xs btn-success btn-info" id="btn_save">Save</button>
                                        </div>
                                    </div>
                                    <br>
                                </form>

                                <form method="post" enctype="multipart/form-data" id="frm_arrival" onsubmit="return statusAlert()">
                                    <input type="hidden" value="<?php echo $arrivals->enq_id; ?>" name="enq_id" id="enq_id">
                                    <div class="row">
                                        
                                        
                                        
                                        
                                        <div class="col-lg-2 p-t-20 div_color">
                                            <label class="mdl-textfield__label">Booking Type</label>
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width is-focused mdl-textfield__input redonly-color">
                                                <?php
                                                $location_keys = ($this->session->userdata('locations') == 'all') ? array_keys($locations) : [$this->session->userdata('locations')]; ?>
                                                <?php
                                                    $this->db->select('*');
                                                    $this->db->from('combo_enquiry');
                                                    $this->db->where('id =', $arrivals->combo_enquiry_id);
                                                    $enquiry = $this->db->get()->result_array();
                                                    // print_r($enquiry);
                                                    if($enquiry){
                                                        print_r($enquiry[0]['enquiry_abbr']);
                                                    }else{
                                                        echo $arrivals->enquiry_abbr; 
                                                    }
                                                ?>
                                            </div>
                                        </div>

                                        <div class="col-lg-2 p-t-20 div_color">
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <label class="mdl-textfield__label">File
                                                    No</label>
                                                <?php echo form_input(['name' => 'enquiry_no', 'id' => 'enquiry_no', 'class' => 'mdl-textfield__input redonly-color', 'value' => $arrivals->enquiry_no, 'readonly' => True]) ?>
                                                    <?php echo form_error('enquiry_no'); ?>
                                                <input type="hidden" name="file_seq" id="file_seq" value="" />
                                            </div>
                                        </div>
                                        
                                        <?php if($arrivals->split_count > 0){ ?>
                                            <div class="col-lg-1 p-t-20 div_color">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <label class="mdl-textfield__label">Split No</label>
                                                    <?php echo form_input(['name' => 'split_count', 'id' => 'split_count', 'class' => 'mdl-textfield__input redonly-color', 'value' => $arrivals->split_number, 'readonly' => True]) ?>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <?php if($arrivals->split_count > 0){ 
                                                $this->db->select('
                                                    MIN(checkin_date) AS min_checkin_date,
                                                    MAX(checkout_date) AS max_checkout_date
                                                ');
                                                $this->db->from('arrival_hotel_details');
                                                $this->db->where('arrival_id', $arrivals->id);
                                            
                                                $date_result = $this->db->get()->row();
                                            
                                                $min_checkin  = $date_result->min_checkin_date;
                                                $max_checkout = $date_result->max_checkout_date;
                                                $checkin  = new DateTime($min_checkin);
                                                $checkout = new DateTime($max_checkout);
                                                $days = $checkin->diff($checkout)->days;
                                            ?>
                                            <div class="col-lg-2 p-t-20 div_color">
                                                <label class="mdl-textfield__label">Number of Nights</label>
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <?php echo form_input(['type' => 'text', 'name' => 'number_of_nights', 'placeholder' => '', 'id' => 'number_of_nights', 'class' => 'mdl-textfield__input redonly-color', 'value' => $days, 'readonly' => True]) ?>  
                                                </div>
                                            </div>
                                        <?php }else{ ?>
                                            <div class="col-lg-2 p-t-20 div_color">
                                                <label class="mdl-textfield__label">Number of Nights</label>
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <?php echo form_input(['type' => 'text', 'name' => 'number_of_nights', 'placeholder' => '', 'id' => 'number_of_nights', 'class' => 'mdl-textfield__input redonly-color', 'value' => $arrivals->number_of_nights, 'readonly' => True]) ?>  
                                                </div>
                                            </div>
                                        <?php } ?>
                                        
                        
                                        <div class="col-lg-3 p-t-20 div_color">
                                            <label class="mdl-textfield__label">Agent Name</label>
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <?php echo form_input(['type' => 'text', 'name' => '', 'placeholder' => '', 'id' => '', 'class' => 'mdl-textfield__input redonly-color', 'value' => $arrivals->name, 'readonly' => True]) ?>

                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-3 p-t-20">
                                            <label class="mdl-textfield__label">Agent Reference Number</label>
                                            <div
                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <?php
                                                echo form_input(['name' => 'agent_reference_num', 'id' => 'agent_reference_num', 'placeholder' => 'Agent Reference Number', 'class' => 'mdl-textfield__input', 'value' => $arrivals->agent_reference_num]);
                                                ?>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-2 p-t-20">
                                            <label class="mdl-textfield__label">Lead Name</label>
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <?php
                                                echo form_input(['name' => 'lead_name', 'id' => 'lead_name', 'placeholder' => 'Lead Name', 'class' => 'mdl-textfield__input', 'value' => $arrivals->lead_name, 'required' => 'required']);
                                                ?>
                                            </div>
                                        </div>

                                        <div class="col-lg-1 p-t-20">
                                            <label class="mdl-textfield__label">ISD</label>
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <?php echo form_input(['name' => 'lead_isd_code', 'id' => 'lead_isd_code', 'placeholder' => 'ISD Code', 'class' => 'mdl-textfield__input', 'value' => '', 'required' => 'required', 'value' => isset($arrivals->lead_isd_code) ? $arrivals->lead_isd_code : '']); ?>
                                            </div>
                                        </div>

                                        <div class="col-lg-2 p-t-20">
                                            <label class="mdl-textfield__label">Lead Contact</label>
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <?php
                                                echo form_input(['name' => 'lead_contact', 'id' => 'lead_contact', 'placeholder' => 'Lead Contact', 'class' => 'mdl-textfield__input', 'value' => $arrivals->lead_contact, 'required' => 'required']);
                                                ?>
                                            </div>
                                        </div>

                                        <div class="col-lg-1 p-t-20 hide">
                                            <label for="lead_photo" class="btn btn-xs btn-info">Lead
                                                Photo</label>
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width" style="padding:0;">
                                                <input type="file" class="btn btn-xs btn-info mdl-textfield__input" style="white-space: normal;display:none;" name="lead_photo" id="lead_photo" />
                                            </div>
                                        </div>

                                        <div class="col-lg-2 p-t-20">
                                            <label class="mdl-textfield__label">Number Of Rooms</label>
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <?php
                                                echo form_input(['name' => 'number_rooms', 'id' => 'number_rooms', 'placeholder' => 'Number Of Rooms', 'class' => 'mdl-textfield__input', 'value' => $arrivals->number_rooms, 'required' => 'required']);
                                                ?>
                                            </div>
                                        </div>

                                        <div class="col-lg-2 p-t-20" style="">
                                            <label class="mdl-textfield__label">No. Of
                                                Adults</label>
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <?php echo form_input(['name' => 'number_persons', 'id' => 'number_persons', 'class' => 'mdl-textfield__input', 'value' => (substr($arrivals->enquiry_no, 0, 1) != 'G')?$arrivals->number_persons:$arrivals->num_adults]) ?>
                                                    <?php echo form_error('number_persons'); ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-1 p-t-20" style="">
                                            <label class="mdl-textfield__label">No. Of
                                                Child</label>
                                                <?php $child_count = (substr($arrivals->enquiry_no, 0, 1) != 'G') ? $arrivals->number_child : $arrivals->num_child; ?>

                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <?php echo form_input(['name' => 'number_child', 'id' => 'number_child', 'class' => 'mdl-textfield__input', 'value' => (substr($arrivals->enquiry_no, 0, 1) != 'G')?$arrivals->number_child:$arrivals->num_child]) ?>
                                                    <?php echo form_error('number_child'); ?>
                                            </div>
                                        </div>
                                        
                                        <!-- Container for dynamic child age fields -->
                                        <div id="childAgeContainer" class="row">
                                            <?php
                                            // Display existing child ages if available
                                            $child_ages = [];
                                            if (!empty($arrivals->child_ages)) {
                                                $child_ages = json_decode($arrivals->child_ages, true);
                                            } elseif ($child_count > 0) {
                                                // If no child ages stored but child count exists, create empty array
                                                $child_ages = array_fill(0, $child_count, '');
                                            }
                                            
                                            if (!empty($child_ages)) {
                                                foreach ($child_ages as $index => $age) {
                                                    $child_number = $index + 1;
                                                    ?>
                                                    <div class="col-lg-2 p-t-20 child-age-field" data-child-index="<?php echo $child_number; ?>">
                                                        <div class="child-age-input-wrapper">
                                                            <label class="mdl-textfield__label">Child <?php echo $child_number; ?> Age</label>
                                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width" style="display: flex; align-items: center;">
                                                                <input type="number" 
                                                                    name="child_age[]" 
                                                                    class="mdl-textfield__input child-age-input" 
                                                                    min="0" 
                                                                    max="17" 
                                                                    placeholder="Enter age" 
                                                                    value="<?php echo htmlspecialchars($age); ?>"
                                                                    required 
                                                                    style="flex: 1;">
                                                                <?php if ($child_number > 1): ?>
                                                                <button type="button" class="btn btn-danger btn-sm remove-child-btn" style="margin-left: 8px; min-width: 40px;">
                                                                    <i class="fa fa-times"></i>
                                                                </button>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php
                                                }
                                                
                                                // Add + button if there are children
                                                if ($child_count > 0) {
                                                    ?>
                                                    <!--<div class="col-lg-12 p-t-20 text-center">-->
                                                    <!--    <button type="button" id="addChildBtn" class="btn btn-success btn-sm">-->
                                                    <!--        <i class="fa fa-plus"></i> Add Another Child-->
                                                    <!--    </button>-->
                                                    <!--</div>-->
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div>

                                        <input type="hidden" name="hdn_arrival_date" id="hdn_arrival_date" value="<?php echo $arrivals->arrival_date; ?>">
                                        <div class="col-lg-2 p-t-20">
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <label class="mdl-textfield__label">Handling Staff</label>
                                                <select name="handling_staff" id="handling_staff" class="mdl-textfield__input" <?= $disabled ?>>
                                                    <option value=""></option>
                                                    <?php
                                                    foreach ($users as $user) {
                                                    ?>
                                                        <option style="color:<?=($user->status == 1) ? '' : '#f81515'?>" title="<?=($user->status == 1) ? '' : 'User is inactive'?>" value="<?= $user->id ?>" <?php echo ($user->id == $arrivals->handling_staff_id) ? 'selected="selected"' : ''; ?>>
                                                            <?= $user->name ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-2 p-t-40">
                                            <button type="button" style="width: 100%;" data-toggle="modal" data-target="#myModalAddTransportation" data-id="<?= $arrivals->enq_id ?>" class="mdl-button mdl-button--raised mdl-js-ripple-effect  m-r-20 btn-success myModal_AddTransportation">Add
                                                Transportation</button>
                                        </div>

                                        
                                            <div class="col-lg-2 p-t-40">
                                            <button type="button" style="width: 100%;" data-toggle="modal" data-target="#myModaldriver" id="add-driver-button" data-id="<?= $arrivals->id ?>" class="mdl-button mdl-button--raised mdl-js-ripple-effect  m-r-20 btn-success myModal_AddGuide">Add
                                            Driver</button>
                                                    </div>
                                                    <div class="col-lg-3 p-t-40">
                                            <button type="button" style="width: 100%;" data-toggle="modal" data-target="#myModalguide" id="add-guide-button" data-id="<?= $arrivals->enq_id ?>" class="mdl-button mdl-button--raised mdl-js-ripple-effect m-r-20 btn-success myModal_AddGuide">Add Guide / DRIVER CUM GUIDE</button>
                                        </div>
                                        <div class="col-lg-1 p-t-40" >
                                            <input type="checkbox" name="chk_guide" id="guide_checkbox" <?= empty($data_guides[0]->id) && $arrivals->guide_id == 0 ? 'checked' : '' ?>>
                                            No Guide
                                        </div>

                                        <div class="col-lg-2 p-t-20">
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <?php $group_type = ['Family', 'Men', 'Friends', 'Mice', 'Ladies', 'Couple','Senior Citizen','Senior Citizen Couple','Men & Women','Men & Women Or child']; ?>
                                                <label class="mdl-textfield__label">Group Type</label>
                                                <select id="group_type" name="group_type" class="mdl-textfield__input" <?= $disabled ?>>
                                                    <?php foreach ($group_type as $list) { ?>
                                                        <option value="<?= $list ?>" <?php echo ($arrivals->group_type == $list) ? 'selected="selected"' : ''; ?>>
                                                            <?= $list ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-2 p-t-20">
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <label class="mdl-textfield__label">Handover To Client</label>
                                                <select name="handover_to_client" id="handover_to_client" class="mdl-textfield__input" <?= $disabled ?>>
                                                    <option value="no" <?php echo ($arrivals->handover_to_client == 'no') ? 'selected="selected"' : ''; ?>>
                                                        No</option>
                                                    <option value="yes" <?php echo ($arrivals->handover_to_client == 'yes') ? 'selected="selected"' : ''; ?>>
                                                        Yes</option>
                                                    
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-2 p-t-20">
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">

                                                <label class="mdl-textfield__label">Handover To Kazin</label>
                                                <select name="handover_to_kazin" id="handover_to_kazin" class="mdl-textfield__input" <?= $disabled ?>>
                                                    <option value="no" <?php echo ($arrivals->handover_to_kazin == 'no') ? 'selected="selected"' : ''; ?>>
                                                        No</option>
                                                    <option value="yes" <?php echo ($arrivals->handover_to_kazin == 'yes') ? 'selected="selected"' : ''; ?>>
                                                        Yes</option>
                                                    
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 p-t-20">
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <label class="mdl-textfield__label">Status</label>

                                                <!--<select name="status" id="status" class="mdl-textfield__input" onchange="document.getElementById('hidediv').className = this.value === 'cancel' ? 'hidden' : 'show'">-->
                                                <select name="status" id="status" class="mdl-textfield__input" onchange="document.getElementById('hidediv').className = this.value !== 'cancel' ? 'col-lg-4 p-t-20 hidden' : 'col-lg-4 p-t-20 show' ">
                                                    <option value="in-progress" <?php echo ($arrivals->status == 'in-progress') ? 'selected="selected"' : ''; ?>>
                                                        In Progress</option>
                                                    <option value="complete" <?php echo ($arrivals->status == 'complete') ? 'selected="selected"' : ''; ?>>
                                                        Complete</option>
                                                    <option value="file-closed" <?php echo ($arrivals->status == 'file-closed') ? 'selected="selected"' : ''; ?>>
                                                        File Closed</option>
                                                    <?php if (/*substr($arrivals->enquiry_no, 0, 1) != 'G' &&*/ ($this->session->userdata('admin_type') == 'superadmin' || $this->session->userdata('id') == '33')) { ?>
                                                        <option value="cancel" <?php echo ($arrivals->status == 'cancel') ? 'selected="selected"' : ''; ?>>
                                                            Cancel</option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                          <div class="col-lg-4 p-t-20 hidden" id="hidediv">
                                              <!--<div class="hidden" id="hidediv">-->
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width" >
                                                    <label class="mdl-textfield__label">Remarks</label>
                                                    <input type="text" class="mdl-textfield__input" name="arrival_remarks" id="arrival_remarks" value="<?php echo trim($arrivals->remarks); ?>">
                                            <!--</div>-->
                                                </div>
                                        </div>
                                       

                                        <?php if (in_array($this->session->userdata('type'), ['1', '3'])) { ?>
                                            <div class="col-lg-2 p-t-20">
                                            <label class="mdl-textfield__label">Client Billing (Amount)</label>
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <input type="text" class="mdl-textfield__input" name="client_billing" id="client_billing" value="<?php echo $arrivals->client_billing; ?>" readonly="">
                                            </div>
                                        </div>

                                        <div class="col-lg-2 p-t-20">
                                            <label class="mdl-textfield__label">Balance Amount</label>
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <input type="number" min="0" class="mdl-textfield__input" name="balance_amount" id="balance_amount" value="<?php echo $arrivals->balance_amount; ?>" readonly="">
                                            </div>
                                        </div>
                                         

                                      
                                        <div class="col-lg-12 p-t-20 mt-4 text-center">
                                            <?php 
                                            $display = '';
                                            if($this->session->userdata('admin_type')=='accounts_view'){ $display = 'display:none;'; } ?>
                                            <button type="button" style="cursor:pointer;<?=$display; ?>" id="edit_flight_details" data-toggle="modal" data-target="#addPaymentDetails" class="btn-info p-2">Add Payment Details</button>
                                            <button type="button" style="cursor:pointer;" id="edit_flight_details" data-toggle="modal" data-target="#viewPaymentDetails" class="btn-info p-2">View Payment Details</button>
                                        </div>
                                        <?php } ?>
                                        <input type="hidden" name="arrival_id" value="<?php echo base64_encode($arrivals->id); ?>" />
                                        <?php if ($arrivals->status != 'cancel') { ?>
                                            <div class="col-lg-12 p-t-20 text-center">
                                                <?php //echo form_submit(['name' => 'add', 'id' => 'add', 'class' => 'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-pink', 'value' => 'Update']); 
                                                ?>
                                                <input type="submit" value="Update" name="add" id="add" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-pink">

                                                <input type="button" value="Cancel" name="" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-danger" onclick="history.back();">
                                            </div>
                                        <?php } ?>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page content -->
        </div>
    </div>
</div>
 <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->
        <!-- jQuery UI -->
 <!--       <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>-->
 <!--       <script src="assets/js/bootstrap.js"></script>-->
        <!-- select2 start -->
 <!--       <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>-->
        <!-- select2 end -->

<script>
    function statusAlert() {
        var form = $('#frm_arrival');
        form[0].reportValidity();
        if($('#status option:selected').val() === "cancel" && $("#arrival_remarks").val()==""){
            $("#arrival_remarks").focus();
            return false;
        }
        
        if ($('#status option:selected').val() === "cancel") {
            return confirm("Are you sure? Once cancelled query cannot be rolled back.");
        }
    }

    function formatDate(dateStr) {
        const date = new Date(dateStr);
        const day = ("0" + date.getDate()).slice(-2); // Add leading zero if needed
        const monthNames = [
            "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul",
            "Aug", "Sept", "Oct", "Nov", "Dec"
        ];
        const month = monthNames[date.getMonth()]; // Get the month name
        const year = date.getFullYear();
        return `${day}-${month}-${year}`;
    }

    function rooms_model() {
        event.preventDefault();
        var enq_id = $("#enq_id").val();
        $.ajax({
            url: "<?php echo base_url('admin/arrivalchart/get_hotel_details'); ?>",
            type: "post",
            data: {
                'enq_id': enq_id,'arrival_id':"<?php echo $arrivals->id; ?>",'enq_num':$("#enquiry_no").val()
            },
            dataType: 'JSON',
            //contentType: false,
            //processData: false,
            beforeSend: function() {},
            success: function(data) {
                //$('.room-category:eq(0)').empty();
                if (data.response === "e") {
                    alert('No hotel(s) details found!');
                    return false;
                } else if (data.response === "s") {
                    $('#roominglist_hotels').empty().append('<option value="">Select Hotel..</option>');
                    $.each(data.details, function(i, d) {
                        $('#roominglist_hotels').append('<option data-attr="' + d.id +
                            '" value="' + d.hotel_id + '">' + d.hotel_name + '</option>');
                    });
                    $("#myModalrooms").modal("toggle");
                }
            }
        });
    }

    $(document).ready(function() {
        
        $("#status").on("change",function(){
            $("#arrival_remarks").removeAttr("required").next("label").html("Remarks (Optional)");
            if($(this).val()=="cancel"){
                $("#arrival_remarks").attr("required","required").next("label").html("Remarks");
            }
        });
        
        $(".costing").on("click", function() {
            $("#modalCost-show").modal("toggle");
            $('#response-message').html('');
            var adult = $(this).data('adults');
            var child = $(this).data('childs');
            var hotel_id = $(this).data('hotel_id');
            var category_id = $(this).data('category_id');
            var nights = $(this).data('nights');
            var breakfast = $(this).data('breakfast');
            var checkin = $(this).data('checkin');
            var checkout = $(this).data('checkout');
            var file = $(this).data('file');
            var rooms = $(this).data('rooms');

            $.ajax({
                url: '<?= base_url() ?>get-costing-data',
                type: 'GET',
                dataType: 'json',
                data: {
                    adult: adult,
                    child: child,
                    hotel_id: hotel_id,
                    category_id: category_id,
                    checkin: checkin,
                    checkout: checkout
                },
                success: function(response) {
                    
                    if(response.details.get_costing_data.length == 0 && response.details.all_costing_detials.length == 0){
                        document.getElementById('costing-data').innerHTML = '';
                        document.getElementById('costing-details').innerHTML = '';
                        document.getElementById('repeated-form').innerHTML = '';
                        $('#total_label').html('');
                        $('#total_price').val('');
                        return false;
                    }  
                    
                    var detail1 = response.details.get_costing_data[0];
                    var detail2 = response.details.get_costing_data.length > 1 ? response.details.get_costing_data[1] : null;
                    var totalCost;

                    if (breakfast.toLowerCase() === 'yes') {
                        totalCost = parseFloat(detail1.price_with_breakfast) + (detail2 ? parseFloat(detail2.price_with_breakfast) : 0);
                    } else {
                        totalCost = parseFloat(detail1.price_without_breakfast) + (detail2 ? parseFloat(detail2.price_without_breakfast) : 0);
                    }

                    var htmlContent = `<div class="col-sm-2 text-center">${detail1.person_count}</div>
                    <div class="col-sm-2 text-center">${detail2 ? detail2.person_count : '0'}</div>
                    <div class="col-sm-3 text-center">${detail2 ? detail2.child_bed : 'CWB'}</div>
                    <div class="col-sm-3 text-center">${breakfast.toUpperCase()}</div>
                    <div class="col-sm-2 text-center">${nights}</div>`;

                    document.getElementById('costing-data').innerHTML = htmlContent;

                    var htmlContent2 = '';
                    var label = {
                        "1": "Single",
                        "2": "Double",
                        "3": "Triple",
                        "4": "Four",
                        "5": "Five"
                    };

                    var occupancyData = {};

                    $.each(response.details.all_costing_detials, function(index, item) {
                        if(detail1.person_count != item.person_count) return;
                        var personCountLabel = label[item.person_count] || item.person_count;
                        if (!occupancyData[personCountLabel]) {
                            occupancyData[personCountLabel] = {
                                priceAdult: '',
                                priceChild: ''
                            };
                        }
                        if (item.type === 'adult') {
                            occupancyData[personCountLabel].priceAdult = `${item.price_with_breakfast}`;
                        }
                        if (item.type === 'child') {
                            occupancyData[personCountLabel].priceChild = `${item.price_with_breakfast}`;
                        }
                    });
                    var cnt_chk = false;
                    $.each(occupancyData, function(key, value) {
                        htmlContent2 += `
                        <div class="col-sm-4 text-center">${key}</div>
                        <div class="col-sm-4 text-center">${value.priceAdult}</div>`;
                        if(value.priceChild != ""){
                            cnt_chk = true;
                            htmlContent2 += `<div class="col-sm-4 text-center">${value.priceChild}</div>`;
                        }

                    });
                    
                    if(!cnt_chk){ $("#child_breakfast_prices").addClass("hide"); }
                    
                    document.getElementById('costing-details').innerHTML = htmlContent2;

                    var editCostingPrice = response.details.edit_costing_price || [];
                    var blackoutDays = response.details.blackout_days || [];

                    function isBlackoutDay(date) {
                        for (var i = 0; i < blackoutDays.length; i++) {
                            var fromDate = new Date(blackoutDays[i].from_date);
                            var toDate = new Date(blackoutDays[i].to_date);
                            if (date >= fromDate && date <= toDate) {
                                return true;
                            }
                        }
                        return false;
                    }

                    // Function to update the total price
                    function updateTotalPrice() {
                        let totalPrice = 0;
                        $('input[name="cost[]"]').each(function() {
                            let value = parseFloat($(this).val()) || 0;
                            totalPrice += value;
                        });
                        if (file.charAt(0) !== "G") {
                            $('#total_label').html('<strong>' + totalPrice.toFixed(2) + ' (Tenge)</strong>');
                            $('#total_price').val(totalPrice.toFixed(2));
                        } else {
                            var total = parseFloat(totalPrice.toFixed(2)) * rooms;
                            $('#rooms').html('<strong>' + rooms + '</strong>');
                            $('#total_label').html('<strong>' + total.toFixed(2) + ' (Tenge)</strong>');
                            $('#total_price').val(total.toFixed(2));
                        }
                    }

                    // Function to generate content for blackout days
                    function generateBlackoutDayContent() {
                        var htmlFormContent = '';
                        var checkinDate = new Date(checkin);
                        var checkoutDate = new Date(checkout);
                        var currentDate = new Date(checkinDate);

                        while (currentDate < checkoutDate) {
                            var formattedDate = currentDate.toISOString().split('T')[0];
                            var dateLabel = formatDate(currentDate); // Use formatted date without day name

                            var currentTotalCost = isBlackoutDay(currentDate) ? '' : totalCost;
                            var dayTypeLabel = isBlackoutDay(currentDate) ? 'Blackout Day' : 'Normal Day';
                            var dayType = isBlackoutDay(currentDate) ? '1' : '0';
                            var class_name = (dayType==1)?'bold':'';
                            htmlFormContent += `
                            <div class="row">
                                <div class="col-lg-4 text-center">
                                    <input type="hidden" name="hotel_id" value="${hotel_id}" required>
                                    <input type="hidden" name="category_id" value="${category_id}" required>
                                    <input type="hidden" name="dates[]" value="${formattedDate}" required>
                                    <label class="mt-2 ${class_name}">${dateLabel}</label>
                                </div>
                                <div class="col-lg-4 text-center">
                                    <input type="text" name="cost[]" id="category_name" required value="${currentTotalCost}" class="cost-input">
                                </div>
                                <div class="col-lg-4 text-right">
                                    <input type="hidden" name="day_type[]" id="category_name" required value="${dayType}">
                                    <label class="${class_name}">(${dayTypeLabel})</label>                                                    
                                </div>
                            </div>
                        `;

                            currentDate.setDate(currentDate.getDate() + 1); // Move to the next day
                        }

                        document.getElementById('repeated-form').innerHTML = htmlFormContent;
                        updateTotalPrice();

                        // Attach event listener to cost inputs to update total price on change
                        $(document).on('input', 'input[name="cost[]"]', function() {
                            updateTotalPrice();
                        });
                    }

                    // Function to generate content for edit costing price
                    function generateEditCostingPriceContent() {
                        var htmlFormContent = '';

                        for (var i = 0; i < editCostingPrice.length; i++) {
                            var item = editCostingPrice[i];
                            var formattedDate = formatDate(new Date(item.date));
                            var dayType = item.day_type == 1 ? 'Blackout Days' : 'Normal Days';
                            var class_name = (item.day_type==1)?'bold':'';
                            
                            htmlFormContent += `
                                <div class="row">
                                    <div class="col-lg-4 text-center">
                                        <input type="hidden" name="ids[]" id="pricing-id" value="${item.id}" required>
                                        <input type="hidden" name="hotel_id" value="${item.hotel_id}" required>
                                        <input type="hidden" name="category_id" value="${item.category_id}" required>
                                        <input type="hidden" name="dates[]" value="${item.date}" required>
                                        <label class="mt-2 ${class_name}">${formattedDate}</label>
                                    </div>
                                    <div class="col-lg-4 text-center">
                                        <input type="text" name="cost[]" id="category_name" required value="${item.price}" class="cost-input">
                                    </div>
                                    <div class="col-lg-4 text-right">
                                        <input type="hidden" name="day_type[]" id="category_name" required value="${item.day_type}">
                                        <label class="${class_name}">(${dayType})</label>                                                    
                                    </div>
                                </div>
                            `;
                        }

                        document.getElementById('repeated-form').innerHTML = htmlFormContent;
                        updateTotalPrice();

                        // Attach event listener to cost inputs to update total price on change
                        $(document).on('input', 'input[name="cost[]"]', function() {
                            updateTotalPrice();
                        });
                    }


                    if (editCostingPrice.length === 0) {
                        generateBlackoutDayContent();
                    } else {
                        $("#pricing_title").text("Edit Pricing");
                        generateEditCostingPriceContent();
                    }
                },
                error: function() {
                    console.log('Error fetching data');
                }
            });
        });
        /*$('.pricing-modal').on('click', function(e) {
            location.reload(true);
        });*/


        $('#costing-form').on('submit', function(e) {
            e.preventDefault();

            var formData = new FormData(this);
            var ids = $('#pricing-id').val();

            // Determine the URL based on the value of ids
            var url = (ids && ids !== 'null') ? 'edit-costing-price' : 'add-costing-price';

            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function(response) {
                    $('#response-message').html('<div class="alert alert-success text-center">' + response.msg + '</div>');
                },
                error: function(xhr, status, error) {
                    $('#response-message').html('<div class="alert alert-danger text-center">There was an error submitting the form.</div>');
                }
            });
        });


        $("#add").on("click", function() {
            event.preventDefault();
            var checkin_cnt = $("input[name='edit_checkin[]']").length;
            for (var i = 0; i < checkin_cnt; i++) {
                $("#frm_arrival").append('<input type="hidden" name="edit_checkin[' + i +
                    ']" value="' + $("input[name='edit_checkin[]']").eq(i).val() + '" />');
                $("#frm_arrival").append('<input type="hidden" name="edit_checkout[' + i +
                    ']" value="' + $("input[name='edit_checkout[]']").eq(i).val() + '" />');
            }
            $("#frm_arrival").submit();
        });

        $("#hotel").autocomplete({
            source: function(request, response) {
                // Fetch data
                $.ajax({
                    url: "<?= base_url() ?>admin/arrivalchart/hotel_name_suggesstion",
                    type: 'post',
                    dataType: "json",
                    data: {
                        search: request.term,
                        'location': '<?= !empty($enquiry[0]['enquiry_abbr']) ? $enquiry[0]['enquiry_abbr'] : $arrivals->enquiry_abbr; ?>'
                    },
                    success: function(data) {
                        response(data);
                        dt = data;
                        $(".err").html('');;
                    }
                });
            },
            select: function(event, ui) {
                // Set selection
                $('#hotel').val(ui.item.label); // display the selected text
                $('#hotel_id').val(ui.item.h_id); // save selected id to input
            }
        });

        $("#roominglist_hotels").on("change", function() {
            event.preventDefault();
            var hotel_id = $(this).val();
            var hotel_details_id = $("#roominglist_hotels option:selected").attr("data-attr");
            var radioIdx = $(":radio[name='rdo_list']").index($(":radio[name='rdo_list']:checked"));
            $.ajax({
                url: "<?php echo base_url('admin/hotel/get_rooms_category'); ?>",
                type: "post",
                data: {
                    'hotel_id': hotel_id,
                    'enq_id': $("#enq_id").val(),
                    'hotel_details_id': hotel_details_id
                },
                dataType: 'JSON',
                //contentType: false,
                //processData: false,
                beforeSend: function() {},
                success: function(data) {
                    $('.room-category:eq(' + radioIdx + ')').empty();
                    if (data.response === "e") {} else if (data.response === "s") {
                        $('.hotel-details-ids:eq(' + radioIdx + ')').val(hotel_id);
                        $('.arrival-hotel-details-ids:eq(' + radioIdx + ')').val(
                            hotel_details_id);
                        $('.room-category:eq(' + radioIdx + ')').empty().append(
                            '<option value="">Select..</option>');
                        $.each(data.details.room_categories, function(i, d) {
                            $('.room-category:eq(' + radioIdx + ')').append(
                                '<option value="' + d.category_name + '_' + d.id +
                                '" data-cat_id="' + d.id +
                                '" data-adults="' + d.number_adults +
                                '" data-childs="' + d.number_childs +
                                '" data-childbed="' + d.child_bed + '">' + d
                                .category_name + '</option>');
                        });
                        $('.check-in:eq(' + radioIdx + ')').val(data.details
                            .hotel_details.checkin_date).trigger("change");
                        $('.check-out:eq(' + radioIdx + ')').val(data.details
                            .hotel_details.checkout_date).trigger("change");
                    }
                }
            });
        });

        $("#frm_hoteldetails").on('keydown.autocomplete', ".hotel-names", function() {
            var ele = $(this);
            var idx = ele.index(".hotel-names");
            /*var d = $('.hotel-names').eq(idx).attr("id");*/

            $(this).autocomplete({
                source: function(request, response) {
                    // Fetch data
                    $.ajax({
                        url: "<?= base_url() ?>admin/arrivalchart/hotel_name_suggesstion",
                        type: 'post',
                        dataType: "json",
                        data: {
                            search: request.term,
                            'location': '<?= !empty($enquiry[0]['enquiry_abbr']) ? $enquiry[0]['enquiry_abbr'] : $arrivals->enquiry_abbr; ?>'
                        },
                        success: function(data) {
                            /*$.each(data, function (index, item) {
                                    $('#'+d).appendTo("<ul><li class=''>" + item.label + "</li></ul>");
                            });*/
                            response(data)
                        }
                    });
                },
                select: function(event, ui) {
                    // Set selection
                    $(this).val(ui.item.label); // display the selected text
                    $(".hotel-ids").eq(idx).val(ui.item.h_id);
                    //$('#hotel_id').val(ui.item.h_id); // save selected id to input
                }
            });
        });

        $("#frm_flightdetails").on('keydown.autocomplete', ".airline-names", function() {
            var ele = $(this);
            var idx = ele.index(".airline-names");
            /*var d = $('.hotel-names').eq(idx).attr("id");*/

            $(this).autocomplete({
                source: function(request, response) {
                    // Fetch data
                    $.ajax({
                        url: "<?= base_url() ?>admin/arrivalchart/airline_name_suggesstion",
                        type: 'post',
                        dataType: "json",
                        data: {
                            search: request.term,
                            'location': ''
                        },
                        success: function(data) {
                            /*$.each(data, function (index, item) {
                                    $('#'+d).appendTo("<ul><li class=''>" + item.label + "</li></ul>");
                            });*/
                            response(data)
                        }
                    });
                },
                select: function(event, ui) {
                    // Set selection
                    $(this).val(ui.item.label); // display the selected text
                    $(".airline-ids").eq(idx).val(ui.item.a_id);
                    //$('#hotel_id').val(ui.item.h_id); // save selected id to input
                }
            });
        });

        $("#transportation").autocomplete({
            source: function(request, response) {
                // Fetch data
                $.ajax({
                    url: "<?= base_url() ?>admin/arrivalchart/transportation_name_suggesstion",
                    type: 'post',
                    dataType: "json",
                    data: {
                        search: request.term,
                        'location': '<?= !empty($enquiry[0]['enquiry_abbr']) ? $enquiry[0]['enquiry_abbr'] : $arrivals->enquiry_abbr; ?>'
                    },
                    success: function(data) {
                        response(data);
                        dt = data;
                        $(".err").html('');;
                    }
                });
            },
            select: function(event, ui) {
                // Set selection
                $('#transportation').val(ui.item.label); // display the selected text
                $('#transportation_id').val(ui.item.t_id); // save selected id to input
                $("#luggage_vehicle").removeAttr("checked");
                if (ui.item.luggage_vehicle == 'yes') {
                    $("#luggage_vehicle").attr("checked", "checked");
                }
            }
        });

        $("#driver_name").autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: "<?= base_url() ?>admin/arrivalchart/driver_name_suggestion",
                    type: 'post',
                    dataType: "json",
                    data: {
                        search: request.term,
                        enquiry_abbr: '<?= !empty($enquiry[0]['enquiry_abbr']) ? $enquiry[0]['enquiry_abbr'] : $arrivals->enquiry_abbr; ?>'
                    },
                    success: function(data) {
                        response(data);
                    }
                });

            },
            select: function(event, ui) {
                    $('#driver_name').val(ui.item.label); // Set driver name in input
                    $('#driver_id').val(ui.item.d_id);    // Set driver ID in hidden field
            }
        });

        $("#guide").autocomplete({
            source: function(request, response) {
                // Fetch data
                $.ajax({
                    url: "<?= base_url() ?>admin/arrivalchart/guide_name_suggesstion",
                    type: 'post',
                    dataType: "json",
                    data: {
                        search: request.term,
                        'location': '<?= !empty($enquiry[0]['enquiry_abbr']) ? $enquiry[0]['enquiry_abbr'] : $arrivals->enquiry_abbr; ?>'
                    },
                    success: function(data) {
                        response(data);
                        dt = data;
                        $(".err").html('');;
                    }
                });
            },
            select: function(event, ui) {
                // Set selection
                $('#guide').val(ui.item.label); // display the selected text
                $('#guide_id').val(ui.item.g_id); // save selected id to input
            }
        });


        /*$(".dts").on("change", function () {
            if ($('.dts:eq(0)').val() === "" || $('.dts:eq(1)').val() === "") {
                return false;
            }
            const pre = new Date($('.dts:eq(0)').val());
            const last = new Date($('.dts:eq(1)').val());
            if (pre > last) {
                alert('Check-in date must be less than Check-out date.');
                $(".dts").val('');
            } else {
                const diffInMs = Math.abs(last - pre);
                const diffInDays = Math.round(diffInMs / (1000 * 60 * 60 * 24));
                $("#number_of_nights").val(diffInDays);
            }
        });*/

        $("#frm_hoteldetails").on('change', '.dts', function() {
            var ele = $(this);
            var idx = ele.index(".dts");
            var idx_dt_format = ele.index(".dt-dateformat");
            var op = $('.dts:eq(' + idx + ')').attr("data-operator");
            var checkin_idx = checkout_idx = dt_format_op = "";
            if (op == "plus") {
                checkin_idx = idx;
                checkout_idx = parseInt(idx) + 1;
                dt_format = idx_dt_format + 1;
            } else {
                checkin_idx = parseInt(idx) - 1;
                checkout_idx = idx;
                dt_format = idx_dt_format - 1;
            }

            if ($('.dts:eq(' + checkin_idx + ')').val() === "" || $('.dts:eq(' +
                    checkout_idx + ')').val() === "") {
                return false;
            }
            const pre = new Date($('.dts:eq(' + checkin_idx + ')').val());
            const last = new Date($('.dts:eq(' + checkout_idx + ')').val());
            if (pre > last) {
                alert('Check-in date must be less than Check-out date.');
                $('.dts:eq(' + checkin_idx + ')').val('');
                $('.dts:eq(' + checkout_idx + ')').val('');
                $('.dt-dateformat-show:eq(' + idx_dt_format + ')').val('');
                $('.dt-dateformat-show:eq(' + dt_format + ')').val('');
            }
        });


        $("#frm_flightdetails").on('change', '.dts-flight', function() {
            var ele = $(this);
            var idx = ele.index(".dts-flight");
            var op = $('.dts-flight:eq(' + idx + ')').attr("data-operator");
            var checkin_idx = checkout_idx = "";
            if (op == "plus") {
                checkin_idx = idx;
                checkout_idx = parseInt(idx) + 1;
            } else {
                checkin_idx = parseInt(idx) - 1;
                checkout_idx = idx;
            }

            if ($('.dts-flight:eq(' + checkin_idx + ')').val() === "" || $('.dts-flight:eq(' +
                    checkout_idx + ')').val() === "") {
                return false;
            }
            const pre = new Date($('.dts-flight:eq(' + checkin_idx + ')').val());
            const last = new Date($('.dts-flight:eq(' + checkout_idx + ')').val());
            if (pre > last) {
                alert('Departure date must be less than Arrival date.');
                $('.dts-flight:eq(' + checkin_idx + ')').val('');
                $('.dts-flight:eq(' + checkout_idx + ')').val('');
                $('.dt-dateformat-flights-show:eq(' + checkin_idx + ')').val('');
                $('.dt-dateformat-flights-show:eq(' + checkout_idx + ')').val('');
            }
        });

        $("#btn_hotel").on("click", function() {
            let myForm = document.getElementById("frm_hotel");
            var data = new FormData(myForm);
            $("#btn_hotel").html('Submitting').attr('disabled', 'disabled');
            $.ajax({
                url: "<?php echo base_url('admin/arrivalchart/add_hotel'); ?>",
                type: "post",
                data: data,
                dataType: 'JSON',
                contentType: false,
                processData: false,
                beforeSend: function() {},
                success: function(data) {
                    $("#msgDiv").html('').html(data.msg);
                    $("#btn_hotel").html('Submit').removeAttr('disabled', 'disabled');
                    if (data.response === "e") {} else if (data.response === "s") {
                        $("#frm_hotel")[0].reset();
                    }
                }
            });
        });

        $("#btn_transportation").on("click", function() {
            let myForm = document.getElementById("frm_transportation");
            var data = new FormData(myForm);
            $("#btn_transportation").html('Submitting').attr('disabled', 'disabled');
            $.ajax({
                url: "<?php echo base_url('admin/arrivalchart/add_transportation'); ?>",
                type: "post",
                data: data,
                dataType: 'JSON',
                contentType: false,
                processData: false,
                beforeSend: function() {},
                success: function(data) {
                    $("#msgDivagent").html('').html(data.msg);
                    $("#btn_transportation").html('Submit').removeAttr('disabled',
                        'disabled');
                    if (data.response === "e") {} else if (data.response === "s") {
                        $("#frm_transportation")[0].reset();
                    }
                }
            });
        });

        $("#frm_roomdetails").on('change', '.person-category', function() {
            var ele = $(this);
            var idx = ele.index(".person-category");
            var child = {
                min: 3,
                max: 11
            };
            var infant = {
                min: 1,
                max: 2
            };
            var d;
            if (ele.val() != "adult") {
                $('.child-age').eq(idx).attr("required", "required").empty().append(
                    '<option value="">Select..</option>').parent().addClass("is-focused");
                if (ele.val() == "child") {
                    d = child;
                } else {
                    d = infant;
                }

                for (var i = d.min; i <= d.max; i++) {
                    $('.child-age').eq(idx).append('<option value="' + i + '">' + i + '</option>');
                }

            } else {
                $('.child-age').eq(idx).removeAttr("required").empty().append(
                    '<option value="NA">NA</option>').parent().addClass("is-focused");
            }
        });

        $("#frm_persondetails").on('click', '.fa-remove', function(e) {
            e.preventDefault();
            $(this).parent().remove(); //Remove field html
        });

        $("#frm_roomdetails").on('click', '.fa-remove', function(e) {
            e.preventDefault();
            $(this).parent().remove(); //Remove field html
        });

        $("#frm_flightdetails").on('click', '.fa-remove', function(e) {
            e.preventDefault();
            $(this).parent().remove(); //Remove field html
        });

        $("#frm_hoteldetails").on('click', '.fa-remove', function(e) {
            e.preventDefault();
            $(this).parent().parent().remove(); //Remove field html
        });

        $(".edit-remove").on("click", function(e) {
            if (!confirm('Are You Sure?')) {
                return false;
            }
            e.preventDefault();
            var ele = $(this);
            var idx = ele.index(".edit-remove");
            var category_id = $(".room-category").eq(idx).val();
            var arrival_id = $("#arr_id").val();
            var hotel_id = $(".hotel-details-ids").eq(idx).val();
            $.ajax({
                url: "<?php echo site_url('edit_remove_details'); ?>",
                type: "post",
                data: {
                    'module_id': ele.attr("data-id"),
                    'module': ele.attr("data-module"),
                    'enq_id': $("#enq_id").val(),
                    'room_category_id' : category_id,
                    'arrival_id' : arrival_id,
                    'hotel_id' : hotel_id
                },
                dataType: 'JSON',
                //contentType : false,
                //processData: false,
                beforeSend: function() {},
                success: function(res) {
                    if (res.response === "s") {
                        ele.parent().parent().remove();
                    }
                }
            });
        });

        $("#frm_roomdetails").on('change', '.dt-room', function() {
            var ele = $(this);
            var idx = ele.index(".dt-room");
            var op = $('.dt-room:eq(' + idx + ')').attr("data-operator");
            var checkin_idx = checkout_idx = "";
            if (op == "plus") {
                checkin_idx = idx;
                checkout_idx = parseInt(idx) + 1;
            } else {
                checkin_idx = parseInt(idx) - 1;
                checkout_idx = idx;
            }

            if ($('.dt-room:eq(' + checkin_idx + ')').val() === "" || $('.dt-room:eq(' +
                    checkout_idx + ')').val() === "") {
                return false;
            }
            const pre = new Date($('.dt-room:eq(' + checkin_idx + ')').val());
            const last = new Date($('.dt-room:eq(' + checkout_idx + ')').val());
            if (pre > last) {
                alert('Check-in date must be less than Check-out date.');
                $('.dt-room:eq(' + checkin_idx + ')').val('');
                $('.dt-room:eq(' + checkout_idx + ')').val('');
                $(".dt-dateformat-rooms-show").eq(checkin_idx).val('');
                $(".dt-dateformat-rooms-show").eq(checkout_idx).val('');
            }
        });

        $(".payment").on("blur", function() {
            $("#err_billing").html('');
            if ($(this).val() == '') {
                $(this).val("0").parent("div").addClass("is-focused");
            }
            if ($("#client_billing").val() == '') {
                $("#err_billing").html(
                    '<div class="alert alert-danger" style="padding: 0 5px;">Client Billing Amount Cannot Be Empty!</div>'
                );
                $(this).val(0);
                return false;
            }
            var balance_amt = parseInt($("#client_billing").val()) - (parseInt($(".payment:eq(0)")
                .val()) + parseInt($(".payment:eq(1)").val()));
            $("#balance_amount").val(balance_amt).parent("div").addClass("is-focused");
        });

        $("#frm_roomdetails").on('change', '.room-category', function() {
            var ele = $(this);
            var idx = ele.index(".room-category");
            var adult_max = $('.room-category option:selected').eq(idx).attr("data-adults");
            var child_max = $('.room-category option:selected').eq(idx).attr("data-childs");
            var child_bed = $('.room-category option:selected').eq(idx).attr("data-childbed");
            $('#frm_roomdetails .room-adults').eq(idx).attr("max", adult_max);
            $('#frm_roomdetails .room-childs').eq(idx).attr("max", child_max);
            $('#frm_roomdetails .room-childbed').eq(idx).empty().append(
                '<option value="N/A">N/A</option><option value="' + child_bed + '">' +
                child_bed + '</option>').parent("div").addClass("is-focused");
        });

        $("#frm_roomdetails").on('click', '.add-person-details', function() {
            event.preventDefault();
            var ele = $(this);
            var idx = ele.index(".add-person-details");

            if ($('#frm_roomdetails .room-adults').eq(idx).val() > $(
                    '#frm_roomdetails .room-adults').eq(idx).attr('max')) {
                alert("Maximum allowed value is " + $('#frm_roomdetails .room-adults').eq(idx).attr(
                    'max'));
                $('#frm_roomdetails .room-adults').eq(idx).focus();
                return false;
            }
            if ($('#frm_roomdetails .room-childs').eq(idx).val() > $(
                    '#frm_roomdetails .room-childs').eq(idx).attr('max')) {
                alert("Maximum allowed value is " + $('#frm_roomdetails .room-childs').eq(idx).attr(
                    'max'));
                $('#frm_roomdetails .room-childs').eq(idx).focus();
                return false;
            }

            var total_persons = parseInt($('#frm_roomdetails .room-adults').eq(idx).val()) +
                parseInt($('#frm_roomdetails .room-childs').eq(idx).val());
            var html = '<div class="row">';
            html +=
                '<div class="col-lg-1"><div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width is-focused"><input type="text" name="first_name[]" placeholder="" id="" value="" class="mdl-textfield__input" required><label class = "mdl-textfield__label">First Name</label></div></div>';
            html +=
                '<div class="col-lg-1"><div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width is-focused"><input type="text" name="last_name[]" placeholder="" id="" value="" class="mdl-textfield__input" required><label class = "mdl-textfield__label">Last Name</label></div></div>';
            html +=
                '<div class="col-lg-1"><div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width is-focused">';
            html +=
                '<select name="person_category[]" class="mdl-textfield__input person-category" style="padding:8px;" required>';
            html += '<option value="adult">Adult</option>';
            html += '<option value="child">Child</option>';
            html += '<option value="infant">Infant</option>';
            html += '</select>';
            html += '<label class = "mdl-textfield__label">Category</label></div></div>';
            html +=
                '<div class="col-lg-1"><div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width is-focused">';
            html +=
                '<select name="age[]" class="mdl-textfield__input child-age" style="padding:8px;">'
            html += '<option value="NA">NA</option>';
            html += '</select>';
            html += '<label class = "mdl-textfield__label">Age</label></div></div>';
            html +=
                '<div class="col-lg-2"><div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width is-focused"><input type="text" name="passport_number[]" placeholder="" id="" value="" class="mdl-textfield__input" required><label class = "mdl-textfield__label">Passport No.</label></div></div>';
            html +=
                '<div class="col-lg-1"><div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width is-focused"><input type="text" name="nationality[]" placeholder="" id="" value="" class="mdl-textfield__input" required><label class = "mdl-textfield__label">Nationality</label></div></div>';
            html +=
                '<div class="col-lg-2"><div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width is-focused">';
            html +=
                '<select name="smoking[]" class="mdl-textfield__input" style="padding:8px;" required>';
            html += '<option value="smoking">Smoking</option>';
            html += '<option value="non-smoking">Non-smoking</option>';
            html += '</select>';
            html += '<label class = "mdl-textfield__label">Smoking</label></div></div>';
            html +=
                '<div class="col-lg-1"><div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width is-focused">';
            html +=
                '<select name="meals[]" class="mdl-textfield__input" style="padding:8px;" required>';
            html +=
                '<option value="veg">Veg</option><option value="non-veg">Non-veg</option><option value="other">Other</option>';
            html += '</select><label class = "mdl-textfield__label">Meals</label></div></div>';
            html +=
                '<div class="col-lg-2"><div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width is-focused"><input type="text" name="remarks[]" placeholder="" id="" value="" class="mdl-textfield__input"><label class = "mdl-textfield__label">Remarks</label></div></div>';
            html += '</div>';
            $('#frm_roomdetails .div-person-details').eq(idx).html('');
            for (var i = 1; i <= total_persons; i++) {
                $('#frm_roomdetails .div-person-details').eq(idx).append(html);
            }
            //html.appendTo($('#frm_roomdetails .div-person-details').eq(idx));
        });

        $("#frm_flightdetails").on('change', "select[name^=flight_number]", function() {
            var element_idx = $("select[name^=flight_number]").index(this);
            var flight_num = $("select[name='flight_number[]']").eq(element_idx).val();
            var airline_id = $("input[name='airline_ids[]']").eq(element_idx).val();
            if (flight_num == "" || flight_num == "undefined") {
                $("input[name='departure_city[]']").eq(element_idx).val('');
                $("input[name='departure_time[]']").eq(element_idx).val('');
                $("input[name='arrival_city[]']").eq(element_idx).val('');
                $("input[name='arrival_time[]']").eq(element_idx).val('');
                return false;
            }
            $.ajax({
                url: "<?php echo site_url('get_flight_schedule'); ?>",
                type: "post",
                data: {
                    'flight_number': flight_num,
                    'airline_id': airline_id
                },
                dataType: 'JSON',
                //contentType : false,
                //processData: false,
                beforeSend: function() {},
                success: function(res) {

                    if (res.response === "s") {
                        $("input[name='departure_city[]']").eq(element_idx).val(res
                            .details.departure_city);
                        $("input[name='departure_time[]']").eq(element_idx).val(res
                            .details.departure_time);
                        $("input[name='arrival_city[]']").eq(element_idx).val(res
                            .details.arrival_city);
                        $("input[name='arrival_time[]']").eq(element_idx).val(res
                            .details.arrival_time);
                    }
                }
            });

        });

        $("#frm_flightdetails").on('change', "select[name^=departure_airport]", function() {
            var element_idx = $("select[name^=departure_airport]").index(this);
            var airport = $("select[name='departure_airport[]']").eq(element_idx).val();
            var airline_id = $("input[name='airline_ids[]']").eq(element_idx).val();

            $("input[name='departure_city[]']").eq(element_idx).val('');
            $("input[name='departure_time[]']").eq(element_idx).val('');
            $("input[name='arrival_city[]']").eq(element_idx).val('');
            $("input[name='arrival_time[]']").eq(element_idx).val('');
            $("select[name='flight_number[]']").eq(element_idx).empty().append(
                '<option value="">Select..</option>').parent().addClass("is-dirty is-focused");
            if (airport == "" || airport == "undefined" || airline_id == "" || airline_id ==
                "undefined") {
                return false;
            }
            $.ajax({
                url: "<?php echo site_url('get_flight_numbers'); ?>",
                type: "post",
                data: {
                    'airport': airport,
                    'airline_id': airline_id
                },
                dataType: 'JSON',
                //contentType : false,
                //processData: false,
                beforeSend: function() {},
                success: function(res) {
                    if (res.response === "s") {
                        $.each(res.details, function(index, item) {
                            $("select[name='flight_number[]']").eq(element_idx)
                                .append('<option value="' + item.flight_number +
                                    '">' + item.flight_number + '</option>');
                        });
                    }
                }
            });
        });

        $("#frm_flightdetails").on('change', "select[name^=edit_flight_number]", function() {
            var element_idx = $("select[name^=edit_flight_number]").index(this);
            var flight_num = $("select[name='edit_flight_number[]']").eq(element_idx).val();
            if (flight_num == "" || flight_num == "undefined") {
                $("input[name='edit_departure_city[]']").eq(element_idx).val('');
                $("input[name='edit_departure_time[]']").eq(element_idx).val('');
                $("input[name='edit_arrival_city[]']").eq(element_idx).val('');
                $("input[name='edit_arrival_time[]']").eq(element_idx).val('');
                return false;
            }
            $.ajax({
                url: "<?php echo site_url('get_flight_schedule'); ?>",
                type: "post",
                data: {
                    'flight_number': flight_num
                },
                dataType: 'JSON',
                //contentType : false,
                //processData: false,
                beforeSend: function() {},
                success: function(res) {

                    if (res.response === "s") {
                        $("input[name='edit_departure_city[]']").eq(element_idx).val(res
                            .details.departure_city);
                        $("input[name='edit_departure_time[]']").eq(element_idx).val(res
                            .details.departure_time);
                        $("input[name='edit_arrival_city[]']").eq(element_idx).val(res
                            .details.arrival_city);
                        $("input[name='edit_arrival_time[]']").eq(element_idx).val(res
                            .details.arrival_time);
                    }
                }
            });

        });

        $("#frm_flightdetails").on('change', "select[name^=edit_departure_airport]", function() {
            var element_idx = $("select[name^=edit_departure_airport]").index(this);
            var airport = $("select[name='edit_departure_airport[]']").eq(element_idx).val();
            var airline_id = $("input[name='edit_airline_ids[]']").eq(element_idx).val();

            $("input[name='edit_departure_city[]']").eq(element_idx).val('');
            $("input[name='edit_departure_time[]']").eq(element_idx).val('');
            $("input[name='edit_arrival_city[]']").eq(element_idx).val('');
            $("input[name='edit_arrival_time[]']").eq(element_idx).val('');
            $("select[name='edit_flight_number[]']").eq(element_idx).empty().append(
                '<option value="">Select..</option>').parent().addClass("is-dirty is-focused");
            if (airport == "" || airport == "undefined" || airline_id == "" || airline_id ==
                "undefined") {
                return false;
            }
            $.ajax({
                url: "<?php echo site_url('get_flight_numbers'); ?>",
                type: "post",
                data: {
                    'airport': airport,
                    'airline_id': airline_id
                },
                dataType: 'JSON',
                //contentType : false,
                //processData: false,
                beforeSend: function() {},
                success: function(res) {
                    if (res.response === "s") {
                        $.each(res.details, function(index, item) {
                            $("select[name='edit_flight_number[]']").eq(
                                element_idx).append('<option value="' + item
                                .flight_number + '">' + item.flight_number +
                                '</option>');
                        });
                    }
                }
            });
        });

        $("#btn_save").on("click", function() {
            let myForm = document.getElementById("frm_hoteldetails");
            var data = new FormData(myForm);
            data.set('id', $("#enq_id").val());
            data.set('arrival_id',"<?php echo $arrivals->id; ?>");
            $("#btn_save").html('Saving...').attr('disabled', 'disabled');
            $.ajax({
                url: "<?php echo base_url('admin/arrivalchart/update_hotel_details'); ?>",
                type: "post",
                data: data,
                dataType: 'JSON',
                contentType: false,
                processData: false,
                beforeSend: function() {},
                success: function(data) {
                    $("#msgDivHotel").html('').html(data.msg);
                    $("#btn_save").html('Save').removeAttr('disabled', 'disabled');
                    if (data.response === "e") {} else if (data.response === "s") {
                        $.each(data.details, function(i, d) {
                            html = '<div class="row"><div class="col-lg-3 div_color" style="border-top: 1px solid #b7c0c7;border-bottom: 1px solid #b7c0c7;border-left: 1px solid #b7c0c7;">';
                            html +=
                                '<div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label is-dirty txt-full-width">';
                            html +=
                                '<input type="date" class="mdl-textfield__input" name="edit_checkin[]" value="' +
                                d.checkin_date +
                                '" readonly="readonly"><label class = "mdl-textfield__label">Check In Date</label></div></div>';
                            html +=
                                '<div class="col-lg-3 div_color" style="border-top: 1px solid #b7c0c7;border-bottom: 1px solid #b7c0c7;border-left: 1px solid #b7c0c7;">';
                            html +=
                                '<div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label is-dirty txt-full-width">';
                            html +=
                                '<input type="date" class="mdl-textfield__input" name="edit_checkout[]" value="' +
                                d.checkout_date +
                                '" readonly="readonly"><label class = "mdl-textfield__label">Check Out Date</label></div></div>';
                            html +=
                                '<div class="col-lg-4 div_color" style="border: 1px solid #b7c0c7;">';
                            html +=
                                '<div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label is-dirty txt-full-width">';
                            html +=
                                '<input type="text" class="mdl-textfield__input" value="' +
                                d.hotel_name +
                                '" readonly="readonly"><label class = "mdl-textfield__label">Hotel</label></div></div>';
                            html +=
                                '<div class="col-lg-1 div_color" style="border-top: 1px solid #b7c0c7;border-bottom: 1px solid #b7c0c7;border-right: 1px solid #b7c0c7;padding:22px;">';
                            html +=
                                '<button type="button" data-module="arrival_hotels" class="btn btn-danger btn-xs arrival-hotel-remove" data-id="' +
                                d.id +
                                '" title="Remove">Remove</button></div></div>';
                            $(html).insertBefore(".hotel_details_cls:eq(0)");
                        });
                        $("input[name='hotel[]']").eq(0).val('');
                        $("input[name='hotel_ids[]']").eq(0).val('');
                        var cnt = $(".hotel_details_cls").length;
                        var ele = [];
                        for (var i = 1; i <= cnt - 1; i++) {
                            ele[i - 1] = '.hotel_details_cls:eq(' + i + ')';
                        }
                        $(ele.toString()).remove();
                    }
                }
            });
        });

        var date_map = [];
        for (var i = 1; i <= 31; i++) {
            if (i < 10) {
                date_map[i] = "0" + i;
            } else {
                date_map[i] = i;
            }
        }

        $(".check-dts, #arrival_date ").on("change", function() {
            //if($('.check-dts:eq(0)').val()==="" || $('.check-dts:eq(1)').val()==="") { return false; }
            var pre = new Date($('#arrival_date').val());
            var smallest = new Date($('.check-dts:eq(0)').val());
            $(".check-dts").each(function(index, element) {
                var last = new Date($('.check-dts:eq(' + index + ')').val());
                if (smallest > last) {
                    smallest = last;
                }
            });

            var selectedDate_new = new Date(smallest.getFullYear() + "-" + date_map[smallest
                .getMonth() +
                1] + "-" + date_map[smallest.getDate()]);
            var options_new = {
                year: 'numeric',
                month: 'short',
                day: '2-digit'
            };

            if (pre < smallest) {
                alert('Physical arrival date must be equal to or greater than check-in date.');
                $("#arrival_date").val(smallest.getFullYear() + "-" + date_map[smallest.getMonth() +
                    1] + "-" + date_map[smallest.getDate()]);
                $(".dt-dateformat-show").eq(0).val(selectedDate_new.toLocaleDateString('en-IN',
                    options_new));
                //return false;
            } else if (dateDiffInDays(smallest, pre) > 1) {
                alert('Physical arrival date cannot be greater than one day from check-in date.');
                $("#arrival_date").val(smallest.getFullYear() + "-" + date_map[smallest.getMonth() +
                    1] + "-" + date_map[smallest.getDate()]);
                $(".dt-dateformat-show").eq(0).val(selectedDate_new.toLocaleDateString('en-IN',
                    options_new));
                //return false;
            } else {
                $("#hdn_arrival_date").val($("#arrival_date").val());
            }
        });

        $("#frm_hoteldetails").on("click", ".arrival-hotel-remove", function(e) {
            if (!confirm('Are You Sure? All hotel, roomimg and persons list will be removed!')) {
                return false;
            }
            e.preventDefault();
            var ele = $(this);
            $.ajax({
                url: "<?php echo site_url('admin/arrivalchart/edit_remove_hotel_details'); ?>",
                type: "post",
                data: {
                    'id': ele.attr("data-id"),
                    'enq_id': $("#enq_id").val()
                },
                dataType: 'JSON',
                //contentType : false,
                //processData: false,
                beforeSend: function() {},
                success: function(res) {
                    if (res.response === "s") {
                        window.location.reload();
                    }
                }
            });
        });

        $("#frm_roomdetails").on("blur", ".room-childs", function(e) {
            var ele = $(this);
            var idx = ele.index(".room-childs");
            if (ele.val() === '0') {
                $(".room-childbed").eq(idx).val('N/A').css('pointer-events', 'none').parent()
                    .addClass("is-dirty");
            } else {
                $(".room-childbed").eq(idx).css('pointer-events', '');
            }
        });

        $("#frm_hoteldetails").on("change", ".dt-dateformat", function() {
            var idx = $(this).index(".dt-dateformat");
            const selectedDate = new Date($(".dt-dateformat").eq(idx).val());
            //const lastDayDate = new Date(selectedDate.getFullYear(), selectedDate.getMonth() + 1, 0);
            const options = {
                year: 'numeric',
                month: 'short',
                day: '2-digit'
            };
            const formattedDate = selectedDate.toLocaleDateString('en-IN', options);

            if ($(".dt-dateformat").eq(idx).val() != "" && formattedDate != "Invalid Date") {
                $(".dt-dateformat-show").eq(idx).val(formattedDate).parent().addClass('is-focused');
            } else {
                $(".dt-dateformat-show").eq(idx).val('');
            }
        });

        $("#frm_roomdetails").on("change", ".dt-dateformat-rooms", function() {
            var idx = $(this).index(".dt-dateformat-rooms");
            const selectedDate = new Date($(".dt-dateformat-rooms").eq(idx).val());
            //const lastDayDate = new Date(selectedDate.getFullYear(), selectedDate.getMonth() + 1, 0);
            const options = {
                year: 'numeric',
                month: 'short',
                day: '2-digit'
            };
            const formattedDate = selectedDate.toLocaleDateString('en-IN', options);
            if ($(".dt-dateformat-rooms").eq(idx).val() != "" && formattedDate != "Invalid Date") {
                $(".dt-dateformat-rooms-show").eq(idx).val(formattedDate).parent().addClass(
                    'is-focused');
            } else {
                $(".dt-dateformat-rooms-show").eq(idx).val('');
            }
        });

        $("#frm_flightdetails").on("change", ".dt-dateformat-flights", function() {
            var idx = $(this).index(".dt-dateformat-flights");
            const selectedDate = new Date($(".dt-dateformat-flights").eq(idx).val());
            //const lastDayDate = new Date(selectedDate.getFullYear(), selectedDate.getMonth() + 1, 0);
            const options = {
                year: 'numeric',
                month: 'short',
                day: '2-digit'
            };
            const formattedDate = selectedDate.toLocaleDateString('en-IN', options);
            if ($(".dt-dateformat-flights").eq(idx).val() != "" && formattedDate !=
                "Invalid Date") {
                $(".dt-dateformat-flights-show").eq(idx).val(formattedDate).parent().addClass(
                    'is-focused');
            } else {
                $(".dt-dateformat-flights-show").eq(idx).val('');
            }
        });

    });

    function dateDiffInDays(a, b) {
        const _MS_PER_DAY = 1000 * 60 * 60 * 24;
        // Discard the time and time-zone information.
        const utc1 = Date.UTC(a.getFullYear(), a.getMonth(), a.getDate());
        const utc2 = Date.UTC(b.getFullYear(), b.getMonth(), b.getDate());
        return Math.floor((utc2 - utc1) / _MS_PER_DAY);
    }

    function formSubmit() {
        event.preventDefault();
        let myForm = document.getElementById("frm_persondetails");
        var data = new FormData(myForm);
        data.set('id', $("#enq_id").val());
        $("#btn_personaldetails").attr("disabled", "disabled");
        $.ajax({
            url: "<?php echo site_url('edit_personal_details'); ?>",
            type: "post",
            data: data,
            dataType: 'JSON',
            contentType: false,
            processData: false,
            success: function(data) {
                $("#msgDivperson").html("").html(data.msg);
                $("#btn_personaldetails").removeAttr("disabled");
                if (data.response === "s") {
                    window.location.reload();
                }
            }
        });
    }

    $('.room_category_select').change(function() {
        var cat_id = $(this).find('option:selected').data('cat_id');
        $('#room_category_id').val(cat_id);
    });

    function formSubmitRooms() {
        event.preventDefault();
        let myForm = document.getElementById("frm_roomdetails");
        var data = new FormData(myForm);
        data.set('id', $("#enq_id").val());
        data.set('hotels_cnt', $('#roominglist_hotels option').length - 1);
        data.set('enquiry_no', $('#enquiry_no').val());
        $("#btn_roomdetails").attr("disabled", "disabled");
        $.ajax({
            url: "<?php echo site_url('edit_room_details'); ?>",
            type: "post",
            data: data,
            dataType: 'JSON',
            contentType: false,
            processData: false,
            success: function(data) {
                $("#msgDivroom").html("").html(data.msg);
                $("#btn_roomdetails").removeAttr("disabled");
                if (data.response === "s") {
                    window.location.reload();
                }
            }
        });
    }

    function formSubmitFlights() {
        event.preventDefault();
        var flight = 0; //$(".flight-modes").length;

        $(".flight-modes").each(function(i, d) {
            if ($(".airline-names").eq(i).val() !== '' && $(".airline-names").eq(i).val() !== undefined) {
                flight++;
            }
        });

        /*if (flight > 2) {
            if (!confirm('Added more than two(2) flight details.')) {
                return false;
            }
        }
        var flight_mode = '';
        for (var i = 0; i < flight; i++) {
            if (flight_mode === $(".flight-modes option:selected").eq(i).val()) {
                alert('Added same flight modes.');
                return false;
            }
            flight_mode = $(".flight-modes option:selected").eq(i).val();
        }*/

        let myForm = document.getElementById("frm_flightdetails");
        var data = new FormData(myForm);
        data.set('id', $("#enq_id").val());
        data.set('arrival_id',$('#arrival_ids').val());
        $("#btn_flightdetails").attr("disabled", "disabled");
        $.ajax({
            url: "<?php echo site_url('edit_flight_details'); ?>",
            type: "post",
            data: data,
            dataType: 'JSON',
            contentType: false,
            processData: false,
            success: function(data) {
                $("#msgflightDiv").html("").html(data.msg);
                $("#btn_flightdetails").removeAttr("disabled");
                if (data.response === "s") {
                    window.location.reload();
                }
            }
        });
    }

    function add_element(id) {
        event.preventDefault();
        $("#roominglist_hotels").val("");
        var x = Math.floor((Math.random() * 1000) + 1);
        var h = $("#" + id).clone().attr('id', id + '_' + x);
        h.find('input').val('');
        h.find('select').val('');
        h.find(".room-category").empty();
        h.append(
            '<i title="Remove" class="fa fa-remove" style="color:red;cursor: pointer;float: right;margin-top: -15px;position:relative;"></i>'
        );
        h.insertAfter("." + id + "_cls:last");
    }

    function add_ele_hotel(id) {
        event.preventDefault();
        var checkout = $("input[name='check_out[]']").length;
        var x = Math.floor((Math.random() * 1000) + 1);
        var h = $("#" + id).clone().attr('id', id + '_' + x).css("margin-top", "5px");
        h.find('input').val("");
        h.append(
            '<div class="col-lg-1"><i title="Remove" class="fa fa-remove" style="color:red;cursor: pointer;margin-top: -15px;position:relative;"></i></div>'
        );
        h.insertAfter("." + id + "_cls:last");
        //var d  = new Date($("input[name='check_out[]']").eq(checkout-1).val());
        $("input[name='check_in[]']").eq(checkout).val($("input[name='check_out[]']").eq(checkout - 1).val());
        $("input[name='check_out[]']").eq(checkout).val($("input[name='check_out[]']").eq(checkout - 1).val());

        var l = $(".dt-dateformat-show").length;
        $(".dt-dateformat-show").eq(l - 1).val($(".dt-dateformat-show").eq(l - 3).val());
        $(".dt-dateformat-show").eq(l - 2).val($(".dt-dateformat-show").eq(l - 3).val());
    }
</script>

<script>
    $(document).ready(function() {
        var responseData;

        $('#meal_type').on('change', function() {
            var selectedValue = $(this).val();
            if (selectedValue === '5') {
                var cuisineType = $('#cuisine_type');
                // console.log(cuisineType)
                cuisineType.empty();
                cuisineType.append($('<option>', {
                    value: ''
                }).text('Select Type'));
                cuisineType.append($('<option>', {
                    value: 'mocktail'
                }).text('Mocktail'));
                cuisineType.append($('<option>', {
                    value: 'cocktail'
                }).text('Cocktail'));
            } else {
                var cuisineType = $('#cuisine_type');
                // console.log(cuisineType)
                cuisineType.empty();
                cuisineType.append($('<option>', {
                    value: ''
                }).text('Select Type'));
                cuisineType.append($('<option>', {
                    value: 'veg'
                }).text('Veg'));
                cuisineType.append($('<option>', {
                    value: 'non_veg'
                }).text('Non Veg'));
                cuisineType.append($('<option>', {
                    value: 'vegan'
                }).text('Vegan'));
            }
        });

        $('#btn-dismiss').click(function(e) {
            $('#response-message').html('');
            $('#buffet').val('');
            $('#restaurant').val('');
            $('#opening_time').val('');
            $('#closing_time').val('');
            $('#no_of_person').val('');
            $('#no_of_veg_person').val('');
            $('#no_of_non_veg_person').val('');
            $('#no_of_vegan_person').val('');
            $('#no_of_jain_meal').val('');
            $('#meal_cuisine_type').val('');
            $('#meal_type').val('');
            $('#cuisine_type').val('');
            var tableBody = $('#example4 .tbody');
            tableBody.empty();
            var itemContainer = $('.col-lg-4.p-t-20.last');
            itemContainer.empty();
            $('#cuisine_type').val('');
            $('#refresh-restaurant').trigger('click');
        });

        $('#arr_id, #date, #buffet, #restaurant').change(function() {
            var encodedValue = $('#arr_id').val();
            var arrId = atob(encodedValue);
            var date = $('#date').val();
            var buffet = $('#buffet').val();
            var restaurant = $('#restaurant').val();
            $('#meal_cuisine_type').val('');
            $('#meal_type').val('');
            $('#cuisine_type').val('');
            var tableBody = $('#example4 .tbody');
            tableBody.empty();
            var itemContainer = $('.col-lg-4.p-t-20.last');
            itemContainer.empty();

            if (arrId && date && buffet && restaurant) {
                $.ajax({
                    url: 'check-data-availability/' + arrId + '/' + date + '/' +
                        buffet +
                        '/' + restaurant,
                    type: 'GET',
                    dataType: 'JSON',
                    success: function(response) {
                        responseData = response; // Store the response data
                        console.log(responseData)
                        var itemContainer = $('.col-lg-4.p-t-20.last');

                        // Empty the container before appending new items
                        itemContainer.empty();

                        // Initialize an object to store cuisine items by meal_type
                        var cuisineByMealType = {};

                        // Group cuisine items by meal_type
                        $.each(response.details, function(index, item) {
                            if (!cuisineByMealType[item.meal_type]) {
                                cuisineByMealType[item.meal_type] = [];
                            }
                            cuisineByMealType[item.meal_type].push(item);
                        });

                        // Iterate over each meal_type
                        $.each(cuisineByMealType, function(mealType, items) {
                            // Create a div for each meal_type
                            var mealTypeDiv;
                            if (mealType === '1') {
                                mealTypeDiv = $(
                                    '<div class="meal-type">APPETIZERS OR STARTERS</div>'
                                );
                            } else if (mealType === '2') {
                                mealTypeDiv = $(
                                    '<div class="meal-type">ENTREES OR MAIN COURSE</div>'
                                );
                            } else if (mealType === '3') {
                                mealTypeDiv = $(
                                    '<div class="meal8-type">SIDES OR SIDE DISHES</div>'
                                );
                            } else if (mealType === '4') {
                                mealTypeDiv = $(
                                    '<div class="meal-type">DESSERT</div>'
                                );
                            } else if (mealType === '5') {
                                mealTypeDiv = $(
                                    '<div class="meal-type">BEVERAGES</div>'
                                );
                            } else if (mealType === '6') {
                                mealTypeDiv = $(
                                    '<div class="meal-type">SPECIALS OR CHEF RECOMMENDATIONS</div>'
                                );
                            } else if (mealType === '7') {
                                mealTypeDiv = $(
                                    '<div class="meal-type">KID MENU</div>'
                                );
                            } else if (mealType === '8') {
                                mealTypeDiv = $(
                                    '<div class="meal-type">HEALTHY OR LIGHTER OPTIONS</div>'
                                );
                            } else if (mealType === '9') {
                                mealTypeDiv = $(
                                    '<div class="meal-type">EXTRA OR ADD ONS</div>'
                                );
                            } else if (mealType === '10') {
                                mealTypeDiv = $(
                                    '<div class="meal-type">Breads</div>'
                                );
                            } else if (mealType === '11') {
                                mealTypeDiv = $(
                                    '<div class="meal-type">High Tea</div>'
                                );
                            } else {
                                mealTypeDiv = $('<div class="meal-type">' +
                                    mealType + '</div>');
                            }

                            // Append the meal_type div to the container
                            itemContainer.append(mealTypeDiv);

                            // Append the meal_type div to the container
                            itemContainer.append(mealTypeDiv);

                            // Iterate over each item in the meal_type
                            $.each(items, function(index, item) {
                                // Split the cuisine string into an array of items
                                var cuisines = item.cuisine.split(',');

                                // Iterate over each item in the cuisines array
                                $.each(cuisines, function(i, cuisine) {
                                    // Create a new element for each cuisine item
                                    var cuisineElement = $(
                                        '<div class="cuisine-item">' +
                                        '<span class="index">' +
                                        ((index * cuisines
                                                .length) +
                                            i + 1) +
                                        '</span>' +
                                        '<span class="name">' +
                                        cuisine.trim() +
                                        '</span>' +
                                        '<button class="delete-btn-for-cuisine" data-meal_type="' +
                                        item.meal_type +
                                        '"  data-id="' +
                                        item.id +
                                        '">Delete</button>' +
                                        '</div>');

                                    // Append the cuisine item element to the meal_type div
                                    mealTypeDiv.append(
                                        cuisineElement);
                                });
                            });
                        });

                        // Update the UI elements
                        $('#opening_time').val(response.details[0].opening_time);
                        $('#closing_time').val(response.details[0].closing_time);
                        $('#no_of_person').val(response.details[0].no_of_person);
                        $('#no_of_veg_person').val(response.details[0]
                            .no_of_veg_person);
                        $('#no_of_non_veg_person').val(response.details[0]
                            .no_of_non_veg_person);
                        $('#no_of_vegan_person').val(response.details[0]
                            .no_of_vegan_person);
                        $('#no_of_jain_meal').val(response.details[0].no_of_jain_meal);
                    },
                    error: function(xhr, status, error) {
                        // Handle errors here
                        console.log("Error:", status, error);
                        // Empty the container
                        $('.col-lg-4.p-t-20.last').empty();
                    }
                });
            }
        });

        $(document).on('click', '.delete-btn-for-cuisine', function(e) {
            e.preventDefault();

            var itemId = $(this).data('id');
            var cuisineElement = $(this).closest('.cuisine-item');

            // Send an AJAX request to delete the item
            $.ajax({
                url: 'menu-master-cuisine-delete/' + itemId,
                type: 'POST',
                dataType: 'json',
                success: function(response) {
                    // Check if the deletion was successful
                    if (response.success) {
                        // Remove the table row
                        cuisineElement.remove();
                        alert('Item deleted successfully.');
                    } else {
                        alert('Failed to delete item. Permission Denied!');
                    }
                },
                error: function() {
                    alert('Failed to delete item.');
                }
            });
        });

        $('#meal_cuisine_type,#meal_type, #cuisine_type').change(function() {
            var mealCuisineTypeId = $('#meal_cuisine_type').val();
            var mealTypeId = $('#meal_type').val();
            var cuisineType = $('#cuisine_type').val();
            $("#msg").html("");
            $('#cuisine_field').prop('readonly', false);
            $('#cuisine_field').val('');

            // Check if both mealTypeId and cuisineType are selected
            if (mealTypeId && mealTypeId && cuisineType) {
                $.ajax({
                    url: 'restaurantmenumaster_menu/' + mealCuisineTypeId + '/' +
                        mealTypeId + '/' +
                        cuisineType,
                    type: 'GET',
                    dataType: 'JSON',
                    success: function(response) {
                        responseData = response; // Store the response data
                        var tableBody = $('#example4 .tbody');
                        tableBody.empty(); // Clear existing table rows
                        $("#cuisine_field").empty();
                        $.each(response.details, function(index, item) {
                            // Split the cuisine string into an array of items
                            var cuisines = item.cuisine.split(',');

                            // Iterate over each item in the cuisines array
                            $.each(cuisines, function(i, cuisine) {
                                // Create a new row for each cuisine item
                                /*var row = '<tr>' +
                                                                        // Display the main index
                                                                        '<td class="center">' +
                                                                        (index *
                                                                            cuisines.length +
                                                                            i + 1) +
                                                                        '</td>' +
                                                                        // Display the cuisine item
                                                                        '<td class="center">' +
                                                                        cuisine
                                                                        .trim() + '</td>' +
                                                                        // Use trim to remove any leading or trailing whitespace
                                                                        '<td class="center">' +
                                                                        '<a class="add-item-btn btn btn-info" data-id="' +
                                                                        item.id +
                                                                        '">Add</a>' +
                                                                        '</td>' +
                                                                        '</tr>';
                                
                                                                    // Append the row to the table body
                                                                    tableBody.append(row);*/

                                $("#cuisine_field").append(
                                    '<option value="' + item
                                    .id + '">' + cuisine.trim() +
                                    '</option>');

                            });
                        });
                    }

                });
            } else {
                var tableBody = $('#example4 .tbody');
                tableBody.empty(); // Clear existing table rows
            }
        });

        // $('.js-example-basic-multiple').select2({
        //     //theme: 'filled',
        //     placeholder: 'Select Cuisine Item',

        // });
        
         $('#modalUpdateRestaurantMenu').on('shown.bs.modal', function () {
            $('#cuisine_field').select2({
                dropdownParent: $('#modalUpdateRestaurantMenu'),
                width: '100%',
                placeholder: 'Select cuisines'
            });
        });


        var formData = {
            date: [],
            buffet: [],
            opening_time: [],
            closing_time: [],
            restaurant: [],
            no_of_person: [],
            no_of_veg_person: [],
            no_of_non_veg_person: [],
            no_of_vegan_person: [],
            no_of_jain_meal: [],
            meal_cuisine_type: [],
            meal_type: [],
            cuisine: []
        };

        $('.add-item-btn').on('click', function() {

            var fieldNames = {
                '#date': 'Date',
                '#buffet': 'Buffet',
                '#restaurant': 'Restaurant',
                '#opening_time': 'Start time',
                '#closing_time': 'End time',
                '#no_of_person': 'Number of persons',
                '#meal_cuisine_type': 'Meal Cuisine Type',
                '#meal_type': 'Meal Type',
                '#cuisine_type': 'Cuisine Type'
            };

            // Check if any required field is empty
            for (var fieldId in fieldNames) {
                if (!$(fieldId).val()) {
                    var fieldName = fieldNames[fieldId];
                    alert(fieldName + ' is required.');
                    $('#meal_cuisine_type, #meal_type, #cuisine_type, #cuisine_field').val('');
                    return;
                }
            }

            // Get the values of all input fields
            var noOfPerson = parseInt($('#no_of_person').val()) || 0;
            var noOfVegPerson = parseInt($('#no_of_veg_person').val()) || 0;
            var noOfNonVegPerson = parseInt($('#no_of_non_veg_person').val()) || 0;
            var noOfVeganPerson = parseInt($('#no_of_vegan_person').val()) || 0;
            var noOfJainMeal = parseInt($('#no_of_jain_meal').val()) || 0;

            // Calculate the sum of all input values
            var sum = noOfVegPerson + noOfNonVegPerson + noOfVeganPerson + noOfJainMeal;

            // Check if the sum is not equal to the value of #no_of_person
            if (noOfPerson !== sum) {
                alert(
                    'The sum of vegetarian, non-vegetarian, vegan, and Jain meals should be equal to the total number of persons.'
                );
                return;
            }
            var cnt = 0;
            $("#msg").html("");
            $.each($("#cuisine_field").val(), function(idx, item_id) {
                var itemId = item_id;
                var item = responseData.details.find(item => item.id == itemId);
                var selectedDate = $('#date').val();
                var selectedBuffet = $('#buffet').val();
                var selectedCuisineMealType = $('#meal_cuisine_type').val();
                var selectedMealType = $('#meal_type').val();

                // Check if the cuisine for the selected item already exists
                var existingItem = $('.col-lg-4.p-t-20.last .cuisine-item[data-date="' +
                    selectedDate +
                    '"][data-meal-type="' + selectedMealType + '"][data-cuisine="' +
                    item.cuisine +
                    '"]');

                if (existingItem.length > 0) {
                    //alert('This cuisine is already added.');
                    cnt++;
                    $("#msg").html('<div class="alert alert-warning">' + cnt +
                        ' items cannot be added. As already added.</div>');
                    return;
                }

                // Check if the div with the selectedMealType already exists
                var cuisineTable = $('#' + selectedMealType);

                var selectValue = selectedMealType
                var option = document.querySelector('#meal_type option[value="' +
                    selectValue + '"]');
                var textContent = option.textContent;

                if (cuisineTable.length === 0) {
                    // If it doesn't exist, create the div and append it to the container
                    cuisineTable = $('<div id="' + selectedMealType +
                        '" class="cusine-div"><h6>' + textContent + '</h6></div>');
                    $('.col-lg-4.p-t-20.last').append(cuisineTable);
                }

                var index = cuisineTable.find('tr').length +
                    1;

                var itemHtml =
                    '<tr class="cuisine-item cuisine-item-remove" data-id="' + item.id +
                    '" data-date="' + selectedDate + '" data-cuisine-meal-type="' +
                    selectedCuisineMealType +
                    '" data-meal-type="' + selectedMealType +
                    '" data-cuisine="' + item.cuisine + '">' +
                    '<td style="index">' + index + '.</td>' +
                    '<td style="name"> ' + item.cuisine + '</td>' +
                    // Include the index here
                    '<td><input type="hidden" name="cuisine[]" class="cuisine" id="cuisine" data-id="' +
                    item.id +
                    '" value="' + item.cuisine + '"></td>' +
                    '<td></td><td><button class="remove-item-btn btn btn-xs btn-danger mb-1" data-id="' +
                    item.id + '">Remove</button></td>' +
                    '</tr>';

                // Append itemHtml to the cuisine div
                cuisineTable.append(itemHtml);


                index++;

                // Update form data
                formData.date.push(selectedDate);
                formData.buffet.push($('#buffet').val());
                formData.opening_time.push($('#opening_time').val());
                formData.closing_time.push($('#closing_time').val());
                formData.restaurant.push($('#restaurant').val());
                formData.no_of_person.push($('#no_of_person').val());
                formData.no_of_veg_person.push($('#no_of_veg_person').val());
                formData.no_of_non_veg_person.push($('#no_of_non_veg_person').val());
                formData.no_of_vegan_person.push($('#no_of_vegan_person').val());
                formData.no_of_jain_meal.push($('#no_of_jain_meal').val());
                formData.meal_cuisine_type.push(selectedCuisineMealType);
                formData.meal_type.push(selectedMealType);
                formData.cuisine.push(item.cuisine);

                //console.log(formData); // Display form data in the console
            });
            $("#cuisine_field").val('').trigger('change');
        });

        $('.col-lg-4.p-t-20.last').on('click', '.remove-item-btn', function() {
            var itemId = $(this).data('id');
            var itemDate = $(this).closest('.cuisine-item-remove').data('date');
            $(this).closest('.cuisine-item-remove').remove();

            // Find the index of the item to remove in the formData arrays
            var index = formData.date.findIndex(date => date === itemDate);
            if (index !== -1) {
                // Remove the item at the found index from all arrays
                formData.date.splice(index, 1);
                formData.buffet.splice(index, 1);
                formData.opening_time.splice(index, 1);
                formData.closing_time.splice(index, 1);
                formData.restaurant.splice(index, 1);
                formData.no_of_person.splice(index, 1);
                formData.no_of_veg_person.splice(index, 1);
                formData.no_of_non_veg_person.splice(index, 1);
                formData.no_of_vegan_person.splice(index, 1);
                formData.no_of_jain_meal.splice(index, 1);
                formData.meal_cuisine_type.splice(index, 1);
                formData.meal_type.splice(index, 1);
                formData.cuisine.splice(index, 1);
            }
        });

        function clearFormData() {
            formData.date = [];
            formData.buffet = [];
            formData.opening_time = [];
            formData.closing_time = [];
            formData.restaurant = [];
            formData.no_of_person = [];
            formData.no_of_veg_person = [];
            formData.no_of_non_veg_person = [];
            formData.no_of_vegan_person = [];
            formData.no_of_jain_meal = [];
            formData.meal_cuisine_type = [];
            formData.meal_type = [];
            formData.cuisine = [];
        }

        $('#btn_company').click(function(e) {

            // Check if the form is valid
            if ($('#form-id')[0].checkValidity()) {
                e.preventDefault(); // Prevent the default form submit

                // Serialize the form data
                var formDataSerialized = $('#form-id').serialize();

                // Convert the formData object to a query string
                var formDataQueryString = $.param(formData);

                // Combine both form data sets
                var combinedFormData = formDataSerialized + '&' + formDataQueryString;

                // Make the AJAX call
                $.ajax({
                    url: 'add-master',
                    type: 'POST',
                    dataType: 'JSON',
                    data: combinedFormData, // Pass the combined form data
                    success: function(response) {
                        if (response.response === 'success') {
                            $('#response-message').addClass('text-success').removeClass(
                                    'text-danger')
                                .text(response.msg);

                            // Clear the form fields
                            $('#form-id')[0].reset();

                            clearFormData();

                            // Scroll to the top of the page
                            $('html, body').animate({
                                scrollTop: 0
                            }, 'slow');
                        }

                        $("#cuisine_field").empty();
                        var tableBody = $('#example4 .tbody');
                        tableBody.empty();
                        var itemContainer = $('.col-lg-4.p-t-20.last');
                        itemContainer.empty();
                    },
                    error: function(xhr, status, error) {
                        // Handle error response
                        console.error('Error inserting data:', error);
                        $('#response-message').text(
                                'Error inserting data. Please try again.')
                            .addClass(
                                'text-danger');
                    }
                });
            }
        });

        $('#refresh-menu ,#addRestaurantMenu').click(function() {
            var encodedValue = $('#arr_id').val();
            var arrId = atob(encodedValue);

            if (arrId) { // Check if arrId exists
                $.ajax({
                    url: 'restaurant-menus-availability/' + arrId,
                    type: 'GET',
                    dataType: 'JSON',
                    success: function(response) {
                        var tableBody = $('#example3 tbody');
                        tableBody.empty(); // Clear existing table rows
                        if (response.details.length > 0) {
                            $("#no_of_person").val(response.details[0].no_of_person);
                            $("#no_of_veg_person").val(response.details[0]
                                .no_of_veg_person);
                            $("#no_of_non_veg_person").val(response.details[0]
                                .no_of_non_veg_person);
                            $("#no_of_vegan_person").val(response.details[0]
                                .no_of_vegan_person);
                            $("#no_of_jain_meal").val(response.details[0]
                                .no_of_jain_meal);
                        }
                        // Loop through the response data and append rows to the table
                        $.each(response.details, function(index, item) {

                            var menuType = item.menu_type.replace(/_/g, ' ')
                                .replace(/\b\w/g, function(char) {
                                    return char.toUpperCase();
                                });

                            var formattedDate = moment(item.date).format(
                                'DD-MMMM-YYYY');

                            var row = '<tr>' +
                                '<td class="">' + (index + 1) + '</td>' +
                                '<td class="center">' + formattedDate +
                                '</td>' +
                                '<td class="center" style="padding-left: 0px;">' +
                                item.buffet + '</td>' +
                                '<td class="center">' + item.opening_time +
                                '</td>' +
                                '<td class="center">' + item.closing_time +
                                '</td>' +
                                '<td class="center">' + item.no_of_person +
                                '</td>' +
                                '<td class="center">' + item.names +
                                '</td>' +
                                '<td class="center" style="margin-left:10px"><a href="#" class="btn btn-xs btn-primary edit-menu" data-toggle="modal" data-target="#modalUpdateRestaurantMenu" data-arrivalsid="' +
                                item.arr_id + '" data-date="' + item
                                .date + '" data-buffet="' + item.buffet +
                                '" data-restaurant="' + item.restaurant_id +
                                '" data-opening="' + item.opening_time +
                                '"  data-closing="' + item.closing_time +
                                '" data-person="' + item.no_of_person +
                                '" data-veg="' + item.no_of_veg_person +
                                '" data-non_veg="' + item.no_of_non_veg_person +
                                '" data-vegan="' + item.no_of_vegan_person +
                                '" data-jain="' + item.no_of_jain_meal +
                                '" >Edit</a>' +
                                '<a href="#" class="btn btn-danger btn-xs delete-menus" data-arrivalsid="' +
                                item.arr_id + '" data-date="' + item
                                .date + '" data-buffet="' + item.buffet +
                                '" data-restaurant="' + item.restaurant_id +
                                '" >Delete</a></td>' +
                                '</tr>';
                            tableBody.append(row);
                        });
                    }
                });
            }
        });

        // $(document).on('click', '.edit-menu', function() {
        //     document.getElementById('udh4').textContent = 'Update Restaurant Menu';
        //     document.getElementById('udch').textContent = 'Update Restaurant Menu';
        //     var encodedValue = $('#arr_id').val();
        //     var arrId = atob(encodedValue);
        //     var date = $(this).data('date');
        //     var buffet = $(this).data('buffet');
        //     var restaurant = $(this).data('restaurant');
        //     var opening_time = $(this).data('opening');
        //     var closing_time = $(this).data('closing');
        //     var no_of_person = $(this).data('person');
        //     var no_of_veg_person = $(this).data('veg');
        //     var no_of_non_veg_person = $(this).data('non_veg');
        //     var no_of_vegan_person = $(this).data('vegan');
        //     var no_of_jain_meal = $(this).data('jain');

        //     var packed = $(this).data('packed');
        //     var vegRemark = $(this).data('veg_remark');
        //     var nonVegRemark = $(this).data('non_veg_remark');
        //     var veganRemark = $(this).data('vegan_remark');
        //     var jainMealRemark = $(this).data('jain_meal_remark');
        //     var finalRemark = $(this).data('final_remark');

        //     if (arrId && date && buffet && restaurant) {
        //         $.ajax({
        //             url: 'check-data-availability/' + arrId + '/' + date + '/' +
        //                 buffet +
        //                 '/' + restaurant,
        //             type: 'GET',
        //             dataType: 'JSON',
        //             success: function(response) {
        //                 responseData = response; // Store the response data
        //                 var itemContainer = $('.col-lg-4.p-t-20.last');

        //                 // Empty the container before appending new items
        //                 itemContainer.empty();

        //                 // Initialize an object to store cuisine items by meal_type
        //                 var cuisineByMealType = {};

        //                 // Group cuisine items by meal_type
        //                 $.each(response.details, function(index, item) {
        //                     if (!cuisineByMealType[item.meal_type]) {
        //                         cuisineByMealType[item.meal_type] = [];
        //                     }
        //                     cuisineByMealType[item.meal_type].push(item);
        //                 });

        //                 // Iterate over each meal_type
        //                 $.each(cuisineByMealType, function(mealType, items) {

        //                     var mealTypeDiv;
        //                     if (mealType === '1') {
        //                         mealTypeDiv = $(
        //                             '<div class="meal-type">APPETIZERS OR STARTERS</div>'
        //                         );
        //                     } else if (mealType === '2') {
        //                         mealTypeDiv = $(
        //                             '<div class="meal-type">ENTREES OR MAIN COURSE</div>'
        //                         );
        //                     } else if (mealType === '3') {
        //                         mealTypeDiv = $(
        //                             '<div class="meal8-type">SIDES OR SIDE DISHES</div>'
        //                         );
        //                     } else if (mealType === '4') {
        //                         mealTypeDiv = $(
        //                             '<div class="meal-type">DESSERT</div>'
        //                         );
        //                     } else if (mealType === '5') {
        //                         mealTypeDiv = $(
        //                             '<div class="meal-type">BEVERAGES</div>'
        //                         );
        //                     } else if (mealType === '6') {
        //                         mealTypeDiv = $(
        //                             '<div class="meal-type">SPECIALS OR CHEF RECOMMENDATIONS</div>'
        //                         );
        //                     } else if (mealType === '7') {
        //                         mealTypeDiv = $(
        //                             '<div class="meal-type">KID MENU</div>'
        //                         );
        //                     } else if (mealType === '8') {
        //                         mealTypeDiv = $(
        //                             '<div class="meal-type">HEALTHY OR LIGHTER OPTIONS</div>'
        //                         );
        //                     } else if (mealType === '9') {
        //                         mealTypeDiv = $(
        //                             '<div class="meal-type">EXTRA OR ADD ONS</div>'
        //                         );
        //                     } else if (mealType === '10') {
        //                         mealTypeDiv = $(
        //                             '<div class="meal-type">Breads</div>'
        //                         );
        //                     } else if (mealType === '11') {
        //                         mealTypeDiv = $(
        //                             '<div class="meal-type">High Tea</div>'
        //                         );
        //                     } else {
        //                         mealTypeDiv = $('<div class="meal-type">' +
        //                             mealType + '</div>');
        //                     }

        //                     // Append the meal_type div to the container
        //                     itemContainer.append(mealTypeDiv);

        //                     // Iterate over each item in the meal_type
        //                     $.each(items, function(index, item) {
        //                         // Split the cuisine string into an array of items
        //                         var cuisines = item.cuisine.split(',');

        //                         // Iterate over each item in the cuisines array
        //                         $.each(cuisines, function(i, cuisine) {
        //                             // Create a new element for each cuisine item
        //                             var cuisineElement = $(
        //                                 '<div class="cuisine-item">' +
        //                                 '<span class="index">' +
        //                                 ((index * cuisines
        //                                         .length) +
        //                                     i + 1) +
        //                                 '</span>' +
        //                                 '<span class="name">' +
        //                                 cuisine.trim() +
        //                                 '</span>' +
        //                                 '<button class="delete-btn-for-cuisine" data-meal_type="' +
        //                                 item.meal_type +
        //                                 '" data-id="' +
        //                                 item.id +
        //                                 '">Delete</button>' +
        //                                 '</div>');

        //                             // Append the cuisine item element to the meal_type div
        //                             mealTypeDiv.append(
        //                                 cuisineElement);
        //                         });
        //                     });
        //                 });

        //                 $('#date').val(date);
        //                 $('#buffet').val(buffet);
        //                 $('#restaurant').val(restaurant);
        //                 $('#opening_time').val(opening_time);
        //                 $('#closing_time').val(closing_time);
        //                 if (no_of_person !== null) {
        //                     $('#no_of_person').val(no_of_person);
        //                     $('#no_of_veg_person').val(no_of_veg_person);
        //                     $('#no_of_non_veg_person').val(no_of_non_veg_person);
        //                     $('#no_of_vegan_person').val(no_of_vegan_person);
        //                     $('#no_of_jain_meal').val(no_of_jain_meal);
        //                     //} 
        //                     // else if (no_of_person === null) {
        //                     //     $('#no_of_person').val($('#number_persons').val());
        //                     //     $('#no_of_veg_person').val(0);
        //                     //     $('#no_of_non_veg_person').val(0);
        //                     //     $('#no_of_vegan_person').val(0);
        //                     //     $('#no_of_jain_meal').val(0);
        //                 } else {
        //                     // Update the UI elements
        //                     $('#no_of_person').val(response.persons[0].no_of_person);
        //                     $('#no_of_veg_person').val(response.persons[0].no_of_veg_person);
        //                     $('#no_of_non_veg_person').val(response.persons[0].no_of_non_veg_person);
        //                     $('#no_of_vegan_person').val(response.persons[0].no_of_vegan_person);
        //                     $('#no_of_jain_meal').val(response.persons[0].no_of_jain_meal);
        //                 }

        //                 if (packed == 1) {
        //                     $('#packed').prop('checked', true);
        //                 }
        //                 $('#final_remark').val(finalRemark);
        //             }
        //         });
        //     }
        // });
          $(document).on('click', '.edit-menu', function() {
            document.getElementById('udh4').textContent = 'Update Restaurant Menu';
            document.getElementById('udch').textContent = 'Update Restaurant Menu';
            var encodedValue = $('#arr_id').val();
            var arrId = atob(encodedValue);
            var date = $(this).data('date');
            var buffet = $(this).data('buffet');
            var restaurant = $(this).data('restaurant');
            var opening_time = $(this).data('opening');
            var closing_time = $(this).data('closing');
            var no_of_person = $(this).data('person');
            var no_of_veg_person = $(this).data('veg');
            var no_of_non_veg_person = $(this).data('non_veg');
            var no_of_vegan_person = $(this).data('vegan');
            var no_of_jain_meal = $(this).data('jain');

            var packed = $(this).data('packed');
            var vegRemark = $(this).data('veg_remark');
            var nonVegRemark = $(this).data('non_veg_remark');
            var veganRemark = $(this).data('vegan_remark');
            var jainMealRemark = $(this).data('jain_meal_remark');
            var finalRemark = $(this).data('final_remark');

            // ================= DATE FORMAT CONVERT (yyyy-mm-dd -> dd-Mon-yyyy) =================
            function formatDateToDDMonYYYY(inputDate) {
                if (!inputDate) return '';

                var parts = inputDate.split('-');

                if (parts.length !== 3) return inputDate;

                var year, month, day;

                if (parts[0].length === 4) {
                    year = parts[0];
                    month = parts[1];
                    day = parts[2];
                } else {
                    day = parts[0];
                    month = parts[1];
                    year = parts[2];
                }

                var monthNames = [
                    'Jan', 'Feb', 'Mar', 'Apr', 'May', 'June',
                    'July', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec'
                ];

                var monthIndex = parseInt(month, 10) - 1;
                var monthName = monthNames[monthIndex] || month;

                return day + '-' + monthName + '-' + year;
            }

            var formattedDate = formatDateToDDMonYYYY(date);
            // =====================================================================================

          if (arrId && date && buffet && restaurant) {
                $.ajax({
                    url: 'check-data-availability/' + arrId + '/' + date + '/' +
                        buffet +
                        '/' + restaurant,
                    type: 'GET',
                    dataType: 'JSON',
                    success: function(response) {
                        responseData = response; // Store the response data
                        var itemContainer = $('.col-lg-4.p-t-20.last');

                        // Empty the container before appending new items
                        itemContainer.empty();

                        // Initialize an object to store cuisine items by meal_type
                        var cuisineByMealType = {};

                        // Group cuisine items by meal_type
                        $.each(response.details, function(index, item) {
                            if (!cuisineByMealType[item.meal_type]) {
                                cuisineByMealType[item.meal_type] = [];
                            }
                            cuisineByMealType[item.meal_type].push(item);
                        });

                        // Iterate over each meal_type
                        $.each(cuisineByMealType, function(mealType, items) {

                            var mealTypeDiv;
                            if (mealType === '1') {
                                mealTypeDiv = $(
                                    '<div class="meal-type">APPETIZERS OR STARTERS</div>'
                                );
                            } else if (mealType === '2') {
                                mealTypeDiv = $(
                                    '<div class="meal-type">ENTREES OR MAIN COURSE</div>'
                                );
                            } else if (mealType === '3') {
                                mealTypeDiv = $(
                                    '<div class="meal8-type">SIDES OR SIDE DISHES</div>'
                                );
                            } else if (mealType === '4') {
                                mealTypeDiv = $(
                                    '<div class="meal-type">DESSERT</div>'
                                );
                            } else if (mealType === '5') {
                                mealTypeDiv = $(
                                    '<div class="meal-type">BEVERAGES</div>'
                                );
                            } else if (mealType === '6') {
                                mealTypeDiv = $(
                                    '<div class="meal-type">SPECIALS OR CHEF RECOMMENDATIONS</div>'
                                );
                            } else if (mealType === '7') {
                                mealTypeDiv = $(
                                    '<div class="meal-type">KID MENU</div>'
                                );
                            } else if (mealType === '8') {
                                mealTypeDiv = $(
                                    '<div class="meal-type">HEALTHY OR LIGHTER OPTIONS</div>'
                                );
                            } else if (mealType === '9') {
                                mealTypeDiv = $(
                                    '<div class="meal-type">EXTRA OR ADD ONS</div>'
                                );
                            } else if (mealType === '10') {
                                mealTypeDiv = $(
                                    '<div class="meal-type">Breads</div>'
                                );
                            } else if (mealType === '11') {
                                mealTypeDiv = $(
                                    '<div class="meal-type">High Tea</div>'
                                );
                            } else {
                                mealTypeDiv = $('<div class="meal-type">' +
                                    mealType + '</div>');
                            }

                            // Append the meal_type div to the container
                            itemContainer.append(mealTypeDiv);

                            // Iterate over each item in the meal_type
                            $.each(items, function(index, item) {
                                // Split the cuisine string into an array of items
                                var cuisines = item.cuisine.split(',');

                                // Iterate over each item in the cuisines array
                                $.each(cuisines, function(i, cuisine) {
                                    // Create a new element for each cuisine item
                                    var cuisineElement = $(
                                        '<div class="cuisine-item">' +
                                        '<span class="index">' +
                                        ((index * cuisines
                                                .length) +
                                            i + 1) +
                                        '</span>' +
                                        '<span class="name">' +
                                        cuisine.trim() +
                                        '</span>' +
                                        '<button class="delete-btn-for-cuisine" data-meal_type="' +
                                        item.meal_type +
                                        '" data-id="' +
                                        item.id +
                                        '">Delete</button>' +
                                        '</div>');

                                    // Append the cuisine item element to the meal_type div
                                    mealTypeDiv.append(
                                        cuisineElement);
                                });
                            });
                        });

                        $('#date').val(date);
                        $('#buffet').val(buffet);
                        $('#restaurant').val(restaurant);
                        $('#opening_time').val(opening_time);
                        $('#closing_time').val(closing_time);
                        if (no_of_person !== null) {
                            $('#no_of_person').val(no_of_person);
                            $('#no_of_veg_person').val(no_of_veg_person);
                            $('#no_of_non_veg_person').val(no_of_non_veg_person);
                            $('#no_of_vegan_person').val(no_of_vegan_person);
                            $('#no_of_jain_meal').val(no_of_jain_meal);
                            //} 
                            // else if (no_of_person === null) {
                            //     $('#no_of_person').val($('#number_persons').val());
                            //     $('#no_of_veg_person').val(0);
                            //     $('#no_of_non_veg_person').val(0);
                            //     $('#no_of_vegan_person').val(0);
                            //     $('#no_of_jain_meal').val(0);
                        } else {
                            // Update the UI elements
                            $('#no_of_person').val(response.persons[0].no_of_person);
                            $('#no_of_veg_person').val(response.persons[0].no_of_veg_person);
                            $('#no_of_non_veg_person').val(response.persons[0].no_of_non_veg_person);
                            $('#no_of_vegan_person').val(response.persons[0].no_of_vegan_person);
                            $('#no_of_jain_meal').val(response.persons[0].no_of_jain_meal);
                        }

                        if (packed == 1) {
                            $('#packed').prop('checked', true);
                        }
                        $('#final_remark').val(finalRemark);
                    }
                });
            }
        });

        $(document).on('click', '.delete-menus', function() {
            var encodedValue = $('#arr_id').val();
            var arrId = atob(encodedValue);
            var date = $(this).data('date');
            var buffet = $(this).data('buffet');
            var restaurant = $(this).data('restaurant');

            if (arrId && date && buffet && restaurant) {
                $.ajax({
                    url: 'delete-menus-data/' + arrId + '/' + date + '/' +
                        buffet +
                        '/' + restaurant,
                    type: 'GET',
                    dataType: 'JSON',
                    success: function(response) {
                        if (response.response === 'success') {
                            alert('Items Deleted Successfully.');
                        } else if (response.response === 'not-allowed') {
                            alert('Not Allowed. Permission Denied!');
                        }
                        $('#refresh-restaurant').trigger('click');
                    },
                    error: function(xhr, status, error) {
                        alert('Items not Deleted.');
                        return;
                    }
                });
            }
        });

        $(document).on('click', '.edit-payment', function() {
            var payment = $(this).data('payment');
            var payment_mode = $(this).data('payment_mode');
            var currency = $(this).data('currency');
            var payment_india = $(this).data('payment_india');
            var country = $(this).data('country');
            var payment_other = $(this).data('payment_in_other');
            var date = $(this).data('date');
            var pay_cilent_billing = $(this).data('pay_client');
            var pay_balance_amount = $(this).data('pay_balance');
            var pay_remark = $(this).data('pay_remark');

            $('#editPaymentDetails').modal('show');
            // $('#viewPaymentDetails').modal('hide');

            $('#payment').val(payment);
            $('#payment_mode').val(payment_mode);
            $('#currency').val(currency);
            $('#payment_india').val(payment_india);
            $('#payment_oth').val(payment_other);
            $('#oth_country').val(country);
            $('#payment_date').val(date);
            $('#pay_cilent_billing').val(pay_cilent_billing);
            $('#pay_balance_amount').val(pay_balance_amount);
            $('#pay_remark').val(pay_remark);

            // Insert the label and JavaScript code after the "Payment Received in" label
            $('#payment_received_label').after(
                `<label class="mdl-textfield__label">Payment Received in ${country}</label>`);
        });

        $('#arr_id, #date, #buffet').change(function() {
            var encodedValue = $('#arr_id').val();
            var arrId = atob(encodedValue);
            var date = $('#date').val();
            var buffet = $('#buffet').val();
            var select = $('#restaurant');

            // Clear existing options before making the AJAX call
            select.empty().append($('<option></option>').text('Select'));

            if (arrId && date && buffet) {
                $.ajax({
                    url: 'check-restaurant-availability/' + arrId + '/' + date + '/' +
                        buffet,
                    type: 'GET',
                    dataType: 'JSON',
                    success: function(response) {
                        // select.empty(); // Clear loading message
                        if (response && response.response === 's' && response.details
                            .length > 0) {
                            $.each(response.details, function(index, item) {
                                // Append options with additional data attributes
                                select.append($('<option></option>').val(item
                                        .restaurant_id)
                                    .text(item.names)
                                    .data('opening_time', item.opening_time)
                                    .data('closing_time', item.closing_time)
                                );
                            });

                            // Event handler for when an option is selected
                            select.on('change', function() {
                                var selectedOption = $(this).find(
                                    'option:selected');
                                var selectedOpeningTime = selectedOption.data(
                                    'opening_time');
                                var selectedClosingTime = selectedOption.data(
                                    'closing_time');

                                // Set values to the corresponding input fields
                                $('#opening_time').val(selectedOpeningTime);
                                $('#closing_time').val(selectedClosingTime);
                            });

                        }
                        // else {
                        //     // Append a placeholder option if no valid options are returned
                        //     select.append($('<option></option>').text('No restaurants available'));
                        // }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                        select.empty().append($('<option></option>').text(
                            'Error loading restaurants'));
                    }
                });
            }
        });

        $('#btn_restaurant').click(function(e) {
            if ($('#form-restaurant')[0].checkValidity()) {
                e.preventDefault();

                let myForm = document.getElementById("form-restaurant");
                var data = new FormData(myForm);

                // Perform the AJAX call
                $.ajax({
                    url: 'add-restaurants',
                    type: 'POST',
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    data: data,
                    success: function(response) {
                        // Handle a successful response
                        if (response.response === 'success') {
                            $('#response-messages')
                                .addClass('text-success')
                                .removeClass('text-danger')
                                .text(response.msg);

                            // Clear the form fields
                            $('#form-restaurant')[0].reset();

                            clearFormData();
                            // Scroll to the top of the page
                            $('html, body').animate({
                                scrollTop: 0
                            }, 'slow');

                        }
                    },
                    error: function(xhr, status, error) {
                        //Handle an error response
                        $('#response-messages')
                            .text(response.msg)
                            .addClass('text-danger');
                    }
                });
            }
        });

        $(document).ready(function() {
            // When the modal is shown
            $('#modalUpdateRestaurantMenu').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget); // Button that triggered the modal

                // Extract info from data-* attributes
                var date = button.data('date');
                var buffet = button.data('buffet');
                var restaurant = button.data('restaurant');
                var restaurant_name = button.data('restaurant_name');
                var openingTime = button.data('opening');
                var closingTime = button.data('closing');

                // Check if the button is the "Edit" button
                var isEdit = button.hasClass('edit-menu');

                // Update the modal's content
                var modal = $(this);

                if (isEdit) {

                    // Replace select with input for date
                    var dateInput = $('<input>', {
                        type: 'text',
                        class: 'mdl-textfield__input date wow date_id',
                        name: 'date[]',
                        id: 'date',
                        value: date,
                        readonly: true,
                        required: true
                    });
                    modal.find('#date').replaceWith(dateInput);

                    // Replace select with input for buffet
                    var buffetInput = $('<input>', {
                        type: 'text',
                        class: 'mdl-textfield__input wow buffet_id',
                        name: 'buffet[]',
                        id: 'buffet',
                        value: buffet,
                        readonly: true,
                        required: true
                    });
                    modal.find('#buffet').replaceWith(buffetInput);

                    // Add a hidden input to store the actual restaurant value
                    var hiddenRestaurantInput = $('<input>', {
                        type: 'hidden',
                        name: 'restaurant[]',
                        id: 'restaurant',
                        value: restaurant,
                        required: true
                    });

                    // Replace select with input for restaurant
                    var restaurantInput = $('<input>', {
                        type: 'text',
                        class: 'mdl-textfield__input restaurant_display',
                        id: 'restaurant_display',
                        value: restaurant_name,
                        readonly: true,
                        required: true
                    });

                    // Replace the select with the new input
                    modal.find('#restaurant').replaceWith(restaurantInput);
                    modal.find('.restaurant_display').siblings('input[type="text"]').not(
                        ':last').remove();
                    modal.find('#restaurant_display').after(hiddenRestaurantInput);

                }

                // Set the values for opening and closing times
                modal.find('#opening_time').val(openingTime).prop('readonly', isEdit);
                modal.find('#closing_time').val(closingTime).prop('readonly', isEdit);
            });

            // When the modal is hidden, reset the form and readonly state
            $('#modalUpdateRestaurantMenu').on('hidden.bs.modal', function() {
                var modal = $(this);
            });

            // Attach the click event handler to the button
            $('#close-restaurant').on('click', function(event) {
                $('#response-messages').html('');
                $('#form-restaurant-edit')[0].reset();
                document.getElementById('title-id').textContent = 'Add Restaurant';
                $('#form-restaurant-edit').attr('id', 'form-restaurant');
                $('#btn_update_restaurant').attr('id', 'btn_restaurant');
            });
        });

        function formatDate(dateStr) {
            const date = new Date(dateStr);
            const day = ("0" + date.getDate()).slice(-2); // Add leading zero if needed
            const monthNames = [
                "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul",
                "Aug", "Sept", "Oct", "Nov", "Dec"
            ];
            const month = monthNames[date.getMonth()]; // Get the month name
            const year = date.getFullYear();
            return `${day}-${month}-${year}`;
        }

        $(document).on('click',
            '#btn_restaurant,#addRestaurantMenu,#btn_update_restaurant,#refresh-restaurant',
            function() {
                var arrivalId = <?php echo $arrivals->id; ?>;
                if (arrivalId) {
                    $.ajax({
                        url: 'all-restaurant-availability/' + arrivalId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(response) {
                            responseData = response; // Store the response data
                            console.log(responseData);

                            var tableBody = $('.restaurant-table tbody');

                            // Remove previously added rows from AJAX requests
                            tableBody.find('.ajax-row').remove();

                            $.each(response.details, function(index, item) {
                                var row = '<tr class="ajax-row">' +
                                    '<td class="center">' + (tableBody.children('tr').length + index + 1) + '</td>' +
                                    '<td class="center">' + formatDate(item.date) + '</td>' +
                                    '<td class="center">' + item.buffet + '</td>' +
                                    '<td class="center">' + item.opening_time + '</td>' +
                                    '<td class="center">' + item.closing_time + '</td>' +
                                    '<td class="center">' + item.names + '</td>' +
                                    '<td class="center">' +
                                    '<a href="#" class="btn btn-info btn-xs p-1 restaurant-btn-edit" ' +
                                    'id="restaurant-btn-edit" ' +
                                    'data-id="' + item.id + '" ' +
                                    'data-date="' + item.date + '" ' +
                                    'data-buffet="' + item.buffet + '" ' +
                                    'data-restaurant_id="' + item.restaurant_id + '" ' +
                                    'data-opening_time="' + item.opening_time + '" ' +
                                    'data-closing_time="' + item.closing_time + '">Edit</a>' +
                                    '<a href="#" class="btn btn-xs btn-primary p-1 edit-menu" data-toggle="modal" data-target="#modalUpdateRestaurantMenu" data-arrivalsid="' +
                                    item.arrival_id + '" data-date="' + item.date + '" data-buffet="' + item.buffet +
                                    '" data-restaurant="' + item.restaurant_id + '" data-restaurant_name="' + item.names +
                                    '" data-opening="' + item.opening_time + '" data-closing="' + item.closing_time +
                                    '" data-person="' + item.no_of_person + '" data-veg="' + item.no_of_veg_person +
                                    '" data-non_veg="' + item.no_of_non_veg_person + '" data-vegan="' + item.no_of_vegan_person +
                                    '" data-jain="' + item.no_of_jain_meal + '" data-packed="' + item.packed +
                                    '" data-final_remark="' + item.final_remark + '" data-veg_remark="' + item.veg_remark +
                                    '" data-non_veg_remark="' + item.non_veg_remark + '" data-vegan_remark="' + item.vegan_remark +
                                    '" data-jain_meal_remark="' + item.jain_meal_remark + '">Menu</a>' +
                                    '<a href="#" class="btn btn-danger btn-xs p-1 delete-menus" data-arrivalsid="' +
                                    item.arrival_id + '" data-date="' + item.date + '" data-buffet="' + item.buffet +
                                    '" data-restaurant="' + item.restaurant_id + '">Delete</a>' +
                                    '</td>' +
                                    '</tr>';
                                tableBody.append(row);
                            });
                        },
                        error: function() {
                            console.log('Error fetching data');
                        }
                    });
                }
            });

        $(document).on('click', '.restaurant-btn-edit', function() {
            var id = $(this).data('id');
            var date = $(this).data('date');
            var buffet = $(this).data('buffet');
            var restaurant = $(this).data('restaurant_id');
            var opening_time = $(this).data('opening_time');
            var closing_time = $(this).data('closing_time');

            $('#modalAddRestaurant').modal('show');

            // Assign values to the elements
            document.getElementById('title-id').textContent = 'Edit Restaurant';
            $('#arrival_restaurant_id').val(id)
            $('#dates').val(date);
            $('#buffets').val(buffet);
            $('#restaurants').val(restaurant);
            $('#restaurant_ids').val(restaurant);
            $('#opening_times').val(opening_time);
            $('#closing_times').val(closing_time);

            // Change the form and button IDs
            $('#form-restaurant').attr('id', 'form-restaurant-edit');
            $('#btn_restaurant').attr('id', 'btn_update_restaurant');
        });

        $(document).on('click', '#btn_update_restaurant', function(e) {
            if ($('#form-restaurant-edit')[0].checkValidity()) {
                e.preventDefault();

                let myForm = document.getElementById("form-restaurant-edit");
                var data = new FormData(myForm);

                var id = $('#arrival_restaurant_id').val();
                var arrival_id = $('#arrival_ids').val();
                var dates = $('#dates').val();
                var buffets = $('#buffets').val();
                var restaurants = $('#restaurants').val();
                var restaurant_ids = $('#restaurant_ids').val();

                // Perform the AJAX call
                $.ajax({
                    url: 'edit-restaurants/' + id + '/' + arrival_id + '/' + dates + '/' +
                        buffets + '/' + restaurant_ids,
                    type: 'POST',
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    data: data,
                    success: function(response) {
                        // Handle a successful response
                        if (response.response === 's') {
                            $('#response-messages')
                                .addClass('text-success')
                                .removeClass('text-danger')
                                .text(response.msg);

                            // Clear the form fields
                            $('#form-restaurant-edit')[0].reset();

                            clearFormData();
                            // Scroll to the top of the page
                            $('html, body').animate({
                                scrollTop: 0
                            }, 'slow');

                        }
                    },
                });
            }
        });

    });
</script>

<script>
    $(document).ready(function() {

        $('#add-enquiry-transportation-form').submit(function(e) {
            e.preventDefault(); // Prevent the form from submitting

            // Serialize form data
            var formData = new FormData(this);

            // Send an AJAX request
            $.ajax({
                url: 'add-enquiry-transportation',
                type: 'POST',
                data: formData,
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function(response) {
                    $('#response-message').html(
                        '<div class="alert alert-success text-center" role="alert">Form submitted successfully!</div>'
                    );
                },
                error: function() {
                    // Display an error message
                    $('#response-message').html(
                        '<div class="alert alert-danger text-center" role="alert">Failed to submit form. Please try again.</div>'
                    );
                }
            });
        });

        function fetchTransportationData() {
            var enquiryId = $(this).data('id');
            //console.log(enquiryId);
            var display = '';
            var i = 0;
            if (enquiryId) {
                $.ajax({
                    url: '<?= base_url() ?>enquiry-transportation-data/' + enquiryId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        responseData = response; // Store the response data
                        //console.log(responseData);
                        var tableBody = $('.transport-table tbody');
                        tableBody.empty(); // Clear existing table rows
                        // Loop through the response data and append rows to the table
                        $.each(response.details, function(index, item) {
                            display = '';
                            if(item.arrival_id != "0" && item.arrival_id != $("#arrival_ids").val()){
                                display = "none";
                            }else { i++; }
                            var row = '<tr style="display:'+display+'">' +
                                '<td class="center">' + i + '</td>' +
                                '<td class="center">' + item.vehicle_name +
                                '</td>' +
                                '<td class="center">' + item.vehicle_type +
                                '</td>' +
                                '<td class="center">' + (item.quantity !== undefined ?
                                    item
                                    .quantity : '-') + '</td>' +
                                '<td class="center" style="text-transform: capitalize;">' +
                                item.luggage_vehicle +
                                '</td>' +
                                '<td class="center">' + item.city +
                                '</td>' +
                                '<td class="center"><a href="#" class="btn btn-danger" id="the-btn-delete" data-id="' +
                                item.id + '" data-enqid="' +
                                item.enqId + '">Delete</a></td>' +
                                '</tr>';
                            tableBody.append(row);
                        });
                    },
                    error: function() {
                        console.log('Error fetching data');
                    }
                });
            }
        }

        $('#add-btn-transportation,#refresh-menu-transport,.myModal_AddTransportation').click(
            fetchTransportationData);

        $('#add-btn-transportation').click(fetchTransportationData);

        $(document).on('click', '#the-btn-delete', function(e) {
            e.preventDefault();

            var itemId = $(this).data('id');
            var enqId = $(this).data('enqid');

            if (enqId !== 'undefined') {
                $.ajax({
                    url: 'update-enquiry-transportation-data/' + enqId,
                    type: 'POST',
                    dataType: 'json',
                    success: function(response) {
                        // Check if the deletion was successful
                        if (response.response === 'success') {
                            // Remove the table row
                            $(e.target).closest('tr').remove();
                            alert('Item deleted successfully.');
                        } else {
                            alert('Failed to delete item.');
                        }
                    },
                    error: function() {
                        alert('Failed to delete item.');
                    }
                });
            } else {
                $.ajax({
                    url: 'delete-enquiry-transportation-data/' + itemId,
                    type: 'POST',
                    dataType: 'json',
                    success: function(response) {
                        // Check if the deletion was successful
                        if (response.response === 'success') {
                            // Remove the table row
                            $(e.target).closest('tr').remove();
                            alert('Item deleted successfully.');
                        } else {
                            alert('Failed to delete item.');
                        }
                    },
                    error: function() {
                        alert('Failed to delete item.');
                    }
                });
            }
        });

        $(document).ready(function() {
    
        $(document).on('click', '#guide-btn-delete', function(e) {
            e.preventDefault();

            var itemId = $(this).data('id');
            var enqId = $(this).data('enqid');

            if (enqId !== 'undefined') {
                $.ajax({
                    url: 'update-enquiry-guide-data/' + enqId,
                    type: 'POST',
                    dataType: 'json',
                    success: function(response) {
                        // Check if the deletion was successful
                        if (response.response === 'success') {
                            // Remove the table row
                            $(e.target).closest('tr').remove();
                            alert('Item deleted successfully.');
                        } else {
                            alert('Failed to delete item.');
                        }
                    },
                    error: function() {
                        alert('Failed to delete item.');
                    }
                });
            } else {
                // Send an AJAX request to delete the item
                $.ajax({
                    url: 'delete-enquiry-guide-data/' + itemId,
                    type: 'POST',
                    dataType: 'json',
                    success: function(response) {
                        // Check if the deletion was successful
                        if (response.response === 'success') {
                            // Remove the table row
                            $(e.target).closest('tr').remove();
                            alert('Item deleted successfully.');
                        } else {
                            alert('Failed to delete item.');
                        }
                    },
                    error: function() {
                        alert('Failed to delete item.');
                    }
                });
            }

        });


            // Function to execute when the page loads
            function updateButtonState() {
                var isChecked = $('#guide_checkbox').prop('checked');
                if (isChecked) {
                    $('#add-guide-button').prop('disabled', true);
                    $('#add-guide-button').removeClass('btn-success').addClass('btn-secondary');
                } else {
                    $('#add-guide-button').prop('disabled', false);
                    $('#add-guide-button').addClass('btn-success').removeClass('btn-secondary');
                }
            }

            // Call the function when the page loads
            updateButtonState();

            // Attach click event to the checkbox
            $('#guide_checkbox').click(function() {
                // Call the function when the checkbox is clicked
                updateButtonState();
            });
        });

        $('#add-form-guide').submit(function(e) {
            e.preventDefault(); // Prevent the form from submitting

            // Serialize form data
            var formData = new FormData(this);

            // Send an AJAX request
            $.ajax({
                url: 'add-enquiry-guide',
                type: 'POST',
                data: formData,
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function(response) {
                    $('#response-message-guide').html(
                        '<div class="alert alert-success text-center" role="alert">Form submitted successfully!</div>'
                    );
                },
                error: function() {
                    // Display an error message
                    $('#response-message').html(
                        '<div class="alert alert-danger text-center" role="alert">Failed to submit form. Please try again.</div>'
                    );
                }
            });
        });

        // $(document).ready(function() {
        //     // Check if #guide-btn-delete element is present
        //     if ($('#guide-btn-delete').length) {
        //         // If present, uncheck the checkbox
        //         $('#guide_checkbox').prop('checked', false);
        //     }
        // });


        function fetchGuideData() {
            var enquiryId = $(this).data('id');
            var display = '';
            var i = 0;
            if (enquiryId) {
                $.ajax({
                    url: '<?= base_url() ?>enquiry-guide-data/' + enquiryId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        responseData = response; // Store the response data
                        var tableBody = $('.guide-table tbody');
                        tableBody.empty(); // Clear existing table rows
                        // Loop through the response data and append rows to the table
                        $.each(response.details, function(index, item) {
                            display = '';
                            if(item.arrival_id != "0" && item.arrival_id != $("#arrival_ids").val()){
                                display = "none";
                            }else { i++; }
                            var row = '<tr style="display:'+display+'">' +
                                '<td class="center">' + i + '</td>' +
                                '<td class="center">' + item.name +
                                '</td>' + 
                                '<td class="center">' + item.isd_codes + item.contact_number +
                                '</td>' + 
                                '<td class="center"><a href="#" class="btn btn-danger" id="guide-btn-delete" data-id="' +
                                item.id + '" data-enqid="' + item.enqId +
                                '">Delete</a></td>' +
                                '</tr>';
                            tableBody.append(row);
                        });
                    },
                    error: function() {
                        console.log('Error fetching Guide data');
                    }
                });
            }
        }

        $('#btn_guide,#refresh-menu-guide,.myModal_AddGuide').click(
            fetchGuideData);

        $('#btn_guide').click(fetchGuideData);


        $(document).on('click', '#guide-btn-delete', function(e) {
            e.preventDefault();

            var itemId = $(this).data('id');
            var enqId = $(this).data('enqid');

            if (enqId !== 'undefined') {
                $.ajax({
                    url: 'update-enquiry-guide-data/' + enqId,
                    type: 'POST',
                    dataType: 'json',
                    success: function(response) {
                        // Check if the deletion was successful
                        if (response.response === 'success') {
                            // Remove the table row
                            $(e.target).closest('tr').remove();
                            alert('Item deleted successfully.');
                        } else {
                            alert('Failed to delete item.');
                        }
                    },
                    error: function() {
                        alert('Failed to delete item.');
                    }
                });
            } else {
                // Send an AJAX request to delete the item
                $.ajax({
                    url: 'delete-enquiry-guide-data/' + itemId,
                    type: 'POST',
                    dataType: 'json',
                    success: function(response) {
                        // Check if the deletion was successful
                        if (response.response === 'success') {
                            // Remove the table row
                            $(e.target).closest('tr').remove();
                            alert('Item deleted successfully.');
                        } else {
                            alert('Failed to delete item.');
                        }
                    },
                    error: function() {
                        alert('Failed to delete item.');
                    }
                });
            }

        });


        $('.close-modal').click(function() {
            $('#response-message-guide').html('');
            $('#response-message').html('');
            $('#guide').val('');
            $('#transportation').val('');
            $('#capacity').val('');
        });


        $('#add-driver-button').click(fetchDriverData);
        
        function fetchDriverData() {
            //var enquiryId = $(this).data('id');
            var enquiryId = $("#add-driver-button").attr("data-id");
            var display = '';
            var i = 0;
            if (enquiryId) {
                $.ajax({
                    url: '<?= base_url() ?>enquiry-driver-data/' + enquiryId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        responseData = response; // Store the response data
                        var tableBody = $('.driver-table tbody');
                        tableBody.empty(); // Clear existing table rows
                        // Loop through the response data and append rows to the table
                        $.each(response.details, function(index, item) {
                            display = '';
                            if(item.driver_id == "0"){
                                display = "none";
                            }else { i++; }
                            var row = '<tr style="display:'+display+'">' +
                                '<td class="center">' + i + '</td>' +
                                '<td class="center">' + item.driver_name +
                                '</td>' +
                                '<td class="center">' + item.driver_phone_number +
                                '</td>' +
                                '<td class="center"><a href="#" class="btn btn-danger" id="driver-btn-delete" data-id="' +
                                item.id + '" data-enqid="' + item.enqId +
                                '">Delete</a></td>' +
                                '</tr>';
                            tableBody.append(row);
                        });
                    },
                    error: function() {
                        console.log('Error fetching Guide data');
                    }
                });
            }
        }

        $("#myModaldriver").on("click","#driver-btn-delete",function(){
            $("#driver_id").val("0");
            $('#add-form-driver').submit();
        });
        
        $('#add-form-driver').submit(function(e) {
            e.preventDefault(); // Prevent the form from submitting

            // Serialize form data
            var formData = new FormData(this);

            // Send an AJAX request
            $.ajax({
                url: 'add-enquiry-driver',
                type: 'POST',
                data: formData,
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function(response) {
                    $('#response-message-driver').html(
                        '<div class="alert alert-success text-center" role="alert">Submitted successfully!</div>'
                    );
                    fetchDriverData();
                    $("#driver_name").val("");
                },
                error: function() {
                    // Display an error message
                    $('#response-message').html(
                        '<div class="alert alert-danger text-center" role="alert">Failed to submit form. Please try again.</div>'
                    );
                }
            });
        });

    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var statusValue = document.getElementById("status").value;
        document.getElementById("hidediv").className = statusValue !== 'cancel' ? 'col-lg-4 p-t-20 hidden' : 'col-lg-4 p-t-20 show';
    });
</script>

<script>
    // Function to create child age input fields
    function createChildAgeFields(childCount) {
        const childAgeContainer = document.getElementById('childAgeContainer');
        
        // Clear existing child age fields
        childAgeContainer.innerHTML = '';
        
        // If no children, return
        if (childCount < 1) {
            return;
        }
        
        // Create input fields for each child
        for (let i = 1; i <= childCount; i++) {
            const childField = createChildField(i);
            childAgeContainer.appendChild(childField);
        }
        
        // Add the + button
        // addPlusButton(childCount);
    }

    // Function to create a single child age field with remove button
    function createChildField(childNumber, existingValue = '') {
        const childField = document.createElement('div');
        childField.className = 'col-lg-2 p-t-20 child-age-field';
        childField.setAttribute('data-child-index', childNumber);
        childField.innerHTML = `
            <div class="child-age-input-wrapper">
                <label class="mdl-textfield__label">Child ${childNumber} Age</label>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width" style="display: flex; align-items: center;">
                    <input type="number" 
                        name="child_age[]" 
                        class="mdl-textfield__input child-age-input" 
                        min="0" 
                        max="17" 
                        placeholder="Enter age" 
                        value="${existingValue}"
                        required 
                        style="flex: 1;">
                    ${childNumber > 1 ? `
                    <button type="button" class="btn btn-danger btn-sm remove-child-btn" style="margin-left: 8px; min-width: 40px;">
                        <i class="fa fa-times"></i>
                    </button>
                    ` : ''}
                </div>
            </div>
        `;
        
        // Add event listener to remove button
        if (childNumber > 1) {
            const removeBtn = childField.querySelector('.remove-child-btn');
            removeBtn.addEventListener('click', function() {
                removeChildField(childField, childNumber);
            });
        }
        
        return childField;
    }

    // Function to add a single child age field
    function addChildAgeField(childNumber) {
        const childAgeContainer = document.getElementById('childAgeContainer');
        const addButtonContainer = document.querySelector('#addChildBtn')?.closest('.col-lg-12');
        
        // Remove the add button temporarily
        if (addButtonContainer) {
            addButtonContainer.remove();
        }
        
        // Create new child age field
        const childField = createChildField(childNumber);
        childAgeContainer.appendChild(childField);
        
        // Re-add the add button
        // addPlusButton(childNumber);
        
        // Update the main child count input
        updateChildCountInput();
    }

    // Function to remove a child age field
    function removeChildField(childField, childNumber) {
        // Remove the field
        childField.remove();
        
        // Re-index remaining fields
        reindexChildFields();
        
        // Update the main child count input
        updateChildCountInput();
    }

    // Function to re-index child fields after removal
    function reindexChildFields() {
        const childFields = document.querySelectorAll('.child-age-field');
        const childAgeContainer = document.getElementById('childAgeContainer');
        
        // Clear container
        childAgeContainer.innerHTML = '';
        
        // Re-create fields with correct numbering and preserve values
        childFields.forEach((field, index) => {
            const newChildNumber = index + 1;
            const existingValue = field.querySelector('.child-age-input').value;
            const newField = createChildField(newChildNumber, existingValue);
            childAgeContainer.appendChild(newField);
        });
        
        // Add + button
        // addPlusButton(childFields.length);
    }

    // Function to add the plus button
    // function addPlusButton(currentCount) {
    //     const childAgeContainer = document.getElementById('childAgeContainer');
        
    //     // Remove existing add button if any
    //     const existingAddBtn = document.querySelector('#addChildBtn');
    //     if (existingAddBtn) {
    //         existingAddBtn.closest('.col-lg-12')?.remove();
    //     }
        
    //     // Add new add button
    //     const addButtonContainer = document.createElement('div');
    //     addButtonContainer.className = 'col-lg-12 p-t-20 text-center';
    //     addButtonContainer.innerHTML = `
    //         <button type="button" id="addChildBtn" class="btn btn-success btn-sm">
    //             <i class="fa fa-plus"></i> Add Another Child
    //         </button>
    //     `;
    //     childAgeContainer.appendChild(addButtonContainer);
        
    //     // Add event listener to the + button
    //     document.getElementById('addChildBtn').addEventListener('click', function() {
    //         const currentFields = document.querySelectorAll('.child-age-field');
    //         addChildAgeField(currentFields.length + 1);
    //     });
    // }

    // Function to update the main child count input
    function updateChildCountInput() {
        const childFields = document.querySelectorAll('.child-age-field');
        const childInput = document.getElementById('number_child');
        childInput.value = childFields.length;
    }

    // Function to initialize child age fields with existing data
    function initializeChildAgeFields() {
        const childInput = document.getElementById('number_child');
        const initialChildCount = parseInt(childInput.value) || 0;
        
        // Create container for child age fields if it doesn't exist
        if (!document.getElementById('childAgeContainer')) {
            const container = document.createElement('div');
            container.id = 'childAgeContainer';
            container.className = 'row';
            childInput.closest('.col-lg-1').insertAdjacentElement('afterend', container);
        }
        
        // If we have existing child ages from PHP, use them
        const existingChildFields = document.querySelectorAll('.child-age-field');
        if (existingChildFields.length > 0) {
            // Fields already rendered by PHP, just attach event listeners
            attachEventListenersToExistingFields();
        } else {
            // Create fields based on child count
            createChildAgeFields(initialChildCount);
        }
    }

    // Function to attach event listeners to existing PHP-rendered fields
    function attachEventListenersToExistingFields() {
    const removeButtons = document.querySelectorAll('.remove-child-btn');
    removeButtons.forEach(button => {
        button.addEventListener('click', function() {
            const childField = this.closest('.child-age-field');
            const childNumber = parseInt(childField.getAttribute('data-child-index'));
            removeChildField(childField, childNumber);
        });
    });
        
    // Attach event listener to existing + button
    const existingAddBtn = document.getElementById('addChildBtn');
    if (existingAddBtn) {
        existingAddBtn.addEventListener('click', function() {
            const currentFields = document.querySelectorAll('.child-age-field');
            addChildAgeField(currentFields.length + 1);
        });
    }
    }

    // Event listener for child input changes
    document.getElementById('number_child').addEventListener('input', function() {
        const childCount = parseInt(this.value) || 0;
        createChildAgeFields(childCount);
    });

    // Initialize on page load
    document.addEventListener('DOMContentLoaded', function() {
        initializeChildAgeFields();
    });
</script>
