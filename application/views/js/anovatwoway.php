<script>
    function twoway() {
        var main = document.getElementById('mainContainer');
        main.innerHTML = `
            <div class="card mb-2 rounded">
                <div class="card mb-2" id="mulai">
                    <h5>
                    ANOVA TWO WAY membandingkan perbedaan rata-rata antara kelompok yang telah dibagi pada dua variabel independen (disebut faktor).
                    </h5>
                </div>
                <label class="ml-3 mt-2" for="uploadFile">
                    Silahkan unggah file data yang akan dianalisa (File berekstensi 'xlsx' atau 'xls'). Lalu klik tombol "Analisa".
                </label>
                <div class="d-flex justify-content-between">
                    <input type="file" class="form-control-file w-50 p-2 ml-1" id="uploadFile" name="uploadFile" value="" required/>
                    <button id="tombolnya" onclick="inputData();" class="btn btn-sm btn-secondary w-25 mr-2 mb-2" hidden>Analisa</button>
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

        filenya = document.getElementById('uploadFile');
        filenya.addEventListener('change', function(e) {
            if (filenya.value == "") {
                document.getElementById("tombolnya").hidden = true;
            } else {
                document.getElementById("tombolnya").hidden = false;
            }
        });
    }

    function inputData() {
        filenya = document.getElementById('uploadFile');
        var file = filenya.files[0];
        var datanya = new FormData();
        datanya.append("uploadFile", file);
        request = new XMLHttpRequest();
        request.open('POST', '<?= base_url('regresi/inputData') ?>', true);
        request.onreadystatechange = function() {
            if (request.readyState == 4 && request.status == 200) {
                if (request.responseText == "") {
                    swal('GAGAL!', 'Server gagal merespon.', 'error');
                    document.getElementById('uploadFile').value = "";
                    document.getElementById('tombolnya').hidden = true;
                } else {
                    if (request.getResponseHeader('Content-type').indexOf('json') > 0) {
                        response = JSON.parse(request.responseText);
                        if (response['status'] == 'success') {
                            setNewData(response['datas'], response['x'], response['y']);
                            setNewHasil(response);
                        } else {
                            swal('GAGAL!', response['msg'], 'error');
                            document.getElementById('uploadFile').value = "";
                            document.getElementById('tombolnya').hidden = true;
                        }
                    } else {
                        swal('GAGAL!', request.responseText, 'error');
                        document.getElementById('uploadFile').value = "";
                        document.getElementById('tombolnya').hidden = true;
                    }
                }
            }
        }
        request.send(datanya);
    }

    function setNewData(datas, x, y) {
        document.getElementById('tableData').hidden = false;
        document.getElementById('tableHead').innerHTML = `
            <tr>
                <th style="width:75px; text-align: center;" scope="col">No.</th>
                <th style="text-align: center;"scope="col">` + x + `</th>
                <th style="text-align: center;"scope="col">` + y + `</th>
            </tr>
        `;
        tableBody = document.getElementById('tableBody');
        tableBody.innerHTML = "";
        for (var i = 0; i < datas.length; i++) {
            tableBody.innerHTML += `
                <tr>
                    <th style="width:75px;" scope="row">` + (i + 1) + `</th>
                    <td style="text-align: right;">` + datas[i][0] + `</td>
                    <td style="text-align: right;">` + datas[i][1] + `</td>
                </tr>
            `;
        }
        document.getElementById('uploadFile').value = "";
        document.getElementById('tombolnya').hidden = true;
    }

    function setNewHasil(hasils) {
        document.getElementById('tableHasil').hidden = false;
        tableBody = document.getElementById('tableBody2');
        tableBody.innerHTML = "";

        setNewHasilBody(tableBody, hasils['m'], 'Gradien (m)');

        setNewHasilBody(tableBody, hasils['mse'], 'Std. Error');

        setNewHasilBody(tableBody, hasils['mt'], 't-Statistik');

        setNewHasilBody(tableBody, hasils['mp'], 'Probabilitas');

        setNewHasilBody(tableBody, hasils['r2'], 'R-squared');

        setNewHasilBody(tableBody, hasils['fs'], 'F-Statistik');

        setNewHasilBody(tableBody, hasils['fp'], 'Prob(F-Statistik)');

        setNewHasilBody(tableBody, hasils['hasil'], 'Persamaan\nRegresi');
    }

    function setNewHasilBody(tableBody, hasil, s) {
        n = +hasil.toFixed(5);

        tableBody.innerHTML += `
            <tr>
                <th class="w-25" scope="row">` + s + `</th>
                <td>` + n + `</td>
            </tr>
        `;
    }
</script>