<!DOCTYPE html>
<html>
<head>
    <title>Pagina de Agendamentos</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
            padding: 8px;
        }
    </style>
</head>
<body>
    <h1>Agendamentos</h1>

    <?php
    //detalhes para a conexão á base de dados
    $servername = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "medisep";

    // criar a conexão
    $connection = new mysqli($servername, $dbusername, $dbpassword, $dbname);

    // verificar se foi possível estabelecer uma conexão, senão enviar um erro 
    if ($connection->connect_error) {
        die("Falha ao estabelecer conexão: " . $connection->connect_error);
    }

    // tratar da submissão do formulário para adicionar novo utilizador
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_agendamento'])) { // apenas se for um POST e o form for para adicionar o utilizador
        $id_medico = isset($_POST['id_medico']) ? $_POST['id_medico'] : '';
        $id_paciente = isset($_POST['id_paciente']) ? $_POST['id_paciente'] : '';
        $data_agendamento = isset($_POST['data_agendamento']) ? $_POST['data_agendamento'] : '';
        $hora_agendamento = isset($_POST['hora_agendamento']) ? $_POST['hora_agendamento'] : '';
        $descricao = isset($_POST['descricao']) ? $_POST['descricao'] : '';

        // inserir o médico na base de dados
        $query = "INSERT INTO agendamentos (id_medico, id_paciente, data_agendamento, hora_agendamento, descricao) VALUES ('$id_medico', '$id_paciente', $data_agendamento, '$hora_agendamento', '$descricao')";
        $result = mysqli_query($connection, $query);

        // se a query foi um sucesso ou seja se o resultado existe ou tem alguma coisa, mostrar uma mensagem de sucesso, senão mostrar mensagem de erro
        if ($result) {
            echo '<p>Novo Agendamento adicionado com sucesso.</p>';
        } else {
            echo '<p>!!! Erro !!!: ' . mysqli_error($connection) . '</p>';
        }
    }

    // tratar da submissão do formulário para remover utilizador
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['remove_agendamento'])) { // apenas se for um POST e o botão "Remover" for clicado ou seja o form é o remove_agendamento
        $agendamento_id = $_POST['agendamento_id'];

        // query para remover o utilizador
        $query = "DELETE FROM agendamentos WHERE id = $agendamento_id";
        $result = mysqli_query($connection, $query);

        // se a query foi um sucesso, mostrar uma mensagem de sucesso, senão mostrar mensagem de erro
        if ($result) {
            echo '<p>Agendamento removido com sucesso.</p>';
        } else {
            echo '<p>!!! Erro !!!: ' . mysqli_error($connection) . '</p>';
        }
    }
    ?>

    <!-- Formulário para adicionar novo utilizador -->
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

        <label for="id_medico">ID do Medico:</label>
        <input type="text" id="id_medico" name="id_medico" required><br>

        <label for="id_paciente">ID do Paciente:</label>
        <input type="text" id="id_paciente" name="id_paciente" required><br>

        <label for="data_agendamento">Data do Agendamento:</label>
        <input type="date" id="data_agendamento" name="data_agendamento" required><br>

        <label for="hora_agendamento">Hora de Agendamento:</label>
        <input type="time" id="hora_agendamento" name="hora_agendamento" required><br>

        <label for="descricao">Descrição:</label>
        <input type="text" id="descricao" name="descricao" required><br>

        <input type="submit" name="add_agendamento" value="Submit">

    </form>

    <?php
    // query para obter os utilizadores do tipo 2 (médicos)
    $query = "SELECT id, id_medico, id_paciente, data_agendamento, hora_agendamento, descricao FROM agendamentos";
    //executa a query
    $result = mysqli_query($connection, $query);

    // se a query foi um sucesso, mostrar os utilizadores encontrados na base de dados
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
        echo '<th>Remover</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';

        // iterar pelos utilizadores encontrados e inserir na tabela as linhas (tr) com as colunas (th)
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td>' . $row['id'] . '</td>';
            echo '<td>' . $row['id_medico'] . '</td>';
            echo '<td>' . $row['id_paciente'] . '</td>';
            echo '<td>' . $row['data_agendamento'] . '</td>';
            echo '<td>' . $row['hora_agendamento'] . '</td>';
            echo '<td>' . $row['descricao'] . '</td>';
            echo '<td>';
            echo '<form method="POST" action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '">'; //php_self para chamar de novo a pagina php para atualizar o conteudo da lista
            echo '<input type="hidden" name="agendamento_id" value="' . $row['id'] . '">'; //input escondido para guardar o id do utilziador que se quer remover
            echo '<input type="submit" name="remove_agendamento" value="Remover">'; //butao para enviar o formulario de rmeover utilizador
            echo '</form>';
            echo '</td>';
            echo '</tr>';
        }

        echo '</tbody>';
        echo '</table>';
    } else {
        echo '<p>Não existem agendamentos para apresentar.</p>';
    }

    // fechar a conexão com a base de dados
    mysqli_close($connection);
    ?>
</body>
</html>