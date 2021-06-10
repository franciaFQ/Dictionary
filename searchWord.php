<?php  
	if (isset($_POST['search'])) {
		$word = $_POST['search'];
	}

	include 'conexion.php';

	$consulta=$conn->query("SET NAMES 'utf8'");
	$sql = "select w.word, w.definition, w.image, c.category_name from words w inner join categories c on c.cod_category = w.cod_category where w.word = ?";
    $consulta=$conn->prepare($sql);

    $consulta->bindParam(1,$word);
    try{
    	if ($consulta->execute()) {
    		$datos = $consulta->fetchAll();
    		if (empty($datos)) {
    			echo "<div class='blog-post' style='background-color: white; padding: 25px 40px 75px 60px;'>
    					<h2 class='blog-post-title'>Can't find the word...</h2>
    				</div>";
    		}
    		foreach ($datos as $dato) {
                echo "<div class='blog-post' style='background-color: white; padding: 25px 40px 75px 60px;'>
	                <h2 class='blog-post-title'>" . $dato["word"] . "</h2>
	                	<nav aria-label='breadcrumb'>
	                            <ol class='breadcrumb'>
	                                <li class='breadcrumb-item'><a href='#'>Dictionary</a></li>
	                                <li class='breadcrumb-item active' aria-current='page'>" . $dato["category_name"] . "</li>
	                            </ol>
	                        </nav><hr/>
	                    <p>" . $dato["definition"] . "</p>";
                        if ($dato["image"] != null) {

                            echo "<center><p><b> Image: </b></p>
                            <img alt=\"image\" height=\"200\" width=\"200\" src=".$dato["image"]." /></center>";
                          }
	                echo "</div>";// end of.blog-post
            }
    	}else{
            echo "Can't find the word...";
            //header('Location: index.php');
        }
    }catch(Exception $e){
        echo "Error". $e;
    }
?>