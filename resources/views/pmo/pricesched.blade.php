@extends('layouts.masters')

@push('style')
    <link rel="stylesheet" href="{{ asset('css/pmo/ps.css') }}">
@endpush

@section('content')
    @include('partials.navigations.pmo')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered table-striped table-hover" id="itemsTable">
                    <thead>
                        <tr>
                            <th>Item Number</th>
                            <th>Item Description</th>
                            <th>Unit</th>
                            <th>Bidders</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!--<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <small class="modal-title text-white">Item: <small id="addModalLabel" class="text-lime"></small></small>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" >
                    <div class="row">
                        <div class="col-md-5">
                            <table class="table table-sm table-hover table-stripe table-condensed" id="biddersTable">
                                <thead>
                                <tr>
                                    <th>Bidder Id</th>
                                    <th>Bidder</th>
                                    <th>Bidder Address</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-7">
                            <table class="table table-sm table-hover table-stripe table-condensed" id="bidInfoTable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Bidder</th>
                                        <th>Bid Price</th>
                                        <th>Brand</th>
                                        <th>Description</th>
                                        <th>Manufacturer</th>
                                        <th>Origin</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="col-md-12">
                        <div class="row float-right">
                            <a href="#" class="nav-link saveBid hover-cyan">SAVE <i class="fas fa-save"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>-->

    <div class="modal fade" id="bidderInfoModal" tabindex="-1" role="dialog" aria-labelledby="bidderInfoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <label class="modal-title text-white">Bidder Details</label>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" >
                    <form id="bidForm">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="input-group mb-2">
                                   <div class="input-group-prepend col-md-3">
                                       <span class="col-form-label ">Name:</span>
                                   </div>
                                    <select name="bidder" id="bidder" class="form-control col-md-9">
                                        <option value="" selected hidden disabled>Select Bidder</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-group mb-2">
                                    <span class="col-form-label col-md-3">Address:</span>
                                    <label class="col-form-label col-md-9" id="bidderAddress"></label>
                                    <input type="hidden" name="address" id="address" value="">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="col-md-12">

                            <div class="row">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend col-md-3">
                                        <span class="col-form-label">Bid Price:</span>
                                    </div>
                                    <input type="number" name="bidprice" id="bidprice" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend col-md-3">
                                        <span class="col-form-label">Brand:</span>
                                    </div>
                                    <input type="text" name="brand" id="brand" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend col-md-3">
                                        <span class="col-form-label">Manufacturer:</span>
                                    </div>
                                    <input type="text" name="manufacturer" id="manufacturer" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend col-md-3">
                                        <span class="col-form-label">Origin:</span>
                                    </div>
                                    <input type="text" name="origin" id="origin" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-group mb-2">
                                    <span class="col-form-label col-md-3">Description:</span>
                                    <textarea class="form-control" id="description" name="description" cols="100" rows="5"></textarea>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <div class="col-md-12">
                        <div class="row float-right">
                            <a href="#" class="nav-link addBid hover-cyan">ADD <i class="fas fa-save"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/pmo/ps.js')  }}"></script>
@endpush
