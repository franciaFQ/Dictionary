<script src="./js/jquery-3.1.1.min.js"></script>
<script>
  function Look(word)
        {
            $.ajax({
                url: "searchWord.php",
                type: "POST",
                data: "search="+word,
                success: function(resp){
                  $('#result').html(resp)
                }
            });
        }
</script>
<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #085CBC;">
  
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

    <a href="#"><img border="0" src="img/logo.png" width="190" height="75"></a>
<span>&nbsp;&nbsp;&nbsp;</span>
  <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item active">
        <a href="index.php" class="btn btn-primary my-2 my-lg-0">Home <span class="sr-only">(current)</span></a><span>&nbsp;&nbsp;</span>
      </li>
      <?php
        if (isset($_SESSION['loggedin'])) {
          if ($_SESSION['tipo'] == 2 || $_SESSION['tipo'] == 3) {
            echo "<li class='nav-item'><a class='btn btn-primary my-2 my-lg-0' href='categories.php'>Categories</a></li><span>&nbsp;&nbsp;</span>";
            if ($_SESSION['tipo'] == 3) {
              echo "<li class='nav-item'><a class='btn btn-primary my-2 my-lg-0' href='users.php'>Users</a></li><span>&nbsp;&nbsp;</span>";
            }
          }
          echo "<li class='nav-item'><a class='btn btn-primary my-2 my-lg-0' href='words.php'>Words</a></li>";
        }
      ?>
    </ul>
    <form class="form-inline my-2 my-lg-0" action="return false" onsubmit="return false">
      <input class="form-control mr-sm-2" type="text" placeholder="Search..." id="search" name="search" required="true" autocomplete="off">
      <button class="btn btn-success my-2 my-sm-0" onclick="Look(document.getElementById('search').value);">Search</button>
    </form><span>&nbsp;&nbsp;&nbsp;</span>
    <ul class="navbar-nav my-2 my-lg-0">
      <?php
        if (isset($_SESSION['loggedin'])) {
          echo "<li class='nav-item'><a class='btn btn-danger my-2 my-lg-0' href='logout.php'>Log out</a></li>";
        }else{
          echo "<li class='nav-item'>
            <a class='btn btn-info my-2 my-lg-0' href='login.php'>Login</a>
            </li>";
        }
      ?>
    </ul>
  </div>
</nav>
