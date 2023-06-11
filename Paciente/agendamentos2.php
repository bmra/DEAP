<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "medisep";


// Cria uma conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

$sql = "SELECT agendamentos.id_paciente, users.username AS nome_paciente, agendamentos.data_agendamento, agendamentos.hora_agendamento, agendamentos.descricao FROM agendamentos INNER JOIN users ON agendamentos.id_paciente = users.id";

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Lista de Consultas</title>
</head>
<body>
    <h2>Lista de consultas</h2>

    <table>
        <tr>
            <th>ID Paciente</th>
            <th>Nome Paciente</th>
            <th>Data</th>
            <th>Hora</th>
            <th>Descrição</th>
        </tr>

        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id_paciente'] . "</td>";
                echo "<td>" . $row['nome_paciente'] . "</td>";
                echo "<td>" . $row['data_agendamento'] . "</td>";
                echo "<td>" . $row['hora_agendamento'] . "</td>";
                echo "<td>" . $row['descricao'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>Nenhum agendamento encontrado</td></tr>";
        }
        ?>
    </table>

    <?php
    $conn->close();
    ?>
</body>
</html>

