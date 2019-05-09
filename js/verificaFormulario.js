$('.date').blur(function () {
    var valor = $(this).val();
    var vet = valor.split("/");
    var dia = parseInt(vet[0]);
    var mes = parseInt(vet[1]);
    if (dia > 31) {
        invalida($(this), $(this).next($('.ldata')));
    } else {
        if (mes > 12) {
            invalida($(this), $(this).next($('.ldata')));
        } else {
            valido($(this), $(this).next($('.ldata')));
        }
    }
});

function invalida(data, label) {
    data.attr('class', 'invalid');
    label.text('Data inválida');
}

function valido(data, label){
    data.attr('class', 'valid');
    label.text('Data válida');
}

$("#formulario").submit(function () {
    alert('aaa');
    var cpf = $('#cpf').val().replace('.', '').toString();
    cpf = cpf.replace('.', '');
    cpf = cpf.replace('-', '');
    if (cpf.length == 11) {
        var x = false;
        for (var i = 0; i <= 8; i++) {
            if (!(cpf[i] == cpf[i + 1])) {
                x = true;
            }
        }
        if (x) {
            var v = [];
            v[0] = (1 * cpf[0]) + (2 * cpf[1]) + (3 * cpf[2]);
            v[0] += (4 * cpf[3]) + (5 * cpf[4]) + (6 * cpf[5]);
            v[0] += (7 * cpf[6]) + (8 * cpf[7]) + (9 * cpf[8]);
            v[0] = v[0] % 11;
            v[0] = v[0] % 10;

            v[1] = (1 * cpf[1]) + (2 * cpf[2]) + (3 * cpf[3]);
            v[1] += (4 * cpf[4]) + (5 * cpf[5]) + (6 * cpf[6]);
            v[1] += (7 * cpf[7]) + (8 * cpf[8]) + (9 * v[0]);
            v[1] = v[1] % 11;
            v[1] = v[1] % 10;

            if ((v[0] != cpf[9]) || v[1] != cpf[10]) {
                $("#cpf").attr('class', 'invalid red-text');
                $("#lcpf").text('CPF Invalido!');
                $("#cpf").focus();
                resposta = 'false';
            } else {
                $("#cpf").attr('class', 'valid green-text');
                $("#lcpf").text('CPF');
            }
        } else {
            $("#cpf").attr('class', 'invalid red-text');
            $("#lcpf").text('CPF Invalido!');
            $("#cpf").focus();
            resposta = 'false';
        }
    } else {
        $("#cpf").attr('class', 'invalid red-text');
        $("#lcpf").text('CPF Invalido!');
        $("#cpf").focus();
        resposta = 'false';
    }
    post = $("#formulario").serialize();
    resposta = 'true';
    $.ajax({
        type: 'POST',
        async: false,
        url: "../../Controle/usuarioPDO.php?function=pesquisarPorRgExata&rg=" + $("#rg").val(),
        data: post,
        success: function (dado) {
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
        url: "../../Controle/usuarioPDO.php?function=pesquisarPorUsuarioExata&usuario=" + $("#usuario").val(),
        data: post,
        success: function (dado) {
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
        url: "../../Controle/usuarioPDO.php?function=pesquisarPorCpfExata&cpf=" + $("#cpf").val(),
        data: post,
        success: function (dado) {
            if (dado != 'false') {
                resposta = 'false';
                $("#cpf").attr('class', "red-text");
                $("#lcpf").text("Este CPF ja esta cadastrado no sistema!");
                $("#cpf").attr('class', 'input-field invalid');
                $("#cpf").focus();
                M.updateTextFields();
            } else {
                $("#lcpf").removeAttr('class');
                $("#cpf").attr('class', 'input-field');
                M.updateTextFields();
            }


        }
    });

    $.ajax({
        type: 'POST',
        async: false,
        url: "../../Controle/usuarioPDO.php?function=pesquisarPorEmailExata&email=" + $("#email").val(),
        data: post,
        success: function (dado) {
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
