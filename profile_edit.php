<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Settings</title>

    <link rel="stylesheet" href="mystyle.css">

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <!--Icon-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
</head>

<body>
    <?php
    include "nav.php";
    echo "<BR>"
    ?>
    <form action="profile_save.php" method="post">
        <div class="container rounded bg-white mb-1">
            <div class="row">
                <div class="col-md-4 border-right">
                    <div class="d-flex flex-column align-items-center text-center p-3 py-1">
                        <img class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg">
                        <span class="font-weight-bold">user_name</span>
                        <span class="text-black-50">user_email</span>
                        <span> </span>
                        <h2>ทำปุ่มใส่รูป</h2>
                    </div>
                </div>
                <div class="col-md-7 border-right">
                    <div class="p-1 py-1">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h2 class="text-right">Profile Settings</h2>
                        </div>
                        <div class="row mt-1">
                            <div class="col-md-6"><label class="labels mb-1">Name</label><input type="text" name="fname" class="form-control" placeholder="first name" value=""></div>
                            <div class="col-md-6"><label class="labels mb-1">Lastname</label><input type="text" name="lname" class="form-control"  placeholder="Last name" value=""></div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12"><label class="labels mb-1">Phone Number</label><input type="text" name="phone" class="form-control mb-3" placeholder="enter phone number" value=""></div>
                            <div class="col-md-12"><label class="labels mb-1">Reward / Experience</label><input type="text" name="exp" class="form-control mb-3" placeholder="enter Reward or Experience" value=""></div>
                            <div class="col-md-12"><label class="labels mb-1">Description</label><input type="text" name="des" class="form-control mb-3" placeholder="Description" value="" style="height: 200px;"></div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6"><label class="labels mb-1">Country</label><input type="text" name="country" class="form-control" placeholder="country" value=""></div>
                            <div class="col-md-6"><label class="labels mb-1">State/Region</label><input type="text" name="state" class="form-control" value="" placeholder="state"></div>
                        </div>
                        <div class="mt-4 text-center"><button class="btn btn-primary profile-button" type="submit">Save Profile</button></div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</body>

</html>