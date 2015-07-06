<?php

class PersonStore {

	var $people_file = './people.json';

	private function load_data() {
		if (file_exists($this->people_file) && is_file($this->people_file))
		{
			$this->people = json_decode(file_get_contents($this->people_file));
		} else {
			die('people file does not exist!');
		}
	}


	private function save_data() {
		file_put_contents($this->people_file, json_encode($this->people));
	}


	private function next_id() {
		$max = 0;

		foreach ($this->people as $person) {
			if ($person->id > $max) {
				$max = $person->id;
			}
		}

		return $max + 1;
	}


	public function seed($people) {
		$this->people = $people;
		$this->save_data();
	}


	public function read_person($id) {
		$this->load_data();

		foreach ($this->people as $person) {
			if ($person->id == $id) {
				return $person;
			}
		}

		return [];
	}


	public function update_person($person_data) {
		$this->load_data();
		$new_people = Array();

		foreach ($this->people as $person) {
			if ($person->id == $person_data->id) {
				array_push($new_people, $person_data);
			} else {
				array_push($new_people, $person);
			}
		}

		$this->people = $new_people;
		$this->save_data();
		return $person_data;
	}


	public function delete_person($id) {
		$deleted = false;
		$this->load_data();
		$new_people = Array();

		foreach ($this->people as $person) {
			if ($person->id == $id) {
				$deleted = true;
			} else {
				array_push($new_people, $person);
			}
		}

		$this->people = $new_people;
		$this->save_data();
		return $deleted;
	}


	public function create_person($person) {
		$this->load_data();
		$person->id = $this->next_id();
		array_push($this->people, $person);
		$this->save_data();
		return $person;
	}


	public function people() {
		$this->load_data();
		return $this->people;
	}
}

