@extends('layout')

@section('title')
    <title>PT Prima Vista Solusi | Claim Approval</title>
@endsection

@section('css')
    <style type="text/css">
    </style>
@endsection

@section('header_content')
    <div class="d-flex justify-content-between mg-b-5">
        <div class="d-flex">
            <svg class="my-auto" width="37" height="37" viewBox="0 0 21 19" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <rect x="1" y="1" width="15" height="17" rx="2" stroke="#757575"
                    stroke-width="2" />
                <path d="M10.7394 13.7985L11.6138 11.5517L12.8946 12.7177L10.7394 13.7985Z" fill="#51CBFF" />
                <path d="M4 14L10 14" stroke="#51CBFF" />
                <path d="M4 11L13 11" stroke="#51CBFF" />
                <path d="M4 8L13 8" stroke="#51CBFF" />
                <rect x="12.9883" y="12.4424" width="1.5" height="10.5684"
                    transform="rotate(-137.684 12.9883 12.4424)" fill="#757575" stroke="#757575" stroke-width="0.3" />
                <path
                    d="M6.1147 3.58203H5.64808C5.63956 3.52166 5.62216 3.46804 5.59588 3.42116C5.5696 3.37358 5.53587 3.3331 5.49467 3.29972C5.45348 3.26634 5.40589 3.24077 5.35192 3.22301C5.29865 3.20526 5.24077 3.19638 5.17827 3.19638C5.06534 3.19638 4.96697 3.22443 4.88317 3.28054C4.79936 3.33594 4.73438 3.4169 4.68821 3.52344C4.64205 3.62926 4.61896 3.75781 4.61896 3.90909C4.61896 4.06463 4.64205 4.19531 4.68821 4.30114C4.73509 4.40696 4.80043 4.48686 4.88423 4.54084C4.96804 4.59482 5.06499 4.6218 5.17507 4.6218C5.23686 4.6218 5.29403 4.61364 5.34659 4.5973C5.39986 4.58097 5.44709 4.55717 5.48828 4.52592C5.52947 4.49396 5.56357 4.45526 5.59055 4.4098C5.61825 4.36435 5.63743 4.3125 5.64808 4.25426L6.1147 4.25639C6.10263 4.35653 6.07244 4.45312 6.02415 4.54616C5.97656 4.63849 5.91229 4.72124 5.83132 4.79439C5.75107 4.86683 5.65518 4.92436 5.54368 4.96697C5.43288 5.00888 5.30753 5.02983 5.16761 5.02983C4.97301 5.02983 4.79901 4.9858 4.6456 4.89773C4.4929 4.80966 4.37216 4.68217 4.28338 4.51527C4.19531 4.34837 4.15128 4.14631 4.15128 3.90909C4.15128 3.67116 4.19602 3.46875 4.28551 3.30185C4.375 3.13494 4.49645 3.00781 4.64986 2.92045C4.80327 2.83239 4.97585 2.78835 5.16761 2.78835C5.29403 2.78835 5.41122 2.80611 5.51918 2.84162C5.62784 2.87713 5.72408 2.92898 5.80788 2.99716C5.89169 3.06463 5.95987 3.14737 6.01243 3.24538C6.0657 3.34339 6.09979 3.45561 6.1147 3.58203ZM6.8908 2.81818V5H6.43697V2.81818H6.8908ZM7.72097 5.03089C7.61657 5.03089 7.52353 5.01278 7.44185 4.97656C7.36017 4.93963 7.29554 4.8853 7.24796 4.81357C7.20108 4.74112 7.17765 4.65092 7.17765 4.54297C7.17765 4.45206 7.19434 4.37571 7.22772 4.31392C7.2611 4.25213 7.30655 4.20241 7.36408 4.16477C7.42161 4.12713 7.48695 4.09872 7.5601 4.07955C7.63397 4.06037 7.71138 4.04688 7.79235 4.03906C7.88752 4.02912 7.96422 4.01989 8.02246 4.01136C8.0807 4.00213 8.12296 3.98864 8.14924 3.97088C8.17551 3.95312 8.18865 3.92685 8.18865 3.89205V3.88565C8.18865 3.81818 8.16735 3.76598 8.12473 3.72905C8.08283 3.69212 8.02317 3.67365 7.94576 3.67365C7.86408 3.67365 7.79909 3.69176 7.7508 3.72798C7.7025 3.76349 7.67054 3.80824 7.65492 3.86222L7.23517 3.82812C7.25648 3.72869 7.29838 3.64276 7.36088 3.57031C7.42338 3.49716 7.504 3.44105 7.60272 3.40199C7.70215 3.36222 7.81721 3.34233 7.94789 3.34233C8.0388 3.34233 8.1258 3.35298 8.2089 3.37429C8.2927 3.3956 8.36692 3.42862 8.43155 3.47337C8.49689 3.51811 8.54838 3.57564 8.58603 3.64595C8.62367 3.71555 8.64249 3.79901 8.64249 3.89631V5H8.21209V4.77308H8.19931C8.17303 4.82422 8.13787 4.86932 8.09384 4.90838C8.0498 4.94673 7.99689 4.97692 7.9351 4.99893C7.87331 5.02024 7.80194 5.03089 7.72097 5.03089ZM7.85094 4.71768C7.9177 4.71768 7.97665 4.70455 8.02779 4.67827C8.07892 4.65128 8.11905 4.61506 8.14817 4.5696C8.17729 4.52415 8.19185 4.47266 8.19185 4.41513V4.24148C8.17765 4.25071 8.15811 4.25923 8.13326 4.26705C8.10911 4.27415 8.08176 4.28089 8.05123 4.28729C8.02069 4.29297 7.99015 4.2983 7.95961 4.30327C7.92907 4.30753 7.90137 4.31143 7.87651 4.31499C7.82324 4.3228 7.77672 4.33523 7.73695 4.35227C7.69718 4.36932 7.66628 4.3924 7.64426 4.42152C7.62225 4.44993 7.61124 4.48544 7.61124 4.52805C7.61124 4.58984 7.63361 4.63707 7.67836 4.66974C7.72381 4.7017 7.78134 4.71768 7.85094 4.71768ZM8.99458 5V3.36364H9.44842V5H8.99458ZM9.22257 3.1527C9.1551 3.1527 9.09721 3.13033 9.04892 3.08558C9.00133 3.04013 8.97754 2.9858 8.97754 2.92259C8.97754 2.86009 9.00133 2.80646 9.04892 2.76172C9.09721 2.71626 9.1551 2.69354 9.22257 2.69354C9.29004 2.69354 9.34757 2.71626 9.39515 2.76172C9.44345 2.80646 9.4676 2.86009 9.4676 2.92259C9.4676 2.9858 9.44345 3.04013 9.39515 3.08558C9.34757 3.13033 9.29004 3.1527 9.22257 3.1527ZM9.81197 5V3.36364H10.2445V3.65234H10.2637C10.2978 3.55646 10.3546 3.48082 10.4341 3.42543C10.5137 3.37003 10.6088 3.34233 10.7196 3.34233C10.8319 3.34233 10.9274 3.37038 11.0062 3.42649C11.085 3.48189 11.1376 3.55717 11.1639 3.65234H11.1809C11.2143 3.55859 11.2747 3.48366 11.362 3.42756C11.4501 3.37074 11.5542 3.34233 11.6742 3.34233C11.8269 3.34233 11.9508 3.39098 12.046 3.48828C12.1419 3.58487 12.1898 3.72195 12.1898 3.8995V5H11.737V3.98899C11.737 3.89808 11.7129 3.8299 11.6646 3.78445C11.6163 3.73899 11.5559 3.71626 11.4835 3.71626C11.4011 3.71626 11.3368 3.74254 11.2907 3.7951C11.2445 3.84695 11.2214 3.91548 11.2214 4.00071V5H10.7814V3.9794C10.7814 3.89915 10.7583 3.83523 10.7122 3.78764C10.6667 3.74006 10.6067 3.71626 10.5321 3.71626C10.4817 3.71626 10.4363 3.72905 10.3958 3.75462C10.356 3.77947 10.3244 3.81463 10.301 3.86009C10.2775 3.90483 10.2658 3.95739 10.2658 4.01776V5H9.81197Z"
                    fill="#757575" />
            </svg>

            <div class="ml-3">
                <h4 class="tx-gray-800">Claim Approval</h4>
                <h6 class="ml-2">List Claim Approval</h6>
            </div>
        </div>
    </div>
