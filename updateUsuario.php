<?php
    // updateUsuario.php

    if (isset($_POST['id'])) {

        try {        
            $conn = new PDO(
                "mysql:host=localhost;port=3306;dbname=trabalhophp2bimestre",
                "root",             // usuário
                ""                  // senha
            );

            $dados = [
                $_POST['nivel'],            // nivel
                $_POST['statusRegistro'],   // Status
                $_POST['nome'],             // nome
                $_POST['login'],            // login
                $_POST['senha'],            // senha
                $_POST['email'],            // email
                $_POST['id']                // id
            ];        

            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $data = $conn->prepare("UPDATE usuario 
                                    SET nivel = ?, statusRegistro = ?, nome = ?, login = ?, senha = ?, email = ?
                                    WHERE id = ?");
            
            $data->execute($dados);

            if ($data->rowCount() > 0) {
                header("Location: lista.php?msgSucesso=Usuário alterado com sucesso !");
            } else {
                header("Location: lista.php?msgError=Falha na alteração do usuário");
            }

        } catch (PDOException $pe) {
            echo "ERROR: " . $pe->getMessage();
        }

    } else {
        header("Location: lista.php");
    }