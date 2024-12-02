<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Status extends Model
{
//    use HasFactory;

    protected $table = 'status';
    protected $fillable = ['status', 'descricao'];
    public $timestamps = false;

    public function pessoas() : HasMany
    {
        return $this->hasMany(Pessoa::class);
    }
}
