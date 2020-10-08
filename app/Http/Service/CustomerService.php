<?php


namespace App\Http\Service;


use App\Customer;

class CustomerService{

    public function saveCustomerDetails($customerRequest) {
        $user = auth()->user();
        $customer = Customer::whereUserId($user->id)->first();
        if ($customer == null) $customer = $this->createNewCustomer();

        $customer->car_make = $customerRequest['car_make'];
        $customer->car_model = $customerRequest['car_model'];
        $customer->address = $customerRequest['address'];
        $customer->working_hour = $customerRequest['working_hour'];
        $customer->occupation = $customerRequest['occupation'];
        $customer->insurance_policy = $customerRequest['insurance_policy'];
        $customer->preferred_driving_city = $customerRequest['preferred_driving_city'];
        $customer->driver_class_type = $customerRequest['driver_class_type'];

        if (!in_array($customer->driver_class_type, ['a', 'b', 'c'])) {
            return false;
        }

        if (!in_array($customer->working_hour, ['7am - 5pm', '6:30am - 6pm', '7:30am - 7pm'])) {
            return false;
        }

        $customer->save();
        return true;
    }

    public function createNewCustomer() {
        $user = auth()->user();
        $customer = new Customer();
        $customer->user_id = $user->id;

        return $customer;
    }
}
