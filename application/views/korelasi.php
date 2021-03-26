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
                                    <h1 class="h3 mb-0 text-gray-800">Korelasi</h1>
                                </div>
                                <div class="col-md-12 mt-4" id="mainContainer">
									<div class="card mb-2" id="mulai">
                                    	<h5>
                                            Korelasi merupakan salah satu teknik analisis dalam statistik yang digunakan untuk mencari hubungan antara dua variabel yang bersifat kuantitatif.
                                            2 hal dikatakan memiliki keterhubungan jika nilai korelasi mendekati -1 atau 1, jika nilai korelasi mendekati 0 artinya kedua variable tersebut kurang memiliki keterhubungan. 
                                            Jika didapatkan nilai korelasi mendekati 1, artinya jika satu nilai meningkat maka nilai yang lain secara linear akan meningkat. 
                                            Jika didapatkan nilei korelasi mendekati -1, artinya jika satu nilai menaik maka nilai yang lain akan secara linear menurun.
                                   		</h5>
                                	</div>
									<?php
									// define variables and set to empty values
									use MathPHP\Statistics\Correlation;
									$nameErr = "";
									$σxy=0;
									$r=0;
									$R²=0;
									$τ=0;
									$ρ=0;
                    				$name="";
                    				$name2 ="";
								
									if ($_SERVER["REQUEST_METHOD"] == "POST") {
					  					if (empty($_POST["name"])) {
											$nameErr = "Name is required";
					  					} else {
											$name = test_input($_POST["name"]);
										}
					  					if (empty($_POST["name2"])) {
											$nameErr = "Name is required";
					  					} else {
											$name2 = test_input($_POST["name2"]);
										}

										$X = explode(',',$name);
                    					$Y = explode(',',$name2);
					
                    					$σxy = Correlation::covariance($X, $Y);
										$r = Correlation::r($X, $Y);
                    					$R² = Correlation::r2($X, $Y);
                    					$τ = Correlation::kendallsTau($X, $Y);
                    					$ρ = Correlation::spearmansRho($X, $Y);
					  				}

									function test_input($data) {
					  					$data = trim($data);
					  					$data = stripslashes($data);
					  					$data = htmlspecialchars($data);
					  					return $data;
									}
									?>
									<div class="card rounded" id="inputData" >
										<div class="col-md-12 mt-4">
											<label>Silahkan masukkan data variabel X dan Y yang akan dihitung. Masukkan data dengan pemisah tanda koma (,), contoh: 1,3,5,2.</label>
											<form method="post" action="">  
												<div class="mb-3">
													<label for="inputX">Variabel X</label>
													<input type="text" class="form-control" id="inputX" name="name" value="<?php echo $name;?>">
					  								<span class="error"> <?php echo $nameErr;?></span>

						  							<label for="inputY">Variabel Y</label>
					  								<input type="text" class="form-control" id="inputY" name="name2" aria-describedby="inputHelp" value="<?php echo $name2;?>">
													<small id="inputHelp" class="form-text text-muted">Pastikan jumlah data X dan Y sama</small>
					  								<span class="error"> <?php echo $nameErr;?></span>
												</div>
						  						<div class="d-flex justify-content-left">
    	                        					<input id="hitung" class="btn btn-secondary ml-2 mb-2" type="submit" name="submit" value="Hitung" >
        	            						</div>
											</form>
										</div>
									</div>
									<div id="tableHasil">
										<table class="table table-light mt-2 rounded">
                        					<thead>
                            					<tr>
	                    			    	        <th style="text-align: center;" scope="col"></th>
    	                            				<th style="text-align: center;" scope="col">Nilai</th>
	 				       	                    </tr>
    	        				            </thead>
        	        	        			<tbody>
         					           	        <tr>
                	        				        <th scope="row">Covarian</th>
													<td style="text-align: right;"><?php echo $σxy?></td>
 				        	                   </tr>
												<tr>
                                					<th scope="row">Pearson Correlation Coefficient</th>
													<td style="text-align: right;"><?php echo $r?></td>
                            					</tr>
												<tr>
	                				                <th scope="row">Coefficient of Determination (R²)</th>
													<td style="text-align: right;"><?php echo $R²?></td>
					                            </tr>
												<tr>
                	                				<th scope="row">Kendall Rank Correlation Coefficient (τ)</th>
													<td style="text-align: right;"><?php echo $τ?></td>
                					            </tr>
												<tr>
				                	                <th scope="row">Spearman's Rank Correlation Coefficient (ρ)</th>
													<td style="text-align: right;"><?php echo $ρ?></td>
				                        	    </tr>
	                				        </tbody>
   					                 	</table>
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