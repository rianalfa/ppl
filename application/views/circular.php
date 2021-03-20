<!DOCTYPE html>
<html lang="en">

<?php $this->load->view('_partials/head'); ?>

<body>

<div id="wrapper">
        <div class="overlay"></div>

        <!-- Sidebar -->
        <?php $this->load->view('_partials/sidebar'); ?>

        <!-- Page Content -->
        <div id="page-content-wrapper" class="toggled">
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
                                    <h1 class="h3 mb-0 text-gray-800">Circular</h1>
                                </div>
                                <div class="col-md-12 mt-4" id="mainContainer">
                                    <div class="card mb-2">
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

					
					<h5> Merupakan perhitungan statistik dengan variabel yang mengindikasikan sebuah arah atau siklus waktu.Ciri cirinya adalah ketika awal
						dan akhir dari 	skala yang diukur akan bertemu 
					</h5>
					<br>
					<h5>Isi dengan sudut-sudut dengan pemisah spasi, example: 1.2 0.93 1.1</h5>
					<form method="post" action="">  
					  <h5>Sudut : <input type="text" name="name" value="<?php echo $name;?>"></h5>
					  <br><br>
					  <div class="d-flex justify-content-left">
					  <input type="submit" name="submit" value="Submit" >  
					  </div>
					</form>
					</div>
					
					<div class="card mb-2">
					<?php
					echo "<h5>Hasil Kalkulasi : </h5>";
					echo "<h5>Mean : $θ</h5>";
					echo "<h5>Resultant Length : $R </h5>";
					echo "<h5>Mean Resultant Length : $ρ</h5>";
					echo "<h5>Variance : $V</h5>";
					echo "<h5>standard Deviation : $ν</h5>";
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