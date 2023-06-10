<!DOCTYPE html>
<html>
<head>
    <title>Médicos</title>
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
    <h1>Médicos</h1>

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
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_user'])) { // apenas se for um POST e o form for para adicionar o utilizador
        $username = isset($_POST['username']) ? $_POST['username'] : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';
        $morada = isset($_POST['morada']) ? $_POST['morada'] : '';
        $data_nascimento = isset($_POST['data_nascimento']) ? $_POST['data_nascimento'] : '';

        // inserir o médico na base de dados
        $query = "INSERT INTO users (username, password, type, morada, data_nascimento) VALUES ('$username', '$password', 2, '$morada', '$data_nascimento')";
        $result = mysqli_query($connection, $query);

        // se a query foi um sucesso ou seja se o resultado existe ou tem alguma coisa, mostrar uma mensagem de sucesso, senão mostrar mensagem de erro
        if ($result) {
            echo '<p>Novo médico adicionado com sucesso.</p>';
        } else {
            echo '<p>!!! Erro !!!: ' . mysqli_error($connection) . '</p>';
        }
    }

    // tratar da submissão do formulário para remover utilizador
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['remove_user'])) { // apenas se for um POST e o botão "Remover" for clicado ou seja o form é o remove_user
        $user_id = $_POST['user_id'];

        // query para remover o utilizador
        $query = "DELETE FROM users WHERE id = $user_id";
        $result = mysqli_query($connection, $query);

        // se a query foi um sucesso, mostrar uma mensagem de sucesso, senão mostrar mensagem de erro
        if ($result) {
            echo '<p>Médico removido com sucesso.</p>';
        } else {
            echo '<p>!!! Erro !!!: ' . mysqli_error($connection) . '</p>';
        }
    }
    ?>

    <!-- Formulário para adicionar novo utilizador -->
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>

        <label for="morada">Morada:</label>
        <input type="text" id="morada" name="morada" required><br>

        <label for="data_nascimento">Data de Nascimento:</label>
        <input type="date" id="data_nascimento" name="data_nascimento" required><br>

        <input type="submit" name="add_user" value="Submit">
    </form>

    <?php
    // query para obter os utilizadores do tipo 2 (médicos)
    $query = "SELECT id, username, morada, data_nascimento FROM users WHERE type = 2";
    //executa a query
    $result = mysqli_query($connection, $query);

    // se a query foi um sucesso, mostrar os utilizadores encontrados na base de dados
    if ($result && mysqli_num_rows($result) > 0) {
        echo '<table>';
        echo '<thead>';
        echo '<tr>';
        echo '<th>ID</th>';
        echo '<th>Username</th>';
        echo '<th>Morada</th>';
        echo '<th>Data de Nascimento</th>';
        echo '<th>Remover</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';

        // iterar pelos utilizadores encontrados e inserir na tabela as linhas (tr) com as colunas (th)
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td>' . $row['id'] . '</td>';
            echo '<td>' . $row['username'] . '</td>';
            echo '<td>' . $row['morada'] . '</td>';
            echo '<td>' . $row['data_nascimento'] . '</td>';
            echo '<td>';
            echo '<form method="POST" action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '">'; //php_self para chamar de novo a pagina php para atualizar o conteudo da lista
            echo '<input type="hidden" name="user_id" value="' . $row['id'] . '">'; //input escondido para guardar o id do utilziador que se quer remover
            echo '<input type="submit" name="remove_user" value="Remover">'; //butao para enviar o formulario de rmeover utilizador
            echo '</form>';
            echo '</td>';
            echo '</tr>';
        }

        echo '</tbody>';
        echo '</table>';
    } else {
        echo '<p>Não existem médicos para apresentar.</p>';
    }

    // fechar a conexão com a base de dados
    mysqli_close($connection);
    ?>
</body>
</html>
