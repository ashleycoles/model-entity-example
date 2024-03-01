<?php


require_once 'src/Entities/Adult.php';

// Model
// The responsibility of a model is handle all database queries for a given database table.
// We take all of our queries that relate to the adults table, and put them in this model.
// - It's more organised - you know that if you need to query a given table, you go to it's respective model.
// - We hide the yucky queries behind nicely named methods - see index.php
//
class AdultModel {
    // The model needs a database connection in order to do it's job of querying the database
    private PDO $db;
    // We use a constructor to pass a DB connection into the model
    // $adultsModel = new AdultsModel($db);
    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    // We create a new method within the model for each database query we might need

    /**
     * Get all adults out of the database
     *
     * This is a special comment that tells PHPStorm that getAllAdults will return an array containing
     * Adult objects
     * @return Adult[]
     */
    public function getAllAdults(): array
    {
        // The queries are exactly the same as before - but we need to use $this->db
        // to access the database connection
        $query = $this->db->prepare('SELECT * FROM `adults`;');
        $query->execute();
        $data = $query->fetchAll();

        // Hydrating
        // We are hydrating Adult entities with the data we got back from the query
       return $this->hydrateMultipleAdults($data);
    }

    /**
     * Gets a single adult out of the database by ID
     */
    public function getAdultById(int $id): Adult
    {
        $query = $this->db->prepare('SELECT * FROM `adults` WHERE `id` = :id');
        $query->execute([
            ':id' => $id
        ]);
        $data = $query->fetch();

        // Hydrating
        // We are hydrating an Adult entity with the data we got back from the query
        return $this->hydrateSingleAdult($data);
    }

    /**
     * Converts a single adult into an Adult entity
     * Use this when your SELECT query does fetch()
     */
    private function hydrateSingleAdult(array $data): Adult{
        return new Adult($data['id'], $data['name'], $data['DOB'], $data['pet_name']);
    }

    /**
     * Converts an array of multiple adults into an array of Adult entities
     * Use this when your SELECT query does fetchAll()
     *
     * @return Adult[]
     */
    private function hydrateMultipleAdults(array $data): array
    {
        $adults = [];
        foreach ($data as $adult) {
            $adults[] = $this->hydrateSingleAdult($adult);
        }
        return $adults;
    }
}