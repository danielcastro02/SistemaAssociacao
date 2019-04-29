$("#formulario").submit(function () {
    alert('a');
    post = $("#formulario").serialize();
    resposta = 'true';
    $.ajax({
        type: 'POST',
        async: false,
        url: "../Controle/usuarioPDO.php?function=pesquisarPorRgExata&rg=" + $("#rg").val(),
        data: post,
        success: function (dado) {
            alert('rg' + dado);
            if (dado != 'false') {
                resposta = 'false';
                $("#lrg").attr('class', "red-text");
                $("#lrg").text("Este RG já existe no sistema!");
                $("#rg").attr('class', 'input-field invalid');
                $("#rg").focus();
                M.updateTextFields();
            } else {
                $("#lrg").removeAttr('class');
                $("#lrg").text("RG");
                $("#rg").attr('class', 'input-field');
                M.updateTextFields();
            }

        }
    });
    $.ajax({
        type: 'POST',
        async: false,
        url: "../Controle/usuarioPDO.php?function=pesquisarPorUsuarioExata&usuario=" + $("#usuario").val(),
        data: post,
        success: function (dado) {
            alert("user" + dado);
            if (dado != 'false') {
                resposta = 'false';
                $("#usuario").attr('class', "red-text");
                $("#lusuario").text("Usuario indisponível escolha outro.");
                $("#usuario").attr('class', 'input-field invalid');
                $("#usuario").focus();
                M.updateTextFields();
            } else {
                $("#lusuario").removeAttr('class');
                $("#lusuario").text("Usuario");
                $("#usuario").attr('class', 'input-field');
                M.updateTextFields();
            }


        }
    });
    $.ajax({
        type: 'POST',
        async: false,
        url: "../Controle/usuarioPDO.php?function=pesquisarPorCpfExata&cpf=" + $("#cpf").val(),
        data: post,
        success: function (dado) {
            alert("user" + dado);
            if (dado != 'false') {
                resposta = 'false';
                $("#cpf").attr('class', "red-text");
                $("#lcpf").text("Este CPF ja esta cadastrado no sistema!");
                $("#cpf").attr('class', 'input-field invalid');
                $("#cpf").focus();
                M.updateTextFields();
            } else {
                $("#lcpf").removeAttr('class');
                $("#lcpf").text("CPF");
                $("#cpf").attr('class', 'input-field');
                M.updateTextFields();
            }


        }
    });

    $.ajax({
        type: 'POST',
        async: false,
        url: "../Controle/usuarioPDO.php?function=pesquisarPorEmailExata&email=" + $("#email").val(),
        data: post,
        success: function (dado) {
            alert("email" + dado);
            if (dado != 'false') {
                resposta = 'false';
                $("#lemail").attr('class', "red-text");
                $("#lemail").text("Este E-mail já existe no sistema!");
                $("#email").attr('class', 'input-field invalid');
                $("#email").focus();
                M.updateTextFields();
            } else {
                $("#lemail").removeAttr('class');
                $("#lemail").text("E-mail");
                $("#email").attr('class', 'input-field');
                M.updateTextFields();
            }

        }
    });

    if (resposta == 'true') {
        return true;
    } else {
        return false;
    }
});
