<?php

namespace App\Livewire;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use App\Models\User;
use App\Notifications\GeneralNotification;
use Livewire\Component;
use Masmerise\Toaster\Toastable;
class LockPage extends Component
{
    use Toastable;
    public $token = ['', '', '', '', '', ''];
    public $sent = false;
    public $approve = false;
    public $status = false;
    public $url;

    public function mount($status = 'otp', $url='')
    { 
        $this->url = $url;
        $this->status = $status;
        $route = $url;

        // Fetch all verified pages
        $verifiedPages = session('lockscreen_verified_pages', []);
        if($status == 'otp') 
        {
            session()->put('scope_otp', false);
            session()->remove('lockscreen_verified_pages');
        }
        // If current route was verified more than 30session('scope_otp', false); mins ago, reset
        if (isset($verifiedPages[$route]) && now()->diffInMinutes($verifiedPages[$route]) > 30) {
            unset($verifiedPages[$route]);
            session(['lockscreen_verified_pages' => $verifiedPages]);
        }

        // Check if this route is already approved
        if (isset($verifiedPages[$route])) {
            $this->approve = true;
            if($status == 'otp') session()->remove('scope_otp');
        }
    }

    public function send($role)
    { 
        $user = User::where('role', $role)->first();
        if(!$user){
             $user = User::where('role', 'admin')->first();
        }
        $staff = auth()->user();

        if (!$staff) {
            $this->addError('token', 'You must be logged in to request a token.');
            return;
        }

        $token = rand(100000, 999999);

        session([
            'lock_token' => (string) $token,
            'lock_token_expires_at' => now()->addMinutes(10),
            'lock_token_route' => $this->url,
        ]);

        $url   = $this->url;
        $ip    = request()->ip();
        $reason = $this->status == 'page' ? "to the route ({$url}) valid for 30mins" : "to the certificate generator platform";

        if ($user) {
            $user->notify(new GeneralNotification(
                '.NG Token Permission',
                "A new permission token has been generated from [{$ip}] {$staff->name} ({$staff->email}) 
                for access ".$reason,
                $user,
                $token
            ));
        }

        $this->sent = true;
    }

    public function submit()
    {
        $enteredToken = implode('', $this->token);
        $validToken   = session('lock_token');
        $expiresAt    = session('lock_token_expires_at');
        $lockedRoute  = session('lock_token_route');

        $currentRoute = $this->url;

        if (!$validToken || !$expiresAt || now()->greaterThan($expiresAt)) {
            $this->addError('token', 'Token expired, please request a new one.');
            return;
        }

        if ($enteredToken === $validToken && $lockedRoute === $currentRoute) {
            $verifiedPages = session('lockscreen_verified_pages', []);
            $verifiedPages[$currentRoute] = now();

            session([
                'lockscreen_verified_pages' => $verifiedPages,
            ]);

            $this->approve = true;

            if($this->status == 'otp') session()->remove('scope_otp');

            if($this->status == 'otp') $this->success('OTP verified!');
            
            if($this->status == 'otp') return $this->redirectRoute('dashboard');

            $this->redirect($this->url);
        } 
        else {
            $this->addError('token', 'Invalid token kindly contact admin or request another.');
        }
    }
    public function render()
    {
        return view('livewire.lock-page')->layout('shared.auth');
    }
}
