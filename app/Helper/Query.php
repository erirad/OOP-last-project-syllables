<?php

class Query
{
    private $select = [];
    private $from;
    private $where = [];

    public function from(string $table)
    {
        $this->from = $table;
    }

    public function select(string ...$fields)
    {
        $this->select = $fields;
    }

}