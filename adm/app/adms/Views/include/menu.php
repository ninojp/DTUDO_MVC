<?php
if (!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')) {
    header("Location: https://localhost/dtudo/public/");
}
//cria uma variável:$sidebar_active. Verifica se contém valor no array:$this->data['sidebarActive'], se tiver coloca o valor na variável criada.
$sidebar_active = "";
if (isset($this->data['sidebarActive'])) {
    $sidebar_active = $this->data['sidebarActive'];
}
// <!-- Inicio do conteúdo da pagina ADM -->
echo "<main class='main_content'>";
// <!-- Inicio do SIDE-BAR -->
    echo "<div class='sidebar'>";

// Precisa EXISTIR:isset() e PRECISA ser TRUE(return=true)
// if ((isset($this->data['menu'])) and ($this->data['menu'])) {
//     foreach ($this->data['menu'] as $item_menu) {
//         // var_dump($item_menu);
//         extract($item_menu);

//         $active_item_menu = "";
//         if ($sidebar_active == $menu_controller) {
//             $active_item_menu = "active";
//         }
//         echo "<a href='" . URLADM . "$menu_controller/$menu_metodo' class='sidebar_nav $active_item_menu'><i class='icon $icon'></i><span>$name_page</span></a>";
//     }
// }

//Menu DropDown Dinâmico com os dados da tabela:adms_items_menus
if ((isset($this->data['menu'])) and ($this->data['menu'])) {
    $count_drop_start = 0;
    $count_drop_end = 0;
    foreach ($this->data['menu'] as $item_menu) {
        extract($item_menu);
        $active_item_menu = "";
        if ($sidebar_active == $menu_controller) {
            $active_item_menu = "active";
        }

        if ($dropdown == 1) {
            if ($count_drop_start != $id_itm_men) {
                //verifica se o $count_drop_end tem o valor 1, quer dizer q está aberto
                if (($count_drop_end == 1) and ($count_drop_start != 0)) {
                    echo "</div>";
                    $count_drop_end = 0;
                }
                //Imprime o MENU DropDown(nome) com o seu icone
                echo "<button class='dropdown_btn btn_active$id_itm_men'>";
                echo "<i class='icon $icon_itm_men'></i><span>$name_itm_men</span><i class='fa-solid fa-caret-down'></i>";
                echo "</button>";

                echo "<div class='dropdown_container cont_active$id_itm_men'>";
            }
            // Aqui imprime os itens do menu DropDown
            echo "<a href='" . URLADM . "$menu_controller/$menu_metodo' class='sidebar_nav active$id_itm_men $active_item_menu'><i class='icon_itens $icon'></i><span>$name_page</span></a>";

            $count_drop_start = $id_itm_men;
            $count_drop_end = 1;

        } else {
            // se o $count_drop_end tem o valor 1(está aberto), então deve ser fechado
            if ($count_drop_end == 1) {
                echo "</div>";
                $count_drop_end = 0;
            }
            // os itens que NÃO forem dropdown, são impressos por aqui
            echo "<a href='" . URLADM . "$menu_controller/$menu_metodo' class='sidebar_nav $active_item_menu'><i class='icon $icon'></i><span>$name_page</span></a>";
        }
    }
    if ($count_drop_end == 1) {
        echo "</div>";
        $count_drop_end = 0;
    }
}
echo "</div>";
// var_dump($this->data['menu']);
?>
<!-- FIM do SIDE-BAR -->