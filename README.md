edu-sharing mediawiki extension
============================
This extension is for mediawiki 1.26.2 or higher versions.
More information about edu-sharing can be found on the [edu-sharing homepage](http://www.edu-sharing.com).

[Demo](http://stable.demo.edu-sharing.net/mwiki/)
--------------------------------------

Installation
------------
- Move the source files to your mediawiki extension folder ([MEDIAWIKI_INSTALL_DIR]/extensions/edu-sharing/).
- Add/adjust the following values in LocalSettings.php
  - $wgEnableParserCache = false;
  - $wgCachePages = false;
  - $wgDefaultUserOptions['usebetatoolbar'] = 1;
  - $wgDefaultUserOptions['usebetatoolbar-cgd'] = 1;
  - $wgAllowUserJs = true;
  - require_once( "$IP/extensions/WikiEditor/WikiEditor.php" );
  - require_once( "$IP/extensions/edu-sharing/edu-sharing.php" );
- Open [MEDIAWIKI_INSTALL_URL]/mw-config and upgrade your mediawiki to create table "edusharing_resource" in the database.

Extension registration
----------------------
At this moment this extension has no registration procedure so you have to register it manually.
- Adjust all extension and repository paths accordingly to your home repository in the following files
  - [MEDIAWIKI_INSTALL_DIR]/extensions/edu-sharing/conf/homeApplication.properties.xml
  - [MEDIAWIKI_INSTALL_DIR]/extensions/edu-sharing/edu-sharing.settings.php
- Change the ssl keypair in [MEDIAWIKI_INSTALL_DIR]/extensions/edu-sharing/conf/homeApplication.properties.xml. You really should do this to avoid a security gap.
- Register the extension in home repository

Contributing
------------
If you plan to contribute on a regular basis, please visit our [community site](http://edu-sharing-network.org/?lang=en).
