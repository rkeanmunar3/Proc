@extends('layouts.admin')

@section('pageTitle', 'PPMP Request')

@push('styles')
    <style>
         @media print{@page {size: landscape}}
    </style>
@endpush

@section('content')

  <div id="wrapper">
  <div id="content-wrapper">
    
    <div class="col-lg-12">

      <table class="table table-condensed table-sm">
          <tr>
                <td rowspan="7" class="border-top-0"><img src="{{ asset('img/logo.png') }}" style="margin-left: 5%; margin-top: 15%" width="150" height="150"></td>
                <td colspan="5" class="border-top-0 border-bottom-0"><center>Republic of the Philippines</center></td>
         </tr>
                <td colspan="5" class="border-top-0 border-bottom-0"><center>Department of Health</center></td>
          <tr>
              
                <td colspan="5" class="border-top-0 border-bottom-0"><center><b>BAGUIO GENERAL HOSPITAL AND MEDICAL CENTER<b></center></td>
          </tr>
          <tr>
                <td colspan="5" class="border-top-0" ><center>Baguio City</center></td>
          </tr>
          <tr>
                <td rowspan="3" width="70%"><center><br><b><h2>Project Procurement Management Plan</h2><b></center></td>
                <td colspan="4">Form No.: MCC-BAC-</td>
          </tr>     
                <td colspan="4">Revision No.: Ø</td>
          <tr>
                <td colspan="4">Effectivity Date:</td>
          </tr>
        </table>

        <table class="table table-condensed table-borderless border-0 table-sm" style="margin-top:-.5%">
            <tr>
                <td width="12%"><i><h4>END USER/UNIT:</h4></td>
                <td><h4><u>{{ $transaction['details']->hosdep }}</h4></td> {{--INSERT DEPARTMENT HERE --}}
            </tr>
            <tr>
                <td colspan="2"><i><b>Charged to GAA</td>
            </tr>
            <tr>
                <td colspan="2"><i>Projects, Programs and Actvities (PAPS)</td>
            </tr>
        </table>
        <hr class="border border-dark">
        <table class="table table-condensed border border-dark table-sm" style="margin-top:-.5%">
            <tr>
                <td class="border-top-0" rowspan="2"><center><b><br>CODE</center></td>
                <td class="border-top-0" rowspan="2"><center><b><br>GENERAL DESCRIPTION</center></td>
                <td class="border-top-0" rowspan="2" width="5%"><center><b><br>Unit of Issue</center></td>
                <td class="border-top-0"><center><b>QUANTITY /</center></td>
                <td class="border-top-0" rowspan="2" width="5%"><center><b><br>Unit Cost</center></td>
                <td class="border-top-0" rowspan="2" width="7%"><center><b><br>ESTIMATED BUDGET</center></td>
                <td class="border-top-0" rowspan="2" width="7%"><center><b><br>Mode of Procurement</center></td>
                <td class="border-top-0" colspan="12"><center><b>SCHEDULE / MILESTONE OF ACTIVITIES</center></td>
            </tr>
            <tr>
                <td><center><b>SIZE</center></td>
                <td><center><b>Jan</center></td>
                <td><center><b>Feb</center></td>
                <td><center><b>Mar</center></td>
                <td><center><b>Apr</center></td>
                <td><center><b>May</center></td>
                <td><center><b>Jun</center></td>
                <td><center><b>July</center></td>
                <td><center><b>Aug</center></td>
                <td><center><b>Sept</center></td>
                <td><center><b>Oct</center></td>
                <td><center><b>Nov</center></td>
                <td><center><b>Dec</center></td>
            </tr>
            @foreach($transaction['items'] as $item)
                <tr>
                    <td><center>{{ $item->itemcode }}</center></td>
                    <td><center>{{ $item->name }}</center></td>
                    <td><center>{{ $item->unit }}</center></td>
                    <td><center>{{ $item->qty }}</center></td>
                    <td><center>{{ number_format((float)$item->price,2) }}</center></td>
                    <td><center>{{ number_format((float)($item->qty * $item->price),2) }}</center></td>
                    <td><center></center></td>
                    <td><center>{{  $item->jan }}</center></td>
                    <td><center>{{ $item->feb }}</center></td>
                    <td><center>{{ $item->mar }}</center></td>
                    <td><center>{{ $item->apr }}</center></td>
                    <td><center>{{ $item->may }}</center></td>
                    <td><center>{{ $item->jun }}</center></td>
                    <td><center>{{ $item->jul }}</center></td>
                    <td><center>{{ $item->aug }}</center></td>
                    <td><center>{{ $item->sep }}</center></td>
                    <td><center>{{ $item->oct }}</center></td>
                    <td><center>{{ $item->nov }}</center></td>
                    <td><center>{{ $item->dec }}</center></td>  
                </tr>
            @endforeach
            <tr>
                <td><b>TOTAL BUDGET:</b></td>
                <td colspan="4"></td>
                <td></td>
            </tr>
            <tr>
                <td>+10% Provision for Inflation</td>
                <td colspan="4"></td>
                <td></td>
            </tr>
            <tr>
                <td>+10% Contingency</td>
                <td colspan="4"></td>
                <td></td>
            </tr>
            <tr>
                <td><b>TOTAL ESTIMATED BUDGET:</td>
                    <td colspan="4"><strong>{{ number_format((float)$transaction['details']->totalprice, 2) }}</strong></td>
                <td></td>
            </tr>
        </table>
        <div class="text-body">
            <small>NOTE: Technical Specifications for each Item/Project being propsed shall be submitted as part of the PPMP.</small> 
        </div> 
        <br>
        <div class="row">
            <div class="col-6 col-md-9"><small>Prepared by:</small></div> <br> <br>
            <div class="col-10 col-lg-12" style="margin-left: 5%"><b>{{ $transaction['details']->name }}.</b></div>
            <div class="col-10 col-lg-12" style="margin-left: 5%"><small> HEAD, {{ $transaction['details']->hosdep }}</small></div>
        </div> 

        <div class="row" style="margin-left: 50%; margin-top:-5%">
                <div class="col-6 col-md-9"><small>Submitted by:</small></div> <br> <br>
                <div class="col-10 col-lg-12" style="margin-left: 15%"><b>{{ $transaction['details']->name }}, Programmer</b></div>
                <div class="col-10 col-lg-12" style="margin-left: 20%"><small>Department Head, MIS Division</small></div>
            </div>
      </div>  
  </div> 
@endsection
