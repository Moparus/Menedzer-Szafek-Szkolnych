<?php
include_once $_SERVER['DOCUMENT_ROOT']."/libs/Session.php";
include_once $_SERVER['DOCUMENT_ROOT']."/models/InsertModel.php";
$InsertModel = new InsertModel();

if(isset($_POST['selectInsertButton']))
{
    switch($_POST['selectInsertButton'])
    {
        case "Klasa":
            echo'
                    <div class="row g-3 my-1">
                        <div class="col">Nazwa</div>
                        <div class="col">Skrót</div>
                    </div>
                ';
            if(isset($_COOKIE['insertAmountCookie'])){
                echo '<input type="text" class="d-none" name="amount" value="'.$_COOKIE['insertAmountCookie'].'">';
                for($i=0;$i<$_COOKIE['insertAmountCookie'];$i++)
                    echo'
                    <div class="row g-3 my-1">
                        <div class="col">
                            <input type="text" class="form-control" name="nazwa' . strval($i+1) . '" placeholder="Nazwa"/>
                        </div>
                        <div class="col">
                            <input type="text" class="form-control" name="skrot' . strval($i+1) . '" placeholder="Skrót"/>
                        </div>
                    </div>';
            }
            else{
                echo' 
                <div class="row g-3">
                    <div class="col">
                        <input type="text" class="form-control" name="nazwa" placeholder="Nazwa"/>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" name="skrot" placeholder="Skrót"/>
                    </div>
                </div>';
            }
            break;
        case "Lokalizacja":
            echo'
                    <div class="row g-3 my-1">
                        <div class="col">Pozycja</div>
                    </div>
                ';
            if(isset($_COOKIE['insertAmountCookie'])){
                echo '<input type="text" class="d-none" name="amount" value="'.$_COOKIE['insertAmountCookie'].'">';
                for($i=0;$i<$_COOKIE['insertAmountCookie'];$i++)
                    echo'
                    <div class="row g-3 my-1">
                        <div class="col">
                            <input type="text" class="form-control" name="pozycja' . strval($i+1) . '" placeholder="Miejsce" required/>
                        </div>
                    </div>';
            }
            else{
                echo' 
                <div class="row g-3">
                    <div class="col">
                        <input type="text" class="form-control" name="pozycja" placeholder="Miejsce" required/>
                    </div>
                </div>';
            }
            break;
        case "Szafka":
            echo'
                    <div class="row g-3 my-1">
                        <div class="col">Numer</div>
                        <div class="col">Ilość Kluczy</div>
                        <div class="col">Lokalizacja</div>
                    </div>
                ';
            if(isset($_COOKIE['insertAmountCookie'])){
                echo '<input type="text" class="d-none" name="amount" value="'.$_COOKIE['insertAmountCookie'].'"/>';
                for($i=0;$i<$_COOKIE['insertAmountCookie'];$i++)
                {
                    echo'
                    <div class="row g-3 my-1">
                        <div class="col">
                            <input type="text" class="form-control" name="kod' . strval($i+1) . '" placeholder="Numer" required/>
                        </div>
                        <div class="col">
                            <select class="form-control" name="ilosc' . strval($i+1) . '">
                                <option>0</option>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>
                        <div class="col">
                            <select class="form-control" data-live-search="true" name="lokalizacja' . strval($i+1) . '">';
                                returnLocations();
                            echo '</select>
                        </div>
                    </div>';
                }
            }
            else{
                echo'
                    <div class="row g-3 my-1">
                        <div class="col">
                            <input type="text" class="form-control" name="kod" placeholder="Numer" required/>
                        </div>
                        <div class="col">
                            <select class="form-control" name="ilosc">
                                <option>0</option>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>
                        <div class="col">
                            <select class="form-control" data-live-search="true" name="lokalizacja">';
                            returnLocations();
                    echo '</select>
                        </div>
                    </div>';
            }
            break;
        case "Uczen":
            echo'
            <div class="row g-3 my-1">
                <div class="col">Klasa</div>
            </div>
            <div class="row g-3 my-1">
                <div class="col">
                    <select class="form-control" data-live-search="true" name="klasa">';
                        returnClasses();
                echo '</select>
                </div>
            </div><br>
            <div class="row g-3 my-1">
                <div class="col">Imie</div>
                <div class="col">Nazwisko</div>
            </div>
            ';
            if(isset($_COOKIE['insertAmountCookie'])){
                echo '<input type="text" class="d-none" name="amount" value="'.$_COOKIE['insertAmountCookie'].'"/>';
                for($i=0;$i<$_COOKIE['insertAmountCookie'];$i++)
                {
                    echo'
                    <div class="row g-3 my-1">
                        <div class="col">
                            <input type="text" class="form-control" name="imie' . strval($i+1) . '" placeholder="Imie"/>
                        </div>
                        <div class="col">
                            <input type="text" class="form-control" name="nazwisko' . strval($i+1) . '" placeholder="Nazwisko"/>
                        </div>
                    </div>';
                }
            }
            else{
                echo'
                <div class="row g-3 my-1">
                    <div class="col">
                        <input type="text" class="form-control" name="imie" placeholder="Imie"/>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" name="nazwisko" placeholder="Nazwisko"/>
                    </div>
                </div>';
            }
            break;
        case "Przypisz Szafke":
            echo'
            <div class="row g-3 my-1">
                <div class="col">Uczeń</div>
                <div class="col">Szafka</div>
            </div>
            ';
            if(isset($_COOKIE['insertAmountCookie'])){
                echo '<input type="text" class="d-none" name="amount" value="'.$_COOKIE['insertAmountCookie'].'"/>';
                for($i=0;$i<$_COOKIE['insertAmountCookie'];$i++)
                {
                    echo'
                    <div class="row g-3 my-1">
                        <div class="col">
                            <select class="form-control" data-live-search="true" name="uczen' . strval($i+1) . '">';
                                returnStudents($i);
                        echo '</select>
                        </div>
                        <div class="col">
                            <select class="form-control" data-live-search="true" name="szafka' . strval($i+1) . '">';
                                returnLockers();
                        echo '</select>
                        </div>
                    </div>';
                }
            }
            else{
                echo'
                <div class="row g-3 my-1">
                    <div class="col">
                        <select class="form-control" data-live-search="true" name="uczen" data-live-search="true">';
                            returnStudents(0);
                    echo '</select>
                    </div>
                    <div class="col">
                        <select class="form-control" data-live-search="true" name="szafka" data-live-search="true">';
                            returnLockers();
                    echo '</select>
                    </div>
                </div>';
            }
            break;
        case "Przypisz Klasowe":
            echo '<script>
            document.querySelector("#amountPickerSection").style.display = "none";
            </script>
            <h3 class="my-3">'.$_POST['selectInsertButton'].'</h3>
            <div class="form-group">
            <label for="classPicker">Wybierz klasę</label>
                <select class="form-control" id="classPicker">
                    <option>-</option>';
                    returnClassesWithLockers($_COOKIE['classPickerCookie']);            
            echo'</select>
            </div>
            <div class="row g-3 my-1">
                <div class="col">Szafka</div>
                <div class="col">Uczeń</div>
            </div>
            ';
            if(isset($_COOKIE['classPickerCookie'])){
                echo '<input type="text" class="d-none" name="amount" value="'.returnStudentsNumber($_COOKIE['classPickerCookie']).'"/>';
                for($i=0;$i<returnStudentsNumber($_COOKIE['classPickerCookie']);$i++)
                {
                    echo'
                    <div class="row g-3 my-1">
                        <div class="col">
                            <select class="form-control" data-live-search="true" name="szafka' . strval($i) . '">';
                                returnClassLockers($_COOKIE['classPickerCookie'], $i);
                        echo '</select>
                        </div>
                        <div class="col">
                            <select class="form-control" data-live-search="true" name="uczen' . strval($i) . '">';
                                echo('<option selected="true" disabled="disabled">-</option>');
                                returnClassStudents($_COOKIE['classPickerCookie']);
                        echo '</select>
                        </div>
                    </div>';
                }
            }
            break;
        case "Zamień Szafki":
            echo'
            <div class="row g-3 my-1">
                <div class="col">Uczeń Pierwszy</div>
                <div class="col">Uczeń Drugi</div>
            </div>
            ';
            if(isset($_COOKIE['insertAmountCookie'])){
                echo '<input type="text" class="d-none" name="amount" value="'.$_COOKIE['insertAmountCookie'].'"/>';
                for($i=0;$i<$_COOKIE['insertAmountCookie'];$i++)
                {
                    echo'
                    <div class="row g-3 my-1">
                        <div class="col">
                            <select class="form-control" data-live-search="true" name="uczen1' . strval($i+1) . '">';
                                returnStudentsWithLockers();
                        echo '</select>
                        </div>
                        <div class="col">
                            <select class="form-control" data-live-search="true" name="uczen2' . strval($i+1) . '">';
                                returnStudentsWithLockers();
                        echo '</select>
                        </div>
                    </div>';
                }
            }
            else{
                echo'
                <div class="row g-3 my-1">
                    <div class="col">
                        <select class="form-control" data-live-search="true" name="uczen1" data-live-search="true">';
                            returnStudentsWithLockers();
                    echo '</select>
                    </div>
                    <div class="col">
                        <select class="form-control" data-live-search="true" name="uczen2" data-live-search="true">';
                            returnStudentsWithLockers();
                    echo '</select>
                    </div>
                </div>';
            }
            break;
        case "Przypisz Status":
            echo'
            <div class="row g-3 my-1">
                <div class="col">Uczeń Szafka</div>
                <div class="col">Status</div>
            </div>
            ';
            if(isset($_COOKIE['insertAmountCookie'])){
                echo '<input type="text" class="d-none" name="amount" value="'.$_COOKIE['insertAmountCookie'].'"/>';
                for($i=0;$i<$_COOKIE['insertAmountCookie'];$i++)
                {
                    echo'
                    <div class="row g-3 my-1">
                        <div class="col">
                            <select class="form-control" data-live-search="true" name="uczenSzafka' . strval($i+1) . '">';
                                returnStudentsLockers();
                        echo '</select>
                        </div>
                        <div class="col">
                            <select class="form-control" data-live-search="true" name="status' . strval($i+1) . '">';
                                returnStatus();
                        echo '</select>
                        </div>
                    </div>';
                }
            }
            else{
                echo'
                <div class="row g-3 my-1">
                    <div class="col">
                        <select class="form-control" data-live-search="true" name="uczenSzafka" data-live-search="true">';
                        returnStudentsLockers();
                    echo '</select>
                    </div>
                    <div class="col">
                        <select class="form-control" data-live-search="true" name="status" data-live-search="true">';
                        returnStatus();
                    echo '</select>
                    </div>
                </div>';
            }
            break;
        default:
            break;
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST['Klasa'])){
        if(isset($_POST['amount'])){
            for($i=1;$i<=$_POST['amount'];$i++)
                if(!empty($_POST['nazwa'.$i]) && !empty($_POST['skrot'.$i]))
                    $InsertModel->addClass($_POST['nazwa'.$i],$_POST['skrot'.$i]);
        }
        else{
            if(!empty($_POST['nazwa']) && !empty($_POST['skrot']))
                $InsertModel->addClass($_POST['nazwa'],$_POST['skrot']);
        }
        header('location: ../views/MainPanel.php?sideMenuButton=Modyfikacja');
    }
    if(isset($_POST['Lokalizacja'])){
        if(isset($_POST['amount'])){
            for($i=1;$i<=$_POST['amount'];$i++)
                $InsertModel->addLocation($_POST['pozycja'.$i]);
        }
        else{
            $InsertModel->addLocation($_POST['pozycja']);
        }
        header('location: ../views/MainPanel.php?sideMenuButton=Modyfikacja');
    }
    if(isset($_POST['Szafka'])){
        if(isset($_POST['amount'])){
            for($i=1;$i<=$_POST['amount'];$i++)
                $InsertModel->addLocker($_POST['kod'.$i],$_POST['ilosc'.$i],$_POST['lokalizacja'.$i]);
        }
        else{
            $InsertModel->addLocker($_POST['kod'],$_POST['ilosc'],$_POST['lokalizacja']);
        }
        header('location: ../views/MainPanel.php?sideMenuButton=Modyfikacja');
    }
    if(isset($_POST['Uczen'])){
        if(isset($_POST['amount'])){
            for($i=1;$i<=$_POST['amount'];$i++)
                if(!empty($_POST['imie'.$i]) && !empty($_POST['nazwisko'.$i]) && !empty($_POST['klasa']))
                    $InsertModel->addStudent($_POST['imie'.$i],$_POST['nazwisko'.$i],$_POST['klasa']);
        }
        else{
            if(!empty($_POST['imie']) && !empty($_POST['nazwisko']) && !empty($_POST['klasa']))
                $InsertModel->addStudent($_POST['imie'],$_POST['nazwisko'],$_POST['klasa']);
        }
        header('location: ../views/MainPanel.php?sideMenuButton=Modyfikacja');
    }
    if(isset($_POST['Przypisz_Szafke'])){
        if(isset($_POST['amount'])){
            for($i=1;$i<=$_POST['amount'];$i++)
                $InsertModel->addStudentLocker($_POST['uczen'.$i],$_POST['szafka'.$i]);
        }
        else{
            $InsertModel->addStudentLocker($_POST['uczen'],$_POST['szafka']);
        }
        header('location: ../views/MainPanel.php?sideMenuButton=Modyfikacja');
    }
    if(isset($_POST['Zamień_Szafki'])){
        if(isset($_POST['amount'])){
            for($i=1;$i<=$_POST['amount'];$i++)
                $InsertModel->changeStudentsLockers($_POST['uczen1'.$i],$_POST['uczen2'.$i]);
        }
        else{
            $InsertModel->changeStudentsLockers($_POST['uczen1'],$_POST['uczen2']);
        }
        header('location: ../views/MainPanel.php?sideMenuButton=Modyfikacja');
    }
    if(isset($_POST['Przypisz_Klasowe'])){
        $j=0;
        if(isset($_POST['amount'])){
            for($i=0;$i<$_POST['amount'];$i++)
                if(isset($_POST['uczen'.$i])){
                       $InsertModel->instertStudentsToClassLockers($_POST['szafka'.$i],$_POST['uczen'.$i]);  
                       $j++;
                  }

        }
        $InsertModel->archiveInstertStudentsToClassLockers($_POST['uczen0'],$j);
        header('location: ../views/MainPanel.php?sideMenuButton=Modyfikacja');
    }
    if(isset($_POST['Przypisz_Status'])){
        if(isset($_POST['amount'])){
            for($i=1;$i<=$_POST['amount'];$i++)
                $InsertModel->addStudentLockerStatus($_POST['uczenSzafka'.$i],$_POST['status'.$i]);
        }
        else{
            $InsertModel->addStudentLockerStatus($_POST['uczenSzafka'],$_POST['status']);
        }
        header('location: ../views/MainPanel.php?sideMenuButton=Modyfikacja');
    }
}

