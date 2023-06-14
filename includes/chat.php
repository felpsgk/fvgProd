<div class="modal fade" id="chatModal" tabindex="-1" aria-labelledby="chatModalLabel" aria-hidden="true">
    <div class="modal-dialog text-center modal-xl">
        <div class="modal-content align-self-center">
            <div class="modal-header">
                <h2 class="modal-title fs-5" id="chatModalLabel">Chat</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="modal-body">
                            <form id="chatz" class="row g-3">
                                <div class="col">
                                    <p>O chat se atualiza sozinho a cada 10 segundos</p>
                                </div>
                                <div id="corpoChat" class="col-12 bg-body-secondary overflow-auto" style="height: 500px;">
                                    <?php
                                    require 'DAO/chat.php';
                                    ?>
                                </div>
                                <div class="col">
                                    <input type="hidden" id="nomeUsu" name="nomeUsu" value="<?php echo $_SESSION['usuario']; ?>"></input>
                                    <input type="hidden" id="idUsu" name="idUsu" value="<?php echo $_SESSION['id']; ?>"></input>
                                    <input class="col mb-1" placeholder="Digite sua mensagem" type="text" id="msgText" name="msgText">
                                    <button type="submit" class="col btn btn-success">Enviar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    setInterval(refreshMessages, 10000);

    function refreshMessages() {
        $.ajax({
            url: 'DAO/chat.php',
            type: 'GET',
            dataType: 'html',
            success: function(data) {
                $('#corpoChat').html(data);
                var height = document.getElementById('corpoChat').scrollHeight; - $('#corpoChat').height();
                $('#corpoChat').scrollTop(height);
            },
            error: function() {
                $('#corpoChat').prepend('Error retrieving new messages..');
            }
        });
    }
    $(document).ready(function() {
        $('#chatz').on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: "DAO/createChat.php",
                method: "POST",
                data: $(this).serialize(),
                dataType: "json",
                success: function(data) {
                    if (data.msg) {
                        var html = '';
                        html += '<div class="bg-white m-1 text-break"><h4 class="text-dark m-1" id="sender">' + data.msgFrom + '</h4><p class="text-dark m-2" id="message">' + data.msg + '</p></div>';
                        $('#corpoChat').append(html);
                        //$('#inserir')[0].reset();
                    }
                    $('#msgText').val('');
                    var height = document.getElementById('corpoChat').scrollHeight; - $('#corpoChat').height();
                    $('#corpoChat').scrollTop(height);
                }
            })
        });

    });
</script>