@extends('layouts.masters')

@push('style')
    <link rel="stylesheet" href="{{ asset('css/pmo/viewpr.css') }}">
@endpush

@section('content')
    @include('partials.navigations.pmo')
    <div class="container-fluid">
        <div class="row py-3">
            <div class="col-md-12">
                <div class="card card-main">
                    <div class="card-header py-2">
                        <div class="row ">
                            <div class="col-md-6 ">
                                <div class="container-fluid">
                                    <div class="row">
                                        <label for="" class="mb-0">TRANSACTION NO:&nbsp <span class="text-lime">{{ $transaction['details']->transcode }}</span></label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="container-fluid">
                                    <div class="row float-right">
                                        <label for="" class="mb-0">REQUEST TYPE:&nbsp <span class="text-lime">{{ $transaction['details']->transtype }}</span></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-5 mt-1">
                                <div class="panel">
                                    <div class="panel-head">
                                        
                                    </div>
                                    <hr class="mt-2 line">
                                    <div class="panel-body">
                                        <div class="container-fluid">
                                                <div class="row">
                                                    <div class="col-md-7">
                                                        <div class="form-group">
                                                            <label for="" class="form-label">DEPARTMENT:&nbsp <span class="text-lime">{{ $transaction['details']->hosdep }}</span></label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <label for="" class="form-label">DEPARTMENT BUDGET:&nbsp <span class="text-lime">{{ number_format((float)$transaction['details']->budget, 2) }}</span> </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    
                                                    <div class="col-md-7">
                                                        <div class="form-group">
                                                            <label for="" class="form-label">STATUS:&nbsp <span class="text-lime">{{ $transaction['details']->status }} BY MCC</span> </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <label for="" class="form-label">DATE REQUESTED:&nbsp <span class="text-lime">{{ date('F j, Y', strtotime($transaction['details']->date_sent)) }}</span> </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="">PURPOSE: </label>
                                                            <textarea class="form-control" name="purpose" id="purpose" cols="30" rows="10" disabled>{{ $transaction['details']->purpose }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    
                                                    <div class="col-md-7">
                                                        <div class="form-group">
                                                            <label for="" class="form-label">NUMBER OF ITEMS:&nbsp <span class="text-lime">{{ $transaction['details']->itemcount }}</span> </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <label for="" class="form-label float-right">TOTAL COST:&nbsp <span class="text-lime">{{ number_format((float)$transaction['details']->totalprice, 2) }}</span> </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row py-1">
                                                    <div class="col-md-4">

                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="row justify-content-center">
                                                            <label for="" class="mb-1">{{ strtoupper($transaction['details']->name) }}</label>
                                                        </div>
                                                        <hr class="mt-0 mb-0 bg-white">
                                                        <div class="row justify-content-center">
                                                            <small>REQUESTED BY</small>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">

                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <table class="table table-hover table-striped table-condensed" id="itemsTable">
                                    <thead>
                                        <tr>
                                            <th>ITEM CODE</th>
                                            <th>NAME</th>
                                            <th>DESCRIPTION</th>
                                            <th>SPECIFICATIONS</th>
                                            <th>PRICE</th>
                                            <th>QTY</th>
                                            <th>TOTAL</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-white">
                                        @foreach($transaction['items'] as $item)
                                            <tr>
                                                <td>{{ $item->itemcode }}</td>
                                                <td><a href="#" class="itemname" data-name="{{ $item->name }}">{{ substr($item->name, 0, 15) }}</a></td>
                                                <td><a href="#" class="itemdesc" data-desc="{{ $item->description }}">{{ substr($item->description, 0, 15) }}</a></td>
                                                <td><a href="#" class="itemspec" data-spec="{{ $item->specs }}">{{ substr($item->specs, 0, 15) }}</a></td>
                                                <td>{{ number_format((float)$item->price, 2) }}</td>
                                                <td>{{ $item->qty }}</td>
                                                <td>{{ number_format((float) ($item->qty * $item->price), 2) }}</td>
                                                <td>
                                                    <a href="#" class="removeItem"><i class="fas fa-times"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body" style="height: auto">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="card">
                                                    <div class="card-header py-1">
                                                        <strong class="text-lime">STATUS: </strong>
                                                    </div>
                                                    <div class="card-body">
                                                        
                                                        <div class="row">
                                                            <div class="col-md-2"></div>
                                                            <div class="col-md-8">
                                                                <div class="row justify-content-center">
                                                                    <label for="" class="mb-1 text-lime">RICARDO B. RUNEZ, J.R., MD,FPCS,MHA,CESE</label>
                                                                </div>
                                                                <hr class="mt-0 mb-0 bg-white">
                                                                <div class="row justify-content-center">
                                                                    <small class="text-white">APPROVED BY</small>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2"></div>
                                                        </div>
                                                        <div class="row mt-5">
                                                            <div class="col-md-6"></div>
                                                            <div class="col-md-6">
                                                                <small for="" class="float-right text-white">DATE APPROVED:&nbsp <span class="text-lime">{{ date('F j, Y', strtotime($transaction['details']->dateapproved)) }}</span></small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="card">
                                                    <div class="card-header py-1">
                                                        <strong class="text-cyan">ATTACHMENTS: </strong>
                                                    </div>
                                                    <div class="card-body attachment-card-body">
                                                        <table class="table table-condensed table-hover table-striped" id="attachmentsTable">
                                                            <tbody>
                                                                @foreach($transaction['attachments'] as $attachment)
                                                                    <tr>
                                                                        <td>{{ $attachment->filename }}</td>
                                                                        <td class="text-center"><a href="{{ route('downloadFile', ['attachmentid' => $attachment->id ]) }}" class="text-cyan">DOWNLOAD <i class="fas fa-file-download"></i></a></td>
                                                                    </tr>
                                                                    
                                                                @endforeach 
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="col-md-12">
                            <div class="row float-right">
                                @if(trim($transaction['details']->type) == 'PR')
                                    <a href="{{ route('generatePR', ['transcode' => $transaction['details']->transcode ]) }}" target="_blank" class="printButton">PRINT PR <i class="fas fa-print"></i></a>
                                    <a href="#forwardModal" data-toggle="modal" class="printButton" data-transcode="{{ $transaction['details']->transcode }}">GENERATE PO <i class="fas fa-print"></i></a>
                                @elseif(trim($transaction['details']->type) == 'PPMP')
                                    <a href="{{ route('generatePPMP', ['transcode' => $transaction['details']->transcode ]) }}" target="_blank" class="printButton">PRINT PPMP <i class="fas fa-print"></i></a>
                                @endif
                                @if(trim($transaction['details']->statcode) == 'A')
                                    <!--<a href="#" class="disapproveTransaction" data-toggle="modal" data-target="#disapproveModal">DISAPPROVE <i class="fas fa-times"></i></a>-->
                                    <a href="#" class="approveTransaction" data-transcode="{{ $transaction['details']->transcode }}" id="actionButton">APPROVE <i class="fas fa-check"></i></a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <!-- Modal -->
        <div class="modal fade" id="forwardModal" tabindex="-1" role="dialog" aria-labelledby="forwardModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-white">PR No: <span id="forwardModalLabel"></span></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" >
                        <div class="input-group py-1">
                            <div class="input-group-prepend col-md-3">
                                <span class="col-form-label ">Supplier: </span>
                            </div>
                            <select name="supplier" id="supplier" data-transcode="{{ $transaction['details']->transcode }}" class="form-control">
                                @foreach($suppliers as $supplier)
                                    <option value="{{ $supplier->suppid }}">{{ $supplier->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="input-group py-1">
                            <div class="input-group-prepend col-md-3">
                                <span class="col-form-label ">Deliver by: </span>
                            </div>
                            <input type="date" class="form-control col-md-9">
                        </div>
                        <div class="input-group py-1">
                            <div class="input-group-prepend col-md-3">
                                <span class="col-form-label ">Delivery Term: </span>
                            </div>
                            <input type="text" class="form-control col-md-9">
                        </div>
                        <!--
                        <div class="input-group py-1">
                            <div class="input-group-prepend col-md-3">
                                <span class="col-form-label ">Transcode: </span>
                            </div>
                            <input type="text" class="form-control col-md-9" value="{{ $transaction['details']->transcode }}" disabled>
                        </div>
                        <div class="input-group py-1">
                            <div class="input-group-prepend col-md-3">
                                <span class="col-form-label ">Deliver to: </span>
                            </div>
                            <input type="text" class="form-control col-md-9" value="{{ $transaction['details']->hosdep }}" disabled>
                        </div>
                        <div class="input-group py-1">
                            <div class="input-group-prepend col-md-3">
                                <span class="col-form-label ">Receive by: </span>
                            </div>
                            <input type="date" class="form-control col-md-9">
                        </div>
                        <div class="input-group py-1">
                            <div class="input-group-prepend col-md-3">
                                <span class="col-form-label">Deliver by: </span>
                            </div>
                            <input type="date" class="form-control col-md-9">
                        </div>
                        <hr>
                        <div class="form-group">
                            <label for="remarks" class="form-label">Remarks: </label>
                            <textarea name="" id="" cols="30" rows="10" class="form-control"></textarea>
                        </div>
                    </div>-->
                    <div class="modal-footer bg-dark">
                        <div class="col-md-12">
                            <div class="row justify-content-center">
                                <a href="{{ route('generatePO', ['transcode' => $transaction['details']->transcode]) }}" target="_blank" class="nav-link" data-transcode="{{ $transaction['details']->transcode }}">GENERATE <i class="fas fa-print"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/pmo/viewpr.js') }}"></script>
@endpush
