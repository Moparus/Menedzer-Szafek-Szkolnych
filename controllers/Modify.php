<?php
include_once $_SERVER['DOCUMENT_ROOT']."/libs/Session.php";
function generateModifyElements()
{
    include_once $_SERVER['DOCUMENT_ROOT'].'/models/ModifyModel.php';
    $ModifyModel = new ModifyModel();

    if(!isset($_COOKIE['modifyCookie'])){
        echo'<script>
        const d = new Date();
        d.setTime(d.getTime() + (36000));
        let expires = "expires="+ d.toUTCString();
        document.cookie = "modifyCookie" + "=" + "Klasa/Szafki" + ";" + expires + ";path=/";
        location.reload();
        </script>';
    }
    $data = $ModifyModel->returnChosenToModify($_COOKIE['modifyCookie']);
    if(count($data)!=0){
        $numberOfRows = count($data);
        $numberOfCells = count($data[0])/2;
        echo('<br>');
        for($i=0; $i<$numberOfRows; $i++)
        { 
            echo '<form class="modifyForm" action="elements/modifyFormElement.php" method="POST"><tr>';
            for($j=0; $j<$numberOfCells; $j++)
            {
                echo('<input name="table" class="d-none" type="text" value="'.$_COOKIE['modifyCookie'].'" />');
                echo('<input name="data'.$j.'" class="d-none" type="text" value="'.$data[$i][$j].'" />');
                if($j!=0)
                    echo('<td>'.$data[$i][$j].'</td>');
            }
            echo('<td><input name="edit" class="btn btn-outline-info mx-1" type="submit" value="Edytuj"> <input name="delete" class="btn btn-outline-danger mx-1" type="submit" value="Usuń"></td></tr></form>');
        }
    }
    else{
        echo('<h4>Brak Danych</h4>');
    }

}
        
function generateScript()
{
    echo'<script>
    function changeSelectedModifyOption($this)
    {
        const d = new Date();
        d.setTime(d.getTime() + (36000));
        let expires = "expires="+ d.toUTCString();
        document.cookie = "modifyCookie" + "=" + $this.value + ";" + expires + ";path=/";
        location.reload();
    }
    function searchTable() {
        var input, filter, found, table, tr, td, i, j, text;
        input = document.getElementById("dataSearchBar");
        filter = input.value.toUpperCase();
        table = document.getElementById("dataTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            text = "";
            td = tr[i].getElementsByTagName("td");
            for (j = 0; j < td.length-1; j++) {
                text+= (td[j].innerHTML.toUpperCase()+" ");
            }
            if (text.indexOf(filter) > -1) {
                tr[i].style.display = "";
                found = false;
            } else {
              if (tr[i].id != "mainRow")
                tr[i].style.display = "none";
            }
        }
    }
    </script>';
}
?>

  


