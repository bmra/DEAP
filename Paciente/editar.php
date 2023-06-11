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
}
    // Execute a consulta SQL para buscar os dados do registro pelo ID
    $sql = "SELECT* FROM pacientes WHERE id = $id"; // substitua "nome_da_tabela" pelo nome correto da tabela
    $resultado = mysqli_query($conn, $sql);

    // Verifique se existe um registro com o ID fornecido
    if (mysqli_num_rows($resultado) > 0) {
        $row = mysqli_fetch_assoc($resultado);
    }
        // Exiba o formulário para edição dos campos desejados
        ?>
        <form action="atualizar.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            Número: <input type="text" name="numeroInput" value="<?php echo $row['numero']; ?>"><br>
            Email: <input type="text" name="emailInput" value="<?php echo $row['email']; ?>"><br>
            <input type="submit" value="Atualizar">
        </form>
        
