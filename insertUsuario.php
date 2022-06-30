<?php
    // insertUsuario.php

    if (isset($_POST['nome'])) {

        try {        
            $conn = new PDO(
                "mysql:host=localhost;port=3306;dbname=trabalhophp2bimestre",
                "root",             // usuário
                ""                  // senha
            );

            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $data = $conn->prepare("INSERT INTO usuario 
                                    (nivel, statusRegistro, nome, login, senha, email)
                                    VALUES ( ?, ?, ?, ?, ?, ? )");
            
            $data->execute([$_POST['nivel'], $_POST['statusRegistro'], $_POST['nome'], $_POST['login'], $_POST['senha'], $_POST['email']]);

            if ($conn->lastInsertId() > 0) {
                header("Location: lista.php?msgSucesso=Usuário inserido com sucesso !");
            } else {
                header("Location: lista.php?msgError=Falha na gravação do novo usuário.");
            }

        } catch (PDOException $pe) {
            echo "ERROR: " . $pe->getMessage();
        }

    } else {
        header("Location: form.php");
    }