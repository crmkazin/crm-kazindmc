<?php include('admin_head_css.php');?> 
<style>
.disabled-link {
  pointer-events: none; 
  opacity: 0.5;
  cursor: not-allowed;
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
                        <h4 class="text-themecolor">All Hotels</h4>
                        </div>
                        <div class="col-lg-2 only-for-dashbord">
                        </div>
                        <div class="col-lg-7 col-sm-6 col-6 align-self-center text-end">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb justify-content-end">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Home</a></li><li class="breadcrumb-item active">All Hotels</li>
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
                                <form method="get" autocomplete="off" class="content">
                                    <div class="card-body row">
                                        <!-- Country Field -->
                                        <div class="col-lg-2">
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <label class="mdl-textfield__label">Select Country</label>
                                                <?php echo form_input([
                                                    'name' => 'country', 
                                                    'id' => 'countrys', 
                                                    'placeholder' => 'Country', 
                                                    'class' => 'mdl-textfield__input bg-white',
                                                    'value' => $this->input->get('country')
                                                ]); ?>
                                            </div>
                                        </div>
                                        <input type="hidden" name="country_id" id="country_id">

                                        <!-- City Field -->
                                        <div class="col-lg-2">
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <label class="mdl-textfield__label">City</label>
                                                <?php echo form_input([
                                                    'name' => 'city', 
                                                    'id' => 'citys', 
                                                    'placeholder' => 'City', 
                                                    'class' => 'mdl-textfield__input bg-white',
                                                    'value' => $this->input->get('city')
                                                ]); ?>
                                            </div>
                                        </div>

                                    <div class="col-lg-2">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <label class="mdl-textfield__label">Hotel</label>
                                           <?php echo form_input([
                                                'name' => 'hotel',
                                                'id' => 'hotels',
                                                'placeholder' => 'Hotel',
                                                'class' => 'mdl-textfield__input bg-white',
                                                'value' => $this->input->get('hotel')
                                            ]); ?>
                                        </div>
                                    </div>

                                        <!-- Submit -->
                                        <div class="col-lg-6 mt-4">
                                            <?php echo form_submit([
                                                'name' => 'submit', 
                                                'id' => 'submit', 
                                                'class' => 'btn btn-md btn-info', 
                                                'style' => 'float:left;', 
                                                'value' => 'Search'
                                            ]); ?>
                                             <?php if (in_array($this->session->userdata('type'), ['1']) || in_array($this->session->userdata('email'), ['geo.ops1@kazindmc.com','bo.geo@kazindmc.com'])) { ?>
                                            
                                            <a href="add-hotel" class="btn btn-info ms-2" style="padding: 8px;"><i class="fa fa-plus"></i>New</a>
                                            <a id="export_to_excel" class="btn btn-info ms-2" style="padding:8px;"><i class="fa fa-download"></i></a>
	                                    
                                        <?php } ?>
                                        </div>
                                    </div>
                                </form>
                                <!-- <div class="card-head"> -->
                                    <!-- <header>All Hotels</header> -->
                                    <!-- <div class="tools">
                                       
                                        <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                                    </div>
                                </div> -->
                                <div class="card-body">
                                    <div class="table-scrollable">
                                    <table class="table table-hover table-striped border table-checkable order-column full-width" id="hotel_list">
                                        <thead>
                                            <tr>
                                                <th class="center">Sr.No</th>
                                                <th class="center">Name</th>
                                                <th class="center">Address1</th>
                                                <!--<th class="center">Address2</th>-->
                                                <th class="center">City</th>
                                                <!--<th class="center">State</th>-->
                                                <th class="center">Country</th>
                                                <th class="center">Email</th>
                                                
                                                <th class="center">Telephone</th>
                                                <th class="center">Contact Person</th>
                                                <th class="center">Remark</th>
                                                <th class="center n_exl">Image</th>
                                                <th class="center n_exl">Category</th>
                                                <th class="center n_exl">Action</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i=1;
                                            $super_admins = ['rohit@kazindmc.com','pankaj@thavertech.com'];
                                            if(!empty($hotels)) {
                                            foreach($hotels as $hotel) {

                                            ?>
                                            <form method="post">
                                                <tr class="odd gradeX">
                                                    <td class="center"><?=$i++?></td>
                                                    <td class="center"><?=$hotel->name?></td>
                                                    <td class="center"><?=$hotel->address_1?></td>
                                                    <!--<td class="center"><?=$hotel->address_2?></td>-->
                                                    <td class="center"><?=$hotel->city?></td>  
                                                    <!--<td class="center"><?=$hotel->state?></td>  -->
                                                    <td class="center"><?=$hotel->country?></td>  
                                                    <td class="center"><?=$hotel->email?></td>  
                                                  
                                                    <td class="center"><?=$hotel->isd_codes?>&nbsp;<?=$hotel->mobile?></td>  
                                                    <td class="center"><?=$hotel->contact_person_name?></td>  
                                                    <td class="center"><?=$hotel->remarks?></td>
                                                    <td class="center noExl">
                                                        <?php if($hotel->image <> ''){ ?>
                                                        <img src="<?php echo base_url('uploads/hotels/'.$hotel->image); ?>" width="75" height="75">
                                                        <?php } ?>
                                                    </td>
                                                    <td style="text-align:center;" class="noExl"><a href="<?php echo base_url('room-category-hotel?hotel_id='.base64_encode($hotel->id)); ?>" class="" title="Add Room Category"><i class="fa fa-sitemap" aria-hidden="true"></i></a></td>
                                                    <td class="center noExl" style="text-align:center;display:flex;">
                                                        <a href="<?php echo base_url('edit-hotel?id='.base64_encode($hotel->id)); ?>" class="btn btn-tbl-edit btn-xs" title="Edit"><i class="fa fa-edit"></i></a> 
                                                         <?php if ($this->session->userdata('admin_type') != 'superadmin') { ?>
                                                             <a href="#" class="btn btn-tbl-delete btn-xs disabled-link" title="Delete (Not allowed)">
                                                                    <i class="fas fa-trash"></i>
                                                                </a>
                                                           <?php }else{ ?>
                                                             <a href="<?php echo base_url('delete-hotel?id='.base64_encode($hotel->id)); ?>" onclick="return confirm('Are you sure you want to delete this Hotel?');" class="btn btn-tbl-delete btn-xs" title="Delete"><i class="fas fa-trash"></i></a>
                                                           <?php } ?>
                                                    </td>
                                                    
                                                    <td></td>
                                                </tr>
                                            </form>	
                                            <?php } }?>	
                                            </tbody>
                                    </table>
                                    </div>
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
    <script>
    $(document).ready(function() {
        var table = $('#hotel_list').DataTable({
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

        
        $("#export_to_excel").on("click",function(){
            var clone = $('#hotel_list thead').clone();            
            clone.find(".n_exl").remove();
            $('<table>').append(clone).append($('#hotel_list').DataTable().$('tr').clone()).table2excel({
                sheetName: 'Hotels List',
                filename: ("Hotels_List_" + new Date().toLocaleDateString('en-IN',{year: 'numeric',month: 'short',day: '2-digit'})).replace(/[\ \.]/g, "_"),
                fileext: ".xls",
                exclude: ".noExl",
                exclude_img: true,
                exclude_links: true,
                exclude_inputs: true,
                preserveColors: true
            });
        });

        var allowedCountryIds = [15, 20, 81, 112, 11, 234];
        var country_flag = false;

        $("#countrys").autocomplete({
            source: function (request, response) {
                $.ajax({
                    url: "<?= base_url('admin/masters/get_specific_country_ajax') ?>",
                    type: 'post',
                    dataType: "json",
                    data: {
                        search: request.term,
                        allowed_ids: allowedCountryIds.join(',')
                    },
                    success: function (data) {
                        response(data);
                    }
                });
                country_flag = false;
            },
            select: function (event, ui) {
                $('#countrys').val(ui.item.label);
                $('#country_id').val(ui.item.country_id);
                country_flag = true;
                return false;
            }
        }).blur(function () {
            if (!country_flag) $("#countrys").val("");
        });

        var city_flag = false;
        $("#citys").autocomplete({
            source: function (request, response) {
                $.ajax({
                    url: "<?= base_url('admin/masters/get_city_ajax') ?>",
                    type: 'post',
                    dataType: "json",
                    data: {
                        search: request.term,
                        state_id: $('#state_id').val()
                    },
                    success: function (data) {
                        response(data);
                    }
                });
                city_flag = false;
            },
            select: function (event, ui) {
                $('#citys').val(ui.item.label);
                city_flag = true;
                return false;
            }
        }).blur(function () {
            if (!city_flag) $("#citys").val("");
        });

        var hotel_flag = false;
        $("#hotels").autocomplete({
            source: function (request, response) {
                $.ajax({
                    url: "<?= base_url('admin/masters/get_hotel_ajax') ?>",
                    type: 'POST',
                    dataType: "json",
                    data: { search: request.term },
                    success: function (data) {
                        response(data);
                    }
                });
                hotel_flag = false;
            },
            select: function (event, ui) {
                $('#hotels').val(ui.item.label);
                hotel_flag = true;
                return false;
            }
        }).blur(function () {
            if (!hotel_flag) $("#hotels").val("");
        });

        
    });
</script>	