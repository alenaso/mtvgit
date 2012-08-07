<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "usuariosinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$usuarios_list = new cusuarios_list();
$Page =& $usuarios_list;

// Page init
$usuarios_list->Page_Init();

// Page main
$usuarios_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($usuarios->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var usuarios_list = new ew_Page("usuarios_list");

// page properties
usuarios_list.PageID = "list"; // page ID
usuarios_list.FormID = "fusuarioslist"; // form ID
var EW_PAGE_ID = usuarios_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
usuarios_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
usuarios_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
usuarios_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<?php if (($usuarios->Export == "") || (EW_EXPORT_MASTER_RECORD && $usuarios->Export == "print")) { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$usuarios_list->TotalRecs = $usuarios->SelectRecordCount();
	} else {
		if ($usuarios_list->Recordset = $usuarios_list->LoadRecordset())
			$usuarios_list->TotalRecs = $usuarios_list->Recordset->RecordCount();
	}
	$usuarios_list->StartRec = 1;
	if ($usuarios_list->DisplayRecs <= 0 || ($usuarios->Export <> "" && $usuarios->ExportAll)) // Display all records
		$usuarios_list->DisplayRecs = $usuarios_list->TotalRecs;
	if (!($usuarios->Export <> "" && $usuarios->ExportAll))
		$usuarios_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$usuarios_list->Recordset = $usuarios_list->LoadRecordset($usuarios_list->StartRec-1, $usuarios_list->DisplayRecs);
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $usuarios->TableCaption() ?>
&nbsp;&nbsp;<?php $usuarios_list->ExportOptions->Render("body"); ?>
</p>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($usuarios->Export == "" && $usuarios->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(usuarios_list);" style="text-decoration: none;"><img id="usuarios_list_SearchImage" src="phpimages/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="usuarios_list_SearchPanel">
<form name="fusuarioslistsrch" id="fusuarioslistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="usuarios">
<div class="ewBasicSearch">
<div id="xsr_1" class="ewCssTableRow">
	<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($usuarios->getSessionBasicSearchKeyword()) ?>">
	<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
	<a href="<?php echo $usuarios_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
</div>
<div id="xsr_2" class="ewCssTableRow">
	<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($usuarios->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($usuarios->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($usuarios->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label>
</div>
</div>
</form>
</div>
<?php } ?>
<?php } ?>
<?php $usuarios_list->ShowPageHeader(); ?>
<?php
$usuarios_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fusuarioslist" id="fusuarioslist" class="ewForm" action="" method="post">
<input type="hidden" name="t" id="t" value="usuarios">
<div id="gmp_usuarios" class="ewGridMiddlePanel">
<?php if ($usuarios_list->TotalRecs > 0) { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $usuarios->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$usuarios_list->RenderListOptions();

// Render list options (header, left)
$usuarios_list->ListOptions->Render("header", "left");
?>
<?php if ($usuarios->idUsuario->Visible) { // idUsuario ?>
	<?php if ($usuarios->SortUrl($usuarios->idUsuario) == "") { ?>
		<td><?php echo $usuarios->idUsuario->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $usuarios->SortUrl($usuarios->idUsuario) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $usuarios->idUsuario->FldCaption() ?></td><td style="width: 10px;"><?php if ($usuarios->idUsuario->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($usuarios->idUsuario->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($usuarios->nombre->Visible) { // nombre ?>
	<?php if ($usuarios->SortUrl($usuarios->nombre) == "") { ?>
		<td><?php echo $usuarios->nombre->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $usuarios->SortUrl($usuarios->nombre) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $usuarios->nombre->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($usuarios->nombre->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($usuarios->nombre->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($usuarios->apellido->Visible) { // apellido ?>
	<?php if ($usuarios->SortUrl($usuarios->apellido) == "") { ?>
		<td><?php echo $usuarios->apellido->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $usuarios->SortUrl($usuarios->apellido) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $usuarios->apellido->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($usuarios->apellido->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($usuarios->apellido->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($usuarios->nombreCompleto->Visible) { // nombreCompleto ?>
	<?php if ($usuarios->SortUrl($usuarios->nombreCompleto) == "") { ?>
		<td><?php echo $usuarios->nombreCompleto->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $usuarios->SortUrl($usuarios->nombreCompleto) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $usuarios->nombreCompleto->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($usuarios->nombreCompleto->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($usuarios->nombreCompleto->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($usuarios->nacimiento->Visible) { // nacimiento ?>
	<?php if ($usuarios->SortUrl($usuarios->nacimiento) == "") { ?>
		<td><?php echo $usuarios->nacimiento->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $usuarios->SortUrl($usuarios->nacimiento) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $usuarios->nacimiento->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($usuarios->nacimiento->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($usuarios->nacimiento->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($usuarios->lugar->Visible) { // lugar ?>
	<?php if ($usuarios->SortUrl($usuarios->lugar) == "") { ?>
		<td><?php echo $usuarios->lugar->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $usuarios->SortUrl($usuarios->lugar) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $usuarios->lugar->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($usuarios->lugar->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($usuarios->lugar->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($usuarios->facebookId->Visible) { // facebookId ?>
	<?php if ($usuarios->SortUrl($usuarios->facebookId) == "") { ?>
		<td><?php echo $usuarios->facebookId->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $usuarios->SortUrl($usuarios->facebookId) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $usuarios->facebookId->FldCaption() ?></td><td style="width: 10px;"><?php if ($usuarios->facebookId->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($usuarios->facebookId->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($usuarios->imagen->Visible) { // imagen ?>
	<?php if ($usuarios->SortUrl($usuarios->imagen) == "") { ?>
		<td><?php echo $usuarios->imagen->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $usuarios->SortUrl($usuarios->imagen) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $usuarios->imagen->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($usuarios->imagen->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($usuarios->imagen->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($usuarios->sexo->Visible) { // sexo ?>
	<?php if ($usuarios->SortUrl($usuarios->sexo) == "") { ?>
		<td><?php echo $usuarios->sexo->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $usuarios->SortUrl($usuarios->sexo) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $usuarios->sexo->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($usuarios->sexo->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($usuarios->sexo->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($usuarios->zemail->Visible) { // email ?>
	<?php if ($usuarios->SortUrl($usuarios->zemail) == "") { ?>
		<td><?php echo $usuarios->zemail->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $usuarios->SortUrl($usuarios->zemail) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $usuarios->zemail->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($usuarios->zemail->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($usuarios->zemail->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($usuarios->fechaAlta->Visible) { // fechaAlta ?>
	<?php if ($usuarios->SortUrl($usuarios->fechaAlta) == "") { ?>
		<td><?php echo $usuarios->fechaAlta->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $usuarios->SortUrl($usuarios->fechaAlta) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $usuarios->fechaAlta->FldCaption() ?></td><td style="width: 10px;"><?php if ($usuarios->fechaAlta->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($usuarios->fechaAlta->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($usuarios->IP->Visible) { // IP ?>
	<?php if ($usuarios->SortUrl($usuarios->IP) == "") { ?>
		<td><?php echo $usuarios->IP->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $usuarios->SortUrl($usuarios->IP) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $usuarios->IP->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($usuarios->IP->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($usuarios->IP->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$usuarios_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($usuarios->ExportAll && $usuarios->Export <> "") {
	$usuarios_list->StopRec = $usuarios_list->TotalRecs;
} else {

	// Set the last record to display
	if ($usuarios_list->TotalRecs > $usuarios_list->StartRec + $usuarios_list->DisplayRecs - 1)
		$usuarios_list->StopRec = $usuarios_list->StartRec + $usuarios_list->DisplayRecs - 1;
	else
		$usuarios_list->StopRec = $usuarios_list->TotalRecs;
}
$usuarios_list->RecCnt = $usuarios_list->StartRec - 1;
if ($usuarios_list->Recordset && !$usuarios_list->Recordset->EOF) {
	$usuarios_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $usuarios_list->StartRec > 1)
		$usuarios_list->Recordset->Move($usuarios_list->StartRec - 1);
} elseif (!$usuarios->AllowAddDeleteRow && $usuarios_list->StopRec == 0) {
	$usuarios_list->StopRec = $usuarios->GridAddRowCount;
}

// Initialize aggregate
$usuarios->RowType = EW_ROWTYPE_AGGREGATEINIT;
$usuarios->ResetAttrs();
$usuarios_list->RenderRow();
$usuarios_list->RowCnt = 0;
while ($usuarios_list->RecCnt < $usuarios_list->StopRec) {
	$usuarios_list->RecCnt++;
	if (intval($usuarios_list->RecCnt) >= intval($usuarios_list->StartRec)) {
		$usuarios_list->RowCnt++;

		// Set up key count
		$usuarios_list->KeyCount = $usuarios_list->RowIndex;

		// Init row class and style
		$usuarios->ResetAttrs();
		$usuarios->CssClass = "";
		if ($usuarios->CurrentAction == "gridadd") {
		} else {
			$usuarios_list->LoadRowValues($usuarios_list->Recordset); // Load row values
		}
		$usuarios->RowType = EW_ROWTYPE_VIEW; // Render view
		$usuarios->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');

		// Render row
		$usuarios_list->RenderRow();

		// Render list options
		$usuarios_list->RenderListOptions();
?>
	<tr<?php echo $usuarios->RowAttributes() ?>>
<?php

// Render list options (body, left)
$usuarios_list->ListOptions->Render("body", "left");
?>
	<?php if ($usuarios->idUsuario->Visible) { // idUsuario ?>
		<td<?php echo $usuarios->idUsuario->CellAttributes() ?>>
<div<?php echo $usuarios->idUsuario->ViewAttributes() ?>><?php echo $usuarios->idUsuario->ListViewValue() ?></div>
<a name="<?php echo $usuarios_list->PageObjName . "_row_" . $usuarios_list->RowCnt ?>" id="<?php echo $usuarios_list->PageObjName . "_row_" . $usuarios_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($usuarios->nombre->Visible) { // nombre ?>
		<td<?php echo $usuarios->nombre->CellAttributes() ?>>
<div<?php echo $usuarios->nombre->ViewAttributes() ?>><?php echo $usuarios->nombre->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($usuarios->apellido->Visible) { // apellido ?>
		<td<?php echo $usuarios->apellido->CellAttributes() ?>>
<div<?php echo $usuarios->apellido->ViewAttributes() ?>><?php echo $usuarios->apellido->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($usuarios->nombreCompleto->Visible) { // nombreCompleto ?>
		<td<?php echo $usuarios->nombreCompleto->CellAttributes() ?>>
<div<?php echo $usuarios->nombreCompleto->ViewAttributes() ?>><?php echo $usuarios->nombreCompleto->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($usuarios->nacimiento->Visible) { // nacimiento ?>
		<td<?php echo $usuarios->nacimiento->CellAttributes() ?>>
<div<?php echo $usuarios->nacimiento->ViewAttributes() ?>><?php echo $usuarios->nacimiento->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($usuarios->lugar->Visible) { // lugar ?>
		<td<?php echo $usuarios->lugar->CellAttributes() ?>>
<div<?php echo $usuarios->lugar->ViewAttributes() ?>><?php echo $usuarios->lugar->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($usuarios->facebookId->Visible) { // facebookId ?>
		<td<?php echo $usuarios->facebookId->CellAttributes() ?>>
<div<?php echo $usuarios->facebookId->ViewAttributes() ?>><?php echo $usuarios->facebookId->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($usuarios->imagen->Visible) { // imagen ?>
		<td<?php echo $usuarios->imagen->CellAttributes() ?>>
<?php if (!ew_EmptyStr($usuarios->imagen->ListViewValue())) { ?><img src="<?php echo $usuarios->imagen->ListViewValue() ?>" border="0"<?php echo $usuarios->imagen->ViewAttributes() ?>><?php } ?>
</td>
	<?php } ?>
	<?php if ($usuarios->sexo->Visible) { // sexo ?>
		<td<?php echo $usuarios->sexo->CellAttributes() ?>>
<div<?php echo $usuarios->sexo->ViewAttributes() ?>><?php echo $usuarios->sexo->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($usuarios->zemail->Visible) { // email ?>
		<td<?php echo $usuarios->zemail->CellAttributes() ?>>
<div<?php echo $usuarios->zemail->ViewAttributes() ?>><?php echo $usuarios->zemail->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($usuarios->fechaAlta->Visible) { // fechaAlta ?>
		<td<?php echo $usuarios->fechaAlta->CellAttributes() ?>>
<div<?php echo $usuarios->fechaAlta->ViewAttributes() ?>><?php echo $usuarios->fechaAlta->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($usuarios->IP->Visible) { // IP ?>
		<td<?php echo $usuarios->IP->CellAttributes() ?>>
<div<?php echo $usuarios->IP->ViewAttributes() ?>><?php echo $usuarios->IP->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$usuarios_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($usuarios->CurrentAction <> "gridadd")
		$usuarios_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($usuarios_list->Recordset)
	$usuarios_list->Recordset->Close();
?>
<?php if ($usuarios->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($usuarios->CurrentAction <> "gridadd" && $usuarios->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($usuarios_list->Pager)) $usuarios_list->Pager = new cPrevNextPager($usuarios_list->StartRec, $usuarios_list->DisplayRecs, $usuarios_list->TotalRecs) ?>
<?php if ($usuarios_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($usuarios_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $usuarios_list->PageUrl() ?>start=<?php echo $usuarios_list->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($usuarios_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $usuarios_list->PageUrl() ?>start=<?php echo $usuarios_list->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $usuarios_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($usuarios_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $usuarios_list->PageUrl() ?>start=<?php echo $usuarios_list->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($usuarios_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $usuarios_list->PageUrl() ?>start=<?php echo $usuarios_list->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $usuarios_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $usuarios_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $usuarios_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $usuarios_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($usuarios_list->SearchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
</span>
</div>
<?php } ?>
</td></tr></table>
<?php if ($usuarios->Export == "" && $usuarios->CurrentAction == "") { ?>
<?php } ?>
<?php
$usuarios_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($usuarios->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$usuarios_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cusuarios_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'usuarios';

	// Page object name
	var $PageObjName = 'usuarios_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $usuarios;
		if ($usuarios->UseTokenInUrl) $PageUrl .= "t=" . $usuarios->TableVar . "&"; // Add page token
		return $PageUrl;
	}

	// Page URLs
	var $AddUrl;
	var $EditUrl;
	var $CopyUrl;
	var $DeleteUrl;
	var $ViewUrl;
	var $ListUrl;

	// Export URLs
	var $ExportPrintUrl;
	var $ExportHtmlUrl;
	var $ExportExcelUrl;
	var $ExportWordUrl;
	var $ExportXmlUrl;
	var $ExportCsvUrl;
	var $ExportPdfUrl;

	// Update URLs
	var $InlineAddUrl;
	var $InlineCopyUrl;
	var $InlineEditUrl;
	var $GridAddUrl;
	var $GridEditUrl;
	var $MultiDeleteUrl;
	var $MultiUpdateUrl;

	// Message
	function getMessage() {
		return @$_SESSION[EW_SESSION_MESSAGE];
	}

	function setMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_MESSAGE], $v);
	}

	function getFailureMessage() {
		return @$_SESSION[EW_SESSION_FAILURE_MESSAGE];
	}

	function setFailureMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_FAILURE_MESSAGE], $v);
	}

	function getSuccessMessage() {
		return @$_SESSION[EW_SESSION_SUCCESS_MESSAGE];
	}

	function setSuccessMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_SUCCESS_MESSAGE], $v);
	}

	// Show message
	function ShowMessage() {
		$sMessage = $this->getMessage();
		$this->Message_Showing($sMessage, "");
		if ($sMessage <> "") { // Message in Session, display
			echo "<p class=\"ewMessage\">" . $sMessage . "</p>";
			$_SESSION[EW_SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$sSuccessMessage = $this->getSuccessMessage();
		$this->Message_Showing($sSuccessMessage, "success");
		if ($sSuccessMessage <> "") { // Message in Session, display
			echo "<p class=\"ewSuccessMessage\">" . $sSuccessMessage . "</p>";
			$_SESSION[EW_SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$sErrorMessage = $this->getFailureMessage();
		$this->Message_Showing($sErrorMessage, "failure");
		if ($sErrorMessage <> "") { // Message in Session, display
			echo "<p class=\"ewErrorMessage\">" . $sErrorMessage . "</p>";
			$_SESSION[EW_SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
	}
	var $PageHeader;
	var $PageFooter;

	// Show Page Header
	function ShowPageHeader() {
		$sHeader = $this->PageHeader;
		$this->Page_DataRendering($sHeader);
		if ($sHeader <> "") { // Header exists, display
			echo "<p class=\"phpmaker\">" . $sHeader . "</p>";
		}
	}

	// Show Page Footer
	function ShowPageFooter() {
		$sFooter = $this->PageFooter;
		$this->Page_DataRendered($sFooter);
		if ($sFooter <> "") { // Fotoer exists, display
			echo "<p class=\"phpmaker\">" . $sFooter . "</p>";
		}
	}

	// Validate page request
	function IsPageRequest() {
		global $objForm, $usuarios;
		if ($usuarios->UseTokenInUrl) {
			if ($objForm)
				return ($usuarios->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($usuarios->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cusuarios_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (usuarios)
		if (!isset($GLOBALS["usuarios"])) {
			$GLOBALS["usuarios"] = new cusuarios();
			$GLOBALS["Table"] =& $GLOBALS["usuarios"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "usuariosadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "usuariosdelete.php";
		$this->MultiUpdateUrl = "usuariosupdate.php";

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'usuarios', TRUE);

		// Start timer
		if (!isset($GLOBALS["gTimer"])) $GLOBALS["gTimer"] = new cTimer();

		// Open connection
		if (!isset($conn)) $conn = ew_Connect();

		// List options
		$this->ListOptions = new cListOptions();

		// Export options
		$this->ExportOptions = new cListOptions();
		$this->ExportOptions->Tag = "span";
		$this->ExportOptions->Separator = "&nbsp;&nbsp;";
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $UserProfile, $Language, $Security, $objForm;
		global $usuarios;

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}

		// Get export parameters
		if (@$_GET["export"] <> "") {
			$usuarios->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$usuarios->Export = $_POST["exporttype"];
		} else {
			$usuarios->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $usuarios->Export; // Get export parameter, used in header
		$gsExportFile = $usuarios->TableVar; // Get export file, used in header
		$Charset = (EW_CHARSET <> "") ? ";charset=" . EW_CHARSET : ""; // Charset used in header
		if ($usuarios->Export == "excel") {
			header('Content-Type: application/vnd.ms-excel' . $Charset);
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
		}
		if ($usuarios->Export == "csv") {
			header('Content-Type: application/csv' . $Charset);
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.csv');
		}

		// Get grid add count
		$gridaddcnt = @$_GET[EW_TABLE_GRID_ADD_ROW_COUNT];
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$usuarios->GridAddRowCount = $gridaddcnt;

		// Set up list options
		$this->SetupListOptions();

		// Setup export options
		$this->SetupExportOptions();

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();
	}

	//
	// Page_Terminate
	//
	function Page_Terminate($url = "") {
		global $conn;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();
		$this->Page_Redirecting($url);

		 // Close connection
		$conn->Close();

		// Go to URL if specified
		if ($url <> "") {
			if (!EW_DEBUG_ENABLED && ob_get_length())
				ob_end_clean();
			header("Location: " . $url);
		}
		exit();
	}

	// Class variables
	var $ListOptions; // List options
	var $ExportOptions; // Export options
	var $DisplayRecs = 20;
	var $StartRec;
	var $StopRec;
	var $TotalRecs = 0;
	var $RecRange = 10;
	var $SearchWhere = ""; // Search WHERE clause
	var $RecCnt = 0; // Record count
	var $EditRowCnt;
	var $RowCnt;
	var $RowIndex = 0; // Row index
	var $KeyCount = 0; // Key count
	var $RowAction = ""; // Row action
	var $RowOldKey = ""; // Row old key (for copy)
	var $RecPerRow = 0;
	var $ColCnt = 0;
	var $DbMasterFilter = ""; // Master filter
	var $DbDetailFilter = ""; // Detail filter
	var $MasterRecordExists;	
	var $MultiSelectKey;
	var $RestoreSearch;
	var $Recordset;
	var $OldRecordset;

	//
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $usuarios;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		if ($this->IsPageRequest()) { // Validate request

			// Handle reset command
			$this->ResetCmd();

			// Hide all options
			if ($usuarios->Export <> "" ||
				$usuarios->CurrentAction == "gridadd" ||
				$usuarios->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ExportOptions->HideAllOptions();
			}

			// Get basic search values
			$this->LoadBasicSearchValues();

			// Restore search parms from Session
			$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$usuarios->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($usuarios->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $usuarios->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		ew_AddFilter($this->SearchWhere, $sSrchAdvanced);
		ew_AddFilter($this->SearchWhere, $sSrchBasic);

		// Call Recordset_Searching event
		$usuarios->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->SearchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$usuarios->setSearchWhere($this->SearchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->StartRec = 1; // Reset start record counter
				$usuarios->setStartRecordNumber($this->StartRec);
			}
		} else {
			$this->SearchWhere = $usuarios->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Set up filter in session
		$usuarios->setSessionWhere($sFilter);
		$usuarios->CurrentFilter = "";

		// Export data only
		if (in_array($usuarios->Export, array("html","word","excel","xml","csv","email","pdf"))) {
			$this->ExportData();
			if ($usuarios->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $usuarios;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $usuarios->nombre, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $usuarios->apellido, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $usuarios->nombreCompleto, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $usuarios->nacimiento, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $usuarios->lugar, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $usuarios->imagen, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $usuarios->sexo, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $usuarios->zemail, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $usuarios->IP, $Keyword);
		return $sWhere;
	}

	// Build basic search SQL
	function BuildBasicSearchSql(&$Where, &$Fld, $Keyword) {
		$sFldExpression = ($Fld->FldVirtualExpression <> "") ? $Fld->FldVirtualExpression : $Fld->FldExpression;
		$lFldDataType = ($Fld->FldIsVirtual) ? EW_DATATYPE_STRING : $Fld->FldDataType;
		if ($lFldDataType == EW_DATATYPE_NUMBER) {
			$sWrk = $sFldExpression . " = " . ew_QuotedValue($Keyword, $lFldDataType);
		} else {
			$sWrk = $sFldExpression . ew_Like(ew_QuotedValue("%" . $Keyword . "%", $lFldDataType));
		}
		if ($Where <> "") $Where .= " OR ";
		$Where .= $sWrk;
	}

	// Return basic search WHERE clause based on search keyword and type
	function BasicSearchWhere() {
		global $Security, $usuarios;
		$sSearchStr = "";
		$sSearchKeyword = $usuarios->BasicSearchKeyword;
		$sSearchType = $usuarios->BasicSearchType;
		if ($sSearchKeyword <> "") {
			$sSearch = trim($sSearchKeyword);
			if ($sSearchType <> "") {
				while (strpos($sSearch, "  ") !== FALSE)
					$sSearch = str_replace("  ", " ", $sSearch);
				$arKeyword = explode(" ", trim($sSearch));
				foreach ($arKeyword as $sKeyword) {
					if ($sSearchStr <> "") $sSearchStr .= " " . $sSearchType . " ";
					$sSearchStr .= "(" . $this->BasicSearchSQL($sKeyword) . ")";
				}
			} else {
				$sSearchStr = $this->BasicSearchSQL($sSearch);
			}
		}
		if ($sSearchKeyword <> "") {
			$usuarios->setSessionBasicSearchKeyword($sSearchKeyword);
			$usuarios->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $usuarios;

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$usuarios->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $usuarios;
		$usuarios->setSessionBasicSearchKeyword("");
		$usuarios->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $usuarios;
		$bRestore = TRUE;
		if ($usuarios->BasicSearchKeyword <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$usuarios->BasicSearchKeyword = $usuarios->getSessionBasicSearchKeyword();
			$usuarios->BasicSearchType = $usuarios->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $usuarios;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$usuarios->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$usuarios->CurrentOrderType = @$_GET["ordertype"];
			$usuarios->UpdateSort($usuarios->idUsuario); // idUsuario
			$usuarios->UpdateSort($usuarios->nombre); // nombre
			$usuarios->UpdateSort($usuarios->apellido); // apellido
			$usuarios->UpdateSort($usuarios->nombreCompleto); // nombreCompleto
			$usuarios->UpdateSort($usuarios->nacimiento); // nacimiento
			$usuarios->UpdateSort($usuarios->lugar); // lugar
			$usuarios->UpdateSort($usuarios->facebookId); // facebookId
			$usuarios->UpdateSort($usuarios->imagen); // imagen
			$usuarios->UpdateSort($usuarios->sexo); // sexo
			$usuarios->UpdateSort($usuarios->zemail); // email
			$usuarios->UpdateSort($usuarios->fechaAlta); // fechaAlta
			$usuarios->UpdateSort($usuarios->IP); // IP
			$usuarios->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $usuarios;
		$sOrderBy = $usuarios->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($usuarios->SqlOrderBy() <> "") {
				$sOrderBy = $usuarios->SqlOrderBy();
				$usuarios->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $usuarios;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$usuarios->setSessionOrderBy($sOrderBy);
				$usuarios->idUsuario->setSort("");
				$usuarios->nombre->setSort("");
				$usuarios->apellido->setSort("");
				$usuarios->nombreCompleto->setSort("");
				$usuarios->nacimiento->setSort("");
				$usuarios->lugar->setSort("");
				$usuarios->facebookId->setSort("");
				$usuarios->imagen->setSort("");
				$usuarios->sexo->setSort("");
				$usuarios->zemail->setSort("");
				$usuarios->fechaAlta->setSort("");
				$usuarios->IP->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$usuarios->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $usuarios;

		// "view"
		$item =& $this->ListOptions->Add("view");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->IsLoggedIn();
		$item->OnLeft = FALSE;

		// "delete"
		$item =& $this->ListOptions->Add("delete");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->IsLoggedIn();
		$item->OnLeft = FALSE;

		// Call ListOptions_Load event
		$this->ListOptions_Load();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $usuarios, $objForm;
		$this->ListOptions->LoadDefault();

		// "view"
		$oListOpt =& $this->ListOptions->Items["view"];
		if ($Security->IsLoggedIn() && $oListOpt->Visible)
			$oListOpt->Body = "<a class=\"ewRowLink\" href=\"" . $this->ViewUrl . "\">" . $Language->Phrase("ViewLink") . "</a>";

		// "delete"
		$oListOpt =& $this->ListOptions->Items["delete"];
		if ($Security->IsLoggedIn() && $oListOpt->Visible)
			$oListOpt->Body = "<a class=\"ewRowLink\"" . "" . " href=\"" . $this->DeleteUrl . "\">" . $Language->Phrase("DeleteLink") . "</a>";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $usuarios;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $usuarios;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$usuarios->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$usuarios->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $usuarios->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$usuarios->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$usuarios->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$usuarios->setStartRecordNumber($this->StartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $usuarios;
		$usuarios->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$usuarios->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $usuarios;

		// Call Recordset Selecting event
		$usuarios->Recordset_Selecting($usuarios->CurrentFilter);

		// Load List page SQL
		$sSql = $usuarios->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$usuarios->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $usuarios;
		$sFilter = $usuarios->KeyFilter();

		// Call Row Selecting event
		$usuarios->Row_Selecting($sFilter);

		// Load SQL based on filter
		$usuarios->CurrentFilter = $sFilter;
		$sSql = $usuarios->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $usuarios;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$usuarios->Row_Selected($row);
		$usuarios->idUsuario->setDbValue($rs->fields('idUsuario'));
		$usuarios->nombre->setDbValue($rs->fields('nombre'));
		$usuarios->apellido->setDbValue($rs->fields('apellido'));
		$usuarios->nombreCompleto->setDbValue($rs->fields('nombreCompleto'));
		$usuarios->nacimiento->setDbValue($rs->fields('nacimiento'));
		$usuarios->lugar->setDbValue($rs->fields('lugar'));
		$usuarios->facebookId->setDbValue($rs->fields('facebookId'));
		$usuarios->imagen->setDbValue($rs->fields('imagen'));
		$usuarios->sexo->setDbValue($rs->fields('sexo'));
		$usuarios->zemail->setDbValue($rs->fields('email'));
		$usuarios->fechaAlta->setDbValue($rs->fields('fechaAlta'));
		$usuarios->IP->setDbValue($rs->fields('IP'));
	}

	// Load old record
	function LoadOldRecord() {
		global $usuarios;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($usuarios->getKey("idUsuario")) <> "")
			$usuarios->idUsuario->CurrentValue = $usuarios->getKey("idUsuario"); // idUsuario
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$usuarios->CurrentFilter = $usuarios->KeyFilter();
			$sSql = $usuarios->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $usuarios;

		// Initialize URLs
		$this->ViewUrl = $usuarios->ViewUrl();
		$this->EditUrl = $usuarios->EditUrl();
		$this->InlineEditUrl = $usuarios->InlineEditUrl();
		$this->CopyUrl = $usuarios->CopyUrl();
		$this->InlineCopyUrl = $usuarios->InlineCopyUrl();
		$this->DeleteUrl = $usuarios->DeleteUrl();

		// Call Row_Rendering event
		$usuarios->Row_Rendering();

		// Common render codes for all row types
		// idUsuario
		// nombre
		// apellido
		// nombreCompleto
		// nacimiento
		// lugar
		// facebookId
		// imagen
		// sexo
		// email
		// fechaAlta
		// IP

		if ($usuarios->RowType == EW_ROWTYPE_VIEW) { // View row

			// idUsuario
			$usuarios->idUsuario->ViewValue = $usuarios->idUsuario->CurrentValue;
			$usuarios->idUsuario->ViewCustomAttributes = "";

			// nombre
			$usuarios->nombre->ViewValue = $usuarios->nombre->CurrentValue;
			$usuarios->nombre->ViewCustomAttributes = "";

			// apellido
			$usuarios->apellido->ViewValue = $usuarios->apellido->CurrentValue;
			$usuarios->apellido->ViewCustomAttributes = "";

			// nombreCompleto
			$usuarios->nombreCompleto->ViewValue = $usuarios->nombreCompleto->CurrentValue;
			$usuarios->nombreCompleto->ViewCustomAttributes = "";

			// nacimiento
			$usuarios->nacimiento->ViewValue = $usuarios->nacimiento->CurrentValue;
			$usuarios->nacimiento->ViewCustomAttributes = "";

			// lugar
			$usuarios->lugar->ViewValue = $usuarios->lugar->CurrentValue;
			$usuarios->lugar->ViewCustomAttributes = "";

			// facebookId
			$usuarios->facebookId->ViewValue = $usuarios->facebookId->CurrentValue;
			$usuarios->facebookId->ViewCustomAttributes = "";

			// imagen
			$usuarios->imagen->ViewValue = $usuarios->imagen->CurrentValue;
			$usuarios->imagen->ImageWidth = 70;
			$usuarios->imagen->ImageHeight = 70;
			$usuarios->imagen->ImageAlt = $usuarios->imagen->FldAlt();
			$usuarios->imagen->ViewCustomAttributes = "";

			// sexo
			$usuarios->sexo->ViewValue = $usuarios->sexo->CurrentValue;
			$usuarios->sexo->ViewCustomAttributes = "";

			// email
			$usuarios->zemail->ViewValue = $usuarios->zemail->CurrentValue;
			$usuarios->zemail->ViewCustomAttributes = "";

			// fechaAlta
			$usuarios->fechaAlta->ViewValue = $usuarios->fechaAlta->CurrentValue;
			$usuarios->fechaAlta->ViewValue = ew_FormatDateTime($usuarios->fechaAlta->ViewValue, 5);
			$usuarios->fechaAlta->ViewCustomAttributes = "";

			// IP
			$usuarios->IP->ViewValue = $usuarios->IP->CurrentValue;
			$usuarios->IP->ViewCustomAttributes = "";

			// idUsuario
			$usuarios->idUsuario->LinkCustomAttributes = "";
			$usuarios->idUsuario->HrefValue = "";
			$usuarios->idUsuario->TooltipValue = "";

			// nombre
			$usuarios->nombre->LinkCustomAttributes = "";
			$usuarios->nombre->HrefValue = "";
			$usuarios->nombre->TooltipValue = "";

			// apellido
			$usuarios->apellido->LinkCustomAttributes = "";
			$usuarios->apellido->HrefValue = "";
			$usuarios->apellido->TooltipValue = "";

			// nombreCompleto
			$usuarios->nombreCompleto->LinkCustomAttributes = "";
			$usuarios->nombreCompleto->HrefValue = "";
			$usuarios->nombreCompleto->TooltipValue = "";

			// nacimiento
			$usuarios->nacimiento->LinkCustomAttributes = "";
			$usuarios->nacimiento->HrefValue = "";
			$usuarios->nacimiento->TooltipValue = "";

			// lugar
			$usuarios->lugar->LinkCustomAttributes = "";
			$usuarios->lugar->HrefValue = "";
			$usuarios->lugar->TooltipValue = "";

			// facebookId
			$usuarios->facebookId->LinkCustomAttributes = "";
			$usuarios->facebookId->HrefValue = "";
			$usuarios->facebookId->TooltipValue = "";

			// imagen
			$usuarios->imagen->LinkCustomAttributes = "";
			$usuarios->imagen->HrefValue = "";
			$usuarios->imagen->TooltipValue = "";

			// sexo
			$usuarios->sexo->LinkCustomAttributes = "";
			$usuarios->sexo->HrefValue = "";
			$usuarios->sexo->TooltipValue = "";

			// email
			$usuarios->zemail->LinkCustomAttributes = "";
			$usuarios->zemail->HrefValue = "";
			$usuarios->zemail->TooltipValue = "";

			// fechaAlta
			$usuarios->fechaAlta->LinkCustomAttributes = "";
			$usuarios->fechaAlta->HrefValue = "";
			$usuarios->fechaAlta->TooltipValue = "";

			// IP
			$usuarios->IP->LinkCustomAttributes = "";
			$usuarios->IP->HrefValue = "";
			$usuarios->IP->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($usuarios->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$usuarios->Row_Rendered();
	}

	// Set up export options
	function SetupExportOptions() {
		global $Language, $usuarios;

		// Printer friendly
		$item =& $this->ExportOptions->Add("print");
		$item->Body = "<a href=\"" . $this->ExportPrintUrl . "\">" . $Language->Phrase("PrinterFriendly") . "</a>";
		$item->Visible = FALSE;

		// Export to Excel
		$item =& $this->ExportOptions->Add("excel");
		$item->Body = "<a href=\"" . $this->ExportExcelUrl . "\">" . $Language->Phrase("ExportToExcel") . "</a>";
		$item->Visible = TRUE;

		// Export to Word
		$item =& $this->ExportOptions->Add("word");
		$item->Body = "<a href=\"" . $this->ExportWordUrl . "\">" . $Language->Phrase("ExportToWord") . "</a>";
		$item->Visible = FALSE;

		// Export to Html
		$item =& $this->ExportOptions->Add("html");
		$item->Body = "<a href=\"" . $this->ExportHtmlUrl . "\">" . $Language->Phrase("ExportToHtml") . "</a>";
		$item->Visible = FALSE;

		// Export to Xml
		$item =& $this->ExportOptions->Add("xml");
		$item->Body = "<a href=\"" . $this->ExportXmlUrl . "\">" . $Language->Phrase("ExportToXml") . "</a>";
		$item->Visible = FALSE;

		// Export to Csv
		$item =& $this->ExportOptions->Add("csv");
		$item->Body = "<a href=\"" . $this->ExportCsvUrl . "\">" . $Language->Phrase("ExportToCsv") . "</a>";
		$item->Visible = TRUE;

		// Export to Pdf
		$item =& $this->ExportOptions->Add("pdf");
		$item->Body = "<a href=\"" . $this->ExportPdfUrl . "\">" . $Language->Phrase("ExportToPDF") . "</a>";
		$item->Visible = FALSE;

		// Export to Email
		$item =& $this->ExportOptions->Add("email");
		$item->Body = "<a name=\"emf_usuarios\" id=\"emf_usuarios\" href=\"javascript:void(0);\" onclick=\"ew_EmailDialogShow({lnk:'emf_usuarios',hdr:ewLanguage.Phrase('ExportToEmail'),f:document.fusuarioslist,sel:false});\">" . $Language->Phrase("ExportToEmail") . "</a>";
		$item->Visible = FALSE;

		// Hide options for export/action
		if ($usuarios->Export <> "" ||
			$usuarios->CurrentAction <> "")
			$this->ExportOptions->HideAllOptions();
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email/PDF format
	function ExportData() {
		global $usuarios;
		$utf8 = (strtolower(EW_CHARSET) == "utf-8");
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->TotalRecs = $usuarios->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->TotalRecs = $rs->RecordCount();
		}
		$this->StartRec = 1;

		// Export all
		if ($usuarios->ExportAll) {
			$this->DisplayRecs = $this->TotalRecs;
			$this->StopRec = $this->TotalRecs;
		} else { // Export one page only
			$this->SetUpStartRec(); // Set up start record position

			// Set the last record to display
			if ($this->DisplayRecs < 0) {
				$this->StopRec = $this->TotalRecs;
			} else {
				$this->StopRec = $this->StartRec + $this->DisplayRecs - 1;
			}
		}
		if ($bSelectLimit)
			$rs = $this->LoadRecordset($this->StartRec-1, $this->DisplayRecs);
		if (!$rs) {
			header("Content-Type:"); // Remove header
			header("Content-Disposition:");
			$this->ShowMessage();
			return;
		}
		if ($usuarios->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
		} else {
			$ExportDoc = new cExportDocument($usuarios, "h");
		}
		$ParentTable = "";
		if ($bSelectLimit) {
			$StartRec = 1;
			$StopRec = $this->DisplayRecs;
		} else {
			$StartRec = $this->StartRec;
			$StopRec = $this->StopRec;
		}
		if ($usuarios->Export == "xml") {
			$usuarios->ExportXmlDocument($XmlDoc, ($ParentTable <> ""), $rs, $StartRec, $StopRec, "");
		} else {
			$sHeader = $this->PageHeader;
			$this->Page_DataRendering($sHeader);
			$ExportDoc->Text .= $sHeader;
			$usuarios->ExportDocument($ExportDoc, $rs, $StartRec, $StopRec, "");
			$sFooter = $this->PageFooter;
			$this->Page_DataRendered($sFooter);
			$ExportDoc->Text .= $sFooter;
		}

		// Close recordset
		$rs->Close();

		// Export header and footer
		if ($usuarios->Export <> "xml") {
			$ExportDoc->ExportHeaderAndFooter();
		}

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($usuarios->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($usuarios->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($usuarios->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($usuarios->ExportReturnUrl());
		} elseif ($usuarios->Export == "pdf") {
			$this->ExportPDF($ExportDoc->Text);
		} else {
			echo $ExportDoc->Text;
		}
	}

	// PDF Export
	function ExportPDF($html) {
		echo($html);
		ew_DeleteTmpImages();
		exit();
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Page Redirecting event
	function Page_Redirecting(&$url) {

		// Example:
		//$url = "your URL";

	}

	// Message Showing event
	// $type = ''|'success'|'failure'
	function Message_Showing(&$msg, $type) {

		// Example:
		//if ($type == 'success') $msg = "your success message";

	}

	// Page Data Rendering event
	function Page_DataRendering(&$header) {

		// Example:
		//$header = "your header";

	}

	// Page Data Rendered event
	function Page_DataRendered(&$footer) {

		// Example:
		//$footer = "your footer";

	}

	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}

	// ListOptions Load event
	function ListOptions_Load() {

		// Example:
		//$opt =& $this->ListOptions->Add("new");
		//$opt->Header = "xxx";
		//$opt->OnLeft = TRUE; // Link on left
		//$opt->MoveTo(0); // Move to first column

	}

	// ListOptions Rendered event
	function ListOptions_Rendered() {

		// Example: 
		//$this->ListOptions->Items["new"]->Body = "xxx";

	}
}
?>
