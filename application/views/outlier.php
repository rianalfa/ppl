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
					$data =$jumlah=$alpha=$name= "";
					$data = [199.31, 199.53, 200.19, 200.82, 201.92, 201.95, 202.18, 245.57];
					$n    = 8;    // size of data
					$𝛼    = 0.05; // significance level
					if ($_SERVER["REQUEST_METHOD"] == "POST") {
					  if (empty($_POST["name"])) {
						$nameErr = "Name is required";
					  } else {
						$name = test_input($_POST["name"]);
						
					  }
					  if (empty($_POST["jumlah"])) {
						$nameErr = "Name is required";
					  } else {
						$jumlah = test_input($_POST["jumlah"]);
						
					  }
					  if (empty($_POST["alpha"])) {
						$nameErr = "Name is required";
					  } else {
						$alpha = test_input($_POST["alpha"]);
						
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
					<p>Isi dengan nilai-nilai dengan pemisah spasi, example: 199.31 199.53 200.19 200.82 201.92 201.95 202.18 245.57</p>
					<p>	n    = 8 </p>
					<p>	𝛼    = 0.05 </p>
					<form method="post" action="">  
					  Data : <input type="text" name="name" value="<?php echo $name;?>">
					  <span class="error"> <?php echo $nameErr;?></span>
					  <br><br>
					  n : <input type="text" name="jumlah" value="<?php echo $jumlah;?>">
					  <span class="error"> <?php echo $nameErr;?></span>
					  <br><br>
					  𝛼 : <input type="text" name="alpha" value="<?php echo $alpha;?>">
					  <span class="error"> <?php echo $nameErr;?></span>
					  <br><br>
					  <input type="submit" name="submit" value="Submit">  
					</form>
					<?php
					use MathPHP\Statistics\Outlier;
					$data = explode(' ',$name);
					/* $data = [199.31, 199.53, 200.19, 200.82, 201.92, 201.95, 202.18, 245.57]; */
					$n    = $jumlah;    // size of data
					$𝛼    = $alpha; // significance level
					
					$grubbsStatistic = Outlier::grubbsStatistic($data, Outlier::TWO_SIDED);
					$criticalValue   = Outlier::grubbsCriticalValue((float) $𝛼,(float) $n, Outlier::TWO_SIDED);

					// Grubbs' test - one sided test of minimum value
					$grubbsStatistic = Outlier::grubbsStatistic($data, Outlier::ONE_SIDED_LOWER);
					$criticalValue   = Outlier::grubbsCriticalValue($𝛼, $n, Outlier::ONE_SIDED);

					// Grubbs' test - one sided test of maximum value
					$grubbsStatistic = Outlier::grubbsStatistic($data, Outlier::ONE_SIDED_UPPER);
					$criticalValue   = Outlier::grubbsCriticalValue($𝛼, $n, Outlier::ONE_SIDED);
					// Descriptive circular statistics report
					//$stats = Circular::describe($angles);
					?>
					
					<?php
					echo "<br>";
					echo "<h5>Grubb's test - two sided test : </h5>";
					echo $grubbsStatistic;
					echo "<br>";
					echo "<h5>Critical Value : </h5>";
					echo $criticalValue;
					/* echo "<br>";
					echo $ρ;
					echo "<br>";
					echo $comment;
					echo "<br>";
					echo $gender; */
					?>


					
					
					
                <!-- Footer -->
                <?php $this->load->view('_partials/footer'); ?>

            </div>
        </div>
        <!-- /#page-content-wrapper -->
    </div>
	
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	<script>
		$('#bar').click(function() {
            $(this).toggleClass('open');
            $('#page-content-wrapper ,#sidebar-wrapper').toggleClass('toggled');

        });
	</script>
</body>
</html>