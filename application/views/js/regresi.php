<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.8.0/jszip.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.8.0/xlsx.js"></script>
<script>    
    function gettingStarted() {
        var main = document.getElementById('mainContainer');
        main.innerHTML = `
            <div class="card mb-2 rounded">
                <label class="ml-3 mt-2" for="uploadFile">
                    Silahkan unggah file data yang akan dihitung. (File berekstensi 'xlsx' atau 'xls')
                </label>
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

    var setData = function(heads) {

        this.parseExcel = function(file) {
            var reader = new FileReader();

            reader.onload = function(e) {
                var data = e.target.result;
                var workbook = XLSX.read(data, {
                type: 'binary'
                });
                workbook.SheetNames.forEach(function(sheetName) {
                // Here is your object
                var XL_row_object = XLSX.utils.sheet_to_row_object_array(workbook.Sheets[sheetName]);
                var json_object = JSON.stringify(XL_row_object);

                setNewData(JSON.parse(json_object), heads);
                })
            };

            reader.onerror = function(ex) {
                alert(ex);
            };

            reader.readAsBinaryString(file);
        };
    };

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
                    swal('GAGAL!', 'Server gagal merespon.','error');
                    document.getElementById('uploadFile').value = "";
                    document.getElementById('tombolnya').hidden = true;
                } else {
                    if (request.getResponseHeader('Content-type').indexOf('json') > 0) {
                        response = JSON.parse(request.responseText);
                        if (response['status'] == 'success') {
                            var readExcel = new setData(response['heads']);
                            readExcel.parseExcel(file);

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

    function setNewData(datas, heads) {
        document.getElementById('tableData').hidden = false;
        tableHead = document.getElementById('tableHead');
        tableHead.innerHTML = "";

        setNewHead(heads, tableHead, 'No.');

        tableBody = document.getElementById('tableBody');
        tableBody.innerHTML = "";

        for (var i = 0; i < datas.length; i++) {
            tr = document.createElement('tr');

            th = document.createElement('th');
            th.setAttribute('style', 'width: 75px;');
            th.setAttribute('scope', 'row');
            th.appendChild(document.createTextNode(i+1));

            tr.appendChild(th);

            for (var j = 0; j < heads.length; j++) {
                td = document.createElement('td');
                td.setAttribute('style', 'text-align: right;');
                if (datas[i].hasOwnProperty(heads[j])) {
                    td.appendChild(document.createTextNode(datas[i][heads[j]]));
                } else {
                    td.appendChild(document.createTextNode(""));
                }

                tr.appendChild(td);
            }
            
            tableBody.appendChild(tr);
        }

        document.getElementById('uploadFile').value = "";
        document.getElementById('tombolnya').hidden = true;
    }

    function setNewHead(heads, tableHead, s) {
        tr = document.createElement('tr');

        th = document.createElement('th');
        th.setAttribute('style', 'width: 75px;');
        th.setAttribute('scope', 'col');
        th.appendChild(document.createTextNode(s));

        tr.appendChild(th);

        for (var i = 0; i < heads.length; i++) {
            th = document.createElement('th');
            th.setAttribute('style', 'text-align: center;');
            th.setAttribute('scope', 'col');
            th.appendChild(document.createTextNode(heads[i]));

            tr.appendChild(th);
        }

        tableHead.appendChild(tr);
    }

    function setNewHasil(hasils) {
        document.getElementById('tableHasil').hidden=false;
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