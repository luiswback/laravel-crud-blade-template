<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;


//importando o Model que me faz a ponte entre o DB e a aplicação

class EventController extends Controller
{

    public function index()
    {

        $search = request('search');

        if ($search){
            $events = Event::where([
               ['title', 'like', '%'.$search. '%']
            ])->get();

        }else{
            $events = Event::all(); //pegando todos os eventos no banco de dados

        }



        return view('welcome', ['events' => $events, 'search' => $search]); //passando os dados para a view welcome

        //chave + variável ou dado cru
        //ele aceita tanto dados de variáveis como dados crus. na parte de view, posso passar a chave profissao como interpolação.
    }

    public function create()
    {
        return view('events.create');
    }


    public function contact()
    {
        return view('/contact');
    }

    public function login()
    {
        return view('/Login/login');
    }

    public function register()
    {
        return view('/Login/register');
    }

    public function store(Request $request)
    {

        $event = new Event;

        $event->title = $request->title;
        $event->date = $request->date;
        $event->city = $request->city;
        $event->private = $request->private;
        $event->description = $request->description;


        //img upload

        if ($request->hasFile('image') && $request->file('image')->isValid()){

            $requestImage = $request->image;

                $extension = $requestImage->extension();

                $imageName = md5($requestImage->getClientOriginalName(). strtotime('now')) . "." .$extension;

                $requestImage->move(public_path('imagem/events'), $imageName);

                $event->image = $imageName;
        }

        $user = auth()->user();
        $event->user_id = $user->id;

        $event->save();

        return redirect('/')->with('msg', 'Evento criado com sucesso!');
    }

    public function show($id){
        $event = Event::findOrFail($id);

        $user = auth()->user();
        $hasUserJoined = false;

        if ($user){

            $userEvents = $user->eventAsParticipant->toArray();

            foreach ($userEvents as $userEvent){
                if ($userEvent['id'] == $id){
                    $hasUserJoined = true;

                }
            }
        }
        $eventOwner = User::where('id', $event->user_id)->first()->toArray();

        return view('events.show', ['event' => $event, 'eventOwner' => $eventOwner, 'hasUserJoined' => $hasUserJoined]);
    }

    public function dashboard(){
        $user = auth()->user();

        $events = $user->events;

        $eventAsParticipant = $user->eventAsParticipant;

        return view('events.dashboard',
            ['events' =>$events, 'eventasparticipant' => $eventAsParticipant]);


    }

    public function destroy($id){
        Event::findOrFail($id)->delete();

        return redirect('/dashboard')->with('msg', 'Evento excluído com sucesso!');
    }

    public function edit($id){
        $user = auth()->user();

        $event = Event::findOrFail($id);

        if ($user->id != $event -> user_id){
            return redirect('/dashboard');
        }
        return view('events.edit',['event' => $event]);
    }

    public function update(Request $request){
        $data = $request->all();

        if ($request->hasFile('image') && $request->file('image')->isValid()){

            $requestImage = $request->image;

            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName(). strtotime('now')) . "." .$extension;

            $requestImage->move(public_path('imagem/events'), $imageName);

            $data['image'] = $imageName;
        }


        Event::findOrFail($request->id)->update($data);

        return redirect('/dashboard')->with('msg', 'Evento editado com sucesso!');
    }

    public function joinEvent($id){

        $user = auth()->user();

        $user->eventAsParticipant()->attach($id);

        $event = Event::findOrFail($id);

        return redirect('/')->with('msg', 'Sua presença está confirmada no evento: ' . $event->title);

    }

    public function leaveEvent($id){

        $user = auth()->user();

        $user->eventAsParticipant()->detach($id);

        $event = Event::findOrFail($id);

        return redirect('/dashboard')->with('msg', 'Você saiu com sucesso do evento: ' . $event->title);

    }

}
