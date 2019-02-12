<?php
namespace app;

class Syllables
{
    private $result;

    private function addEverySecondCharacterZero($arrOfArr)
    {
        $newArrOfArr = [];
        foreach ($arrOfArr as $arr) {
            $arrWithZero = [];
            foreach ($arr as $key => $val) {
                if (is_numeric($val) == true) {
                    $arrWithZero[] = $val;
                } elseif (array_key_exists($key + 1, $arr) == true) {
                    if (is_numeric($arr[$key + 1]) == true) {
                        $arrWithZero[] = $val;
                    } elseif (is_numeric($val) == false) {
                        array_push($arrWithZero, $val, '0');
                    }
                    elseif (is_numeric($val) == false) {
                        array_push($arrWithZero, $val, '0');
                    }
                } elseif (is_numeric($val) == false) {
                    if(!preg_match('/^[a-zA-Z0-9]+$/', $val)){
                        array_push($arrWithZero, $val);
                    } else {
                        array_push($arrWithZero, $val, '0');
                    }
                }

            }
            $newArrOfArr[] = $arrWithZero;
        }
        return $newArrOfArr;
    }

    private function setFirstCharZero($newArrOfArr)
    {
        foreach ($newArrOfArr as $key => $value) {
            if (!is_numeric($newArrOfArr[$key][0])) {
                array_unshift($newArrOfArr[$key], "0");
            }
        }
        return $newArrOfArr;
    }

    private function mergeAllToOneArray($newArrOfArr)
    {
        $countCharLenght = count($newArrOfArr[0]);
        $rezultatas = $newArrOfArr[0];
        foreach ($newArrOfArr as $arr) {
            for ($i = 0; $i < $countCharLenght; $i++) {
                if (array_key_exists($i, $rezultatas) == false)
                    $rezultatas[$i] = null;
                if (array_key_exists($i, $arr) == false)
                    $arr[$i] = null;
                if (is_numeric($rezultatas[$i]) == false && is_numeric($arr[$i]) == true)
                    $rezultatas[$i] = $arr[$i];
                if (is_numeric($rezultatas[$i]) == true && is_numeric($arr[$i]) == true && $rezultatas[$i] < $arr[$i])
                    $rezultatas[$i] = $arr[$i];
            }
        }
        return $rezultatas;
    }

    public function getFinalStringWithNumbers($finalArr)
    {

        $arrOfArr = array();
        foreach ($finalArr as $el) {
            array_push($arrOfArr, preg_split('//', $el, -1, PREG_SPLIT_NO_EMPTY));
        }
        $newArrOfArr = $this->addEverySecondCharacterZero($arrOfArr);
        $newArrOfArr = $this->setFirstCharZero($newArrOfArr);
        $rezultatas = $this->mergeAllToOneArray($newArrOfArr);
        $this->result = $rezultatas;
    }

    public function printFinalResult()
    {
        // gauname rezultata, pasaliname nebereikalingus '0', atspausdiname kaip string
        $printResult = preg_replace("/0/", "", $this->result);
        //pakeicia nelyginius - "-", lyginius- ""
        foreach ($printResult as $key => $rez) {
            if (is_numeric($rez) && $rez % 2 != 0) {
                $printResult[$key] = "-";
            }
            if (is_numeric($rez) && $rez % 2 == 0) {
                $printResult[$key] = "";
            }
            if ($printResult[0] == "-" || $printResult[count($printResult)-1] == "-") {
                $printResult[$key] = "";
            }
        }
        $printResult = implode("", $printResult);
        echo $printResult . " ";
    }
}
?>