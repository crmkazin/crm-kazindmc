<?php include('admin_head_css.php'); ?> 
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="page-content-wrapper">
                <div class="page-bar">
                <div class="row page-titles">
                    <div class="col-lg-3 col-sm-6  col-6 align-self-center">
                        <h4 class="text-themecolor">Masters</h4>
                    </div>
                    <div class="col-lg-4 only-for-dashbord">
                    </div>
                    <div class="col-lg-5 col-sm-6 col-6 align-self-center text-end">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb justify-content-end">
                                <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Home</a></li>
                                <li class="breadcrumb-item active">Masters</li>
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
                                    <div class="col-lg-3">
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

                                    <!-- State Field -->
                                    <!-- <div class="col-lg-3 p-t-20">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <?php //echo form_input([
                                                // 'name' => 'state', 
                                                // 'id' => 'states', 
                                                // 'placeholder' => 'State', 
                                                // 'class' => 'mdl-textfield__input',
                                                // 'value' => //$this->input->get('state')
                                            //]); ?>
                                            <label class="mdl-textfield__label">State</label>
                                        </div>
                                    </div>
                                    <input type="hidden" name="state_id" id="state_id"> -->

                                    <!-- City Field -->
                                    <div class="col-lg-3">
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

                                    <!-- Submit -->
                                    <div class="col-lg-3 mt-2">
                                        <?php echo form_submit([
                                            'name' => 'submit', 
                                            'id' => 'submit', 
                                            'class' => 'btn btn-md btn-primary m-t-20', 
                                            'style' => 'float:left;', 
                                            'value' => 'Search'
                                        ]); ?>
                                        <a href="<?=base_url();?>itinerary-masters-create-restaurants" class="btn btn-info ms-3 m-t-20" style="padding:8px;" title="Create Masters"><i class="fa fa-plus"></i></a>

                                    </div>
                                </div>
                                </form>
                             
                                <div class="card-body">
                                    <div class="table-scrollable">
                                    <table class="table table-hover table-striped border table-checkable order-column full-width" id="restaurants-list">
                                        <thead>
                                            <tr>
                                                <th class="center">Sr.No</th>
                                                <th class="center">Name</th>   
                                                <th class="center">Contact Number</th>                                                   
                                                <th class="center">Cuisines</th>
                                                <th class="center">Timing</th>
                                                <th class="center">Seating Capacity</th>
                                                <th class="center">City</th>
                                                <th class="center">Country</th>
                                                <th class="center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            //echo '<pre>';print_r($company); print_r($this->session->userdata); die;
                                            $i=1;
                                            if(!empty($result)) {
                                            foreach($result as $companies) {
                                            ?>
                                                <tr class="odd gradeX">
                                                    <td class="center"><?=$i++?></td>
                                                        <td class="center"><?php echo $companies->name; ?></td> 
                                                        <td class="center"><?php echo $companies->contact_number; ?></td>                                                         
                                                        <td class="center"><?= strtoupper($companies->cuisine)?></td>
                                                        <?php
                                                        if (!empty($companies->opening_time) && !empty($companies->closing_time)) {?>
                                                            <td class="center"><?= $companies->opening_time . ' to ' . $companies->closing_time ?></td>
                                                        <?php } else { ?>         
                                                        <td class="center">-</td>
                                                        <?php } ?>
                                                        <td class="center"><?= strtoupper($companies->seating_capacity)?></td>
                                                        <td class="center"><?=ucwords(strtolower($companies->city)); ?></td>
                                                        <td class="center"><?=ucwords(strtolower($companies->country)); ?></td>

                                                        <td class="center">
                                                            <a href="<?php echo base_url('edit_restaurants_masters?id='.base64_encode($companies->id)); ?>" class="btn btn-tbl-edit btn-xs" title="Edit"><i class="fa fa-edit"></i></a>

                                                        <?php if($this->session->userdata('type') == 1){?>  
                                                            <a href="<?=base_url('delete-restaurants-masters?id='.base64_encode($companies->id))?>"  onclick="return confirm('Are you sure you want to delete this ?');" class="btn btn-tbl-delete btn-xs" title="Delete"> 
                                                        <i class="fas fa-trash"></i> </a>													
                                                        <?php }?>
                                                        </td>
                                                </tr>
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
    </div>

<script>
    $('#export_to_excel').click(function () {
        $("#restaurants-list").table2excel({
            filename: "data.xls"
        });
    });
    
    $(document).ready(function() {
        var table = $('#restaurants-list').DataTable({
            responsive: true
            //"scrollY": "200px",
            //"paging": false
        });
        
        table.columns.adjust().draw( false );
        $('.mdl-textfield__input').on( 'click', function (e) {
            // Get the column API object
            var column = table.column( $(this).attr('data-column') );
            // Toggle the visibility
            column.visible( ! column.visible() );
            table.columns.adjust().draw( false );
            $('.view_all').prop("checked",false);
            $(".dataTables_info").parent().parent('div').show();
        });
        
        $(".view_all").on('click',function(){
            if($(this).prop("checked") === true){
                $('.mdl-textfield__input').prop('checked',true);
                table.columns( '.center' ).visible( true );
                $(".dataTables_info").parent().parent('div').show();
            }else{
                $('.mdl-textfield__input').prop("checked",false);
                table.columns( '.center' ).visible( false );
                $(".dataTables_info").parent().parent('div').hide();
            }
        });
        
        var allowedCountryIds = [15, 20, 81, 112, 11, 234];
        var country_flag = false;
        $("#countrys").autocomplete({
            source: function (request, response) {
                $.ajax({
                    url: "<?= base_url('admin/masters/get_specific_country_ajax') ?>",
                    type: 'post',
                    dataType: "json",
                    data: { search: request.term,
                        allowed_ids: allowedCountryIds.join(','),
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
    });
    
</script>
