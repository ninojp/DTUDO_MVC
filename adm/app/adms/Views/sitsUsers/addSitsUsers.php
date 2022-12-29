<?php
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
// echo "Views/sitsUsers/addSitsUsers.php <h1> Pagina(view) Adicionar Situação</h1>";

//verifica, se contém dados no array:$this->data['form']
if(isset($this->data['form'])){
    //se contiver, atribui para variável:$valorForm
    $valorForm = $this->data['form'];
} ?>
<!-- <h1 class="text-center mt-5">Cadastrar Nova Situação de Usuário</h1> -->
<?php
// echo "<a class='btn btn-sm btn-outline-primary ms-4' href='".URLADM."list-sits-users/index'> Listar </a> ";
// if(isset($_SESSION['msg'])){
//     echo $_SESSION['msg'];
//     unset($_SESSION['msg']);
// } 
// var_dump($this->data['selectCor']['cor']);?>
<div class="wrapper_form">
    <div class="row_form">
        <div class="title_form">
            <h2>Cadastrar Situação de Usuário</h2>
        </div>
        <div id="msg" class="msg_alert">
            <?php if (isset($_SESSION['msg'])) {
                echo $_SESSION['msg'];
                unset($_SESSION['msg']); } ?>
        </div>
        <form class="form_adms" action="" method="POST" id="form-add-sit-user">
            <div class="row_input">
            <?php $name="";
            if(isset($valorForm['name'])){
                $name = $valorForm['name'];} ?>
                <!-- <label class="form-label" for="name">Nova Situação:<span style="color:#f00;">*</span></label> -->
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="text" name="name" id="name" value="<?php echo $name; ?>" placeholder="Digite o nome da Situação *" required>
            </div>
            <div class="row_input">
                <i class="fa-solid fa-hand-pointer"></i>
                <div class="select_input">
                    <label class="form_label" for="adms_color_id">Cor da Situação<span style="color:#f00;"> * </span></label>
                    <select name="adms_color_id" id="adms_color_id" required>
                        <option value="">Selecione a Cor</option>
                        <?php foreach($this->data['selectCor']['cor'] as $cor){
                            extract($cor);
                            if((isset($valorForm['adms_color_id'])) and ($valorForm['adms_color_id'] == $idCor)){
                                echo "<option value='$idCor' selected>$nameCor</option>";
                            } else {
                                echo "<option value='$idCor'>$nameCor</option>";
                            }  } ?>
                    </select>
                </div>
            </div>
            <span class="span_obrigatorio" >* Campos obrigatórios</span><br>
            <div class="button_center">
                <button class="btn btn-primary" type="submit" name="SendAddSitUser" value="Cadastrar">Cadastrar Situação</button>
            </div>
            <div class="button_center">
                 <a class="btn btn-sm btn-outline-info" href="<?=URLADM;?>list-sits-users/index"> Listar Situações </a>
            </div>
        </form>
    </div>
</div>