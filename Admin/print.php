<!doctype html>
<html>
<?php
            include './connect.php';    
            $transaksi_id = $_GET["id"];
            $transaksi = getTransaksiByID($_GET["id"]);
            $date=date_create("$transaksi[Transaksi_Tanggal]");

        ?>
<head>
    <meta charset="utf-8">
    <title>Kwintasi Hay Rental <?php 
    echo "No. $transaksi_id Tgl ";
    echo date_format($date,"d-m-Y");                
    
    ?></title>    
    <style>

    @media print
    {
    body * { visibility: hidden; }
    .invoice-box * { visibility: visible; 
    }
    html, body {
    height:100%; 
    margin: 0 !important; 
    padding: 0 !important;
    overflow: hidden;
  }
    table { /* Or specify a table class */
    max-height: 100%;
    overflow: hidden;
    page-break-after: always;
  }
    }

    .invoice-box {
        max-width: 800px;
        margin: auto;
        padding: 30px;
        border: 1px solid #eee;
        box-shadow: 0 0 10px rgba(0, 0, 0, .15);
        font-size: 12px;
        line-height: 24px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: #555;
        max-height: 900px;
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
        text-align: left;
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
  padding: 2px;
}
    </style>
</head>

<body>
        <script>
        function printDiv(divName) {
             window.print();
        }
        function goBack() {
             window.history.back();
        }
        </script>
    <div class="invoice-box">
        <!-- <div class="get_more_info">
            <div class="row no-gutters">
                <div class="col-md-6">
                    <div class="form-footer block"">
                    <p style="text-align:center;"><img src="logo.jpeg" width="160" height="160" alt="Logo"></p>
                    </div>
                </div>
                <div class="col-md-6 block">
                    <div class="max-container-map-left">
                        <h3> HAY RENTAL MOBIL <br><p class="mb-4 pb-0">SURAT JALAN / INVOICE</p></h3>
                        <p class="mb-4 pb-0">
                            <b><u>                            
                            NO.HRM <?php echo "$transaksi[Transaksi_ID]";
                                echo date_format($date,"/m/Y");?></b></u>
                            <br>Jln.Komodo Airnona, Kota Kupang
                            <br>Nusa Tenggara Timur
                            <br>Nomor Telp : (0380)8442728 /082236338534
                        </p>
                    </div>
                </div>
            </div>
        </div> -->
        <table style="border-collapse: collapse;  width: 100%;">
            <tr>
                <td><p style="text-align:center;"><img src="logo.jpeg" width="160" height="160" alt="Logo"></p></td>
                <td><b style="font-size:20px;"> HAY RENTAL</h2></b><br>SURAT JALAN / INVOICE<br>
                NO.HRM <?php echo "$transaksi[Transaksi_ID]";
                                echo date_format($date,"/m/Y");?></b></u>
                            <br>Jln.Komodo Airnona, Kota Kupang
                            <br>Nusa Tenggara Timur
                            <br>Nomor Telp : (0380)8442728 /082236338534
            </td>
            </tr>
            <tr>
                <td></td>
                <td></td>
            </tr>

            <tr>
                <th>YANG BETANDA TANGAN DI BAWAH INI</th>
                <td>:</td>
            </tr>
            <tr>
                <td>NAMA LENGKAP</td>
                <td>: <?php echo "$transaksi[Transaksi_Nama]"?> </td>
            </tr>
            <tr>
                <td>NO HP/TELP</td>
                <td>: <?php echo "$transaksi[Transaksi_NomorHP]" ?> </td>
            </tr>
            <tr>
                <td>ALAMAT</td>
                <td>: <?php echo "$transaksi[Transaksi_Alamat]" ?> </td>
            </tr>
            <tr>
                <td>NO IDENTITAS YANG DI JAMINKAN</td>
                <td>: <?php echo "$transaksi[Transaksi_Jaminan_Identitas]-$transaksi[Transaksi_Nomor_Jaminan_Identitas]" ?> </td>
            </tr>
            <tr>
                <th>DENGAN INI MENYATAKAN AKAN MENYEWA KENDARAAN </th>
                <td></td>
            </tr>
            <tr>
                <td>JENIS KENDARAAN</td>
                <td>: <?php echo "$transaksi[Mobil_Merk] $transaksi[Mobil_Tipe]" ?> </td>
            </tr>
            <tr>
                <td>NOMOR POLISI</td>
                <td>: <?php echo "$transaksi[Mobil_No_Polisi]" ?> </td>
            </tr>
            <tr>
                <td>BENSIN POSISI</td>
                <td>: <?php echo "$transaksi[Transaksi_Posisi_Bensin]" ?> KOTAK</td>
            </tr>
            <tr>
                <td>TANGGAL KELUAR [JAM]</td>
                <td>: <?php 
                $dateout=date_create("$transaksi[Tangal_Waktu_Mulai]");
                $datemasuk=date_create("$transaksi[Tanggal_Waktu_Berakhir]");
                echo date_format($dateout,"d/m/Y [H:i]");                
                 ?></td>
            </tr>
            <tr>
                <td>TANGGAL MASUK [JAM]</td>
                <td>: <?php 
                echo date_format($datemasuk,"d/m/Y [H:i]");                
                // $datemasuk=date_create("$transaksi[Tangal_Waktu_Mulai]");
                // echo date_format($dateIN,"d/m/Y");                
                 ?></td>
            </tr>
            <tr>
                <td>PAYMENT/DEPOSIT</td>
                <td>: <?php  ?></td>
            </tr>

            <!-- <tr>
                <th>Masa Sewa</th>
                <td>
                    <table>
                        <tr>
                            <?php echo "<td> $transaksi[Masa_Sewa_Jam] Jam</td>" ?>
                            <?php echo "<td> $transaksi[Masa_Sewa_Hari] Hari</td>" ?>
                            <?php echo "<td> $transaksi[Masa_Sewa_Bulan] Bulan</td>" ?>
                            <?php echo "<td> $transaksi[Masa_Sewa_Tahun] Tahun</td>" ?>
                        </tr>
                    </table>
                </td>
            </tr> -->
            <tr>
                <td>Kelengkapan</td>
                <td><?php echo "$transaksi[Kelengkapan]" ?> </td>
            </tr>
            <tr>
                <td><b>An CV.Berkat Sejahtera - HAY RENTAL<br> Bank Mandiri Norek 181-00-0039035-2</b></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td>Di nyatakan di kupang, <?php 
                $date=date_create("$transaksi[Transaksi_Tanggal]");
                echo date_format($date,"d/m/Y");                
                ?></td>
            </tr>
            <tr>
                <th>Adminstrasi<br><br><br></th>
                <th>Penyewa<br><br><br></th>
            </tr>
            <tr>
                <th>(...................)</th>
                <th>(<?php echo "$transaksi[Transaksi_Nama]"?>)</th>
            </tr>
            <tr>
                <th colspan="2">
                <p style = "font-family:Apple Chancery, cursive;font-size:16px;font-style:italic;">
                    "Selamat Menikmati Perjalanan Anda"
                </p>    
                </th>            
            </tr>
        </table>    
        <!-- <center>selamat menikmati perjalanan anda</center>     -->
    </div>

    <table style="width:100%">
    <tr>
                <td>            <button onclick="printDiv('invoice')" >Print</button>
</td>
            </tr>
    <tr>
                <td>            <button onclick="goBack()" >Kembali</button>
</td>
            </tr>
<!-- 
    <tr>
        <th>
            <button onclick="printDiv('invoice')" >Print</button>
        </th>
        <th>
            <button onclick="goBack()" >Kembali</button>
        </th>
    </tr> -->
    </table>

</body>
</html>