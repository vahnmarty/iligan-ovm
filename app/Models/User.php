<?php

namespace App\Models;

use Str;
use App\Traits\HasUuid;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;
use Spatie\ModelStatus\HasStatuses;
use Laravel\Jetstream\HasProfilePhoto;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;
    use HasUuid;
    use HasStatuses;


    const ADMIN = 'admin';
    const USER_ROLE = 'user';

    const PENDING_APPROVAL = 'PENDING_APPROVAL';
    const PAYMENT_PENDING = 'PAYMENT_PENDING';
    const PAYMENT_PARTIAL = 'PARTIAL_PAYMENT';
    const PAYMENT_ACCEPTED = 'PAYMENT_ACCEPTED';
    const REGISTRATION_COMPLETED = 'REGISTRATION_COMPLETED';
    const SUSPENDED = 'SUSPENDED';
    const DISABLED = 'DISABLED';


    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function person()
    {
        return $this->hasOne(Person::class);
    }

    public function wallet()
    {
        return $this->hasOne(Wallet::class);
    }

    public function balance()
    {
        return $this->wallet->current_balance;
    }

    public function readyForReview()
    {
        self::setStatus(self::PENDING_APPROVAL);

        // Notify Approving Officer.
    }

    public function topup($amount, Transaction  $transaction)
    {
        $wallet = $this->wallet;

        if(!$wallet)
        {
            $wallet = $this->wallet()->create([
                'previous_balance' => 0,
                'current_balance' => 0
            ]);
        }

        $wallet->credit($amount, $transaction);

        return $wallet;
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function paymentStatus()
    {
        $paid = false;
        $product = Product::whereCode(Transaction::REGISTRATION)->first();

        if( count($this->transactions) > 0 )
        {
            foreach($this->transactions()->paid()->get() as $transaction)
            {
                foreach($transaction->items as $item)
                {
                    if($item->product_id == $product->id)
                    {
                        return true;
                        break;
                    }
                }
            }
        }

        return $paid;
    }

    public function labelStatus()
    {
        return $this->tailwind_color_from_status($this->status);
    }

    public function tailwind_color_from_status($status)
    {
        if(in_array($status, [self::REGISTRATION_COMPLETED]))
        {
            return 'success';
        }

        if(in_array($status, [self::PAYMENT_PENDING]))
        {
            return 'warning';
        }

        if(in_array($status, [self::PENDING_APPROVAL]))
        {
            return 'soft_warning';
        }

        return 'default';
    }


    public function generateUsername()
    {
        return Str::lower($this->person->first_name . '.' . $this->person->last_name . $this->id);
    }

    public function isApproved()
    {
        return $this->approved_at;
    }

    public function scopeRegistrants($query)
    {
        return $query->role(User::USER_ROLE)->whereNull('approved_at');
    }

    public function scopeMembers($query)
    {
        return $query->role(User::USER_ROLE)->whereNotNull('approved_at');
    }
    
}
