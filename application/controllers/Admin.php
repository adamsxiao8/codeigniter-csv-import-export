<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends SB_Controller
{
    
    public function __construct()
    {

        parent::__construct();

        $this->load->model('Setting_model');

    }
    
    public function index()
    {
        $data = $this->Setting_model->get_rows();
        $this->display('admin/index', array('data'=>$data));
    }
    
    function do_download()
    {
        $data = array();
        $xls = $this->Setting_model->get_rows();
        $type = '';
        foreach ($xls as $row)
        {
            if ($type != $row['type'])
            {
                $tmp = array($row['type'], $row['tid'], $row['value']);
                $data[] = $tmp;
                $type = $row['type'];
            }
            else
            {
                $tmp = array('', $row['tid'], $row['value']);
                $data[] = $tmp;
            }
        }
        
        $objPHPExcel = new PHPExcel();

        // Set document properties
        $objPHPExcel->getProperties()->setTitle("Excel");

        $a_z = range('A', 'Z');
        // Add some data
        $i = 1;
        foreach ($data as $row)
        {
            $j = 0;
            foreach ($row as $cell)
            {
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue($a_z[$j++].$i, $cell);
            }
            $i++;
        }
        
        // Rename worksheet
        $objPHPExcel->getActiveSheet()->setTitle('Excel');


        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0);


        // Redirect output to a clientâ€™s web browser (Excel5)
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="generalSetting.xls"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
        header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header ('Pragma: public'); // HTTP/1.0

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
    }
    
    public function do_upload()
    {
        $config['upload_path'] = './temp/';
        $config['allowed_types'] = 'csv|xls|xlsx';
        $config['max_size']    = '100';
        $config['max_width']  = '1024';
        $config['max_height']  = '768';

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('settings'))
        {
            $error = array('error' => $this->upload->display_errors());

            $this->load->view('upload_form', $error);
        }
        else
        {
            $data = array('upload_data' => $this->upload->data());
            $files = convert2csv($data);
            $setting = $this->_read_setting_file($files[0]);
            unlink($data['upload_data']['full_path']);
            foreach ($files as $file)
            {
                unlink($file);
            }
            $this->_save2db($setting);
            redirect('admin/index');
        }
    }
    
    private function _read_setting_file($file)
    {
        $csv = new parseCSV();
        $csv->auto($file);
        $data = $csv->data;
        
        $result[] = array_keys($data[0]);
        foreach ($data as $row)
        {
            $result[] = array_values($row);
        }
        return $result;
    }
    
    private function _save2db($setting)
    {
        $result = array();
        
        if (is_array($setting))
        {
            $i = 0;
            while ($i < count($setting))
            {
                if (trim($setting[$i][0]) == SETTING_KEYWORD_INVESTORS)
                {
                    $investor = array('id'=>$setting[$i][1], 'value'=>$setting[$i][2]);
                    $result[SETTING_KEYWORD_INVESTORS][] = $investor;
                    while (trim($setting[++$i][0]) == "")
                    {
                        if (isset($setting[$i][1]) && trim($setting[$i][1])!='' && $setting[$i][2]!='')
                        {
                            $investor = array('id'=>$setting[$i][1], 'value'=>$setting[$i][2]);
                            $result[SETTING_KEYWORD_INVESTORS][] = $investor;
                        }
                        if ($i >= (count($setting)-1))   break;
                    }
                }
                if (trim($setting[$i][0]) == SETTING_KEYWORD_LOANPRODUCTS)
                {
                    $investor = array('id'=>$setting[$i][1], 'value'=>$setting[$i][2]);
                    $result[SETTING_KEYWORD_LOANPRODUCTS][] = $investor;
                    while (trim($setting[++$i][0]) == "")
                    {
                        if (isset($setting[$i][1]) && trim($setting[$i][1])!='' && $setting[$i][2]!='')
                        {
                            $investor = array('id'=>$setting[$i][1], 'value'=>$setting[$i][2]);
                            $result[SETTING_KEYWORD_LOANPRODUCTS][] = $investor;
                        }
                        if ($i >= (count($setting)-1))   break;
                    }
                }
                if (trim($setting[$i][0]) == SETTING_KEYWORD_LOCKDAYS)
                {
                    $investor = array('id'=>$setting[$i][1], 'value'=>$setting[$i][2]);
                    $result[SETTING_KEYWORD_LOCKDAYS][] = $investor;
                    while (trim($setting[++$i][0]) == "")
                    {
                        if (isset($setting[$i][1]) && trim($setting[$i][1])!='' && $setting[$i][2]!='')
                        {
                            $investor = array('id'=>$setting[$i][1], 'value'=>$setting[$i][2]);
                            $result[SETTING_KEYWORD_LOCKDAYS][] = $investor;
                        }
                        if ($i >= (count($setting)-1))   break;
                    }
                }
                if (trim($setting[$i][0]) == SETTING_KEYWORD_DATEFORMAT)
                {
                    $investor = array('id'=>$setting[$i][1], 'value'=>$setting[$i][2]);
                    $result[SETTING_KEYWORD_DATEFORMAT][] = $investor;
                    while (trim($setting[++$i][0]) == "")
                    {
                        if (isset($setting[$i][1]) && trim($setting[$i][1])!='' && $setting[$i][2]!='')
                        {
                            $investor = array('id'=>$setting[$i][1], 'value'=>$setting[$i][2]);
                            $result[SETTING_KEYWORD_DATEFORMAT][] = $investor;
                        }
                        if ($i >= (count($setting)-1))   break;
                    }
                }
                if (trim($setting[$i][0]) == SETTING_KEYWORD_TIMEFORMAT)
                {
                    $investor = array('id'=>$setting[$i][1], 'value'=>$setting[$i][2]);
                    $result[SETTING_KEYWORD_TIMEFORMAT][] = $investor;
                    while (isset($setting[$i]) && (trim($setting[++$i][0]) == ""))
                    {
                        if (isset($setting[$i][1]) && trim($setting[$i][1])!='' && $setting[$i][2]!='')
                        {
                            $investor = array('id'=>$setting[$i][1], 'value'=>$setting[$i][2]);
                            $result[SETTING_KEYWORD_TIMEFORMAT][] = $investor;
                        }
                        if ($i >= (count($setting)-1))   break;
                    }
                }
                
                $i++;
            }
        }
        
        $this->Setting_model->flush_update($result);
    }
}