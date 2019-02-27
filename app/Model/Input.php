<?php
namespace App\Model;

use App\Helper\Query;
use App\Helper\DB;

class Input extends Query
{
    private $table_name = "input";

    public function takeInputResultFromDB($word)
    {
        $query = DB::sql()
            ->select("syllables_result")
            ->from($this->table_name)
            ->where("word = ?")
            ->get();
        $stmt = $this->connect->prepare($query);
        $stmt->execute([$word]);
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    public function insertInputWithHyphenatedResultToDB($word, $result)
    {
           $data = $this->takeInputResultFromDB($word);
            if(!$data){
                $query = DB::sql()
                    ->insert($this->table_name)
                    ->set("word = ?, syllables_result = ?")
                    ->get();
                $stmt = $this->connect->prepare($query);
                $stmt->execute([$word, $result]);
            }
    }

    public function read()
    {
        $query = DB::sql()
            ->select()
            ->from($this->table_name)
            ->get();
        $stmt = $this->connect->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $result;
    }

    public function update($id, $word, $syllables_result)
    {
        $query = DB::sql()
            ->update($this->table_name)
            ->set("word = ?, syllables_result = ?")
            ->where("id = ?")
            ->get();
        $stmt = $this->connect->prepare($query);
        $updated = $stmt->execute([$word, $syllables_result, $id]);

        return $updated;
    }

    public function delete($id)
    {
        $query = DB::sql()
            ->delete($this->table_name)
            ->where("id = ?")
            ->get();
        $stmt = $this->connect->prepare($query);
        $deleted = $stmt->execute([$id]);

        return $deleted;
    }

    public function create($word, $syllables_result)
    {
        $query = DB::sql()
            ->insert($this->table_name)
            ->set("word = ?, syllables_result = ?")
            ->get();
        $stmt = $this->connect->prepare($query);
        $created = $stmt->execute([$word, $syllables_result]);

        return $created;
    }

    public function insertMatchesWithPatternsAndWord($word, $pattern)
    {
        $query = "INSERT INTO syllables (word_id, pattern_id) VALUES (:word, (SELECT name from patterns where name =:pattern))";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(':word', $word);
        $stmt->bindParam(':pattern', $pattern);
        $stmt->execute();
    }
}