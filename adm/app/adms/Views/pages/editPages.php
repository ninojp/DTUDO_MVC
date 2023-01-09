<?php
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
// echo "Views/login/login.php <h1> Pagina(view) para fazer o login</h1>";
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
            <h2>Editar Página</h2>
        </div>
        <?php if (isset($_SESSION['msg'])) { 
            echo "<div id='msg' class='msg_alert'>";
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
            echo "</div>"; } ?>
        <div id='msg' class='msg_alert'></div>
        <form class="form_adms" action="" method="POST" id="form-edit-page">
            <!-- input oculto pra enviar o id, via post -->
            <input class="form-control" type="hidden" name="id" id="id" value="<?php if(isset($valorForm['id'])){echo $valorForm['id'];} ?>">

            <div class="row_edit">
                <label class="" for="name">Nome da Página:</label>
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="text" name="name_page" id="name_page" value="<?php if(isset($valorForm['name_page'])){echo $valorForm['name_page'];} ?>" placeholder="Digite o nome Completo" required>
            </div>
            <div class="row_edit">
                <label class="" for="controller">Classe(controller):</label>
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="text" name="controller" id="controller" value="<?php if(isset($valorForm['controller'])){echo $valorForm['controller'];} ?>" placeholder="Digite o nome da Classe(controller)">
            </div>
            <div class="row_edit">
                <label class="" for="metodo">Método:</label>
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="text" name="metodo" id="metodo" value="<?php if(isset($valorForm['metodo'])){echo $valorForm['metodo'];} ?>" placeholder="Digite o nome do método">
            </div>
            <div class="row_edit">
                <label class="" for="menu_controller">Classe(menu_controller):</label>
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="text" name="menu_controller" id="menu_controller" value="<?php if(isset($valorForm['menu_controller'])){echo $valorForm['menu_controller'];} ?>" placeholder="Digite o Classe(menu_controller)">
            </div>
            <div class="row_edit">
                <label class="" for="menu_metodo">menu_metodo:</label>
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="text" name="menu_metodo" id="menu_metodo" value="<?php if(isset($valorForm['menu_metodo'])){echo $valorForm['menu_metodo'];} ?>" placeholder="Digite o menu_metodo">
            </div>
            <div class="row_edit">
                <label class="" for="publish">Observações:</label>
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="text" name="obs" id="obs" value="<?php if(isset($valorForm['obs'])){echo $valorForm['obs'];} ?>" placeholder="Digite as observações">
            </div>
            <div class="row_edit">
                <label class="" for="icon">Tag do icon:</label>
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="text" name="icon" id="icon" value="<?php if(isset($valorForm['icon'])){echo $valorForm['icon'];} ?>" placeholder="Digite a tag icon">
            </div>
            <div class="row_input">
            <i class="fa-solid fa-hand-pointer"></i>
                <div class="select_input">
                    <label class="mx-3">Página Pública:</label>
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
                    <label class="mx-3" for="adms_sits_pgs_id">Situação da Pagina: </label>
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
                    <label class="mx-3" for="adms_types_pgs_id">Tipo da Página:</label>
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
                    <label class="mx-3" for="adms_groups_pgs_id">Grupo de Página:</label>
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
            <div class="button_center">
                <button class="btn btn-primary" type="submit" name="SendEditPages" value="Salvar">Salvar Mudanças</button><br>
            </div>
            <div class="button_center">
                 <a class="btn btn-sm btn-outline-success mx-2" href="<?=URLADM;?>list-pages/index"> Listar Páginas </a>
                 <?php if(isset($valorForm['id'])){
                    echo "<a class='btn btn-sm btn-outline-warning mx-2' href='".URLADM."view-pages/index/".$valorForm['id']."'> Visualizar </a>";
                    echo "<a class='btn btn-sm btn-outline-danger mx-2' href='".URLADM."delete-pages/index/".$valorForm['id']."' onclick='return confirm(\"Tem certeza que deseja excluir o registro?\")'> Apagar</a>"; } ?>
            </div>
        </form>
    </div>
</div>



