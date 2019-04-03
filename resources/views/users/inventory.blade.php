@extends('home')


@push('style')
    <link rel="stylesheet" href="{{ asset('css/pharmacy/inventory.css') }}">
@endpush

@section('content')
    @include('partials.navigations.user')
    <div class="col-md-12 py-2">
        <div class="card container-header">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-3">
                        <div class="input-group">
                            <div class="input-group-prepend bg-success" >
                                <span class="col-form-label text-white">
                                    Category
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
                            {{ $page }}
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
                <table class="table table-condensed table-sm table-hover table-striped text-white" id="inventoryTable">
                    <thead>
                        <tr>
                            <th></th>
                            <th>ITEM CODE</th>
                            <th>NAME</th>
                            <th>DESCRIPTION</th>
                            <th>SPECIFICATIONS</th>
                            <th>PRICE</th>
                            <th class="text-center">ADD TO</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>

            </div>
            <div class="card-footer">
                <div class="row col-md-12 justify-content-center paging">

                </div>
            
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/pharmacy/inventory.js') }}"></script>
@endpush