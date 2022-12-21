<?php
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
// echo "Views/sitsUsers/addSitsUsers.php <h1> Pagina(view) Adicionar Situação</h1>";

//verifica, se contém dados no array:$this->data['form']
if(isset($this->data['form'])){
    //se contiver, atribui para variável:$valorForm
    $valorForm = $this->data['form'];
} 
//na posição [0] e quando os dados vem do banco de dados
if(isset($this->data['form'][0])){
    $valorForm = $this->data['form'][0];
} ?>
<h1 class="text-center mt-2">Editar Situação</h1>
<?php
echo "<a class='btn btn-sm btn-outline-primary ms-4' href='".URLADM."list-sits-users/index'> Listar </a> ";
if (isset($valorForm['id'])){
    echo "<a class='btn btn-sm btn-outline-primary ms-4' href='".URLADM."view-sits-users/index/".$valorForm['id']."'> Visualizar </a><br><hr>";
}
if(isset($_SESSION['msg'])){
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
} 
// var_dump($this->data['selectCor']['cor']);
// var_dump($this->data['form']);
// var_dump($valorForm['name']);
?>
<span id="msg"></span>
<form action="" method="POST" id="form-add-sit-user">
    <div class="row m-2">
        <div class="col-12 m-2">
            <!-- input oculto pra enviar o id, via post -->
            <input class="form-control" type="hidden" name="id" id="id" value="<?php if(isset($valorForm['id'])){echo $valorForm['id'];} ?>">

            <div class="col-md-4 offset-md-4 mb-3">
                <label class="form-label" for="name">Editar Situação:<span style="color:#f00;">*</span></label>
                <input class="form-control" type="text" name="name" id="name" value="<?php if(isset($valorForm['name'])){echo $valorForm['name'];} ?>" required>
            </div>
            
            <div class="col-md-4 offset-md-4 mb-3">
                <label class="form-label" for="adms_color_id">COR da Situação:<span style="color:#f00;">*</span></label>
                <select name="adms_color_id" id="adms_color_id" required>
                    <option value="">Selecione a Cor</option>
                    <?php foreach($this->data['selectCor']['cor'] as $cor){
                        extract($cor);
                        if((isset($valorForm['adms_color_id'])) and ($valorForm['adms_color_id'] == $idCor)){
                            echo "<option value='$idCor' selected>$nameCor</option>";
                        } else {
                            echo "<option value='$idCor'>$nameCor</option>";
                        }
                    } ?>
                </select>
            </div>
            <div class="col-md-2 offset-5 mb-3">
                <button class="btn btn-primary" type="submit" name="SendEditSitUser" value="Editar">Editar</button>
            </div>
        </div>
    </div>
</form>