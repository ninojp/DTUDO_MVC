<?php
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
// echo "Views/sitsUsers/addSitsUsers.php <h1> Pagina(view) Adicionar Situação</h1>";

//verifica, se contém dados no array:$this->data['form']
if(isset($this->data['form'])){
    //se contiver, atribui para variável:$valorForm
    $valorForm = $this->data['form'];
} ?>
<!-- <h1 class="text-center mt-5">Cadastrar Nova Cor</h1> -->
<?php
// echo "<a class='btn btn-sm btn-outline-primary ms-4' href='".URLADM."list-colors/index'> Listar </a> ";
// if(isset($_SESSION['msg'])){
//     echo $_SESSION['msg'];
//     unset($_SESSION['msg']);
// } ?>
<!-- <span id="msg"></span> -->
<div class="wrapper_form">
    <div class="row_form">
        <div class="title_form">
            <h2>Cadastrar Nova Cor</h2>
        </div>
        <?php if (isset($_SESSION['msg'])) { 
            echo "<div id='msg' class='msg_alert'>";
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
            echo "</div>"; } ?>
        <form class="form_adms" action="" method="POST" id="form-add-colors">
            <div class="row_input">
                <?php $name="";
                if(isset($valorForm['name'])){
                    $name = $valorForm['name'];} ?>
                    <!-- <label class="form-label" for="name">Nova Cor:<span style="color:#f00;">*</span></label> -->
                    <i class="fa-solid fa-file-signature"></i>
                    <input class="form-control" type="text" name="name" id="name" value="<?php echo $name; ?>" placeholder="Nome para Cor *" required>
            </div>
            <div class="row_input">
                <?php $color="";
                if(isset($valorForm['color'])){
                    $color = $valorForm['color'];} ?>
                    <label class="form-label" for="color">Escolha a Cor:<span style="color:#f00;">*</span></label>
                    <i class="fa-solid fa-palette"></i>
                    <input class="form-control" type="color" name="color" id="color" value="<?php echo $color; ?>" placeholder="Código da Cor *" required>
            </div>
            <br><br><span class="span_obrigatorio">* Campos obrigatórios</span><br>
            <div class="button_center">
                <button class="btn btn-primary" type="submit" name="SendAddColors" value="Cadastrar">Cadastrar Cor</button>
            </div>
            <div class="button_center">
                 <a class="btn btn-sm btn-outline-info" href="<?=URLADM;?>list-colors/index"> Listar  Cores </a>
            </div>
        </form>
    </div>
</div>