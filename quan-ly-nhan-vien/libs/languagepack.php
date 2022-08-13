<?php
    function label($id)
    {
        GLOBAL $lang;
        $sql = "Select data ";
        $sql.= "From languagepacks ";
        $sql.= "Where (LangId='$lang') and (id=$id)";
        $labelData = MySqlDataProvider::executeQuery($sql);
        $labelData = MySqlDataProvider::nextRow($labelData);
        if ($labelData!= null)
            return $labelData["data"];
        return "";
    }
    
    function LanguageList()
    {
        GLOBAL $lang;
        $sql = "Select * from languages order by LangName";
        $listData = MySqlDataProvider::executeQuery($sql);
        
        $listLang = '<select name="selectLang">';
        while ($row = MySqlDataProvider::nextRow($listData))
        {
            $langId = $row["LangId"];
            $langName = $row["LangName"];
            $selected = ($lang==$langId)?"Selected":"";
            $listLang.= '<option value="'.$langId.'" '.$selected.'>'.$langName.'</option>';
        }
        $listLang.= "</select>";
        
        return $listLang;
    }
    
    function GetLanguageIdList()
    {
        $sql = "Select LangId from languages order by LangName";
        $listData = MySqlDataProvider::executeQuery($sql);
        
        $listLang = array();
        while ($row = MySqlDataProvider::nextRow($listData))
        {
            $langId = $row["LangId"];
            $listLang[] = $langId;
        }
        
        return $listLang;      
    }
?>
