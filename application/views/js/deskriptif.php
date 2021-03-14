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
        <div class="col">
            <div class="row">
                <table id="tableData" class="table table-light table-bordered mt-2 mw-100 rounded" hidden>
                    <thead id="tableHead" class="mw-100">
                    </thead>
                    <tbody id="tableBody" class="mw-100">
                    </tbody>
                </table>
            </div>
            <div class="row">
                <table id="tableHasil" class="table table-light mt-2 rounded" hidden>
                    <thead id="tableHead2">
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
    request.open('POST', '<?= base_url('deskriptif/inputData') ?>', true);

    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            if (request.responseText == "undefined") {
                    swal('GAGAL!', 'Server gagal merespon.','error');
            } else {
                if (request.getResponseHeader('Content-type').indexOf('json') > 0) {
                    response = JSON.parse(request.responseText);
                    if (response['status'] == 'success') {
                        setNewData(response['datas'], response['heads']);
                        setNewHasil(response['stats'], response['heads']);
                    } else {
                        swal('GAGAL!', response['msg'],'error');
                    }
                } else {
                    swal('GAGAL!', 'Gagal mengupload file.','error');
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
        th.setAttribute('style', 'width: 50px;');
        th.setAttribute('scope', 'row');
        th.appendChild(document.createTextNode(i+1));

        tr.appendChild(th);

        for (var j = 0; j < datas[i].length; j++) {
            td = document.createElement('td');
            td.setAttribute('style', 'width: 150px; text-align: right;');
            td.appendChild(document.createTextNode(datas[i][j]));

            tr.appendChild(td);
        }
        
        tableBody.appendChild(tr);
    }

    document.getElementById('uploadFile').value = "";
    document.getElementById('tombolnya').hidden = true;
}

function setNewHasil(stats, heads) {
    tableHasil = document.getElementById('tableHasil').hidden = false;
    tableHead = document.getElementById('tableHead2');
    tableHead.innerHTML = "";

    setNewHead(heads, tableHead, '');

    tableBody = document.getElementById('tableBody2');
    tableBody.innerHTML = "";

    setNewHasilBody(stats, tableBody, heads.length, 'Min.', 'min', '');

    setNewHasilBody(stats, tableBody, heads.length, 'Q1', 'quartiles', 'Q1');
    
    setNewHasilBody(stats, tableBody, heads.length, 'Mean', 'mean', '');

    setNewHasilBody(stats, tableBody, heads.length, 'Median', 'median', '');
    
    setNewHasilBody(stats, tableBody, heads.length, 'Q3', 'quartiles', 'Q3');

    setNewHasilBody(stats, tableBody, heads.length, 'Maks.', 'max', '');
    
    setNewHasilBody(stats, tableBody, heads.length, 'Varians', 'variance', '');

    setNewHasilBody(stats, tableBody, heads.length, 'Standar\nDeviasi', 'sd', '');
}

function setNewHead(heads, tableHead, s) {
    tr = document.createElement('tr');

    th = document.createElement('th');
    th.setAttribute('style', 'width: 50px;');
    th.setAttribute('scope', 'col');
    th.appendChild(document.createTextNode(s));

    tr.appendChild(th);

    for (var i = 0; i < heads.length; i++) {
        th = document.createElement('th');
        th.setAttribute('style', 'width: 150px; text-align: center;');
        th.setAttribute('scope', 'col');
        th.appendChild(document.createTextNode(heads[i]));

        tr.appendChild(th);
    }

    tableHead.appendChild(tr);
}

function setNewHasilBody(stats, tableBody, heads, s, t, u) {
    tr = document.createElement('tr');
    th = document.createElement('th');
    th.setAttribute('style', 'width: 50px;');
    th.setAttribute('scope', 'col');
    th.appendChild(document.createTextNode(s));
    tr.appendChild(th);
    for (var i = 0; i < heads; i++) {
        td = document.createElement('td');
        td.setAttribute('style', 'width: 150px; text-align: right;');

        if (u == ""){
            n = +stats[i][t].toFixed(5);
        } else {
            n = +stats[i][t][u].toFixed(5);
        }

        td.appendChild(document.createTextNode(n));

        tr.appendChild(td);
    }

    tableBody.appendChild(tr);
}
</script>