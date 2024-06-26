<?php

namespace App\Models;

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
    'fname',
    'lname',
    'email',
    'photo',
    'username',
    'password',
    'number',
    'city',
    'state',
    'address',
    'country',
    'billing_fname',
    'billing_lname',
    'billing_email',
    'billing_photo',
    'billing_number',
    'billing_city',
    'billing_state',
    'billing_address',
    'billing_country',
    'shpping_fname',
    'shpping_lname',
    'shpping_email',
    'shpping_photo',
    'shpping_number',
    'shpping_city',
    'shpping_state',
    'shpping_address',
    'shpping_country',
    'status',
    'verification_link',
    'email_verified',
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

  public function conversations()
  {
    return $this->hasMany('App\Models\Conversation');
  }

  public function orders()
  {
    return $this->hasMany('App\Models\ProductOrder');
  }

  public function order_items()
  {
    return $this->hasMany('App\Models\OrderItem');
  }

  public function courseOrder()
  {
    return $this->hasMany('App\Models\CoursePurchase');
  }

  public function course_reviews()
  {
    return $this->hasMany('App\Models\CourseReview');
  }

  public function donation_details()
  {
    return $this->hasMany('App\Models\DonationDetail');
  }

  public function event_details()
  {
    return $this->hasMany('App\Models\EventDetail');
  }

  public function package_orders()
  {
    return $this->hasMany('App\Models\PackageOrder');
  }

  public function product_reviews()
  {
    return $this->hasMany('App\Models\ProductReview');
  }

  public function tickets()
  {
    return $this->hasMany('App\Models\Ticket');
  }

    public function subscription() {
        return $this->hasOne('App\Models\Subscription');
    }
}
