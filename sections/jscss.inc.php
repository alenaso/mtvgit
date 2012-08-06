<link rel="stylesheet" type="text/css" href="styles/reset.css" />
<link rel="stylesheet" type="text/css" href="styles/ultimoanio.css"/>
<link rel="stylesheet" type="text/css" href="styles/jquery.jscrollpane.css"/>
<link rel="stylesheet" type="text/css" href="styles/autocomplete.css"/>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.js"></script>
<script src="http://code.jquery.com/ui/1.8.22/jquery-ui.min.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="js/jquery.jscrollpane.min.js"></script>
<script type="text/javascript" src="js/jquery.mousewheel.js"></script>
<script type="text/javascript" src="js/mwheelIntent.js"></script>
<script type="text/javascript" src="js/funciones.js?<?php echo rand(0,999999)?>"></script>

<!-- MTV SCRIPTS -->
<script type="text/javascript" src="http://www.mtvla.com/scripts/sm4/SocialMedia4Config.js"></script>
<script type="text/javascript" src="http://www.mtvla.com/scripts/yepnope/yepnope.min.js"></script>
<script type="text/javascript" src="http://www.mtvla.com/scripts/sm4/loadSm4.js"></script>
<script type="text/javascript">
/* <![CDATA[ */ jQuery(document).ready(function() {
jQuery(".sm4Widget").sm4();
});
/* ]]> */
</script>
<script type="text/javascript" src="http://aplicaciones.mtvla.com/sitewide/scripts/geo/esi_geo_js.php"></script>
<script type="text/javascript" src="http://btg.mtvnservices.com/aria/coda.html?site=mtvla.com"></script>
<script type="text/javascript">
	// Configure basic environment settings
	var prfx = 'tv/ultimo-ano/app';
	var dartSite = 'lamtv.com';
	var site_region = 'latam';
	var siteLang = 'es';
	
	//Initialize Controller
	mtvn.btg.Controller.init();
	
	//Send a page call
	var params = {
		pageName: prfx + "/" + com.mtvi.metadata.getDefaultPageName(),
		channel: prfx,
		hier2:  prfx + "/" + com.mtvi.metadata.getDefaultPageName(),
		prop1:  countryCode, // COUNTRY CODE
		prop2:  region, // REGION
		prop4:  siteLang // LANG
	};
	mtvn.btg.Controller.sendPageCall(params);
	
	//Set Default Site Sections for site
	com.mtvi.ads.AdManager.setDefaultSections("/"+ prfx + "/" + com.mtvi.metadata.getDefaultPageName());
</script>
<!-- CODA SETUP END -->