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
                <h4 class="tx-gray-800">Claim Request</h4>
                <h6 class="ml-2">List Claim Request</h6>
            </div>
        </div>
        <div class="d-flex justify-content-end">
            @if ($data['privilege_menu']["CLAIM_REQUEST_PUSAT_ADD"])     
            <button class='btn-scale my-auto rounded-xl btn btn-primary modal-add mx-1'><i class="fas fa-plus"></i> Add Item
            </button>
            @endif
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

    {{-- Modal Add Claim Request --}}
    <div id="modal-claim-request_add" class="modal fade" data-value=''>
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content tx-size-sm">
                <div class="modal-header pd-x-20">
                    <h5></h5>
                    <h6 class="tx-20 mg-b-0 tx-inverse tx-bold"> <i class="fa fa-plus mg-r-10"></i> Add Claim Request</h6>
                    <button type="button" class="close add-cancel_claim" >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body pd-5-force pd-l-20-force bg-gray-400 ">
                    Main Details
                </div>
                <div class="form-layout">
                    <div class="modal-body pd-20" id="pon-request-detail-container">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-control-label">Cost Centre <span class="tx-danger">*</span></label>
                                    <select class="form-control cost_centre rounded-xl" id="cost_centre-add" name="cost_centre"
                                        style="width: 100%" disabled required>
                                        <option value="{{Session::get('cost_centre_id')}}">{{Session::get('cost_centre_name')}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-control-label">Currency <span class="tx-danger">*</span></label>
                                    <select class="form-control currency rounded-xl" id="currency-add" name="currency"
                                        style="width: 100%" required>
                                        @foreach ($data['currency'] as $item)
                                            <option value="{{$item['currency_id']}}">{{$item['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-control-label">RF Period <span class="tx-danger">*</span></label>
                                    <select class="form-control rf_period rounded-xl" id="rf_period-add" name="rf_period"
                                        style="width: 100%" disabled required>
                                        @foreach ($data['current-period'] as $item)
                                            <option value="{{$item['rf_period_id']}}">{{$item['rf_name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="pon_request_file" class="control-label">Support Documents (Ex: Absensi) <span class="tx-danger">*</span></label>
                                <div class="form-group">
                                    <input class="form-control rounded-xl" type="file" multiple
                                        id="support_doc-add"
                                        accept="image/jpeg,image/gif,image/png,application/pdf,image/x-eps"
                                        name="support_doc">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-body pd-5-force pd-l-20-force bg-gray-400 ">
                    Claim Details
                </div>
                <div class="modal-body pd-35 row" style="padding-bottom: 0px">
                    <div class="col-3 nav nav-pills modal-claim-overflow" id="v-pills-tab" role="tablist"
                        aria-orientation="vertical">
                        @foreach ($data['claim_category'] as $item)
                            @if ($item['active'] == '1')
                                <a class="nav-link border w-full @once {{ 'active' }} @endonce shadow-base my-1 rounded-xl"
                                    id="{{ $item['claim_category_id'] }}-tab" data-toggle="pill"
                                    href="#{{ $item['claim_category_id'] }}" role="tab"
                                    aria-controls="{{ $item['claim_category_id'] }}"
                                    aria-selected="true">{{ $item['name'] }} (<span
                                        id="{{ $item['claim_category_id'] }}-jumlah-add">0</span>)</a>
                            @endif
                        @endforeach
                    </div>
                    <div class="col-9 tab-content" id="v-pills-tabContent">
                        <div id="validate-detail" class="alert alert-danger" style="display: none" role="alert">
                        </div>
                        @foreach ($data['claim_category'] as $item)
                            @if ($item['active'] == '1')
                                <div class="tab-pane fade @once {{ 'active' }} @endonce show "
                                    id="{{ $item['claim_category_id'] }}" role="tabpanel"
                                    aria-labelledby="{{ $item['claim_category_id'] }}-tab">
                                    <form onsubmit="return submitItemDetail(event, '{{ $item['claim_category_id'] }}')" id="{{ $item['claim_category_id'] }}-form_add">
                                    <div class="form-layout">
                                        <div class="modal-body pd-20 pd-t-10-force">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label class="form-control-label">Claim Date <span
                                                                class="tx-danger">*</span></label>
                                                        <input type="text"
                                                            class="form-control fc-datepicker rounded-xl"
                                                            name="{{ $item['claim_category_id'] }}-claim_date"
                                                            id="{{ $item['claim_category_id'] }}-claim_date-add"
                                                            placeholder="DD/MM/YYYY" autocomplete="off" required>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label class="form-control-label">Claim Amount <span
                                                                class="tx-danger">*</span></label>
                                                        <input class="form-control rounded-xl" type="text"
                                                            oninput="this.value = formatRupiah(this.value, event)"
                                                            name="{{ $item['claim_category_id'] }}-claim_amount"
                                                            id="{{ $item['claim_category_id'] }}-claim_amount-add"
                                                            placeholder="Enter Price" min="1" step="1" required
                                                            maxlength="15"
                                                            autocomplete="off">
                                                    </div>
                                                </div>
                                            </div>
                                            @if ($item['approval_phase']['4'] == '1')
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label class="form-control-label">PM <span
                                                                class="tx-danger">*</span></label>
                                                        <select class="form-control rounded-xl"
                                                            id="{{ $item['claim_category_id'] }}-pm-add"
                                                            name="{{ $item['claim_category_id'] }}-pm"
                                                            style="width: 100%" required>
                                                            @foreach ($data['pm_list'] as $pm)
                                                                <option value="{{$pm["user_id"]}}">{{$pm["user_firstname"]." ".$pm["user_lastname"]}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="form-control-label">Claim Description <span
                                                            class="tx-danger">*</span></label>
                                                        <textarea class="form-control rounded-xl" type="text" name="{{ $item['claim_category_id'] }}-claim_desc"
                                                            id="{{ $item['claim_category_id'] }}-claim_desc-add" placeholder="Enter Description" maxlength="3000" autocomplete required></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="pon_request_file" class="control-label">Upload Document
                                                        Attachment <span class="tx-danger">*</span></label>
                                                    <div class="form-group">
                                                        <input class="form-control rounded-xl" type="file" required
                                                            accept="image/jpeg,image/gif,image/png,application/pdf,image/x-eps"
                                                            id="{{ $item['claim_category_id'] }}-upload_document-add"
                                                            name="{{ $item['claim_category_id'] }}-upload_document">
                                                    </div>
                                                </div>
                                                <div class="col d-flex justify-content-end" style="padding: 29px;">
                                                    <button name="button" type="submit"
                                                        class='rounded-xl btn btn-primary mx-2'>Add Item</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                </div>
                            @endif
                        @endforeach

                    </div>
                </div>

                <div class="modal-body pd-5-force pd-l-20-force bg-gray-400 ">
                    Summary Claim Items
                </div>
                <div class="form-layout">
                    <div class="modal-body pd-20" id="pon-request-detail-container">
                        <div class="row">
                            <div class="col">
                                <table id="request_item_datatable-add" class="table table-striped table-bordered"
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
                    <button class='add-cancel_claim rounded-xl btn btn-dark'>Cancel</button>
                    <button id="add-save_claim" onclick="SubmitHandler('SAVE')" value="SAVE"
                        class='rounded-xl btn btn-warning mx-2'>Save</button>
                    <button id="add-submit_claim" onclick="SubmitHandler('SUBMIT')" value="SUBMIT"
                        class='rounded-xl btn btn-primary'>Submit</button>
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
                <input id="claim_request_id-edit" type="text" hidden>
                <input id="claim_request_type_id-edit" type="text" hidden>
                <input id="claim_phase_id-edit" type="text" hidden>

                <input id="rf_period_name-edit" type="text" hidden>

                <div class="form-layout">
                    <div class="modal-body pd-20" id="pon-request-detail-container">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-control-label">Cost Centre <span class="tx-danger">*</span></label>
                                    <select class="form-control cost_centre rounded-xl" id="cost_centre-edit" name="cost_centre"
                                        style="width: 100%" disabled required>
                                        <option value="{{Session::get('cost_centre_id')}}">{{Session::get('cost_centre_name')}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-control-label">Currency <span class="tx-danger">*</span></label>
                                    <select class="form-control currency rounded-xl" id="currency-edit" name="currency"
                                        style="width: 100%" required>
                                        @foreach ($data['currency'] as $item)
                                            <option value="{{$item['currency_id']}}">{{$item['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-control-label">RF Period <span class="tx-danger">*</span></label>
                                    <select class="form-control rf_period rounded-xl" id="rf_period-edit" name="rf_period"
                                        style="width: 100%" disabled required>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="pon_request_file" class="control-label">Change Support Documents</label>
                                <div class="form-group">
                                    <input class="form-control rounded-xl" type="file" multiple
                                        id="change_support_doc-edit"
                                        accept="image/jpeg,image/gif,image/png,application/pdf,image/x-eps"
                                        name="support_doc">
                                </div>
                            </div>
                        </div>
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

                <div class="modal-body pd-5-force pd-l-20-force bg-gray-400 ">
                    Claim Details
                </div>
                <div class="modal-body pd-35 row" style="padding-bottom: 0px">
                    <div class="col-3 nav nav-pills modal-claim-overflow" id="v-pills-tab" role="tablist"
                        aria-orientation="vertical">
                        @foreach ($data['claim_category'] as $item)
                            @if ($item['active'] == '1')
                                <a class="nav-link border w-full @once {{ 'active' }} @endonce shadow-base my-1 rounded-xl"
                                    id="{{ $item['claim_category_id'] }}-tab-edit" data-toggle="pill"
                                    href="#{{ $item['claim_category_id'] }}-edit" role="tab"
                                    aria-controls="{{ $item['claim_category_id'] }}-edit"
                                    aria-selected="true">{{ $item['name'] }} (<span
                                        id="{{ $item['claim_category_id'] }}-jumlah-edit">0</span>)</a>
                            @endif
                        @endforeach
                    </div>
                    <div class="col-9 tab-content" id="v-pills-tabContent">
                        <div id="validate-detail-edit" class="alert alert-danger" style="display: none" role="alert">
                        </div>
                        @foreach ($data['claim_category'] as $item)
                            @if ($item['active'] == '1')
                                <div class="tab-pane fade @once {{ 'active' }} @endonce show "
                                    id="{{ $item['claim_category_id'] }}-edit" role="tabpanel"
                                    aria-labelledby="{{ $item['claim_category_id'] }}-tab-edit">
                                    <form onsubmit="return submitItemDetailEdit(event, '{{ $item['claim_category_id'] }}')">
                                    <div class="form-layout">
                                        <div class="modal-body pd-20 pd-t-10-force">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label class="form-control-label">Claim Date <span
                                                                class="tx-danger">*</span></label>
                                                        <input type="text"
                                                            class="form-control fc-datepicker rounded-xl"
                                                            name="{{ $item['claim_category_id'] }}-claim_date-edit"
                                                            id="{{ $item['claim_category_id'] }}-claim_date-edit"
                                                            placeholder="DD/MM/YYYY" autocomplete="off" required>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label class="form-control-label">Claim Amount <span
                                                                class="tx-danger">*</span></label>
                                                        <input class="form-control rounded-xl" type="text"
                                                            oninput="this.value = formatRupiah(this.value, event)"
                                                            name="{{ $item['claim_category_id'] }}-claim_amount-edit"
                                                            id="{{ $item['claim_category_id'] }}-claim_amount-edit"
                                                            maxlength="15"
                                                            placeholder="Enter Price" min="1" step="1"
                                                            autocomplete="off" required>
                                                    </div>
                                                </div>
                                                @if ($item['approval_phase']['4'] == '1')
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label class="form-control-label">PM <span
                                                                    class="tx-danger">*</span></label>
                                                            <select class="form-control rounded-xl"
                                                                id="{{ $item['claim_category_id'] }}-pm-edit"
                                                                name="{{ $item['claim_category_id'] }}-pm-edit"
                                                                style="width: 100%" required>
                                                            </select>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="form-control-label">Claim Description <span
                                                            class="tx-danger">*</span></label>
                                                        <textarea class="form-control rounded-xl" type="text" name="{{ $item['claim_category_id'] }}-claim_desc-edit"
                                                            id="{{ $item['claim_category_id'] }}-claim_desc-edit" placeholder="Enter Description" maxlength="3000" required autocomplete></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="pon_request_file" class="control-label">Upload Document
                                                        Attachment <span class="tx-danger">*</span></label>
                                                    <div class="form-group">
                                                        <input class="form-control rounded-xl" type="file" required
                                                            accept="image/jpeg,image/gif,image/png,application/pdf,image/x-eps"
                                                            id="{{ $item['claim_category_id'] }}-upload_document-edit"
                                                            name="{{ $item['claim_category_id'] }}-upload_document-edit">
                                                    </div>
                                                </div>
                                                <div class="col d-flex justify-content-end" style="padding: 29px;">
                                                    <button name="button" type="submit"
                                                        class='rounded-xl btn btn-primary mx-2'>Add Item</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            @endif
                        @endforeach

                    </div>
                </div>

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
                    <button id="add-save_claim" onclick="SubmitUpdateHandler('SAVE')" value="SAVE"
                        class='rounded-xl btn btn-warning mx-2'>Save</button>
                    <button id="add-submit_claim" onclick="SubmitUpdateHandler('SUBMIT')" value="SUBMIT"
                        class='rounded-xl btn btn-primary'>Submit</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal View Detail --}}
    <div id="modal-claim-request_view" class="modal fade" data-value=''>
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
                        <p class="text-base mb-2 font-semibold text-capitalize">:<span id="name-detail" class="ml-2">{{Session::get('user_firstname')." ".Session::get('user_lastname')}}</span></p>
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
                                <table id="request_item_datatable-view" class="table table-striped table-bordered"
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

                <div class="modal-body pd-5-force pd-l-20-force bg-gray-400 ">
                    History Claim
                </div>
                <div class="form-layout">
                    <div class="modal-body pd-20">
                        <div class="row">
                            <div class="col">
                                <table id="table-data" class="table display responsive nowrap" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th class="wd-5p-force">No</th>
                                            <th>Phase</th>
                                            <th class="text-center">Status</th>
                                            <th>Review Date</th>
                                            <th>Reviewer</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-common" id="data-history">
                    
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button data-dismiss="modal" aria-label="Close" class='rounded-xl btn btn-dark'>Close</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Delete --}}
    <div id="modal-claim-request_delete" class="modal fade" data-value=''>
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
                                <h5 class="alert-title">Delete Item ?</h5>
                                <p class="alert-text mg-b-0-force">Are You Sure Want To Delete This Item ?</p>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <input type="text" name="claim_request_id" id="delete-claim_request_id" hidden>
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
        var data_temp = []

        var data_edit_temp = []

        var delete_file_temp = []

        var history_data = []

        var support_doc = []

        var delete_file_claim = []
        var delete_file_support = []

        $(document).ready(function() {
            $('.dataTables_length select').select2({
                minimumResultsForSearch: Infinity
            });

            // DATEPICKER INITIALIZATION
            $('.fc-datepicker').datepicker({
                format: 'dd/mm/yyyy',
                autoclose: true
            });
        });

        const currentPeriod = @json($data['current-period']);
        const claim_category_list = @json($data['claim_category']);

        async function get_history(claim_request_id) { 
            const data = {claim_request_id};
            $.ajax({
                url: '{{ route('claim_request_history') }}',
                method: 'POST',
                data,
                datatype: "json",
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                success: function(res) {
                    console.log(res);
                    if (res.result == "SUCCESS") {
                        let tbody_html = ""
                        $.each(res.data, function(i, item) {
                            let stat = "open"
                            if (item.status == "Approved") {
                                stat = "notyetsubmitted"
                            } else if (item.status == "Rejected") {
                                stat = "needrevision"
                            }
                            const status = `<div class="status-label status-${stat}" >${item.status}</div>`
                            tbody_html += 
                            `<tr>
                                <td>${i+1}</td>
                                <td>${item.claim_request_phase}</td>
                                <td>${status}</td>
                                <td>${item.review_date}</td>
                                <td>${item.reviewer_name}</td>
                            </tr>`;
                        })
                        $("#data-history").html(tbody_html);
                        $('#modal-claim-request_view').modal("show");
                        $.LoadingOverlay('hide');
                        return
                    }
                    amaran_error(res.message)
                    $.LoadingOverlay('hide');
                    return
                }
            })
         }

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
            ajax: {
                'url': "{{ route('claim_request_list') }}",
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
                    targets: 2,
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
                        let follup = ""
                        if (data.status == "Need Revision" || data.status == "Not Yet Submitted") {
                            follup += '<button id="edit-modal-show" style="text-decoration: none;" class="btn btn-outline-primary mg-r-5" type="button" title="Edit Item"><span class="icon ion-compose"></span></button>'
                        } else {
                            follup += '<button id="view-modal-show" style="text-decoration: none;padding: 3px 13px;" class="btn btn-outline-primary mg-r-5" type="button" title="View Detail"><span class="my-auto mx-auto icon ion-eye"></span></button>'
                        }

                        if (data.status == "Not Yet Submitted") {
                            follup +=`<button id="delete-modal-show" style="text-decoration: none;" class="btn btn-outline-danger mg-r-5" type="button" title="Delete Item"><span class="icon ion-trash-a"></span></button>`
                        }

                        return follup;
                    }
                }
            ],
            "order": [
                [0, 'asc']
            ]
        });

        // Table Items
        var item_request_table_add = $('#request_item_datatable-add').DataTable({
            "searching": false,
            columnDefs: [
                {
                    searchable: false,
                    sortable: false,
                    targets: -1,
                    render: function(data) {
                        return `
                            <a href="tmp/${data}" target="_blank" style="text-decoration: none;" class="btn btn-outline-primary" type="button" title="Preview File"><span class="my-auto icon ion-eye"></span></a>
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
                    total.toLocaleString('en-US')
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
                    total.toLocaleString('en-US')
                );
            }
        });

        var item_request_table_view = $('#request_item_datatable-view').DataTable({
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
                    total.toLocaleString('en-US')
                );
            }
        });

        async function resetForm(claim_category_id, action) {
            $(`#${claim_category_id}-claim_date-${action}`).val('')
            $(`#${claim_category_id}-claim_desc-${action}`).val('')
            $(`#${claim_category_id}-claim_amount-${action}`).val('')
            $(`#${claim_category_id}-upload_document-${action}`).val('')
            const pm = $(`#${claim_category_id}-pm-${action}`).val()
            if (pm !== undefined) {
                $(`#${claim_category_id}-pm-${action}`).val('')
            }
        }

        function buildTableItem(action) {
            let buildData = []

            if (action == "add") {
                item_request_table_add.clear().draw()
                buildData = data_temp
            } else if (action == "edit") {
                item_request_table_edit.clear().draw()
                buildData = data_edit_temp
            }
            
            claim_category_list.map( (item, index) => {
                const jumlahData = buildData.filter(itemData => itemData.claim_category_id == item.claim_category_id)
                $(`#${item.claim_category_id}-jumlah-${action}`).text(jumlahData.length)
            } )

            let nomor = 1;
            buildData.map((item, index) => {
                const claim_category = claim_category_list.find(claim_category => claim_category
                    .claim_category_id == item.claim_category_id)

                let filename = item.claim_document[0];
                if (action == "edit") {
                    filename = item.claim_document[0].filename;
                }

                const detail_data = `<tr>
                    <td style="width: 5%">${nomor}</td>
                    <td style="width: 15%">${item.claim_date}</td>
                    <td style="width: 20%">${claim_category.name}</td>
                    <td style="width: 20%">${item.claim_desc}</td>
                    <td style="width: 20%">${item.claim_amount.toLocaleString('en-US')}</td>
                    <td style="width: 20%">${filename}</td>
                </tr>`
            
                if (action == "add") {
                    item_request_table_add.row.add($(`${detail_data}`)).draw()
                } else if (action == "edit") {
                    item_request_table_edit.row.add($(`${detail_data}`)).draw()
                }

                nomor++
                return
            })
        }

        // Submit Item Details
        function submitItemDetail(e, claim_category_id) {
            e.preventDefault()
            var files = $(`#${claim_category_id}-upload_document-add`)[0].files[0];

            var formData = new FormData();
            formData.append('upload_document', files);

            let amount = $(`#${claim_category_id}-claim_amount-add`).val()

            const pm = $(`#${claim_category_id}-pm-add`).val()
            const data = {
                claim_date: $(`#${claim_category_id}-claim_date-add`).val(),
                claim_amount: parseInt(amount.replaceAll('.', '')),
                claim_desc: $(`#${claim_category_id}-claim_desc-add`).val(),
                claim_category_id
            }
            if (pm !== undefined) {
                if (pm === null) {
                    $('#validate-detail').html("<li><strong>Please fill all required field</strong></li>")
                    $('#validate-detail').fadeIn("slow");
                    setTimeout(function() {
                        $("#validate-detail").fadeOut("slow");
                    }, 3000);
                    return
                }
                data.pm = pm
            }

            if (data.claim_date === "" || data.claim_amount === ""|| data.claim_desc === "" || data.claim_amount === 0) {
                $('#validate-detail').html("<li><strong>Please fill all required field</strong></li>")
                $('#validate-detail').fadeIn("slow");
                setTimeout(function() {
                    $("#validate-detail").fadeOut("slow");
                }, 3000);
                return
            }
            if (!Date.parse(data.claim_date)) {
                $('#validate-detail').html("<li><strong>Please enter a valid date</strong></li>")
                $('#validate-detail').fadeIn("slow");
                setTimeout(function() {
                    $("#validate-detail").fadeOut("slow");
                }, 3000);
                return
            }
            let total = data_temp.reduce( function(accumulator, object) {
                return accumulator + object.claim_amount;
            }, 0);
        
            total += data.claim_amount;

            if (total > 1000000000) {
                amaran_error("Maximum Total Is 1B")
                return
            }

            $.ajax({
                url: "{{ route('upload_item') }}",
                method: 'POST',
                data: formData,
                datatype: "json",
                contentType: false,
                processData: false,
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
                        $('#validate-detail').html(listErr)
                        $('#validate-detail').fadeIn("slow");
                        setTimeout(function() {
                            $("#validate-detail").fadeOut("slow");
                        }, 3000);
                        return
                    } else if (res.result === "SUCCESS") {
                        data.claim_document = [res.file_name]
                        data_temp.push(data)

                        console.log(data_temp);

                        buildTableItem("add")
                        resetForm(claim_category_id, 'add')
                    }
                }
            })
        }

        // Submit Item Details Edit
        function submitItemDetailEdit(e, claim_category_id) {
            e.preventDefault();

            var files = $(`#${claim_category_id}-upload_document-edit`)[0].files[0];
            var formData = new FormData();
            formData.append('upload_document', files);

            let amount = $(`#${claim_category_id}-claim_amount-edit`).val()

            const pm = $(`#${claim_category_id}-pm-edit`).val()
            const data = {
                claim_date: $(`#${claim_category_id}-claim_date-edit`).val(),
                claim_amount: parseInt(amount.replaceAll('.', '')),
                claim_desc: $(`#${claim_category_id}-claim_desc-edit`).val(),
                claim_category_id
            }
            if (pm !== undefined) {
                if (pm === null) {
                    $('#validate-detail-edit').html("<li><strong>Please fill all required field</strong></li>")
                    $('#validate-detail-edit').fadeIn("slow");
                    setTimeout(function() {
                        $("#validate-detail-edit").fadeOut("slow");
                    }, 3000);
                    return
                }
                data.pm = pm
            }

            if (data.claim_date === "" || data.claim_amount === "" || data.claim_desc === "") {
                $('#validate-detail-edit').html("<li><strong>Please fill all required field</strong></li>")
                $('#validate-detail-edit').fadeIn("slow");
                setTimeout(function() {
                    $("#validate-detail-edit").fadeOut("slow");
                }, 3000);
                return
            }
            if (!Date.parse(data.claim_date)) {
                $('#validate-detail-edit').html("<li><strong>Please enter a valid date</strong></li>")
                $('#validate-detail-edit').fadeIn("slow");
                setTimeout(function() {
                    $("#validate-detail-edit").fadeOut("slow");
                }, 3000);
                return
            }
            $.ajax({
                url: "{{ route('upload_item') }}",
                method: 'POST',
                data: formData,
                datatype: "json",
                contentType: false,
                processData: false,
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
                        $('#validate-detail-edit').html(listErr)
                        $('#validate-detail-edit').fadeIn("slow");
                        setTimeout(function() {
                            $("#validate-detail-edit").fadeOut("slow");
                        }, 3000);
                        return
                    } else if (res.result === "SUCCESS") {
                        data.claim_document = [{ filename: res.file_name}]
                        data_edit_temp.push(data)

                        console.log(data_edit_temp);

                        buildTableItem("edit")
                        resetForm(claim_category_id, 'edit')
                    }
                }
            })
            
        }

        // Delete Item Detail
        $('#request_item_datatable-add tbody').on('click', '#delete-item-detail', function() {
            const i = $(this).closest('tr').index()
            const {
                claim_category_id,
                claim_document
            } = data_temp[i]
            
            $(`#${claim_category_id}-jumlah-add`).text("0")

            data_temp.splice(i, 1)

            const data = {
                delete_document: claim_document[0]
            }

            buildTableItem("add")

            $.ajax({
                type: "POST",
                url: "{{ route('delete_item') }}",
                data: data,
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
            });
            return
        })

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
            buildTableItem("edit")

        })

        // Action Submit
        function SubmitHandler(action) {
            if (!data_temp.length) {
                amaran_error("Please Add Item")
                return
            }

            var files = $("#support_doc-add")[0].files;
            if (!files.length) {
                amaran_error("Please Add Support Doc")
                return
            }
            /* define allowed file types */
            var allowedExtensionsRegx = /(\.jpg|\.jpeg|\.png|\.gif|\.pdf)$/i;

            var formData = new FormData();
            let invalidType = false
            $.each( files, function (i, file) {  
                var extension = file.name.substr(file.name.lastIndexOf("."));
                /* testing extension with regular expression */
                var isAllowed = allowedExtensionsRegx.test(extension);
                if (!isAllowed) {
                    amaran_error("Invalid Support Doc Type")
                    invalidType = true
                    return
                }
                formData.append('support_doc[]', file);
            } )
            if (invalidType) {
                return
            }

            const rfName = "{{ $data['current-period'][0]['rf_period_name'] }}"

            var column = item_request_table_add.column(-2);
            var totalFormat = $(column.footer()).html().split(",")

            const total_amount = totalFormat.join("")
            const claim_item_detail = data_temp

            const data = {
                action, total_amount, claim_item_detail,
                currency_id: $("#currency-add").val(),
                rf_period_id: $("#rf_period-add").val(),
                cost_centre_id: $("#cost_centre-add").val()
            }
            formData.append('data', JSON.stringify(data));
            formData.append('rf_name', rfName);

            $.ajax({
                url: '{{ route('claim_request_create') }}',
                method: 'POST',
                data: formData,
                datatype: "json",
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                success: function(res) {
                    if (res.result == "SUCCESS") {
                        table.ajax.reload()
                        $('#modal-claim-request_add').modal("hide");
                        data_temp = []
                        $("#support_doc-add").val("")
                        amaran_success("Add claim request success")
                        return
                    }
                    amaran_error("Add Claim Failed")
                    return
                },
                error: function(err) {
                    amaran_error(err)
                }
            });

        }
        function SubmitUpdateHandler(action) { 
            if (!data_edit_temp.length) {
                amaran_error("Please Add Item")
                return
            }
            var formData = new FormData();
            var change_support_doc = $("#change_support_doc-edit")[0].files;

            /* define allowed file types */
            var allowedExtensionsRegx = /(\.jpg|\.jpeg|\.png|\.gif|\.pdf)$/i;

            let invalidType = false;
            $.each( change_support_doc, function (i, file) { 
                var extension = file.name.substr(file.name.lastIndexOf("."));
                /* testing extension with regular expression */
                var isAllowed = allowedExtensionsRegx.test(extension);
                if (!isAllowed) {
                    amaran_error("Invalid Support Doc Type")
                    invalidType = true
                    return
                }
                formData.append('change_support_doc[]', file);
            })
            if (invalidType) {
                return
            }

            var column = item_request_table_edit.column(-2);
            var totalFormat = $(column.footer()).html().split(",")

            const rfName = $("#rf_period_name-edit").val()

            const total_amount = totalFormat.join("")
            let claim_item_detail = [...data_edit_temp]

            const data = {
                action, total_amount, claim_item_detail, support_doc, 
                rf_name: rfName,
                currency_id: $("#currency-edit").val(),
                rf_period_id: $("#rf_period-edit").val(),
                cost_centre_id: $("#cost_centre-edit").val(),
                claim_request_id: $("#claim_request_id-edit").val(),
                claim_request_type_id: $("#claim_request_type_id-edit").val(),
                claim_phase_id: $("#claim_phase_id-edit").val(),
                delete_document: delete_file_temp
            }
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
                        table.ajax.reload()
                        $('#modal-claim-request_edit').modal("hide");
                        amaran_success("Add claim request success")
                        return
                    }
                    amaran_error("Add Claim Request Failed")
                    return
                },
                error: function(err) {
                    amaran_error(err)
                }
            });
        }

        $("#delete_item").click(() => {
            const data = {
                claim_request_id: $("#delete-claim_request_id").val(),
                delete_file_claim, delete_file_support
            }
            $.ajax({
                url: '{{ route('claim_request_delete') }}',
                method: 'POST',
                data,
                datatype: "json",
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                success: function(res) {
                    console.log(res);
                    if (res.result === 'SUCCESS') {
                        table.ajax.reload()
                        $('#modal-claim-request_delete').modal("hide");
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

        // Modal Show
        $(".modal-add").click(() => {
            buildTableItem("add")
            $.LoadingOverlay("show");
            $('#modal-claim-request_add').modal("show");
            $.LoadingOverlay('hide');
        })

        $('#table-data tbody').on('click', '#edit-modal-show', function() {
            $.LoadingOverlay("show");
            const data = table.row($(this).parents('tr')).data();
            tableSupportDoc( data.support_doc, "edit" )

            console.log(data);
            // kasih value rf period saat need revision
            if (data.status == "Not Yet Submitted") {
                $("#rf_period_name-edit").val(currentPeriod[0].rf_period_name)
                $("#rf_period-edit").html(`<option value="${currentPeriod[0].rf_period_id}" selected>${currentPeriod[0].rf_name}</option>`)
            } else {
                $("#rf_period_name-edit").val(data.rf_period.rf_period_name)
                $("#rf_period-edit").html(`<option value="${data.rf_period_id}" selected>${data.rf_period.rf_name}</option>`)
            }

            $("#currency-edit").val(data.currency_id)
            $("#claim_request_type_id-edit").val(data.claim_request_type_id)
            $("#claim_request_id-edit").val(data.claim_request_id)
            $("#claim_phase_id-edit").val(data.claim_request_phase_id)
            
            data_edit_temp = [...data.claim_item_detail]
            delete_file_temp = []

            buildTableItem("edit")
            
            $('#modal-claim-request_edit').modal("show");
            $.LoadingOverlay('hide');
        })

        $('#table-data tbody').on('click', '#view-modal-show', function() {
            $.LoadingOverlay("show");
            item_request_table_view.clear()
            const data = table.row($(this).parents('tr')).data();
            get_history(data.claim_request_id);
            tableSupportDoc( data.support_doc, "view" )

            $("#support_doc-view").html()

            let stat = "open"
            if (data.status == "Not Yet Submitted") {
                stat = "notyetsubmitted"
            } else if (data.status == "Closed" ) {
                stat = "close"
            } else if (data.status == "Need Revision") {
                stat = "needrevision"
            }
            const status = `<span class="ml-2 px-3 py-1 status-label status-${stat} p-2" >${data.status}</span>` 
            $("#cost_centre-detail").text(data.cost_centre_name);
            $("#currency-detail").text(data.currency_name);
            $("#total_amount-detail").text("Rp."+data.total_amount);
            $("#status-detail").html(`:${status}`);

            let nomor = 1;
            data.claim_item_detail.map((item, index) => {
                const claim_category = claim_category_list.find(claim_category => claim_category
                    .claim_category_id == item.claim_category_id)

                filename = item.claim_document[0].filename;

                const detail_data = `<tr>
                    <td style="width: 5%">${nomor}</td>
                    <td style="width: 15%">${item.claim_date}</td>
                    <td style="width: 20%">${claim_category.name}</td>
                    <td style="width: 20%">${item.claim_desc}</td>
                    <td style="width: 20%">${item.claim_amount.toLocaleString('en-US')}</td>
                    <td style="width: 20%">${filename}</td>
                </tr>`
                item_request_table_view.row.add($(`${detail_data}`)).draw()
                nomor++
            })

            // $('#modal-claim-request_view').modal("show");
            $.LoadingOverlay('hide');
        })
        
        $('#table-data tbody').on('click', '#delete-modal-show', function() {
            $.LoadingOverlay("show");
            const { claim_request_id, support_doc, claim_item_detail } = table.row($(this).parents('tr')).data();
            delete_file_claim = []
            delete_file_support = []

            delete_file_claim = claim_item_detail;
            delete_file_support = support_doc;

            $("#delete-claim_request_id").val(claim_request_id)
            $('#modal-claim-request_delete').modal("show");
            $.LoadingOverlay('hide');
        })

        async function deleteFileTemp() {
            const data = {
                claim_item_detail: data_temp
            }
            if (data_temp.length) {    
                $.ajax({
                    url: '{{ route('claim_request_cancel') }}',
                    method: 'POST',
                    data,
                    datatype: "json",
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    }
                });
            }
            data_temp = []
        }

        $(".add-cancel_claim").click( function () {  
            deleteFileTemp()
            $("#support_doc-add").val("")
            $("#modal-claim-request_add").modal("hide")
        } )

        function forceNumber(e) {
            console.log(e.keyCode);
            if (e.keyCode === 190 || e.keyCode === 110 || e.keyCode === 188) {
                e.preventDefault();
            }

            if ((e.keyCode >= 65 && e.keyCode <= 90)) { 
                e.preventDefault();
            }
        }

        function formatRupiah(angka, e)
        {
            angka = angka.replaceAll(",", "");
            angka = angka.replace(/^0+/, '');
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split    = number_string.split(','),
                sisa     = split[0].length % 3,
                rupiah     = split[0].substr(0, sisa),
                ribuan     = split[0].substr(sisa).match(/\d{3}/gi);
                
            if (ribuan) {
                let separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }
            
            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return rupiah ? rupiah : '';

        }


    </script>
@endsection
