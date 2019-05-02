$('#senha1').blur(function(){
    var dados = $('form').serialize();
    $.ajax({
        url: '../Controle/usuarioPDO.php?function=validaSenhaJs',
        data: dados,
        type: 'POST',
        success: function (data) {
            if(data == 'false'){
                $('#senha1').attr('class', 'invalid red-text');
                $('#lsenha1').attr('class', 'red-text');
                $('#lsenha1').text('Invalido! Minimo 8 digitos e um número!');
            }else{
                $('#senha1').attr('class', 'valid');
                $('#lsenha1').attr('class', '');
                $('#lsenha1').text('Senha'); 
            }
        }
    });
    
});
$('#senha2').blur(function(){
    var dados = $('form').serialize();
    $.ajax({
        url: '../Controle/usuarioPDO.php?function=validaSenhaJs',
        data: dados,
        type: 'POST',
        success: function (data) {
            if(data == 'false'){
                $('#senha2').attr('class', 'invalid red-text');
                $('#lsenha2').attr('class', 'red-text');
                $('#lsenha2').text('Invalido! Minimo 8 digitos e um número!');
            }else{
                $('#senha2').attr('class', 'valid');
                $('#lsenha2').attr('class', '');
                $('#lsenha2').text('Senha'); 
            }
        }
    });
    
});