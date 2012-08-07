<?php

// Menu
define("EW_MENUBAR_CLASSNAME", "ewMenuBarVertical", TRUE);
define("EW_MENUBAR_ITEM_CLASSNAME", "", TRUE);
define("EW_MENUBAR_ITEM_LABEL_CLASSNAME", "", TRUE);
define("EW_MENU_CLASSNAME", "ewMenuBarVertical", TRUE);
define("EW_MENU_ITEM_CLASSNAME", "", TRUE);
define("EW_MENU_ITEM_LABEL_CLASSNAME", "", TRUE);
?>
<?php

// Menu Rendering event
function Menu_Rendering(&$Menu) {

	// Change menu items here
}

// MenuItem Adding event
function MenuItem_Adding(&$Item) {

	//var_dump($Item);
	// Return FALSE if menu item not allowed

	return TRUE;
}
?>
<!-- Begin Main Menu -->
<div class="phpmaker">
<?php

// Generate all menu items
$RootMenu = new cMenu("RootMenu");
$RootMenu->IsRoot = TRUE;
$RootMenu->AddMenuItem(3, $Language->MenuPhrase("3", "MenuText"), "concursolist.php", -1, "", IsLoggedIn(), FALSE);
$RootMenu->AddMenuItem(4, $Language->MenuPhrase("4", "MenuText"), "concurso_opcionlist.php", -1, "", IsLoggedIn(), FALSE);
$RootMenu->AddMenuItem(9, $Language->MenuPhrase("9", "MenuText"), "usuarioslist.php", -1, "", IsLoggedIn(), FALSE);
$RootMenu->AddMenuItem(-1, $Language->Phrase("Logout"), "logout.php", -1, "", IsLoggedIn());
$RootMenu->AddMenuItem(-1, $Language->Phrase("Login"), "login.php", -1, "", !IsLoggedIn() && substr(@$_SERVER["URL"], -1 * strlen("login.php")) <> "login.php");
$RootMenu->Render();
?>
</div>
<!-- End Main Menu -->
