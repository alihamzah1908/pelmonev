<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ComBank
 *
 * @property string $bank_cd
 * @property string $bank_nm
 * @property string|null $created_by
 * @property string|null $updated_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ComBank newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ComBank newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ComBank query()
 * @method static \Illuminate\Database\Eloquent\Builder|ComBank whereBankCd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ComBank whereBankNm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ComBank whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ComBank whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ComBank whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ComBank whereUpdatedBy($value)
 * @mixin \Eloquent
 */
class ComBank extends Model{
    protected $table      = 'com_bank';
    protected $primaryKey = 'bank_cd'; 
    public $incrementing  = false;

    protected $fillable = [
        'bank_cd', 'bank_nm', 'note', 'created_by', 'updated_by'
    ];
}
