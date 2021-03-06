<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * @method static create(array $newAdminMenu)
 * @method static updateOrCreate(array $backendMenu)
 */
class MenuItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'module',
        'icon',
        'type',
        'value',
        'target',
        'active_resolver',
        'status',
        'order',
        'menu_id',
        'created_by',
        'updated_by',
        'text_color',
        'bg_color',
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function iconName()
    {
        return $this->belongsTo(Fontawesome::class, 'icon');
    }

    public function createdUser()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedUser()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function scopeStatus($query)
    {
        return $query->where('status', 1);
    }

    protected static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub

        static::creating(function ($menuItem) {
            $menuItem->slug       = slug($menuItem->name);
            $menuItem->created_by = Auth::id() ?? 1;
            $menuItem->updated_by = Auth::id() ?? 1;
        });
        static::updating(function ($menuItem) {
            $menuItem->slug       = slug($menuItem->name);
        });
    }
}
