<?php

class CsvExport
{
    public static function ExportByReq($reqIn)
    {
      try 
      {
          $bdd = PdoHelper::getInstance();
          //on prepare la requete
          $req = $bdd->DataBase->prepare($reqIn);
          $req->execute();
      
          $rows = $req->fetchAll(PDO::FETCH_ASSOC);
          $columnNames = array();
          if(!empty($rows)){
              //We only need to loop through the first row of our result
              //in order to collate the column names.
              $firstRow = $rows[0];
              foreach($firstRow as $colName => $val){
                  $columnNames[] = $colName;
              }
          }
          
          //Setup the filename that our CSV will have when it is downloaded.
          $fileName = 'Export.csv';
          
          //Set the Content-Type and Content-Disposition headers to force the download.
          header('Content-Type: application/excel');
          header('Content-Disposition: attachment; filename="' . $fileName . '"');
          
          //Open up a file pointer
          $fp = fopen('php://output', 'w');
          
          //Start off by writing the column names to the file.
          fputcsv($fp, $columnNames, ";");
          
          //Then, loop through the rows and write them to the CSV file.
          foreach ($rows as $row) {
              fputcsv($fp, $row, ";");
          }
          
          //Close the file pointer.
          fclose($fp);

      } 
      catch(PDOException $e) 
      {
          echo 'ERROR: ' . $e->getMessage();
          return -1;
      }
      return 1;
    }     

}
?>