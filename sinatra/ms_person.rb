require 'sinatra'
require 'sinatra/advanced_routes'
require './person_store'


HTTP_NOT_FOUND = 404
HTTP_INVALID   = 403
HTTP_OK        = 200


get '/' do 
  status HTTP_OK
  "person microservice (sinatra)"
end


get '/help' do
  Sinatra::Application.each_route do |route|
    puts '-' * 20
    puts route.app.name   # "SomeSinatraApp"
    puts route.path       # that's the path given as argument to get and akin
    puts route.verb       # get / head / post / put / delete
    puts route.file       # "some_sinatra_app.rb" or something
    puts route.line       # the line number of the get/post/... statement
    puts route.pattern    # that's the pattern internally used by sinatra
    puts route.keys       # keys given when route was defined
    puts route.conditions # conditions given when route was defined
    puts route.block      # the route's closure
  end
end


get '/people' do
  status HTTP_OK

  ps     = PersonStore.new()
  people = ps.people

  people.to_json
end


get '/person/:person_id' do
  status HTTP_OK

  person_id = params[:person_id].to_i
  ps        = PersonStore.new()
  person    = ps.read_person(person_id)

  status HTTP_NOT_FOUND if person.nil?

  person.to_json
end


put '/person/:person_id' do
  status HTTP_OK
  request.body.rewind

  person_id   = params[:person_id].to_i
  person_data = JSON.parse request.body.read
  ps          = PersonStore.new()
  person      = ps.update_person(person_id, person_data)

  status HTTP_NOT_FOUND if person.nil?
  person.to_json
end


post '/person' do
  status HTTP_OK
  request.body.rewind

  person_data = JSON.parse request.body.read
  ps          = PersonStore.new()
  person      = ps.create_person(person_data)

  person.to_json
end


delete '/person/:person_id' do
  status HTTP_OK

  person_id = params[:person_id].to_i
  ps        = PersonStore.new()

  status HTTP_NOT_FOUND unless ps.delete_person(person_id)
end

