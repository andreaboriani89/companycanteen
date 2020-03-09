<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once(dirname(__FILE__)."/../lib/Bookings.php");
require_once(dirname(__FILE__)."/../config/initConfig.php");

class BookingsTest extends TestCase
{
    public function testConnectionDB()
    {	
		global $DB;

		return $this->assertEquals( true, $DB->getConnectionState() );
		
		
    }
	
	public function testAddBooking()
    {
		
		$user = "Andrea Boriani";
		$foods = array(1,2);
		$day = "2020-03-09";
		
		$bookings = new Bookings($user, $foods, $day);
		
		$responseValidationInput = $bookings->ValidateBooking();
		
		if($responseValidationInput[0] != 200){
			throw new \Exception($responseValidationInput[1]);
		}
		
		$responseInsert = $bookings->AddBooking();	
		
		return $this->assertEquals(201, $responseInsert[0]);	
		
    }


}

?>