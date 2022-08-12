<?php
    function selfURL()
    { 
        $pageURL = 'http://';
//         if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
//         $pageURL .= "://";
         if ($_SERVER["SERVER_PORT"] != "80") {
          $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
         } else {
          $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
         }
         return $pageURL;
    }
    
    function createLink($url, $displaytext, $note)
    {
        $link = '';
        $link.= '<p>';
        $link.= '<a href="'.$url.'">'.$displaytext.'</a>';
        $link.= '<br/>'.$note;
        $link.= '</p>';
        return $link;
    }
?>