@extends('layout')
@section('title')
    <title>Wirecard | Update Profile</title>
@endsection
@section('css')
@endsection
@section('header_content')
    <h4 class="tx-gray-800 mg-b-5"><i class="fas fa-user"></i>  Profile</h4>
@endsection
@section('body_content')

    <div class="tab-content br-profile-body">
        <div class="tab-pane fade active show" id="posts">
            <div class="row">
                <div class="col-lg-4 mg-t-30 mg-lg-t-0">
                    <div class="card pd-20 pd-xs-30 shadow-base bd-0 tx-center">
                        <div class="card-profile-img">
                            <img class="wd-40p mg-b-20" style="border-radius: 50%" avatar="{{ Session::get('user_name') }}">
                        </div>
                        <h4 class="tx-normal tx-roboto">{{ Session::get('user_firstname') }} {{ Session::get('user_lastname') }}</h4>
                        <p class="mg-b-5">{{ Session::get('user_name') }}</p>
                        <p>{{ Session::get('user_email') }}</p>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card pd-20 pd-xs-30 shadow-base bd-0">
                        <form id="form-update-profile">
                            <div class="form-layout">
                                <div class="row mg-b-25">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label">Firstname: <span class="tx-danger">*</span></label>
                                            <input class="form-control" type="text" id="update_firstname" name="update_firstname" value="{{ $data['user_data'][0]['user_firstname'] }}" placeholder="Enter firstname" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-control-label">Lastname: <span class="tx-danger">*</span></label>
                                            <input class="form-control" type="text" id="update_lastname" name="update_lastname" value="{{ $data['user_data'][0]['user_lastname'] }}" placeholder="Enter lastname" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-control-label">Phone Number: <span class="tx-danger">*</span></label>
                                            <input class="form-control" type="number" id="update_phone" name="update_phone" value="{{ $data['user_data'][0]['user_phone'] }}" placeholder="Enter phone number" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-control-label">Nama Bank: <span class="tx-danger">*</span></label>
                                            <select class="form-control" name="update_bank_id" id="update_bank_id">
                                                <option value="">Select Bank Name</option>
                                                @foreach ($data["bank_list"] as $item)
                                                    <option {{$data['user_data'][0]['bank_account']['bank_id'] == $item['id'] ? "selected" : "" }} value="{{$item['id']}}">{{$item['name']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group mg-b-10-force">
                                            <label class="form-control-label">User Address: <span class="tx-danger">*</span></label>
                                            <textarea rows="11" style="max-height: initial;" class="form-control" id="update_address" name="update_address" placeholder="Enter your address" required>{{ $data['user_data'][0]['user_address'] }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-control-label">Account Number: <span class="tx-danger">*</span></label>
                                            <input class="form-control" type="text" id="update_account_number" name="update_account_number" value="{{ $data['user_data'][0]['bank_account']['account_number'] }}" placeholder="Account Number" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label">Account Name: <span class="tx-danger">*</span></label>
                                            <input class="form-control" type="text" id="update_account_name" name="update_account_name" value="{{ $data['user_data'][0]['bank_account']['account_name'] }}" placeholder="Account Name" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label">Team Leader: </label>
                                            <input class="form-control" type="text" id="update_team_leader" name="update_team_leader" value="{{ $data['user_data'][0]['team_leader_name'] }}" placeholder="No Choose Team Lead" disabled>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label">On Leave Status</label>
                                            <div class="form-check d-flex my-auto">
                                                <input id="on_leave"
                                                    name="on_leave" type="checkbox" value="0">
                                                <div><p class="my-auto mx-2 font-italic">Checklist if you're paid leave</p></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="show_substitute" class="col-lg-6" style="display: none">
                                        <div class="form-group">
                                            <label class="form-control-label">Subtitute <span class="tx-danger">*</span></label>
                                            <select class="form-control" name="on_leave_subtitute" id="on_leave_subtitute" >
                                                <option value="">Select Subtitute</option>
                                                @foreach ($data["substitute"] as $item)
                                                    <option value="{{$item['user_id']}}">{{$item['user_fullname']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group mg-b-10-force">
                                            <label class="form-control-label">User Description: <span class="tx-danger">*</span></label>
                                            <textarea rows="4" class="form-control" id="update_description" name="update_description" placeholder="Enter your description" required>{{ $data['user_data'][0]['user_description'] }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-layout-footer tx-right">
                                    <button type="submit" class="btn btn-info btn-update-profile">Update Profile</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- br-pagebody -->

@endsection
@section('javascript')
    <script type="text/javascript">
        $(document).ready(function() {
            $('input[type="checkbox"]').on('change', function() {
                this.value = this.checked ? 1 : 0;
                if (this.id == "on_leave") {
                    if (this.value == 1) {
                        $("#on_leave_subtitute").prop('required',true);
                        $("#show_substitute").show(200)
                    }else {
                        $("#on_leave_subtitute").prop('required',false);
                        $("#show_substitute").hide(200)
                    }
                }
            });

            $("#on_leave").val(on_leave_status.on_leave)
            if (on_leave_status.on_leave == 1) {
                $("#on_leave").prop("checked", true).change();
            }
        })
        // EDIT USER
        var on_leave_status = @json($data['user_data'][0]['on_leave_status']);
        $("#on_leave_subtitute").val(on_leave_status.subtitute_user).change()

        var frm = $('#form-update-profile');
        frm.submit(function (e) {
            e.preventDefault();

            var update_user_name           = "{{ Session::get('user_name') }}";     
            var update_user_firstname      = $('#update_firstname').val();   
            var update_user_lastname       = $('#update_lastname').val();     
            var update_user_description    = $('#update_description').val();
            var update_user_phone          = $('#update_phone').val();     
            var update_user_address        = $('#update_address').val();  

            const bank_id = $('#update_bank_id').val();
            const account_number = $('#update_account_number').val();
            const account_name = $('#update_account_name').val();
            const on_leave = $("#on_leave").val();
            let on_leave_subtitute = ""
            if (on_leave == 1) {
                on_leave_subtitute = $("#on_leave_subtitute").val()
            }

            var data = {
                user_name           : update_user_name,
                user_firstname      : update_user_firstname,
                user_lastname       : update_user_lastname,
                user_description    : update_user_description,
                user_phone          : update_user_phone,
                user_address        : update_user_address,
                bank_id, account_name, account_number,
                on_leave, on_leave_subtitute
            };

            var instance = $('#form-update-profile').parsley();
            if(instance.validate()){
                $.ajax({
                    url     : '{{ route("update-profile") }}',
                    method  : 'POST',
                    data    : data,
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    datatype: "json",
                    success: function (msg) {
                        console.log(msg);
                        $.LoadingOverlay('hide');
                        if (msg['{{ config('constants.result') }}'] == "FAILED") {
                            amaran_error(msg.message);
                        }
                        else if (msg['{{ config('constants.result') }}'] == "SUCCESS") {
                            amaran_success(msg.message);
                            setTimeout(
                                function() {
                                    window.location = "/profile";
                                }, 3000
                            );
                        } else {
                            amaran_error('Oops, Something went wrong!');
                        }
                    },
                    error: function () {
                        $.LoadingOverlay('hide');
                        amaran_error('Something went wrong, please contact technical support!');
                    }
                });
            }
            else{
                amaran_error('Failed, please check your input!');
            }
        });
    </script>

@endsection