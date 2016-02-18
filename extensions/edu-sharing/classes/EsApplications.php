<?php
/**
 * Copyright (C) 2000  Author
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 */


/**
 * handles the current metacoon session
 *
 * @author steffen gross / matthias hupfer
 * @version 1.0
 * @package core
 * @subpackage classes.new
 */
class EsApplications
{
	protected $conf_file;
	protected $_list;

	/**
	 *
	 */
	public function __construct($p_conf_file)
	{

    $this->conf_file = $p_conf_file;

		return true;

	} // end constructor


	/**
	 *
	 */
	final public function addFile($p_filename)
	{
     $li   = $this->getFileList();
     $li[] = $p_filename;
     $this->updateList($li);

     return true;
	}

	final public function deleteFile($p_filename)
	{
     $li   = $this->getFileList();
     $pos = array_search($p_filename,$li);
     if ($pos !== false){
        unset($li[$pos]);
     	}

     $this->updateList($li);

    		return true;
	}

	final public function updateList($p_filearray)
	{
		$app_str = implode(',',$p_filearray);

		if (file_exists($this->conf_file)) {
			$l_DOMDocument = new DOMDocument();
			$l_DOMDocument->load($this->conf_file);
		}
		$list = $l_DOMDocument->getElementsByTagName('entry');

	foreach ($list as $entry)
		{
		 if ($entry->getAttribute("key")=="applicationfiles" ){
        $entry->nodeValue = $app_str;
			  break;
		 }
    }

			$l_DOMDocument->save($this->conf_file);
    	return true;
	}


	/**
	 *
	 */
	final public function getFileList()
	{
		if (file_exists($this->conf_file)) {
			$l_DOMDocument = new DOMDocument();
			$l_DOMDocument->load($this->conf_file);
		}
		$list = $l_DOMDocument->getElementsByTagName('entry');

	foreach ($list as $entry)
		{
		 if ($entry->getAttribute("key")=="applicationfiles" ){
			   $app_str  = $entry->nodeValue;
			   break;
		 }
    }

		$app_array = explode(',',$app_str);

		return $app_array;
	}

	/**
	 *
	 */
	final public function getHtmlList($path,$target)
	{

  $list   = $this->getFileList();

  $htmllist='<SELECT NAME="esappconflist" onchange="var s = this.options[this.selectedIndex].text;parent.'.$target.'.location.href=\''.$path.'?sel=\'+s">';

      $htmllist.='<option value="">-- select --</option>';


 	foreach ($list as $key => $val)
		{
      $htmllist.='<option value="'.$key.'">'.$val.'</option>';
    }

  $htmllist.='</SELECT >';

		return $htmllist;
	}



} // end class mc_Session

?>
