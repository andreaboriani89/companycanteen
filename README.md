# companycanteen
Repository per applicazione prenotazione mensa aziendale

##configuration plug-in##

to configure the db and specify the domain you need to edit the config / config.php file
$wwwroot = "" //example http://example.com;
$dbhost = "";
$dbname = "";
$dbuser = "";
$dbpass = "";


##api##

###api addBooking##

web service to add a new booking

*Endpoint*: /api/new
*Method*: POST
*Body*: 
 - user: string name user
 - foods: array ids foods
 - day: string day of booking. Format: yyy-mm-dd
 
 
###api getBookings##

web service to get list bookings of one day

*Endpoint*: /api/list
*Method*: POST
*Body*: 
 - day: string day of booking. Format: yyy-mm-dd