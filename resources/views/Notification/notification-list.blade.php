@extends('layout')
@section('title')
    <title>Wirecard | Notification List</title>
@endsection
@section('css')
@endsection
@section('header_content')
    <h4 class="tx-gray-800 mg-b-5"><i class="fas fa-bell"></i>  Notification</h4>
@endsection
@section('body_content')
    <div class="card mg-b-80">
        <div class="card-header bg-transparent pd-l-20-force pd-t-10-force pd-b-10-force row">
            <div class="col-md-6">
                <h3 class="card-title tx-uppercase tx-14 mg-t-7 mg-b-0-force"><i class="fas fa-list"></i> Notification List</h3>
            </div>
            <div class="col-md-6">
            </div>
        </div>
        <div class="br-section-wrapper pd-b-50-force">
            <div class="table-wrapper">
                <table id="notif_datatables" class="table display responsive nowrap" style="width: 100%; cursor: pointer;">
                    <thead>
                        <tr>
                            <th class="wd-5p-force">No</th>
                            <th>Category</th>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Request Time</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('javascript')
<script type="text/javascript">
    $(document).ready(function() {
        $('.dataTables_length select').select2({
            minimumResultsForSearch: Infinity
        });

        $.fn.dataTable.ext.errMode = function(settings, helpPage, message) {
            if (message != "") {
                amaran_error();
            }
        };

        $('.dataTable').on('click', 'tbody td', function() {
            data_category = table.cell({ row: this.parentNode.rowIndex - 1, column : this.cellIndex }).data().data_type.toLowerCase();
            window.location.href = '/approval/'+data_category;
        })
    });

    'use strict';

    var table = $('#notif_datatables').DataTable({
        ajax: {
            'url': "{{ route('notification-list') }}",
            'dataSrc': 'notification_data.result'
        },
        scrollX: true,
        scrollCollapse: true,
        deferRender: true,
        processing: true,
        columns: [{
                data: null
            },
            {
                data: null
            },
            {
                data: null
            },
            {
                data: null
            },
            {
                data: null
            },
            {
                data: null
            }
        ],
        responsive: true,
        language: {
            searchPlaceholder: 'Search...',
            sSearch: '',
            lengthMenu: '_MENU_ items/page',
        },
        columnDefs: [
            {
                searchable: false,
                sortable: true,
                targets: 0,
                data: null,
                render: function(data, type, full, meta) {
                    return meta.row + 1;
                }
            },
            {
                targets: -5,
                sortable: true,
                data: null,
                render: function(data, type, full) {
                    return data.data_type;
                }
            },
            {
                targets: -4,
                sortable: true,
                data: null,
                render: function(data, type, full) {
                    return data.data_name;
                }
            },
            {
                targets: -3,
                sortable: true,
                data: null,
                render: function(data, type, full) {
                    var type_name = data.request_type_name;
                    var status = "";
                    if (type_name == 'ADD') {
                        status = '<span class="tx-success" style="font-weight: bold;">' + type_name + '</span>';
                    } else if (type_name == 'UPDATE') {
                        status = '<span class="tx-warning" style="font-weight: bold;">' + type_name + '</span>';
                    } else if (type_name == 'DELETE') {
                        status = '<span class="tx-danger" style="font-weight: bold;">' + type_name + '</span>';
                    }
                    // return '<a href="showdata/id?'+status+'">Show patient</a>'
                    return status;
                }
            },
            {
                targets: -2,
                sortable: true,
                data: null,
                render: function(data, type, full) {
                    var status_name=data.data_status;
                    var status="";
                    if(status_name=='PENDING'){
                        status ='<span class="label label-danger">'+status_name+'</span><span class="label label-info mg-x-5">NEED VERIFICATION</span>'; 
                    }
                    else if(status_name=='VERIFIED'){
                        status ='<span class="label label-warning">'+status_name+'</span><span class="label label-primary mg-x-5">NEED APPROVAL</span>'; 
                    }
            
                    return status;
                }
            },
            {
                targets: -1,
                sortable: true,
                data: null,
                render: function(data, type, full) {
                    return data.data_datetime;
                }
            }
        ],
        "order": [
            [0, 'asc']
        ]
    });
</script>
@endsection