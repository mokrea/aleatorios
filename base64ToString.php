<?php
$handle = fopen("file.php", "r");
$handle2 = fopen("output.php","w+");
if ($handle) {
    while (($line = fgets($handle)) !== false) {
        $pos = strpos($line,"base64");
        if($pos != false) {
                preg_match_all('/base64_decode\((.*?)\)/',substr($line,3),$matches);
                $target = $matches[1];
                for($i=0;$i<count($matches[1]);$i++) {
                        $aux = str_replace('"','',$target[$i]);
                        $aux2 = base64_decode($aux);
                        $line = str_replace($matches[0][$i],$aux2,$line);
                }
        }
        fwrite($handle2,$line);
    }
    fclose($handle);
    fclose($handle2);
} else {
        echo "Can't open file.\n";
}
?>
