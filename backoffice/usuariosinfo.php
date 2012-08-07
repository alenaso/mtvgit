<?php

// Global variable for table object
$usuarios = NULL;

//
// Table class for usuarios
//
class cusuarios {
	var $TableVar = 'usuarios';
	var $TableName = 'usuarios';
	var $TableType = 'TABLE';
	var $idUsuario;
	var $nombre;
	var $apellido;
	var $nombreCompleto;
	var $nacimiento;
	var $lugar;
	var $facebookId;
	var $imagen;
	var $sexo;
	var $zemail;
	var $fechaAlta;
	var $IP;
	var $fields = array();
	var $UseTokenInUrl = EW_USE_TOKEN_IN_URL;
	var $Export; // Export
	var $ExportOriginalValue = EW_EXPORT_ORIGINAL_VALUE;
	var $ExportAll = TRUE;
	var $ExportPageBreakCount = 0; // Page break per every n record (PDF only)
	var $SendEmail; // Send email
	var $TableCustomInnerHtml; // Custom inner HTML
	var $BasicSearchKeyword; // Basic search keyword
	var $BasicSearchType; // Basic search type
	var $CurrentFilter; // Current filter
	var $CurrentOrder; // Current order
	var $CurrentOrderType; // Current order type
	var $RowType; // Row type
	var $CssClass; // CSS class
	var $CssStyle; // CSS style
	var $RowAttrs = array(); // Row custom attributes

	// Reset attributes for table object
	function ResetAttrs() {
		$this->CssClass = "";
		$this->CssStyle = "";
    	$this->RowAttrs = array();
		foreach ($this->fields as $fld) {
			$fld->ResetAttrs();
		}
	}

	// Setup field titles
	function SetupFieldTitles() {
		foreach ($this->fields as &$fld) {
			if (strval($fld->FldTitle()) <> "") {
				$fld->EditAttrs["onmouseover"] = "ew_ShowTitle(this, '" . ew_JsEncode3($fld->FldTitle()) . "');";
				$fld->EditAttrs["onmouseout"] = "ew_HideTooltip();";
			}
		}
	}
	var $TableFilter = "";
	var $CurrentAction; // Current action
	var $LastAction; // Last action
	var $CurrentMode = ""; // Current mode
	var $UpdateConflict; // Update conflict
	var $EventName; // Event name
	var $EventCancelled; // Event cancelled
	var $CancelMessage; // Cancel message
	var $AllowAddDeleteRow = TRUE; // Allow add/delete row
	var $DetailAdd = FALSE; // Allow detail add
	var $DetailEdit = FALSE; // Allow detail edit
	var $GridAddRowCount = 5;

	// Check current action
	// - Add
	function IsAdd() {
		return $this->CurrentAction == "add";
	}

	// - Copy
	function IsCopy() {
		return $this->CurrentAction == "copy" || $this->CurrentAction == "C";
	}

	// - Edit
	function IsEdit() {
		return $this->CurrentAction == "edit";
	}

	// - Delete
	function IsDelete() {
		return $this->CurrentAction == "D";
	}

	// - Confirm
	function IsConfirm() {
		return $this->CurrentAction == "F";
	}

	// - Overwrite
	function IsOverwrite() {
		return $this->CurrentAction == "overwrite";
	}

	// - Cancel
	function IsCancel() {
		return $this->CurrentAction == "cancel";
	}

	// - Grid add
	function IsGridAdd() {
		return $this->CurrentAction == "gridadd";
	}

	// - Grid edit
	function IsGridEdit() {
		return $this->CurrentAction == "gridedit";
	}

	// - Insert
	function IsInsert() {
		return $this->CurrentAction == "insert" || $this->CurrentAction == "A";
	}

	// - Update
	function IsUpdate() {
		return $this->CurrentAction == "update" || $this->CurrentAction == "U";
	}

	// - Grid update
	function IsGridUpdate() {
		return $this->CurrentAction == "gridupdate";
	}

	// - Grid insert
	function IsGridInsert() {
		return $this->CurrentAction == "gridinsert";
	}

	// - Grid overwrite
	function IsGridOverwrite() {
		return $this->CurrentAction == "gridoverwrite";
	}

	// Check last action
	// - Cancelled
	function IsCanceled() {
		return $this->LastAction == "cancel" && $this->CurrentAction == "";
	}

	// - Inline inserted
	function IsInlineInserted() {
		return $this->LastAction == "insert" && $this->CurrentAction == "";
	}

	// - Inline updated
	function IsInlineUpdated() {
		return $this->LastAction == "update" && $this->CurrentAction == "";
	}

