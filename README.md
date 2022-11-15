# Alura - Doctrine: migrations, reports and performance

Examples from Alura training [Doctrine: migrations, reports and performance](https://cursos.alura.com.br/course/doctrine-migrations-relatorios-performance).

## Requirements

- PHP 8.1
- Composer
- SQLite 3

## Run the project

1. Install the dependencies:
   ```
   composer install 
   ```

2. Create the database:
   ```
   php bin/doctrine.php orm:schema-tool:create
   ```

3. Run the scripts in the `tests/courses` and `tests/students` directories. Example, to create a student with a phone number:
   ```
   php tests/students/insert.php Daniel "(17) 98888-7777"
   ```
   
## Main commands:
- Create difference migrations between the entities and the current database:
  ```
  php vendor/bin/doctrine-migrations migrations:diff
  ```

- Clear metadata cache:
  ```
  php bin/doctrine orm:clear-cache:metadata
  ```

- Clear query cache:
  ```
  php bin/doctrine orm:clear-cache:query
  ```

- Clear result cache:
  ```
  php bin/doctrine orm:clear-cache:result
  ```

