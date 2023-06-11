<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "medisep";

$enter = new mysqli($servername, $username, $password, $database);
        if ($enter->connect_error) {
            die("Falha na conexão: " . $enter->connect_error);
        }

$nome=$_POST['name'];
$idade=$_POST['age'];
$numero=$_POST['number'];
$email=$_POST['email'];

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
header("Location: painel.html");
exit();
?>






<?php

// Conecte-se ao banco de dados (substitua "nome_do_banco", "nome_do_usuario" e "senha" pelos valores corretos)
$conn = mysqli_connect("localhost", "root", "", "medisep");

// Verifique se a conexão foi estabelecida corretamente
if (!$conn) {
    die("Erro na conexão com o banco de dados: " . mysqli_connect_error());
}

// Crie a consulta SQL para buscar os dados da tabela (substitua "nome_da_tabela" pelos valores corretos)
$sql = "SELECT nome,numero,idade,email FROM paciente";

// Execute a consulta SQL
$resultado = mysqli_query($conn, $sql);

// Inicialize uma variável para armazenar o HTML formatado
$html = 'paciente1';

// Verifique se existem registros retornados
if (mysqli_num_rows($resultado) > 0) {
    // Loop pelos registros e construa o HTML formatado
    while ($row = mysqli_fetch_assoc($resultado)) {
        $html .= '<p>Nome: ' . $row["nome"] . '</p>';
        $html .= '<p>idade: ' . $row["idade"] . '</p>';
        $html .= '<p>numero: ' . $row["numero"] . '</p>';
        $html .= '<p>Email: ' . $row["email"] . '</p>';
        $html .= '<hr>'; // opcional, adicione uma linha separadora entre os registros
    }
} else {
    $html = 'Nenhum registro encontrado.';
}

// Feche a conexão com o banco de dados
mysqli_close($conn);

// Retorne o HTML formatado
echo $html;
?>
