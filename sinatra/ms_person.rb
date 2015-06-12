require 'sinatra'
require './person_store'


get '/' do 
  "person microservice (sinatra)"
end


get '/person/:person_id' do
  person_id = params[:person_id].to_i
  ps        = PersonStore.new()
  person    = ps.read_person(person_id)

  return "NOT FOUND" if person.nil?

  person.to_json
end


put '/person/:person_id' do
  person_id = params[:person_id].to_i
  ps        = PersonStore.new()
  person    = ps.update_person(person_id, person_data)

  person.to_json
end


post '/person' do
  "NOT IMPLEMENTED"
end


delete '/person/:person_id' do
  "NOT IMPLEMENTED"
end

