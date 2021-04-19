<?php

/**
 * Envía correo notificando la fecha de próximo reporte de compromiso
 */
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Correo iWasi</title>
</head>

<body>

    <p>Hola <b><?= '@' . $params["email_e"] . ' has invited you to join the' ?></b>,</p>
    <p><?= '@' . $params["organizacion"] . ' organization' ?></p>
    <hr>


    <p><?= '@' . $params["email_e"] . ' has invited you to join the' ?></p>
    <p>This invitation will expire in 7 days.</p>
    <!-- <button style="padding: auto;">Aceptar</button> -->
    <a href="<?= $params["ruta"]; ?>">Aceptar</a>
    <p><?= 'Note: This invitation was intended for <a href="#">' .  $params["email_r"] . '</a> If you were not expecting this invitation, you can ignore this email. If @jnolbertovm is sending you too many emails, you can block them or report them for abuse.' ?></p>
    <p>Atentamente</p>
    <p>Equipo de iWasi</p>

</body>

</html>