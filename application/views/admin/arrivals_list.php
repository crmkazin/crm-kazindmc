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

    table.dataTable.dtr-column>tbody>tr>td.control:before, table.dataTable.dtr-column>tbody>tr>th.control:before{
        line-height: 24px !important;
        height: 25px !important;
        width: 25px !important;
    }

</style>

<div class="page-wrapper">
    <!-- start page container -->
    <div class="container-fluid">
        <!-- start page content -->
        <div class="page-bar">
            <div class="row page-titles">
                <div class="col-lg-3 col-sm-6 col-6 align-self-center">
                    <h4 class="text-themecolor">Arrivals</h4>
                </div>
                <div class="col-lg-2 only-for-dashbord">
                </div>
                <div class="col-lg-7 col-sm-6 col-6 align-self-center text-end">
                    <div class="d-flex justify-content-end align-items-center">
                        <ol class="breadcrumb justify-content-end">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Home</a></li>
                            <li class="breadcrumb-item active">Arrivals</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-content-wrapper">
            <div class="page-content">
                <?php echo $this->session->flashdata('message'); unset($_SESSION['message']); ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-box">
                            

                            <div style="display: flex;justify-content: space-between;">
                                <div class="filter-dropdown">
                                    <h3 class="text-primary">Advance Search</h3>
                                    <form method="get">
                                    <ul id="accordion" class="accordion ps-0">
                                                                           <li>
                                                <div Class="acco">
                                                    <div class="link">
                                                        <i class="fa fa-chevron-down"></i>
                                                        Search By Location
                                                    </div>
                                                    <div class="content">
                                                        <label for="location">Location</label>
                                                        <div class="input-container">
                                                            <div class="mySelect">  
                                                                <select name="location" id="location" class="location select">
                                                                    <option value="" selected disabled hidden></option>
                                                                    <?php
                                                                        $user_id = $this->session->userdata('id');
                                                                        $user_email = $this->session->userdata('email');
                                                                        // Run query directly
                                                                        $this->db->select('*');
                                                                        $this->db->from('admin');
                                                                        $this->db->where('id', $user_id);
                                                                        $query = $this->db->get();
            
                                                                        // Fetch single row as array
                                                                        $user = $query->row_array();
            
                                                                        // Determine which locations array to use
                                                                        $special_emails = [''];
                                                                        $use_locations_new = in_array($user_email, $special_emails);
            
                                                                        $locations = $use_locations_new ? $locations_new : $locations;
                                                                        $main_keys = ['kazakhstan', 'azerbaijan', 'belarus', 'georgia', 'armenia','uzbekistan'];
            
                                                                        if ($this->session->userdata('type') == 2 && !in_array($user_email, $special_emails)) {
                                                                            $user_locations = explode(',', $user['location']);
                                                                            asort($locations);
            
                                                                            $has_all_access = in_array('all', $user_locations) ||
                                                                                            empty(array_diff($main_keys, $user_locations));
            
                                                                            // Show "All" option only if allowed
                                                                            if ($has_all_access) {
                                                                                $selected = ($this->input->get('location') == 'all') ? 'selected="selected"' : '';
                                                                                echo "<option value='all' data-abbr='" . implode(',', $locations['all']) . "' $selected>All</option>";
                                                                            }
            
                                                                            foreach ($locations as $key => $val) {
                                                                                if ($key === 'all') continue;
            
                                                                                if ($has_all_access || in_array($key, $user_locations)) {
                                                                                    $selected = ($this->input->get('location') == $key) ? 'selected="selected"' : '';
                                                                                    echo "<option value='$key' data-abbr='" . implode(',', $val) . "' $selected>" . ucfirst($key) . "</option>";
                                                                                }
                                                                            }
                                                                        } else {
                                                                            // Admin or type ≠ 2 users
                                                                            asort($locations);
            
                                                                            // Always show "All" for admins
                                                                            $selected = ($this->input->get('location') == 'all') ? 'selected="selected"' : '';
                                                                            echo "<option value='all' data-abbr='" . implode(',', $locations['all']) . "' $selected>All</option>";
            
                                                                            foreach ($locations as $key => $val) {
                                                                                if ($key === 'all') continue;
                                                                                $selected = ($this->input->get('location') == $key) ? 'selected="selected"' : '';
                                                                                echo "<option value='$key' data-abbr='" . implode(',', $val) . "' $selected>" . ucfirst($key) . "</option>";
                                                                            }
                                                                        }
                                                                    ?>
            
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <label for="booking_type">Booking Type</label>
                                                        <div class="input-container">
                                                            <div class="mySelect">
                                                                <select name="booking_type" id="booking_type" class="select booking_type">
                                                                    <option value=""></option>
                                                                </select>
                                                            
                                                                <!-- <span>Booking Type</span> -->
                                                            </div>
                                                        </div>
                                                        <label for="staff_id">Staff</label>
                                                        <div class="input-container">
                                                            <div class="mySelect">
                                                                <select name="staff_id" id="staff_id" class="select staff_id">
                                                                    <option value=""></option>
                                                                </select>
                                                        
                                                                <!-- <span>Staff</span> -->
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            </li>           
                                        <li>
                                        

                                       <li>
                                            <div class="link">
                                                <i class="fa fa-chevron-down"></i>
                                                Search By Arrival Date
                                            </div>
                                            <div class="content">
                                                <label for="from">From</label>
                                                <div class="input-container">
                                                    <input type="text" name=""
                                                class="input inputdate mdl-textfield__input dt-search-show" style="width:100%;"
                                                value="<?php echo ($this->input->get('date_from') <> '') ? date('d-M-Y', strtotime($this->input->get('date_from'))) : ''; ?>"
                                                readonly>
                                                <?php echo form_input(['type' => 'date', 'name' => 'date_from', 'placeholder' => '', 'id' => 'date_from', 'class' => 'dts mdl-textfield__input dt-search date_from', 'value' => ($this->input->get('date_from') <> '') ? $this->input->get('date_from') : '', 'style' => 'width:17px;float:right; position: absolute; right: 8%; border: none; background-color: transparent; top: 50%; transform: translateY(-50%);']) ?>
                                                    <!-- <span>From</span> -->
                                                </div>
                                                
                                                <label for="">To</label>
                                                <div class="input-container">
                                                    <input type="text" name=""
                                                        class="input inputdate mdl-textfield__input dt-search-show" style="width:100%;"
                                                        value="<?php echo ($this->input->get('date_to') <> '') ? date('d-M-Y', strtotime($this->input->get('date_to'))) : ''; ?>"
                                                        readonly>
                                                    <?php echo form_input(['type' => 'date', 'name' => 'date_to', 'id' => 'date_to', 'placeholder' => '', 'class' => 'date_to dts mdl-textfield__input dt-search', 'value' => ($this->input->get('date_to') <> '') ? $this->input->get('date_to') : '', 'style' => 'width:17px;float:right; position: absolute; right: 8%; border: none; background-color: transparent; top: 50%; transform: translateY(-50%);']) ?>
                                                    
                                                    <!-- <span>TO</span> -->
                                                </div>
                                            </div>
                                        </li>
                                        <!--<li>-->
                                        <!--        <div class="link">-->
                                        <!--            <i class="fa fa-chevron-down"></i>-->
                                        <!--            Search By Query Date-->
                                        <!--        </div>-->
                                        <!--        <div class="content">-->
                                        <!--                <label for="from">From</label>-->
                                        <!--                <div class="input-container" style="margin:0! important">-->
                                        <!--                <input type="text" name=""-->
                                        <!--                    class="input inputdate mdl-textfield__input dt-search-show bg-white" style="width:100%;"-->
                                        <!--                    value="<?php echo ($this->input->get('from') <> '') ? date('d-M-Y', strtotime($this->input->get('from'))) : ''; ?>"-->
                                        <!--                    readonly>-->
                                        <!--                <?php echo form_input(['type' => 'date', 'name' => 'from', 'placeholder' => '', 'id' => 'from', 'class' => 'dt-search', 'value' => ($this->input->get('from') <> '') ? $this->input->get('from') : '', 'style' => 'width:17px;float:right;']) ?>-->
                                                
                                                        <!-- <span>From</span> -->
                                                    
                                        <!--        </div>-->

                                        <!--                <label for="">To</label>-->
                                        <!--                <div class="input-container" style="margin:0! important">-->
                                        <!--                    <input type="text" name=""-->
                                        <!--                        class="input inputdate mdl-textfield__input dt-search-show bg-white" style="width:100%;"-->
                                        <!--                        value="<?php echo ($this->input->get('to') <> '') ? date('d-M-Y', strtotime($this->input->get('to'))) : ''; ?>"-->
                                        <!--                        readonly>-->
                                        <!--                    <?php echo form_input(['type' => 'date', 'name' => 'to', 'id' => 'to', 'placeholder' => '', 'class' => 'dt-search', 'value' => ($this->input->get('to') <> '') ? $this->input->get('to') : '', 'style' => 'width:17px;float:right;']) ?>-->
                                                        
                                                            <!-- <span>TO</span> -->
                                        <!--                </div>-->
                                                    
                                        <!--        </div>-->
                                        <!--    </li>-->

                                        <li>
                                            <div class="link">
                                                <i class="fa fa-chevron-down"></i>
                                                Search By Company
                                            </div>
                                            <div class="content">
                                                <label for="">Company</label>
                                                <div class="input-container">                            
                                                    <?php echo form_input(['name'=>'company','id'=>'company','placeholder'=>'Company Name', 'class'=>'company input mdl-textfield__input', 'value'=>urldecode($this->input->get('company'))])?>
                                                    <input type="hidden" name="company_id" id="company_id" class="company_id" value="<?=($this->input->get('company_id')<>'' && $this->input->get('company')<>'')?$this->input->get('company_id'):''; ?>">
                                                </div>
                                            </div>
                                        </li>
                                        
                                        <li>
                                            <div class="link">
                                                <i class="fa fa-chevron-down"></i>
                                                Search By Query Number
                                            </div>
                                            <div class="content">
                                                <label for="">Query Number</label>
                                                <div class="input-container">                            
                                                    <?php echo form_input(['name' => 'query_number', 'id' => 'query_number', 'class' => 'input', 'value' => ($this->input->get('query_number')<>'')?$this->input->get('query_number'):'']) ?>
                                                </div>
                                            </div>
                                        </li>

                                        <li>
                                            <div class="link">
                                                <i class="fa fa-chevron-down"></i>
                                                Search By Status
                                            </div>
                                            <div class="content">
                                                <label for="">Status</label>
                                                <div class="input-container">
                                                    <div class="mySelect">
                                                        <select name="status" id="status" class="input mdl-textfield__input"
                                                            style="padding: 10px;">
                                                            <option value=""></option>
                                                            <option value="in-progress"
                                                                <?php echo ($this->input->get('status')<>'' && $this->input->get('status')=='in-progress')?'selected="selected"':''; ?>>
                                                                In-progress</option>
                                                            <option value="complete"
                                                                <?php echo ($this->input->get('status')<>'' && $this->input->get('status')=='complete')?'selected="selected"':''; ?>>
                                                                Complete</option>
                                                            <option value="cancel"
                                                                <?php echo ($this->input->get('status')<>'' && $this->input->get('status')=='cancel')?'selected="selected"':''; ?>>
                                                                Cancel</option>
                                                            <option value="file-closed"
                                                                <?php echo ($this->input->get('status')<>'' && $this->input->get('status')=='file-closed')?'selected="selected"':''; ?>>
                                                                File Closed</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>

                                    <div class="filter-buttons">
                                        <button type="submit" style="background-color:#4f4e4e;">Reset</button>
                                        <button style="" class="bg-primary">Search</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        <div class="card-body">
                            <div class="row text-center mt-3">
                                <?php
                                $statuses = [
                                    'in-progress' => ['label' => 'In-Progress', 'color' => '#6f42c1'],
                                    'complete' => ['label' => 'Complete', 'color' => '#28a745'],
                                    'file-closed' => ['label' => 'File Closed', 'color' => '#b20783'],
                                    'cancel' => ['label' => 'Cancel', 'color' => '#dc3545'],
                                ];
                                ?>
                                <?php foreach ($statuses as $key => $info): ?>
                                    <div class="col-lg-3 col-md-6 col-6 mb-2">
                                        <div class="card shadow-sm" style="border-top: 4px solid <?= $info['color'] ?>;">
                                            <div class="card-body p-2">
                                                <h5 class="text-dark mb-1"><?= isset($counts[$key]) ? $counts[$key] : '0' ?></h5>
                                                <small class="text-muted"><?= $info['label'] ?></small>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>     
                            
                                <form method="get">
                                    <div class="content row">
                                        <div class="col-md-2 mt-2">
                                            <label for="location">Location</label>
                                            <div class="mySelect">
                                                <!--<select name="location" id="location" class="select location">-->
                                                <!--<option value="" selected disabled hidden></option>-->
                                               <?php
                                                        // $user_id = $this->session->userdata('id');
                                                        // // Run query directly
                                                        // $this->db->select('*');
                                                        // $this->db->from('admin');
                                                        // $this->db->where('id', $user_id);
                                                        // $query = $this->db->get();

                                                        // // Fetch single row as array
                                                        // $user = $query->row_array();

                                                        // $locations = $locations;

                                                        // $main_keys = ['kazakhstan', 'azerbaijan', 'belarus', 'georgia','armenia'];
                                                        // // $location = $this->session->userdata('locations');

                                                        // if ($this->session->userdata('type') == 2) {
                                                        //     $user_locations = explode(',', $user['location']);
                                                        //     asort($locations);

                                                        //     $has_all_access = in_array('all', $user_locations) ||
                                                        //                     empty(array_diff($main_keys, $user_locations)); // user has all 4 countries

                                                        //     // Show "All" option only if allowed
                                                        //     if ($has_all_access) {
                                                        //         $selected = ($this->input->get('location') == 'all') ? 'selected="selected"' : '';
                                                        //         echo "<option value='all' data-abbr='" . implode(',', $locations['all']) . "' $selected>All</option>";
                                                        //     }

                                                        //     foreach ($locations as $key => $val) {
                                                        //         if ($key === 'all') continue;

                                                        //         if ($has_all_access || in_array($key, $user_locations)) {
                                                        //             $selected = ($this->input->get('location') == $key) ? 'selected="selected"' : '';
                                                        //             echo "<option value='$key' data-abbr='" . implode(',', $val) . "' $selected>" . ucfirst($key) . "</option>";
                                                        //         }
                                                        //     }
                                                        // } else {
                                                        //     // Admin or type ≠ 2 users
                                                        //     asort($locations);

                                                        //     // Always show "All" for admins
                                                        //     $selected = ($this->input->get('location') == 'all') ? 'selected="selected"' : '';
                                                        //     echo "<option value='all' data-abbr='" . implode(',', $locations['all']) . "' $selected>All</option>";

                                                        //     foreach ($locations as $key => $val) {
                                                        //         if ($key === 'all') continue;
                                                        //         $selected = ($this->input->get('location') == $key) ? 'selected="selected"' : '';
                                                        //         echo "<option value='$key' data-abbr='" . implode(',', $val) . "' $selected>" . ucfirst($key) . "</option>";
                                                        //     }
                                                        // }
                                                        ?>

                                                    <!--</select>-->
                                                    <select name="location" id="location" class="location select">
                                                        <option value="" selected disabled hidden></option>
                                                        <?php
                                                            $user_id = $this->session->userdata('id');
                                                            $user_email = $this->session->userdata('email');
                                                            // Run query directly
                                                            $this->db->select('*');
                                                            $this->db->from('admin');
                                                            $this->db->where('id', $user_id);
                                                            $query = $this->db->get();
    
                                                            // Fetch single row as array
                                                            $user = $query->row_array();
    
                                                            // Determine which locations array to use
                                                            $special_emails = [];
                                                            $use_locations_new = in_array($user_email, $special_emails);
    
                                                            $locations = $use_locations_new ? $locations_new : $locations;
                                                            $main_keys = ['kazakhstan', 'azerbaijan', 'belarus', 'georgia', 'armenia','uzbekistan'];
    
                                                            if ($this->session->userdata('type') == 2 && !in_array($user_email, $special_emails)) {
                                                                $user_locations = explode(',', $user['location']);
                                                                asort($locations);
    
                                                                $has_all_access = in_array('all', $user_locations) ||
                                                                                empty(array_diff($main_keys, $user_locations));
    
                                                                // Show "All" option only if allowed
                                                                if ($has_all_access) {
                                                                    $selected = ($this->input->get('location') == 'all') ? 'selected="selected"' : '';
                                                                    echo "<option value='all' data-abbr='" . implode(',', $locations['all']) . "' $selected>All</option>";
                                                                }
    
                                                                foreach ($locations as $key => $val) {
                                                                    if ($key === 'all') continue;
    
                                                                    if ($has_all_access || in_array($key, $user_locations)) {
                                                                        $selected = ($this->input->get('location') == $key) ? 'selected="selected"' : '';
                                                                        echo "<option value='$key' data-abbr='" . implode(',', $val) . "' $selected>" . ucfirst($key) . "</option>";
                                                                    }
                                                                }
                                                            } else {
                                                                // Admin or type ≠ 2 users
                                                                asort($locations);
    
                                                                // Always show "All" for admins
                                                                $selected = ($this->input->get('location') == 'all') ? 'selected="selected"' : '';
                                                                echo "<option value='all' data-abbr='" . implode(',', $locations['all']) . "' $selected>All</option>";
    
                                                                foreach ($locations as $key => $val) {
                                                                    if ($key === 'all') continue;
                                                                    $selected = ($this->input->get('location') == $key) ? 'selected="selected"' : '';
                                                                    echo "<option value='$key' data-abbr='" . implode(',', $val) . "' $selected>" . ucfirst($key) . "</option>";
                                                                }
                                                            }
                                                        ?>
    
                                                    </select>
                                            </div>
                                        </div>

                                        <div class="col-md-2 mt-2">
                                            <label for="booking_type">Booking Type</label>
                                            <div class="mySelect">
                                                <select name="booking_type" id="booking_type" class="select booking_type" data-selected="<?= $this->input->get('booking_type') ?? 'all'; ?>">
                                                    <option value=""></option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-2 mt-2">
                                            <label for="Staff">Staff</label>
                                            <div class="mySelect">
                                                <select name="staff_id" id="staff_id" class="select mdl-textfield__input staff_id">
                                                        <option value=""></option>
                                                </select>
                                            </div>
                                        </div>
    
                                        <!--<div class="col-md-2">-->
                                        <!--    <label for="">Status</label>-->
                                        <!--    <div class="myselect">-->
                                        <!--        <select name="status" id="status" class="select mdl-textfield__input"-->
                                        <!--            style="">-->
                                        <!--            <option value=""></option>-->
                                        <!--            <option value="in-progress"-->
                                        <!--                <?php echo ($this->input->get('status')<>'' && $this->input->get('status')=='in-progress')?'selected="selected"':''; ?>>-->
                                        <!--                In-progress</option>-->
                                        <!--            <option value="complete"-->
                                        <!--                <?php echo ($this->input->get('status')<>'' && $this->input->get('status')=='complete')?'selected="selected"':''; ?>>-->
                                        <!--                Complete</option>-->
                                        <!--            <option value="cancel"-->
                                        <!--                <?php echo ($this->input->get('status')<>'' && $this->input->get('status')=='cancel')?'selected="selected"':''; ?>>-->
                                        <!--                Cancel</option>-->
                                        <!--            <option value="file-closed"-->
                                        <!--                <?php echo ($this->input->get('status')<>'' && $this->input->get('status')=='file-closed')?'selected="selected"':''; ?>>-->
                                        <!--                File Closed</option>-->
                                        <!--        </select>-->
                                        <!--    </div>-->
                                        <!--</div>-->
                                         <div class="col-md-2">
                                            <label for="from">From</label>
                                            <div class="input-container">
                                                <input type="text" name=""
                                            class="input inputdate mdl-textfield__input dt-search-show" style="width:100%;"
                                            value="<?php echo ($this->input->get('date_from') <> '') ? date('d-M-Y', strtotime($this->input->get('date_from'))) : ''; ?>"
                                            readonly>
                                            <?php echo form_input(['type' => 'date', 'name' => 'date_from', 'placeholder' => '', 'id' => 'date_from', 'class' => 'dts mdl-textfield__input dt-search date_from', 'value' => ($this->input->get('date_from') <> '') ? $this->input->get('date_from') : '', 'style' => 'width:17px;float:right; position: absolute; right: 8%; border: none; background-color: transparent; top: 50%; transform: translateY(-50%);']) ?>
                                                <!-- <span>From</span> -->
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-2">
                                            <label for="">To</label>
                                            <div class="input-container">
                                                <input type="text" name=""
                                                    class="input inputdate mdl-textfield__input dt-search-show" style="width:100%;"
                                                    value="<?php echo ($this->input->get('date_to') <> '') ? date('d-M-Y', strtotime($this->input->get('date_to'))) : ''; ?>"
                                                    readonly>
                                                <?php echo form_input(['type' => 'date', 'name' => 'date_to', 'id' => 'date_to', 'placeholder' => '', 'class' => 'date_to dts mdl-textfield__input dt-search', 'value' => ($this->input->get('date_to') <> '') ? $this->input->get('date_to') : '', 'style' => 'width:17px;float:right; position: absolute; right: 8%; border: none; background-color: transparent; top: 50%; transform: translateY(-50%);']) ?>
                                                
                                                <!-- <span>TO</span> -->
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-2">
                                            <label for="">Status</label>
                                            <div class="mySelect">
                                                <select name="status" id="status" class="input mdl-textfield__input"
                                                    style="padding: 10px;">
                                                    <option value=""></option>
                                                    <option value="in-progress"
                                                        <?php echo ($this->input->get('status')<>'' && $this->input->get('status')=='in-progress')?'selected="selected"':''; ?>>
                                                        In-progress</option>
                                                    <option value="complete"
                                                        <?php echo ($this->input->get('status')<>'' && $this->input->get('status')=='complete')?'selected="selected"':''; ?>>
                                                        Complete</option>
                                                    <option value="cancel"
                                                        <?php echo ($this->input->get('status')<>'' && $this->input->get('status')=='cancel')?'selected="selected"':''; ?>>
                                                        Cancel</option>
                                                    <option value="file-closed"
                                                        <?php echo ($this->input->get('status')<>'' && $this->input->get('status')=='file-closed')?'selected="selected"':''; ?>>
                                                        File Closed</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-2">
                                            <label for="">Company</label>
                                                <div class="input-container">                            
                                                    <?php echo form_input(['name'=>'company','id'=>'company','placeholder'=>'Company Name', 'class'=>'company input mdl-textfield__input', 'value'=>urldecode($this->input->get('company')), 'style' => 'background-color:#fff; color:black;'])?>
                                                    <input type="hidden" name="company_id" id="company_id"class="company_id" value="<?=($this->input->get('company_id')<>'' && $this->input->get('company')<>'')?$this->input->get('company_id'):''; ?>">
                                                </div>
                                        </div>
                                        
                                         <div class="col-md-2 mt-2">
                                            <label for="Staff"> Query Number</label>
                                            <div class="mySelect">
                                                <?php echo form_input(['name' => 'query_number', 'id' => 'query_number', 'class' => 'input', 'value' => ($this->input->get('query_number')<>'')?$this->input->get('query_number'):'']) ?>
                                            </div>
                                        </div>

                                     <div class="col-md-4 mt-2">
                                        <div class="input-container">
                                            <?php echo form_submit(['name'=>'submit','id'=>'submit', 'class'=>'ms-2 btn btn-md btn-info mt-1', 'value'=>'Search']);?>
                                    
                                            <a href="javascript:void(0)" class="btn btn-md btn-info mt-1 ms-3 " id="toggleBtn" >Advance Search</a>
                                    
                                            <?php 
                                                $user_email = strtolower($this->session->userdata('email'));
                                    
                                                $allowed_emails = [
                                                    'siddhesh@kazindmc.com',
                                                    'tsm@kazindmc.com'
                                                ];
                                    
                                                if (in_array($this->session->userdata('type'), ['1', '3']) || in_array($user_email, $allowed_emails)) : 
                                            ?>
                                                <a href="<?= base_url('budget-report-tracking');?>" class="btn btn-md btn-info mt-1 ms-3 " id="toggleBtn" >Budget Tracker</a>
                                            <?php endif; ?>
                                    
                                            <a href="<?php echo base_url('excel-download?'.$this->input->SERVER('QUERY_STRING')); ?>"
                                            class="btn btn-sm btn-primary mt-1 ms-3" style="padding:6px;" title="Download Excel"
                                            target="_blank">
                                            <i class="fa fa-download"></i></a>
                                    
                                        </div>
                                    </div>

                                    </div>
                                </form>
                                <div class="row text-center mt-3">
                                <?php
                                $statuses2 = [
                                    'complete' => ['label' => 'Improper Flight Details', 'color' => 'blue'],
                                    'in-progress' => ['label' => 'Flight Details Entered', 'color' => '#ff008d'],
                                    'file-closed' => ['label' => 'Booking Cancelled', 'color' => 'red'],
                                ];
                                ?>
                                <?php foreach ($statuses2 as $key => $info1): ?>
                                    <div class="col-lg-4 col-md-6 col-6 mb-2">
                                        <div class="card shadow-sm" style="border-top: 4px solid <?= $info1['color'] ?>;">
                                            <div class="card-body p-2">
                                                <small class="text-muted"><?= $info1['label'] ?></small>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>     
                                <div class="table-scrollable">
                                    <table class="table table-hover table-striped table-checkable border order-column full-width"
                                            id="arrival_lists" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th class="center">S.No.</th>
                                                    <th class="center">Query <br>Number</th>
                                                    <th class="center">Physical <br>Arrival<br> Date</th>
                                                    <th class="center">Number Of<br> Nights</th>
                                                    <th class="center">Handling <br>Staff <br>Name</th>
                                                    <th class="center">Hotel <br>Name </th>
                                                    <th class="center">Nos. of<br>Guests</th>
                                                    <th class="center">Transportation</th>
                                                    <th class="center">Guide / Driver</th>
                                                    <th class="center">Group <br>Type</th>
                                                    <th class="center">Handover <br>To <br>Agent</th>
                                                    <th class="center">Company Name</th>
                                                    <?php  //if(in_array($this->session->userdata('type'),['1','3'])){ 
                                                        if($this->session->userdata('email') != 'vishal@kazindmc.com'){
                                                    ?>
                                                    <th class="center">Currency</th>
                                                    <th class="center">Client <br>Billing</th>
                                                    <th class="center">Payment <br>Received <br>In India</th>
                                                    <th class="center">Payment <br>Received <br>In Other</th>
                                                    <th class="center">Balance <br>Amount</th>
                                                    <th class="center">Time Query Confirm</th>
                                                    <th class="center">Payment Remarks</th>
                                                    <?php } ?>
                                                    <th class="center">Status</th>
                                                    <th class="center">Action</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php     
                                        $records_cnt=0;
                                        if(!empty($result)) {
                                           $i=$offset+1;
                                        foreach($result as $list) { 
                                            $records_cnt++;                                            
                                            $arrival_id = $list->id;
                                            $enq_id = $list->enquiry_id;
                                            $arrival_date2=$list->arrival_date;
                                            $this->db->select('*');
                                            $this->db->from('combo_enquiry');
                                            $this->db->where('id =', $list->combo_enquiry_id);
                                            $enquiry = $this->db->get()->result_array();
                                            
                                            $where = 'arrival_flight_details.arrival_id= '.$arrival_id.' GROUP BY flight_mode';
                                            $select = 'SUM(arrival_flight_details.number_persons) AS person_cnt,arrival_flight_details.flight_mode';
                                            $flight_details = $this->common_model->get_data('arrival_flight_details','', '', $select,$where,'', $count = false);
                                            //echo '<pre>';print_r($flight_details);
                                            if(empty($flight_details) && $list->split_count == 0){                                                
                                                $where = 'arrival_flight_details.enquiry_id= '.$enq_id.' GROUP BY flight_mode';
                                                $select = 'SUM(arrival_flight_details.number_persons) AS person_cnt,arrival_flight_details.flight_mode';
                                                $flight_details = $this->common_model->get_data('arrival_flight_details','', '', $select,$where,'', $count = false);
                                            }
                                            
                                            
                                            $arrival_date = date_create($list->arrival_date);
                                            $days_to_add = (int)$list->number_of_nights + 1;
                                            date_add($arrival_date,date_interval_create_from_date_string($days_to_add.' days'));
                                            $d1_arrival = date_format($arrival_date,'Y-m-d');
                                            $d2_today = date('Y-m-d');
                                            $auto_updated = 0;
                                            if($d1_arrival < $d2_today && $list->status == 'in-progress' /*&& $list->enquiry_no=='FAZ3706'*/){
                                                $update_arr = array('status'=>'complete');
                                                $id = $list->id;
                                                $update_data = ['table_name'=>'arrivals','update_data'=>$update_arr,'condition'=>['id'=>$id]];
                                                $affected_rows = $this->common_model->update_data_limit($update_data);
                                                if($affected_rows){
                                                    $list->status = 'complete';
                                                    $auto_updated = 1;
                                                }
                                            }
                                            if($d1_arrival < $d2_today && $list->status == 'complete' && $list->balance_amount == '0' /*&& $list->enquiry_no=='FAZ3706'*/){
                                                $update_arr = array('status'=>'file-closed');
                                                $id = $list->id;
                                                $update_data = ['table_name'=>'arrivals','update_data'=>$update_arr,'condition'=>['id'=>$id]];
                                                $affected_rows = $this->common_model->update_data_limit($update_data);
                                                if($affected_rows){
                                                    $list->status = 'file-closed';
                                                    $auto_updated = 1;
                                                }
                                            }
                                            
                                            // $where = 'arrival_hotel_details.enquiry_id = '.$enq_id;
                                            // $select = 'arrival_hotel_details.hotel_name';
                                            // $hotel = $this->common_model->get_data('arrival_hotel_details','', '', $select,$where,' ORDER BY arrival_hotel_details.checkout_date ASC LIMIT 1', $count = false);
                                            // $hotel_name = (!empty($hotel)?$hotel[0]->hotel_name:''); 
                                            if($arrival_date2 >='2025-04-01')
                                            {
                                                $where = 'arrival_hotel_details.arrival_id = '.$arrival_id;
                                                $select = 'arrival_hotel_details.hotel_name';
                                                $hotel = $this->common_model->get_data('arrival_hotel_details','', '', $select,$where,' ORDER BY arrival_hotel_details.checkout_date ASC LIMIT 1', $count = false);
                                                $hotel_name = (!empty($hotel)?$hotel[0]->hotel_name:''); 
                                            }
                                            else{
                                                 $where = 'arrival_hotel_details.enquiry_id = '.$enq_id;
                                                $select = 'arrival_hotel_details.hotel_name';
                                                $hotel = $this->common_model->get_data('arrival_hotel_details','', '', $select,$where,' ORDER BY arrival_hotel_details.checkout_date ASC LIMIT 1', $count = false);
                                                $hotel_name = (!empty($hotel)?$hotel[0]->hotel_name:''); 
                                            }    
                                            
                                            $where = 'payment_details.arrival_id= '.$list->id;
                                            $select = 'payment_details.remarks';
                                            $payment_details_remarks = $this->common_model->get_data('payment_details','', '', $select,$where,' ORDER BY payment_details.id DESC LIMIT 1', $count = false);
                                            $remarks = (!empty($payment_details_remarks))?$payment_details_remarks[0]->remarks:'';
                                            
                                            // $where = 'enquiry_transport.arrival_id= '.$arrival_id.' ORDER BY enquiry_transport.id ASC LIMIT 1 ';
                                            // $join = [['type' => '', 'join_table' => 'transportation', 'condition' => 'transportation.id = enquiry_transport.transportation_id']];
                                            // $trans_details = $this->common_model->get_data('enquiry_transport','', '', 'transportation.vehicle_name',$where,'', $count = false,$join);
                                            if($arrival_date2 >='2025-05-01')
                                            {
                                                $where = 'enquiry_transport.arrival_id= '.$arrival_id.' ORDER BY enquiry_transport.id ASC LIMIT 1 ';
                                                $join = [['type' => '', 'join_table' => 'transportation', 'condition' => 'transportation.id = enquiry_transport.transportation_id']];
                                                $trans_details = $this->common_model->get_data('enquiry_transport','', '', 'transportation.vehicle_name',$where,'', $count = false,$join);
                                            }
                                            else
                                            {
                                                $where = 'enquiry_transport.enquiry_id= '.$enq_id.' ORDER BY enquiry_transport.id ASC LIMIT 1 ';
                                                $join = [['type' => '', 'join_table' => 'transportation', 'condition' => 'transportation.id = enquiry_transport.transportation_id']];
                                                $trans_details = $this->common_model->get_data('enquiry_transport','', '', 'transportation.vehicle_name',$where,'', $count = false,$join);
                                            }
                                            
                                            $where = 'enquiry_guide.arrival_id = '.$arrival_id.' ORDER BY enquiry_guide.id ASC';
                                            $join = [['type' => '', 'join_table' => 'guides', 'condition' => 'guides.id = enquiry_guide.guide_id']];
                                            $guide_details = $this->common_model->get_data('enquiry_guide','', '', 'guides.name',$where,'', $count = false,$join);
                                            if($list->combo_enquiry_id == 'NULL'){
                                                if(empty($guide_details) && $list->split_count == 0){                                                
                                                    $where = 'enquiry_guide.enquiry_id= '.$enq_id.' ORDER BY enquiry_guide.id ASC';
                                                    $join = [['type' => '', 'join_table' => 'guides', 'condition' => 'guides.id = enquiry_guide.guide_id']];
                                                    $guide_details = $this->common_model->get_data('enquiry_guide','', '', 'guides.name',$where,'', $count = false,$join);
                                                }
                                            }

                                            $guides = [];
                                            if(!empty($guide_details)){
                                                foreach($guide_details AS $guide_list){
                                                    $guides[] = $guide_list->name;
                                                }
                                            }
                                            if($list->guide<>''){ $guides[] = $list->guide; }
                                            
                                            $where = 'arrival_restaurants.arrival_id= '.$list->id;
                                            $arrival_restaurants = $this->restaurantmenumaster_model->available_menu_item($list->id);
                                            
                                            $where = 'arrivals.id = ' . $arrival_id;
                                            $select = 'arrivals.driver_id,drivers.driver_name,drivers.driver_phone_number';
                                            $join = [['type' => '', 'join_table' => 'drivers', 'condition' => 'drivers.id = arrivals.driver_id'],];
                                            $drivers = $this->common_model->get_data('arrivals', '', '', $select, $where, '', $count = false, $join);
                                            
                                            if ($list->split_count != 0) {
                                                $this->db->select('
                                                    MIN(checkin_date) AS min_checkin_date,
                                                    MAX(checkout_date) AS max_checkout_date
                                                ');
                                                $this->db->from('arrival_hotel_details');
                                                $this->db->where('arrival_id', $arrival_id);
                                            
                                                $date_result = $this->db->get()->row();
                                            
                                                $min_checkin  = $date_result->min_checkin_date;
                                                $max_checkout = $date_result->max_checkout_date;
                                                $checkin  = new DateTime($min_checkin);
                                                $checkout = new DateTime($max_checkout);
                                                $days = $checkin->diff($checkout)->days;
                                            }

                                            
                                        ?>
                                                <?php
                                                    $status_color = ['in-progress'=>'#663399','complete'=>'#18ce0f','cancel'=>'#FF3636','file-closed'=>'#b20783'];
                                                    $status = $list->status;
                                                     ?>

                                                <tr class="odd gradeX" <?= $list->status == 'cancel' ? 'title="Booking Cancelled"' : '' ?>>
                                                    <td class="center"><?=$i++?></td>

                                                    <?php if($status=="cancel") { ?>

                                                    <td class="center" style="color: <?=$status_color[$status]?>;">
                                                        
                                                   
                                                     <?php
                                                        $this->db->where('file1', $list->enquiry_no);
                                                        $this->db->or_where('file2', $list->enquiry_no);
                                                        $combo_query = $this->db->get('arrival_combo');
                                                        $combo_result = $combo_query->row();
                                                        
                                                        $this->db->select('*');
                                                        $this->db->from('combo_enquiry');
                                                        $this->db->where('id', $list->combo_enquiry_id);
                                                        $enquiry = $this->db->get()->result_array();

                                                        $is_combo = false;
                                                        $tooltip = '';

                                                        if ($combo_result) {
                                                            if ($combo_result->file1 == $list->enquiry_no) {
                                                                $is_combo = true;
                                                                $tooltip = 'Combo with: ' . $combo_result->file2;
                                                            } elseif ($combo_result->file2 == $list->enquiry_no) {
                                                                $is_combo = true;
                                                                $tooltip = 'Combo with: ' . $combo_result->file1;
                                                            }
                                                        }
                                                        ?>

                                                        <span style="font-weight:600 !important;" title="<?= $tooltip ?>">
                                                            <?= $list->enquiry_no ?>
                                                            <?php if ($is_combo): ?>
                                                                <strong>(c)</strong>
                                                            <?php endif; ?>
                                                            <?php
                                                                if ($list->combo_enquiry_id != null) {
                                                                    echo '(' . $enquiry[0]['enquiry_abbr'] . ')';
                                                                } 
                                                            ?>
                                                        </span>
                                                    </td>
                                                    <td class="center"
                                                        style="color: <?=$status_color[$status]?>;">
                                                        <span style="font-weight:600 !important;"><?= date('d-M-Y',strtotime($list->arrival_date))?></span></td>
                                                        <td class="center" style="color: <?=$status_color[$status]?>;"><?=$list->number_of_nights?></td>
                                                        <td class="center" style="color: <?=$status_color[$status]?>;"><?=$list->staff_name?></td>
                                                        <td class="center" style="color: <?=$status_color[$status]?>;"><?=$hotel_name?></td>
                                                        <td class="center" style="color: <?=$status_color[$status]?>;">
                                                        <?php
                                                            if($list->split_number != '0'){
                                                                echo (($list->num_adults=='')?'0':$list->num_adults) + (($list->num_child=='')?'0':$list->num_child);
                                                            }else{
                                                                echo (($list->number_persons=='')?'0':$list->number_persons) + (($list->number_child=='')?'0':$list->number_child);
                                                            }
                                                        ?>
                                                    </td>
                                                    <td class="center" style="color: <?=$status_color[$status]?>;"><span style="font-weight:500 !important;">
                                                        <?php if($list->vehicle_type<>'') { echo $list->vehicle_type; 
                                                            }else if(!empty($trans_details)){
                                                                echo $trans_details[0]->vehicle_name;
                                                            } ?></span></td>
                                                    <td class="center" style="color: <?=$status_color[$status]?>;"><span style="font-weight:500 !important;">
                                                        <?php //if($list->guide<>''){ echo $list->guide;}
                                                        if(!empty($guides)){
                                                            if(count($guides)==1){
                                                                echo $guides[0];
                                                            }else{
                                                                $div = '<div class="guide-hide">'.$guides[0].' ..</div>';
                                                                $div .= '<div class="guide-show" style="display:none;">'.implode(', ',$guides).' <button class="btn btn-xs btn-danger btn-less">less</button></div>';
                                                                echo $div;
                                                            }
                                                        }else{ echo '<i class="fa fa-user-times" aria-hidden="true" title="No Guide" style="color: #ffb1b1;"></i>'; }
                                                        ?> / 
                                                        <?php if(!empty($drivers)){
                                                            $div = '<div class="driver-hide">'.$drivers[0]->driver_name.' ..</div>';
                                                            $div .= '<div class="driver-show" style="display:none;">'.$drivers[0]->driver_name.' '.$drivers[0]->driver_phone_number.' <button class="btn btn-xs btn-danger btn-less-driver">less</button></div>';
                                                            echo $div;
                                                        }else{
                                                            echo '<i class="fa fa-user-times" aria-hidden="true" title="No Driver" style="color: #ffb1b1;"></i>';
                                                        }
                                                        
                                                        
                                                        ?>
                                                    </span></td>
                                                    <td class="center" style="color: <?=$status_color[$status]?>;"><?=$list->group_type?></td>
                                                    <td class="center" style="color: <?=$status_color[$status]?>;"><?=$list->handover_to_client?></td>
                                                    
                                                    <td class="center" style="color: <?=$status_color[$status]?>;"><?=$list->name?></td>
                                                    <?php } else { ?>
                                                    <td class="center">
                                                       
                                                       
                                                     <?php
                                                        $this->db->where('file1', $list->enquiry_no);
                                                        $this->db->or_where('file2', $list->enquiry_no);
                                                        $combo_query = $this->db->get('arrival_combo');
                                                        $combo_result = $combo_query->row();

                                                        $is_combo = false;
                                                        $tooltip = '';

                                                        if ($combo_result) {
                                                            if ($combo_result->file1 == $list->enquiry_no) {
                                                                $is_combo = true;
                                                                $tooltip = 'Combo with: ' . $combo_result->file2;
                                                            } elseif ($combo_result->file2 == $list->enquiry_no) {
                                                                $is_combo = true;
                                                                $tooltip = 'Combo with: ' . $combo_result->file1;
                                                            }
                                                        }
                                                        ?>

                                                        <span style="font-weight:600 !important;" title="<?= $tooltip ?>">
                                                            <?= $list->enquiry_no ?>
                                                            <?php if ($is_combo): ?>
                                                                <strong>(c)</strong>
                                                            <?php endif; ?>
                                                            <?php
                                                                if ($list->combo_enquiry_id != null) {
                                                                    echo '(' .$enquiry[0]['enquiry_abbr'] . ')';
                                                                } 
                                                            ?>
                                                        </span>
                                                        <?php 
                                                            if($list->split_count > 1){
                                                            /*$split_arr = explode(',',$list->split_num); 
                                                            foreach($split_arr AS $val){
                                                                $d = explode('_',$val);*/ ?>
                                                                <a href="<?= base_url('edit_arrival?id='.base64_encode($list->id)); ?>" class="btn btn-primary btn-sm mt-1 mr-1 nowrap" title="Split" style="color:#FFF;text-transform: none;"><i class="fa fa-plane"></i> Split <?=$list->split_num?></a>
                                                               
                                                            <?php //}
                                                            }
                                                        ?>
                                                    </td>
                                                    <td class="center" >
                                                        <span style="font-weight:600 !important;"><?= date('d-M-Y',strtotime($list->arrival_date))?></span></td>
                                                        <!--<td class="center">-->
                                                            <?php //echo $list->number_of_nights ? $list->number_of_nights : $enquiry[0]['no_of_nights']; ?>
                                                        <!--</td>-->
                                                        <td class="center">
                                                             <?php 
                                                               if (!empty($enquiry) && isset($enquiry[0]['no_of_nights']) && $enquiry[0]['no_of_nights'] !== '') {
                                                                
                                                                    echo $enquiry[0]['no_of_nights'];
                                                                
                                                                } elseif ($list->split_count != 0 && isset($days)) {
                                                                
                                                                    echo $days;
                                                                
                                                                } else {
                                                                
                                                                    echo $list->number_of_nights;
                                                                
                                                                }
                                                            ?>
                                                        </td>
                                                        <td class="center"><?=$list->staff_name?></td>
                                                        <td class="center"><?=$hotel_name?></td>
                                                        <td class="center">
                                                            <?php
                                                                // if($list->split_number != '0'){
                                                                //     echo (($list->num_adults=='')?'0':$list->num_adults) + (($list->num_child=='')?'0':$list->num_child);
                                                                // }else{
                                                                //     echo (($list->number_persons=='')?'0':$list->number_persons) + (($list->number_child=='')?'0':$list->number_child);
                                                                // }
                                                            ?>
                                                            <?php
                                                                // if ($list->split_number != '0') {
                                                                //     $adults = ($list->num_adults == '') ? 0 : $list->num_adults;
                                                                //     $children = ($list->num_child == '') ? 0 : $list->num_child;
                                                                // } else {
                                                                //     $adults = ($list->number_persons == '') ? 0 : $list->number_persons;
                                                                //     $children = ($list->number_child == '') ? 0 : $list->number_child;
                                                                // }
                                                                
                                                                // if ($children > 0) {
                                                                //     echo "{$adults} (A), {$children} (C)";
                                                                // } else {
                                                                //     echo "{$adults}";
                                                                // }
                                                            ?>
                                                            
                                                            <?php                                                              
                                                                // Check if it's a combo enquiry
                                                                if ($list->combo_enquiry_id != null) {
                                                                    // Get data from combo_enquiry table
                                                                    $this->db->select('*');
                                                                    $this->db->from('combo_enquiry');
                                                                    $this->db->where('id', $list->combo_enquiry_id);
                                                                    $enquiry = $this->db->get()->result_array();
                                                                    
                                                                    if (!empty($enquiry)) {
                                                                        $comboData = $enquiry[0];
                                                                        $adults = $comboData['no_of_person'] ?? 0;
                                                                        $children = $comboData['no_of_child'] ?? 0;
                                                                        
                                                                        // Display combo enquiry info with enquiry abbreviation
                                                                        if ($children > 0) {
                                                                            echo "{$adults} (A), {$children} (C) ";
                                                                        } else {
                                                                            echo "{$adults} (A)";
                                                                        }
                                                                    } else {
                                                                        // Fallback if combo enquiry not found
                                                                        echo "Combo data not found";
                                                                    }
                                                                } else {
                                                                    // Regular enquiry handling
                                                                    if ($list->split_number != '0') {
                                                                        $adults = ($list->num_adults == '') ? 0 : $list->num_adults;
                                                                        $children = ($list->num_child == '') ? 0 : $list->num_child;
                                                                    } else {
                                                                        $adults = ($list->number_persons == '') ? 0 : $list->number_persons;
                                                                        $children = ($list->number_child == '') ? 0 : $list->number_child;
                                                                    }

                                                                    if ($children > 0) {
                                                                        echo "{$adults} (A), {$children} (C)";
                                                                    } else {
                                                                        echo "{$adults} (A)";
                                                                    }
                                                                }
                                                            ?>
                                                        </td>
                                                        <td class="center"><span style="color:blue !important;font-weight:500 !important;">
                                                            <?php if($list->vehicle_type<>'') { echo $list->vehicle_type; 
                                                                }else if(!empty($trans_details)){
                                                                    echo $trans_details[0]->vehicle_name;
                                                                } ?></span></td>
                                                        <td class="center"><span style="color:blue !important;font-weight:500 !important;">
                                                            <?php //if($list->guide<>''){ echo $list->guide;}
                                                            if(!empty($guides)){
                                                                if(count($guides)==1){
                                                                    echo $guides[0];
                                                                }else{
                                                                    $div = '<div class="guide-hide">'.$guides[0].' ..</div>';
                                                                    $div .= '<div class="guide-show" style="display:none;">'.implode(', ',$guides).' <button class="btn btn-xs btn-danger btn-less">less</button></div>';
                                                                    echo $div;
                                                                }
                                                            }else{ echo '<i class="fa fa-user-times" aria-hidden="true" title="No Guide" style="color: #ffb1b1;"></i>'; }
                                                            ?> / 
                                                            <?php if(!empty($drivers)){
                                                                $div = '<div class="driver-hide">'.$drivers[0]->driver_name.' ..</div>';
                                                                $div .= '<div class="driver-show" style="display:none;">'.$drivers[0]->driver_name.' '.$drivers[0]->driver_phone_number.' <button class="btn btn-xs btn-danger btn-less-driver">less</button></div>';
                                                                echo $div;
                                                            }else{
                                                                echo '<i class="fa fa-user-times" aria-hidden="true" title="No Driver" style="color: #ffb1b1;"></i>';
                                                            }
                                                            
                                                            
                                                            ?>
                                                        </span></td>
                                                        <td class="center"><?=$list->group_type?></td>
                                                        <td class="center"><?=$list->handover_to_client?></td>
                                                        
                                                        <td class="center"><?=$list->name?></td>
                                                    <?php } ?>
                                                   
                                                    
                                                    <?php  //if(in_array($this->session->userdata('type'),['1','3'])){ 
                                                        if($this->session->userdata('email') != 'vishal@kazindmc.com'){
                                                    ?>
                                                    <td class="center"><?=$list->currency?></td>
                                                    <td class="center"><?=$list->client_billing?></td>
                                                    <td class="center"><?=(int)$list->payment_received_india + (int)$list->paymentreceived_india?></td>
                                                    <td class="center"><?=(int)$list->payment_received_almaty + (int)$list->paymentrecieved_in_other?></td>
                                                    <td class="center"><?=$list->balance_amount?></td>
                                                    <td><label style="font-weight:600;"><?php echo date('d-M-Y , g:i a', strtotime($list->created)); ?></label></td>
                                                    <td class="center"><?=$remarks?></td>
                                                    <?php } ?>
                                                    <td class="center">
                                                        <a class="btn btn-xs"
                                                            
                                                            href="#">
                                                                <?php echo ucfirst($status);?>
                                                                </a>
                                                             <?php if($list->remarks != ''): ?>
                                                            <div class="remarks-container">
                                                                <div class="remarks-hide">
                                                                    <span style="font-size: 9px; font-weight: bold;">Remarks..</span>
                                                                    <button type="button" class="btn btn-xs btn-primary btn-remarks-show">Show</button>
                                                                </div>
                                                                <div class="remarks-show" style="display: none;">
                                                                    <?= nl2br(htmlspecialchars($list->remarks)); ?>
                                                                </div>
                                                            </div>
                                                        <?php endif; ?>
                                                        <?php if($auto_updated){ ?>
                                                        <span class="badge badge-warning"><i
                                                                class="fa fa-hand-o-right"></i> Auto-updated At
                                                            <?php echo date('Y-m-d H:i:s'); ?></span>
                                                        <?php } ?>
                                                    </td>
                                                    
                                                    <td style="display:flex;">
                                                        <?php 

                                                            $locations = explode(',', $this->session->userdata('locations'));
                                                            
                                                            if(
                                                                $this->session->userdata('type') == 1
                                                                ||
                                                                (
                                                                    in_array(
                                                                        $this->session->userdata('email'),
                                                                        ['bo.geo@kazindmc.com','uz.backoffice@kazindmc.com']
                                                                    )
                                                                    &&
                                                                    count(array_intersect(
                                                                        $locations,
                                                                        ['uzbekistan','georgia','azerbaijan']
                                                                    )) > 0
                                                                )
                                                            ){
                                                        // if($this->session->userdata('type')==1 || (in_array($this->session->userdata('email'),['bo.geo@kazindmc.com','uz.backoffice@kazindmc.com']) && in_array($this->session->userdata('locations'), ['uzbekistan','georgia','azerbaijan']))){

                                                        if(count($flight_details) == 2 && ($flight_details[0]->person_cnt == $flight_details[1]->person_cnt))
                                                        { ?>
                                                        <a href="<?=base_url('create-itinerary?id='.base64_encode($list->id)) ?>"
                                                            class="" title="Itinerary"
                                                            style="margin-right: 10px;margin-top: 3px;"
                                                            target="_blank"><i class="fa fa-calendar" style="color:#2CA8FF;"></i></a>
                                                        <?php }
                                                        else{ ?>
                                                        <span class="" data-toggle="tooltip"
                                                            title="Improper Flight Details"
                                                            style="margin-right: 10px;margin-top: 3px;color: #ff5555;"><i
                                                                class="fa fa-calendar"></i></span>
                                                        <?php } } ?>
                                                        <a href="<?=base_url('print_service_voucher?id='.base64_encode($list->id)) ?>"
                                                            class="btn btn-tbl-edit btn-xs"
                                                            title="Print Service Voucher"
                                                            style="background-color:#2CA8FF;" target="_blank"><i
                                                                class="fa fa-print"></i></a>
                                                        <?php if(!empty($arrival_restaurants)) { ?><a  href="<?=base_url('select-print-restaurant-voucher?id='.base64_encode($list->id)) ?>" 
                                                            class="btn btn-tbl-edit btn-xs"
                                                            title="Print Restaurant Voucher"
                                                            style="background-color:green;" target="_blank"><i
                                                                class="fa fa-print"></i></a><?php } ?>
                                                        <a href="<?=base_url('print_file_arrival?id='.base64_encode($list->id)) ?>"
                                                            class="btn btn-tbl-edit btn-xs"
                                                            title="Print File Arrival Details"
                                                            style="background-color:#ffc107;" target="_blank"><i
                                                                class="fa fa-print"></i></a>
                                                        <?php 
                                                            $user_booking_type = $this->db->select('booking_type')->from('admin')->where('id', $this->session->userdata('id'))->get()->row();                                                            
                                                            $allowedTypes = [];

                                                            if (!empty($user_booking_type->booking_type)) {
                                                                $allowedTypes = array_map('trim', explode(',', $user_booking_type->booking_type));
                                                            }

                                                            $enquiryPrefix = strtoupper(substr($list->enquiry_no, 0, 3));

                                                            // Conditions for showing the Original button (admin, ID list, OR booking type match)
                                                            $showOriginal = (in_array($this->session->userdata('type'), [1]) || 
                                                                            in_array($this->session->userdata('id'), [62, 31, 49, 54, 41, 70, 112, 89]) || 
                                                                            in_array($enquiryPrefix, $allowedTypes));

                                                            // Conditions for showing Closing & Final buttons (only admin or ID list, not booking type)
                                                            $showExtra = (in_array($this->session->userdata('type'), [1]) || 
                                                                        in_array($this->session->userdata('id'), [62, 31, 49, 54, 41, 70, 112]));

                                                            if ($showOriginal) {
                                                                $quot_final = $this->db->select('quot_final, created')->from('quotations')->where('enquiry_id', $enq_id)->where('quot_final', 'yes')->get()->row();
                                                                $acknow_quot = $this->db->select('enquiry_id,final_budget')->from('saved_budget_reports')->where('enquiry_id', $enq_id)->order_by('id', 'DESC')->get()->row();

                                                                if (!empty($quot_final) && !empty($quot_final->created) && strtotime($quot_final->created) >= strtotime('2026-01-10')) {
                                                                    // Original Budget Report – always shown if $showOriginal is true
                                                                    ?>
                                                                    <a href="<?= base_url('original-budget-report/'.base64_encode($enq_id)) ?>" class="btn btn-tbl-edit btn-xs" style="background-color:#da627d;" title="Original Budget Report" target="_blank"><i class="fa fa-file-invoice"></i></a>
                                                                    <?php

                                                                    // Closing and Final buttons – only if $showExtra is true
                                                                    if ($showExtra) {
                                                                        ?>
                                                                        <a href="<?= base_url('budget-report/'.base64_encode($enq_id)) ?>" class="btn btn-tbl-edit btn-xs" style="background-color:#a3b18a;" title="Closing Budget Report" target="_blank"><i class="fa fa-check-circle"></i></a>
                                                                        <?php 
                                                                        if (!empty($acknow_quot) && $acknow_quot->final_budget == 'yes') {
                                                                            ?>
                                                                            <a href="<?= base_url('budget-report-view/'.base64_encode($enq_id)) ?>" class="btn btn-tbl-edit btn-xs" style="background-color:#2a9d8f;" title="Final Budget Report" target="_blank"><i class="fa fa-lock"></i></a>
                                                                            <?php 
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        ?>
                                                        <a href="<?=base_url('edit_arrival?id='.base64_encode($list->id)) ?>"
                                                            class="btn btn-tbl-edit btn-xs" title="Edit"><i
                                                                class="fa fa-edit"></i></a>
                                                        <?php //if($this->session->userdata('type') == 1){?>
                                                        <!--a href="<?php //echo base_url().base64_encode($list->id)?>/delete-arrival" onclick="return confirm('Are you sure you want to delete this Arrival?');" class="btn btn-tbl-delete btn-xs" title="Delete"><i class="fa fa-trash-o"></i></a-->
                                                        <?php //} ?>
                                                    </td>
                                                    
                                                   <?php
                                                   if($list->status == 'cancel'){ ?>
                                                       <td title="More Details" class="red"></td>
                                                        <style>
                                                            table.dataTable.dtr-column>tbody>tr>td.red.control:before, table.dataTable.dtr-column>tbody>tr>th.control:before{
                                                                background-color:red !important;
                                                            }
                                                        </style>
                                                <?php   }
                                                     else if(count($flight_details) == 2 && ($flight_details[0]->person_cnt == $flight_details[1]->person_cnt))
                                                    { ?>
                                                    <td title="More Details" class="pink"></td>
                                                        <style>
                                                            table.dataTable.dtr-column>tbody>tr>td.pink.control:before, table.dataTable.dtr-column>tbody>tr>th.control:before{
                                                                background-color:#ff008d !important;
                                                            }
                                                        </style>
                                                    <?php }
                                                    else{ ?>
                                                        <td title="More Details" class="" style=""></td>
                                                    <?php } ?>
                                                </tr>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var url = new URL(window.location.href);
    $(document).ready(function() {

        $('#arrival_lists').DataTable({
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

        $(".company").autocomplete({
            source: function(request, response) {
                // Fetch data
                $.ajax({
                    url: "<?= base_url() ?>admin/company/company_name_suggesstion",
                    type: 'POST',
                    dataType: "json",
                    data: {
                        search: request.term
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
                $('.company').val(ui.item.label); // display the selected text
                $('.company_id').val(ui.item.company_id); // save selected id to input
            }
        }).blur(function(event) {
            if($('.company').val()==''){
                $('.company_id').val('');
            }               
        });
    });
</script>
<script>
    $(document).ready(function() {
        if (url.searchParams.has('followup_status')) {
            $("#followup_status").val(url.searchParams.get('followup_status'));               
        }
        $('[data-toggle="tooltip"]').tooltip();

        $(".dt-search").on("change", function () {
            const idx = $(this).index(".dt-search");
            const selectedDate = new Date($(this).val());
            const formattedDate = selectedDate.toLocaleDateString('en-IN', {
                year: 'numeric',
                month: 'short',
                day: '2-digit'
            });

            $(".dt-search-show").eq(idx).val(formattedDate).parent().addClass('is-focused');

            const fromDate = new Date($(".date_from").val());
            const toDate = new Date($(".date_to").val());

            if (this.id === "date_from") {
                if ($(".date_to").val() === "") {
                    $(".date_to").attr("min", $(this).val());
                } else if (fromDate > toDate) {
                    $(".date_to").val('').attr("min", $(this).val());
                    $(".dt-search-show").eq($(".date_to").index(".dt-search")).val('');
                }
            }

            if (this.id === "date_to") {
                if ($(".date_from").val() === "") {
                    $(".date_from").attr("max", $(this).val());
                } else if (toDate < fromDate) {
                    $(".date_from").val('').attr("max", $(this).val());
                    $(".dt-search-show").eq($(".date_from").index(".dt-search")).val('');
                }
            }
        });

        $(".btn-more").on("click", function() {
            var idx = $(this).index(".btn-more");
            $(".guide-hide").eq(idx).css("display", "none");
            $(".guide-show").eq(idx).css("display", "block");
        });
        $(".btn-less").on("click", function() {
            var idx = $(this).index(".btn-less");
            $(".guide-hide").eq(idx).css("display", "block");
            $(".guide-show").eq(idx).css("display", "none");
        });
    });

    $(document).ready(function(){
        // Attach event to dynamically generated buttons
        $(document).on("click", ".btn-remarks-show", function() {
            var parent = $(this).closest('.remarks-container');
            parent.find('.remarks-show').slideDown();
            $(this).hide(); // hide the button after showing remarks (optional)
        });
    });
</script>

<?php if ($this->session->userdata('type') == '1' || $this->session->userdata('type') == '3'){ ?>
<script>
    $(document).ready(function () {
        // Utility: Get URL parameter
        const params = new URLSearchParams(window.location.search);
        const bookingTypeFromURL = params.get('booking_type') || "";
        const staffIdFromURL = params.get('staff_id');
    
        // Function to update Booking Types dropdown based on selected Location
        function updateBookingTypesFromLocation(selectedLocation, selectedBookingType = "") {
            var selectedOption = $(".location option[value='" + selectedLocation + "']");
            var v = selectedOption.attr('data-abbr');
    
            $(".booking_type").empty().parent().removeClass("is-dirty");
    
            if (v !== "" && v !== undefined) {
                var opts = v.split(",");
                $(".booking_type").parent().addClass("is-dirty");
    
                // Append "All" option
                // var selectedAll = (selectedBookingType === "all") ? 'selected="selected"' : '';
                $('.booking_type').append('<option value="all" selected="selected">All</option>');
    
                // Append other booking type options
                $.each(opts, function (i, d) {
                    var selected = (selectedBookingType === d) ? 'selected="selected"' : '';
                    $('.booking_type').append('<option value="' + d + '" ' + selected + '>' + d + '</option>');
                });
    
                // Trigger user fetch if booking type present
                getUsersByBookingType(selectedBookingType, staffIdFromURL);
            }
        }
    
        // Function to fetch and display users by booking type
        function getUsersByBookingType(bookingType, selectedStaffId = null) {
            const selectedLocation = $(".location").val(); // ⬅️ Get selected location
    
            if (!bookingType) {
                $('.staff_id').html('<option value="">Select</option>');
                return;
            }
    
            $('.staff_id').html('<option value="">Loading...</option>');
    
            $.ajax({
                url: '<?= base_url("admin/enquiry/get_users_by_booking_types") ?>',
                type: 'GET',
                data: { 
                    booking_type: bookingType, 
                    location: selectedLocation
                },
                dataType: 'json',
                success: function (response) {
                    if (response.status === 'success') {
                        var users = response.data;
                        var options = '<option value="all">All</option>';
    
                        $.each(users, function (i, user) {
                            var label = user.name + (user.hod === 'yes' ? ' (HOD)' : '');
                            var style = user.status == 2 ? 'style="color:red;"' : '';
                            var title = user.status == 2 ? 'title="User In-active no longer work with us"' : '';
                            var selected = (selectedStaffId && user.id == selectedStaffId) ? 'selected="selected"' : '';
                            options += '<option value="' + user.id + '" ' + style + ' ' + title + ' ' + selected + '>' + label + '</option>';
                        });
    
                        $('.staff_id').html(options);
                    } else {
                        $('.staff_id').html('<option value="">No users found</option>');
                    }
                },
                error: function () {
                    $('.staff_id').html('<option value="">AJAX error occurred</option>');
                }
            });
        }
    
        // Initial population on page load
        var selectedLocation = $(".location").val();
        updateBookingTypesFromLocation(selectedLocation, bookingTypeFromURL);
    
        // When location is changed, update booking type dropdown
        $(".location").on("change", function () {
            var newLocation = $(this).val();
            updateBookingTypesFromLocation(newLocation, "");
            var newBookingType = $('.booking_type').val();
            getUsersByBookingType(newBookingType);
        });
    
        // When booking type is changed, update users list
        $('.booking_type').on('change', function () {
            var newBookingType = $(this).val();
            getUsersByBookingType(newBookingType);
        });
    });
</script>
<?php  } ?>
<?php if ($this->session->userdata('type') == '2' && !in_array($this->session->userdata('email'), ['bo.geo@kazindmc.com', 'fkz.support@kazindmc.com'])){ ?>
<script>
    $(document).ready(function () {
        function fetchBookingTypeAndUsers(location, callback = null) {
            if (!location) return;
            $.ajax({
                url: '<?= base_url("admin/enquiry/get_booking_data_for_hod_user") ?>',
                type: 'GET',
                data: { location: location },
                dataType: 'json',
                success: function (res) {
                    if (res.status === 'success') {
                        // Set booking type options
                        var typeOptions = '<option value="">Select</option>';
                        $.each(res.booking_type_options, function (i, val) {
                            var selected = (val === res.selected_booking_type) ? 'selected' : '';
                            typeOptions += '<option value="' + val + '" ' + selected + '>' + val + '</option>';
                        });
                        $('.booking_type').html(typeOptions);
    
                        // Set users
                        populateUsers(res.users, res.logged_in_user_id);
                        //  trigger callback after DOM update
                        if (typeof callback === 'function') {
                            setTimeout(callback, 10); // slight delay ensures DOM is ready
                        }
                    } else {
                        $('.booking_type').html('<option value="all" selected="selected">All</option>');
                        $('.staff_id').html('<option value="">No Users</option>');
                    }
                }
            });
        }
    
        function fetchUsersByBookingType(bookingType, location) {
            if (!bookingType) return;
    
            $.ajax({
                url: '<?= base_url("admin/enquiry/get_users_by_booking_type_filtered") ?>',
                type: 'GET',
                data: { booking_type: bookingType, location: location },
                dataType: 'json',
                success: function (res) {
                    if (res.status === 'success') {
                        populateUsers(res.users, res.logged_in_user_id);
                    } else {
                        $('.staff_id').html('<option value="">No users found</option>');
                    }
                }
            });
        }
    
        function populateUsers(users, loggedInUserId) {
            var userOptions = '<option value="">Select User</option>';
            if (users.length > 0) {
                $.each(users, function (i, user) {
                    var selected = (user.id == loggedInUserId) ? 'selected' : '';
                    var label = user.name;
    
                    if (user.hod === 'yes') {
                        label += '';
                    }
                    if (user.id == loggedInUserId) {
                        label += '';
                    }
    
                    userOptions += '<option value="' + user.id + '" ' + selected + '>' + label + '</option>';
                });
            } else {
                userOptions = '<option value="">No Users</option>';
            }
            $('.staff_id').html(userOptions);
        }
    
        // On location change
        $('.location').on('change', function () {
            const location = $(this).val();
            if (!location) return;
        
            // Fetch booking types and users first, then load chart using selected booking type
            fetchBookingTypeAndUsers(location, function () {
                const updatedBookingType = $('.booking_type').val(); // get after dropdown updates
                loadSalesTeamChart(); // if needed you can pass updatedBookingType
            });
        });
    
    
    
        // On booking type change
        $('.booking_type').on('change', function () {
            var selectedBookingType = $(this).val();
            var location = $('.location').val();
            fetchUsersByBookingType(selectedBookingType, location);
        });
    
        // Initial load
        var initialLocation = $('.location').val();
        if (initialLocation) {
            fetchBookingTypeAndUsers(initialLocation);
            setTimeout(function () {
                loadSalesTeamChart();
        }, 300);
        }
    });
</script>
<?php } ?>
<?php if (in_array($this->session->userdata('email'), ['bo.geo@kazindmc.com', 'fkz.support@kazindmc.com'])){ ?>
<script>
    $(document).ready(function () {
        function fetchBookingTypeAndUsers(location, callback = null) {
            if (!location) return;
            $.ajax({
                url: '<?= base_url("admin/enquiry/get_booking_data_by_location") ?>',
                type: 'GET',
                data: { location: location },
                dataType: 'json',
                success: function (res) {
                    if (res.status === 'success') {
                        // Set booking type options
                        var typeOptions = '<option value="">Select</option>';
                        $.each(res.booking_type_options, function (i, val) {
                            var selected = (val === res.selected_booking_type) ? 'selected' : '';
                            typeOptions += '<option value="' + val + '" ' + selected + '>' + val + '</option>';
                        });
                        $('.booking_type').html(typeOptions);

                        // Set users
                        populateUsers(res.users, res.logged_in_user_id);
                        
                        // Trigger callback after DOM update
                        if (typeof callback === 'function') {
                            setTimeout(callback, 10);
                        }
                    } else {
                        $('.booking_type').html('<option value="">Select</option>');
                        $('.staff_id').html('<option value="">No Users</option>');
                    }
                }
            });
        }

        function fetchUsersByBookingType(bookingType, location) {
            if (!bookingType) return;

            $.ajax({
                url: '<?= base_url("admin/enquiry/get_users_by_booking_type_filtered") ?>',
                type: 'GET',
                data: { booking_type: bookingType, location: location },
                dataType: 'json',
                success: function (res) {
                    if (res.status === 'success') {
                        populateUsers(res.users, res.logged_in_user_id);
                    } else {
                        $('.staff_id').html('<option value="">No users found</option>');
                    }
                }
            });
        }

        function populateUsers(users, loggedInUserId) {
            var userOptions = '<option value="">Select User</option>';
            if (users.length > 0) {
                $.each(users, function (i, user) {
                    var selected = (user.id == loggedInUserId) ? 'selected' : '';
                    var label = user.name;

                    if (user.hod === 'yes') {
                        label += ' (HOD)';
                    }
                    if (user.id == loggedInUserId) {
                        label += ' (You)';
                    }

                    userOptions += '<option value="' + user.id + '" ' + selected + '>' + label + '</option>';
                });
            } else {
                userOptions = '<option value="">No Users</option>';
            }
            $('.staff_id').html(userOptions);
        }

        // On location change
        $('.location').on('change', function () {
            const location = $(this).val();
            if (!location) return;
        
            // Fetch booking types and users first, then load chart using selected booking type
            fetchBookingTypeAndUsers(location, function () {
                const updatedBookingType = $('.booking_type').val();
                loadSalesTeamChart(); // Pass updatedBookingType if needed
            });
        });

        // On booking type change
        $('.booking_type').on('change', function () {
            var selectedBookingType = $(this).val();
            var location = $('.location').val();
            fetchUsersByBookingType(selectedBookingType, location);
        });

        // Initial load
        var initialLocation = $('.location').val();
        if (initialLocation) {
            fetchBookingTypeAndUsers(initialLocation);
            setTimeout(function () {
                loadSalesTeamChart();
            }, 300);
        }
    });
</script>
<?php } ?>