<?php
  require 'includes/header.php'; 
  include('includes/connection.php');
  if (isset($_SESSION['email'])) {
    header("Location: market.php");
  }
 ?>
  <link rel="stylesheet" type="text/css" href="bootstrap/css/styles.css"/>
    <title>Enimike Store | Home</title>
  </head>

  <body>
    <!--       main body      -->
    <main>
      <div id="banner" class="container-fluid">
        <div class="row">
          <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
            <div id="banner_content" class="jumbotron">
              <h1>We bring the market to you.</h1>
              <p class="lead">Take a tour in our market</p><br>
              <p class="lead">
                <a class="btn btn-info btn-lg" href="market.php" role="button"><strong>Shop Now!</strong></a>
              </p>
            </div>
          </div><!---  col   -->
        </div><!---   row   ---->
      </div>
    </main>
    <!--     footer     ---->
    <?php
      require 'includes/footer.php';
     ?>
  </body>
</html>
