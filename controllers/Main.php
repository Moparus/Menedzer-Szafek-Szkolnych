<?php
    include_once $_SERVER['DOCUMENT_ROOT']."/libs/Session.php";
    include_once $_SERVER['DOCUMENT_ROOT'].'/models/MainModel.php';
    
    function generateProgressBar()
    {
        $MainModel = new MainModel();
        $progressValue = $MainModel->returnShelfOccupancy();
        if($progressValue<90)
            echo('<div class="progress-bar bg-success progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="height: '.$progressValue.'%;">'.$progressValue.'%</div>');
        else
            echo('<div class="progress-bar bg-danger progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="height: '.$progressValue.'%;">'.$progressValue.'%</div>');
    }
    function generateEndangeredLockers()
    {
        $MainModel = new MainModel();
        $data = $MainModel->endangeredLockers();
        for($i=0; $i<sizeof($data); $i++)
        {
            echo('<tr>
                <td class="lockerPrint"><span class="badge badge-dark badge-pill d-print-none">'.$data[$i][1].'</span><span class="d-none d-print-block">'.$data[$i][1].'</span></td>
                <td class="locationPrint text-danger">'.$data[$i][2].'</td>
            </tr>');
        }
    }
    function generateFirstPanel()
    {
        $MainModel = new MainModel();
        $data = $MainModel->endangeredLockers();
        if($data!=null)
        {
            echo('<div class="col-md-auto rounded shadow-lg m-1 text-center scrollClass mh-100">
            <br><strong class="text-danger">UWAGA</strong>
            <table class="table my-2">
            <thead>
                <tr id="mainRow">
                <th scope="col">Szafka</th>
                <th scope="col">Kluczy</th>
                </tr>
            </thead>
            <tbody>');
            for($i=0; $i<sizeof($data); $i++)
            {
                echo('<tr>
                    <td class="lockerPrint"><span class="badge badge-dark badge-pill d-print-none">'.$data[$i][1].'</span></td>
                    <td class="locationPrint text-danger">'.$data[$i][2].'</td>
                </tr>');
            }
            echo('</tbody></table></div>');
        }
        
    }
    function generateSecoundPanel()
    {
        $MainModel = new MainModel();
        $data = $MainModel->endangeredStudents();
        if($data!=null)
        {
            echo('<div class="col rounded shadow-lg m-1 text-center scrollClass mh-100">
            <br><strong class="text-danger">UCZNIOWIE BEZ SZAFKI</strong>
            <table class="table my-2">
            <thead>
                <tr id="mainRow">
                <th scope="col">Uczen</th>
                <th scope="col">Klasa</th>
                </tr>
            </thead>
            <tbody>');
            for($i=0; $i<sizeof($data); $i++)
            {
                echo('<tr>
                    <td class="locationPrint text-danger">'.$data[$i][0].' '.$data[$i][1].'</td>
                    <td class="locationPrint text-danger">'.$data[$i][2].'</td>
                </tr>');
            }
            echo('</tbody></table></div>');
        }
        else{
          echo('<div class="col rounded shadow-lg m-1 text-center scrollClass mh-100"><h3>Wszystko okej :)</h3></div>');
        }
        
    }
?>
