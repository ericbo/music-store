<?php
session_start();
header('Content-type:application/json;charset=utf-8');

//Include the database functions
$dir = dirname(__FILE__);
include_once($dir . "/../functions/database_functions.php");

validateCart();

//Ensure required args are given.
if(isset($_GET['function']) && isset($_GET['id'])) {

	$beatID = $_GET['id'];

	//Branch on the function name.
	switch ($_GET['function']) {
		case 'add':
			if(isset($_GET['exclusive']))
				addToCart($beatID, (boolean) $_GET['exclusive']);
			else
				addToCart($beatID);
			break;

		//Remove from cart functionality
		case 'remove':
				removeFromCart($beatID);
			break;

		//Bad request
		default:
			http_response_code(400);
			break;
	}
}

echo (isset($_SESSION['cart']) ? json_encode($_SESSION['cart']) : '[]');

/*
* Checks if changes have been made to the database since the last cart query. If changes have
* been made update the cart. Also initializes the cart if it is the users first time interacting with it.
*/
function validateCart() {
	//Check if the cart is empty, otherwise validation is not needed
	if(isset($_SESSION['cart']) && count($_SESSION['cart'])) {
		//Check if changes have been made to the database since the last cart interaction.
		if(isset($_SESSION['checksum']) && $_SESSION['checksum'] !== checksum_beats())
		{
			foreach ($_SESSION['cart'] as $key => $value) {

				$updatedBeat = get_beat($value['beatID']);
				if(!$updatedBeat)
					unset($_SESSION['cart'][$key]);
				else
					$_SESSION['cart'][$key] = $updatedBeat;
			}
		}
	} else if (empty($_SESSION['cart'])) {
		$_SESSION['cart'] = array();
	}
	$_SESSION['checksum'] = checksum_beats();
}

function addToCart($id, $exclusive = false) {
	if($exclusive != false)
		$exclusive = true;

	if(isset($_SESSION['cart']) && id_in_cart($id) == -1)
		{
			$beat = get_beat($id);

			if(!$beat)
				http_response_code(400);
			else
			{
				$beat['exclusive'] = $exclusive;
				array_push($_SESSION['cart'], $beat);
				http_response_code(201);
			}
		}
	elseif(empty($_SESSION['cart']))
		{
			$beat = get_beat($id);

			if(!$beat)
				http_response_code(400);
			else
			{
				$beat['exclusive'] = $exclusive;
				array_push($_SESSION['cart'], $beat);
				http_response_code(201);
			}
		}
	else {
		http_response_code(200);
	}
}

function removeFromCart($id) {
	if(isset($_SESSION['cart']))
	{
		$cartId = id_in_cart($id);
		if($cartId >= 0)
		{
			unset($_SESSION['cart'][$cartId]);
			http_response_code(201);
		}
		else
			http_response_code(200);
	}
	else
		http_response_code(200);
}

function id_in_cart($id) {
	foreach ($_SESSION['cart'] as $key => $item) {
		if($item['beatID'] === $id)
			return $key;
	}
	return -1;
}