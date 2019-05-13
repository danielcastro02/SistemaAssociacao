$('#senha1').blur(function(){
    var dados = $('form').serialize();
    $.ajax({
        url: '../../Controle/usuarioControle.php?function=validaSenhaJs',
        data: dados,
        type: 'POST',
        success: function (data) {
            if(data == 'false'){
                $('#senha1').attr('class', 'invalid red-text');
                $('#lsenha1').attr('class', 'red-text');
                $('#lsenha1').text('Invalido! Minimo 8 digitos e um número!');
                M.updateTextFields();
            }else{
                $('#senha1').attr('class', 'valid');
                $('#lsenha1').attr('class', '');
                $('#lsenha1').text('Senha'); 
                M.updateTextFields();
            }
        }
    });
    
});
$('#senha2').blur(function(){
    var dados = $('form').serialize();
    $.ajax({
        url: '../../Controle/usuarioControle.php?function=validaSenhaJs',
        data: dados,
        type: 'POST',
        success: function (data) {
            if(data == 'false'){
                $('#senha2').attr('class', 'invalid red-text');
                $('#lsenha2').attr('class', 'red-text');
                $('#lsenha2').text('Invalido! Minimo 8 digitos e um número!');
                M.updateTextFields();
            }else{
                $('#senha2').attr('class', 'valid');
                $('#lsenha2').attr('class', '');
                $('#lsenha2').text('Senha'); 
                M.updateTextFields();
            }
        }
    });
    
});