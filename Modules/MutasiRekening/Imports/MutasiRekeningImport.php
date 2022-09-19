<?php

namespace Modules\MutasiRekening\Imports;

use Illuminate\Support\Collection;
use Illuminate\Support\Arr;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithMappedCells;
use PhpOffice\PhpSpreadsheet\Shared\Date as DateExcel;


use Maatwebsite\Excel\Imports\HeadingRowFormatter;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use App\Models\PublicTrxMutasiRekening;


HeadingRowFormatter::default('none');

class MutasiRekeningImport implements ToCollection, WithStartRow
{
    /**
     * @param array $row
     *
     * @return User|null
     */

    public $importResult = [];

    //protected $headingRow = 1;
    protected $startRow = 3;
    
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) 
        {
            $row[1] = DateExcel::excelToDateTimeObject($row[1])->format('Y-m-d');
            $row[3] = DateExcel::excelToDateTimeObject($row[3])->format('Y-m-d');

            $row[2] = DateExcel::excelToDateTimeObject($row[2])->format('H:i');
            $row[4] = DateExcel::excelToDateTimeObject($row[4])->format('H:i');

            $dataTobeSaved = PublicTrxMutasiRekening::firstOrNew(
                ['ref_no' => $row[9]],
                [
                    'post_date' => $row[1],
                    'post_time' => $row[2],
                    'eff_date' => $row[3],
                    'eff_time' => $row[4],
                    'description' => $row[5],
                    'debit' => $row[6],
                    'credit' => $row[7],
                    'balance' => $row[8]
                ]
            );

            if(!$dataTobeSaved->exists){
                $saveNew = $dataTobeSaved->save();
            }
        }
    }

    // public function headingRow(): int
    // {
    //     return $this->headingRow;
    // }

    public function startRow(): int
    {
        return $this->startRow;
    }
}