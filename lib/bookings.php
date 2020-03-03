<?php 
//classe per gestire le prenotazioni alla mensa aziendale
class Bookings
{
	
	private $user;
	private $foods;
	private $day;

	public function __construct($user, $foods, $day)
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
	
	public function AddBooking()
	{
		global $DB;
		
		//se i campi di input sono stati correttamente inseriti allora aggiungo la prenotazione
		if($this->ValidateBooking()){
			
			$user = $DB->real_escape_string($this->GetUser());
		
			foreach($this->GetFoods() as $foodid){
				$DB->query('INSERT INTO cc_bookings (user,foodid,time) VALUES (?,?,?)', $user, $foodid, $this->GetDay());
			}
		
		}
		
	}
	
	//metodo per validare i campi di input di una prenotazione di un utente
	private function ValidateBooking(){
		
		if(!$this->GetUser()) return false;
		
		if(!count($this->GetFoods())) return false;
		
		if(!$this->GetDay()) return false;	
		
		return true;
		
	}

}
?>