<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Companies extends Model
{
	use SoftDeletes;

	protected $table = 'companies';

    protected $guarded = [];

    public function getLogoAttribute($logo)
    {
        // if (!$logo || starts_with($logo, 'http')) {
        //     return $logo;
        // }

        return Storage::disk(env('APP_DISK'))->url($logo);
    }
}
