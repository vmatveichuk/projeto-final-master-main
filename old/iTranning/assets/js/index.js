(function () {
    'use strict'

    feather.replace()

    /**
     * Dashboard
     */

    if ($('#myChart').html() != undefined) {
        $.ajax({
            type: "POST",
            url: 'Api/TreinoController/rankUsuariosTreino',
            processData: false,
            contentType: false,
            success: function (data) {
                var char = JSON.parse(data);

                var label = [];
                char.forEach(function (charIn) {
                    label.push(charIn['usuario']);
                });

                var data = [];
                char.forEach(function (charIn) {
                    data.push(charIn['total_treino']);
                });

                //Gráfico
                var ctx = document.getElementById('myChart')
                var myChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: label,
                        datasets: [{
                            data: data,
                            lineTension: 0,
                            backgroundColor: 'transparent',
                            borderColor: '#007bff',
                            borderWidth: 4,
                            pointBackgroundColor: '#007bff'
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: false
                                }
                            }]
                        },
                        legend: {
                            display: false
                        }
                    }
                })
            }
        });
    }

    if ($('#idUsuario').html() != undefined) {
        $('#idUsuario').select2();
    }

    if ($('#chatProfessor').html() != undefined) {

        //Buscar usuarios do professor
        function buscarUserProf() {
            $.ajax({
                type: "POST",
                url: 'Api/Chat/buscarAlunosByProfessor',
                success: function (data) {
                    var chat = JSON.parse(data);

                    var alunos = '';

                    chat.forEach(msg => {
                        alunos += '<tr>';
                        alunos += '<td>' + msg['msg'] + '</td>';
                        alunos += '<td><a  id="buttonAccChat" data-user=' + msg['idusuario'] + ' href="#" >' + msg['nome'] + '</a></td>';
                        alunos += '</tr>';
                    });

                    $('#tableAlunos tbody').html(alunos);
                }
            });
        }
        buscarUserProf();

        $('#atualizarAlunos').on('click', function () {
            buscarUserProf();
        });

        var idInterval;

        //Escolheu o usuário
        $('#tableAlunos tbody').on('click', '#buttonAccChat', function () {
            var user = $(this).attr('data-user');
            var userNome = $(this).html();

            $('#title-chat-con').html('Chat - ' + userNome);
            $('#btn-input').removeAttr('disabled');
            $('#btn-chat').removeAttr('disabled');

            if (idInterval != undefined) {
                clearInterval(idInterval);
            }


            idInterval = setInterval(function () {
                $.ajax({
                    type: "POST",
                    url: 'Api/Chat/buscarMsgProfessor',
                    data: { 'user': user },
                    success: function (data) {
                        var chat = JSON.parse(data);

                        var msgS = '';

                        chat.forEach(msg => {
                            if (msg['aluno_envio'] == 0) {
                                msgS += '<div class="row msg_container base_sent">';
                                msgS += '<div class="col-md-10 col-xs-10">';
                                msgS += '<div class="messages msg_sent">';
                                msgS += '<p>' + msg['mensagem'] + '</p>';
                                msgS += '<time datetime="' + msg['momento'] + '">' + msg['momento'] + '</time>';
                                msgS += '</div>';
                                msgS += '</div>';
                                msgS += '</div>';
                            } else {
                                msgS += '<div class="row msg_container base_receive">';
                                msgS += '<div class="col-md-10 col-xs-10">';
                                msgS += '<div class="messages msg_receive">';
                                msgS += '<p>' + msg['mensagem'] + '</p>';
                                msgS += '<time datetime="' + msg['momento'] + '">' + msg['momento'] + '</time>';
                                msgS += '</div>';
                                msgS += '</div>';
                                msgS += '</div>';
                            }
                        });

                        $('#bodyMsgS').html(msgS);

                        var minhadiv = document.getElementById("bodyMsgS");
                        minhadiv.scrollTop = minhadiv.scrollHeight;
                    }
                });

                $('#btn-input').keyup(function (e) {
                    var mensagem = $('#btn-input').val().substr(0, 1);

                    if (mensagem.charCodeAt() == 32) {
                        $('#btn-input').val($('#btn-input').val().replace(' ', ''));
                        return false;
                    } else {
                        return true;
                    }
                });

                $('#btn-chat').unbind('click').on('click', function () {
                    var mensagem = $('#btn-input').val();
                    $('#btn-input').val('');

                    $.ajax({
                        type: "POST",
                        url: 'Api/Chat/enviarMsgProf',
                        data: { "msg": mensagem, "user": user },
                        success: function (data) {
                            console.log(data)
                        }
                    });

                });
            }, 1000);


        });


    }

    if ($('#chatAluno').html() != undefined) {

        setInterval(function () {
            $.ajax({
                type: "POST",
                url: 'Api/Chat/buscarMsgAluno',
                success: function (data) {
                    var chat = JSON.parse(data);

                    var msgS = '';

                    chat.forEach(msg => {
                        if (msg['aluno_envio'] == 1) {
                            msgS += '<div class="row msg_container base_sent">';
                            msgS += '<div class="col-md-10 col-xs-10">';
                            msgS += '<div class="messages msg_sent">';
                            msgS += '<p>' + msg['mensagem'] + '</p>';
                            msgS += '<time datetime="' + msg['momento'] + '">' + msg['momento'] + '</time>';
                            msgS += '</div>';
                            msgS += '</div>';
                            msgS += '</div>';
                        } else {
                            msgS += '<div class="row msg_container base_receive">';
                            msgS += '<div class="col-md-10 col-xs-10">';
                            msgS += '<div class="messages msg_receive">';
                            msgS += '<p>' + msg['mensagem'] + '</p>';
                            msgS += '<time datetime="' + msg['momento'] + '">' + msg['momento'] + '</time>';
                            msgS += '</div>';
                            msgS += '</div>';
                            msgS += '</div>';
                        }
                    });

                    $('#bodyMsgS').html(msgS);

                    var minhadiv = document.getElementById("bodyMsgS");
                    minhadiv.scrollTop = minhadiv.scrollHeight;
                }
            });
        }, 1000);

        $('#btn-input').keyup(function (e) {
            var mensagem = $('#btn-input').val().substr(0, 1);

            if (mensagem.charCodeAt() == 32) {
                $('#btn-input').val($('#btn-input').val().replace(' ', ''));
                return false;
            } else {
                return true;
            }
        });

        $('#btn-chat').on('click', function () {
            var mensagem = $('#btn-input').val();
            $('#btn-input').val('');

            $.ajax({
                type: "POST",
                url: 'Api/Chat/enviarMsg',
                data: { "msg": mensagem },
                success: function (data) {
                    console.log(data)
                }
            });

        });
    }
}())