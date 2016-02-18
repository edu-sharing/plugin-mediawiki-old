<?php
/*
* $McLicense$
*
* $Id$
*
*/

function curPageURL() {
 $pageURL = 'http';
 if (!empty($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["SCRIPT_NAME"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["SCRIPT_NAME"];
 }
 return $pageURL;
}

$filename = substr(basename(__FILE__), 0, -4);


$ns = curPageURL();

$xml = <<<QNYXRESULTWSDL
<?xml version="1.0" encoding="UTF-8"?>
<wsdl:definitions targetNamespace="http://authentication.webservices.edu_sharing.org" xmlns:apachesoap="http://xml.apache.org/xml-soap" xmlns:impl="http://authentication.webservices.edu_sharing.org" xmlns:intf="http://authentication.webservices.edu_sharing.org" xmlns:wsdl="http://schemas.xmlsoap.org/wsdl/" xmlns:wsdlsoap="http://schemas.xmlsoap.org/wsdl/soap/" xmlns:xsd="http://www.w3.org/2001/XMLSchema">
<!--WSDL created by Apache Axis version: 1.4
Built on Apr 22, 2006 (06:55:48 PDT)-->
 <wsdl:types>
  <schema elementFormDefault="qualified" targetNamespace="http://authentication.webservices.edu_sharing.org" xmlns="http://www.w3.org/2001/XMLSchema">
   <element name="authenticateByApp">
    <complexType>
     <sequence>
      <element name="applicationId" type="xsd:string"/>
      <element name="username" type="xsd:string"/>

      <element name="email" type="xsd:string"/>
      <element name="ticket" type="xsd:string"/>
      <element name="createUser" type="xsd:boolean"/>
     </sequence>
    </complexType>
   </element>
   <element name="authenticateByAppResponse">
    <complexType>
     <sequence>

      <element name="authenticateByAppReturn" type="impl:AuthenticationResult"/>
     </sequence>
    </complexType>
   </element>
   <complexType name="AuthenticationResult">
    <sequence>
     <element name="courseId" nillable="true" type="xsd:string"/>
     <element name="email" nillable="true" type="xsd:string"/>
     <element name="givenname" nillable="true" type="xsd:string"/>

     <element name="sessionid" nillable="true" type="xsd:string"/>
     <element name="surname" nillable="true" type="xsd:string"/>
     <element name="ticket" nillable="true" type="xsd:string"/>
     <element name="username" nillable="true" type="xsd:string"/>
    </sequence>
   </complexType>
   <complexType name="AuthenticationException">
    <sequence>
     <element name="cause" nillable="true" type="xsd:anyType"/>

     <element name="message" nillable="true" type="xsd:string"/>
    </sequence>
   </complexType>
   <element name="fault" type="impl:AuthenticationException"/>
   <element name="authenticateByCAS">
    <complexType>
     <sequence>
      <element name="username" type="xsd:string"/>
      <element name="proxyTicket" type="xsd:string"/>

     </sequence>
    </complexType>
   </element>
   <element name="authenticateByCASResponse">
    <complexType>
     <sequence>
      <element name="authenticateByCASReturn" type="impl:AuthenticationResult"/>
     </sequence>
    </complexType>

   </element>
   <element name="checkTicket">
    <complexType>
     <sequence>
      <element name="username" type="xsd:string"/>
      <element name="ticket" type="xsd:string"/>
     </sequence>
    </complexType>
   </element>

   <element name="checkTicketResponse">
    <complexType>
     <sequence>
      <element name="checkTicketReturn" type="xsd:boolean"/>
     </sequence>
    </complexType>
   </element>
   <element name="authenticate">
    <complexType>

     <sequence>
      <element name="username" type="xsd:string"/>
      <element name="password" type="xsd:string"/>
     </sequence>
    </complexType>
   </element>
   <element name="authenticateResponse">
    <complexType>
     <sequence>

      <element name="authenticateReturn" type="impl:AuthenticationResult"/>
     </sequence>
    </complexType>
   </element>
  </schema>
 </wsdl:types>

   <wsdl:message name="authenticateByAppResponse">

      <wsdl:part element="impl:authenticateByAppResponse" name="parameters">

      </wsdl:part>

   </wsdl:message>

   <wsdl:message name="AuthenticationException">

      <wsdl:part element="impl:fault" name="fault">

      </wsdl:part>

   </wsdl:message>

   <wsdl:message name="checkTicketResponse">

      <wsdl:part element="impl:checkTicketResponse" name="parameters">

      </wsdl:part>

   </wsdl:message>

   <wsdl:message name="checkTicketRequest">

      <wsdl:part element="impl:checkTicket" name="parameters">

      </wsdl:part>

   </wsdl:message>

   <wsdl:message name="authenticateByCASResponse">

      <wsdl:part element="impl:authenticateByCASResponse" name="parameters">

      </wsdl:part>

   </wsdl:message>

   <wsdl:message name="authenticateByAppRequest">

      <wsdl:part element="impl:authenticateByApp" name="parameters">

      </wsdl:part>

   </wsdl:message>

   <wsdl:message name="authenticateResponse">

      <wsdl:part element="impl:authenticateResponse" name="parameters">

      </wsdl:part>

   </wsdl:message>

   <wsdl:message name="authenticateByCASRequest">

      <wsdl:part element="impl:authenticateByCAS" name="parameters">

      </wsdl:part>

   </wsdl:message>

   <wsdl:message name="authenticateRequest">

      <wsdl:part element="impl:authenticate" name="parameters">

      </wsdl:part>

   </wsdl:message>

   <wsdl:portType name="Authentication">

      <wsdl:operation name="authenticateByApp">

         <wsdl:input message="impl:authenticateByAppRequest" name="authenticateByAppRequest">

       </wsdl:input>

         <wsdl:output message="impl:authenticateByAppResponse" name="authenticateByAppResponse">

       </wsdl:output>

         <wsdl:fault message="impl:AuthenticationException" name="AuthenticationException">

       </wsdl:fault>

      </wsdl:operation>

      <wsdl:operation name="authenticateByCAS">

         <wsdl:input message="impl:authenticateByCASRequest" name="authenticateByCASRequest">

       </wsdl:input>

         <wsdl:output message="impl:authenticateByCASResponse" name="authenticateByCASResponse">

       </wsdl:output>

         <wsdl:fault message="impl:AuthenticationException" name="AuthenticationException">

       </wsdl:fault>

      </wsdl:operation>

      <wsdl:operation name="checkTicket">

         <wsdl:input message="impl:checkTicketRequest" name="checkTicketRequest">

       </wsdl:input>

         <wsdl:output message="impl:checkTicketResponse" name="checkTicketResponse">

       </wsdl:output>

         <wsdl:fault message="impl:AuthenticationException" name="AuthenticationException">

       </wsdl:fault>

      </wsdl:operation>

      <wsdl:operation name="authenticate">

         <wsdl:input message="impl:authenticateRequest" name="authenticateRequest">

       </wsdl:input>

         <wsdl:output message="impl:authenticateResponse" name="authenticateResponse">

       </wsdl:output>

         <wsdl:fault message="impl:AuthenticationException" name="AuthenticationException">

       </wsdl:fault>

      </wsdl:operation>

   </wsdl:portType>

   <wsdl:binding name="authenticationSoapBinding" type="impl:Authentication">

      <wsdlsoap:binding style="document" transport="http://schemas.xmlsoap.org/soap/http"/>

      <wsdl:operation name="authenticateByApp">

         <wsdlsoap:operation soapAction=""/>

         <wsdl:input name="authenticateByAppRequest">

            <wsdlsoap:body use="literal"/>

         </wsdl:input>

         <wsdl:output name="authenticateByAppResponse">

            <wsdlsoap:body use="literal"/>

         </wsdl:output>

         <wsdl:fault name="AuthenticationException">

            <wsdlsoap:fault name="AuthenticationException" use="literal"/>

         </wsdl:fault>

      </wsdl:operation>

      <wsdl:operation name="authenticateByCAS">

         <wsdlsoap:operation soapAction=""/>

         <wsdl:input name="authenticateByCASRequest">

            <wsdlsoap:body use="literal"/>

         </wsdl:input>

         <wsdl:output name="authenticateByCASResponse">

            <wsdlsoap:body use="literal"/>

         </wsdl:output>

         <wsdl:fault name="AuthenticationException">

            <wsdlsoap:fault name="AuthenticationException" use="literal"/>

         </wsdl:fault>

      </wsdl:operation>

      <wsdl:operation name="checkTicket">

         <wsdlsoap:operation soapAction=""/>

         <wsdl:input name="checkTicketRequest">

            <wsdlsoap:body use="literal"/>

         </wsdl:input>

         <wsdl:output name="checkTicketResponse">

            <wsdlsoap:body use="literal"/>

         </wsdl:output>

         <wsdl:fault name="AuthenticationException">

            <wsdlsoap:fault name="AuthenticationException" use="literal"/>

         </wsdl:fault>

      </wsdl:operation>

      <wsdl:operation name="authenticate">

         <wsdlsoap:operation soapAction=""/>

         <wsdl:input name="authenticateRequest">

            <wsdlsoap:body use="literal"/>

         </wsdl:input>

         <wsdl:output name="authenticateResponse">

            <wsdlsoap:body use="literal"/>

         </wsdl:output>

         <wsdl:fault name="AuthenticationException">

            <wsdlsoap:fault name="AuthenticationException" use="literal"/>

         </wsdl:fault>

      </wsdl:operation>

   </wsdl:binding>

    <wsdl:service name="AuthenticationService">
        <wsdl:port binding="impl:authenticationSoapBinding" name="authentication">
            <wsdlsoap:address location="$ns"/>
        </wsdl:port>
    </wsdl:service>
</wsdl:definitions>
QNYXRESULTWSDL;

if ( empty($wsdl_write) )
{
	header('Content-Type: text/xml;charset='.MC_CHAR_SET);
  Header("Content-Disposition: attachment; filename=".$filename);
  Header("Pragma: no-cache");
  Header("Expires: 86400");
	die($xml);
}

$wdsl_path = 'authentication.wsdl';
$wsdl_handle = fopen($wdsl_path, 'w+');
if (empty($wsdl_handle) )
{
	throw new Exception("error on fopen({$wdsl_path})");
}
fwrite($wsdl_handle, $xml);
fclose($wsdl_handle);