 <?php if($this->session->userdata('type') == '1') {?>
<style>
    .toggle-btn {
        font-size: 30px;
        cursor: pointer;
        /* float: left; */
    }

    .content-box {
        display: none;
    }
    #toggleIcon span{
        width: 40px;
        /* height: 40px; */
        display: inline-block;
        text-align:center;
            /* padding: 2px 6px; */
    background-color: rebeccapurple;
    border-radius: 9px;
    color: #fff;
    }


</style>
<?php } ?>
<style>
  .legend-item {
    display: inline-block;
    margin-right: 15px;
    cursor: pointer;
    position: relative;
    opacity: 1;
    text-decoration: none;
  }

  .legend-item.hidden {
    opacity: 0.5;
    text-decoration: line-through;
  }

  .legend-box {
    display: inline-block;
    width: 20px;
    height: 10px;
    margin-right: 5px;
    vertical-align: middle;
  }
</style>
<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-lg-2 col-sm-6  col-6 align-self-center">
                <h4 class="text-themecolor">Dashboard</h4>
            </div>
            <div class="col-lg-8 only-for-dashbord">
                <ul>
                    <li><a href="<?php echo base_url('enquiry-followup');?>"> <img style="max-width:70px;" src="assets/images/query-bord.gif"
                                alt=""><span>Query Board</span></a></li>

                    <li><a href="<?php echo base_url('arrivals');?>"> <img style="max-width: 75px;margin-top: -10px;"
                                src="assets/images/transportation .gif" alt=""><span>Arrival Chart</span></a>
                    </li>
                    <?php if($this->session->userdata('admin_type') !== 'user') : ?>
                        <li>
                            <a href="<?php echo base_url('party-bus');?>"> 
                                <img style="  max-width: 56px;margin-right: 2px;" src="assets/images/bus.gif" alt="">
                                <span>Party Bus</span>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
            <div class="col-lg-2 col-sm-6 col-6 align-self-center text-end">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb justify-content-end">
                        <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="row">
            <?php if(($this->session->userdata('type') == '2') || ($this->session->userdata('admin_type') == 'user')) {
            // if($this->session->userdata('admin_type') == 'user') {
            $user_id = $this->session->userdata('id');
            // Run query directly
                $this->db->select('*');
                $this->db->from('admin');
                $this->db->where('id', $user_id);
                $query = $this->db->get();

                // Fetch single row as array
                $user = $query->row_array();
                $admin_counts = $admin_counts;
                // $user_locations = explode(',', $user['location']); 
                // $filtered_data = array_filter($admin_counts, function($row) use ($user_locations) {
                //     return in_array(strtolower($row['country']), $user_locations);
                // });
                // $admin_counts = $filtered_data;
            } else {
                $admin_counts = $admin_counts;
            }
            ?>

            <?php foreach ($admin_counts as $admin_count) : ?>
                <div class="col-lg-3 col-md-12">
                    <div class="card" style="height: 87%;">
                        <div class="card-body">
                            <h5 class="card-title">
                                <img style="max-width: 28px; margin-right: 10px;"
                                    src="assets/admin/flags/<?= strtolower($admin_count['country']) ?>.png" 
                                    alt="<?= $admin_count['country'] ?>">
                                <?= $admin_count['country'] ?? 'N/A' ?>
                            </h5>
                            <div class="stats-row">
                                <div class="stat-item">
                                    <h6>Pending</h6>
                                    <b><?= $admin_count['pending'] ?? 0 ?></b>
                                </div>
                                <div class="stat-item">
                                    <h6>In-Progress</h6>
                                    <b><?= $admin_count['in-progress'] ?? 0 ?></b>
                                </div>
                                <div class="stat-item">
                                    <h6>Confirm</h6>
                                    <b class="donfirm" data-content="<?= $admin_count['confirm'] ?? 0 ?>">
                                        <?= $admin_count['confirm'] ?? 0 ?>
                                       <a href="<?php echo base_url('arrivals?country=' . $admin_count['country'] . '&confirm_cnt=true'); ?>" class="confirm_count_<?= $admin_count['country'] ?>">
                                        <!-- <span  class="badge badge-pill badge-info blinking"
                                            style="padding: 6px 10px; height: 29px; font-size: 19px !important; 
                                                margin-top: -40px; background-color: #663399;">0</span> -->
                                                
                                                </a>
                                    </b>
                                </div>
                                <div class="stat-item">
                                    <h6>Not Materialized</h6>
                                    <b><?= $admin_count['not-materialized'] ?? 0 ?></b>
                                </div>
                                <br>
                                <div class="stat-item">
                                    <b style="font-weight: 400;font-size: 16px;"><i style="margin-right: 6px;" class="fa fa-user" aria-hidden="true"> </i><?= $admin_count['total_pax'] ?? 0 ?></b>
                               <b style="font-weight: 400;font-size: 16px;"><i style="margin-right: 6px;" class="fa fa-dollar-sign"></i><?= number_format($admin_count['total_billing_dollar'] ?? 0, 0) ?></b>
                                </div>
                                <!--<div class="stat-item">-->
                                <!--    <h6 style="font-weight: 400;">Total Revenue</h6>-->
                                <!--    <b style="font-weight: 400;">$<?= number_format($admin_count['total_billing_dollar'] ?? 0, 0) ?></b>-->
                                <!--</div>-->
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="row">
            <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                <div class="card" style="height: 96%;">
                    <div class="card-body">
                        <h5 class="card-title">Query Board</h5>
                        <canvas id="yearlyEnquiryChart" style="max-width:500px; margin: 0 auto; display:block; height:380px;"></canvas>
                        <div id="enquiry-custom-legend" style="margin-top: 10px;" class="text-center"></div>
                        <!-- <img style="width: 100%;" src="assets/images/chart2.png" alt=""> -->
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                <div class="card" style="height: 96%;">
                    <div class="card-body">
                        <h5 class="card-title">Arrival Chart</h5>
                        <canvas id="yearlyArrivalChart" style="max-width:500px; margin: 0 auto; display:block; height:380px;"></canvas>
                        <div id="arrival-custom-legend" style="margin-top: 10px;" class="text-center"></div>
                        <!-- <img style="width: 100%;" src="assets/images/chart2.png" alt=""> -->
                    </div>
                </div>
            </div>
            
            <?php if($this->session->userdata('type') == '1'){ ?>
                <div class="toggle-btn text-end mb-3" id="toggleIcon"><span>＋</span></div>
           <?php } ?>

            <?php if (in_array($this->session->userdata('type'), ['1'])) { ?>
                <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12 content-box toggleContent" id="toggleContent">
                    <div class="card" style="height: 96%;">
                        <div class="card-body">
                            <h5 class="card-title">Revenue Chart</h5>
                            <div class="row">
                                <div class="col-md-3">
                                    <?php
                                    $locationOptions = [
                                        'kazakhstan' => ['FKZ', 'GKZ', 'IKZ'],
                                        'azerbaijan' => ['FAZ', 'GAZ', 'IAZ'],
                                        'belarus'    => ['FBZ', 'GBZ', 'IBZ'],
                                        'georgia'    => ['FGE', 'GGE', 'IGE'],
                                        'armenia'    => ['FAR','GAR','IAR'],
                                        'all'        => ['FKZ', 'GKZ', 'IKZ', 'FAZ', 'GAZ', 'IAZ', 'FBZ', 'GBZ', 'IBZ', 'FGE', 'GGE', 'IGE','FAR','GAR','IAR']
                                    ];
                                    ?>

                                    <label for="country">Location</label>
                                    <select id="country" name="country" class="form-control">
                                        <?php foreach ($locationOptions as $country => $codes): ?>
                                            <option value="<?= $country ?>" <?= ($country == 'all') ? 'selected' : '' ?>>
                                                <?= ucfirst($country) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label for="sales">Sales Team</label>
                                    <?php
                                        // Sort the $all_user array alphabetically by name
                                        usort($sales_team, function($a, $b) {
                                            return strcmp(strtolower($a->name), strtolower($b->name));
                                        });
                                    ?>
                                    <select name="sales" id="sales" class="form-control">
                                        <option value="">All</option>
                                        <?php foreach ($sales_team as $list): ?>
                                            <option value="<?= $list->id ?>" <?= ($this->input->get('sales') == $list->id) ? 'selected' : '' ?>>
                                                <?= $list->name ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label for="quarter">Quarter</label>
                                    <select name="quarter" id="quarter" class="form-control">
                                        <option value="">All</option>
                                    <?php
                                            $current_year = date('Y');
                                            $quarters = [
                                                'quarter_1' => $current_year . '-01-01_' . $current_year . '-03-31',
                                                'quarter_2' => $current_year . '-04-01_' . $current_year . '-06-30',
                                                'quarter_3' => $current_year . '-07-01_' . $current_year . '-09-30',
                                                'quarter_4' => $current_year . '-10-01_' . $current_year . '-12-31'
                                            ];

                                            // Calculate current quarter
                                            $month = date('n'); // Numeric month (1-12)
                                            $current_quarter_key = match(true) {
                                                $month >= 1 && $month <= 3 => 'quarter_1',
                                                $month >= 4 && $month <= 6 => 'quarter_2',
                                                $month >= 7 && $month <= 9 => 'quarter_3',
                                                $month >= 10 && $month <= 12 => 'quarter_4',
                                            };

                                            $q_labels = [
                                                'quarter_1' => 'Q1',
                                                'quarter_2' => 'Q2',
                                                'quarter_3' => 'Q3',
                                                'quarter_4' => 'Q4'
                                            ];

                                            foreach ($quarters as $key => $val) {
                                                $selected = ($this->input->get('quarter') == $val || (!isset($_GET['quarter']) && $key == $current_quarter_key)) ? 'selected' : '';
                                                echo "<option value='$val' $selected>{$q_labels[$key]}</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label class="">Region</label>
                                    <div class="">
                                    <input type="text" id="state" name="state" placeholder="State" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="Company">Company</label>
                                    <div class="">                            
                                        <?php echo form_input(['name' => 'company', 'id' => 'company', 'class' => 'company input mdl-textfield__input', 'value' => urldecode($this->input->get('company'))]); ?>
                                        <input type="hidden" name="company_id" id="company_id" class="company_id"
                                        value="<?= ($this->input->get('company_id') <> '' && $this->input->get('company') <> '') ? $this->input->get('company_id') : ''; ?>">                                
                                    </div>
                                </div>
                            </div>
                            <canvas id="billingChart" style="max-width:330px; margin: 0 auto; display:block; height:280px;"></canvas>
                            <div id="totalRevenue" style="text-align:center; font-weight:600; margin-top:12px; color:#333;"></div>
                        </div>
                    </div>
                </div>
            <?php } ?>

            <?php if(in_array($this->session->userdata('type'), ['1','5','6'])){ ?>
                <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12 content-box toggleContent" id="toggleContent">
                    <div class="card" style="height: 96%;">
                        <div class="card-body">
                            <h5 class="card-title">Sales Team Productivity Reports</h5>
                            <div class="row mb-3">
                                <div class="col-md-2">
                                    <?php
                                    $locationOptions = [
                                        'kazakhstan' => ['FKZ', 'GKZ', 'IKZ'],
                                        'azerbaijan' => ['FAZ', 'GAZ', 'IAZ'],
                                        'belarus'    => ['FBZ', 'GBZ', 'IBZ'],
                                        'georgia'    => ['FGE', 'GGE', 'IGE'],
                                        'armenia'    => ['FAR','GAR','IAR'],
                                        'all'        => ['FKZ', 'GKZ', 'IKZ', 'FAZ', 'GAZ', 'IAZ', 'FBZ', 'GBZ', 'IBZ', 'FGE', 'GGE', 'IGE','FAR','GAR','IAR']
                                    ];
                                    ?>

                                    <label for="country">Location</label>
                                    <select id="countrys" name="country" class="form-control">
                                        <?php foreach ($locationOptions as $country => $codes): ?>
                                            <option value="<?= $country ?>" <?= ($country == 'all') ? 'selected' : '' ?>>
                                                <?= ucfirst($country) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>

                                </div>
                                <div class="col-md-2">
                                    <label for="filterYear">Year</label>
                                    <select id="filterYear" class="form-control">
                                        <?php for ($y = date('Y'); $y >= 2024; $y--): ?>
                                            <option value="<?= $y ?>" <?= ($y == date('Y')) ? 'selected' : '' ?>><?= $y ?></option>
                                        <?php endfor; ?>
                                    </select>
                                </div>

                                <div class="col-md-2">
                                    <label for="filterMonth">Month</label>
                                    <select id="filterMonth" class="form-control">
                                        <option value="">All</option>
                                        <?php for ($m = 1; $m <= 12; $m++): ?>
                                            <option value="<?= str_pad($m, 2, '0', STR_PAD_LEFT) ?>" <?= ($m == date('m')) ? 'selected' : '' ?>>
                                                <?= date('F', mktime(0, 0, 0, $m, 10)) ?>
                                            </option>
                                        <?php endfor; ?>
                                    </select>
                                </div>

                                <div class="col-md-2">
                                    <label for="filterQuarter">Quarter</label>
                                    <select id="filterQuarter" class="form-control">
                                        <option value="">All</option>
                                        <option value="1">Q 1</option>
                                        <option value="2">Q 2</option>
                                        <option value="3">Q 3</option>
                                        <option value="4">Q 4</option>
                                    </select>
                                </div>
                                
                                <div class="col-md-2">
                                    <label class="">Region</label>
                                    <div class="">
                                        <?php echo form_input(['name' => 'states', 'id' => 'state_sales', 'placeholder' => 'State', 'class' => 'state_sales input mdl-textfield__input p-2','value'=>$this->input->get('state')]) ?>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <label for="sales">Sales Team</label>
                                        <?php
                                            // Sort the $all_user array alphabetically by name
                                            usort($sales_team, function($a, $b) {
                                                return strcmp(strtolower($a->name), strtolower($b->name));
                                            });
                                        ?>

                                    <select name="sales" id="sales_data" class="form-control">
                                        <option value="">All</option>
                                        <?php //foreach ($sales_team as $list): ?>
                                            <!--<option value="<?php //echo $list->id ?>" <?php //echo ($this->input->get('sales') == $list->id) ? 'selected' : '' ?>>-->
                                            <!--    <?php //echo $list->name ?>-->
                                            <!--</option>-->
                                        <?php //endforeach; ?>
                                    </select>
                                </div>
                                
                                
                            </div>
                            <canvas id="statusPieChart" style="max-width:330px; margin: 0 auto; display:block; height:280px;"></canvas>
                            <div id="status_chart_legend" style="text-align:center; margin-top:10px; font-weight:600;"></div>
                        </div>
                    </div>
                </div>
            <?php } ?>
            
            <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12" style="display:none">
                <div class="card" style="height: 96%;">
                    <div class="card-body">
                        <h5 class="card-title">Team Productivity Report</h5>
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <?php
                                $locationOptions = [
                                    'kazakhstan' => ['FKZ', 'GKZ', 'IKZ'],
                                    'azerbaijan' => ['FAZ', 'GAZ', 'IAZ'],
                                    'belarus'    => ['FBZ', 'GBZ', 'IBZ'],
                                    'georgia'    => ['FGE', 'GGE', 'IGE'],
                                    'armenia'    => ['FAR','GAR','IAR'],
                                    'all'        => ['FKZ', 'GKZ', 'IKZ', 'FAZ', 'GAZ', 'IAZ', 'FBZ', 'GBZ', 'IBZ', 'FGE', 'GGE', 'IGE','FAR','GAR','IAR']
                                ];
                                ?>

                                <label for="country">Country</label>
                                <!-- <select id="countryss" name="country" class="form-control">
                                    <?php //foreach ($locationOptions as $country => $codes): ?>
                                        <option value="<?php //echo $country ?>" <?php //echo ($country == 'all') ? 'selected' : '' ?>>
                                            <?php //echo ucfirst($country) ?>
                                        </option>
                                    <?php //endforeach; ?>
                                </select> -->

                            </div>

                            <div class="col-md-3">
                                <label for="filterQuarter">Type</label>
                                <!-- <select id="File_type" name="type" class="form-control">
                                    <option value="">All</option>
                                    <option value="fit">FIT</option>
                                    <option value="git">GIt</option>
                                </select> -->
                            </div>

                            <div class="col-md-3">
                                <label for="filterQuarter">Quarter</label>
                                <!-- <select id="Quarterfilter" name="Quarterfilter" class="form-control">
                                    <option value="">All</option>
                                    <option value="1">Q 1</option>
                                    <option value="2">Q 2</option>
                                    <option value="3">Q 3</option>
                                    <option value="4">Q 4</option>
                                </select> -->
                            </div>

                            <div class="col-md-3">
                                <label for="user">Sales Team</label>
                                <!-- <select name="user" id="all_user" class="form-control">
                                    <option value="">All</option>
                                    <?php //foreach ($all_user as $list): ?>
                                        <option value="<?php //echo $list->id ?>" <?php //echo ($this->input->get('user') == $list->id) ? 'selected' : '' ?>>
                                            <?php //echo $list->name ?>
                                        </option>
                                    <?php //endforeach; ?>
                                </select> -->
                            </div>
                        </div>
                        <!-- <canvas id="salesTeamPieChart" style="max-width:330px; margin: 0 auto; display:block; height:280px;"></canvas> -->
                        <!-- <div id="countryBreakdown" style="text-align:center; margin-top: 15px; font-weight: 600;"></div>
                        <div id="conversionRateBox"></div> -->
                    </div>
                </div>
            </div>
            
            <?php if (in_array($this->session->userdata('type'), ['1','2'])) { ?>
                <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                       <div class="card" style="height: 96%;">
                            <div class="card-body">
                                <?php 
                                    $userType = $this->session->userdata('type');
                                    if($userType == '1'){ echo '<h5 class="card-title">Team Productivity Report</h5>';}
                                    else if($userType == '2') { echo '<h5 class="card-title">Productivity Report</h5>';}
                                ?>
                                
                                <div class="row mb-3">
                                    <div class="col-md-2">
                                        <label for="country">Location</label>
                                        <select id="countryss" name="country" class="form-control" >
                                            <?php
                                                $user_id = $this->session->userdata('id');
                                                // Run query directly
                                                $this->db->select('*');
                                                $this->db->from('admin');
                                                $this->db->where('id', $user_id);
                                                $query = $this->db->get();
    
                                                // Fetch single row as array
                                                $user = $query->row_array();
    
                                                $locations = [
                                                    'kazakhstan' => ['FKZ', 'GKZ', 'IKZ'],
                                                    'azerbaijan' => ['FAZ', 'GAZ', 'IAZ'],
                                                    'belarus'    => ['FBZ', 'GBZ', 'IBZ'],
                                                    'georgia'    => ['FGE', 'GGE', 'IGE'],
                                                    'armenia'    => ['FAR','GAR','IAR'],
                                                    'all'        => ['FKZ', 'GKZ', 'IKZ', 'FAZ', 'GAZ', 'IAZ', 'FBZ', 'GBZ', 'IBZ', 'FGE', 'GGE', 'IGE','FAR','GAR','IAR']
                                                ];
    
                                                $main_keys = ['kazakhstan', 'azerbaijan', 'belarus', 'georgia', 'armenia'];
                                                // $location = $this->session->userdata('locations');
    
                                                if ($this->session->userdata('type') == 2) {
                                                    $user_locations = explode(',', $user['location']);
                                                    asort($locations);
    
                                                    $has_all_access = in_array('all', $user_locations) ||
                                                                    empty(array_diff($main_keys, $user_locations)); // user has all 4 countries
    
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
    
                                    <!-- <div class="col-md-2">
                                        <label for="filterQuarter">Type</label>
                                        <select id="File_type" name="type" class="form-control">
                                            <option value="">All</option>
                                            <option value="fit">FIT</option>
                                            <option value="git">GIT</option>
                                        </select>
                                    </div> -->
    
                                     <div class="col-md-3">
                                        <label for="booking_type">Booking Type</label>
                                            <select name="booking_type" id="booking_type" class="booking_type select"
                                                data-selected="<?= $this->input->get('booking_type') ?? 'all'; ?>">
                                                <option value="">select</option>
                                            </select>
                                    </div>
    
                                    <div class="col-md-2">
                                        <label for="filterYears">Year</label>
                                        <select id="filterYearss" class="form-control">
                                            <?php for ($y = date('Y'); $y >= 2024; $y--): ?>
                                                <option value="<?= $y ?>" <?= ($y == date('Y')) ? 'selected' : '' ?>><?= $y ?></option>
                                            <?php endfor; ?>
                                        </select>
                                    </div>
    
                                    <div class="col-md-2">
                                        <label for="filterQuarter">Quarter</label>
                                        <select id="Quarterfilter" name="Quarterfilter" class="form-control">
                                            <option value="">All</option>
                                            <option value="1">Q 1</option>
                                            <option value="2">Q 2</option>
                                            <option value="3">Q 3</option>
                                            <option value="4">Q 4</option>
                                        </select>
                                    </div>
    
                                    <div class="col-md-3">
                                        <label for="user">Ops Team</label>
    
                                        <?php
                                            $userType = $this->session->userdata('type');
                                            $loggedInUserId = $this->session->userdata('id');
        
                                            if ($userType == '1' || $userType == '2') {
                                                // usort($all_user, function($a, $b) {
                                                //     return strcmp(strtolower($a->name), strtolower($b->name));
                                                // });
        
                                                // echo '<select name="user" id="all_user" class="form-control">';
                                                // echo '<option value="">All</option>';
                                                // foreach ($all_user as $list) {
                                                //     $selected = ($this->input->get('user') == $list->id) ? 'selected' : '';
                                                //     echo '<option value="' . $list->id . '" ' . $selected . '>' . $list->name . '</option>';
                                                // }
                                                // echo '</select>';
                                                // echo '
                                                // <select name="user" id="all_user" class="form-control">';
                                                // if ($userType == '1') {
                                                //     echo '<option value="">All</option>';
                                                // }
                                                // echo '
                                                // <!-- JS will populate user options here -->
                                                // </select>';
                                                
                                            echo '<select name="user" id="all_user" class="form-control"><option value="">Select</option></select>';
                                            // echo '<script>';
                                            // echo 'var userType = ' . json_encode($userType) . ';';
                                            // echo 'var selectedUserId = ' . json_encode($loggedInUserId) . ';';
                                            // echo '</script>';
                                                
    
                                            } 
                                            
                                            // elseif ($userType == '2') {
                                            //     // Only show the logged-in user for type 2
                                            //     $currentUser = array_filter($all_user, function($u) use ($loggedInUserId) {
                                            //         return $u->id == $loggedInUserId;
                                            //     });
                                            //     $currentUser = reset($currentUser); // get the first match
        
                                            //     echo '<select name="user" id="all_user" class="form-control">';
                                            //     echo '<option value="' . $currentUser->id . '" selected>' . $currentUser->name . '</option>';
                                            //     echo '</select>';
                                            // }
                                            ?>
                                    </div>
    
                                </div>
                                <canvas id="salesTeamPieChart" style="max-width:330px; margin: 0 auto; display:block; height:280px;"></canvas>
                                <div id="countryBreakdown" style="text-align:center; margin-top: 15px; font-weight:600;"></div>
                            </div>
                    </div>
                </div>
            <?php } ?>
            
            <?php if (in_array($this->session->userdata('type'), ['1','5','6'])) { ?>
      
            <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                <div class="card" style="height: 96%;">
                    <div class="card-body">
                        <h5 class="card-title">Market Comparison Reports</h5>
                        <div class="row">
                            <div class="col-md-2">
                                 <?php
                                $locationOptionsdata = [
                                    'kazakhstan' => ['FKZ', 'GKZ', 'IKZ'],
                                    'azerbaijan' => ['FAZ', 'GAZ', 'IAZ'],
                                    'belarus'    => ['FBZ', 'GBZ', 'IBZ'],
                                    'georgia'    => ['FGE', 'GGE', 'IGE'],
                                    'armenia'    => ['FAR','GAR','IAR'],
                                    'all'        => ['FKZ', 'GKZ', 'IKZ', 'FAZ', 'GAZ', 'IAZ', 'FBZ', 'GBZ', 'IBZ', 'FGE', 'GGE', 'IGE','FAR','GAR','IAR']
                                ];
                                ?>
                                <label for="location">Location</label>
                                <select id="location" name="location" class="form-control">
                                    <?php foreach ($locationOptionsdata as $country => $codes): ?>
                                        <option value="<?= $country ?>" <?= ($country == 'all') ? 'selected' : '' ?>>
                                            <?= ucfirst($country) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="col-md-2">
                                <label for="filterYears">Year</label>
                                <select id="filterYears" class="form-control">
                                    <?php for ($y = date('Y'); $y >= 2024; $y--): ?>
                                        <option value="<?= $y ?>" <?= ($y == date('Y')) ? 'selected' : '' ?>><?= $y ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>

                            <div class="col-md-2">
                                <label for="quarterwise">Quarter</label>
                                <select name="quarter" id="quarterwise" class="form-control">
                                    <option value="">All</option>
                                    <?php
                                    // $current_year = date('Y');
                                    // $quarters = [
                                    //     'quarter_1' => $current_year . '-01-01_' . $current_year . '-03-31',
                                    //     'quarter_2' => $current_year . '-04-01_' . $current_year . '-06-30',
                                    //     'quarter_3' => $current_year . '-07-01_' . $current_year . '-09-30',
                                    //     'quarter_4' => $current_year . '-10-01_' . $current_year . '-12-31'
                                    // ];
                                    // $month = date('n');
                                    // $current_quarter_key = match (true) {
                                    //     $month >= 1 && $month <= 3 => 'quarter_1',
                                    //     $month >= 4 && $month <= 6 => 'quarter_2',
                                    //     $month >= 7 && $month <= 9 => 'quarter_3',
                                    //     $month >= 10 && $month <= 12 => 'quarter_4',
                                    // };
                                    // $q_labels = ['quarter_1' => 'Q1', 'quarter_2' => 'Q2', 'quarter_3' => 'Q3', 'quarter_4' => 'Q4'];
                                    // foreach ($quarters as $key => $val) {
                                    //     $selected = ($this->input->get('quarter') == $val || (!isset($_GET['quarter']) && $key == $current_quarter_key)) ? 'selected' : '';
                                    //     echo "<option value='$val' $selected>{$q_labels[$key]}</option>";
                                    // }
                                    ?>
                                </select>
                            </div>

                            <div class="col-md-2">
                                <label class="mdl-textfield__label">Country</label>
                                <div class="input-container">
                                    <?php echo form_input([
                                        'name' => 'country',
                                        'id' => 'countrywise',
                                        'placeholder' => 'Country',
                                        'class' => 'country input mdl-textfield__input',
                                        'value' => urldecode($this->input->get('country'))
                                    ]) ?>
                                </div>
                            </div>

                            <input type="hidden" class="country_id" name="country_id" id="country_id" value="">
                            <div class="col-md-2">
                                <label class="mdl-textfield__label">State</label>
                                <div class="input-container">
                                    <?php echo form_input(['name' => 'state', 'id' => 'statewise', 'placeholder' => 'State', 'class' => 'state input mdl-textfield__input','value'=>$this->input->get('state')]) ?>
                                </div>
                            </div>

                            <input type="hidden" name="state_id" class="state_id" id="state_id" value="">
                            <div class="col-md-2">
                                <label class="mdl-textfield__label">City</label>
                                <div class="input-container">
                                    <?php echo form_input(['name' => 'city', 'id' => 'city', 'placeholder' => 'City', 'class' => 'city input mdl-textfield__input','value'=>$this->input->get('city')]) ?>
                                </div>
                            </div>
                        </div>
                        <div style="width: 100%; max-width: 1000px; margin: 0 auto;">
                            <canvas id="revenuegroupchart" style="width: 100%; height: 400px;"></canvas>
                        </div>
                        <div id="grouprevenue" style="text-align:center; font-weight:600; margin-top:12px; color:#333;"></div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>

<script>
    let salesTeamChart = null;

    function loadSalesTeamChart() {
        const userId = document.getElementById('all_user').value;
        const country = document.getElementById('countryss').value;
        const type = document.getElementById('booking_type').value;
        const quarter = document.getElementById('Quarterfilter').value;
        const year = document.getElementById('filterYearss').value;

        const currentYear = year;
        let quarterRange = '';
        if (quarter) {
            const qMap = {
                '1': `${currentYear}-01-01_${currentYear}-03-31`,
                '2': `${currentYear}-04-01_${currentYear}-06-30`,
                '3': `${currentYear}-07-01_${currentYear}-09-30`,
                '4': `${currentYear}-10-01_${currentYear}-12-31`
            };
            quarterRange = qMap[quarter];
        }
        

    const url = `<?= base_url('admin/dashboard/get_teamwise_revenue') ?>?user=${userId}&country=${country}&type=${type}&quarter=${quarterRange}&year=${year}`;

        fetch(url)
            .then(res => res.json())
              .then(res => {
                const labels = res.labels || [];
                const values = res.data || [];
                const total = values.reduce((a, b) => a + b, 0);

                // Step 1: Combine data
                const combined = labels.map((label, index) => ({
                    label: label,
                    value: values[index]
                }));

                // Step 2: Sort by value descending
                combined.sort((a, b) => b.value - a.value);

                // Step 3: Extract sorted arrays
                const sortedLabels = combined.map(item => item.label);
                const sortedValues = combined.map(item => item.value);

                const ctx = document.getElementById('salesTeamPieChart').getContext('2d');
                if (salesTeamChart) salesTeamChart.destroy();
                const colorMap = {
                    'Confirm': '#02d530',
                    'Not Materialized': '#bdbdbd',
                    'In Progress': 'orange',
                    'Pending': '#0f4aff',
                    'Cancel at Arrival': '#fc2f00'
                };
                const backgroundColors = sortedLabels.map(label => colorMap[label] || '');

                salesTeamChart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: sortedLabels,
                        datasets: [{
                            data: sortedValues,
                            backgroundColor: backgroundColors
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            tooltip: {
                                callbacks: {
                                    label: function (context) {
                                        const label = context.label;
                                        console.log(label,'labellabel');
                                        const value = context.raw;
                                        const percent = ((value / total) * 100).toFixed(1);
                                        return `${label}: ${value} (${percent}%)`;
                                    }
                                }
                            },
                            legend: {
                                display: false,
                                position: 'bottom'
                            }
                        }
                    }
                });


                const statusCountsBox = document.getElementById('countryBreakdown');
                if (statusCountsBox && res.data) {
                    const counts = res.data;
                    const confirmCount = parseInt(counts[0]) || 0;
                    const totalFiles = total;
                    const conversionPercentage = totalFiles > 0 ? ((confirmCount / totalFiles) * 100).toFixed(2) : '0.00';
                    const totalRevenue = res.total_revenue;
                    const formattedRevenue = Number(totalRevenue).toLocaleString('en-US');
                    // console.log(counts,'counts');

                    const summaryText = `
                        <div style="margin-top: 10px; font-weight: bold; text-align:;">
                            <span style="margin-right:30px;">Total Revenue: $${formattedRevenue}</span>
                            <span>Conversion: ${conversionPercentage}%</span>
                            <br>
                            <span style="margin-right:10px;">Total Files: ${total}</span>
                            <span style="margin-right:10px;"><span style="color:#02d530;">Confirm:</span> ${counts[0] || 0}</span>
                            <span style="margin-right:10px;"><span style="color:orange;">In-Progress:</span> ${counts[1] || 0}</span>
                            <span style="margin-right:10px;"><span style="color:#0f4aff;">Pending:</span> ${counts[2] || 0}</span>
                            <span style="margin-right:10px;"><span style="color:#bdbdbd;">Not Mat.:</span> ${counts[4] || 0}</span>
                            <span style="margin-right:10px;"><span style="color:#fc2f00;">Cancel At Arrival:</span> ${counts[3] || 0}</span>
                        </div>
                    `;

                    statusCountsBox.innerHTML = summaryText;
                    } else {
                    statusCountsBox.innerHTML = `<div style="text-align:center;">No status data available.</div>`;
                    }
            })
            .catch(err => console.error('Error loading chart:', err));
    }

    document.addEventListener('DOMContentLoaded', function () {
        const currentMonth = new Date().getMonth() + 1;
        const currentQuarter = Math.ceil(currentMonth / 3);
        document.getElementById('Quarterfilter').value = currentQuarter.toString();

        loadSalesTeamChart();

        document.getElementById('countryss').addEventListener('change', loadSalesTeamChart);
        document.getElementById('Quarterfilter').addEventListener('change', loadSalesTeamChart);
        document.getElementById('booking_type').addEventListener('change', loadSalesTeamChart);
        document.getElementById('all_user').addEventListener('change', loadSalesTeamChart);
        document.getElementById('filterYearss').addEventListener('change', loadSalesTeamChart);
        const filters = [
            'countryss',
            'Quarterfilter',
            'booking_type',
            'all_user',
            'filterYearss'
        ];

        filters.forEach(id => {
            const element = document.getElementById(id);
            if (element) {
                element.addEventListener('change', function () {
                    if (id === 'countryss') {
                        const selectedLocation = element.value;
                        // filterUsersByLocation(selectedLocation || 'all');
                    } else {
                        loadSalesTeamChart();
                    }
                });
            }
        });

    });
</script>

<script>
    let chartInstances = null;

    function loadStatusPieChart() {
        const year = document.getElementById('filterYear').value;
        const month = document.getElementById('filterMonth').value;
        const quarter = document.getElementById('filterQuarter').value;
        const sales = document.getElementById('sales_data').value;
        const state = document.getElementById('state_sales').value.trim();
        const country = document.getElementById('countrys').value;

        const ctx = document.getElementById('statusPieChart').getContext('2d');

        fetch(`<?= base_url('admin/dashboard/get_status_chart_data') ?>?year=${year}&month=${month}&quarter=${quarter}&sales=${sales}&state=${encodeURIComponent(state)}&country=${country}`)
            .then(response => response.json())
            .then(result => {
                console.log(result, 'result');
                const data = result.data;

                // Define raw data with labels, values, and colors
                const rawData = [
                    { label: 'Confirm', value: parseInt(data['confirm']) || 0, color: '#02d530' },
                    { label: 'In-Progress', value: parseInt(data['in-progress']) || 0, color: 'orange' },
                    { label: 'Pending', value: parseInt(data['pending']) || 0, color: '#0f4aff' },
                    { label: 'Cancel At Arrival', value: parseInt(data['cancel-at-arrival']) || 0, color: '#fc2f00' },
                    { label: 'Not Materialized', value: parseInt(data['not-materialized']) || 0, color: '#bdbdbd' }
                ];

                // Sort by descending value
                const sortedData = rawData.sort((a, b) => b.value - a.value);

                const labels = sortedData.map(item => item.label);
                const values = sortedData.map(item => item.value);
                const colors = sortedData.map(item => item.color);
                const total = values.reduce((a, b) => a + b, 0);

                if (chartInstances) {
                    chartInstances.destroy();
                }

                chartInstances = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: labels,
                        datasets: [{
                            data: values,
                            backgroundColor: colors
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            tooltip: {
                                callbacks: {
                                    label: function (context) {
                                        const label = context.label;
                                        const value = context.raw;
                                        const percentage = ((value / total) * 100).toFixed(1);
                                        return `${label}: ${value} (${percentage}%)`;
                                    },
                                    afterBody: function () {
                                        return `Total Files: ${total}`;
                                    }
                                }
                            },
                            legend: { display: false }
                        }
                    }
                });

                const legendData = [
                    { label: 'Confirm', value: parseInt(data['confirm']) || 0, color: '#02d530' },
                    { label: 'In-Progress', value: parseInt(data['in-progress']) || 0, color: 'orange' },
                    { label: 'Pending', value: parseInt(data['pending']) || 0, color: '#0f4aff' },
                    { label: 'Not Materialized', value: parseInt(data['not-materialized']) || 0, color: '#bdbdbd' },
                    { label: 'Cancel At Arrival', value: parseInt(data['cancel-at-arrival']) || 0, color: '#fc2f00' }
                ];

                // Sort by descending value
                // const sortedData = rawData.sort((a, b) => b.value - a.value);
                // Custom legend below chart
                const legendDiv = document.getElementById('status_chart_legend');
                let legendHTML = `<div style="margin-top: 5px;"><strong style="margin-right: 10px;">Total File: ${total}</strong>`;

                legendData.forEach(item => {
                    legendHTML += `<span style="margin-right: 15px;"><span style="color:${item.color};">${item.label}:</span> ${item.value}</span>`;
                });

                legendHTML += `</div>`;
                legendDiv.innerHTML = legendHTML;
            })
            .catch(error => console.error("Error loading chart data:", error));
    }


    document.addEventListener('DOMContentLoaded', function () {
        // Set current year
        document.getElementById('filterYear').value = new Date().getFullYear();

        // Set current quarter based on current month
        const currentMonth = new Date().getMonth() + 1;
        const currentQuarter = Math.ceil(currentMonth / 3);
        document.getElementById('filterQuarter').value = currentQuarter.toString();
        document.getElementById('filterQuarter').addEventListener('change', function () {
            document.getElementById('filterMonth').value = '';
            loadStatusPieChart();
        });

        // Load chart initially
        loadStatusPieChart();

        // Add listener to Year filter
        document.getElementById('filterYear').addEventListener('change', loadStatusPieChart);

        // Add listener to Month filter with quarter auto-adjustment
        // document.getElementById('filterMonth').addEventListener('change', function () {
        //     const selectedMonth = parseInt(this.value);
        //     const quarterField = document.getElementById('filterQuarter');

        //     if (!isNaN(selectedMonth)) {
        //         // Set quarter automatically based on selected month
        //         const autoQuarter = Math.ceil(selectedMonth / 3);
        //         quarterField.value = autoQuarter.toString();
        //     } else {
        //         // Reset quarter if 'All' is selected
        //         quarterField.value = '';
        //     }

        //     loadStatusPieChart();
        // });

        document.getElementById('filterMonth').addEventListener('change', function () {
            const selectedMonth = parseInt(this.value);
            const quarterField = document.getElementById('filterQuarter');

            if (!isNaN(selectedMonth)) {
                quarterField.value = ''; // Reset quarter to 'All'
            }

            loadStatusPieChart();
        });

        // Other filters
        document.getElementById('filterQuarter').addEventListener('change', loadStatusPieChart);
        document.getElementById('sales_data').addEventListener('change', loadStatusPieChart);
        // document.getElementById('state_sales').addEventListener('change', loadStatusPieChart);
        document.getElementById('countrys').addEventListener('change', loadStatusPieChart);

    });
