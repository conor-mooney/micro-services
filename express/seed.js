var fs = require('fs')

people = [
{'id': 1, 'first name': 'Bart'  , 'last name': 'Simpson'},
{'id': 2, 'first name': 'Homer' , 'last name': 'Simpson'},
{'id': 3, 'first name': 'Marge' , 'last name': 'Simpson'},
{'id': 4, 'first name': 'Lisa'  , 'last name': 'Simpson'},
{'id': 5, 'first name': 'Maggy' , 'last name': 'Simpson'},
{'id': 6, 'first name': 'Donald', 'last name': 'Duck'}   ,
{'id': 7, 'first name': 'Daffy' , 'last name': 'Duck'}   ,
{'id': 8, 'first name': 'Mickey', 'last name': 'Mouse'}
];

fs.writeFile('people.json', 
    JSON.stringify(people, null, 4), 
    function (err, data) {
      if (err) {
        return console.log(err);
      } else {
        console.log('data saved');
      }
    });
