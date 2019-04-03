@extends('layouts.admin')

@section('pageTitle', 'APP Request')

@push('styles')
    <style>
         @media print{@page {size: landscape}}
    </style>
@endpush

@section('content')

  <div id="wrapper">
  <div id="content-wrapper">
    
    <div class="col-lg-12">

        {{-- HEADER --}}
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
                <td colspan="5" class="border-top-0"><center>Baguio City</center></td>
          </tr>
          <tr>
              {{-- INSERT CURRENT YEAR HERE --}}
                <td rowspan="3" width="70%"><center><br><b><h1>ANNUAL PROCUREMENT PLAN 2019 </h1><b></center></td>
                <td colspan="4">Form No.: HS-PS-002</td>
          </tr>     
                <td colspan="4">Revision No.: Ø</td>
          <tr>
                <td colspan="4">Effectivity Date: August 1, 2014</td>
          </tr>
            <tr>
                <td colspan="13"></td>
            </tr>
        </table>
        {{-- END HEADER --}}

        {{-- COLUMN HEADER --}}
        <table class="table table-condensed border-bottom-0 table-sm" style="margin-top:-1.2%">
            <tr>
                <td rowspan="2"><center><b><br>Code (PAP)</center></td>
                <td rowspan="2"><center><b><br>Procurement Program/Project</center></td>
                <td rowspan="2"><center><b><br>PMO/End-User</center></td>
                <td rowspan="2"><center><b><br>Mode of Procurement</center></td>
                <td colspan="4"><center><b><br>Schedule for Each Procurement Activity </center></td>
                <td rowspan="2" width="7%"><center><b><br>Source of Funds </center></td>
                <td colspan="3"><center><b><br>Estimated Budget (PhP)</center></td>
                <td width="15%"><center><b>Remarks (brief description of Program/Project)</center></td>
            </tr>
                <td width="4%"><center><b>Ads/Post of IAEB</center></td>
                <td width="4%"><center><b>Sub/Open of Bids</center></td>
                <td width="5%"><center><b>Notice of Award</center></td>
                <td width="4%"><center><b>Contract Signing</center></td>
                <td width="5%"><center><b>Total</center></td>     
                <td width="5%"><center><b>MOOE</center></td>
                <td width="5%"><center><b>CO</center></td>
                <td width="5%"></td>                
            <tr>
                <td colspan="13"></td>
            </tr>
            {{-- END COLUMN HEADER --}}

            @foreach($paps as $key => $pap)
            <tr>
                <td colspan="13" style="background: yellow">{{ $key  }}</td>
            </tr>
                @foreach($paps[$key] as $val)
                    <tr>
                        <td style="padding-left: 15px">{{ $val->papcode }}</td>
                        <td>{{ $val->description }}</td>
                        <td>
                            @foreach($val->depnames as $dep)
                                {{$dep->name.','}}
                            @endforeach
                        </td>
                        <td></td>
                        <td colspan="4">January to December, 2019</td>
                        <td></td>
                        <td>{{ number_format((float)$val->budget, 2) }}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                @endforeach
            @endforeach
            
        </table>

        {{-- SIGNATORIES --}}
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm">Prepared by:</div>
                <div class="col-sm">Certified Correct by:</div>
                <div class="col-sm">Recommending Approval:</div>
                <div class="col-sm">Approved by:</div>
            </div>
            <br>
            <div class="row">
                <div class="col-sm"><b>EDISON S. MORALES</b></div>
                <div class="col-sm"><b>FELICIDAD F. ATOS, MPA</b></div>
                <div class="col-sm"><b>PRISCILLA P. GALISTE, MPA</b></div>
                <div class="col-sm"><b>RICARDO B. RUNEZ JR., MD,FPCS, MHA, CSEE</b></div>
            </div>

            <div class="row">
                <div class="col-sm">BAC II Secretariat</div>
                <div class="col-sm">Head, BAC II Secretariat</div>
                <div class="col-sm">Chief Administrative Officer</div>
                <div class="col-sm">Medical Center Chief II </div>
            </div>
        </div>
      </div>  
  </div>
</div> 
@endsection
