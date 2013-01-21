<?php
############################################################
# PODCAST GENERATOR
#
# Created by Alberto Betella
# http://podcastgen.sourceforge.net
# 
# This is Free Software released under the GNU/GPL License.
############################################################


$testfile = "test.txt";

### define directories
$media_directory = "../media/";
$images_directory = "../images/";
$script_directory = "../";

## include language file
//if($scriptlang!=NULL) {
	//include("lang/setup_$scriptlang.php");
	//} else {
		//include("lang/setup_en.php");
		//}


		if (file_exists("../config.php")) { //if config.php already exists stop the script

			echo "<font color=\"red\">_("Config.php file already exists!")</font><br />_("Please delete this file before proceeding with the installation...")";

			exit;

		} 



		###############
		############### try to set writing permissions
		$PG_mainbody .= "<b>_("Now checking folders permissions")</b><br />";

		## checking media dir
		$fp = fopen("$media_directory$testfile",'a'); //create test file
		$content = "test";
		fwrite($fp,$content);
		fclose($fp);

		if (file_exists("$media_directory$testfile")) {

			$PG_mainbody .= "<p><font color=\"green\">_("Media Directory") _("is writable")</font></p>";
			unlink ("$media_directory$testfile");
			$dir1 = "ok";
		}
		else {
			$PG_mainbody .= "<p><font color=\"red\"><b>_("Media Directory") ".$media_directory." _("is NOT writable")</b></font></p>";
			$dir1 = "NO";
		}


		## checking images dir
		$fp1 = fopen("$images_directory$testfile",'a'); //create test file
		$content1 = "test";
		fwrite($fp1,$content1);
		fclose($fp1);

		if (file_exists("$images_directory$testfile")) {

			$PG_mainbody .= "<p><font color=\"green\">_("Images Directory") _("is writable")</font></p>";
			unlink ("$images_directory$testfile");
			$dir2 = "ok";
		}
		else {
			$PG_mainbody .= "<p><font color=\"red\"><b>_("Images Directory") ".$images_directory." _("is NOT writable")</b></font></p>";
			$dir2 = "NO";
		}


		## checking script root dir
		$fp2 = fopen("$script_directory$testfile",'a'); //create test file
		$content2 = "test";
		fwrite($fp2,$content2);
		fclose($fp2);

		if (file_exists("$script_directory$testfile")) {

			$PG_mainbody .=  "<p><font color=\"green\">_("Root Directory") _("is writable")</font></p>";
			unlink ("$script_directory$testfile");
			$dir3 = "ok";
		}
		else {
			$PG_mainbody .=  "<p><font color=\"red\"><b>_("Root Directory") ".$script_directory." _("is NOT writable")</b></font></p>";
			$dir3 = "NO";
		}


		if (isset($dir1) AND $dir1=="ok" AND isset($dir2) AND $dir2=="ok" AND isset($dir3) AND $dir3=="ok") { // OK CAN PROCEED

			$PG_mainbody .= "<br /><p><b>_("Directories have correct writing permissions")</b></p>";
			$PG_mainbody .=  "<p>_("You can proceed with Podcast Generator Installation...")</p>";

			$PG_mainbody .= '
				<form method="post" action="index.php?step=4">
				<br />
				<input type="hidden" name="setuplanguage" value="'.$_POST['setuplanguage'].'">
				<input type="submit" value="'._("Next").'">
				</form>
				';

		} else {

			$PG_mainbody .=  "<br /><br /><font color=\"red\"><b>_("Try to set writing permission:")</b></font>";

			if (isset($dir1) AND $dir1!="ok") {
				$PG_mainbody .=  "<br />_("Setting writing permission to") $media_directory (_("Media Directory"))";
				chmod("$media_directory", 0777);
			}
			if (isset($dir1) AND $dir2!="ok") {
				$PG_mainbody .=  "<br />_("Setting writing permission to") to $images_directory (_("Images Directory"))";
				chmod("$images_directory", 0777);
			}
			if (isset($dir1) AND $dir3!="ok") {
				$PG_mainbody .=  "<br />_("Setting writing permission to") $script_directory (_("Root Directory"))";
				chmod("$script_directory", 0777);
			}

			$PG_mainbody .=  "<br /><p><b>_("I tried to set writing permissions (chmod 777) to the directories listed above...")</b></p>";

			// reload button
			$PG_mainbody .= '
				<form method="post" action="index.php?step=3">
				<br />
				<input type="hidden" name="setuplanguage" value="'.$_POST['setuplanguage'].'">
				<input type="submit" value="'._("Reload this page").'">
				</form>
				';

			$PG_mainbody .=  "<p>_("and see if you can proceed with the installation of the script.")</p>";
			$PG_mainbody .=  "<p>_("...if not, set writing permission manually using your FTP program and be sure to have the privilege to change permission to folders on your server.")</p><br />";


		}



		#######
		####### end set permission
		?>