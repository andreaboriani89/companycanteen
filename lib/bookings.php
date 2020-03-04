<?php 
//classe per gestire le prenotazioni alla mensa aziendale
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
	
	//metodo per aggiungere una nuova prenotazione
	public function AddBooking()
	{
		global $DB;
		
		try{
		
			//se i campi di input sono stati correttamente inseriti allora aggiungo la prenotazione
			if($this->ValidateBooking()){
				
				//pulisco la stringa da caratteri non accettati dal mysql
				$user = $DB->escape($this->GetUser());
			
				foreach($this->GetFoods() as $foodid){
					$DB->query('INSERT INTO cc_bookings (user, foodid, day) VALUES (?, ?, ?)', $user, $foodid, $this->GetDay());
				}
			
			}
		
		} catch (Exception $e) {
			return 'Caught exception ' .$e->getMessage();
		}
		
		return "200: ok addBooking";
		
	}
	
	//metodo per validare i campi di input di una prenotazione di un utente
	private function ValidateBooking(){
		
		if(!$this->GetUser()){
			throw new Exception('1001: The user field is empty');
			return false;
		}
		
		if(strlen($this->GetUser()) > 255){
			throw new Exception('1002: The user field is longer than 255 characters');
			return false;
		}
		
		if(!count($this->GetFoods())){
			throw new Exception('1003: The foods field is empty');
			return false;
		}
		
		if(!$this->GetDay()){
			throw new Exception('1004: The day field is empty');
			return false;	
		}
		
		return true;
		
	}
	
	
	//metodo per leggere le prenotazioni di un determinato giorno della settimana
	private function GetBookings()
	{
		global $DB;
		
		$where = "";
		$params = array();
		
		if($this->GetDay()){
			$where = " AND day = ?";
			$params[] = $this->GetDay();
		}
		
		return $DB->query('SELECT * FROM cc_bookings WHERE 1=1'.$where, $params)->fetchAll();
		
	}
	
	//metodo che ritorna un json delle prenotazioni di un determinato giorno della settimana
	public function GetBookingsJson()
	{
		
		return json_encode($this->GetBookings());
		
	}
	
	//metodo che ritorna un array delle prenotazioni di un determinato giorno della settimana
	public function GetBookingsArray()
	{
		
		return $this->GetBookings();
		
	}

}
?>