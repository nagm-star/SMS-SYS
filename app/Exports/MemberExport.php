<?php
/**********************
    File Name   : MemberExport.php
    Author Name : Nagm Eldin Yousif
    Created On  : 23-1-2020
***********************/
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
