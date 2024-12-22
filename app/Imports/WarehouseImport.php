<?php

namespace App\Imports;

use App\Models\Warehouse;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;


class WarehouseImport implements ToModel
{

    public function collection(Collection $rows)
    {
        $data = [];

        foreach ($rows as $row) {
            $data[] = [
                'Warehouse_Name' => $row[0],
                'Contact' => $row[1],
                'Address' => $row[2],
                'City' => $row[3],
                'State' => $row[4],
                'Zip' => $row[5],
                'Phone' => $row[6],
                'Phone2' => $row[7],
                'Fax' => $row[8],
            ];
        }
        DB::table('warehouses')->insert($data);
    }

    public function chunkSize(): int
    {
        return 2000; // Process 2000 rows at a time
    }

    // Batch insert for better performance
    public function batchSize(): int
    {
        return 1000; // Insert 1000 rows per batch
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        return new Warehouse([
            'Warehouse_Name' => $row[0],
            'Contact' => $row[1],
            'Address' => $row[2],
            'City' => $row[3],
            'State' => $row[4],
            'Zip' => $row[5],
            'Phone' => $row[6],
            'Phone2' => $row[7],
            'Fax' => $row[8],
        ]);
    }
}
