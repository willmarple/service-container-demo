<?php

namespace App\Models;

use App\Services\Stripe\Facades\Stripe;
use Illuminate\Database\Eloquent\Model;
use Sushi\Sushi;

class PaymentMethod extends Model
{
    use Sushi;

    protected static $customerId;

    public static function setCustomer($value)
    {
        self::$customerId = $value;

        return self::query();
    }

    public function getRows()
    {
        $data = Stripe::client()->paymentMethods->all([
            'customer' => self::$customerId,
            'type' => 'card',
        ])['data'];

        $paymentMethods = array_map(function ($item) {
            return [
                'payment_method_id' => $item['id'],
                'brand' => $item['card']['brand'],
                'last4' => $item['card']['last4'],
                'exp' => $item['card']['exp_month'] . '/' . $item['card']['exp_year'],
                'created_at' => $item['created'],
            ];
        }, $data);

        return $paymentMethods;
    }

   public function delete()
   {
       Stripe::client()->paymentMethods->detach(
           $this->payment_method_id
       );
       parent::delete();
   }
}
