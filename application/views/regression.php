<!DOCTYPE html>
<html lang="en">

<?php $this->load->view('_partials/head'); ?>

<body>

<div id="wrapper">
        <div class="overlay"></div>

        <!-- Sidebar -->
        <?php $this->load->view('_partials/sidebar'); ?>

        <!-- Page Content -->
        <div id="page-content-wrapper">
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
                                    <h1 class="h3 mb-0 text-gray-800">Regresi</h1>
                                </div>
                                <div class="col-md-12 mt-4" id="mainContainer">
                                    <div class="card mb-2">
                                        <h5>
                                        Regresi adalah salah satu metode untuk menentukan hubungan sebab-akibat antara variabel dengan variabel lainnya. 
                                        Dalam analisis regresi sederhana, hubungan antara variabel bersifat linier, 
                                        di mana perubahan pada variabel X akan diikuti oleh perubahan pada variabel secara tetap. 
                                        Sedangkan dalam hubungan nonlinier, perubahan X tidak diikuti dengan perubahan variabel Y secara proporsional.
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

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script>
        $('#bar').click(function() {
            $(this).toggleClass('open');
            $('#page-content-wrapper ,#sidebar-wrapper').toggleClass('toggled');

        });

        function gettingStarted(){
            var main = document.getElementById('mainContainer');
            main.innerHTML = `
                <div class="card mb-2 w-50 rounded">
                    <label class="ml-3 mt-2" for="uploadFile">
                        Silahkan unggah file data yang akan dihitung.
                        <br>
                        (File berekstensi 'xlsx' atau 'xls')
                    </label>
                    <div class="d-flex justify-content-around">
                        <input type="file" class="form-control-file p-2 ml-1" id="uploadFile" name="uploadFile" value="" required/>
                        <button id="tombolnya" onclick="inputData();" class="btn btn-sm btn-secondary w-25 mr-2 mb-2" hidden>Input</button>
                    </div>
                </div>
                <table class="table table-light w-50 mt-2 rounded">
                    <thead id="tableHead">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">X</th>
                            <th scope="col">Y</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        <tr>
                            <th scope="row">1</th>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <th scope="row">4</th>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <th scope="row">5</th>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            `;

            filenya = document.getElementById('uploadFile');
            filenya.addEventListener('change', function(e) {
                if (filenya.value == "") {
                    document.getElementById("tombolnya").hidden=true;
                } else {
                    document.getElementById("tombolnya").hidden=false;
                }
            });
        }

        function inputData() {
            filenya = document.getElementById('uploadFile');
            var file = filenya.files[0];
            var datanya = new FormData();
            datanya.append("uploadFile", file);
            request = new XMLHttpRequest();
            request.open('POST', '<?= base_url('regressions/inputData') ?>', true);
            request.onreadystatechange = function() {
                if (request.readyState == 4 && request.status == 200){
                    if (request.getResponseHeader('Content-type').indexOf('json') > 0) {
                        datas = JSON.parse(request.responseText);
                        setNewData(datas);
                    } else {
                        alert("BABI");
                    }
                }
            }
            request.send(datanya);
        }

        function setNewData(datas){
            tableBody = document.getElementById('tableBody');
            tableBody.innerHTML="";
            i=0;
            for (var i=0; i<datas.length; i++) {
                tableBody.innerHTML+=`
                    <tr>
                        <th scope="row">`+i+`</th>
                        <td>`+datas[i][0]+`</td>
                        <td>`+datas[i][1]+`</td>
                    </tr>
                `;
            }
            document.getElementById('uploadFile').value="";
            document.getElementById('tombolnya').hidden=true;
        }
    </script>
</body>
</html>