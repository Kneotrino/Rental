<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Kwintasi Hay Rental</title>    
    <style>

    @media print
    {
    body * { visibility: hidden; }
    .invoice-box * { visibility: visible; }
    }

    .invoice-box {
        max-width: 800px;
        margin: auto;
        padding: 30px;
        border: 1px solid #eee;
        box-shadow: 0 0 10px rgba(0, 0, 0, .15);
        font-size: 16px;
        line-height: 24px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: #555;
    }
    
    .invoice-box table {
        width: 100%;
        line-height: inherit;
        text-align: left;
    }
    
    .invoice-box table td {
        padding: 5px;
        vertical-align: top;
    }
    
    .invoice-box table tr td:nth-child(1) {
        text-align: center;
    }
    .invoice-box table tr td:nth-child(2) {
        text-align: right;
    }
    
    .invoice-box table tr.top table td {
        padding-bottom: 20px;
    }
    
    .invoice-box table tr.top table td.title {
        font-size: 45px;
        line-height: 45px;
        color: #333;
    }
    
    .invoice-box table tr.information table td {
        padding-bottom: 40px;
    }
    
    .invoice-box table tr.heading td {
        background: #eee;
        border-bottom: 1px solid #ddd;
        font-weight: bold;
    }
    
    .invoice-box table tr.details td {
        padding-bottom: 20px;
    }
    
    .invoice-box table tr.item td{
        border-bottom: 1px solid #eee;
    }
    
    .invoice-box table tr.item.last td {
        border-bottom: none;
    }
    
    .invoice-box table tr.total td:nth-child(2) {
        border-top: 2px solid #eee;
        font-weight: bold;
    }
    
    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td {
            width: 100%;
            display: block;
            text-align: center;
        }
        
        .invoice-box table tr.information table td {
            width: 100%;
            display: block;
            text-align: center;
        }
    }
    
    /** RTL **/
    .rtl {
        direction: rtl;
        font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    }
    
    .rtl table {
        text-align: right;
    }
    
    .rtl table tr td:nth-child(2) {
        text-align: left;
    }

    .btn {
  border: none;
  background-color: inherit;
  padding: 14px 28px;
  font-size: 16px;
  cursor: pointer;
  display: inline-block;
}

/* Green */
.success {
  color: green;
}

.success:hover {
  background-color: #4CAF50;
  color: white;
}

/* Blue */
.info {
  color: dodgerblue;
}

.info:hover {
  background: #2196F3;
  color: white;
}

/* Orange */
.warning {
  color: orange;
}

.warning:hover {
  background: #ff9800;
  color: white;
}

/* Red */
.danger {
  color: red;
}

.danger:hover {
  background: #f44336;
  color: white;
}

/* Gray */
.default {
  color: black;
}

.default:hover {
  background: #e7e7e7;
}
*,
 ::after,
 ::before {
    box-sizing: border-box;
}

.no-gutters>.col,
.no-gutters>[class*=col-] {
    padding-right: 0;
    padding-left: 0;
}

.block {
    padding-top: 90px;
    padding-bottom: 100px;
}

.col-md-6 {
    -ms-flex: 0 0 50%;
    flex: 0 0 50%;
    max-width: 50%;
}

.max-container-map-left {
    position: relative;
    z-index: 1;
}

.form-footer {
    height: 100%;
    background-repeat: no-repeat;
    background-size: cover;
}

.get_more_info .form-footer {
    position: relative;
}

.max-container-map-left {
    max-width: 640px;
    padding: 0px 50px;
    margin: 0 0 0 auto;
}

.get_more_info {
    position: relative;
    margin-top: -100px;    
}

.no-gutters {
    margin-right: 0;
    margin-left: 0;
}

.row {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    height: 300px;
    margin-right: -15px;
    margin-left: -15px;
}

.get_more_info h2 {
    font-size: 40px;
    color: #fff;
    margin-bottom: 30px;
    font-weight: bold;
}

