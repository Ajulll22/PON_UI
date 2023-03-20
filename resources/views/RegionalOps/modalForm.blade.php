<div id="modal_add_pon_request" class="modal fade" data-value=''>
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content tx-size-sm">
            <div class="modal-header pd-x-20">
                <h5 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold"> <i class="fa fa-plus mg-r-10"></i> PON Request Form Initiation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="form_add_pon_request" enctype="multipart/form-data">
                <div class="modal-body pd-5-force pd-l-20-force bg-gray-400 ">
                    Main Details
                </div>
                <div class="form-layout">
                    <div class="modal-body pd-20" id="pon-request-detail-container">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-control-label">Cost Centre <span class="tx-danger">*</span></label>
                                    <select class="form-control select2 cost_centre" id="cost_centre" name="cost_centre" style="width: 100%" required>
                                        <option value="">Select Cost Centre</option>
                                        @foreach ($data['cost_centre_data'] as $item)
                                            <option value="{{ $item['cost_centre_id'] }}">{{$item['cost_centre_name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-control-label">RF Period <span class="tx-danger">*</span></label>
                                    <select class="form-control select2 currency" id="rf_period" name="rf_period" style="width: 100%" required>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-control-label">Account <span class="tx-danger">*</span></label>
                                    <select class="form-control select2 currency" id="account" name="account" style="width: 100%" required>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-body pd-5-force pd-l-20-force bg-gray-400 ">
                    Item Details
                </div>
                <div class="modal-body pd-t-10 pd-l-20-force pd-b-0">
                    <span>Note: All items below will have a supplier and currency as specified in the main details section.</span>
                </div>
                <div class="form-layout">
                    <div class="modal-body pd-20 pd-t-10-force">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                <label class="form-control-label">Claim Date </label>
                                <input type="text" class="form-control fc-datepicker" name="datepicker" id="claim_date_add" placeholder="DD/MM/YYYY" autocomplete="off" >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-control-label">Claim Type </label>
                                    <select class="form-control select2 claim_type" id="claim_type_add" name="claim_type_add" style="width: 100%" required>
                                        <option value="">Select Claim</option>
                                        <option value="test">test</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-control-label">Reviewed By </label>
                                    <input class="form-control" type="text" name="reviewed_by_add" id="reviewed_by_add" placeholder="Enter Reviewed By">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-control-label">Description</label>
                                    </select>
                                    <textarea list="description_item_list_add" class="form-control" type="text" name="description_add" id="description_add" placeholder="Enter Description" maxlength="3000" autocomplete></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label class="form-control-label">Price</label>
                                    <input class="form-control" type="text" name="price_add" id="price_add" placeholder="Enter Price" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" autocomplete>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <label for="pon_request_file" class="control-label">Upload Document Attachment</label>
                                <div class="form-group" >
                                    <input class="form-control" type="file" id="file_item" name="file_item">
                                </div>

                            </div>
                            <div class="col-md-2" style="padding-top: 27px;">
                                <input type="button" name="add_item_button" class="btn btn-primary" value="Add Item" id="add_item_button" style="width: 100%" />
                            </div>
                        </div>
                        <div class="row mg-t-7">
                            <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                <table id="request_item_datatable" class="table table-striped table-bordered" style="background-color: #fff">
                                    <thead>
                                        <tr>
                                            <th width="5%">No</th>
                                            <th width="20%">Claim Date</th>
                                            <th width="20%">Claim Type</th>
                                            <th width="20%">Reviewed By</th>
                                            <th width="20%">Price</th>
                                            <th class="text-center" width="15%">Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th colspan="4" style="text-align:right">Amount:</th>
                                            <th colspan="2"></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer pd-8-force">
                    <button type="button" class="btn btn-dark tx-size-xs pd-t-7-force pd-b-7-force" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary tx-size-xs pd-t-7-force pd-b-7-force">Submit PON Request</button>
                </div>
            </form>
        </div>
    </div>
</div>