<?php

// Entity
// The responsibility of an entity is to represent a single row from our database
// It just contains data - nothing else
// We cannot reliably pass generic arrays around our program
// But we can reliably pass around specific objects, see the example function below
//
//function displayAdult(Adult $adult): string {
//    $output = '<ul>';
//    $output .= '<li>' . $adult->name . '</li>';
//    $output .= '<li>' . $adult->pet_name . '</li>';
//    $output .= '</ul>';
//    return $output;
//}

// Not a bad idea to make an entity readonly, this way we know that whenever we're dealing
// with an Adult object, it accurately reflects the data in the database
readonly class Adult {
    // We create properties to represent the columns in the database
    public int $id;
    public string $name;
    public string $dob;
    public ?string $pet_name;

    // We create a constructor so that we can pass data into the object
    public function __construct(int $id, string $name, string $dob, ?string $pet_name)
    {
        $this->id = $id;
        $this->name = $name;
        $this->dob = $dob;
        $this->pet_name = $pet_name;
    }
}
