@extends('layout')

@section('title')
    <title>PT Prima Vista Solusi | Setting</title>
@endsection

@section('css')
@endsection

@section('header_content')
    <div class="d-flex justify-content-between mg-b-5">
        <div class="d-flex">
            <svg class="my-auto" width="37" height="37" viewBox="0 0 21 21" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M1.73205 9.5L5.25 3.40673C5.60727 2.78793 6.26752 2.40673 6.98205 2.40673H14.0179C14.7325 2.40673 15.3927 2.78793 15.75 3.40673L19.268 9.5C19.6252 10.1188 19.6252 10.8812 19.268 11.5L15.75 17.5933C15.3927 18.2121 14.7325 18.5933 14.0179 18.5933H6.98205C6.26752 18.5933 5.60727 18.2121 5.25 17.5933L1.73205 11.5C1.37479 10.8812 1.37479 10.1188 1.73205 9.5Z"
                    stroke="#757575" stroke-width="2" />
                <circle cx="10.5" cy="10.5" r="3.5" stroke="#51CBFF" stroke-width="2" />
            </svg>
            <div class="ml-3">
                <h4 class="tx-gray-800">RF Period</h4>
                <h6 class="ml-2">List RF Period</h6>
            </div>
        </div>
        {{-- <div class="d-flex justify-content-end">
            <button class='btn-scale my-auto rounded-xl btn btn-primary modal-add mx-1'><i class="fas fa-plus"></i> Add Item
            </button>
        </div> --}}
    </div>
@endsection

