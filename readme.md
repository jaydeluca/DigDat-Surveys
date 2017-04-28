
### Installation
- `composer install`
- `yarn`
- `php artisan migrate`
- `php artisan db:seed`

#### Google Analytics
Reference the configuration docs from here: https://github.com/spatie/laravel-analytics

You will need to do a few steps through your google API dashboard, and then using a JSON file they provide,
add it to the project at: storage/app/laravel-google-analytics/service-account-credentials.json

Note: This file is not, and should not be version controlled, so you **will need** to manually add it.

### Creating a form
Currently just using JSON until the GUI is done.

Ex:
```
  {
    "question": "There is no spoon?",
    "options": [
      "Yes",
      "No"
    ]
  }
```

## TODO
- Associate Surveys with users (in progress)
- Add Survey status - maybe optional expiration date?
- Survey GUI/CRUD for creating surveys
- Survey URLS
- Integrate Google Analytics more specific (stats per survey as opposed to per account)
- Email Reporting
- Layout overhaul: get some love from Eric
- Survey Page Titles
- Public / Private?
- Make Google Analytics aspect optional and more customizable within the application
- Users can 'subscribe' to surveys. When survey is completed, they can get an email with results

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