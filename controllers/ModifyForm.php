<?php
    include_once $_SERVER['DOCUMENT_ROOT']."/libs/Session.php";
    include_once $_SERVER['DOCUMENT_ROOT']."/models/ModifyFormModel.php";
    $ModifyFormModel = new ModifyFormModel();
    function generateElementToModify()
    {
        echo ('<h3>'.$_POST['table'].'</h3><br>');
        echo'<input type="number" class="d-none" name="data0" value="'.$_POST['data0'].'"/>';
        if(isset($_POST['edit'])){
            switch($_POST['table'])
            {
                case "Klasy":
                    $i=1;
                    echo '<div class="row">
                        <div class="col">Nazwa</div>
                        <div class="col">Skrót</div>
                    </div>
                    <div class="row">';
                    while(isset($_POST['data'.$i]))
                    {
                        echo'<div class="col"><input type="text" class="form-control" name="data'.$i.'" value="'.$_POST['data'.$i].'" required/></div>';
                        $i++;
                    }
                    echo '</div>';
                    break;
                case "Szafki":
                    $i=1;
                    echo '<div class="row">
                            <div class="col">Kod</div>
                            <div class="col">Ilość Kluczy</div>
                            <div class="col">Lokalizacja</div>
                        </div>
                    <div class="row">';
                        echo'<div class="col"><input type="text" class="form-control" name="data1" value="'.$_POST['data1'].'" disabled/></div>';
                        echo'<div class="col"><input type="text" class="form-control" name="data2" value="'.$_POST['data2'].'" required/></div>';
                        echo'<div class="col">
                            <select class="form-control" name="data3" data-live-search="true">';
                                returnLocations($_POST['data3']);
                        echo '</select></div></div>';
                    break;
                case "Uczen/Szafka":
                    echo '<div class="row">
                            <div class="col">Uczeń</div>
                            <div class="col">Szafka</div>
                        </div>
                        <div class="row">';
                        echo'<div class="col">
                            <select class="form-control" name="data0" data-live-search="true">';
                                returnStudent($_POST['data0']);
                        echo '</select></div>';
                        echo'<div class="col">
                            <select class="form-control" name="data1" data-live-search="true">';
                                returnLockers($_POST['data3']);
                        echo '</select></div>
                        </div>';
                    break;
                case "Klasa/Szafki":
                    echo('<h4>'.$_POST['data1'].'</h4>');
                    echo '<div class="row">
                            <div class="col">Szafka</div>
                            <div class="col">Ilość nieprzypisanych</div>
                        </div>';
                        returnClassLockers($_POST['data0']);
                    break;
                 case "Zmiana Hasła":
                    echo('<h4>'.$_POST['data1'].'</h4>');
                    echo '<div class="row">
                            <div class="col">Hasło</div>
                            <div class="col">Nowe Hasło</div>
                        </div>';
                        echo'<div class="row">
                        <div class="col"><input type="password" class="form-control" name="oldPassword" value=""/></div>
                        <div class="col"><input type="password" class="form-control" name="newPassword" value=""/></div>
                        </div>';
                    break;
                case "Uczniowie":
                    $i=1;
                    echo '<div class="row">
                            <div class="col">Imie</div>
                            <div class="col">Nazwisko</div>
                            <div class="col">Klasa</div>
                        </div>
                        <div class="row">';
                        while(isset($_POST['data'.$i]) && $i<3)
                        {
                            echo'<div class="col"><input type="text" class="form-control" name="data'.$i.'" value="'.$_POST['data'.$i].'" required/></div>';
                            $i++;
                        }
                        echo'<div class="col">
                            <select class="form-control" name="data3" data-live-search="true">';
                                returnClasses($_POST['data3']);
                        echo '</select></div>';
                    echo '</div>';
                    break;
                case "Lokalizacje":
                    $i=1;
                    echo '<div class="row">
                        <div class="col">Nazwa</div>
                    </div>
                    <div class="row">';
                    while(isset($_POST['data'.$i]))
                    {
                        echo'<div class="col"><input type="text" class="form-control" name="data'.$i.'" value="'.$_POST['data'.$i].'" required/></div>';
                        $i++;
                    }
                    echo '</div>';
                    break;
                case "Status/Szafka":
                    echo '<div class="row">
                            <div class="col">Uczeń Szafka</div>
                            <div class="col">Status</div>
                        </div>
                        <div class="row">';
                        echo'<div class="col">
                            <select class="form-control" name="data0" data-live-search="true">';
                            echo('<option value="'.$_POST['data0'].'" selected>'.$_POST['data1'].' '.$_POST['data2'].' '.$_POST['data4'].'</option>');
                        echo '</select></div>';
                        echo'<div class="col">
                            <select class="form-control" name="data1" data-live-search="true">';
                                returnStatus($_POST['data5']);
                        echo '</select></div>
                        </div>';
                    break;
            }
        } else if(isset($_POST['delete'])){
            switch($_POST['table'])
            {
                case "Klasy":
                    $i=1;
                    echo '<div class="row">
                        <div class="col">Nazwa</div>
                        <div class="col">Skrót</div>
                    </div>
                    <div class="row">';
                    while(isset($_POST['data'.$i]))
                    {
                        echo'<div class="col"><input type="text" class="form-control" name="data'.$i.'" value="'.$_POST['data'.$i].'" readonly/></div>';
                        $i++;
                    }
                    echo '</div>';
                    echo '<br>Usuwa:
                    <ul>
                        <li>Klasę z listy klas</li>
                        <li>Wszystkie osoby przypisane do klasy</li>
                        <li>Wszystkie przypisania szafek dla usuniętych osób oraz tej klasy</li>
                    </ul>';
                    break;
                case "Szafki":
                    $i=1;
                    echo '<div class="row">
                        <div class="col">Szafka</div>
                        <div class="col">Klucze</div>
                        <div class="col">Lokalizacja</div>
                    </div>
                    <div class="row">';
                    while(isset($_POST['data'.$i]))
                    {
                        echo'<div class="col"><input type="text" class="form-control" name="data'.$i.'" value="'.$_POST['data'.$i].'" readonly/></div>';
                        $i++;
                    }
                    echo '</div>';
                    echo '<br>Usuwa:
                    <ul>
                        <li>Szafkę z listy szafek</li>
                        <li>Lokalizację szafki</li>
                        <li>Przypisanie klucza/szafki do osoby</li>
                    </ul>';
                    break;
                case "Uczen/Szafka":
                    $i=1;
                    echo '<div class="row">
                        <div class="col">Imie</div>
                        <div class="col">Nazwisko</div>
                        <div class="col">Szafka</div>
                    </div>
                    <div class="row">';
                    while(isset($_POST['data'.$i]))
                    {
                        echo'<div class="col"><input type="text" class="form-control" name="data'.$i.'" value="'.$_POST['data'.$i].'" readonly/></div>';
                        $i++;
                    }
                    echo '</div>';
                    echo '<br>Usuwa:
                    <ul>
                        <li>Przypisanie klucza do osoby</li>
                    </ul>';
                    break;
                case "Klasa/Szafki":
                    $i=1;
                    echo '<div class="row">
                        <div class="col">Klasa</div>
                        <div class="col">Skrót</div>
                        <div class="col">Klucze</div>
                    </div>
                    <div class="row">';
                    while(isset($_POST['data'.$i]))
                    {
                        echo'<div class="col"><input type="text" class="form-control" name="data'.$i.'" value="'.$_POST['data'.$i].'" readonly/></div>';
                        $i++;
                    }
                    echo '</div>';
                    echo '<br>Usuwa:
                    <ul>
                        <li>Nieprzypisane klucze z klasy</li>
                    </ul>';
                    break;
                case "Uczniowie":
                    $i=1;
                    echo '<div class="row">
                        <div class="col">Imie</div>
                        <div class="col">Nazwisko</div>
                        <div class="col">Klasa</div>
                    </div>
                    <div class="row">';
                    while(isset($_POST['data'.$i]))
                    {
                        echo'<div class="col"><input type="text" class="form-control" name="data'.$i.'" value="'.$_POST['data'.$i].'" readonly/></div>';
                        $i++;
                    }
                    echo '</div>';
                    echo '<br>Usuwa:
                    <ul>
                        <li>Ucznia z listy osób</li>
                        <li>Przypisanie osoby do klasy</li>
                        <li>Przypisanie klucza do osoby oraz klasy</li>
                    </ul>';
                    break;
                case "Lokalizacje":
                    $i=1;
                    echo '<div class="row">
                        <div class="col">Nazwa</div>
                    </div>
                    <div class="row">';
                    while(isset($_POST['data'.$i]))
                    {
                        echo'<div class="col"><input type="text" class="form-control" name="data'.$i.'" value="'.$_POST['data'.$i].'" readonly/></div>';
                        $i++;
                    }
                    echo '</div>';
                    echo '<br>Usuwa:
                    <ul>
                        <li>Lokalizacje z listy lokalizacji</li>
                        <li>Wszystkie szafki przypisane do lokalizacji</li>
                        <li>Wszystkie przypisania szafek</li>
                    </ul>';
                    break;
                case "Status/Szafka":
                    $i=1;
                    echo '<div class="row">
                        <div class="col">Imie</div>
                        <div class="col">Nazwisko</div>
                        <div class="col">Szafka</div>
                        <div class="col">Klasa</div>
                        <div class="col">Status</div>
                    </div>
                    <div class="row">';
                    while(isset($_POST['data'.$i]))
                    {
                        echo'<div class="col"><input type="text" class="form-control" name="data'.$i.'" value="'.$_POST['data'.$i].'" readonly/></div>';
                        $i++;
                    }
                    echo '</div>';
                    echo '<br>Usuwa:
                    <ul>
                        <li>Usuwa zdarzenie przypisane do szafki</li>
                    </ul>';
                    break;
                case "Zmiana Hasła":
                    echo('<h4>Usunięcie konta zablokowane.</h4>');
                    break;
            }
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST['selectedTable'])){
            switch($_POST['selectedTable'])
            {
                case "Klasy":
                    $ModifyFormModel->modifyClass($_POST['data0'],$_POST['data1'],$_POST['data2']);
                    header('location: ../views/MainPanel.php?sideMenuButton=Modyfikacja');
                    break;
                case "Szafki":
                    $ModifyFormModel->modifyKey($_POST['data0'],$_POST['data2'],$_POST['data3']);
                    header('location: ../views/MainPanel.php?sideMenuButton=Modyfikacja');
                    break;
                case "Uczen/Szafka":
                    $ModifyFormModel->modifyLocker($_POST['data0'],$_POST['data1']);
                    header('location: ../views/MainPanel.php?sideMenuButton=Modyfikacja');
                    break;
                case "Klasa/Szafki":
                    $i=0;
                    while(isset($_POST["lockerId$i"]))
                    {
                        $ModifyFormModel->modifyClassLockers($_POST['data0'],$_POST["lockerId$i"],$_POST["keysAmount$i"]);
                        $i++;
                    }
                    $ModifyFormModel->addModifyClassLockerToArchive($_POST['data0'],$i);
                    header('location: ../views/MainPanel.php?sideMenuButton=Modyfikacja');
                    break;
                case "Uczniowie":
                    $ModifyFormModel->modifyStudent($_POST['data0'],$_POST['data1'],$_POST['data2'],$_POST['data3']);
                    header('location: ../views/MainPanel.php?sideMenuButton=Modyfikacja');
                    break;
                case "Lokalizacje":
                    $ModifyFormModel->modifyLocation($_POST['data0'],$_POST['data1']);
                    header('location: ../views/MainPanel.php?sideMenuButton=Modyfikacja');
                    break;
                case "Status/Szafka":
                    $ModifyFormModel->modifyLockerStatus($_POST['data0'],$_POST['data1']);
                    header('location: ../views/MainPanel.php?sideMenuButton=Modyfikacja');
                    break;
                case "Zmiana Hasła":
                    $ModifyFormModel->modifyUserPassword($_POST['data0'],$_POST['oldPassword'],$_POST['newPassword']);
                    header('location: ../views/MainPanel.php?sideMenuButton=Modyfikacja');
                    break;
                default:
                    header('location: ../views/MainPanel.php?sideMenuButton=Modyfikacja');
                    break;
            }
        }
        if(isset($_POST['deleteTable'])){
            switch($_POST['deleteTable'])
            {
                case "Klasy":
                    $ModifyFormModel->deleteClass($_POST['data0']);
                    header('location: ../views/MainPanel.php?sideMenuButton=Modyfikacja');
                    break;
                case "Szafki":
                    $ModifyFormModel->deleteKey($_POST['data0']);
                    header('location: ../views/MainPanel.php?sideMenuButton=Modyfikacja');
                    break;
                case "Uczen/Szafka":
                    $ModifyFormModel->deleteLocker($_POST['data0']);
                    header('location: ../views/MainPanel.php?sideMenuButton=Modyfikacja');
                    break;
                case "Klasa/Szafki":
                    $ModifyFormModel->deleteClassLocker($_POST['data0']);
                    header('location: ../views/MainPanel.php?sideMenuButton=Modyfikacja');
                    break;
                case "Uczniowie":
                    $ModifyFormModel->deleteStudent($_POST['data0']);
                    header('location: ../views/MainPanel.php?sideMenuButton=Modyfikacja');
                    break;
                case "Lokalizacje":
                    $ModifyFormModel->deleteLocation($_POST['data0']);
                    header('location: ../views/MainPanel.php?sideMenuButton=Modyfikacja');
                    break;
                case "Status/Szafka":
                    $ModifyFormModel->deleteLockerStatus($_POST['data0']);
                    header('location: ../views/MainPanel.php?sideMenuButton=Modyfikacja');
                    break;
                default:
                    header('location: ../views/MainPanel.php?sideMenuButton=Modyfikacja');
                    break;
            }
        }
    }
    

    function returnStudent($studentId)
    {
        $ModifyFormModel = new ModifyFormModel();
        $data = $ModifyFormModel->getStudent($studentId);
        for($i=0; $i<sizeof($data); $i++)
        {
            echo('<option value="'.$data[$i][0].'" selected>'.$data[$i][1].' '.$data[$i][2].' '.$data[$i][3].'</option>');
        }
    }

    function returnLockers($lockerCode)
    {
        $ModifyFormModel = new ModifyFormModel();
        $data = $ModifyFormModel->getLockers();
        for($i=0; $i<sizeof($data); $i++)
        {
            if($data[$i][1]==$lockerCode){
                echo('<option value="'.$data[$i][0].'" selected>'.$data[$i][1].' | Klucze: '.$data[$i][3].'/'.$data[$i][2].'</option>');
            }
            else{
                echo('<option value="'.$data[$i][0].'">'.$data[$i][1].' | Klucze: '.$data[$i][3].'/'.$data[$i][2].'</option>');
            }
        }
    }
    function returnClasses($classCode)
    {
        $ModifyFormModel = new ModifyFormModel();
        $data = $ModifyFormModel->getClasses();
        for($i=0; $i<sizeof($data); $i++)
        {
            if($data[$i][2]==$classCode){
                echo('<option value="'.$data[$i][0].'" selected>'.$data[$i][1].' '.$data[$i][2].'</option>');
            }
            else {
                echo('<option value="'.$data[$i][0].'">'.$data[$i][1].' '.$data[$i][2].'</option>');
            }
        }
    }
    function returnClassLockers($classId)
    {
        $ModifyFormModel = new ModifyFormModel();
        $data = $ModifyFormModel->getClassLockers($classId);

        for($i=0; $i<sizeof($data); $i++)
        {
            echo'<div class="row">';
                    if(true){
                        echo'<div class="col-md-auto"><input type="text" class="form-control" name="lockerId'.$i.'" value="'.$data[$i][1].'" readonly/></div>';
                        echo'<div class="col"><input type="text" class="form-control" name="keysAmount'.$i.'" value="'.$data[$i][2].'" min=0 max='.$data[$i][2].' /></div>';
                    }
            echo '</div>';
        }
    }
    function returnLocations($location)
    {
        $ModifyFormModel = new ModifyFormModel();
        $data = $ModifyFormModel->getLocation();
        for($i=0; $i<sizeof($data); $i++)
        {
            if($data[$i][1]==$location){
                echo('<option value="'.$data[$i][0].'" selected>'.$data[$i][1].'</option>');
            }
            else {
                echo('<option value="'.$data[$i][0].'">'.$data[$i][1].'</option>');
            }
        }
    }
    function returnStatus($status)
    {
        $ModifyFormModel = new ModifyFormModel();
        $data = $ModifyFormModel->getStatus();
        for($i=0; $i<sizeof($data); $i++)
        {
            if($data[$i][1]==$status){
                echo('<option value="'.$data[$i][0].'" selected>'.$data[$i][1].'</option>');
            }
            else {
                echo('<option value="'.$data[$i][0].'">'.$data[$i][1].'</option>');
            }
        }
    }

?>