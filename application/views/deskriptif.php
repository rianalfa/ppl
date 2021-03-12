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
            <div id="content" style="height: 700px;">
                <div class="container-fluid p-0 px-lg-0 px-md-0">

                    <!-- Navbar -->
                    <?php $this->load->view('_partials/navbar'); ?>

                    <!-- Begin Page Content -->
                    <div class="container-fluid px-lg-4">
                        <div class="row">
                            <div class="col-md-12 mt-lg-4 mt-4">
                                <!-- Page Heading -->
                                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                    <h1 class="h3 mb-0 text-gray-800">Statistik Deskriptif</h1>
                                </div>
                                <div class="col-md-12 mt-4" id="mainContainer">
                                    <div class="card">
                                        <h5>
                                            Statistik deskriptif adalah salah satu bagian dari ilmu statistika yang berhubungan dengan aktivitas 
                                            penghimpunan, penataan, peringkasan dan penyajian data dengan harapan agar data lebih bermakna, 
                                            mudah dibaca dan mudah dipahami oleh pengguna data. Statistik deskriptif hanya sebatas memberikan 
                                            deskripsi atau gambaran umum tentang karakteristik objek yang diteliti tanpa maksud untuk melakukan 
                                            generalisasi sampel terhadap populasi.
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
    
    <?php $this->load->view('js/deskriptif.php'); ?>
</body>

</html>