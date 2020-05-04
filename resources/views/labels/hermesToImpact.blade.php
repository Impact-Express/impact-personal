<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
 <title>Your Label</title>
</head>
<body>

  <div class="label">
    <div class="top">
      <div class="top-left">
        <div class="top-left-top">
          <ul>
            <li>Package: 1 of 1</li>
              <li>Contents: Sunglasses</li>
            <li>Value: GBP 150.00</li>
          </ul>
        </div>
        <div class="top-left-bottom">
          <div class="barcode">
            {!! DNS1D::getBarcodeHTML('6157173010108895', 'I25', 2, 60) !!}
            <span class="ie-barcode-number">IE12345678</span>
          </div>
        </div>
      </div>
      <div class="top-right">
        <div class="cnee-address">
          <ul>
            <li>Steve Stevens</li>
            <li>123 The Street</li>
            <li>Beverly Hills</li>
            <li>90210 CA</li>
            <li>USA</li>
            <li>Tel: 7896543234</li>
          </ul>
        </div>
      </div>
    </div>
    <div class="bottom">
    
    </div>
  </div>

<style>
   * {
    box-sizing: border-box;
   }
   ul {
    list-style-type:none;
    padding-left: 30px;
  }
  .label {
    width: 100%;
    height: 40%;
    border: 1px dashed black;
  }
  .top {
    width: 100%;
    height: 20%;
  }
  .top-left {
    display:inline-block;
    float:left;
    width: 50%;
    height: 10%;
  }
  .top-left-top {
    height:8%;
  }
  .top-left-bottom {
    padding-left:30px;
  }
  .top-right {
    float:right;
    display:inline-block;
    height:20%;
    width: 50%;
  }
  .cnee-address {
    border: 1px solid black;
    height:15%;
    width:300px;
    margin: auto;
    margin-top: 20px;
  }
  .bottom {
    width: 100%;
    height: 20%;
    border-top: 2px solid black;
  }
  




  
</style>
</body>

</html>
