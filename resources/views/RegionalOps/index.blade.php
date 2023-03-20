@extends('layout')

@section('title')
    <title>PT Prima Vista Solusi | Claim Request</title>
@endsection

@section('css')
    <style type="text/css">
        .card {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        }

        .buttons-html5 {
            cursor: pointer
        }

        tbody tr.clickable {
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

        .dataTables_wrapper .dataTables_filter {
            visibility: hidden;
        }

        table.dataTable thead th.sorting::before,
        table.dataTable thead th.sorting::after,
        table.dataTable thead th.sorting_asc::before,
        table.dataTable thead th.sorting_desc::before,
        table.dataTable thead th.sorting_asc::after,
        table.dataTable thead th.sorting_desc::after {
            display: none;
        }

        table.dataTable thead>tr>th.sorting_asc,
        table.dataTable thead>tr>th.sorting_desc,
        table.dataTable thead>tr>th.sorting,
        table.dataTable thead>tr>td.sorting_asc,
        table.dataTable thead>tr>td.sorting_desc,
        table.dataTable thead>tr>td.sorting {
            padding-right: 12px;
        }

        #request_item_datatable tfoot>tr>th,
        #request_item_datatable_update tfoot>tr>th {
            border-top: 1px solid #dee2e6 !important;
        }
    </style>
@endsection

@section('header_content')
    <h4 class="tx-gray-800 mg-b-5"><i class="fas fa-paste"></i> Claim Request</h4>
@endsection

@section('body_content')
    <div class="card mg-b-80">
        <div class="card-header bg-transparent pd-l-20-force pd-t-10-force pd-b-10-force row">
            <div class="col-md-6">
                <h3 class="card-title tx-uppercase tx-14 mg-t-7 mg-b-0-force"><i class="fas fa-list"></i> Claim List
                </h3>
            </div>
            <div class="col-md-6">
                <button class='modal-add btn btn-outline-primary add-btn'><i class="fas fa-plus"></i> Add Request </button>
            </div>
        </div>

        <div class="br-section-wrapper pd-b-50-force pd-t-15-force">
            <div class="row mg-b-15"></div>
        </div>
    </div>

    @include('Claim.modalForm')
@endsection

@section('javascript')
    <script>
        var item_detail_array = []

        $(document).ready(function() {
            // SELECT2 DROPDOWN FOR DATATABLES
            $('.dataTables_length select').select2({
                minimumResultsForSearch: Infinity
            });

            $('#data_status').val(0).change();

            $.fn.dataTable.ext.errMode = function(settings, helpPage, message) {
                if (message != "") {
                    amaran_error(message);
                }
            };

            // DATEPICKER INITIALIZATION
            $('input[name="datepicker"]').datepicker({
                format: 'dd/mm/yyyy',
                autoclose: true
            });

            $('input[name="datepicker"').val('');
        });

        var item_request_table = $('#request_item_datatable').DataTable({
            "searching": false,
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
                    .column(4)
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                // Update footer
                $(api.column(4).footer()).html(
                    // $.fn.dataTable.render.number(',', '.', 4).display(total)
                    addComasStatic(Math.round((parseFloat(total) + Number.EPSILON) * 10000) / 10000)
                );
            }
        });

        var buildAddTable = () => {
            for (var i = 0; i < item_detail_array.length; i++) {
                let index_number = i + 1;

                // DATATABLE DATA CONSTRUCTION
                var main_data = '<td style="width: 5%">' + index_number + '</td>' +
                    '<td style="width: 20%">' + item_detail_array[i].claim_date + '</td>' +
                    '<td style="width: 20%">' + item_detail_array[i].claim_type + '</td>' +
                    '<td style="width: 20%">' + item_detail_array[i].reviewed_by + '</td>' +
                    '<td style="width: 20%">' + addComasStatic(Math.round((parseFloat(item_detail_array[i].price) +
                        Number.EPSILON) * 10000) / 10000) + '</td>';

                var menu_bar_header =
                    `<a href="tmp/${item_detail_array[i].file_name}" target="_blank" type="button" style="text-decoration: none;" class="btn btn-outline-primary mg-r-5" data-toggle="tooltip" data-placement="top" title="Preview File" data-original-title="Preview File"><span class="icon ion-eye"></span></a>` +
                    '<button type="button" style="text-decoration: none;" class="btn btn-outline-danger mg-l-5 btn-item-remove" data-toggle="tooltip" data-placement="top" title="Remove Item" data-original-title="Remove Item"><span class="icon ion-trash-a"></span></button>';
                var menu_bar_footer = '</div></div>';
                var button_menu = '';

                button_menu = menu_bar_header + menu_bar_footer;

                last_sequence = i;
                var jRow = $('<tr>').append(main_data, '<td>' + button_menu + '</td>');
                item_request_table.row.add(jRow).draw();
            }
        }

        $('#add_item_button').click(function(event) {
            event.preventDefault();

            let new_item = {};
            let each_total = 0;

            let claim_date = $('#claim_date_add').val();
            let claim_type = $('#claim_type_add').val();
            let reviewed_by = $('#reviewed_by_add').val();
            let description = $('#description_add').val();
            let price = $('#price_add').val();
            var files = $('#file_item')[0].files[0];

            if (claim_date == '' || claim_type == '' || reviewed_by == '' || description == '' || price == '' ||
                files == undefined) {
                amaran_error('Please fill all item fields!');
                return
            }

            var fd = new FormData();
            fd.append('file_item', files);

            $.ajax({
                url: "{{ route('upload_item') }}",
                method: 'POST',
                data: fd,
                datatype: "json",
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                success: function(res) {
                    if (res.success) {
                        new_item['claim_date'] = claim_date;
                        new_item['claim_type'] = claim_type;
                        new_item['reviewed_by'] = reviewed_by;
                        new_item['description'] = description;
                        new_item['price'] = price;
                        new_item['file_name'] = res.file_name;

                        item_detail_array.push(new_item);

                        item_request_table.clear().draw();

                        buildAddTable();

                        $('#claim_date_add').val('');
                        $('#claim_type_add').val('').change();
                        $('#reviewed_by_add').val('');
                        $('#description_add').val('');
                        $('#price_add').val('');
                        $('#file_item').val('');
                    } else {
                        amaran_error('Upload File Failed');
                        return
                    }
                },
                error: function() {
                    amaran_error('Upload File Failed');
                    return
                }
            });
        });

        $('#request_item_datatable tbody').on('click', '.btn-item-remove', function() {
            let index_number = item_request_table.row($(this).parents('tr')).index();
            let data = {
                file_name: item_detail_array[index_number].file_name
            }
            item_detail_array.splice(index_number, 1);

            item_request_table.clear().draw();

            buildAddTable();

            $.ajax({
                type: "POST",
                url: "{{ route('delete_item') }}",
                data: data,
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
            });
        });

        $(".modal-add").on('click', function() {
            $.LoadingOverlay("show");

            $('#modal_add_pon_request').modal("show");
            $.LoadingOverlay('hide');
        })
    </script>
@endsection
