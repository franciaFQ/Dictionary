<?php
	session_start();

	include 'conexion.php';

	$carnet = "";
	$contra = "";

if (isset($_POST['username']) && isset($_POST['password'])) {
	$carnet = $_POST['username'];
	$contra = $_POST['password'];
}else{
	header('Location: logout.php');
}

if ($carnet == null || $contra == null)
{
    echo "<span class='text-center text-muted' style='color: red;'>Please, fill the all the text.</span>";
}
else
{
	$consulta=$conn->query("SET NAMES 'utf8'");
	$consulta=$conn->prepare("select * from users where cod_user=? and password=?");
	$consulta->bindParam(1,$carnet);
	$consulta->bindParam(2,$contra);
	

	try{
		if($consulta->execute()){
			$datos = $consulta->fetchAll();
			if ($datos==null) {
				echo "<span class='text-center text-muted' style='color: red;'>Username or password incorrect</span>";
				exit();
			}
	/*		var_dump($datos); echo "<br/>";
			echo "Carnet " . $datos[0][0];echo "<br/>";
			echo "Nombre " . $datos[0][1];echo "<br/>";
			echo "Contraseña " . $datos[0][2];echo "<br/>";
			echo "Codigo tipo " . $datos[0][3];echo "<br/>";
	*/
			if ($datos != null) {
				$tipo = $datos[0][3];

				$_SESSION['loggedin'] = true;
				$_SESSION['nombre'] = $datos[0][1];
				$_SESSION['carnet'] = $datos[0][0];
				$_SESSION['tipo'] = $tipo;
				$_SESSION['start'] = time();
				$_SESSION['expire'] = $_SESSION['start'] + (10 * 60);
				//header('Location: index.php');
				echo "<script>location.href = './index.php'</script>";
			}
		    //header('Location: index.php');
		    
		}else{
			echo "<span class='text-center text-muted' style='color: red;'>Error no se pudo iniciar sesión</span>";
			//header('Location: index.php');
		}

		$conn=null;

	}catch(PDOExceptio $e){
		echo "Error: " . $e->getMessage();
		//header('Location: index.php');
	}
}
?>