<?php

namespace App\Imports;

use App\Models\PriceCode;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;

class PriceCodeImport implements ToModel
{

    public function collection(Collection $rows)
    {
        $data = [];

        foreach ($rows as $row) {
            if (count($row) < 38) {
                continue;
            }

            $data[] = [
                'Warehouse_Name' => $row[0] ?? null,
                "Item" => $row[1] ?? null,
                "Insurance" => $row[2] ?? null,
                "OrderType" => $row[3] ?? null,
                "PredefinedText" => $row[4] ?? null,
                "Billable_Price" => $row[5] ?? null,
                "AllowablePrice" => $row[6] ?? null,
                "Rental_Billable_Price" => $row[7] ?? null,
                "RentalAllowablePrice" => $row[8] ?? null,
                "RentalType" => $row[9] ?? null,
                "Bill_Billable_Code" => $row[10] ?? null,
                "DMNRX" => $row[11] ?? null,
                "modifier1" => $row[12] ?? null,
                "modifier2" => $row[13] ?? null,
                "modifier3" => $row[14] ?? null,
                "modifier4" => $row[15] ?? null,
                "PriorAuth" => $row[16] ?? null,
                "Quantity" => $row[17] ?? null,
                "Units" => $row[18] ?? null,
                "When" => $row[19] ?? null,
                "Converter" => $row[20] ?? null,
                "BQuantity" => $row[21] ?? null,
                "BUnits" => $row[22] ?? null,
                "BWhen" => $row[23] ?? null,
                "BConverter" => $row[24] ?? null,
                "DQuantity" => $row[25] ?? null,
                "DUnits" => $row[26] ?? null,
                "DWhen" => $row[27] ?? null,
                "DConverter" => $row[28] ?? null,
                "ReoccuringSale" => $row[29] ?? null,
                "AcceptAssignment" => $row[30] ?? null,
                "SpanDates" => $row[31] ?? null,
                "Taxable" => $row[33] ?? null,
                "DayDelivery" => $row[34] ?? null,
                "LastPeriod" => $row[35] ?? null,
                "BillPickUp" => $row[36] ?? null,
                "LastMonth" => isset($row[37]) ? $row[37] : null, // Use isset() for safety
            ];
        }

        DB::table('price_codes')->insert($data);
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
    return new PriceCode([
        'Warehouse_Name' => $row[0] ?? null,
        'Item' => $row[1] ?? null,
        'Insurance' => $row[2] ?? null,
        'OrderType' => $row[3] ?? null,
        'PredefinedText' => $row[4] ?? null,
        'Billable_Price' => $row[5] ?? null,
        'AllowablePrice' => $row[6] ?? null,
        'Rental_Billable_Price' => $row[7] ?? null,
        'RentalAllowablePrice' => $row[8] ?? null,
        'RentalType' => $row[9] ?? null,
        'Bill_Billable_Code' => $row[10] ?? null,
        'DMNRX' => $row[11] ?? null,
        'modifier1' => $row[12] ?? null,
        'modifier2' => $row[13] ?? null,
        'modifier3' => $row[14] ?? null,
        'modifier4' => $row[15] ?? null,
        'PriorAuth' => $row[16] ?? null,
        'Quantity' => $row[17] ?? null,
        'Units' => $row[18] ?? null,
        'When' => $row[19] ?? null,
        'Converter' => $row[20] ?? null,
        'BQuantity' => $row[21] ?? null,
        'BUnits' => $row[22] ?? null,
        'BWhen' => $row[23] ?? null,
        'BConverter' => $row[24] ?? null,
        'DQuantity' => $row[25] ?? null,
        'DUnits' => $row[26] ?? null,
        'DWhen' => $row[27] ?? null,
        'DConverter' => $row[28] ?? null,
        'ReoccuringSale' => $row[29] ?? null,
        'AcceptAssignment' => $row[30] ?? null,
        'SpanDates' => $row[31] ?? null,
        // Note: Ensure that this is intentional as "Insurance" is defined twice
        // If it's intentional, consider renaming one of them
        // For example:
        // "Insurance_2" => isset($row[32]) ? $row[32] : null,
        // Otherwise:
        // Remove one of them if not needed
        'Taxable' => $row[33] ?? null,
        'DayDelivery' => $row[34] ?? null,
        'LastPeriod' => $row[35] ?? null,
        'BillPickUp' => $row[36] ?? null,
        // Use isset() for safety on LastMonth
        'LastMonth' => isset($row[37]) ? $row[37] : null,
    ]);
}
}
