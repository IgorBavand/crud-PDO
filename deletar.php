<?php
include_once 'dbConfig.php';

if(isset($_POST['btn-del'])){
 $id = $_GET['id'];
 $crud->delete($id);
 header("Location: deletar.php?deleted"); 
}
?>


<?php
 if(isset($_GET['deleted'])) {  ?>
     <strong>registro deletado...</strong>  
<?php 
 }else{
  ?>
    <strong>Quer mesmo deletar?</strong> 
        <?php
 } ?> 
    <?php
  if(isset($_GET['id'])) { ?>
         <table border>
         <tr><th>ID</th><th>Nome</th><th>Email</th><th>Cidade</th>
         </tr>
         <?php
         $stmt = $DB_con->prepare("SELECT * FROM pessoa WHERE id=:id");
         $stmt->execute(array(":id"=>$_GET['id']));
         while($row=$stmt->fetch(PDO::FETCH_BOTH))
         {?> <tr><td><?php print($row['id']); ?></td>
             <td><?php print($row['nome']); ?></td>
             <td><?php print($row['email']); ?></td>
             <td><?php print($row['cidade']); ?></td>
         </tr>
             <?php } ?>
         </table>
         <?php  }
  ?>
<div><p><?php
if(isset($_GET['id'])){ ?>
   <form method="post">
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>" />
    <button type="submit" name="btn-del">Sim</button>
    <a href="index.php">Não</a>
    </form>  <?php }else{ ?>
    <a href="index.php">Voltar</a> <?php } ?>
</p></div> 


