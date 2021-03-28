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
                                    <h1 class="h3 mb-0 text-gray-800">Distances</h1>
                                </div>
                                <div class="col-md-12 mt-4" id="mainContainer">
									<div class="card mb-2" id="mulai">
                                    	<h5>
                                        <ul style="list-style-type: disc;" class="col-md-12">
												<p>Berikut adalah yang dihitung :</p>
                                                <li>Bhattacharyya Distance</li>
                                                <li>Hellinger Distance</li>
                                                <li>Minkowski Distance</li>
                                                <li>Euclidean Distance</li>
                                                <li>Manhattan Distance</li>
                                                <li>Jensen Shannon Distance</li>
                                                <li>Canberra Distance</li>
                                                <li>Bray Curtis Distance</li>
                                                <li>Cosine Distance</li>
                                                <li>Cosine Similarity Distance</li>
                                            </ul>
                                        </h5>
                                	</div>
									<?php
									// define variables and set to empty values
									// use MathPHP\Statistics\Correlation;
									use MathPHP\Statistics\Distance;
									$nameErr = "";
									$DB⟮X、Y⟯=0;
									$H⟮X、Y⟯=0;
									$D⟮X、Y⟯=0;
									$d⟮X、Y⟯=0;
									$d₁⟮X、Y⟯=0;
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
					
                    					$DB⟮X、Y⟯   = Distance::bhattacharyyaDistance($X, $Y);
										$H⟮X、Y⟯    = Distance::hellingerDistance($X, $Y);
										$D⟮X、Y⟯    = Distance::minkowski($X, $Y, $p = 2);
										$d⟮X、Y⟯    = Distance::euclidean($X, $Y);               // L² distance
										$d₁⟮X、Y⟯   = Distance::manhattan($X, $Y);
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
                	        				        <th scope="row">Bhattacharyya Distance</th>
													<td style="text-align: right;"><?php echo $DB⟮X、Y⟯?></td>
 				        	                   </tr>
												<tr>
                                					<th scope="row">Hellinger Distance</th>
													<td style="text-align: right;"><?php echo $H⟮X、Y⟯?></td>
                            					</tr>
												<tr>
	                				                <th scope="row">Minkowski Distance</th>
													<td style="text-align: right;"><?php echo $D⟮X、Y⟯?></td>
					                            </tr>
												<tr>
                	                				<th scope="row">Euclidean Distance</th>
													<td style="text-align: right;"><?php echo $d⟮X、Y⟯?></td>
                					            </tr>
												<tr>
				                	                <th scope="row">Manhattan Distance</th>
													<td style="text-align: right;"><?php echo $d₁⟮X、Y⟯?></td>
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