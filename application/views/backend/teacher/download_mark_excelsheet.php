<?php 

$this->load->library('Excel');
$objPHPExcel = new PHPExcel();
for ($col = 'A'; $col != 'J'; $col++) {
       $objPHPExcel->getActiveSheet()->getColumnDimension($col)->setAutoSize(true);}
                $objPHPExcel->getProperties()->setCreator("HOO")
                                                        ->setLastModifiedBy("HOO")
                                                        ->setTitle("Jobs History")
                                                        ->setSubject("PHPExcel Test Document")
                                                        ->setDescription("Test document for PHPExcel, generated using PHP classes.")
                                                        ->setKeywords("office PHPExcel php")
                                                        ->setCategory("Test result file");
				$exam=$this->db->get_where('exam',array('class_id'=>$class_id))->row();	
				
				
                $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:Z1');
                $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Student Mark Sheet');
				$objPHPExcel->getActiveSheet()->setCellValue('A2', 'Year');
				$objPHPExcel->getActiveSheet()->setCellValue('A3', 'Exam');
				$objPHPExcel->getActiveSheet()->setCellValue('A4', 'Class');
				$objPHPExcel->getActiveSheet()->setCellValue('B2', '2016');
				$objPHPExcel->getActiveSheet()->setCellValue('B3', $exam->name);
				$objPHPExcel->getActiveSheet()->setCellValue('B4', $class_id);
                $objPHPExcel->getActiveSheet()->getStyle("A1")->getFont()->setBold(true);
				$objPHPExcel->getActiveSheet()->getStyle("A2")->getFont()->setBold(true);
				$objPHPExcel->getActiveSheet()->getStyle("A3")->getFont()->setBold(true);
				$objPHPExcel->getActiveSheet()->getStyle("A4")->getFont()->setBold(true);

                $objPHPExcel->getActiveSheet()->getStyle('A5:A5')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
                $objPHPExcel->getActiveSheet()->getStyle('A5:A5')->getFill()->getStartColor()->setARGB('29bb04');
                // Add some data
                $objPHPExcel->getActiveSheet()->getStyle("A5:A5")->getFont()->setBold(true);
                $objPHPExcel->getActiveSheet()->getStyle('A5:A5')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);


                //echo date('H:i:s') , " Add some data" , EOL;
                $objPHPExcel->setActiveSheetIndex(0)
                            ->setCellValue('A5','Name');
                           
				$subject=$this->db->get_where('subject',array('class_id'=>$class_id));
				$alphabet='B';
				foreach($subject->result() AS $row)
				{
					$objPHPExcel->getActiveSheet()->getStyle('B5:'.$alphabet.'5')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
				$objPHPExcel->getActiveSheet()->getStyle('B5:'.$alphabet.'5')->getFill()->getStartColor()->setARGB('29bb04');
					$objPHPExcel->getActiveSheet()->getStyle('B5:'.$alphabet.'5')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
				$objPHPExcel->getActiveSheet()->getStyle('B5:'.$alphabet.'5')->getFont()->setBold(true);
					 $objPHPExcel->setActiveSheetIndex(0)	
                				 ->setCellValue($alphabet.'5', $row->name);
					$alphabet++;			 
				}
                $objPHPExcel->getActiveSheet()->getRowDimension(1)->setRowHeight(-1);
                $i =6;
				
				$details=$this->db->get_where('student',array('class_id'=>$class_id,'std_status'=>0));
			    foreach($details->result() AS $item)
                {
                    $objPHPExcel->getActiveSheet()->getStyle('A'.$i.'')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    $objPHPExcel->setActiveSheetIndex(0)
                            ->setCellValue('A'.$i, $item->name." ".$item->father_name);
                           
                    $i++;
                }
ob_end_clean();
$finalFileName=date("Y")."_".$this->session->userdata('name')."_class".$class_id;
header('Content-type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="'.$finalFileName.'.xls"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
$data['uplaoded_file_name'] = $finalFileName.'.xls'; 
$mark_file_exist=$this->db->get_where('mark',array('uplaoded_file_name'=>$data['uplaoded_file_name']))->row();
if(count($mark_file_exist)>0)
{}else{$this->db->insert('mark', $data);}



?>