<h2 class="text-center">Kodutöö- sirvi, muuda või kustuta</h2>
<?php
// Lisame siia leheküljendamise
include 'hw_paginate.php';
// sql lause, päring ja if lause
$sql = 'SELECT * FROM simple ORDER BY added DESC LIMIT '.$start.', '.$maxPerPage;
$res = $database->dbGetArray($sql);
if($res !==false) {
   // $database->show($res);

?>

<table class="table table-hover table-bordered">
    <thead>
        <tr class="text-center">
            <th>Jrk</th>
            <th>Nimi</th>
            <th>Sünniaeg</th>
            <th>Palk</th>
            <th>Pikkus</th>
            <th>Lisatud</th>
            <th>Tegevus</th>
        </tr>
    </thead>
    <tbody>
        
        <?php
        // Calculate the starting sequence number for the current page
                                $startSequence = ($pg - 1) * $maxPerPage + 1;
                                // foreach-loop algus 
                                foreach($res as $key=>$val) { 
                                    $date = new DateTime(($val['birth']));
                                    $birth = $date->format("d.m.Y");
                                    $dateTime = new DateTime($val['added']);
                                    $added = $dateTime->format("d.m.Y H:i:s");                          
                                ?>
                                    <tr>
                                    <td class="text-end"><?php echo $startSequence++; ?>.</td>
                                        <td><?php echo $val['name']; ?></td>
                                        <td><?php echo $birth; ?></td>
                                        <td class="text-end"><?php echo $val['salary']; ?></td>
                                        <td class="text-end"><?php echo $val['height']; ?></td>
                                        <td><?php echo $added; ?></td>
                                        <td class="text-center">
                                        <a href="<?php echo $_SERVER['PHP_SELF']; ?>?page=hw_update-by-id&ids=<?php echo $val['id']; ?>"><i class="fa-solid fa-pen-to-square text-warning" title="Edit"></i></a>
                                            <a href="?page=hw_delete&ids=<?php echo $val['id'];?>" onclick="if (confirm('Kas oled kindel?')) { return true; } else { return false; }">
                                                <i class="fa-solid fa-trash-can text-danger" title="Delete"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php
                                // foreach-loop lõpp
                                }
        ?>
    </tbody>
</table>
<?php
} else {
?> 
<div class="alert alert-danger">Sobivaid kirjeid ei leitud</div>
<?php
}
?>