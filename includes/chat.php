<!-- chat Modal-->
<button class="btn btn-success btn-circle" onclick="openForm()">Chat</button>
<div class="chat-popup" id="chatzera">
    <form id="chatz" class="form-container">
        <h1>Chat</h1>
        <p>O chat se atualiza sozinho a cada 10 segundos</p>
        <div id="corpoChat" class="blocoMsg w-100 p-1 overflow-auto" style="background-color: #eee; height: 400px; margin-bottom: 10px;">
            <?php
            require 'DAO/chat.php';
            ?>
        </div>
        <input type="hidden" id="nomeUsu" name="nomeUsu" value="<?php echo $_SESSION['usuario']; ?>"></input>
        <input type="hidden" id="idUsu" name="idUsu" value="<?php echo $_SESSION['id']; ?>"></input>
        <input class="mb-1 w-100" placeholder="Digite sua mensagem" type="text" id="msgText" name="msgText">
        <button type="submit" class="btn">Enviar</button>
        <button type="button" class="btn cancel" onclick="closeForm()">Fechar</button>
    </form>
</div>