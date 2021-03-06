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

include ('checkconfigexistence.php');

$PG_mainbody = NULL; //define

//Get the XML document loaded into a variable (The xml parser must be previously included)
if (file_exists($absoluteurl."components/podcastgen_languages/podcastgen_languages.xml")) {
$parser = simplexml_load_file($absoluteurl.'components/podcastgen_languages/podcastgen_languages.xml','SimpleXMLElement',LIBXML_NOCDATA);
}

// define variables
$arr = NULL;
$arrid = NULL;
$n = 0;

foreach($parser->language as $singlelanguage)
{
	//echo $singlelanguage->id[0]->tagData."<br>";
	//echo $singlelanguage->description[0]->tagData;

	$arr[] .= $singlelanguage->description[0];
	$arrid[] .= $singlelanguage->id[0];
	$n++;
}


## SCRIPT LANGUAGES LIST

$PG_mainbody .= '

	<form method="post" action="index.php?step=2">

	<p><label for="setuplanguage"><b>Select Language</b></label></p>
	';
$PG_mainbody .= '<select name="setuplanguage">';


natcasesort($arr); // Natcasesort orders more naturally and is different from "sort", which is case sensitive


$browserlanguage = substr($_SERVER["HTTP_ACCEPT_LANGUAGE"],0,2); // Extract browser locale (en, es, it)
$browserlanguage .= '_'.strtoupper($browserlanguage); //this way we obtain the complete locale (e.g. en_EN, es_ES, it_IT) 

foreach ($arr as $key => $val) {



	$PG_mainbody .= '
		<option value="' . $arrid[$key] . '"';

	// PRE select the language in the form checking the browser language

	if (isset($browserlanguage) AND $browserlanguage == $arrid[$key]) {
		$PG_mainbody .= ' selected';
	}

	$PG_mainbody .= '>' . $val . '</option>
		';	

}
$PG_mainbody .= '</select>
	<br /><br />
	<input type="submit" value="'._("Next").'">
	</form>
	<br /><br />
	';


//print output

echo $PG_mainbody;

?>

