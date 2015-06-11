'''
a very basic store for people objects
'''
import json
from os import path


class PersonStore(object):

  def __init__(self, store='people.json'):
    self.__people = []
    self.__store  = store
    self.__load_data()


  def __load_data(self):
    if path.exists(self.__store):
      with open(self.__store, 'r') as f:
        self.__people = json.loads(f.read())


  def __save_data(self):
    with open(self.__store, 'w') as f:
      self.__people = f.write(json.dumps(self.__people))


  def __next_id(self):
    if len(self.__people) > 0:
      return max([int(p['id']) for p in self.__people]) + 1
    else:
      return 1


  def seed(self, people):
    self.__people = people
    self.__save_data()


  @property
  def people(self):
    return self.__people


  def read_person(self, person_id):
    for person in self.people:
      if person['id'] == person_id:
        return person

    return None


  def create_person(self, person):
    new_id = self.__next_id()
    person['id'] = new_id
    self.__people.append(person)
    self.__save_data()
    return person


  def update_person(self, person_id, person_data):
    for i, person in enumerate(self.people):
      if person['id'] == person_id:
        del(self.__people[i])
        self.__people.append(person_data)
        self.__save_data()
        return person

    return {}


  def delete_person(self, person_id):
    for i, person in enumerate(self.people):
      if person['id'] == person_id:
        del(self.people[i])
        self.__save_data()
        return True

    return False

