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
      $segments = [];
      $depth = '';
      
      foreach ($fragments as $fragment) {
          if (strlen($fragment) < 8) {
              continue;
          }
          
          // Check if there is any depth
          // By construction, depth is always less than 128, so we need to increment
          if (!empty($depth)) {
              $depthLength = strlen($depth);
              $shouldGetFromFragment = 256 - $depthLength;
              
              if (strlen($fragment) > $shouldGetFromFragment) {
                  $sub = substr($fragment, 0, $shouldGetFromFragment);
                  $rest = substr($fragment, $shouldGetFromFragment);
                  $fragment = $rest;
                  
                  array_push($segments, $depth . $sub);
                  $depth = '';
              }
          }
          
          if ($this->haveRequirement($fragment)) {
              array_push($segments, $fragment);
          } else {
              if (strlen($fragment) < 128) {
                  $depth .= $fragment;
              }
              
              if (strlen($fragment) > 256) {
                  $chunks = str_split($fragment, 256);
                  
                  // Check the last element in the chunks
                  $last = end($chunks);
                  
                  if ($this->haveRequirement($last)) {
                      foreach ($chunks as $chunk) {
                          array_push($segments, $chunk);
                      }
                  } else {
                      $depth = array_pop($chunks);
                      
                      foreach ($chunks as $chunk) {
                          array_push($segments, $chunk);
                      }
                  }
              }
          }
      }
      
      if (!empty($depth)) {
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

