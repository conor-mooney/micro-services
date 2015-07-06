<?php

function test1() {
  print("TEST 1\n");
  return false;
}


function test2() {
  print("TEST 2\n");
  return false;
}


function test3() {
  print("TEST 3\n");
  return false;
}


function test4() {
  print("TEST 4\n");
  return false;
}


function test5() {
  print("TEST 5\n");
  return false;
}

$num_pass = 0;
$num_fail = 0;

forEach(["test1", "test2", "test3", "test4", "test5"] as $test) {
  print "---------------------------------------------------\n";
  if ($test()) {
    print("PASS\n");
    $num_pass += 1;
  } else {
    print("FAIL\n");
    $num_fail += 1;
  }
}

print "===================================================\n";
printf("%d passed, %d failed\n", $num_pass, $num_fail)

?>
