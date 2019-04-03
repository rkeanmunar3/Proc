@extends('home')

@push('style')
    <link rel="stylesheet" href="{{ asset('css/pmo/pr.css') }}">
@endpush

@section('main-content')
    <div class="col-md-12 py-2">
        <div class="card container-header">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6 text-center">
                        <h6 class="page-name">
                            Purchase Requests
                        </h6>
                    </div>
                    <div class="col-md-3">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search" name="search" id="search">
                            <!--<div class="input-group-prepend bg-success" style="width: 20px">
                                <span class="col-form-label text-white" >
                                   <i class="fas fa-search"></i>
                                </span>
                            </div>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 py-2">
        <div class="card container-card">
            <div class="card-body">
                <table class="table table-condensed table-hover table-striped text-white" id="prTable">
                    <thead style="color:white">
                        <tr>
                            <th>PR CODE</th>
                            <th>FROM</th>
                            <th>ITEMS</th>
                            <th>ESTIMATED BUDGET</th>
                            <th>DATE SENT</th>
                            <th>STATUS</th>
                            <th class="text-center">ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($requests as $request)
                            <tr>
                                <td>{{ $request->transcode }}</td>
                                <td>{{ $request->name }}</td>
                                <td>{{ $request->items }}</td>
                                <td>{{ $request->totalprice }}</td>
                                <td>{{ $request->date_sent }}</td>
                                <td>{{ $request->status }}</td>
                                <td>
                                    <a href="{{ route('viewPR', ['transcode' => $request->transcode]) }}" target="_blank" class="viewPR text-center"><i class="fas fa-eye"></i></a>
                                    @if(trim($request->statcode) == 'C')
                                        <a href="{{ route('generatePO', ['transcode' => $request->transcode]) }}" target="_blank" class="generatePO" data-prno="'{{ $request->transcode }}'"><i class="fas fa-shopping-cart"></i></a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
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
            <div class="modal-body" style="background-image: url({{ asset('img/bg.png')}}) ; background-size: cover">
                
            </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/pmo/pr.js') }}"></script>
@endpush