</script>

<script>
   let chartInstance = null;

   function loadChart(salesId = '', quarter = '', state = '', companyId = '', country = '') {
        const params = new URLSearchParams({
            sales: salesId,
            quarter: quarter,
            state: state || '',
            company_id: companyId,
            country: country
        });

        fetch(`<?= base_url('admin/dashboard/get_company_billing_data') ?>?${params.toString()}`)
            .then(response => response.json())
            .then(chart => {
                const ctx = document.getElementById('billingChart').getContext('2d');
                console.log(chart,'chartchart');
                if (chartInstance) chartInstance.destroy();

                // Step 1: Combine all related data
                const combined = chart.labels.map((label, index) => ({
                    label: label,
                    value: chart.data[index],
                    file: chart.file[index]
                }));

                // Step 2: Sort by value descending
                // combined.sort((a, b) => b.value - a.value);

                // Step 3: Extract sorted arrays
                const sortedLabels = combined.map(item => item.label);
                const sortedData = combined.map(item => item.value);
                const sortedFileCounts = combined.map(item => item.file);

                chartInstance = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: sortedLabels,
                        datasets: [{
                            data: sortedData,
                            filecount: sortedFileCounts,
                            backgroundColor: sortedLabels.map((_, i) => `hsl(${i * 30}, 70%, 60%)`)
                        }]
                    },
                    options: {
                        plugins: {
                            tooltip: {
                                callbacks: {
                                    label: function (context) {
                                        let label = context.label || '';
                                        let value = context.raw || 0;
                                        let fileCount = context.dataset.filecount[context.dataIndex] || 0;
                                        return `${label}: $${value.toLocaleString()} (Files: ${fileCount})`;
                                    }
                                }
                            },
                            legend: { display: false }
                        }
                    }
                });

                    // Show country totals if available
                    const totalDiv = document.getElementById('totalRevenue');
                    // Country label mapping
                    const countryMap = {
                        kazakhstan: 'KZ',
                        azerbaijan: 'AZ',
                        georgia: 'GE',
                        belarus: 'BE',
                        armenia: 'AR'
                    };

                if (chart.country_totals && Object.keys(chart.country_totals).length > 0) {
                    let html = '<strong id="total_revenue" style="margin-right:20px;">Total Revenue:</strong>';
                    const revenuePerCountry = {};

                    for (const [country, total] of Object.entries(chart.country_totals)) {
                        const label = countryMap[country.toLowerCase()] || country.slice(0, 2).toUpperCase();
                        revenuePerCountry[label] = parseFloat(total);
                        html += `<span style="margin-right: 20px;">${label}: $${parseFloat(total).toLocaleString()}</span>`;
                    }

                    totalDiv.innerHTML = html;

                    // Sum all totals
                    const totalRevenue = Object.values(revenuePerCountry).reduce((sum, val) => sum + val, 0);
                    const totalRevenueEl = document.getElementById('total_revenue');
                    totalRevenueEl.innerHTML = `Total Revenue: $${totalRevenue.toLocaleString()}`;
    
                } else {
                    const totalRevenue = chart.data.reduce((sum, val) => sum + parseFloat(val), 0);
                    totalDiv.innerHTML = `Total Revenue: $${totalRevenue.toLocaleString()}`;

                }

            });
    }

    document.addEventListener('DOMContentLoaded', () => {
        const salesSelect = document.getElementById('sales');
        const quarterSelect = document.getElementById('quarter');
        const stateInput = document.getElementById('state');
        const companyInput = document.getElementById('company');
        const companyIdInput = document.getElementById('company_id');
        const countrySelect = document.getElementById('country');

        function updateChart() {
            const salesVal = salesSelect.value;
            const quarterVal = quarterSelect.value;
            const stateVal = stateInput.value;
            const companyId = companyIdInput.value;
            const countryVal = countrySelect.value;

            loadChart(salesVal, quarterVal, stateVal, companyId, countryVal);
        }

        // Initial chart load
        updateChart();

        // Event listeners for filters
        salesSelect.addEventListener('change', updateChart);
        quarterSelect.addEventListener('change', updateChart);
        companyInput.addEventListener('change', updateChart);
        // stateInput.addEventListener('input', updateChart);
        countrySelect.addEventListener('change', updateChart);

        // Expose globally if needed
        window.updateChart = updateChart;
    });
