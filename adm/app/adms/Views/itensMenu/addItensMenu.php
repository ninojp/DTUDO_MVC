<?php
if (!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')) { header("Location: https://localhost/dtudo/public/"); }
// Manter os dados no formulário     
if (isset($this->data['form'])) {
    // var_dump($this->data['form']);
    $valorForm = $this->data['form']; } ?>
<div class="wrapper_form">
    <div class="row_form">
        <div class="title_form">
            <h2>Cadastrar Item do Menu DropDown</h2>
        </div>
        <?php echo "<div id='msg' class='msg_alert'>";
            if (isset($_SESSION['msg'])) { 
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);}
            echo "</div>"; ?>
        <form class="form_adms" action="" method="POST" id="form-add-item-Menu">
            <div class="row_input">
                <?php $name = "";
                if (isset($valorForm['name'])) {
                    $name = $valorForm['name']; } ?>
                <i class="fa-regular fa-file-lines"></i>
                <input class="form-control" type="text" name="name" id="name" value="<?php echo $name; ?>" placeholder="Digite o Nome para o Tipo *">
            </div>
            <div class="row_input">
                <?php $icon = "";
                if (isset($valorForm['icon'])) {
                    $icon = $valorForm['icon']; } ?>
                <i class="fa-regular fa-file-lines"></i>
                <input class="form-control" type="text" name="icon" id="icon" value="<?php echo $icon; ?>" placeholder="Digite Classe do Icone">
            </div>
            <div class="row_input">
                <?php $order_item_menu = "";
                if (isset($valorForm['order_item_menu'])) {
                    $order_item_menu = $valorForm['order_item_menu']; } ?>
                <i class="fa-solid fa-file"></i>
                <input class="form-control" type="text" name="order_item_menu" id="order_item_menu" value="<?= $order_item_menu; ?>" placeholder="Digite o Numero da Ordem de Menu *" required>
            </div>
            <span class="span_obrigatorio">* Campos obrigatórios</span><br>
            <div class="button_center">
                <button class="btn btn-primary" type="submit" name="SendAddItemMenu" value="Cadastrar">Cadastrar Item</button>
            </div>
            <div class="button_center">
                 <a class="btn btn-sm btn-outline-info" href="<?=URLADM;?>list-itens-menu/index"> Listar os Itens </a>
            </div>
        </form>
    </div>
</div>