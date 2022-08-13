<?php
    function isAdminLogin()
    {
        if (!isset($_SESSION["admin"]))
            $_SESSION["admin"] = false;
        return $_SESSION["admin"];
    }
    
    function confirmDelete()
    {
        $confirm = '<script language="javascript">';
        $confirm.= '    function ConfirmDelete()
                        {
                            x = confirm("Are you sure to delete this item(s)?");
                            return x;
                        }
                    ';
        $confirm.= '</script>';
        
        return $confirm;
    }
    
    function MessageBox($msg)
    {
        $box = "";
        $box.= "<script language='javascript'>";
        $box.= '    alert("'.$msg.'");';
        $box.= "</script>";
        return $box;
    }
    
    function ApproveDeleteForm($approveAction, $deleteAction, $id, $needApproved)
    {
        $form = "";
        $form.= confirmDelete();
        
        if ($needApproved == true)
        {
            $form.= '<form class="admin" action="'.$approveAction.'" method="POST" >';
            $form.= '   <input type="image" src="images/control/deactive.png" width="15px" heigth="15px" title="Approve" />';
            $form.= '   <input type="hidden" name="id" value="'.$id.'"/>';
            $form.= '</form> ';    
        }
        else
        {
            $form.= '<form class="admin" action="'.$approveAction.'" method="POST" >';
            $form.= '   <input type="image" src="images/control/active.png" width="15px" heigth="15px" title="Un-Approved" />';
            $form.= '   <input type="hidden" name="id" value="'.$id.'"/>';
            $form.= '</form> ';
        }
        
        
        $form.= '<form class="admin" action="'.$deleteAction.'" method="POST" onsubmit="javacript:return ConfirmDelete();">';
        $form.= '   <input type="image" src="images/control/delete.png" width="15px" heigth="15px" title="Delete" />';
        $form.= '   <input type="hidden" name="id" value="'.$id.'"/>';
        $form.= '</form> ';
        
        return $form;
    }
    function EditDeleteForm($editAction, $deleteAction, $id)
    {
        $form = "";
        $form.= confirmDelete();
        //$form.= '<div>';
        $form.= '<form class="admin" action="'.$editAction.'" method="POST" >';
        $form.= '   <input type="image" src="images/control/edit.png" width="15px" heigth="15px" title="Edit" />';
        $form.= '   <input type="hidden" name="id" value="'.$id.'"/>';
        $form.= '</form> ';
        
        $form.= '<form class="admin" action="'.$deleteAction.'" method="POST" onsubmit="javacript:return ConfirmDelete();">';
        $form.= '   <input type="image" src="images/control/delete.png" width="15px" heigth="15px" title="Delete" />';
        $form.= '   <input type="hidden" name="id" value="'.$id.'"/>';
        $form.= '</form> ';
        //$form.= '</div>';
        
        return $form;
    }
    function EditForm($editAction, $id)
    {
        $form = "";
        $form.= confirmDelete();
        //$form.= '<div>';
        $form.= '<form class="admin" action="'.$editAction.'" method="POST">';
        $form.= '   <input type="image" src="images/control/edit.png" width="15px" heigth="15px" title="Edit" />';
        $form.= '   <input type="hidden" name="id" value="'.$id.'"/>';
        $form.= '</form> ';
        //$form.= '</div>';
        
        return $form;
    }
    
    function SaveCancelButtons()
    {
        $button = "";
        $button.= '<input type="image" src="images/control/save.png" width="32px" heigth="32px" title="Save" /> ';
        $button.= '<a href="index.php?action=cancel" ><img src="images/control/cancel.png" width="32px" heigth="32px" title="Cancel" /></a>';
        $button.= '<br/>';
        return $button;
    }
    
    function AddNewButtons($url, $title, $label)
    {
        $button = "";
        $button.= '<p> '.$label.'
                        <a href="'.$url.'">
                            <img src="images/control/add.png" width="20px" heigth="20px" title="'.$title.'"/>
                        </a>
                  </p>';
        return $button;
    }
    
    function ShowStatus($url, $title, $id)
    {
        $button = "";
        $button.= '<form class="admin" method="POST" action="'.$url.'">';
        $button.= '     <input type="image" src="images/control/hide.gif" width="10px" heigth="10px" title="'.$title.'"/>';
        $button.= '     <input type="hidden" name="id" value="'.$id.'"/>';
        $button.= '</form>';
        return $button;
    }
    
    function HideStatus($url, $title, $id)
    {
        $button = "";
        $button.= '<form class="admin" method="POST" action="'.$url.'">';
        $button.= '     <input type="image" src="images/control/show.gif" width="10px" heigth="10px" title="'.$title.'"/>';
        $button.= '     <input type="hidden" name="id" value="'.$id.'"/>';
        $button.= '</form>';
        return $button;
    }
    
    function ShowHideCombo($selected)
    {
        $combo = "";
        $combo.= '<select name="showhide">';
        $combo.= '  <option value="1" '.(($selected==1)?'"selected"':'').'>Show</option>';
        $combo.= '  <option value="0" '.(($selected==0)?'"selected"':'').'>Hide</option>';
        $combo.= '</select>';
        return $combo;
    }
    
    function MenuOrderCombo($tableName, $selected)
    {
        $sql = "Select max(MenuOrder) from $tableName";
        $data = MySqlDataProvider::executeQuery($sql);
        $maxValue = MySqlDataProvider::firstCell($data) + 1;
        
        $combo = '<select name="MenuOrder">';
        for ($i=0; $i<=$maxValue; $i++)
            if ($i==$selected)
                $combo.= '  <option value="'.$i.'" "selected">'.$i.'</option>';
            else
                $combo.= '  <option value="'.$i.'">'.$i.'</option>';
        $combo.= '</select>';
        return $combo;
    }
    
    function CatalogyCombo($curId, $parentId)
    {
        GLOBAL $lang;
        
        // Lay cai cat o root !
        $sql = "Select c.CatId, c.ShowInfo, cd.CatName, c.ParentCatId
                from categories c join categorydetail cd on c.CatId=cd.CatId
                where (cd.LangId='$lang')and (c.CatId=c.ParentCatId) order by c.MenuOrder";
        $data = MySqlDataProvider::executeQuery($sql);
        
        $combo = '<select name="ParentCatId">';
        if ($curId != -1)
        {
            if ($curId == $parentId)
                $combo.= '  <option value="0" "selected">[Root]</option>';
            else
                $combo.= '  <option value="0">[Root]</option>';
        }
            
        while ($cat=MySqlDataProvider::nextRow($data))
        {
            $catId          = $cat["CatId"];
            $catShowInfo    = $cat["ShowInfo"];
            $catName        = $cat["CatName"];
            $catParentId    = $cat["ParentCatId"];
            $color          = ($catShowInfo==0)?"color:Gray;":"color:Black;";
            
            if ($catId == $parentId)
                $combo.= '  <option selected="selected" value="'.$catId.'" style="font-weight:bold;'.$color.'">'.$catName.'</option>';
            else
                $combo.= '  <option value="'.$catId.'" style="font-weight:bold;'.$color.'">'.$catName.'</option>';
            
            //echo $parentId."-->";
            $combo.= SubCatComboOption($catId, $parentId, "----");
        }
        $combo.= '</select>';
        
        return $combo;
    }
    
    function SubCatComboOption($curCat, $selectedParent, $splitmark)
    {
        GLOBAL $lang;
        $sql = "Select c.CatId, c.ShowInfo, cd.CatName, c.ParentCatId    
                from categories c join categorydetail cd on c.CatId=cd.CatId
                where (cd.LangId='$lang') and (c.ParentCatId=$curCat) and (c.CatId<>c.ParentCatId) order by c.MenuOrder";
        $data = MySqlDataProvider::executeQuery($sql);
        
        $comboOption = "";
        while ($row=MySqlDataProvider::nextRow($data))
        {
            $catIdz          = $row["CatId"];
            $catShowInfo    = $row["ShowInfo"];
            $catName        = $row["CatName"];
            $catParentId    = $row["ParentCatId"];   
            $color          = ($catShowInfo==0)?"color:Gray;":"color:Black;";
            
            if ($catIdz == $selectedParent)
                $comboOption.= '<option selected="selected" value="'.$catIdz .'" style="'.$color.'">'.$splitmark.$catName.'</option>';
            else
                $comboOption.= '<option value="'.$catIdz .'" style="'.$color.'">'.$splitmark.$catName.'</option>';
                
            //echo $selectedParent."-->";
            $comboOption.= SubCatComboOption($catIdz, $selectedParent, $splitmark."----");
        }
        
        return $comboOption;
    }
    
    function AgentComboOption($MenuLevel, $selectedId)
    {
        GLOBAL $lang;
        $agentOption = "";
        
        $agentOption.= '<select name="agentlist">';
        $agentOption.= '    <option value="0" '.(($selectedId==0)?'selected':'').'>[Root]</option>';
        
        $sql = "Select a.AgentId, a.ParentAgentId, ad.AgentName
                from agent a join agentdetail ad on a.AgentId=ad.AgentId
                where (ad.LangId='$lang') and (a.isBranch=0) and (a.AgentId=a.ParentAgentId) and
                (a.Longitude is null) and (Latitude is null)";
        $rootAgents = MySqlDataProvider::executeQuery($sql);
        while ($rootagent = MySqlDataProvider::nextRow($rootAgents))
        {
            $rootid = $rootagent["AgentId"];
            $rootname = $rootagent["AgentName"];
            $agentOption.= '<option value="'.$rootid.'" '.(($MenuLevel==2)?'style="font-weight:bold;"':' ').(($selectedId==$rootid)?'selected':'').'>'.$rootname.'</option>';
            
            if ($MenuLevel == 2)
            {
                // tao option cap 2
                $sql = "Select a.AgentId, a.ParentAgentId, ad.AgentName
                        from agent a join agentdetail ad on a.AgentId=ad.AgentId
                        where (ad.LangId='$lang') and (a.isBranch=0) and 
                        (a.AgentId<>a.ParentAgentId) and (a.ParentAgentId=$rootid) and 
                        (a.Longitude is null) and (Latitude is null)";
                $level2Agents = MySqlDataProvider::executeQuery($sql);
                while ($agentlevel2 = MySqlDataProvider::nextRow($level2Agents))
                {
                    $id = $agentlevel2["AgentId"];
                    $name = $agentlevel2["AgentName"];
                    $agentOption.= '<option value="'.$id.'" '.(($selectedId==$id)?'selected':'').'> --- '.$name.'</option>';
                }
            }
        }
        $agentOption.= '</select>';
        
        return $agentOption;
    }
?>