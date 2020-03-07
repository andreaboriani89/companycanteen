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
			if($this->ValidateBooking()[0] == 200){
				
				//pulisco la stringa da caratteri non accettati dal mysql
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
	
	//metodo per validare i campi di input di una prenotazione di un utente
	private function ValidateBooking(){
		
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
		
		return array(200, "valori input validati");
		
	}
	
	
	//metodo per leggere le prenotazioni di un determinato giorno della settimana
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