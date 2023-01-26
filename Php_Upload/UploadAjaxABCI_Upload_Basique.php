<?php

session_start();

$filename = '../Upload-Temp/';
$temp_files_location = "../temp";

if (!empty($_POST['sousdossier'])) {
    $sousdossier = $_POST['sousdossier'];
    $IdCateg = $_POST['IdCateg'];
    if (!file_exists($filename . '/' .$sousdossier)) {
        mkdir($filename. '/' .$sousdossier, 0777, true);
    }
    
    $dir = $filename;
    $ignored = array('.', '..', $sousdossier);

    $files = array();
    foreach (scandir($dir) as $file) {
        if (in_array($file, $ignored)) continue;
        $files[$file] = filemtime($dir . '/' . $file);
    }

    arsort($files);
    $files = array_keys($files);

    $info = new SplFileInfo($files[0]);
    rename($filename . $files[0], $filename . $IdCateg . "." . $info->getExtension());

    $files = array();
    foreach (scandir($dir) as $file) {
        if (in_array($file, $ignored)) continue;
        $files[$file] = filemtime($dir . '/' . $file);
    }

    arsort($files);
    $files = array_keys($files);

    copy($filename . $files[0], $filename. '/' .$sousdossier. '/' .$files[0]);
    unlink($filename . $files[0]);
    
}

if (!empty($_POST['chunkMetadata'])) {
    // Gets chunk details
    $metaDataObject = json_decode($_POST['chunkMetadata']);

    if (!file_exists($filename)) {
        mkdir($filename, 0777, true);
    }

    if (!file_exists($temp_files_location)) {
        mkdir($temp_files_location);
    }

    $temp_file_path = $temp_files_location . "/" .  $metaDataObject->FileGuid . ".temp";

    // Appends the chunk to the file
    $content = file_get_contents($_FILES['file']['tmp_name']);
    file_put_contents($temp_file_path, $content, FILE_APPEND);

    // Saves the file if all chunks are received
    if($metaDataObject->Index == ($metaDataObject->TotalCount - 1)) {
        $fichier = $metaDataObject->FileName;
        //Ensuite on retire tous les accents que l'utilisateur pourrait utiliser et qui pourraient être utilisés par des mots clés
        $fichier=str_replace("à","a",$fichier);
        $fichier=str_replace("â","a",$fichier);
        $fichier=str_replace("é","e",$fichier);
        $fichier=str_replace("è","e",$fichier);
        $fichier=str_replace("ê","e",$fichier);
        $fichier=str_replace("ë","e",$fichier);
        $fichier=str_replace("ì","i",$fichier);
        $fichier=str_replace("î","i",$fichier);
        $fichier=str_replace("ï","i",$fichier);
        $fichier=str_replace("ô","o",$fichier);
        $fichier=str_replace("ù","u",$fichier);
        $fichier=str_replace("û","u",$fichier);
        $fichier=str_replace("ç","c",$fichier);

        $target_file_path = $filename . "/" . $fichier;
        copy($temp_file_path, $target_file_path);
        unlink($temp_file_path);
    }

}
?>
