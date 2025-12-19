<?php

namespace App\Models;

use CodeIgniter\Model;

class BoomidariModel extends Model
{
    protected $table = 'boomidari_master';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'khatha_no',
        'pattadari_name',
        'father_name',
        'lp_no',
        'old_survey_no',
        'ul_pi_no',
        'boomi_swabhavamu',
        'boomi_upa_swabhavamu',
        'boomi_vargeekarana',
        'boomi_upa_vargeekarana',
        'lp_extent',
        'anubhava_swabhavamu',
        'phone_number',
        'remarks',
        'status'
    ];
}