$(document).ready(function () {
    $("#formulario").submit(function () {
        post = $("#formulario").serialize();
        resposta = 'true';
        $.ajax({
            type: 'POST',
            url: "../Controle/usuarioPDO.php?function=pesquisaUsuariosPorRg&rg=" + $("#rg").val(),
            data: post,
            success: function (dado) {
                resposta = dado;
                if (dado != 'false') {
                    $("#lrg").attr('class', "red-text");
                    $("#lrg").text("Este RG já existe no sistema!");
                    $("#rg").attr('class', 'input-field invalid');
                    $("#rg").focus();
                }else{
                    resposta = dado;
                    $("#lrg").removeAttr('class');
                    $("#lrg").text("RG");
                    $("#rg").attr('class', 'input-field');
                }
            }
        });
        $.ajax({
            type: 'POST',
            url: "../Controle/usuarioPDO.php?function=pesquisaUsuariosPorCpf&cpf=" + $("#cpf").val(),
            data: post,
            success: function (dado) {
                resposta = dado;
                if (dado != 'false') {
                    $("#lcpf").attr('class', "red-text");
                    $("#lcpf").text("Este CPF já existe no sistema!");
                    $("#cpf").attr('class', 'input-field invalid');
                    $("#cpf").focus();
                }else{
                    resposta = dado;
                    $("#lcpf").removeAttr('class');
                    $("#lcpf").text("CPF");
                    $("#cpf").attr('class', 'input-field');
                }
            }
        });
        $.ajax({
            type: 'POST',
            url: "../Controle/usuarioPDO.php?function=pesquisaUsuariosPorUsuario&usuario=" + $("#usuario").val(),
            data: post,
            success: function (dado) {
                resposta = dado;
                if (dado != 'false') {
                    $("#usuario").attr('class', "red-text");
                    $("#lusuario").text("Usuario indisponível escolha outro.");
                    $("#usuario").attr('class', 'input-field invalid');
                    $("#usuario").focus();
                }else{
                    resposta = dado;
                    $("#lusuario").removeAttr('class');
                    $("#lusuario").text("Usuario");
                    $("#usuario").attr('class', 'input-field');
                }
            }
        });
        $.ajax({
            type: 'POST',
            url: "../Controle/usuarioPDO.php?function=pesquisaUsuariosPorEmail&email=" + $("#email").val(),
            data: post,
            success: function (dado) {
                resposta = dado;
                if (dado != 'false') {
                    $("#lemail").attr('class', "red-text");
                    $("#lemail").text("Este E-mail já existe no sistema!");
                    $("#email").attr('class', 'input-field invalid');
                    $("#email").focus();
                }else{
                    resposta = dado;
                    $("#lemail").removeAttr('class');
                    $("#lemail").text("E-mail");
                    $("#email").attr('class', 'input-field');
                }
            }
        });
        if (resposta == 'false') {
            return true;
        } else {
            return false;
        }
    });
});
