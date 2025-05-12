<?php
    require_once __DIR__. '/../Modelo/BDDConection.php';
    require_once __DIR__. '/../Modelo/modelologin.php';
    
    $sesion_ok = false;
    $conection = DB::getInstance();
    
    if(empty($_POST['nameAccount'])||empty($_POST['password']) ){
        $sesion_ok = false;
    }
    $conection_ok = login(
        $conection, 
        $_POST['nameAccount'], 
        $_POST['password']
    );

    if($conection_ok) {
        $_SESSION["nameAccount"] = $_POST["nameAccount"];
        
        
       $sesion_ok = true;
       $_SESSION["SesionStart"] = true;

       // Redirigir a Resource_usuario.php con el parámetro de acción
       header("Location: /ProjectaRapidgo/?action=Usuario");
       exit(); // Asegúrate de salir después de redirigir
    }else {
        echo $conection_ok;
        $error = "Usuari o contrasenya incorrectes";
        echo "<script>alert('error en Controller/Autentificacion/loginSESSION')</script>";
        $sesion_ok= false;
        $_SESSION["SesionStart"] = false;
    }



?>