</script>

<script>
    function loadRevenueChart() {
        const location = document.getElementById('location').value;
        const year = document.getElementById('filterYears').value;
        const quarter = document.getElementById('quarterwise').value;
        const country = document.getElementById('countrywise').value;
        const state = document.getElementById('statewise').value;
        const city = document.getElementById('city').value;

        const params = new URLSearchParams({ location, year, quarter, country, state, city });

        fetch(`<?= base_url('admin/dashboard/get_company_billing_groupbar_data') ?>?${params.toString()}`)
            .then(res => res.json())
            .then(res => {
                console.log(res,'resres');
                const countryMap = {
                    kazakhstan: 'KZ',
                    azerbaijan: 'AZ',
                    georgia: 'GE',
                    belarus: 'BE',
                    armenia: 'AR'
                };

                res.chart_data.sort((a, b) => {
                    const sumA = Object.values(a).reduce((acc, val) => typeof val === 'object' ? acc + (val.amount || 0) : acc, 0);
                    const sumB = Object.values(b).reduce((acc, val) => typeof val === 'object' ? acc + (val.amount || 0) : acc, 0);
                    return sumA - sumB;
                });

                const locations = res.chart_data.map(item => {
                    const locKey = item.location.toLowerCase();
                    return countryMap[locKey] || item.location;
                });

                const countryKeys = res.country_keys;
                const totalSum = res.total_sum;
                const datasets = [];

                function getRandomColor(seed) {
                    let hash = 0;
                    for (let i = 0; i < seed.length; i++) {
                        hash = seed.charCodeAt(i) + ((hash << 5) - hash);
                    }
                    return `hsl(${hash % 360}, 65%, 60%)`;
                }

                const colors = {};
                countryKeys.forEach(key => {
                    colors[key] = getRandomColor(key);
                });

                countryKeys.forEach(country => {
                    const countryData = [];
                    const fileCounts = [];
                    const confirmedCounts = [];

                    res.chart_data.forEach(item => {
                        const data = item[country] || {};
                        countryData.push(data.amount || 0);
                        fileCounts.push(data.file_count || 0);
                        confirmedCounts.push(data.confirmed_count || 0);
                    });

                    datasets.push({
                        label: country,
                        data: countryData,
                        backgroundColor: colors[country],
                        fileCounts: fileCounts,
                        confirmedCounts: confirmedCounts,
                        datalabels: {
                            display: function (context) {
                                return context.dataset.data[context.dataIndex] > 0;
                            },
                            anchor: 'end',
                            align: 'end',
                            formatter: function (value, context) {
                                const confirmed = context.dataset.confirmedCounts[context.dataIndex];
                                const total = context.dataset.fileCounts[context.dataIndex];
                                return `$${value.toLocaleString()}\n(${confirmed}/${total})`;
                            },
                            color: '#000',
                            font: { size: 10 }
                        }
                    });
                });

                const ctx = document.getElementById('revenuegroupchart').getContext('2d');
                if (window.revenueChartInstance) window.revenueChartInstance.destroy();

                window.revenueChartInstance = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: locations,
                        datasets: datasets
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        layout: { padding: { right: 60, top: 60 } },
                        plugins: {
                            legend: {
                                display: true,
                                position: 'bottom',
                                labels: {
                                    filter: legendItem => legendItem.text !== 'Others'
                                }
                            },
                             tooltip: {
                                callbacks: {
                                    label: function (context) {
                                        const confirmed = context.dataset.confirmedCounts[context.dataIndex];
                                        const total = context.dataset.fileCounts[context.dataIndex];
                                        const revenue = context.raw;
                                        const percentage = totalSum > 0 ? Math.round((revenue / totalSum) * 100) : 0;
                                        const filepercentage = total > 0 ? Math.round((confirmed / total) * 100) : 0;
                                        // return `${context.dataset.label}: $${revenue.toLocaleString()}(${percentage}%)(Files: ${confirmed}/${total})`;
                                        return `${context.dataset.label}:\nNotes: $${revenue.toLocaleString()} (${percentage}%) (Files: ${confirmed}/${total}(${filepercentage}%))`;
                                    }
                                }
                            },
                            datalabels: {
                                display: true,
                                anchor: 'end',
                                align: 'end',
                                color: '#000',
                                font: { size: 10 }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                title: { display: true, text: 'Revenue ($)' }
                            },
                            x: {
                                stacked: false,
                                ticks: {
                                    autoSkip: false,
                                    maxRotation: 45,
                                    minRotation: 45
                                }
                            }
                        }
                    },
                    plugins: [ChartDataLabels]
                });
            });
    }


    // Trigger on load and change
    document.addEventListener("DOMContentLoaded", () => {
        const yearSelect = document.getElementById('filterYears');
        updateQuarterOptions(yearSelect.value);

        yearSelect.addEventListener('change', function () {
            updateQuarterOptions(this.value);
            loadRevenueChart();
        });
        loadRevenueChart();
        document.getElementById('location').addEventListener('change', loadRevenueChart);
        document.getElementById('quarterwise').addEventListener('change', loadRevenueChart);
        document.getElementById('filterYears').addEventListener('change', loadRevenueChart);
    });

    function updateQuarterOptions(year) {
        const quarterSelect = document.getElementById('quarterwise');
        const currentMonth = new Date().getMonth() + 1;

        const quarters = {
            'Q1': `${year}-01-01_${year}-03-31`,
            'Q2': `${year}-04-01_${year}-06-30`,
            'Q3': `${year}-07-01_${year}-09-30`,
            'Q4': `${year}-10-01_${year}-12-31`
        };

        // Clear old options
        quarterSelect.innerHTML = '';

        // Add "All" option
        const allOption = document.createElement('option');
        allOption.value = '';
        allOption.textContent = 'All';
        quarterSelect.appendChild(allOption);

        // Determine current quarter
        let currentQuarter = '';
        if (currentMonth >= 1 && currentMonth <= 3) currentQuarter = 'Q1';
        else if (currentMonth >= 4 && currentMonth <= 6) currentQuarter = 'Q2';
        else if (currentMonth >= 7 && currentMonth <= 9) currentQuarter = 'Q3';
        else if (currentMonth >= 10 && currentMonth <= 12) currentQuarter = 'Q4';

        // Populate quarters
        Object.entries(quarters).forEach(([label, value]) => {
            const option = document.createElement('option');
            option.value = value;
            option.textContent = label;
            if (label === currentQuarter && parseInt(year) === new Date().getFullYear()) {
                option.selected = true;
            }
            quarterSelect.appendChild(option);
        });
    }

