<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Event;
use App\Models\User;

class EventController extends Controller
{
    public function index (){

        $search= request("search");/*vai fazer o request do ("search"), pois é o "name" que demos no form-action do welcome(na parte de busca) */
        if($search){
            $events = Event::where([
                ["title", "like", "%".$search."%"]
            ])->get();

        }else{
            $events = Event::all();   
        }
      
        return view('welcome',["events"=> $events, "search" => $search]);



    }

    public function create(){
        return view("events.create");
    }




    public function contact(){
        return view("contact");
    }

    public function store(Request $request){

        $event = new Event; /* classe Event pois o module é Event */

        $event->title= $request->title;
        $event->date= $request->date;
        $event->city= $request->city;
        $event->private= $request->private;
        $event->description= $request->description;
        $event->items= $request->items;

        //upload imagem:
        if($request->hasFile("image") && $request->file("image")->isValid()){

            $requestImage = $request->image;
            $extension = $requestImage->extension();
            $imageName = md5($requestImage->getClientOriginalName() .strtotime("now")) . "." . $extension;
            $requestImage->move(public_path("img/events"), $imageName);
            $event->image =$imageName;
        }


        $user = auth()->user();
        $event->user_id = $user->id;



        $event->save();

        return redirect("/")->with("msg", "Evento criado com sucesso!");




    }





    public function destroy($id) {
        $event = Event::findOrFail($id)->delete();
        return redirect("/dashboard")->with("msg", "Evento excluido com sucesso");
       

  
        return redirect()->back()->with('success', 'Evento removido com sucesso');
    }



    public function show ($id){

        $event = Event::findOrFail($id);

        $user= auth()->user();
        $hasUserJoined = false;
        
        if($user){
            $userEvents = $user->eventsasparticipant->toArray();
            foreach($userEvents as $userEvent){
                if($userEvent["id"]==$id){
                    $hasUserJoined = true;
                }
                /*  if($userEvent["id"==$id]){
                    o primeiro id é o id dos eventos que usuario ja participa
                    o segundo id é do evento que o usuario tenta entrar
                    se forem igual(hasUserJoined vai ser true)
                    e nao vai deixar entrar novamente pois ja participa */
            }
        }


        $eventOwner= User::where("id" , $event->user_id)->first()->toArray();

        return view('events.show', ["event"=> $event, "eventOwner" => $eventOwner, "hasUserJoined" => $hasUserJoined]);
        /* se quisesse event poderia ser"eventos". é a chave da variavel $event(que esta no banco de dados e contem todas as informações sobre o evento)
        logo, quando irei para view, para usar a variavel $event e mostrar na view, terei de chamar por
        "$eventos" visto que teria passado a chave "eventos" para a variavel $events
        *pppppp*/


    }

    
    public function dashboard(){

        $user= auth()->user();
        $events= $user->events;
        $eventsasparticipant = $user->eventsasparticipant;
        return view("events.dashboard", ["events"=> $events, "eventsasparticipant" => $eventsasparticipant]);

    }


    public function edit($id){

        $user= auth()->user();

        $event = Event::findOrFail($id);
        if($user->id != $event->user->id){
            return redirect("/dashboard");
        }

        return view("events.edit",["event"=>$event]);

    }
    public function update(Request $request)
{
    $data = $request->all(); // Convertendo o Request para um array associativo

    // Verifica se 'date' está definida e se é nula
    if (!isset($data['date']) || empty($data['date'])) {
        // Defina aqui um valor padrão para 'date', se necessário
        // Por exemplo, $data['date'] = date('Y-m-d'); para definir a data atual
        $data['date'] = date('Y-m-d');
    }

    // Upload da imagem
    if ($request->hasFile("image") && $request->file("image")->isValid()) {
        $requestImage = $request->image;
        $extension = $requestImage->extension();
        $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;
        $requestImage->move(public_path("img/events"), $imageName);
        $data["image"] = $imageName;
    }

    // Atualizando o evento
    Event::findOrFail($request->id)->update($data);

    return redirect("/dashboard")->with("msg", "Evento editado com sucesso!");
}

public function joinEvent($id){

    $user= auth()->user();

    $user-> eventsasparticipant()->attach($id);

    $event = Event::findOrFail($id);

    return redirect("/dashboard")->with("msg" , "Sua presença está confirmada em: " . $event->title);





}

public function leaveEvent($id) {

    $user= auth()->user();

    $user-> eventsasparticipant()->detach($id);

    $event = Event::findOrFail($id);

    return redirect("/dashboard")->with("msg", "Você saiu do evento.");

}


}
    