@extends('home')

@push('style')
    <link rel="stylesheet" href="{{ asset('css/pharmacy/editppmp.css') }}">
@endpush

@section('content')
    @include('partials.navigations.user')
    <div class="container-fluid">
        <div class="row py-3">
            <div class="col-md-12">
                <div class="card card-main">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="mb-0 text-white">TRANSACTION CODE:&nbsp </label><strong class="text-lime">{{ trim($transaction['details']->type).'-'.$transaction['details']->transcode }}</strong>
                            </div>
                            <div class="col-md-6 ">
                                <a href="#" class="float-right text-lime">ADD ITEM <i class="fas fa-plus "></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-condensed table-hover" id="itemsTable">
                                    <thead>
                                        <tr>
                                            <th>CODE</th>
                                            <th>GENERAL DESCRIPTION</th>
                                            <th>UNIT</th>
                                            <th>QUANTITY</th>
                                            <th>PRICE</th>
                                            <th>MODE</th>
                                            <th>JANUARY</th>
                                            <th>FEBRRUARY</th>
                                            <th>MARCH</th>
                                            <th>APRIL</th>
                                            <th>MAY</th>
                                            <th>JUNE</th>
                                            <th>JULY</th>
                                            <th>AUGUST</th>
                                            <th>SEPTEMBER</th>
                                            <th>OCTOBER</th>
                                            <th>NOVEMBER</th>
                                            <th>DECEMBER</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($transaction['items'] as $item)
                                            <tr>
    
                                                <td>{{ $item->itemcode }}</td>
                                                <td><strong>{{ $item->name }}</strong>, {{ strtolower($item->specs) }}</td>
                                                <td>{{ $item->unit }}</td>
                                                <td>
                                                    <input type="number" name="origqty" id="origqty" class="origqty" value="{{ $item->qty }}">
                                                </td>
                                                <td>{{ number_format((float)$item->price, 2) }}</td>
                                                <td>
                                                    <select name="mode" id="mode">
                                                        <option value="PB">Public Bidding</option>
                                                        <option value="S">Shopping</option>
                                                    </select>
                                                </td>
                                                <td><input type="number" name="janqty" id="janqty" class="qty" value="{{ $item->jan }}"></td>
                                                <td><input type="number" name="febqty" id="febqty" class="qty" value="{{ $item->feb }}"></td>
                                                <td><input type="number" name="marqty" id="marqty" class="qty" value="{{ $item->mar }}"></td>
                                                <td><input type="number" name="aprqty" id="aprqty" class="qty" value="{{ $item->apr }}"></td>
                                                <td><input type="number" name="mayqty" id="mayqty" class="qty" value="{{ $item->may }}"></td>
                                                <td><input type="number" name="junqty" id="junqty" class="qty" value="{{ $item->jun }}"></td>
                                                <td><input type="number" name="julqty" id="julqty" class="qty" value="{{ $item->jul }}"></td>
                                                <td><input type="number" name="augqty" id="augqty" class="qty" value="{{ $item->aug }}"></td>
                                                <td><input type="number" name="sepqty" id="sepqty" class="qty" value="{{ $item->sep }}"></td>
                                                <td><input type="number" name="octqty" id="octqty" class="qty" value="{{ $item->oct }}"></td>
                                                <td><input type="number" name="novqty" id="novqty" class="qty" value="{{ $item->nov }}"></td>
                                                <td><input type="number" name="decqty" id="decqty" class="qty" value="{{ $item->dec }}"></td>
                                                <td><input type="number" name="hiddenqty" id="hiddenqty" class="hiddenqty" value="{{ $item->qty }}"></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md-6"></div>
                            <div class="col-md-6 ">
                                <div class="row float-right">
                                    <a href="#" class=" text-cyan savePPMP" data-transcode="{{ $transaction['details']->transcode }}">SAVE <i class="fas fa-save"></i></a>
                                    <a href="#" class=" text-lime sendPPMP" data-transcode="{{ $transaction['details']->transcode }}">SEND <i class="fas fa-paper-plane "></i></a>
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
    <script src="{{ asset('js/pharmacy/editppmp.js') }}"></script>
@endpush