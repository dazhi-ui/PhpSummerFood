<?php
    $page = 1;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css" type="text/css" />
    <script src="../js/jquery-1.4.4.min.js" type="text/javascript"></script>
    <script src="../js/bootstrap.min.js" type="text/javascript"></script>
</head>
<script>
</script>
<body>
<div style="position: relative;left: 700px;">
    <nav aria-label="Page navigation">
        <ul class="pagination pagination-lg">
            <li>
                <a href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <li><a href="../commodities/page.php?page=1" onclick="getNextPage(1)">1</a></li>
            <li><a href="../commodities/page.php?page=2" onclick="getNextPage(2)">2</a></li>
            <li><a href="../commodities/page.php?page=3" onclick="getNextPage(3)">3</a></li>
            <li><a href="../commodities/page.php?page=4" onclick="getNextPage(4)">4</a></li>
            <li><a href="../commodities/page.php?page=5" onclick="getNextPage(5)">5</a></li>
            <li>
                <a href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
</div>
</body>
</html>
