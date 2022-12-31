// JavaScript - Criado no curoso CELKE PHPDelopment modulo layout do administrativo

//==================================================================================================
// Início do Dropdown Navbar
let varNotification=document.querySelector(".notification");
let varAvatar=document.querySelector(".avatar");
//pode ser escrito assim também
//let notification=document.querySelector(".notification"),avatar=document.querySelector(".avatar");

DropMenu(varAvatar);
DropMenu(varNotification);
//console.log(VarAvatar);

// Implementa ou remove a classe de ACTIVE, para exibir ou ocultar o bloco de codigo(html)
function DropMenu(seletor){
    // console.log(seletor);
    seletor.addEventListener("click", () => {
        //está pegando a classe (.dropdown_menu) e colocando numa variavel (VarDropdown)
        let varDropdown = seletor.querySelector(".dropdown_menu");
            // está verificando se a variavel (VarDropdown) tem o estado de ACTIVE, se tiver, quando clicar remove se não adiciona
        varDropdown.classList.contains("active") ? varDropdown.classList.remove("active") : varDropdown.classList.add("active");
    });
}

//====================================================================================================
// Início Sidebars Toggle / bars /
let varSidebar = document.querySelector(".sidebar");
let varBars = document.querySelector(".bars");
varBars.addEventListener("click", () => {
    varSidebar.classList.contains("active") ? varSidebar.classList.remove("active") : varSidebar.classList.add("active");
});
// deixa o menu aberto for maior que 768px
window.matchMedia("(max-width: 768px)").matches ? varSidebar.classList.remove("active") : varSidebar.classList.add("active");

//====================================================================================================
// INICIO do botão AÇÃO DropDrown do listar (vizualizar, editar, apagar) 
function actionDrop(id){
    closeDropAction();
    document.getElementById("actionDrop"+id).classList.toggle("show_drop_action");
}
window.onclick = function(event){
    if(!event.target.matches(".drop_btn_action")){
        // document.getElementById("actionDrop").classList.remove("show_drop_action");
    closeDropAction();
    }
}
//----------------------------------------------------------------------------------------------------
function closeDropAction(){
    var dropDowns = document.getElementsByClassName("drop_action_item");
    var i;
    for (i = 0; i < dropDowns.length; i++) {
       var openDropDown = dropDowns[i];
       if(openDropDown.classList.contains("show_drop_action")){
        openDropDown.classList.remove("show_drop_action");
       }
    }
}
// --------------------------------------------------------------------------------------------------
/* Inicio menu dropdown no sidebar */
var dropdownSidebar = document.getElementsByClassName("dropdown-btn");
var i;

for (i = 0; i < dropdownSidebar.length; i++) {
    dropdownSidebar[i].addEventListener("click", function () {
        this.classList.toggle("active");
        var dropdownContent = this.nextElementSibling;
        if (dropdownContent.style.display === "block") {
            dropdownContent.style.display = "none";
        } else {
            dropdownContent.style.display = "block";
        }
    });
}
/* Fim dropdown sidebar */
