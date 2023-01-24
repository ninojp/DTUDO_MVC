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
            <h2>Editar Conteudo do Topo</h2>
        </div>
        <div class="button_center">
            <?php  echo "<a class='btn btn-sm btn-outline-info mx-4' href='".URLADM."view-page-home/index'> Visualizar </a> "; ?>
        </div>
        <?php echo "<div id='msg' class='msg_alert'>";
            if (isset($_SESSION['msg'])) { 
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);}
        echo "</div>"; ?>
        <form class="form_adms" action="" method="POST" id="form-edit-home-top">
            <!-- input oculto pra enviar o id, via post -->
            <input class="form-control" type="hidden" name="id" id="id" value="<?php if(isset($valorForm['id'])){echo $valorForm['id'];} ?>" required>

            <div class="row_edit">
                <label class="" for="name">Titulo Um:</label>
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="text" name="title_one_top" id="title_one_top" value="<?php if(isset($valorForm['title_one_top'])){echo $valorForm['title_one_top'];}?>" required>
            </div>
            <div class="row_edit">
                <label class="" for="name">Titulo Dois:</label>
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="text" name="title_two_top" id="title_two_top" value="<?php if(isset($valorForm['title_two_top'])){echo $valorForm['title_two_top'];}?>" required>
            </div>
            <div class="row_edit">
                <label class="" for="name">Titulo Três:</label>
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="text" name="title_three_top" id="title_three_top" value="<?php if(isset($valorForm['title_three_top'])){echo $valorForm['title_three_top'];}?>" required>
            </div>
            <div class="row_edit">
                <label class="" for="name">Link do Botão:</label>
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="text" name="link_btn_top" id="link_btn_top" value="<?php if(isset($valorForm['link_btn_top'])){echo $valorForm['link_btn_top'];}?>" required>
            </div>
            <div class="row_edit">
                <label class="" for="name">Texto do Botão:</label>
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="text" name="txt_btn_top" id="txt_btn_top" value="<?php if(isset($valorForm['txt_btn_top'])){echo $valorForm['txt_btn_top'];}?>" required>
            </div>
            <div class="button_center">
                <button class="btn btn-primary" type="submit" name="SendEditHomeTop" value="Editar">Salvar Mudança</button>
            </div>
        </form>
    </div>
</div>