<?php
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
// echo "Views/sitsUsers/addSitsUsers.php <h1> Pagina(view) Adicionar Situação</h1>";

//verifica, se contém dados no array:$this->data['form']
if(isset($this->data['form'])){
    //se contiver, atribui para variável:$valorForm
    $valorForm = $this->data['form'];
} ?>
<h1 class="text-center mt-5">Cadastrar Nova Cor</h1>
<?php
echo "<a class='btn btn-sm btn-outline-primary ms-4' href='".URLADM."list-colors/index'> Listar </a> ";
if(isset($_SESSION['msg'])){
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
} ?>
<span id="msg"></span>
<form action="" method="POST" id="form-add-colors">
    <div class="row m-2">
        <div class="col-12 m-2">
            <div class="col-md-4 offset-md-4 mb-3">
                <?php $name="";
                if(isset($valorForm['name'])){
                    $name = $valorForm['name'];} ?>
                    <label class="form-label" for="name">Nova Cor:<span style="color:#f00;">*</span></label>
                    <input class="form-control" type="text" name="name" id="name" value="<?php echo $name; ?>" placeholder="Digite o nome da Situação" required>
            </div>
            <div class="col-md-4 offset-md-4 mb-3">
                <?php $color="";
                if(isset($valorForm['color'])){
                    $color = $valorForm['color'];} ?>
                    <label class="form-label" for="color">Cor (Hexadecimal):<span style="color:#f00;">*</span></label>
                    <input class="form-control" type="color" name="color" id="color" value="<?php echo $color; ?>" placeholder="Código da Cor" required>
            </div>
            <div class="col-md-2 offset-5 mb-3">
                <button class="btn btn-primary" type="submit" name="SendAddColors" value="Cadastrar">Cadastrar</button>
            </div>
        </div>
    </div>
</form>