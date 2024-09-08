@extends('admin.layout.master')                
@section('main_content')

<style type="text/css">
  /*.ui-autocomplete
  {
    max-width: 26% !important;
  }
  .mass_min {
    background: #fcfcfc none repeat scroll 0 0;
    border: 1px dashed #d0d0d0;
    float: left;
    margin-bottom: 20px;
    margin-right: 21px;
    margin-top: 10px;
    padding: 5px;
  }
  .mass_addphoto {
    display: inline-block;
    margin: 0 10px;
    padding-top: 27px;
    text-align: center;
    vertical-align: top;
  }
  .mass_addphoto {
    text-align: center;
  }
  .upload_pic_btn {
    cursor: pointer;
    font-size: 14px;
    height: 100% !important;
    left: 0;
    margin: 0;
    opacity: 0;
    padding: 0;
    position: absolute;
    right: 0;
    top: 0;
  }*/
</style>

<!-- BEGIN Page Title -->
<div class="page-title">
  <div>
  </div>
</div>
<!-- END Page Title -->
<!-- BEGIN Breadcrumb -->
<div id="breadcrumbs">
  <ul class="breadcrumb">
    <li>
      <i class="fa fa-home">
      </i>
      <a href="{{ url($admin_panel_slug.'/dashboard') }}">Dashboard
      </a>
    </li>

    @if(isset($order_count) && $order_count > 1 && isset($transactionId))
      <span class="divider">
        <i class="fa fa-angle-right">
        </i>
        <i class="fa fa-users faa-vertical animated-hover">
        </i>
        <a href="{{ url($module_url_path) }}/view/{{base64_encode($transactionId)}}" class="call_loader">{{ 'Manage Orders'}}
        </a>
      </span> 
    @else
      <span class="divider">
        <i class="fa fa-angle-right">
        </i>
        <i class="fa fa-users faa-vertical animated-hover">
        </i>
        <a href="{{ url($module_url_path) }}" class="call_loader">{{ $module_title or ''}}
        </a>
      </span> 
    @endif

    <span class="divider">
      <i class="fa fa-angle-right">
      </i>
      <i class="fa fa-eye">
      </i>
    </span> 
    <li class="active"> {{ $page_title or ''}}
    </li>
  </ul>
