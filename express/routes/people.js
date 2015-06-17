var express = require('express');
var router  = express.Router();


// route handlers
router.get('/', function(req, res, next) {
  res.type('text/plain');
  res.send('person micorservice (express)');
});


router.get('/people', function(req, res) {
	var people = {"first name": "Homer", "last name": "Simpson"}
	res.json(people);
});

module.exports = router;

