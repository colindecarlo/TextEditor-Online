<?php

//
//	FILE: fileHandler.php
//	PROJECT: A06_jQuery_JSON_AJAX
//	STUDENT: Felipe Flor
//	FIRST VERSION: 2018-01-12
//	DESCRIPTION: Server-side page that opens files to read or to write.
//


	// The file name (e.g. "file1.txt") and the action ("read" or "write") are sent via GET. 
    $fileName = $_GET["fileName"];
    $action = $_GET["action"];

    $jsonResponse = "";

    // Text content will not be provided in the case of Read requests.
    if (isset($_GET["textContent"]))
    {
        $textContent = $_GET["textContent"];
    }

    // If the requested action is for a read, put the contents of the file into jsonResponse.
    if ($action=="read")
    {
        $fileContent = "";

        // Personal note: die() is a php function that prints a message to the screen and terminates the script.
        $fileSrc = fopen($fileName, "r") or die("{\"feedback\":\"Error: File could not be read.\"}");
        while(!feof($fileSrc))
        {
            $fileContent = $fileContent.fgets($fileSrc);
        }

        fclose($fileSrc);

        $jsonResponse = "{\"fileContent\":\"$fileContent\",\"feedback\":\"Success!\"}";
    }
    // If the requested action is for a write, inform the requester whether or not the operation 
	// was successful in the jsonResponse 
    else if ($action=="write")
    {
        $targetFile = fopen($fileName, "w") or die("{\"feedback\":\"Error: File could not be saved.\"}");
        fwrite($targetFile, $textContent);
        fclose($targetFile);

        $jsonResponse = "{\"feedback\":\"Success!\"}";
    }
    // If the requested action is not supported.
    else
    {
        $jsonResponse = "{\"feedback\":\"Error: Unknown Action!\"}";
    }

    echo $jsonResponse;
?>