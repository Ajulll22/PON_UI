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
                <h4 class="tx-gray-800">Claim Category</h4>
                <h6 class="ml-2">List Claim Category</h6>
            </div>
        </div>
        <button class='btn-scale my-auto rounded-xl btn btn-primary modal-add'><i class="fas fa-plus"></i> Add Item
        </button>
    </div>
@endsection

@section('body_content')
    <div class="card-border p-4">
        <div class="table-wrapper">
            <table id="table-data" class="table display responsive nowrap" style="width: 100%;">
                <thead>
                    <tr>
                        <th class="wd-5p-force">No</th>
                        <th>Claim Name</th>
                        <th>Status</th>
                        <th>PM</th>
                        <th>HRD</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    {{-- Modal Add  --}}
    <div id="modal-claim-category" class="modal fade" data-value=''>
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content tx-size-sm">
                <div class="modal-header pd-x-20">
                    <h5></h5>
                    <h6 class="tx-20 mg-b-0 tx-inverse tx-bold"> <i class="fa fa-plus mg-r-10"></i> Add Claim Category</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body-padding">
                    <div id="validate" class="alert alert-danger" style="display: none" role="alert">
                    </div>
                    <form id="form_add_item">
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Claim Name<span
                                    class="tx-danger">*</span></label>
                            <div class="col-sm-9">
                                <input class="form-control rounded-xl" autocomplete="off" name="name" id="name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-3 col-form-label">Active<span
                                    class="tx-danger">*</span></label>
                            <div class="col-sm-9">
                                <select class="form-control rounded-xl" name="active" id="active">
                                    <option value="1">Active</option>
                                    <option value="0">Deactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-3 col-form-label">Claim Description</label>
                            <div class="col-sm-9">
                                <textarea class="form-control rounded-xl" name="description" id="description" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-3 col-form-label">Follow Up To</label>
                            <div class="col-sm-9 pt-2 row">
                                @foreach ($data['approval_list'] as $item)
                                    <div class="form-check col-sm-6">
                                        <input id="approval_phase_{{ $item['claim_request_phase_id'] }}"
                                            name="approval_phase" type="checkbox"
                                            value="{{ $item['claim_request_phase_id'] }}"
                                            {{ $item['claim_request_phase_id'] == 4 || $item['claim_request_phase_id'] == 5 ? '' : ($item['claim_request_phase_id'] == 6 ? 'disabled' : 'disabled checked') }}>
                                        <label class="form-check-label" for="pm">
                                            {{ str_replace(' Approval', '', $item['name']) }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div id="hrd_create" class="form-group row">

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

    {{-- Modal Edit  --}}
    <div id="modal-claim-category_edit" class="modal fade" data-value=''>
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content tx-size-sm">
                <div class="modal-header pd-x-20">
                    <h5></h5>
                    <h6 class="tx-20 mg-b-0 tx-inverse tx-bold">Edit Claim Category
                    </h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body-padding">
                    <div id="validate_edit" class="alert alert-danger" style="display: none" role="alert">
                    </div>
                    <form id="form_edit_item">

                        <input type="text" name="claim_category_id" id="edit-claim_category_id" hidden>

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Claim Name<span
                                    class="tx-danger">*</span></label>
                            <div class="col-sm-9">
                                <input class="form-control rounded-xl" autocomplete="off" name="name" id="edit-name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-3 col-form-label">Active<span
                                    class="tx-danger">*</span></label>
                            <div class="col-sm-9">
                                <select class="form-control rounded-xl" name="active" id="edit-active">
                                    <option value="1">Active</option>
                                    <option value="0">Deactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-3 col-form-label">Claim Description</label>
                            <div class="col-sm-9">
                                <textarea class="form-control rounded-xl" name="description" id="edit-description" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-3 col-form-label">Follow Up To</label>
                            <div class="col-sm-9 pt-2 row">
                                @foreach ($data['approval_list'] as $item)
                                    <div class="form-check col-sm-6">
                                        <input id="edit-approval_phase_{{ $item['claim_request_phase_id'] }}"
                                            name="edit-approval_phase" type="checkbox"
                                            value="{{ $item['claim_request_phase_id'] }}"
                                            {{ $item['claim_request_phase_id'] == 4 || $item['claim_request_phase_id'] == 5 ? '' : ($item['claim_request_phase_id'] == 6 ? 'disabled' : 'disabled checked') }}>
                                        <label class="form-check-label" for="pm">
                                            {{ str_replace(' Approval', '', $item['name']) }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div id="hrd_edit" class="form-group row">

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

    {{-- Modal Delete  --}}
    <div id="modal-claim_category_delete" class="modal fade" data-value=''>
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
                                <h5 class="alert-title">Delete Item <span class="name-delete"></span> ?</h5>
                                <p class="alert-text mg-b-0-force">Are You Sure Want To Delete This Item ?</p>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <input type="text" name="claim_category_id" id="delete-claim_category_id" hidden>
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
        })

        const hrd_list = @json($data["hrd_list"]);

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
                'url': "{{ route('claim_category_list') }}",
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
                    data: "name"
                },
                {
                    data: "active"
                },
                {
                    data: "approval_phase.2.selected"
                },
                {
                    data: "approval_phase.3.selected"
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
                    targets: [2],
                    data: null,
                    render: function(data) {
                        let follup = ""
                        if (data == 1) {
                            follup = `
                                <svg class="ml-2" width="16" height="14" viewBox="0 0 16 14" fill="none" xmlns="http://www.w3.org/2000/svg">
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
                    targets: [-2, -3],
                    data: null,
                    render: function(data) {
                        let follup = ""
                        if (data == 1) {
                            follup = `
                                <svg class="ml-2" width="16" height="14" viewBox="0 0 16 14" fill="none" xmlns="http://www.w3.org/2000/svg">
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
                        let follup =
                            `<button id="edit-modal-show" style="text-decoration: none;" class="btn btn-outline-primary mg-r-5" type="button" title="Edit Item"><span class="icon ion-compose"></span></button>`
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

        // Handle Change
        $("#approval_phase_5").change((e) => {
            $("#approval_phase_6").prop("checked", e.currentTarget.checked)
            if (e.currentTarget.checked) {
                let hrdListHtml = "";
                hrd_list.forEach(element => {
                    hrdListHtml += `<option value="${element.user_id}">${element.user_firstname} ${element.user_lastname}</option>`
                });
                $("#hrd_create").html(`
                    <label for="inputPassword3" class="col-sm-3 col-form-label">HRD<span
                            class="tx-danger">*</span></label>
                    <div class="col-sm-9">
                        <select id="hrd_id" class="form-control rounded-xl" name="active" required>
                            <option value="">Pilih HRD</option>
                            ${hrdListHtml}
                        </select>
                    </div>
                `);
            } else {
                $("#hrd_create").html("")
            }
        })
        $("#edit-approval_phase_5").change((e) => {
            $("#edit-approval_phase_6").prop("checked", e.currentTarget.checked)
            if (e.currentTarget.checked) {
                let hrdListHtml = "";
                hrd_list.forEach(element => {
                    hrdListHtml += `<option value="${element.user_id}">${element.user_firstname} ${element.user_lastname}</option>`
                });
                $("#hrd_edit").html(`
                    <label for="inputPassword3" class="col-sm-3 col-form-label">HRD<span
                            class="tx-danger">*</span></label>
                    <div class="col-sm-9">
                        <select id="edit-hrd_id" class="form-control rounded-xl" name="active" required>
                            <option value="">Pilih HRD</option>
                            ${hrdListHtml}
                        </select>
                    </div>
                `);
            } else {
                $("#hrd_edit").html("")
            }
        })

        // Handle Action
        $("#form_add_item").submit((e) => {
            e.preventDefault()

            const approval_phase = [
                {
                    phase_id: "2",
                    phase_name: "Team Leader Approval",
                    selected: "0",
                    user_approver: null
                },
                {
                    phase_id: "3",
                    phase_name: "Head of Dept. Approval",
                    selected: "0",
                    user_approver: null
                },
                {
                    phase_id: "4",
                    phase_name: "PM Approval",
                    selected: "0",
                    user_approver: null
                },
                {
                    phase_id: "5",
                    phase_name: "HRD Approval",
                    selected: "0",
                    user_approver: null
                },
                {
                    phase_id: "6",
                    phase_name: "Head of HR Approval",
                    selected: "0",
                    user_approver: null
                },
                {
                    phase_id: "7",
                    phase_name: "Finance Approval",
                    selected: "0",
                    user_approver: null
                }
            ]
            
            const check_approval = $.map($('input[name="approval_phase"]:checked'), (item) => item.value);

            approval_phase.forEach(val => {
                if (check_approval.includes(val.phase_id)) {
                    val.selected = "1"
                    if (val.phase_id == "5") {
                        val.user_approver = $("#hrd_id").val()
                    }
                }
            });
            const data = {
                name: $("#name").val(),
                description: $("#description").val(),
                active: $("#active").val(),
                approval_phase
            };

            $.ajax({
                url: '{{ route('claim_category_create') }}',
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
                        $('#modal-claim-category').modal("hide");
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
        $("#form_edit_item").submit((e) => {
            e.preventDefault()
            const approval_phase = [
                {
                    phase_id: "2",
                    phase_name: "Team Leader Approval",
                    selected: "0",
                    user_approver: null
                },
                {
                    phase_id: "3",
                    phase_name: "Head of Dept. Approval",
                    selected: "0",
                    user_approver: null
                },
                {
                    phase_id: "4",
                    phase_name: "PM Approval",
                    selected: "0",
                    user_approver: null
                },
                {
                    phase_id: "5",
                    phase_name: "HRD Approval",
                    selected: "0",
                    user_approver: null
                },
                {
                    phase_id: "6",
                    phase_name: "Head of HR Approval",
                    selected: "0",
                    user_approver: null
                },
                {
                    phase_id: "7",
                    phase_name: "Finance Approval",
                    selected: "0",
                    user_approver: null
                }
            ]
            
            const check_approval = $.map($('input[name="edit-approval_phase"]:checked'), (item) => item.value);

            approval_phase.forEach(val => {
                if (check_approval.includes(val.phase_id)) {
                    val.selected = "1"
                    if (val.phase_id == "5") {
                        val.user_approver = $("#edit-hrd_id").val()
                    }
                }
            });
            
            const data = {
                claim_category_id: $('#edit-claim_category_id').val(),
                name: $("#edit-name").val(),
                description: $("#edit-description").val(),
                active: $("#edit-active").val(),
                approval_phase
            };

            $.ajax({
                url: '{{ route('claim_category_update') }}',
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
                        $('#modal-claim-category_edit').modal("hide");
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
        $("#delete_item").click(() => {
            const data = {
                claim_category_id: $("#delete-claim_category_id").val()
            }
            $.ajax({
                url: '{{ route('claim_category_delete') }}',
                method: 'POST',
                data,
                datatype: "json",
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                success: function(res) {
                    if (res.result === 'SUCCESS') {
                        table.ajax.reload()
                        $('#modal-claim_category_delete').modal("hide");
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
                claim_category_id,
                name
            } = table.row($(this).parents('tr')).data();
            $("#delete-claim_category_id").val(claim_category_id);
            $(".name-delete").text(name);
            $('#modal-claim_category_delete').modal("show");
            $.LoadingOverlay('hide');
        });

        // Modal Edit
        $('#table-data tbody').on('click', '#edit-modal-show', function() {
            $.LoadingOverlay("show");
            const data = table.row($(this).parents('tr')).data();

            $('#edit-claim_category_id').val(data.claim_category_id)

            $('#edit-name').val(data.name);
            $('#edit-description').val(data.description);
            $('#edit-active').val(data.active).trigger('change');

            data.approval_phase.forEach(val => {
                $(`#edit-approval_phase_${val.phase_id}`).prop("checked", val.selected == "1")
                if (val.phase_id == "5") {
                    if (val.selected == "1") {
                        let hrdListHtml = "";
                        hrd_list.forEach(element => {
                            hrdListHtml += `<option value="${element.user_id}" ${val.user_approver == element.user_id ? "selected" : ""} >${element.user_firstname} ${element.user_lastname}</option>`
                        });
                        $("#hrd_edit").html(`
                            <label for="inputPassword3" class="col-sm-3 col-form-label">HRD<span
                                    class="tx-danger">*</span></label>
                            <div class="col-sm-9">
                                <select id="edit-hrd_id" class="form-control rounded-xl" name="active" required>
                                    <option value="">Pilih HRD</option>
                                    ${hrdListHtml}
                                </select>
                            </div>
                        `);
                    } else {
                        $("#hrd_edit").html(``);
                    }
                }
            });

            $('#modal-claim-category_edit').modal("show");
            $.LoadingOverlay('hide');
        })

        // Modal Show
        $(".modal-add").click(() => {
            $.LoadingOverlay("show");
            $('#modal-claim-category').modal("show");
            $.LoadingOverlay('hide');
        })
    </script>
@endsection
