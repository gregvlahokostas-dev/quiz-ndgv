<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizAttempt extends Model {
    protected $fillable = ['user_id','score','total_questions','duration_seconds','category_ids'];
    protected $casts = ['category_ids' => 'array'];
    public function answers() { return $this->hasMany(AttemptAnswer::class); }
    public function user() { return $this->belongsTo(User::class); }
}
