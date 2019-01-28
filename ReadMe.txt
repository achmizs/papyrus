Name: Papyrus
Version: 2019-01-28
Description: Skin for PmWiki
Author: Said Achmiz
Contact: said@saidachmiz.net
Copyright: Copyright 2019 Said Achmiz
xhtml validation: Passed (http://validator.w3.org/)

Files:
papyrus.tmpl - template file
papyrus.css - style sheet
papyrus.php - script file
papyrus.jpg - papyrus background
ReadMe.txt - this file

This skin is released under the GNU General Public License
as published by the Free Software Foundation; either version
2 of the License, or (at your option) any later version.


Installation:
1) Un-zip papyrus.zip into your skins directory
2) Enable the papyrus skin in your config.php with:

$Skin = 'papyrus';

Changelog

v. 2019-01-28
 * Added support for (:notitlegroup:) and (:titlegroup:) directives
 * Various tweaks and bug fixes

v. 2019-01-27
 * Switched to date-based versioning
 * CSS file is plain CSS now, not .php
 * Unified mobile and desktop style sheets
 * Various improvements to layout, especially mobile
 
 NOTE on upgrading from previous versions: the file 'papyrus-mobile.css' is no longer needed; you may delete it.

v. 0.2 2017-08-13
 * Papyrus now supports the following directives: (:noheader:), (:nofooter:), (:noaction:), (:notitle:), (:noright:)

v. 0.1 2017-08-13
 * original release