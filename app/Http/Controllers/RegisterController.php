<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Role;
use App\Event;
use App\EventsUser;
use App\TempGuest;
use App\Short;
use App\Mail\AppMail;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($data = null)
    {
        $params = [
            'title' => 'Register',            
        ];

        if (!is_null($data)) {
            $info = json_decode(Crypt::decryptString($data));

            if (isset($info->email)) {
			
                $user = User::where('email',$info->email)->first();

                // Verifico el auto confirm
                $event = Event::find($info->event_id);

                if (!is_null($user)) {

                    // Verifico si el cliente ya no es un invitado en ese evento
                    $eventUser = EventsUser::where('event_id',$info->event_id)->where('user_id',$user->id)->first();
                    
                    if(!is_null($eventUser)){
                        // Invitación procesada
                        Auth::logout();

                        return redirect()->route('login')->with('error','Your invitation has already been processed.');
                    }

                    // Login user
                    Auth::login($user);

                    // guardo el evento en session asociado al usuario
                    session(['event_id_of_'.$user->id => $info->event_id]);

                    // Verifico si el usuario ya tiene foto
                    if (empty(trim($user->profile_pic_url))) {
						
                        return redirect()->route('photo-user');
						
                    } else{

                        // El usuario tiene foto                       

                        if (!is_null($event) && $event->auto_confirm == 1) {
                            
                            // Auto confirm
                            $event->autoConfirm($event->id);

                            return redirect()->route('platfoms')->with('success','Confirmed invitation to the event: '.$event->name);
                        }

                        // Auto confirm off
                        return redirect()->route('show-events');
                    }
                }
                else{
                    
                    // Si el usuario no esta registrado, debe registrarse
                    return view('auth/register',[
                        'title' => 'Register',
                        'invite' => $data,
                        'invite_email' => $info->email,
                        'success' => 'Register to confirm your invitation to the event: '.$event->name,
                    ]);
                }
            }
            else{
                // error
                return redirect()->route('register')
                ->with('error',"We had a problem with your event invitation, please try again.");
            }
        }

        return view('auth/register',$params);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function done()
    {
        $params = [
            'title' => 'Register',
        ];

        return view('auth/done',$params);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            // 'nickname' => 'string|min:4|max:40|unique:users',
            // 'phone' => 'required|numeric',
            // 'country' => 'required',
            'password' => 'required|string|min:8|confirmed',
            'g-recaptcha-response' => 'required|captcha',
            'terms_accept' => 'required',
        ]);
		

        $guest = Role::where('slug','guest')->first();
        
        $user = new User();

        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->slug  = Str::slug($request->firstname.$request->lastname);
        $user->nickname  = Str::slug($request->firstname.$request->lastname);
        // $user->nickname = $request->nickname;
        $user->country = "XX";
        $user->phone = "";
        $user->password = Hash::make($request->password);		
		
        if($user->save()){

            // Registramos el usuario en el evento predeterminado
            // $eventDefault = Event::first();
   //
   //          if(!is_null($eventDefault)){
   //
   //              // Verifico si el cliente ya esta en el evento
   //              $eventUser = EventsUser::where('event_id',$eventDefault->id)
   //              ->where('user_id',$user->id)
   //              ->first();
   //
   //              if(is_null($eventUser)){
   //                  EventsUser::create([
   //                      'event_id' => $eventDefault->id,
   //                      'user_id' => $user->id,
   //                      'status_id' => 2,
   //                  ]);
   //              }
   //          }     
        
            $user->roles()->attach($guest);            

            // Verifico si invite existe
            if ($request->has('invite')) {
				
                $user->status = 1;
                $user->email_verified_at = now();
                $user->save();
				
                // Seguirmos con la invitación al evento
                return redirect()->route('register',[$request->input('invite')]);
            }

            // Generate link
            $short_link = new Short();
            $short_link->key = Str::random(30);
            $short_link->value = route('verify-register',[Crypt::encryptString($user->id)]);
            $short_link->save();

            // Send email
            $data = [
                'link' => route('short',[$short_link->key]),
            ];

            Mail::to($request->input('email'),$request->input('name'))
            ->send(new AppMail('Verify email', $data, 'verify'));

            return redirect()->route('done-register');
        }
        else{
            return back()->with('error',__('msj.str_not_found'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $token
     * @return \Illuminate\Http\Response
     */
    public function verify($token)
    {
        $user_id = Crypt::decryptString($token);

        $user = User::find($user_id);

        if(!is_null($user)){
            $user->status = 1;
            $user->email_verified_at = now();
            $user->save();

            Auth::login($user);

            // Verifico si tiene pendientes
            $temp_guest = TempGuest::where('email',$user->email)->get();

            if (!is_null($temp_guest) && count($temp_guest) > 0) {
                return redirect()->route('show-pending');
            }

            // Redirect to Dashboard
            return redirect()->route('platfoms');
        }

        return redirect()->route('register')->with('error','The user you wish to confirm was not found.');
    }
}
