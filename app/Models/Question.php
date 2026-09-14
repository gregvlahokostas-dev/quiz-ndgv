<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model {
    protected $fillable = ['category_id','text','options','correct_index','external_id','number'];
    protected $casts = ['options' => 'array'];
    public function category() { return $this->belongsTo(Category::class); }
}
