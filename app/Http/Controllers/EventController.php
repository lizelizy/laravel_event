<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Event; // chamando o model para buscar os dados
use App\Models\User; // chamando o model para buscar dados do user

class EventController extends Controller
{
    public function index(){

        // Código de busca
        $search = request('search');
        If($search){

            $events = Event::where([
                ['title', 'like', '%' .$search. '%']
            ])->get();

        }else{
            // Código para mostrar todas as informações
            $events = Event::all();
        }
        

    return view('welcome',['events' => $events, 'search' => $search]);
    }

    public function contato(){
        return view('contato');
    }

    public function create(){
        return view('events.create');
    }

    public function products(){

        $busca = request('search');

        return view('products', ['busca' => $busca]);  // Parâmetro para acessar a busca na url
    }

    public function store(Request $request){
        $event = new event();

        $event->title = $request->title;
        $event->city = $request->city;
        $event->private = $request->private;
        $event->description = $request->description;

        //Deve ser informado no modal
        $event->items = $request->items;

        //Deve ser informado no modal
        $event->date = $request->date;

        //image upload
        if($request->hasFile('image') && $request->file('image')->isValid() ){

            $requestImage = $request->image;
            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;
            $requestImage->move(public_path('img/events'), $imageName );

            $event->image = $imageName;

        }

        // ID
        $user = auth()->user();
        $event->user_id = $user->id;

        $event->save();

        return redirect('/')->with('msg', 'Evento criado com sucesso');

        //redirect para o link na rota
        //with é a mensagem que enviamos para o usuário para confirmar um envio de dados ou um erro (deve ser confirmado no main)

    }


    public function show($id){

        $event = Event::findOrFail($id); // Encontrar o ID do evento

        $user = auth()->user();
        $hasUserJoined = false;

        if($user){
            $userEvents = $user->eventsAsParticipant->toArray();

            foreach($userEvents as $userEvent){
                if($userEvent['id'] == $id){
                    $hasUserJoined = true;
                }
            }
        }

        $eventOwner = User::where('id', $event->user_id)->first()->toArray(); // Encontrar o id do dono do evento

        return view('events.show', ['event' => $event, 'eventOwner' => $eventOwner, 'hasUserJoined' => $hasUserJoined]);

    }

    public function dashboard(){

        // Evento que o usuário é dono
        $user = auth()->user();
        $events = $user->events;

        //Evento que o usuária participa
        $eventsAsParticipant = $user->eventsAsParticipant;

        return view('events.dashboard', ['events' => $events, 'eventsasparticipant' => $eventsAsParticipant]);   

    }

    public function destroy($id){
        Event::findOrFail($id)->delete();

        return redirect('/dashboard')->with('msg', 'Evento excluído com sucesso');
    }

    public function edit($id){

        $user = auth()->user();

        $event = Event::findOrFail($id);

        //medida de segurança para usuario nao editar o evento do qual não é dono
        if ($user->id != $event->user_id){
            return redirect('/dashboard');
        }

        return view('events.edit', ['event' => $event]);
    }

    public function update(Request $request){

        $data = $request->all();
        //upload da imagem
        if($request->hasFile('image') && $request->file('image')->isValid() ){

            $requestImage = $request->image;
            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;
            $requestImage->move(public_path('img/events'), $imageName );

            //edição da imagem
            $data['image'] = $imageName;

        }

        Event::findOrFail($request->id)->update($data);

        return redirect('/dashboard')->with('msg', 'Evento editado com sucesso');
    }

    public function joinEvent($id){

        $user = auth()->user();

        //Salvando usuário ao evento
        $user->eventsAsParticipant()->attach($id);

        $event = Event::findOrFail($id);

        return redirect('/dashboard')->with('msg', 'Sua presença foi confirmada ao evento');

    }

    public function leaveEvent($id){

        $user = auth()->user(); 

        $user->eventsAsParticipant()->detach($id);

        $event = Event::findOrFail($id);

        return redirect('/dashboard')->with('msg', 'Sua presença do evento foi removida com sucesso');

    }

}