<?php
namespace App\Helper;

class Query {

    private static $instance = NULL;

    public static function sql()
    {
        self::$instance = new self();
        return self::$instance;
    }

    public function select(string $select_options = "*")
    {
        $query_part = "SELECT ".$select_options;
        $this->select = $query_part;

        return $this;
    }

    public function update(string $table_name)
    {
        $query_part = "UPDATE ".$table_name;
        $this->update = $query_part;

        return $this;
    }

    public function insert(string $table_name)
    {
        $query_part = "INSERT INTO ".$table_name;
        $this->insert = $query_part;

        return $this;
    }

    public function delete(string $table_name)
    {
        $query_part = "DELETE ".$table_name;
        $this->insert = $query_part;

        return $this;
    }

    public function from(string $from_options)
    {
        $query_part = "FROM ".$from_options;
        $this->from = $query_part;

        return $this;
    }

    public function set(string $set_options)
    {
        $query_part = "SET ".$set_options;
        $this->set = $query_part;

        return $this;
    }

    public function where(string $where_options)
    {
        $query_part = "WHERE ".$where_options;
        $this->where = $query_part;

        return $this;
    }

    // GroupBy
    public function groupBy(string $group_options)
    {
        $query_part = "groupBy ".$group_options;
        $this->groupBy = $query_part;
        return $this;
    }



    public function get()
    {
        $array = (array)$this;
        $string = implode(" ", $array);

        return $string;
    }

}

// Use class DB
$query = Query::sql()
    ->select("name, surname, age")
    ->from("cmi")
    ->where("id = 10500")
    ->get();

$query2 = Query::sql()
    ->update("cmi")
    ->set("name = 'Karolina', surname = 'Valkomina'")
    ->where("id = 10500")
    ->get();

$query3 = Query::sql()
    ->select()
    ->from("cmi")
    ->get();

$query4 = Query::sql()
    ->delete("cmi")
    ->where("id = '16005'")
    ->get();

echo $query4;

