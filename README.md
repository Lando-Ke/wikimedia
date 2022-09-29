### Rquirements

This App has been build using Laravel 9. View the full requirements list here
    
### Installation
```sh
gh repo clone Lando-Ke/wikimedia
$cd subscriber-manager
composer install
```

### Running it
To run it:
```sh
$npm run dev; php artisan serve
```
The app should now be available on http://localhost:8000 

**Get short description**
----
  Returns json result with all subscribers.
* **URL**
  api/wikimedia/{search_query}
  * **Method:**
  `Get`
* **Sample Response**
  ```json
  {
	"title" : "height",
	"type" : "number",
	"value" : "5.11"}
  ```
    
### Assumptions Made
1. The API Structure is consistent. I've catered for the following edge cases:
    * Typos: It performs the search again using the suggested query input
    * Missing Entry: The api returns a response describing the failed search query
3. The language can be dynamically set, when the API is implemented. If an entry is not available in the english version, another request can be made to another language version. Or the language can be set to match the users language.
4.  If the `Short description` tag is present, it will always appear on the first line of the content body.
 

### What things could you do to keep this API service highly available and reliable?
1. Cache the results of search queries so that we don't have to ping the wikimedia API for repeat searches. The cache expiry can be set to a 24hrs to allow for data consistency
2. Set a http timeout to limit the amount of time the app server should wait for a response from the Wikimedia API
3. Take Advantage of Asynchrounous request techniques to send HTTP request in the background without blocking our code.


  
