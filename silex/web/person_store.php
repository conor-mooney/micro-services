<?php


class PersonStore {

  var $people_file = './people.json';

  public function person($id) {
    if(file_exists($this->people_file) && is_file($this->people_file))
    {
      $people = json_decode(file_get_contents($this->people_file));

      foreach ($people as $person) {
        var_dump($person);
        if ($person->id == $id) {
          print("FOUND");
          return $person;
        }
      }

      return [];
    } else {
      die('people file does not exist!');
    }
  }


  public function people() {
    if(file_exists($this->people_file) && is_file($this->people_file))
    {
      $people = json_decode(file_get_contents($this->people_file));

      return $people;
    } else {
      die('people file does not exist!');
    }
  }
}

