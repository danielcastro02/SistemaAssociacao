$("#dataNasc").blur(function () {
    var dados = $("form").serialize();
    $.ajax({
        url: "../../Controle/usuarioControle.php?function=verificaMaioridadeJs",
        type: 'POST',
        data: dados,
        success: function (data) {
            if (data == 'false') {
                $('#dataNasc').attr('class', 'invalid red-text');
                $('#ldataNasc').text('Tem de ser maior de Idade!');
            } else {
                $('#dataNasc').attr('class', 'valid');
                $('#ldataNasc').text('Data de Nascimento');
            }
        }
    });
});
