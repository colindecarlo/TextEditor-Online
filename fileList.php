<?php

//
//	FILE: fileList.php
//	PROJECT: A06_jQuery_JSON_AJAX
//	STUDENT: Felipe Flor
//	FIRST VERSION: 2018-01-12
//	DESCRIPTION: Server-side page that returns a json string with the list of files in the directory.
//



	//
	//	FUNCTION:	isTextFile
	//	DESCRIPTION:
	//      Checks if a given file has extension txt. 
	//	PARAMETERS:
	//		string file - The file name being analyzed.
	//	RETURNS: True if the file has txt extension.
	//
	function isTextFile($file)
	{
		$isTxt = false;

		$components = explode(".",$file);
		$extension = $components[count($components)-1];
		if (strtoupper($extension) == "TXT")
		{
			$isTxt = true;
		}

		return $isTxt;
	}


	// 	Get all files in the current directory
	$allFiles = scandir(".");

	// Fill arrayOfOptions with all the text files from the current directory
	$arrayOfOptions = array();
	foreach ($allFiles as $thisFile)
	{
		if (isTextFile($thisFile))
		{
			array_push($arrayOfOptions,$thisFile);
		}
	}


	// Print only the JSON string as output.
	echo json_encode($arrayOfOptions, JSON_FORCE_OBJECT);

?>
