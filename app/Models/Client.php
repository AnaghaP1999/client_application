<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $table = 'clients';
    protected $fillable = [
        'id',
        'name',
        'category_id',
        'user_id'
    ];

    // Get All Client Details
    public function getClientDetails(int $perPage = null) {
        $clients = $this->select('clients.*', 'categories.name as category_name')
            ->leftjoin('categories', 'categories.id', '=', 'clients.category_id')
            ->paginate($perPage);
        
        return $clients;
    }

    // Get Client details By Id
    public function getClientById(int $id = null) {
        $clientDetails = $this->where('clients.id', $id)
            ->leftjoin('categories', 'categories.id', '=', 'clients.category_id')
            ->select('clients.*', 'categories.name as category_name')
            ->first();
        
        return $clientDetails;
    }
}