@endsection

@section('body_content')
    <div class="card-border p-4">
        <div class="table-wrapper">
            <table id="table-data" class="table display responsive nowrap" style="width: 100%;">
                <thead>
                    <tr>
                        <th class="wd-5p-force">No</th>
                        <th>Name</th>
                        <th>RF Period</th>
                        <th class="text-center" >Status</th>
                        <th>Due Date</th>
                        <th>Amount</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    {{-- Modal View Detail --}}
    <div id="modal-claim-approve_view" class="modal fade" data-value=''>
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content tx-size-sm">
                <div class="modal-header pd-x-20">
                    <h5></h5>
                    <h6 class="tx-20 mg-b-0 tx-inverse tx-bold">View Detail Claim</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body pd-5-force pd-l-20-force bg-gray-400 ">
                    Main Details
                </div>
                <div class="modal-body row px-5">
                    <div class="col-md-3">
                        <p class="text-base mb-2 font-semibold">Name</p>
                        <p class="text-base mb-2 font-semibold">Cost Centre</p>
                        <p class="text-base mb-2 font-semibold">Currency</p>
                        <p class="text-base mb-2 font-semibold">Total Amount</p>
                        <p class="text-base mb-2 font-semibold">Status</p>
                    </div>
                    <div class="col-md-5">
                        <p class="text-base mb-2 font-semibold text-capitalize">:<span id="name-detail" class="ml-2"></span></p>
                        <p class="text-base mb-2">:<span id="cost_centre-detail" class="ml-2"></span></p>
                        <p class="text-base mb-2">:<span id="currency-detail" class="ml-2"></span></p>
                        <p class="text-base mb-2">:<span id="total_amount-detail" class="ml-2"></span></p>
                        <p id="status-detail" class="text-base mb-2"></p>
                    </div>
                    <div id="show-support_doc_view" class="col-md-4" style="display: none">
                        <table class="table display responsive nowrap">
                            <thead>
                                <tr>
                                    <th class="text-capitalize py-2">Other Documents</th>
                                </tr>
                            </thead>
                            <tbody id="support_doc-view" class="table-absen">

                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="modal-body pd-5-force pd-l-20-force bg-gray-400 ">
                    Summary Claim Items
                </div>
                <div class="form-layout">
                    <div class="modal-body pd-20">
                        <div class="row">
                            <div class="col">
                                <table id="approve_item_datatable-view" class="table table-striped table-bordered"
                                    style="background-color: #fff">
                                    <thead>
                                        <tr>
                                            <th width="5%">No</th>
                                            <th width="20%">Date</th>
                                            <th width="20%">Claim Category</th>
                                            <th width="20%">Description</th>
                                            <th width="25%">Amount</th>
                                            <th class="text-center" width="10%">Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th colspan="4" style="text-align:right">Total:</th>
                                            <th colspan="1" style="text-align:left"></th>
                                            <th colspan="1"></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="view_action_reason" >
                    
                </div>
                
                <div id="action-view" class="d-flex justify-content-between p-4">
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Edit Claim Request --}}
    <div id="modal-claim-request_edit" class="modal fade" data-value=''>
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content tx-size-sm">
                <div class="modal-header pd-x-20">
                    <h5></h5>
                    <h6 class="tx-20 mg-b-0 tx-inverse tx-bold">Edit Claim Request</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body pd-5-force pd-l-20-force bg-gray-400 ">
                    Main Details
                </div>
                <input id="claim_request_id-edit" type="text"  hidden>
                <input id="claim_request_type_id-edit" type="text"  hidden>
                <input type="text" id="currency_id-edit" hidden>
                <input type="text" id="rf_period_id-edit" hidden>
                <input type="text" id="cost_centre_id-edit" hidden>
                <input type="text" id="claim_phase_id-edit" hidden>

                <input type="text" id="rf_name-edit" hidden>
                <div class="modal-body row px-5">
                    <div class="col-md-3">
                        <p class="text-base mb-2 font-semibold">Name</p>
                        <p class="text-base mb-2 font-semibold">Cost Centre</p>
                        <p class="text-base mb-2 font-semibold">Currency</p>
                        <p class="text-base mb-2 font-semibold">Status</p>
                    </div>
                    <div class="col-md-9">
                        <p class="text-base mb-2 font-semibold text-capitalize">:<span id="name-edit" class="ml-2"></span></p>
                        <p class="text-base mb-2">:<span id="cost_centre-edit" class="ml-2"></span></p>
                        <p class="text-base mb-2">:<span id="currency-edit" class="ml-2"></span></p>
                        <p id="status-edit" class="text-base mb-2"></p>
                    </div>
                </div>

                <div id="show-support_doc_edit" style="display: none">
                    <div class="modal-body pd-5-force pd-l-20-force bg-gray-400 ">
                        Support Documents
                    </div>
                    <div class="modal-body pd-20">
                        <table class="table display responsive nowrap px-2">
                            <thead>
                                <tr>
                                    <th class="text-capitalize py-2">No</th>
                                    <th class="text-capitalize py-2">Other Documents</th>
                                    <th class="text-capitalize py-2 text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody id="support_doc-edit" class="table-absen">
    
                            </tbody>
                        </table>
                    </div>
                </div>

                <form id="edit_item_detail" style="display: none">
                    <div class="modal-body pd-5-force pd-l-20-force bg-gray-400 ">
                        Edit Claim Item
                    </div>
                    <input id="index-edit" type="text" hidden>
                    <input id="pm-edit" type="text" hidden>
                    <div class="modal-body px-5">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-control-label">Claim Category <span
                                        class="tx-danger">*</span></label>
                                    <select class="form-control claim_category rounded-xl" id="claim_category-edit" name="claim_category"
                                        style="width: 100%" disabled required>
                                        @foreach ($data['claim_category'] as $item)
                                            <option value="{{$item['claim_category_id']}}">{{$item['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-control-label">Claim Date <span
                                            class="tx-danger">*</span></label>
                                    <input type="text"
                                        class="form-control fc-datepicker rounded-xl" name="claim_date"
                                        id="claim_date-edit" placeholder="DD/MM/YYYY" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-control-label">Claim Amount <span
                                            class="tx-danger">*</span></label>
                                    <input class="form-control rounded-xl" type="text"
                                        name="claim_amount-edit"
                                        id="claim_amount-edit"
                                        placeholder="Enter Price"
                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                        autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-control-label">Claim Description</label>
                                    <textarea class="form-control rounded-xl" type="text" name="claim_desc-edit"
                                        id="claim_desc-edit" placeholder="Enter Description" maxlength="3000" autocomplete></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <div onclick="cancelEditDetail()" class="btn rounded-xl btn-secondary btn-sm mx-2">Cancel</div>
                            <button type="submit" class="btn rounded-xl btn-success btn-sm">Save</button>
                        </div>
                    </div>
                </form>

                <div class="modal-body pd-5-force pd-l-20-force bg-gray-400 ">
                    Summary Claim Items
                </div>
                <div class="form-layout">
                    <div class="modal-body pd-20" id="pon-request-detail-container">
                        <div class="row">
                            <div class="col">
                                <table id="request_item_datatable-edit" class="table table-striped table-bordered"
                                    style="background-color: #fff">
                                    <thead>
                                        <tr>
                                            <th width="5%">No</th>
                                            <th width="20%">Date</th>
                                            <th width="20%">Claim Category</th>
                                            <th width="20%">Description</th>
                                            <th width="25%">Amount</th>
                                            <th class="text-center" width="10%">Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th colspan="4" style="text-align:right">Total:</th>
                                            <th colspan="2"></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button data-dismiss="modal" aria-label="Close" class='rounded-xl btn btn-dark'>Cancel</button>

                    <button id="edit-submit_claim" class='rounded-xl btn btn-primary'>Submit</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        let claim_request_approval = @json($data['claim_list']['claim_request_approval']);

        const priv_list = @json($data['privilege_menu'])
        
        var data_edit_temp = []
        var delete_file_temp = []

        var support_doc = []

        $(document).ready(function() {
            $('.dataTables_length select').select2({
                minimumResultsForSearch: Infinity
            });

            // DATEPICKER INITIALIZATION
            $('.fc-datepicker').datepicker({
                format: 'dd/mm/yyyy',
                autoclose: true
            });
        })

        async function tableSupportDoc(files, action) {
            let tbodySupportDoc = ""
            support_doc = []
            $.each( files, function (i, file) { 
                support_doc.push(file.filename) 
                const fileName = file.filename.split("/")
                let number = ""
                if (action == "edit") {
                    number = `<td>${i+1}</td>`
                }
                tbodySupportDoc += `
                    <tr>
                        ${number}
                        <td>${fileName[fileName.length-1]}</td>
                        <td class="text-center" ><a href="${file.filename}" target="_blank" style="text-decoration: none;" class="btn btn-outline-primary py-1 px-2" type="button" title="View File"><span class="icon ion-eye"></span></a></td>
                    </tr>`
            } )   
            if (files.length > 0 ) {
                $(`#show-support_doc_${action}`).show()
            } else {
                $(`#show-support_doc_${action}`).hide()
            }
            $(`#support_doc-${action}`).html(tbodySupportDoc)
        }

        var table = $('#table-data').DataTable({
            data: claim_request_approval,
            scrollX: true,
            scrollCollapse: true,
            deferRender: true,
            processing: true,
            columns: [{
                    data: null
                },
                {
                    className: "font-semibold text-capitalize",
                    data: "user_fullname"
                },
                {
                    data: "rf_period.rf_name"
                },
                {
                    data: "status"
                },
                {
                    data: "rf_period.due_date"
                },
                {
                    data: "total_amount"
                },
                {
                    data: null,
                }
            ],
            responsive: true,
            language: {
                searchPlaceholder: 'Search...',
                sSearch: '',
                lengthMenu: '_MENU_ items/page',
            },
            columnDefs: [{
                    searchable: false,
                    sortable: true,
                    targets: 0,
                    data: null,
                    render: function(data, type, full, meta) {
                        return meta.row + 1;
                    }
                },
                {
                    width: "15%",
                    searchable: false,
                    sortable: false,
                    targets: 3,
                    data: null,
                    render: function(data){
                        let status = "open"
                        if (data == "Not Yet Submitted") {
                            status = "notyetsubmitted"
                        } else if (data == "Closed" ) {
                            status = "close"
                        } else if (data == "Need Revision") {
                            status = "needrevision"
                        }
                        return `<div class="status-label status-${status}">${data}</div>`;
                    }                    
                },
                {
                    searchable: false,
                    sortable: false,
                    className: "text-center",
                    targets: -1,
                    data: null,
                    render: function(data) {
                        let buttonAction = ""
                        if (priv_list.CLAIM_APPROVAL_PUSAT_UPDATE && data.status == "Open") {
                            buttonAction += `<button id="edit-modal-show" style="text-decoration: none;" class="btn btn-outline-warning mg-r-5" type="button" title="Edit Item"><span class="icon ion-compose"></span></button>`
                        }
                        if (priv_list.CLAIM_APPROVAL_PUSAT_APR) {
                            buttonAction += `<button id="view-modal-show" style="text-decoration: none;padding: 3px 13px;" class="btn btn-outline-primary mg-r-5" type="button" title="View Detail"><span class="my-auto mx-auto icon ion-eye"></span></button>`
                        }
                        
                        return buttonAction;
                    }
                }
            ],
            "order": [
                [0, 'asc']
            ]
        });

        var item_approve_table_view = $('#approve_item_datatable-view').DataTable({
            "searching": false,
            columnDefs: [
                {
                    searchable: false,
                    sortable: false,
                    className: "text-center",
                    targets: -1,
                    render: function(data) {
                        let target = data
                        let namaFile = data.split("-")
                        if (namaFile[0] == "UploadTmp") {
                            target = `tmp/${data}`
                        }
                        return `
                            <a href="${target}" target="_blank" style="text-decoration: none;" class="btn btn-outline-primary" type="button" title="Preview File"><span class="my-auto icon ion-eye"></span></a>`;
                    }
                }
            ],
            "footerCallback": function(row, data, start, end, display) {
                var api = this.api(),
                    data;

                // Remove the formatting to get integer data for summation
                var intVal = function(i) {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '') * 1 :
                        typeof i === 'number' ?
                        i : 0;
                };

                // Total over all pages
                let total = api
                    .column(-2)
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                // Update footer
                $(api.column(-2).footer()).html(
                    // $.fn.dataTable.render.number(',', '.', 4).display(total)
                    addComasStatic(Math.round((parseFloat(total) + Number.EPSILON) * 10000) / 10000)
                );
            }
        });

        var item_request_table_edit = $('#request_item_datatable-edit').DataTable({
            "searching": false,
            columnDefs: [
                {
                    searchable: false,
                    sortable: false,
                    targets: -1,
                    render: function(data) {
                        let target = data
                        let namaFile = data.split("-")
                        if (namaFile[0] == "UploadTmp") {
                            target = `tmp/${data}`
                        }
                        return `
                            <button id="edit-item-detail" style="text-decoration: none;" class="btn btn-outline-warning mg-r-5" type="button" title="Edit Item"><span class="icon ion-compose"></span></button>
                            <a href="${target}" target="_blank" style="text-decoration: none;" class="btn btn-outline-primary" type="button" title="Preview File"><span class="my-auto icon ion-eye"></span></a>
                            <button id="delete-item-detail" type="button" style="text-decoration: none;" class="btn btn-outline-danger" title="Remove Item"><span class="icon ion-trash-a"></span></button>`;
                    }
                }
            ],
            "footerCallback": function(row, data, start, end, display) {
                var api = this.api(),
                    data;

                // Remove the formatting to get integer data for summation
                var intVal = function(i) {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '') * 1 :
                        typeof i === 'number' ?
                        i : 0;
                };

                // Total over all pages
                let total = api
                    .column(-2)
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                // Update footer
                $(api.column(-2).footer()).html(
                    // $.fn.dataTable.render.number(',', '.', 4).display(total)
                    addComasStatic(Math.round((parseFloat(total) + Number.EPSILON) * 10000) / 10000)
                );
            }
        });

        function reFatchData() { 
            $.ajax({
                url: '{{ route('claim_approval_list') }}',
                method: 'GET',
                datatype: "json",
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                success: function(res) {
                    console.log(res);
                    if (res.result === 'SUCCESS') {
                        table.clear().rows.add(res.data.claim_request_approval).draw()
                        return
                    }
                    amaran_error(res.message)
                    $.LoadingOverlay("hide");
                }
            })
         }

        function ApproveAction(action, claim_request_id) {
            const data = {
                action,claim_request_id
            }
            if (action == "reject") {
                $("#reason_validate").parsley().validate();
                if (!$("#reason_validate").parsley().validate()) {
                    return
                }
                data.reason = $("#reason").val()
            }

            $.ajax({
                url: '{{ route('claim_approval_action') }}',
                method: 'POST',
                data,
                datatype: "json",
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                success: function(res) {
                    console.log(res);
                    if (res.result == "SUCCESS") {
                        reFatchData();
                        $.LoadingOverlay("hide");
                        $("#modal-claim-approve_view").modal("hide");
                        amaran_success(res.message);
                        return;
                    }
                    amaran_error(res.message);
                }
            });
        }

        function buildTableEdit() {
            let tableEdit = "";
            data_edit_temp.map( (item, index) => {
                tableEdit += `<tr>
                    <td style="width: 5%">${index+1}</td>
                    <td style="width: 15%">${item.claim_date}</td>
                    <td style="width: 20%">${item.claim_category_name}</td>
                    <td style="width: 20%">${item.claim_desc}</td>
                    <td style="width: 20%">${addComasStatic(Math.round((parseFloat(item.claim_amount) +
                        Number.EPSILON) * 10000) / 10000)}</td>
                    <td style="width: 20%">${item.claim_document[0].filename}</td>
                </tr>`
            } )
            item_request_table_edit.clear().rows.add($(`${tableEdit}`)).draw()
        }

        $('#request_item_datatable-edit tbody').on('click', '#delete-item-detail', function() {
            const i = $(this).closest('tr').index()
            const {
                claim_category_id,
                claim_document
            } = data_edit_temp[i]
            console.log(claim_document);
            let namaFile = claim_document[0].filename.split("-")
            if (namaFile[0] == "UploadTmp") {
                const data = { delete_document: claim_document[0].filename }
                $.ajax({
                    type: "POST",
                    url: "{{ route('delete_item') }}",
                    data: data,
                    dataType: "json",
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                });
            } else {
                delete_file_temp.push(claim_document[0].filename)
                console.log(delete_file_temp);
            }

            data_edit_temp.splice(i, 1)
            buildTableEdit()
        })

        function cancelEditDetail() {
            $("#edit_item_detail").hide(200);
        }

        $("#edit_item_detail").submit( function (e) { 
            e.preventDefault();
            console.log(data_edit_temp);
            const index = $("#index-edit").val()
            const tmp = {...data_edit_temp[index]}

            tmp.claim_amount = $("#claim_amount-edit").val()
            tmp.claim_desc = $("#claim_desc-edit").val()
            tmp.claim_date = $("#claim_date-edit").val()

            data_edit_temp[index] = tmp

            buildTableEdit()
            $("#edit_item_detail").hide(200);
         } )

        $("#edit-submit_claim").click( function () { 
            var column = item_request_table_edit.column(-2);
            var totalFormat = $(column.footer()).html().split(",")

            const total_amount = totalFormat.join("")

            const data = {
                claim_request_id: $("#claim_request_id-edit").val(),
                claim_request_type_id: $("#claim_request_type_id-edit").val(),
                currency_id: $("#currency_id-edit").val(),
                rf_period_id: $("#rf_period_id-edit").val(),
                cost_centre_id: $("#cost_centre_id-edit").val(),
                rf_name: $("#rf_name-edit").val(),
                claim_phase_id: $("#claim_phase_id-edit").val(),
                total_amount, action: "SUBMIT", support_doc,
                claim_item_detail: data_edit_temp,
                delete_document: delete_file_temp
            }
            var formData = new FormData();
            formData.append("data", JSON.stringify(data));

            $.ajax({
                url: '{{ route('claim_request_update') }}',
                method: 'POST',
                data: formData,
                datatype: "json",
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                success: function(res) {
                    console.log(res);                    
                    if (res.result == "SUCCESS") {
                        reFatchData()
                        $('#modal-claim-request_edit').modal("hide");
                        amaran_success(res.message)
                        return
                    }
                    amaran_error("Update Claim Failed")
                    return
                },
                error: function(err) {
                    amaran_error(err)
                }
            });
         } )

        $('#request_item_datatable-edit tbody').on('click', '#edit-item-detail', function() {
            const i = $(this).closest('tr').index()
            if (data_edit_temp[i].pm) {
                $("#pm-edit").val(data_edit_temp[i].pm)
            }
            $("#index-edit").val(i)

            $("#claim_category-edit").val(data_edit_temp[i].claim_category_id)
            $("#claim_date-edit").val(data_edit_temp[i].claim_date)
            $("#claim_amount-edit").val(data_edit_temp[i].claim_amount)
            $("#claim_desc-edit").val(data_edit_temp[i].claim_desc)
            $("#edit_item_detail").show(200)
        })

        $('#table-data tbody').on('click', '#view-modal-show', function() {
            $.LoadingOverlay("show");
            $(this).blur()
            item_approve_table_view.clear()
            const data = table.row($(this).parents('tr')).data();
            tableSupportDoc( data.support_doc, "view" )
            let stat = "";
            $("#view_action_reason").html("")
            let action_view = `<div></div>
                            <button data-dismiss="modal" aria-label="Close" class='rounded-xl btn btn-dark'>Close</button>`
            if (data.status == "Closed" ) {
                stat = "close"
            } else if (data.status == "Need Revision") {
                stat = "needrevision"
            } else {
                action_view = `
                <button data-dismiss="modal" aria-label="Close" class='rounded-xl btn btn-dark'>Close</button>
                <div class="d-flex" >
                    <button onclick="ApproveAction('reject', ${data.claim_request_id})" class="rounded-xl btn status-needrevision mx-2" >Reject</button>
                    <button onclick="ApproveAction('approve', ${data.claim_request_id})" class="rounded-xl btn btn-success" >Aprrove</button>
                </div>
                `
                stat = "open"

                const view_action_reason = `
                    <form id="reason_validate">
                        <div class="modal-body pd-5-force pd-l-20-force bg-gray-400 ">
                            Reason
                        </div>
                        <div class="form-layout">
                            <div class="modal-body pd-20">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="inputPassword3" class="form-control-label">Reason</label>
                                            <textarea class="form-control rounded-xl" name="reason" id="reason" placeholder="Reason" rows="3" required></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>`
                $("#view_action_reason").html(view_action_reason)
            }
            const status = `<span class="ml-2 px-3 py-1 status-label status-${stat} p-2" >${data.status}</span>` 
            $("#name-detail").text(data.user_fullname);
            $("#cost_centre-detail").text(data.cost_centre_name);
            $("#currency-detail").text(data.currency_name);
            $("#total_amount-detail").text("Rp."+data.total_amount);
            $("#status-detail").html(`:${status}`);

            let tableHtml = "";
            data.claim_item_detail.map((item, index) => {
                tableHtml += `<tr>
                    <td style="width: 5%">${index+1}</td>
                    <td style="width: 15%">${item.claim_date}</td>
                    <td style="width: 20%">${item.claim_category_name}</td>
                    <td style="width: 20%">${item.claim_desc}</td>
                    <td style="width: 20%">${addComasStatic(Math.round((parseFloat(item.claim_amount) +
                        Number.EPSILON) * 10000) / 10000)}</td>
                    <td style="width: 20%">${item.claim_document[0].filename}</td>
                </tr>`
            })
            item_approve_table_view.rows.add($(`${tableHtml}`)).draw()
            $("#action-view").html(action_view)

            $('#modal-claim-approve_view').modal("show");
            $.LoadingOverlay("hide");
        })

        $('#table-data tbody').on('click', '#edit-modal-show', function() {
            $.LoadingOverlay("show");
            const data = table.row($(this).parents('tr')).data();
            console.log(data);
            $("#claim_request_id-edit").val(data.claim_request_id);
            $("#claim_request_type_id-edit").val(data.claim_request_type_id);
            $("#currency_id-edit").val(data.currency_id);
            $("#rf_period_id-edit").val(data.rf_period_id);
            $("#cost_centre_id-edit").val(data.cost_centre_id);
            $("#rf_name-edit").val(data.rf_period.rf_period_name);
            $("#claim_phase_id-edit").val(data.claim_request_phase_id);
            tableSupportDoc( data.support_doc, "edit" )

            let stat = ""
            if (data.status == "Closed" ) {
                stat = "close"
            } else if (data.status == "Need Revision") {
                stat = "needrevision"
            } else {
                stat = "open"
            }
            const status = `<span class="ml-2 px-3 py-1 status-label status-${stat} p-2" >${data.status}</span>` 
            $("#name-edit").text(data.user_fullname);
            $("#cost_centre-edit").text(data.cost_centre_name);
            $("#currency-edit").text(data.currency_name);
            $("#status-edit").html(`:${status}`);

            data_edit_temp = [...data.claim_item_detail]
            delete_file_temp = []

           buildTableEdit()
           $("#edit_item_detail").hide()
            
            $('#modal-claim-request_edit').modal("show");
            $.LoadingOverlay('hide');
        })
    </script>
@endsection
