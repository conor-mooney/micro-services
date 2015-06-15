require 'json'
require 'httparty'


BASE_URL = 'http://127.0.0.1:4567'


test1 = Proc.new do
  puts "TEST 1"

  url         = "#{BASE_URL}/person/1"
  response    = HTTParty.get(url)
  status_code = response.code

  puts "STATUS: #{status_code}"
  puts "DATA:   #{response.body}"

  status_code == 200
end


test2 = Proc.new do
  puts "TEST 2"

  url         = "#{BASE_URL}/person"
  headers     = {'Content-Type' => 'application/json'}
  payload     = {"first name" => "Donald", "last name" => "Duck"}
  response    = HTTParty.post(url, :headers => headers, :body => payload.to_json)
  status_code = response.code

  puts "STATUS: #{status_code}"
  puts "DATA:   #{response.body}"

  status_code == 200
end


test3 = Proc.new do
  puts "TEST 3"

  url         = "#{BASE_URL}/person"
  headers     = {'Accept' => 'application/json', 'Content-Type' => 'application/json'}
  payload     = {"first name" => "Donald", "last name" => "Duck"}
  response    = HTTParty.post(url, :headers => headers, :body => payload.to_json)
  status_code = response.code

  puts "STATUS: #{status_code}"

  return false if status_code != 200

  person_id   = JSON.parse(response.body)['id']
  headers     = {'Accept' => 'application/json', 'Content-Type' => 'application/json'}
  url         = "#{BASE_URL}/person/#{person_id}"
  response    = HTTParty.delete(url, :headers => headers)
  status_code = response.code

  puts "STATUS: #{status_code}"

  status_code == 200
end


test4 = Proc.new do
  puts "TEST 4"

  url         = "#{BASE_URL}/person"
  headers     = {'Accept' => 'application/json', 'Content-Type' => 'application/json'}
  payload     = {"first name" => "Donald", "last name" => "Duck"}
  response    = HTTParty.post(url, :headers => headers, :body => payload.to_json)
  status_code = response.code

  puts "STATUS: #{status_code}"

  return false if status_code != 200

  person_id             = JSON.parse(response.body)['id']
  payload               = response.body
  payload['first name'] = "I'm"
  payload['last name']  = "Changed!"

  headers     = {'Accept' => 'application/json'}
  url         = "#{BASE_URL}/person/#{person_id}"
  response    = HTTParty.put(url, :headers => headers, :body => payload)
  status_code = response.code

  puts "STATUS: #{status_code}"
  puts "DATA:   #{response.body}"

  status_code == 200
end


test5 = Proc.new do
  puts "TEST 5"

  url         = "#{BASE_URL}/people"
  response    = HTTParty.get(url)
  status_code = response.code

  puts "STATUS: #{status_code}"
  puts "DATA:   #{response.body}"

  status_code == 200
end


num_pass = 0
num_fail = 0

[test1, test2, test3, test4, test5].each do |test|
  puts "-----------------------------------------------------------"

  if test.call
    num_pass += 1
    puts "PASS"
  else
    num_fail += 1
    puts "FAIL"
  end
end

puts "==========================================================="
puts "#{num_pass} passed, #{num_fail} failed"

