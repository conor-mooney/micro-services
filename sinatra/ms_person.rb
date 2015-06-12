require 'sinatra'
require './person_store'


get '/' do 
  "person microservice (sinatra)"
end


get '/people' do
  ps     = PersonStore.new()
  people = ps.people

  people.to_json
end


get '/person/:person_id' do
  person_id = params[:person_id].to_i
  ps        = PersonStore.new()
  person    = ps.read_person(person_id)

  return "NOT FOUND" if person.nil?

  person.to_json
end


put '/person/:person_id' do
  request.body.rewind

  person_id   = params[:person_id].to_i
  person_data = JSON.parse request.body.read
  ps          = PersonStore.new()
  person      = ps.update_person(person_id, person_data)

  person.to_json
end


post '/person' do
  request.body.rewind

  person_data = JSON.parse request.body.read
  ps          = PersonStore.new()
  person      = ps.create_person(person_data)

  person.to_json
end


delete '/person/:person_id' do
  person_id = params[:person_id].to_i
  ps        = PersonStore.new()

  if ps.delete_person(person_id)
    return "DELETED"
  else
    return "NOT FOUND"
  end
end

