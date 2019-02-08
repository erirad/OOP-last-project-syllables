<?php
class Syllables {
  private $result;
  private $print;

  function __construct($finalArr) {
    $this->getFinalStringWithNumbers($finalArr);
    $this->printFinalResult($this->result);
  }

  public function getResult(){
     return $this->print;
  }

  private function addEverySecondCharacterZero($arrOfArr)
  {
      $newArrOfArr = array();
      foreach($arrOfArr as $arr){
          $arrWithZero = array();
          foreach($arr as $key => $val){
              if(is_numeric($val) == true){
                  array_push($arrWithZero, $val);
              } else if(array_key_exists($key + 1, $arr) == true){
                  if(is_numeric($arr[$key + 1]) == true){
                      array_push($arrWithZero, $val);
                  } else if(is_numeric($val) == false) {
                      array_push($arrWithZero, $val, '0');
                  }
              } else if(is_numeric($val) == false) {
                  array_push($arrWithZero, $val, '0');
              }
          }
          array_push($newArrOfArr, $arrWithZero);
      }
      return $newArrOfArr;
  }

  private function setFirstCharZero($newArrOfArr)
  {
      foreach ($newArrOfArr as $key => $value){
          if(!is_numeric($newArrOfArr[$key][0])){
              array_unshift($newArrOfArr[$key],"0");
          }
      }
      return $newArrOfArr;
  }
  private function mergeAllToOneArray($newArrOfArr)
  {
      $countCharLenght = count($newArrOfArr[0]);
      $rezultatas = $newArrOfArr[0];
      foreach($newArrOfArr as $arr){
          for($i = 0; $i < $countCharLenght; $i++){
              if(array_key_exists($i, $rezultatas) == false)
                  $rezultatas[$i] = null;
              if(array_key_exists($i, $arr) == false)
                  $arr[$i] = null;
              if(is_numeric($rezultatas[$i]) == false && is_numeric($arr[$i]) == true)
                  $rezultatas[$i] = $arr[$i];
              if(is_numeric($rezultatas[$i]) == true && is_numeric($arr[$i]) == true && $rezultatas[$i] < $arr[$i])
                  $rezultatas[$i] = $arr[$i];
          }
      }
      return $rezultatas;
  }
  private function getFinalStringWithNumbers($finalArr) {
  //matrica
      $arrOfArr = array();
      foreach ($finalArr as $el){
          array_push($arrOfArr, preg_split('//', $el, -1, PREG_SPLIT_NO_EMPTY));
      }
      $newArrOfArr = $this->addEverySecondCharacterZero($arrOfArr);
      $newArrOfArr = $this->setFirstCharZero($newArrOfArr);
      $rezultatas = $this->mergeAllToOneArray($newArrOfArr);
      $this->result = $rezultatas;
  }

  private function printFinalResult($rezultatas)
  {
  // gauname rezultata, pasaliname nebereikalingus '0', atspausdiname kaip string
      $printResult = str_replace ( "0","", $rezultatas );
  //pakeicia nelyginius - "-", lyginius- ""
      foreach ($printResult as $key => $rez) {
          if(is_numeric($rez) && $rez % 2 != 0) {
              $printResult[$key] = "-";
          }
          if(is_numeric($rez) && $rez % 2 == 0) {
              $printResult[$key] = "";
          }
          if($printResult[0] == "-") {
              $printResult[$key] = "";
          }
      }
      $printResult = implode("", $printResult);
      $this->print = $printResult;
  }


}
