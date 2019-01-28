<?php if (!defined('PmWiki')) exit();

/*	PAPYRUS skin for PmWiki
	Copyright 2019 Said Achmiz

	Version:    2019-01-28-3

	More info at these URLs:
	
	* https://www.pmwiki.org/wiki/Skins/Papyrus
	* https://www.pmwiki.org/wiki/Profiles/SaidAchmiz

	The Papyrus skin includes:

	* papyrus.php (skin script file)
	* papyrus.css (style sheet)
	* papyrus.jpg (background pattern)
	* papyrus.tmpl (skin template)
	* ReadMe.txt (instructions & info)
	* wikilib.d/ (directory of bundled wikipages)
	*/

global $FmtPV;
$FmtPV['$SkinName'] = '"Papyrus"';
$FmtPV['$SkinVersion'] = '"2019-01-28-3"';

## Append the modification time to the URL as a GET parameter; this should be ignored
## by the web server, but is seen as part of the unique URL of the remote resource by
## the browser; when it changes (because the attachment has been modified), the 
## browser will see that it doesn’t have a cached version of the resource under the
## new URL, and will retrieve the updated version.
$filepath = "$SkinDir/papyrus.css";
$path = "$SkinDirUrl/papyrus.css";
$versioned_path = $path . "?v=" . filemtime($filepath);

global $VersionedAssetsReattachFileExtension;
if ($VersionedAssetsReattachFileExtension == true) {
	## Re-attach the file extension.
	preg_match("/\\.[^\\.]+$/", $path, $matches);
	$versioned_path .= $matches[0];
}

global $HTMLHeaderFmt;
$HTMLHeaderFmt[] = "<link rel='stylesheet' type='text/css' href='$versioned_path' />\n";

## Define a custom PageStore for bundled pages.
class PapyrusPageStore extends PageStore {
	function pagefile($pagename) {
		global $FarmD;
		$dfmt = $this->dirfmt;
		if ($pagename > '') {
			$pagename = str_replace('/', '.', $pagename);
			if ($dfmt == dirname(__FILE__).'/wikilib.d/{$FullName}')
				return $this->PFE(dirname(__FILE__)."/wikilib.d/$pagename");
			if ($dfmt == '$FarmD/pub/skins/papyrus/wikilib.d/{$FullName}')
				return $this->PFE("$FarmD/pub/skins/papyrus/wikilib.d/$pagename");
		}
		return $this->PFE(FmtPageName($dfmt, $pagename));
	}
}
global $WikiLibDirs, $RecipeInfo;
$PageStorePath = dirname(__FILE__).'/wikilib.d/{$FullName}';
$where = count($WikiLibDirs);
if ($where > 1) $where--;
if ($RecipeInfo['Sisterly']['Version'] != '') $where--;	// If Sisterly is enabled, then the last PageStore is the SisterStore, not the PmWiki stuff. So we have to insert at an index 1 less.
array_splice($WikiLibDirs, $where, 0, array(new PapyrusPageStore($PageStorePath)));

## Label the body element with a class indicating the current page action.
global $HTMLFooterFmt, $action;
$HTMLFooterFmt[] = "<script type='text/javascript'>document.querySelector('body').classList.add('action-{$action}');</script>";

## Enable the (:notitlegroup:) and (:titlegroup:) directives.
Markup('notitlegroup', 'directives',  '/\\(:notitlegroup:\\)/i', function ($m) {
	global $HTMLStylesFmt;
	$HTMLStylesFmt['papyrus-title-group'] = "#pageTitle .title-group { display: none; }";
});
Markup('titlegroup', 'directives',  '/\\(:titlegroup:\\)/i', function ($m) {
	global $HTMLStylesFmt;
	$HTMLStylesFmt['papyrus-title-group'] = "";
});
