<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('convert2csv'))
{
    /**
     * *.xls, *.xlsx file convert to csv file
     *
     * @param    array: returned value from uploaded file
     * @return   array: files to converted sheets
     */
    function convert2csv($file)
    {
        $result = array();
        
        $params = " -jar ";
        $filePath = '"'.$file['upload_data']['full_path'].'"';
        
        if ($file['upload_data']['file_ext'] == '.csv') 
        {
            $result[] = $file['upload_data']['full_path'];
        }
        else
        {
            if ($file['upload_data']['file_ext'] == '.xls') 
            {
                $command = JREPATH . $params . EXE_XLS2CSV . " " . $filePath;
                //exec($cmd = "/home2/sprinhf4/jre1.7.0_80/bin/java -Djava.awt.headless=true -XX:MaxHeapSize=512m -jar /home2/sprinhf4/xls2csv.jar $filePath", $output, $var ); // dev 
                exec($command, $output, $var );   // server
            } 
            elseif ($file['upload_data']['file_ext'] == '.xlsx') 
            {
                $command = JREPATH . $params . EXE_XLSX2CSV . " " . $filePath;
                //exec($cmd = "/home2/sprinhf4/jre1.7.0_80/bin/java -Djava.awt.headless=true -XX:MaxHeapSize=512m -jar /home2/sprinhf4/xlsx2csv.jar $filePath", $output, $var); // dev
                exec($command, $output, $var);   // server

            } 
            
            $i = 0;
            while (is_readable($file['upload_data']['full_path']."-sheet$i.csv"))
            {
                if (is_empty_csv($file['upload_data']['full_path']."-sheet$i.csv"))
                {
                    $result[] = $file['upload_data']['full_path']."-sheet$i.csv";
                }
                $i++;
            }
        }
        
        return $result;
    }
    
    
}
if ( ! function_exists('is_empty_csv'))
{
    function is_empty_csv($file)
    {
        $csv = new parseCSV();
        $csv->auto($file);
        $data = $csv->data;
        
        if (count($data)>0)
        {
            return true;
        }
        else
        {
            unlink($file);
            return false;
        }

    }
}