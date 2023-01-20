<?php
if (!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')) {
    header("Location: https://localhost/dtudo/public/");
}
// echo "Views/login/login.php <h1> Pagina(view) para fazer o login</h1>";
// Manter os dados no formulário     
if (isset($this->data['form'])) {
    $valorForm = $this->data['form'];
}
//na posição [0] e quando os dados vem do banco de dados
if (isset($this->data['form'][0])) {
    $valorForm = $this->data['form'][0];
}
// var_dump($this->data['form'][0]); 
?>
<div class="wrapper_form">
    <div class="row_form">
        <div class="title_form">
            <h2>Editar Item de Menu da Página</h2>
        </div>
        <?php echo "<div id='msg' class='msg_alert'>";
        if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        echo "</div>"; ?>
        <form class="form_adms" action="" method="POST" id="form-edit-page-menu">
            <!-- input oculto pra enviar o id, via post -->
            <?php $id = "";
            if (isset($valorForm['id'])) {
                $id = $valorForm['id'];
            }
            echo "<input class='form-control' type='hidden' name='id' id='id' value='$id'>"; ?>

            <?php $name_page = "";
            if (isset($valorForm['name_page'])) {
                $name_page = $valorForm['name_page'];
            } ?>
            <div class="view_det">
                <span class="view_det_title">Nome da Página:</span>
                <span class="view_det_info"><?= $name_page; ?></span>
            </div>

            <div class="row_input">
                <i class="fa-solid fa-hand-pointer"></i>
                <div class="select_input">
                    <label class="mx-3" for="adms_items_menu_id">Item de Menu:<span class="text-danger">*</span></label>
                    <select name="adms_items_menu_id" id="adms_items_menu_id">
                        <option value="">Selecione</option>
                        <?php foreach ($this->data['select']['itm'] as $it_menu) {
                            extract($it_menu);
                            if ((isset($valorForm['adms_items_menu_id'])) and ($valorForm['adms_items_menu_id'] == $id_itm)) {
                                echo "<option value='$id_itm' selected>$name_itm</option>";
                            } else {
                                echo "<option value='$id_itm'>$name_itm</option>";
                            }
                        } ?>
                    </select>
                </div>
            </div>

            <div class="button_center">
                <button class="btn btn-primary" type="submit" name="SendEditPageMenu" value="Salvar">Salvar Mudanças</button><br>
            </div>
            <div class="button_center">
                <?php if ($this->data['button']['list_permission']) {
                    echo "<a class='btn btn-sm btn-outline-success mx-2' href='" . URLADM . "list-permission/index?level={$this->data['btnLevel']}' type='button'>Listar Permissões</a>";
                }

                //DEPOIS VEJO SE SERÁ UTIL
                // if(isset($valorForm['id'])){
                // echo "<a class='btn btn-sm btn-outline-warning mx-2' href='".URLADM."view-access-nivels/index/".$valorForm['id']."'> Visualizar </a>";
                // echo "<a class='btn btn-sm btn-outline-danger mx-2' href='".URLADM."delete-access-nivels/index/".$valorForm['id']."' onclick='return confirm(\"Tem certeza que deseja excluir o registro?\")'> Apagar</a>"; }
                ?>
            </div>
        </form>
    </div>
</div>