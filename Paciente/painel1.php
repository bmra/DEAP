<!DOCTYPE html>
<html>
<head>
   <meta charset="UTF-8">
   <title>update profile</title>

   <!--  css file   -->
   <link rel="stylesheet" href="painel1.css">

</head>
<body>
   
<div class="update-profile">

   <?php
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

   

      $select = mysqli_query($conn, "SELECT * FROM `pacientes` WHERE id = '$user_id'") or die('query failed');
      if(mysqli_num_rows($select) > 0){
         $fetch = mysqli_fetch_assoc($select);
      }
   ?>

   <form action="" method="post" >
      <?php
        
         if(isset($message)){
            foreach($message as $message){
               echo '<div class="message">'.$message.'</div>';
            }
         }
      ?>
      <div class="flex">
         <div class="inputBox">
            <!-- Resolver os valeu -->
            <span>Nome :</span>
            <input type="text" name="update_name" value=" <?$fetch["nome"]?>" class="box">
            <span>Data de Nascimento :</span>
            <input type="date" name="update_date" value=" <?$fetch["data"]?>" class="box">
            <span>Número de Utente :</span>
            <input type="text" name="update_utente" value=" <?$fetch["utente"]?>" class="box">
            <span>E-mail :</span>
            <input type="email" name="update_email" value="E-mail" class="box">
         
            
         </div>
         <div class="inputBox">
            <!-- mudar os contactos -->
            <span>Contacto :</span>
            <input type="text" name="num" value = "contacto" class="box">
      </div>
      <input type="submit" value="update profile" name="update_profile" class="btn">
      <a href="medico_page.php" class="delete-btn">go back</a>
   </form>

</div>

</body>
</html>