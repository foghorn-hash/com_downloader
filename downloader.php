<?php

/**
 * Component for Joomla 1.0.+
 *
 * LICENSE: Open Source (GNU GPL)
 *
 * @copyright  2006-2010 i4ware Software
 * @license    http://www.gnu.org/copyleft/gpl.html
 * @version    $Id$ 1.0.0
 * @link       http://www.i4ware.fi/
 */ 
 
# Don't allow direct linking
  defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
  
# Variables - Don't change anything here!!!
  if (file_exists($mosConfig_absolute_path.'/administrator/components/com_downloader/config.downloader.php')) {
  require_once($mosConfig_absolute_path."/administrator/components/com_downloader/config.downloader.php"); }
  
  # Get the right language if it exists
  if (file_exists($mosConfig_absolute_path.'/components/com_downloader/languages/'.$mosConfig_lang.'.php')) {
    include($mosConfig_absolute_path.'/components/com_downloader/languages/'.$mosConfig_lang.'.php');
  } else {
    include($mosConfig_absolute_path.'/components/com_downloader/languages/english.php');
  }

$now 		= date( 'Y-m-d H:i:s', time() );

switch ($task) {
	case 'submit':
	ob_clean();
	echo '{"success": true}';
	exit();
	break;
	default:
 
	$mainframe->addCustomHeadTag('<script type="text/javascript" src="http://api.recaptcha.net/js/recaptcha_ajax.js"></script>
<link rel="stylesheet" type="text/css" href="/components/com_downloader/ext/resources/css/ext-all.css" />
<script type="text/javascript" src="/components/com_downloader/ext/adapter/ext/ext-base.js"></script>
<script type="text/javascript" src="/components/com_downloader/ext/ext-all.js"></script>
	<link rel="stylesheet" type="text/css" href="/components/com_downloader/css/default.css" />
	<script type="text/javascript" src="/components/com_downloader/languages/'.$mosConfig_lang.'.js"></script>
	<script type="text/javascript" src="/components/com_downloader/downloader.js"></script>
	<script type="text/javascript" src="/components/com_downloader/Ext.ux.recaptcha.js"></script>	
	');
    echo "<h1>Contact Form</h1><div id=\"StudioID\"></div>"
	."";
	break;
}
	
?>