@section('body_content')
    <div class="card-border p-4">
        <div class="table-wrapper">
            <table id="table-data" class="table display responsive nowrap" style="width: 100%;">
                <thead>
                    <tr>
                        <th class="wd-5p-force">No</th>
                        <th>RF Name</th>
                        <th>Active</th>
                        <th>Start Date</th>
                        <th>Due Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    {{-- Modal Add --}}
    <div id="modal-rf-period_add" class="modal fade" data-value=''>
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content tx-size-sm">
                <div class="modal-header pd-x-20">
                    <h5></h5>
                    <h6 class="tx-20 mg-b-0 tx-inverse tx-bold"> <i class="fa fa-plus mg-r-10"></i> Add RF Period</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body-padding">
                    <div id="validate" class="alert alert-danger" style="display: none" role="alert">
                    </div>
                    <form id="form_add_item">
                        <div class="form-layout">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-control-label">RF Name <span class="tx-danger">*</span></label>
                                        <select class="form-control rounded-xl" name="rf_id">
                                            <option value="">Choose RF Name</option>
                                            @foreach ($data['rf_period'] as $item)
                                                <option value="{{ $item['rf_id'] }}">{{ $item['name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Status <span class="tx-danger">*</span></label>
                                        <select class="form-control rounded-xl" name="active">
                                            <option value="1">Active</option>
                                            <option value="0">Deactive</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label class="form-control-label">Start Date <span
                                                class="tx-danger">*</span></label>
                                        <input class="form-control rounded-xl" type="date" name="start_date"
                                            id="start_date" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label class="form-control-label">Due Date <span class="tx-danger">*</span></label>
                                        <input class="form-control rounded-xl" type="date" name="due_date" id="due_date"
                                            autocomplete="off">
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="d-flex justify-content-end">
                            <button name="button" data-dismiss="modal" aria-label="Close"
                                class='rounded-xl btn btn-dark'>Cancel</button>
                            <button name="button" class='rounded-xl btn btn-primary mx-2'>Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Edit --}}
    <div id="modal-rf-period_edit" class="modal fade" data-value=''>
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content tx-size-sm">
                <div class="modal-header pd-x-20">
                    <h5></h5>
                    <h6 class="tx-20 mg-b-0 tx-inverse tx-bold">Edit RF Period</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body-padding">
                    <div id="validate_edit" class="alert alert-danger" style="display: none" role="alert">
                    </div>
                    <form id="form_edit_item">

                        <input type="text" name="rf_period_id" id="edit-rf_period_id" hidden>

                        <div class="form-layout">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">RF Type <span class="tx-danger">*</span></label>
                                        <select class="form-control rounded-xl" id="edit-rf_id" name="rf_id" required>
                                            <option value="">Choose RF Name</option>
                                            @foreach ($data['rf_period'] as $item)
                                                <option value="{{ $item['rf_id'] }}">{{ $item['name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">RF Name <span class="tx-danger">*</span></label>
                                        <input class="form-control rounded-xl" type="text" name="rf_period_name" id="edit-rf_period_name"
                                            autocomplete="off" placeholder="Ex: RF 25 Mei 2023" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Status <span class="tx-danger">*</span></label>
                                        <select class="form-control rounded-xl" id="edit-active" name="active">
                                            <option value="1">Active</option>
                                            <option value="0">Deactive</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label class="form-control-label">Start Date <span
                                                class="tx-danger">*</span></label>
                                        <input oninput="minDate(this.value)" class="form-control rounded-xl" type="date" name="start_date"
                                            id="edit-start_date" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label class="form-control-label">Due Date <span
                                                class="tx-danger">*</span></label>
                                        <input class="form-control rounded-xl" type="date" name="due_date"
                                            id="edit-due_date" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="d-flex justify-content-end">
                            <button name="button" data-dismiss="modal" aria-label="Close"
                                class='rounded-xl btn btn-dark'>Cancel</button>
                            <button name="button" class='rounded-xl btn btn-primary mx-2'>Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Delete --}}
    <div id="modal-rf_period_delete" class="modal fade" data-value=''>
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content tx-size-sm">
                <div class="modal-header pd-x-20">
                    <h5></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body-padding">
                    <div class="alert-delete rounded-xl p-3 mb-3">
                        <div class="d-flex">
                            <svg class="my-auto" width="30" height="30" xmlns="http://www.w3.org/2000/svg"
                                className="h-6 w-6" viewBox="0 0 20 20">
                                <path
                                    d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z">
                                </path>
                            </svg>
                            <div class="ml-2">
                                <h5 class="alert-title">Delete <span class="rf_name-delete"></span> on <span
                                        class="due_date-delete"></span> ?</h5>
                                <p class="alert-text mg-b-0-force">Are You Sure Want To Delete This Item ?</p>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <input type="text" name="rf_period_id" id="delete-rf_period_id" hidden>
                        <button name="button" data-dismiss="modal" aria-label="Close"
                            class='rounded-xl btn btn-dark'>Cancel</button>
                        <button id="delete_item" class='rounded-xl btn btn-danger mx-2'>Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        $(document).ready(function() {
            $('.dataTables_length select').select2({
                minimumResultsForSearch: Infinity
            });

            $('input[type="checkbox"]').on('change', function() {
                this.value = this.checked ? 1 : 0;
            });
        })

        const cobaFind = [{
                id: 1,
                name: "pm"
            },
            {
                id: 2,
                name: "hrd"
            }
        ]

        const pm = cobaFind.find(approveList => approveList.name === "hrd")

        var table_df = $('#table_data_filter').DataTable({
            fixedHeader: true,
            scrollY: "200px",
            scrollCollapse: true,
            bSort: false,
            paging: false,
            autoWidth: false,
            bFilter: false,
            bInfo: false,
            responsive: true
        });
        table_df.columns.adjust().draw();


        var table = $('#table-data').DataTable({
            ajax: {
                'url': "{{ route('rf_period_list') }}",
                'dataSrc': 'data'
            },
            scrollX: true,
            scrollCollapse: true,
            deferRender: true,
            processing: true,
            columns: [{
                    data: null
                },
                {
                    data: "rf_period_name"
                },
                {
                    data: "active"
                },
                {
                    data: "start_date"
                },
                {
                    data: "due_date"
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
                    targets: [3, 4],
                    data: null,
                    render: function(data) {
                        let initial_date = data;
                        initial_date = new Date(initial_date);
                        initial_date = dateformat_ddmmyyyy(initial_date, '/');

                        return initial_date;
                    }
                },
                {
                    searchable: false,
                    sortable: false,
                    targets: 2,
                    data: null,
                    render: function(data) {
                        let follup = ""
                        if (data == 1) {
                            follup = `
                                <svg class="ml-3" width="16" height="14" viewBox="0 0 16 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1.11181 7C0.135159 17.9248 5.61941 11.6306 15.1118 1" stroke="#51CBFF" stroke-width="2"/>
                                </svg>
                            `;
                        }
                        return follup;
                    }
                },
                {
                    searchable: false,
                    sortable: false,
                    targets: -1,
                    data: null,
                    render: function(data) {
                        let follup =`<button id="edit-modal-show" style="text-decoration: none;" class="btn btn-outline-primary mg-r-5" type="button" title="Edit Item"><span class="icon ion-compose"></span></button>`
                        if (data.active != 1) {
                            follup += `<button id="delete-modal-show" style="text-decoration: none;" class="btn btn-outline-danger mg-r-5" type="button" title="Delete Item"><span class="icon ion-trash-a"></span></button>`
                        }
                        return follup;
                    }
                }
            ],
            "order": [
                [0, 'asc']
            ]
        });

        // Handle Action
        $("#form_add_item").submit((e) => {
            e.preventDefault();

            const data = {};
            $("form#form_add_item :input").each(function() {
                let nama = $(this).attr("name");
                let value = $(this).val();
                data[nama] = value || "";
            });
            delete data['button']

            $.ajax({
                url: '{{ route('rf_period_create') }}',
                method: 'POST',
                data,
                datatype: "json",
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                success: function(res) {
                    $.LoadingOverlay('hide');
                    if (res.result === 'error_validate') {
                        var listErr = ""
                        $.each(res.message, function(_, valueOfElement) {
                            $.each(valueOfElement, function(_, valueOfElement) {
                                listErr +=
                                    `<li><strong>${valueOfElement}</strong></li>`
                            });
                        });
                        $('#validate').html(listErr)
                        $('#validate').fadeIn("slow");
                        setTimeout(function() {
                            $("#validate").fadeOut("slow");
                        }, 3000);
                        return
                    } else if (res.result === 'SUCCESS') {
                        table.ajax.reload()
                        $('#form_add_item').trigger("reset");
                        $('#modal-rf-period_add').modal("hide");
                        amaran_success(res.message)
                    } else {
                        amaran_error(res.message)
                    }
                },
                error: function(err) {
                    amaran_error(err)
                }
            });
        });
        $("#form_edit_item").submit((e) => {
            e.preventDefault();

            const data = {};
            $("form#form_edit_item :input").each(function() {
                let nama = $(this).attr("name");
                let value = $(this).val();
                data[nama] = value || "";
            });
            delete data['button']

            $.ajax({
                url: '{{ route('rf_period_update') }}',
                method: 'PUT',
                data,
                datatype: "json",
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                success: function(res) {
                    $.LoadingOverlay('hide');
                    if (res.result === 'error_validate') {
                        var listErr = ""
                        $.each(res.message, function(_, valueOfElement) {
                            $.each(valueOfElement, function(_, valueOfElement) {
                                listErr +=
                                    `<li><strong>${valueOfElement}</strong></li>`
                            });
                        });
                        $('#validate_edit').html(listErr)
                        $('#validate_edit').fadeIn("slow");
                        setTimeout(function() {
                            $("#validate_edit").fadeOut("slow");
                        }, 3000);
                        return
                    } else if (res.result === 'SUCCESS') {
                        table.ajax.reload()
                        $('#form_add_item').trigger("reset");
                        $('#modal-rf-period_edit').modal("hide");
                        amaran_success(res.message)
                    } else {
                        amaran_error(res.message)
                    }
                },
                error: function(err) {
                }
            });
        })
        $("#delete_item").click(() => {
            const data = {
                rf_period_id: $("#delete-rf_period_id").val()
            }
            $.ajax({
                url: '{{ route('rf_period_delete') }}',
                method: 'POST',
                data,
                datatype: "json",
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                success: function(res) {
                    if (res.result === 'SUCCESS') {
                        table.ajax.reload()
                        $('#modal-rf_period_delete').modal("hide");
                        amaran_success(res.message)
                    } else {
                        amaran_error(res.message)
                    }
                },
                error: function(err) {
                    amaran_error(err)
                }
            });
        })

        // Modal Delete
        $('#table-data tbody').on('click', '#delete-modal-show', function() {
            $.LoadingOverlay("show");
            const {
                rf_period_id,
                rf_name,
                due_date
            } = table.row($(this).parents('tr')).data();

            let initial_date = due_date;
            initial_date = new Date(initial_date);
            initial_date = dateformat_ddmmyyyy(initial_date, '/');

            $("#delete-rf_period_id").val(rf_period_id);
            $(".rf_name-delete").text(rf_name);
            $(".due_date-delete").text(initial_date);
            $('#modal-rf_period_delete').modal("show");
            $.LoadingOverlay('hide');
        });

        // Modal Edit
        $('#table-data tbody').on('click', '#edit-modal-show', function() {
            $.LoadingOverlay("show");
            const data = table.row($(this).parents('tr')).data();

            $("#edit-rf_period_id").val(data.rf_period_id);
            $("#edit-rf_period_name").val(data.rf_period_name);
            $("#edit-rf_id").val(data.rf_id);
            $("#edit-active").val(data.active);
            $("#edit-start_date").val(data.start_date).trigger("input");
            $("#edit-due_date").val(data.due_date);

            $.LoadingOverlay("hide");
            $("#modal-rf-period_edit").modal("show");
        })

        // Modal Add
        $(".modal-add").click(() => {
            $.LoadingOverlay("show");
            $('#modal-rf-period_add').modal("show");
            $.LoadingOverlay('hide');
        })

        function minDate(startDate) {
            let date = new Date(startDate)
            date.setDate(date.getDate() + 1);
            
            let min = date.toISOString().split('T')[0];

            $("#edit-due_date").prop("min", `${min}`)
        }
    </script>
@endsection
