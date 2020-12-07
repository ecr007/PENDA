<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use Intervention\Image\ImageManagerStatic as Image;
use App\User;
use App\Event;
use App\EventsUser;
use App\Skin;
use App\EventsSkinsUser;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($deleted_at = null)
    {
        if (is_null($deleted_at)) {
            $trashed = false;
            $link = route('get-users');
        }
        else{
            $trashed = true;
            $link = route('get-users',['deleted_at'=>'ok']);
        }

        $data = [
            "title" => "Users",
            "current" => "users",
            "trashed" => $trashed,
            "link" => $link,
        ];

        return view("users/index",$data);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function get($deleted_at = null)
    {
        if(is_null($deleted_at)){
            $users = User::all();
        }
        else{
            $users = User::onlyTrashed()->get();
        }

        return datatables()
            ->of($users)
            ->addColumn('fullname',function($row){
                return $row->firstname . " " . $row->lastname; 
            })
            ->addColumn('flag',function($row){
                return '<img src="'.asset("images/flags/".mb_strtolower($row->country)).'.png" alt="'.$row->country.'">';
            })
            ->addColumn('badge_status',function($row){
                if($row->status == 1){
                    return '<span class="badge badge-success">Active</span>';
                }
                else{
                    return '<span class="badge badge-danger">Inactive</span>';
                }
            })
            ->addColumn('event_count',function($row){
                return EventsUser::where('user_id',$row->id)->count();
            })
            ->addColumn('profile_pic',function($row){
                return '<a href="#" class="btn btn-sm btn-outline-primary gathr-open-modal" data-title="'.$row->firstname.'" data-img="'.$row->getPhoto().'">Profile pic</a>';
            })
            ->addColumn('user_skin',function($row){
                if(isset($row->skins[0])){
                    return '<a href="#" class="btn btn-sm btn-outline-primary gathr-open-modal" data-title="'.$row->firstname.'" data-img="'.$row->skins[0]->preview_image.'">Skin</a>';
                }
                else{
                    return "N/A";
                }
            })
            ->addColumn('delete',function($row){
                if(is_null($row->deleted_at)){
                    return '<a href="'.route("destroy-users",[$row->id]).'" class="btn btn-sm btn-outline-danger">Hide</a>';
                }
                else{
                    return '<a href="'.route("recovery-users",[$row->id]).'" class="btn btn-sm btn-outline-warning">Recover</a>';
                }
            })
            ->escapeColumns([])
            ->toJson();
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validation = [
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255'
        ];

        $validator = Validator::make($request->all(),$validation);

        if ($validator->fails()) {
            return back()->with('errorsAry',$validator->errors())->withInput();
        }

        $request->user()->firstname = trim($request->firstname);
        $request->user()->lastname = trim($request->lastname);
        $request->user()->nickname = Str::slug($request->firstname.$request->lastname);
        $request->user()->phone = trim($request->phone);
        $request->user()->country = trim($request->country);
		
		if($request->organization!=''){
        	$request->user()->organization = trim($request->organization);
		}

        if (!empty(trim($request->password))) {
            $validation = [
                'password' => 'required|string|min:8|confirmed',
            ];

            $validator = Validator::make($request->all(),$validation);

            if ($validator->fails()) {
                return back()->with('errorsAry',$validator->errors())->withInput();
            }

            $request->user()->password = Hash::make(trim($request->password));
        }

        if($request->user()->save()){
           return back()->with('success',__('msj.str_success_update'));
        }
        
        return back()->with('error',__('msj.str_error_update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
		$record = User::find($id);

		if (is_null($record)) {
			return back()->with('error',__('msj.str_not_found'));
		}

		if($record->delete()){
			return back()->with('success',__('msj.str_success_delete'));
		}
		else{
			return back()->with('error',__('msj.str_error_delete'));
		}
    }

    /**
     * Recovry the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function recovery($id)
    {
        //
        $record = User::withTrashed()->find($id);

        if (is_null($record)) {
            return back()->with('error',__('msj.str_not_found'));
        }

        if($record->restore()){
            return back()->with('success',__('msj.str_success_recove'));
        }
        else{
            return back()->with('error',__('msj.str_error_recove'));
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function photo($event_id = null)
    {
        $user = Auth::user();

        $data = [
            'title' => 'Update picture',
            'user' => $user,
            'skin_select' => null,
            'skin' => asset('storage/images/skins/preview-white.png'),
        ];

        // Busco los skin del evento
        if (Session::has('event_id_of_'.$user->id)) {
            $event_id = session('event_id_of_'.$user->id);
        }

        if(isset($event_id) && !is_null($event_id)){

            $event = Event::find($event_id);

            $data['event_id'] = $event_id;
        }

        return view('users/photo',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function photoUpload(Request $request)
    {
        $user = $request->user();

        if ($request->hasFile('profile_pic_url')) {

            $validation = [
                'profile_pic_url' => 'required|file|max:10240|mimes:jpeg,png,jpg,gif',
            ];

            $validator = Validator::make($request->all(),$validation);

            if ($validator->fails()) {
                return back()->with('errorsAry',$validator->errors())->withInput();
            }

            $source = $_FILES['profile_pic_url']['tmp_name'];
            
            $res = $this->editImage($user,$source,$_POST);

            if ($res == false) {
                return back()->with('error',__('msj.str_error'));
            }

            $user->profile_pic_url = $res;
        }
        else if( !empty(trim($user->profile_pic_url)) ){

            $path = Storage::disk(env('APP_DISK'))->url($user->profile_pic_url);

            $res = $this->editImage($user,$path,$_POST);

            if ($res == false) {
                return back()->with('error',__('msj.str_error'));
            }
        }

        if ($user->save()) {

            $event_id = session('event_id_of_'.$user->id);

            if( !is_null($event_id) ){
                
                // Si el evento tiene auto confirm, pasa directamente a la pantalla de plataformas
                $event = Event::find($event_id);

                // Verifico si el cliente ya no es un invitado en ese evento
                $eventUser = EventsUser::where('event_id',$event_id)->where('user_id',$user->id)->first();

                if (is_null($eventUser) && !is_null($event) && $event->auto_confirm == 1) {
                    
                    // Auto confirm
                    $event->autoConfirm($event->id);

                    return redirect()->route('dashboard')
                    ->with('success','Self-confirmed invitation to the event: '.$event->name);
                }
            }
            
            // Enviar al evento si la session existe
            if($request->session()->has('event_id_of_'.$user->id)){
                return redirect()->route('show-events');
            }
            else{

                // Go perfil
                return redirect()->route('dashboard');
            }
        }
        else{
            return back()->with('error',__('msj.str_error'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateSkin(Request $request)
    {
        $user = $request->user();

        $validation = [
            'event'  => 'required|numeric',
            'skin'  => 'required|numeric',
        ];

        $validator = Validator::make($request->all(),$validation);

        if ($validator->fails()) {
            return back()->with('errorsAry',$validator->errors())->withInput();
        }

        // Verifico si el usuario ya tiene un skin para dicho evento
        $eventSkinUser = EventsSkinsUser::where('event_id',$request->event)
        ->where('user_id',$user->id)->first();

        if (is_null($eventSkinUser)) {
            $eventSkinUser = new EventsSkinsUser();
            $eventSkinUser->event_id = $request->event;
            $eventSkinUser->user_id = $user->id;
            $eventSkinUser->skin_id = $request->skin;
            $eventSkinUser->save();
        }
        else{
           EventsSkinsUser::where('event_id',$request->event)
           ->where('user_id',$user->id)->update(['skin_id'=>$request->skin]); 
        }

        return back()->with('success',__('msj.str_success'));
    }

    /**
     * return user list
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function list(Request $request)
    {
        $data = [
            'incomplete_results' => false,
        ];

        $event = Event::find($request->eventid);
        
        $users = User::where('firstname','like','%'.$request->input('q').'%');
        $users->orWhere('lastname','like','%'.$request->input('q').'%');
        $users->orWhere('email','like','%'.$request->input('q').'%');
        
        // Excluyo los usuarios que ya estan en la tabla users
        if (!is_null($event)) {
            $event_users = $event->users;

            $user_ids = [];

            if(count($event_users) > 0){
                foreach ($event_users as $key) {
                    array_push($user_ids, $key->user_id);
                }
            }

            if(count($user_ids) > 0){
                $users->whereNotIn('id',$user_ids);
            }
        }
        
        $users = $users->get();

        $data['total_count'] = $users->count();
        $data['items'] = $users->toArray();

        return $data;
    }


    private function editImage($user,$source,$post)
    {   
        $info_image = getimagesize($source);

        if ($info_image['mime'] == 'image/jpeg'){
            $img_r = imagecreatefromjpeg($source);
        }
        elseif ($info_image['mime'] == 'image/gif'){
            $img_r = imagecreatefromgif($source);
        }
        elseif ($info_image['mime'] == 'image/png'){
            $img_r = imagecreatefrompng($source);
        }
        else{
            return back()->with('error','Image format is not valid');
        }

        //Get current dimensions
        $width = imagesx($img_r);
        $height = imagesy($img_r);

        $x1 = $post['x1'];
        $y1 = $post['y1'];
        $x2 = $post['x2'];
        $y2 = $post['y2'];

        $new_width  = $x2 - $x1;
        $new_height = $y2 - $y1;

        $best_width = 260;
        $best_height = 370;

        $dst_r = ImageCreateTrueColor( $best_width, $best_height );
        
        imagecopyresampled($dst_r, $img_r, 0, 0, $x1, $y1, $best_width, $best_height, $new_width, $new_height);

        $img = (string) Image::make($source)->setCore($dst_r)->encode('jpg', 100);

        $image_name = 'profile-'.$user->nickname.'-'.$user->id.'.jpg';

        $res = Storage::disk( env('APP_DISK') )->put('images/users/'.$image_name, $img );

        if ($res == true) {
            return 'images/users/'.$image_name;
        }

        return false;
    }
}
