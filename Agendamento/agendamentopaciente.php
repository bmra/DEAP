<!DOCTYPE html>
<html>
<head>
    <title>Pagina de Agendamentos</title>
    <style>
body {
            background-color: #f2f2f2;
            font-family: Arial, sans-serif;
        }

        h1 {
            text-align: center;
            margin-top: 30px;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        p {
            text-align: center;
            color: #555;
        }
    </style>
</head>
<body>
    <h1>Os Seus Agendamentos</h1>

<?php
session_start(); // Inicie a sessão (se ainda não estiver iniciada)

// Detalhes para a conexão à base de dados
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "medisep";

// Verificar se o usuário está logado
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    $user_id = $_SESSION['user_id'];

// Criar a conexão
$connection = new mysqli($servername, $dbusername, $dbpassword, $dbname);

// Verificar se foi possível estabelecer uma conexão, senão enviar um erro 
if ($connection->connect_error) {
    die("Falha ao estabelecer conexão: " . $connection->connect_error);
}

    // Query para obter os agendamentos do usuário logado
    $query = "SELECT id, id_medico, id_paciente, data_agendamento, hora_agendamento, descricao FROM agendamentos WHERE id_paciente = $user_id";
    // Executa a query
    $result = mysqli_query($connection, $query);

    // Se a query foi um sucesso, mostrar os agendamentos encontrados na base de dados
    if ($result && mysqli_num_rows($result) > 0) {
        echo '<table>';
        echo '<thead>';
        echo '<tr>';
        echo '<th>ID</th>';
        echo '<th>ID Medico</th>';
        echo '<th>ID Paciente</th>';
        echo '<th>Data de Agendamento</th>';
        echo '<th>Hora de Agendamento</th>';
        echo '<th>Descrição</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';

        // Iterar pelos agendamentos encontrados e inserir na tabela as linhas (tr) com as colunas (th)
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td>' . $row['id'] . '</td>';
            echo '<td>' . $row['id_medico'] . '</td>';
            echo '<td>' . $row['id_paciente'] . '</td>';
            echo '<td>' . $row['data_agendamento'] . '</td>';
            echo '<td>' . $row['hora_agendamento'] . '</td>';
            echo '<td>' . $row['descricao'] . '</td>';
            echo '</tr>';
        }

        echo '</tbody>';
        echo '</table>';
    } else {
        echo '<p>Não existem agendamentos para apresentar.</p>';
    }
} else {
    echo '<p>Nenhum usuário está logado.</p>';
}

// Fechar a conexão com a base de dados
mysqli_close($connection);
?>
</body>
</html>