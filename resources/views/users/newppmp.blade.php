@extends('home')


@push('style')
    <link rel="stylesheet" href="{{ asset('css/pharmacy/newpr.css') }}">
@endpush

@section('content')
    @include('partials.navigations.user')
    <div class="col-md-12 py-2">
        <div class="card container-header">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-3">
                        <div class="input-group">
                            <div class="input-group-prepend  bg-primary" >
                                <span class="col-form-label text-white">
                                    Item Category
                                </span>
                            </div>
                            <select name="grpcode" id="grpcode" class="form-control">
                                <option value="A">ALL</option>
                                @foreach($items as $item)
                                    <option value="{{ $item->grpcode }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 text-center">
                        <h6 class="page-name">
                            
                        </h6>
                    </div>
                    <div class="col-md-3">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search" name="search" id="search">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 py-2">
        <div class="card container-card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 py-1">
                        <div class="card" >
                            <div class="card-header bg-primary text-white" style="padding: 3px">
                                <small ><strong>Transaction Details</strong></small>
                            </div>
                            <div class="card-body" style="background: #090038; height: 550px">
                                <div class="input-group mb-5">
                                    <div class="input-group-prepend ">
                                        <span class="col-form-label bg-primary text-white">
                                            TYPE
                                        </span>
                                    </div>
                                    <input type="text" value="PPMP" name="type" id="type" disabled class="form-control">
                                </div>
                                

                                <label for="purpose" class="text-white">Purpose:</label>
                                <div class="container-fluid text-white">
                                    
                                    <div class="row">
                                        <textarea name="purpose" id="purpose" cols="100" rows="10"></textarea>
                                    </div>
                                </div>
                                <br>
                                <div class="card attachment-card">
                                    <div class="card-header py-1">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <strong class="text-cyan">ATTACHMENTS: </strong>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <form action="uploadFile" enctype="multipart/form-data" method="post" id="attachmentForm">
                                            @csrf
                                            <input type="hidden" name="transcode" id="transcode">
                                            <input type="file" multiple="multiple" name="attachment[]" id="attachment" class="text-cyan">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <table class="table table-condensed table-sm table-hover table-striped text-white" id="inventoryTable">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>ITEM CODE</th>
                                    <th>NAME</th>
                                    <th>DESCRIPTION</th>
                                    <th>SPECIFICATIONS</th>
                                    <th>STANDARD STOCK</th>
                                    <th>CURRENT BALANCE</th>
                                    <th>PRICE</th>
                                    <th class="text-center">ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                               @foreach($itemlist as $item)
                                    <tr>
                                        <td>{{ $item->codegrp }}</td>
                                        <td>{{ $item->itemcode }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->description}}</td>
                                        <td>{{ $item->specs }}</td>
                                        <td>{{ $item->standardstock }}</td>
                                        <td>{{ $item->stockbal }}</td>
                                        <td>{{ number_format((float)$item->price, 2) }}</td>
                                        <td>
                                            <a href="#" class="addItem">ADD <i class="fas fa-plus"></i></a>
                                        </td>
                                    </tr>
                               @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="card bottom-card">
                            <div class="card-body">
                                <div class="row">
                                    <!--<div class="col-md-4">
                                        <div class="card status-card">
                                            <div class="card-header py-1">
                                                <strong class="text-lime">DETAILS: </strong>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="" class="text-white">ITEMS:&nbsp </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="" class="text-white">TOTAL:&nbsp </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        
                                    </div>-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="row justify-content-center col-md-6 paging"></div>
                            <div class="col-md-3 ">
                                <div class="row float-right">
                                    <a href="#" class="nav-link savePR" data-prno="{{ $prno }}" id="savePR">SAVE <i class="fas fa-save"></i></a>
                        
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/pharmacy/newppmp.js') }}"></script>
@endpush