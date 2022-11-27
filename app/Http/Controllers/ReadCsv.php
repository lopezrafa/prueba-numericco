<?php

namespace App\Http\Controllers;

use App\Models\Premio;
use App\Models\premios;
use Illuminate\Http\Request;
use  Illuminate\Support\Str;

class ReadCsv extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $csvFile = public_path('documents\awards_list.csv');
        $values = $this->readCSV($csvFile, array('delimiter' => ','));
        $premios = [];
        $cantidades = [];
        
        for($i = 1; $i < count($values); $i++){
            array_push($cantidades, (int) $values[$i][1]);
            array_push($premios, $values[$i][0]);
        }

        foreach($premios as $premio){
                premios::create([
                    "premio" => $premio,
                    "code" => Str::random(8)
               ]);
        }

        return premios::all();

        return response('Ok!', 200);        
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
