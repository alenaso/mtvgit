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
$usuarios_delete = new cusuarios_delete();
$Page =& $usuarios_delete;

// Page init
$usuarios_delete->Page_Init();

// Page main
$usuarios_delete->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var usuarios_delete = new ew_Page("usuarios_delete");

// page properties
usuarios_delete.PageID = "delete"; // page ID
usuarios_delete.FormID = "fusuariosdelete"; // form ID
var EW_PAGE_ID = usuarios_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
usuarios_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
usuarios_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
usuarios_delete.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php

// Load records for display
if ($usuarios_delete->Recordset = $usuarios_delete->LoadRecordset())
	$usuarios_deleteTotalRecs = $usuarios_delete->Recordset->RecordCount(); // Get record count
if ($usuarios_deleteTotalRecs <= 0) { // No record found, exit
	if ($usuarios_delete->Recordset)
		$usuarios_delete->Recordset->Close();
	$usuarios_delete->Page_Terminate("usuarioslist.php"); // Return to list
}
?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $usuarios->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $usuarios->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $usuarios_delete->ShowPageHeader(); ?>
<?php
$usuarios_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="usuarios">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($usuarios_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $usuarios->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $usuarios->idUsuario->FldCaption() ?></td>
		<td valign="top"><?php echo $usuarios->nombre->FldCaption() ?></td>
		<td valign="top"><?php echo $usuarios->apellido->FldCaption() ?></td>
		<td valign="top"><?php echo $usuarios->nombreCompleto->FldCaption() ?></td>
		<td valign="top"><?php echo $usuarios->nacimiento->FldCaption() ?></td>
		<td valign="top"><?php echo $usuarios->lugar->FldCaption() ?></td>
		<td valign="top"><?php echo $usuarios->facebookId->FldCaption() ?></td>
		<td valign="top"><?php echo $usuarios->imagen->FldCaption() ?></td>
		<td valign="top"><?php echo $usuarios->sexo->FldCaption() ?></td>
		<td valign="top"><?php echo $usuarios->zemail->FldCaption() ?></td>
		<td valign="top"><?php echo $usuarios->fechaAlta->FldCaption() ?></td>
		<td valign="top"><?php echo $usuarios->IP->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$usuarios_delete->RecCnt = 0;
$i = 0;
while (!$usuarios_delete->Recordset->EOF) {
	$usuarios_delete->RecCnt++;

	// Set row properties
	$usuarios->ResetAttrs();
	$usuarios->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$usuarios_delete->LoadRowValues($usuarios_delete->Recordset);

	// Render row
	$usuarios_delete->RenderRow();
?>
	<tr<?php echo $usuarios->RowAttributes() ?>>
		<td<?php echo $usuarios->idUsuario->CellAttributes() ?>>
<div<?php echo $usuarios->idUsuario->ViewAttributes() ?>><?php echo $usuarios->idUsuario->ListViewValue() ?></div></td>
		<td<?php echo $usuarios->nombre->CellAttributes() ?>>
<div<?php echo $usuarios->nombre->ViewAttributes() ?>><?php echo $usuarios->nombre->ListViewValue() ?></div></td>
		<td<?php echo $usuarios->apellido->CellAttributes() ?>>
<div<?php echo $usuarios->apellido->ViewAttributes() ?>><?php echo $usuarios->apellido->ListViewValue() ?></div></td>
		<td<?php echo $usuarios->nombreCompleto->CellAttributes() ?>>
<div<?php echo $usuarios->nombreCompleto->ViewAttributes() ?>><?php echo $usuarios->nombreCompleto->ListViewValue() ?></div></td>
		<td<?php echo $usuarios->nacimiento->CellAttributes() ?>>
<div<?php echo $usuarios->nacimiento->ViewAttributes() ?>><?php echo $usuarios->nacimiento->ListViewValue() ?></div></td>
		<td<?php echo $usuarios->lugar->CellAttributes() ?>>
<div<?php echo $usuarios->lugar->ViewAttributes() ?>><?php echo $usuarios->lugar->ListViewValue() ?></div></td>
		<td<?php echo $usuarios->facebookId->CellAttributes() ?>>
<div<?php echo $usuarios->facebookId->ViewAttributes() ?>><?php echo $usuarios->facebookId->ListViewValue() ?></div></td>
		<td<?php echo $usuarios->imagen->CellAttributes() ?>>
<?php if (!ew_EmptyStr($usuarios->imagen->ListViewValue())) { ?><img src="<?php echo $usuarios->imagen->ListViewValue() ?>" border="0"<?php echo $usuarios->imagen->ViewAttributes() ?>><?php } ?></td>
		<td<?php echo $usuarios->sexo->CellAttributes() ?>>
<div<?php echo $usuarios->sexo->ViewAttributes() ?>><?php echo $usuarios->sexo->ListViewValue() ?></div></td>
		<td<?php echo $usuarios->zemail->CellAttributes() ?>>
<div<?php echo $usuarios->zemail->ViewAttributes() ?>><?php echo $usuarios->zemail->ListViewValue() ?></div></td>
		<td<?php echo $usuarios->fechaAlta->CellAttributes() ?>>
<div<?php echo $usuarios->fechaAlta->ViewAttributes() ?>><?php echo $usuarios->fechaAlta->ListViewValue() ?></div></td>
		<td<?php echo $usuarios->IP->CellAttributes() ?>>
<div<?php echo $usuarios->IP->ViewAttributes() ?>><?php echo $usuarios->IP->ListViewValue() ?></div></td>
	</tr>
<?php
	$usuarios_delete->Recordset->MoveNext();
}
$usuarios_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("DeleteBtn")) ?>">
</form>
<?php
$usuarios_delete->ShowPageFooter();
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
$usuarios_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cusuarios_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'usuarios';

	// Page object name
	var $PageObjName = 'usuarios_delete';

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
	function cusuarios_delete() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (usuarios)
		if (!isset($GLOBALS["usuarios"])) {
			$GLOBALS["usuarios"] = new cusuarios();
			$GLOBALS["Table"] =& $GLOBALS["usuarios"];
		}

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'usuarios', TRUE);

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
		global $usuarios;

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}

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
	var $TotalRecs = 0;
	var $RecCnt;
	var $RecKeys = array();
	var $Recordset;

	//
	// Page main
	//
	function Page_Main() {
		global $Language, $usuarios;

		// Load key parameters
		$this->RecKeys = $usuarios->GetRecordKeys(); // Load record keys
		$sFilter = $usuarios->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("usuarioslist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in usuarios class, usuariosinfo.php

		$usuarios->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$usuarios->CurrentAction = $_POST["a_delete"];
		} else {
			$usuarios->CurrentAction = "I"; // Display record
		}
		switch ($usuarios->CurrentAction) {
			case "D": // Delete
				$usuarios->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($usuarios->getReturnUrl()); // Return to caller
				}
		}
	}

// No functions
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

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $usuarios;

		// Initialize URLs
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

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $usuarios;
		$DeleteRows = TRUE;
		$sSql = $usuarios->SQL();
		$conn->raiseErrorFn = 'ew_ErrorFn';
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE) {
			return FALSE;
		} elseif ($rs->EOF) {
			$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
			$rs->Close();
			return FALSE;
		}
		$conn->BeginTrans();

		// Clone old rows
		$rsold = ($rs) ? $rs->GetRows() : array();
		if ($rs)
			$rs->Close();

		// Call row deleting event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$DeleteRows = $usuarios->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['idUsuario'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($usuarios->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($usuarios->CancelMessage <> "") {
				$this->setFailureMessage($usuarios->CancelMessage);
				$usuarios->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("DeleteCancelled"));
			}
		}
		if ($DeleteRows) {
			$conn->CommitTrans(); // Commit the changes
		} else {
			$conn->RollbackTrans(); // Rollback changes
		}

		// Call Row Deleted event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$usuarios->Row_Deleted($row);
			}
		}
		return $DeleteRows;
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
}
?>
