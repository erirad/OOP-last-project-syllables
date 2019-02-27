<?php
namespace App\Lib;

class Match
{
    public function getPatterns($inputWithDots, $patternTree)
    {
        $length = strlen($inputWithDots);
        $matches = [];
        for($i=0; $i<$length-2; $i++){
            if(isset($patternTree[$inputWithDots[$i]][$inputWithDots[$i+1]][$inputWithDots[$i+2]]) != false){
                foreach ($patternTree[$inputWithDots[$i]][$inputWithDots[$i+1]][$inputWithDots[$i+2]] as $pattern) {
                    $match =  $this->chechPattern($inputWithDots, $pattern);
                    if($match){
                        $matches[] = $match;
                    }
                }
            }
            if(!empty($patternTree[$inputWithDots[$i]][$inputWithDots[$i+1]][0]) != false){
                foreach ($patternTree[$inputWithDots[$i]][$inputWithDots[$i+1]][0] as $pattern) {
                    $match = $this->chechPattern($inputWithDots, $pattern);
                    if($match){
                        $matches[] = $match;
                    }
                }
            }
        }
        return $matches;
    }

    private function chechPattern($input, $pattern)
    {
        $patternWithoutNumbers = preg_replace('/[0-9]+/', '', $pattern);
        $match = strpos($input, $patternWithoutNumbers);
        if (is_numeric($match)) {
            return $pattern;
        }
    }
}

























//$matches = [];
//foreach ($wordArr as $first => $item) {
//    foreach ($item as $second => $value){
//        if(array_key_exists($second, $patternTree[$first])) {
//            foreach ($patternTree[$first][$second] as $pattern){
//                $patternWithoutNumbers = preg_replace('/[0-9]+/', '', $pattern);
//                $match = strpos($inputWithDots, $patternWithoutNumbers);
//                if (is_numeric($match)) {
//                    $matches[] = $pattern;
//                }
//            }
//        }
//    }
//}
//return $matches;


















//<?php
//namespace App\Helper;
//
//use App\Helper\PatternsTree;
//
//class Match
//{
//    public function getPatterns($inputWithDots, $patternTree)
//    {
//        $sortedByTwoArr = $patternTree;
//        $wordArr = [];
//        $lenght = strlen($inputWithDots);
//        for($i=0; $i<$lenght-2; $i++){
//            $char = $inputWithDots[$i];
//            $secondChar = $inputWithDots[$i+1];
//            if($inputWithDots[$i+2]) {
//                $thirdChar = $inputWithDots[$i + 2];
//                $wordArr[$char][$secondChar][$thirdChar] = $char . $secondChar . $thirdChar;
//            } else {
//                $wordArr[$char][$secondChar] = $char . $secondChar;
//            }
//        }
//
//
//        $matches = [];
//        foreach ($wordArr as $first => $item) {
//            foreach ($item as $second => $item2){
//                if(array_key_exists("default", $sortedByTwoArr[$first][$second])) {
//                    foreach ($sortedByTwoArr[$first][$second]["default"] as $pattern) {
//                        $matches[] = $pattern;
//                    }
//                }
//                foreach ($item2 as $third => $value)
//                    if(array_key_exists($third, $sortedByTwoArr[$first][$second])) {
//                        foreach ($sortedByTwoArr[$first][$second][$third] as $pattern){
//                            $patternWithoutNumbers = preg_replace('/[0-9]+/', '', $pattern);
//                            $match = strpos($inputWithDots, $patternWithoutNumbers);
//                            if (is_numeric($match)) {
//                                $matches[] = $pattern;
//                            }
//                        }
//                    }
//            }
//        }
//
//        return $matches;
//    }
//}