.get_more_info h3 {
    font-size: 20px;
    font-weight: bold;
    margin-bottom: 30px;
    padding-top: 20px;
}

.get_more_info .form-footer {
    position: relative;
}

.get_more_info .form-footer:before {
    content: "";
    opacity: 0.75;
    position: absolute;
    top: 0;
    left: 0px;
    width: 100%;
    height: 100%;
}

tr, td {
  text-align: center;
  padding: 8px;
}
    </style>
</head>

<body>
        <script>
        function printDiv(divName) {
             window.print();
        }
        </script>
<table style="width:100%">
        <?php
            include './connect.php';    
            // $transaksi_id = $_GET["id"];   
        ?>
  <tr>
    <th>
        <button onclick="printDiv('invoice')" class="btn warning" >Print</button>
    </th>
  </tr>
</table>

    <div class="invoice-box">
        <div class="get_more_info">
            <div class="row no-gutters">
                <div class="col-md-6">
                    <div class="form-footer block"">
                    <p style="text-align:center;"><img src="logo.jpeg" width="160" height="160" alt="Logo"></p>
                    </div>
                </div>
                <div class="col-md-6 block">
                    <div class="max-container-map-left">
                        <h3> HAY RENTAL MOBIL </h3>
                        <p class="mb-4 pb-0">Jln.Komodo Airnona, Kota Kupang<br>Nusa Tenggara Timur</p>
                    </div>
                </div>
            </div>
        </div>

        <table style="border-collapse: collapse;  width: 100%;">
            <tr>
                <th>YANG BETANDA TANGAN DI BAWAH INI</th>
                <th>NO.HRM/..../..../..../</th>
            </tr>
            <tr>
                <td>Company</td>
                <td>Country</td>
            </tr>
            <tr>
                <td>Company</td>
                <td>Country</td>
            </tr>
            <tr>
                <td>Company</td>
                <td>Country</td>
            </tr>
            <tr>
                <td>Company</td>
                <td>Country</td>
            </tr>
            <tr>
                <th>YANG BETANDA TANGAN DI BAWAH INI</th>
                <th>NO.HRM/..../..../..../</th>
            </tr>
            <tr>
                <td>Company</td>
                <td>Country</td>
            </tr>
            <tr>
                <td>Company</td>
                <td>Country</td>
            </tr>
            <tr>
                <td>Company</td>
                <td>Country</td>
            </tr>
            <tr>
                <th>Masa Sewa</th>
                <td>
                    <table>
                        <tr>
                            <td>Jam</td>
                            <td>Hari</td>
                            <td>Bulan</td>
                            <td>Tahun</td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td>Kelengkapan</td>
                <td>Country</td>
            </tr>
            <tr>
                <td>Norek Bank Mandiri</td>
                <td>000000000000000000</td>
            </tr>
            <tr>
                <td></td>
                <td>Di nyatakan di kupang, ../../..</td>
            </tr>
            <tr>
                <th>Adminstrasi<br><br><br><br></th>
                <th>Penyewa<br><br><br><br></th>
            </tr>
            <tr>
                <th>(...................)</th>
                <th>(...................)</th>
            </tr>
        </table>        
    </div>
<script>
// Set the date we're counting down to



  var countDownDate = new Date("  <?php 
    echo date_format($dateBatas,"D, d M y H:i:s");
  ?>").getTime();

  // Update the count down every 1 second
  var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();
    
  // Find the distance between now and the count down date
  var distance = countDownDate - now;
    
  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
  // Output the result in an element with id="demo"
  document.getElementById("demo").innerHTML = "Batas Pelunasan Deposit(DP)<br>"+days + "d " + hours + "h "
  + minutes + "m " + seconds + "s ";
    
  // If the count down is over, write some text 
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("demo").innerHTML = "BOOKING TELAH KADALUARSA SILAHKAN BUAT BARU";
  }
}, 1000);
</script>    
</body>
</html>