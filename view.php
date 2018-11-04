<?php
    foreach ($data as $key => $category) {
        foreach (array_reverse($category['tracks']) as $key2 => $track) {
            ?>
            <h4><?php echo $track['name']?></h4>
            <table class="rfactor-hotlaps-table">
                <thead class="rfactor-hotlaps-header">
                    <th class="rfactor-hotlaps-th-1">Pos</th>
                    <th class="rfactor-hotlaps-th-2">Nombre</th>
                    <th class="rfactor-hotlaps-th-3">Tiempo</th>
                    <th class="rfactor-hotlaps-th-4">Vueltas</th>
                    <th class="rfactor-hotlaps-th-5">Sesión</th>
                </thead>
                <tbody class="rfactor-hotlaps-body">
                    <?php   
                        foreach($track['drivers'] as $key3 => $driver){
                            $minutes = floor($driver['lapTime']/60);
                            $seconds = floor($driver['lapTime'] - $minutes * 60);
                            $seconds = $seconds < 10 ? "0".$seconds : $seconds;
                            $miliseconds = floor(($driver['lapTime'] - (floor($driver['lapTime']))) * 1000);
                            $time = $minutes.":".$seconds.".".$miliseconds;
                            
                            ?>
                                <tr class="rfactor-hotlaps-tr-<?php echo $key3 + 1 ?>">
                                    <td class="rfactor-hotlaps-th-1"><?php echo $driver['pos'] ?></td>
                                    <td class="rfactor-hotlaps-th-2"><?php echo $driver['name'] ?></td>
                                    <td class="rfactor-hotlaps-th-3"><?php echo $time ?></td>
                                    <td class="rfactor-hotlaps-th-4"><?php echo $driver['lapCount'] ?></td>
                                    <td class="rfactor-hotlaps-th-5"><?php echo $driver['session'] ?></td>
                                </tr>
                            <?php
                        }
                    ?>
                </tbody>
            </table>
            <?php
        }
    }
?>

    