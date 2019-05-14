$('.ativoInativo').click(function(){
    var caminho = $(this).attr('caminho');
    var pesquisa = '';
    pesquisa = $(this).attr('pesquisa');
    var esseaqui= $(this);
    if($('form').length){
        pesquisa = $('form').serialize();
    }
    $.ajax({
        type: 'POST',
        url: caminho,
        success: function (data) {
            if(data == 'false'){
                alert('Ocorreu um erro interno do servidor, por favor notifiquenos ou tente novamente!');
            }else{
                var divLoad = $(esseaqui).closest($('.loader'));
                divLoad.load('./tabelaDinamica.php', pesquisa);
            }
        }
    });
});

