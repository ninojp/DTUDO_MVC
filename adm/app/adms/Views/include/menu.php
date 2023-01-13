<?php
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
//cria uma variável:$sidebar_active. Verifica se contém valor no array:$this->data['sidebarActive'], se tiver coloca o valor na variável criada.
$sidebar_active = "";
if(isset($this->data['sidebarActive'])){
    $sidebar_active = $this->data['sidebarActive']; }
// <!-- Inicio do conteúdo da pagina ADM -->
echo "<main class='main_content'>";
    // <!-- Inicio do SIDE-BAR -->
    echo "<div class='sidebar'>";
        // Precisa EXISTIR:isset() e PRECISA ser TRUE(return=true)
        if((isset($this->data['menu'])) and ($this->data['menu'])) {
            foreach($this->data['menu'] as $item_menu){
                // var_dump($item_menu);
                extract($item_menu);

                $active_item_menu = "";
                if($sidebar_active == $menu_controller){
                    $active_item_menu = "active"; } 
                    echo "<a href='".URLADM."$menu_controller/$menu_metodo' class='sidebar_nav $active_item_menu'><i class='icon $icon'></i><span>$name_page</span></a>";
            }
        } 
    echo "</div>";
    // <!-- FIM do SIDE-BAR -->