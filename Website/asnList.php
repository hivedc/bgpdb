<?php

include_once "header.php";

spl_autoload_register(function ($class) {
    include "model/{$class}.php";
});

$db = new DBManager();
?>

<!DOCTYPE html>
<html lang="en">

<head>

</head>

<body>

    <?php

    if (isset($_GET["province"])) {
        $asns = $db->GetAsnByProvince($_GET["province"]);
    } else {
        $asns = $db->getAllAsns();
    }

    $updateDate = $db->GetLastUpdateDate();

    ?>
    <br>
    <div class="container">
        <h5>Last Updated: <?php echo ($updateDate['UPDATE_TIME']); ?></h5>
        <!-- TODO -->
        <!-- MAKE UPDATE DATE DYNAMIC -->
        <div class="table-responsive">
            <table class="table" id="table">
                <thead>
                    <tr>
                        <th scope="col">ASN</th>
                        <th scope="col">OrgID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Status</th>
                        <th scope="col">ASN Date</th>
                        <th scope="col">Org Date</th>
                        <th scope="col">City</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- TODO -->
                    <!-- ADD HREF TO ASN (bgp.tools, arin api) -->

                    <?php for ($i = 0; $i < count($asns); $i++) { ?>
                        <tr>
                            <th scope="row"><?php echo $asns[$i]['asn'] ?></th>
                            <td><?php echo $asns[$i]['org_id'] ?></td>
                            <td><?php echo $asns[$i]['name'] ?></td>
                            <td><?php echo $asns[$i]['status'] ?></td>
                            <td><?php echo $asns[$i]['asn_date'] ?></td>
                            <td><?php echo $asns[$i]['org_date'] ?></td>
                            <td><?php echo $asns[$i]['city'] . ', ' . $asns[$i]['province'] ?></td>
                        </tr>

                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php
    include_once "footer.php";
    ?>
</body>

</html>