<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "medisep";

$enter = new mysqli($servername, $username, $password, $database);
        if ($enter->connect_error) {
            die("Falha na conexão: " . $enter->connect_error);
        }

$nome= isset($_POST['nomeInput']) ? $_POST['nomeInput'];
$idade=isset($_POST['idadeInput']) ? $_POST['idadeInput'];
$numero= isset($_POST['numeroInput']) ? $_POST['numeroInput'];
$email=isset ($_POST['emailInput'])? $_POST['emailInput'];

// Crie a consulta SQL para inserir os dados na tabela (substitua "nome_da_tabela" pelos valores corretos)
$sql = "insert into pacientes (nome,idade,numero, email) VALUES ('$nome','$idade','$numero', '$email')";

// Execute a consulta SQL
if (mysqli_query($enter, $sql)) {
    echo "Dados inseridos com sucesso!";
} else {
    echo "Erro ao inserir os dados: " . mysqli_error($enter);
}

// Feche a conexão com o banco de dados
mysqli_close($enter);

?>






