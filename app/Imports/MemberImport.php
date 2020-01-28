<?php
/**********************
    File Name   : MemberImport.php
    Author Name : Nagm Eldin Yousif
    Created On  : 23-1-2020
***********************/
namespace App\Imports;

use App\Member;
use Maatwebsite\Excel\Concerns\ToModel;

class MemberImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Member([
            'name' => $row[1],
            'phone' => $row[2],
        ]);
    }

    public function rules(): array
    {
        return [
            '0' => 'required|string',
            '1' => 'required|string',
            '2' => 'required:numeric|max:9',
        ];
    }
}
