'''
web service for handling people records
'''
import json
from flask import Flask, request, jsonify
from person_store import PersonStore


app = Flask('person')

@app.route('/')
def info():
  return "person microservice (flask)"


@app.route('/help', methods = ['GET'])
def help():
  func_list = {}

  for rule in app.url_map.iter_rules():
    if rule.endpoint != 'static':
      func_list[rule.rule] = app.view_functions[rule.endpoint].__doc__

  return jsonify(func_list)


@app.route('/person/<int:person_id>', methods=['GET'])
def read_person(person_id):
  ps      = PersonStore()
  person  = ps.read_person(person_id) 

  if person is None:
    return "NOT FOUND"

  return json.dumps(person)


@app.route('/person/<int:person_id>', methods=['PUT'])
def update_person(person_id):
  person_data = request.json
  ps          = PersonStore()
  person      = ps.update_person(person_id, person_data)

  return jsonify(person)


@app.route('/person', methods=['POST'])
def create_person():
  person_data = request.json
  ps          = PersonStore()
  person      = ps.create_person(person_data)

  return jsonify(person)


@app.route('/person/<int:person_id>', methods=['DELETE'])
def delete_person(person_id):
  ps = PersonStore()
  
  if ps.delete_person(person_id):
    return "DELETED"
  else:
    return "NOT FOUND"


if __name__ == "__main__":
  app.run(debug=True)

