<!DOCTYPE html>
<html>
<head>
    <title>Lista de Agendamentos</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        
        th {
            background-color: #dddddd;
        }
    </style>
</head>
<body>
    <h2>Lista de Agendamentos</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>ID Médico</th>
            <th>ID Paciente</th>
            <th>Nome Paciente</th>
            <th>Data</th>
            <th>Hora</th>
            <th>Descrição</th>
        </tr>
        
        <?php
        // Conexão com o banco de dados
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "medisep";
        
        $conn = new mysqli($servername, $username, $password, $database);
        if ($conn->connect_error) {
            die("Falha na conexão: " . $conn->connect_error);
        }
        
        // Consulta SQL para obter os agendamentos e seus respectivos nomes de médico e usuário
        $sql = "SELECT agendamentos.id, agendamentos.id_medico, agendamentos.id_paciente, users.username AS nome_paciente, agendamentos.data_agendamento, agendamentos.hora_agendamento, agendamentos.descricao
                FROM agendamentos
                INNER JOIN users ON agendamentos.id_paciente = users.id"; //inner join na tabela users para ter acesso ao username do paciente 
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            // Exibe os agendamentos na tabela
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["id_medico"] . "</td>";
                echo "<td>" . $row["id_paciente"] . "</td>";
                echo "<td>" . $row["nome_paciente"] . "</td>";
                echo "<td>" . $row["data_agendamento"] . "</td>";
                echo "<td>" . $row["hora_agendamento"] . "</td>";
                echo "<td>" . $row["descricao"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='8'>Nenhum agendamento encontrado.</td></tr>";
        }
        
        // Fecha a conexão com o banco de dados
        $conn->close();
        ?>
        
    </table>
</body>
</html>
