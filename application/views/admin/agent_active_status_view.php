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
                        <h4 class="text-themecolor">Agent Growth Status Report</h4>
                    </div>
                    <div class="col-lg-2 only-for-dashbord">
                    </div>
                    <div class="col-lg-7 col-sm-6 col-6 align-self-center text-end">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb justify-content-end">
                                <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Home</a></li>
                                <li class="breadcrumb-item active">Agent Growth Status Report</li>
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
                                            <a href="<?= current_url().'?'.http_build_query($_GET + ['excel_download' => 1]) ?>" class="btn btn-success"><i class="fas fa-download"></i></a>
                                        </div>
                                    </div>
                                </div>                               
                            </form>
                            <div class="card-body">
                                <div class="table-scrollable">
                                    <table id="sales_productivity_report" class="table table-hover table-striped border table-checkable order-column full-width w-100">
                                        <thead>
                                            <tr>
                                                <th class="center">Sr.No</th>
                                                <th class="center">Region</th>
                                                <th class="center">Total Agents</th>
                                                <th class="center" style="background-color:#bdbdbd;">No Query Agent</th>
                                                <th class="center" style="background-color:#0f4aff;">No query Agent to Not Converted Agent</th>
                                                <th class="center" style="background-color:orange;">No query Agent to Single Confirm Agent</th>
                                                <th class="center" style="background-color:#02d530;">No query Agent to Multiple Confirm Agent</th>
                                                <th class="center" style="background-color:#0f4aff;">Not Converted Agent</th>
                                                <th class="center" style="background-color:orange;">Not Converted Agent to Single Confirm Agent</th>
                                                <th class="center" style="background-color:#02d530;">Not Converted Agent to Multiple Confirm Agent</th>
                                                <th class="center" style="background-color:orange;">Single Confirm Agent</th>
                                                <th class="center" style="background-color:#02d530;">Single Confirm Agent to Multiple Confirm Agent</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php if (!empty($report_data)): ?>
                                            <?php $sr_no = 1; ?>
                                            <?php foreach ($report_data as $row): ?>
                                                <tr>
                                                    <td class="center"><?= $sr_no++ ?></td>
                                                    <td class="center">
                                                        <?php //echo htmlspecialchars(ucfirst($row->region)) ?>
                                                        <?php
                                                            // Get searched state & city from GET
                                                            $search_state = isset($_GET['state']) ? rtrim($_GET['state'], ', ') : '';
                                                            $search_city  = isset($_GET['city']) ? rtrim($_GET['city'], ', ') : '';

                                                            // Count states (comma separated)
                                                            $states = array_filter(array_map('trim', explode(',', $search_state)));

                                                            echo htmlspecialchars(ucfirst($row->region));

                                                            // show city only if:
                                                            // - Only 1 state selected
                                                            // - Current row matches that state
                                                            if (count($states) == 1 && strtolower($row->region) == strtolower($states[0]) && !empty($search_city)) {
                                                                echo "<br><small style='color:#888;'>".htmlspecialchars($search_city)."</small>";
                                                            }
                                                        ?>
                                                    </td>
                                                    <td class="center"><?= (int)$row->total_agents ?></td>
                                                    
                                                    <!-- No Query Agent Columns -->
                                                    <td class="center agent-popup" data-region="<?= $row->region ?>" title="Click here to view No Query Agents" data-type="no_query"><?= (int)$row->total_no_query ?></td>
                                                    <td class="center agent-popup" data-region="<?= $row->region ?>" title="Click here to view No Query to Not Converted Agents" data-type="noq_to_notconv"><?= (int)$row->noq_to_notconv ?></td>
                                                    <td class="center agent-popup" data-region="<?= $row->region ?>" title="Click here to view No Query to Single Confirm Agents" data-type="noq_to_single"><?= (int)$row->noq_to_single ?></td>
                                                    <td class="center agent-popup" data-region="<?= $row->region ?>" title="Click here to view No Query to Multiple Confirm Agents" data-type="noq_to_multi"><?= (int)$row->noq_to_multi ?></td>

                                                    <!-- Not Converted Agent Columns -->
                                                    <td class="center agent-popup" data-region="<?= $row->region ?>" title="Click here to view Not Converted Agents" data-type="not_converted"><?= (int)$row->total_not_converted ?></td>
                                                    <td class="center agent-popup" data-region="<?= $row->region ?>" title="Click here to view Not Converted to Single Confirm Agents" data-type="notconv_to_single"><?= (int)$row->notconv_to_single ?></td>
                                                    <td class="center agent-popup" data-region="<?= $row->region ?>" title="Click here to view Not Converted to Multiple Confirm Agents" data-type="notconv_to_multi"><?= (int)$row->notconv_to_multi ?></td>

                                                    <!-- Single Confirm Agent Columns -->
                                                    <td class="center agent-popup" data-region="<?= $row->region ?>" title="Click here to view Single Confirm Agents" data-type="one_confirm"><?= (int)$row->total_single_confirm ?></td>
                                                    <td class="center agent-popup" data-region="<?= $row->region ?>" title="Click here to view Single Confirm to Multiple Confirm Agents" data-type="single_to_multi"><?= (int)$row->single_to_multi ?></td>

                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="11" class="center">No data found for selected filters</td>
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
    
