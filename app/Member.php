<?php
/**********************
    File Name   : Member.php
    Author Name : Nagm Eldin Yousif
    Created On  : 23-1-2020
***********************/
namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = [
        'name','phone','group_id'
    ];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }
}
