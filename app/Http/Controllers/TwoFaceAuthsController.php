<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TwoFaceAuthsController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }

    public function index()
    {
        $googleAuthenticator = new \PHPGangsta_GoogleAuthenticator();
        // Tạo secret code
        $secretCode = $googleAuthenticator->createSecret();
        // Tạo QR code từ secret code. Tham số đầu tiên là tên. Chúng ta sẽ hiển thị
        // email hiện tại của người dùng. Tham số tiếp theo là secret code và tham số cuối cùng
        // là tiêu đề của ứng dụng. Sử dụng để người dùng biết code này đang sử dụng cho dịch vụ nào
        // Bạn có thể tùy ý sử dụng tham số 1 và 3.
        $qrCodeUrl = $googleAuthenticator->getQRCodeGoogleUrl(
            auth()->user()->email,
            $secretCode,
            config("app.name")
        );

        // Lưu secret code vào session để phục vụ cho việc kiểm tra bên dưới
        // và update vào database trong trường hợp người dùng nhập đúng mã được sinh ra bởi
        // ứng dụng Google Authenticator
        session(["secret_code" => $secretCode]);

        return view("admin.two_face_auths.index", compact("qrCodeUrl"));
    }

    public function enable(Request $request)
    {
        // dd($request->get("code"));
        // Validate dữ liệu gửi lên
        $this->validate($request, [
            "code" => "required|digits:6"
        ]);

        // Khởi tạo Google Authenticator class
        $googleAuthenticator = new \PHPGangsta_GoogleAuthenticator();
        // Lấy secret code
        $secretCode = session("secret_code");

        // Mã người dùng nhập không khớp với mã được sinh ra bởi ứng dụng
        if (!$googleAuthenticator->verifyCode($secretCode, $request->get("code"), 0)) {
            return redirect()->back()->with("error", "Invalid code");
            // return 'lỗi';
        }

        // Update secret code cho người dùng
        $user = auth()->user();
        $user->secret_code = $secretCode;
        $user->save();
        session()->flash("success", true);

        return view("admin.two_face_auths.index")->with("status", "Cài đặt xác thực 2 lớp thành công !");
        // return ok;
    }
    public function disable(Request $request)
    {
        // Update secret code cho người dùng
        $user = auth()->user();
        $user->secret_code = null;
        $user->save();
        session()->flash("success", true);

        return view("admin.two_face_auths.index")->with("status", "Tắt xác thực 2 lớp thành công !");
        // return ok;
    }
}
