<?php
include_once $_SERVER['DOCUMENT_ROOT']."/libs/Session.php";
include_once $_SERVER['DOCUMENT_ROOT'].'/models/ClassesModel.php';

function generateClassesList()
{
    $ClassesModel = new ClassesModel();
    $list = $ClassesModel->returnClassesList();
    for($i=0; $i<sizeof($list); $i++)
    {
       echo('<input onclick="searchTable(this)" class="btn" type="button" name="selectClassButton" value="'.str_replace(' ', '', $list[$i][2]).'"><br>');
    }
}

function getStudentsList()
{
    $ClassesModel = new ClassesModel();
    $data = $ClassesModel->returnStudentsList();
    for($i=0; $i<sizeof($data); $i++)
    {
        $className = str_replace(' ', '', $data[$i][4]);
        echo('<tr id='.$className.'>
            <td>'.$data[$i][0].'</td>
            <td>'.$data[$i][1].'</td>
            <td><span class="badge badge-dark badge-pill d-print-none">'.$data[$i][2].'</span><span class="d-none d-print-block">'.$data[$i][2].'</span></td>
            <td>'.$data[$i][3].'</td>
        </tr>');
    }
}

?>
