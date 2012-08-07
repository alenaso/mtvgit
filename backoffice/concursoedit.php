<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "concursoinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$concurso_edit = new cconcurso_edit();
$Page =& $concurso_edit;

// Page init
$concurso_edit->Page_Init();

// Page main
$concurso_edit->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var concurso_edit = new ew_Page("concurso_edit");

// page properties
concurso_edit.PageID = "edit"; // page ID
concurso_edit.FormID = "fconcursoedit"; // form ID
var EW_PAGE_ID = concurso_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
concurso_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = 1;
	for (i=0; i<rowcnt; i++) {
		infix = "";
		elm = fobj.elements["x" + infix + "_nombre"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($concurso->nombre->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_texto"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($concurso->texto->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_fechaInicio"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($concurso->fechaInicio->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_fechaInicio"];
		if (elm && !ew_CheckDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($concurso->fechaInicio->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_fechaFin"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($concurso->fechaFin->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_fechaFin"];
		if (elm && !ew_CheckDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($concurso->fechaFin->FldErrMsg()) ?>");

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
concurso_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
concurso_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
concurso_edit.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $concurso->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $concurso->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $concurso_edit->ShowPageHeader(); ?>
<?php
$concurso_edit->ShowMessage();
?>
<form name="fconcursoedit" id="fconcursoedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return concurso_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="concurso">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($concurso->idConcurso->Visible) { // idConcurso ?>
	<tr id="r_idConcurso"<?php echo $concurso->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $concurso->idConcurso->FldCaption() ?></td>
		<td<?php echo $concurso->idConcurso->CellAttributes() ?>><span id="el_idConcurso">
<div<?php echo $concurso->idConcurso->ViewAttributes() ?>><?php echo $concurso->idConcurso->EditValue ?></div>
<input type="hidden" name="x_idConcurso" id="x_idConcurso" value="<?php echo ew_HtmlEncode($concurso->idConcurso->CurrentValue) ?>">
</span><?php echo $concurso->idConcurso->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($concurso->nombre->Visible) { // nombre ?>
	<tr id="r_nombre"<?php echo $concurso->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $concurso->nombre->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $concurso->nombre->CellAttributes() ?>><span id="el_nombre">
<input type="text" name="x_nombre" id="x_nombre" size="30" maxlength="200" value="<?php echo $concurso->nombre->EditValue ?>"<?php echo $concurso->nombre->EditAttributes() ?>>
</span><?php echo $concurso->nombre->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($concurso->texto->Visible) { // texto ?>
	<tr id="r_texto"<?php echo $concurso->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $concurso->texto->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $concurso->texto->CellAttributes() ?>><span id="el_texto">
<textarea name="x_texto" id="x_texto" cols="35" rows="4"<?php echo $concurso->texto->EditAttributes() ?>><?php echo $concurso->texto->EditValue ?></textarea>
</span><?php echo $concurso->texto->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($concurso->fechaInicio->Visible) { // fechaInicio ?>
	<tr id="r_fechaInicio"<?php echo $concurso->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $concurso->fechaInicio->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $concurso->fechaInicio->CellAttributes() ?>><span id="el_fechaInicio">
<input type="text" name="x_fechaInicio" id="x_fechaInicio" value="<?php echo $concurso->fechaInicio->EditValue ?>"<?php echo $concurso->fechaInicio->EditAttributes() ?>>
</span><?php echo $concurso->fechaInicio->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($concurso->fechaFin->Visible) { // fechaFin ?>
	<tr id="r_fechaFin"<?php echo $concurso->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $concurso->fechaFin->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $concurso->fechaFin->CellAttributes() ?>><span id="el_fechaFin">
<input type="text" name="x_fechaFin" id="x_fechaFin" value="<?php echo $concurso->fechaFin->EditValue ?>"<?php echo $concurso->fechaFin->EditAttributes() ?>>
</span><?php echo $concurso->fechaFin->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("EditBtn")) ?>">
</form>
<?php
$concurso_edit->ShowPageFooter();
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
$concurso_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class cconcurso_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'concurso';

	// Page object name
	var $PageObjName = 'concurso_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $concurso;
		if ($concurso->UseTokenInUrl) $PageUrl .= "t=" . $concurso->TableVar . "&"; // Add page token
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
		global $objForm, $concurso;
		if ($concurso->UseTokenInUrl) {
			if ($objForm)
				return ($concurso->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($concurso->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cconcurso_edit() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (concurso)
		if (!isset($GLOBALS["concurso"])) {
			$GLOBALS["concurso"] = new cconcurso();
			$GLOBALS["Table"] =& $GLOBALS["concurso"];
		}

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'concurso', TRUE);

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
		global $concurso;

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
		global $objForm, $Language, $gsFormError, $concurso;

		// Load key from QueryString
		if (@$_GET["idConcurso"] <> "")
			$concurso->idConcurso->setQueryStringValue($_GET["idConcurso"]);
		if (@$_POST["a_edit"] <> "") {
			$concurso->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$concurso->CurrentAction = ""; // Form error, reset action
				$this->setFailureMessage($gsFormError);
				$concurso->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$concurso->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($concurso->idConcurso->CurrentValue == "")
			$this->Page_Terminate("concursolist.php"); // Invalid key, return to list
		switch ($concurso->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("concursolist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$concurso->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $concurso->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$concurso->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$concurso->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$concurso->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $concurso;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $concurso;
		if (!$concurso->idConcurso->FldIsDetailKey)
			$concurso->idConcurso->setFormValue($objForm->GetValue("x_idConcurso"));
		if (!$concurso->nombre->FldIsDetailKey) {
			$concurso->nombre->setFormValue($objForm->GetValue("x_nombre"));
		}
		if (!$concurso->texto->FldIsDetailKey) {
			$concurso->texto->setFormValue($objForm->GetValue("x_texto"));
		}
		if (!$concurso->fechaInicio->FldIsDetailKey) {
			$concurso->fechaInicio->setFormValue($objForm->GetValue("x_fechaInicio"));
			$concurso->fechaInicio->CurrentValue = ew_UnFormatDateTime($concurso->fechaInicio->CurrentValue, 9);
		}
		if (!$concurso->fechaFin->FldIsDetailKey) {
			$concurso->fechaFin->setFormValue($objForm->GetValue("x_fechaFin"));
			$concurso->fechaFin->CurrentValue = ew_UnFormatDateTime($concurso->fechaFin->CurrentValue, 9);
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $concurso;
		$this->LoadRow();
		$concurso->idConcurso->CurrentValue = $concurso->idConcurso->FormValue;
		$concurso->nombre->CurrentValue = $concurso->nombre->FormValue;
		$concurso->texto->CurrentValue = $concurso->texto->FormValue;
		$concurso->fechaInicio->CurrentValue = $concurso->fechaInicio->FormValue;
		$concurso->fechaInicio->CurrentValue = ew_UnFormatDateTime($concurso->fechaInicio->CurrentValue, 9);
		$concurso->fechaFin->CurrentValue = $concurso->fechaFin->FormValue;
		$concurso->fechaFin->CurrentValue = ew_UnFormatDateTime($concurso->fechaFin->CurrentValue, 9);
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $concurso;
		$sFilter = $concurso->KeyFilter();

		// Call Row Selecting event
		$concurso->Row_Selecting($sFilter);

		// Load SQL based on filter
		$concurso->CurrentFilter = $sFilter;
		$sSql = $concurso->SQL();
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
		global $conn, $concurso;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$concurso->Row_Selected($row);
		$concurso->idConcurso->setDbValue($rs->fields('idConcurso'));
		$concurso->nombre->setDbValue($rs->fields('nombre'));
		$concurso->texto->setDbValue($rs->fields('texto'));
		$concurso->fechaInicio->setDbValue($rs->fields('fechaInicio'));
		$concurso->fechaFin->setDbValue($rs->fields('fechaFin'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $concurso;

		// Initialize URLs
		// Call Row_Rendering event

		$concurso->Row_Rendering();

		// Common render codes for all row types
		// idConcurso
		// nombre
		// texto
		// fechaInicio
		// fechaFin

		if ($concurso->RowType == EW_ROWTYPE_VIEW) { // View row

			// idConcurso
			$concurso->idConcurso->ViewValue = $concurso->idConcurso->CurrentValue;
			$concurso->idConcurso->ViewCustomAttributes = "";

			// nombre
			$concurso->nombre->ViewValue = $concurso->nombre->CurrentValue;
			$concurso->nombre->ViewCustomAttributes = "";

			// texto
			$concurso->texto->ViewValue = $concurso->texto->CurrentValue;
			$concurso->texto->ViewCustomAttributes = "";

			// fechaInicio
			$concurso->fechaInicio->ViewValue = $concurso->fechaInicio->CurrentValue;
			$concurso->fechaInicio->ViewValue = ew_FormatDateTime($concurso->fechaInicio->ViewValue, 9);
			$concurso->fechaInicio->ViewCustomAttributes = "";

			// fechaFin
			$concurso->fechaFin->ViewValue = $concurso->fechaFin->CurrentValue;
			$concurso->fechaFin->ViewValue = ew_FormatDateTime($concurso->fechaFin->ViewValue, 9);
			$concurso->fechaFin->ViewCustomAttributes = "";

			// idConcurso
			$concurso->idConcurso->LinkCustomAttributes = "";
			$concurso->idConcurso->HrefValue = "";
			$concurso->idConcurso->TooltipValue = "";

			// nombre
			$concurso->nombre->LinkCustomAttributes = "";
			$concurso->nombre->HrefValue = "";
			$concurso->nombre->TooltipValue = "";

			// texto
			$concurso->texto->LinkCustomAttributes = "";
			$concurso->texto->HrefValue = "";
			$concurso->texto->TooltipValue = "";

			// fechaInicio
			$concurso->fechaInicio->LinkCustomAttributes = "";
			$concurso->fechaInicio->HrefValue = "";
			$concurso->fechaInicio->TooltipValue = "";

			// fechaFin
			$concurso->fechaFin->LinkCustomAttributes = "";
			$concurso->fechaFin->HrefValue = "";
			$concurso->fechaFin->TooltipValue = "";
		} elseif ($concurso->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// idConcurso
			$concurso->idConcurso->EditCustomAttributes = "";
			$concurso->idConcurso->EditValue = $concurso->idConcurso->CurrentValue;
			$concurso->idConcurso->ViewCustomAttributes = "";

			// nombre
			$concurso->nombre->EditCustomAttributes = "";
			$concurso->nombre->EditValue = ew_HtmlEncode($concurso->nombre->CurrentValue);

			// texto
			$concurso->texto->EditCustomAttributes = "";
			$concurso->texto->EditValue = ew_HtmlEncode($concurso->texto->CurrentValue);

			// fechaInicio
			$concurso->fechaInicio->EditCustomAttributes = "";
			$concurso->fechaInicio->EditValue = ew_HtmlEncode(ew_FormatDateTime($concurso->fechaInicio->CurrentValue, 9));

			// fechaFin
			$concurso->fechaFin->EditCustomAttributes = "";
			$concurso->fechaFin->EditValue = ew_HtmlEncode(ew_FormatDateTime($concurso->fechaFin->CurrentValue, 9));

			// Edit refer script
			// idConcurso

			$concurso->idConcurso->HrefValue = "";

			// nombre
			$concurso->nombre->HrefValue = "";

			// texto
			$concurso->texto->HrefValue = "";

			// fechaInicio
			$concurso->fechaInicio->HrefValue = "";

			// fechaFin
			$concurso->fechaFin->HrefValue = "";
		}
		if ($concurso->RowType == EW_ROWTYPE_ADD ||
			$concurso->RowType == EW_ROWTYPE_EDIT ||
			$concurso->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$concurso->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($concurso->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$concurso->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $concurso;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($concurso->nombre->FormValue) && $concurso->nombre->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $concurso->nombre->FldCaption());
		}
		if (!is_null($concurso->texto->FormValue) && $concurso->texto->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $concurso->texto->FldCaption());
		}
		if (!is_null($concurso->fechaInicio->FormValue) && $concurso->fechaInicio->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $concurso->fechaInicio->FldCaption());
		}
		if (!ew_CheckDate($concurso->fechaInicio->FormValue)) {
			ew_AddMessage($gsFormError, $concurso->fechaInicio->FldErrMsg());
		}
		if (!is_null($concurso->fechaFin->FormValue) && $concurso->fechaFin->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $concurso->fechaFin->FldCaption());
		}
		if (!ew_CheckDate($concurso->fechaFin->FormValue)) {
			ew_AddMessage($gsFormError, $concurso->fechaFin->FldErrMsg());
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
		global $conn, $Security, $Language, $concurso;
		$sFilter = $concurso->KeyFilter();
		$concurso->CurrentFilter = $sFilter;
		$sSql = $concurso->SQL();
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

			// nombre
			$concurso->nombre->SetDbValueDef($rsnew, $concurso->nombre->CurrentValue, "", $concurso->nombre->ReadOnly);

			// texto
			$concurso->texto->SetDbValueDef($rsnew, $concurso->texto->CurrentValue, "", $concurso->texto->ReadOnly);

			// fechaInicio
			$concurso->fechaInicio->SetDbValueDef($rsnew, ew_UnFormatDateTime($concurso->fechaInicio->CurrentValue, 9), ew_CurrentDate(), $concurso->fechaInicio->ReadOnly);

			// fechaFin
			$concurso->fechaFin->SetDbValueDef($rsnew, ew_UnFormatDateTime($concurso->fechaFin->CurrentValue, 9), ew_CurrentDate(), $concurso->fechaFin->ReadOnly);

			// Call Row Updating event
			$bUpdateRow = $concurso->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				if (count($rsnew) > 0)
					$EditRow = $conn->Execute($concurso->UpdateSQL($rsnew));
				else
					$EditRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
			} else {
				if ($concurso->CancelMessage <> "") {
					$this->setFailureMessage($concurso->CancelMessage);
					$concurso->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$concurso->Row_Updated($rsold, $rsnew);
		$rs->Close();
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
