<?php

namespace App\Http\Controllers;
use  Illuminate\Support\Str;

use Illuminate\Http\Request;

class PremiosController extends Controller
{
    public function addPremio(){
        $csvFile = public_path('documents\awards_list.csv');
        $values = $this->readCSV($csvFile, array('delimiter' => ','));
        $cantidades = [];

        for($i = 1; $i < count($values); $i++){

            array_push($cantidades, $values[1]);
            dd($cantidades);
            $premios = [
                "premio" => $values[0],
                "code" => Str::random(8)

            ];
        }

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
