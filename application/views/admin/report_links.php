<style>
    .active_link{        
        background: #FFF;
        color: #000;
        border-bottom: 5px solid #fb0404;
    }
    .icon-and-text-button-demo {
        margin-left: 140px;
        padding: 10px;
    }
</style>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="icon-and-text-button-demo">
            <!--<a href="get-arrivals-report" class="btn btn-success waves-effect">-->
            <!--    <i class="material-icons">people_outline</i><br>-->
            <!--    <span>Arrivals Report</span>-->
            <!--</a>-->
            <?php $links_arr = ['vendor-report','transportation-report','restaurant-report','restaurant-menu-report']; 
            
            if(in_array($this->uri->segment(1),$links_arr)){ ?>
            
            <a href="vendor-report" class="m-2 btn <?php echo ($this->uri->segment(1) == 'vendor-report')?'active_link':'btn-dark waves-effect'; ?>">
                <i class="material-icons">content_paste</i><br>
                <span>Hotel Report</span>
            </a>
            
            <a href="transportation-report" class="m-2 btn <?php echo ($this->uri->segment(1) == 'transportation-report')?'active_link':'btn-primary waves-effect'; ?>">
                <i class="material-icons">content_paste</i><br>
                <span class="">Transportation Report</span>
            </a>
            <a href="restaurant-report" class="m-2 btn <?php echo ($this->uri->segment(1) == 'restaurant-report')?'active_link':'btn-warning waves-effect'; ?>">
                <i class="material-icons">content_paste</i><br>
                <span>Restaurant Report</span>
            </a>
            
            <a href="restaurant-menu-report" class="m-2 btn <?php echo ($this->uri->segment(1) == 'restaurant-menu-report')?'active_link':'btn-info waves-effect'; ?>">
                <i class="material-icons">content_paste</i><br>
                <span>Restaurant Menu Report</span>
            </a>
            
            <!-- <span style="padding: 20px 0px;border: 2px solid #000;margin: 10px;"></span> -->
            
            <!-- <a href="itinerary-report" class="btn btn-primary waves-effect">
                <i class="material-icons">content_paste</i><br>
                <span>All Reports</span>
            </a> -->
            
            <?php }
            else{
            ?>
            <a href="itinerary-report" class="btn <?php echo ($this->uri->segment(1) == 'itinerary-report')?'active_link':'btn-dark waves-effect'; ?>">
                <i class="material-icons">content_paste</i><br>
                <span>Itinerary Reports</span>
            </a>
            <?php if($this->session->userdata('type')==1 || $this->session->userdata('admin_type')=='accounts_admin'){ ?>
            <!--a href="monitoring-report" class="btn btn-primary waves-effect">
                <i class="material-icons">content_paste</i><br>
                <span>Monetary Reports</span>
            </a-->       
            
            <a href="revenue-report" class="btn <?php echo ($this->uri->segment(1) == 'revenue-report')?'active_link':'btn-success waves-effect'; ?>">
                <i class="material-icons">content_paste</i><br>
                <span>Sales Report</span>
            </a>
            <a href="enquiry-report" class="btn <?php echo ($this->uri->segment(1) == 'enquiry-report')?'active_link':'btn-info waves-effect'; ?>">
                <i class="material-icons">content_paste</i><br>
                <span>Query Report</span>
            </a>
            
            <a href="database-report" class="btn <?php echo ($this->uri->segment(1) == 'database-report')?'active_link':'btn-primary waves-effect'; ?>">
                <i class="material-icons">content_paste</i><br>
                <span>Database Report</span>
            </a>

            <a href="agents-report" class="btn <?php echo ($this->uri->segment(1) == 'agents-report')?'active_link':'btn-warning waves-effect'; ?>">
                <i class="material-icons">content_paste</i><br>
                <span>Agent Report</span>
            </a>
            
            <a href="staff-report" class="btn <?php echo ($this->uri->segment(1) == 'staff-report')?'active_link':'btn-danger waves-effect'; ?>">
                <i class="material-icons">content_paste</i><br>
                <span>Staff Report</span>
            </a>
			<a href="comparisons" class="btn <?php echo ($this->uri->segment(1) == 'comparisons')?'active_link':'cyan-bgcolor waves-effect text-white'; ?>">
                <i class="material-icons">content_paste</i><br>
                <span>Comparison Report</span>
            </a>
            <span style="padding: 20px 0px;border: 2px solid #000;margin: 10px;"></span>
            <a href="vendor-all-reports" class="btn <?php echo ($this->uri->segment(1) == 'vendor-all-reports')?'active_link':'btn-info waves-effect'; ?>">
                <i class="material-icons">content_paste</i><br>
                <span>Vendor Report</span>
            </a>
            
            <?php }} ?> 
        </div>
    </div>
</div>