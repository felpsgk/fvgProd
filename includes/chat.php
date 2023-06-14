<!-- chat Modal-->
<div class="modal fade" id="chatModal" tabindex="-1" aria-labelledby="chatModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="chatModalLabel">Chat</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="chatz" class="form-container">
                    <!--<div class="col">
                        <h1>Chat</h1>
                        <p>O chat se atualiza sozinho a cada 10 segundos</p>
                        <div id="corpoChat" class="overflow-auto" style="background-color: #eee; height: auto; margin-bottom: 10px;">
                            <?php
                            //require 'DAO/chat.php';
                            ?>
                        </div>
                        <input type="hidden" id="nomeUsu" name="nomeUsu" value="<?php //echo $_SESSION['usuario']; 
                                                                                ?>"></input>
                        <input type="hidden" id="idUsu" name="idUsu" value="<?php //echo $_SESSION['id']; 
                                                                            ?>"></input>
                        <input class="mb-1 w-100" placeholder="Digite sua mensagem" type="text" id="msgText" name="msgText">
                        <button type="submit" class="btn">Enviar</button>
                    </div>-->
                </form>
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