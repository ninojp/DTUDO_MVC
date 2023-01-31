<?php
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
// echo "Views/sitsUsers/addSitsUsers.php <h1> Pagina(view) Adicionar Situação</h1>";

//verifica, se contém dados no array:$this->data['form']
if(isset($this->data['form'])){
    //se contiver, atribui para variável:$valorForm
    $valorForm = $this->data['form'];
} 
//na posição [0] e quando os dados vem do banco de dados
if(isset($this->data['form'][0])){
    $valorForm = $this->data['form'][0];
} ?>
<div class="wrapper_form">
    <div class="row_form">
        <div class="title_form">
            <h2>Editar dados da Página Contatos</h2>
        </div>
        <div class="button_center">
            <?php  echo "<a class='btn btn-sm btn-outline-info mx-4' href='".URLADM."view-pg-contact/index'> Visualizar </a> "; ?>
        </div>
        <?php echo "<div id='msg' class='msg_alert'>";
            if (isset($_SESSION['msg'])) { 
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);}
        echo "</div>"; ?>
        <form class="form_adms" action="" method="POST" id="form-edit-pg-contact">
            <!-- input oculto pra enviar o id, via post -->
            <input class="form-control" type="hidden" name="id" id="id" value="<?php if(isset($valorForm['id'])){echo $valorForm['id'];} ?>" required>

            <div class="row_edit">
                <label class="" for="name">title_contact:</label>
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="text" name="title_contact" id="title_contact" value="<?php if(isset($valorForm['title_contact'])){echo $valorForm['title_contact'];}?>" required>
            </div>
            <div class="row_edit">
                <label class="" for="name">desc_contact:</label>
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="text" name="desc_contact" id="desc_contact" value="<?php if(isset($valorForm['desc_contact'])){echo $valorForm['desc_contact'];}?>" required>
            </div>
            <div class="row_edit">
                <label class="" for="name">icon_company (Somente a classe):</label>
                <i class="<?= $valorForm['icon_company'];?>"></i>
                <input class="form-control" type="text" name="icon_company" id="icon_company" value="<?php if(isset($valorForm['icon_company'])){echo $valorForm['icon_company'];}?>" required>
            </div>
            <div class="row_edit">
                <label class="" for="name">title_company:</label>
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="text" name="title_company" id="title_company" value="<?php if(isset($valorForm['title_company'])){echo $valorForm['title_company'];}?>" required>
            </div>
            <div class="row_edit">
                <label class="" for="name">desc_company:</label>
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="text" name="desc_company" id="desc_company" value="<?php if(isset($valorForm['desc_company'])){echo $valorForm['desc_company'];}?>" required>
            </div>
            <div class="row_edit">
                <label class="" for="name">icon_address (Somente a classe):</label>
                <i class="<?=$valorForm['icon_address'];?>"></i>
                <input class="form-control" type="text" name="icon_address" id="icon_address" value="<?php if(isset($valorForm['icon_address'])){echo $valorForm['icon_address'];}?>" required>
            </div>
            <div class="row_edit">
                <label class="" for="name">title_address:</label>
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="text" name="title_address" id="title_address" value="<?php if(isset($valorForm['title_address'])){echo $valorForm['title_address'];}?>" required>
            </div>
            <div class="row_edit">
                <label class="" for="name">desc_address:</label>
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="text" name="desc_address" id="desc_address" value="<?php if(isset($valorForm['desc_address'])){echo $valorForm['desc_address'];}?>" required>
            </div>
            <div class="row_edit">
                <label class="" for="name">icon_email (Somente a classe):</label>
                <i class="<?= $valorForm['icon_email'];?>"></i>
                <input class="form-control" type="text" name="icon_email" id="icon_email" value="<?php if(isset($valorForm['icon_email'])){echo $valorForm['icon_email'];}?>" required>
            </div>
            <div class="row_edit">
                <label class="" for="name">title_form:</label>
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="text" name="title_form" id="title_form" value="<?php if(isset($valorForm['title_form'])){echo $valorForm['title_form'];}?>" required>
            </div>
            <div class="row_edit">
                <label class="" for="name">desc_email:</label>
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="text" name="desc_email" id="desc_email" value="<?php if(isset($valorForm['desc_email'])){echo $valorForm['desc_email'];}?>" required>
            </div>
            <div class="button_center">
                <button class="btn btn-primary" type="submit" name="SendEditPgcontact" value="Editar">Salvar Mudança</button>
            </div>
        </form>
    </div>
</div>