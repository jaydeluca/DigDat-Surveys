
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



## TODO
- Survey GUI/CRUD
- Survey URLS
- Integrate Google Analytics more specific (stats per survey as opposed to per account)
- Email Reporting
- Layout overhaul
- Make Google Analytics aspect optional and more customizable within the application