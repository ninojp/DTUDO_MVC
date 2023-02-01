<?php
if (!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')) {
    header("Location: https://localhost/dtudo/public/");
}
// echo "Views/login/login.php <h1> Pagina(view) para fazer o login</h1>";
// Manter os dados no formulário     
if (isset($this->data['form'])) {
    // var_dump($this->data['form']);
    $valorForm = $this->data['form'];
} ?>
<div class="wrapper_form">
    <div class="row_form">
        <div class="title_form">
            <h2>Cadastrar Nova Mensagem (Pg Contato)</h2>
        </div>
        <?php echo "<div id='msg' class='msg_alert'>";
        if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        echo "</div>"; ?>
        <form class="form_adms" action="" method="POST" id="form-add-msg-contact">
            <div class="row_input">
                <?php $name = "";
                if (isset($valorForm['name'])) {
                    $name = $valorForm['name']; } ?>
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="text" name="name" id="name" value="<?php echo $name; ?>" placeholder="Digite o nome Para Msg *">
            </div>
            <div class="row_input">
                <?php $email = "";
                if (isset($valorForm['email'])) {
                    $email = $valorForm['email']; } ?>
                <i class="fa-solid fa-envelope"></i>
                <input class="form-control" type="email" name="email" id="email" value="<?= $email; ?>" placeholder="Digite o E-mail *" required>
            </div>
            <div class="row_input">
                <?php $subject = "";
                if (isset($valorForm['subject'])) {
                    $subject = $valorForm['subject']; } ?>
                <i class="fa-solid fa-envelope"></i>
                <input class="form-control" type="text" name="subject" id="subject" value="<?= $subject; ?>" placeholder="Digite o Assunto *" required>
            </div>
            <div class="row_input">
                <?php $content = "";
                if (isset($valorForm['content'])) {
                    $content = $valorForm['content']; } ?>
                <i class="fa-solid fa-envelope"></i>
                <input class="form-control" type="content" name="content" id="content" value="<?= $content; ?>" placeholder="Digite o conteúdo da Msg *" required>
            </div>

            <span class="span_obrigatorio">* Campos obrigatórios</span><br>
            <div class="button_center">
                <button class="btn btn-primary" type="submit" name="SendAddMsgContact" value="Cadastrar">Cadastrar Mensagem</button>
            </div>
            <div class="button_center">
                <a class="btn btn-sm btn-outline-info" href="<?= URLADM; ?>list-msg-contact/index"> Listar Mensagem </a>
            </div>
        </form>
    </div>
</div>