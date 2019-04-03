@extends('layouts.admin')

@section('pageTitle', 'Purchase Order')

@section('content')

  <div id="wrapper">
  <div id="content-wrapper">
    
    <div class="col-lg-12">
        <br>
      <table class="table table-condensed table-sm">
          <tr>
                <td rowspan="8" class="border-top-0 border-top-0"><img src="{{ asset('../img/logo.png') }}" style="margin-left: 5%; margin-top: 20%" width="150" height="150"></td>
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
                <td class="border-bottom-0"><center>Procurement Management Office</center></td>
                <td colspan="3">Form No.: HS – PS – 006</td>
            </tr> 
            <tr>
                <td rowspan="3" class="border-top-0" width="60%"><center><b><h1>PURCHASE ORDER</h1><b></center></td>
            </tr>
                <td colspan="4">Revision No.: 1</td>
            <tr>
                <td colspan="4">Effectivity Date: September 1, 2016</td>
            </tr>
            <td colspan="7"></td>
        </table> 
        
        <table class="table table-condensed table-sm" style="margin-top:-1.2%">
        <tr>
            <td width="8%"class="border-right-0 border-bottom-0">Supplier:</td>
            <td width="45%"class="border-left-0">
                {{ $datas['details']->supplier }}
            </td>
            <td width="15%"class="border-right-0 border-bottom-0">Purchase Order Number:</td >
            <td width="20%"class="border-left-0">{{ $datas['details']->transcode }}</td>
        </tr>
            <td colspan="2" class="border-top-0 border-bottom-0"></td>
            <td class="border-top-0 border-right-0 border-bottom-0"> Mode of Procurement</td>
            <td class="border-left-0">Public Bidding</td>
       <tr>
            <td class="border-right-0 border-top-0 border-bottom-0">Address:</td>
            <td class="border-left-0 border-top-0">
            {{ $datas['details']->address }}
            </td>
            <td class="border-top-0 border-right-0 border-bottom-0">Purchase Order Date:</td>
            <td class="border-left-0">{{ date('F j, Y', strtotime($datas['details']->date_sent)) }}</td>
       </tr>
            <td colspan="7" class="border-top-0"></td>
        <tr>
            <td colspan="7"><small><center>GENTLEMEN: Please furnish this office the following articles subject to the terms and conditions contained herein:</small></center></td>
        </tr>
        </table>

        <table class="table table-condensed border-bottom-0 table-sm" style="margin-top:-1.2%">
            <tr>
                <td width="8%"class="border-right-0 border-bottom-0">Place of Delivery:</td>
                <td width="30%"class="border-left-0"><b><center>BAGUIO GENERAL HOSPITAL AND MEDICAL CENTER</center></b></td>
                <td width="10%"class="border-right-0 border-bottom-0">Delivery Term:</td >
                <td width="15%"class="border-left-0"><b><center>10</center></b></td>
            </tr>
            <tr>
                <td class="border-top-0 border-right-0 border-bottom-0">Date of Delivery:</td>
                <td class="border-left-0"><b><center>March 29, 2019</center></b></td>
                <td class="border-top-0 border-right-0 border-bottom-0">Payment Term:</td>
                <td class="border-left-0"><b><center></center></b></td>
            </tr>
                <td colspan="7" class="border-top-0"></td>
        </table>

        <table class="table table-condensed border-bottom-0 table-sm" style="margin-top:-1.2%">
            <tr>
                <td width="10%"><b><center>Stock Number</center></b></td>
                <td width="10%"><b><center>UNIT</center></b></td>
                <td width="10%"><b><center>QUANTITY</center></b></td>
                <td width="30%"><b><center>DESCRIPTION</center></b></td>
                <td width="10%"><b><center>UNIT COST</center></b></td>
                <td width="10%"><b><center>AMOUNT</center></b></td>
            </tr>
            @foreach($datas['items'] as $item)
                <tr>
                    <td><center>{{ $item->itemcode }}</center></td>
                    <td>{{ $item->unit }}</td>
                    <td>{{ $item->qty }}</td>
                    <td colspan="4">{{ $item->name }}</td>
                    <td>{{ number_format((float)$item->price, 2) }}</td>
                    <td>{{ number_format((float)($item->qty * $item->price), 2)}}</td>
                </tr>
            @endforeach
            <td colspan="2"><b>Total Amount in Words:</b></td>
            <td colspan="6"><h4 id="totalAmount" data-total="{{ (int)$datas['details']->totalprice }}"></h4></td>
            <td colspan="1"><strong>{{ number_format((float)$datas['details']->totalprice, 2) }}</strong></td>
        </table>
        <table class="table table-condensed table-borderless table-sm" style="margin-top:-1.35%">
            <tr>
                <td colspan="2" class="text-justify border-bottom-0">Non-delivery of the above-mentioned item/s, partial, or completely delivery, within the prescribed
                    delivery term shall have the effect of cancellation of the Purchase Order and Subsequent orders. In case
                    you will be allowed to deliver beyond the delivery term, partial or completely delivery, a penalty of one-tenth(1/10)
                    of one percent (1%) for everyday of delay shall be imposed.</p></td>
            </tr>
            <tr>
                <td class="border-right-0 border-bottom-0"></td>
                <td width="40%" class="border-left-0">Very truly yours,</td>
            </tr>
            <tr>
                <td class="border-right-0 border-bottom-0">Conforme:</td>
                <td width="40%" class="border-left-0"></td>
            </tr>
            <tr>
                <td class="border-right-0 border-bottom-0"></td>
                <td width="40%" class="border-left-0"></td>
            </tr>
            <tr>
                <td width="-10%" class="border-right-0 border-bottom-0"> <center>______________________________________________________</center></td>
                <td class="border-left-0"><center><b><u>RICARDO B. RUNEZ JR.,MD,FPCS,MHA,CESE</u></b></center></td>
            </tr>
            <tr>
                <td width="0%" class="border-right-0 border-bottom-0"><center>Signature Over Printed Name</center></td>
                <td class="border-left-0"><center>Medical Center Chief II</center></td>
            </tr>
            <tr>
                <td width="-10%" class="border-right-0 border-bottom-0"> <center><b><u>February 12, 2019</b></center></td>
                <td></td>
            </tr>
            <tr>
                <td width="0%" class="border-right-0 border-bottom-0"><center>Date</center></td>
                <td></td>
            </tr>
        </table>

        <table class="table table-condensed table-sm" style="margin-top:-1.2%">
                <tr>
                    <td width="8%"class="border-right-0 border-bottom-0"><b>FUND CLUSTER:</b></td>
                    <td width="30%"class="border-left-0"></td>
                    <td width="15%"class="border-right-0 border-bottom-0"></td >
                    <td width="20%"class="border-left-0 border-bottom-0"></td>
                </tr>
                <td width="10%"class="border-top-0 border-right-0 border-bottom-0"><b>FUNDS AVAILABLE:</b></td>
                    <td width="30%"class="border-left-0"></td>
                    <td width="15%"class="border-top-0 border-right-0 border-bottom-0"></td >
                    <td width="20%"class="border-top-0 border-left-0 border-bottom-0"></td>
               <tr>
                    <td class="border-top-0 border-right-0 border-bottom-0"></td>
                    <td class="border-left-0 border-bottom-0"></td>
                    <td width="15%"class="border-top-0 border-right-0 border-bottom-0">ORS / BURS No.:</td >
                    <td width="20%"class="border-top-0 border-left-0"></td>
               </tr> 
               <tr>
                    <td class="border-top-0 border-right-0 border-bottom-0"></td>
                    <td class="border-top-0 border-left-0 border-bottom-0"><center><b><u>CECILIA J. PUGONG, CPA</u></b></center></td>
                    <td width="15%"class="border-top-0 border-right-0 border-bottom-0">Date of ORS / BURS:</td >
                    <td class="border-left-0"></td>
               </tr> 
               <tr>
                    <td class="border-top-0 border-right-0 border-bottom-0"></td>
                    <td class="border-top-0 border-left-0 border-bottom-0"><center><small>Accountant IV</small></center></td>
                    <td class="border-top-0 border-right-0 border-bottom-0">Amount:</td>
                    <td class="border-left-0"></td>
               </tr> 
               <tr>
                    <td class="border-right-0"></td>
                    <td class="border-top-0 border-left-0"><center><small>Head, Accounting Section</small></center></td>
                    <td class="border-top-0 border-right-0"></td>
                    <td class="border-left-0"></td>
               </tr> 
            </table>
        </div>
    </div>  
</div> 
@endsection

@push('scripts')
    <script src="{{ asset('js/forms/po.js') }}"></script>
@endpush