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
				$exam=$this->db->get_where('exam',array('name'=>$exam_id))->row();	
				$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:Z1');
                $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Student Mark Sheet');
				$objPHPExcel->getActiveSheet()->setCellValue('A2', 'Year');
				$objPHPExcel->getActiveSheet()->setCellValue('A3', 'Exam ID');
				$objPHPExcel->getActiveSheet()->setCellValue('A4', 'Exam Name');
				$objPHPExcel->getActiveSheet()->setCellValue('A5', 'Class');
				$objPHPExcel->getActiveSheet()->setCellValue('B2', $year_name);
				$objPHPExcel->getActiveSheet()->setCellValue('B3', $exam->exam_id);
				$objPHPExcel->getActiveSheet()->setCellValue('B4', $exam_id);
				$objPHPExcel->getActiveSheet()->setCellValue('B5', $class_id);
                $objPHPExcel->getActiveSheet()->getStyle("A1")->getFont()->setBold(true);
				$objPHPExcel->getActiveSheet()->getStyle("A2")->getFont()->setBold(true);
				$objPHPExcel->getActiveSheet()->getStyle("A3")->getFont()->setBold(true);
				$objPHPExcel->getActiveSheet()->getStyle("A4")->getFont()->setBold(true);
				$objPHPExcel->getActiveSheet()->getStyle("A5")->getFont()->setBold(true);
				$objPHPExcel->getActiveSheet()->getStyle("A1")->getFont()->setSize(16);

                $objPHPExcel->getActiveSheet()->getStyle('A6:A6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
				$objPHPExcel->getActiveSheet()->getStyle('B6:B6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
				$objPHPExcel->getActiveSheet()->getStyle('C6:C6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
                $objPHPExcel->getActiveSheet()->getStyle('A6:A6')->getFill()->getStartColor()->setARGB('#FFFF99');
				$objPHPExcel->getActiveSheet()->getStyle('B6:B6')->getFill()->getStartColor()->setARGB('#FFFF99');
				$objPHPExcel->getActiveSheet()->getStyle('C6:C6')->getFill()->getStartColor()->setARGB('#FFFF99');
                // Add some data
                $objPHPExcel->getActiveSheet()->getStyle("A6:A6")->getFont()->setBold(true);
				$objPHPExcel->getActiveSheet()->getStyle("B6:B6")->getFont()->setBold(true);
				$objPHPExcel->getActiveSheet()->getStyle("C6:C6")->getFont()->setBold(true);
                $objPHPExcel->getActiveSheet()->getStyle('A6:A6')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
				$objPHPExcel->getActiveSheet()->getStyle('B6:B6')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
				$objPHPExcel->getActiveSheet()->getStyle('C6:C6')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

                $objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('A6','Student Id')
                            ->setCellValue('B6','Name')
							->setCellValue('C6','Roll No.');
                           
				$subject=$this->db->get_where('subject',array('class_id'=>intval($class_id))); 
				$refillup_mark=$this->db->get_where('mark',array('class_id'=>$class_id,'exam_id'=>$exam_id))->result();
				$alphabet='D';
				foreach($subject->result() AS $row){
					$objPHPExcel->getActiveSheet()->getStyle('D6:'.$alphabet.'6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
				$objPHPExcel->getActiveSheet()->getStyle('D6:'.$alphabet.'6')->getFill()->getStartColor()->setARGB('#FFFF99');
					$objPHPExcel->getActiveSheet()->getStyle('D6:'.$alphabet.'6')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
				$objPHPExcel->getActiveSheet()->getStyle('D6:'.$alphabet.'6')->getFont()->setBold(true);
					 $objPHPExcel->setActiveSheetIndex(0)	
                				 ->setCellValue($alphabet.'6', $row->name);
				$alphabet++;			 
				}
				$alphabet1='D';
				$count=7;
				$count1=6;
				$h=0;
				foreach($refillup_mark AS $refillup_mark_row){
					if($h%count($subject->result())==0){
						$alphabet2 = "D";
						$objPHPExcel->setActiveSheetIndex(0)	
                				 ->setCellValue($alphabet2.$count,$refillup_mark_row->mark_obtained);
						$alphabet2 ="E";
						$count1++;
						$count++;
					}else{
						$objPHPExcel->setActiveSheetIndex(0)	
                				 ->setCellValue($alphabet2.$count1,$refillup_mark_row->mark_obtained);
						$alphabet2++;
					}
					$h++;
					$alphabet1++;
				}
				$objPHPExcel->getActiveSheet()->getRowDimension(1)->setRowHeight(-1);
                $i =7;
						 $this->db->order_by('student_id','asc');	
				$details=$this->db->get_where('student',array('class_id'=>$class_id,'std_status'=>0));
			    foreach($details->result() AS $item)
                {
                    $objPHPExcel->getActiveSheet()->getStyle('A'.$i.'')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    $objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('A'.$i, $item->student_id)
                            ->setCellValue('B'.$i, $item->name)
							->setCellValue('C'.$i, $item->roll);
                    $i++;
                }
				//die;
ob_end_clean();
$finalFileName=$year_name."_".$this->session->userdata('name')."_class".$class_id."-".$exam_id."-".time();
header('Content-type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="'.$finalFileName.'.xls"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
$data['uplaoded_file_name'] = $finalFileName.'.xls'; 
$mark_file_exist=$this->db->get_where('mark',array('uplaoded_file_name'=>$data['uplaoded_file_name']))->row();
if(count($mark_file_exist)>0)
{}else{$this->db->where('year', 0);$this->db->delete('mark');$this->db->insert('mark', $data);}
?>