<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppModel extends Model
{
    use HasFactory;

    const ACTIVE = 1;
    const INACTIVE = 2;

    public function changeStatusModel($request) {
        $model = $this->find($request->id);
        $model->status = $request->status;
        $data = $model->save();

        return $data;
    }

    public function takeAll() 
    {
        return $this->all();
    }
}
