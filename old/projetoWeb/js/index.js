$(document).ready(function() {
    function criarAutoComplete(arrayDados, id) {

        var htmlOption = '';

        htmlOption += '<div class="select_complete">';
        arrayDados.forEach(function (dados) {
            htmlOption += '<p data-codigousuario="' + dados['codigo'] + '" class="option_select_complete">' + dados['email'] + '</p>';
        })
        htmlOption += '</div>';

        if ($('.select_complete').html() == undefined) {
            $(id).after(htmlOption);
        } else {
            $('.select_complete').html(htmlOption);
        }

        $('body').on('click', '.option_select_complete', function () {
            var emailUsuario = $(this).html();
            var codigoUsuario = $(this).attr('data-codigousuario');

            $('#enviar-email').val(emailUsuario);

            $('.select_complete').remove();
        })

    }

    function criarDivBuscConteudoEmail() {
        var conteudoEmail = '';
        conteudoEmail += '<div id="container-resultado">';
        conteudoEmail += '<div id="resultado-pesquisa">';
        conteudoEmail += '<table class="table"></table>';
        conteudoEmail += '</div>';
        conteudoEmail += '</div>';

        $('#body-navbar-top').after(conteudoEmail);
    }

    $(function () {

        /* Busca dos email de caixa de entrada */
        if ($('#conteudoCaixaEntrada').html() != undefined) {
            $.ajax({
                type: 'GET',
                url: '../Api/buscar_caixa_entrada.php',
                success: function (data) {
                    var dados = Object.values(JSON.parse(data));
                    var conteudoHtml = '';

                    if (dados.length > 0) {
                        dados.forEach(function (item) {
                            conteudoHtml += "<tr>";
                            conteudoHtml += "<td><a href='email.php?c=" + item['codigo'] + "'>" + item["remetente"] + "</a></td>";
                            conteudoHtml += "<td>Assunto : " + item["assunto"] + "</td>";
                            conteudoHtml += "<td class='textWrap'>" + item["mensagem"] + "</td>";
                            conteudoHtml += "</tr>";
                        });
                    } else {
                        conteudoHtml += "<tr>";
                        conteudoHtml += "<td colspan='3'>Caixa de entrada vazia</td>";
                        conteudoHtml += "</tr>";
                    }

                    $('#conteudoCaixaEntrada').html(conteudoHtml);

                }
            })
        }

        /* AUTO COMPLETE EMAIL */
        if ($('.complete-email').html() !== undefined) {
            $('#enviar-email').keyup(function () {
                $.ajax({
                    type: 'POST',
                    data: { "buscar_query": $('#enviar-email').val() },
                    url: '../Api/buscar_usuario.php',
                    success: function (data) {
                        var usuers = JSON.parse(data);
                        criarAutoComplete(usuers, '#enviar-email');
                    }
                })
            });

        }

        /* AUTO COMPLETE BUSCAR EMAIL */
        $('#pesquisar-email').keyup(function () {
            $.ajax({
                type: 'POST',
                data: { "buscar_query": $('#pesquisar-email').val() },
                url: '../Api/buscar_email.php',
                success: function (data) {
                    var busca = JSON.parse(data);
                    $('#resultado-pesquisa').css('display', 'block');

                    criarDivBuscConteudoEmail();

                    var retornoHTML = '';
                    busca.forEach(function (email) {
                        retornoHTML += '<tr>';
                        retornoHTML += '<td><a href="email.php?c=' + email['codigo'] + '"><b>De : </b>' + email['remetente'] + ';<b>Assunto : </b>' + email['assunto'] + ';<b>Msg : </b>' + email['mensagem'].substring(0, 30) + '...</a></td>';
                        retornoHTML += '</tr>';
                    });

                    $('#resultado-pesquisa table').html(retornoHTML);
                }
            })
        });
    });
});