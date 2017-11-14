# DigDat Surveys
Simple Survey system using Laravel Backend and Vue.js Frontend  
Users can register and create surveys, which they can share with the public. Publicly available results will be provided,
 as well as some data visualization and more detailed data for the survey creator.


## Getting Started

### Requirements
- PHP 7.0+
- Laravel 5.5
- MySQL 5+
- nodejs 6+

#### quick setup.sh script (ymmv, tested under ubuntu)
- `./setup.sh`

#### enter commands manually
- `chmod 777 storage/ -R`
  - do these once... (the setup script handles skipping them)
    - `cp .env.example .env`
    - `editor .env`
      - at the very least, edit the db connection settings
    - `php artisan key:generate`
- `composer install`
- `yarn`
- `mysql -u root -p -e 'CREATE DATABASE IF NOT EXISTS dd_surveys'`
  - that's from the command line, or use your tool of choice to create the db
- `php artisan migrate`
- `php artisan db:seed`

### Google Analytics support (optional)
If you'd like to use Google Analytics, simply enter your
[property ID](https://support.google.com/analytics/answer/1008080) (UA code) in
the GOOGLE_ANALYTICS_UA parameter in your `.env` file

## Tests
PHPUnit Tests: `phpunit`  
Browser Tests: `php artisan dusk`

## TODO FOR V0.1
- ~~Associate Surveys with users~~
- ~~Create an 'Option' Model for question options (adds more flexibility)~~
- User Registration - slug validation
- Add Survey status - maybe optional expiration date?
- Survey GUI/CRUD for creating surveys (in progress)
- Survey URLS (slugs & user namespace?)
- ~~Remove Google Analytics stuff (kind of)~~
- Email Reporting
- Layout overhaul: get some love from Eric
- Survey Page Titles
- Public / Private?
- Users can 'subscribe' to surveys. When survey is completed, they can get an email with results
- Data Visualizations of results (for creator)

## Pages
- Survey Create (must be logged in)
- Survey Edit (must be logged in)
- Survey Results (must be logged in)
- Survey Display (public)
- Home Page (public)
  - List of recent surveys? or most popular?


## Tests to write
- Non-logged in users see prompt to register when trying to view results
- Registered users can see survey results
- If logged in user and survey owner, see detailed results link
- If logged in user and not survey owned, see link for public results


## Notes
- Try and include unique ID's to button elements for easier testing
