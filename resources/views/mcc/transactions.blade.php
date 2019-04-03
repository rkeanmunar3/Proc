@extends('home')

@push('style')
    <link rel="stylesheet" href="{{ asset('css/mcc/transactions.css') }}">
@endpush

@section('content')
    @include('partials.navigation')
    <div class="col-md-12 py-2">
        <div class="card container-card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <a class="navs nav-link" href="{{ route('mcctransactions', ['status' => 'P']) }}" aria-expanded="false"><i class="fas fa-shopping-cart"></i>&nbsp Pending</a></li>
                            <a class="navs nav-link" href="{{ route('mcctransactions', ['status' => 'A']) }}"><i class="fas fa-check"></i>&nbsp Approved</a>
                           <!-- <a class="navs nav-link" href="{{ route('mcctransactions', ['status' => 'D']) }}"><i class="fas fa-times"></i>&nbsp Dispproved</a>
                            <a class="navs nav-link" href="{{ route('mcctransactions', ['status' => 'R']) }}"><i class="fas fa-sync"></i>&nbsp Returned</a> -->
                        </div> 
                    </div>
                    <div class="col-md-6">
                        <div class="row float-right">
                            <input type="text" class="form-control" placeholder="Search" name="search" id="search">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row mb-1">
                    <div class="col-md-8">
                        <!--<h6 class="page-name">
                            {{ $page }}
                        </h6>-->
                    </div>
                    <div class="col-md-4">
                        
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-condensed table-hover table-striped text-white" id="prTable">
                            <thead>
                                <tr>
                                    <th>TRANSCODE</th>
                                    <th>FROM</th>
                                    <th>ITEMS</th>
                                    <th>TOTAL PRICE</th>
                                    <th>DATE SENT</th>
                                    <th>STATUS</th>
                                    <th class="text-center"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($transactions as $transaction)
                                    <tr>
                                        <td>{{ $transaction->type.'-'.$transaction->transcode }}</td>
                                        <td>{{ $transaction->department }}</td>
                                        <td>{{ $transaction->items }}</td>
                                        <td>{{ number_format((float)$transaction->totalprice, 2) }}</td>
                                        <td>{{ date('F j, Y', strtotime($transaction->date_sent)) }}</td>
                                        <td>{{ $transaction->status }}</td>
                                        <td>
                                            <a href="{{ route('mccviewTransaction', ['transcode' => $transaction->transcode]) }}" target="_blank" class="viewTransaction"><i class="fas fa-eye"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="row col-md-12 justify-content-center paging">

                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="prModal" tabindex="-1" role="dialog" aria-labelledby="prModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-white">PR No: <span id="prModalLabel"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-sm table-hover table-bordered table-striped" id="itemTable">
                    <thead class="">
                        <tr>
                            <th></th>
                            <th>Item Name</th>
                            <th>Unit</th>
                            <th>Description</th>
                            <th>Specifications</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary disapprovePR">DIAPPROVE <i class="fas fa-times"></i></button>
                <button type="button" class="btn btn-primary approvePR">APPROVE <i class="fas fa-check"></i></button>
            </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/mcc/transactions.js') }}"></script>
@endpush