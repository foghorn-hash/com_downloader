<?php

/**
 * order Component for Joomla 1.0.+
 *
 * LICENSE: Open Source (GNU GPL)
 *
 * @copyright  2006-2010 i4ware Software
 * @license    http://www.gnu.org/copyleft/gpl.html
 * @version    $Id$ 1.0.0
 * @link       http://www.i4ware.fi/
 */ 

// no direct access
defined( '_VALID_MOS' ) or die( 'Restricted access' );

require_once( $mainframe->getPath( 'admin_html' ) );

switch ($task) {
	case 'saveconfig':
        saveconfig();
	break;  
	case 'config':
	# Variables - Don't change anything here!!!
  if (file_exists($mosConfig_absolute_path.'/administrator/components/com_downloader/config.downloader.php')) {
  require_once($mosConfig_absolute_path."/administrator/components/com_downloader/config.downloader.php"); }
	?>
	<form action="index.php?option=com_downloader&task=saveconfig" method="post">
	Email <input name="email" value="<?php echo $email; ?>" size="40" />
	<input type="submit" value="Save" />
	</form>
	<?php
	break; 	  
	case 'admin':
	echo "<div id=\"StudioID\"></div>";
	break;
	default:
	break;
}

function saveconfig(){
	
	global $mosConfig_absolute_path;
	
	// for security reasons we set variables to INT only
	
	$email_post = mosGetParam( $_POST, 'email' );
	
$copyright = "/**\n"
 ."* LICENSE: Open Source (GNU GPL)\n"
 ."*\n"
 ."* @copyright  2006-2010 i4ware Software\n"
 ."* @license    http://www.gnu.org/copyleft/gpl.html\n"
 ."* @version    $Id$ 1.0.0\n"
 ."* @link       http://www.i4ware.fi/\n"
 ."*/";
	
	$config = "<?php\n\n";
	$config .= $copyright."\n\n";
	$config .= "$";
	$config .= "email = \"".$email_post."\";\n";
	$config .= "\n"."?>";
	
	if ($fp = fopen($mosConfig_absolute_path
	.'/administrator/components/com_downloader/config.downloader.php', "w")) {
		fputs($fp, $config, strlen($config));
		fclose ($fp);

	    mosRedirect( "index2.php?option=com_downloader&task=config", "Success!" );
	
	} else {
		mosRedirect( "index2.php?option=com_downloader&task=config", "Error! config file not found!" );
	}


}

?>
