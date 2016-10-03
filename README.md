# Solution of PHP Task
## How to start server
1. Need to make copy of file `init.server.php.example` with name `init.server.php`, and set up the database parameters in this file.
2. Configure Apache so that it was looking for in the directory `./web/`.
3. The database is automatically created with the name `EnglishDom` after first start.

## How to use
1. For upload the observers into database need to run a home script named `index.php`.
2. After that you can use comments with observers in the script named `comments.php`.
3. Also was created unit test for the `EventManager`:
 * `phpunit tests/EventManagerTestHandle.php`
 * `phpunit tests/EventManagerTestSaveLoad.php`
