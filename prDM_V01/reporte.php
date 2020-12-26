<?php

    require "db.php";
    require "mailer/sendMail.php";
    require "fpdf/fpdf.php";

    session_start();

    if( isset($_SESSION['user_id']) ){

        $records = $conn->prepare('SELECT id, name, email, pswd FROM users WHERE id = :id');
        $records->bindParam(':id', $_SESSION['user_id']);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);

        $user = null;

        if( count($results) > 0 ){
            $user = $results;
        }

    }

    # Variables del formulario
    $costo = $_GET['costo'];
    $address = $_GET['address'];
    $ci = $_GET['cid'];
    $co = $_GET['cod'];
    $room = $_GET['type'];
    $sv1 = $_GET['s1'];
    $sv2 = $_GET['s2'];
    $sv3 = $_GET['s3'];
    $s_unam = $_GET['unam'];
    $s_inapam = $_GET['inapam'];
    $userid = $user['id'];

    $type = type_r( $room );
    $s1 = service( $sv1 );
    $s2 = service( $sv2 );
    $s3 = service( $sv3 );
    $unam = service( $s_unam );
    $inapam = service( $s_inapam );

    echo '<br> Tipo: ' . $type;
    echo '<br> S1: ' . $s1;
    echo '<br> S2: ' . $s2;
    echo '<br> S3: ' . $s3;
    echo '<br> UNAM: ' . $unam;
    echo '<br> INAPAM: ' . $inapam;
    echo '<br> HAB: ' . $room;
    echo '<br> CI: ' . $ci;
    echo '<br> CO: ' . $co;
    echo '<br> ID: '. $userid  . '<br>';

    $sql = "INSERT INTO books (room, type, check_in, check_out, unam, inapam, userid, service_1, service_2, service_3) VALUES ('$room', '$type', '$ci', '$co', '$unam', '$inapam', '$userid', '$s1', '$s2', '$s3')";
    $stmt = $conn->prepare( $sql );

    pdf( $user, $costo, $address, $s1, $s2, $s3, $co, $ci);

    if( !$stmt->execute() ){
        echo "<script>
                alert('Ha habido un error');
                window.location= 'reserva.php'
              </script>";
    } else {
        echo "<script>
                alert('Reserva creada');
                window.location= 'reserva.php'
              </script>";
    }

    function type_r( $room ){
        $type = '';
        switch ( $room ) {
            case 1:
                $type =  "Estándar";
                break;

            case 2:
                $type = "Estándar con frigobar";
                break;

            case 3:
                $type = "Jr-Suite";
                break;

            default:
                // code...
                break;
        }
        return $type;
    }

    function service( $serv ){
        if( !empty($serv) ){
            return 1;
        } else {
            return 0;
        }
    }

    # Crea el PDF de la factura
    function pdf( $user, $costo, $address, $s1, $s2, $s3, $co, $ci ){

        $name = "facturas/factura " . $user['name'] . ".pdf";

        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial','B',16);
        $pdf->Cell(80);
        $pdf->Cell(30,10,'El Descanso Medieval',1,0,'C'); # Título
        $pdf->Ln(20);

        $pdf->Cell(0,10, utf8_decode('Nombre: ' . $user['name']) );
        $pdf->Ln(5);
        $pdf->Cell(0,10, utf8_decode('Dirección: ' . $address) );
        $pdf->Ln(5);
        $pdf->Cell(0,10, utf8_decode('Costo: ' . $costo) );
        $pdf->Ln(5);
        $pdf->Cell(0,10, utf8_decode('Gym: ' . selected_s( $s1 )) );
        $pdf->Ln(5);
        $pdf->Cell(0,10, utf8_decode('Yoga: ' . selected_s( $s2 )) );
        $pdf->Ln(5);
        $pdf->Cell(0,10, utf8_decode('Zumba: ' . selected_s( $s3 )) );
        $pdf->Ln(5);
        $pdf->Cell(0,10, utf8_decode('Fecha de check in: ' . $ci) );
        $pdf->Ln(5);
        $pdf->Cell(0,10, utf8_decode('Fecha de check out: ' . $co) );
        $pdf->Ln(5);

        $pdf->Output( 'F', $name );

        # Envía el correo de factura
        sendMail( $user, $name );

    }

    function selected_s( $s ){
        if( $s ){
            return 'Sí';
        } else {
            return 'No';
        }
    }

?>
