<style>
    .circle {
        width: 30pt;
        height: 30pt;
        border-radius: 50%
    }

    .navbar {
        box-shadow: 0 1px 5px rgba(0, 0, 0, .5);
    }


    h1,
    a
    {
        font-family: 'Noto Sans Thai', sans-serif;
        font-weight: 600;
        color: #34495e;
    }

    body,
    div,
    p{
        font-family: 'Noto Sans Thai', sans-serif;
        font-weight: 400;
        color: #34495e;
    }

    .bold{
        font-family: 'Noto Sans Thai', sans-serif;
        font-weight: 900;
        color: #34495e;
    }
    a {
        color: #c0392b;
        font-size: 24px;
    }
</style>

<?php
if (!isset($_SESSION['id'])) {
    ?>

    <nav class="navbar navbar-light px-2" style="background-color:#D3D3D3">
        <div class="container-fluid">

            <a href="index.php" class="navbar-brand">
                <i class="bi bi-house-door-fill"></i> Home <!--Home button Navbar + Home icon-->
            </a>

            <a class="navbar-text col-md-8">
                <form action="search.php" method="get">
                    <span class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Search...">
                        <button type="submit"><i class="bi bi-search"></i></button>
                    </span>
                </form>
            </a>

            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="login.php" class="nav-link">
                        <i class="bi bi-box-arrow-in-right"></i> Sign in
                    </a>
                </li>
            </ul>
        </div>
    </nav>

<?php } else { ?>

    <nav class="navbar navbar-expand-lg navbar-light px-2" style="background-color: #D3D3D3;">
        <div class="container-fluid">
            <a href="index.php" class="navbar-brand">
                <i class="bi bi-house-door-fill"></i> Home
            </a>

            <a class="navbar-text col-md-8">
                <form action="search.php" method="get">
                    <span class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Search...">
                        <button type="submit"><i class="bi bi-search"></i></button>
                    </span>
                </form>
            </a>

            <ul class="navbar-nav">
                <li class="nav-item">
                    <div class="dropdown">
                        <a class="btn btn-outline-secondary dropdown-toggle btn-sm" type="button" id="button1"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-lines-fill"></i>
                            <?php echo $_SESSION['username']; ?>
                            <img src="https://media.discordapp.net/attachments/759437257961635907/1080497630490140744/333569516_3245945072382544_7351929676159766126_n.jpg?width=522&height=644"
                                alt="" class="circle">
                        </a>

                        <ul class="dropdown-menu" aria-labelledby="button1">
                            <li>
                                <a href="myprofile.php" class="dropdown-item"><i class="bi bi-person"></i> My Profile</a>
                            </li>

                            <li>
                                <a href="mymenu.php" class="dropdown-item"><i class="bi bi-menu-app"></i> My Menu</a>
                            </li>

                            <li>
                                <a href="logout.php" class="dropdown-item"><i class="bi bi-power"></i> Sign out</a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>

    </nav>

<?php } ?>