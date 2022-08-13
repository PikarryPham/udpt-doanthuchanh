<?php
    include_once("libs/date.php");
    
    function SaveUploadImage($fileControlName, $imageFolderName)
    {
        if (count($_FILES)>0 && $_FILES[$fileControlName]["name"]!="")
        {
            $tmpname = $_FILES[$fileControlName]["tmp_name"];
            $urlImage = "images/$imageFolderName/".CurrentDateTimeFileName()."-".$_FILES[$fileControlName]["name"];
            move_uploaded_file($tmpname, $urlImage);
            
            return $urlImage;
        }
        return "";
    }
?>