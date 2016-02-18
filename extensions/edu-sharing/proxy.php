<?php

session_name('my_wiki2_session');
if(!(empty($_GET['SID'])))
	session_id($_GET['SID']);
@session_start();
if(empty($_SESSION['wsUserName'])) {
	echo 'Please log in to enjoy edu-sharing content.';
	exit();
}

require_once ('classes/ESApp.php');

class edurender {
	public function getRedirectUrl($eduobj, $display_mode = 'inline') {
		
		if (empty ( $eduobj->contenturl )) {
			trigger_error ( 'No repository-content-url configured.' );
		}
		
		$url = $eduobj->contenturl;
		
		$app_id = $eduobj->appid;
		if (empty ( $app_id )) {
			trigger_error ( 'No application-app-id configured.', E_ERROR );
		}
		
		$url .= '?app_id=' . urlencode ( $app_id );
		
		$sessionId = $eduobj->SID;
		$url .= '&session=' . urlencode ( $sessionId );
		
		$rep_id = $eduobj->repid;
		if (empty ( $rep_id )) {
			trigger_error ( 'No repository-app-id configured.', E_ERROR );
		}
		
		$url .= '&rep_id=' . urlencode ( $rep_id );
		
		$resourceReference = $eduobj->id;
		if (empty ( $resourceReference )) {
			trigger_error ( 'No object-id returned.' );
		}
		
		$url .= '&obj_id=' . urlencode ( $resourceReference );
		
		$url .= '&resource_id=' . urlencode ( $eduobj->resourceid );
		$url .= '&course_id=' . urlencode ( $eduobj->pageid );
		
		$url .= '&display=' . urlencode ( $display_mode );
		
		$url .= '&width=' . urlencode ( $eduobj->width );
		$url .= '&height=' . urlencode ( $eduobj->height );
		
		$url .= '&language=' . urlencode ( $eduobj->language );
		
		return $url;
	}
	function getRenderHtml($url) {
		$inline = "";
		try {
			$curl_handle = curl_init ( $url );
			if (! $curl_handle) {
				throw new Exception ( 'Error initializing CURL.' );
			}
			
			curl_setopt ( $curl_handle, CURLOPT_FOLLOWLOCATION, 1 );
			curl_setopt ( $curl_handle, CURLOPT_HEADER, 0 );
			curl_setopt ( $curl_handle, CURLOPT_RETURNTRANSFER, 1 );
			curl_setopt ( $curl_handle, CURLOPT_USERAGENT, $_SERVER ['HTTP_USER_AGENT'] );
			curl_setopt ( $curl_handle, CURLOPT_SSL_VERIFYPEER, false );
			curl_setopt ( $curl_handle, CURLOPT_SSL_VERIFYHOST, false );
			
			$inline = curl_exec ( $curl_handle );
			curl_close ( $curl_handle );
		} catch ( Exception $e ) {
			error_log ( print_r ( $e, true ) );
			curl_close ( $curl_handle );
			return false;
		}
		
		return $inline;
	}
	
	
	function display($html, $eduobj, $conf) {
		
		global $wgScriptPath;
		
		$html = str_replace ( array (
				"\r\n",
				"\r",
				"\n" 
		), '', $html );
		//$html = str_replace ( '\'', '\\\'', $html );
		
		/*
		 * replaces {{{LMS_INLINE_HELPER_SCRIPT}}}
		 */
		$html = str_replace("{{{LMS_INLINE_HELPER_SCRIPT}}}", $conf -> prop_array['inline_helper'] . "?reUrl=".urlencode($this -> getRedirectUrl ($eduobj, 'window')) . "&SID=" . $_GET ['SID'], $html);
		
		/*
		 * replaces <es:title ...>...</es:title>
		 */
		$html = preg_replace ( "/<es:title[^>]*>.*<\/es:title>/Uims", $eduobj->printTitle, $html );
		/*
		 * For images, audio and video show a capture underneath object
		 */
		$mimetypes = array (
				'image',
				'video',
				'audio' 
		);
		foreach ( $mimetypes as $mimetype ) {
			if (strpos ( $eduobj->mimetype, $mimetype ) !== false)
				$html .= '<p class="caption">' . $eduobj->printTitle . '</p>';
		}
		
		echo $html;
	}
	
	public function getSecurityParams($conf) {
		$paramString = '';
		
		$ts = round ( microtime ( true ) * 1000 );
		$paramString .= '&ts=' . $ts;
		$ES_KEY = $conf -> prop_array['encrypt_key'];
		$ES_IV = $conf -> prop_array['encrypt_initvector'];
		$userNameEnc = urlencode ( base64_encode ( mcrypt_cbc ( MCRYPT_BLOWFISH, $ES_KEY, strtolower ( $_SESSION ['wsUserName'] ), MCRYPT_ENCRYPT, $ES_IV ) ) );
		$paramString .= '&u=' . $userNameEnc;
		
		$signature = '';
		$priv_key = $conf->prop_array ['private_key'];
		$pkeyid = openssl_get_privatekey ( $priv_key );
		openssl_sign ( $conf->prop_array ['appid'] . $ts, $signature, $pkeyid );
		$signature = base64_encode ( $signature );
		openssl_free_key ( $pkeyid );
		$paramString .= '&sig=' . urlencode ( $signature );
		$paramString .= '&signed=' . urlencode($conf -> prop_array['appid'].$ts);
		
		return $paramString;
	}
}

$edu_sharing = new stdClass ();

$edu_sharing->id = $_GET ['oid'];
$edu_sharing->appid = $_GET ['appid'];
$edu_sharing->repid = $_GET ['repid'];
$edu_sharing->resourceid = $_GET ['resid'];
$edu_sharing->height = $_GET ['height'];
$edu_sharing->width = $_GET ['width'];
$edu_sharing->mimetype = $_GET ['mime'];
$edu_sharing->pageid = $_GET ['pid'];
$edu_sharing->SID = $_GET ['SID'];
$edu_sharing->printTitle = $_GET ['printTitle'];
$edu_sharing->language = $_GET ['language'];

$es = new ESApp ();
$es->loadApps ();
$conf = $es->getHomeConf ();
$edu_sharing->contenturl = $conf->prop_array ['contenturl'];

$e = new edurender ();
$url = $e->getRedirectUrl ( $edu_sharing, 'inline' );

$url .= $e->getSecurityParams ( $conf );

$html = $e->getRenderHtml ( $url );
$e->display ( $html, $edu_sharing, $conf );
?>

