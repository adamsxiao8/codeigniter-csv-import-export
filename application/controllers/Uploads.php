<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Uploads extends SB_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        
        $this->load->model('Setting_model');
    }
    
    public function index()
    {
        $investor = $this->input->post('investor');
        $investors = $this->Setting_model->get_settings_value(SETTING_KEYWORD_INVESTORS);
        $investor = is_null($investor) ? $investors[0]['id'] : $investor;
        foreach ($investors as $ivt)
        {
            $arr_investors[$ivt['id']] = $ivt['value'];
        }
        
        $files = $this->_get_all_versions($investor);
        $this->display('uploads/index', array('investor'=>$investor, 'investors'=>$arr_investors, 'files'=>$files));
    }
    
    public function do_upload()
    {
        $investor_index = $this->input->post('investor');

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
            
            foreach ($files as $key=>$file)
            {
                if ($path = $this->_move_data_file($file, $key, $investor_index))
                {
                    //$setting = $this->_read_setting_file($path);
                    //$this->_save2db($setting);
                }
            }
            
        }
        
        redirect('uploads/');
    }
    
    private function _move_data_file($file, $sheet_number, $index)
    {
        $folder_path = DATAPATH . "\\" . date('ymd');
        
        if (!is_readable($folder_path))
        {
            mkdir($folder_path, 0777, true);
        }
        $index = sprintf('%03d', $index);
        $version = $this->_get_data_version($index);
        $src = $file;
        $dest = $folder_path . "\\" . $index . '-' . $version . "-$sheet_number".  ".csv";
        
        if (move($src, $dest))
        {
            return $dest;
        }
        
        return false;
    }
    
    private function _read_setting_file($file)
    {
        
    }
    
    private function _save2db($data)
    {
        
    }
    
    private function _get_data_version($index)
    {
        $indexes = array();
        $version = 0;
        $folder_path = DATAPATH . "\\" . date('ymd');
        if (is_dir($folder_path))
        {
            $dh  = opendir($folder_path);
            while (false !== ($filename = readdir($dh))) {
                $pattern = "/($index-)([0-9])(\\.csv)/";
                $replacement = '${2}';
                if (preg_match($pattern, $filename))
                {
                    $indexes[] = preg_replace($pattern, $replacement, $filename);
                }
            }
        }
        if (count($indexes) > 0)
        {
            $version = max($indexes);
        }
        $version++;
        return $version;
        
    }
    
    private function _get_all_versions($index)
    {
        $files = array();
        $version = 0;
        $folder_path = DATAPATH . "\\" . date('ymd');
        if (is_dir($folder_path))
        {
            $dh  = opendir($folder_path);
            while (false !== ($filename = readdir($dh))) {
                $pattern = "/($index-)([0-9])(\.csv)/";
                $replacement = '${2}';
                //if (preg_match($pattern, $filename))
                if ($filename != '.' && $filename != '..')
                {
                    $files[] = $filename;
                }
            }
        }

        return $files;
        
    }
}