<!doctype html>

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
                                    <h1 class="h3 mb-0 text-gray-800">Peubah Acak</h1>
                                </div>
                                <div class="col-md-12 mt-4" id="mainContainer" >
                                    <div class="card mb-2" id="mulai">
                                        <h5>
                                            Variabel Acak atau Peubah Acak adalah variabel numerik yang nilai spesifiknya tidak dapat diprediksi dengan pasti sebelum dilakukan eksperimen. 
                                            Suatu peubah acak didefinisikan sebagai fungsi yang memetakan suatu kejadian pada sesuatu interval bilangan riil. 
                                        </h5>
                                    </div>
                                <div id="inputData" class="card rounded">
                                    <?php
                                    $nameErr  = "";
		                            use MathPHP\Statistics\RandomVariable;
		                            $skewness = 0;
		                            $SES = 0;
		                            $kurtosis = 0;
		                            $SEK = 0;
		                            $sem = 0;
		                            $name = "";
					
		                            if ($_SERVER["REQUEST_METHOD"] == "POST") {
			                            if (empty($_POST["name"])) {
				                        	$nameErr = "Name is required";
				                        } else {
					                        $name = test_input($_POST["name"]);
					
					                        $X = explode(',',$name);
					
					                        $skewness = RandomVariable::skewness($X);
					                        $SES      = RandomVariable::ses(count($X)); 
					                        $kurtosis = RandomVariable::kurtosis($X); 
					                        $SEK      = RandomVariable::sek(count($X));
					                        $sem = RandomVariable::sem($X);
                                        }
                                    }
                                    function test_input($data) {
			                            $data = trim($data);
			                            $data = stripslashes($data);
			                            $data = htmlspecialchars($data);
			                            return $data;
		                            }
                                    ?>
                                    <div class="col-md-12 mt-4">
                                        <label>Silahkan masukkan data yang akan dihitung. Masukkan data dengan pemisah tanda koma (,), contoh: 1,3,5,2.</label>    
                                        <form method="post" action="">  
                                            <div class="mb-3">
                                                <label for="inputX">Data</label>
                                                <input type="text" id="inputX" class="form-control" name="name" value="<?php echo $name;?>">
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
            	        				        <th scope="row">Skewness</th>
    											<td style="text-align: right;"><?php echo $skewness?></td>
			        	                   </tr>
											<tr>
                            					<th scope="row">Standard Error of Skewness (SES)</th>
												<td style="text-align: right;"><?php echo $SES?></td>
                        					</tr>
											<tr>
                				                <th scope="row">Kurtosis</th>
												<td style="text-align: right;"><?php echo $kurtosis?></td>
					                        </tr>
											<tr>
                	            				<th scope="row">Standard Error of Kurtosis (SEK)</th>
												<td style="text-align: right;"><?php echo $SEK?></td>
            					            </tr>
											<tr>
			                	                <th scope="row">Standard Error of Mean (SEM)</th>
												<td style="text-align: right;"><?php echo $sem?></td>
				                     	    </tr>
	                			        </tbody>
   					                </table>
				                </div>
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

    <!-- /#wrapper -->
    <!-- JavaScript -->
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

