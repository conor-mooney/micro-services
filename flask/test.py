import requests
import json


BASE_URL = 'http://127.0.0.1:5000'


def test1():
  print "TEST 1"

  headers     = {'Accept': 'application/json'}
  url         = "%s/person/1" % BASE_URL
  response    = requests.get(url, headers=headers)
  status_code = response.status_code

  print "STATUS: %s" % status_code
  print "DATA:   %s" % response.json()

  return status_code == 200


def test2():
  print "TEST 2"

  headers     = {'Accept': 'application/json', 'Content-type': 'application/json'}
  url         = "%s/person" % BASE_URL
  payload     = {"first name": "Donald", "last name": "Duck"}
  response    = requests.post(url, headers=headers, data=json.dumps(payload))
  status_code = response.status_code

  print "STATUS: %s" % status_code
  print "DATA:   %s" % response.json()

  return status_code == 200


def test3():
  print "TEST 3"

  headers     = {'Accept': 'application/json', 'Content-type': 'application/json'}
  url         = "%s/person" % BASE_URL
  payload     = {"first name": "Delete", "last name": "Me"}
  response    = requests.post(url, headers=headers, data=json.dumps(payload))
  status_code = response.status_code

  print "STATUS: %s" % status_code

  if status_code != 200:
    return False

  person_id   = response.json()['id']
  headers     = {'Accept': 'application/json'}
  url         = "%s/person/%d" % (BASE_URL, person_id)
  response    = requests.delete(url, headers=headers)
  status_code = response.status_code

  print "STATUS: %s" % status_code

  return status_code == 200


def test4():
  print "TEST 4"

  headers     = {'Accept': 'application/json', 'Content-type': 'application/json'}
  url         = "%s/person" % BASE_URL
  payload     = {"first name": "Change", "last name": "Me"}
  response    = requests.post(url, headers=headers, data=json.dumps(payload))
  status_code = response.status_code

  print "STATUS: %s" % status_code

  if status_code != 200:
    return False

  person                = response.json()
  person_id             = person['id']
  payload               = person
  payload['first name'] = "I'm"
  payload['last name']  = "Changed!"

  headers     = {'Accept': 'application/json', 'Content-type': 'application/json'}
  url         = "%s/person/%d" % (BASE_URL, person_id)
  response    = requests.put(url, headers=headers, data=json.dumps(payload))
  status_code = response.status_code

  print "STATUS: %s" % status_code
  print "DATA:   %s" % response.json()

  return status_code == 200


def test5():
  print "TEST 5"

  headers     = {'Accept': 'application/json'}
  url         = "%s/people" % BASE_URL
  response    = requests.get(url, headers=headers)
  status_code = response.status_code

  print "STATUS: %s" % status_code
  print "DATA:   %s" % response.json()

  return status_code == 200


if __name__ == "__main__":
  num_pass = 0
  num_fail = 0

  for test in [test1, test2, test3, test4, test5]:
    print "-----------------------------------------------------------"

    if test():
      num_pass += 1
      print "PASS"
    else:
      num_fail += 1
      print "FAIL"

  print "==========================================================="
  print "%d passed, %d failed" % (num_pass, num_fail)

