@extends('layout')

@section('title')
    <title>PT Prima Vista Solusi | Audit Trail</title>
@endsection

@section('css')
	<style type="text/css">
		.buttons-html5{
			cursor: pointer
		}
		tbody tr.clickable{
			cursor: pointer;
		}	
		.ui-datepicker .ui-datepicker-calendar td.ui-datepicker-unselectable .ui-state-default {
		  color: #ccc !important;
		}

		td.details-control {
		    background: url({{ asset('assets/img/iconfinder_arrow-down-01_186411.png') }}) no-repeat center center;
		    cursor: pointer;
		}
		tr.shown td.details-control {
		    background: url({{ asset('assets/img/iconfinder_arrow-up-01_186407.png') }}) no-repeat center center;
		}
	</style>
@endsection
@section('header_content')
<h4 class="tx-gray-800 mg-b-5"><i class="fas fa-archive"></i>  Audit Trail</h4>
@endsection
@section('body_content')
<div class="card mg-b-80">
    <div class="card-header bg-transparent pd-l-20-force pd-t-10-force pd-b-10-force row">
        <div class="col-md-6">
            <h3 class="card-title tx-uppercase tx-14 mg-t-7 mg-b-0-force"><i class="fas fa-list"></i> Audit Trail List</h3>
        </div>
    </div>
    <div class="br-section-wrapper pd-b-5-force ">
    	<div>
		    <form id="form_search_audit">
		        <div class="row pd-b-5">
		            <div class="col-lg-2">
		                <label class="form-control-label">Date: <span class="tx-danger">*</span></label>
		                <input type="text" class="form-control fc-datepicker" id="search_date" placeholder="MM/DD/YYYY" autocomplete="off" required>
		            </div>
		            <div class="col-lg-4">
		                <label class="form-control-label">Username/Email: (optional)</label>
		                <select class="form-control select2" name="user_name" id="select_user_name">
                            <option value=""></option>
                            @foreach ($data['user_list'] as $value)
                                <option value="{{ $value['user_name'] }}">{{ $value['user_email'] }} ({{ $value['user_name'] }})</option>
                            @endforeach
                        </select>
		            </div>
		            <div class="col-lg-4">
		                <label class="form-control-label">Description: (optional)</label>
		                <input class="form-control" type="text" name="search_desc" id="search_desc" placeholder="Enter description" maxlength="30">
		            </div>
		            <div class="col-lg-2 pd-r-0" style="padding-top: 29px">
		                <button id="btn-search" type="button" class="btn btn-primary tx-size-xs wd-75p">
		                    <!-- Text -->
		                    <span id="text_search" style="display: block;">Search</span>
		                    <!-- Load Loader -->
		                    <div id="loader_search" style="display: none; padding-left: 28px">
		                        <div id="load" class="sk-wave tx-4 ht-15">
		                            <div class="sk-rect sk-rect1"></div>
		                            <div class="sk-rect sk-rect2"></div>
		                            <div class="sk-rect sk-rect3"></div>
		                            <div class="sk-rect sk-rect4"></div>
		                            <div class="sk-rect sk-rect5"></div>
		                        </div>
		                    </div>
		                </button>
		                <span id="msg_empty" class="tx-danger" style="display: none">*please input at least 1 field</span>
		            </div>
		        </div>
		    </form>
    	</div>
    </div>
    <div class="br-section-wrapper pd-b-5-force">
        <div class="table-wrapper">
            <table id="audit_datatables" class="table display responsive nowrap" style="width: 100%;">
                <thead>
                    <tr>
                        <th class="wd-5p">No</th>
                        <th>Datetime</th>
                        <th>Username/Email</th>
                        <th>IP Address</th>
                        <th>Activity</th>
                        <th>Status</th>
                        <th class="wd-5p">Details</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection
@section('javascript')
<script src="{{ asset('assets/lib/datatables/buttons/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/lib/datatables/buttons/buttons.flash.min.js') }}"></script>
<script src="{{ asset('assets/lib/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('assets/lib/datatables/buttons/pdfmake.min.js') }}"></script>
<script src="{{ asset('assets/lib/datatables/buttons/vfs_fonts.js') }}"></script>
<script src="{{ asset('assets/lib/datatables/buttons/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/lib/moment/moment.js') }}"></script>
<script src="{{ asset('assets/lib/moment/moment-with-locales.js') }}"></script>

