<?php 
    class TsvReaderHelper extends AppHelper {
   		public function getViewTSV($filename) {
      //  $filename = time() . $this->data['TSV']['file']['name'];
      		$link = $_SERVER['DOCUMENT_ROOT']. 'tsv' . DS . $filename;
   		
   		// 	$link = WEBROOT_DIR . DS . 'tsv' . DS . $filename;
      	//	echo $link;

        $data_tsv = array();

        if (($handle = fopen($link, "r")) !== FALSE) {
            $row = 0;
            while (($data = fgetcsv($handle, 1000, "\t")) !== FALSE) {
                $num = count($data);
                for ($i = 0; $i < $num; $i++) {
                    $data[$i] = mb_convert_encoding($data[$i], 'utf-8');
                }
                //$review = $review."row $row:".$data[0][2]."<br/>";
                if ($data[0] != null && strcmp($data[0][0], '#') != 0 && ($row != 0 || strcmp($data[0][3], '#') != 0)) {
                    //print_r($data);
                    $data_tsv[] = $data;
                }
                $row++;
            }

            fclose($handle);
        }
        $review = '';
        $error = '';
        //echo $data_tsv[0][0][3];
        if ($data_tsv[0][0][3] != 'T' || !isset($data_tsv[0][1])) {
            $error = $error . "Thieu Test title";
        } else {
            $review = "<div name=\"TestTitle\">" . $data_tsv[0][1] . "</div>";

            $row = 1;
            $num = count($data_tsv);
            if ($data_tsv[1][0] == "TestSunTitle") {
                $review = $review . "<div name=\"TestSunTitle\">" . $data_tsv[1][1] . "</div>";
                $row++;
            }

            //$review = $review.$num;
            while ($row < $num) {
                $numberQuestion = substr($data_tsv[$row][0], 2, -1);
                if ($data_tsv[$row][0] == "End") {
                    break;
                } else {
                    if ($data_tsv[$row][1] != "QS") {


                        $error = "Thieu noi dung cau hoi $numberQuestion.";
                        break;
                    } else {

                        $questionID = $data_tsv[$row][0];
                        $review = $review . "<div class=\"question\">問題 " . $numberQuestion . ":" . $data_tsv[$row][2] . "</div>";
                        $review = $review . "<ol>";
                        $row++;

                        while ($row < $num && $data_tsv[$row][0] == $questionID && $data_tsv[$row][1][0] == 'S') {
                            $review = $review . "<li>";
                            $review = $review . $data_tsv[$row][2];
                            $review = $review . "</li>";
                            $row++;
                        }
                        $review = $review . "</ol>";

                        if ($data_tsv[$row][1] != "KS" || !isset($data_tsv[$row][2]) || !isset($data_tsv[$row][3])) {
                            $error = "Thieu ket qua cau hoi $numberQuestion.";
                            break;
                        } else {
                            $review = $review . "<div class=\"result\">結果：" . $data_tsv[$row][2][2] . "    " . $data_tsv[$row][3] . "点</div>";
                            $row++;
                        }
                    }
                }
            }
        }
        return $review;
    }

    private function getDataTSV($filename) {
        //$link = $_SERVER['DOCUMENT_ROOT'] . DS . 'elearning' . DS . WEBROOT_DIR . DS . 'tsv' . DS . $filename;
        $link = 	$link = $_SERVER['DOCUMENT_ROOT']. 'tsv' . DS . $filename;
        $data_tsv = array();

        if (($handle = fopen($link, "r")) !== FALSE) {
            $row = 0;
            while (($data = fgetcsv($handle, 1000, "\t")) !== FALSE) {
                $num = count($data);
                for ($i = 0; $i < $num; $i++) {
                    $data[$i] = mb_convert_encoding($data[$i], 'utf-8');
                }

                if ($data[0] != null && strcmp($data[0][0], '#') != 0 && ($row != 0 || strcmp($data[0][3], '#') != 0)) {
                    //print_r($data);
                    $data_tsv[] = $data;
                }
                $row++;
            }


            fclose($handle);
        } else {
            $this->Session->setFlash("Loi mo file!");
        }
        return $data_tsv;
    }


    public function getTest($filename) {
        $data = $this->getDataTSV($filename);
        $row = 1;
        $error = "";
        $num = count($data);
        $test = "";
        if ($data[1][0] == "TestSunTitle") {
            $test = $test."<h3 name=\"TestSunTitle\">" . $data[1][1] . "</h3>";
            $row++;
        }
        $sumQuestion = 0;
        $numberQuestion = 0;
        //$test = $test.$num;
        while ($row < $num) {

            $numberQuestion = substr($data[$row][0], 2, -1);
            if ($data[$row][0] == "End") {
                break;
            } else {
                $sumQuestion++;
                if ($data[$row][1] != "QS") {


                    $error = "Thieu noi dung cau hoi $numberQuestion.";
                    break;
                } else {

                    $questionID = $data[$row][0];
                    $test = $test."<h4 class=\"question\">問題 " . $numberQuestion . ":" . $data[$row][2] . "</h4>";
                    $row++;

                    while ($row < $num && $data[$row][0] == $questionID && $data[$row][1][0] == 'S') {
                        $test = $test."<div class=\"radio\"><label>";
                        $test = $test."<input type=\"radio\" name=\"question" . $numberQuestion . "\" id=\"optionsRadios" . $numberQuestion . "\" value=\"option" . $numberQuestion . "\"";
                        $test = $test."value=\"0\">";
                        $test = $test.$data[$row][2];
                        $test = $test."</label></div>";
                        $row++;
                    }

                    if ($data[$row][1] != "KS") {
                        $error = "Thieu ket qua cau hoi $numberQuestion.";
                        break;
                    } else {

                        $row++;
                    }
                }
            }
        }
        //$test = $test.$sumQuestion;
        if (strlen($error) != 0) {
            $test = $test.$error;
        }
        return $test;
    }
}
?>
