<?php
if (!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')) {
    header("Location: https://localhost/dtudo/public/");
}
// echo "Views/login/login.php <h1> Pagina(view) para fazer o login</h1>";
// Manter os dados no formulário     
if (isset($this->data['form'])) {
    // var_dump($this->data['form']);
    $valorForm = $this->data['form']; } ?>
<div class="wrapper_form">
    <div class="row_form">
        <div class="title_form">
            <h2>Cadastrar Nova Página</h2>
        </div>
        <?php if (isset($_SESSION['msg'])) { 
            echo "<div class='msg_alert'>";
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
            echo "</div>"; } ?>
        <div class="msg_alert" id='msg'></div>
        <form class="form_adms" action="" method="POST" id="form-add-pages">
            <div class="row_input">
                <?php $name_page = "";
                if (isset($valorForm['name_page'])) {
                    $name_page = $valorForm['name_page']; } ?>
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="text" name="name_page" id="name_page" value="<?php echo $name_page; ?>" placeholder="Digite o nome da Página *" required>
            </div>
            <div class="row_input">
                <?php $controller = "";
                if (isset($valorForm['controller'])) {
                    $controller = $valorForm['controller']; } ?>
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="text" name="controller" id="controller" value="<?php echo $controller; ?>" placeholder="Digite o nome Classe(controllers) *" required>
            </div>
            <div class="row_input">
                <?php $metodo = "";
                if (isset($valorForm['metodo'])) {
                    $metodo = $valorForm['metodo']; } ?>
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="text" name="metodo" id="metodo" value="<?php echo $metodo; ?>" placeholder="Digite o nome do Método(principal) *" required>
            </div>
            <div class="row_input">
                <?php $menu_controller = "";
                if (isset($valorForm['menu_controller'])) {
                    $menu_controller = $valorForm['menu_controller']; } ?>
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="text" name="menu_controller" id="menu_controller" value="<?php echo $menu_controller; ?>" placeholder="Digite o nome menu_controller *" required>
            </div>
            <div class="row_input">
                <?php $menu_metodo = "";
                if (isset($valorForm['menu_metodo'])) {
                    $menu_metodo = $valorForm['menu_metodo']; } ?>
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="text" name="menu_metodo" id="menu_metodo" value="<?php echo $menu_metodo; ?>" placeholder="Digite o nome menu_metodo *" required>
            </div>
            <div class="row_input">
                <?php $obs = "";
                if (isset($valorForm['obs'])) {
                    $obs = $valorForm['obs']; } ?>
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="text" name="obs" id="obs" value="<?php echo $obs; ?>" placeholder="Digite as observações da Página">
            </div>
            <div class="row_input">
                <?php $icon = "";
                if (isset($valorForm['icon'])) {
                    $icon = $valorForm['icon']; } ?>
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="text" name="icon" id="icon" value="<?php echo $icon; ?>" placeholder="Digite a Tag para inserir o icon">
            </div>
            <div class="row_input">
            <i class="fa-solid fa-hand-pointer"></i>
                <div class="select_input">
                    <label class="mx-3">Página Pública:<span class="text-danger">*</span></label>
                    <select name="publish" id="publish" class="" required>
                        <?php
                        if (isset($valorForm['publish']) and $valorForm['publish'] == 1) {
                            echo "<option value=''>Selecione</option>";
                            echo "<option value='1' selected>Sim</option>";
                            echo "<option value='2'>Não</option>";
                        } elseif (isset($valorForm['publish']) and $valorForm['publish'] == 2) {
                            echo "<option value=''>Selecione</option>";
                            echo "<option value='1'>Sim</option>";
                            echo "<option value='2' selected>Não</option>";
                        } else {
                            echo "<option value='' selected>Selecione</option>";
                            echo "<option value='1'>Sim</option>";
                            echo "<option value='2'>Não</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="row_input">
                <i class="fa-solid fa-hand-pointer"></i>
                <div class="select_input">
                    <label class="mx-3" for="adms_sits_pgs_id">Situação da Pagina:<span class="text-danger">*</span></label>
                    <select name="adms_sits_pgs_id" id="adms_sits_pgs_id">
                        <option value="">Selecione</option>
                        <?php foreach($this->data['select']['sit'] as $sit){
                            extract($sit);
                            if((isset($valorForm['adms_sits_pgs_id'])) and ($valorForm['adms_sits_pgs_id'] == $id_sit)){
                                echo "<option value='$id_sit' selected>$name_sit</option>";
                            } else {
                                echo "<option value='$id_sit'>$name_sit</option>";
                            } } ?>
                    </select>
                </div>
            </div>
            <div class="row_input">
                <i class="fa-solid fa-hand-pointer"></i>
                <div class="select_input">
                    <label class="mx-3" for="adms_types_pgs_id">Tipo da Página:<span class="text-danger">*</span></label>
                    <select name="adms_types_pgs_id" id="adms_types_pgs_id">
                        <option value="">Selecione</option>
                        <?php foreach($this->data['select']['atp'] as $atp){
                            extract($atp);
                            if((isset($valorForm['adms_types_pgs_id'])) and ($valorForm['adms_types_pgs_id'] == $id_atp)){
                                echo "<option value='$id_atp' selected>$type_atp</option>";
                            } else {
                                echo "<option value='$id_atp'>$type_atp</option>";
                            } } ?>
                    </select>
                </div>
            </div>
            <div class="row_input">
                <i class="fa-solid fa-hand-pointer"></i>
                <div class="select_input">
                    <label class="mx-3" for="adms_groups_pgs_id">Grupo de Página:<span class="text-danger">*</span></label>
                    <select name="adms_groups_pgs_id" id="adms_groups_pgs_id">
                        <option value="">Selecione</option>
                        <?php foreach($this->data['select']['agp'] as $agp){
                            extract($agp);
                            if((isset($valorForm['adms_groups_pgs_id'])) and ($valorForm['adms_groups_pgs_id'] == $id_agp)){
                                echo "<option value='$id_agp' selected>$name_agp</option>";
                            } else {
                                echo "<option value='$id_agp'>$name_agp</option>";
                            } } ?>
                    </select>
                </div>
            </div>
            <span class="span_obrigatorio">* Campos obrigatórios</span><br>
            <div class="button_center">
                <button class="btn btn-primary" type="submit" name="SendAddPages" value="Cadastrar">Cadastrar Página</button>
            </div>
            <div class="button_center">
                 <a class="btn btn-sm btn-outline-info" href="<?=URLADM;?>list-pages/index"> Listar  Páginas </a>
            </div>
        </form>
    </div>
</div>