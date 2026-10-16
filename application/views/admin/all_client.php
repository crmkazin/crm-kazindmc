<style>
    .img-width {max-width: 80px;}
    .greenText{ background-color:#02d530; }
    .blueText{ background-color:#0f4aff; }
    .orangeText{ background-color:orange; }
    .grayText{ background-color:#bdbdbd; }
    .whiteText{ background-color:#FFF; }
    .dataTable thead th[class*=sorting]:after{display: none !important;}
    span.select2-selection.select2-selection--multiple {border: 1px solid #ccc !important;}
</style>
<link href="https://cdn.jsdelivr.net/gh/djibe/material@4.6.2-1.0/css/material-plugins.min.css" rel="stylesheet" />
<?php include('admin_head_css.php'); ?>

<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-lg-2 col-sm-6  col-6 align-self-center">
                <h4 class="text-themecolor">Lists</h4>
            </div>
            <div class="col-lg-8 only-for-dashbord">
            </div>
            <div class="col-lg-2 col-sm-6 col-6 align-self-center text-end">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb justify-content-end">
                        <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Home</a></li>
                        <li class="breadcrumb-item active">Lists</li>
                    </ol>
                </div>
            </div>
        </div>
        <?php echo $this->session->flashdata('message'); unset($_SESSION['message']); ?> <div class="row">
        <div class="col-12">
                <div class="card card-box">
            
            
                <div class="card-body">
                <form method="get" autocomplete="off">
                    <div class="card-body row">
                        <div class="col-lg-3 p-t-20">
                            <div
                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">

                                <label class="mdl-textfield__label">Select Country</label>
                                <?php echo form_input(['name' => 'country', 'id' => 'country', 'placeholder' => 'Country', 'class' => 'mdl-textfield__input','value'=>$this->input->get('country')]) ?>
                            </div>
                        </div>
                        <input type="hidden" name="country_id" id="country_id" value="">
                        <div class="col-lg-3 p-t-20">
                            <div
                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">

                                <label class="mdl-textfield__label">State</label>
                                <?php echo form_input(['name' => 'state', 'id' => 'state', 'placeholder' => 'State', 'class' => 'mdl-textfield__input','value'=>$this->input->get('state')]) ?>
                            </div>
                        </div>
                        <input type="hidden" name="state_id" id="state_id" value="">

                        <div class="col-lg-3 p-t-20">
                            <div
                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">

                                <label class="mdl-textfield__label">City</label>
                                <?php echo form_input(['name' => 'city', 'id' => 'city', 'placeholder' => 'City', 'class' => 'mdl-textfield__input','value'=>$this->input->get('city')]) ?>
                            </div>
                        </div>

                        <div class="col-lg-3 p-t-20">
                            <div
                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                <label class="mdl-textfield__label">Company</label>
                                <?php echo form_input(['name' => 'company', 'id' => 'company', 'placeholder' => 'Company Name', 'class' => 'mdl-textfield__input', 'value'=>($this->input->get('company')<>'')?urldecode($this->input->get('company')):'']) ?>
                            </div>
                            <input type="hidden" name="company_id" id="company_id" value="<?=($this->input->get('company_id')<>'' && $this->input->get('company')<>'')?$this->input->get('company_id'):''; ?>">
                        </div>

                        <div class="col-lg-3 p-t-20">
                            <div
                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                <label class="mdl-textfield__label">Select Agent</label>
                                <select name="agent" id="agent" class="mdl-textfield__input" style="padding:8px;">
                                    <option value="">Select..</option>
                                </select>
                                
                            </div>
                        </div>

                        <div class="col-lg-3 p-t-20">
                            <div
                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                <label class="mdl-textfield__label">Email Address</label>
                                <?php echo form_input(['name' => 'email', 'type' => 'email', 'id' => 'email', 'placeholder' => 'Agent email', 'class' => 'mdl-textfield__input','value'=>urldecode($this->input->get('email'))]) ?>
                            </div>
                        </div>
                        
                        <div class="col-lg-3 p-t-20">
                            <div
                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                <label class="mdl-textfield__label">Mobile Number</label>
                                <?php echo form_input(['name' => 'mobile', 'type' => 'text', 'id' => 'mobile', 'placeholder' => 'Agent mobile number', 'class' => 'mdl-textfield__input','value'=>urldecode($this->input->get('mobile'))]) ?>
                            </div>
                        </div>
                        <div class="col-lg-3 p-t-20">
                            <div
                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width" style="">
                                 <label class="mdl-textfield__label">Status</label>
                                <select onchange="this.className=this.options[this.selectedIndex].className" name="enquiry_status" id="enquiry_status" class="select mdl-textfield__input" style="padding:8px; width:100%; border-radius:4px;">
                                    <option class="whiteText" value="">All</option>
                                    <option class="grayText" style="color: #fff;" value="no-query" <?php echo ($this->input->get('enquiry_status')<>'' && $this->input->get('enquiry_status')=='no-query')?'selected':''; ?>>No query received</option>
                                    <option class="blueText" style="color: #fff;" value="query-received-but-not-converted" <?php echo ($this->input->get('enquiry_status')<>'' && $this->input->get('enquiry_status')=='query-received-but-not-converted')?'selected':''; ?>>Query received but not converted</option>
                                    <option class="orangeText" style="color: #fff;" value="only-one-query-converted" <?php echo ($this->input->get('enquiry_status')<>'' && $this->input->get('enquiry_status')=='only-one-query-converted')?'selected':''; ?>>Single query converted</option>
                                    <option class="greenText" style="color: #fff;" value="queries-converted" <?php echo ($this->input->get('enquiry_status')<>'' && $this->input->get('enquiry_status')=='queries-converted')?'selected':''; ?>>Multiple query converted</option>
                                </select>
                            </div>    
                        </div>

                        <div class="col-lg-3 p-t-20">
                            <div
                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width" style="">
                                 <label class="mdl-textfield__label">From</label>
                                <input type="text" name=""
                                                    class="input inputdate mdl-textfield__input dt-search-show" style="width:100%;"
                                                    value="<?php echo ($this->input->get('from') <> '') ? date('d-M-Y', strtotime($this->input->get('from'))) : ''; ?>"
                                                    readonly>
                                                <?php echo form_input(['type' => 'date', 'name' => 'from', 'placeholder' => '', 'id' => 'from', 'class' => 'dt-search', 'value' => ($this->input->get('from') <> '') ? $this->input->get('from') : '', 'style' => 'width:17px;float:right; top:70%']) ?>
                                        
                            </div>    
                        </div>

                        <div class="col-lg-3 p-t-20">
                            <div
                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width" style="">
                                 <label class="mdl-textfield__label">To</label>
                                <input type="text" name=""
                                                    class="input inputdate mdl-textfield__input dt-search-show" style="width:100%;"
                                                    value="<?php echo ($this->input->get('to') <> '') ? date('d-M-Y', strtotime($this->input->get('to'))) : ''; ?>"
                                                    readonly>
                                                <?php echo form_input(['type' => 'date', 'name' => 'to', 'placeholder' => '', 'id' => 'to', 'class' => 'dt-search', 'value' => ($this->input->get('to') <> '') ? $this->input->get('to') : '', 'style' => 'width:17px;float:right; top:70%']) ?>
                                        
                            </div>    
                        </div>

                        <!-- <div class="col-lg-3 p-t-20">
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                      <label class="mdl-textfield__label">Year</label>
                                <select name="year[]" id="year" class="mdl-textfield__input js-example-basic-multiple" style="padding:5px;width:100%;" multiple>
                                    <option value="">Select..</option>
                                    <?php 
                                    // $current_year = date('Y');
                                    // $get_years = ($this->input->get('year')<>'')?$this->input->get('year'):[]; 
                                    
                                    // for($i=2023;$i<=$current_year;$i++){ ?>
                                    <option value="<?php //echo $i?>" <?php //echo (!empty($this->input->get('year')) && in_array($i, $get_years))?'selected="selected"':''; ?>><?php //echo $i?></option>
                                    <?php //} ?>
                                </select>
                          
                            </div>
                            
                        </div> -->
                        <!-- <div class="col-lg-3 p-t-20">
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                  <label class="mdl-textfield__label">Month(s)</label>
                                <select name="months[]" id="months" class="mdl-textfield__input js-example-basic-multiple" style="padding:5px;width:100%;" multiple <?php //echo (count($get_years)>1)?'disabled':''; ?>>
                                    <option value="all" <?php //echo ($this->input->get('months')<>'' && $this->input->get('months')[0]=='all')?'selected="selected"':''; ?>>All</option>
                                        <?php   //$months = ['01'=>'January','02'=>'February','03'=>'March','04'=>'April','05'=>'May','06'=>'June',
                                            //             '07'=>'July','08'=>'August','09'=>'September','10'=>'October','11'=>'November','12'=>'December']; 
                                            // $get_months = ($this->input->get('months')<>'')?$this->input->get('months'):[];
                                            // $first_month = $get_months[0];
                                            // $last_month = end($get_months);
                                            // for($m=$first_month;$m<=$last_month;$m++){
                                            //     $get_months[] = $m;
                                            // }
                                            
                                        ?>
                                        <?php //foreach($months AS $key=>$val){ ?>
                                            <option value="<?php //echo $key?>" <?php //echo ($get_months<>'' && in_array($key,$get_months))?'selected="selected"':''; ?>><?php //echo $val?></option>
                                        <?php //} ?>
                                </select>
                              
                            </div>												
                        </div> -->

                        <div class="col-lg-3 p-t-20"> 
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                <label class = "mdl-textfield__label">Acquiring Source</label>	
                                <?php $selected_source = $this->input->get('acquiring_source'); ?>
                                    <select name="acquiring_source" class="acquiring_source mdl-textfield__input" style="padding-top:13px;">
                                        <option value=""></option>
                                        <?php 
                                        // $acquiring_source = ['exhibition','SKAL','sales visit(one-to-one meeting)','TTAUP TRAVEL MART','Salem Travel Mart','GTAA- Global Tourism Travel Agents Association','referral','road show','website','social media marketing','email','T- Syndicate Group']; 
                                        
                                        $acquiring_source = ['exhibition','sales visit(one-to-one meeting)','referral','road show','website','social media marketing','email','webinar'];

                                        
                                        foreach($acquiring_source AS $list){  
                                            $selected = ($selected_source == $list) ? 'selected' : '';
                                        ?>
                                            <option value="<?=$list ?>" <?= $selected ?>><?= ucfirst($list); ?></option>
                                        <?php } ?>
                                    </select>
                            </div>
						</div>
						
						<div class="col-lg-3 p-t-20 road_show" style="display:none;"> 
                            <div class= "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                <label class = "mdl-textfield__label">Road Show</label>	
                                <?php $selected_show = $this->input->get('road_show'); ?>
                                <select name="road_show" class="mdl-textfield__input" style="padding-top:13px;">
                                    <option value=""></option>
                                    <?php 
                                    $road_show = ['SKAL','TTAUP TRAVEL MART','Salem Travel Mart','GTAA- Global Tourism Travel Agents Association','Uniglobe - South Asia','T- Syndicate Group','MTOA','MTTE','KTTC - Kerala','TAFI', 'UTEN', 'ITME', 'GNTA Chennai', 'GNTA Bangalore', 'GNTA Mumbai','GNTA Delhi', 'iris mertens Belgium'];                                                                       
                                    foreach($road_show AS $list){  ?>
                                        <?php $road_show_selected = ($selected_show == $list) ? 'selected' : '';
                                        ?>
                                        <option value="<?= $list ?>" <?= $road_show_selected; ?>>
                                            <?= $list ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        
						
						<?php $selected_sales = $this->input->get('sales'); ?>
                        <div class="col-lg-3 p-t-20 sales_team" style="display:none;"> 
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                <label class="mdl-textfield__label">Kazin Sales Team</label>
                                <select name="sales" class="mdl-textfield__input" style="padding-top:13px;">
                                    <option value=""></option>
                                    <?php 
                                    foreach ($sales_team as $list) {
                                        $selected = ($selected_sales == $list->id) ? 'selected' : '';
                                        echo "<option value=\"$list->id\" $selected>" . ucfirst($list->name) . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div> 
						
						<?php $selectedExhibition = $this->input->get('exhibition'); ?>
                        <div class="col-lg-3 p-t-20 Exhibition" style="display:none;"> 
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                <label class = "mdl-textfield__label">Exhibition</label>	
                                 <select name="exhibition" class="mdl-textfield__input" style="padding-top:13px;">
                                    <option value="">Select Exhibition</option>
                                    <option value="SAATE" <?= ($selectedExhibition == 'SAATE') ? 'selected="selected"' : '' ?>>SAATE</option>
                                    <option value="OTM" <?= ($selectedExhibition == 'OTM') ? 'selected="selected"' : '' ?>>OTM</option>
                                    <option value="TTJ" <?= ($selectedExhibition == 'TTJ') ? 'selected="selected"' : '' ?>>TTJ</option>
                                    <option value="Melange" <?= ($selectedExhibition == 'Melange') ? 'selected="selected"' : '' ?>>Melange</option>
                                    <option value="IMEX" <?= ($selectedExhibition == 'IMEX') ? 'selected="selected"' : '' ?>>IMEX</option>
                                    <option value="QTM" <?= ($selectedExhibition == 'QTM') ? 'selected="selected"' : '' ?>>QTM</option>
                                    <option value="TMS APAC" <?= ($selectedExhibition == 'TMS APAC') ? 'selected="selected"' : '' ?>>TMS APAC</option>
                                    <option value="Allintoo" <?= ($selectedExhibition == 'Allintoo') ? 'selected="selected"' : '' ?>>Allintoo</option>
                                    <option value="KITF" <?= ($selectedExhibition == 'KITF') ? 'selected="selected"' : '' ?>>KITF</option>
                                    <option value="Tarifa" <?= ($selectedExhibition == 'Tarifa') ? 'selected="selected"' : '' ?>>Tarifa</option>
                                    <option value="World Travel Collective (WTC)" <?= ($selectedExhibition == 'World Travel Collective (WTC)') ? 'selected="selected"' : '' ?>>World Travel Collective (WTC)</option>
                                    <option value="Arabian Travel Market (ATM)" <?= ($selectedExhibition == 'Arabian Travel Market (ATM)') ? 'selected="selected"' : '' ?>>Arabian Travel Market (ATM)</option>
                                </select>
                            </div>
						</div>   

                        <div class="col-lg-3 p-t-20">
                            <div
                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                <label class="mdl-textfield__label">Pincode</label>
                                <?php echo form_input(['name' => 'pincode', 'type' => 'text', 'id' => 'pincode', 'placeholder' => 'pincode', 'class' => 'mdl-textfield__input','value'=>urldecode($this->input->get('pincode'))]) ?>
                            </div>
                        </div>
                        
                        
                        <div class="col-lg-4 p-t-20">
                            <?php echo form_submit(['name' => 'submit', 'id' => 'submit', 'class' => 'btn btn-md btn-primary m-t-20', 'style' => 'float:left;', 'value' => 'Search']); ?>
                         <?php  $allowed_users = ['1', '3', '5'];
                         $allowed_user_emails = ['bo.geo@kazindmc.com','uz.backoffice@kazindmc.com'];
                         
                            ?>
                        <?php  if (in_array($this->session->userdata('type'), $allowed_users) || in_array($this->session->userdata('email'),$allowed_user_emails)) { ?>
                        <a href="<?= base_url(); ?>company" class="btn btn-primary m-t-20 ms-2" style="padding:8px;"
                            title="Add Query B2B">
                            <i class="fa fa-plus"></i> </a>
                        <?php } if (in_array($this->session->userdata('type'), ['1', '3']) || in_array($this->session->userdata('email'), ['sales@kazindmc.com'])) { ?>
                        <a href="<?php echo base_url('client-excel-download?' . $this->input->SERVER('QUERY_STRING')); ?>"
                            id="export_to_excel" class="btn btn-primary m-t-20 ms-2" title="Download Excel"
                            target="_blank" style="padding:8px;">
                            <i class="fa fa-download"></i></a>
                        <?php } ?>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- table responsive -->
        <div class="card">
            <div class="card-body">
                <div class="table-responsives m-t-20">
                    <div class="row text-center mb-3">
                        <div class="col-3">
                            <div class="card shadow-sm" style="border-top: 4px solid #bdbdbd;">
                                <div class="card-body p-2">
                                    <h5 class="text-dark mb-1"></h5>
                                    <small class="text-muted">No query received</small>
                                </div>
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="card shadow-sm" style="border-top: 4px solid #0f4aff;">
                                <div class="card-body p-2">
                                    <h5 class="text-dark mb-1"></h5>
                                    <small class="text-muted">Query received but not converted</small>
                                </div>
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="card shadow-sm" style="border-top: 4px solid orange;">
                                <div class="card-body p-2">
                                    <h5 class="text-dark mb-1"></h5>
                                    <small class="text-muted">Single query converted</small>
                                </div>
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="card shadow-sm" style="border-top: 4px solid #02d530;">
                                <div class="card-body p-2">
                                    <h5 class="text-dark mb-1"></h5>
                                    <small class="text-muted">Multiple query  converted</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php //print_r($company);?>
                    <div class="table-scrollable">
                        <table
                            class="table table-striped border table-hover table-checkable order-column full-width display"
                            id="client_data">
                            <!-- Table header -->
                            <thead>
                                <tr>
                                    <th class="center">Sr.No</th>
                                    <th class="center">Company Name</th>
                                    <th class="center">Total Agents</th>
                                    <th class="center">Agent</th>
                                    <!-- <th class="center">Total Agents</th> -->
                                    <th class="center">Contact Number</th>
                                    <th class="center">Email</th>
                                    <th class="center">Designation</th>
                                    <th class="center">Pincode</th>
                                    <th class="center">City</th>
                                    <th class="center">State</th>
                                    <th class="center">Country</th>
                                    <th class="center">Sales Person</th>
                                    <th class="center">Acquiring Source</th>
                                    <th class="center">Exhibition Source</th>
                                    <th class="center">Remark</th>
                                    <th class="center">Date</th>
                                    <th class="center">Status</th>
                                    <th class="center remove">Company Logo</th>
                                    <th class="center remove">Action</th>
                                    <th class="center"></th>
                                </tr>
                            </thead>
                            <!-- Table body -->
                            <tbody>
                                <?php
                                $records_cnt = 0;
                                if (!empty($company)) {
                                    $i = $offset + 1;
                                    // print_r($company);
                                    foreach ($company as $companies) {
                                        $records_cnt++;
                                        $background = '';
                                            if($companies->enquiry_status === 'queries-converted'){
                                            $background = 'background: #02d530;color:#FFF;';                                                            
                                            }
                                            else if($companies->enquiry_status === 'only-one-query-converted'){
                                            $background = 'background: orange;color:#FFF;';
                                            }
                                            else if($companies->enquiry_status === 'query-received-but-not-converted'){
                                            $background = 'background: #0f4aff;color:#FFF;';
                                            }
                                            else{
                                            $background = 'background:#bdbdbd;color:#FFF;';
                                        }
                                    ?>
                                    <tr class="odd gradeX" style="">
                                            <td class="center"><?= $i++ ?></td>
                                            <td class="center"><?= ucwords(strtolower($companies->name)); ?>
                                            </td>
                                            <!-- <td class="center" id="totalRowsCell"
                                                data-ids="<?= $companies->company; ?>">
                                                <?= $companies->totalRows ?>
                                            </td> -->
                                            <td class="center">
                                                <a class="btn" href="<?php echo base_url() . $companies->company; ?>/all-company-data"
                                                    style="padding: 3px 10px;<?= $background?>;" title="View"><?= $companies->totalRows ?></a>
                                            </td>
                                            <td class="center"><?= $companies->contact_person ?></td>
                                            <td class="center"><?= $companies->contact_person_number ?></td>
                                            <td class="center"><?= $companies->email ?></td>
                                            <td class="center">
                                                <?= ucwords(strtolower($companies->designation)); ?>
                                            </td>
                                            <td class="center"> 
                                               <?php 
                                               echo isset($companies->pincode) && $companies->pincode !== '' 
                                                   ? ucwords(strtolower($companies->pincode)) 
                                                   : '-'; 
                                               ?>
                                           </td>
                                            <td class="center"><?= ucwords(strtolower($companies->city)); ?>
                                            </td>
                                            <td class="center"><?= ucwords(strtolower($companies->state)); ?>
                                            </td>
                                            <td class="center"><?= ucwords(strtolower($companies->country)); ?>
                                            </td>
                                            <?php
                                                $this->db->select('name');
                                                $this->db->from('admin');
                                                $this->db->where('id',$companies->sales_admin_id);
                                                $query = $this->db->get();
                                                $sales_person = $query->result();
                                            ?>
                                            <td class="center">
                                                <?php 
                                                echo isset($sales_person[0]->name) && !empty($sales_person[0]->name) 
                                                    ? ucwords(strtolower($sales_person[0]->name)) 
                                                    : '-'; 
                                                ?>
                                            </td>
                                            <td class="center">
                                                <?= ucwords(strtolower(htmlentities($companies->acquiring_source))); ?>
                                            </td>
                                            <td class="center"> 
                                                <?php 
                                                echo isset($companies->exhibition_source) && $companies->exhibition_source !== '' 
                                                    ? ucwords(strtolower($companies->exhibition_source)) 
                                                    : '-'; 
                                                ?>
                                            </td>
                                            <td class="center"> 
                                                <?php 
                                                echo isset($companies->remark) && $companies->remark !== '' 
                                                    ? ucwords(strtolower($companies->remark)) 
                                                    : '-'; 
                                                ?>
                                            </td>
                                            <td class="center">
                                                <?php $d = strtotime($companies->company_creation_date);
                                                echo date('d-M-Y', $d); ?>
                                            </td>
                                            
                                            <td class="center">
                                                <?php 
                                                $this->db->select('status');
                                                $this->db->from('company');
                                                $this->db->where('company_id',$companies->company);
                                                $query = $this->db->get();
                                                $company_status = $query->result();
                                                print_r(ucfirst($company_status[0]->status)); ?>
                                            </td>

                                            <td class="center remove"><img class="img-width"
                                                src="<?= base_url('assets/company/') . $companies->company_logo; ?>"
                                                alt=""></td>

                                            <td class="center" style="display:inline-flex;">
                                                <?php if ($this->session->userdata('type') == 1 || in_array($this->session->userdata('email'), ['uz.backoffice@kazindmc.com','bo.geo@kazindmc.com'])) { ?>
                                                    <a href="<?php echo base_url() . $companies->company_id; ?>/edit-client-logo"
                                                        class="btn btn-tbl-edit btn-xs" title="Edit Logo"
                                                        style="background-color: #FFF;"><i class="fa fa-image"
                                                            style="color:#000;"></i></a>

                                                    <a href="<?php echo base_url() . $companies->company; ?>/edit-company"
                                                        class="btn btn-tbl-edit btn-xs" title="Edit"><i
                                                            class="fa fa-edit"></i></a>

                                                <?php } else if ($companies->user_id == $this->session->userdata('id')) { ?>

                                                        <a href="<?php echo base_url() . $companies->company_id; ?>/edit-client-logo"
                                                            class="btn btn-tbl-edit btn-xs" title="Edit Logo"
                                                            style="background-color: #FFF;"><i class="fa fa-image"
                                                                style="color:#000;"></i></a>

                                                        <a href="<?php echo base_url() . $companies->company; ?>/edit-company"
                                                            class="btn btn-tbl-edit btn-xs" title="Edit"><i
                                                                class="fa fa-edit"></i></a>

                                                <?php } ?>
                                                <?php //if ($this->session->userdata('type') == 1) { ?>
                                                    <!--a href="<?php //echo base_url() . $companies->company_id ?>/delete-client"
                                                        onclick="return confirm('Are you sure you want to delete this ?');"
                                                        class="btn btn-tbl-delete btn-xs" title="Delete">
                                                        <i class="fa fa-trash-o "></i>
                                                    </a-->
                                                <?php //} ?>
                                            </td>
                                            <td class="center"></td>
                                        </tr>
                                    <?php }
                                } ?>
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
</div>
<script>
    // Exhibiton source dropdown
    $(document).ready(function () {
        function get_exhibition_source(selectedValue) {
            if(selectedValue === 'exhibition'){
                $('.Exhibition').show();
                $('.road_show').hide();
                $('.sales_team').hide();
                $('.referral-remark').hide();
            } else if(selectedValue === 'referral'){
                $('.referral-remark').show();
                $('.sales_team').hide();
                $('.road_show').hide();
                $('.Exhibition').hide();
            } else if (selectedValue === 'sales visit(one-to-one meeting)') {
                $('.sales_team').show();
                $('.referral-remark').hide();
                $('.road_show').hide();
                $('.Exhibition').hide();
            } else if (selectedValue === 'road show') {
                $('.sales_team').hide();
                $('.road_show').show();
                $('.referral-remark').hide();
                $('.Exhibition').hide();
            } else{
                $('.sales_team').hide();
                $('.referral-remark').hide();
                $('.road_show').hide();
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
    
    var url = new URL(window.location.href);
    $(document).ready(function () {
        $('#client_data').DataTable({
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
            order: [[0, 'asc']]
        });
        $("#company").autocomplete({
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
                $('#company').val(ui.item.label); // display the selected text
                $('#company_id').val(ui.item.company_id); // save selected id to input
                get_agents();
            }
        });
        
        if (url.searchParams.has('company_id')) {
            get_agents();                
        }
        
        function get_agents() {
            if ($("#company_id").val() === "") {
                $("#agent").empty();
                return false;
            }
            var id = $('#company_id').val();

            $.ajax({
                type: "POST",
                url: '<?= base_url(); ?>get-agent-ajax/' + id,
                dataType: 'json',
                success: function (response) {
                    responseData = response.details; // Store the response data
                    console.log(responseData)
                    $("#agent").empty().parent().addClass("is-dirty");
                    $('#agent').append('<option value="">Select..</option>');
                    $.each(response.details, function (i, agent) {
                        $('#agent').append('<option value="' + agent.contact_person +
                            '">' + agent
                                .contact_person + '</option>');
                    });
                },
                complete:function(){ 
                    $('#agent').val(url.searchParams.get('agent')); 
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error("Error fetching agents:", errorThrown);
                }
            });
        }

        $("#country").autocomplete({
            source: function (request, response) {
                // Fetch data
                $.ajax({
                    url: "<?= base_url() ?>admin/company/get_country_ajax",
                    type: 'post',
                    dataType: "json",
                    data: {
                        search: extractLast(request.term),
                    },
                    success: function (data) {

                        response(data);
                    }
                });
            },
            select: function (event, ui) {
                var terms = split(this.value);
                // remove the current input
                terms.pop();
                // add the selected item
                terms.push(ui.item.label);
                // add placeholder to get the comma-and-space at the end
                terms.push("");
                this.value = terms.join(", ");
                if (terms.length > 2) {
                    $("#state").val("").attr('disabled', 'disabled');
                } else {
                    $("#state").removeAttr('disabled');
                    $('#country_id').val(ui.item.country_id); 
                }
                return false;
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
                var country_id = $('#country_id').val();
                if (!country_id) {
                alert("Please select country");
                $('#state').val('');
                $('#state_id').val('');
                return; 
                }
                // Fetch data
                $.ajax({
                    url: "<?= base_url() ?>admin/company/get_state_ajax",
                    type: 'post',
                    dataType: "json",
                    data: {
                        search: extractLast(request.term),
                        country_id: $('#country_id').val()
                    },
                    success: function (data) {

                        response(data);
                    }
                });
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
                    $("#city").val("").attr('disabled', 'disabled');
                } else {
                    $("#city").removeAttr('disabled');
                    $('#state_id').val(ui.item.state_id);
                }
                return false;

                //$('#state').val(ui.item.label); // display the selected text
                //$('#state_id').val(ui.item.state_id); // save selected id to input
                //return false;
            }
        });

        $("#city").autocomplete({
            source: function (request, response) {
                var state_id = $('#state').val();
                if (!state_id) {
                    alert("Please select state");
                    $('#city').val('');
                    return; 
                }
                // Fetch data
                $.ajax({
                    url: "<?= base_url() ?>admin/company/get_city_ajax",
                    type: 'post',
                    dataType: "json",
                    data: {
                        search: extractLast(request.term),
                        state_id: $('#state_id').val()
                    },
                    success: function (data) {
                        response(data);
                    }
                });
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
                return false;

                //$('#city').val(ui.item.label); // display the selected text
                //$('#company_id').val(ui.item.company_id); // save selected id to input
                //return false;
            }
        });
        
        $("#enquiry_status").trigger("change");
        $('.js-example-basic-multiple').select2({
            //theme: 'filled',
            placeholder: 'Select',
        });
        $("#year").on("change",function(){
            if($(this).val().length > 1){
                $("#months").val("all").select2();
                $("#months").attr("disabled","disabled");
            }else{ $("#months").removeAttr("disabled"); }
            if($(this).val()!=""){
                $("#months").val("all").select2();
            }else{ $("#months").val("").select2(); }
        });
        $("#months").on("change",function(){
            var m = $(this).val();
            if(m.indexOf("all") !== -1){
                $("#months").val("all").select2();
            }
        });	

         $(".dt-search").on("change", function() {
            var idx = $(this).index(".dt-search");
            const selectedDate = new Date($(".dt-search").eq(idx).val());
            //const lastDayDate = new Date(selectedDate.getFullYear(), selectedDate.getMonth() + 1, 0);
            const options = {
                year: 'numeric',
                month: 'short',
                day: '2-digit'
            };
            const formattedDate = selectedDate.toLocaleDateString('en-IN', options);
            $(".dt-search-show").eq(idx).val(formattedDate).parent().addClass('is-focused');

            if ($(this).attr("id") === "date_from" && $("#date_to").val() === "") {
                $("#date_to").attr("min", $(this).val());
            } else if ($(this).attr("id") === "date_from" && $("#date_to").val() !== "") {
                const selectedToDate = new Date($("#date_to").val());
                if (parseInt(selectedToDate.getTime()) < parseInt(selectedDate.getTime())) {
                    $("#date_to").val('').attr("min", $(this).val());
                    $(".dt-search-show").eq($("#date_to").index(".dt-search")).val('');
                }
            }
            if ($(this).attr("id") === "date_to" && $("#date_from").val() === "") {
                $("#date_from").attr("max", $(this).val());
            } else if ($(this).attr("id") === "date_to" && $("#date_from").val() !== "") {
                const selectedFromDate = new Date($("#date_from").val());
                if (parseInt(selectedFromDate.getTime()) > parseInt(selectedDate.getTime())) {
                    $("#date_from").val('').attr("max", $(this).val());
                    $(".dt-search-show").eq($("#date_from").index(".dt-search")).val('');
                }
            }

        });
    });
</script>