<?php

class Search extends Model
{
    protected string $id;
    protected string $term;
    protected string $date;

    public function __construct(string $id = "", string $term = '', string $date = '')
    {
        $this->id = $id;
        $this->term = $term;
        $this->date = $date;
    }

    public static function getSearchResults($search)
    {
        $pdo = DB::connect();

        $stmt = $pdo->prepare('CALL spsearch(:search)');

        $stmt->execute([
            ':search' => $search
        ]);

        $searchResults = $stmt->fetchAll();

        return $searchResults;
    }

    public static function getFailedSearches()
    {
        $pdo = DB::connect();

        $stmt = $pdo->prepare('CALL SPGetFailedSearches()');
        $stmt->execute();

        $failureArray = [];

        $failedSearches = $stmt->fetchAll();

        foreach($failedSearches as $failure)
        {
            array_push($failureArray, new Search($failure['id'], $failure['term'], $failure['date']));
        }        
        return $failureArray;
    }

    public function removeSearch()
    {
        $pdo = DB::connect();

        $stmt = $pdo->prepare('CALL SPRemoveSearch(:id)');
        $stmt->execute([
            ':id' => $this->id
        ]);
    }


    
}