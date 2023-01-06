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
<div class="wrapper_form">
    <div class="row_form">
        <div class="title_form">
            <h2>Editar o Tipo da Pagina</h2>
        </div>
        <?php if (isset($_SESSION['msg'])) { 
            echo "<div id='msg' class='msg_alert'>";
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
            echo "</div>"; } ?>
        <div id='msg' class='msg_alert'></div>
        <form class="form_adms" action="" method="POST" id="form-edit-type-pg">
            <!-- input oculto pra enviar o id, via post -->
            <input class="form-control" type="hidden" name="id" id="id" value="<?php if(isset($valorForm['id'])){echo $valorForm['id'];} ?>">

            <div class="row_edit">
                <label class="" for="type">Tipo:</label>
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="text" name="type" id="type" value="<?php if(isset($valorForm['type'])){echo $valorForm['type'];} ?>" placeholder="Digite o Tipo de Pg" required>
            </div>
            <div class="row_edit">
                <label class="" for="name">Nome:</label>
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="text" name="name" id="name" value="<?php if(isset($valorForm['name'])){echo $valorForm['name'];} ?>" placeholder="Digite o nome" required>
            </div>
            <div class="row_edit">
                <label class="" for="order_type_pg">order_type_pg:</label>
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="text" name="order_type_pg" id="order_type_pg" value="<?php if(isset($valorForm['order_type_pg'])){echo $valorForm['order_type_pg'];} ?>" placeholder="Numero para ordenar o tipo pg">
            </div>
            <?php if(!empty($valorForm['obs'])) { ?> 
                <div class="row_edit">
                    <label class="" for="obs">Observações:</label>
                    <i class="fa-solid fa-envelope"></i>
                    <input class="form-control" type="text" name="obs" id="obs" value="<?php if(isset($valorForm['obs'])){echo $valorForm['obs'];} ?>" placeholder="Edite as Observações" required>
                </div>
            <?php } ?>
            <div class="button_center">
                <button class="btn btn-primary" type="submit" name="SendEditTypesPgs" value="Salvar">Salvar Mudanças</button><br>
            </div>
            <div class="button_center">
                 <a class="btn btn-sm btn-outline-success mx-2" href="<?=URLADM;?>list-types-pgs/index"> Listar Tipos Pgs </a>
                 <?php if(isset($valorForm['id'])){
                    echo "<a class='btn btn-sm btn-outline-warning mx-2' href='".URLADM."view-types-pgs/index/".$valorForm['id']."'> Visualizar </a>";
                    echo "<a class='btn btn-sm btn-outline-danger mx-2' href='".URLADM."delete-types-pgs/index/".$valorForm['id']."' onclick='return confirm(\"Tem certeza que deseja excluir o registro?\")'> Apagar</a>"; } ?>
            </div>
        </form>
    </div>
</div>



