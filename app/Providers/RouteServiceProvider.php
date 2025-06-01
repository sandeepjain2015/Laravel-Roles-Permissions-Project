<?php 
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;

public function boot()
{
    parent::boot();

    Route::model('permission', Permission::class);
}
