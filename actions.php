<?php
	include 'conexion.php';

	$accion=$_GET['acc'];
	try{
		switch ($accion) {
			case 'del':
				$id=$_GET['id'];
				$delete=$conn->prepare("delete from categories where cod_category=$id");
				$resultD = $delete->execute();
				header('location:categories.php');
				break;
			case 'edit':
				$nameE=$_POST['nameE'];
				$idE=$_POST['idE'];
				
				$edit=$conn->prepare("update categories set category_name='$nameE' where cod_category='$idE'");
				$resultE = $edit->execute();
				header('location:categories.php');
				break;
			case 'delW':
				$id=$_GET['word'];

				$sqlop = $conn->query("SET NAMES 'utf8'");
	            $sqlop = $conn->prepare("SELECT image from words where word ='".$id."'");
	            $sqlop->execute();
	            $resultado = $sqlop->fetchAll();
	            
	            unlink($resultado[0][0]);


	            $delete = $conn->query("SET NAMES 'utf8'");
				$delete=$conn->prepare("delete from words where word='$id'");
				$resultD = $delete->execute();
				header('location:words.php');
				break;
			case 'delU':
				$id=$_GET['id'];
				$delete=$conn->prepare("delete from users where cod_user='$id'");
				$resultD = $delete->execute();
				header('location:users.php');
				break;
			case 'editU':
				$nameE=$_POST['nameE'];
				$passE=$_POST['passE'];
				$idE=$_POST['idE'];
				
				$edit=$conn->prepare("update users set user_name='$nameE', password='$passE' where cod_user='$idE'");
				$resultE = $edit->execute();
				header('location:users.php');
				break;
			default:
				header('location:categories.php');
				break;
		}
	}catch(Exception $e){
		echo "An Error has ocurred";
	}
?>