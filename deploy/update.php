<?php
include_once("config.php");

if ( trim(exec('whoami')) !== RUNNING_USER ) {
	die("Error: Please run with the specified user: ".RUNNING_USER);
}

print ("= Create ".TMP_PATH."api folder structure =\n");
system("rm -rf ".escapeshellarg(TMP_PATH));
mkdir(dirname($json_output['menu']), 0777, true);
mkdir(dirname($json_output['sponsors']), 0777, true);
mkdir(dirname($json_output['program']), 0777, true);
mkdir(dirname($json_output['news']), 0777, true);

$cwd = getcwd();

print ("= Last Commit =\n");
chdir (SRC_PATH);
system ("git log -1");
chdir ($cwd);
print ("\n");

// Copy all source files to a src tmp folder
system ('rsync -a --delete ' . SRC_PATH . ' ' . SRC_TMP_PATH);

print ("= Updating Dynamic Content (from Google Docs) =\n");
include ("update-dynamic-content.php");
print ("\n");

print ("= Compiling Content =\n");

chdir (MARKSITE_PATH);
include 'marksite.php';
chdir ($cwd);
print ("\n");

print ("= Writing menu.json.js =\n");
$fp = fopen ($json_output["menu"], "w");
$r = array();
foreach($marksite->menu as $locale => $menuitem)
{
  $r[$locale] = "<ul>" . $marksite->menu_recursion($menuitem['menu'], 1, 2, false) . "</ul>";
}
fwrite ($fp, json_encode($r));
fclose ($fp);
print ("\n");

# we don't support app cache now, but keep 'site.appcache' generated by marksite intact
if (file_exists(TMP_PATH.'site.appcache')) {
  print ("= Writing commit hashes to manifest =\n");
  $cwd = getcwd();
  chdir (THEME_PATH);
  $theme_hash = trim(system("git rev-parse HEAD"));
  chdir ($cwd);
  $fp = fopen(TMP_PATH.'site.appcache', "a");
  fwrite ($fp, "\n# THEME $theme_hash\n");
  print ("\n");
}

print ("= Syncing Content to target WEBSITE_PATH =\n");
system ('rsync -a ' . TMP_PATH . ' ' . WEBSITE_PATH);
print ("\n");

print ("= Copy assets to WEBSITE_PATH =\n");
system ('rsync -a --delete ' . THEME_PATH . 'assets/ ' . WEBSITE_PATH . 'assets/');
print ("\n");
