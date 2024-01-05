<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Blog extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    public function incrementReadCount() {
        $this->reads++;
        return $this->save();
    }

    // khusus function nih hanya ada diclass Blog apabila mas mau ambil data sih blog nih tadi bisa aj 
    // bisa pke cara yg ak td klu mau
    // wait sbntr

    static function getBlog() {
        $return=DB::table('blogs')
        ->select("categories.name")
        ->join('categories','blogs.category_id','=','categories.id');
        return $return;
    }


}
