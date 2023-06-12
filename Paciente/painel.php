<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "medisep";

$enter = new mysqli($servername, $username, $password, $database);
        if ($enter->connect_error) {
            die("Falha na conexão: " . $enter->connect_error);
        }


        $nome = isset($_POST['nome']) ? $_POST['nome'] : "";
        $data = isset($_POST['data_nascimento']) ? $_POST['data_nascimento'] : "";
        $numero = isset($_POST['telemovel']) ? $_POST['telemovel'] : "";
        $utente = isset($_POST['numero_utente'])? $_POST['numero_utente'] : "";
        $email = isset($_POST['email']) ? $_POST['email'] : "";
        

// Crie a consulta SQL para inserir os dados na tabela (substitua "nome_da_tabela" pelos valores corretos)
$sql = "insert into pacientes (nome,data_nascimento,telemovel,numero_utente, email) VALUES ('$nome','$data','$telemovel','$utente, '$email')";

// Execute a consulta SQL
if (mysqli_query($enter, $sql)) {
    echo "Dados inseridos com sucesso!";
} else {
    echo "Erro ao inserir os dados: " . mysqli_error($enter);
}

// Feche a conexão com o banco de dados
mysqli_close($enter);
// Após inserir os dados no banco de dados, redirecione o usuário de volta à página

?>











