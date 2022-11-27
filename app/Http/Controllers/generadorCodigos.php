<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class generadorCodigos extends Controller
{

    public function handle(){

        dd("hola");
        $csvFileName = "awards_list.csv";
        $csvFile = public_path('public\documents\awards_list.csv' . $csvFileName);
        $this->readCSV($csvFile,array('delimiter' => ','));
    }


    public function readCSV($csvFile, $array)
    {
        $file_handle = fopen($csvFile, 'r');
        while (!feof($file_handle)) {
            $line_of_text[] = fgetcsv($file_handle, 0, $array['delimiter']);
        }
        fclose($file_handle);
        return $line_of_text;
    }
}
