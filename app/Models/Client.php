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

    
    // protected function serializeDate(DateTimeInterface $date)
    // {
    //     return $date->format('d-m-Y h:m:s');
    // }
    
    // Get clients between dates and sort asc or desc by created_at or updated_at
    static function getClientsByDate($sortby = null, $sortmethod = null, $date_start = null, $date_end = null)
    {
        if($sortby != null && $sortmethod != null && $date_start != null && $date_end != null) {
            $date_start = $date_start.' 00:00:00';
            $date_end = $date_end.' 23:59:59';

            return Client::orderBy($sortby, $sortmethod)
                ->where($sortby, '>=', $date_start)
                ->where($sortby, '<=', $date_end)
                ->paginate(15);
        }else{
            return Client::orderBy('created_at', 'desc')
                ->paginate(15);
        }
    }
}