<script>
	$(document).ready(function() {
    // Select2 Initialization
	    $('.dataTables_length select').select2({
	        minimumResultsForSearch: Infinity
	    });

	    $.fn.dataTable.ext.errMode = function(settings, helpPage, message) {
	        if (message != "") {
	            amaran_error();
	        }
	    };

	    $('#select_user_name').select2({
            placeholder: "Select username",
            width: '100%',
            allowClear: true
        }).on('change', function(event){
            
        });
	});

	$('.fc-datepicker').datepicker({
	    showOtherMonths: true,
	    selectOtherMonths: true,
	    dateFormat: 'dd/mm/yy',
	    // changeMonth: true,
	    changeYear: true,
	    maxDate: 0,
        autoclose: true,
	    yearRange: "-100:+0"
	});

	var contains = function(needle) {
	    // Per spec, the way to identify NaN is that it is not equal to itself
	    var findNaN = needle !== needle;
	    var indexOf;

	    if (!findNaN && typeof Array.prototype.indexOf === 'function') {
	        indexOf = Array.prototype.indexOf;
	    } else {
	        indexOf = function(needle) {
	            var i = -1,
	                index = -1;

	            for (i = 0; i < this.length; i++) {
	                var item = this[i];
	                if ((findNaN && item !== item) || item === needle) {
	                    index = i;
	                    break;
	                }
	            }
	            return index;
	        };
	    }

	    return indexOf.call(this, needle) > -1;
	};

	var download_privilege = '<?php echo $data['privilege_menu'][config('constants.AUDIT_DOWNLOAD')] ?>';
	var visibile = "";
	if (download_privilege) {
	    visible = "";
	} else {
	    visible = "d-none";
	}

	var table = $('#audit_datatables').DataTable({
	    responsive: true,
		language: {
		    searchPlaceholder: 'Search...',
		    sSearch: '',
		    lengthMenu: '_MENU_ items/page',
		},
	    dom: 'Blfrtip',
	    buttons: [
		    {
		        extend 		: 'pdfHtml5',
		        title 		: 'Audit Trail Report',
		        text 		: '<i class="fas fa-file-pdf tx-18"></i> Download Report',
		        className 	: 'btn btn-danger btn-sm mg-b-5 disabled d-none'
		    },
		    {
		        extend 		: 'excelHtml5',
		        title 		: 'Audit Trail Report',
		        text 		: '<i class="fas fa-file-pdf tx-18"></i> Download Report',
		        className 	: 'btn btn-danger btn-sm mg-b-5 disabled d-none'
		    }
	    ],
	    // searching: false,
	    deferRender: true
	});


	$('#btn-search').click(function() {

	    var ck_date = $('#search_date').parsley();

	    if (ck_date.isValid()) {
	        ck_date.validate();
	        $("#form_search_audit").submit();
	        ck_date.reset();
	    } else {
	        ck_date.validate();
	    }
	});

	function format_data ( d ) {
    // `d` is the original data object for the row
    	var result = '';
    	for (var i = 0; i < d.audit_trail_description.length; i++) {
    		result+= '<tr><td class="wd-5p">-</td><td>'+d.audit_trail_description[i].replace('\n','<br>')+'</td></tr>';
    	}

	    return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px; width = "-webkit-fill-available">'+
	        result+
	    '</table>';
	}

	function initiate_audit_trail(search_date, username, description) {
	    $('#audit_datatables').DataTable().clear().destroy();
	    var search_date_title = '';

	    if (search_date!='') {
	    	search_date_title = ' - '+moment(search_date, "YYYYMMDD").locale("en-gb").format("LL");
	    }
	    var dt = $('#audit_datatables').DataTable({
	        responsive: true,
            scrollX         : true,
            scrollY         : true,
			language: {
			    searchPlaceholder: 'Search...',
			    sSearch: '',
			    lengthMenu: '_MENU_ items/page',
			},
	        dom: 'Blfrtip',
	        buttons: [
	        {
	            extend 		: 'pdfHtml5',
	            title 		: 'Audit Trail Report ' + search_date_title,
	            text 		: '<i class="fas fa-file-pdf tx-18"></i> <span data-toggle="tooltip" data-placement="bottom" title="Download report as PDF"> PDF</span>',
	            pageSize	: 'A4',
	            // orientation: 'landscape',
	            className 	: 'btn btn-danger btn-sm mg-b-5 '+visible
	        },
	        {
	            extend 		: 'excelHtml5',
	            title 		: 'Audit Trail Report ' + search_date_title,
	            text 		: '<i class="fas fa-file-excel tx-18"></i> <span data-toggle="tooltip" data-placement="bottom" title="Download report as EXCEL"> EXCEL</span>',
	            pageSize	: 'A4',
	            autoFilter 	: true,
	            className 	: 'btn btn-success btn-sm mg-b-5 '+visible
	        },
	        {
	            extend 		: 'csvHtml5',
	            title 		: 'Audit Trail Report ' + search_date_title,
	            text 		: '<i class="fas fa-file-csv tx-18"></i> <span data-toggle="tooltip" data-placement="bottom" title="Download report as CSV"> CSV</span>',
	            pageSize	: 'A4',
	            autoFilter 	: true,
	            className 	: 'btn btn-secondary btn-sm mg-b-5 '+visible
	        }
	        ],
	        // searching: false,
	        deferRender: true,
	        processing: true,
	        ajax: {
	        	method 	: 'POST',
	            url 	: "{{ route('search-audit-trail') }}",
	            headers: {
	                'X-CSRF-TOKEN': "{{ csrf_token() }}"
	            },
	            data 	: {
	            	date_time 	: search_date,
	            	user_name 	: username,
	            	keyword 	: description
	            },
	            dataSrc : 'audit_trail_list'
	        },
	        // "deferRender": true,
	        // "order": [[6, 'asc']],
	        columns: [
	        	{
	                "data": null
	            },
	            {
	                "data": "date_time"
	            },
	            {
	                "data": "audit_trail_user_name"
	            },
	            {
	                "data": "ip_address"
	            },
	            {
	                "data": "activity_name"
	            },
	            {
	                "data": "activity_status"
	            },
	            {
	            	"className"		: 'details-control',
	                "orderable"		: false,
	                "data"			: null,
	                "defaultContent": ''
	            }
	        ],
	        columnDefs: [
	            {
	                searchable: false,
	                sortable: true,
	                targets: 0,
	                data: null,
	                render: function(data, type, full, meta) {
	                    return meta.row + 1;
	                }
	            },{
	            	targets:-1,
	            	data: null,
	            	render: function(data, type, full, meta){
	            		var result ='';
	            		for (var i = 0; i < data.audit_trail_description.length; i++) {
	            			result += '<span style="display:none;">'+data.audit_trail_description[i]+'\r\n</span>';
	            		}

	            		return result;
	            	}
	            }
	        ],
		    createdRow: function (row, data, index) {
	    		$(row).addClass("clickable");
		    }
	    });



	    // Array to track the ids of the details displayed rows
	    var detailRows = [];

	    $('#audit_datatables').find('tbody').off('click', 'tr.clickable');
	    $('#audit_datatables').find('tbody').on('click', 'tr.clickable', function() {
	        var tr = $(this).closest('tr');
	        var row = dt.row(tr);
	        var idx = $.inArray(tr.attr('id'), detailRows);

	        if (row.child.isShown()) {
	            tr.removeClass('details');
	            tr.removeClass('shown');
	            row.child.hide();
	            // Remove from the 'open' array
	            detailRows.splice(idx, 1);
	        } else {
	            tr.addClass('details');
	            tr.addClass('shown');
	            row.child(format_data(row.data())).show();
	            if (idx === -1) {
	                detailRows.push(tr.attr('id'));
	            }
	        }
	    });

	    // On each draw, loop over the `detailRows` array and show any child rows
	    dt.on('draw', function() {
	        $.each(detailRows, function(i, id) {
	            $('#' + id + ' td.details-control').trigger('click');
	        });
	    });

	    $('.dataTables_length select').select2({
	        minimumResultsForSearch: Infinity
	    });
	}

	$("#form_search_audit").submit(function(event) {
	    event.preventDefault();
	    // $("#text_search").css('display', 'none');
	    // $("#loader_search").css('display', 'block');
	    // $("#btn-search").prop('disabled', true);

	    table.clear().draw();
	    var search_date = $('#search_date').val();

	    if (search_date != "") {
	        var split = search_date.split("/");
	        var search_date = split[2] + split[0] + split[1];
	    } else {
	        search_date = "";
	    }

	    var username = $('#select_user_name').val();
	    if (username == "") {
	        username = "empty";
	    }

	    var search_desc = $('#search_desc').val();
	    if (search_desc == "") {
	        search_desc = "empty";
	    }
	    initiate_audit_trail(search_date, username, search_desc);
	});

	//call after load page
	$(function() {
	    // Select2
	    'use strict';
	    $('.dataTables_length select').select2({
	        minimumResultsForSearch: Infinity
	    });
	});
</script>
@endsection