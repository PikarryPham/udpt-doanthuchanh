<?php
    function HTMLEncode($data)
    {
        return htmlentities($data, ENT_QUOTES, "UTF-8");
    }
    
    function HTMLDecode($data)
    {
        return html_entity_decode($data, ENT_QUOTES, "UTF-8");
    }
?>