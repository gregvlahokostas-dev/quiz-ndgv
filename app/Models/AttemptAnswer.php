<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttemptAnswer extends Model {
    protected $fillable = ['quiz_attempt_id','question_id','selected_index','is_correct'];
    public function question() { return $this->belongsTo(Question::class); }
}
