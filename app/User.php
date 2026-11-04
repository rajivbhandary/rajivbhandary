<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'about',
        'image',
        'phone_number',
        'facebook_id',
        'instagram_id',
        'twitter_id',
        'behance_id',
        'youtube_id',
        'linked_in_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * HELPER METHODS
     */

    public function deleteImage()
    {
        Storage::delete($this->image);
    }
    public function isAdmin()
    {
        return $this->role === "admin";
    }

    public function isSuperAdmin()
    {
        return $this->role === "super-admin";
    }

    public function isAuthor(){
        return $this->role === 'author';
    }

    /**
     * RELATIONSHIP FUNCTIONS
     */
    public function blogs() {
        return $this->hasMany(Blog::class);
    }

    /**
     * ACCESSORS
     */
    public function getAvatarAttribute(){
        $size = 128;
        $name = $this->name;
        return "https://ui-avatars.com/api/?name={$name}&rounded=true&size={$size}";
    }
    public function getNameInitialsAttribute(){
        $initials = "";
        $nameParts = explode(' ', $this->name);
        foreach($nameParts as $namePart){
            $initials .= strtoupper($namePart[0]);
        }
        return $initials;
    }

    /**
     * SCOPE QUERIES
     */

    public function scopeSearch($query, $searchValue)
    {
        if ($searchValue) {
            return $query->where(function ($q) use ($searchValue) {
            $q->where('name', 'like', "%{$searchValue}%")->orWhere('email', 'like', "%{$searchValue}%")->orWhere('phone_number', 'like', "%{$searchValue}%")->orWhere('role', 'like', "%{$searchValue}%");
        });
        }
        return $query;
    }

    public function scopeOrder($query, $orderBy)
    {
        if ($orderBy) {
            $columns = ["sr_no", "image", "name", "email", "phone_number", "about", "role", "actions"];
            return $query->orderBy($columns[$orderBy[0]['column']], $orderBy[0]['dir']);
        }
        return $query;
    }

    public function scopeLimitBy($query, $start, $length)
    {
        if ($length != -1) {
            return $query->offset($start)->limit($length);
        }
        return $query;
    }

    public function scopeAdmins($query)
    {
        return $query->where(function ($q) {
            $q->where('role', 'like', "admin")->orWhere('role', 'like', "super-admin");
        });
    }
}
