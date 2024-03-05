<?php
include_once $_SERVER['DOCUMENT_ROOT']."/libs/Session.php";
function generateLockers($lockersLocation)
{
    include_once $_SERVER['DOCUMENT_ROOT'].'/models/LockersModel.php';
    $LockersModel = new LockersModel();
    $data = $LockersModel->returnLockersList($lockersLocation);

    $i=0;
    for($j=0; $j<sizeof($data); $j++)
    {
        if($i==0) {
            echo'<div class="lockerRow"><select name="lockers[]" class="lockers" size="30" multiple="multiple">';
        }
        $i++;
        if($LockersModel->checkIfKeysAvailable($data[$j][0])) { // there are free keys
            echo'<option value="'.$data[$j][0].'" class="bg-success">'.$data[$j][1]."⚿".$data[$j][2].'</option>';
        } 
        else { // there are no free keys left
            echo'<option value="'.$data[$j][0].'" class="bg-danger" disabled>'.$data[$j][1]."⚿".$data[$j][2].'</option>';
        }   
        if($i==30){
            echo'</select></div>';
            $i=0;
        } 
    }
    if(sizeof($data)%30!=0)
        echo'</select></div>';
}

function generateForm($lockersId)
{
    $lockersArray = explode(",",$lockersId);
    $LM = new LockersModel();
    $numberOfKeys = $LM->returnSumOFKeys($lockersId);
    $data = $LM->returnChoosenLockersList($lockersId);
    $classes = $LM->returnAvailableClassesList();

    echo '<h3 class="my-3">Ilość wybranych kluczy: '.$numberOfKeys.'</h3>';
    echo '<div class="col">
        Klasa
        <select class="form-control" name="dataClass" data-live-search="true">';
            for($i=0;$i<sizeof($classes);$i++)
            {
                if($classes[$i][3]!=$classes[$i][4]){
                    if(is_null($classes[$i][3]))
                        echo('<option value="'.$classes[$i][0].'">'.$classes[$i][2].' | Uczniów: 0 | Przypisanych kluczy: '.$classes[$i][4].'</option>');
                    else
                        echo('<option value="'.$classes[$i][0].'">'.$classes[$i][2].' | Uczniów: '.$classes[$i][3].' | Przypisanych kluczy: '.$classes[$i][4].'</option>');
                }
            }
    echo '</select></div><br>
    <input type="text" class="d-none" name="numberOfLockers" value="'.sizeof($lockersArray).'"/>
    <div class="row m-1">
        <div class="col-md-auto">Numer</div>
        <div class="col">Kluczy</div>
    </div>';
    for($i=0;$i<sizeof($data);$i++)
    {
    echo'<div class="row m-1">
            <input type="text" class="d-none" name="dataId'.$i.'" value="'.$data[$i][0].'"/>
            <div class="col-md-auto">
                <input type="text" class="form-control" value="'.$data[$i][1].'" readonly/>
            </div>
            <div class="col">
                <input type="number" class="form-control" name="dataKeys'.$i.'" value="'.$data[$i][2].'" min=0 max="'.$data[$i][2].'" required/>
            </div>
        </div>';
    }
    echo '<input class="btn btn-outline-success px-5 my-2" type="submit" name="addClassesLockers" value="Przypisz"/>
    </form>';
}

function generateScript()
{
    echo '
    <script>
    // Script for lockers Panel
    document.body.addEventListener("change", function(event){
        if(event.target.classList.contains("lockers")){
            const values = Array.from(event.target).map(({ value, selected }) => ({ value, selected }));
            values.forEach((element) => {
                const options = Array.from(event.target)
                const selectedOptions = options.find(item => item.value === element.value);
                if(selectedOptions.className != "bg-danger"){
                    if(element.selected){
                        selectedOptions.className = "bg-info";
                    }
                    else{
                        selectedOptions.className = "bg-success";
                    }
                }
            });
        };
    });
    document.getElementById("reset").addEventListener("click", function(){
        if (confirm("Czy na pewno chcesz odświeżyć stronę?")) {
            location.reload();
        }
    });
    document.getElementById("lockerForm").addEventListener("submit", e => {
        e.preventDefault();
        const targetTmp = new FormData(e.target);
        const targetData = ([...targetTmp.entries()]);
        var data = [];
        for(let i=0;i<targetData.length;i++)
        {
            data[i] = targetData[i][1];
        }
        const d = new Date();
        d.setTime(d.getTime() + (36000));
        let expires = "expires="+ d.toUTCString();
        document.cookie = "selectedData" + "=" + data + ";" + expires + ";path=/";
        location.reload();
    });
    </script>';
    $_COOKIE['selectedData'] = "";
}
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST['addClassesLockers']))
    {
        include_once $_SERVER['DOCUMENT_ROOT']."/libs/Model.php";
        include_once $_SERVER['DOCUMENT_ROOT'].'/models/LockersModel.php';
        $LockersModel = new LockersModel();
        for($i=0;$i<$_POST['numberOfLockers'];$i++)
        {
            $LockersModel->occupyLockersByClass($_POST['dataClass'],$_POST["dataId$i"],$_POST["dataKeys$i"]);
        }
        $LockersModel->addOccupyLockersArchive($_POST['dataClass'],$_POST['numberOfLockers']);
        header('location: ../views/MainPanel.php');
    }
}
