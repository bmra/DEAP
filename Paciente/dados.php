<?php
// Conecte-se ao banco de dados (substitua os valores pelos corretos)
$conn = mysqli_connect("localhost", "root", "", "medisep");

// Verifique se a conexão foi estabelecida corretamente
if (!$conn) {
    die("Falha na conexão com o banco de dados: " . mysqli_connect_error());
}

// Execute a consulta SQL para buscar os dados do banco de dados
$sql = "SELECT * FROM 'pacientes'"; // substitua "nome_da_tabela" pelo nome correto da tabela
$resultado = mysqli_query($conn, $sql);

// Verifique se existem registros retornados
if (mysqli_num_rows($resultado) > 0) {
    // Loop pelos registros e exiba os dados
    while ($row = mysqli_fetch_assoc($resultado)) {
        echo "Nome: " . $row['nome'] . "<br>";
        echo "Idade: " . $row['idade'] . "<br>";
        echo "Número: " . $row['numero'] . "<br>";
        echo "Email: " . $row['email'] . "<br>";
        echo "<br>";
    }
} else {
    echo "Nenhum dado encontrado.";
}

while ($row = mysqli_fetch_assoc($resultado)) {
    echo "Nome: " . $row['nome'] . "<br>";
    echo "Idade: " . $row['idade'] . "<br>";
    echo "Número: " . $row['numero'] . "<br>";
    echo "Email: " . $row['email'] . "<br>";
    echo "<a href='editar.php?id=" . $row['id'] . "'>Editar</a>"; // Adicione o botão "Editar"
    echo "<br><br>";
}


// Feche a conexão com o banco de dados
mysqli_close($conn);
?>