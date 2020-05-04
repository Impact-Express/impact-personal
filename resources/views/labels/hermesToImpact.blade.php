<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
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
            <li>Tel: 07896543234</li>
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
              <li>13 Blackthorne Crescent</li>
              <li>Slough</li>
              <li>SL3 0QR</li>
            </ul>
          </div>
        </div>
        <div class="bottom-top-right">
          <div class="bottom-top-right-left">
            <ul>
              <li>IE12345678</li>
              <li>COU-PNET</li>
              <li>04/05/2020</li>
              <li><=1kg</li>
            </ul>
          </div>
          <div class="bottom-top-right-right">
            <ul>
              <li class="box">81 BRAD</li>
              <li>VAN 73</li>
              <li>DROP 15</li>
              <li>C-ROUND 5713</li>
            </ul>
          </div>
        </div>
      </div>
      <div class="bottom-bottom">
        
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
    height: 45%;
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
    margin-top: 20px;
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
    float:right;
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
  }
  .bottom-top-right-right ul {
    padding: 0;
    font-size:20px;
    font-weight: bold;
  }
  .box {
    border: 1px solid block;
    width:70%;
    height:30px;
    padding: 5px 0 0 10px;
    margin-bottom: 10px;
  }
  .ie-address {
    border: 1px solid black;
    width: 300px;
    margin: 20px 0 0 20px;
  }
  .ie-address ul {
    padding: 5px;
    margin:0;
  }


</style>
</body>

</html>
