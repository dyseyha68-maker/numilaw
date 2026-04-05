<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
        'bio',
        'bio_km',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function articles()
    {
        return $this->hasMany(Article::class, 'author_id');
    }

    public function facultyProfile()
    {
        return $this->hasOne(Faculty::class);
    }

    public function organizedEvents()
    {
        return $this->hasMany(Event::class, 'organizer_id');
    }

    public function eventReports()
    {
        return $this->hasMany(EventReport::class, 'author_id');
    }

    public function supervisedProjects()
    {
        return $this->hasMany(Project::class, 'supervisor_id');
    }

    public function ledProjects()
    {
        return $this->hasMany(Project::class, 'leader_id');
    }

    public function alumni()
    {
        return $this->hasOne(Alumni::class);
    }

    public function organizedAlumniEvents()
    {
        return $this->hasMany(AlumniEvent::class, 'organizer_id');
    }

    public function verifiedDonations()
    {
        return $this->hasMany(AlumniDonation::class, 'verified_by');
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isFaculty()
    {
        return $this->role === 'faculty';
    }

    public function isStaff()
    {
        return $this->role === 'staff';
    }

    public function getBioWithLocaleAttribute()
    {
        return app()->getLocale() === 'km' && $this->bio_km ? $this->bio_km : $this->bio;
    }

    public function isAlumni()
    {
        return $this->role === 'alumni' || $this->alumni !== null;
    }
}