function returnLocations()
{
    $InsertModel = new InsertModel();
    $data = $InsertModel->getLocations();
    for($i=0; $i<sizeof($data); $i++)
    {
        echo('<option value="'.$data[$i][0].'">'.$data[$i][1].'</option>');
    }
}
function returnClasses()
{
    $InsertModel = new InsertModel();
    $data = $InsertModel->getClasses();
    for($i=0; $i<sizeof($data); $i++)
    {
        echo('<option value="'.$data[$i][0].'">'.$data[$i][1].'</option>');
    }
}

function returnStudents($number)
{
    $InsertModel = new InsertModel();
    $data = $InsertModel->getStudents();
    for($i=0; $i<sizeof($data); $i++)
    {
        if($i==$number)
            echo('<option value="'.$data[$i][0].'" selected>'.$data[$i][1].' '.$data[$i][2].' '.$data[$i][3].'</option>');
        else
            echo('<option value="'.$data[$i][0].'">'.$data[$i][1].' '.$data[$i][2].' '.$data[$i][3].'</option>');
    }
}

function returnLockers()
{
    $InsertModel = new InsertModel();
    $data = $InsertModel->getLockers();
    for($i=0; $i<sizeof($data); $i++)
    {
        echo('<option value="'.$data[$i][0].'">'.$data[$i][1].' | Klucze: '.$data[$i][3].'/'.$data[$i][2].'</option>');
    }
}

