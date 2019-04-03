@extends('layouts.admin')

@section('pageTitle', 'Request for Quotation')

@section('content')

  <div id="wrapper">
  <div id="content-wrapper">
    
    <div class="col-lg-12">

      <table class="table table-condensed table-sm">
        <tr>
                <td rowspan="7" class="border-top-0"><img src="{{ asset('img/logo.png') }}" style="margin-left: 18%; margin-top: 15%" width="150" height="150"></td>
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
                <td rowspan="3" width="40%"><center><br><b><h2>REQUEST FOR QUOTATION</h2><b></center></td>
                <td colspan="4">Form No.: HS - PS - 007</td>
            </tr>     
                <td colspan="4">Revision No.: 1</td>
            <tr>
                <td colspan="4">Effectivity Date: December 1, 2015</td>
            </tr>
        </table> 
        
        <table class="table table-condensed table-borderless border-0 table-sm" style="margin-top:-1.2%">
        <tr>
           <br>
            <td colspan="2" class="border-bottom"></td> {{-- NAME OF COMPANY --}}
            <td width="15%">Date Prepared:</td >
            <td width="20%"></td>
        </tr>
            <td colspan="2" class="border-bottom"></td>
            <td > Requisition No.:</td>
            <td></td>
       <tr>
            <td></td>
            <td ></td>
            <td>R.F.Q. No.:</td>
            <td></td>
       </tr>        
        </table>
        <table class="table table-condensed table-borderless border-0 table-sm" style="margin-top:-1.2%">
            <tr>
                <td><h5>Gentlemen:</h5></td>
            </tr>        
            <tr>
                <td style="text-indent: 50px; text-align:justify"><h5>Please quote your least price most advantageous to the Government for the following item and/or items for immediate delivery upon notice.</h5></td>
            </tr>
            <tr>
                <td style="text-indent: 50px"><i class="text-danger"><h5>Please indicate the brand and the manufacturer of the item being offered.</h5></td>
            </tr>
        </table>

        <table class="table table-condensed table-sm" style="margin-top:-1.2%">
            <tr>
                <td class="border-top-0" rowspan="2" width="5%"><center>ITEM NO.</center></td>
                <td class="border-top-0" rowspan="2" width="5%"><br><center>QTY</center></td>
                <td class="border-top-0" rowspan="2" width="5%"><br><center>UNIT</center></td>
                <td class="border-top-0" rowspan="2"><h5><center><br><b>ARTICLE AND DESCRIPTION</center></h5></td>
                <td class="border-top-0" rowspan="2" width="10%"><center><small>Approved Budget for the Contact</small></center></td>
                <td class="border-top-0" rowspan="2" width="10%"><br><center>Brand Name</center></td>
                <td class="border-top-0" rowspan="2" width="10%"><br><center>Manufacturer</center></td>
                <td class="border-top-0" colspan="2" width="10%"><center>PRICE</center></td>
            </tr>
            <tr>
                <td><center>UNIT</center></td>
                <td><center>TOTAL</center></td>
            </tr>
            <tr>
                <td><center>1</center></td>
                <td><center></center></td>
                <td><center></center></td>
                <td><center></center></td>
                <td><center></center></td>
                <td><center></center></td>
                <td><center></center></td>
                <td><center></center></td>
                <td><center></center></td>
            </tr>
        </table>
        <table class="table table-condensed table-borderless border-0 table-sm" >      
            <tr>
                <td style="text-align:justify"><h5>NOTE: This Request for Quotation be submitted by the canvasser<b><u> at the BGHMC BAC Office sealed </u></b>on or before _______________________________________.</td>
            </tr>
        </table>
        <table class="table table-condensed table-borderless border-0 table-sm" style="margin-top: 10%">      
            <tr>
                <td style="text-align:justify"><h5>Requested By:</h5></td>
            </tr>
            <tr>
                <td style="text-indent: 50px"><br><br><br>___________________________________________________________</td>
                <td ><br><br><br>___________________________________________________________</td>
            </tr>
            <tr>
                <td style="text-indent: 90px"><b><h5>FELICIDAD F. ATOS, MPA</h5></b></td>
                <td style="text-indent: 155px"><h5>BAC Member</h5></td>
            </tr>
            <tr>
                <td style="text-indent: 90px"><small>SAO, Procurement Management Office</small></td>
            </tr>
            <tr>
                <td style="text-align:justify">This is to certify that I personally distributed the Request for Price Quotation and that the entries herein provided are true and correct of my own personal knowledge and belief, under pain of action for falsification / Perjury.</td>
                <td style="text-align:justify">This is to certify that I / We personally received the Request for Price Quotation and that the entries herein provided are true and correct of my own personal knowledge and belief.</td>
            </tr>
            <tr>
                <td></td>
                <td >___________________________________________________________</td>
            </tr>
            <tr>
                <td style="text-indent: 90px"></h5></b></td>
                <td style="text-indent: 155px"><h5>Supplier</h5></td>
            </tr>
            <tr>
                <td style="text-indent: 100px"></h5></b></td>
                <td style="text-indent: 80px"><h6>(Signature over Printed Name)</h6></td>
            </tr>
            <tr>
                <td style="text-indent: 100px"></h5></b></td>
                <td><h6>Address: <u></u></h6></td>
            </tr>
            <tr>
                <td >___________________________________________________________</td>
                <td></td>
            </tr>
            <tr>
                <td style="text-indent: 150px"><b><h5>Canvasser</h5></b></td>
                <td><h6>Telephone Number: <u></u></h6></td>
            </tr>
            <tr>
                <td><b><h5>Email:<i class="text-primary"> bghmcprocurement@gmail.com</h5></b></td>
            </tr>
        </table>
        </div>
    </div>  
</div> 
@endsection
