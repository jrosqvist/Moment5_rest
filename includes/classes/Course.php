<?php
class Course {
    private $db;

    // Konstruerare som skapar en databasanslutning
    function __construct (){
        // Skapar en databasanslutning - använder konstanter från config.php
        $this->db = mysqli_connect(HOST, USERNAME, PASSWORD, DBNAME) or die('Fel vid anslutning');
    }

    // Hämtar alla kurser och returnerar dem
    function getCourses () {
        $sql = "SELECT ID, Code, Name, Progression, Syllabus FROM Courses";
        $result = mysqli_query($this->db, $sql) or die ('Fel vid SQL-fråga');
        return $result;
    }

    // Lägger till kurser med 4 parametrar
    function addCourse ($code, $name, $progression, $syllabus){
        $sql = "INSERT INTO Courses(code, name, progression, syllabus) 
        VALUES('$code', '$name', '$progression', '$syllabus')";
        $result = mysqli_query($this->db, $sql) or die('Fel vid SQL-fråga');
        return $result;
    }

    // Uppdaterar en kurs med ID:t som identifierare
    function updateCourse ($code, $name, $progression, $syllabus, $id) {
        $sql = "UPDATE Courses SET code = '$code', name = '$name', 
        progression = '$progression', syllabus = '$syllabus'
        WHERE ID = $id";
        $result = mysqli_query($this->db, $sql) or die('Fel vid SQL-fråga');
        return $result;
    }

    // Raderar en kurs med ID:t som identifierare
    function deleteCourse ($id) {
        $sql = "DELETE FROM Courses WHERE ID = " . $id . ";";
        $result = mysqli_query($this->db, $sql) or die ('Fel vid SQL-fråga');
        return $result;
    }

}