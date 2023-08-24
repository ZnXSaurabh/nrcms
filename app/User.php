<?php



namespace App;



use App\Models\Area;

use App\Models\Profile;

use App\Models\Location;

use App\Models\Complaint;

use Illuminate\Notifications\Notifiable;

use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Foundation\Auth\User as Authenticatable;



class User extends Authenticatable

{

    use Notifiable;



    /**

     * The attributes that are mass assignable.

     *

     * @var array

     */

    protected $fillable = [

        'name', 'email', 'mobileno', 'password', 'is_account_verified', 'is_mobile_verified',

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

    * @param string|array $roles

    */

    public function authorizeRoles($roles)

    {

        if (is_array($roles)) {

            return $this->hasAnyRoles($roles) || abort(401, 'This action is unauthorized.');

        }



        return $this->hasAnyRole($roles) || abort(401, 'This action is unauthorized.');

    }



    /**

    * Check multiple roles

    * @param array $roles

    */

    public function hasAnyRoles($roles)

    {

        return null !== $this->roles()->whereIn('slug', $roles)->first();

    }



    /**

    * Check one role

    * @param string $role

    */

    public function hasAnyRole($role)

    {

        return null !== $this->roles()->where('slug', $role)->first();

    }



    /**

    * Check one location

    * @param string $location

    */

    public function hasAnyLocation($location)

    {

        return null !== $this->locations()->where('id', $location)->first();

    }



    /**

    * Check one area

    * @param string $area

    */

    public function hasAnyArea($area)

    {

        return null !== $this->areas()->where('id', $area)->first();

    }



    /**

     * Check for permissions

     * @param array $permissions

     */

    public function hasAccess(array $permissions)

    {

        foreach ($this->roles as $role) {

            if ($role->hasAccess($permissions)) {

                return true;

            }

        }

        return false;

    }



    public function roles()

    {

        return $this->belongsToMany(Role::class);

    }



    public function locations()

    {

        return $this->belongsToMany(Location::class, 'location_user')->withPivot(['area_id']);

    }



    public function areas()

    {

        return $this->belongsToMany(Area::class, 'location_user');

    }



    public function profile()

    {

        return $this->hasOne(Profile::class);

    }



    public function complaints()

    {

        return $this->hasMany(Complaint::class);

    }

}

