@extends('layout')

@section('title')
    <title>PT Prima Vista Solusi | Claim Request</title>
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
                <h4 class="tx-gray-800">Claim Processing</h4>
                <h6 class="ml-2">List Claim Processing</h6>
            </div>
        </div>
    </div>

    <div id="modal-download_pp" class="modal fade" data-value=''>
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content tx-size-sm">
                <div class="modal-header pd-x-20">
                    <h5></h5>
                    <h6 class="tx-20 mg-b-0 tx-inverse tx-bold">Download Proposal Payment Report</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body px-5">
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Submission Date<span
                                class="tx-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text"
                                class="form-control fc-datepicker rounded-xl"
                                name="submission_date"
                                id="submission_date"
                                placeholder="DD/MM/YYYY" autocomplete="off">
                            <input type="text" name="rf_period_id" id="rf_period_id" hidden>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button data-dismiss="modal" aria-label="Close" class='rounded-xl btn btn-dark'>Cancel</button>

                    <button id="submit-download_pp" class='rounded-xl btn btn-primary'>Submit</button>
                </div>
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
                        <th>Initial Date</th>
                        <th>Rf Period</th>
                        <th class="text-center">Status</th>
                        <th>Grand Total Claim</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        $(document).ready(function() {
            $('.dataTables_length select').select2({
                minimumResultsForSearch: Infinity
            });

            // DATEPICKER INITIALIZATION
            $('.fc-datepicker').datepicker({
                autoclose: true
            });
        })

        var table = $('#table-data').DataTable({
            ajax: {
                'url': "{{ route('claim_processing_list') }}",
                'dataSrc' : ""
            },
            scrollX: true,
            scrollCollapse: true,
            deferRender: true,
            processing: true,
            columns: [{
                    data: null
                },
                {
                    data: "rf_date"
                },
                {
                    data: "rf_period"
                },
                {
                    data: "claim_rf_status"
                },
                {
                    data: "total_price"
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
                    searchable: false,
                    sortable: false,
                    className: "text-center",
                    targets: -1,
                    data: null,
                    render: function(data) {
                        console.log(data.action_menu);
                        let follup = ""
                        if (data.action_menu.request_pon == 1) {
                            follup += `<button id="initiate_claim" style="text-decoration: none;" class="btn btn-outline-primary mg-r-5" type="button" >Request PON</button>`
                        }
                        if (data.action_menu.autopay_report == 1) {
                            follup += `<a href="/claim-processing/generate-autopay/${data.rf_period_id}" style="text-decoration: none;" class="btn btn-outline-primary mg-r-5">Auto Pay</a>`
                        }
                        if (data.action_menu.PP_report == 1) {
                            follup += `<button id="generate-pp" style="text-decoration: none;" class="btn btn-outline-primary mg-r-5" type="button">Proposal Payment</button>`
                        }
                        if (data.action_menu.CSV_report == 1) {
                            follup += `<a id="generate-csv" href="/claim-processing/generate-csv/${data.rf_period_id}" style="text-decoration: none;" class="btn btn-outline-primary mg-r-5">CSV</a>`
                        }
                        if (data.action_menu.files == 1) {
                            follup += `<a href="/claim-processing/download-zip/${data.rf_period}" style="text-decoration: none;" class="btn btn-outline-primary mg-r-5">Zip File</a>`
                        }
                        if (data.action_menu.close == 1) {
                            follup += `<button id="close_claim" style="text-decoration: none;" class="btn btn-outline-primary mg-r-5" type="button">Close</button>`
                        }
                        return follup;
                    }
                }
            ],
            "order": [
                [0, 'asc']
            ]
        });

        $('#table-data tbody').on('click', '#close_claim', function() {
            const { rf_period_id, rf_period } = table.row($(this).parents('tr')).data();
            const data = { 
                rf_period_id
            };
            
            alertify.confirm('Confirmation', `Are you sure want to close this RF ${rf_period} ?`, function(){  
                $.ajax({
                    url     : '{{ route("claim_processing_close") }}',
                    method  : 'POST',
                    data,
                    datatype: "json",
                    headers : {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    success: function (res) {
                        console.log(res);
                        $.LoadingOverlay('hide');
                        if (res.result === 'SUCCESS') {
                            table.ajax.reload();
                            amaran_success(res.message)
                        } else {
                            amaran_error(res.message)
                        }
                    }
                })
            }, "");
        })

        $('#table-data tbody').on('click', '#initiate_claim', function() {
            const { rf_period_id, rf_period } = table.row($(this).parents('tr')).data();
            const data = { 
                rf_period_id
            };
            
            alertify.confirm('Confirmation', `Are you sure want to request PON this claim RF ${rf_period} ?`, function(){  
                $.ajax({
                    url     : '{{ route("claim_processing_initiate") }}',
                    method  : 'POST',
                    data,
                    datatype: "json",
                    headers : {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    success: function (res) {
                        console.log(res);
                        $.LoadingOverlay('hide');
                        if (res.result === 'SUCCESS') {
                            table.ajax.reload();
                            amaran_success(res.message)
                        } else {
                            amaran_error(res.message)
                        }
                    }
                })
            }, "");
        })
        
        $('#table-data tbody').on('click', '#generate-pp', function() {
            const { rf_period_id } = table.row($(this).parents('tr')).data();
            $("#submission_date").val("");
            $("#rf_period_id").val(rf_period_id);
            $("#modal-download_pp").modal("show");
            
        })

        $("#submit-download_pp").click( function () {  
            const date = $("#submission_date").val();
            const id = $("#rf_period_id").val();
            if (date == "") {
                amaran_error("Please Fill Required Field")
                return
            }
            window.location.href = `/claim-processing/generate-pp/${id}?date=${date}`;
            $("#modal-download_pp").modal("hide");
            amaran_success("Downloading");
        } )
    </script>
@endsection
