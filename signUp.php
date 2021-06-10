<?php
	session_start();

	include 'conexion.php';

	$carnet = "";
	$name = "";

if (isset($_POST['id']) && isset($_POST['name'])) {
	$carnet = $_POST['id'];
	$name = $_POST['name'];
	$tipo = '1';
}else{
	header('Location: logout.php');
}

if ($carnet == null || $name == null)
{
    echo "<span class='text-center text-muted' style='color: red;'>Please, fill the all the text.</span>";
}else{
	$consulta=$conn->query("SET NAMES 'utf8'");
	$consulta=$conn->prepare("insert INTO users (cod_user, user_name, password, cod_type) VALUES (?,?,?,?)");
	$consulta->bindParam(1,$carnet);
	$consulta->bindParam(2,$name);
	$consulta->bindParam(3,$carnet);
	$consulta->bindParam(4,$tipo);
	
	try{
		$rows = $consulta->execute();
		if($rows == 1){
			$consulta=$conn->query("SET NAMES 'utf8'");
			$consulta=$conn->prepare("select * from users where cod_user=?");
			$consulta->bindParam(1,$carnet);
			
			try{
				if($consulta->execute()){
					$datos = $consulta->fetchAll();
					if ($datos==null) {
						echo "<span class='text-center text-muted' style='color: red;'>Username or password incorrect</span>";
						exit();
					}
					if ($datos != null) {
						$tipo = $datos[0][3];

						$_SESSION['loggedin'] = true;
						$_SESSION['nombre'] = $datos[0][1];
						$_SESSION['carnet'] = $datos[0][0];
						$_SESSION['tipo'] = $tipo;
						$_SESSION['start'] = time();
						$_SESSION['expire'] = $_SESSION['start'] + (10 * 60);
						echo "<script>location.href = './index.php'</script>";
					}
				    
				}else{
					echo "<span class='text-center text-muted' style='color: red;'>Error no se pudo iniciar sesión</span>";
				}

				$conn=null;

			}catch(PDOExceptio $e){
				echo "Error: " . $e->getMessage();
			}
		}else{
			echo "<span class='text-center text-muted' style='color: red;'>Username or password incorrect</span>";
			exit();
		}
	}catch(Exception $e){
		echo "<span class='text-center text-muted' style='color: red;'>You already have an account!!!</span>";
	}
}


?>