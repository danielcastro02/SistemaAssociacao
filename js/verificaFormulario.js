$("#formulario").submit(function () {
    alert('a');
    post = $("#formulario").serialize();
    resposta = 'true';
    $.ajax({
        type: 'POST',
        url: "../Controle/usuarioPDO.php?function=pesquisarUsuariosPorRg&rg=" + $("#rg").val(),
        data: post,
        success: function (dado) {
             alert('rg'+dado);
            if (dado != 'false') {
               
                $("#lrg").attr('class', "red-text");
                $("#lrg").text("Este RG já existe no sistema!");
                $("#rg").attr('class', 'input-field invalid');
                $("#rg").focus();
                M.updateTextFields();
            } else {
                resposta = dado;
                $("#lrg").removeAttr('class');
                $("#lrg").text("RG");
                $("#rg").attr('class', 'input-field');
                M.updateTextFields();
            }
        }
    });
    $.ajax({
        type: 'POST',
        url: "../Controle/usuarioPDO.php?function=pesquisarUsuariosPorCpf&cpf=" + $("#cpf").val(),
        data: post,
        success: function (dado) {
             alert('cpf'+dado);
            if (dado != 'false') {
                $("#lcpf").attr('class', "red-text");
                $("#lcpf").text("Este CPF já existe no sistema!");
                $("#cpf").attr('class', 'input-field invalid');
                $("#cpf").focus();
                M.updateTextFields();
            } else {
                resposta = dado;
                $("#lcpf").removeAttr('class');
                $("#lcpf").text("CPF");
                $("#cpf").attr('class', 'input-field');
                M.updateTextFields();
            }
        }
    });
    $.ajax({
        type: 'POST',
        url: "../Controle/usuarioPDO.php?function=pesquisarUsuariosPorUsuario&usuario=" + $("#usuario").val(),
        data: post,
        success: function (dado) {
             alert("user"+dado);
            if (dado != 'false') {
                $("#usuario").attr('class', "red-text");
                $("#lusuario").text("Usuario indisponível escolha outro.");
                $("#usuario").attr('class', 'input-field invalid');
                $("#usuario").focus();
                M.updateTextFields();
            } else {
                resposta = dado;
                $("#lusuario").removeAttr('class');
                $("#lusuario").text("Usuario");
                $("#usuario").attr('class', 'input-field');
                M.updateTextFields();
            }
        }
    });
    $.ajax({
        type: 'POST',
        url: "../Controle/usuarioPDO.php?function=pesquisarUsuariosPorEmail&email=" + $("#email").val(),
        data: post,
        success: function (dado) {
             alert("email"+dado);
            if (dado != 'false') {
                $("#lemail").attr('class', "red-text");
                $("#lemail").text("Este E-mail já existe no sistema!");
                $("#email").attr('class', 'input-field invalid');
                $("#email").focus();
                M.updateTextFields();
            } else {
                resposta = dado;
                $("#lemail").removeAttr('class');
                $("#lemail").text("E-mail");
                $("#email").attr('class', 'input-field');
                M.updateTextFields();
            }
        }
    });
    if (resposta == 'false') {
        return true;
    } else {
        return false;
    }
});
