<script>    
    function gettingStarted() {
        var main = document.getElementById('mainContainer');
        main.innerHTML = `
            <div class="card">
                <div class="col-md-12 mt-4">
                <form method="post" action="" >  
                    <div class="mb-3">
                        <label class="form-label" for="inputData">
                            Silahkan masukkan data yang akan dihitung. Masukkan data dengan pemisah tanda koma, contoh: 1,3,5,2
                        </label>
                            <input type="text" class="form-control" id="inputData" name="inputData" value="">
                    </div>
                    <div class="d-flex justify-content-left">
                        <button class="btn btn-secondary ml-2 mb-2" onclick="hitung();">Hitung</button>
                    </div>
				</form>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <table id="tableData" class="table table-light mt-2 rounded" hidden>
                        <thead id="tableHead">
                        </thead>
                        <tbody id="tableBody">
                        </tbody>
                    </table>
                </div>
                <div class="col">
                    <table id="tableHasil" class="table table-light mt-2 rounded" hidden>
                        <thead id="tableHead2">
                            <tr>
                                <th class="w-25" scope="col"></th>
                                <th scope="col">Nilai</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody2">
                        </tbody>
                    </table>
                </div>
            </div>
        `;
    }

    function inputData() {
        
    }
</script>