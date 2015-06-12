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


  def update_person(person_id, person)
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
  end

end

