<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\withHeadingRow;
use Illuminate\Support\Facades\Validator;
use App\timestamp;
class timestampsimport implements ToCollection, WithHeadingRow
{
    use Importable;
    /**
    * @param Collection $collection
    */
    // public function collection(Collection $collection)
    // {
    //     //
    // }
    public function headingRow(): int
    {
        return 3;
    }
    public function collection(Collection $collection)
    {
        \Log::info($collection);
        \Log::info($collection->toArray());
        Validator::make($collection->toArray(), [
            '*.sap_id' => 'required'
        ])->validate();
            
        
     foreach($collection as $row)
     {
         timestamp::create([
             'id_card' => $row['id_card'],
             'sap_id' => $row['sap_id'],
             'full_name' => $row['full_name'],
             'date' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['date']),
             'time' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['time']),
             'reader' => $row['reader'],
             'come_in' => $row['come_in'],
             'door' => $row['door'],
         ]);
     }
    }
}
