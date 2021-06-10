<?php
  session_start();
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

    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
  </head>

  <body  style="background-color: #EAEAEA;">
    <div  id="wrapper" class="toggled">
      <div class="d-flex">
      <!-- Page Content -->
        <div id="page-content-wrapper">
        <!-- Sidebar -->
        <?php
          include 'navbar.php';
          include 'conexion.php';
        ?>
          <div class="container-fluid">
            <div style="position: relative; top: 40px; "><center><h3 class="display-4">¡Supérate! Dictionary</h3></center></div>
            <main role="main" class="container" style="position: relative; top: 80px; ">
              
              <div class="row">
                <div class="col-lg-8 blog-main" id="result"> 

                <?php
                  $consulta=$conn->query("SET NAMES 'utf8'");
                  if (isset($_GET['cat'])) {
                    $consulta=$conn->prepare("select w.word, w.definition, w.image, c.category_name from words w inner join categories c on c.cod_category = w.cod_category where c.category_name = '".$_GET['cat']."' limit 5");
                  }else{
                    $consulta=$conn->prepare("select w.word, w.definition, w.image, c.category_name from words w inner join categories c on c.cod_category = w.cod_category limit 5");
                  }
                  try{
                    if ($consulta->execute()) {
                      $datos = $consulta->fetchAll();

                      if (empty($datos)) {
                        echo "<div class='blog-post' style='background-color: white; padding: 25px 40px 75px 60px;'>";
                        echo "<h2 class='blog-post-title'>No words yet...</h2>";
                        echo "</div>";// end of.blog-post
                      }
                      foreach ($datos as $dato) {
                        echo "<div class='blog-post' style='background-color: white; padding: 25px 40px 75px 60px;'>";

                          echo "<h2 class='blog-post-title'>" . $dato["word"] . "</h2>";

                          echo "<nav aria-label='breadcrumb'>
                                  <ol class='breadcrumb'>
                                    <li class='breadcrumb-item'><a href='#'>Dictionary</a></li>
                                    <li class='breadcrumb-item active' aria-current='page'>" . $dato["category_name"] . "</li>
                                  </ol>
                                </nav><hr/>";
                          echo "<p><b> Definition: </b>" . $dato["definition"] . "</p>";
                          if ($dato["image"] != null) {

                            echo "<center><p><b> Image: </b></p>
                            <img alt=\"image\" height=\"200\" width=\"200\" src=".$dato["image"]." /></center>";
                          }
                          
                        echo "</div>";// end of.blog-post
                      }
                    }else{
                      echo "No words yet...";
                      header('Location: index.php');
                    }
                  }catch(PDOExceptio $e){
                    echo "Error: " . $e->getMessage();
                    header('Location: index.php');
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
                              echo "<a href='?cat=".$dato["category_name"] . "' style='text-align: justify;'>" . $dato["category_name"] . "</a><br/>";
                            }
                          }else{
                            echo "Error no se pudo encontrar categories";
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

    <!-- Menu Toggle Script -->
    <script>
      $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
      });
    </script>
    <script src="https://kit.fontawesome.com/fabbdc8f7c.js" crossorigin="anonymous"></script>
  </body>
</html>