<?php
if(isset($_POST)){ //verificar que lleguen todos los campos
        //conexion a la bd
        require_once 'includes/conexion.php';
        
        
        //Recogo datos del formulario Actualizacion
        $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db, $_POST['nombre']) : false;
        $apellidos = isset($_POST['apellidos']) ? mysqli_real_escape_string($db, $_POST['apellidos']) : false; 
        $email = isset($_POST['email']) ? mysqli_real_escape_string($db, trim($_POST['email'])) : false;
        

        //Array de errores
        $errores = array(); 

    
        //Validar los datos antes de guardarlos en la BD

        //Valido el nombre
        if(!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)){
            $nombre_validado = true;
        }else{
            $nombre_validado= false;
            $errores['nombre'] = "El nombre no es valido";
        }
    
    
    
        //Valido los apellidos
        if(!empty($apellidos) && !is_numeric($apellidos) && !preg_match("/[0-9]/", $apellidos)){
            $apellidos_validado = true;
        }else{
            $apellidos_validado= false;
            $errores['apellidos'] = "Los apellidos no son validos";
        }

        //Valido el email

        if(!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)){
            $email_validado = true;
        }else{
            $email_validado= false;
            $errores['email'] = "El email no es valido";
        }

    
        $guardar_usuario = false;
        if(count($errores)== 0){
            $usuario = $_SESSION['usuario'];
            $guardar_usuario = true;

        
        //COMPROBAR SI EL EMAIL NO EXISTE YA 
        $sql = "SELECT id , email FROM usuarios WHERE email = '$email'";
        $existe = mysqli_query($db,$sql);
        $existe_usuario = mysqli_fetch_assoc($existe); //Array asociativo del usuario que me ha sacado
        
        if($existe_usuario['id'] ==  $usuario['id'] || empty($existe_usuario) ){
            //ACTUALIZO EL USUARIO EN LA BASE DE DATOS
           
            $sql ="UPDATE usuarios SET ".
                  "nombre = '$nombre', ".
                  "apellidos = '$apellidos',".
                  "email = '$email' ".
                  "WHERE id = ".$usuario['id'];  

            $guardar = mysqli_query($db, $sql);


            if($guardar){
                $_SESSION['usuario']['nombre'] = $nombre;
                $_SESSION['usuario']['apellidos'] = $apellidos;
                $_SESSION['usuario']['email'] = $email;
                $_SESSION ['completado'] = "TUS DATOS SE HAN ACTUALIZADO CON EXITO";
            }
            else{
                $_SESSION ['errores']['general'] = "FALLO AL ACTUALIZAR EL USUARIO EN LA BD";
            }
        } else{
            $_SESSION ['errores']['general'] = "EL USUARIO YA ESTA REGISTRADO";
        }
    }
    
    else{
        $_SESSION ['errores'] = $errores;
    }
}
//Redirecciono a la pagina mis datos
header('Location: mis-datos.php');
?>


