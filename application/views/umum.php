<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href=" <?= base_url("css/style.css") ?> ">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans&display=swap" rel="stylesheet">
    <link href="/your-path-to-fontawesome/css/all.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <title>Kalkulator Statistik</title>
</head>

<body>
    <!-- Welcome Section  -->
    <section id="welcome">
        <div class="welcome container">
            <div>
                <h1>Kalkulator<span></span></h1>
                <h1>Statistik <span></span></h1>
                <h1>Portable <span></span></h1>
                <a href="#calculator" type="button" class="cta">Mulai</a>
            </div>
        </div>
    </section>
    <!-- End welcome Section  -->

    <!-- Calculator section -->
    <section id="calculator">
        <input type="checkbox" id="check">
        <label for="check">
            <i class="fas fa-bars" id="btn"></i>
            <i class="fas fa-times" id="cancel"></i>
        </label>
        <div class="sidebar">
            <header>Kalkulator Statistik</header>
            <ul>
                <li><a href=" <?= base_url("calculator") ?> ">Calkulator</a></li>
                <li><a href="#">Statistik</a></li>
            </ul>
        </div>
    </section>
    <!-- End calculator section-->

</body>

</html>