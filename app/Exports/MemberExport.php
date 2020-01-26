<?php
/*
    MemberExport
    Created By : Nagm Eldin Yousif
    Date: 23-1-2020
*/
namespace App\Exports;

use App\Member;
use Maatwebsite\Excel\Concerns\FromCollection;

class MemberExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Member::all();
    }
}
