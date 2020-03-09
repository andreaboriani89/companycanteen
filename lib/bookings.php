<?php 
/**
	* @author Andrea Boriani
*/
class Bookings
{
	
	private $user;
	private $foods;
	private $day;

	public function __construct(string $user, array $foods, string $day)
    {
        $this->SetUser($user);
        $this->SetFoods($foods);
        $this->SetDay($day);
    }
	
	public function SetUser($user)
	{
		return $this->user = trim($user);
	}
	
	public function GetUser()
	{
		return $this->user;
	}
	
	public function SetFoods($foods)
	{
		return $this->foods = $foods;
	}
	
	public function GetFoods()
	{
		return $this->foods;
	}
	
	public function SetDay($day)
	{
		return $this->day = $day;
	}
	
	public function GetDay()
	{
		return $this->day;
	}
	
	/**
	 * @description method for adding a new booking
	 *
     * @params user, foods, day
     *
     *
     * @return: ok addBooking if the parameters are correct, else error 400
     */
	public function AddBooking()
	{
		global $DB;
		
		try{
		
			//validate input
			if($this->ValidateBooking()[0] == 200){
				
				//escape string user
				$user = $DB->escape($this->GetUser());
			
				foreach($this->GetFoods() as $foodid){
					$DB->query('INSERT INTO cc_bookings (user, foodid, day) VALUES (?, ?, ?)', $user, $foodid, $this->GetDay());
				}
			
			}else{
				return $this->ValidateBooking();
			}
		
		} catch (Exception $e) {
			return array(500 , 'Caught exception ' .$e->getMessage());
		}
		
		return array(201, "ok addBooking");
		
	}
	
	/**
	 * @description method for validate data input
	 *
     * @params user, foods, day
     *
     *
     * @return: ok if the parameters are correct, else error 400
     */
	public function ValidateBooking(){
		
		if(!$this->GetUser()){
			return array(400, "The user field is empty");
		}
		
		if(strlen($this->GetUser()) > 255){	
			return array(400, "The user field is longer than 255 characters");
		}
		
		if(!count($this->GetFoods())){
			return array(400, "The foods field is empty");
		}
		
		if(!$this->GetDay()){
			return array(400, "The day field is empty");	
		}
		
		$regexDay = '/[0-9]{4}-[0-9]{2}-[0-9]{2}/';

		if (!preg_match($regexDay, $this->GetDay())) {
			return array(400, "The format of day field is not correctly. The correctly format is yyy-mm-dd");
		} 
		
		return array(200, "valori input validati");
		
	}
	
	
	/**
	 * @description method for get list bookings
	 *
     * @param day
     *
     *
     * @return: array list bookings
     */
	public function GetBookings()
	{
		global $DB;
		
		if(!$this->GetDay()){
			return array();
		}
		
		return $DB->query('SELECT * FROM cc_bookings WHERE day = ?', $this->GetDay())->fetchAll();
		
	}

}
?>