<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
 <title>Your Label</title>
</head>
<body>
  <div class="label">
    <!-- TOP SECTION -->
    <div class="top">
      <div class="top-left">
        <div class="top-left-top">
          <ul>
            <li>Package: 1 of 1</li>
{{--              <li>Contents: {{$shipment->contents}}</li>--}}
{{--            <li>Value: GBP {{sprintf('%01.2f',$shipment->value/100)}}</li>--}}
          </ul>
        </div>
        <div class="top-left-bottom">
          <div class="ie-barcode">
            {!! DNS1D::getBarcodeHTML($shipment->shipment_reference, 'C128', 2, 40) !!}
            <span class="ie-barcode-number">{{$shipment->shipment_reference}}</span>
            <img src="{{public_path().'/assets/images/logo01.svg'}}" class="ie-logo">
          </div>
        </div>
      </div>
      <div class="top-right">
        <div class="cnee-address">
          <ul>
            <li>{{$shipment->consignee}}</li>
            <li>{{$shipment->consignee_address_1}}</li>
            <li>{{$shipment->consignee_city}}</li>
            <li>{{$shipment->consignee_zip}}</li>
            <li>{{$countryName}}</li>
            <li>Tel: {{$shipment->consignee_contact_tel}}</li>
          </ul>
        </div>
      </div>
    </div>
    <!-- BOTTOM SECTION -->
    <div class="bottom">
      <div class="bottom-top">
        <div class="bottom-top-left">
          <div class="ie-address">
            <ul>
              <li>Impact Express Wholesale Ltd</li>
              <li>Unit 5, Britannia Industrial</li>
              <li>Slough</li>
              <li>SL3 0BH</li>
            </ul>
          </div>
        </div>
        <div class="bottom-top-right">
          <div class="bottom-top-right-left">
            <ul>
              <li>{{$shipment->shipment_reference}}</li>
              <li style="font-weight:bolder;font-size:22px;">{{$shipment->label->delivery_method_desc}}</li>
              <li>04/05/2020</li>
              <li>{{$shipment->dead_weight/1000}}kg</li>
            </ul>
          </div>
          <div class="bottom-top-right-right">
              <img src="{{public_path().'/assets/images/hermes-label.jpg'}}" class="h-logo">
              <ul>
                  <li class="box sort-box">{{$shipment->label->sort_level_1}} {{$shipment->label->sort_level_2}}</li>
              </ul>
          </div>
        </div>
      </div>
      <div class="bottom-bottom">
          <div class="h-barcode">
              {!! DNS1D::getBarcodeHTML($shipment->label->barcode_number, 'C128', 1.5, 90) !!}
              <span class="h-barcode-number">{{$shipment->label->barcode_display}}</span>
          </div>
        <img class="h-barcode2d" src="{{Storage::path('test1.svg')}}">
      </div>
    </div>
  </div>
<style>
   * {
    box-sizing: border-box;
    font-family: Arial;
   }
   ul {
    list-style-type:none;
    padding-left: 30px;
  }
  .label {
    width: 100%;
    height: 46%;
    border: 1px dashed black;
  }
  .top {
    width: 100%;
    height: 18%;
  }
  .top-left {
    display:inline-block;
    float:left;
    width: 50%;
    height: 10%;
  }
  .top-left-top {
    height:2%;
  }
  .top-left-bottom {
    padding-left:30px;
  }
  .top-right {
    display:inline-block;
    float:right;
    height:20%;
    width: 50%;
  }
  .cnee-address {
    border: 1px solid black;
    height:15%;
    width:300px;
    margin: auto;
    margin-top: 15px;
  }
  .bottom {
    width: 100%;
    height: 20%;
    border-top: 2px solid black;
  }
  .bottom-top-left {
    display:inline-block;
    float:left;
    width: 50%;
  }
  .bottom-top-right {
    display:inline-block;
    position: absolute;
    width: 50%;
    height:15%;
  }
  .bottom-top-right-left {
    display:inline-block;
    float:left;
    height:15%;
    width:40%;
  }
  .bottom-top-right-left ul {
    padding:0;
  }
  .bottom-top-right-right {
    display:inline-block;
    float:right;
    height:15%;
    width:60%;
    font-weight: bold;
  }
  .bottom-top-right-right ul {
    padding: 0;
    font-size:20px;
  }
  .ie-address {
    border: 1px solid black;
    height:11%;
    width:300px;
    margin: auto;
    margin-top: 20px;
  }
  .ie-address ul {
    margin-top: 4px;
  }
  .bottom-bottom {
    position: relative;
  }
  .h-logo {
    position: absolute;
    height: 50px;
    top:10px;
    left: 720px;
  }
  .ie-logo {
    position: absolute;
    height: 40px;
    top:130px;
    left: 20px;
  }
  .h-barcode {
    position: absolute;
    top: 160px;
    left: 25px;
  }
  .box {
    border: 1px solid black;
    width:70%;
    height:30px;
    padding: 5px 0 0 10px;
    margin-bottom: 10px;
  }
  .sort-box {
      position: absolute;
      height: 30px;
      top:65px;
      left: 720px;
  }
  .h-barcode2d {
      position:absolute;
      right: 50px;
      top:120px;
      width:275px;
  }
</style>
</body>
</html>
