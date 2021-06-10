<?php
  session_start();
  include 'conexion.php';

  if(isset($_POST['word']) && isset($_POST['category']) && isset($_POST['descri'])){
    
    $word = $_POST['word'];
    $cate = $_POST['category'];
    $descri = $_POST['descri'];

    //capturamos los datos del fichero subido    
    $type=$_FILES['foto']['type'];
    $tmp_name = $_FILES['foto']["tmp_name"];
    $name = $_FILES['foto']["name"];

    //Creamos una nueva ruta (nuevo path)
    //Así guardaremos nuestra imagen en la carpeta "images"
    $nuevo_path="images/".$name;

    //Movemos el archivo desde su ubicación temporal hacia la nueva ruta
    # $tmp_name: la ruta temporal del fichero
    # $nuevo_path: la nueva ruta que creamos
    move_uploaded_file($tmp_name,$nuevo_path);

    //Extraer la extensión del archivo. P.e: jpg
    # Con explode() segmentamos la cadena de acuerdo al separador que definamos. En este caso punto (.)
    $array=explode('.',$nuevo_path);

    # Capturamos el último elemento del array anterior que vendría a ser la extensión
    $ext = end($array);


    try{

      $consulta=$conn->prepare("insert into words (word, definition, cod_category, image) VALUES
       (:word, :descri, :category, :image)");
      $result = $consulta->execute(array(':word' => $word, ':descri' => $descri,':category' => $cate, ':image' => $nuevo_path));

      if ($result==1){
        $smsg = "Successfully inserted data, Insert New data.";
      }else{
        $fmsg = "Data not inserted, please try again later.";
      }
    }catch(Exception $e){
      $fmsg = "That word already exits.";
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Supérate | Dictionary</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/simple-sidebar.css" rel="stylesheet">

    <!-- Datatables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
  </head>

  <body style="background-color: #EAEAEA;">
    <?php
    if (!isset($_SESSION['loggedin'])) {
      echo "<div class='alert alert-danger' role='alert'>
            You can't be here please login! <a href='login.php'><b>HERE</b></a>
          </div>";
        exit();
    }
    ?>
    <div  id="wrapper" class="toggled">
      <div class="d-flex">
      <!-- Page Content -->
        <div id="page-content-wrapper">
        <!-- Sidebar -->
        <?php
          include 'navbar.php';
        ?>
          <div class="container-fluid">
            <main role="main" class="container" style="position: relative; top: 100px; ">
              <div class="row">
                <div class="col-lg-8 blog-main" id="result">
                  <div class="blog-post" style="background-color: white; padding: 25px 40px 30px 60px;">
                    <?php
                    if ($_SESSION['tipo'] == 1) {
                    ?>
                    <h2 class="blog-post-title">Add a word!!!</h2>
                    <hr>

                    <form method="POST" action="" class="form-group" enctype="multipart/form-data">
                      <div class="form-group mb-2">
                        <label for="id" class="control-label">Word: </label>
                        <input type="text" class="form-control" id="word" name="word" placeholder="Word..." required="true">
                      </div>
                      <div class="form-group mb-2">
                          <label class="control-label">Category: </label>
                          <div>
                            <select name="category" id="category" class="form-control">      
                            <?php
                              $sql = $conn->query("SET NAMES 'utf8'");
                              $sql = $conn->prepare('SELECT * FROM categories');
                              $sql->execute();
                              $resultado = $sql->fetchAll();
                                            
                              foreach ($resultado as $row) {
                                echo '<option value='.$row["cod_category"].'>'
                                .$row["category_name"]."</option>";
                              }
                                           
                              $sql->closeCursor();
                            ?>
                            </select>
                          </div>
                        </div>
                      <div class="form-group mb-2">
                        <label for="nameCA" class="control-label">Definition: </label>
                        <textarea class="form-control" id="descri" name="descri" required="true" placeholder="Definition is...."></textarea>
                      </div>
                      <div class="form-group">
                          <label class="control-label">Image:</label>
                          <div>
                            <input type="file" accept="image/* " name="foto">
                          </div>
                        </div>
                      <button type="submit" class="btn btn-primary mb-2">Save</button>
                    </form>

                    <?php if(isset($smsg)){ ?>
                      <div class="alert alert-success" role="alert"> <?php echo $smsg; ?> 
                      </div><?php } ?>
                    <?php if(isset($fmsg)){ ?>
                      <div class="alert alert-danger" role="alert"> <?php echo $fmsg; ?> 
                      </div><?php } ?>
                  </div><!-- /.blog-post -->
                  <div class="blog-post" style="background-color: white; padding: 25px 40px 75px 60px;">
                    <hr>
                  </div>
              <?php
                }else{
              ?>  
              <h2 class="blog-post-title">Add a word!!!</h2>
                    <hr>

                    <form method="POST" action="" class="form-group" enctype="multipart/form-data">
                      <div class="form-group mb-2">
                        <label for="id" class="control-label">Word: </label>
                        <input type="text" class="form-control" id="word" name="word" placeholder="Word..." required="true">
                      </div>
                      <div class="form-group mb-2">
                          <label class="control-label">Category: </label>
                          <div>
                            <select name="category" id="category" class="form-control">      
                            <?php
                              $sql = $conn->query("SET NAMES 'utf8'");
                              $sql = $conn->prepare('SELECT * FROM categories');
                              $sql->execute();
                              $resultado = $sql->fetchAll();
                                            
                              foreach ($resultado as $row) {
                                echo '<option value='.$row["cod_category"].'>'
                                .$row["category_name"]."</option>";
                              }
                                           
                              $sql->closeCursor();
                            ?>
                            </select>
                          </div>
                        </div>
                      <div class="form-group mb-2">
                        <label for="nameCA" class="control-label">Definition: </label>
                        <textarea class="form-control" id="descri" name="descri" required="true" placeholder="Definition is...."></textarea>
                      </div>
                      <div class="form-group">
                          <label class="control-label">Image:</label>
                          <div>
                            <input type="file" accept="image/* " name="foto">
                          </div>
                      </div>
                      <button type="submit" class="btn btn-primary mb-2">Save</button>
                    </form>

                    <?php if(isset($smsg)){ ?>
                      <div class="alert alert-success" role="alert"> <?php echo $smsg; ?> 
                      </div><?php } ?>
                    <?php if(isset($fmsg)){ ?>
                      <div class="alert alert-danger" role="alert"> <?php echo $fmsg; ?> 
                      </div><?php } ?>
                  </div><!-- /.blog-post -->
                  <div class="blog-post" style="background-color: white; padding: 25px 40px 75px 60px;">
                    <hr>
                  
                  <h2 class="blog-post-title">All the words!!!</h2>
                    <hr>
                    <div class="table-responsive">
                    <table id="tabla" class="table">
                      <thead>
                          <tr>
                              <th>Word</th>
                              <th>Definition</th>
                              <th>Category</th>
                              <th>Image</th>
                              <th>Options</th>
                          </tr>
                      </thead>
                      <tbody>
                      <?php
                        $consulta=$conn->query("SET NAMES 'utf8'");
                        $consulta=$conn->prepare("select w.word, w.definition, w.image, c.category_name from words w inner join categories c on c.cod_category = w.cod_category");

                        try{
                          if ($consulta->execute()) {
                            $datos = $consulta->fetchAll();

                            foreach ($datos as $dato) {
                              $word = $dato["word"];
                              $defin = $dato["definition"];
                              $cate = $dato["category_name"];
                              $img = $dato["image"];
                              echo "<tr>";
                                echo "<td>" . $word . "</td>";
                                echo "<td>" . $defin . "</td>";
                                echo "<td>" . $cate . "</td>";
                                if ($img != null) {
                                  echo "<td><img alt=\"image\" height=\"90\" width=\"90\" src=".$dato["image"]." /></td>";
                                }else{
                                  echo "<td>No image found</td>";
                                }
                                echo "<td><a href='#del" . $word . "' data-toggle='modal' class='btn btn-danger'> Delete</a></td>";
                              echo "</tr>";

                              include ('buttonW.php');
                            }
                          }else{
                            echo "Error no se pudo encontrar categories";
                            header('Location: index.php');
                          }
                        }catch(PDOExceptio $e){
                          echo "Error: " . $e->getMessage();
                          header('Location: index.php');
                        }
                      ?>
                      </tbody>
                    </table>
                  </div>
                  </div><!-- /.blog-post -->
                  
              <?php    
                }
              ?>
                </div><!-- /.blog-main -->
                
                <aside class="col-lg-4 blog-sidebar" >
                  <div class="p-4 mb-3 bg-light rounded">
                    <h4 class="font-italic">Categories</h4>
                    <div>
                      <?php
                        $consulta=$conn->query("SET NAMES 'utf8'");
                        $consulta=$conn->prepare("select * from categories limit 5");

                        try{
                          if ($consulta->execute()) {
                            $datos = $consulta->fetchAll();

                            foreach ($datos as $dato) {
                              echo "<a href='#' style='text-align: justify;'>" . $dato["category_name"] . "</a><br/>";
                            }
                          }else{
                            echo "Error can't find categories";
                            header('Location: index.php');
                          }
                          $conn=null;
                        }catch(PDOExceptio $e){
                          echo "Error: " . $e->getMessage();
                          header('Location: index.php');
                        }
                      ?>
                    </div>
                  </div>
                </aside><!-- /.blog-sidebar -->
              </div><!-- /.row -->
            </main><!-- /.container -->
          </div>
          <br/><br/>
          <!-- /#page-content-wrapper -->
          <footer class="blog-footer" style="position: relative; text-align: center; top: 130px;">
            <p>
              Dictionary build to Supérate! Raíces by <b>RFRANCIA</b>.</p>
            <p>
              <a href="#">Back to top</a>
            </p>
          </footer>
        </div>
      </div>
    </div>
    
    <!-- /#wrapper -->

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
    <script>
      $(document).ready( function () {
        $('#tabla').DataTable();
      } );
    </script>

  </body>
 
</html>