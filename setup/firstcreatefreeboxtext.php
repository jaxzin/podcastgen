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

if (file_exists("../freebox-content.txt")) { //if freebox text is already present

	echo "<font color=\"red\">"._("Freebox text already exists...")."</font><br />";


} else { // else create "freebox-content.txt" file in the root dir

// take the localized _("Uncategorized") variable in setup_LANGUAGE, depurate it and generate a unique id to use in the categories.xml file generated

$texttowrite = stripslashes(_("FREEBOX: in this box you can write freely what you wish: add links, text, HTML code through a visual editor from the admin section! You can optionally disable this feature if you don't need it...")); 
$texttowrite = htmlspecialchars($texttowrite);
$texttowrite = depurateContent($texttowrite);

// affiliate link
//$texttowrite .= '<p>put whatever here</p>';


$createtxtbox = fopen("$absoluteurl"."freebox-content.txt",'w'); //create categories file
fwrite($createtxtbox,$texttowrite); //write content into the file
fclose($createtxtbox);

}

?>