</script>

<script>
    $(document).ready(function () {
        $(".company").autocomplete({
            source: function (request, response) {
                $.ajax({
                    url: "<?= base_url() ?>admin/company/company_name_suggesstion",
                    type: 'POST',
                    dataType: "json",
                    data: { search: request.term },
                    success: function (data) {
                        response(data);
                        $(".err").html('');
                    }
                });
            },
            select: function (event, ui) {
                $('.company').val(ui.item.label);
                $('.company_id').val(ui.item.company_id);
                updateChart();
            }
        }).blur(function () {
            if ($('.company').val().trim() === '') {
                $('.company_id').val('');
                updateChart();
            }
        });

        function split(val) {
            return val.split(/,\s*/);
        }
        function extractLast(term) {
            return split(term).pop();
        }

        $("#state").autocomplete({
            source: function (request, response) {
                $.ajax({
                    url: "<?= base_url('admin/dashboard/get_user_region') ?>",
                    type: "POST",
                    dataType: "json",
                    data: {
                        search: extractLast(request.term)
                    },
                    success: function (data) {
                        // Wrap values in { label: ..., value: ... } if needed
                        response($.map(data, function (item) {
                            return {
                                label: item,
                                value: item
                            };
                        }));
                    }
                });
            },
            focus: function () {
                return false;
            },
            select: function (event, ui) {
                let terms = split(this.value);
                terms.pop();
                terms.push(ui.item.label);
                terms.push("");
                this.value = terms.join(", ");
                updateChart(); 
                return false;
            }
        });

        $(".state_sales").autocomplete({
        source: function (request, response) {
            $.ajax({
                url: "<?= base_url('admin/dashboard/get_user_region') ?>",
                type: "POST",
                dataType: "json",
                data: {
                    search: extractLast(request.term)
                },
                success: function (data) {
                    response($.map(data, function (item) {
                        return {
                            label: item,
                            value: item
                        };
                    }));
                }
            });
        },
        focus: function () {
            return false;
        },
        select: function (event, ui) {
            const selectedRegion = ui.item.label;

            // Set selected region
            let terms = split(this.value);
            terms.pop();
            terms.push(selectedRegion);
            terms.push("");
            this.value = terms.join(", ");
            loadStatusPieChart(); 
            // Load sales team based on selected region
            $.ajax({
                url: "<?php echo base_url('admin/dashboard/get_sales_by_region') ?>",
                method: "POST",
                data: { region: $(".state_sales").val() },
                dataType: "json",
                success: function (response) {
                    let $salesSelect = $('#sales_data');
                    $salesSelect.empty();
                    $salesSelect.append('<option value="">All</option>');

                    if (response.length > 0) {
                        response.forEach(function (user) {
                            $salesSelect.append(
                                `<option value="${user.id}">${user.name}</option>`
                            );
                        });
                    } else {
                        $salesSelect.append('<option disabled>No users found</option>');
                    }
                },
                error: function () {
                    alert("Failed to load sales team.");
                }
            });

            return false;
        }
    });

    });
