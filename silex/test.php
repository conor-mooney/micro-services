<?php
require_once __DIR__.'/vendor/autoload.php';
use GuzzleHttp\Client;


$BASE_URL = 'http://127.0.0.1:8080';

$client = new Client([
  'base_uri' => $BASE_URL,
  'timeout'  => 2.0,
]);


function test1() {
  print("TEST 1\n");

  global $client;

  $response    = $client->get("/person/1");
  $status_code = $response->getStatusCode();
  $data        = $response->getBody();

  printf("STATUS: %d\n", $status_code);
  printf("DATA:   %s\n", $data);

  return $status_code == 200;
}


function test2() {
  print("TEST 2\n");

  global $client;

  $payload     = ["first name" => "Bat", "last name" => "Man"];
  $response    = $client->post("/person", ['json' => $payload]);
  $status_code = $response->getStatusCode();
  $data        = $response->getBody();

  printf("STATUS: %d\n", $status_code);
  printf("DATA:   %s\n", $data);

  return $status_code == 200;
}


function test3() {
  print("TEST 3\n");

  global $client;

  $payload     = ["first name" => "Delete", "last name" => "Me"];
  $response    = $client->post("/person", ['json' => $payload]);
  $status_code = $response->getStatusCode();
  $data        = json_decode($response->getBody());

  printf("STATUS: %d\n", $status_code);

  if ($status_code != 200) {
  	return false;
  }

  $person_id   = (int)$data->id;
  $response    = $client->delete("/person/" . $person_id);
  $status_code = $response->getStatusCode();

  return $status_code == 200;
}


function test4() {
  print("TEST 4\n");

  global $client;

  $payload     = ["first name" => "Change", "last name" => "Me"];
  $response    = $client->post("/person", ['json' => $payload]);
  $status_code = $response->getStatusCode();
  $data        = json_decode($response->getBody());

  printf("STATUS: %d\n", $status_code);

  if ($status_code != 200) {
  	return false;
  }

  $person_id = (int)$data->id;
  $payload   = ["first name" => "I'm", "last name" => "Changed"];
  $response  = $client->put("/person/" . $person_id, ['json' => $payload]);

  return $status_code == 200;
}


function test5() {
  print("TEST 5\n");

  global $client;

  $response    = $client->get("/people");
  $status_code = $response->getStatusCode();
  $data        = $response->getBody();

  printf("STATUS: %d\n", $status_code);
  printf("DATA:   %s\n", $data);

  return $status_code == 200;
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
