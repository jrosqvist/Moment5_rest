<?php
// Anger JSON som filtyp och UTF-8 som teckenkodning
header("Content-Type: application/json");
// Tillåter åtkomst från samtliga domäner
header("Access-Control-Allow-Origin: *");
// TIllåter att metoderna POST, GET, DELETE och PUT används
header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT');

// Hämtar config-filen
include ("includes/config.php");
// Läser av vilken metod som skickats med i HTTP-anropet
$method = $_SERVER['REQUEST_METHOD'];
// Snyggar till sökvägen
$request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
// Läser av inmatat data och konverterar från JSON
$input = json_decode(file_get_contents('php://input'),true);
// Kollar om första elementet i sökvägen är courses
if($request[0] != "courses"){ 
	http_response_code(404);
	exit();
}
// Skapar en ny instans av klassen Course
$course = new Course;

// Switch-sats som kör kod beroende på vilken metod som skickats
switch ($method){
	case "GET":
	    // Hämtar alla kurser
	    $result = $course->getCourses();
		break;
	case "POST":
	    // Lägger till kurs med de fyra inskickade argumenten
	    $result = $course->addCourse($input['code'], $input['name'], $input['progression'], $input['syllabus']);
		break;
	case "DELETE":
	    // Tar bort en kurs, id:t plockas från det andra elementet i URL:en
	    $result = $course->deleteCourse($request[1]);
   		break;
	case "PUT":
	    // Uppdaterar en specifik kurs, som identifieras av id:t i URL:en
	    $result = $course->updateCourse($input['code'], $input['name'], $input['progression'], $input['syllabus'],$request[1]);
    	break;
}

    // Skapar en tom array
	$course_arr = [];
	// Loopar igenom resultatet från switch-satsen
    while($row = mysqli_fetch_assoc($result)){
			$course_item = array(
				'ID' => $row['ID'],
				'Code' => $row['Code'],
				'Name' => $row['Name'],
				'Progression' => $row['Progression'],
				'Syllabus' => $row['Syllabus']
			);
			// Lägger in resultaten i den tomma arrayen
			array_push($course_arr,$course_item);
	}
	// Konverterar till JSON och skriver ut arrayen
    echo json_encode($course_arr);
?>