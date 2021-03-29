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
                                    <h1 class="h3 mb-0 text-gray-800">Uji Signifikansi</h1>
                                </div>
                                <div class="col-md-12 mt-4" id="mainContainer">
									<div class="card mb-2" id="mulai">
                                    	<h5>
                                        <ul style="list-style-type: disc;" class="col-md-12">
												<h4>Uji t sample berpasangan</h4>
                                                <p>Uji t sample berpasangan sering kali disebut sebagai paired-sampel t test. 
                                                Uji t untuk data sampel berpasangan membandingkan rata-rata dua variabel untuk 
                                                suatu grup sampel tunggal. Uji ini menghitung selisih antara nilai dua variabel 
                                                untuk tiap kasus dan menguji apakah selisih rata-rata tersebut bernilai nol.<p>
                                            </ul>
                                        </h5>
                                	</div>
									<?php
									// define variables and set to empty values
									use MathPHP\Statistics\Significance;
									$nameErr = "";
									$t = 0;
									$df = 0;
									$p1 = 0;
									$p2 = 0;
									$mean1 = 0;
									$mean2 = 0;
									$sd1 = 0;
									$sd2 = 0;

                    				$name = "";
                    				$name2 = "";
								
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
					
                    					$t = Significance::tTest($X, $Y)['t'];
                                        $df = Significance::tTest($X, $Y)['df'];
                                        $p1 = Significance::tTest($X, $Y)['p1'];
                                        $p2 = Significance::tTest($X, $Y)['p2'];
                                        $mean1 = Significance::tTest($X, $Y)['mean1'];
                                        $mean2 = Significance::tTest($X, $Y)['mean2'];
                                        $sd1 = Significance::tTest($X, $Y)['sd1'];
                                        $sd2 = Significance::tTest($X, $Y)['sd2'];
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
											<label>Silahkan masukkan data variabel X dan Y yang akan dihitung. Masukkan data dengan pemisah tanda koma (,), contoh: 20,24,27.</label>
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
	                    			    	        <th style="text-align: left;" scope="col">Ringkasan</th>
    	                            				<th style="text-align: left;" scope="col">Nilai</th>
	 				       	                    </tr>
    	        				            </thead>
        	        	        			<tbody>
         					           	        <tr>
                	        				        <th scope="row">t score</th>
													<td style="text-align: left;"><?php echo ": $t";?></td>
 				        	                   </tr>
												<tr>
                                					<th scope="row">degrees of freedom</th>
													<td style="text-align: left;"><?php echo ": $df";?></td>
                            					</tr>
												<tr>
	                				                <th scope="row">One-tailed p value</th>
													<td style="text-align: left;"><?php echo ": $p1";?></td>
					                            </tr>
												<tr>
                	                				<th scope="row">two-tailed p value</th>
													<td style="text-align: left;"><?php echo ": $p2";?></td>
                					            </tr>
												<tr>
				                	                <th scope="row">mean of sample x₁</th>
													<td style="text-align: left;"><?php echo ": $mean1";?></td>
				                        	    </tr>
												<tr>
				                	                <th scope="row">mean of sample x₂</th>
													<td style="text-align: left;"><?php echo ": $mean2";?></td>
				                        	    </tr>
												<tr>
				                	                <th scope="row">standard deviation of x₁</th>
													<td style="text-align: left;"><?php echo ": $sd1";?></td>
				                        	    </tr>
												<tr>
				                	                <th scope="row">standard deviation of x₂</th>
													<td style="text-align: left;"><?php echo ": $sd2";?></td>
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