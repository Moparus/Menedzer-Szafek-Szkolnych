<?php
    include_once $_SERVER['DOCUMENT_ROOT']."/libs/Session.php";
    include_once $_SERVER['DOCUMENT_ROOT'].'/models/MainPanelModel.php';
    
    function generateLocations()
    {
        $MainPanelModel = new MainPanel();
        $list = $MainPanelModel->returnLocationsList();
        for($i=0; $i<sizeof($list); $i++)
        {
           echo('<input class="btn" type="submit" value="'.ucfirst($list[$i][1]).'" name="sideMenuButton"><br>');
        }
    }
?>