</script>

<script>
    const years = <?php echo $years; ?>;
    const totalData = <?php echo $totalData; ?>;
    const confirmData = <?php echo $confirmData; ?>;
    const pendingData = <?php echo $pendingData; ?>;
    const inProgressData = <?php echo $inProgressData; ?>;
    const notMaterializedData = <?php echo $notMaterializedData; ?>;

    const ctx = document.getElementById('yearlyEnquiryChart').getContext('2d');

    const yearlyEnquiryChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: years,
        datasets: [
        {
            label: 'Total',
            data: totalData,
            backgroundColor: 'rgba(54, 162, 235, 0.7)',
        },
        {
            label: 'Confirm',
            data: confirmData,
            backgroundColor: 'rgba(75, 192, 192, 0.7)',
        },
        {
            label: 'Pending',
            data: pendingData,
            backgroundColor: 'rgba(255, 206, 86, 0.7)',
        },
        {
            label: 'In Progress',
            data: inProgressData,
            backgroundColor: 'rgba(153, 102, 255, 0.7)',
        },
        {
            label: 'Not Materialized',
            data: notMaterializedData,
            backgroundColor: 'rgba(255, 99, 132, 0.7)',
        }
        ]
    },
    options: {
        responsive: true,
        plugins: {
        legend: {
            display: false // Hide the default legend
        }
        },
        scales: {
        x: {
            title: {
            display: true,
            text: 'Year'
            }
        },
        y: {
            beginAtZero: true,
            title: {
            display: true,
            text: 'Enquiries'
            }
        }
        }
    }
    });

    // Tooltip messages
    const enquiryTooltipMap = {
        'Total': 'Click TO Filter',
        'Confirm': 'Click TO Filter',
        'Pending': 'Click TO Filter',
        'In Progress': 'Click TO Filter',
        'Not Materialized': 'Click TO Filter'
    };

    // Create custom legend
    const enquiryLegendContainer = document.getElementById('enquiry-custom-legend');
    yearlyEnquiryChart.data.datasets.forEach((dataset, index) => {
    const legendItem = document.createElement('div');
    legendItem.className = 'legend-item';
    legendItem.setAttribute('title', enquiryTooltipMap[dataset.label] || dataset.label);
    legendItem.dataset.index = index;

    const colorBox = document.createElement('span');
    colorBox.className = 'legend-box';
    colorBox.style.backgroundColor = dataset.backgroundColor;

    const labelText = document.createTextNode(dataset.label);

    legendItem.appendChild(colorBox);
    legendItem.appendChild(labelText);
    enquiryLegendContainer.appendChild(legendItem);

    // Toggle functionality on click
    legendItem.addEventListener('click', function () {
        const datasetIndex = this.dataset.index;
        const meta = yearlyEnquiryChart.getDatasetMeta(datasetIndex);
        meta.hidden = meta.hidden === null ? true : !meta.hidden;
        this.classList.toggle('hidden', meta.hidden);
        yearlyEnquiryChart.update();
    });
});
</script>

