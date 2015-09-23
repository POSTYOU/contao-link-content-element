<?php

namespace postyou;


class LinkContentElement extends \Contao\Frontend
{
    function getContentElementHook($objElement, $strBuffer)
    {
        $replaceTarget="_self";
        $replaceStyle="";
        $replaceClass="linked_contentElement";
        $replaceURL=null;

        if (isset($objElement->row()["addLinkContentElement"]) && $objElement->row()["addLinkContentElement"]==="1") {

            if (isset($objElement->row()["elementHrefLink"]) && !empty($objElement->row()["elementHrefLink"]))
                $replaceURL =$objElement->row()["elementHrefLink"];

            if (isset($objElement->row()["elementHref_target"]) && $objElement->row()["elementHref_target"]==="1")
                $replaceTarget="_blank";

            if (isset($objElement->row()["elementHref_cursor"]) && $objElement->row()["elementHref_cursor"]==="1")
                $replaceStyle="style=\"cursor:pointer\"";

            $onclick="";
            if(isset($replaceURL))
                $onclick="onclick=\"window.open('". $replaceURL."','".$replaceTarget."');\"";

            $strBuffer = preg_replace("/div/", "div ".$replaceStyle."  title=\"".$objElement->row()["elementHrefTitle"]."\" ".$onclick, $strBuffer, 1);
            $strBuffer = preg_replace("/class=\"/", "class=\"" .$replaceClass." ", $strBuffer, 1);
        }
        return $strBuffer;

    }
}
