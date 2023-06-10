<?php

$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "test";

$mysqli = new mysqli($servername, $dbusername, $dbpassword, $dbname);
if($mysqli->connect_errno){

    echo "Falha ao conectar com o servidor: (". $mysqli->connect_errno . ")" 
}

?>