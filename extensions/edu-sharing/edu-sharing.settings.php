<?php
 
if ( !defined( 'MEDIAWIKI' ) ) {
	die( 'Not an entry point.' );
}

/*
 * Add module settings 
 */
 
 $wgExtensionMessagesFiles['edu-sharing'] = dirname( __FILE__ ) . '/edu-sharing.i18n.php';
 
 $wgResourceModules['ext.edu-sharing.dialog'] = array(
 'localBasePath' => "$IP/extensions/edu-sharing/",
 'remoteBasePath' => 'extensions/edu-sharing',
 'styles' => array('css/screen.css'),
 'scripts' => array('javascript/dialog.js'),
 'dependencies' => array(
    'jquery.wikiEditor',
    'jquery.wikiEditor.toolbar.i18n',
    'jquery.wikiEditor.toolbar',
    'jquery.wikiEditor.dialogs.config',
    'jquery.ui.dialog',
 ),
 'messages' => array(
    'wikieditor-toolbar-edusharing-title',
    'wikieditor-toolbar-edusharing-object',
    'wikieditor-toolbar-edusharing-search',
    'wikieditor-toolbar-edusharing-caption',
    'wikieditor-toolbar-edusharing-height',
    'wikieditor-toolbar-edusharing-width',
    'wikieditor-toolbar-edusharing-insert',
    'wikieditor-toolbar-edusharing-cancel',
    'wikieditor-toolbar-edusharing-px',
    'wikieditor-toolbar-edusharing-float',
    'wikieditor-toolbar-edusharing-float-left',
    'wikieditor-toolbar-edusharing-float-none',
    'wikieditor-toolbar-edusharing-float-right',
    'wikieditor-toolbar-edusharing-float-inline',
    'wikieditor-toolbar-edusharing-constrainPropoertions',
    'wikieditor-toolbar-edusharing-version',
    'wikieditor-toolbar-edusharing-version-latest',
    'wikieditor-toolbar-edusharing-version-current'
    )
 );
 
  $wgResourceModules['ext.edu-sharing.display'] = array(
    'scripts' => array('extensions/edu-sharing/javascript/jquery-near-viewport.min.js','extensions/edu-sharing/javascript/edu.js'),
  	'styles' => array('extensions/edu-sharing/css/filter.css'),
    'position' => 'top'
  );
  
  $eduIconMimeVideo = 'extensions/edu-sharing/images/video.png';
  $eduIconMimeAudio = 'extensions/edu-sharing/images/audio.png';

 