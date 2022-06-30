<?php
    // deleteUsuario.php

    if (isset($_POST['id'])) {

        try {        
            $conn = new PDO(
                "mysql:host=localhost;port=3306;dbname=trabalhophp2bimestre",
                "root",             // usuário
                ""                  // senha
            );

            $id = 4;

            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $data = $conn->prepare("DELETE FROM usuario 
                                    WHERE id = ?");
            
            $data->execute([$_POST['id']]);

            if ($data->rowCount() > 0) {
                header("Location: lista.php?msgSucesso=Usuário excluído com sucesso !");
            } else {
                header("Location: lista.php?msgError=Falha na exclusão do usuário");
            }

        } catch (PDOException $pe) {
            echo "ERROR: " . $pe->getMessage();
        }

    } else {
        header("Location: lista.php");
    }