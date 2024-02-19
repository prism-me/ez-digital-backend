<?php


namespace App\Services;

use Illuminate\Support\Facades\Hash;

use App\Models\Address;
use App\Models\User;
use auth;

use DB;

class UserService
{
    public function update($data)
    {
        $user = User::where('id', $data['user_id'])->first();
        unset($data['user_id']);
        unset($data['email']);
        if ($user->exists()) {
            //                    if (!empty($data['password'])) {
            //
            //                        $data['password'] = bcrypt($data['changed_password']);
            //
            //                        $isUserUpdated = $user->update($data);
            //
            //                    } else {

            $isUserUpdated = $user->update($data);

            //}
            if ($isUserUpdated) {

                echo json_encode(['message' => 'Data Updated successfully.']);
            } else {
                echo json_encode(['message' => 'Wrong Information']);
            }
        } else {

            echo json_encode(['message' => 'User doesnot exist']);
        }
    }

    public function changePassword($data)
    {

        $user = User::where('id', $data['user_id'])->first();
        if ($user->exists()) {
            $password = Hash::check($data['change_password'], $user['password']);
            $currentPassword = Hash::check($data['password'], $user['password']);

            if ($currentPassword == 1) {

                if ($password == 1) {

                    return response()->json(['message' => 'Current Password and New Password cannot be same', 'status' => 404]);
                } else {

                    $update['password'] = bcrypt($data['change_password']);
                    unset($data['user_id']);
                    unset($data['change_password']);
                    unset($data['confirm_password']);

                    $isUserUpdated = User::where('email', $user['email'])->update($update);

                    if ($isUserUpdated) {

                        return response(['message' => 'Password Updated successfully.', 'status' => 200]);
                    } else {

                        return response(['message' => 'Wrong Information', 'status' => 404]);
                    }
                }
            } else {

                return response(['message' => 'Wrong Current Password', 'status' => 404]);
            }
        } else {

            return response(['message' => 'User doesnot exist', 'status' => 404]);
        }
    }




    public function createAddress($data, $user_id)
    {
        $address = Address::where('user_id', $user_id)
            ->where('city', $data['city'])
            ->where('state', $data['state'])
            ->where('phone_number', $data['phone'])
            ->where('address_line1', $data['line1'])
            ->first();

        if (!$address) {
            $address = Address::create([
                'user_id' => $user_id,
                'name' => $data['name'],
                'country' => $data['country'],
                'state' => $data['state'],
                'city' => $data['city'],
                'address_line1' => $data['line1'],
                'address_line2' => $data['line2'],
                'postal_code' => $data['postal_code'],
                'phone_number' => $data['phone'],
                'default' => 1,
                'address_type' => 'billing'
            ]);
        }
        return $address;
    }

    public function updateProfile($data)
    {

        $user = User::where('id', $data['user_id'])->first();
        if ($user) {

            $update = [
                'name' => isset($data['name']) ? $data['name'] : $user['name'],
                'mobile' => isset($data['mobile']) ? $data['mobile'] : $user['mobile'],
            ];
            unset($data->created_at);
            unset($data->user_id);
            unset($data->email);
            $isUserUpdated = $user->update($update);
            return response()->json(['message' => 'Profile Updated Successfully', 'status' => 200]);

        } else {

            return response()->json(['message' => 'User doesnot exist', 'status' => 404]);
        }
    }
}