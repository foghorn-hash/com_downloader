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

function com_install() {
  global $database, $mosConfig_absolute_path;

  # Show installation result to user
  ?>
  <center>
  <table width="100%" border="0">
    <tr>
      <td>
        <strong>Product Downloader Component</strong><br/>
      </td>
    </tr>
    <tr>
      <td background="F0F0F0" colspan="2">
         <font color="green"><b>Installation finished.</b></font></code>
      </td>
    </tr>
  </table>
  </center>
  <?php
}
?>
