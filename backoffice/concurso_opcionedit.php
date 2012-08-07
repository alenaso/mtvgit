<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "concurso_opcioninfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$concurso_opcion_edit = new cconcurso_opcion_edit();
$Page =& $concurso_opcion_edit;

// Page init
$concurso_opcion_edit->Page_Init();

// Page main
$concurso_opcion_edit->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var concurso_opcion_edit = new ew_Page("concurso_opcion_edit");

// page properties
concurso_opcion_edit.PageID = "edit"; // page ID
concurso_opcion_edit.FormID = "fconcurso_opcionedit"; // form ID
var EW_PAGE_ID = concurso_opcion_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
concurso_opcion_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = 1;
	for (i=0; i<rowcnt; i++) {
		infix = "";
		elm = fobj.elements["x" + infix + "_concursoId"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($concurso_opcion->concursoId->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_imagen"];
		aelm = fobj.elements["a" + infix + "_imagen"];
		var chk_imagen = (aelm && aelm[0])?(aelm[2].checked):true;
		if (elm && chk_imagen && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($concurso_opcion->imagen->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_imagen"];
		if (elm && !ew_CheckFileType(elm.value))
			return ew_OnError(this, elm, ewLanguage.Phrase("WrongFileType"));
		elm = fobj.elements["x" + infix + "_votos"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($concurso_opcion->votos->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_votos"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($concurso_opcion->votos->FldErrMsg()) ?>");

		// Set up row object
		var row = {};
		row["index"] = infix;
		for (var j = 0; j < fobj.elements.length; j++) {
			var el = fobj.elements[j];
			var len = infix.length + 2;
			if (el.name.substr(0, len) == "x" + infix + "_") {
				var elname = "x_" + el.name.substr(len);
				if (ewLang.isObject(row[elname])) { // already exists
					if (ewLang.isArray(row[elname])) {
						row[elname][row[elname].length] = el; // add to array
					} else {
						row[elname] = [row[elname], el]; // convert to array
					}
				} else {
					row[elname] = el;
				}
			}
		}
		fobj.row = row;

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}

	// Process detail page
	var detailpage = (fobj.detailpage) ? fobj.detailpage.value : "";
	if (detailpage != "") {
		return eval(detailpage+".ValidateForm(fobj)");
	}
	return true;
}

// extend page with Form_CustomValidate function
concurso_opcion_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
concurso_opcion_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
concurso_opcion_edit.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $concurso_opcion->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $concurso_opcion->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $concurso_opcion_edit->ShowPageHeader(); ?>
<?php
$concurso_opcion_edit->ShowMessage();
?>
<form name="fconcurso_opcionedit" id="fconcurso_opcionedit" action="<?php echo ew_CurrentPage() ?>" method="post" enctype="multipart/form-data" onsubmit="return concurso_opcion_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="concurso_opcion">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($concurso_opcion->idConcursoOpcion->Visible) { // idConcursoOpcion ?>
	<tr id="r_idConcursoOpcion"<?php echo $concurso_opcion->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $concurso_opcion->idConcursoOpcion->FldCaption() ?></td>
		<td<?php echo $concurso_opcion->idConcursoOpcion->CellAttributes() ?>><span id="el_idConcursoOpcion">
<div<?php echo $concurso_opcion->idConcursoOpcion->ViewAttributes() ?>><?php echo $concurso_opcion->idConcursoOpcion->EditValue ?></div>
<input type="hidden" name="x_idConcursoOpcion" id="x_idConcursoOpcion" value="<?php echo ew_HtmlEncode($concurso_opcion->idConcursoOpcion->CurrentValue) ?>">
</span><?php echo $concurso_opcion->idConcursoOpcion->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($concurso_opcion->concursoId->Visible) { // concursoId ?>
	<tr id="r_concursoId"<?php echo $concurso_opcion->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $concurso_opcion->concursoId->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $concurso_opcion->concursoId->CellAttributes() ?>><span id="el_concursoId">
<select id="x_concursoId" name="x_concursoId"<?php echo $concurso_opcion->concursoId->EditAttributes() ?>>
<?php
if (is_array($concurso_opcion->concursoId->EditValue)) {
	$arwrk = $concurso_opcion->concursoId->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($concurso_opcion->concursoId->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
?>
</select>
</span><?php echo $concurso_opcion->concursoId->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($concurso_opcion->imagen->Visible) { // imagen ?>
	<tr id="r_imagen"<?php echo $concurso_opcion->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $concurso_opcion->imagen->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $concurso_opcion->imagen->CellAttributes() ?>><span id="el_imagen">
<div id="old_x_imagen">
<?php if ($concurso_opcion->imagen->LinkAttributes() <> "") { ?>
<?php if (!empty($concurso_opcion->imagen->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, $concurso_opcion->imagen->UploadPath) . $concurso_opcion->imagen->Upload->DbValue ?>" border=0<?php echo $concurso_opcion->imagen->ViewAttributes() ?>>
<?php } elseif (!in_array($concurso_opcion->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!empty($concurso_opcion->imagen->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, $concurso_opcion->imagen->UploadPath) . $concurso_opcion->imagen->Upload->DbValue ?>" border=0<?php echo $concurso_opcion->imagen->ViewAttributes() ?>>
<?php } elseif (!in_array($concurso_opcion->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</div>
<div id="new_x_imagen">
<?php if (!empty($concurso_opcion->imagen->Upload->DbValue)) { ?>
<label><input type="radio" name="a_imagen" id="a_imagen" value="1" checked="checked"><?php echo $Language->Phrase("Keep") ?></label>&nbsp;
<label><input type="radio" name="a_imagen" id="a_imagen" value="2" disabled="disabled"><?php echo $Language->Phrase("Remove") ?></label>&nbsp;
<label><input type="radio" name="a_imagen" id="a_imagen" value="3"><?php echo $Language->Phrase("Replace") ?><br></label>
<?php $concurso_opcion->imagen->EditAttrs["onchange"] = "this.form.a_imagen[2].checked=true;" . @$concurso_opcion->imagen->EditAttrs["onchange"]; ?>
<?php } else { ?>
<input type="hidden" name="a_imagen" id="a_imagen" value="3">
<?php } ?>
<input type="file" name="x_imagen" id="x_imagen" size="30"<?php echo $concurso_opcion->imagen->EditAttributes() ?>>
</div>
</span><?php echo $concurso_opcion->imagen->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($concurso_opcion->votos->Visible) { // votos ?>
	<tr id="r_votos"<?php echo $concurso_opcion->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $concurso_opcion->votos->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $concurso_opcion->votos->CellAttributes() ?>><span id="el_votos">
<input type="text" name="x_votos" id="x_votos" size="30" value="<?php echo $concurso_opcion->votos->EditValue ?>"<?php echo $concurso_opcion->votos->EditAttributes() ?>>
</span><?php echo $concurso_opcion->votos->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("EditBtn")) ?>">
</form>
<?php
$concurso_opcion_edit->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php include_once "footer.php" ?>
<?php
$concurso_opcion_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class cconcurso_opcion_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'concurso_opcion';

	// Page object name
	var $PageObjName = 'concurso_opcion_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $concurso_opcion;
		if ($concurso_opcion->UseTokenInUrl) $PageUrl .= "t=" . $concurso_opcion->TableVar . "&"; // Add page token
		return $PageUrl;
	}

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
		global $objForm, $concurso_opcion;
		if ($concurso_opcion->UseTokenInUrl) {
			if ($objForm)
				return ($concurso_opcion->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($concurso_opcion->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cconcurso_opcion_edit() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (concurso_opcion)
		if (!isset($GLOBALS["concurso_opcion"])) {
			$GLOBALS["concurso_opcion"] = new cconcurso_opcion();
			$GLOBALS["Table"] =& $GLOBALS["concurso_opcion"];
		}

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'concurso_opcion', TRUE);

		// Start timer
		if (!isset($GLOBALS["gTimer"])) $GLOBALS["gTimer"] = new cTimer();

		// Open connection
		if (!isset($conn)) $conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $UserProfile, $Language, $Security, $objForm;
		global $concurso_opcion;

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}

		// Create form object
		$objForm = new cFormObj();

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
	var $DbMasterFilter;
	var $DbDetailFilter;

	// 
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $concurso_opcion;

		// Load key from QueryString
		if (@$_GET["idConcursoOpcion"] <> "")
			$concurso_opcion->idConcursoOpcion->setQueryStringValue($_GET["idConcursoOpcion"]);
		if (@$_POST["a_edit"] <> "") {
			$concurso_opcion->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$concurso_opcion->CurrentAction = ""; // Form error, reset action
				$this->setFailureMessage($gsFormError);
				$concurso_opcion->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$concurso_opcion->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($concurso_opcion->idConcursoOpcion->CurrentValue == "")
			$this->Page_Terminate("concurso_opcionlist.php"); // Invalid key, return to list
		switch ($concurso_opcion->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("concurso_opcionlist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$concurso_opcion->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $concurso_opcion->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$concurso_opcion->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$concurso_opcion->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$concurso_opcion->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $concurso_opcion;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
		$concurso_opcion->imagen->Upload->Index = $objForm->Index;
		$concurso_opcion->imagen->Upload->RestoreDbFromSession();
		if ($confirmPage) { // Post from confirm page
			$concurso_opcion->imagen->Upload->RestoreFromSession();
		} else {
			if ($concurso_opcion->imagen->Upload->UploadFile()) {

				// No action required
			} else {
				echo $concurso_opcion->imagen->Upload->Message;
				$this->Page_Terminate();
				exit();
			}
			$concurso_opcion->imagen->Upload->SaveToSession();
		}
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $concurso_opcion;
		$this->GetUploadFiles(); // Get upload files
		if (!$concurso_opcion->idConcursoOpcion->FldIsDetailKey)
			$concurso_opcion->idConcursoOpcion->setFormValue($objForm->GetValue("x_idConcursoOpcion"));
		if (!$concurso_opcion->concursoId->FldIsDetailKey) {
			$concurso_opcion->concursoId->setFormValue($objForm->GetValue("x_concursoId"));
		}
		if (!$concurso_opcion->votos->FldIsDetailKey) {
			$concurso_opcion->votos->setFormValue($objForm->GetValue("x_votos"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $concurso_opcion;
		$this->LoadRow();
		$concurso_opcion->idConcursoOpcion->CurrentValue = $concurso_opcion->idConcursoOpcion->FormValue;
		$concurso_opcion->concursoId->CurrentValue = $concurso_opcion->concursoId->FormValue;
		$concurso_opcion->votos->CurrentValue = $concurso_opcion->votos->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $concurso_opcion;
		$sFilter = $concurso_opcion->KeyFilter();

		// Call Row Selecting event
		$concurso_opcion->Row_Selecting($sFilter);

		// Load SQL based on filter
		$concurso_opcion->CurrentFilter = $sFilter;
		$sSql = $concurso_opcion->SQL();
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
		global $conn, $concurso_opcion;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$concurso_opcion->Row_Selected($row);
		$concurso_opcion->idConcursoOpcion->setDbValue($rs->fields('idConcursoOpcion'));
		$concurso_opcion->concursoId->setDbValue($rs->fields('concursoId'));
		$concurso_opcion->imagen->Upload->DbValue = $rs->fields('imagen');
		$concurso_opcion->votos->setDbValue($rs->fields('votos'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $concurso_opcion;

		// Initialize URLs
		// Call Row_Rendering event

		$concurso_opcion->Row_Rendering();

		// Common render codes for all row types
		// idConcursoOpcion
		// concursoId
		// imagen
		// votos

		if ($concurso_opcion->RowType == EW_ROWTYPE_VIEW) { // View row

			// idConcursoOpcion
			$concurso_opcion->idConcursoOpcion->ViewValue = $concurso_opcion->idConcursoOpcion->CurrentValue;
			$concurso_opcion->idConcursoOpcion->ViewCustomAttributes = "";

			// concursoId
			if (strval($concurso_opcion->concursoId->CurrentValue) <> "") {
				$sFilterWrk = "`idConcurso` = " . ew_AdjustSql($concurso_opcion->concursoId->CurrentValue) . "";
			$sSqlWrk = "SELECT `nombre` FROM `concurso`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$concurso_opcion->concursoId->ViewValue = $rswrk->fields('nombre');
					$rswrk->Close();
				} else {
					$concurso_opcion->concursoId->ViewValue = $concurso_opcion->concursoId->CurrentValue;
				}
			} else {
				$concurso_opcion->concursoId->ViewValue = NULL;
			}
			$concurso_opcion->concursoId->ViewCustomAttributes = "";

			// imagen
			if (!ew_Empty($concurso_opcion->imagen->Upload->DbValue)) {
				$concurso_opcion->imagen->ViewValue = $concurso_opcion->imagen->Upload->DbValue;
				$concurso_opcion->imagen->ImageWidth = 200;
				$concurso_opcion->imagen->ImageHeight = 200;
				$concurso_opcion->imagen->ImageAlt = $concurso_opcion->imagen->FldAlt();
			} else {
				$concurso_opcion->imagen->ViewValue = "";
			}
			$concurso_opcion->imagen->ViewCustomAttributes = "";

			// votos
			$concurso_opcion->votos->ViewValue = $concurso_opcion->votos->CurrentValue;
			$concurso_opcion->votos->ViewCustomAttributes = "";

			// idConcursoOpcion
			$concurso_opcion->idConcursoOpcion->LinkCustomAttributes = "";
			$concurso_opcion->idConcursoOpcion->HrefValue = "";
			$concurso_opcion->idConcursoOpcion->TooltipValue = "";

			// concursoId
			$concurso_opcion->concursoId->LinkCustomAttributes = "";
			$concurso_opcion->concursoId->HrefValue = "";
			$concurso_opcion->concursoId->TooltipValue = "";

			// imagen
			$concurso_opcion->imagen->LinkCustomAttributes = "";
			$concurso_opcion->imagen->HrefValue = "";
			$concurso_opcion->imagen->TooltipValue = "";

			// votos
			$concurso_opcion->votos->LinkCustomAttributes = "";
			$concurso_opcion->votos->HrefValue = "";
			$concurso_opcion->votos->TooltipValue = "";
		} elseif ($concurso_opcion->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// idConcursoOpcion
			$concurso_opcion->idConcursoOpcion->EditCustomAttributes = "";
			$concurso_opcion->idConcursoOpcion->EditValue = $concurso_opcion->idConcursoOpcion->CurrentValue;
			$concurso_opcion->idConcursoOpcion->ViewCustomAttributes = "";

			// concursoId
			$concurso_opcion->concursoId->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `idConcurso`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld` FROM `concurso`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$concurso_opcion->concursoId->EditValue = $arwrk;

			// imagen
			$concurso_opcion->imagen->EditCustomAttributes = "";
			if (!ew_Empty($concurso_opcion->imagen->Upload->DbValue)) {
				$concurso_opcion->imagen->EditValue = $concurso_opcion->imagen->Upload->DbValue;
				$concurso_opcion->imagen->ImageWidth = 200;
				$concurso_opcion->imagen->ImageHeight = 200;
				$concurso_opcion->imagen->ImageAlt = $concurso_opcion->imagen->FldAlt();
			} else {
				$concurso_opcion->imagen->EditValue = "";
			}

			// votos
			$concurso_opcion->votos->EditCustomAttributes = "";
			$concurso_opcion->votos->EditValue = ew_HtmlEncode($concurso_opcion->votos->CurrentValue);

			// Edit refer script
			// idConcursoOpcion

			$concurso_opcion->idConcursoOpcion->HrefValue = "";

			// concursoId
			$concurso_opcion->concursoId->HrefValue = "";

			// imagen
			$concurso_opcion->imagen->HrefValue = "";

			// votos
			$concurso_opcion->votos->HrefValue = "";
		}
		if ($concurso_opcion->RowType == EW_ROWTYPE_ADD ||
			$concurso_opcion->RowType == EW_ROWTYPE_EDIT ||
			$concurso_opcion->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$concurso_opcion->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($concurso_opcion->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$concurso_opcion->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $concurso_opcion;

		// Initialize form error message
		$gsFormError = "";
		if (!ew_CheckFileType($concurso_opcion->imagen->Upload->FileName)) {
			ew_AddMessage($gsFormError, $Language->Phrase("WrongFileType"));
		}
		if ($concurso_opcion->imagen->Upload->FileSize > 0 && EW_MAX_FILE_SIZE > 0 && $concurso_opcion->imagen->Upload->FileSize > EW_MAX_FILE_SIZE) {
			ew_AddMessage($gsFormError, str_replace("%s", EW_MAX_FILE_SIZE, $Language->Phrase("MaxFileSize")));
		}
		if (in_array($concurso_opcion->imagen->Upload->Error, array(1, 2, 3, 6, 7, 8))) {
			ew_AddMessage($gsFormError, $Language->Phrase("PhpUploadErr" . $concurso_opcion->imagen->Upload->Error));
		}

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($concurso_opcion->concursoId->FormValue) && $concurso_opcion->concursoId->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $concurso_opcion->concursoId->FldCaption());
		}
		if ($concurso_opcion->imagen->Upload->Action == "3" && is_null($concurso_opcion->imagen->Upload->Value)) {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $concurso_opcion->imagen->FldCaption());
		}
		if (!is_null($concurso_opcion->votos->FormValue) && $concurso_opcion->votos->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $concurso_opcion->votos->FldCaption());
		}
		if (!ew_CheckInteger($concurso_opcion->votos->FormValue)) {
			ew_AddMessage($gsFormError, $concurso_opcion->votos->FldErrMsg());
		}

		// Return validate result
		$ValidateForm = ($gsFormError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateForm = $ValidateForm && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			ew_AddMessage($gsFormError, $sFormCustomError);
		}
		return $ValidateForm;
	}

	// Update record based on key values
	function EditRow() {
		global $conn, $Security, $Language, $concurso_opcion;
		$sFilter = $concurso_opcion->KeyFilter();
		$concurso_opcion->CurrentFilter = $sFilter;
		$sSql = $concurso_opcion->SQL();
		$conn->raiseErrorFn = 'ew_ErrorFn';
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE)
			return FALSE;
		if ($rs->EOF) {
			$EditRow = FALSE; // Update Failed
		} else {

			// Save old values
			$rsold =& $rs->fields;
			$rsnew = array();

			// concursoId
			$concurso_opcion->concursoId->SetDbValueDef($rsnew, $concurso_opcion->concursoId->CurrentValue, 0, $concurso_opcion->concursoId->ReadOnly);

			// imagen
			if ($concurso_opcion->imagen->Upload->Action == "1") { // Keep
			} elseif ($concurso_opcion->imagen->Upload->Action == "2" || $concurso_opcion->imagen->Upload->Action == "3") { // Update/Remove
			$concurso_opcion->imagen->Upload->DbValue = $rs->fields('imagen'); // Get original value
			if (is_null($concurso_opcion->imagen->Upload->Value)) {
				$rsnew['imagen'] = NULL;
			} else {
				if ($concurso_opcion->imagen->Upload->FileName == $concurso_opcion->imagen->Upload->DbValue) { // Upload file name same as old file name
					$rsnew['imagen'] = $concurso_opcion->imagen->Upload->FileName;
				} else {
					$rsnew['imagen'] = ew_UploadFileNameEx(ew_UploadPathEx(TRUE, $concurso_opcion->imagen->UploadPath), $concurso_opcion->imagen->Upload->FileName);
				}
			}
			}

			// votos
			$concurso_opcion->votos->SetDbValueDef($rsnew, $concurso_opcion->votos->CurrentValue, 0, $concurso_opcion->votos->ReadOnly);

			// Call Row Updating event
			$bUpdateRow = $concurso_opcion->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
			if (!ew_Empty($concurso_opcion->imagen->Upload->Value)) {
				if ($concurso_opcion->imagen->Upload->FileName == $concurso_opcion->imagen->Upload->DbValue) { // Overwrite if same file name
					$concurso_opcion->imagen->Upload->SaveToFile($concurso_opcion->imagen->UploadPath, $rsnew['imagen'], TRUE);
					$concurso_opcion->imagen->Upload->DbValue = ""; // No need to delete any more
				} else {
					$concurso_opcion->imagen->Upload->SaveToFile($concurso_opcion->imagen->UploadPath, $rsnew['imagen'], FALSE);
				}
			}
			if ($concurso_opcion->imagen->Upload->Action == "2" || $concurso_opcion->imagen->Upload->Action == "3") { // Update/Remove
				if ($concurso_opcion->imagen->Upload->DbValue <> "")
					@unlink(ew_UploadPathEx(TRUE, $concurso_opcion->imagen->UploadPath) . $concurso_opcion->imagen->Upload->DbValue);
			}
				$conn->raiseErrorFn = 'ew_ErrorFn';
				if (count($rsnew) > 0)
					$EditRow = $conn->Execute($concurso_opcion->UpdateSQL($rsnew));
				else
					$EditRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
			} else {
				if ($concurso_opcion->CancelMessage <> "") {
					$this->setFailureMessage($concurso_opcion->CancelMessage);
					$concurso_opcion->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$concurso_opcion->Row_Updated($rsold, $rsnew);
		$rs->Close();

		// imagen
		$concurso_opcion->imagen->Upload->RemoveFromSession(); // Remove file value from Session
		return $EditRow;
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
}
?>
