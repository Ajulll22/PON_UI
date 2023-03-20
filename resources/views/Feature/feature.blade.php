@extends('layout')

@section('title')
    <title>PT Prima Vista Solusi | Feature</title>
@endsection

@section('css')
@endsection

@section('header_content')
  <h4 class="tx-gray-800 mg-b-5"><i class="fas fa-cog"></i> Feature</h4>
@endsection

@section('body_content')
<div class="card mg-b-80">
    <div class="card-header bg-transparent pd-l-20-force pd-t-10-force pd-b-10-force row">
        <div class="col-md-6">
            <h3 class="card-title tx-uppercase tx-14 mg-t-7 mg-b-0-force"><i class="fas fa-list"></i> Feature List</h3>
        </div>
        <div class="col-md-6">
        </div>
    </div>
    <div class="br-section-wrapper pd-b-50-force">
        <div class="table-wrapper">
            <table id="feature_datatables" class="table display responsive nowrap" style="width: 100%;">
                <thead>
                    <tr>
                        <th class="wd-5p-force">No</th>
                        <th>Feature name</th>
                        <th>Level Approval</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
        <!-- table-wrapper -->
    </div>
    <!-- br-section-wrapper -->
</div>

<!-- EDIT MODAL -->
<div id="modal_edit_feature" class="modal fade" data-value=''>
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content tx-size-sm">
            <div class="modal-header pd-x-20">
                <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold"> <i class="fa fa-plus mg-r-10"></i>  Edit Feature</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body pd-5-force pd-l-20-force bg-gray-400 ">
                Feature Detail
            </div>
            <form id="form_edit_feature" autocomplete="off">
            	<input type="hidden" name="edit_feature_id" id="edit_feature_id">
                <div class="modal-body pd-20">
                    <div class="form-layout">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-control-label">Feature Name : <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="edit_feature_name" id="edit_feature_name" value="" maxlength="30" placeholder="Enter name" autocomplete="off" readonly="readonly" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group ">
                                    <label class="form-control-label">Feature Level : <span class="tx-danger">*</span></label>
                                    <select class="form-control" name="edit_feature_level" id="edit_feature_level">
                                    	@for ($i = 1; $i <=3 ; $i++)
                                    		<option value="{{ $i }}">{{ $i }}</option>
                                    	@endfor
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- row -->
                    </div>
                    <!-- form-layout -->
                </div>
                <div class="modal-footer pd-8-force">
                    <button type="button" class="btn btn-dark tx-size-xs pd-t-7-force pd-b-7-force" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary tx-size-xs pd-t-7-force pd-b-7-force">Update Feature</button>
                </div>
                <!-- modal-footer -->
            </form>
        </div>
    </div>
    <!-- modal-dialog -->
</div>
<!--END EDIT MODAL -->
@endsection

@section('javascript')
<script>
    $(document).ready(function() {
        $('.dataTables_length select').select2({
            minimumResultsForSearch: Infinity
        });

        $.fn.dataTable.ext.errMode = function ( settings, helpPage, message ) { 
            if(message!=""){
                amaran_error();
            }
        };
         $('#edit_feature_level').select2({
            placeholder: "select level",
            width: '100%',
            minimumResultsForSearch: -1,
        }).on('change', function(event){
        });
    });

    var table = $('#feature_datatables').DataTable({
      ajax: {
        'url': "{{ route('feature-list') }}",
        'dataSrc': 'feature_list'
      },
      scrollX:true,
      scrollCollapse : true,
      deferRender: true,
      processing:true,
      columns: [{
          data: null
        },
        {
          data: "feature_name"
        },
        {
          data: null,
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
        data:null,
        render: function (data, type, full,meta) {
          return meta.row+1;
        }
      },
      {
        searchable: false,
        sortable: true,
        targets: 2,
        data:null,
        render: function (data, type, full,meta) {
            var result = '';
            if(data.feature_level==1){
                result = data.feature_level+' (<strong class="tx-danger"> SAVE IMMEDIATELY </strong>)';
            }else if (data.feature_level==2) {
                result = data.feature_level+' (<strong class="tx-warning"> REQUEST</strong>, <strong class="tx-success">APPROVAL</strong>)';
            }else if (data.feature_level==3) {
                result = data.feature_level+' (<strong class="tx-warning"> REQUEST</strong>, <strong class="tx-info">VERIFY </strong>, <strong class="tx-success">APPROVAL</strong>)';
            }

            return result;
        }
      },
      {
        targets: -1,
        data: null,
        sortable: true,
        render: function (data, type, full) {
            var result        = '<button style="text-decoration: none;" class="btn btn-outline-primary mg-r-5 btn-user-click-update" type="button" data-toggle="tooltip" data-placement="top" title="Edit Feature Level"><span class="icon ion-compose"></span></button>';
            return result;
        }
      }],
      "order": [[ 0, 'asc' ]]
    });

    // EDIT FEATURE
    $('#feature_datatables tbody').on('click', '.btn-user-click-update', function() {
        $.LoadingOverlay("show");
        $('#form_edit_feature')[0].reset();

        var instance = $('#form_edit_feature').parsley();
        instance.reset();

        var data = table.row($(this).parents('tr')).data();
        $('#edit_feature_id').val(data.feature_id);
        $('#edit_feature_name').val(data.feature_name);
        $('#edit_feature_level').val(data.feature_level).trigger('change');
        $('#modal_edit_feature').modal('show');
        $.LoadingOverlay("hide");
    });

    var frm = $('#form_edit_feature');
    frm.submit(function(e) {
        e.preventDefault();

        var feature_id    = $('#edit_feature_id').val();
        var feature_name  = $('#edit_feature_name').val();
        var feature_level = $('#edit_feature_level').val();

        var instance = $('#form_edit_feature').parsley();
        if (instance.validate()) {
            var data = {
            	feature_id 		: feature_id,
                feature_name 	: feature_name,
                feature_level 	: feature_level
            };
            var msg_level ='';
            if (feature_level==1) {
                msg_level='<ol><li>will be save immediately</li></ol>';
            }else if (feature_level==2) {
                msg_level='<ol><li>Request</li><li>approval</li></ol>';
            }else if (feature_level==3) {
                msg_level='<ol><li>Request</li><li>verification</li><li>approval</li></ol>';
            }

            var message = 'Are you sure you want to change <strong>'+feature_name+'</strong> level approval? <br>'+
            'level <strong>'+feature_name+'</strong> going through '+feature_level+' level'+msg_level;
            alertify.confirm(header_confirm,message, function () {
                $.ajax({
                    url: '{{ route("feature-update") }}',
                    method: 'POST',
                    data: data,
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    datatype: "json",
                    success: function(msg) {
                        $.LoadingOverlay('hide');
                        if (msg['{{ config('constants.result') }}'] == "FAILED") {
                            amaran_error(msg.message);
                        } else if (msg['{{ config('constants.result') }}'] == "SUCCESS") {
                            amaran_success(msg.message);
                            $('#form_edit_feature')[0].reset();
                            table.ajax.reload();
                            $('#modal_edit_feature').modal('hide');
                        } else {
                            amaran_error('Oops, Something went wrong!');
                        }
                    },
                    error: function() {
                        $.LoadingOverlay('hide');
                        // amaran_error('Something went wrong, please contact technical support!');
                    }
                });
            }, function(){}).set('reverseButtons', true);

        } else {
            amaran_error('Failed, please check your input!');
        }
    });

    // END EDIT FEATURE

</script>
@endsection