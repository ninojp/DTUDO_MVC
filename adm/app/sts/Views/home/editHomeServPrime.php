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
            <h2>Editar Conteudo do Serviço Premium</h2>
        </div>
        <div class="button_center">
            <?php  echo "<a class='btn btn-sm btn-outline-info mx-4' href='".URLADM."view-page-home/index'> Visualizar </a> "; ?>
        </div>
        <?php echo "<div id='msg' class='msg_alert'>";
            if (isset($_SESSION['msg'])) { 
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);}
        echo "</div>"; ?>
        <form class="form_adms" action="" method="POST" id="form-edit-home-serv-prime">
            <!-- input oculto pra enviar o id, via post -->
            <input class="form-control" type="hidden" name="id" id="id" value="<?php if(isset($valorForm['id'])){echo $valorForm['id'];} ?>" required>

            <div class="row_edit">
                <label class="" for="name">prem_title:</label>
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="text" name="prem_title" id="prem_title" value="<?php if(isset($valorForm['prem_title'])){echo $valorForm['prem_title'];}?>" required>
            </div>
            <div class="row_edit">
                <label class="" for="name">prem_subtitle:</label>
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="text" name="prem_subtitle" id="prem_subtitle" value="<?php if(isset($valorForm['prem_subtitle'])){echo $valorForm['prem_subtitle'];}?>" required>
            </div>
            <div class="row_edit">
                <label class="" for="name">prem_desc:</label>
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="text" name="prem_desc" id="prem_desc" value="<?php if(isset($valorForm['prem_desc'])){echo $valorForm['prem_desc'];}?>" required>
            </div>
            <div class="row_edit">
                <label class="" for="name">prem_btn_text:</label>
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="text" name="prem_btn_text" id="prem_btn_text" value="<?php if(isset($valorForm['prem_btn_text'])){echo $valorForm['prem_btn_text'];}?>" required>
            </div>
            <div class="row_edit">
                <label class="" for="name">prem_btn_link:</label>
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="text" name="prem_btn_link" id="prem_btn_link" value="<?php if(isset($valorForm['prem_btn_link'])){echo $valorForm['prem_btn_link'];}?>" required>
            </div>
            <div class="button_center">
                <button class="btn btn-primary" type="submit" name="SendEditHomeServPrime" value="Editar">Salvar Mudança</button>
            </div>
        </form>
    </div>
</div>