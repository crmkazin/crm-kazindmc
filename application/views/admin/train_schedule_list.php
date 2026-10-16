    <?php include('admin_head_css.php');?>
      <style>
    .pagination {
    display: flex;
    list-style: none;
    padding-left: 0;
    border-radius: 0.25rem;
    }

    .pagination li {
        margin: 0 3px;
    }

    .pagination li a,
    .pagination li span {
        border: 1px solid #ddd;
        padding: 6px 12px;
        text-decoration: none;
        color: #6c757d ;
        border-radius: 50%;
        transition: background-color 0.2s, color 0.2s;
    }

    .pagination li.active a,
    .pagination li.active span {
        background-color: #8e2de2 !important; 
        color: #fff;
        border-color: #8e2de2 !important;
    }

    .pagination li a:hover {
        background-color: #f1f1f1;
        color: #000;
    }
    </style>
    <div class="page-wrapper">
        <!-- start page container -->
        <div class="container-fluid">
            <!-- start page content -->
            <div class="page-content-wrapper">
                <div class="page-bar">
                    <div class="row page-titles">
                        <div class="col-lg-3 col-sm-6  col-6 align-self-center">
                            <h4 class="text-themecolor">All Train Schedule List</h4>
                        </div>
                        <div class="col-lg-2 only-for-dashbord">
                        </div>
                        <div class="col-lg-7 col-sm-6 col-6 align-self-center text-end">
                            <div class="d-flex justify-content-end align-items-center">
                                <ol class="breadcrumb justify-content-end">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Home</a></li>
                                    <li class="breadcrumb-item active">All Train Schedule List</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-content">
                    <?php echo $this->session->flashdata('message'); unset($_SESSION['message']); ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-box">
                                
                                <div class="card-body">
                                    <form method="get">
                                        <div class="row mt-2">
                                            <div class="col-lg-1">
                                                <h4>Search</h4>
                                            </div>
                                             <div class="col-lg-2 mt-2">
                                                 <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <?php echo form_input(['name'=>'train_number','id'=>'','class'=>'mdl-textfield__input', 'placeholder'=>'Train Number','value'=>($this->input->get('train_number')<>'')?$this->input->get('train_number'):''])?>
                                                    <!--<label class="mdl-textfield__label">Flight Number</label>-->
                                                </div>
                                            </div> 
                                             <div class="col-lg-2 mt-2">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <?php echo form_submit(['name'=>'submit','id'=>'submit', 'class'=>'btn btn-md btn-primary', 'value'=>'Search']);?>
                                                     <a href="<?php echo base_url('all-train-schedule'); ?>" class="btn btn-md btn-danger">Clear</a>
                                                </div>
                                            </div> 
                                        </div>
                                    </form>
                                    <div class="table-scrollable">
                                        <table class="table table-hover table-striped no-wrap table-checkable border order-column full-width" id="flight_schedule_list">
                                            <thead>
                                                <tr>
                                                    <th class="center">Sr.No</th>
                                                    <th class="center">Train Name</th>
                                                    <th class="center">Train Number</th>
                                                    <th class="center">Departing Station</th>
                                                    <th class="center">Arrival Station</th>
                                                    <th class="center">Departure Time</th>
                                                    <th class="center">Arrival Time</th>
                                                    <th class="center">Days Of Operations</th>
                                                    <th class="center">Type</th>
                                                    <th class="center">Business Class Adult Ticket Price</th>
                                                    <th class="center">Business Class Child Ticket Price</th>
                                                    <th class="center">Economy Class Adult Ticket Price</th>
                                                    <th class="center">Economy Class Child Ticket Price</th>
                                                    <th class="center">First Class Adult Ticket Price</th>
                                                    <th class="center">First Class Child Ticket Price</th>
                                                    <th class="center">Second Class Adult Ticket Price</th>
                                                    <th class="center">Second Class Child Ticket Price</th>
                                                    <th class="center">Luxe Class Adult Ticket Price</th>
                                                    <th class="center">Luxe Class Child Ticket Price</th>
                                                    <th class="center">Open Plan Class Adult Ticket Price</th>
                                                    <th class="center">Open Plan Class Child Ticket Price</th>
                                                    <th class="center">Couple Class Adult Ticket Price</th>
                                                    <th class="center">Couple Class Child Ticket Price</th>
                                                    <th class="center">Country</th>
                                                    <th class="center">Status</th>
                                                    <th class="center">Action</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php                                            
                                            $super_admins = ['rohit@kazindmc.com','pankaj@thavertech.com'];
                                            $records_cnt=0;
                                            if(!empty($result)) {
                                                 $i=$offset+1;
                                            foreach($result as $list) {
                                                $records_cnt++;   

                                            ?>
                                                <form method="post">
                                                    <tr class="odd gradeX">
                                                        <td class="center"><?=$i++?></td>
                                                        <td class="center"><?=$list->train_name?></td>
                                                        <td class="center"><?=$list->train_number?></td>
                                                        <td class="center"><?=$list->departing_station ?></td>
                                                        <td class="center"><?=$list->arrival_station ?></td>
                                                        <td><?php if($list->mon_dep_time) echo "Mon-".$list->mon_dep_time.","; ?>
                                                            <?php if($list->tue_dep_time) echo "Tue-".$list->tue_dep_time.","; ?>
                                                            <?php if($list->wed_dep_time) echo "Wed-".$list->wed_dep_time.","; ?><br>
                                                            <?php if($list->thu_dep_time) echo "Thu-".$list->thu_dep_time.","; ?>
                                                            <?php if($list->fri_dep_time) echo "Fri-".$list->fri_dep_time.","; ?>
                                                            <?php if($list->sat_dep_time) echo "Sat-".$list->sat_dep_time.","; ?><br>
                                                            <?php if($list->sun_dep_time) echo "Sun-".$list->sun_dep_time; ?>
                                                        </td>
                                                        <td><?php if($list->mon_arr_time) echo "Mon-".$list->mon_arr_time.","; ?>
                                                            <?php if($list->tue_arr_time) echo "Tue-".$list->tue_arr_time.","; ?>
                                                            <?php if($list->wed_arr_time) echo "Wed-".$list->wed_arr_time.","; ?><br>
                                                            <?php if($list->thu_arr_time) echo "Thu-".$list->thu_arr_time.","; ?>
                                                            <?php if($list->fri_arr_time) echo "Fri-".$list->fri_arr_time.","; ?>
                                                            <?php if($list->sat_arr_time) echo "Sat-".$list->sat_arr_time.","; ?><br>
                                                            <?php if($list->sun_arr_time) echo "Sun-".$list->sun_arr_time; ?>
                                                        </td>
                                                        <td class="center"><?=$list->days_of_operations ?></td>
                                                        <td class="center">
                                                            <?php
                                                            $types = json_decode($list->type, true);
                                                            if(is_array($types)) {
                                                                $formatted_types = array_map(function($type) {
                                                                    return ucwords(str_replace('_', ' ', trim($type)));
                                                                }, $types);
                                                                
                                                                echo implode(', ', $formatted_types);
                                                            } else {
                                                                echo '';
                                                            }
                                                            ?>
                                                        </td>
                                                        <td class="center"><?=$list->ticket_price ?></td>
                                                        <td class="center"><?=$list->business_child_ticket_price ?></td>
                                                        <td class="center"><?=$list->economy_ticket_price ?></td>
                                                        <td class="center"><?=$list->economy_child_ticket_price ?></td>
                                                        <td class="center"><?=$list->first_class_ticket_price ?></td>
                                                        <td class="center"><?=$list->first_class_child_ticket_price ?></td>
                                                        <td class="center"><?=$list->second_class_ticket_price ?></td>
                                                        <td class="center"><?=$list->second_class_child_ticket_price ?></td>
                                                         <td class="center"><?=$list->luxe_ticket_price ?></td>
                                                        <td class="center"><?=$list->luxe_child_ticket_price ?></td>
                                                        <td class="center"><?=$list->open_plan_ticket_price ?></td>
                                                        <td class="center"><?=$list->open_plan_child_ticket_price ?></td>
                                                        <td class="center"><?=$list->couple_ticket_price ?></td>
                                                        <td class="center"><?=$list->couple_child_ticket_price ?></td>
                                                        <td class="center"><?=$list->country ?></td>
                                                        <td class="center"><?=ucfirst($list->status) ?></td>
                                                        <td class="center"  style="display:flex;">
                                                            <a href="<?php echo base_url('train-schedule-edit-?id='.base64_encode($list->id)); ?>" class="btn btn-tbl-edit btn-xs" title="Edit"><i class="fa fa-edit"></i></a> 
                                                            <!--a href="<?php //echo base_url('delete-flight-schedule?id='.base64_encode($list->id)); ?>" onclick="return confirm('Are you sure you want to delete this Flight Schedule?');" class="btn btn-tbl-delete btn-xs" title="Delete"><i class="fa fa-trash-o "></i></a-->
                                                            <a href="<?php echo base_url('train-schedule-delete?id='.base64_encode($list->id).'&train_num='.base64_encode($list->train_number)); ?>" onclick="return confirm('Are you sure you want to delete this train Schedule?');" class="btn btn-tbl-delete btn-xs" title="Delete"><i class="fas fa-trash"></i></a>
                                                        </td>
                                                        <td></td>
                                                    </tr>
                                                </form>
                                                <?php } }?>
                                            </tbody>
                                        </table>
                                    </div>
                                     <div class="col-md-12 d-flex justify-content-between align-items-center mt-3">
                                    <div>
                                        <?php echo 'Showing ' . ($offset + 1) . ' to ' . ($offset + $records_cnt) . ' of ' . $total . ' entries'; ?>
                                    </div>
                                    <div class="pagination-container">
                                        <?php echo $links; ?>
                                    </div>
                            </div>
                                </div>
                                <!--<div class="col-md-12 dataTables_paginate paging_simple_numbers" id="">-->
                                    <?php //echo 'Showing '.$records_cnt.' of '.$total.' Records'; ?>
                                    <?php //echo $links; ?>
                                    <!--</div>-->
                                   
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- end page content -->
        </div>
    </div>
<script>
    $(document).ready(function() {
        var table = $('#flight_schedule_list').DataTable({
            paging: false,
            info: false,
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
    });
</script>
