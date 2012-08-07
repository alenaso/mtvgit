<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$login = new clogin();
$Page =& $login;

// Page init
$login->Page_Init();

// Page main
$login->Page_Main();
?>
<?php include_once "header.php" ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<script type="text/javascript">
<!--
var login = new ew_Page("login");

// extend page with ValidateForm function
login.ValidateForm = function(fobj)
{
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (!ew_HasValue(fobj.username))
		return ew_OnError(this, fobj.username, ewLanguage.Phrase("EnterUid"));
	if (!ew_HasValue(fobj.password))
		return ew_OnError(this, fobj.password, ewLanguage.Phrase("EnterPwd"));

	// Call Form Custom Validate event
	if (!this.Form_CustomValidate(fobj)) return false;
	return true;
}

// extend page with Form_CustomValidate function
login.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// requires js validation
<?php if (EW_CLIENT_VALIDATE) { ?>
login.ValidateRequired = true;
<?php } else { ?>
login.ValidateRequired = false;
<?php } ?>

//-->
</script>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("LoginPage") ?></p>
<?php $login->ShowPageHeader(); ?>
<?php
$login->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return login.ValidateForm(this);">
<table border="0" cellspacing="0" cellpadding="4">
	<tr>
		<td><span class="phpmaker"><?php echo $Language->Phrase("Username") ?></span></td>
		<td><span class="phpmaker"><input type="text" name="username" id="username" size="20" value="<?php echo $login->Username ?>"></span></td>
	</tr>
	<tr>
		<td><span class="phpmaker"><?php echo $Language->Phrase("Password") ?></span></td>
		<td><span class="phpmaker"><input type="password" name="password" id="password" size="20"></span></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td><span class="phpmaker">
		<label><input type="radio" name="rememberme" id="rememberme" value="a"<?php if ($login->LoginType == "a") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AutoLogin") ?></label><br>
		<label><input type="radio" name="rememberme" id="rememberme" value="u"<?php if ($login->LoginType == "u") { ?>  checked="checked"<?php } ?>><?php echo $Language->Phrase("SaveUserName") ?></label><br>
		<label><input type="radio" name="rememberme" id="rememberme" value=""<?php if ($login->LoginType == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AlwaysAsk") ?></label>
		</span></td>
	</tr>
	<tr>
		<td colspan="2" align="center"><span class="phpmaker"><input type="submit" name="submit" id="submit" value="<?php echo ew_BtnCaption($Language->Phrase("Login")) ?>"></span></td>
	</tr>
</table>
</form>
<br>
<?php
$login->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your startup script here
// document.write("page loaded");
//-->

</script>
<?php include_once "footer.php" ?>
<?php
$login->Page_Terminate();
?>
<?php

//
// Page class
//
class clogin {

	// Page ID
	var $PageID = 'login';

	// Page object name
	var $PageObjName = 'login';

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
		return TRUE;
	}

	//
	// Page class constructor
	//
	function clogin() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'login', TRUE);

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
	var $Username;
	var $LoginType;

	//
	// Page main
	//
	function Page_Main() {
		global $Security, $Language, $UserProfile, $gsFormError;
		$sPassword = "";
		$sLastUrl = $Security->LastUrl(); // Get last URL
		if ($sLastUrl == "")
			$sLastUrl = "index.php";
		if (IsLoggingIn()) {
			$this->Username = @$_SESSION[EW_SESSION_USER_PROFILE_USER_NAME];
			$sPassword = @$_SESSION[EW_SESSION_USER_PROFILE_PASSWORD];
			$this->LoginType = @$_SESSION[EW_SESSION_USER_PROFILE_LOGIN_TYPE];
			$bValidPwd = $Security->ValidateUser($this->Username, $sPassword, FALSE);
			if ($bValidPwd) {
				$_SESSION[EW_SESSION_USER_PROFILE_USER_NAME] = "";
				$_SESSION[EW_SESSION_USER_PROFILE_PASSWORD] = "";
				$_SESSION[EW_SESSION_USER_PROFILE_LOGIN_TYPE] = "";
			}
		} else {
			if (!$Security->IsLoggedIn())
				$Security->AutoLogin();
			if (@$_POST["username"] <> "") {

				// Setup variables
				$this->Username = ew_RemoveXSS(ew_StripSlashes(@$_POST["username"]));
				$sPassword = ew_StripSlashes(@$_POST["password"]);
				$this->LoginType = strtolower(@$_POST["rememberme"]);
				$bValidate = $this->ValidateForm($this->Username, $sPassword);
				if (!$bValidate)
					$this->setFailureMessage($gsFormError);
				$_SESSION[EW_SESSION_USER_PROFILE_USER_NAME] = $this->Username; // Save login user name
				$_SESSION[EW_SESSION_USER_PROFILE_LOGIN_TYPE] = $this->LoginType; // Save login type
			} else {
				if ($Security->IsLoggedIn()) {
					if ($this->getFailureMessage() == "")
						$this->Page_Terminate($sLastUrl); // Return to last accessed page
				}
				$bValidate = FALSE;

				// Restore settings
				if (@$_COOKIE[EW_PROJECT_NAME]['Checksum'] == strval(crc32(md5(EW_RANDOM_KEY))))
					$this->Username = TEAdecrypt(@$_COOKIE[EW_PROJECT_NAME]['Username'], EW_RANDOM_KEY);
				if (@$_COOKIE[EW_PROJECT_NAME]['AutoLogin'] == "autologin") {
					$this->LoginType = "a";
				} elseif (@$_COOKIE[EW_PROJECT_NAME]['AutoLogin'] == "rememberusername") {
					$this->LoginType = "u";
				} else {
					$this->LoginType = "";
				}
			}
			$bValidPwd = FALSE;
			if ($bValidate) {

				// Call Logging In event
				$bValidate = $this->User_LoggingIn($this->Username, $sPassword);
				if ($bValidate) {
					$bValidPwd = $Security->ValidateUser($this->Username, $sPassword, FALSE); // Manual login
					if (!$bValidPwd) {
						if ($this->getFailureMessage() == "")
							$this->setFailureMessage($Language->Phrase("InvalidUidPwd")); // Invalid user id/password
					}
				} else {
					if ($this->getFailureMessage() == "")
						$this->setFailureMessage($Language->Phrase("LoginCancelled")); // Login cancelled
				}
			}
		}
		if ($bValidPwd) {

			// Write cookies
			if ($this->LoginType == "a") { // Auto login
				setcookie(EW_PROJECT_NAME . '[AutoLogin]',  "autologin", EW_COOKIE_EXPIRY_TIME); // Set autologin cookie
				setcookie(EW_PROJECT_NAME . '[Username]', TEAencrypt($this->Username, EW_RANDOM_KEY), EW_COOKIE_EXPIRY_TIME); // Set user name cookie
				setcookie(EW_PROJECT_NAME . '[Password]', TEAencrypt($sPassword, EW_RANDOM_KEY), EW_COOKIE_EXPIRY_TIME); // Set password cookie
				setcookie(EW_PROJECT_NAME . '[Checksum]', crc32(md5(EW_RANDOM_KEY)), EW_COOKIE_EXPIRY_TIME);
			} elseif ($this->LoginType == "u") { // Remember user name
				setcookie(EW_PROJECT_NAME . '[AutoLogin]', "rememberusername", EW_COOKIE_EXPIRY_TIME); // Set remember user name cookie
				setcookie(EW_PROJECT_NAME . '[Username]', TEAencrypt($this->Username, EW_RANDOM_KEY), EW_COOKIE_EXPIRY_TIME); // Set user name cookie
				setcookie(EW_PROJECT_NAME . '[Checksum]', crc32(md5(EW_RANDOM_KEY)), EW_COOKIE_EXPIRY_TIME);
			} else {
				setcookie(EW_PROJECT_NAME . '[AutoLogin]', "", EW_COOKIE_EXPIRY_TIME); // Clear auto login cookie
			}

			// Call loggedin event
			$this->User_LoggedIn($this->Username);
			$this->Page_Terminate($sLastUrl); // Return to last accessed URL
		} elseif ($this->Username <> "" && $sPassword <> "") {

			// Call user login error event
			$this->User_LoginError($this->Username, $sPassword);
		}
	}

	//
	// Validate form
	//
	function ValidateForm($usr, $pwd) {
		global $Language, $gsFormError;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;
		if (trim($usr) == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterUid"));
		}
		if (trim($pwd) == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterPwd"));
		}

		// Return validate result
		$ValidateForm = ($gsFormError == "");

		// Call Form Custom Validate event
		$sFormCustomError = "";
		$ValidateForm = $ValidateForm && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			ew_AddMessage($gsFormError, $sFormCustomError);
		}
		return $ValidateForm;
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

	// User Logging In event
	function User_LoggingIn($usr, &$pwd) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// User Logged In event
	function User_LoggedIn($usr) {

		//echo "User Logged In";
	}

	// User Login Error event
	function User_LoginError($usr, $pwd) {

		//echo "User Login Error";
	}

	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}
}
?>
