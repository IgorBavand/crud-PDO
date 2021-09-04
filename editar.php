<html>
    <head>
        <meta charset="utf-8">
    </head>
</html>
<?php
include_once 'dbConfig.php';
if(isset($_POST['btn-update'])){
 $id = $_GET['id'];
 $nome = $_POST['nome'];
 $email = $_POST['email'];
 $cidade = $_POST['cidade'];
 
   if($crud->update($id,$nome,$email,$cidade)) {
    $msg = "<div class='alert alert-info'>
     Registro atualizado! <a href='index.php'>Voltar a pagina principal</a>!
    </div>";
   } else {
     $msg = "<div class='alert alert-warning'>
      Ocorreu um erro!
     </div>";
   }
}
if(isset($_GET['id'])){
 $id = $_GET['id'];
 extract($crud->getID($id)); 
}if(isset($msg)){
 echo $msg;
}

?>


     <form method='post'><table border>
        <tr><td>Nome</td>
            <td><input type='text' name='nome' value="<?php echo $nome; ?>" required></td></tr> 
        <tr><td>Email</td>
            <td><input type='text' name='email' value="<?php echo $email; ?>" required></td></tr>
        <tr><td>Cidade</td>
            <td><input type='text' name='cidade' value="<?php echo $cidade; ?>" required></td></tr>
        <tr><td colspan="2">
                <button type="submit" name="btn-update">Atualizar este registro</button>
                <a href="index.php">Cancelar</a>
            </td></tr></table></form>
    


