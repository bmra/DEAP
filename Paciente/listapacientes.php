<!DOCTYPE html>
<html>
<head>
    <title>Lista Pacientes</title>
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
    <h1>Lista Pacientes</h1>

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
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_user'])) { // apenas se for um POST e o botão "Submit" for clicado
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';
        $nome = isset($_POST['nome']) ? $_POST['nome'] : '';
        $morada = isset($_POST['morada']) ? $_POST['morada'] : '';
        $data_nascimento = isset($_POST['data_nascimento']) ? $_POST['data_nascimento'] : '';
        $nr_telemovel = isset($_POST['nr_telemovel']) ? $_POST['nr_telemovel'] : '';

    // Função para gerar uma senha de 9 dígitos
    function gerarSenha() {
        return rand(100000000, 999999999);
    }

    // Gerar uma senha inicial
    $password = gerarSenha();

    // Verificar se a senha já existe na base de dados
    $sql = "SELECT password FROM users WHERE password = '$password'";
    $result = $connection->query($sql);

    // Se a senha já existir, gerar uma nova até obter uma senha única
    while ($result->num_rows > 0) {
        $password = gerarSenha();
        $result = $connection->query("SELECT password FROM users WHERE password = '$password'");
    }

        // inserir o paciente na base de dados
        $query = "INSERT INTO users (email, password, nome, type, morada, data_nascimento, nr_telemovel) VALUES ('$email', '$password', '$nome', 'paciente', '$morada', '$data_nascimento', '$nr_telemovel')";
        $result = mysqli_query($connection, $query);

        // se a query foi um sucesso, mostrar uma mensagem de sucesso, senão mostrar mensagem de erro
        if ($result) {
            echo '<p>Novo paciente adicionado com sucesso.</p>';
        } else {
            echo '<p>!!! Erro !!!: ' . mysqli_error($connection) . '</p>';
        }
    }

    // tratar da submissão do formulário para remover utilizador
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['remove_user'])) { // apenas se for um POST e o botão "Remover" for clicado
        $user_id = $_POST['user_id'];

        // query para remover o utilizador
        $query = "DELETE FROM users WHERE id = $user_id";
        $result = mysqli_query($connection, $query);

        // se a query foi um sucesso, mostrar uma mensagem de sucesso, senão mostrar mensagem de erro
        if ($result) {
            echo '<p>Paciente removido com sucesso.</p>';
        } else {
            echo '<p>!!! Erro !!!: ' . mysqli_error($connection) . '</p>';
        }
    }

    ?>

    <!-- Formulário para adicionar novo utilizador -->
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>

        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome"><br>

        <label for="morada">Morada:</label>
        <input type="text" id="morada" name="morada"><br>

        <label for="data_nascimento">Data de Nascimento:</label>
        <input type="date" id="data_nascimento" name="data_nascimento"><br>

        <label for="nr_telemovel">Numero de Telemovel:</label>
        <input type="tel" id="nr_telemovel" name="nr_telemovel"><br>

        <input type="submit" name="add_user" value="Submit">
    </form>

    <?php
    // query para obter os utilizadores do tipo paciente
    $query = "SELECT id, email, nome, morada, data_nascimento, nr_telemovel FROM users WHERE type = 'paciente'";
    $result = mysqli_query($connection, $query);

    // se a query foi um sucesso, mostrar os utilizadores encontrados na base de dados
    if ($result && mysqli_num_rows($result) > 0) {
        echo '<table>';
        echo '<thead>';
        echo '<tr>';
        echo '<th>ID</th>';
        echo '<th>Email</th>';
        echo '<th>Nome</th>';
        echo '<th>Morada</t;h>';
        echo '<th>Data de Nascimento</th>';
        echo '<th>Numero de Telemovel</th>';
        echo '<th>Remover</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';

        // iterar pelos utilizadores encontrados e inserir na tabela as linhas (tr) com as colunas (td)
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td>' . $row['id'] . '</td>';
            echo '<td>' . $row['email'] . '</td>';
            echo '<td>' . $row['nome'] . '</td>';
            echo '<td>' . $row['morada'] . '</td>';
            echo '<td>' . $row['data_nascimento'] . '</td>';
            echo '<td>' . $row['nr_telemovel'] . '</td>';
            echo '<td>';
            echo '<form method="POST" action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '">';
            echo '<input type="hidden" name="user_id" value="' . $row['id'] . '">';
            echo '<input type="submit" name="remove_user" value="Remover">';
            echo '</form>';
            echo '</td>';
            echo '</tr>';
        }

        echo '</tbody>';
        echo '</table>';
    } else {
        echo '<p>Não existem pacientes para apresentar.</p>';
    }

    // fechar a conexão com a base de dados
    mysqli_close($connection);
    ?>
</body>
</html>
