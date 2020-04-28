<?php
    //Iniciar la sesion y la conexion a la BD
    require_once 'includes/conexion.php';
    //Recoger los datos del formulario
    if(isset($_POST)){
        
        if(isset($_SESSION['error_login'])){
                        session_unset($_SESSION['error_login']); //elimina sesion
        }
        
        $email = trim($_POST['email']);
        $password = $_POST['password'];
        
        //Consultar credenciales del usuario
        $sql = "SELECT * FROM usuarios WHERE email = '$email'";
        $login = mysqli_query($db, $sql);
        
        if($login && mysqli_num_rows($login) == 1){
            $usuario = mysqli_fetch_assoc($login);
            
            //Comprobar la contraseña /cifrarla de nuevo
            $verify = password_verify($password, $usuario['password']);
            if($verify){
                    //Utilizar una sesion para guardar los datos del usuario logeado
                    $_SESSION['usuario'] = $usuario; //guardo
                    
                    

            }else{
                    //Si algo falla enviar una sesion con el fallo
                    $_SESSION['error_login'] = "Login incorrecto";
            }
        }else{
            //Mensaje de error
            $_SESSION['error_login'] = "Login incorrecto";
        }
        
        
    }
   
    //Redirigir al index
    header("Location:index.php");
?>
