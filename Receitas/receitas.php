<!DOCTYPE html>
<html>
<head>
    <title>Pagina das Receitas</title>
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
    <h1>Rceitas</h1>

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

    //Tratar da submissão do formulário para adicionar novo Agendamento
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_receitas'])) { // apenas se for um POST e o form for para adicionar as receitas
        $id = isset($_POST['id']) ? $_POST['id'] : '';
        $id_medico = isset($_POST['id_medico']) ? $_POST['id_medico'] : '';
        $id_paciente = isset($_POST['id_paciente']) ? $_POST['id_paciente'] : '';
        $medicamento = isset($_POST['medicamento']) ? $_POST['medicamento'] : '';
        $ref_receita = isset($_POST['ref_receita']) ? $_POST['ref_receita'] : '';
        $descricao = isset($_POST['descricao']) ? $_POST['descricao'] : '';
        $data_emissao = isset($_POST['data_emissao']) ? $_POST['data_emissao'] : '';
        $data_validade = isset($_POST['data_validade']) ? $_POST['data_validade'] : '';
        $quantidade = isset($_POST['quantidade']) ? $_POST['quantidade'] : '';

        // inserir as receitas na base de dados
        $query = "INSERT INTO receitas (id, id_medico, id_paciente,medicamento,ref_receita,descricao,data_emissao,data_validade, quantidade) VALUES ('$id','$id_medico', '$id_paciente','$medicamento','$ref_receita','$descricao',' $data_emissao', '$data_validade', '$quantidade')";
        $result = mysqli_query($connection, $query);

        // se a query foi um sucesso, ou seja, se o resultado existe, mostrar uma mensagem de sucesso, senão mostrar mensagem de erro
        if ($result) {
            echo '<p>Nova receita adicionado com sucesso.</p>';
        } else {
            echo '<p>!!! Erro !!!: ' . mysqli_error($connection) . '</p>';
        }
    }

    // tratar da submissão do formulário para remover receita
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['remove_receitas'])) { // apenas se for um POST e o botão "Remover" for clicado, ou seja, o form é o remove_receita
        $receita_id = $_POST['receitas_id'];

        // query para remover o agendamento
        $query = "DELETE FROM receitas WHERE id = $receitas_id";
        $result = mysqli_query($connection, $query);

        // se a query foi um sucesso, mostrar uma mensagem de sucesso, senão mostrar mensagem de erro
        if ($result) {
            echo '<p>Receita removida com sucesso.</p>';
        } else {
            echo '<p>!!! Erro !!!: ' . mysqli_error($connection) . '</p>';
        }
    }
    ?>

    <!-- Formulário para adicionar novo agendamento -->
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

        <label for="id_medico">ID do Medico:</label>
        <input type="text" id="id_medico" name="id_medico" required><br>

        <label for="id_paciente">ID do Paciente:</label>
        <input type="text" id="id_paciente" name="id_paciente" required><br>

        <label for="medicamento">Medicamento:</label>
        <input type="text" id="medicamento" name="medicamento" required><br>

        <label for="ref_receita">ID do Paciente:</label>
        <input type="text" id="ref_receita" name="ref_receita" required><br>~

        <label for="descricao">Descrição:</label>
        <input type="text" id="descricao" name="descricao" required><br>

        <label for="data_emissao">Data de Emissão:</label>
        <input type="date" id="data_emissao" name="data_emissao" required><br>

        <label for="data_validade">Data de validade:</label>
        <input type="date" id="data_validade" name="data_validade" required><br>

        <label for="quantidade"> Quantidade:</label>
        <input type="text" id="quantidade" name="quantidade" required><br>

        <input type="submit" name="add_receita" value="Submit">

    </form>

    <?php
    // query para obter toda a informação das receitas da tabela receitas
    $query = "SELECT id, id_medico, id_paciente,medicamento,ref_receita,descricao,data_emissao,data_validade, quantidade FROM receitas ";
    //executa a query
    $result = mysqli_query($connection, $query);

    // se a query foi um sucesso, mostrar as receitas encontradas na base de dados
    if ($result && mysqli_num_rows($result) > 0) {
        echo '<table>';
        echo '<thead>';
        echo '<tr>';
        echo '<th>ID</th>';
        echo '<th>ID Medico</th>';
        echo '<th>ID Paciente</th>';
        echo '<th>Medicamento</th>';
        echo '<th>Ref_Receita</th>';
        echo '<th>Descrição</th>';
        echo '<th>Data de Emissão</th>';
        echo '<th>Data de Validade</th>';
        echo '<th>Quantidade</th>';
        echo '<th>Remover</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';

        // iterar pelas receitas encontradas e inserir na tabela as linhas (tr) com as colunas (th)
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td>' . $row['id'] . '</td>';
            echo '<td>' . $row['id_medico'] . '</td>';
            echo '<td>' . $row['id_paciente'] . '</td>';
            echo '<td>' . $row['medicamento'] . '</td>';
            echo '<td>' . $row['ref_receita'] . '</td>';
            echo '<td>' . $row['descricao'] . '</td>';
            echo '<td>' . $row['data_emissao'] . '</td>';
            echo '<td>' . $row['data_validade'] . '</td>';
            echo '<td>' . $row['quantidade'] . '</td>';
            echo '<td>';
            echo '<form method="POST" action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '">'; //php_self para chamar de novo a pagina php para atualizar o conteudo da lista
            echo '<input type="hidden" name="receitas_id" value="' . $row['id'] . '">'; //input escondido para guardar o id do utilizador que se quer remover
            echo '<input type="submit" name="remove_receitas" value="Remover">'; //botao para enviar o formulario de remover utilizador
            echo '</form>';
            echo '</td>';
            echo '</tr>';
        }

        echo '</tbody>';
        echo '</table>';
    } else {
        echo '<p>Não existem receitas para apresentar.</p>';
    }

    // fechar a conexão com a base de dados
    mysqli_close($connection);
    ?>
</body>
</html>