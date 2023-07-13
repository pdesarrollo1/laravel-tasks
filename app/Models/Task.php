<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    //para que no se agreguen campos no deseados en nuestra tabla, hay que indicar cuáles son las propiedades deseadas (autorizadas) para crear el objeto. 
    // protected $fillable = [ 'name', 'description', 'categoria' ];
    // Si la cantidad de propiedades es mucha podemos optar por usar: 
    protected $guarded = [];
    // Podemos dejar el array vacío y aún así nos permitirá la asignación masiva. Esto guardas los campos que omitira
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
