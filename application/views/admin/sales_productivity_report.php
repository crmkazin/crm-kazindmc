<style>
    .loader-overlay {
        display: none;
        position: fixed;
        z-index: 9999;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.4);
    }

    .spinner {
        position: absolute;
        top: 50%;
        left: 50%;
        width: 50px;
        height: 50px;
        border: 5px solid #ffffff;
        border-top: 5px solid transparent;
        border-radius: 50%;
        transform: translate(-50%, -50%);
        animation: spin 0.8s linear infinite;
    }

    @keyframes spin {
        0% { transform: translate(-50%, -50%) rotate(0deg); }
        100% { transform: translate(-50%, -50%) rotate(360deg); }
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
                        <h4 class="text-themecolor">Sales Productivity Report</h4>
                    </div>
                    <div class="col-lg-2 only-for-dashbord">
                    </div>
                    <div class="col-lg-7 col-sm-6 col-6 align-self-center text-end">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb justify-content-end">
                                <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Home</a></li>
                                <li class="breadcrumb-item active">Sales Productivity Report</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="page-content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-box">
                            <form method="get" autocomplete="off" style="margin-top: 0px !important;" class="content">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="location">Location</label>
                                        <div class="mySelect mt-2">
                                            <select name="location" id="location" class="location select">
                                                <option value="" selected disabled hidden></option>
                                                <?php
                                                    $user_id = $this->session->userdata('id');
                                                    // Run query directly
                                                    $this->db->select('*');
                                                    $this->db->from('admin');
                                                    $this->db->where('id', $user_id);
                                                    $query = $this->db->get();

                                                    // Fetch single row as array
                                                    $user = $query->row_array();

                                                    $locations = $locations;

                                                    $main_keys = ['kazakhstan', 'azerbaijan', 'belarus', 'georgia','armenia','uzbekistan'];
                                                    // $location = $this->session->userdata('locations');

                                                    if ($this->session->userdata('type') == 2) {
                                                        $user_locations = explode(',', $user['location']);
                                                        asort($locations);

                                                        $has_all_access = in_array('all', $user_locations) ||
                                                                        empty(array_diff($main_keys, $user_locations)); // user has all 5 countries

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

                                    <div class="col-md-3">
                                        <label for="">Country</label>
                                        <div class="input-container">
                                            <?php echo form_input(['name' => 'country', 'id' => 'country', 'placeholder' => 'Country', 'class' => 'country input mdl-textfield__input','value'=>urldecode($this->input->get('country'))]) ?>
                                        </div>
                                    </div>
                                    <input type="hidden" class="country_id" name="country_id" id="country_id" value="">

                                    <div class="col-md-3">
                                        <label for="">State</label>
                                            <div class="input-container">                            
                                                <?php echo form_input(['name' => 'state', 'id' => 'state', 'placeholder' => 'State', 'class' => 'state input mdl-textfield__input','value'=>$this->input->get('state')]) ?>
                                            </div>
                                    </div>
                                    <input type="hidden" name="state_id" class="state_id" id="state_id" value="">

                                    <div class="col-md-3">
                                        <label for="">city</label>
                                            <div class="input-container">                            
                                                <?php echo form_input(['name' => 'city', 'id' => 'city', 'placeholder' => 'City', 'class' => 'city input mdl-textfield__input','value'=>$this->input->get('city')]) ?>
                                            </div>
                                    </div>

                                    <div class="col-md-3">
                                        <label for="from">From</label>
                                        <div class="input-container">
                                            <input type="text" class="input inputdate mdl-textfield__input dt-search-show" readonly style="width:100%;"
                                                value="<?= ($this->input->get('date_from') != '') ? date('d-M-Y', strtotime($this->input->get('date_from'))) : ''; ?>">

                                            <?= form_input([
                                                'type'  => 'date',
                                                'name'  => 'date_from',
                                                'id'    => 'from',
                                                'class' => 'dts mdl-textfield__input dt-search from',
                                                'value' => ($this->input->get('date_from') != '') ? $this->input->get('date_from') : '',
                                                'style' => 'width:17px;float:right; position: absolute; right: 8%; border: none; background-color: transparent; top: 50%; transform: translateY(-50%);'
                                            ]) ?>
                                        </div>
                                    </div>

                                    <div class="col-md-3">  
                                        <label for="to">To</label>
                                        <div class="input-container">
                                            <input type="text" class="input inputdate mdl-textfield__input dt-search-show" readonly style="width:100%;"
                                                value="<?= ($this->input->get('date_to') != '') ? date('d-M-Y', strtotime($this->input->get('date_to'))) : ''; ?>">

                                            <?= form_input([
                                                'type'  => 'date',
                                                'name'  => 'date_to',
                                                'id'    => 'to',
                                                'class' => 'dts mdl-textfield__input dt-search to',
                                                'value' => ($this->input->get('date_to') != '') ? $this->input->get('date_to') : '',
                                                'style' => 'width:17px;float:right; position: absolute; right: 8%; border: none; background-color: transparent; top: 50%; transform: translateY(-50%);'
                                            ]) ?>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <label for="location">Quarter</label>
                                        <div class="mySelect mt-2">
                                            <select name="quarter" id="quarter" class="select mdl-textfield__input">
                                                <option value="">Select Quarter..</option>
                                                <?php
                                                $current_year = date('Y');
                                                $quarters = ['quarter_1'=>$current_year.'-01-01_'.$current_year.'-03-31',
                                                            'quarter_2'=>$current_year.'-04-01_'.$current_year.'-06-30',
                                                            'quarter_3'=>$current_year.'-07-01_'.$current_year.'-09-30',
                                                            'quarter_4'=>$current_year.'-10-01_'.$current_year.'-12-31'];
                                                            
                                                foreach ($quarters as $key => $val) {
                                                    ?>
                                                    <option value="<?= $val ?>" <?=($this->input->get('quarter')<>'' && $this->input->get('quarter')==$val)?'selected="selected"':''; ?>>
                                                        <?= ucfirst(str_replace('_',' ',$key)).' ('.$current_year.')' ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <label for="">Kazin Sales Team</label>
                                        <div class="input-container">
                                            <div class="mySelect">
                                            <select name="sales" id="sales" class="select sales">
                                                <option value="">All</option>
                                                <?php foreach ($sales_team as $list) { ?>
                                                    <option style="color:<?=($list->status == 1) ? '' : '#f81515'?>" value="<?php echo $list->id; ?>" <?php echo ($this->input->get('sales') <> '' && $this->input->get('sales') == $list->id) ? 'selected="selected"' : ''; ?>>
                                                        <?php echo $list->name; ?>
                                                    </option>
                                                <?php } ?>
                                                </select> 
                                                <span>Kazin Sales Team</span> 
                                            </div>   
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <label for="">Time Period Filter</label>
                                        <div class="input-container">
                                            <div class="mySelect">
                                            <select name="time_period" id="time_period" class="form-control">
                                                <option value="">Select Time Period</option>
                                                <option value="after_joining" <?php echo (($this->input->get('time_period')) && $this->input->get('time_period') == 'after_joining') ? 'selected' : ''; ?>>After Joining Date</option>
                                                <option value="before_joining" <?php echo (($this->input->get('time_period')) && $this->input->get('time_period') == 'before_joining') ? 'selected' : ''; ?>>Before Joining Date</option>
                                                <option value="all" <?php echo (($this->input->get('time_period')) && $this->input->get('time_period') == 'all') ? 'selected' : ''; ?>>All Time</option>
                                            </select>
                                            </div>   
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <label for="enquiry_type">Enquiry Type</label>
                                        <div class="input-container">
                                            <div class="mySelect">
                                                <select name="enquiry_type" id="enquiry_type" class="form-control">
                                                    <option value="">All</option>
                                                    <option value="fit" <?php echo ($this->input->get('enquiry_type') == 'fit') ? 'selected' : ''; ?>>FIT (F/I)</option>
                                                    <option value="git" <?php echo ($this->input->get('enquiry_type') == 'git') ? 'selected' : ''; ?>>GIT (G)</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <label for="acquiring_source">Acquiring Source</label>
                                        <div class="input-container">
                                            <div class="mySelect">
                                                <?php $selected_source = $this->input->get('acquiring_source'); ?>
                                                <select name="acquiring_source" id="acquiring_source" class="acquiring_source form-control">
                                                    <option value=""></option>
                                                    <?php
                                                    $acquiring_source = ['exhibition','sales visit(one-to-one meeting)','referral','road show','website','social media marketing','email'];
                                                    
                                                    foreach($acquiring_source AS $list){  
                                                        $selected = ($selected_source == $list) ? 'selected' : '';
                                                    ?>
                                                        <option value="<?=$list ?>" <?= $selected ?>><?= ucfirst($list); ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <?php $selectedExhibition = $this->input->get('exhibition'); ?>
                                    <div class="col-md-3 Exhibition"  style="display:none;">
                                        <label for="acquiring_source">Exhibition</label>
                                        <div class="input-container">
                                            <div class="mySelect">
                                                <?php $selected_source = $this->input->get('acquiring_source'); ?>
                                                <select name="exhibition" id="exhibition" class="exhibition form-control">
                                                    <option value="">Select Exhibition</option>
                                                    <option value="SAATE" <?= ($selectedExhibition == 'SAATE') ? 'selected="selected"' : '' ?>>SAATE</option>
                                                    <option value="OTM" <?= ($selectedExhibition == 'OTM') ? 'selected="selected"' : '' ?>>OTM</option>
                                                    <option value="TTJ" <?= ($selectedExhibition == 'TTJ') ? 'selected="selected"' : '' ?>>TTJ</option>
                                                    <option value="Melange" <?= ($selectedExhibition == 'Melange') ? 'selected="selected"' : '' ?>>Melange</option>
                                                    <option value="IMEX" <?= ($selectedExhibition == 'IMEX') ? 'selected="selected"' : '' ?>>IMEX</option>
                                                    <option value="QTM" <?= ($selectedExhibition == 'QTM') ? 'selected="selected"' : '' ?>>QTM</option>
                                                    <option value="TMS APAC" <?= ($selectedExhibition == 'TMS APAC') ? 'selected="selected"' : '' ?>>TMS APAC</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 p-t-20 text-start">
                                        <div class="input-container">
                                            <?php echo form_submit(['name'=>'submit','id'=>'submit', 'class'=>'btn btn-md btn-info me-2', 'value'=>'Search']);?>
                                            <!-- <span class="btn btn-info m-1" id="toggleBtn" style="height: 35px; width:150px; color:#fff; padding:5px; margin-left:20px; float:left;">Advance Search</span> -->
                                            <a href="<?= current_url().'?'.http_build_query($_GET + ['excel_download' => 1]) ?>" class="btn btn-success"><i class="fas fa-download"></i></a>
                                        </div>
                                    </div> 

                                </div>                               
                            </form>
                            
                            <?php if (!empty($totals)) { ?>
                                <div class="row mt-2">
                                    <div class="col-md-1"></div>

                                    <div class="col-md-2">
                                        <div class="rounded-3" style="background-color:#bac9f3;padding: 2px 10px;">
                                            <div class="text-center m-2">
                                                <h5 class="m-2 text-dark" style="font-weight: 700;">Total Query</h5>
                                                <h4 style="font-weight: 500;"><?php echo $totals['queries']; ?></h4>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="rounded-3" style="background-color:#bac9f3;padding: 2px 10px;">
                                            <div class="text-center m-2">
                                                <h5 class="m-2" style="font-weight: 700;">Total Confirm</h5>
                                                <h4 style="font-weight: 500;"><?php echo $totals['confirmed']; ?></h4>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="rounded-3" style="background-color:#bac9f3;padding: 2px 10px;">
                                            <div class="text-center m-2">
                                                <h5 class="m-2" style="font-weight: 700;">Total Cancel File</h5>
                                                <h4 style="font-weight: 500;"><?php echo $totals['cancel']; ?></h4>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="rounded-3" style="background-color:#bac9f3;padding: 2px 10px;">
                                            <div class="text-center m-2">
                                                <h5 class="m-2" style="font-weight: 700;">Total Revenue</h5>
                                                <h4 style="font-weight: 500;"><?php echo '$' . number_format($totals['revenue']); ?></h4>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="rounded-3" style="background-color:#bac9f3;padding: 2px 10px;">
                                            <div class="text-center m-2">
                                                <h5 class="m-2" style="font-weight: 700;">Total Pax</h5>
                                                <h4 style="font-weight: 500;"><?php echo $totals['pax']; ?></h4>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-1"></div>
                                </div>
                                <?php } ?>
                        
                            
                                <div class="card-body">
                                    <div class="table-scrollable">
                                        <table class="table table-hover table-striped border table-checkable order-column full-width w-100"
                                            id="sales_productivity_report">
                                            <thead>
                                                <tr>
                                                    <th class="center">Sr.No</th>
                                                    <th class="center">Region</th>
                                                    <th class="center">Total Company</th>
                                                    <th class="center">Filtered Company</th>
                                                    <th class="center" style="background-color:#bdbdbd;">No Query Received</th>
                                                    <th class="center" style="background-color:#0f4aff;">Query Not Converted</th>
                                                    <th class="center" style="background-color:orange;">Single Query Received</th>
                                                    <th class="center" style="background-color:#02d530;">Multiple Query Received</th>
                                                    <th class="center">Total no of query received</th>
                                                    <!-- <th class="center">Green Agent</th>
                                                    <th class="center">Orange Agent</th>
                                                    <th class="center">Blue Agent</th>
                                                    <th class="center">Gray Agent</th> -->
                                                    <th class="center">Confirm Query</th>
                                                    <th class="center">Fit Count</th>
                                                    <th class="center">Git Count</th>
                                                    <th class="center">Cancel-at-arrival</th>
                                                    <th class="center">Revenue</th>
                                                    <th class="center">No Of Pax</th>
                                                    <th class="center">Action</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php 
                                                $i = 1; 
                                                foreach ($sales_report as $index => $row): 
                                                    // Check if $company_data exists and has the corresponding index
                                                    $company_row = isset($company_data[$index]) ? $company_data[$index] : null;
                                                    $total_ompany_row = isset($total_company[$index]) ? $total_company[$index] : null;
                                                ?>
                                                <tr>
                                                    <td><?= $i++ ?></td>
                                                    <td><?= ucfirst($row->region) ?></td>
                                                    <td><?= isset($total_ompany_row->total_company) ? (int)$total_ompany_row->total_company : 0 ?></td>
                                                    <!-- COMPANY DATA -->
                                                    <td><?= isset($company_row->total_rows) ? (int)$company_row->total_rows : 0 ?></td>
                                                    <td><?= isset($company_row->no_query) ? (int)$company_row->no_query : 0 ?></td>
                                                    <td><?= isset($company_row->query_received_but_not_converted) ? (int)$company_row->query_received_but_not_converted : 0 ?></td>
                                                    <td><?= isset($company_row->only_one_query_converted) ? (int)$company_row->only_one_query_converted : 0 ?></td>
                                                    <td><?= isset($company_row->queries_converted) ? (int)$company_row->queries_converted : 0 ?></td>

                                                    <!-- SALES REPORT DATA -->
                                                    <td><?= isset($row->total_queries) ? (int)$row->total_queries : 0 ?></td>
                                                    <!-- <td><?= isset($row->green_queries) ? (int)$row->green_queries : 0 ?></td>
                                                    <td><?= isset($row->orange_queries) ? (int)$row->orange_queries : 0 ?></td>
                                                    <td><?= isset($row->blue_queries) ? (int)$row->blue_queries : 0 ?></td>
                                                    <td><?= isset($row->gray_queries) ? (int)$row->gray_queries : 0 ?></td> -->

                                                    <!-- <td class="agents-green agent-count" data-region="<?php echo $row->region; ?>" data-status="green"><?= isset($row->agents_green) ? (int)$row->agents_green : 0 ?></td>
                                                    <td class="agents-orange agent-count" data-region="<?php echo $row->region; ?>" data-status="orange"><?= isset($row->agents_orange) ? (int)$row->agents_orange : 0 ?></td>
                                                    <td class="agents-blue agent-count" data-region="<?php echo $row->region; ?>" data-status="blue"><?= isset($row->agents_blue) ? (int)$row->agents_blue : 0 ?></td>
                                                    <td class="agents-gray agent-count" data-region="<?php echo $row->region; ?>" data-status="gray"><?= isset($row->agents_gray) ? (int)$row->agents_gray : 0 ?></td> -->

                                                    <td><?= isset($row->confirmed_queries) ? (int)$row->confirmed_queries : 0 ?></td>
                                                    <!-- FIT Count Click -->
                                                    <td title="Click here to view details">
                                                        <span class="count-link text-primary" 
                                                            data-type="fit" 
                                                            data-region="<?= $row->region ?>">
                                                            <?= (int)$row->fit_count ?>
                                                        </span>
                                                    </td>
                                                    <!-- GIT Count Click -->
                                                    <td title="Click here to view details">
                                                        <span class="count-link text-success" 
                                                            data-type="git" 
                                                            data-region="<?= $row->region ?>">
                                                            <?= (int)$row->git_count ?>
                                                        </span>
                                                    </td>
                                                    <!-- Cancel-at-Arrival Click -->
                                                    <td title="Click here to view details">
                                                        <span class="count-link text-danger" 
                                                            data-type="cancel-at-arrival" 
                                                            data-region="<?= $row->region ?>">
                                                            <?= (int)$row->cancel_at_arrival ?>
                                                        </span>
                                                    </td>
                                                    <td>$<?= isset($row->total_revenue) ? number_format($row->total_revenue, 2) : '0.00' ?></td>
                                                    <td><?= isset($row->total_pax) ? (int)$row->total_pax : 0 ?></td>
                                                    <td>
                                                        <div class="d-flex">
                                                            <form method="post" 
                                                                action="<?= base_url('admin/report/download_sales_pdf1/' . rawurlencode($row->region)) ?>" 
                                                                target="_blank">

                                                                <input type="hidden" name="location"  value="<?= html_escape($this->input->get('location')) ?>">
                                                                <input type="hidden" name="country"   value="<?= html_escape($this->input->get('country')) ?>">
                                                                <input type="hidden" name="state"     value="<?= html_escape($this->input->get('state')) ?>">
                                                                <input type="hidden" name="city"      value="<?= html_escape($this->input->get('city')) ?>">
                                                                <input type="hidden" name="date_from" value="<?= html_escape($this->input->get('date_from')) ?>">
                                                                <input type="hidden" name="date_to"   value="<?= html_escape($this->input->get('date_to')) ?>">
                                                                <input type="hidden" name="quarter"   value="<?= html_escape($this->input->get('quarter')) ?>">
                                                                <input type="hidden" name="sales"     value="<?= html_escape($this->input->get('sales')) ?>">
                                                                <input type="hidden" name="enquiry_type"   value="<?= html_escape($this->input->get('enquiry_type')) ?>">
                                                                <input type="hidden" name="time_period"     value="<?= html_escape($this->input->get('time_period')) ?>">
                                                                <input type="hidden" name="exhibition"   value="<?= html_escape($this->input->get('exhibition')) ?>">
                                                                <input type="hidden" name="acquiring_source"     value="<?= html_escape($this->input->get('acquiring_source')) ?>">
                                                                <button type="submit" class="btn btn-sm btn-danger me-2">
                                                                    <i class="fas fa-file-pdf"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php endforeach; ?>
                                                
                                                <?php if (empty($sales_report)): ?>
                                                <tr>
                                                    <td colspan="14" class="text-center text-muted py-4">
                                                        No data found for the selected criteria.
                                                    </td>
                                                </tr>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page content -->
        </div>
        <!-- end page container -->
    </div>
</div>
    
<form id="excelDownloadForm" method="POST" action="<?= base_url('admin/report/download_enquiries_excel') ?>">
    <input type="hidden" name="region" id="excel_region">
    <input type="hidden" name="type" id="excel_type">
</form>

<!-- loader -->
<div id="popupLoader" class="loader-overlay">
    <div class="spinner"></div>
</div>
<!-- Enquiry Details Modal -->
<div class="modal fade" id="enquiryModal" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            
            <div class="modal-header">
                <h5 class="modal-title text-center fw-bold w-100"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div id="excel-download-btn">
                    <button type="button" class="btn btn-success btn-sm" id="downloadExcelBtn">
                        <i class="fas fa-file-excel"></i> Download Excel
                    </button>
                </div>
                <div>
                    <table id="sales_enquiry" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>S No.</th>
                                <th>Company Name</th>
                                <th>Enquiry No</th>
                                <th>Enquiry Abbr</th>
                                <th>location</th>
                                <th class="revenue">Revenue</th>
                            </tr>
                        </thead>
                        <tbody id="modal-data"></tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Datatable code start from here -->
<script>
    $(document).ready(function(){
        $("#sales_productivity_report").DataTable({
                responsive: true,
        });

        // Helper functions
        function split(val) {
            return val.split(/,\s*/);
        }
        function extractLast(term) {
            return split(term).pop();
        }

        // ---- Initial setup based on existing values ----
        var countryVal = $('.country').val();
        var stateVal = $('.state').val();
        var cityVal = $('.city').val();
        
        // If country has a value, enable state input
        if (countryVal !== "") {
            $('.state').prop('disabled', false);
        } else {
            $('.state').prop('disabled', true);
            $('.city').prop('disabled', true);
        }
        
        // If state has a value, count how many states
        if (stateVal !== "") {
        var states = split(stateVal);
        var stateCount = states.filter(s => s.trim() !== "").length;
        if (stateCount === 1) {
            $('.city').prop('disabled', false);
        } else {
            $('.city').prop('disabled', true);
            // If city had a value but multiple states, clear it
            if (cityVal !== "") $('.city').val('');
        }
        } else {
            $('.city').prop('disabled', true);
        }

        // On page load, if country input has a value, fetch its ID via AJAX (or use the passed ID)
        var countryName = $('.country').val();
        // var existingCountryId = $('.country_id').val();
        if (countryName) {
            // If country name exists but ID is missing, fetch it via AJAX
            $.ajax({
                url: "<?= base_url() ?>admin/company/get_country_ajax",
                type: 'post',
                dataType: "json",
                data: { search: countryName },
                success: function(data) {
                    if (Array.isArray(data) && data.length) {
                        // Find exact match (case-insensitive)
                        var matched = data.find(function(item) {
                            return item.label.toLowerCase() === countryName.toLowerCase();
                        });
                        if (matched) {
                            $('.country_id').val(matched.country_id);
                        } else {
                            // If no exact match, use the first? but better to clear
                            $('.country_id').val('');
                        }
                    }
                }
            });
        }

        // On page load, if State input has a value, fetch its ID via AJAX (or use the passed ID)
        var stateName = $('.state').val();
        if (stateName) {
            // If country name exists but ID is missing, fetch it via AJAX
            $.ajax({
                url: "<?= base_url() ?>admin/company/get_state_ajax",
                type: 'post',
                dataType: "json",
                data: { search: stateName },
                success: function(data) {
                    if (Array.isArray(data) && data.length) {
                        // Find exact match (case-insensitive)
                        var matched = data.find(function(item) {
                            return item.label.toLowerCase() === stateName.toLowerCase();
                        });
                        if (matched) {
                            $('.state_id').val(matched.state_id);
                        } else {
                            // If no exact match, use the first? but better to clear
                            $('.state_id').val('');
                        }
                    }
                }
            });
        }
        
        // ---- Country autocomplete ----
        var country_flag = false;
        $(".country").autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: "<?= base_url() ?>admin/company/get_country_ajax",
                    type: 'post',
                    dataType: "json",
                    data: { search: request.term },
                    success: function(data) { response(data); }
                });
                country_flag = false;
            },
            select: function(event, ui) {
                $('.country').val(ui.item.label);
                $('.country_id').val(ui.item.country_id);
                country_flag = true;
                $('.state').prop('disabled', false);
                $('.city').prop('disabled', true).val('');
                return false;
            }
        }).blur(function() {
            if (!country_flag) {
                $(".country").val("");
                $(".country_id").val("");
                $('.state').prop('disabled', true).val('');
                $('.city').prop('disabled', true).val('');
            }
        });
        
        // ---- State autocomplete ----
        var state_flag = false;
        $(".state").autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: "<?= base_url() ?>admin/company/get_state_ajax",
                    type: 'post',
                    dataType: "json",
                    data: {
                        search: extractLast(request.term),
                        country_id: $('.country_id').val()
                    },
                    success: function(data) { response(data); }
                });
                state_flag = false;
            },
            select: function(event, ui) {
                var terms = split(this.value);
                terms.pop(); // remove current input
                terms.push(ui.item.label);
                terms.push("");
                this.value = terms.join(", ");
                
                var stateCount = terms.filter(t => t.trim() !== "").length;
                if (stateCount === 1) {
                    $('.city').prop('disabled', false);
                } else {
                    $('.city').prop('disabled', true).val('');
                }
                $('.state_id').val(ui.item.state_id);
                state_flag = true;
                return false;
            }
        }).blur(function() {
            if (!state_flag) {
                $(".state").val("");
                $('.city').prop('disabled', true).val('');
            }
        });
        
        // ---- City autocomplete ----
        var city_flag = false;
        $(".city").autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: "<?= base_url() ?>admin/company/get_city_ajax",
                    type: 'post',
                    dataType: "json",
                    data: {
                        search: extractLast(request.term),
                        state_id: $('.state_id').val()
                    },
                    success: function(data) { response(data); }
                });
                city_flag = false;
            },
            select: function(event, ui) {
                var terms = split(this.value);
                terms.pop();
                terms.push(ui.item.label);
                terms.push("");
                this.value = terms.join(", ");
                city_flag = true;
                return false;
            }
        }).blur(function() {
            if (!city_flag) {
                $(".city").val("");
            }
        });

    });
