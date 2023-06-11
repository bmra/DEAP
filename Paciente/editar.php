<?php
// Conecte-se ao banco de dados (substitua os valores pelos corretos)
$conn = mysqli_connect("localhost", "root", "", "medisep");

// Verifique se a conexão foi estabelecida corretamente
if (!$conn) {
    die("Falha na conexão com o banco de dados: " . mysqli_connect_error());
}

// Verifique se o ID do registro foi passado como parâmetro
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Execute a consulta SQL para buscar os dados do registro pelo ID
    $sql = "SELECT * FROM pacientes WHERE id = $id"; 
    $resultado = mysqli_query($conn, $sql);

    // Verifique se existe um registro com o ID fornecido
    if (mysqli_num_rows($resultado) > 0) {
        $row = mysqli_fetch_assoc($resultado);

        // Exiba o formulário para edição dos campos desejados
        ?>
        <form action="" method="POST">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            Número: <input type="text" name="numeroInput" value="<?php echo $row['numero']; ?>"><br>
            Email: <input type="text" name="emailInput" value="<?php echo $row['email']; ?>"><br>
            <input type="submit" value="Atualizar">
        </form>

        <?php
    } else {
        echo "Registro não encontrado.";
    }
}

// Verifique se o formulário foi submetido
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifique se os campos necessários foram preenchidos
    if (isset($_POST['id']) && isset($_POST['numeroInput']) && isset($_POST['emailInput'])) {
        $id = $_POST['id'];
        $numero = $_POST['numeroInput'];
        $email = $_POST['emailInput'];

        // Execute a consulta SQL para atualizar os dados do registro
        $sql = "UPDATE pacientes SET numero = '$numero', email = '$email' WHERE id = $id";
        if (mysqli_query($conn, $sql)) {
            echo "Dados atualizados com sucesso!";
        } else {
            echo "Erro ao atualizar os dados: " . mysqli_error($conn);
        }
    } else {
        echo "Por favor, preencha todos os campos.";
    }
}

// Feche a conexão com o banco de dados
mysqli_close($conn);
?>

        
