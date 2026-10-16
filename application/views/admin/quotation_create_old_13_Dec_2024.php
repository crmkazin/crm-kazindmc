<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Quotation Creation</title>
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Maven+Pro:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/admin/print/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>assets/admin/print/css/style.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="<?=base_url();?>assets/images/favicon.ico" sizes="32x32" />
    <script src="<?php echo base_url(); ?>assets/admin/print/js/bootstrap.js"></script>
    <style>
    .bg-light-back {
        background-color: #ebebeb !important
    }

    .remove-border {
        background-color: #bfbfbf !important
    }
	.fadetbl { background-color:#eef0f3 !important;font-size: 17px;font-weight: bold; }

    @media print {
        html {
            -webkit-print-color-adjust: exact;
        }

        .print-data {
            page-break-after: always;
        }

        .noPrint {
            display: none;
        }
    }
    </style>
</head>

<body>
    <div class="container" id="">
       
        <div class="row" style="margin:0 0px ">
            <div class="col-lg-12">
                <div class="print-head">Quotation Creation</div>
            </div>

            <?php if(!empty($itinerary)){ 			
			?>
            <div class="col-lg-12 head-space">
                <div class="in-pl">
                    <div class="print-sub-head">Suggessted Itinerary:</div>
                </div>
            </div>
            <div class="col-md-12 mt-2">
                <div class="in-pl">
                    <?php 
                $i = 0;
				$sr = 0;
                $itinerary_date = $itinerary[0];
                
                if($this->input->post('transportations') <> ''){
                    $where = 'transportation_costs.transport_id = '.$this->input->post('transportations');
                    $transportation_cost = $this->common_model->get_data('transportation_costs','', '', 'transportation_costs.*',$where, '', $count = false);
                    //echo '<pre>';print_R($transportation_cost);

                    if(!empty($transportation_cost)){
                        foreach($transportation_cost AS $list){
                            $type = str_replace('-','_',$list->type); 
                            $$type = $list->price;
                            if($list->type == 'halfday'){
                                $half_day_starttime = $list->start_time;
                                $half_day_endtime = $list->end_time;
                            }else if($list->type == 'full-day'){
                                $full_day_starttime = $list->start_time;
                                $full_day_endtime = $list->end_time;
                            }else if($list->type == 'extended-day'){
                                $extended_day_starttime = $list->start_time;
                                $extended_day_endtime = $list->end_time;
                            }
                        }
                    }
                }
                $location_ids = [];
                foreach($itinerary AS $list){					
					$transportation = $transportation_flag = '';
					if($list->sites_id <> 0){
						//foreach($this->input->post('transportations') AS $trans){
                        if($this->input->post('transportations')<>''){
                            $where = 'sites.id = '.$list->sites_id.' AND sites.category = "sitescene" AND outsidecity_transportation_costs.transport_id = '.$this->input->post('transportations');
                            $join = [['type' => '', 'join_table' => 'outsidecity_transportation_costs', 'condition' => 'outsidecity_transportation_costs.location_ids = sites.location_ids'],
                                    ['type' => '', 'join_table' => 'transportation', 'condition' => 'transportation.id = outsidecity_transportation_costs.transport_id'],];
                            $select = 'outsidecity_transportation_costs.*,transportation.vehicle_name,sites.location_ids';
                            $transportation_result = $this->common_model->get_data('sites','', '', $select,$where, '', $count = false,$join);
                            if(!empty($transportation_result)){
                                $transportation_flag = 1;
                                if(!in_array($transportation_result[0]->location_ids,$location_ids)){
                                    $location_ids[] = $transportation_result[0]->location_ids;
                                    $transportation = '<strong>'.$transportation_result[0]->vehicle_name.'</strong><br>';
                                    $transportation .= '<li>Price: '.$transportation_result[0]->price.'</li>';
                                    $transportation .= '<li>Toll: '.$transportation_result[0]->toll_price.'</li>';
                                    $transportation .= '<li>Parking: '.$transportation_result[0]->parking_price.'</li>';
                                }
                            }
                        }
						//}
                        
					}
                    if($i==0 || $itinerary_date != $list->date){
                        
                    ?>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th colspan="4" class="bg-info">
                                    <strong class="ms-3 text-white">Day: <?php echo ++$sr; //echo date('d M Y (l)',strtotime($list->date)); ?></strong>
                                </th>
                            </tr>
                            <tr>
                                <th class="fadetbl" width="10%">
                                    <p class="text-black">Time</p>
                                </th>
                                <th class="fadetbl" width="50%">
                                    <p class="text-black">Activities</p>
                                </th>
                                <th class="fadetbl" width="25%">
                                    <p class="text-black">Remark</p>
                                </th>
								<th class="fadetbl" width="25%">
                                    <p class="text-black">Transportation Cost</p>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php } ?>

                            <tr>

                                <td class="bg-white"><?php echo $list->time;  ?> Hrs</td>
                                <td class="bg-white">
                                    <?php echo urldecode($list->title).' '.urldecode($list->content); ?></td>
                                <td class="bg-white"><?php echo urldecode($list->remarks); ?></td>
								<td class="bg-white"><ol>
                                    <?php 
                                        if($i == 0 && isset($airport_transfer_in)){
                                            echo $airport_transfer_in.'<br>(Airport Transfer In)';
                                        }else if($i == count($itinerary)-1 && isset($airport_transfer_out)){
                                            echo $airport_transfer_out.'<br>(Airport Transfer Out)';
                                        }else{
                                            echo $transportation;
                                        }
                                    ?>
                                    </ol>
                                </td>
                            </tr>

                            <?php 
                                $itinerary_date = $list->date;
                                if(!array_key_exists($i+1,$itinerary) || $itinerary_date != $itinerary[$i+1]->date){
                                    if($transportation_flag == '1' && isset($full_day_endtime) && str_replace(':','',$list->time) > (str_replace(':','',$full_day_endtime)+130)){
                                        echo '<tr><td colspan="4" style="text-align: right;">Extended Day: '.$extended_day.'</td></tr>'; 
                                    }else if($transportation_flag == '1' && isset($full_day_endtime)){ 
                                        echo '<tr><td colspan="4" style="text-align: right;">Full Day: '.$full_day.'</td></tr>'; 
                                    }                                  
                                    $transportation_flag = '';
                                ?>
                                
                        </tbody>
                    </table>
                    <?php }$i++; }   ?>
                </div>
            </div>
            <?php }  ?>
    </div>
    
    <div class="row">
        <div class="in-pl">
            <div class="print-sub-head">Hotel Costing:</div>
        </div>
        <?php if(!empty($this->input->post('category_ids'))){ ?>
        <div class="col-md-12">
            <div class="row p-3 bg-info mb-2" style="color:#FFF;font-weight:600;">             
                <div class="col-md-4">Category</div>
                <div class="col-md-8" style="text-align:right;">Costing</div>
            </div>
            <?php 
            
            $nights = $sr-1;
            foreach($this->input->post('category_ids') AS $list){ 
                    $category = explode('_',$list);
                    if(array_key_exists($category[0].'_hotel_prices',$this->input->post())){
                        //echo '<pre>'; print_r(array_keys($this->input->post($category[0].'_hotel_prices')));
                    }
                    $total = 0;
            ?>
                <div class="row p-2 mb-3 bg-grey" style="line-height:1.2">             
                    <div class="col-md-8" style="font-weight:600;"><?php echo $category[1]; ?></div>
                    <div class="col-md-4" style="text-align:right;">
                        <ol>
                            <?php foreach($this->input->post($category[0].'_hotel_prices') AS $key=>$val){
                                        foreach($val AS $pr){
                                            $prices = explode(' ',$pr);
                            ?>
                                <li><?php echo $pr; ?> x <?=$nights ?>(Nights) = <label style="font-weight:600;"><?php echo $amt=$nights*$prices[1]; $total=$total+$amt; ?></label></li>
                            <?php } ?>
                            <li class="mb-2">Number Of Rooms: <?=$this->input->post($category[0].'_room_cnt')[$key]; $total = $total * $this->input->post($category[0].'_room_cnt')[$key]; ?></li>
                            <hr>
                            <?php } ?>
                            <li><span style="font-weight: 600;border-top: 1px solid #a19e9e;border-bottom: 1px solid #a19e9e;">Total : <?=$total?></li>
                        </ol>
                    </div>
                </div>
            <?php } ?>            
         </div> 
        <?php } ?>
    </div>
    
</body>

</html>