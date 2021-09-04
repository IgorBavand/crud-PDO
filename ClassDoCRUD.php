<?php

class Crud {

    private $db;

    function __construct($DB_con) {
        $this->db = $DB_con;
    }

    public function create($nome, $email, $cidade) {
        try {
            $this->db->beginTransaction();
            $stmt = $this->db->prepare("INSERT INTO 
pessoa(nome, email, cidade) VALUES(:nome, :email, :cidade)");           
            $stmt->bindparam(":nome", $nome);
            $stmt->bindparam(":email", $email);
            $stmt->bindparam(":cidade", $cidade);
            $stmt->execute();
            $this->db->commit();
            return true;
        } catch (PDOException $e) {
            $this->db->rollback();
            echo $e->getMessage();
            return false;
        }
    }

    public function getID($id) {
        $stmt = $this->db->prepare("SELECT * FROM pessoa WHERE id=:id");
        $stmt->execute(array(":id" => $id));
        $editRow = $stmt->fetch(PDO::FETCH_ASSOC);
        return $editRow;
    }

    public function update($id, $nome, $email, $cidade) {
        try {
            $this->db->beginTransaction();
            $stmt = $this->db->prepare("UPDATE 
pessoa SET nome=:nome, email=:email, cidade=:cidade
             WHERE id=:id ");
            $stmt->bindparam(":nome", $nome);
            $stmt->bindparam(":email", $email);
            $stmt->bindparam(":cidade", $cidade);
            $stmt->bindparam(":id", $id);
            $stmt->execute();
            $this->db->commit();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            $this->db->rollback();
            return false;
        }
    }

    public function delete($id) {
        try{
        $stmt = $this->db->prepare("DELETE FROM 
pessoa WHERE id=:id");
        $stmt->bindparam(":id", $id);
        $stmt->execute();
        return true;
        }  catch (PDOException $e){
            echo $e->getMessage();
            $this->db->rollback();
        }
    }

    public function dataview($query) {
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <tr>
                    <td><?php print($row['id']); ?></td>
                    <td><?php print($row['nome']); ?></td>
                    <td><?php print($row['email']); ?></td>
                    <td><?php print($row['cidade']); ?></td>
                    <td><a href="editar.php?id=<?php print($row['id']); ?>">Atualizar</a></td>
                    <td><a href="deletar.php?id=<?php print($row['id']); ?>">Deletar</a></td></tr>
                <?php
            }
        } else {
            ?>
            <tr>
                <td>Nenhum registro encontrado...</td>
            </tr>
            <?php
        }
    }

    public function paging($query, $records_per_page) {
        $starting_position = 0;
        if (isset($_GET["page_no"])) {
            $starting_position = ($_GET["page_no"] - 1) * $records_per_page;
        }
        $query2 = $query . " limit $starting_position,$records_per_page";
        return $query2;
    }

    public function paginglink($query, $records_per_page) {

        $self = $_SERVER['PHP_SELF'];

        $stmt = $this->db->prepare($query);
        $stmt->execute();

        $total_no_of_records = $stmt->rowCount();

        if ($total_no_of_records > 0) {
            ?><ul class="pagination"><?php
                $total_no_of_pages = ceil($total_no_of_records / $records_per_page);
                $current_page = 1;
                if (isset($_GET["page_no"])) {
                    $current_page = $_GET["page_no"];
                }
                if ($current_page != 1) {
                    $previous = $current_page - 1;
                    echo "<li><a href='" . $self . "?page_no=1'>Primeira</a></li>";
                    echo "<li><a href='" . $self . "?page_no=" . $previous . "'>Anterior</a></li>";
                }
                for ($i = 1; $i <= $total_no_of_pages; $i++) {
                    if ($i == $current_page) {
                        echo "<li><a href='" . $self . "?page_no=" . $i . "' style='color:red;'>" . $i . "</a></li>";
                    } else {
                        echo "<li><a href='" . $self . "?page_no=" . $i . "'>" . $i . "</a></li>";
                    }
                }
                if ($current_page != $total_no_of_pages) {
                    $next = $current_page + 1;
                    echo "<li><a href='" . $self . "?page_no=" . $next . "'>Próxima</a></li>";
                    echo "<li><a href='" . $self . "?page_no=" . $total_no_of_pages . "'>Última</a></li>";
                }
                ?></ul><?php
        }
    }

}

