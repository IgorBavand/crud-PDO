
<html>
    <head>
        <meta charset="utf-8">
    </head>
</html>
<?php
include_once 'dbConfig.php';
?>

   
    </style>
    <table>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Cidade</th>
            <th colspan="2">Atualizar/Deletar</th>
            
        </tr>
        <?php
         $query = "SELECT * FROM pessoa";
        
        $records_per_page = 10;
        $newquery = $crud->paging($query, $records_per_page);
        $crud->dataview($newquery);
       
        ?>
        
                     
        <tr>
            <td colspan="7">
                    <?php $crud->paginglink($query, $records_per_page); ?>
               <a href="adicionar.php">Adicionar registro</a>
            </td>
        </tr>

    </table>



