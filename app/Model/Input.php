<?php
namespace App\Model;

use App\Helper\Database;

class Input extends Database
{
    private $table_name = "cmi";
    public $id;
    public $word;
    public $syllables_result;

    public function checkIfInputExistInDb($word)
    {
        $data = $this->connect->query("SELECT syllables_result FROM cmi where word = '$word'")->fetch();
        return $data;
    }

    public function insertWordsFromCmiIntoTableWithResult($word, $result)
    {
           $data = $this->checkIfInputExistInDb($word);
            if(!$data){
                $query = "INSERT INTO cmi (word, syllables_result) VALUES ('$word', '$result')";
                $this->connect->exec($query);
            }
    }

    public function insertMatchesWithPatternsAndWord($word, $pattern)
    {
        $query = "INSERT INTO syllables (word_id, pattern_id) VALUES ('$word', '$pattern')";
        //$query = "INSERT INTO syllables (word_id, pattern_id) VALUES ((SELECT word from cmi where word=':word'), (SELECT name from patterns where name=':pattern'))";
        //  $stmt = $this->connect->prepare($query);
        //$stmt->execute(["word" => $word, ])
        $this->connect->exec($query);
    }

    public function read()
    {
        $query = "SELECT id, word, syllables_result FROM cmi";
        $stmt = $this->connect->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $result;
    }

    public function update($id, $word, $syllables_result)
    {

        $query = "UPDATE cmi SET word='$word', syllables_result='$syllables_result' WHERE id='$id'";
        $stmt = $this->connect->prepare($query);
        $updated = $stmt->execute();

        return $updated;
    }

    public function delete($id)
    {
        $query = "DELETE FROM cmi WHERE id=".$id;
        $stmt = $this->connect->prepare($query);
        $deleted = $stmt->execute();

        return $deleted;
    }

    public function create($word, $syllables_result)
    {
        $query= "INSERT INTO cmi SET word='{$word}', syllables_result='{$syllables_result}'";
        $stmt = $this->connect->prepare($query);
        $created = $stmt->execute();

        return $created;
    }


}