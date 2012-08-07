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
$concurso_delete = new cconcurso_delete();
$Page =& $concurso_delete;

// Page init
$concurso_delete->Page_Init();

// Page main
$concurso_delete->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var concurso_delete = new ew_Page("concurso_delete");

// page properties
concurso_delete.PageID = "delete"; // page ID
concurso_delete.FormID = "fconcursodelete"; // form ID
var EW_PAGE_ID = concurso_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
concurso_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
concurso_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
concurso_delete.ValidateRequired = false; // no JavaScript validation
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
if ($concurso_delete->Recordset = $concurso_delete->LoadRecordset())
	$concurso_deleteTotalRecs = $concurso_delete->Recordset->RecordCount(); // Get record count
if ($concurso_deleteTotalRecs <= 0) { // No record found, exit
	if ($concurso_delete->Recordset)
		$concurso_delete->Recordset->Close();
	$concurso_delete->Page_Terminate("concursolist.php"); // Return to list
}
?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $concurso->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $concurso->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $concurso_delete->ShowPageHeader(); ?>
<?php
$concurso_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="concurso">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($concurso_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $concurso->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $concurso->idConcurso->FldCaption() ?></td>
		<td valign="top"><?php echo $concurso->nombre->FldCaption() ?></td>
		<td valign="top"><?php echo $concurso->fechaInicio->FldCaption() ?></td>
		<td valign="top"><?php echo $concurso->fechaFin->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$concurso_delete->RecCnt = 0;
$i = 0;
while (!$concurso_delete->Recordset->EOF) {
	$concurso_delete->RecCnt++;

	// Set row properties
	$concurso->ResetAttrs();
	$concurso->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$concurso_delete->LoadRowValues($concurso_delete->Recordset);

	// Render row
	$concurso_delete->RenderRow();
?>
	<tr<?php echo $concurso->RowAttributes() ?>>
		<td<?php echo $concurso->idConcurso->CellAttributes() ?>>
<div<?php echo $concurso->idConcurso->ViewAttributes() ?>><?php echo $concurso->idConcurso->ListViewValue() ?></div></td>
		<td<?php echo $concurso->nombre->CellAttributes() ?>>
<div<?php echo $concurso->nombre->ViewAttributes() ?>><?php echo $concurso->nombre->ListViewValue() ?></div></td>
		<td<?php echo $concurso->fechaInicio->CellAttributes() ?>>
<div<?php echo $concurso->fechaInicio->ViewAttributes() ?>><?php echo $concurso->fechaInicio->ListViewValue() ?></div></td>
		<td<?php echo $concurso->fechaFin->CellAttributes() ?>>
<div<?php echo $concurso->fechaFin->ViewAttributes() ?>><?php echo $concurso->fechaFin->ListViewValue() ?></div></td>
	</tr>
<?php
	$concurso_delete->Recordset->MoveNext();
}
$concurso_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("DeleteBtn")) ?>">
</form>
<?php
$concurso_delete->ShowPageFooter();
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
$concurso_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cconcurso_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'concurso';

	// Page object name
	var $PageObjName = 'concurso_delete';

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
	function cconcurso_delete() {
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
			define("EW_PAGE_ID", 'delete', TRUE);

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
		global $Language, $concurso;

		// Load key parameters
		$this->RecKeys = $concurso->GetRecordKeys(); // Load record keys
		$sFilter = $concurso->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("concursolist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in concurso class, concursoinfo.php

		$concurso->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$concurso->CurrentAction = $_POST["a_delete"];
		} else {
			$concurso->CurrentAction = "I"; // Display record
		}
		switch ($concurso->CurrentAction) {
			case "D": // Delete
				$concurso->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($concurso->getReturnUrl()); // Return to caller
				}
		}
	}

// No functions
	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $concurso;

		// Call Recordset Selecting event
		$concurso->Recordset_Selecting($concurso->CurrentFilter);

		// Load List page SQL
		$sSql = $concurso->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$concurso->Recordset_Selected($rs);
		return $rs;
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

			// fechaInicio
			$concurso->fechaInicio->LinkCustomAttributes = "";
			$concurso->fechaInicio->HrefValue = "";
			$concurso->fechaInicio->TooltipValue = "";

			// fechaFin
			$concurso->fechaFin->LinkCustomAttributes = "";
			$concurso->fechaFin->HrefValue = "";
			$concurso->fechaFin->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($concurso->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$concurso->Row_Rendered();
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $concurso;
		$DeleteRows = TRUE;
		$sSql = $concurso->SQL();
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
				$DeleteRows = $concurso->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['idConcurso'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($concurso->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($concurso->CancelMessage <> "") {
				$this->setFailureMessage($concurso->CancelMessage);
				$concurso->CancelMessage = "";
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
				$concurso->Row_Deleted($row);
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
