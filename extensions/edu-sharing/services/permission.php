<?php
/*
* $McLicense$
*
* $Id$
*
*/


class PermissionService {
	public function getPermission($wrappedParams) {		
		return (array("getPermissionReturn" => true) );
	}
}


$wsdl_write = true;

$server = new SoapServer('permission.wsdl');
$server->setClass("PermissionService");
$server->handle();