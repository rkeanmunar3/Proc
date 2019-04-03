@extends('layouts.admin')

@section('pageTitle', 'Abstract of Quotation')

@section('content')

  <div id="wrapper">
  <div id="content-wrapper">
    
    <div class="col-lg-12">

    <table class="table table-condensed table-sm">
        <tr>
            <td rowspan="7" class="border-top-0"><img src="../bghmc.png" style="margin-left: 18%; margin-top: 15%" width="150" height="150"></td>
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
            <td rowspan="3" width="40%"><center><br><b><h2>ABSTRACT OF QUOTATION</h2><b></center></td>
            <td colspan="4">Form No.: HS – PS-010</td>
        </tr>     
            <td colspan="4">Revision No.: Ø</td>
        <tr>
            <td colspan="4">Effectivity Date: August 1, 2014</td>
        </tr>
    </table>     
        <table class="table table-condensed table-borderless border-0 table-sm" style="margin-top:-1.2%">
        <tr>         
            <td colspan="2"></td>
            <td width="15%">PR No.:</td >
            <td class="border-bottom" width="20%"></td>
        </tr>
            <td colspan="2">Canvassed By:</td>
            <td>AOQ No.:</td>
            <td class="border-bottom" width="20%"></td>
       <tr>
            <td></td>
            <td></td>
            <td>Date:</td>
            <td class="border-bottom" width="20%"></td>
       </tr>        
        </table>
        <table class="table table-condensed border-bottom-0 table-sm">
            <tr>
                <td class="border-top-0" width="5%"><center><b>Item No.</b></center></td>
                <td class="border-top-0" width="5%"><center><b>Qty</b></center></td>
                <td class="border-top-0" width="10%"><center><b>Unit</b></center></td>
                <td class="border-top-0" width="25%"><center><b>ARTICLES</b></center></td>
                <td class="border-top-0"><center><b>1</b></center></td>
                <td class="border-top-0"><center><b>2</b></center></td>
                <td class="border-top-0"><center><b>3</b></center></td>
            </tr>
            <tr>
                <td><center>1</center></td>
                <td><center></center></td>
                <td><center></center></td>
                <td><center></center></td>
                <td><center></center></td>
                <td><center></center></td>
                <td><center></center></td>
            </tr>
        </table> 
     {{--SIGNATORIES  --}}
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm"></div>
                <div class="col-sm">Approved:</div>
            </div>
            <br>
            <div class="row">
                <div class="col-sm"><b><u>SAMPLE1</u></b></div> 
                <div class="col-sm-5"><b>SAMPLE2</b></div>
            </div>

            <div class="row">
                <div class="col-sm">BAC Member</div>
                <div class="col-sm-5">BAC Chairperson</div>
            </div>
        </div>
    </div>  
</div> 
@endsection
