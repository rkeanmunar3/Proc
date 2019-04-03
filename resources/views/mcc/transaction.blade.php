@extends('layouts.masters')

@push('style')
    <link rel="stylesheet" href="{{ asset('css/mcc/transaction.css') }}">
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row py-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-5 mt-1">
                                <div class="panel">
                                    <div class="panel-head">
                                        <div class="container-fluid">
                                            <div class="row mt-2">
                                                <div class="col-md-6">
                                                    <label for="" class="">TRANSACTION NO:&nbsp {{ $transaction['details']->transcode }}</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="" class="float-right">REQUEST TYPE:&nbsp <span class="department">{{ $transaction['details']->type }}</span></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="mt-2 line">
                                    <div class="panel-body">
                                        <div class="container-fluid">
                                                <div class="row">
                                                    <div class="col-md-7">
                                                        <div class="form-group">
                                                            <label for="" class="form-label">DEPARTMENT:&nbsp <span class="department">{{ $transaction['details']->hosdep }}</span></label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <label for="" class="form-label">DEPARTMENT BUDGET:&nbsp <span class="budget">{{ number_format((float)$transaction['details']->budget, 2) }}</span> </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    
                                                    <div class="col-md-7">
                                                        <div class="form-group">
                                                            <label for="" class="form-label">STATUS:&nbsp <span class="budget">{{ $transaction['details']->status }}</span> </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <label for="" class="form-label">DATE REQUESTED:&nbsp <span class="budget">{{ date('F j, Y', strtotime($transaction['details']->date_sent)) }}</span> </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="">PURPOSE: </label>
                                                            <textarea class="form-control" name="" id="purpose" cols="30" rows="10" disabled>{{ $transaction['details']->purpose }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    
                                                    <div class="col-md-7">
                                                        <div class="form-group">
                                                            <label for="" class="form-label">NUMBER OF ITEMS:&nbsp <span class="budget">{{ $transaction['details']->itemcount }}</span> </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <label for="" class="form-label float-right">TOTAL COST:&nbsp <span class="budget">{{ number_format((float)$transaction['details']->totalprice, 2) }}</span> </label>
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
                                                
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body" style="height: auto"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="col-md-12">
                            <div class="row float-right">
                                @if(trim($transaction['details']->statcode) == 'P')
                                   <!-- <a href="#" class=" disapproveTransaction" data-toggle="modal" data-target="#disapproveModal">DISAPPROVE <i class="fas fa-times"></i></a> -->
                                    <a href="#" class=" approveTransaction" data-transcode="{{ $transaction['details']->transcode }}">APPROVE <i class="fas fa-check"></i></a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="disapproveModal" tabindex="-1" role="dialog" aria-labelledby="disapproveModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-white">TRANSCODE:&nbsp <span id="disapproveModalLabel">{{ $transaction['details']->transcode }}</span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="" class="col-form-label text-white">Remarks: </label>
                            <textarea name="remarks" id="remarks" cols="30" rows="10" class="form-control" required></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="#" class="disapprovePR" data-transcode="{{ $transaction['details']->transcode }}">DIAPPROVE <i class="fas fa-times"></i></a>
            </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/mcc/transaction.js') }}"></script>
@endpush