<!DOCTYPE html>
<html lang="en">

<?php $this->load->view('_partials/head'); ?>
<title>Anjay</title>
<body>

<div id="wrapper">
        <div class="overlay"></div>

        <!-- Sidebar -->
        <?php $this->load->view('_partials/sidebar'); ?>

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div id="content">
                <div class="container-fluid p-0 px-lg-0 px-md-0">

                    <!-- Navbar -->
                    <?php $this->load->view('_partials/navbar'); ?>

                    <!-- Begin Page Content -->
					

					<?php
					// define variables and set to empty values
					$nameErr = $emailErr = $genderErr = $websiteErr = "";
					$email = $gender = $comment = $website = "";
					$name = "";
					if ($_SERVER["REQUEST_METHOD"] == "POST") {
					  if (empty($_POST["name"])) {
						$nameErr = "Name is required";
					  } else {
						$name = test_input($_POST["name"]);
						
					  }
					  
					  
					}

					function test_input($data) {
					  $data = trim($data);
					  $data = stripslashes($data);
					  $data = htmlspecialchars($data);
					  return $data;
					}
					?>

					<h2>Statistic Circular</h2>
					<p>Isi dengan sudut-sudut dengan pemisah spasi, example: 1.2 0.93 1.1</p>
					<form method="post" action="">  
					  Sudut : <input type="text" name="name" value="<?php echo $name;?>">
					  <span class="error"> <?php echo $nameErr;?></span>
					  <br><br>
					  <input type="submit" name="submit" value="Submit">  
					</form>
					<?php
					use MathPHP\Statistics\Circular;
					$angles = explode(' ',$name);
					//$angles = [1.51269877, 1.07723915, 0.81992282];
					
					$θ = Circular::mean($angles);
					$R = Circular::resultantLength($angles);
					$ρ = Circular::meanResultantLength($angles);
					$V = Circular::variance($angles);
					$ν = Circular::standardDeviation($angles);

					// Descriptive circular statistics report
					$stats = Circular::describe($angles);
					?>
					
					<?php
					echo "<br>";
					echo "<h3>Hasil Kalkulasi : </h3>";
					echo $θ;
					echo "<br>";
					echo $R;
					echo "<br>";
					echo $ρ;
					echo "<br>";
					echo $comment;
					echo "<br>";
					echo $gender;
					?>


					
					
					
                <!-- Footer -->
                <?php $this->load->view('_partials/footer'); ?>

            </div>
        </div>
        <!-- /#page-content-wrapper -->
    </div>
	
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
   
</body>
</html>