var express = require('express');
var router  = express.Router();
var fs      = require('fs');


// route handlers
router.get('/', function(req, res, next) {
  res.type('text/plain');
  res.send('person micorservice (express)');
});


router.get('/people', function(req, res) {
  fs.readFile('people.json', 
    function (err, data) {
      if (err) {
        res.json({'error': err});
      } else {
        people = JSON.parse(data);
        res.json(people);
      }
    });
});


router.get('/person/:person_id', function(req, res) {
  var person_id = parseInt(req.params['person_id']);
  var person    = null;

  fs.readFile('people.json', 
    function (err, data) {
      if (err) {
        res.json({'error': err});
      } else {
        people = JSON.parse(data);

        people.forEach( function(p, index) {
          if (p['id'] == person_id) {
            person = p;
          }
        });
      }

      if (person == null) {
        res.json({'status': 'NOT FOUND'});
      } else {
        res.json(person);
      }
    });
});


router.post('/person', function(req, res) {
  var person = req.body;

  fs.readFile('people.json', 
    function (err, data) {
      if (err) {
        res.json({'error': err});
      } else {
        people = JSON.parse(data);

        var max = 0;
        people.forEach( function(p, index) {
          if (p['id'] > max) {
            max = p['id'];
          }
        });

        person['id'] = max + 1;
        people.push(person);

        fs.writeFile('people.json', 
          JSON.stringify(people, null, 4), 
          function (err, data) {
            if (err) {
              res.json({'error': err});
            } else {
              res.json(person);
            }
          });
      }
    });
});


router.put('/person/:person_id', function(req, res) {
  var person    = req.body;
  var person_id = parseInt(req.params['person_id']);

  person['id'] = person_id;

  fs.readFile('people.json', 
    function (err, data) {
      if (err) {
        res.json({'error': err});
      } else {
        people = JSON.parse(data);

        people.forEach( function(p, index) {
          if (p['id'] == person_id) {
            people.splice(index, 1);
            people.push(person);

            fs.writeFile('people.json', 
              JSON.stringify(people, null, 4), 
              function (err, data) {
                if (err) {
                  res.json({'error': err});
                } else {
                  res.json(person);
                }
              });
          }
        });
        res.json({'status': 'NOT FOUND'});
      }
    });
});


router.delete('/person/:person_id', function(req, res) {
});

module.exports = router;

