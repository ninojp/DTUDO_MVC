<?php
if (!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')) {
    header("Location: https://localhost/dtudo/public/");
}
// echo "Views/login/login.php <h1> Pagina(view) para fazer o login</h1>";
// Manter os dados no formulário     
if (isset($this->data['form'])) {
    // var_dump($this->data['form']);
    $valorForm = $this->data['form'];
} ?>
<div class="wrapper_form">
    <div class="row_form">
        <div class="title_form">
            <h2>Cadastrar Novo Artigo (Sobre Empresa)</h2>
        </div>
        <?php echo "<div id='msg' class='msg_alert'>";
        if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        echo "</div>"; ?>
        <form class="form_adms" action="" method="POST" id="form-add-about-pg">
            <div class="row_input">
                <?php $title = "";
                if (isset($valorForm['title'])) {
                    $title = $valorForm['title'];
                } ?>
                <!-- <label class="form-label" for="title">Nome:<span style="color:#f00;">*</span></label> -->
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="text" name="title" id="title" value="<?php echo $title; ?>" placeholder="Digite o nome Completo  *">
            </div>
            <div class="row_input">
                <?php $description = "";
                if (isset($valorForm['description'])) {
                    $description = $valorForm['description'];
                } ?>
                <!-- <label class="form-label" for="description">description:<span style="color:#f00;">*</span></label> -->
                <i class="fa-solid fa-envelope"></i>
                <input class="form-control" type="text" name="description" id="description" value="<?= $description; ?>" placeholder="Digite uma Descrição *" required>
            </div>

            <div class="row_input">
                <i class="fa-solid fa-hand-pointer"></i>
                <div class="select_input">
                    <label class="form_label" for="sts_situation_id">Situação:<span style="color:#f00;">*</span></label>
                    <select name="sts_situation_id" id="sts_situation_id" class="input-adm" required>
                        <option value="">Selecione</option>
                        <?php
                        foreach ($this->data['select']['sit'] as $sit) {
                            extract($sit);
                            if ((isset($valorForm['sts_situation_id'])) and ($valorForm['sts_situation_id'] == $id_sit)) {
                                echo "<option value='$id_sit' selected>$name_sit</option>";
                            } else {
                                echo "<option value='$id_sit'>$name_sit</option>";
                            }
                        } ?>
                    </select>
                </div>
            </div>
            <span class="span_obrigatorio">* Campos obrigatórios</span><br>
            <div class="button_center">
                <button class="btn btn-primary" type="submit" name="SendAddAboutPg" value="Cadastrar">Cadastrar Artigo</button>
            </div>
            <div class="button_center">
                <a class="btn btn-sm btn-outline-info" href="<?= URLADM; ?>list-about-pg/index"> Listar Artigos </a>
            </div>
        </form>
    </div>
</div>