<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        if ($request->isMethod('GET')) {
            return view('auth.register');
        }

        $payload = $request->all();
        $rules = [
            'email' => ['required', 'string', 'max:255', 'email', Rule::unique('users')],
            'password' => ['required', 'string', 'min:6', 'max:255'],
            'password_confirm' => ['required', 'string', 'same:password'],
            'name' => ['required', 'string', 'max:255'],
            'is_male' => ['required'],
            'date_of_birth' => ['required', Rule::date()->beforeOrEqual(today())],
            'height' => ['required', 'numeric', 'between:1,999.99'],
            'weight' => ['required', 'numeric', 'between:1,999.99'],
        ];
        $messages = [
            'email.required' => 'Email là trường bắt bắt buộc',
            'email.string' => 'Email không hợp lệ',
            'email.max' => 'Email không được dài quá :max kí tự',
            'email.email' => 'Email không hợp lệ (name@example.com)',
            'email.unique' => 'Email đã được sử dụng bởi 1 người dùng khác',
            'password.required' => 'Mật khẩu là trường bắt buộc',
            'password.string' => 'Mật khẩu không hợp lệ',
            'password.min' => 'Mật khẩu phải có ít nhất :min kí tự',
            'password_confirm.required' => 'Mật khẩu xác nhận không đúng',
            'password_confirm.string' => 'Mật khẩu xác nhận không hợp lệ',
            'password_confirm.same' => 'Mật khẩu và mật khẩu xác nhận phải giống nhau',
            'name.required' => 'Họ tên là trường bắt buộc',
            'name.string' => 'Họ tên không hợp lệ',
            'name.max' => 'Họ tên không được vượt quá :max kí tự',
            'is_male.required' => 'Bạn chưa chọn giới tính',
            'date_of_birth.required' => 'Ngày sinh là trường bắt buộc',
            'date_of_birth.date' => 'Ngày sinh không hợp lệ',
            'date_of_birth.before_or_equal' => 'Ngày sinh không hợp lệ',
            'height.required' => 'Chiều cao là trường bắt buộc',
            'height.numeric' => 'Chiều cao phải là số',
            'height.between' => 'Chiều cao không hợp lệ',
            'weight.required' => 'Cân nặng là trường bắt buộc',
            'weight.numeric' => 'Cân nặng phải là số',
            'weight.between' => 'Cân nặng không hợp lệ',
        ];
        $validator = validator()->make($payload, $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }

        $userData = $validator->validated();
        $userData['password'] = bcrypt($userData['password']);
        User::create($userData);

        return redirect()->back()->with('message', 'Đăng ký thành công!');
    }
}
