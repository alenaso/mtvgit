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
$concurso_opcion_delete = new cconcurso_opcion_delete();
$Page =& $concurso_opcion_delete;

// Page init
$concurso_opcion_delete->Page_Init();

// Page main
$concurso_opcion_delete->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var concurso_opcion_delete = new ew_Page("concurso_opcion_delete");

// page properties
concurso_opcion_delete.PageID = "delete"; // page ID
concurso_opcion_delete.FormID = "fconcurso_opciondelete"; // form ID
var EW_PAGE_ID = concurso_opcion_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
concurso_opcion_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
concurso_opcion_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
concurso_opcion_delete.ValidateRequired = false; // no JavaScript validation
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
if ($concurso_opcion_delete->Recordset = $concurso_opcion_delete->LoadRecordset())
	$concurso_opcion_deleteTotalRecs = $concurso_opcion_delete->Recordset->RecordCount(); // Get record count
if ($concurso_opcion_deleteTotalRecs <= 0) { // No record found, exit
	if ($concurso_opcion_delete->Recordset)
		$concurso_opcion_delete->Recordset->Close();
	$concurso_opcion_delete->Page_Terminate("concurso_opcionlist.php"); // Return to list
}
?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $concurso_opcion->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $concurso_opcion->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $concurso_opcion_delete->ShowPageHeader(); ?>
<?php
$concurso_opcion_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="concurso_opcion">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($concurso_opcion_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $concurso_opcion->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $concurso_opcion->idConcursoOpcion->FldCaption() ?></td>
		<td valign="top"><?php echo $concurso_opcion->concursoId->FldCaption() ?></td>
		<td valign="top"><?php echo $concurso_opcion->imagen->FldCaption() ?></td>
		<td valign="top"><?php echo $concurso_opcion->votos->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$concurso_opcion_delete->RecCnt = 0;
$i = 0;
while (!$concurso_opcion_delete->Recordset->EOF) {
	$concurso_opcion_delete->RecCnt++;

	// Set row properties
	$concurso_opcion->ResetAttrs();
	$concurso_opcion->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$concurso_opcion_delete->LoadRowValues($concurso_opcion_delete->Recordset);

	// Render row
	$concurso_opcion_delete->RenderRow();
?>
	<tr<?php echo $concurso_opcion->RowAttributes() ?>>
		<td<?php echo $concurso_opcion->idConcursoOpcion->CellAttributes() ?>>
<div<?php echo $concurso_opcion->idConcursoOpcion->ViewAttributes() ?>><?php echo $concurso_opcion->idConcursoOpcion->ListViewValue() ?></div></td>
		<td<?php echo $concurso_opcion->concursoId->CellAttributes() ?>>
<div<?php echo $concurso_opcion->concursoId->ViewAttributes() ?>><?php echo $concurso_opcion->concursoId->ListViewValue() ?></div></td>
		<td<?php echo $concurso_opcion->imagen->CellAttributes() ?>>
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
</td>
		<td<?php echo $concurso_opcion->votos->CellAttributes() ?>>
<div<?php echo $concurso_opcion->votos->ViewAttributes() ?>><?php echo $concurso_opcion->votos->ListViewValue() ?></div></td>
	</tr>
<?php
	$concurso_opcion_delete->Recordset->MoveNext();
}
$concurso_opcion_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("DeleteBtn")) ?>">
</form>
<?php
$concurso_opcion_delete->ShowPageFooter();
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
$concurso_opcion_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cconcurso_opcion_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'concurso_opcion';

	// Page object name
	var $PageObjName = 'concurso_opcion_delete';

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
	function cconcurso_opcion_delete() {
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
			define("EW_PAGE_ID", 'delete', TRUE);

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
		global $Language, $concurso_opcion;

		// Load key parameters
		$this->RecKeys = $concurso_opcion->GetRecordKeys(); // Load record keys
		$sFilter = $concurso_opcion->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("concurso_opcionlist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in concurso_opcion class, concurso_opcioninfo.php

		$concurso_opcion->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$concurso_opcion->CurrentAction = $_POST["a_delete"];
		} else {
			$concurso_opcion->CurrentAction = "I"; // Display record
		}
		switch ($concurso_opcion->CurrentAction) {
			case "D": // Delete
				$concurso_opcion->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($concurso_opcion->getReturnUrl()); // Return to caller
				}
		}
	}

// No functions
	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $concurso_opcion;

		// Call Recordset Selecting event
		$concurso_opcion->Recordset_Selecting($concurso_opcion->CurrentFilter);

		// Load List page SQL
		$sSql = $concurso_opcion->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$concurso_opcion->Recordset_Selected($rs);
		return $rs;
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
		}

		// Call Row Rendered event
		if ($concurso_opcion->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$concurso_opcion->Row_Rendered();
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $concurso_opcion;
		$DeleteRows = TRUE;
		$sSql = $concurso_opcion->SQL();
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
				$DeleteRows = $concurso_opcion->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['idConcursoOpcion'];
				@unlink(ew_UploadPathEx(TRUE, $concurso_opcion->imagen->UploadPath) . $row['imagen']);
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($concurso_opcion->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($concurso_opcion->CancelMessage <> "") {
				$this->setFailureMessage($concurso_opcion->CancelMessage);
				$concurso_opcion->CancelMessage = "";
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
				$concurso_opcion->Row_Deleted($row);
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
