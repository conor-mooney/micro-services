var http = require('http');

const PORT=8080; 

function handleRequest(request, response){
    response.end('person microservice (node)');
}

var server = http.createServer(handleRequest);

server.listen(PORT, function(){
    console.log("Server listening on: http://localhost:%s", PORT);
});

