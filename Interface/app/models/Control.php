<?php

class Control extends \Eloquent {

    protected $table = 'controls';

    protected $fillable = [
        'sensors_id',
        'value',
        'status'
    ];


}