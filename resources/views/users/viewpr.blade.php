@extends('home')


@push('style')
    <link rel="stylesheet" href="{{ asset('css/pharmacy/viewpr.css') }}">
@endpush

@section('content')
    @include('partials.navigations.user')
    <div class="col-md-12 py-2">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <div class="col-md-12 ">
                    <h5>PURCHASE REQUEST DETAILS</h5>
                </div>
            </div>
            <div class="card-body container-card">
                <div class="row">
                    <div class="col-md-4">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <label for="" class="col-form-label">Section:</label>
                            </div>
                            <input type="text" class="form-control">
                        </div>
                        <div class="input-group py-2">
                            <div class="input-group-prepend">
                                <label for="" class="col-form-label">Section:</label>
                            </div>
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="input-group">
                                <div class="input-group-prepend">
                                    <label for="" class="col-form-label">Section:</label>
                                </div>
                                <input type="text" class="form-control">
                            </div>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <label for="" class="col-form-label">Section:</label>
                                </div>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                    <div class="col-md-4">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <label for="" class="col-form-label">Section:</label>
                            </div>
                            <input type="text" class="form-control">
                        </div>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <label for="" class="col-form-label">Section:</label>
                            </div>
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-12 py-5">
                        <div class="card">
                            <div class="card-body card-items">
                                <table class="table table-condensed table-sm table-hover table-striped text-white" id="inventoryTable">
                                    <thead>
                                        <tr>
                                            <th>ITEM CODE</th>
                                            <th>NAME</th>
                                            <th>DESCRIPTION</th>
                                            <th>SPECIFICATIONS</th>
                                            <th>QUANTITY</th>
                                            <th>PRICE</th>
                                        </tr>
                                    </thead>
                                    <tbody>
    
                                        @foreach($items as $item)
                                            <tr style="background-color: {{ (trim($item->itemstat) == 'R') ? 'red' : '' }}">
                                                <td>{{ $item->itemcode }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->specs }}</td>
                                                <td>{{ $item->itemstat }}</td>
                                                <td>{{ $item->price }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer">
                                <div class="row justify-content-center">
                                    <div class="paging"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/pharmacy/viewpr.js') }}"></script>
@endpush