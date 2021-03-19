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
                    <div class="container-fluid px-lg-4">
                        <div class="row">
                            <div class="col-md-12 mt-lg-4 mt-4">
                                <!-- Page Heading -->
                                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                    <h1 class="h3 mb-0 text-gray-800">Outlier</h1>
                                </div>
                                <div class="col-md-12 mt-4" id="mainContainer">

					<?php
					// define variables and set to empty values
					use MathPHP\Statistics\Outlier;
					$nameErr = $emailErr = $genderErr = $websiteErr = "";
					$email = $gender = $comment = $website = "";
					$data =$jumlah=$alpha=$name= "";
					$grubbsStatistic=0;
					$criticalValue=0;
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
						
					$data = explode(' ',$name);
					/* $data = [199.31, 199.53, 200.19, 200.82, 201.92, 201.95, 202.18, 245.57]; */
					$n    = $jumlah;    // size of data
					$𝛼    = $alpha; // significance level
					
					$grubbsStatistic1 = Outlier::grubbsStatistic($data, Outlier::TWO_SIDED);
					$criticalValue1   = Outlier::grubbsCriticalValue((float) $𝛼,(float) $n, Outlier::TWO_SIDED);

					// Grubbs' test - one sided test of minimum value
					$grubbsStatistic2 = Outlier::grubbsStatistic($data, Outlier::ONE_SIDED_LOWER);
					$criticalValue2   = Outlier::grubbsCriticalValue((float) $𝛼,(float) $n, Outlier::ONE_SIDED);

					// Grubbs' test - one sided test of maximum value
					$grubbsStatistic3 = Outlier::grubbsStatistic($data, Outlier::ONE_SIDED_UPPER);
					$criticalValue3   = Outlier::grubbsCriticalValue((float) $𝛼,(float) $n, Outlier::ONE_SIDED);
					// Descriptive circular statistics report
					//$stats = Circular::describe($angles);
					  }
					  
					}

					function test_input($data) {
					  $data = trim($data);
					  $data = stripslashes($data);
					  $data = htmlspecialchars($data);
					  return $data;
					}
					?>
					<div class="card mb-2">
					<h5>Outlier atau pencilan adalah titik data yang berbeda secara signifikan dari pengamatan lain</h5>
					<h5>Isi dengan nilai-nilai dengan pemisah spasi ( ), contoh isian: </h5>
					<h5>	data = 199.31 199.53 200.19 200.82 201.92 201.95 202.18 245.57</h5>
					<h5>	n    = 8 </h5>
					<h5>	𝛼    = 0.05 </h5>
					<form method="post" action="">  
					  <h5>Data : <input type="text" name="name" value="<?php echo $name;?>"></h5>
					  <span class="error"> <?php echo $nameErr;?></span>
					  
					  <h5>n : <input type="text" name="jumlah" value="<?php echo $jumlah;?>"></h5>
					  <span class="error"> <?php echo $nameErr;?></span>
					  
					  <h5>𝛼 : <input type="text" name="alpha" value="<?php echo $alpha;?>"></h5>
					  <span class="error"> <?php echo $nameErr;?></span>
					  
					  <input type="submit" name="submit" value="Submit">  
					</form>
					</div>
					<div class="card mb-2">
					<?php
					echo "<br>";
					echo "<h4>Hasil Kalkulasi : </h4>";
					echo "<h5>Grubb's test - two sided test : $grubbsStatistic1 </h5>";
					echo "<h5>Critical Value - two sided test  : $criticalValue1</h5>";
					echo "<h5>Grubb's test - one sided test of minimum value : $grubbsStatistic2 </h5>";
					echo "<h5>Critical Value - one sided test of minimum value : $criticalValue2</h5>";
					echo "<h5>Grubb's test -one sided test of maximum value : $grubbsStatistic3 </h5>";
					echo "<h5>Critical Value -one sided test of maximum value : $criticalValue3</h5>";
					
					?>
					</div>
								</div>
							</div>
						</div>
					</div>
				</div>

					
					
					
                <!-- Footer -->
                <?php $this->load->view('_partials/footer'); ?>

					</div>
				
			
        
        <!-- /#page-content-wrapper -->
    </div>
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