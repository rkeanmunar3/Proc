@extends('layouts.admin')

@section('pageTitle', 'Purchase Request')

@section('content')

  <div id="wrapper">
  <div id="content-wrapper">
    
    <div class="col-lg-12">

      <table class="table table-condensed table-sm">
          <tr>
              <td rowspan="7" class="border-top-0 border-right-0"><img src="{{ asset('img/logo.png') }}" style="margin-left: 5%; margin-top: 15%" width="150" height="150"></td>
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
              <td rowspan="3" width="40%"><center><br><b><h1>PURCHASE REQUEST</h1><b></center></td>
              <td colspan="4">Form No.: HS - PS - 001</td>
          </tr>     
              <td colspan="4">Revision No.: 3</td>
          <tr>
              <td colspan="4">Effectivity Date: September 1, 2016</td>
          </tr>
          <td colspan="7"></td>
          <tr>
              <td colspan="1" width="15%">Department: </td>
              <td width="10%"><b>{{ $transaction['details']->division }}</b></td>
              <td width="12.5%">PR No.:</td>
              <td width="11%"><b>{{ $transaction['details']->transcode }}</b></td>
              <td width="1%">Date: </td>
              <td width=""><b>{{ date('F j, Y', strtotime($transaction['details']->date_sent)) }}</b></td>
          </tr>
          <tr>
              <td colspan="1" width="15%">Section: </td>
              <td><b>{{ $transaction['details']->hosdep }}</b></td>
              <td>SAI No.:</td>
              <td width=""></td>
              <td width="">Date: </td>
              <td></td>
          </tr>
          <tr>
              <td colspan="2" width="15%"></td>
              <td>ORS No./BURS No:</td>
              <td width=""></td>
              <td width="">Date: </td>
              <td></td>
          </tr>
              <td colspan="7"></td>
        </table>
        
        <table class="table table-condensed table-sm table-sm" style="margin-top:-1.2%">
            <tr>
                <td class="border-top-0" width="5%"><center><b>Item No.</center></td>
                <td class="border-top-0" width="5%"><center><b>Qty.</center></td>
                <td class="border-top-0" width="7%"><center><b>Unit of Issue</center></td>
                <td class="border-top-0"><center><b>Item Description</center></tdv>
                <td class="border-top-0" width="5%"><center><b>Stock No.</center></td>
                <td class="border-top-0" width="15%"><center><b>Estimated Unit Cost</center></td>
                <td class="border-top-0" width="15%"><center><b>Estimated Cost</center></td>
            </tr>
            @foreach($transaction['items'] as $item)
            <tr>
                <td width="5%"><center>
                    {{$loop->iteration}}
                </center></td>
                <td width="5%"><center>{{$item->qty}}</center></td>
                <td width="7%"><center>{{ $item->unit }}</center></td>
                <td><b>{{ $item->name }}</b>
                  <br><br>{{$item->description.','.$item->specs}}
                </td>
                <td width="7%">{{ $item->itemcode }}</td>
                <td width="15%"><center>{{ number_format((float)$item->price, 2) }}</center></td>
                <td width="15%"><center>{{ number_format((float)($item->price * $item->qty), 2) }}</center></td>
              </tr>
            @endforeach
            <tr>
                <td>Purpose:</td>
                <td colspan="7"><b>{{ $transaction['details']->purpose }}</td>
            </tr>
            <tr>
                <td colspan="7"><b>Required Attachments:</b> <i class="text-primary">(For Procurement Management Office use only)</td>
            </tr>          
        </table>
        <table class="table table-condensed table-borderless border-bottom-0 table-sm" style="margin-top:-1.3%">
            <tr>
                <td width="3%"><input type="checkbox" style="width: 25px; height: 25px"></td>
                <td>Stock Position Sheet for Consumables</td>

                <td width="3%"><input type="checkbox" style="width: 25px; height: 25px"></td>
                <td>Acknowledgement Receipt for Equipment</td>

                <td width="3%"><input type="checkbox" style="width: 25px; height: 25px"></td>
                <td>Certificate of  No suitable subtitute</td>
            </tr>
            {{-- ROW 2 --}}
            <tr>
                <td width="3%"><input type="checkbox" style="width: 25px; height: 25px"></td>
                <td>Justification for none inclusion in the PPMP</td>

                <td width="3%"><input type="checkbox" style="width: 25px; height: 25px"></td>
                <td>Biomedical Service Report / MIS Service Report</td>

                <td width="3%"><input type="checkbox" style="width: 25px; height: 25px"></td>
                <td>Certificate of  Exclusive Distributorship</td>
            </tr>
            {{-- ROW 3 --}}
            <tr>
                  <td width="3%"><input type="checkbox" style="width: 25px; height: 25px"></td>
                <td>Complete generic specification of item/s requested</td>

                  <td width="3%"><input type="checkbox" style="width: 25px; height: 25px"></td>
                <td>Scope of Work / Detailed Estimate</td>

                  <td width="3%"><input type="checkbox" style="width: 25px; height: 25px"></td>
                <td>Price Quotation</td>
            </tr>
        </table>
        <table class="table table-condensed table-borderless border-top-0 table-sm table-sm" style="margin-top:-1.3%">
            <tr>
                <td>Others:</td>
                <td width="100%"></td>   
            </tr>
        </table>
        <table class="table table-condensed table-sm table-sm" style="margin-top:-1.2%">
            <tr>
                <td class="border-top-0" width="20%"></td>
                <td class="border-top-0">Requested By:</td>
                <td class="border-top-0">Approved By:</td>
            </tr>
            <tr>
                <td>Signature:</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Printed Name:</td>
                <td><center><b>{{ $transaction['details']->name }}</center></td>
                <td><center><b>RICARDO B. RUNEZ, J.R., MD,FPCS,MHA,CESE</center></td>
            </tr>
            <tr>
                <td>Designation:</td>
                <td><center>{{ $transaction['details']->hosdep }}</center></td>
                <td><center>Medical Center Chief II</center></td>
            </tr>
        </table>
         
      </div>  
  </div> 
@endsection
