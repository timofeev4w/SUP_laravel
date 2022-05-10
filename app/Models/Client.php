<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Client extends Model
{
    use HasFactory;

    protected $table = 'clients';

    protected $primary_key = 'id';

    protected $fillable = ['secondname', 'firstname', 'patronymic', 'email', 'phone', 'city_id', 'address'];

    public $timestamps =  true;

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    
    // Get clients between dates and sort asc or desc by created_at or updated_at or by city with paginate
    static function getClientsByDatePaginate($sortby = null, $sortmethod = null, $date_start = null, $date_end = null, $city = null)
    {
        if($sortby != null && $sortmethod != null && $date_start != null && $date_end != null) {
            $date_start = $date_start.' 00:00:00';
            $date_end = $date_end.' 23:59:59';
            if ($city == null) {
                return Client::orderBy($sortby, $sortmethod)
                    ->where($sortby, '>=', $date_start)
                    ->where($sortby, '<=', $date_end)
                    ->paginate(15)->withQueryString();
            }else{
                $city_id = City::where('name', $city)->first();

                if ($city_id != null) {
                    return Client::orderBy($sortby, $sortmethod)
                    ->where($sortby, '>=', $date_start)
                    ->where($sortby, '<=', $date_end)
                    ->where('city_id', $city_id->id)
                    ->paginate(15)->withQueryString();
                }else{
                    return null;
                }
            }
        }else{
            return Client::orderBy('created_at', 'desc')
                ->paginate(15)->withQueryString();
        }
    }

    // Get clients by date-start & date-end all for report
    static function getClientsByDate($date_start = null, $date_end = null)
    {
        if($date_start != null && $date_end != null) {
            $date_start = $date_start.' 00:00:00';
            $date_end = $date_end.' 23:59:59';
            $sortby = 'created_at';
            $sortmethod = 'asc';
            
            return Client::orderBy($sortby, $sortmethod)
                ->where($sortby, '>=', $date_start)
                ->where($sortby, '<=', $date_end)
                ->get();
        }
    }
}