function returnStudentsWithLockers()
{
    $InsertModel = new InsertModel();
    $data = $InsertModel->getStudentsWithLockers();
    for($i=0; $i<sizeof($data); $i++)
    {
        echo('<option value="'.$data[$i][0].'">'.$data[$i][1].' '.$data[$i][2].' '.$data[$i][3].' | Szafka: '.$data[$i][4].'</option>');
    }
}

function returnClassesWithLockers($classCookie)
{
    $InsertModel = new InsertModel();
    $data = $InsertModel->getClassesWithLockers();
    for($i=0; $i<sizeof($data); $i++)
    {
        if(isset($classCookie)&&$classCookie==$data[$i][0])
            echo('<option value="'.$data[$i][0].'" selected>'.$data[$i][1].' '.$data[$i][2].'</option>');
        else
            echo('<option value="'.$data[$i][0].'">'.$data[$i][1].' '.$data[$i][2].'</option>');
    }
}

function returnClassStudents($classId)
{
    $InsertModel = new InsertModel();
    $data = $InsertModel->getClassStudents($classId);
    for($i=0; $i<sizeof($data); $i++)
    {
        echo('<option value="'.$data[$i][0].'">'.$data[$i][1].' '.$data[$i][2].'</option>');
    }
}

function returnClassLockers($classId, $number)
{
    $InsertModel = new InsertModel();
    $data = $InsertModel->getClassLockers($classId);
    for($i=0; $i<sizeof($data); $i++)
    {
        if($i==$number)
            echo('<option value="'.$data[$i][0].'">'.$data[$i][1].'</option>');
    }
}

function returnStudentsNumber($classId)
{
    $InsertModel = new InsertModel();
    $data = $InsertModel->getStudentsNumber($classId);
    return $data;
}

function returnStudentsLockers()
{
    $InsertModel = new InsertModel();
    $data = $InsertModel->getStudentsLockers();
    for($i=0; $i<sizeof($data); $i++)
    {
        echo('<option value="'.$data[$i][0].'">'.$data[$i][1].' '.$data[$i][2].' '.$data[$i][4].' : '.$data[$i][3].'</option>');
    }
}
function returnStatus()
{
    $InsertModel = new InsertModel();
    $data = $InsertModel->getStatus();
    for($i=0; $i<sizeof($data); $i++)
    {
        echo('<option value="'.$data[$i][0].'">'.$data[$i][1].'</option>');
    }
}

