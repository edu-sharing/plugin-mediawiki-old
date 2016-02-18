<?php
/*
 * $McLicense$
 *
 * $Id$
 *
 */

//require_once 'WebStart.php';

require_once dirname(__FILE__) . '/../classes/edu-sharingWebService.php';
require_once dirname(__FILE__) . '/../classes/edu-sharingWS.php';
require_once dirname(__FILE__) . '/../classes/EsApplication.php';
require_once dirname(__FILE__) . '/../classes/EsApplications.php';
require_once dirname(__FILE__) . '/../classes/ESApp.php';

/**
 * Provides authentication services for repo connections
 * 
 */
class AuthenticationService {

    /**
     * Checks if a ticket is valid 
     * 
     * To validate a ticket the received username is compared with the username in the belonging session (received ticket as sessionId)
     * 
     * @param string $username
     * @param string $ticket
     * 
     * @return checkTicketReturn boolean
     * 
     */
    public function checkTicket($wrappedParams) {  
        
        $username = $wrappedParams -> username;
        $ticket = $wrappedParams -> ticket;
        
        $ret = new stdClass();

//weg damit
//$ret -> checkTicketReturn = true;
  //          return $ret;

//woher kommt die anfrage ohne username????
        
        if(empty($username) || ($username == 'guest' && $ticket == 'dummy')) {
            $ret -> checkTicketReturn = true;
            return $ret;
        }
        
        //weitere kombination
        // un = guest und tickt voranden, dann allerings $_SESSION['wsUserName'] noch nicht gesetzt
        
        //$fh = fopen('log.txt', 'a');
        //fputs($fh, $username . ' ' . $ticket);
        //fclose($fh);
        
        session_id($ticket);
        session_start();
        session_write_close();
        
        if(strtolower($_SESSION['wsUserName']) == $username || $username == 'guest') {
            $ret -> checkTicketReturn = true;
        }

        return $ret;

    }


    /**
     * 
     */
    public function authenticateByApp($wrappedParams) {
        global $data;
        return array('authenticateByAppReturn' => array('email' => 'guest', 'username' => 'guest'));
    }

    function isLoggedIn() {
        $session_cookie = 'wikidb_session';
        if (!isset($_COOKIE[$session_cookie])) {
            return false;
        }

        $url = ((isset($_SERVER['HTTPS'])) ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . (($_SERVER['SERVER_PORT'] != 80) ? ':' . $_SERVER['SERVER_PORT'] : '') . '/wiki/api.php?action=query&format=xml&meta=userinfo';

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_COOKIE, $session_cookie . '=' . $_COOKIE[$session_cookie]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        $ret = curl_exec($ch);
        curl_close($ch);

        return preg_match('/id="(\d+)"/', $ret, $id) && $id[1];
    }

}

$wsdl_write = true;
require_once ("authentication.wsdl.php");
// skipping problem with url_fopen

$server = new SoapServer('authentication.wsdl');
$server -> setClass("AuthenticationService");
$server -> handle();
