<style>
    .budget-summary-grid{
        display:grid;
        grid-template-columns:repeat(4,minmax(0,1fr));
        gap:18px;
        margin-top:20px
    }

    .budget-summary-card.arrivals::before{
        background:#7c3aed
    }

    .arrivals .summary-card-icon{
        background:#f0e9ff;
        color:#7c3aed
    }

    .summary-count-static{
        display:inline-block;
        margin-top:14px;
        padding:0;
        font-size:34px;
        font-weight:800;
        line-height:1;
        color:#182230
    }

    .summary-card-icon i{
        display:block;
        font-size:19px;
        line-height:1
    }

    @media(max-width:1200px){
        .budget-summary-grid{
            grid-template-columns:repeat(2,minmax(0,1fr))
        }
    }

    @media(max-width:768px){
        .budget-summary-grid{
            grid-template-columns:1fr
        }
    }

    .budget-date-container{
        position:relative;
        width:100%
    }

    .budget-date-display{
        width:100%;
        height:44px;
        padding-right:45px;
        background:#fff!important;
        color:#111!important;
        cursor:pointer!important
    }

    .budget-native-date{
        position:absolute;
        top:0;
        right:0;
        width:45px;
        height:44px;
        opacity:0;
        cursor:pointer;
        z-index:3
    }

    .budget-date-icon{
        position:absolute;
        top:0;
        right:0;
        width:45px;
        height:44px;
        display:flex;
        align-items:center;
        justify-content:center;
        color:#1974d2;
        background:#eef5ff;
        border-left:1px solid #dbe3ec;
        border-radius:0 8px 8px 0;
        pointer-events:none;
        z-index:2
    }

    .file-handler-info{
        display:flex;
        flex-direction:column;
        gap:3px;
        min-width:150px
    }

    .file-handler-info strong{
        color:#243447;
        font-size:13px;
        font-weight:700
    }

    .file-handler-info small{
        color:#8a97a5;
        font-size:11px
    }

    .handler-email{
        color:#1974d2;
        font-size:12px;
        font-weight:600;
        text-decoration:none
    }

    .handler-email:hover{
        color:#125da8;
        text-decoration:underline
    }

    .budget-tracking-page{padding-bottom:30px}
    .budget-filter-card{border:0;border-radius:14px;background:#fff;box-shadow:0 5px 22px rgba(15,23,42,.07);overflow:hidden}
    .budget-filter-header{display:flex;align-items:center;justify-content:space-between;padding:18px 22px;border-bottom:1px solid #edf0f3;background:linear-gradient(135deg,#f8fbff,#eef5fc)}
    .budget-filter-title{margin:0;color:#17324d;font-size:17px;font-weight:700}
    .budget-filter-subtitle{margin-top:4px;color:#718096;font-size:12px}
    .budget-filter-body{padding:20px 22px}
    .budget-filter-body .form-label{margin-bottom:7px;color:#475569;font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:.35px}
    .budget-filter-body .form-control,.budget-filter-body .form-select{height:44px;border:1px solid #dbe3ec;border-radius:9px;font-size:13px}
    .budget-filter-body .form-control:focus,.budget-filter-body .form-select:focus{border-color:#1974d2;box-shadow:0 0 0 3px rgba(25,116,210,.12)}
    .budget-filter-body .btn{height:44px;border-radius:9px;font-size:13px;font-weight:700}
    .budget-summary-grid{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:18px;margin-top:20px}
    .budget-summary-card{position:relative;padding:22px;border:0;border-radius:15px;background:#fff;box-shadow:0 5px 22px rgba(15,23,42,.08);overflow:hidden;transition:.2s ease}
    .budget-summary-card:hover{transform:translateY(-3px);box-shadow:0 10px 30px rgba(15,23,42,.13)}
    .budget-summary-card::before{content:"";position:absolute;top:0;left:0;width:5px;height:100%}
    .budget-summary-card.total::before{background:#1974d2}
    .budget-summary-card.final::before{background:#198754}
    .budget-summary-card.pending::before{background:#f0ad00}
    .summary-card-top{display:flex;align-items:center;justify-content:space-between;gap:14px}
    .summary-card-label{margin:0;color:#64748b;font-size:13px;font-weight:700;text-transform:uppercase;letter-spacing:.35px}
    .summary-card-icon{display:flex;align-items:center;justify-content:center;width:45px;height:45px;border-radius:12px;font-size:19px}
    .total .summary-card-icon{background:#e8f2ff;color:#1974d2}
    .final .summary-card-icon{background:#e3f7ea;color:#198754}
    .pending .summary-card-icon{background:#fff2c8;color:#b27b00}
    .summary-count-button{display:inline-block;margin-top:14px;padding:0;border:0;background:transparent;font-size:34px;font-weight:800;line-height:1;color:#182230;cursor:pointer}
    .summary-count-button:hover{color:#1974d2}
    .summary-card-note{display:block;margin-top:7px;color:#94a3b8;font-size:12px}
    .active-filter-box{display:flex;flex-wrap:wrap;align-items:center;gap:8px;margin-top:17px;padding-top:15px;border-top:1px dashed #dce4ec}
    .active-filter-label{color:#64748b;font-size:12px;font-weight:700}
    .active-filter-badge{display:inline-flex;align-items:center;padding:6px 10px;border-radius:20px;background:#eef5ff;color:#1765ae;font-size:11px;font-weight:700}
    /* @media(max-width:992px){.budget-summary-grid{grid-template-columns:1fr}} */

    #finalBudgetDetailsModal .modal-dialog{max-width:95%;margin:25px auto}
    #finalBudgetDetailsModal .modal-content{border:0;border-radius:14px;overflow:hidden;box-shadow:0 20px 60px rgba(0,0,0,.2)}
    #finalBudgetDetailsModal .modal-header{padding:18px 22px;background:linear-gradient(135deg,#163a5f,#1974d2);color:#fff;border:0;align-items:flex-start}
    #finalBudgetDetailsModal .modal-title{display:block;font-size:20px;font-weight:700}
    .final-budget-subtitle{display:block;margin-top:4px;font-size:13px;color:rgba(255,255,255,.8)}
    .final-budget-legend{display:flex;flex-wrap:wrap;gap:8px;margin-top:13px}
    .legend-item{display:inline-flex;align-items:center;gap:7px;padding:6px 11px;background:rgba(255,255,255,.13);border:1px solid rgba(255,255,255,.2);border-radius:20px;font-size:12px;font-weight:600}
    .legend-dot{width:9px;height:9px;border-radius:50%;display:inline-block}
    .legend-dot.saving{background:#43d17d}
    .legend-dot.exceeded{background:#ff7272}
    .legend-dot.equal{background:#ffc107}
    #finalBudgetDetailsModal .btn-close{filter:invert(1);opacity:1}
    #finalBudgetDetailsModal .modal-body{padding:20px;background:#f5f7fa}
    .final-budget-table-card{background:#fff;border:1px solid #e7ebf0;border-radius:12px;overflow:hidden}
    #final_budget_details_table{margin:0!important}
    #final_budget_details_table thead th{background:#edf3f9;color:#243447;font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:.3px;white-space:nowrap;border-color:#dfe6ed;vertical-align:middle}
    #final_budget_details_table tbody td{vertical-align:middle;font-size:13px;border-color:#edf0f3;padding:11px 10px}
    #final_budget_details_table tbody tr:hover{background:#f4f9ff}
    .enquiry-number{font-weight:700;color:#1974d2}
    .quote-badge{display:inline-flex;align-items:center;justify-content:center;min-width:72px;padding:7px 11px;border-radius:20px;background:#e8f2ff;color:#1261ad;font-size:12px;font-weight:700}
    .amount-value{font-weight:600;color:#263238;white-space:nowrap}
    .difference-box{display:inline-flex;flex-direction:column;align-items:flex-end;gap:3px}
    .difference-amount{display:inline-block;min-width:105px;padding:6px 10px;border-radius:6px;font-weight:700;text-align:center;white-space:nowrap}
    .difference-status{font-size:11px;font-weight:600}
    .difference-saving .difference-amount{background:#dff7e8;color:#13743b}
    .difference-saving .difference-status{color:#198754}
    .difference-exceeded .difference-amount{background:#ffe2e5;color:#b42332}
    .difference-exceeded .difference-status{color:#dc3545}
    .difference-equal .difference-amount{background:#fff0bf;color:#765900}
    .difference-equal .difference-status{color:#997000}
    .margin-positive{font-weight:700;color:#198754}
    .margin-negative{font-weight:700;color:#dc3545}
    .margin-zero{font-weight:700;color:#d49100}
    .saved-date{white-space:nowrap;color:#5f6b76;font-size:12px}
    #finalBudgetDetailsModal .modal-footer{padding:12px 20px;background:#fff;border-top:1px solid #e5e9ed}
    @media(max-width:768px){
        #finalBudgetDetailsModal .modal-dialog{max-width:100%;margin:8px}
        #finalBudgetDetailsModal .modal-header{padding:15px}
        #finalBudgetDetailsModal .modal-body{padding:10px}
    }

    .difference-popup-btn{
        padding:0;
        border:0;
        background:transparent;
        cursor:pointer;
        text-align:right;
    }

    .difference-popup-btn:hover .difference-amount{
        box-shadow:0 3px 10px rgba(25,116,210,.25);
        transform:translateY(-1px);
    }

    .difference-popup-btn .difference-amount{
        transition:.2s ease;
    }

    #differenceDetailsModal{
        z-index:1080;
    }

    .difference-modal-backdrop{
        z-index:1075!important;
    }

    #differenceDetailsModal .modal-content{
        border:0;
        border-radius:14px;
        overflow:hidden;
        box-shadow:0 20px 60px rgba(0,0,0,.25);
    }

    #differenceDetailsModal .modal-header{
        padding:17px 20px;
        color:#fff;
        border:0;
        background:linear-gradient(135deg,#163a5f,#1974d2);
    }

    #differenceDetailsModal .modal-title{
        font-size:18px;
        font-weight:700;
    }

    .difference-popup-content{
        padding:8px 3px;
    }

    .difference-popup-enquiry{
        margin-bottom:14px;
        color:#1974d2;
        font-size:17px;
        font-weight:700;
    }

    .difference-popup-message{
        margin-bottom:16px;
        padding:14px 16px;
        border:1px solid #dce8f5;
        border-radius:10px;
        background:#f4f9ff;
        color:#243447;
        font-size:14px;
        font-weight:600;
    }

    .difference-popup-summary{
        display:grid;
        grid-template-columns:repeat(3,minmax(0,1fr));
        gap:12px;
    }

    .difference-popup-summary-item{
        padding:13px;
        border:1px solid #e7ebf0;
        border-radius:10px;
        background:#fff;
    }

    .difference-popup-summary-item small{
        display:block;
        margin-bottom:5px;
        color:#8492a6;
        font-size:11px;
        font-weight:700;
        text-transform:uppercase;
    }

    .difference-popup-summary-item strong{
        color:#243447;
        font-size:15px;
    }

    @media(max-width:576px){
        .difference-popup-summary{
            grid-template-columns:1fr;
        }
    }
</style>

<div class="page-wrapper">
    <div class="container-fluid">
        <div class="page-content-wrapper">
            <div class="page-content budget-tracking-page">
                    <div class="page-bar">
                        <div class="row page-titles">
                            <div class="col-md-5 col-5 align-self-center">
                                <h4 class="text-themecolor">Budget Tracking Report</h4>
                            </div>
                            <div class="col-md-7 col-7 align-self-center text-end">
                                <div class="d-flex justify-content-end align-items-center">
                                    <ol class="breadcrumb justify-content-end">
                                        <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard');?>" style="color:#212529;">Home</a></li>
                                        <li class="breadcrumb-item active"><a href="<?php echo base_url('budget-report-tracking');?>" style="color:#01c0c8;">Budget Tracking Report</a></li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>

                <div class="budget-filter-card mt-4">
                    <div class="budget-filter-header">
                        <div>
                            <h5 class="budget-filter-title">
                                Budget Tracking Filters
                            </h5>
            
                            <div class="budget-filter-subtitle">
                                Filter quote final and final-budget records by date
                            </div>
                        </div>
            
                        <i class="fa fa-filter text-primary" style="font-size:20px;"></i>
                    </div>
            
                    <div class="budget-filter-body">
                        <form method="get" action="<?= current_url() ?>" id="budgetTrackingFilterForm">
                            <div class="row g-3 align-items-end">

                                <div class="col-lg-2 col-md-6">
                                    <label for="location">Location</label>

                                    <select
                                        name="location"
                                        id="location"
                                        class="form-select"
                                    >
                                       <?php foreach(($location_options ?? []) as $value => $label): ?>

                                            <option
                                                value="<?= html_escape($value) ?>"
                                                <?= ($filters['location'] ?? 'all') === $value ? 'selected' : '' ?>
                                            >
                                                <?= html_escape($label) ?>
                                            </option>

                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="col-lg-2 col-md-6">
                                    <label for="booking_type">Booking Type</label>

                                    <select
                                        name="booking_type"
                                        id="booking_type"
                                        class="form-select"
                                    >
                                        <option value="all">All</option>

                                        <?php foreach(($booking_type_options??[]) as $type): ?>
                                            <option
                                                value="<?= html_escape($type) ?>"
                                                <?= ($filters['booking_type']??'all')===$type?'selected':'' ?>
                                            >
                                                <?= html_escape($type) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="col-lg-2 col-md-6">
                                    <label for="from_date">From Date</label>

                                    <div class="budget-date-container">
                                        <input
                                            type="text"
                                            id="from_date_display"
                                            class="form-control budget-date-display"
                                            value="<?= !empty($filters['from_date'])?date('d M Y',strtotime($filters['from_date'])):'' ?>"
                                            placeholder="Select from date"
                                            readonly
                                        >

                                        <input
                                            type="date"
                                            name="from_date"
                                            id="from_date"
                                            class="budget-native-date"
                                            value="<?= html_escape($filters['from_date']??'') ?>"
                                        >

                                        <span class="budget-date-icon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                    </div>
                                </div>

                                <div class="col-lg-2 col-md-6">
                                    <label for="to_date">To Date</label>

                                    <div class="budget-date-container">
                                        <input
                                            type="text"
                                            id="to_date_display"
                                            class="form-control budget-date-display"
                                            value="<?= !empty($filters['to_date'])?date('d M Y',strtotime($filters['to_date'])):'' ?>"
                                            placeholder="Select to date"
                                            readonly
                                        >

                                        <input
                                            type="date"
                                            name="to_date"
                                            id="to_date"
                                            class="budget-native-date"
                                            value="<?= html_escape($filters['to_date']??'') ?>"
                                        >

                                        <span class="budget-date-icon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-12">
                                    <div class="d-flex gap-2">
                                        <button
                                            type="submit"
                                            class="btn btn-primary flex-fill"
                                        >
                                            <i class="fa fa-filter"></i>
                                            Apply Filter
                                        </button>

                                        <a
                                            href="<?= current_url() ?>"
                                            class="btn btn-outline-secondary flex-fill"
                                        >
                                            <i class="fa fa-refresh"></i>
                                            Reset
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            
                <div class="budget-summary-grid">

                    <div
                        class="budget-summary-card arrivals"
                        title="Total number of arrival files."
                    >
                        <div class="summary-card-top">
                            <h6 class="summary-card-label">Total Arrivals</h6>

                            <span class="summary-card-icon">
                                <i class="fa fa-plane"></i>
                            </span>
                        </div>

                        <button
                            type="button"
                            class="summary-count-button load-budget-details"
                            data-detail-type="arrivals"
                        >
                            <?= (int)($budget_summary['total_arrival_files']??0) ?>
                        </button>

                        <span class="summary-card-note">
                            Total arrival files
                        </span>
                    </div>

                    <div
                        class="budget-summary-card total"
                        title="Click on count to view Total Quote Final data."
                    >
                        <div class="summary-card-top">
                            <h6 class="summary-card-label">Total Quote Final</h6>

                            <span class="summary-card-icon">
                                <i class="fa fa-file"></i>
                            </span>
                        </div>

                        <button
                            type="button"
                            class="summary-count-button load-budget-details"
                            data-detail-type="total"
                        >
                            <?= (int)($budget_summary['total_quote_final']??0) ?>
                        </button>

                        <span class="summary-card-note">
                            Total finalized quotation files
                        </span>
                    </div>

                    <div
                        class="budget-summary-card final"
                        title="Click on count to view Final Budget data."
                    >
                        <div class="summary-card-top">
                            <h6 class="summary-card-label">Final Budget</h6>

                            <span class="summary-card-icon">
                                <i class="fa fa-check-circle"></i>
                            </span>
                        </div>

                        <button
                            type="button"
                            class="summary-count-button load-budget-details"
                            data-detail-type="final_budget"
                        >
                            <?= (int)($budget_summary['total_final_budget']??0) ?>
                        </button>

                        <span class="summary-card-note">
                            Final budget and final quote files
                        </span>
                    </div>

                    <div
                        class="budget-summary-card pending"
                        title="Click on count to view Pending Budget data."
                    >
                        <div class="summary-card-top">
                            <h6 class="summary-card-label">Pending Budget</h6>

                            <span class="summary-card-icon">
                                <i class="fa fa-hourglass-half"></i>
                            </span>
                        </div>

                        <button
                            type="button"
                            class="summary-count-button load-budget-details"
                            data-detail-type="pending"
                        >
                            <?= (int)($budget_summary['total_pending_budget']??0) ?>
                        </button>

                        <span class="summary-card-note">
                            Final budget is still pending
                        </span>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="finalBudgetDetailsModal" tabindex="-1" aria-labelledby="finalBudgetDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">

            <div class="modal-header">
                <div>
                    <span class="modal-title" id="finalBudgetDetailsModalLabel">
                        Budget Tracking Details
                    </span>

                    <span class="final-budget-subtitle" id="budgetModalSubtitle">
                        Click Final Budget count to load details
                    </span>

                    <div class="final-budget-legend">
                        <span class="legend-item">
                            <span class="legend-dot saving"></span>
                            Budget greater than actual
                        </span>

                        <span class="legend-item">
                            <span class="legend-dot exceeded"></span>
                            Actual greater than budget
                        </span>

                        <span class="legend-item">
                            <span class="legend-dot equal"></span>
                            No difference
                        </span>
                    </div>
                </div>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="final-budget-table-card">
                    <div class="table-responsive">
                        <table
                            class="table table-bordered table-hover w-100"
                            id="budget_tracking_details_table"
                        >
                            <thead id="budgetTrackingDetailsHead"></thead>

                            <tbody id="budgetTrackingDetailsBody">
                                <tr>
                                    <td class="text-center text-muted py-4">
                                        Click a summary count to load details.
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">
                    Close
                </button>
            </div>

        </div>
    </div>
</div>

<div
    class="modal fade"
    id="differenceDetailsModal"
    tabindex="-1"
    aria-labelledby="differenceDetailsModalLabel"
    aria-hidden="true"
>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5
                    class="modal-title"
                    id="differenceDetailsModalLabel"
                >
                    Final Budget Difference
                </h5>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>
            </div>

            <div class="modal-body">
                <div class="difference-popup-content">

                    <div
                        class="difference-popup-enquiry"
                        id="differencePopupEnquiry"
                    ></div>

                    <div
                        class="difference-popup-message"
                        id="differencePopupText"
                    ></div>

                    <div class="difference-popup-summary">

                        <div class="difference-popup-summary-item">
                            <small>Original Budget</small>

                            <strong id="differenceOriginalBudget">
                                -
                            </strong>
                        </div>

                        <div class="difference-popup-summary-item">
                            <small>Closing Budget</small>

                            <strong id="differenceClosingBudget">
                                -
                            </strong>
                        </div>

                        <div class="difference-popup-summary-item">
                            <small>Difference</small>

                            <strong id="differencePopupAmount">
                                -
                            </strong>
                        </div>

                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button
                    type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal"
                >
                    Close
                </button>

                <button
                    type="button"
                    class="btn btn-primary"
                    id="viewFinalBudgetBtn"
                >
                    <i class="fa fa-eye"></i>
                    View Final Budget
                </button>
            </div>

        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('#budget_tracking_table').DataTable({
            responsive: true,
            searching: false,
            paging: false,
            info: false,
            ordering: false
        });

        const locationBookingTypes={
            kazakhstan:['FKZ','GKZ','IKZ'],
            azerbaijan:['FAZ','GAZ','IAZ'],
            belarus:['FBZ','GBZ','IBZ'],
            georgia:['FGE','GGE','IGE'],
            armenia:['FAR','GAR','IAR'],
            uzbekistan:['FUZ','GUZ','IUZ'],
            all:[
                'FKZ','GKZ','IKZ',
                'FAZ','GAZ','IAZ',
                'FBZ','GBZ','IBZ',
                'FGE','GGE','IGE',
                'FAR','GAR','IAR',
                'FUZ','GUZ','IUZ',
            ]
        };

        let detailsTable=null;
        let activeRequest=null;

        const fromDate=document.getElementById('from_date');
        const toDate=document.getElementById('to_date');
        const fromDisplay=document.getElementById('from_date_display');
        const toDisplay=document.getElementById('to_date_display');

        function escapeHtml(value){
            return $('<div>').text(value??'').html();
        }

        function escapeAttribute(value){
            return String(value??'')
                .replace(/&/g,'&amp;')
                .replace(/"/g,'&quot;')
                .replace(/'/g,'&#039;')
                .replace(/</g,'&lt;')
                .replace(/>/g,'&gt;');
        }

        function formatDisplayDate(value){
            if(!value){
                return '';
            }

            const parts=value.split('-');

            if(parts.length!==3){
                return '';
            }

            const months=[
                'Jan','Feb','Mar','Apr','May','Jun',
                'Jul','Aug','Sep','Oct','Nov','Dec'
            ];

            const month=parseInt(parts[1],10);

            if(month<1 || month>12){
                return '';
            }

            return parts[2]+' '+months[month-1]+' '+parts[0];
        }

        function openDatePicker(input){
            if(typeof input.showPicker==='function'){
                input.showPicker();
            }else{
                input.focus();
                input.click();
            }
        }

        function updateToDateMinimum(){
            toDate.min=fromDate.value||'';

            if(
                fromDate.value &&
                toDate.value &&
                toDate.value<fromDate.value
            ){
                toDate.value='';
                toDisplay.value='';
            }
        }

        fromDisplay.value=formatDisplayDate(fromDate.value);
        toDisplay.value=formatDisplayDate(toDate.value);
        updateToDateMinimum();

        fromDisplay.addEventListener('click',function(){
            openDatePicker(fromDate);
        });

        toDisplay.addEventListener('click',function(){
            openDatePicker(toDate);
        });

        fromDate.addEventListener('change',function(){
            fromDisplay.value=formatDisplayDate(this.value);
            updateToDateMinimum();
        });

        toDate.addEventListener('change',function(){
            if(
                fromDate.value &&
                this.value &&
                this.value<fromDate.value
            ){
                this.value='';
                toDisplay.value='';

                alert(
                    'To Date cannot be earlier than From Date.'
                );

                return;
            }

            toDisplay.value=formatDisplayDate(this.value);
        });

        function renderBookingTypes(location,selectedType){
            const bookingTypes=
                locationBookingTypes[location]||
                locationBookingTypes.all;

            let html='<option value="all">All</option>';

            bookingTypes.forEach(function(type){
                html+=
                    '<option value="'+type+'"'+
                        (selectedType===type?' selected':'')+
                    '>'+
                        type+
                    '</option>';
            });

            $('#booking_type').html(html);
        }

        $('#location').on('change',function(){
            renderBookingTypes(
                $(this).val()||'all',
                'all'
            );
        });

        renderBookingTypes(
            $('#location').val()||'all',
            '<?= html_escape($filters['booking_type']??'all') ?>'
        );

        function destroyDetailsTable(){
            if(
                $.fn.DataTable &&
                $.fn.DataTable.isDataTable(
                    '#budget_tracking_details_table'
                )
            ){
                $('#budget_tracking_details_table')
                    .DataTable()
                    .clear()
                    .destroy();
            }

            detailsTable=null;
        }

        function showModal(){
            const element=document.getElementById(
                'finalBudgetDetailsModal'
            );

            if(window.bootstrap && bootstrap.Modal){
                bootstrap.Modal
                    .getOrCreateInstance(element)
                    .show();
            }else{
                $('#finalBudgetDetailsModal').modal('show');
            }
        }

        function getModalTitle(detailType){
            if(detailType==='arrivals'){
                return 'Arrival Files Details';
            }

            if(detailType==='pending'){
                return 'Pending Budget Details';
            }

            if(detailType==='final_budget'){
                return 'Final Budget Details';
            }

            return 'Total Quote Final Details';
        }

        function renderArrivalTable(rows){
            $('#budgetTrackingDetailsHead').html(
                '<tr>'+
                    '<th class="text-center">#</th>'+
                    '<th>Enquiry No</th>'+
                    '<th class="text-center">Enquiry ID</th>'+
                    '<th>File Handler</th>'+
                    '<th>Email</th>'+
                '</tr>'
            );

            let html='';

            rows.forEach(function(row,index){
                html+=
                    '<tr>'+
                        '<td class="text-center">'+
                            (index+1)+
                        '</td>'+

                        '<td>'+
                            '<strong class="enquiry-number">'+
                                escapeHtml(row.enquiry_no)+
                            '</strong>'+
                        '</td>'+

                        '<td class="text-center">'+
                            Number(row.enquiry_id||0)+
                        '</td>'+

                        '<td>'+
                            '<div class="file-handler-info">'+
                                '<strong>'+
                                    escapeHtml(
                                        row.file_handler_name||
                                        'Not Assigned'
                                    )+
                                '</strong>'+
                            '</div>'+
                        '</td>'+

                        '<td>'+
                            (
                                row.file_handler_email &&
                                row.file_handler_email!=='-'
                                    ? '<a href="mailto:'+
                                        escapeHtml(row.file_handler_email)+
                                    '" class="handler-email">'+
                                        escapeHtml(row.file_handler_email)+
                                    '</a>'
                                    : '<span class="text-muted">-</span>'
                            )+
                        '</td>'+
                    '</tr>';
            });

            $('#budgetTrackingDetailsBody').html(html);

            detailsTable=$(
                '#budget_tracking_details_table'
            ).DataTable({
                responsive:true,
                pageLength:25,
                lengthMenu:[
                    [10,25,50,100,-1],
                    [10,25,50,100,'All']
                ],
                order:[[0,'asc']],
                columnDefs:[
                    {
                        targets:[0,2],
                        className:'text-center'
                    }
                ],
                language:{
                    search:'Search records:',
                    emptyTable:'No arrival files found',
                    zeroRecords:'No matching arrival files found'
                }
            });
        }

        function renderBasicTable(rows){
            $('#budgetTrackingDetailsHead').html(
                '<tr>'+
                    '<th class="text-center">#</th>'+
                    '<th>Enquiry No</th>'+
                    '<th class="text-center">Enquiry ID</th>'+
                    '<th class="text-center">Quote</th>'+
                    '<th>File Handler</th>'+
                    '<th>Email</th>'+
                '</tr>'
            );

            let html='';

            rows.forEach(function(row,index){
                const handlerId=Number(row.file_handle_by||0);

                html+=
                    '<tr>'+
                        '<td class="text-center">'+
                            (index+1)+
                        '</td>'+

                        '<td>'+
                            '<strong class="enquiry-number">'+
                                escapeHtml(row.enquiry_no)+
                            '</strong>'+
                        '</td>'+

                        '<td class="text-center">'+
                            Number(row.enquiry_id||0)+
                        '</td>'+

                        '<td class="text-center">'+
                            '<span class="quote-badge">'+
                                'Quote '+Number(row.quote_number||1)+
                            '</span>'+
                        '</td>'+

                        '<td>'+
                            '<div class="file-handler-info">'+
                                '<strong>'+
                                    escapeHtml(
                                        row.file_handler_name||
                                        'Not Assigned'
                                    )+
                                '</strong>'+
                            '</div>'+
                        '</td>'+

                        '<td>'+
                            (
                                row.file_handler_email &&
                                row.file_handler_email!=='-'
                                    ? '<a href="mailto:'+
                                        escapeHtml(row.file_handler_email)+
                                    '" class="handler-email">'+
                                        escapeHtml(row.file_handler_email)+
                                    '</a>'
                                    : '<span class="text-muted">-</span>'
                            )+
                        '</td>'+
                    '</tr>';
            });

            $('#budgetTrackingDetailsBody').html(html);

            detailsTable=$('#budget_tracking_details_table').DataTable({
                responsive:true,
                pageLength:25,
                lengthMenu:[
                    [10,25,50,100,-1],
                    [10,25,50,100,'All']
                ],
                order:[[0,'asc']],
                columnDefs:[
                    {
                        targets:[0,2,3],
                        className:'text-center'
                    }
                ],
                language:{
                    search:'Search records:',
                    emptyTable:'No records found',
                    zeroRecords:'No matching records found'
                }
            });
        }

        function renderFinalBudgetTable(rows){
            $('#budgetTrackingDetailsHead').html(
                '<tr>'+
                    '<th class="text-center">#</th>'+
                    '<th>Enquiry No</th>'+
                    '<th class="text-center">Enquiry ID</th>'+
                    '<th class="text-center">Quote</th>'+
                    '<th class="text-end" style="background-color:#da627d;">Original Budget</th>'+
                    '<th class="text-end" style="background-color:#a3b18a;">Closing Budget</th>'+
                    '<th class="text-end">Margin</th>'+
                    '<th class="text-end">Margin Percentage</th>'+
                    '<th>Saved Date</th>'+
                '</tr>'
            );

            let html='';

            rows.forEach(function(row,index){
                const differenceRaw=Number(
                    row.difference_raw||0
                );

                const sign=differenceRaw>0?'+':'';

                html+=
                    '<tr>'+
                        '<td class="text-center">'+
                            (index+1)+
                        '</td>'+
                        '<td>'+
                            '<strong class="enquiry-number">'+
                                escapeHtml(row.enquiry_no)+
                            '</strong>'+
                        '</td>'+
                        '<td class="text-center">'+
                            Number(row.enquiry_id||0)+
                        '</td>'+
                        '<td class="text-center">'+
                            '<span class="quote-badge">'+
                                'Quote '+
                                Number(row.quote_number||1)+
                            '</span>'+
                        '</td>'+
                        '<td class="text-end">'+
                            '$' + escapeHtml(row.total_budget) + 
                        '</td>'+
                        '<td class="text-end">'+
                            '$' + escapeHtml(row.total_actual) +
                        '</td>'+
                        '<td class="text-end">'+
                            '<button '+
                                'type="button" '+
                                'class="difference-box difference-popup-btn difference-'+
                                    escapeAttribute(row.difference_class)+
                                '" '+

                                'data-enquiry-no="'+
                                    escapeAttribute(row.enquiry_no)+
                                '" '+

                                'data-original-budget="'+
                                    escapeAttribute(row.total_budget)+
                                '" '+

                                'data-closing-budget="'+
                                    escapeAttribute(row.total_actual)+
                                '" '+

                                'data-difference="'+
                                    escapeAttribute(
                                        sign+(row.difference||'0')
                                    )+
                                '" '+

                                'data-difference-status="'+
                                    escapeAttribute(row.difference_status)+
                                '" '+

                                'data-final-budget-url="'+
                                    escapeAttribute(row.final_budget_url||'')+
                                '" '+

                                'title="Click to view difference details"'+
                            '>'+
                                '<span class="difference-amount">'+
                                    sign+
                                    escapeHtml(row.difference)+
                                '</span>'+

                            '</button>'+
                        '</td>'+
                        '<td class="text-end">'+
                            '<span class="'+
                                escapeHtml(row.margin_class)+
                            '">'+
                                escapeHtml(row.margin_percentage)+
                            '</span>'+
                        '</td>'+
                        '<td>'+
                            '<span class="saved-date">'+
                                escapeHtml(row.saved_date)+
                            '</span>'+
                        '</td>'+
                    '</tr>';
            });

            $('#budgetTrackingDetailsBody').html(html);

            detailsTable=$(
                '#budget_tracking_details_table'
            ).DataTable({
                responsive:true,
                pageLength:25,
                order:[[8,'desc']]
            });
        }

        $(document).on(
            'click',
            '.load-budget-details',
            function(){
                const detailType=
                    $(this).data('detail-type')||'total';

                destroyDetailsTable();

                $('#finalBudgetDetailsModalLabel').text(
                    getModalTitle(detailType)
                );

                $('#budgetModalSubtitle').text(
                    'Loading records...'
                );

                $('#budgetTrackingDetailsHead').html('');

                $('#budgetTrackingDetailsBody').html(
                    '<tr>'+
                        '<td class="text-center text-primary py-5">'+
                            '<i class="fa fa-spinner fa-spin"></i>'+
                            ' Loading records...'+
                        '</td>'+
                    '</tr>'
                );

                showModal();

                if(activeRequest!==null){
                    activeRequest.abort();
                }

                activeRequest=$.ajax({
                    url:"<?= base_url('admin/BudgetReport/budget_tracking_details_ajax') ?>",
                    type:'GET',
                    dataType:'json',
                    cache:false,

                    data:{
                        from_date:fromDate.value||'',
                        to_date:toDate.value||'',
                        location:$('#location').val()||'all',
                        booking_type:$('#booking_type').val()||'all',
                        detail_type:detailType
                    },

                    success:function(response){
                        if(!response || response.success!==true){
                            $('#budgetModalSubtitle').text(
                                'Unable to load records'
                            );

                            $('#budgetTrackingDetailsBody').html(
                                '<tr>'+
                                    '<td class="text-center text-danger py-5">'+
                                        escapeHtml(
                                            response.message||
                                            'Unable to load records.'
                                        )+
                                    '</td>'+
                                '</tr>'
                            );

                            return;
                        }

                        $('#budgetModalSubtitle').text(
                            response.total+
                            ' records found'
                        );

                        if(!response.rows.length){
                            $('#budgetTrackingDetailsBody').html(
                                '<tr>'+
                                    '<td class="text-center text-muted py-5">'+
                                        'No records found.'+
                                    '</td>'+
                                '</tr>'
                            );

                            return;
                        }

                        if(response.mode==='final_budget'){
                            renderFinalBudgetTable(response.rows);
                        }else if(response.mode==='arrivals'){
                            renderArrivalTable(response.rows);
                        }else{
                            renderBasicTable(response.rows);
                        }
                    },

                    error:function(xhr,textStatus){
                        if(textStatus==='abort'){
                            return;
                        }

                        $('#budgetModalSubtitle').text(
                            'Unable to load records'
                        );

                        $('#budgetTrackingDetailsBody').html(
                            '<tr>'+
                                '<td class="text-center text-danger py-5">'+
                                    'Server error while loading records.'+
                                '</td>'+
                            '</tr>'
                        );

                        console.error(xhr.responseText);
                    },

                    complete:function(){
                        activeRequest=null;
                    }
                });
            }
        );

        $('#budgetTrackingFilterForm').on(
            'submit',
            function(event){
                if(
                    fromDate.value &&
                    toDate.value &&
                    toDate.value<fromDate.value
                ){
                    event.preventDefault();

                    alert(
                        'To Date cannot be earlier than From Date.'
                    );

                    return false;
                }
            }
        );

        $('#finalBudgetDetailsModal').on(
            'hidden.bs.modal',
            function(){
                if(activeRequest!==null){
                    activeRequest.abort();
                    activeRequest=null;
                }

                destroyDetailsTable();

                $('#budgetTrackingDetailsHead').html('');
                $('#budgetTrackingDetailsBody').html(
                    '<tr>'+
                        '<td class="text-center text-muted py-4">'+
                            'Click a summary count to load details.'+
                        '</td>'+
                    '</tr>'
                );
            }
        );

        let selectedFinalBudgetUrl='';

        function showDifferenceModal(){
            const element=document.getElementById(
                'differenceDetailsModal'
            );

            if(window.bootstrap && bootstrap.Modal){
                bootstrap.Modal
                    .getOrCreateInstance(element)
                    .show();
            }else{
                $('#differenceDetailsModal').modal('show');
            }
        }

        $(document).on(
            'click',
            '.difference-popup-btn',
            function(){
                const enquiryNo=
                    $(this).attr('data-enquiry-no')||'-';

                const originalBudget=
                    $(this).attr('data-original-budget')||'-';

                const closingBudget=
                    $(this).attr('data-closing-budget')||'-';

                const difference=
                    $(this).attr('data-difference')||'0';

                const differenceStatus=
                    $(this).attr('data-difference-status')||
                    'No difference';

                selectedFinalBudgetUrl=
                    $(this).attr('data-final-budget-url')||'';

                $('#differencePopupEnquiry').text(
                    'Enquiry No: '+ enquiryNo
                );

                $('#differencePopupText').text(
                    differenceStatus
                );

                $('#differenceOriginalBudget').text(
                    '$' + originalBudget
                );

                $('#differenceClosingBudget').text(
                    '$' + closingBudget
                );

                $('#differencePopupAmount').text(
                    difference
                );

                $('#viewFinalBudgetBtn').prop(
                    'disabled',
                    selectedFinalBudgetUrl===''
                );

                showDifferenceModal();
            }
        );

        $(document).on(
            'click',
            '#viewFinalBudgetBtn',
            function(){
                if(selectedFinalBudgetUrl===''){
                    alert('Final Budget URL not found.');
                    return;
                }

                // window.location.href=selectedFinalBudgetUrl;
                window.open(
                    selectedFinalBudgetUrl,
                    '_blank',
                    'noopener,noreferrer'
                );
            }
        );

        $('#differenceDetailsModal').on(
            'shown.bs.modal',
            function(){
                $('.modal-backdrop')
                    .last()
                    .addClass('difference-modal-backdrop');
            }
        );

        $('#differenceDetailsModal').on(
            'hidden.bs.modal',
            function(){
                selectedFinalBudgetUrl='';

                /*
                * Difference popup ke peeche main details
                * popup open hai, isliye body scroll lock restore karein.
                */
                if($('#finalBudgetDetailsModal').hasClass('show')){
                    $('body').addClass('modal-open');
                }
            }
        );
    });
</script>