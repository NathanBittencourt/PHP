<!DOCTYPE html>
<!-- lista.php -->
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Lista Usuário</title>

        <link href="../../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">

    </head>
    <body>

        <h2>Lista de Usuários</h2>

        <p>
            <a href="form.php?acao=insert" class="btn btn-primary" title="Novo Registro">Novo</a>
        </p>

        <?php

        if (isset($_GET['msgSucesso'])) {
            ?>
            <div class="alert alert-success" role="alert">
                <?= $_GET['msgSucesso'] ?>
            </div>
            <?php
        }

        if (isset($_GET['msgError'])) {
            ?>
            <div class="alert alert-danger" role="alert">
                <?= $_GET['msgError'] ?>
            </div>
            <?php
        }

        ?>

        <table class="table table-responsive table-bordered table-striped table-sm">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nome</th>
                    <th>Status</th>
                    <th>Opções<th>
                </tr>
            </thead>
            <tbody>

                <?php
                try {        
                    $conn = new PDO(
                        "mysql:host=localhost;port=3306;dbname=trabalhophp2bimestre",
                        "root",             // usuário
                        ""                  // senha
                    );

                    $data = $conn->query("SELECT * FROM usuario ORDER BY nome");

                    foreach ($data as $value) {
                        ?>
                        <tr>
                        <td><?= $value['id'] ?></td>
                            <td><?= $value['nome'] ?></td>
                            <td><?= ($value['statusRegistro'] == 1 ? "Ativo" : "Inativo") ?></td>
                            <td>
                                <a href="form.php?acao=view&id=<?= $value['id'] ?>" class="btn btn-success btn-sm" title="Visualização Registro">Visualizar</a>
                                <a href="form.php?acao=update&id=<?= $value['id'] ?>" class="btn btn-info btn-sm" title="Alteração Registro">Alterar</a>
                                <a href="form.php?acao=delete&id=<?= $value['id'] ?>" class="btn btn-danger btn-sm" title="Exclusão Registro">Excluir</a>
                            </td>
                        </tr>
                        <?php
                    }

                } catch (PDOException $pe) {
                    echo "ERROR: " . $pe->getMessage();
                }
                ?>
            </tbody>
        </table>
        
    </body>
</html>