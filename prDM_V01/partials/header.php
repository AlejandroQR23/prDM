<header class = "header">

    <div class="container logo-container">
        <a href="#" class="logo"> DESCANSO MEDIEVAL </a>
        <nav class="navigation">
            <ul>
                <li><a href="/prDM_V01"> Inicio </a></li>
                <li><a href="/prDM_V01/conocenos.php"> Conocenos </a></li>

                <?php if( isset($_SESSION['admin']) && $_SESSION['admin'] ): ?>
                    <li><a href="/prDM_V01/admin/admin_menu.php"> Admin </a></li>
                <?php else: ?>
                    <li><a href="/prDM_V01/reserva.php"> Reserva </a></li>
                <?php endif; ?>

                <li><a href="/prDM_V01/contacto.php"> Contacto </a></li>
            </ul>
        </nav>
    </div>

</header>
