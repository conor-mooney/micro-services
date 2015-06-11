import json
from flask import Flask, request


class PersonStore(object):

  def __init__(self, store= None):
    self.__people = {}
    self.__store  = store
    self.__load_data()

  def __load_data(self):
    with open(self.__store, 'r') as f:
      self.__people = eval(json.loads(f.read()))

  def __save_data(self):
    with open(self.__store, 'w') as f:
      self.__people = f.write(json.dumps(self.__people))

  @property
  def people(self):
    return self.__people

  def add_person(self, person):
    self.__people


app = Flask('person')

@app.route('/')
def info():
  return "person microservice"


@app.route('/person/<int:person_id>', methods=['GET'])
def read_person(person_id):
  return "NOT FOUND"


@app.route('/person/<int:person_id>', methods=['PUT'])
def update_person(person_id):
  return "NOT FOUND"


@app.route('/person', methods=['POST'])
def create_person():
  json_data = request.json
  print json.dumps(json_data)
  return "person created"


@app.route('/person/<int:person_id>', methods=['DELETE'])
def delete_person(person_id):
  return "NOT FOUND"


if __name__ == "__main__":
  app.run()

