var request = require('request');
var wait    = require('wait.for');

BASE_URL = 'http://127.0.0.1';
PORT   = 3000


function test1() {
	var result = false;
	console.log('Test 1');

	wait.launchFiber(request.get, {
		uri: BASE_URL + ":" + PORT + "/person/1" 
	},
	function (error, response, body) {
		if (!error && response.statusCode == 200) {
			console.log(body);
			result = true;
		} else {
			console.log(response.statusCode);
			result = false;
		}
	});

	return result;
}


function test2() {
	console.log('Test 2');
	var result  = false;
	var payload = {"first name": "Donald", "last name": "Duck"}

	wait.launchFiber(request.post, {
		uri: BASE_URL + ":" + PORT + "/person" ,
		body: JSON.stringify(payload)
	},
	function (error, response, body) {
		if (!error && response.statusCode == 200) {
			console.log(body);
			result = true;
		} else {
			console.log(response.statusCode);
			result = false;
		}
	});

	return result;
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

	try{
		if (tests[test]()) {
			num_pass++;
			console.log('PASS');
		} else {
			num_fail++;
			console.log('FAIL');
		}
	} catch (err) {
		console.log("EXCEPTION: " + err.stack);
	}
}

console.log('==================================================');
console.log(num_pass + " passed, " + num_fail + " failed");

