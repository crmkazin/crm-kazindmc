   <div class="page-wrapper">
        <!-- start page container -->
        <div class="container-fluid">
            <!-- start page content -->
            <div class="page-content-wrapper">
                <div class="page-bar">
                    <div class="row page-titles">
                        <div class="col-lg-3 col-sm-6  col-6 align-self-center">
                            <h4 class="text-themecolor">Agent Productivity Report</h4>
                        </div>
                        <div class="col-lg-2 only-for-dashbord">
                        </div>
                        <div class="col-lg-7 col-sm-6 col-6 align-self-center text-end">
                            <div class="d-flex justify-content-end align-items-center">
                                <ol class="breadcrumb justify-content-end">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Home</a></li>
                                    <li class="breadcrumb-item active">Agent Productivity Report</li>
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
                                            <label for="">Company</label>
                                                <div class="input-container">                            
                                                    <?php echo form_input(['name'=>'company','id'=>'company','placeholder'=>'Company Name', 'class'=>'company input mdl-textfield__input', 'value'=>urldecode($this->input->get('company')), 'style' => 'background-color:#fff; color:black;'])?>
                                                    <input type="hidden" name="company_id" id="company_id"class="company_id" value="<?=($this->input->get('company_id')<>'' && $this->input->get('company')<>'')?$this->input->get('company_id'):''; ?>">
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

                                        <div class="col-lg-3 p-t-20 text-start">
                                            <?php echo form_submit(['name'=>'submit','id'=>'submit', 'class'=>'btn btn-info me-2', 'value'=>'Search']);?>
                                            <!-- <span class="btn btn-info m-1" id="toggleBtn" style="height: 35px; width:150px; color:#fff; padding:5px; margin-left:20px; float:left;">Advance Search</span> -->
                                            <?php
                                                $userId = $this->session->userdata('id');

                                                // Check if this user is HOD
                                                $isHod = $this->db
                                                    ->select('id')
                                                    ->from('admin')
                                                    ->where('id', $userId)
                                                    ->where('hod', 'yes')
                                                    ->get()
                                                    ->row();

                                                if (!$isHod): ?>
                                                    <a href="<?= current_url().'?'.http_build_query($_GET + ['excel_download' => 1]) ?>" class="btn btn-success" title="Excel Download"><i class="fas fa-download"></i></a>
                                                <?php endif; ?>
                                        
                                        </div> 

                                    </div>                               
                                </form>
                                
                                
                                    <?php if(!empty($totals)) { ?>
                                    <div class="row mt-2">
                                        <div class="col-md-3">
                                            <div class="rounded-3" style="background-color:#bac9f3;padding: 2px 10px;">
                                                <div class="text-center m-2">
                                                    <h5 class="m-2 text-dark" style="font-weight: 700;">Total Query</h5>
                                                    <h4 class="" style="font-weight: 500;"><?php print_r($totals['total_query']); ?></h3>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="rounded-3" style="background-color:#bac9f3;padding: 2px 10px;">
                                                <div class="text-center m-2">
                                                    <h5 class="m-2" style="font-weight: 700;">Total confirm</h5>
                                                    <h4 class="" style="font-weight: 500;"><?php print_r($totals['total_confirm']); ?></h3>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="rounded-3" style="background-color:#bac9f3;padding: 2px 10px;">
                                                <div class="text-center m-2">
                                                    <h5 class="m-2" style="font-weight: 700;">Total Cancel File</h5>
                                                    <h4 class="" style="font-weight: 500;"><?php print_r($totals['total_cancel_at_arrival']); ?></h3>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="rounded-3" style="background-color:#bac9f3;padding: 2px 10px;">
                                                <div class="text-center m-2">
                                                    <h5 class="m-2" style="font-weight: 700;">Total Revenue</h5>
                                                    <h4 class="" style="font-weight: 500;"><?php echo '$' . $totals['total_billing']; ?></h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                    <?php } ?>

                                <div class="card-body">
                                        <div class="table-scrollable">
                                            <table class="table table-hover table-striped border table-checkable order-column full-width w-100"
                                                id="agent_productivity_report">
                                                <!-- Table headerside_bar -->
                                                <thead>
                                                    <tr>
                                                        <th class="center">Sr.No</th>
                                                        <th class="center">Agent</th>
                                                        <th class="center">Query Recieved</th>
                                                        <th class="center">Confirm</th>
                                                        <th class="center">Cancel-at-arrival</th>
                                                        <th class="center">Revenue</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <!-- Table body -->
                                                <tbody>
                                                    <?php $index = 1; ?>
                                                    <?php foreach($agent_report as $report): ?>
                                                        <?php if (empty($report->company_id) || empty($report->company_name)) continue; ?>
                                                        <tr>
                                                            <td><?php echo $index++; ?></td>
                                                            <td><?php echo $report->company_name; ?></td>
                                                            <td><?php echo $report->query_received; ?></td>
                                                            <td><?php echo $report->confirm_count; ?></td>
                                                            <td><?php echo $report->cancel_at_arrival_count; ?></td>
                                                            <td><?php echo '$' . $report->total_billing; ?></td>
                                                            <td>
                                                                <div class="d-flex">
                                                                    <a href="<?= base_url('admin/report/download_agent_pdf/' . $report->company_id) ?>" 
                                                                    class="btn btn-sm btn-danger" target="_blank">
                                                                        <i class="fas fa-file-pdf"></i>
                                                                    </a>
                                                                  
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
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
<!-- Datatable code start from here -->
<script>
    $(document).ready(function(){
        $("#agent_productivity_report").DataTable({
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
        var country_flag = false;
        $(".country").autocomplete({
            source: function (request, response) {
                // Fetch data
                $.ajax({
                    url: "<?= base_url() ?>admin/company/get_country_ajax",
                    type: 'post',
                    dataType: "json",
                    data: {
                        search: request.term
                    },
                    success: function (data) {

                        response(data);
                    }
                });
                country_flag = false;
            },
            select: function (event, ui) {
                // Set selection
                $('.country').val(ui.item.label); // display the selected text
                $('.country_id').val(ui.item.country_id); // save selected id to input
                country_flag = true;
                return false;
            }
        }).blur(function(event) {
            if(country_flag==false){
                $(".country").val("");
            }               
        });

        function split(val) {
            return val.split(/,\s*/);
        }

        function extractLast(term) {
            return split(term).pop();
        }

        var state_flag = false;
        $(".state").autocomplete({
            
            source: function (request, response) {
                // Fetch data
                $.ajax({
                    url: "<?= base_url() ?>admin/company/get_state_ajax",
                    type: 'post',
                    dataType: "json",
                    data: {
                        search: extractLast(request.term),
                        country_id: $('.country_id').val()
                    },
                    success: function (data) {

                        response(data);
                    }
                });
                state_flag = false;
            },
            select: function (event, ui) {
                // Set selection

                var terms = split(this.value);
                // remove the current input
                terms.pop();
                // add the selected item
                terms.push(ui.item.label);
                // add placeholder to get the comma-and-space at the end
                terms.push("");
                this.value = terms.join(", ");
                if (terms.length > 2) {
                    $(".city").val("").attr('disabled', 'disabled');
                } else {
                    $(".city").removeAttr('disabled');
                    $('.state_id').val(ui.item.state_id);
                } state_flag = true;
                return false;

                //$('#state').val(ui.item.label); // display the selected text
                //$('#state_id').val(ui.item.state_id); // save selected id to input
                //return false;
            }
        }).blur(function(event) {
            if(state_flag==false){
                    $(".state").val("");
            }               
        });
        
        var city_flag = false;
        $(".city").autocomplete({
            source: function (request, response) {
                // Fetch data
                $.ajax({
                    url: "<?= base_url() ?>admin/company/get_city_ajax",
                    type: 'post',
                    dataType: "json",
                    data: {
                        search: extractLast(request.term),
                        state_id: $('.state_id').val()
                    },
                    success: function (data) {
                        response(data);
                    }
                });
                city_flag = false;
            },
            select: function (event, ui) {
                // Set selection

                var terms = split(this.value);
                // remove the current input
                terms.pop();
                // add the selected item
                terms.push(ui.item.label);
                // add placeholder to get the comma-and-space at the end
                terms.push("");
                this.value = terms.join(", ");
                city_flag = true;
                return false;

                //$('#city').val(ui.item.label); // display the selected text
                //$('#company_id').val(ui.item.company_id); // save selected id to input
                //return false;
            }
        }).blur(function(event) {
            if(city_flag==false){
                    $(".city").val("");
            }               
        });
    });
</script>
<!-- Js for company , country, state, city , autosearch -->