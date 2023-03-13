<?php

class MyClass
{
    public function add($a, $b)
    {
        return $a + $b;
    }
    function haveRequirement($string){
        $length = strlen($string);
        if($length >= 128 && $length <= 256){
            return true;
        }else{
            return false;
        }
    }
    function assemble_segments($fragments) {
      $segments = array();
      $depth = '';
      foreach ($fragments as $fragment) {
      print_r("executed\n");  
      $size = strlen($fragment);
      if ($size < 8) {
        continue;
      }
      // check the dept if thereis any one there
      // by the way by construction dept is laways less then 128 of we need to increment
      if(!empty($depth)){
       $depthLength = strlen($depth);
       print_r("the depth length ".$depthLength."\n");
       // the size of how wen need to substring the fragement 
       $shouldGetFromFragement = 256 - $depthLength;
       if(strlen($fragment) > $shouldGetFromFragement){
        $sub = substr($fragment , 0 , $shouldGetFromFragement);
        $rest = substr($fragment  , $shouldGetFromFragement);
        $fragment = $rest;
        print_r("push dept\n");  
        print_r($depth.$sub."\n");
        array_push($segments , $depth.$sub);
        $depth = '';
       }
       
      }
      if($this->haveRequirement($fragment)){
        print_r("push normal\n");  
        array_push($segments , $fragment);
      }else{
       if(strlen($fragment) < 128){
        print_r("dept\n");  
        $depth = $depth.$fragment;
       }
       if(strlen($fragment) > 256){
        $chuncks = str_split($fragment , 256);
        // check the last element in the chuncks
        $last = end($chuncks);
        if($this->haveRequirement($last)){
            print_r("push normal 2\n");  
            foreach ($chuncks as $chunk) {
                array_push($segments, $chunk);
            }
        }else{
            print_r("push normal 3\n");  
            $depth = array_pop($chuncks);
            foreach ($chuncks as $chunk) {
                array_push($segments, $chunk);
            }
        }
       }
      }
      


}
if(!empty($depth)){
  array_push($segments, $depth);
}

return $segments; 
    }
    function trimTo128to256($string) {
        $stringArray = array();
        while(strlen($string) > 256) {
          $stringArray[] = substr($string, 0, 256);
          $string = substr($string, 256);
        }
        if(strlen($string) > 128) {
          $stringArray[] = substr($string, 0, 128);
          $string = substr($string, 128);
        }
        if(strlen($string) > 0) {
          $stringArray[] = $string;
        }
        return $stringArray;
      }
      
}

