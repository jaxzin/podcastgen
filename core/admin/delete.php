<?php
############################################################
# PODCAST GENERATOR
#
# Created by Alberto Betella
# http://podcastgen.sourceforge.net
# 
# This is Free Software released under the GNU/GPL License.
############################################################

########### Security code, avoids cross-site scripting (Register Globals ON)
if (isset($_REQUEST['GLOBALS']) OR isset($_REQUEST['absoluteurl']) OR isset($_REQUEST['amilogged']) OR isset($_REQUEST['theme_path'])) { exit; } 
########### End

### Check if user is logged ###
	if ($amilogged != "true") { exit; }
###

if (isset($_GET['file']) AND $_GET['file']!=NULL) {

	$file = $_GET['file']; 
	
		$file = str_replace("/", "", $file); // Replace / in the filename.. avoid deleting of file outside media directory - AVOID EXPLOIT with register globals set to ON

	$ext = $_GET['ext'];



	if (fileExists("$upload_dir$file.$ext")) {
		removeFile("$upload_dir$file.$ext");
		$PG_mainbody .="<p><b>$file.$ext</b> "._("has been deleted")."</p>";

	}

	if (fileExists("$upload_dir$file.xml")) {

		removeFile ("$upload_dir$file.xml"); // DELETE THE FILE

	}


	if (isset($_GET['img']) AND $_GET['img']!=NULL) { 

		$img = $_GET['img'];

		if (fileExists("$img_dir$img")) { // if associated image exists

			removeFile ("$img_dir$img"); // DELETE IMAGE FILE

			$PG_mainbody .="<p>"._("Image associated to this file deleted")."</p>";
		}

	} //end if isset image


	########## REGENERATE FEED
	include ("$absoluteurl"."core/admin/feedgenerate.php"); //(re)generate XML feed
	##########

	$PG_mainbody .= '<p><a href=?p=archive&amp;cat=all>'._("Delete other episodes").'</a></p>';

} else { 
	$PG_mainbody .= _("No file to delete...");
}
?>