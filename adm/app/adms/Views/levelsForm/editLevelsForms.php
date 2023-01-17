<?php
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
// echo "Views/login/login.php <h1> Pagina(view) para fazer o login</h1>";
// Manter os dados no formulário     
if(isset($this->data['form'])){
    $valorForm = $this->data['form'];
} 
//na posição [0] e quando os dados vem do banco de dados
if(isset($this->data['form'][0])){
    $valorForm = $this->data['form'][0];
} 
var_dump($this->data['form']); 
// var_dump($this->data['select']['sit']);
// var_dump($this->data['select']['lev']);

?>
<div class="wrapper_form">
    <div class="row_form">
        <div class="title_form">
            <h2>Editar as Configurações novo Usuário</h2>
        </div>
        <?php echo "<div id='msg' class='msg_alert'>";
            if (isset($_SESSION['msg'])) { 
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);}
            echo "</div>"; ?>
        <div id='msg' class='msg_alert'></div>
        <form class="form_adms" action="" method="POST" id="form-edit-level-form">
            <!-- input oculto pra enviar o id, via post -->
            <input class="form-control" type="hidden" name="id" id="id" value="<?php if(isset($valorForm['id'])){echo $valorForm['id'];} ?>">

            <div class="row_input">
                <i class="fa-solid fa-hand-pointer"></i>
                <div class="select_input">
                    <label class="mx-3" for="adms_access_level_id">Nivel de Acesso:</label>
                    <select name="adms_access_level_id" id="adms_access_level_id">
                        <option value="">Selecione</option>
                        <?php foreach($this->data['select']['lev'] as $lev){
                            extract($lev);
                            //verifica se existe, E SE É IGUAL ao valor do id
                            if((isset($valorForm['adms_access_level_id'])) and ($valorForm['adms_access_level_id'] == $id_lev)){
                                echo "<option value='$id_lev' selected>$name_lev</option>";
                            } else {
                                echo "<option value='$id_lev'>$name_lev</option>";
                            } } ?>
                    </select>
                </div>
            </div>
            <div class="row_input">
                <i class="fa-solid fa-hand-pointer"></i>
                <div class="select_input">
                    <label class="mx-3" for="adms_sits_user_id"> Situação: </label>
                    <select name="adms_sits_user_id" id="adms_sits_user_id">
                        <option value="">Selecione</option>
                        <?php foreach($this->data['select']['sit'] as $sit){
                            extract($sit);
                            if((isset($valorForm['adms_sits_user_id'])) and ($valorForm['adms_sits_user_id'] == $id_sit)){
                                echo "<option value='$id_sit' selected>$name_sit</option>";
                            } else {
                                echo "<option value='$id_sit'>$name_sit</option>";
                            } } ?>
                    </select>
                </div>
            </div>
            <div class="button_center">
                <button class="btn btn-primary" type="submit" name="SendEditLevelForm" value="Salvar">Salvar Mudanças</button><br>
            </div>
            <div class="button_center">
                <?php if(isset($valorForm['id'])){
                    echo "<a class='btn btn-sm btn-outline-warning mx-2' href='".URLADM."view-users/index/".$valorForm['id']."'> Visualizar </a>";
                } ?>
            </div>
        </form>
    </div>
</div>