	// - Grid updated
	function IsGridUpdated() {
		return $this->LastAction == "gridupdate" && $this->CurrentAction == "";
	}

	// - Grid inserted
	function IsGridInserted() {
		return $this->LastAction == "gridinsert" && $this->CurrentAction == "";
	}

	//
	// Table class constructor
	//
	function cusuarios() {
		global $Language;
		$this->AllowAddDeleteRow = ew_AllowAddDeleteRow(); // Allow add/delete row

		// idUsuario
		$this->idUsuario = new cField('usuarios', 'usuarios', 'x_idUsuario', 'idUsuario', '`idUsuario`', 21, -1, FALSE, '`idUsuario`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->idUsuario->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['idUsuario'] =& $this->idUsuario;

		// nombre
		$this->nombre = new cField('usuarios', 'usuarios', 'x_nombre', 'nombre', '`nombre`', 200, -1, FALSE, '`nombre`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['nombre'] =& $this->nombre;

		// apellido
		$this->apellido = new cField('usuarios', 'usuarios', 'x_apellido', 'apellido', '`apellido`', 200, -1, FALSE, '`apellido`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['apellido'] =& $this->apellido;

		// nombreCompleto
		$this->nombreCompleto = new cField('usuarios', 'usuarios', 'x_nombreCompleto', 'nombreCompleto', '`nombreCompleto`', 200, -1, FALSE, '`nombreCompleto`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['nombreCompleto'] =& $this->nombreCompleto;

		// nacimiento
		$this->nacimiento = new cField('usuarios', 'usuarios', 'x_nacimiento', 'nacimiento', '`nacimiento`', 200, -1, FALSE, '`nacimiento`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['nacimiento'] =& $this->nacimiento;

		// lugar
		$this->lugar = new cField('usuarios', 'usuarios', 'x_lugar', 'lugar', '`lugar`', 200, -1, FALSE, '`lugar`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['lugar'] =& $this->lugar;

		// facebookId
		$this->facebookId = new cField('usuarios', 'usuarios', 'x_facebookId', 'facebookId', '`facebookId`', 20, -1, FALSE, '`facebookId`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->facebookId->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['facebookId'] =& $this->facebookId;

		// imagen
		$this->imagen = new cField('usuarios', 'usuarios', 'x_imagen', 'imagen', '`imagen`', 200, -1, FALSE, '`imagen`', FALSE, FALSE, 'IMAGE');
		$this->fields['imagen'] =& $this->imagen;

		// sexo
		$this->sexo = new cField('usuarios', 'usuarios', 'x_sexo', 'sexo', '`sexo`', 200, -1, FALSE, '`sexo`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['sexo'] =& $this->sexo;

		// email
		$this->zemail = new cField('usuarios', 'usuarios', 'x_zemail', 'email', '`email`', 200, -1, FALSE, '`email`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['email'] =& $this->zemail;

		// fechaAlta
		$this->fechaAlta = new cField('usuarios', 'usuarios', 'x_fechaAlta', 'fechaAlta', '`fechaAlta`', 135, 5, FALSE, '`fechaAlta`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fechaAlta->FldDefaultErrMsg = str_replace("%s", "/", $Language->Phrase("IncorrectDateYMD"));
		$this->fields['fechaAlta'] =& $this->fechaAlta;

		// IP
		$this->IP = new cField('usuarios', 'usuarios', 'x_IP', 'IP', '`IP`', 200, -1, FALSE, '`IP`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['IP'] =& $this->IP;
	}

	// Get field values
	function GetFieldValues($propertyname) {
		$values = array();
		foreach ($this->fields as $fldname => $fld)
			$values[$fldname] =& $fld->$propertyname;
		return $values;
	}

	// Table caption
	function TableCaption() {
		global $Language;
		return $Language->TablePhrase($this->TableVar, "TblCaption");
	}

	// Page caption
	function PageCaption($Page) {
		global $Language;
		$Caption = $Language->TablePhrase($this->TableVar, "TblPageCaption" . $Page);
		if ($Caption == "") $Caption = "Page " . $Page;
		return $Caption;
	}

	// Export return page
	function ExportReturnUrl() {
		$url = @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_EXPORT_RETURN_URL];
		return ($url <> "") ? $url : ew_CurrentPage();
	}

	function setExportReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_EXPORT_RETURN_URL] = $v;
	}

	// Records per page
	function getRecordsPerPage() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_REC_PER_PAGE];
	}

	function setRecordsPerPage($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_REC_PER_PAGE] = $v;
	}

	// Start record number
	function getStartRecordNumber() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_START_REC];
	}

	function setStartRecordNumber($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_START_REC] = $v;
	}

	// Search highlight name
	function HighlightName() {
		return "usuarios_Highlight";
	}

	// Advanced search
	function getAdvancedSearch($fld) {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ADVANCED_SEARCH . "_" . $fld];
	}

	function setAdvancedSearch($fld, $v) {
		if (@$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ADVANCED_SEARCH . "_" . $fld] <> $v) {
			$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ADVANCED_SEARCH . "_" . $fld] = $v;
		}
	}

	// Basic search keyword
	function getSessionBasicSearchKeyword() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_BASIC_SEARCH];
	}

	function setSessionBasicSearchKeyword($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_BASIC_SEARCH] = $v;
	}

	// Basic search type
	function getSessionBasicSearchType() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_BASIC_SEARCH_TYPE];
	}

	function setSessionBasicSearchType($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_BASIC_SEARCH_TYPE] = $v;
	}

	// Search WHERE clause
	function getSearchWhere() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_SEARCH_WHERE];
	}

	function setSearchWhere($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_SEARCH_WHERE] = $v;
	}

	// Single column sort
	function UpdateSort(&$ofld) {
		if ($this->CurrentOrder == $ofld->FldName) {
			$sSortField = $ofld->FldExpression;
			$sLastSort = $ofld->getSort();
			if ($this->CurrentOrderType == "ASC" || $this->CurrentOrderType == "DESC") {
				$sThisSort = $this->CurrentOrderType;
			} else {
				$sThisSort = ($sLastSort == "ASC") ? "DESC" : "ASC";
			}
			$ofld->setSort($sThisSort);
			$this->setSessionOrderBy($sSortField . " " . $sThisSort); // Save to Session
		} else {
			$ofld->setSort("");
		}
	}

	// Session WHERE clause
	function getSessionWhere() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_WHERE];
	}

	function setSessionWhere($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_WHERE] = $v;
	}

	// Session ORDER BY
	function getSessionOrderBy() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ORDER_BY];
	}

	function setSessionOrderBy($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ORDER_BY] = $v;
	}

	// Session key
	function getKey($fld) {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_KEY . "_" . $fld];
	}

	function setKey($fld, $v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_KEY . "_" . $fld] = $v;
	}

	// Table level SQL
	function SqlFrom() { // From
		return "`usuarios`";
	}

	function SqlSelect() { // Select
		return "SELECT * FROM " . $this->SqlFrom();
	}

	function SqlWhere() { // Where
		$sWhere = "";
		$this->TableFilter = "";
		ew_AddFilter($sWhere, $this->TableFilter);
		return $sWhere;
	}

	function SqlGroupBy() { // Group By
		return "";
	}

	function SqlHaving() { // Having
		return "";
	}

	function SqlOrderBy() { // Order By
		return "";
	}

	// Check if Anonymous User is allowed
	function AllowAnonymousUser() {
		switch (EW_PAGE_ID) {
			case "add":
			case "register":
			case "addopt":
				return FALSE;
			case "edit":
			case "update":
				return FALSE;
			case "delete":
				return FALSE;
			case "view":
				return FALSE;
			case "search":
				return FALSE;
			default:
				return FALSE;
		}
	}

	// Apply User ID filters
	function ApplyUserIDFilters($sFilter) {
		return $sFilter;
	}

	// Get SQL
	function GetSQL($where, $orderby) {
		return ew_BuildSelectSql($this->SqlSelect(), $this->SqlWhere(),
			$this->SqlGroupBy(), $this->SqlHaving(), $this->SqlOrderBy(),
			$where, $orderby);
	}

	// Table SQL
	function SQL() {
		$sFilter = $this->CurrentFilter;
		$sFilter = $this->ApplyUserIDFilters($sFilter);
		$sSort = $this->getSessionOrderBy();
		return ew_BuildSelectSql($this->SqlSelect(), $this->SqlWhere(),
			$this->SqlGroupBy(), $this->SqlHaving(), $this->SqlOrderBy(),
			$sFilter, $sSort);
	}

	// Table SQL with List page filter
	function SelectSQL() {
		$sFilter = $this->getSessionWhere();
		ew_AddFilter($sFilter, $this->CurrentFilter);
		$sFilter = $this->ApplyUserIDFilters($sFilter);
		$sSort = $this->getSessionOrderBy();
		return ew_BuildSelectSql($this->SqlSelect(), $this->SqlWhere(), $this->SqlGroupBy(),
			$this->SqlHaving(), $this->SqlOrderBy(), $sFilter, $sSort);
	}

	// Try to get record count
	function TryGetRecordCount($sSql) {
		global $conn;
		$cnt = -1;
		if ($this->TableType == 'TABLE' || $this->TableType == 'VIEW') {
			$sSql = "SELECT COUNT(*) FROM" . substr($sSql, 13);
		} else {
			$sSql = "SELECT COUNT(*) FROM (" . $sSql . ") EW_COUNT_TABLE";
		}
		if ($rs = $conn->Execute($sSql)) {
			if (!$rs->EOF && $rs->FieldCount() > 0) {
				$cnt = $rs->fields[0];
				$rs->Close();
			}
		}
		return intval($cnt);
	}

	// Get record count based on filter (for detail record count in master table pages)
	function LoadRecordCount($sFilter) {
		$origFilter = $this->CurrentFilter;
		$this->CurrentFilter = $sFilter;
		$this->Recordset_Selecting($this->CurrentFilter);
		$sSql = $this->SQL();
		$cnt = $this->TryGetRecordCount($sSql);
		if ($cnt == -1) {
			if ($rs = $this->LoadRs($this->CurrentFilter)) {
				$cnt = $rs->RecordCount();
				$rs->Close();
			}
		}
		$this->CurrentFilter = $origFilter;
		return intval($cnt);
	}

	// Get record count (for current List page)
	function SelectRecordCount() {
		global $conn;
		$origFilter = $this->CurrentFilter;
		$this->Recordset_Selecting($this->CurrentFilter);
		$sSql = $this->SelectSQL();
		$cnt = $this->TryGetRecordCount($sSql);
		if ($cnt == -1) {
			if ($rs = $conn->Execute($this->SelectSQL())) {
				$cnt = $rs->RecordCount();
				$rs->Close();
			}
		}
		$this->CurrentFilter = $origFilter;
		return intval($cnt);
	}

	// INSERT statement
	function InsertSQL(&$rs) {
		global $conn;
		$names = "";
		$values = "";
		foreach ($rs as $name => $value) {
			$names .= $this->fields[$name]->FldExpression . ",";
			$values .= ew_QuotedValue($value, $this->fields[$name]->FldDataType) . ",";
		}
		if (substr($names, -1) == ",") $names = substr($names, 0, strlen($names)-1);
		if (substr($values, -1) == ",") $values = substr($values, 0, strlen($values)-1);
		return "INSERT INTO `usuarios` ($names) VALUES ($values)";
	}

	// UPDATE statement
	function UpdateSQL(&$rs) {
		global $conn;
		$SQL = "UPDATE `usuarios` SET ";
		foreach ($rs as $name => $value) {
			$SQL .= $this->fields[$name]->FldExpression . "=";
			$SQL .= ew_QuotedValue($value, $this->fields[$name]->FldDataType) . ",";
		}
		if (substr($SQL, -1) == ",") $SQL = substr($SQL, 0, strlen($SQL)-1);
		if ($this->CurrentFilter <> "")	$SQL .= " WHERE " . $this->CurrentFilter;
		return $SQL;
	}

	// DELETE statement
	function DeleteSQL(&$rs) {
		$SQL = "DELETE FROM `usuarios` WHERE ";
		$SQL .= ew_QuotedName('idUsuario') . '=' . ew_QuotedValue($rs['idUsuario'], $this->idUsuario->FldDataType) . ' AND ';
		if (substr($SQL, -5) == " AND ") $SQL = substr($SQL, 0, strlen($SQL)-5);
		if ($this->CurrentFilter <> "")	$SQL .= " AND " . $this->CurrentFilter;
		return $SQL;
	}

	// Key filter WHERE clause
	function SqlKeyFilter() {
		return "`idUsuario` = @idUsuario@";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->idUsuario->CurrentValue))
			$sKeyFilter = "0=1"; // Invalid key
		$sKeyFilter = str_replace("@idUsuario@", ew_AdjustSql($this->idUsuario->CurrentValue), $sKeyFilter); // Replace key value
		return $sKeyFilter;
	}

	// Return page URL
	function getReturnUrl() {
		$name = EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL;

		// Get referer URL automatically
		if (ew_ServerVar("HTTP_REFERER") <> "" && ew_ReferPage() <> ew_CurrentPage() && ew_ReferPage() <> "login.php") // Referer not same page or login page
			$_SESSION[$name] = ew_ServerVar("HTTP_REFERER"); // Save to Session
		if (@$_SESSION[$name] <> "") {
			return $_SESSION[$name];
		} else {
			return "usuarioslist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// List URL
	function ListUrl() {
		return "usuarioslist.php";
	}

	// View URL
	function ViewUrl() {
		return $this->KeyUrl("usuariosview.php", $this->UrlParm());
	}

	// Add URL
	function AddUrl() {
		$AddUrl = "usuariosadd.php";

//		$sUrlParm = $this->UrlParm();
//		if ($sUrlParm <> "")
//			$AddUrl .= "?" . $sUrlParm;

		return $AddUrl;
	}

	// Edit URL
	function EditUrl($parm = "") {
		return $this->KeyUrl("usuariosedit.php", $this->UrlParm($parm));
	}

	// Inline edit URL
	function InlineEditUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
	}

	// Copy URL
	function CopyUrl($parm = "") {
		return $this->KeyUrl("usuariosadd.php", $this->UrlParm($parm));
	}

	// Inline copy URL
	function InlineCopyUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
	}

	// Delete URL
	function DeleteUrl() {
		return $this->KeyUrl("usuariosdelete.php", $this->UrlParm());
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->idUsuario->CurrentValue)) {
			$sUrl .= "idUsuario=" . urlencode($this->idUsuario->CurrentValue);
		} else {
			return "javascript:alert(ewLanguage.Phrase('InvalidRecord'));";
		}
		return $sUrl;
	}

	// Sort URL
	function SortUrl(&$fld) {
		if ($this->CurrentAction <> "" || $this->Export <> "" ||
			in_array($fld->FldType, array(128, 204, 205))) { // Unsortable data type
				return "";
		} elseif ($fld->Sortable) {
			$sUrlParm = $this->UrlParm("order=" . urlencode($fld->FldName) . "&ordertype=" . $fld->ReverseSort());
			return ew_CurrentPage() . "?" . $sUrlParm;
		} else {
			return "";
		}
	}

	// Add URL parameter
	function UrlParm($parm = "") {
		$UrlParm = ($this->UseTokenInUrl) ? "t=usuarios" : "";
		if ($parm <> "") {
			if ($UrlParm <> "")
				$UrlParm .= "&";
			$UrlParm .= $parm;
		}
		return $UrlParm;
	}

	// Get record keys from $_POST/$_GET/$_SESSION
	function GetRecordKeys() {
		$arKeys = array();
		$arKey = array();
		if (isset($_POST["key_m"])) {
			$arKeys = ew_StripSlashes($_POST["key_m"]);
			$cnt = count($arKeys);
		} elseif (isset($_GET["key_m"])) {
			$arKeys = ew_StripSlashes($_GET["key_m"]);
			$cnt = count($arKeys);
		} elseif (isset($_GET)) {
			$arKeys[] = @$_GET["idUsuario"]; // idUsuario

			//return $arKeys; // do not return yet, so the values will also be checked by the following code
		}

		// check keys
		$ar = array();
		foreach ($arKeys as $key) {
			if (!is_numeric($key))
				continue;
			$ar[] = $key;
		}
		return $ar;
	}

	// Get key filter
	function GetKeyFilter() {
		$arKeys = $this->GetRecordKeys();
		$sKeyFilter = "";
		foreach ($arKeys as $key) {
			if ($sKeyFilter <> "") $sKeyFilter .= " OR ";
			$this->idUsuario->CurrentValue = $key;
			$sKeyFilter .= "(" . $this->KeyFilter() . ")";
		}
		return $sKeyFilter;
	}

	// Load rows based on filter
	function &LoadRs($sFilter) {
		global $conn;

		// Set up filter (SQL WHERE clause) and get return SQL
		$this->CurrentFilter = $sFilter;
		$sSql = $this->SQL();
		$rs = $conn->Execute($sSql);
		return $rs;
	}

	// Load row values from recordset
	function LoadListRowValues(&$rs) {
		$this->idUsuario->setDbValue($rs->fields('idUsuario'));
		$this->nombre->setDbValue($rs->fields('nombre'));
		$this->apellido->setDbValue($rs->fields('apellido'));
		$this->nombreCompleto->setDbValue($rs->fields('nombreCompleto'));
		$this->nacimiento->setDbValue($rs->fields('nacimiento'));
		$this->lugar->setDbValue($rs->fields('lugar'));
		$this->facebookId->setDbValue($rs->fields('facebookId'));
		$this->imagen->setDbValue($rs->fields('imagen'));
		$this->sexo->setDbValue($rs->fields('sexo'));
		$this->zemail->setDbValue($rs->fields('email'));
		$this->fechaAlta->setDbValue($rs->fields('fechaAlta'));
		$this->IP->setDbValue($rs->fields('IP'));
	}

	// Render list row values
	function RenderListRow() {
		global $conn, $Security;

		// Call Row Rendering event
		$this->Row_Rendering();

   // Common render codes
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
		// idUsuario

		$this->idUsuario->ViewValue = $this->idUsuario->CurrentValue;
		$this->idUsuario->ViewCustomAttributes = "";

		// nombre
		$this->nombre->ViewValue = $this->nombre->CurrentValue;
		$this->nombre->ViewCustomAttributes = "";

		// apellido
		$this->apellido->ViewValue = $this->apellido->CurrentValue;
		$this->apellido->ViewCustomAttributes = "";

		// nombreCompleto
		$this->nombreCompleto->ViewValue = $this->nombreCompleto->CurrentValue;
		$this->nombreCompleto->ViewCustomAttributes = "";

		// nacimiento
		$this->nacimiento->ViewValue = $this->nacimiento->CurrentValue;
		$this->nacimiento->ViewCustomAttributes = "";

		// lugar
		$this->lugar->ViewValue = $this->lugar->CurrentValue;
		$this->lugar->ViewCustomAttributes = "";

		// facebookId
		$this->facebookId->ViewValue = $this->facebookId->CurrentValue;
		$this->facebookId->ViewCustomAttributes = "";

		// imagen
		$this->imagen->ViewValue = $this->imagen->CurrentValue;
		$this->imagen->ImageWidth = 70;
		$this->imagen->ImageHeight = 70;
		$this->imagen->ImageAlt = $this->imagen->FldAlt();
		$this->imagen->ViewCustomAttributes = "";

		// sexo
		$this->sexo->ViewValue = $this->sexo->CurrentValue;
		$this->sexo->ViewCustomAttributes = "";

		// email
		$this->zemail->ViewValue = $this->zemail->CurrentValue;
		$this->zemail->ViewCustomAttributes = "";

		// fechaAlta
		$this->fechaAlta->ViewValue = $this->fechaAlta->CurrentValue;
		$this->fechaAlta->ViewValue = ew_FormatDateTime($this->fechaAlta->ViewValue, 5);
		$this->fechaAlta->ViewCustomAttributes = "";

		// IP
		$this->IP->ViewValue = $this->IP->CurrentValue;
		$this->IP->ViewCustomAttributes = "";

		// idUsuario
		$this->idUsuario->LinkCustomAttributes = "";
		$this->idUsuario->HrefValue = "";
		$this->idUsuario->TooltipValue = "";

		// nombre
		$this->nombre->LinkCustomAttributes = "";
		$this->nombre->HrefValue = "";
		$this->nombre->TooltipValue = "";

		// apellido
		$this->apellido->LinkCustomAttributes = "";
		$this->apellido->HrefValue = "";
		$this->apellido->TooltipValue = "";

		// nombreCompleto
		$this->nombreCompleto->LinkCustomAttributes = "";
		$this->nombreCompleto->HrefValue = "";
		$this->nombreCompleto->TooltipValue = "";

		// nacimiento
		$this->nacimiento->LinkCustomAttributes = "";
		$this->nacimiento->HrefValue = "";
		$this->nacimiento->TooltipValue = "";

		// lugar
		$this->lugar->LinkCustomAttributes = "";
		$this->lugar->HrefValue = "";
		$this->lugar->TooltipValue = "";

		// facebookId
		$this->facebookId->LinkCustomAttributes = "";
		$this->facebookId->HrefValue = "";
		$this->facebookId->TooltipValue = "";

		// imagen
		$this->imagen->LinkCustomAttributes = "";
		$this->imagen->HrefValue = "";
		$this->imagen->TooltipValue = "";

		// sexo
		$this->sexo->LinkCustomAttributes = "";
		$this->sexo->HrefValue = "";
		$this->sexo->TooltipValue = "";

		// email
		$this->zemail->LinkCustomAttributes = "";
		$this->zemail->HrefValue = "";
		$this->zemail->TooltipValue = "";

		// fechaAlta
		$this->fechaAlta->LinkCustomAttributes = "";
		$this->fechaAlta->HrefValue = "";
		$this->fechaAlta->TooltipValue = "";

		// IP
		$this->IP->LinkCustomAttributes = "";
		$this->IP->HrefValue = "";
		$this->IP->TooltipValue = "";

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Aggregate list row values
	function AggregateListRowValues() {
	}

	// Aggregate list row (for rendering)
	function AggregateListRow() {
	}

	// Export data in Xml Format
	function ExportXmlDocument(&$XmlDoc, $HasParent, &$Recordset, $StartRec, $StopRec, $ExportPageType = "") {
		if (!$Recordset || !$XmlDoc)
			return;
		if (!$HasParent)
			$XmlDoc->AddRoot($this->TableVar);

		// Move to first record
		$RecCnt = $StartRec - 1;
		if (!$Recordset->EOF) {
			$Recordset->MoveFirst();
			if ($StartRec > 1)
				$Recordset->Move($StartRec - 1);
		}
		while (!$Recordset->EOF && $RecCnt < $StopRec) {
			$RecCnt++;
			if (intval($RecCnt) >= intval($StartRec)) {
				$RowCnt = intval($RecCnt) - intval($StartRec) + 1;
				$this->LoadListRowValues($Recordset);

				// Render row
				$this->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->ResetAttrs();
				$this->RenderListRow();
				if ($HasParent)
					$XmlDoc->AddRow($this->TableVar);
				else
					$XmlDoc->AddRow();
				if ($ExportPageType == "view") {
					$XmlDoc->AddField('idUsuario', $this->idUsuario->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('nombre', $this->nombre->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('apellido', $this->apellido->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('nombreCompleto', $this->nombreCompleto->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('nacimiento', $this->nacimiento->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('lugar', $this->lugar->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('facebookId', $this->facebookId->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('imagen', $this->imagen->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('sexo', $this->sexo->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('zemail', $this->zemail->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('fechaAlta', $this->fechaAlta->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('IP', $this->IP->ExportValue($this->Export, $this->ExportOriginalValue));
				} else {
					$XmlDoc->AddField('idUsuario', $this->idUsuario->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('nombre', $this->nombre->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('apellido', $this->apellido->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('nombreCompleto', $this->nombreCompleto->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('nacimiento', $this->nacimiento->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('lugar', $this->lugar->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('facebookId', $this->facebookId->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('imagen', $this->imagen->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('sexo', $this->sexo->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('zemail', $this->zemail->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('fechaAlta', $this->fechaAlta->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('IP', $this->IP->ExportValue($this->Export, $this->ExportOriginalValue));
				}
			}
			$Recordset->MoveNext();
		}
	}

	// Export data in HTML/CSV/Word/Excel/Email/PDF format
	function ExportDocument(&$Doc, &$Recordset, $StartRec, $StopRec, $ExportPageType = "") {
		if (!$Recordset || !$Doc)
			return;

		// Write header
		$Doc->ExportTableHeader();
		if ($Doc->Horizontal) { // Horizontal format, write header
			$Doc->BeginExportRow();
			if ($ExportPageType == "view") {
				$Doc->ExportCaption($this->idUsuario);
				$Doc->ExportCaption($this->nombre);
				$Doc->ExportCaption($this->apellido);
				$Doc->ExportCaption($this->nombreCompleto);
				$Doc->ExportCaption($this->nacimiento);
				$Doc->ExportCaption($this->lugar);
				$Doc->ExportCaption($this->facebookId);
				$Doc->ExportCaption($this->imagen);
				$Doc->ExportCaption($this->sexo);
				$Doc->ExportCaption($this->zemail);
				$Doc->ExportCaption($this->fechaAlta);
				$Doc->ExportCaption($this->IP);
			} else {
				$Doc->ExportCaption($this->idUsuario);
				$Doc->ExportCaption($this->nombre);
				$Doc->ExportCaption($this->apellido);
				$Doc->ExportCaption($this->nombreCompleto);
				$Doc->ExportCaption($this->nacimiento);
				$Doc->ExportCaption($this->lugar);
				$Doc->ExportCaption($this->facebookId);
				$Doc->ExportCaption($this->imagen);
				$Doc->ExportCaption($this->sexo);
				$Doc->ExportCaption($this->zemail);
				$Doc->ExportCaption($this->fechaAlta);
				$Doc->ExportCaption($this->IP);
			}
			if ($this->Export == "pdf") {
				$Doc->EndExportRow(TRUE);
			} else {
				$Doc->EndExportRow();
			}
		}

		// Move to first record
		$RecCnt = $StartRec - 1;
		if (!$Recordset->EOF) {
			$Recordset->MoveFirst();
			if ($StartRec > 1)
				$Recordset->Move($StartRec - 1);
		}
		while (!$Recordset->EOF && $RecCnt < $StopRec) {
			$RecCnt++;
			if (intval($RecCnt) >= intval($StartRec)) {
				$RowCnt = intval($RecCnt) - intval($StartRec) + 1;

				// Page break for PDF
				if ($this->Export == "pdf" && $this->ExportPageBreakCount > 0) {
					if ($RowCnt > 1 && ($RowCnt - 1) % $this->ExportPageBreakCount == 0)
						$Doc->ExportPageBreak();
				}
				$this->LoadListRowValues($Recordset);

				// Render row
				$this->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->ResetAttrs();
				$this->RenderListRow();
				$Doc->BeginExportRow($RowCnt); // Allow CSS styles if enabled
				if ($ExportPageType == "view") {
					$Doc->ExportField($this->idUsuario);
					$Doc->ExportField($this->nombre);
					$Doc->ExportField($this->apellido);
					$Doc->ExportField($this->nombreCompleto);
					$Doc->ExportField($this->nacimiento);
					$Doc->ExportField($this->lugar);
					$Doc->ExportField($this->facebookId);
					$Doc->ExportField($this->imagen);
					$Doc->ExportField($this->sexo);
					$Doc->ExportField($this->zemail);
					$Doc->ExportField($this->fechaAlta);
					$Doc->ExportField($this->IP);
				} else {
					$Doc->ExportField($this->idUsuario);
					$Doc->ExportField($this->nombre);
					$Doc->ExportField($this->apellido);
					$Doc->ExportField($this->nombreCompleto);
					$Doc->ExportField($this->nacimiento);
					$Doc->ExportField($this->lugar);
					$Doc->ExportField($this->facebookId);
					$Doc->ExportField($this->imagen);
					$Doc->ExportField($this->sexo);
					$Doc->ExportField($this->zemail);
					$Doc->ExportField($this->fechaAlta);
					$Doc->ExportField($this->IP);
				}
				$Doc->EndExportRow();
			}
			$Recordset->MoveNext();
		}
		$Doc->ExportTableFooter();
	}

	// Row styles
	function RowStyles() {
		$sAtt = "";
		$sStyle = trim($this->CssStyle);
		if (@$this->RowAttrs["style"] <> "")
			$sStyle .= " " . $this->RowAttrs["style"];
		$sClass = trim($this->CssClass);
		if (@$this->RowAttrs["class"] <> "")
			$sClass .= " " . $this->RowAttrs["class"];
		if (trim($sStyle) <> "")
			$sAtt .= " style=\"" . trim($sStyle) . "\"";
		if (trim($sClass) <> "")
			$sAtt .= " class=\"" . trim($sClass) . "\"";
		return $sAtt;
	}

	// Row attributes
	function RowAttributes() {
		$sAtt = $this->RowStyles();
		if ($this->Export == "") {
			foreach ($this->RowAttrs as $k => $v) {
				if ($k <> "class" && $k <> "style" && trim($v) <> "")
					$sAtt .= " " . $k . "=\"" . trim($v) . "\"";
			}
		}
		return $sAtt;
	}

	// Field object by name
	function fields($fldname) {
		return $this->fields[$fldname];
	}

	// Table level events
	// Recordset Selecting event
	function Recordset_Selecting(&$filter) {

		// Enter your code here	
	}

	// Recordset Selected event
	function Recordset_Selected(&$rs) {

		//echo "Recordset Selected";
	}

	// Recordset Search Validated event
	function Recordset_SearchValidated() {

		// Example:
		//$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value

	}

	// Recordset Searching event
	function Recordset_Searching(&$filter) {

		// Enter your code here	
	}

	// Row_Selecting event
	function Row_Selecting(&$filter) {

		// Enter your code here	
	}

	// Row Selected event
	function Row_Selected(&$rs) {

		//echo "Row Selected";
	}

	// Row Inserting event
	function Row_Inserting($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Inserted event
	function Row_Inserted($rsold, &$rsnew) {

		//echo "Row Inserted"
	}

	// Row Updating event
	function Row_Updating($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Updated event
	function Row_Updated($rsold, &$rsnew) {

		//echo "Row Updated";
	}

	// Row Update Conflict event
	function Row_UpdateConflict($rsold, &$rsnew) {

		// Enter your code here
		// To ignore conflict, set return value to FALSE

		return TRUE;
	}

	// Row Deleting event
	function Row_Deleting(&$rs) {

		// Enter your code here
		// To cancel, set return value to False

		return TRUE;
	}

	// Row Deleted event
	function Row_Deleted(&$rs) {

		//echo "Row Deleted";
	}

	// Email Sending event
	function Email_Sending(&$Email, &$Args) {

		//var_dump($Email); var_dump($Args); exit();
		return TRUE;
	}

	// Row Rendering event
	function Row_Rendering() {

		// Enter your code here	
	}

	// Row Rendered event
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>); 

	}
}
?>
