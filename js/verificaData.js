//Essa é a parte expecifica do JS que verifica se o campo DATE é válido

$('.date').blur(function () {
    var valor = $(this).val();
    var vet = valor.split("/");
    var dia = parseInt(vet[0]);
    var mes = parseInt(vet[1]);
    var ano = parseInt(vet[2]);

    if (isNaN(dia)) {
        voltar($(this), $(this).next($('.ldata')));
    } else {
        if ((isNaN(mes) || isNaN(ano)) || (dia > 31 || dia == 0) || (mes > 12 || mes == 0) || (mes == 2 && dia == 29 && bissexto(ano) == false)) {
            invalida($(this), $(this).next($('.ldata')));
        } else {
            valido($(this), $(this).next($('.ldata')));
        }
    }
});

function invalida(data, label) {
    voltar(data, label);
    data.attr('class', 'invalid');
    label.text(label.text() + " inválida");
}

function valido(data, label) {
    voltar(data, label);
    data.attr('class', 'valid');
}

function bissexto(ano) {
    bi = ano % 4;
    if (bi == 0) {
        return true;
    } else {
        if ((ano % 400) == 0) {
            return true;
        } else {
            return false;
        }
    }
}

function voltar(data, label) {
    data.attr('class', 'input-field');
    label.text(label.text().toString().replace("inválida", ""));
}