</div>
<!-- END Breadcrumb -->
<!-- BEGIN Main Content -->
<div class="row">
  <div class="col-md-12">
    <div class="box ">
      <div class="box-title">
        <h3>
          <i class="fa fa-eye">
          </i> {{ $page_title or ''}}
        </h3>
        <div class="box-tool">
        </div>
      </div>
      <div class="box-content">
   
   

        <?php
          $orderId           = isset($obj_order_data->orderId) ? $obj_order_data->orderId : "";
          $loginId           = isset($obj_order_data->loginId) ? $obj_order_data->loginId : "";
          $txnId             = isset($obj_order_data->txnId) ? $obj_order_data->txnId : "";
          $txnStatus         = isset($obj_order_data->txnStatus) ? $obj_order_data->txnStatus : "";
          $txnPrice          = isset($obj_order_data->txnPrice) ? $obj_order_data->txnPrice : "";
          $paperPrice        = isset($obj_order_data->paperPrice) ? $obj_order_data->paperPrice : "";
          $numOfPages        = isset($obj_order_data->numOfPages) ? $obj_order_data->numOfPages : "";
          $printingPrice     = isset($obj_order_data->printingPrice) ? $obj_order_data->printingPrice : "";
          $bindingPrice      = isset($obj_order_data->bindingPrice) ? $obj_order_data->bindingPrice : "";
          $foldingPrice      = isset($obj_order_data->foldingPrice) ? $obj_order_data->foldingPrice : "";
          $txnDate           = isset($obj_order_data->txnDate) ? date('d-m-Y H:i A',strtotime($obj_order_data->txnDate)) : "";
          $userType          = isset($obj_order_data->userType) ? $obj_order_data->userType : "";
          $fullName          = isset($obj_order_data->fullName) ? $obj_order_data->fullName : "";
          $documentTypeName  = isset($obj_order_data->documentTypeName) ? $obj_order_data->documentTypeName : "";
          $sizeName          = isset($obj_order_data->sizeName) ? $obj_order_data->sizeName : "";
          $weightInGsm       = isset($obj_order_data->weightInGsm) ? $obj_order_data->weightInGsm : "";
          $sideName          = isset($obj_order_data->sideName) ? $obj_order_data->sideName : "";
          $bindingOptionName = isset($obj_order_data->bindingOptionName) ? $obj_order_data->bindingOptionName : "";
          $foldingOptionName = isset($obj_order_data->foldingOptionName) ? $obj_order_data->foldingOptionName : "";
          $fileName          = isset($obj_order_data->fileName) ? $obj_order_data->fileName : "";
          $paperTypeName     = isset($obj_order_data->paperTypeName) ? $obj_order_data->paperTypeName : "";
          $paperColorName    = isset($obj_order_data->paperColorName) ? $obj_order_data->paperColorName : "";
          $payVia            = isset($obj_order_data->payVia) ? $obj_order_data->payVia : "";
          $address           = isset($obj_order_data->address) ? $obj_order_data->address : "";
          $processingFee     = isset($obj_order_data->processingFee) ? $obj_order_data->processingFee : "";
          $totalAmount       = isset($obj_order_data->totalAmount) ? $obj_order_data->totalAmount : "";

          
          /*$str = '[ ';
          if(isset($obj_order_data->cityTitle) && $obj_order_data->cityTitle != '' && $obj_order_data->cityTitle != null)
          {
            $str.= ucfirst($obj_order_data->cityTitle.',');
          }
          if(isset($obj_order_data->countryName) && $obj_order_data->countryName != '' && $obj_order_data->countryName != null)
          {
            $str.= ucfirst($obj_order_data->countryName);
          }
          $str.=' ]';*/
          $strCityCountry = $str = '';
          if(isset($obj_order_data->cityTitle) && $obj_order_data->cityTitle != '' && $obj_order_data->cityTitle != null)
          {
            $strCityCountry.= ucfirst($obj_order_data->cityTitle.',');
          }
          if(isset($obj_order_data->countryName) && $obj_order_data->countryName != '' && $obj_order_data->countryName != null)
          {
            $strCityCountry.= ucfirst($obj_order_data->countryName);
          }
          if($strCityCountry != '')
          {
            $str = '[ ';
            $str.= $strCityCountry;
            $str.= ' ]';
          }

          $pdf = $uploads_public_path.$loginId.'/product/'.$fileName;
        ?>

        <div class="box">
          <div class="box-content studt-padding">
            <div class="row">
              <div class="form-group" style="margin-top: 15px;">
                <label class="col-sm-8 col-lg-8 control-label" style="text-align:left">
                  {{-- <h3>Basic Details 
                  </h3> --}}
                </label>
              </div>

              <div class="col-md-6">
                  <table class="table table-bordered">
                  <tbody>
                    <tr>
                      <th style="width: 30%">Transaction ID
                      </th>
                      <td>
                        {{$txnId or ''}}
                      </td>
                    </tr>
                    
                    <tr>
                      <th style="width: 30%">User Name
                      </th>
                      <td>
                       {{$fullName or ''}}
                      </td>
                    </tr>
                    
                    <tr>
                      <th style="width: 30%">User Type
                      </th>
                      <td>
                        {{$userType or ''}}
                      </td>
                    </tr>
                    
                    <tr>
                      <th style="width: 30%">PDF
                      </th>
                      <td>
                        <a href="{{$pdf}}" download>{{$fileName or ''}}</a>
                        
                      </td>
                    </tr>

                    <tr>
                      <th style="width: 30%">Number of pages
                      </th>
                      <td>
                        {{$numOfPages or ''}}
                      </td>
                    </tr>

                    <tr>
                      <th style="width: 30%"> Document Type
                      </th>
                      <td>
                        {{ $documentTypeName or '' }}
                      </td>
                    </tr>
                    <tr>
                      <th style="width: 30%">Paper Size 
                      </th>
                      <td>
                        {{$sizeName or ''}}
                      </td>
                     </tr>
                    <tr>
                      <th style="width: 30%">Paper Type 
                      </th>
                      <td>
                        {{$paperTypeName or ''}}
                      </td>
                    </tr>
                    <tr>
                      <th style="width: 30%">Paper Weight (GSM)
                      </th>
                      <td>
                        {{$weightInGsm or ''}}
                      </td>
                    </tr>
                    
                    <tr>
                      <th style="width: 30%">Color
                      </th>
                      <td>
                        {{$paperColorName or ''}}
                      </td>
                    </tr>

                    <tr>
                      <th style="width: 30%">Printing Side
                      </th>
                      <td>
                        {{$sideName or ''}}
                      </td>
                    </tr>

                    <tr>
                      <th style="width: 30%">Binding
                      </th>
                      <td>
                        {{$bindingOptionName or ''}}
                      </td>
                    </tr>

                    <tr>
                      <th style="width: 30%">Folding
                      </th>
                      <td>
                        {{$foldingOptionName or ''}}
                      </td>
                    </tr> 


                  </tbody>
                </table>  
              </div>            

              <div class="col-md-6">
                  <table class="table table-bordered">
                  <tbody>
                    <tr>
                      <th style="width: 30%">Total Price ({{currency_code()}})
                      </th>
                      <td>
                        {{$totalAmount or ''}}
                      </td>
                    </tr>
                    
                    <tr>
                      <th style="width: 30%">Paper Price ({{currency_code()}})
                      </th>
                      <td>
                       {{$paperPrice or ''}}
                      </td>
                    </tr>
                    
                    <tr>
                      <th style="width: 30%">Printing Price ({{currency_code()}})
                      </th>
                      <td>
                        {{$printingPrice or ''}}
                      </td>
                    </tr>
                    
                    <tr>
                      <th style="width: 30%">Binding Price ({{currency_code()}})
                      </th>
                      <td>
                        {{$bindingPrice or ''}}
                      </td>
                    </tr>

                    <tr>
                      <th style="width: 30%">Folding Price ({{currency_code()}})
                      </th>
                      <td>
                        {{$foldingPrice or ''}}
                      </td>
                    </tr>
                    <tr>
                      <th style="width: 30%">Transaction Price ({{currency_code()}})
                      </th>
                      <td>
                        {{$txnPrice or ''}}
                      </td>
                    </tr>
                    <tr>
                      <th style="width: 30%">Processing Fee ({{'%'}})
                      </th>
                      <td>
                        {{$processingFee or ''}}
                      </td>
                    </tr>
                    <tr>
                      <th style="width: 30%">Status
                      </th>
                      <td>
                        {{$txnStatus or ''}}
                      </td>
                     </tr>

                     <tr>
                      <th style="width: 30%">Pay Via 
                      </th>
                      <td>
                        {{$payVia or ''}}
                      </td>
                    </tr>

                    <tr>
                      <th style="width: 30%">Address
                      </th>
                      <td>
                        {{(preg_replace('#<[^>]+>#',',',$address.' '.$str))}}
                      </td>
                    </tr>

                     <tr>
                      <th style="width: 30%">Transaction Date 
                      </th>
                      <td>
                        {{$txnDate or ''}}
                      </td>
                    </tr>

                    </tbody>
                  </table>  
              </div>

            </div>
          </div>
        </div>
        
      </div>
    </div>
  </div>
  <!-- END Main Content --> 
  @endsection
