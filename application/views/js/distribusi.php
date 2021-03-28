<script>
    function mulai() {
        var main = document.getElementById('mainContainer');
        main.innerHTML = `
            <div id="inputData" class="card rounded">
            <?php

            use MathPHP\Statistics\Distribution;

            $nameErr                         = "";
            $frequencies                     = 0;
            $relative_frequencies            = 0;
            $cumulative_frequencies          = 0;
            $cumulative_relative_frequencies = 0;
            $name                            = "";

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (empty($_POST["name"])) {
                    $nameErr = "Name is required";
                } else {
                    $name = test_input($_POST["name"]);

                    $grades = explode(',', $name);

                    $frequencies                     = Distribution::frequency($grades);
                    $relative_frequencies            = Distribution::relativeFrequency($grades);
                    $cumulative_frequencies          = Distribution::cumulativeFrequency($grades);
                    $cumulative_relative_frequencies = Distribution::cumulativeRelativeFrequency($grades);
                }
            }
            function test_input($data)
            {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }
            ?>
                <div class="col-md-12 mt-4">
                    <form>
                        <div class="mb-3">
                            <label for="inputData" class="form-label">Silahkan memasukkan nilai data</label>
                            <input type="string" class="form-control" id="inputData" placeholder="Contoh: 33,96,45,22,34,12,..." aria-describedby="inputHelp" value="<?php echo $name; ?>" required>
                            <div id="inputHelp" class="form-text">Nilai data dapat dipisahkan dengan tanda koma (,). Lalu klik tombol "Hitung".</div>
                        </div>
                        <div class="d-flex justify-content-left">
                            <input id="hitung" class="btn btn-secondary ml-2 mb-2" type="submit" name="submit" value="Hitung">
                            <span class="error"> <?php echo $nameErr; ?></span>
                        </div>
                    </form>
                </div>
            </div>
            <div id="tableHasil">
                <table class="table table-light mt-2 rounded">
                    <thead>
                        <tr>
	                        <th style="text-align: center;" scope="col">Data</th>
    	                    <th style="text-align: center;" scope="col">Frekuensi</th>
    	                    <th style="text-align: center;" scope="col">Frekuensi Relatif</th>
                            <th style="text-align: center;" scope="col">Frekuensi Kumulatif</th>
                            <th style="text-align: center;" scope="col">Frekuensi Kumulatif Relatif</th>
	 				    </tr>
    	        	</thead>
        	    	<tbody>
         			    <tr>
            	    		<th scope="row"><?php echo $name ?></th>
    						<td style="text-align: right;"><?php echo $frequencies ?></td>
                            <td style="text-align: right;"><?php echo $relative_frequencies ?></td>
                            <td style="text-align: right;"><?php echo $cumulative_frequencies ?></td>
                            <td style="text-align: right;"><?php echo $cumulative_relative_frequencies ?></td>
	                </tbody>
   				</table>
			</div>
        `;
    }
</script>