<?php
include_once "header.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>

    <br>
    <div class="container">
        <div class="jumbotron">
            <h1 class="display-4">Canadian BGP Database</h1>
            <p class="lead">A collection of all ASNs belonging to organizations in Canada</p>
            <hr class="my-4">
            <ul>
                <li><a href="asnList.php">All ASNs</a></li>
                <li><a href="asnList.php?province=BC">British Columbia</a></li>
                <li><a href="asnList.php?province=AB">Alberta</a></li>
                <li><a href="asnList.php?province=SK">Saskatchewan</a></li>
                <li><a href="asnList.php?province=MB">Manitoba</a></li>
                <li><a href="asnList.php?province=ON">Ontario</a></li>
                <li><a href="asnList.php?province=QC">Quebec</a></li>
                <li><a href="asnList.php?province=NL">Newfoundland and Labrador</a></li>
                <li><a href="asnList.php?province=NB">New Brunswick</a></li>
                <li><a href="asnList.php?province=PE">Prince Edward Island</a></li>
                <li><a href="asnList.php?province=NS">Nova Scotia</a></li>
                <li><a href="asnList.php?province=YT">Yukon</a></li>
                <li><a href="asnList.php?province=NT">Northwest Territories</a></li>
                <li><a href="asnList.php?province=NU">Nunavut</a></li>
            </ul>
        </div>
    </div>

    <?php
    include_once "footer.php";
    ?>

</body>

</html>