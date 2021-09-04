<html>
    <head>
        <meta charset="utf-8">
    </head>
</html>
<?php
include_once 'dbConfig.php';
if(isset($_POST['btn-save'])){
 $nome = $_POST['nome'];
 $email = $_POST['email'];
 $cidade = $_POST['cidade'];
 
 if($crud->create($nome,$email, $cidade))
 {
  header("Location: adicionar.php?inserted");
 }
 else
 {
  header("Location: adicionar.php?failure");
 }
}
?>

<?php
if(isset($_GET['inserted'])){
 ?>
   
     O registro foi insirido <a href="index.php">Ir para a página principal</a>
 
    <?php
}
else if(isset($_GET['failure'])){
 ?>
   Erro
    <?php
}
?>
<table border>
  <form method='post'>
        <tr>
            <td>Nome</td>
            <td><input type='text' name='nome'  required></td>
        </tr>

<tr>
   <td>Email</td>
   <td><input type='text' name='email' required></td>
</tr> 
    <tr>
   <td>Cidade</td>
   <td><input type='text' name='cidade' required></td>
    </tr>
   <td colspan="2">
      <button type="submit" name="btn-save">Inserir novo registro</button>  
      <a href="index.php"></i> Voltar</a>
   </td>

</table>
</form>       


