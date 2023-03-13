<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../src/MyClass.php';

class MyClassTest extends TestCase
{
    public function testAdd()
    {
    $myClass = new MyClass();
    // 256 byte fragement 
    $fragement1 = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam eu fringilla nulla. Nunc non dignissim quam. Aliquam vestibulum faucibus diam, ut volutpat tortor facilisis a. Quisque mi neque, pellentesque quis posuere quis, blandit sit amet risus eleifend.";
    // 377 byte fragement
    $fragement2 = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus at nibh sed libero malesuada tincidunt a eget mauris. Suspendisse a nibh eleifend leo ullamcorper auctor ac et risus. Phasellus interdum sapien vitae lacus congue posuere. Ut dictum, purus vel eleifend sodales, sem augue euismod purus, id congue leo arcu ac dui. Sed pulvinar, leo non imperdiet fringilla biam.";
    // 150 byte fragement
    $fragement3 = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vitae ornare magna. Proin ullamcorper lacus quis arcu tincidunt, in aliquam magna biam.";
    // 5 byte fragement
    $fragement4 = "sssAA";
    // all the test cases are mentioned 

	$fragments = array($fragement1 , $fragement2 , $fragement3 , $fragement4);

    // 
    $segements = $myClass->assemble_segments($fragments);
    foreach($segements as $segement){
        $this->assertGreaterThanOrEqual(128 , strlen($segement));
        $this->assertLessThanOrEqual(256 , strlen($segement));
    }
	

    }
}

