    
<?php
    // form.php
$data = [
    "id" => 0,
    "nivel" => 2,
    "statusRegistro" => 1,
    "nome" => "",
    "login" => "",
    "senha" => "",
    "email" => ""
];

$subMenu = [
    "insert" => "Novo",
    "update" => "Alteração",
    "delete" => "Exclusão",
    "view"  => "Visualização"
];

if ($_GET['acao'] != "insert") {

    // buscar a categoria de produtos

    try {        
        $conn = new PDO(
            "mysql:host=localhost;port=3306;dbname=trabalhophp2bimestre",
            "root",             // usuário
            ""                  // senha
        );

        $data = $conn->prepare("SELECT * FROM usuario WHERE id = ?");
        $rsc = $data->execute([$_GET['id']]);
        $data = $data->fetch();

    } catch (PDOException $pe) {
        echo "ERROR: " . $pe->getMessage();
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Formulário Usuário</title>

        <link href="../../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        
    </head>
    <body>

        <div class="container">

            <h2>Usuário - <?= $subMenu[$_GET['acao']] ?></h2>

            <form method="POST" action="<?= $_GET['acao'] ?>Usuario.php">

                
            
            <div class="row mt-5">
                    <div class="mb-3 col-8">
                        <label for="nome" class="form-label">Nome</label>
                        <input type="text" class="form-control" name="nome"  id="nome" placeholder="Nome dos usuários" value="<?= $data['nome'] ?>">
                    </div>

                    <div class="mb-3 col-4">
                        <label for="statusRegistro" class="form-label">Status</label>
                        <select class="form-select" aria-label="Default select statusRegistro" name="statusRegistro" id="statusRegistro">
                            <option <?= ($data['statusRegistro'] == "" ? "selected" : "") ?>>...</option>
                            <option <?= ($data['statusRegistro'] == 1 ? "selected" : "") ?> value="1">Ativo</option>
                            <option <?= ($data['statusRegistro'] == 2 ? "selected" : "") ?> value="2">Inativo</option>
                        </select>                
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="mb-3 col-8">
                        <label for="nivel" class="form-label">Nível</label>
                        <input type="text" class="form-control" name="nivel"  id="nivel" placeholder="Nível dos usuários" value="<?= $data['nivel'] ?>">
                    </div>

                    <div class="row mt-5">
                    <div class="mb-3 col-8">
                        <label for="login" class="form-label">Login</label>
                        <input type="text" class="form-control" name="login"  id="login" placeholder="" value="<?= $data['login'] ?>">
                    </div>

                    <div class="row mt-5">
                    <div class="mb-3 col-8">
                        <label for="senha" class="form-label">Senha</label>
                        <input type="text" class="form-control" name="senha"  id="senha" placeholder="Digite sua senha" value="<?= $data['senha'] ?>">
                    </div>

                    <div class="row mt-5">
                    <div class="mb-3 col-8">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email"  id="email" placeholder="@" value="<?= $data['email'] ?>">
                    </div>


                <input type="hidden" name="id" id="id" value="<?= $data['id'] ?>">
                
                <div class="mt-3">

                    <div class="col-auto">
                        <a href="lista.php" class="btn btn-secondary btn-sm mb-3">Voltar</a>
                        
                        <?php
                        if ($_GET['acao'] != "view") {
                            ?>
                            <button type="submit" class="btn btn-primary btn-sm mb-3">Gravar</button>
                            <?php
                        }
                        ?>
                    </div>

                </div>
            
            </form>

        </div>

    </body>
</html>