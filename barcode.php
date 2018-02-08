<?php
    $nim = $_GET['nim']; // Input nim

    // Service 1 = http://203.24.50.30:7475/datasnap/rest/tservermethods1/datamhs/{nim}, dapat idmahasiswa, nim dan password
    // service 2 =  http://203.24.50.30:7475/datasnap/rest/tservermethods1/datanilai/{idmhs} , dapat lihs terakhir
    $service1         = file_get_contents("http://203.24.50.30:7475/datasnap/rest/tservermethods1/datamhs/$nim");
    $decodeservice1   = json_decode($service1,true);


      if(empty($decodeservice1['result'][0])){  // jika data tidak ada info empty
          echo "empty";
      }
      else {  // kalau ada prosess
            $idmhs            = $decodeservice1['result'][0][0]['idmahasiswa'];
            $service2         = file_get_contents("http://203.24.50.30:7475/datasnap/rest/tservermethods1/datanilai/$idmhs");
            $decodeservice2   = json_decode($service2,true);
            $service3 = file_get_contents("http://203.24.50.30:9999/datasnap/rest/tservermethods1/getpicbynim/$nim");
            $decodeservice3 = json_decode($service3,true);
            array_push($decodeservice1,$decodeservice2,$decodeservice3);
            echo json_encode($decodeservice1);
        }


 ?>