</script>

<!-- Js for company , country, state, city , autosearch -->
<script>
    $(document).ready(function () {
        $(".company").autocomplete({
            source: function (request, response) {
                // Fetch data
                $.ajax({
                    url: "<?= base_url() ?>admin/company/company_name_suggesstion",
                    type: 'POST',
                    dataType: "json",
                    data: {
                        search: request.term
                    },
                    success: function (data) {
                        response(data);
                        dt = data;
                        $(".err").html('');;
                    }
                });
            },
            select: function (event, ui) {
                // Set selection
                $('.company').val(ui.item.label); // display the selected text
                $('.company_id').val(ui.item.company_id); // save selected id to input
            }
        }).blur(function(event) {
            if($('.company').val()==''){
                $('.company_id').val('');
            }               
        });

        function get_exhibition_source(selectedValue) {
            if(selectedValue === 'exhibition'){
                $('.Exhibition').show();
            } else {                
                $('.Exhibition').hide();
            }
        }

        // On change event
        $('.acquiring_source').on('change', function () {
            var selectedValue = $(this).val();
            get_exhibition_source(selectedValue);
        });

        // On page load
        var initialValue = $('.acquiring_source').val();
        get_exhibition_source(initialValue);
    });
</script>

<!-- Display Fit and Git count details -->
<script>
    let selectedRegion = '';
    let selectedType   = '';

    $(document).on("click", ".count-link", function () {
        selectedRegion = $(this).data("region");
        selectedType   = $(this).data("type");

        if (selectedType === 'cancel-at-arrival') {
           $('.modal-title').text('Cancel At Arrival Files');
        } else if(selectedType === 'fit') {
           $('.modal-title').text('Fit Files');
        } else if(selectedType === 'git') {
            $('.modal-title').text('Git Files');
        }

        // if (selectedType === 'cancel-at-arrival' || selectedType === 'fit' || selectedType === 'git') {
        //    $('.revenue').show('');
        // } else {
        //    $('.revenue').hide();
        // }
        

        $("#popupLoader").show();
        $("#modal-data").hide();
        $("#enquiryModal").modal("show");

        $.ajax({
            url: "<?= base_url('admin/report/get_enquiries_by_type') ?>",
            type: "POST",
            data: {
                region: selectedRegion,
                type: selectedType
            },
            success: function (response) {
                $("#popupLoader").hide();
                $("#modal-data").html(response).show();
            }
        });
    });

    $(document).on("click", "#downloadExcelBtn", function () {
        if (!selectedRegion || !selectedType) {
            alert('Please select enquiry type first');
            return;
        }

        $('#excel_region').val(selectedRegion);
        $('#excel_type').val(selectedType);

        $('#excelDownloadForm').submit();
    });
</script>
