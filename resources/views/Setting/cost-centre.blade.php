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
                <h4 class="tx-gray-800">Cost Centre</h4>
                <h6 class="ml-2">List Cost Centre</h6>
            </div>
        </div>
        <div class="d-flex justify-content-end">
            <button class='btn-scale my-auto rounded-xl btn btn-primary modal-add mx-1'><i class="fas fa-plus"></i> Add Item
            </button>
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
                        <th>Main Division</th>
                        <th>Division I</th>
                        <th>Division II</th>
                        <th>Number</th>
                        <th>Code</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="table-common" id="data-cost_centre">

                </tbody>
            </table>
        </div>
    </div>

    {{-- Modal Add --}}
    <div id="modal-cost_centre_add" class="modal fade" data-value=''>
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content tx-size-sm">
                <div class="modal-header pd-x-20">
                    <h5></h5>
                    <h6 class="tx-20 mg-b-0 tx-inverse tx-bold"> <i class="fa fa-plus mg-r-10"></i> Add Cost Centre</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body-padding">
                    <div id="validate-add" class="alert alert-danger" style="display: none" role="alert">
                    </div>
                    <form id="form_add_item">

                        <div class="form-layout">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-control-label">Cost Centre Type <span
                                                class="tx-danger">*</span></label>
                                        <select class="form-control rounded-xl" name="cost_centre_type"
                                            id="cost_centre_type-add">
                                            <option value="main_division">Main Division</option>
                                            <option value="division_1">Division I</option>
                                            <option value="division_2">Division II</option>
                                        </select>
                                    </div>
                                </div>
                                <div id="main_division_choice-add" class="col-md-4" style="display: none">
                                    <div class="form-group">
                                        <label class="form-control-label">Main Division <span
                                                class="tx-danger">*</span></label>
                                        <select class="form-control rounded-xl" name="main_division" id="main_division-add">
                                        </select>
                                    </div>
                                </div>
                                <div id="division_1_choice-add" class="col-md-4" style="display: none">
                                    <div class="form-group">
                                        <label class="form-control-label">Division I <span
                                                class="tx-danger">*</span></label>
                                        <select class="form-control rounded-xl" name="division_1" id="division_1-add">
                                            <option value="">Select Division I</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Name <span class="tx-danger">*</span></label>
                                        <input placeholder="Cost Centre Name" class="form-control rounded-xl" type="text"
                                            name="cost_centre_name" id="cost_centre_name-add" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-control-label">Code <span class="tx-danger">*</span></label>
                                        <input placeholder="Ex : BOD" class="form-control rounded-xl" type="text"
                                            name="cost_centre_code" id="cost_centre_code-add" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-control-label">Number <span class="tx-danger">*</span></label>
                                        <input placeholder="Ex : W01000" class="form-control rounded-xl" type="text"
                                            name="cost_centre_number" id="cost_centre_number-add" autocomplete="off">
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
    <div id="modal-cost_centre_edit" class="modal fade" data-value=''>
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content tx-size-sm">
                <div class="modal-header pd-x-20">
                    <h5></h5>
                    <h6 class="tx-20 mg-b-0 tx-inverse tx-bold">Edit Cost Centre</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body-padding">
                    <div id="validate-edit" class="alert alert-danger" style="display: none" role="alert">
                    </div>
                    <form id="form_edit_item">

                        <input type="text" name="cost_centre_id-edit" id="cost_centre_id-edit" hidden>

                        <div class="form-layout">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-control-label">Cost Centre Type <span
                                                class="tx-danger">*</span></label>
                                        <select class="form-control rounded-xl" name="cost_centre_type"
                                            id="cost_centre_type-edit">
                                            <option value="main_division">Main Division</option>
                                            <option value="division_1">Division I</option>
                                            <option value="division_2">Division II</option>
                                        </select>
                                    </div>
                                </div>
                                <div id="main_division_choice-edit" class="col-md-4" style="display: none">
                                    <div class="form-group">
                                        <label class="form-control-label">Main Division <span
                                                class="tx-danger">*</span></label>
                                        <select class="form-control rounded-xl" name="main_division"
                                            id="main_division-edit">
                                        </select>
                                    </div>
                                </div>
                                <div id="division_1_choice-edit" class="col-md-4" style="display: none">
                                    <div class="form-group">
                                        <label class="form-control-label">Division I <span
                                                class="tx-danger">*</span></label>
                                        <select class="form-control rounded-xl" name="division_1" id="division_1-edit">
                                            <option value="">Select Division I</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Name <span class="tx-danger">*</span></label>
                                        <input placeholder="Cost Centre Name" class="form-control rounded-xl"
                                            type="text" name="cost_centre_name" id="cost_centre_name-edit"
                                            autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-control-label">Code <span class="tx-danger">*</span></label>
                                        <input placeholder="Ex : BOD" class="form-control rounded-xl" type="text"
                                            name="cost_centre_code" id="cost_centre_code-edit" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-control-label">Number <span class="tx-danger">*</span></label>
                                        <input placeholder="Ex : W01000" class="form-control rounded-xl" type="text"
                                            name="cost_centre_number" id="cost_centre_number-edit" autocomplete="off">
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
    <div id="modal-cost_centre_delete" class="modal fade" data-value=''>
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
                        <input type="text" name="cost_centre_id" id="delete-cost_centre_id" hidden>
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
        $(document).ready(function() {})

        let cost_centre_list = @json($data['cost_centre_list'])

        // Edit Type Function
        function editMainDiv(id) {
            $('#cost_centre_type-edit').val("main_division").trigger("change")
            const {
                cost_centre_name,
                cost_centre_code,
                cost_centre_number
            } = cost_centre_list.find(row => row.cost_centre_id == id)
            $('#cost_centre_id-edit').val(id)
            $('#cost_centre_name-edit').val(cost_centre_name)
            $('#cost_centre_code-edit').val(cost_centre_code)
            $('#cost_centre_number-edit').val(cost_centre_number)

            $('#modal-cost_centre_edit').modal("show")
        }

        function editDiv1(idMainDiv, id) {
            $('#cost_centre_type-edit').val("division_1").trigger("change")
            const dataMainDiv = cost_centre_list.find(row => row.cost_centre_id == idMainDiv)
            const {
                cost_centre_name,
                cost_centre_code,
                cost_centre_number
            } = dataMainDiv.division.find(row => row.cost_centre_id == id)
            $('#cost_centre_id-edit').val(id)
            $('#cost_centre_name-edit').val(cost_centre_name)
            $('#cost_centre_code-edit').val(cost_centre_code)
            $('#cost_centre_number-edit').val(cost_centre_number)
            $('#main_division-edit').val(idMainDiv).trigger("change")

            $('#modal-cost_centre_edit').modal("show")
        }

        function editDiv2(idMainDiv, idDiv1, id) {
            $('#cost_centre_type-edit').val("division_2").trigger("change")
            const dataMainDiv = cost_centre_list.find(row => row.cost_centre_id == idMainDiv)
            const dataDiv1 = dataMainDiv.division.find(row => row.cost_centre_id == idDiv1)
            const {
                cost_centre_name,
                cost_centre_code,
                cost_centre_number
            } = dataDiv1.division.find(row => row.cost_centre_id == id)
            $('#cost_centre_id-edit').val(id)
            $('#cost_centre_name-edit').val(cost_centre_name)
            $('#cost_centre_code-edit').val(cost_centre_code)
            $('#cost_centre_number-edit').val(cost_centre_number)
            $('#main_division-edit').val(idMainDiv).trigger("change")
            $('#division_1-edit').val(idDiv1).trigger("change")

            $('#modal-cost_centre_edit').modal("show")
        }

        function refreshTable(data) {

            let tbody_html = ""
            let no = 1
            $.each(data, function(i, main_division) {
                tbody_html += `<tr>
            <td>${no}</td>
            <td>${main_division.cost_centre_name}</td>
            <td></td>
            <td></td>
            <td>${main_division.cost_centre_number}</td>
            <td>${main_division.cost_centre_code}</td>
            <td>
                <button onclick="editMainDiv(${main_division.cost_centre_id})" id="edit-modal-show" style="text-decoration: none;" class="btn btn-outline-primary py-1 mg-r-5" type="button" title="Edit Item"><span class="icon ion-compose"></span></button>
                <button data-name="${main_division.cost_centre_name}" data-id=${main_division.cost_centre_id} id="delete-modal-show" style="text-decoration: none;" class="btn btn-outline-danger py-1 mg-r-5" type="button" title="Delete Item"><span class="icon ion-trash-a"></span></button>
            </td>
        </tr>`
                if (main_division.division) {
                    $.each(main_division.division, function(i, division_1) {
                        tbody_html += `<tr>
                    <td></td>
                    <td></td>
                    <td>${division_1.cost_centre_name}</td>
                    <td></td>
                    <td>${division_1.cost_centre_number}</td>
                    <td>${division_1.cost_centre_code}</td>
                    <td>
                        <button onclick="editDiv1(${main_division.cost_centre_id}, ${division_1.cost_centre_id})" id="edit-modal-show" style="text-decoration: none;" class="btn btn-outline-primary py-1 mg-r-5" type="button" title="Edit Item"><span class="icon ion-compose"></span></button>
                        <button data-name="${division_1.cost_centre_name}" data-id=${division_1.cost_centre_id} id="delete-modal-show" style="text-decoration: none;" class="btn btn-outline-danger py-1 mg-r-5" type="button" title="Delete Item"><span class="icon ion-trash-a"></span></button>
                    </td>
                </tr>`
                        if (division_1.division) {
                            $.each(division_1.division, function(i, division_2) {
                                tbody_html += `<tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>${division_2.cost_centre_name}</td>
                        <td>${division_2.cost_centre_number}</td>
                        <td>${division_2.cost_centre_code}</td>
                        <td>
                            <button onclick="editDiv2(${main_division.cost_centre_id}, ${division_1.cost_centre_id}, ${division_2.cost_centre_id})" id="edit-modal-show" style="text-decoration: none;" class="btn btn-outline-primary py-1 mg-r-5" type="button" title="Edit Item"><span class="icon ion-compose"></span></button>
                            <button data-name="${division_2.cost_centre_name}" data-id=${division_2.cost_centre_id} id="delete-modal-show" style="text-decoration: none;" class="btn btn-outline-danger py-1 mg-r-5" type="button" title="Delete Item"><span class="icon ion-trash-a"></span></button>
                        </td>
                    </tr>`
                            })
                        }
                    })
                }
                no++
            })
            $('#data-cost_centre').html(tbody_html)

        }

        function refreshCostCentreChoice(data) {
            let mainDivisionOptionAdd = $('#main_division-add')
            let mainDivisionOptionEdit = $('#main_division-edit')
            mainDivisionOptionAdd.empty()
            mainDivisionOptionEdit.empty()
            mainDivisionOptionAdd.append(new Option("Select Main Division", ""))
            mainDivisionOptionEdit.append(new Option("Select Main Division", ""))
            $.each(data, (i, item) => {
                mainDivisionOptionAdd.append(new Option(item.cost_centre_name, item.cost_centre_id))
                mainDivisionOptionEdit.append(new Option(item.cost_centre_name, item.cost_centre_id))
            })
        }

        function refreshData() {
            $.ajax({
                url: '{{ route('cost_centre_list') }}',
                method: 'GET',
                datatype: "json",
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                success: function(res) {

                    cost_centre_list = res.data
                    refreshTable(res.data);
                    refreshCostCentreChoice(res.data)
                }
            })
        }

        refreshCostCentreChoice(cost_centre_list)
        refreshTable(cost_centre_list)

        // Change Action 
        $('#cost_centre_type-add').change(function() {
            const type = $(this).val()
            if (type === "main_division") {
                $('#main_division_choice-add').fadeOut("fast");
                $('#division_1_choice-add').fadeOut("fast");
            } else if (type === "division_1") {
                $('#main_division_choice-add').fadeIn("fast");
                $('#division_1_choice-add').fadeOut("fast");
            } else {
                $('#main_division_choice-add').fadeIn("fast");
                $('#division_1_choice-add').fadeIn("fast");
            }
        });
        $('#main_division-add').change(function() {
            const type = $('#cost_centre_type-add').val()

            const cost_centre_id = $(this).val()
            let Division1Option = $('#division_1-add')
            Division1Option.empty()
            if (cost_centre_id == "") {
                Division1Option.append(new Option("Select Division I", ""))
                return
            }
            Division1Option.append(new Option("Select Division I", ""))

            const division1ListFilter = cost_centre_list.find(row => row.cost_centre_id === cost_centre_id)
            if (division1ListFilter.division) {
                $.each(division1ListFilter.division, (i, item) => {
                    Division1Option.append(new Option(item.cost_centre_name,
                        item
                        .cost_centre_id))
                })
            }
        })

        $('#cost_centre_type-edit').change(function() {
            const type = $(this).val()
            if (type === "main_division") {
                $('#main_division_choice-edit').fadeOut("fast");
                $('#division_1_choice-edit').fadeOut("fast");
            } else if (type === "division_1") {
                $('#main_division_choice-edit').fadeIn("fast");
                $('#division_1_choice-edit').fadeOut("fast");
            } else {
                $('#main_division_choice-edit').fadeIn("fast");
                $('#division_1_choice-edit').fadeIn("fast");
            }
        });
        $('#main_division-edit').change(function() {
            const type = $('#cost_centre_type-edit').val()
            const cost_centre_id = $(this).val()
            let Division1Option = $('#division_1-edit')
            Division1Option.empty()
            if (cost_centre_id == "") {
                Division1Option.append(new Option("Select Division I", ""))
                return
            }
            Division1Option.append(new Option("Select Division I", ""))

            const division1ListFilter = cost_centre_list.find(row => row.cost_centre_id === cost_centre_id)
            if (division1ListFilter.division) {
                $.each(division1ListFilter.division, (i, item) => {
                    Division1Option.append(new Option(item.cost_centre_name,
                        item
                        .cost_centre_id))
                })
            }
        })

        // Submit Action
        $("#form_add_item").submit((e) => {
            e.preventDefault()

            const cost_centre_type = $('#cost_centre_type-add').val()
            const data = {
                cost_centre_name: $('#cost_centre_name-add').val(),
                cost_centre_number: $('#cost_centre_number-add').val(),
                cost_centre_code: $('#cost_centre_code-add').val(),
                cost_centre_parent_id: ""
            }

            var listErr = ""

            if (cost_centre_type === "division_1") {
                let cost_centre_parent_id = $('#main_division-add').val()
                if (cost_centre_parent_id === "") {
                    listErr =
                        "<li><strong>Main Division Field Is Required When Cost Centre Type Division I</strong></li>"
                }
                data.cost_centre_parent_id = cost_centre_parent_id
            } else if (cost_centre_type === "division_2") {
                let cost_centre_parent_id = $('#division_1-add').val()
                if (cost_centre_parent_id === "") {
                    listErr =
                        "<li><strong>Division I Field Is Required When Cost Centre Type Division II</strong></li>"
                }
                data.cost_centre_parent_id = cost_centre_parent_id
            }
            if (listErr !== "") {
                $('#validate-add').html(listErr)
                $('#validate-add').fadeIn("slow");
                setTimeout(function() {
                    $("#validate-add").fadeOut("slow");
                }, 3000);
                return
            }

            $.ajax({
                url: '{{ route('cost_centre_create') }}',
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
                        $('#validate-add').html(listErr)
                        $('#validate-add').fadeIn("slow");
                        setTimeout(function() {
                            $("#validate-add").fadeOut("slow");
                        }, 3000);
                        return
                    } else if (res.result === 'SUCCESS') {
                        $('#form_add_item').trigger("reset");
                        $('#cost_centre_type-add').val("main_division").trigger("change")
                        refreshData()
                        $('#modal-cost_centre_add').modal("hide");
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

            const cost_centre_type = $('#cost_centre_type-edit').val()
            const data = {
                cost_centre_id: $('#cost_centre_id-edit').val(),
                cost_centre_name: $('#cost_centre_name-edit').val(),
                cost_centre_number: $('#cost_centre_number-edit').val(),
                cost_centre_code: $('#cost_centre_code-edit').val(),
                cost_centre_parent_id: ""
            }

            var listErr = ""

            if (cost_centre_type === "division_1") {
                let cost_centre_parent_id = $('#main_division-edit').val()
                if (cost_centre_parent_id === "") {
                    listErr =
                        "<li><strong>Main Division Field Is Required When Cost Centre Type Division I</strong></li>"
                }
                data.cost_centre_parent_id = cost_centre_parent_id
            } else if (cost_centre_type === "division_2") {
                let cost_centre_parent_id = $('#division_1-edit').val()
                if (cost_centre_parent_id === "") {
                    listErr =
                        "<li><strong>Division I Field Is Required When Cost Centre Type Division II</strong></li>"
                }
                data.cost_centre_parent_id = cost_centre_parent_id
            }
            if (listErr !== "") {
                $('#validate-edit').html(listErr)
                $('#validate-edit').fadeIn("slow");
                setTimeout(function() {
                    $("#validate-edit").fadeOut("slow");
                }, 3000);
                return
            }

            $.ajax({
                url: '{{ route('cost_centre_update') }}',
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
                        $('#validate-edit').html(listErr)
                        $('#validate-edit').fadeIn("slow");
                        setTimeout(function() {
                            $("#validate-edit").fadeOut("slow");
                        }, 3000);
                        return
                    } else if (res.result === 'SUCCESS') {
                        refreshData()
                        $('#modal-cost_centre_edit').modal("hide");
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
        $("#delete_item").click(() => {
            const data = {
                cost_centre_id: $("#delete-cost_centre_id").val()
            }

            $.ajax({
                url: '{{ route('cost_centre_delete') }}',
                method: 'POST',
                data,
                datatype: "json",
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                success: function(res) {
                    if (res.result === 'SUCCESS') {
                        refreshData()
                        $('#modal-cost_centre_delete').modal("hide");
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

        // Modal Add
        $(".modal-add").click(() => {
            $.LoadingOverlay("show");
            $('#modal-cost_centre_add').modal("show");
            $.LoadingOverlay('hide');
        })

        // Modal Delete
        $('#table-data tbody').on('click', '#delete-modal-show', function() {
            const id = $(this).data('id');
            const name = $(this).data('name');

            $('#delete-cost_centre_id').val(id)
            $('.name-delete').text(name)

            $('#modal-cost_centre_delete').modal('show')
        } )
    </script>
@endsection
