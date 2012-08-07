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
$concurso_opcion_imagen_blobview = new cconcurso_opcion_imagen_blobview();
$Page =& $concurso_opcion_imagen_blobview;

// Page init
$concurso_opcion_imagen_blobview->Page_Init();

// Page main
$concurso_opcion_imagen_blobview->Page_Main();
?>
<?php
$concurso_opcion_imagen_blobview->Page_Terminate();
?>
<?php

//
// Page class
//
class cconcurso_opcion_imagen_blobview {

	// Page ID
	var $PageID = 'blobview';

	// Page object name
	var $PageObjName = 'concurso_opcion_imagen_blobview';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
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

	//
	// Page class constructor
	//
	function cconcurso_opcion_imagen_blobview() {
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
			define("EW_PAGE_ID", 'blobview', TRUE);

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
	var $Recordset;

	//
	// Page main
	//
	function Page_Main() {
		global $conn, $concurso_opcion;

		// Get key
		if (@$_GET["idConcursoOpcion"] <> "") {
			$concurso_opcion->idConcursoOpcion->setQueryStringValue($_GET["idConcursoOpcion"]);
		} else {
			$this->Page_Terminate(); // Exit
			exit();
		}
		$objBinary = new cUpload('concurso_opcion', 'x_imagen');

		// Show thumbnail
		$bShowThumbnail = (@$_GET["showthumbnail"] == "1");
		if (@$_GET["thumbnailwidth"] == "" && @$_GET["thumbnailheight"] == "") {
			$iThumbnailWidth = 200; // Set default width
			$iThumbnailHeight = 200; // Set default height
		} else {
			if (@$_GET["thumbnailwidth"] <> "") {
				$iThumbnailWidth = $_GET["thumbnailwidth"];
				if (!is_numeric($iThumbnailWidth) || $iThumbnailWidth < 0) $iThumbnailWidth = 0;
			}
			if (@$_GET["thumbnailheight"] <> "") {
				$iThumbnailHeight = $_GET["thumbnailheight"];
				if (!is_numeric($iThumbnailHeight) || $iThumbnailHeight < 0) $iThumbnailHeight = 0;
			}
		}
		if (@$_GET["quality"] <> "") {
			$quality = $_GET["quality"];
			if (!is_numeric($quality)) $quality = 75; // Set Default
		} else {
			$quality = 75;
		}
		$sFilter = $concurso_opcion->KeyFilter();

		// Set up filter (SQL WHERE clause) and get return SQL
		// SQL constructor in concurso_opcion class, concurso_opcioninfo.php

		$concurso_opcion->CurrentFilter = $sFilter;
		$sSql = $concurso_opcion->SQL();
		if ($this->Recordset = $conn->Execute($sSql)) {
			if (!$this->Recordset->EOF) {
				if (!EW_DEBUG_ENABLED && ob_get_length())
					ob_end_clean();
				if (strpos(ew_ServerVar("HTTP_USER_AGENT"), "MSIE") === FALSE)
					header("Content-type: images");
				$objBinary->Value = $this->Recordset->fields('imagen');
				$objBinary->Value = $objBinary->Value;
				if ($bShowThumbnail) {
					ew_ResizeBinary($objBinary->Value, $iThumbnailWidth, $iThumbnailHeight, $quality);
				}
				$data = $objBinary->Value;
				if (substr($data, 0, 2) == "PK" && strpos($data, "[Content_Types].xml") > 0 &&
					strpos($data, "_rels") > 0 && strpos($data, "docProps") > 0) { // Fix Office 2007 documents
					if (substr($data, -4) <> "\0\0\0\0")
						$data .= "\0\0\0\0";
				}
				echo $data;
			}
			$this->Recordset->Close();
		}
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
}
?>
