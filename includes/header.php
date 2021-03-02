<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
    <body>
    <ul>
        <li class='header'><a class="active" href="index.php">Clitter</a></li>
        <li class='header'><a href="login.php">Login</a></li>
        <li class='header'><a href="my_page.php">My Page</a></li>
        <!-- <li class='header'><a href="logout.php">Log Out</a></li> -->
        <div class = "formClass" style="margin-top:13px;">
        <form class="searchForm" action="search.php" method="post" style="display: inline">
            <input name="search" type="search" size="20" maxlength="20">
            <input type="submit" name="submit" value="Search">
        </form>
        <form align=right class="allusers" action="allusers.php" method="post" style="display: inline">
                <input type="submit" name="submit" value="All Users">
        </form>
        </div>
    </ul>
    </body>
</html>