<script>
    const arrival_year = <?php echo $arrival_year; ?>;
    const total_arrival = <?php echo $total_arrival; ?>;
    const Complete_arrival = <?php echo $Complete_arrival; ?>;
    const File_closed = <?php echo $File_closed; ?>;
    const arrival_cancel = <?php echo $arrival_cancel; ?>;
    const in_progress = <?php echo $in_progress; ?>;

    const ctx2 = document.getElementById('yearlyArrivalChart').getContext('2d');

    const yearlyArrivalChart = new Chart(ctx2, {
        type: 'bar',
        data: {
        labels: arrival_year,
        datasets: [
            {
            label: 'Total',
            data: total_arrival,
            backgroundColor: 'rgba(54, 162, 235, 0.7)',
            },
            {
            label: 'Complete',
            data: Complete_arrival,
            backgroundColor: 'rgba(75, 192, 192, 0.7)',
            },
            {
            label: 'File-closed',
            data: File_closed,
            backgroundColor: 'rgba(255, 206, 86, 0.7)',
            },
            {
            label: 'Cancel',
            data: arrival_cancel,
            backgroundColor: 'rgba(153, 102, 255, 0.7)',
            },
            {
            label: 'In-Progress',
            data: in_progress,
            backgroundColor: 'rgba(255, 186, 102, 0.7)',
            }
        ]
        },
        options: {
        responsive: true,
        plugins: {
            legend: {
            display: false // Disable default legend
            }
        },
        scales: {
            x: {
            title: {
                display: true,
                text: 'Arrival Year'
            }
            },
            y: {
            beginAtZero: true,
            title: {
                display: true,
                text: 'Arrival'
            }
            }
        }
        }
    });

    // Tooltip text for each label
    const tooltipMap = {
        'Total': 'Click TO Filter',
        'Complete': 'Click TO Filter',
        'File-closed': 'Click TO Filter',
        'Cancel': 'Click TO Filter',
        'In-Progress': 'Click TO Filter'
    };

    // Render custom legend
    const legendContainer = document.getElementById('arrival-custom-legend');
    yearlyArrivalChart.data.datasets.forEach((dataset, index) => {
        const legendItem = document.createElement('div');
        legendItem.className = 'legend-item';
        legendItem.setAttribute('title', tooltipMap[dataset.label] || dataset.label);
        legendItem.dataset.index = index;

        const colorBox = document.createElement('span');
        colorBox.className = 'legend-box';
        colorBox.style.backgroundColor = dataset.backgroundColor;

        const labelText = document.createTextNode(dataset.label);

        legendItem.appendChild(colorBox);
        legendItem.appendChild(labelText);
        legendContainer.appendChild(legendItem);

        // Click to toggle
        legendItem.addEventListener('click', function () {
        const datasetIndex = this.dataset.index;
        const meta = yearlyArrivalChart.getDatasetMeta(datasetIndex);
        meta.hidden = meta.hidden === null ? true : !meta.hidden;
        this.classList.toggle('hidden', meta.hidden);
        yearlyArrivalChart.update();
        });
    });

    $(window).on('load', function() {
    var delayMs = 1000;

    setTimeout(function() {
        $("#numbers-count").toggle('slow');
    }, delayMs);

    function refreshPart() {
        $.ajax({
            url: 'admin/dashboard/counts_data',
            method: 'GET',
            success: function(response) {
                var parsedResponse = JSON.parse(response);

                $("#count-data").empty();

                // Create and append the updated badge
                var badgeHTML = '<span class="badge badge-pill badge-info blinking" ' +
                    'style="padding: 6px 10px;height: 29px;font-size: 19px !important;' +
                    'margin-top: -40px;background-color: #663399;">' + parsedResponse.data + '</span>';

                $("#count-data").append(badgeHTML);
            },

            error: function() {
                console.error("An error occurred while refreshing the part.");
            }
        });
    }

    function refreshAdminPart() {
        $.ajax({
            url: 'admin/dashboard/admin_counts_data',
            method: 'GET',
            success: function(response) {
                var parsedResponse = JSON.parse(response);
                var parsedResponse = parsedResponse.data;
                // console.log('response',response);
                $.each(parsedResponse, function(index, countryData) {
                    //var row = $(".row-container[data-index='" + index + "']");
                    $('.confirm_count_' + countryData.country).html('<span>' + countryData.count + '</span>');
                });
            },
            error: function() {
                console.error("An error occurred while refreshing the part.");
            }
        });
    }

    // Set interval to refresh the #numbers-count part every 500 ms
    setInterval(function() {
        refreshPart();
        refreshAdminPart();
    }, 1000); // 500 milliseconds
    });
