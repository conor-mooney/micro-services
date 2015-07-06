<?php
require 'web/person_store.php';


$people = [
  [
    "first name" =>  "Bart",
    "id"         =>  1,
    "last name"  =>  "Simpson"
  ],
  [
    "first name" =>  "Homer",
    "id"         =>  2,
    "last name"  =>  "Simpson"
  ],
  [
    "first name" =>  "Marge",
    "id"         =>  3,
    "last name"  =>  "Simpson"
  ],
  [
    "first name" =>  "Lisa",
    "id"         =>  4,
    "last name"  =>  "Simpson"
  ],
  [
    "first name" =>  "Maggy",
    "id"         =>  5,
    "last name"  =>  "Simpson"
  ],
  [
    "first name" =>  "Donald",
    "id"         =>  6,
    "last name"  =>  "Duck"
  ],
  [
    "first name" =>  "Daffy",
    "id"         =>  7,
    "last name"  =>  "Duck"
  ]
];

$ps = new PersonStore();
$ps->seed($people);

?>

