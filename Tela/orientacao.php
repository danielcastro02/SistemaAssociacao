<?php
if (!isset($_SESSION['id'])) {
    session_start();
}
if (!isset($_SESSION)) {
    header("Location: ../index.php");
}
?>
<?php
//date_default_timezone_set('America/Sao_Paulo');
//$date = date('Y-m-d H:i');
//$date = date('Y-m-d');
//echo $date . "<br>";
//$data = '02/09/1998';
//list($dia, $mes, $ano) = explode('/', $data);
//$hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
//$nascimento = mktime(0, 0, 0, $mes, $dia, $ano);
//$idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25);
//print $idade;
//split = explode
if (!isset($_SESSION)) {
    session_start();
}
?>                  

<!DOCTYPE html>
<html>
    <head>
        <?php include_once '../Base/header.php'; ?>
    </head> 
    <body class="homeimg">
        <?php
        if (isset($_GET['msg'])) {
            if ($_GET['msg']=='sucessoAluno') {
                ?>
                aluno cadastrado com sucesso - Maior de idade
                <?php
            }else{
                if ($_GET['msg']=='menorDeIdade') {
                    ?>
                aluno menor de idade cadastrado com sucesso - Deseja cadastrar um responsável?
                <?php
                }
            }
        }else{
            header("Location: ../index.php");
        }
        ?>
        
    </body>
</html>