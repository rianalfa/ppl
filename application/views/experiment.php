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
                                    <h1 class="h3 mb-0 text-gray-800">Percobaan</h1>
                                </div>
                                <div class="col-md-12 mt-4" id="mainContainer">
                                    <div class="card">
                                        <h5>
                                            Eksperiment atau Percobaan adalah penghitungan di statistik yang bertujuan untuk mencoba metode yang ada di statistik.
											Pada Eksperiment ini akan ada Risk Ratio, Odds Ratio dan Likelihood Ratio. </h5>
                                            <h5>Risk Ratio adalah rasio probabilitas dari suatu hasil dalam kelompok terkena probabilitas suatu hasil dalam kelompok tidak terpapar. 
											Bersama-sama dengan perbedaan risiko dan rasio peluang, risiko relatif mengukur hubungan antara eksposur dan hasil.</h5>
											<h5>Odds Ratio adalah ukuran asosiasi paparan (faktor risiko) dengan kejadian penyakit; dihitung dari angka kejadian penyakit 
											pada kelompok berisiko (terpapar faktor risiko) dibanding angka kejadian penyakit pada kelompok yang tidak berisiko (tidak terpapar faktor risiko).</h5>
											<h5>Likelihood Ratio adalah salah satu uji yang berhubungan langsungdengan penduga maksimum likelihood, di mana model distribusi dari populasinyamengikuti model distribusi dengan pdf tertentu.
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
    </script>
    
    <?php $this->load->view('js/experiment.php'); ?>
</body>

</html>