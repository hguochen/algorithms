SELECT * FROM person;

SELECT name, age FROM pet;

SELECT name, age FROM pet WHERE dead = 0;

SELECT * FROM person WHERE first_name != 'Zed';

SELECT * FROM pet WHERE pet.age > 10;

SELECT * FROM person WHERE person.age < 29;

SELECT * FROM person WHERE first_name = "Zed" AND age > 30;