<?php
    $name = "";
    if(isset($_GET['name'])){
        $name = $_GET['name'];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/bootstrap.min.css" type="text/css" />
    <script src="../js/jquery-3.3.1.min.js" type="text/javascript"></script>
    <script src="../js/bootstrap.min.js" type="text/javascript"></script>
    <title>Title</title>
</head>
<script>

</script>
<body>
<nav class='navbar navbar-default' style='background:#b7d2ff;font-size: 20px;font-family:新宋体;'>
    <div class='container-fluid'>
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class='navbar-header'>
            <button type='button' class='navbar-toggle collapsed' data-toggle='collapse' data-target='#bs-example-navbar-collapse-1' aria-expanded='false'>
                <span class='sr-only'>Toggle navigation</span>
                <span class='icon-bar'></span>
                <span class='icon-bar'></span>
                <span class='icon-bar'></span>
            </button>
            <a class='navbar-brand' href='../commodities/commodities.php' style='color: #171a1d'>首页</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class='collapse navbar-collapse' id='bs-example-navbar-collapse-1'>
            <ul class='nav navbar-nav' id='classification'>
                <li class='li'><a href='../commodities/classification.php?kind=肉类零食' style='color: #171a1d'>肉类零食</a></li>
<!--                <li class='li'><a href='../commodities/classification.php?kind=小说' style='color: #171a1d'>小说</a></li>-->
                <li class='li'><a href='../commodities/classification.php?kind=素类零食' style='color: #171a1d'>素类零食</a></li>
                <li class='li'><a href='../commodities/classification.php?kind=甘果类零食' style='color: #171a1d'>甘果类零食</a></li>
            </ul>
            <form action='../commodities/searchProduct.php' class='navbar-form navbar-left'>
                <div class='form-group'>
                    <input type='text' class='form-control' placeholder='Search' name="name" value="<?php echo $name?>">
                </div>
                <button type='submit' class='btn btn-success' style='width: 150px;background-color: purple'>查找</button>
            </form>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
</body>
</html>