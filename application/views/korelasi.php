
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
                                    <h1 class="h3 mb-0 text-gray-800">Korelasi</h1>
                                </div>
                                <div class="col-md-12 mt-4" id="mainContainer">
                                    <div class="card">
                                        <h5>
                                            Korelasi adalah
                                        </h5>
                                        <div class="d-flex justify-content-left">
                                            <button class="btn btn-secondary ml-2 mb-2" onclick="gettingStarted();">Getting Started</button>
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
            request.open('POST', '<?= base_url('korelasi/inputData') ?>', true);
            request.onreadystatechange = function() {
                if (request.readyState == 4 && request.status == 200) {
                    if (request.getResponseHeader('Content-type').indexOf('json') > 0) {
                        response = JSON.parse(request.responseText);
                        setNewData(response['datas'], response['x'], response['y']);
                        setNewHasil(response);
                    } else {
                        alert("BABI");
                    }
                }
            }
            request.send(datanya);
        }

        function setNewData(datas, x, y) {
            document.getElementById('tableData').hidden=false;
            document.getElementById('tableHead').innerHTML=`
                <tr>
                    <th style="width:75px;" scope="col">No.</th>
                    <th scope="col">` + x + `</th>
                    <th scope="col">` + y + `</th>
                </tr>
            `;
            tableBody = document.getElementById('tableBody');
            tableBody.innerHTML = "";
            for (var i = 0; i < datas.length; i++) {
                tableBody.innerHTML += `
                    <tr>
                        <th style="width:75px;" scope="row">` + (i+1) + `</th>
                        <td>` + datas[i][0] + `</td>
                        <td>` + datas[i][1] + `</td>
                    </tr>
                `;
            }
            document.getElementById('uploadFile').value = "";
            document.getElementById('tombolnya').hidden = true;
        }

        function setNewHasil(hasils) {
        document.getElementById('tableHasil').hidden=false;
        tableBody = document.getElementById('tableBody2');
        tableBody.innerHTML = "";

        setNewHasilBody(tableBody, hasils['σxy'], 'Covariance');
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
</body>

</html>
