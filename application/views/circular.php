<!DOCTYPE html>
<html lang="en">

<?php $this->load->view('_partials/head'); ?>

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

					<?php
					// define variables and set to empty values
					$nameErr  = "";
					use MathPHP\Statistics\Circular;
					$θ = 0;
					$R = 0;
					$ρ = 0;
					$V = 0;
					$ν = 0;
					$name = "";
					
					if ($_SERVER["REQUEST_METHOD"] == "POST") {
					  if (empty($_POST["name"])) {
						$nameErr = "Name is required";
					  } else {
						$name = test_input($_POST["name"]);
						
					
					
					$angles = explode(' ',$name);
					
					//$angles = [1.51269877, 1.07723915, 0.81992282];
					
					$θ = Circular::mean($angles);
					$R = Circular::resultantLength($angles);
					$ρ = Circular::meanResultantLength($angles);
					$V = Circular::variance($angles);
					$ν = Circular::standardDeviation($angles);

					// Descriptive circular statistics report
					$stats = Circular::describe($angles);
					
					
					
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
					  <br><br>
					  <input type="submit" name="submit" value="Submit" >  
					</form>
					<?php
					echo "<br>";
					echo "<h4>Hasil Kalkulasi : </h4>";
					echo "<p>Mean : $θ</p>";
					echo "<p>Resultant Length : $R </p>";
					echo "<p>Mean Resultant Length : $ρ</p>";
					echo "<p>Variance : $V</p>";
					echo "<p>standardDeviation : $ν</p>";
					?>


					
					
					
                <!-- Footer -->
                <?php $this->load->view('_partials/footer'); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
</div>
        <!-- /#page-content-wrapper -->
   
	
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