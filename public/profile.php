
<!-- connecting to the data base -->
    <?php
include "../config/config.php";



$id = $_SESSION['user']['id'];

$sql = "SELECT id, first_name, last_name, bio, phone, image FROM profile where user_id = $id";
$result= mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$Image = str_replace('../', '', $row['image']);
?>

    <div class="container col-md-12  shadow-md p-5">
        <div class="row d-flex justify-content-center">
            <div class=" mt-2 pt-5">
                <div class="row z-depth-3">
                    <div class="bg-light col-sm-4  rounded-left">
                        <div class="card-block text-center text-black">
                            <i class="fas fa-user-tie fa-7x mt-5"></i>
                            <div class="container">
                            <img class="img rounded-circle img-fluid"
                            src="<?php echo $Image; ?>" onerror="this.src='projectUploads/defualt.png'" alt="" style="width: 200px; height: 200px;; margin-top: 20px"></div>
                            <h2 class="font-weight-bold mt-4"><?php echo $row['username'] ?? ""?></h2>
                            <p><?php echo $row['first_name'] ?? ""?></p>
                            <p><?php echo $row['last_name'] ?? ""?></p>
                            <i class="far fa-edit fa-2x mb-4"></i>
                        </div>
                    </div>
                    <div class="bg-light col-sm-8 rounded-right">
                        <h3 class="mt-3 text-center text-black">Informations</h3>
                        <hr class="badge-primary mt-0 w-">
                        <div class="row">
                        <div class="col-sm-6">
                            <p class="font-weight-bold text-black">Biography:</p>
                            <h6 class="text-muted"><?php echo $row['bio'] ?? ""?></h6>
                        </div>
                    </div>
                        <div class="row my-5">
                        <div class="col-sm-6">
                                <button class="text-white text-white p-4 bgpurple-lighter rounded hover:bgpurple">Share</button>
                            </div>
                        <div class="col-sm-6">
                        <a href="profile/" class="text-white p-4 bgpurple-lighter rounded hover:bgpurple" style="text-decoration: none">Edit Profile</a>

                            </div>
                    </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>

    <script src="js/bootstrap.js"></script>
</div>