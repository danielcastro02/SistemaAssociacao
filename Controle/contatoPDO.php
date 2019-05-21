<?php

if (realpath("./index.php")) {
    include_once "./Controle/conexao.php";
    require_once './PHPMailer-5.2.13/PHPMailerAutoload.php';
    include_once './Modelo/contato.php';
} else {
    if (realpath("../index.php")) {
        include_once "../Controle/conexao.php";
        require_once '../PHPMailer-5.2.13/PHPMailerAutoload.php';
        include_once '../Modelo/contato.php';
    } else {
        if (realpath("../../index.php")) {
            include_once "../../Controle/conexao.php";
            require_once '../../PHPMailer-5.2.13/PHPMailerAutoload.php';
            include_once '../../Modelo/contato.php';
        }
    }
}

require_once '../PHPMailer-5.2.13/PHPMailerAutoload.php';
include_once '../Modelo/contato.php';

class contatoPDO {

    public function enviaEmail(contato $contato) {
        $mail = new PHPMailer();
        //$mail->SMTPDebug = 3;
        $mail->isSMTP();
        $mail->Host = 'mail.nobadserver.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'daniel.castro@nobadserver.com';
        $mail->Password = 'Class.7ufo';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        
        $mail->From = 'daniel.castro@nobadserver.com';
        $mail->FromName = 'Sistema ônibus';
        $mail->addAddress('zanini.castro@gmail.com');
        $mail->addReplyTo($contato->getEmail(), $contato->getNome());
        $mail->isHTML(true);
        $mail->Subject = "Contato sobre ".$contato->getMotivo();
        $mail->Body = "<h3>Olá, este é um contato do seu sistema da associacao!<h3>"
                . "<h4>O usuário ". $contato->getNome().' com CPF/CNPJ:'.$contato->getCpfCnpj().', entrou em contato atravéz do sistema, sobre '. $contato->getMotivo().''
                . 'com a seguinte mensagem:<h4><br>'.$contato->getDescricao().'<br>E-mail para resposta: '.$contato->getEmail();
        $mail->AltBody = "Olá, este é um contato do seu sistema da associacao!"
                . "O usuário ". $contato->getNome().'ccom CPF/CNPJ: '.$contato->getCpfCnpj().', entrou em contato atravéz do sistema, sobre '. $contato->getMotivo().''
                . 'com a seguinte mensagem:'.$contato->getDescricao().' E-mail para resposta <br> '. $contato->getEmail();
        if($mail->send()){
            return true;
        }else{
            return false;
        }
    }

    function contato() {
        $contato = new contato($_POST);
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare("insert into contato values (default, :nome , :cpf , :email ,:motivo , :descricao);");
        $stmt->bindValue(':nome', $contato->getNome());
        $stmt->bindValue(':cpf', $contato->getCpfCnpj());
        $stmt->bindValue(':email', $contato->getEmail());
        $stmt->bindValue(':motivo', $contato->getMotivo());
        $stmt->bindValue(':descricao', $contato->getDescricao());
        if ($stmt->execute()) {
            if ($this->enviaEmail($contato)) {
                if ($contato->getMotivo() == 'bug') {
                    header('location: ../Tela/Sistema/reclamacao.php?msg=sucessoContatoBug');
                }
                if ($contato->getMotivo() == 'critica') {
                    header('location: ../Tela/Sistema/reclamacao.php?msg=sucessoContatoCritica');
                }
                if ($contato->getMotivo() == 'sugestao') {
                    header('location: ../Tela/Sistema/reclamacao.php?msg=sucessoContatoSugestao');
                }
                if ($contato->getMotivo() == 'problema') {
                    header('location: ../Tela/Sistema/reclamacao.php?msg=sucessoContatoProblema');
                }
            } else {
                //header('location: ../Tela/Sistema/reclamacao.php?msg=erroEmail');
            }
        } else {
            header('location: ../Tela/Sistema/reclamacao.php?msg=erroContato');
        }
    }

}
