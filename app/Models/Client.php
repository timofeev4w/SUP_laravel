<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \DateTimeInterface;

class Client extends Model
{
    use HasFactory;

    protected $table = 'clients';

    protected $primary_key = 'id';

    protected $fillable = ['secondname', 'firstname', 'patronymic', 'email', 'phone'];

    public $timestamps =  true;

    
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('d-m-Y h:m:s');
    }
}
