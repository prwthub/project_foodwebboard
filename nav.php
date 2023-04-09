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
    a {
        font-family: 'Noto Sans Thai', sans-serif;
        font-weight: 600;
        color: #34495e;
    }

    body,
    div,
    p {
        font-family: 'Noto Sans Thai', sans-serif;
        font-weight: 400;
        color: #34495e;
    }

    .bold {
        font-family: 'Noto Sans Thai', sans-serif;
        font-weight: 900;
        color: #34495e;
    }

    .lighter {
        font-family: 'Noto Sans Thai', sans-serif;
        font-size: 16px;
        font-weight: 500;
        color: #34495e;

    }

    a.red {
        color: #c0392b;
        font-size: 24px;
    }

    .dropdown-menu {
        font-family: 'Noto Sans Thai', sans-serif;
        font-size: 19px;
        font-weight: 200;
        color: #34495e;
    }
</style>

<?php
if (!isset($_SESSION['id'])) {
    ?>

    <nav class="navbar navbar-light px-2" style="background-color:#D3D3D3">
        <div class="container-fluid">

            <a href="index.php" class="navbar-brand bold">
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

<?php } else {
    $user_id = $_SESSION['user_id']; ?>

    <nav class="navbar navbar-expand-lg navbar-light px-2" style="background-color: #D3D3D3;">
        <div class="container-fluid">
            <a href="index.php" class="navbar-brand bold">
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
                        <a class="btn btn-outline-secondary px-3 dropdown-toggle btn-sm" type="button" id="button1"
                            data-bs-toggle="dropdown" aria-expanded="false">

                            <?php echo $_SESSION['username']; ?>
                            <?php
                            // Include the database configuration file  
                            require_once 'dbConfig_SQLi.php';
                            // Get image data from database 
                            $result = $db->query("SELECT image FROM images_user WHERE user_id = $user_id");
                            ?>

                            <?php
                            //******************************** เรียกรูปจาก database *********************************************** */ 
                            if ($result->num_rows > 0) { ?>
                                <?php while ($row = $result->fetch_assoc()) { ?>
                                    <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['image']); ?>"
                                        width='522' & height='644' alt="" class="circle">
                                <?php } ?>
                            <?php } else { ?>
                                <img src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg"
                                    width='522' & height='644' alt='' class='circle'>
                            <?php } ?>
                        </a>

                        <ul class="dropdown-menu" aria-labelledby="button1">
                            <li>
                                <a href="myprofile.php" class="dropdown-item"><i class="bi bi-person"></i> My Profile</a>
                            </li>

                            <li>
                                <a href="mymenu.php" class="dropdown-item"><i class="bi bi-menu-app"></i> My Menu</a>
                            </li>
                            <div class="dropdown-divider"></div>
                            <li>
                                <a href="logout.php" class="dropdown-item"><i class="bi bi-power"></i> Sign out</a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>

    </nav>

<?php } ?>