<?php 

session_name ( 'my_wiki2_session' );
session_id ( $_GET ['SID'] );
session_start ();

require_once ('classes/ESApp.php');

$redirect_url = $_GET['reUrl'];
$parts = parse_url($redirect_url);
parse_str($parts['query'], $query);

$es = new ESApp ();
$es->loadApps ();
$conf = $es->getHomeConf ();
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
openssl_sign ( $conf->prop_array ['appid'] . $ts . $query['obj_id'], $signature, $pkeyid );
$signature = base64_encode ( $signature );
openssl_free_key ( $pkeyid );
$paramString .= '&sig=' . urlencode ( $signature );
$paramString .= '&signed=' . urlencode($conf -> prop_array['appid'] . $ts . $query['obj_id']);
$paramString .= '&closeOnBack=true';

$encryptedTicket = '';
$repoPublicKey = openssl_get_publickey($conf->prop_array ['repo_public_key']);
openssl_public_encrypt($_SESSION["repository_ticket"] ,$encryptedTicket, $repoPublicKey);
if($encryptedTicket === false) {
    error_log('Error encrypting ticket.');
    exit();
}
$paramString .= '&ticket=' . urlencode(base64_encode($encryptedTicket));

$redirect_url .= $paramString;

header("Location: " . $redirect_url);
exit();

