  <!-- Import Font -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@200;400;600;900&display=swap"
    rel="stylesheet">
    
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
    }

    .lighter {
        font-family: 'Noto Sans Thai', sans-serif;
        font-size: 16px;
        font-weight: 400;
    }

    .regular{
        font-family: 'Noto Sans Thai', sans-serif;
        font-size: 20px;
        font-weight: 500;
    }

    a.red {
        color: #d2746a;
        font-size: 24px;
    }

    .whiter {
        color: #ffecde;
    }

    .darkBrown {
        color: #635951;
    }

    .dropdown-menu {
        font-family: 'Noto Sans Thai', sans-serif;
        font-size: 19px;
        font-weight: 200;
        color: #34495e;
    }

    .btn-secondary, .btn-secondary:active, .btn-secondary:visited, .btn-outline{
    background-color: #635951 !important;
    
  }

  .btn-secondary:hover  {
    background-color: #8c694d !important;
  }

</style>

<?php
if (!isset($_SESSION['id'])) {
    ?>

    <nav class="navbar navbar-expand-lg navbar-light px-2 text-white" style="background-color: #635951;">
        <div class="container-fluid justify-content-center">
            <a href="index.php" class="navbar-brand bold whiter">
                <i class="bi bi-house-door-fill"></i> Home
            </a>

            <a class="container-fluid justify-content-start navbar-text col-sm-9">
                <form action="search.php" method="get" class ="form-inline">
                    <span class="input-group">
                        <input type="search" name="search" class="form-control" placeholder="Search...">
                        <button type="submit" class = "btn btn-sm btn-outline-success whiter"><i class="bi bi-search"></i></button>
                    </span>
                </form>
            </a>

            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="login.php" class="nav-link whiter">
                        <i class="bi bi-box-arrow-in-right"></i> Sign in
                    </a>
                </li>
            </ul>
        </div>
    </nav>

<?php } else {
    $user_id = $_SESSION['user_id']; ?>

    <nav class="navbar navbar-expand-sm navbar-light px-2" style="background-color: #635951;">
        <div class="container-fluid justify-content-center ">
            <a href="index.php" class="navbar-brand bold whiter">
                <i class="bi bi-house-door-fill"></i> Home
            </a>

            <a class="container-fluid navbar-text col-sm-9">
                <form action="search.php" method="get" class ="form-inline">
                    <span class="input-group">
                        <input type="search" name="search" class="form-control" placeholder="Search...">
                        <button type="submit" class = "btn btn-sm btn-outline-success whiter"><i class="bi bi-search"></i></button>
                    </span>
                </form>
            </a>

            <ul class="navbar-nav">
                <li class="nav-item">
                    <div class="dropdown">
                        <a class="btn btn-outline-secondary px-3 dropdown-toggle btn-sm whiter" type="button" id="button1"
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