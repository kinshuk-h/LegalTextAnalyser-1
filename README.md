## Deployment
To install this Laravel project, you'll need to make sure you have the following installed on your system:
- PHP
- Composer
- Node.js
- npm (comes with Node.js)
- MySQL (comes with XAMPP)

Once you've done that, you can install and set up this Laravel project by following these instructions:

- For this Laravel project, you must start the MySQL server in Workbench or phpMyAdmin and create a new MySQL database. Run the following SQL command after logging into your MySQL server using the mysql command-line client:

$ CREATE DATABASE <database-name>;

- The Laravel project must be cloned from GitHub. Go to the location where you wish to install the project in a terminal after launching it. Run the subsequent command to clone the project after that:

$ git clone https://github.com/paraspant09/LegalTextAnalyser.git

- After the project has been cloned, use Composer to install the PHP requirements by navigating to the project directory:

$ composer install

- You must then configure your environment variables. Your database credentials and application key are two examples of environment-specific settings that Laravel stores in an .env file. You can duplicate the project's .env.example file to generate an .env environment variable file:

$ cp .env.example .env

- In a text editor, open the .env file, and make the necessary changes to the settings. For instance, you must set the DB_DATABASE, DB_USERNAME, and DB_PASSWORD variables to match your database credentials.

- In .env file add link from where the Documents should be seeded in the database : 
https://api.github.com/repos/kinshuk-h/LT-Crawler/contents/data/json/DHC%20Judgments

- Create a mailtrap.io account (or another email testing server) and copy the mailtrap laravel configurations to the .env file (if error occurs then change port as firewall may restrict ports). 
For production, Change the environment to production and add email configurations for real email IDs.

- After making the necessary changes to the .env file, you must create an application key. The data in your application is encrypted and secured using this key. You can generate an application key by running the following command:

$ php artisan key:generate

- You may now use migrations to generate the database tables after setting up the Laravel backend. The structure of the database tables is specified by Laravel using migrations. To run the migrations, run the following command:

$ php artisan migrate

With this, all of the database tables required for this Laravel project will be created.

- Once the database tables have been constructed, seeders can be used to add the data needed to operate, such as admin, document, and user data. For testing purposes, Laravel creates dummy data using seeders.For this project, it is a necessity for production deployment as well.To run the seeders, run the following command:

$ php artisan db:seed

- The frontend's Node.js dependencies may now be installed, and npm can be used to create the frontend's assets. :

$ npm install <br/>
$ npm run build

- Last but not least, you may launch the Laravel development server by executing the following command in the project's root directory:

$ php artisan serve

By doing this, the Laravel development server at localhost:8000 will be launched. To access this Laravel project, enter this URL into your web browser.
