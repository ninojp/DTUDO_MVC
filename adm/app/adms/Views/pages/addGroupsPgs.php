<?php
if (!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')) { header("Location: https://localhost/dtudo/public/"); }
// Manter os dados no formulário     
if (isset($this->data['form'])) {
    // var_dump($this->data['form']);
    $valorForm = $this->data['form']; } ?>
<div class="wrapper_form">
    <div class="row_form">
        <div class="title_form">
            <h2>Cadastrar Grupo de Páginas</h2>
        </div>
        <?php if (isset($_SESSION['msg'])) { 
            echo "<div class='msg_alert'>";
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
            echo "</div>"; } ?>
        <div class="msg_alert" id='msg'></div>
        <form class="form_adms" action="" method="POST" id="form-add-groups-pgs">
            <div class="row_input">
                <?php $name = "";
                if (isset($valorForm['name'])) {
                    $name = $valorForm['name']; } ?>
                <i class="fa-regular fa-file-lines"></i>
                <input class="form-control" type="text" name="name" id="name" value="<?php echo $name; ?>" placeholder="Digite o Nome para o Tipo *">
            </div>
            <div class="row_input">
                <?php $order_group_pg = "";
                if (isset($valorForm['order_group_pg'])) {
                    $order_group_pg = $valorForm['order_group_pg']; } ?>
                <i class="fa-solid fa-file"></i>
                <input class="form-control" type="text" name="order_group_pg" id="order_group_pg" value="<?= $order_group_pg; ?>" placeholder="Digite o order_group_pg *" required>
            </div>
            <span class="span_obrigatorio">* Campos obrigatórios</span><br>
            <div class="button_center">
                <button class="btn btn-primary" type="submit" name="SendAddGroupsPgs" value="Cadastrar">Cadastrar Grupo</button>
            </div>
            <div class="button_center">
                 <a class="btn btn-sm btn-outline-info" href="<?=URLADM;?>list-groups-pgs/index"> Listar os Grupod de Pgs </a>
            </div>
        </form>
    </div>
</div>