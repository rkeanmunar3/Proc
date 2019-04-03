@extends('layouts.masters')

@push('style')
    <link rel="stylesheet" href="{{ asset('css/budget/budget.css') }}">
@endpush

@section('content')
    @include('budget.navigation') 
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-main">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-10">
                                <label for="">ANNUAL PROCUREMENT PLAN</label>
                            </div>
                            <div class="col-md-2">
                                <a href="{{ route('printAPP') }}" class="float-right" target="_blank">PRINT <i class="fas fa-print"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm table-hover table-condensed" id="budgetTable">
                            <thead>
                                <tr>
                                    <th>Code (PAP)</th>
                                    <th>Procurement Program/Project</th>
                                    <th>PMO/End-User</th>
                                    <th></th>
                                    <th>Mode of Procurement</th>
                                    <th>Schedule</th>
                                    <th>Source of Funds</th>
                                    <th></th>
                                    <th>Total</th>
                                    <th>MOOE</th>
                                    <th>CO</th>
                                    <th>Remarks</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($paps as $key => $pap)
                                    <tr style="background: yellow">
                                        <td colspan="13">{{ $key }}</td>
                                    </tr>
                                    @foreach($paps[$key] as $value)
                                        <tr>
                                            <td style="padding-left: 20px">{{ $value->papcode }}</td>
                                            <td>{{ substr($value->description, 0, 30) }}</td>
                                            <td>
                                                <a href="#" class="text-green">Departments: {{ $value->departments }}</a>
                                            </td>
                                            <td>
                                                <a href="#" class="addenduser" data-id="{{ $value->id }}" data-papcode="{{ $value->papcode }}" data-programname="{{ $value->description }}"><i class="fas fa-plus"></i></a>
                                            </td>
                                            <td>
                                                <select name="mode" id="mode">
                                                    <option value="{{ trim($value->proccode) }}" disabled selected hidden>{{ $value->mode }}</option>
                                                    <option value="PB">Public Bidding</option>
                                                    <option value="SP">Shopping</option>
                                                </select>
                                            </td>
                                            <td><a href="#" style="color:black">January to December, 2019</a></td>
                                            <td></td>
                                            <th>
                                                <a href="#" class="addenduser" data-id="{{ $value->id }}" data-programname="{{ $value->description }}"><i class="fas fa-plus"></i></a>
                                            </th>
                                            <td>
                                                <input type="number" name="total" id="total" value="" placeholder="{{ number_format((float) $value->budget, 2) }}">
                                            </td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                <a href="#" class="saves" data-id="{{ $value->id }}" data-papcode="{{ $value->papcode }}" style="color: blue"><i class="fas fa-save"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <small class="modal-title text-white">Program: <small id="addModalLabel" class="text-lime"></small></small>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" >
                        <div class="col-md-12">
                            <table class="table table-sm table-hover table-stripe table-condensed" id="departmentsTable">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>ID</th>
                                            <td>UNIT</td>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="col-md-12">
                            <div class="row float-right">
                                <a href="#" class="nav-link add">ADD <i class="fas fa-plus"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/budget/budget.js') }}"></script>
@endpush