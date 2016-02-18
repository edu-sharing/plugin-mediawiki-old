<?php
/*
* $McLicense$
*
* $Id$
*
*/
include_once('../../dblog.inc.php');
$filename = substr(basename(__FILE__), 0, -4);

$ns = MC_ROOT_URI.'func/service/permission.php';

$xml = <<<PERMISSIONSERVICEWSDL
<?xml version="1.0" encoding="UTF-8"?>
<wsdl:definitions targetNamespace="http://permission.webservices.edu_sharing.org" xmlns:apachesoap="http://xml.apache.org/xml-soap" xmlns:impl="http://permission.webservices.edu_sharing.org" xmlns:intf="http://permission.webservices.edu_sharing.org" xmlns:wsdl="http://schemas.xmlsoap.org/wsdl/" xmlns:wsdlsoap="http://schemas.xmlsoap.org/wsdl/soap/" xmlns:xsd="http://www.w3.org/2001/XMLSchema">
<!--WSDL created by Apache Axis version: 1.4
Built on Apr 22, 2006 (06:55:48 PDT)-->

<!-- this is an campuscontent LMS Service for example for moodle to find out if the current user is allowed to remove usages
	 there is only a java stub under src-webservices
 -->
 <wsdl:types>
  <schema elementFormDefault="qualified" targetNamespace="http://permission.webservices.edu_sharing.org" xmlns="http://www.w3.org/2001/XMLSchema">
   <element name="checkCourse">
    <complexType>
     <sequence>
      <element name="in0" type="xsd:string"/>
      <element name="in1" type="xsd:int"/>
     </sequence>
    </complexType>
   </element>
   <element name="checkCourseResponse">
    <complexType>
     <sequence>
      <element name="checkCourseReturn" type="xsd:string"/>
     </sequence>
    </complexType>
   </element>
   <element name="getPermission">
    <complexType>
     <sequence>
      <element name="session" type="xsd:string"/>
      <element name="courseid" type="xsd:int"/>
      <element name="action" type="xsd:string"/>
      <element name="resourceid" type="xsd:string"/>
     </sequence>
    </complexType>
   </element>
   <element name="getPermissionResponse">
    <complexType>
     <sequence>
      <element name="getPermissionReturn" type="xsd:boolean"/>
     </sequence>
    </complexType>
   </element>
  </schema>
 </wsdl:types>
   <wsdl:message name="checkCourseResponse">
      <wsdl:part element="impl:checkCourseResponse" name="parameters"/>
   </wsdl:message>
   <wsdl:message name="checkCourseRequest">
      <wsdl:part element="impl:checkCourse" name="parameters"/>
   </wsdl:message>
   <wsdl:message name="getPermissionRequest">
      <wsdl:part element="impl:getPermission" name="parameters"/>
   </wsdl:message>
   <wsdl:message name="getPermissionResponse">
      <wsdl:part element="impl:getPermissionResponse" name="parameters"/>
   </wsdl:message>
   <wsdl:portType name="Permission">
      <wsdl:operation name="checkCourse">
         <wsdl:input message="impl:checkCourseRequest" name="checkCourseRequest"/>
         <wsdl:output message="impl:checkCourseResponse" name="checkCourseResponse"/>
      </wsdl:operation>
      <wsdl:operation name="getPermission">
         <wsdl:input message="impl:getPermissionRequest" name="getPermissionRequest"/>
         <wsdl:output message="impl:getPermissionResponse" name="getPermissionResponse"/>
      </wsdl:operation>
   </wsdl:portType>
   <wsdl:binding name="permissionSoapBinding" type="impl:Permission">
      <wsdlsoap:binding style="document" transport="http://schemas.xmlsoap.org/soap/http"/>
      <wsdl:operation name="checkCourse">
         <wsdlsoap:operation soapAction=""/>
         <wsdl:input name="checkCourseRequest">
            <wsdlsoap:body use="literal"/>
         </wsdl:input>
         <wsdl:output name="checkCourseResponse">
            <wsdlsoap:body use="literal"/>
         </wsdl:output>
      </wsdl:operation>
      <wsdl:operation name="getPermission">
         <wsdlsoap:operation soapAction=""/>
         <wsdl:input name="getPermissionRequest">
            <wsdlsoap:body use="literal"/>
         </wsdl:input>
         <wsdl:output name="getPermissionResponse">
            <wsdlsoap:body use="literal"/>
         </wsdl:output>
      </wsdl:operation>
   </wsdl:binding>
   <wsdl:service name="PermissionService">
      <wsdl:port binding="impl:permissionSoapBinding" name="permission">
         <wsdlsoap:address location="$ns"/>
      </wsdl:port>
   </wsdl:service>
</wsdl:definitions>
PERMISSIONSERVICEWSDL;

if ( empty($wsdl_write) )
{
	header('Content-Type: text/xml;charset='.MC_CHAR_SET);
  Header("Content-Disposition: attachment; filename=".$filename);
  Header("Pragma: no-cache");
  Header("Expires: 86400");
	die($xml);
}

$wdsl_path = MC_BASE_DIR.'func/service/permission.wsdl';
$wsdl_handle = fopen($wdsl_path, 'w+');
if (empty($wsdl_handle) )
{
	throw new Exception("error on fopen({$wdsl_path})");
}
fwrite($wsdl_handle, $xml);
fclose($wsdl_handle);