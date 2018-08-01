<?php
session_start();

if (isset($_SESSION["logado"])) {
    if (!$_SESSION["logado"]) {
        header("Location: index.php?msg=1");
    }
} else {
    header("Location: index.php?msg=1");
}
?>
<!doctype html>
<html lang="pt-br">
    <head>
        <title>MyTest</title>
        <meta charset="utf-8" />
        <link href="bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <link href="bootstrap/css/dashboard.css" rel="stylesheet" type="text/css"/>
        <link href="css/painel.css" rel="stylesheet" type="text/css"/>
        <link href="css/select2.css" rel="stylesheet" type="text/css"/>     
        <link href="css/bootstrap-datepicker.css" rel="stylesheet">
        <script src="js/jquery-3.1.1.min.js" type="text/javascript"></script>
        <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="js/bootstrap-datepicker.js"></script>
        
        <link rel="shortcut icon" href="../img/favicon.ico" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <script src="js/script.js" type="text/javascript"></script>
        <script src="js/select2.full.js" type="text/javascript"></script>
    </head>
 <body>

    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="?pagina=home">My test</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="logout.php">Sair</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-2 col-md-1 sidebar">


        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-11 col-md-offset-1 main">
      

          
          <?php        
                require_once("Util/RequestPage.php");
           ?>
          
          </div>
        </div>
      </div>
    </div>


  </body>
</html>


         
