<?php
if(isset($_POST)){ //verificar que lleguen todos los campos
        //conexion a la bd
        require_once 'includes/conexion.php';
        
        //Recojo los datos del formulario enviados por POST
        $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db, $_POST['nombre']) : false;
        $apellidos = isset($_POST['apellidos']) ? mysqli_real_escape_string($db, $_POST['apellidos']) : false; 
        $email = isset($_POST['email']) ? mysqli_real_escape_string($db, trim($_POST['email'])) : false;
        $password = isset($_POST['password']) ? mysqli_real_escape_string($db, $_POST['password']) : false; //escapar los datos para que lo tome todo como un string aumenta seguridad para evitar que metan consulta dentro del strings
       

        //Creo un Array de errores para ir guardando los errores
        $errores = array(); 
    
    
        //Validacion los datos antes de guardarlos en la BD

        //Validacion del nombre
        if(!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)){
            $nombre_validado = true;
        }else{
            $nombre_validado= false;
            $errores['nombre'] = "El nombre no es valido";
        }
    
    
    
        //Validacion de los apellidos
        if(!empty($apellidos) && !is_numeric($apellidos) && !preg_match("/[0-9]/", $apellidos)){
            //echo "Apellidos validos";
            $apellidos_validado = true;
        }else{
            $apellidos_validado= false;
            $errores['apellidos'] = "Los apellidos no son validos";
        }

        //Validacion del email
        if(!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)){
            $email_validado = true;
        }else{
            $email_validado= false;
            $errores['email'] = "El email no es valido";
        }

        //Validacion de la password
        if(!empty($password)){
            $password_validado = true;
        }else{
            $password_validado= false;
            $errores['password'] = "La password esta vacia";
        }
    
    
        //Bandera
        $guardar_usuario = false;
        
        // Si no existió ningun error previamente, es decir, mi array de errores esta vacio entonces
        // realizo la consulta a la Base de datos
        if(count($errores)== 0){
            $guardar_usuario = true;

            //CIFRAR LA CONTRASEÑA
            $password_segura = password_hash($password, PASSWORD_BCRYPT, ['cost' => 4] ); //cifra contraseña 4 veces

            //var_dump($password); //normal
            //var_dump($password_segura); //cifrada
            //var_dump(password_verify($password, $password_segura)); //devuelve true o false si son iguales las contraseñas o no 


            //INSERTAR USUARIO EN LA TABLA DE LA BD
            $sql = "INSERT INTO usuarios VALUES (null, '$nombre' , '$apellidos', '$email' , '$password_segura' , CURDATE());";
            $guardar = mysqli_query($db, $sql);

            if($guardar){ //Si se guardo el registro correctamente
                $_SESSION ['completado'] = "EL REGISTRO SE HA COMPLETADO CON EXITO";
                header('Location: index.php');
            }
            else{
                $_SESSION ['errores']['general'] = "FALLO AL GUARDAR EL USUARIO EN LA BD";
            }
        }
        else{
            $_SESSION ['errores'] = $errores;
        }
} 
header('Location: index.php');
       

?>

