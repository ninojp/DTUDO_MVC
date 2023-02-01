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
            <h2>Editar dados do Rodapé (Footer)</h2>
        </div>
        <div class="button_center">
            <?php  echo "<a class='btn btn-sm btn-outline-info mx-4' href='".URLADM."view-footer/index'> Visualizar </a> "; ?>
        </div>
        <?php echo "<div id='msg' class='msg_alert'>";
            if (isset($_SESSION['msg'])) { 
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);}
        echo "</div>"; ?>
        <form class="form_adms" action="" method="POST" id="form-edit-footer">
            <!-- input oculto pra enviar o id, via post -->
            <input class="form-control" type="hidden" name="id" id="id" value="<?php if(isset($valorForm['id'])){echo $valorForm['id'];} ?>">

            <div class="row_edit">
                <label class="" for="footer_desc">footer_desc:</label>
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="text" name="footer_desc" id="footer_desc" value="<?php if(isset($valorForm['footer_desc'])){echo $valorForm['footer_desc'];}?>" required>
            </div>
            <div class="row_edit">
                <label class="" for="footer_text_link">footer_text_link:</label>
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="text" name="footer_text_link" id="footer_text_link" value="<?php if(isset($valorForm['footer_text_link'])){echo $valorForm['footer_text_link'];}?>" required>
            </div>
            <div class="row_edit">
                <label class="" for="footer_link">footer_link:</label>
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="text" name="footer_link" id="footer_link" value="<?php if(isset($valorForm['footer_link'])){echo $valorForm['footer_link'];}?>" required>
            </div>
            <div class="button_center">
                <button class="btn btn-primary" type="submit" name="SendEditFooter" value="Editar">Salvar Mudança</button>
            </div>
        </form>
    </div>
</div>