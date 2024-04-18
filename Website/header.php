<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BGPDB - Hive Data Center</title>
    <link rel="icon" href="static/images/cropped-hive-favicon-32x32.png" sizes="32x32">
    <link rel="icon" href="static/images/cropped-hive-favicon-32x32.png" sizes="192x192">
    <link rel="stylesheet" type="text/css" href="static/stylesheet.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.22.4/dist/bootstrap-table.min.css">
</head>

<body>

    <div class="bg-dark sticky-top">

        <div class="container">

            <nav class="navbar navbar-expand-lg bg-dark text-white">
                <div class="container-fluid">
                    <a href="/BGPDB" class="navbar-brand text-white">
                        <img width="200" height="100" src="static/images/hive-logo-white.svg" class="attachment-full size-full wp-image-425 astra-logo-svg" alt="hive logo">
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="" role="button"><i class="fa fa-bars" aria-hidden="true" style="color:#e6e6ff"></i></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a href="/BGPDB" class="nav-link active text-white" id="navText">
                                    Home
                                </a>
                            </li>
                            <li class="nav-item">
                                <div class="dropdown">
                                    <a href="#" id="navText" class="dropdown-toggle text-white nav-link" id="dropdownNavLink" data-bs-toggle="dropdown" aria-expanded="false">
                                        Lists
                                    </a>
                                    <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownNavLink">
                                        <li><a class="dropdown-item" href="asnList.php">All ASNs</a></li>
                                        <li><a class="dropdown-item" href="asnList.php?province=BC">British Columbia</a></li>
                                        <li><a class="dropdown-item" href="asnList.php?province=AB">Alberta</a></li>
                                        <li><a class="dropdown-item" href="asnList.php?province=SK">Saskatchewan</a></li>
                                        <li><a class="dropdown-item" href="asnList.php?province=MB">Manitoba</a></li>
                                        <li><a class="dropdown-item" href="asnList.php?province=ON">Ontario</a></li>
                                        <li><a class="dropdown-item" href="asnList.php?province=QC">Quebec</a></li>
                                        <li><a class="dropdown-item" href="asnList.php?province=NL">Newfoundland and Labrador</a></li>
                                        <li><a class="dropdown-item" href="asnList.php?province=NB">New Brunswick</a></li>
                                        <li><a class="dropdown-item" href="asnList.php?province=PE">Prince Edward Island</a></li>
                                        <li><a class="dropdown-item" href="asnList.php?province=NS">Nova Scotia</a></li>
                                        <li><a class="dropdown-item" href="asnList.php?province=YT">Yukon</a></li>
                                        <li><a class="dropdown-item" href="asnList.php?province=NT">Northwest Territories</a></li>
                                        <li><a class="dropdown-item" href="asnList.php?province=NU">Nunavut</a></li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                        <div class="" id="navText">
                            Your IP: <?php echo $_SERVER['HTTP_CF_CONNECTING_IP']; ?>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <script src="static/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/bootstrap-table@1.22.4/dist/bootstrap-table.min.js"></script>
</body>

</html>