<!-- loader -->
<div id="popupLoader" class="loader-overlay">
    <div class="spinner"></div>
</div>

<!-- agent modal -->
<div class="modal fade" id="agentModal">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center fw-bold w-100"></h5>
                <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <button id="downloadExcel" class="btn btn-success">
                    <i class="fas fa-download"></i> Export
                </button>
                <table class="table table-bordered" id="agent_activity_status">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Agent Name</th>
                            <th>Company Name</th>
                            <th>Email</th>
                            <th>Agent Number</th>
                            <th>State</th>
                            <th>Country</th>
                            <th>Creation Date</th>
                        </tr>
                    </thead>
                    <tbody id="agentTableBody"></tbody>
                </table>
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
    });
</script>
<!-- Datatable code End from here -->

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

        function formatDate(dateStr) {
            let date = new Date(dateStr);

            let day = date.getDate();
            let month = date.toLocaleString('en-GB', { month: 'short' });
            let year = date.getFullYear();

            return `${day} ${month} ${year}`;
        }

        $(document).on('click', '.agent-popup', function () {
            let region = $(this).data('region');
            let type   = $(this).data('type');

            if (type === 'no_query') {
                $('.modal-title').text('No Query Agent Details');
            } else if(type === 'noq_to_notconv') {
                $('.modal-title').text('No Query Agent to Not Converted Agent Details');
            } else if(type === 'noq_to_single') {
                $('.modal-title').text('No Query Agent to Single Confirm Agent Details');
            } else if(type === 'noq_to_multi') {
                $('.modal-title').text('No Query Agent to Multiple Confirm Agent Details');
            } else if(type === 'not_converted') {
                $('.modal-title').text('Not Converted Agent Details');
            } else if(type === 'notconv_to_single') {
                $('.modal-title').text('Not Converted Agent to Single Confirm Agent Details');
            } else if(type === 'notconv_to_multi') {
                $('.modal-title').text('Not Converted Agent to Multiple Confirm Agent Details');
            } else if(type === 'one_confirm') {
                $('.modal-title').text('Single Confirm Agent Details');
            } else if(type === 'single_to_multi') {
                $('.modal-title').text('Single Confirm Agent to Multiple Confirm Agent Details');
            }
            
            $('.agent-popup').removeClass('active');
            $(this).addClass('active');
            $('#popupLoader').show();
            $.ajax({
                url: "<?= base_url('admin/report/get_agent_popup_data') ?>",
                type: "POST",
                data: {
                    region: region,
                    type: type,

                    // Pass filters
                    company_id: "<?= $this->input->get('company_id') ?>",
                    date_from: "<?= $this->input->get('date_from') ?>",
                    date_to: "<?= $this->input->get('date_to') ?>",
                    quarter: "<?= $this->input->get('quarter') ?>",
                    country: "<?= $this->input->get('country') ?>",
                    state: "<?= $this->input->get('state') ?>",
                    city: "<?= $this->input->get('city') ?>",
                    sales: "<?= $this->input->get('sales') ?>",
                    time_period: "<?= $this->input->get('time_period') ?>",
                    location: "<?= $this->input->get('location') ?>",
                    enquiry_type: "<?= $this->input->get('enquiry_type') ?>",
                    acquiring_source: "<?= $this->input->get('acquiring_source') ?>",
                    exhibition: "<?= $this->input->get('exhibition') ?>",
                },
                success: function (res) {
                    let data = JSON.parse(res);
                    let html = '';
                    let sno = 0;
                    if (data.length > 0) {
                        data.forEach(function (row) {
                            sno++;
                            html += `<tr>
                                        <td>${sno}</td>
                                        <td>${row.agent_name}</td>
                                        <td>${row.company_name}</td>
                                        <td>${row.email}</td>
                                        <td>${row.agent_number}</td>
                                        <td>${row.state}</td>
                                        <td>${row.country}</td>
                                        <td>${formatDate(row.creation_date)}</td>
                                    </tr>`;
                        });
                    } else {
                        html = `<tr><td colspan="2">No data found</td></tr>`;
                    }
                    
                    $('#agentTableBody').html(html);
                    $('#popupLoader').hide();
                    $('#agentModal').modal('show');
                }
            });
        });

        $('#downloadExcel').click(function () {
            let region = $('.agent-popup.active').data('region'); // or store globally
            let type   = $('.agent-popup.active').data('type');

            let form = $('<form>', {
                method: 'POST',
                action: "<?= base_url('admin/report/get_agent_popup_data') ?>"
            });

            let params = {
                region: region,
                type: type,
                excel_downloads: 1,

                company_id: "<?= $this->input->get('company_id') ?>",
                date_from: "<?= $this->input->get('date_from') ?>",
                date_to: "<?= $this->input->get('date_to') ?>",
                quarter: "<?= $this->input->get('quarter') ?>",
                country: "<?= $this->input->get('country') ?>",
                state: "<?= $this->input->get('state') ?>",
                city: "<?= $this->input->get('city') ?>",
                sales: "<?= $this->input->get('sales') ?>",
                time_period: "<?= $this->input->get('time_period') ?>",
                location: "<?= $this->input->get('location') ?>",
                enquiry_type: "<?= $this->input->get('enquiry_type') ?>",
                acquiring_source: "<?= $this->input->get('acquiring_source') ?>",
                exhibition: "<?= $this->input->get('exhibition') ?>",
            };

            $.each(params, function (key, value) {
                form.append($('<input>', {
                    type: 'hidden',
                    name: key,
                    value: value
                }));
            });

            $('body').append(form);
            form.submit();
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

            // Split multiple states
            let states = stateName.split(',').map(s => s.trim()).filter(s => s !== '');

            // Use only first state for ID
            let firstState = states[0];

            console.log(firstState, 'firstState');

            $.ajax({
                url: "<?= base_url() ?>admin/company/get_state_ajax",
                type: 'post',
                dataType: "json",
                data: { 
                    search: firstState,
                    country_id: $('.country_id').val(),
                },
                success: function(data) {

                    if (Array.isArray(data) && data.length) {

                        // Case-insensitive match
                        var matched = data.find(function(item) {
                            return item.label.toLowerCase() === firstState.toLowerCase();
                        });

                        if (matched) {
                            $('.state_id').val(matched.state_id);
                        } else {
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
