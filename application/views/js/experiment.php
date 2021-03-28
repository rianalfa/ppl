<script>    
    function gettingStarted() {
        var main = document.getElementById('mainContainer');
        main.innerHTML = `
            <div class="card mb-2 rounded">
                <label class="ml-3 mt-2" for="uploadFile">
                    Silahkan unggah file data yang akan dihitung. (File berekstensi 'xlsx' atau 'xls')<br>
                    Contoh
                </label>
                <tr>
                    <left><img src="http://1.bp.blogspot.com/-kMHrDLCfizE/TpkTTKcYeiI/AAAAAAAAAKM/kFlCLiFWNEg/s1600/fisher1.PNG" width="300" height="100"/></left>
                </tr>
                <label>
                    A = 3 (Ya dan Ya) <br>
                    B = 1 (Ya dan Tidak) <br>
                    C = 0 (Tidak dan Ya) <br>
                    D = 3 (Tidak dan Tidak) <br><br>

                    CONTOH INPUT EXCEL <br>
                </label>
                <table border="1" width="300" height="100">
                <thead>
                <tr>
                <td>A</td>
                <td>B</td>
                <td>C</td>
                <td>D</td>
                </tr>
                </thead>
                <tbody>
                <tr>
                <td>Nilai A</td>
                <td>Nilai B</td>
                <td>Nilai C</td>
                <td>Nilai D</td>
                </tr>
                </tbody>
                </table>
                <div class="d-flex justify-content-between">
                    <input type="file" class="form-control-file w-50 p-2 ml-1" id="uploadFile" name="uploadFile" value="" required/>
                    <button id="tombolnya" onclick="inputData();" class="btn btn-sm btn-secondary w-25 mr-2 mb-2" hidden>Input</button>
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
                                <th scope="col">Hasil</th>
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
        request.open('POST', '<?= base_url('experiments/inputData') ?>', true);
        request.onreadystatechange = function() {
            if (request.readyState == 4 && request.status == 200) {
                if (request.responseText == "") {
                    swal('GAGAL!', 'Server gagal merespon.','error');
                    document.getElementById('uploadFile').value = "";
                    document.getElementById('tombolnya').hidden = true;
                } else {
                    if (request.getResponseHeader('Content-type').indexOf('json') > 0) {
                        response = JSON.parse(request.responseText);
                        if (response['status'] == 'success') {
                            setNewData(response['datas'], response['heads']);
                            alert(response);
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

    function setNewData(datas, a, b, c, d) {
        document.getElementById('tableData').hidden=false;
        document.getElementById('tableHead').innerHTML=`
            <tr>
                <th style="width:75px; text-align: center;" scope="col">No.</th>
                <th style="text-align: center;"scope="col">` + datas[0][0] + `</th>
                <th style="text-align: center;"scope="col">` + datas[0][1] + `</th>
                <th style="text-align: center;"scope="col">` + datas[0][2] + `</th>
                <th style="text-align: center;"scope="col">` + datas[0][3] + `</th>
            </tr>
        `;
        tableBody = document.getElementById('tableBody');
        tableBody.innerHTML = "";
        for (var i = 1; i < datas.length; i++) {
            tableBody.innerHTML += `
                <tr>
                    <th style="width:75px;" scope="row">` + (i) + `</th>
                    <td style="text-align: center;">` + datas[i][0] + `</td>
                    <td style="text-align: center;">` + datas[i][1] + `</td>
                    <td style="text-align: center;">` + datas[i][2] + `</td>
                    <td style="text-align: center;">` + datas[i][3] + `</td>
                </tr>
            `;
        }
        document.getElementById('uploadFile').value = "";
        document.getElementById('tombolnya').hidden = true;
    }

    function setNewHasil(experiments) {
        document.getElementById('tableHasil').hidden=false;
        tableBody = document.getElementById('tableBody2');
        tableBody.innerHTML = "";

        setNewHasilBody(tableBody, experiments['rr']['RR'], 'Risk Ratio');
        setNewHasilBody(tableBody, experiments['or']['OR'], 'Odds Ratio');
        setNewHasilBody(tableBody, experiments['ll']['LL+'], 'Likelihood Ratio');
    }

    function setNewHasilBody(tableBody, experiment, s) {
        n = +experiment.toFixed(5);

        tableBody.innerHTML += `
            <tr>
                <th class="w-50" scope="row">` + s + `</th>
                <td>` + n + `</td>
            </tr>
        `;  
    }
</script>