</script>
<script>
    $(document).ready(function () {
        const url = new URL(window.location.href);
        const initialLocation = $(".location").val();

        $(".location").on("change", function () {
            var locationVal = $(this).val();
            if (locationVal) {
                get_staff(locationVal);
            }
        });
        if (initialLocation) {
            get_staff(initialLocation);
        }

        function get_staff(locationnew) {
            if (!locationnew) {
                console.warn("Location is empty");
                $(".staff_id").empty();
                return;
            }

            $.ajax({
                type: "POST",
                url: "<?= base_url(); ?>admin/enquiry/get_staffuser",
                data: {
                    location: locationnew,
                    '<?= $this->security->get_csrf_token_name(); ?>': '<?= $this->security->get_csrf_hash(); ?>'
                },
                dataType: "JSON",
                success: function (data) {
                    $(".staff_id").empty().parent().addClass("is-dirty");
                     $('.staff_id').append('<option value="">All</option>');
                    $.each(data.details, function (i, d) {
                        $('.staff_id').append('<option value="' + d.id + '">' + d.name + '</option>');
                    });

                    let staffFromUrl = url.searchParams.get('staff_id');
                    if (staffFromUrl && data.details.some(staff => staff.id == staffFromUrl)) {
                        $('.staff_id').val(staffFromUrl);
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error("AJAX error:", textStatus);
                }
            });
        }
    });
</script>

<script>
   $(document).ready(function () {
        // Disable state and city by default
        $(".state").prop('disabled', true);
        $(".city").prop('disabled', true);

        function split(val) {
            return val.split(/,\s*/);
        }

        function extractLast(term) {
            return split(term).pop();
        }

        function checkCountryStateCityEnabling() {
            const countryCount = split($('.country').val()).filter(Boolean).length;
            const stateCount = split($('.state').val()).filter(Boolean).length;

            if (countryCount === 1) {
                $(".state").prop('disabled', false);
            } else {
                $(".state").val('').prop('disabled', true);
                $(".city").val('').prop('disabled', true);
            }

            if (stateCount === 1) {
                $(".city").prop('disabled', false);
            } else {
                $(".city").val('').prop('disabled', true);
            }
        }

        $(".country").autocomplete({
            minLength: 1,
            source: function(request, response) {
                $.ajax({
                    url: "<?= base_url() ?>admin/company/get_country_ajax",
                    type: 'post',
                    dataType: "json",
                    data: {
                        search: extractLast(request.term)
                    },
                    success: function(data) {
                        response(data);
                    }
                });
            },
            focus: function() {
                return false;
            },
            select: function(event, ui) {
                let terms = split(this.value);
                terms.pop();
                terms.push(ui.item.label);
                terms.push("");
                this.value = terms.join(", ");
                // $('#countrys').val(ui.item.label);
                $('#country_id').val(ui.item.country_id);
                checkCountryStateCityEnabling();
                loadRevenueChart();
                return false;
            }
        });

        $(".state").autocomplete({
            source: function (request, response) {
                if ($('.country').val() === "") {
                    alert('Please select a country first.');
                    $(".state").val('').prop('disabled', true);
                    return;
                }

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
            },
            focus: function() {
                return false;
            },
            select: function (event, ui) {
                var terms = split(this.value);
                terms.pop();
                terms.push(ui.item.label);
                terms.push("");
                this.value = terms.join(", ");

                $('.state_id').val(ui.item.state_id);

                checkCountryStateCityEnabling();
                loadRevenueChart();
                return false;
            }
        });

        $(".city").autocomplete({
            source: function (request, response) {
                if ($('.state').val() === "") {
                    alert('Please select a state first.');
                    $(".city").val('').prop('disabled', true);
                    return;
                }

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
            },
            focus: function() {
                return false;
            },
            select: function (event, ui) {
                var terms = split(this.value);
                terms.pop();
                terms.push(ui.item.label);
                terms.push("");
                this.value = terms.join(", ");

                loadRevenueChart();
                return false;
            }
        });

        // Re-check enable/disable state/city if input manually
        $('.country, .state').on('blur', checkCountryStateCityEnabling);
    });

</script>

<?php if (in_array($this->session->userdata('type'), ['1'])) : ?>
<script>
  const toggleIcon = document.getElementById("toggleIcon");
  const toggleContents = document.querySelectorAll(".toggleContent");

  toggleIcon.addEventListener("click", function () {
    updateChart();
    loadStatusPieChart();
    let isHidden = [...toggleContents].every(div =>
      div.style.display === "none" || div.style.display === ""
    );

    toggleContents.forEach(div => {
      div.style.display = isHidden ? "block" : "none";
    });

    toggleIcon.innerHTML = isHidden ? "<span>-</span>" : "<span>＋</span>";
  });
</script>
<?php endif; ?>
<?php if ($this->session->userdata('type') == '1' || $this->session->userdata('type') == '2') : ?>
<script>
// $(document).ready(function () {
//     const selectedLocation = $('#countryss').val();
//     filterUsersByLocation(selectedLocation || 'all');
// });

// function filterUsersByLocation(location) {
//     $.ajax({
//         url: "<?php //echo base_url('admin/dashboard/getUsersByLocation') ?>",
//         method: "POST",
//         data: { location: location },
//         dataType: "json",
//         success: function (response) {
//             const userDropdown = $('#all_user');
//             userDropdown.empty();

//             // If userType == 1, add "All" option
//             if (userType == 1) {
//                 const selectedAttr = (selectedUserId == '') ? ' selected' : '';
//                 userDropdown.append('<option value=""' + selectedAttr + '>All</option>');
//             }

//             // Add user options
//             response.forEach(function (user) {
//                 let selectedAttr = '';
//                 if (userType == 2 && selectedUserId == user.id) {
//                     selectedAttr = ' selected';
//                 } else if (userType == 1 && selectedUserId == user.id) {
//                     selectedAttr = ' selected';
//                 }
//                 userDropdown.append('<option value="' + user.id + '"' + selectedAttr + '>' + user.name + '</option>');
//             });
//              loadSalesTeamChart();
//         },
//         error: function () {
//             alert("Failed to fetch users.");
//         }
//     });
// }
</script>
<?php endif; ?>
<?php if ($this->session->userdata('type') == '1'){ ?>
<script>
$(document).ready(function () {
    function updateBookingTypesFromLocation(selectedLocation) {
        var selectedOption = $("#countryss option[value='" + selectedLocation + "']");
        var v = selectedOption.attr('data-abbr');

        // Get selected booking type from data-selected
        var selectedBookingType = $("#booking_type").data("selected") || "";

        $(".booking_type").empty().parent().removeClass("is-dirty");

        // Always start with "Select" as the first option
        $('.booking_type').append('<option value="">Select</option>');

        if (v !== "" && v !== undefined) {
            var opts = v.split(",");
            $(".booking_type").parent().addClass("is-dirty");

            $.each(opts, function (i, d) {
                var selected = (selectedBookingType === d) ? 'selected="selected"' : '';
                $('.booking_type').append('<option value="' + d + '" ' + selected + '>' + d + '</option>');
            });

            // Optional: Include 'All' at the end (but not selected)
            // $('.booking_type').append('<option value="all">All</option>');
        }
    }

    // On page load
    var selectedLocation = $("#countryss").val();
    updateBookingTypesFromLocation(selectedLocation);

    // On location change
    $("#countryss").on("change", function () {
        // Clear previous selection
        $("#booking_type").attr("data-selected", "");
        var selectedLocation = $(this).val();
        updateBookingTypesFromLocation(selectedLocation);
    });
});


$(document).ready(function () {
    $('.booking_type').on('change', function () {
        var bookingType = $(this).val();

        $('#all_user').html('<option value="">Loading...</option>');

        $.ajax({
            url: '<?= base_url("admin/dashboard/get_users_by_booking_type") ?>',
            type: 'GET',
            data: { booking_type: bookingType },
            dataType: 'json',
            success: function (response) {
                if (response.status === 'success') {
                    var users = response.data;
                    var options = '<option value="">Select</option>';

                    if (users.length > 0) {
                        $.each(users, function (i, user) {
                            var label = user.name + (user.hod === 'yes' ? ' (HOD)' : '');
                            var style = user.status == 2 ? 'style="color:red;"' : '';
                            var title = user.status == 2 ? 'title="User In-active no longer work with us"' : '';
                            options += '<option value="' + user.id + '" ' + style + ' ' + title + '>' + label + '</option>';
                        });
                    } else {
                        options = '<option value="">No users found</option>';
                    }

                    $('#all_user').html(options);
                } else {
                    $('#all_user').html('<option value="">Error fetching users</option>');
                }
            },
            error: function () {
                $('#all_user').html('<option value="">AJAX error occurred</option>');
            }
        });
    });
});

</script>
<?php } ?>
<?php if ($this->session->userdata('type') == '2'){ ?>
<script>
$(document).ready(function () {
    function fetchBookingTypeAndUsers(location, callback = null) {
        if (!location) return;

        $.ajax({
            url: '<?= base_url("admin/dashboard/get_booking_data_for_hod_user") ?>',
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
                    $('#booking_type').html(typeOptions);

                    // Set users
                    populateUsers(res.users, res.logged_in_user_id);
                    //  trigger callback after DOM update
                    if (typeof callback === 'function') {
                        setTimeout(callback, 10); // slight delay ensures DOM is ready
                    }
                } else {
                    $('#booking_type').html('<option value="">Select</option>');
                    $('#all_user').html('<option value="">No Users</option>');
                }
            }
        });
    }

    function fetchUsersByBookingType(bookingType, location) {
        if (!bookingType) return;

        $.ajax({
            url: '<?= base_url("admin/dashboard/get_users_by_booking_type_filtered") ?>',
            type: 'GET',
            data: { booking_type: bookingType, location: location },
            dataType: 'json',
            success: function (res) {
                if (res.status === 'success') {
                    populateUsers(res.users, res.logged_in_user_id);
                } else {
                    $('#all_user').html('<option value="">No users found</option>');
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
        $('#all_user').html(userOptions);
    }

    // On location change
    $('#countryss').on('change', function () {
        const location = $(this).val();
        if (!location) return;
    
        // Fetch booking types and users first, then load chart using selected booking type
        fetchBookingTypeAndUsers(location, function () {
            const updatedBookingType = $('#booking_type').val(); // get after dropdown updates
            loadSalesTeamChart(); // if needed you can pass updatedBookingType
        });
    });



    // On booking type change
    $('#booking_type').on('change', function () {
        var selectedBookingType = $(this).val();
        var location = $('#countryss').val();
        fetchUsersByBookingType(selectedBookingType, location);
    });

    // Initial load
    var initialLocation = $('#countryss').val();
    if (initialLocation) {
        fetchBookingTypeAndUsers(initialLocation);
        setTimeout(function () {
            loadSalesTeamChart();
    }, 300);
    }
});
</script>
<?php } ?>