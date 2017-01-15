<?php
namespace Helpers;
// Temp class.. will move these values to db
class Config 
{
	public static $EMAILS = array(
		'jasonrmajors@gmail.com', 
		'stephen.haney@gmail.com',
		'Noah.embrey@yahoo.com'
	);	

	public static $yesPhrases = array(
		"Totally",
		"I needed it",
		"Indubitably",
		"Henceforth, it shall be",
	);


	public static $noPhrases = array(
		'Agreed!',
		'Hilariously wrong!',
		'Not even close',
		"I wouldn't let my own maid have that",
		"It's not gluten free",

	);

	public static function getNoPhrase()
	{
		$length = count(self::$noPhrases);
		$index = rand(0, $length -1);

		return self::$noPhrases[$index];
	}

	public static function getYesPhrase()
	{
		$length = count(self::$yesPhrases);
		$index = rand(0, $length -1);

		return self::$yesPhrases[$index];
	}
}