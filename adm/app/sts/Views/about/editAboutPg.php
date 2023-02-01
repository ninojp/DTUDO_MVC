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
} // var_dump($this->data['form'][0]); ?>
<!-- <span id="msg"></span> -->
<div class="wrapper_form">
    <div class="row_form">
        <div class="title_form">
            <h2>Editar Artigo (Sobre Empresa)</h2>
        </div>
        <?php echo "<div id='msg' class='msg_alert'>";
            if (isset($_SESSION['msg'])) { 
            echo $_SESSION['msg'];
            unset($_SESSION['msg']); } 
            echo "</div>"; ?>
        <form class="form_adms" action="" method="POST" id="form-edit-about-pg">
            <!-- input oculto pra enviar o id, via post -->
            <input class="form-control" type="hidden" name="id" id="id" value="<?php if(isset($valorForm['id'])){echo $valorForm['id'];} ?>">

            <div class="pt-3 text-center">
                    <?php
                    if ((!empty($valorForm['image'])) and (file_exists("app/sts/assets/imgs/about/{$valorForm['id']}/{$valorForm['image']}"))) {
                        echo "<img src='" . URLADM . "app/sts/assets/imgs/about/{$valorForm['id']}/{$valorForm['image']}' width='250' ><br>";
                    } else {
                        echo "<img src='" . URLADM . "app/sts/assets/imgs/Logo_Dtudo_2022-300p.png' width='250'><br>";
                    }
                    echo "<span class='view_det_title'>Imagem:</span><br>";
                    echo "<a href='" . URLADM . "edit-about-pg-img/index/".$valorForm['id']."' class='btn btn-sm btn-warning ms-3'>Editar Imagem</a>";
                    ?>
                </div>
            <div class="row_edit">
                <label class="" for="title">Titulo:</label>
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="text" name="title" id="title" value="<?php if(isset($valorForm['title'])){echo $valorForm['title'];} ?>" placeholder="Digite o Titulo" required>
            </div>
            <div class="row_edit">
                <label class="" for="description">Descrição:</label>
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="text" name="description" id="description" value="<?php if(isset($valorForm['description'])){echo $valorForm['description'];} ?>" placeholder="Digite uma descrição)">
            </div>
            <div class="row_input">
                <i class="fa-solid fa-hand-pointer"></i>
                <div class="select_input">
                    <label class="mx-3" for="sts_situation_id"> Situação: </label>
                    <select name="sts_situation_id" id="sts_situation_id">
                        <option value="">Selecione</option>
                        <?php foreach($this->data['select']['sit'] as $sit){
                            extract($sit);
                            //verifica se existe, E SE É IGUAL ao valor do id
                            if((isset($valorForm['sts_situation_id'])) and ($valorForm['sts_situation_id'] == $id_sit)){
                                echo "<option value='$id_sit' selected>$name_sit</option>";
                            } else {
                                echo "<option value='$id_sit'>$name_sit</option>";
                            } } ?>
                    </select>
                </div>
            </div>
            <div class="button_center">
                <button class="btn btn-primary" type="submit" name="SendEditAboutPg" value="Salvar">Salvar</button><br>
            </div>
            <div class="button_center">
                 <a class="btn btn-sm btn-outline-success mx-2" href="<?=URLADM;?>list-about-pg/index">Listar Artigos</a>
                 <?php if(isset($valorForm['id'])){
                    echo "<a class='btn btn-sm btn-outline-warning mx-2' href='".URLADM."view-about-pg/index/".$valorForm['id']."'> Visualizar </a>";
                    echo "<a class='btn btn-sm btn-outline-danger mx-2' href='".URLADM."delete-about-pg/index/".$valorForm['id']."' onclick='return confirm(\"Tem certeza que deseja excluir o registro?\")'> Apagar</a>"; } ?>
            </div>
        </form>
    </div>
</div>



