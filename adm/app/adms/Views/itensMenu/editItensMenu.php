<?php
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
// Manter os dados no formulário     
if(isset($this->data['form'])){
    $valorForm = $this->data['form']; } 
//na posição [0] e quando os dados vem do banco de dados
if(isset($this->data['form'][0])){
    $valorForm = $this->data['form'][0];
} // var_dump($this->data['form'][0]); ?>
<div class="wrapper_form">
    <div class="row_form">
        <div class="title_form">
            <h2>Editar Item do Menu DropDown</h2>
        </div>
        <?php echo "<div id='msg' class='msg_alert'>";
            if (isset($_SESSION['msg'])) { 
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);}
            echo "</div>";  ?>
        <form class="form_adms" action="" method="POST" id="form-edit-itens-menu">
            <!-- input oculto pra enviar o id, via post -->
            <input class="form-control" type="hidden" name="id" id="id" value="<?php if(isset($valorForm['id'])){echo $valorForm['id'];} ?>">

            <div class="row_edit">
                <label class="" for="name">Nome no menu:</label>
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="text" name="name" id="name" value="<?php if(isset($valorForm['name'])){echo $valorForm['name'];} ?>" placeholder="Digite o nome" required>
            </div>
            <div class="row_edit">
                <label class="" for="icon">Icone (class):</label>
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="text" name="icon" id="icon" value="<?php if(isset($valorForm['icon'])){echo $valorForm['icon'];} ?>" placeholder="Digite Classe do Icone">
            </div>
            <div class="row_edit">
                <label class="" for="order_item_menu">Ordem do Item:</label>
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="text" name="order_item_menu" id="order_item_menu" value="<?php if(isset($valorForm['order_item_menu'])){echo $valorForm['order_item_menu'];} ?>" placeholder="Numero para ordenar o Item">
            </div>
            <div class="button_center">
                <button class="btn btn-primary" type="submit" name="SendEditItensMenu" value="Salvar">Salvar Mudanças</button><br>
            </div>
            <div class="button_center">
                 <a class="btn btn-sm btn-outline-success mx-2" href="<?=URLADM;?>list-itens-menu/index"> Listar Itens menu </a>
                 <?php if(isset($valorForm['id'])){
                    echo "<a class='btn btn-sm btn-outline-warning mx-2' href='".URLADM."view-itens-menu/index/".$valorForm['id']."'> Visualizar </a>";
                    echo "<a class='btn btn-sm btn-outline-danger mx-2' href='".URLADM."delete-itens-menu/index/".$valorForm['id']."' onclick='return confirm(\"Tem certeza que deseja excluir o registro?\")'> Apagar</a>"; } ?>
            </div>
        </form>
    </div>
</div>



