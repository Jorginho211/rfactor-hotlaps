<?php  
add_action( 'wp_ajax_get_hotlaps_json', 'get_data_json' );
add_action( 'wp_ajax_nopriv_get_hotlaps_json', 'get_data_json' );

function get_data($path){
    $hotlapsData = array();

    $str = file_get_contents($path);
    $hotlapsXml = simplexml_load_string(utf8_encode($str));

    $data = array();
    
    foreach ($hotlapsXml as $key => $category) {
        $data[] = array(
            'category' => (string) $category->{categoryName},
            'tracks' => array()
        );

        foreach($category->{listOfTrack} as $key2 => $track){
            $t = array(
                "name" => (string) $track->trackName,
                "drivers" => array()
            );

            $data[count($data) - 1]['tracks'][] = $t;
        
            foreach($track->{listOfLapRecord} as $key3 => $lapRecord){
                $driver = array(
                    'name' => (string) $lapRecord->{driverName},
                    'session' => (string) $lapRecord->{sessionName},
                    'pos' => intval((string) $lapRecord->attributes()->rank),
                    'lapCount' => intval((string) $lapRecord->attributes()->lapCount),
                    'lapTime' => floatval((string) $lapRecord->attributes()->lapTime)
                );

                $data[count($data) - 1]['tracks'][count($data[count($data) - 1]['tracks']) - 1]['drivers'][] = $driver;
            }

            usort($data[count($data) - 1]['tracks'][count($data[count($data) - 1]['tracks']) - 1]['drivers'], 'order_driver_by_pos');
        }
    }

    return $data;
}

function order_driver_by_pos($driverA, $driverB){
    return $driverA['pos'] > $driverB['pos'];
}

function get_data_json(){
    header('Content-Type: application/json');

    $path = plugin_dir_path( __FILE__ ).'hotlapsData.xml';
    if(isset($_GET['src'])){
        $path = $_GET['src'];
    }
    
    $json = get_data($path);

    $jsonString = json_encode($json);
    echo $jsonString;
    exit;
}
?>