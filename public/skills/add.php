<?php 

include  __DIR__ . "/../../includes/header.php";
session_start();


?>

<link rel="stylesheet" href="../css/style.css">
<body class="container">

<?php 

if(isset($_SESSION['message'])){
    echo $_SESSION['message'];
    unset($_SESSION['message']);
}
?>

    <form action="process.php" method="POST" class="form bgpurple p-5 mt-5 rounded" >
        <h1 class="">Add Skills</h1>
        <div class="mt-3">
            <label for="name">Skills</label><br>
            <input type="text" name="name" id="name" placeholder="Add your skill" required class="form-control">
        </div>

        <div class="mt-3">
            <select name="profficiency" name="" class="form-control">
                <option value="">Select Profficient Level</option>
                <option value="Novice">Novice</option>
                <option value="Intermediate">Intermediate</option>
                <option value="Advanced">Advanced</option>
                <option value="Superior">Superior</option>
                <option value="Expert">Expert</option>
            </select>
        </div>     



         <div class="mt-3">
            <label for="description">Description</label><br>
            <textarea name="description" id="description" cols="20" rows="3" class="form-control"></textarea>
        </div>

        <div class="mt-3">
        <input type="submit" name="submit" class="form-control bg-lightpurple text-white">
        </div>

       
    </form>

    

</body>
</html>
