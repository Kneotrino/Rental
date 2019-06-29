<?php
date_default_timezone_set('Asia/Jayapura');
function debug_to_console( $Tag,$data ) {
    $output = $data;
    if ( is_array( $output ) )
        $output = implode( ',', $output);

    echo "<script>console.log( '". $Tag . ": " . $output . "' );</script>";
}

function getTransaksiByID($id){
    // $sql = "SELECT * FROM `Transaksi` WHERE `Transaksi_id` = '$id'";
    $sql = "SELECT * FROM transaksi INNER JOIN mobil ON transaksi.Transaksi_Mobil=mobil.Mobil_id WHERE `Transaksi_ID` = '$id'";
    $connMini = 
      new mysqli(
        $GLOBALS['servername'],
        $GLOBALS['username'],
        $GLOBALS['password'],
        $GLOBALS['dbname']);
        $result = $connMini->query($sql);

    if(!$connMini)    {
        die("Query Failed" . mysqli_error($connection));
    }

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    }
    return $row;
}

function alertJS($message)
{
      echo "<script type='text/javascript'>alert('$message');</script>";
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rental";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
	debug_to_console( "Connection","Connected failed" );
    die("Connection failed: " . $conn->connect_error);
} 
debug_to_console( "Connection","Connected successfully" );

?>