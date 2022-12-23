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
    // Imprimir(Mostrar) a força da senha
    if(strength < 30){
        document.getElementById("msgViewStrength").innerHTML = "<p class='alert alert-danger'>Senha Fraca(JS)</p>";
    } else if ((strength >= 30) && (strength < 50)){
        document.getElementById("msgViewStrength").innerHTML = "<p class='alert alert-warning'>Senha Média(JS)</p>";
    } else if ((strength >= 50) && (strength < 70)){
        document.getElementById("msgViewStrength").innerHTML = "<p class='alert alert-primary'>Senha Boa(JS)</p>";
    } else if (strength >= 70){
        document.getElementById("msgViewStrength").innerHTML = "<p class='alert alert-success'>Senha Forte(JS)</p>";
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
            document.getElementById("msg").innerHTML = "<p class='alert alert-danger'>Erro! Necessário preencher o campo NOME! (JS)</p>";
            return;
        }
        //Receber o valor do campo EMAIL
        var email = document.querySelector("#email").value;
        // Verificar se o campo está vazio
        if (email === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert alert-danger'>Erro! Necessário preencher o campo EMAIL! (JS)</p>";
            return;
        }
        //Receber o valor do campo PASSWORD
        var password = document.querySelector("#password").value;
        // Verificar se o campo está vazio
        if (password === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert alert-danger'>Erro! Necessário preencher o campo SENHA! (JS)</p>";
            return;
        }
        // Verificar se o campo senha possui 6 caracteres
        if (password.length < 6) {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert alert-warning'>A Senha deve ter no minímo 6 caracteres! (JS)</p>";
            return;
        }
        // Verificar se o campo senha não possui numeros repetidos
        // PARA APRENDER MAIS SOBRE EXPRESSÕES REGULARES
        //https://developer.mozilla.org/pt-BR/docs/Web/JavaScript/Guide/Regular_Expressions
        if (password.match(/([1-9]+)\1{1,}/)) {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert alert-warning'>A Senha Não pode conter números repetidos! (JS)</p>";
            return;
        }
        // Verificar se o campo senha possui Letras
        if (!password.match(/[A-Za-z]/)) {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert alert-warning'>A Senha deve ter no minímo uma letra! (JS)</p>";
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
            document.getElementById("msg").innerHTML = "<p class='alert alert-danger'>Erro! Necessário preencher o campo USUÁRIO! (JS)</p>";
            return;
        }
        //Receber o valor do campo PASSWORD
        var password = document.querySelector("#password").value;
        // Verificar se o campo está vazio
        if (password === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert alert-danger'>Erro! Necessário preencher o campo SENHA! (JS)</p>";
            return;
        } else {
            document.getElementById("msg").innerHTML = "<p></p>";
            return;
        }
    });
}
// ===============================================================================================
// Formulário de E-mail confirmação de novo usuário
const formNewConfEmail = document.getElementById("form-new-conf-email");
if (formNewConfEmail) {
    formNewConfEmail.addEventListener("submit", async(e) => {
        //Receber o valor do campo EMAIL
        var email = document.querySelector("#email").value;
        // Verificar se o campo está vazio
        if (email === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert alert-danger'>Erro! Necessário preencher o campo EMAIL! (JS)</p>";
            return;
        } else {
            document.getElementById("msg").innerHTML = "<p></p>";
            return;
        }
    });
}
// ===============================================================================================
// Formulário de recuperação de senha do usuário
const formRecoverPass = document.getElementById("form-recover-pass");
if (formRecoverPass) {
    formRecoverPass.addEventListener("submit", async(e) => {
        //Receber o valor do campo EMAIL
        var email = document.querySelector("#email").value;
        // Verificar se o campo está vazio
        if (email === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert alert-danger'>Erro! Necessário preencher o campo EMAIL! (JS)</p>";
            return;
        } else {
            document.getElementById("msg").innerHTML = "<p></p>";
            return;
        }
    });
}
// ===============================================================================================
// Formulário de atualização da senha do usuário
const formUpdatePass = document.getElementById("form-update-pass");
if (formUpdatePass) {
    formUpdatePass.addEventListener("submit", async(e) => {
        //Receber o valor do campo Senha
        var senha = document.querySelector("#password").value;
        // Verificar se o campo está vazio
        if (senha === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert alert-warning'>Erro! Necessário preencher o campo Senha! (JS)</p>";
            return;
        } else {
            document.getElementById("msg").innerHTML = "<p></p>";
            return;
        }
    });
}