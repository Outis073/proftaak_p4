<?php

class Search extends Model
{
    
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

    
}