@extends('home')

@push('style')
    <link rel="stylesheet" href="{{ asset('css/pharmacy/pr.css') }}">
@endpush

@section('content')
    @include('partials.navigations.user')
    <div class="col-md-12 py-2">
        <div class="card container-card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <a href="{{ route('newPR') }}" target="_blank" class="nav-link" id="newPR">NEW <i class="fas fa-plus"></i></a>
                    </div>
                    <!--<div class="col-md-6 text-center">
                        <h6 class="page-name">
                            {{ $page }}
                        </h6>
                    </div>-->
                    <div class="col-md-4">
                        <div class="input-group float-right">
                            <input type="text" class="form-control" placeholder="Search" name="search" id="search">
                        </div>
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="col-md-12">
                    <table class="table table-condensed table-hover table-striped text-white" id="prTable">
                        <thead>
                            <tr>
                                <th>TRANSCODE</th>
                                <th>PURPOSE</th>
                                <th>ITEMS</th>
                                <th>ESTIMATED BUDGET</th>
                                <th>DATE CREATED</th>
                                <th>STATUS</th>
                                <th class="text-center"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($requests as $request)
                                <tr style="background-color: ">
                                    <td>{{ $request->transcode }}</td>
                                    <td>{{ $request->purpose }}</td>
                                    <td>{{ $request->items }}</td>
                                    <td>{{ number_format((float)$request->totalprice, 2, '.', ',') }}</td>
                                    <td>{{ $request->created_at }}</td>
                                    <td>{{ $request->status }}</td>
                                    <td>
                                      <!--  <a href="{{ route('view', ['transcode' => $request->transcode]) }}" class="viewPR" target="_blank">VIEW <i class="fas fa-eye"></i></a> -->
                                        <a href="{{ (trim($request->type) == 'PR') ? route('generatePR', ['transcode' => $request->transcode]) : route('generatePPMP', ['transcode' => $request->transcode]) }}" class="viewPR" target="_blank">PRINT <i class="fas fa-print"></i></a>
                                        @if(trim($request->statcode) == 'S')
                                            <a href="{{ route('editppmpTransaction', ['transcode' => $request->transcode]) }}" class="text-cyan" target="_blank">EDIT<i class="fas fa-edit"></i></a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/pharmacy/pr.js') }}"></script>
@endpush