<?php
include_once("email/mail.inc.php");
$mail = new MyMailer;
// Contenido del Correo
$mail->AddAddress("jorge.ramirez@cerok.com", "Jorge");
$mail->Subject = "Prueba de Tareas Programadas con  - SAIA";
$mail->Body    = "Esto es una prueba de Envio de correo con Las tareas Progamadas ".date("Y-m-d H:i:s")." debe llegar cada 15 o 30 minutos";
$mail->Send();
$mail->AddAddress("diego.vargas@cerok.com", "Diego");
$mail->Subject = "Prueba de Tareas Programadas con  - SAIA";
$mail->Body    = "Esto es una prueba de Envio de correo con Las tareas Progamadas ".date("Y-m-d H:i:s")." debe llegar cada 15 o 30 minutos";
$mail->Send();
$mail->AddAddress("hernando.trejos@cerok.com", "Hernando");
$mail->Subject = "Prueba de Tareas Programadas con  - SAIA";
$mail->Body    = "Esto es una prueba de Envio de correo con Las tareas Progamadas ".date("Y-m-d H:i:s")." debe llegar cada 15 o 30 minutos";
$mail->Send();
?>