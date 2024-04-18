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

        <div class="table-responsive">
            <table class="table" id="table" data-toggle="table">
                <thead>
                    <tr>
                        <th scope="col" data-sortable="true">ASN</th>
                        <th scope="col" data-sortable="true">OrgID</th>
                        <th scope="col" data-sortable="true">Name</th>
                        <th scope="col" data-sortable="true">Status</th>
                        <th scope="col" data-sortable="true">ASN Date</th>
                        <th scope="col" data-sortable="true">Org Date</th>
                        <th scope="col" data-sortable="true">City</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- TODO -->
                    <!-- ADD HREF TO ASN (bgp.tools, arin api) -->

                    <?php for ($i = 0; $i < count($asns); $i++) { ?>
                        <tr>
                            <th scope="row"><a href="https://bgp.tools/as/<?php echo $asns[$i]['asn'] ?>" target="_blank"><?php echo $asns[$i]['asn'] ?></a></th>
                            <td><a href="https://whois.arin.net/rest/org/<?php echo $asns[$i]['org_id'] ?>" target="_blank"><?php echo $asns[$i]['org_id'] ?></a></td>
                            <td><?php echo $asns[$i]['name'] ?></td>
                            <td>
                                <?php

                                if ($asns[$i]['status'] === 1) {
                                    echo ('<span class="badge text-bg-success">Active</span>');
                                } elseif ($asns[$i]['status'] === 0) {
                                    echo ('<span class="badge text-bg-danger">Inactive</span>');
                                } else {
                                    echo "";
                                }

                                ?>
                            </td>
                            <td><?php echo $asns[$i]['asn_date'] ?></td>
                            <td><?php echo $asns[$i]['org_date'] ?></td>
                            <td><?php echo $asns[$i]['city'] . ', ' . $asns[$i]['province'] ?></td>
                        </tr>

                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <br>

    <?php
    include_once "footer.php";
    ?>
</body>

</html>