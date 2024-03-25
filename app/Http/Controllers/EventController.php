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

        $eventOwner= User::where("id" , $event->user_id)->first()->toArray();

        return view('events.show', ["event"=> $event, "eventOwner" => $eventOwner]);
        /* se quisesse event poderia ser"eventos". é a chave da variavel $event(que esta no banco de dados e contem todas as informações sobre o evento)
        logo, quando irei para view, para usar a variavel $event e mostrar na view, terei de chamar por
        "$eventos" visto que teria passado a chave "eventos" para a variavel $events
        *ppp*/


    }

    
    public function dashboard(){

        $user= auth()->user();
        $events= $user->events;
        return view("events.dashboard", ["events"=> $events]);

    }

}
    