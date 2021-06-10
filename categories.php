<?php
  session_start();
  include 'conexion.php';

  if(isset($_POST['nameCA'])){
    
    $name = $_POST['nameCA'];

    try{

      $consulta=$conn->prepare("insert into categories (category_name) VALUES (:nameC)");
      $result = $consulta->execute(array(':nameC' => $name));


      if ($result){
        $smsg = "Successfully inserted data, Insert New data.";
      }else{
        $fmsg = "Data not inserted, please try again later.";
      }
    }catch(Exception $e){
      $fmsg = "Category already exists.";
      //echo "Error" . $e;
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

  <body  style="background-color: #EAEAEA;">
    <?php
    if (isset($_SESSION['loggedin'])) {
      if ($_SESSION['tipo'] == 1) {
        echo "<div class='alert alert-danger' role='alert'>
            You can't be here please login! <a href='login.php'><b>HERE</b></a>
          </div>";
        exit;
      }
    }else{
      echo "<div class='alert alert-danger' role='alert'>
            You can't be here please login! <a href='login.php'><b>HERE</b></a>
          </div>";
        exit;
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
                    <h2 class="blog-post-title">Categories CRUD</h2>
                    
                    <hr>
                    <form method="POST" action="" class="form-inline">
                      <div class="form-group mx-sm-3 mb-2">
                        <label for="nameCA" class="sr-only">Category Name: </label>
                        <input type="text" class="form-control" id="nameCA" name="nameCA" placeholder="Bank" required="true">
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
                    <table id="tabla" class="display">
                      <thead>
                          <tr>
                              <th>ID</th>
                              <th>Category</th>
                              <th>Options</th>
                          </tr>
                      </thead>
                      <tbody>
                      <?php
                        $consulta=$conn->query("SET NAMES 'utf8'");
                        $consulta=$conn->prepare("select * from categories");

                        try{
                          if ($consulta->execute()) {
                            $datos = $consulta->fetchAll();

                            foreach ($datos as $dato) {
                              $code=$dato["cod_category"];
                              $nameC=$dato["category_name"];
                              echo "<tr>";
                                echo "<td>" . $code . "</td>";
                                echo "<td>" . $nameC . "</td>";

                                echo "<td><a class='btn btn-info' data-toggle='modal' href='#edit" . $code . "'> Edit</a>";

                                echo "<span>&nbsp;&nbsp;&nbsp;</span>";

                                echo "<a href='#del" . $code . "' data-toggle='modal' class='btn btn-danger'> Delete</a></td>";
                              echo "</tr>";

                              include ('button.php');
                            }
                          }else{
                            echo "Error can't find categories";
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