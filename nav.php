<style>
    .circle {
        width: 50pt;
        height: 50pt;
        border-radius: 50%
    }
</style>

<?php
if (!isset($_SESSION['id'])) {
    ?>
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color:#D3D3D3">
        <div class="container-fluid">

            <a href="index.php" class="navbar-brand">
                <i class="bi bi-house-door-fill"></i> Home <!--Home button Navbar + Home icon-->
            </a>

            <a class="navbar-text col-md-8">
                <span class="input-group">
                    <span class="input-group-text" class="form-label"><i class="bi bi-search"></i></span>
                    <input type="text" class="form-control" placeholder="Search...">
                </span>
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

    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #D3D3D3;">
        <div class="container-fluid">
            <a href="index.php" class="navbar-brand"><i class="bi bi-house-door-fill"></i> Home</a>
            <ul class="navbar-nav">
                <div class="dropdown">
                    <a class="btn btn-outline-secondary dropdown-toggle btn-sm" type="button" id="button1"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-lines-fill"></i>
                        <?php echo $_SESSION['username']; ?>
                    </a>
                    <img src="https://media.discordapp.net/attachments/759437257961635907/1080497630490140744/333569516_3245945072382544_7351929676159766126_n.jpg?width=522&height=644" alt="" class="circle">
                    <ul class="dropdown-menu" aria-labelledby="button1">
                        <li>
                            <a href="logout.php" class="dropdown-item"><i class="bi bi-power"></i> Sign out</a>
                        </li>
                    </ul>
                </div>
            </ul>
        </div>
    </nav>

<?php } ?>