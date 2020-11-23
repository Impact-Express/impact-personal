<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use League\Csv\Reader;

class Tariff extends Model
{
    public static function create($request)
    {
//        dd($request);
            $reader = Reader::createFromString(File::get($request->file('file')));
        $records = $reader->getRecords();
        $data = [];
        foreach ($records as $record) {

            if ($record[0] === "kg" || $record[0] === "Kg") continue;
            foreach ($record as $zone => $value) {
                if ($zone === 0) continue;
                $data[] = [
                    'weight' => $record[0],
                    'zone' => $zone,
//                    'documents' => $request->documents === "on" ? '1' : '0',
                    'amount' => round($record[$zone], 5),
                    'created_at' => now()->isoFormat('YYYY-M-D HH:mm:ss'),
                    'updated_at' => now()->isoFormat('YYYY-M-D HH:mm:ss')
                ];
            }
        }
        self::insert($data);
    }
}
