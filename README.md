### Japan Spots and Weather
- Website: https://japan.devdojo.cloud/
- Hosting: Hostinger

### Why the UI/UX?

I decided to just go with single-page-type application and provide the information that users needed and based on the requirements, including the weather and tourist in a horizontal scrollable content.
In this design, users can view in a single glance all of the data, the layout also provides the time in Japan.

In terms of switching cities, I put it at the right side of the page so that it's much easier to navigate.

### Code implementation

I used laravel, vuejs and the default SQLite. For the API, I created a services in the `app/services` so that the APIs are isolated and can be used to other projects if so.
The result from the APIs are cached by API type and by identifier, so that it'll improve the performance of the application, not fetching every users or requests, since the data aren't changing in real-time (the caches can be edited how long it'll be cache to suit the API).

I also created a migration file for countries, in case ~ soon, the app will also display other countries and cities.
