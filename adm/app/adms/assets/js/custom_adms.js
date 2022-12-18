// ===============================================================================================
// Permitir o retorno(voltar) no navegador, após erro no formulário;
if (window.history.replaceState){
    window.history.replaceState(null, null, window.location.href);
}
// ===============================================================================================
//Calcular a foça da senha
function passwordStrength(){
    var password = document.getElementById('password').value;
    var strength = 0;
    if ((password.length >= 6) && (password.length <= 7)){
        strength += 10;
    } else if (password.length > 7){
        strength += 25;
    }
    if ((password.length >= 6) && (password.match(/[a-z]+/))){
        strength += 10;
    }
    if ((password.length >= 7) && (password.match(/[A-Z]+/))){
        strength += 20;
    }
    if ((password.length >= 8 ) && (password.match(/[@#$%;!*]+/))){
        strength += 25;
    }
    if (password.match(/([1-9]+)\1{1,}/)){
        strength -= 25;
    }
    viewStrength(strength);
}
// ================================================================================================
function viewStrength(strength){
    // Imprimir a força da senha
    if(strength < 30){
        document.getElementById("msgViewStrength").innerHTML = "<p class='alert alert-danger'>Senha Fraca</p>";
    } else if ((strength >= 30) && (strength < 50)){
        document.getElementById("msgViewStrength").innerHTML = "<p class='alert alert-warning'>Senha Média</p>";
    } else if ((strength >= 50) && (strength < 70)){
        document.getElementById("msgViewStrength").innerHTML = "<p class='alert alert-primary'>Senha Boa</p>";
    } else if (strength >= 70){
        document.getElementById("msgViewStrength").innerHTML = "<p class='alert alert-success'>Senha Forte</p>";
    } else {
        document.getElementById("msgViewStrength").innerHTML = "";
    }
}
// ================================================================================================
const formNewUser = document.getElementById("form-new-user");
if (formNewUser) {
    formNewUser.addEventListener("submit", async (e) => {
        //Receber o valor do campo NAME
        var name = document.querySelector("#name").value;
        // Verificar se o campo está vazio
        if (name === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert alert-danger'>Erro! Necessário preencher o campo NOME! (validação JS)</p>";
            return;
        }
        //Receber o valor do campo EMAIL
        var email = document.querySelector("#email").value;
        // Verificar se o campo está vazio
        if (email === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert alert-danger'>Erro! Necessário preencher o campo EMAIL! (validação JS)</p>";
            return;
        }
        //Receber o valor do campo PASSWORD
        var password = document.querySelector("#password").value;
        // Verificar se o campo está vazio
        if (password === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert alert-danger'>Erro! Necessário preencher o campo SENHA! (validação JS)</p>";
            return;
        }
        // Verificar se o campo senha possui 6 caracteres
        if (password.length < 6) {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert alert-warning'>A Senha deve ter no minímo 6 caracteres! (validação JS)</p>";
            return;
        }
        // Verificar se o campo senha não possui numeros repetidos
        // PARA APRENDER MAIS SOBRE EXPRESSÕES REGULARES
        //https://developer.mozilla.org/pt-BR/docs/Web/JavaScript/Guide/Regular_Expressions
        if (password.match(/([1-9]+)\1{1,}/)) {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert alert-warning'>A Senha Não pode conter números repetidos! (validação JS)</p>";
            return;
        }
        // Verificar se o campo senha possui Letras
        if (!password.match(/[A-Za-z]/)) {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert alert-warning'>A Senha deve ter no minímo uma letra! (validação JS)</p>";
            return;
        } else {
            document.getElementById("msg").innerHTML = "<p></p>";
            return;
        }
    });
}
//=================================================================================================
const formLogin = document.getElementById("form-login");
if (formLogin) {
    formLogin.addEventListener("submit", async (e) => {
        //Receber o valor do campo USER
        var user = document.querySelector("#user").value;
        // Verificar se o campo está vazio
        if (user === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert alert-danger'>Erro! Necessário preencher o campo USUÁRIO! (validação JS)</p>";
            return;
        }
        //Receber o valor do campo PASSWORD
        var password = document.querySelector("#password").value;
        // Verificar se o campo está vazio
        if (password === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert alert-danger'>Erro! Necessário preencher o campo SENHA! (validação JS)</p>";
            return;
        } else {
            document.getElementById("msg").innerHTML = "<p></p>";
            return;
        }
    });
}
// ===============================================================================================
const formNewConfEmail = document.getElementById("form-new-conf-email");
if (formNewConfEmail) {
    formNewConfEmail.addEventListener("submit", async(e) => {
        //Receber o valor do campo EMAIL
        var email = document.querySelector("#email").value;
        // Verificar se o campo está vazio
        if (email === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert alert-danger'>Erro! Necessário preencher o campo EMAIL! (validação JS)</p>";
            return;
        } else {
            document.getElementById("msg").innerHTML = "<p></p>";
            return;
        }
    });
}
// ===============================================================================================
const formRecoverPass = document.getElementById("form-recover-pass");
if (formRecoverPass) {
    formRecoverPass.addEventListener("submit", async(e) => {
        //Receber o valor do campo EMAIL
        var email = document.querySelector("#email").value;
        // Verificar se o campo está vazio
        if (email === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert alert-danger'>Erro! Necessário preencher o campo EMAIL! (validação JS)</p>";
            return;
        } else {
            document.getElementById("msg").innerHTML = "<p></p>";
            return;
        }
    });
}
// ===============================================================================================
const formUpdatePass = document.getElementById("form-update-pass");
if (formUpdatePass) {
    formUpdatePass.addEventListener("submit", async(e) => {
        //Receber o valor do campo Senha
        var senha = document.querySelector("#password").value;
        // Verificar se o campo está vazio
        if (senha === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert alert-warning'>Erro! Necessário preencher o campo Senha! (validação JS)</p>";
            return;
        } else {
            document.getElementById("msg").innerHTML = "<p></p>";
            return;
        }
    });
}
// ================================================================================================
// VALIDAÇÃO DO FORMULÁRIO DA VIEW:addUser
const formAddUser = document.getElementById("form-add-user");
if (formAddUser) {
    formAddUser.addEventListener("submit", async (e) => {
        //Receber o valor do campo NAME
        var name = document.querySelector("#name").value;
        // Verificar se o campo está vazio
        if (name === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert alert-danger'>Erro! Necessário preencher o campo NOME! (validação JS)</p>";
            return;
        }
        //Receber o valor do campo EMAIL
        var email = document.querySelector("#email").value;
        // Verificar se o campo está vazio
        if (email === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert alert-danger'>Erro! Necessário preencher o campo EMAIL! (validação JS)</p>";
            return;
        }
        //Receber o valor do campo USUÁRIO
        var user = document.querySelector("#user").value;
        // Verificar se o campo está vazio
        if (user === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert alert-danger'>Erro! Necessário preencher o campo Usuário! (validação JS)</p>";
            return;
        }
        //Validar o valor do campo SITUAÇÃO do USUÁRIO
        var adms_sits_user_id = document.querySelector("#adms_sits_user_id").value;
        // Verificar se o campo está vazio
        if (adms_sits_user_id === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert alert-danger'>Erro! Necessário preencher o campo Situação! (validação JS)</p>";
            return;
        }
        //Receber o valor do campo PASSWORD
        var password = document.querySelector("#password").value;
        // Verificar se o campo está vazio
        if (password === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert alert-danger'>Erro! Necessário preencher o campo SENHA! (validação JS)</p>";
            return;
        }
        // Verificar se o campo senha possui 6 caracteres
        if (password.length < 6) {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert alert-warning'>A Senha deve ter no minímo 6 caracteres! (validação JS)</p>";
            return;
        }
        // Verificar se o campo senha não possui numeros repetidos
        // PARA APRENDER MAIS SOBRE EXPRESSÕES REGULARES
        //https://developer.mozilla.org/pt-BR/docs/Web/JavaScript/Guide/Regular_Expressions
        if (password.match(/([1-9]+)\1{1,}/)) {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert alert-warning'>A Senha Não pode conter números repetidos!</p>";
            return;
        }
        // Verificar se o campo senha possui Letras
        if (!password.match(/[A-Za-z]/)) {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert alert-warning'>A Senha deve ter no minímo uma letra!</p>";
            return;
        } else {
            document.getElementById("msg").innerHTML = "<p></p>";
            return;
        }
    });
}
// ================================================================================================
// VALIDAÇÃO DO FORMULÁRIO DA VIEW:editUser
const formEditUser = document.getElementById("form-edit-user");
if (formEditUser) {
    formEditUser.addEventListener("submit", async (e) => {
        //Validar o valor do campo NAME
        var name = document.querySelector("#name").value;
        // Verificar se o campo está vazio
        if (name === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert alert-danger'>Erro! Necessário preencher o campo NOME! (validação JS)</p>";
            return;
        }
        //Validar o valor do campo EMAIL
        var email = document.querySelector("#email").value;
        // Verificar se o campo está vazio
        if (email === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert alert-danger'>Erro! Necessário preencher o campo EMAIL! (validação JS)</p>";
            return;
        }
        //Validar o valor do campo USUÁRIO
        var user = document.querySelector("#user").value;
        // Verificar se o campo está vazio
        if (user === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert alert-danger'>Erro! Necessário preencher o campo Usuário! (validação JS)</p>";
            return;
        }
        //Validar o valor do campo SITUAÇÃO do USUÁRIO
        var adms_sits_user_id = document.querySelector("#adms_sits_user_id").value;
        // Verificar se o campo está vazio
        if (adms_sits_user_id === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert alert-danger'>Erro! Necessário preencher o campo Situação! (validação JS)</p>";
            return;
        } else {
            document.getElementById("msg").innerHTML = "<p></p>";
            return;
        }
    });
}
// ================================================================================================
const formEditUserPass = document.getElementById("form-edit-user-pass");
if (formEditUserPass) {
    formEditUserPass.addEventListener("submit", async (e) => {
        
        //Receber o valor do campo PASSWORD
        var password = document.querySelector("#password").value;
        // Verificar se o campo está vazio
        if (password === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert alert-danger'>Erro! Necessário preencher o campo SENHA! (validação JS)</p>";
            return;
        }
        // Verificar se o campo senha possui 6 caracteres
        if (password.length < 6) {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert alert-warning'>A Senha deve ter no minímo 6 caracteres! (validação JS)</p>";
            return;
        }
        // Verificar se o campo senha não possui numeros repetidos
        // PARA APRENDER MAIS SOBRE EXPRESSÕES REGULARES
        //https://developer.mozilla.org/pt-BR/docs/Web/JavaScript/Guide/Regular_Expressions
        if (password.match(/([1-9]+)\1{1,}/)) {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert alert-warning'>A Senha Não pode conter números repetidos! (validação JS)</p>";
            return;
        }
        // Verificar se o campo senha possui Letras
        if (!password.match(/[A-Za-z]/)) {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert alert-warning'>A Senha deve ter no minímo uma letra! (validação JS)</p>";
            return;
        } else {
            document.getElementById("msg").innerHTML = "<p></p>";
            return;
        }
    });
}
// ================================================================================================
// VALIDAÇÃO DO FORMULÁRIO DA VIEW:editUser
const formEditProfile = document.getElementById("form-edit-profile");
if (formEditProfile) {
    formEditProfile.addEventListener("submit", async (e) => {
        //Validar o valor do campo NAME
        var name = document.querySelector("#name").value;
        // Verificar se o campo está vazio
        if (name === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert alert-danger'>Erro! Necessário preencher o campo NOME! (validação JS)</p>";
            return;
        }
        //Validar o valor do campo EMAIL
        var email = document.querySelector("#email").value;
        // Verificar se o campo está vazio
        if (email === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert alert-danger'>Erro! Necessário preencher o campo EMAIL! (validação JS)</p>";
            return;
        }
        //Validar o valor do campo USUÁRIO
        var user = document.querySelector("#user").value;
        // Verificar se o campo está vazio
        if (user === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert alert-danger'>Erro! Necessário preencher o campo Usuário! (validação JS)</p>";
            return;
        } else {
            document.getElementById("msg").innerHTML = "<p></p>";
            return;
        }
    });
}
// ================================================================================================
const formEditProfPass = document.getElementById("form-edit-prof-pass");
if (formEditProfPass) {
    formEditProfPass.addEventListener("submit", async (e) => {
        
        //Receber o valor do campo PASSWORD
        var password = document.querySelector("#password").value;
        // Verificar se o campo está vazio
        if (password === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert alert-danger'>Erro! Necessário preencher o campo SENHA! (validação JS)</p>";
            return;
        }
        // Verificar se o campo senha possui 6 caracteres
        if (password.length < 6) {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert alert-warning'>A Senha deve ter no minímo 6 caracteres! (validação JS)</p>";
            return;
        }
        // Verificar se o campo senha não possui numeros repetidos
        // PARA APRENDER MAIS SOBRE EXPRESSÕES REGULARES
        //https://developer.mozilla.org/pt-BR/docs/Web/JavaScript/Guide/Regular_Expressions
        if (password.match(/([1-9]+)\1{1,}/)) {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert alert-warning'>A Senha Não pode conter números repetidos! (validação JS)</p>";
            return;
        }
        // Verificar se o campo senha possui Letras
        if (!password.match(/[A-Za-z]/)) {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert alert-warning'>A Senha deve ter no minímo uma letra! (validação JS)</p>";
            return;
        } else {
            document.getElementById("msg").innerHTML = "<p></p>";
            return;
        }
    });
}
// ================================================================================================
// VALIDAÇÃO DO FORMULÁRIO DA VIEW:editUserImage
const formEditUserImg = document.getElementById("form-edit-user-img");
if (formEditUserImg) {
    formEditUserImg.addEventListener("submit", async (e) => {
        //Validar o valor do campo IMAGE
        var new_image = document.querySelector("#new_image").value;
        // Verificar se o campo está vazio
        if (new_image === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert alert-danger'>Erro! Necessário Selecionar uma imagem(user)! (validação JS)</p>";
            return;
        } else {
        document.getElementById("msg").innerHTML = "<p></p>";
        return;
    }
    });
}

// ================================================================================================
// VALIDAÇÃO DO FORMULÁRIO DA VIEW:editProfileImage
const formEditProfImg = document.getElementById("form-edit-prof-img");
if (formEditProfImg) {
    formEditProfImg.addEventListener("submit", async (e) => {
        //Validar o valor do campo IMAGE
        var new_image = document.querySelector("#new_image").value;
        // Verificar se o campo está vazio
        if (new_image === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert alert-danger'>Erro! Necessário Selecionar uma imagem! (validação JS)</p>";
            return;
        } else {
        document.getElementById("msg").innerHTML = "<p></p>";
        return;
    }
    });
}
/** ================================================================================================
 * Validar o Tipo da IMAGEM (JPG ou PNG)
 * @returns  */
function inputFileValImg(){
    var new_image = document.querySelector("#new_image");

    var filePath = new_image.value;
    var allowedExtension = /(\.jpg|\.jpeg|\.png)$/i;
    
    if(!allowedExtension.exec(filePath)){
        new_image.value = '';
        document.getElementById("msg").innerHTML = "<p class='alert alert-danger'>Erro! Necessário Selecionar uma imagem JPG ou PNG! (validação JS)</p>";
        return;
    } else {
        previewImage(new_image);
        document.getElementById("msg").innerHTML = "<p></p>";
        return;
    }
}
function previewImage(new_image){
    if((new_image.files) && (new_image.files[0])){
        // FileReader() - ler o conteúdo do arquivo
        var reader = new FileReader();
        //onload - dispar um evento quando qualquer elemento tenha sido carregado
        reader.onload = function(e){
            document.getElementById('preview-img').innerHTML = "<img src='"+ e.target.result +"' alt='Imagem' style='width: 200px;'>";
        }
    }
    //readAsDataURL - Retorna os dados do formato blob como uma URL de dados - blob representa um arquivo
    reader.readAsDataURL(new_image.files[0]);
}
// ===============================================================================================
// validar os campos do formulário de adicionar nova situação de usuário
const formAddSitsUsers = document.getElementById("form-add-sit-user");
if (formAddSitsUsers) {
    formAddSitsUsers.addEventListener("submit", async(e) => {
        //Receber o valor do campo Nova Situação
        var nameSits = document.querySelector("#name").value;
        // Verificar se o campo está vazio
        if (nameSits === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert alert-danger'>Erro! Necessário preencher o campo Nova situação! (validação JS)</p>";
            return;
        } 
        //Validar o valor do campo SITUAÇÃO do USUÁRIO
        var admsSitsCor = document.querySelector("#adms_color_id").value;
        // Verificar se o campo está vazio
        if (admsSitsCor === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert alert-danger'>Erro! Necessário Selecionar uma Cor para a Situação! (validação JS)</p>";
            return;
        } else {
            document.getElementById("msg").innerHTML = "<p></p>";
            return;
        }
    });
}
