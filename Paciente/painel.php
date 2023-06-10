<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "medisep";

$enter = new mysqli($servername, $username, $password, $database);
        if ($enter->connect_error) {
            die("Falha na conexão: " . $enter->connect_error);
        }

$nome=$_POST['nomeInput'];
$idade=$_POST['idadeInput'];
$numero=$_POST['numeroInput'];
$email=$_POST['emailInput'];

// Crie a consulta SQL para inserir os dados na tabela (substitua "nome_da_tabela" pelos valores corretos)
$sql = "INSERT INTO pacientes (nome,idade,numero, email) VALUES ('$nome','$idade','$numero', '$email')";

// Execute a consulta SQL
if (mysqli_query($enter, $sql)) {
    echo "Dados inseridos com sucesso!";
} else {
    echo "Erro ao inserir os dados: " . mysqli_error($enter);
}

// Feche a conexão com o banco de dados
mysqli_close($enter);
?>