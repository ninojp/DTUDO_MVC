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
            <h2>Editar Conteudo Serviço</h2>
        </div>
        <div class="button_center">
            <?php  echo "<a class='btn btn-sm btn-outline-info mx-4' href='".URLADM."view-page-home/index'> Visualizar </a> "; ?>
        </div>
        <?php echo "<div id='msg' class='msg_alert'>";
            if (isset($_SESSION['msg'])) { 
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);}
        echo "</div>"; ?>
        <form class="form_adms" action="" method="POST" id="form-edit-home-serv">
            <!-- input oculto pra enviar o id, via post -->
            <input class="form-control" type="hidden" name="id" id="id" value="<?php if(isset($valorForm['id'])){echo $valorForm['id'];} ?>" required>

            <div class="row_edit">
                <label class="" for="name">serv_title:</label>
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="text" name="serv_title" id="serv_title" value="<?php if(isset($valorForm['serv_title'])){echo $valorForm['serv_title'];}?>" required>
            </div>
            <div class="row_edit">
                <label class="" for="name">serv_icon_one:</label>
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="text" name="serv_icon_one" id="serv_icon_one" value="<?php if(isset($valorForm['serv_icon_one'])){echo $valorForm['serv_icon_one'];}?>" required>
            </div>
            <div class="row_edit">
                <label class="" for="name">serv_title_one:</label>
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="text" name="serv_title_one" id="serv_title_one" value="<?php if(isset($valorForm['serv_title_one'])){echo $valorForm['serv_title_one'];}?>" required>
            </div>
            <div class="row_edit">
                <label class="" for="name">serv_desc_one:</label>
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="text" name="serv_desc_one" id="serv_desc_one" value="<?php if(isset($valorForm['serv_desc_one'])){echo $valorForm['serv_desc_one'];}?>" required>
            </div>
            <div class="row_edit">
                <label class="" for="name">serv_icon_two:</label>
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="text" name="serv_icon_two" id="serv_icon_two" value="<?php if(isset($valorForm['serv_icon_two'])){echo $valorForm['serv_icon_two'];}?>" required>
            </div>
            <div class="row_edit">
                <label class="" for="name">serv_title_two:</label>
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="text" name="serv_title_two" id="serv_title_two" value="<?php if(isset($valorForm['serv_title_two'])){echo $valorForm['serv_title_two'];}?>" required>
            </div>
            <div class="row_edit">
                <label class="" for="name">serv_icon_three:</label>
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="text" name="serv_icon_three" id="serv_icon_three" value="<?php if(isset($valorForm['serv_icon_three'])){echo $valorForm['serv_icon_three'];}?>" required>
            </div>
            <div class="row_edit">
                <label class="" for="name">serv_title_three:</label>
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="text" name="serv_title_three" id="serv_title_three" value="<?php if(isset($valorForm['serv_title_three'])){echo $valorForm['serv_title_three'];}?>" required>
            </div>
            <div class="row_edit">
                <label class="" for="name">serv_desc_three:</label>
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="text" name="serv_desc_three" id="serv_desc_three" value="<?php if(isset($valorForm['serv_desc_three'])){echo $valorForm['serv_desc_three'];}?>" required>
            </div>
            <div class="button_center">
                <button class="btn btn-primary" type="submit" name="SendEditHomeServ" value="Editar">Salvar Mudança</button>
            </div>
        </form>
    </div>
</div>