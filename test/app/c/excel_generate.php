<?php

class excel_generate extends base {

	function __construct()
  	{
  		parent::__construct();
    	$this->m = load('m/admin_m');
  	}

  	function index(){
		/** Error reporting */
		error_reporting(E_ALL);

		/** Include path **/
		ini_set('include_path', ini_get('include_path').';../Classes/');

		/** PHPExcel */
		include dirname(dirname(__FILE__)).'/extension/Classes/PHPExcel.php';

		/** PHPExcel_Writer_Excel2007 */
		include dirname(dirname(__FILE__)).'/extension/Classes/PHPExcel/Writer/Excel2007.php';
		date_default_timezone_set('Europe/London');
		// Create new PHPExcel object
		//echo date('H:i:s') . " Create new PHPExcel object\n";
		$objPHPExcel = new PHPExcel();

		// Set properties
		//echo date('H:i:s') . " Set properties\n";
		$objPHPExcel->getProperties()->setCreator("2DX");
		$objPHPExcel->getProperties()->setLastModifiedBy("2DX");
		$objPHPExcel->getProperties()->setTitle("Office 2007 XLSX Test Document");
		$objPHPExcel->getProperties()->setSubject("Office 2007 XLSX Test Document");
		$objPHPExcel->getProperties()->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.");


		// Add some data
		//echo date('H:i:s') . " Add some data\n";
		//var_dump($this);exit;
		$data = $this->m->db->query('select * from '.strip_tags(seg(4)));

		$objPHPExcel->setActiveSheetIndex(0);
		$chars = range('A','N');
		foreach ($data as $keyRow => $row) {
			$i = 0;
			foreach ($row as $k => $v) {
				if($keyRow == 0){
					$objPHPExcel->getActiveSheet()->SetCellValue($chars[$i].($keyRow+1), $k);
				}
				$objPHPExcel->getActiveSheet()->SetCellValue($chars[$i].($keyRow+2), $v);
				++$i;
			}
			unset($i);
		}
		// $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Hello');
		// $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'world!');
		// $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Hello');
		// $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'world!');

		// Rename sheet
		//echo date('H:i:s') . " Rename sheet\n";
		$objPHPExcel->getActiveSheet()->setTitle('Simple');

				
		// Save Excel 2007 file
		//echo date('H:i:s') . " Write to Excel2007 format\n";
		$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
		$file_name = time().'.xls';
		$file_dir = dirname(dirname(dirname(__FILE__))).'/Other/';
		$objWriter->save(str_replace('.php', '.xlsx', $file_dir.$file_name) );

		$filename = $file_dir.$file_name; 
		$file = fopen($filename,"rb");

		 ob_end_clean();
         $hfile = fopen($filename,"rb") or die("Can not find file: $filename\n");
         header("export:");
         Header("Content-type: application/octet-stream");
         Header("Content-Transfer-Encoding: binary");
         Header("Accept-Ranges: bytes");
         Header("Content-Length: ".filesize($filename));
         Header("Content-Disposition: attachment; filename=\"$file_name\"");
         while (!feof($hfile)) {
            echo fread($hfile, 32768);
         }
         fclose($hfile);
		// 打开文件

		// $filename = $file_dir.$file_name;
		// header("Content-Type: application/force-download;");
		// header("Content-Disposition: attachment; filename=".basename($filename)); 
		// readfile($filename);

  	}

  	function exportexcel($data=array(),$title=array(),$filename='report'){
	    header("Content-type:application/octet-stream");
	    header("Accept-Ranges:bytes");
	    header("Content-type:application/vnd.ms-excel");  
	    header("Content-Disposition:attachment;filename=".$filename.".xls");
	    header("Pragma: no-cache");
	    header("Expires: 0");
	    //导出xls 开始
	    if (!empty($title)){
	        foreach ($title as $k => $v) {
	            $title[$k]=iconv("UTF-8", "GB2312",$v);
	        }
	        $title= implode("\t", $title);
	        echo "$title\n";
	    }
	    if (!empty($data)){
	        foreach($data as $key=>$val){
	            foreach ($val as $ck => $cv) {
	                $data[$key][$ck]=iconv("UTF-8", "GB2312", $cv);
	            }
	            $data[$key]=implode("\t", $data[$key]);
	            
	        }
	        echo implode("\n",$data);
	    }
 }



}