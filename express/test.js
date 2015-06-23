var http = require('http')


function test1() {
  console.log('Test 1');

  return false;
}


function test2() {
  console.log('Test 2');

  return false;
}


function test3() {
  console.log('Test 3');

  return false;
}


function test4() {
  console.log('Test 4');

  return false;
}


function test5() {
  console.log('Test 5');

  return false;
}


var num_pass = 0;
var num_fail = 0;

var tests = [test1, test2, test3, test4, test5];

for (test  = 0; test < tests.length; test++) { 
  console.log('--------------------------------------------------');

  if (tests[test]()) {
    num_pass++;
    console.log('PASS');
  } else {
    num_fail++;
    console.log('FAIL');
  }
}
