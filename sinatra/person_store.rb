require 'json'


class PersonStore

  attr_reader :people

  def initialize(store='people.json')
    @people = []
    @store = store
    load_data
  end


  def seed(people)
    @people = people
    save_data
  end


  def read_person(person_id)
    @people.each do |person|
      return person if person['id'] == person_id
    end

    return nil
  end


  def update_person(person_id, person_data)
    @people.each do |person|
      if person['id'] == person_id
        person_data['id'] = person_id
        @people -= [person]
        @people << person_data
        save_data
        return person_data
      end
    end

    nil
  end


  def delete_person(person_id)
    @people.each do |person|
      if person['id'] == person_id
        @people -= [person]
        save_data
        return true
      end
    end

    false
  end


  def create_person(person_data)
    person_data['id'] = next_id
    @people << person_data
    save_data
    person_data
  end


  private

  def load_data()
    if File.exists?(@store)
      data = File.read(@store)
      @people = JSON.parse(data)
    end
  end


  def save_data()
    File.open(@store, 'w') do |file|
      file.write(JSON.dump(@people))
    end
  end


  def next_id()
    if @people.length > 0
      return @people.map {|m| m['id']}.max + 1
    else
      return 1
    end
  end

end

