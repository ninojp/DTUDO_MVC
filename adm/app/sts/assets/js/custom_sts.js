// ================================================================================================
// Validação DO FORMULÁRIO DA VIEW:editUserImage
const formEditUserImg = document.getElementById("form-edit-home-top-img");
if (formEditUserImg) {
    formEditUserImg.addEventListener("submit", async (e) => {
        //Validar o valor do campo IMAGE
        var new_image = document.querySelector("#new_image").value;
        // Verificar se o campo está vazio
        if (new_image === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert alert-danger'>Erro! Necessário Selecionar uma imagem(user)! (JS)</p>";
            return;
        } else {
        document.getElementById("msg").innerHTML = "<p></p>";
        return;
    }
    });
}

// // ================================================================================================
// // VALIDAÇÃO DO FORMULÁRIO DA VIEW:editProfileImage
// const formEditProfImg = document.getElementById("form-edit-prof-img");
// if (formEditProfImg) {
//     formEditProfImg.addEventListener("submit", async (e) => {
//         //Validar o valor do campo IMAGE
//         var new_image = document.querySelector("#new_image").value;
//         // Verificar se o campo está vazio
//         if (new_image === "") {
//             e.preventDefault();
//             document.getElementById("msg").innerHTML = "<p class='alert alert-danger'>Erro! Necessário Selecionar uma imagem! (JS)</p>";
//             return;
//         } else {
//         document.getElementById("msg").innerHTML = "<p></p>";
//         return;
//     }
//     });
// }
// /** ================================================================================================
//  * Validar o Tipo da IMAGEM (JPG ou PNG)
//  * @returns  */
// function inputFileValImg(){
//     var new_image = document.querySelector("#new_image");

//     var filePath = new_image.value;
//     var allowedExtension = /(\.jpg|\.jpeg|\.png)$/i;
    
//     if(!allowedExtension.exec(filePath)){
//         new_image.value = '';
//         document.getElementById("msg").innerHTML = "<p class='alert alert-danger'>Erro! Necessário Selecionar uma imagem JPG ou PNG! (JS)</p>";
//         return;
//     } else {
//         previewImage(new_image);
//         document.getElementById("msg").innerHTML = "<p></p>";
//         return;
//     }
// }
// function previewImage(new_image){
//     if((new_image.files) && (new_image.files[0])){
//         // FileReader() - ler o conteúdo do arquivo
//         var reader = new FileReader();
//         //onload - dispar um evento quando qualquer elemento tenha sido carregado
//         reader.onload = function(e){
//             document.getElementById('preview-img').innerHTML = "<img src='"+ e.target.result +"' alt='Imagem' style='width: 300px;'>";
//         }
//     }
//     //readAsDataURL - Retorna os dados do formato blob como uma URL de dados - blob representa um arquivo
//     reader.readAsDataURL(new_image.files[0]);
// }