<?php

namespace App\Http\Controllers;

use App\Models\Status;
use App\Models\User;
use App\Enum\MessageEnum;
use http\Client\Request;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    /**
     * Display the login page.
     *
     * @return Application|Factory|View
     */
    public function showLogin()
    {
        return view('login');
    }

    /**
     * Display the registration page.
     *
     * @return Illuminate\Contracts\Foundation\Application|Factory|View
     */
    public function showRegistration()
    {
        return view('registration');
    }

    /**
     * Display the profile page.
     *
     * @return Illuminate\Contracts\Foundation\Application|Factory|View
     */
    public function showProfile()
    {
        $userId = session()->get('userId');
        $user = User::findorFail($userId);

        return view('profile', ['user' => $user]);
    }

    /**
     * Authentication.
     *
     * @return Response
     */
    public function doLogin()
    {
        //DB::enableQueryLog();
        $password = md5(request('password'));
        $user =
            User::where([
                    ["user_name", "=", request('username')],
                    ["password", "=", $password],
                    ["status", "=", Status::active]
                ])->first();
        //Log::debug(dd(DB::getQueryLog()));

        if ($user != null) {
            session(['userId' => $user->id]);
            return redirect()->route('quiz.listQuizzes');
        }

        session(['login' => MessageEnum::LoginError]);
        return redirect()->route('home.showLogin')->withErrors(['login' => MessageEnum::LoginError]);
    }

    /**
     * Registration.
     *
     * @return RedirectResponse
     */
    public function doRegistration()
    {
        //DB::enableQueryLog();

        $user = new User();
        $user->user_name = request('email');
        $user->email = request('email');
        $user->password = md5(request('password'));
        $user->full_name = request('fullname');
        $user->status = Status::active;

        $user->save();

        session(['email' => $user->email]);
        session(['userId' => $user->id]);

        //Log::debug(dd(DB::getQueryLog()));

        return redirect()->route('quiz.listQuizzes');
    }

    /**
     * Check if an email exists.
     *
     * @param $email
     * @return boolean flag.
     */
    public function checkEmail($email)
    {
        Log::debug("In check email");
        $user = User::where('email', '=', $email)->first();

        if ($user != null)
        {
            return MessageEnum::UserExists;
        }

        return MessageEnum::UserDoesNotExist;
    }

    public function doLogout() {
        session(['userId' => null]);

        return redirect()->route('home.showLogin');
    }

    /**
     * Registration.
     *
     * @return RedirectResponse
     */
    public function editProfile(): RedirectResponse
    {
        //DB::enableQueryLog();

        $userId = session()->get('userId');
        $user = User::findorFail($userId);

        /*$user->user_name = request('email');
        $user->email = request('email');
        $user->password = md5(request('password'));
        $user->status = Status::active;*/

        $user->full_name = request('fullname');
        $user->age = request('age');
        $user->gender = request('gender');
        $user->grade = request('grade');

        $user->update();

        session(['email' => $user->email]);

        //Log::debug(dd(DB::getQueryLog()));

        return redirect()->route('quiz.listQuizzes');
    }
}
