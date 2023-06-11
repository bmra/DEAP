<?php
$conn = mysqli_connect("localhost", "root", "", "medisep");

if (!$conn) {
    die("Falha na conexão com o banco de dados: " . mysqli_connect_error());
}

$sql = "SELECT * FROM pacientes"; // remova as aspas simples em torno de pacientes

$resultado = mysqli_query($conn, $sql);

if (mysqli_num_rows($resultado) > 0) {
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

mysqli_close($conn);
?>
