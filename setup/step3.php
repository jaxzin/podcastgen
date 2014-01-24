<?php
############################################################
# PODCAST GENERATOR
#
# Created by Alberto Betella
# http://podcastgen.sourceforge.net
# 
# This is Free Software released under the GNU/GPL License.
############################################################

include ('checkconfigexistence.php');

$PG_mainbody = NULL;

$awsAccessKey = $_POST['awsAccessKey'];
$awsSecretKey = $_POST['awsSecretKey'];
$s3bucket = $_POST['s3bucket'];

$PG_mainbody = '<form method="post" action="index.php?step=4">	
	';

$PG_mainbody .= '<p><b>'._("Choose a username and a password for the administration area:").'</b></p>
	<label for="username">'._("Username").'</label><br />

	<input name="username" id="username" type="text" size="20" maxlength="20" value=""><br /><br /><br />

	<label for="password">'._("Password:").'</label><br />

	<input type="password" id="password" name="password" size="20" maxlength="20"><br />

	<label for="password2">'._("Please type again your password:").'</label><br />
	<input type="password" id="password2" name="password2" size="20" maxlength="20"><br /><br />

	<input type="hidden" name="setuplanguage" value="'.$_POST['setuplanguage'].'">
	<input type="hidden" name="setupawsAccessKey" value="'.$_POST['awsAccessKey'].'">
	<input type="hidden" name="setupawsSecretKey" value="'.$_POST['awsSecretKey'].'">
	<input type="hidden" name="setups3bucket" value="'.$_POST['s3bucket'].'">
	<input type="submit" value="'._("Next").'">
	</form>';

//print output

echo $PG_mainbody;

?>

