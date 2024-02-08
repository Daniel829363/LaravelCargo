<?php

namespace App\Http\Controllers;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::get();

        return view('products.product', compact('products'));
    }
    public function create(Request $request){
        if ($request->whatsapp){
            $contact=new Contact;
            $contact->whatsapp=$request->whatsapp;
            $contact->save();
        }
        if ($request->tel){
            $contact=new Contact;
            $contact->tel=$request->tel;
            $contact->save();
        }
        return redirect()->back()->with('success', 'Успешно добавлена.');
    }



    public function update(Request $request){
        $contact=Contact::first();
        if($request->addres_a)$contact->update(['addres_a' => $request->addres_a]);
        if($request->addres_b)$contact->update(['addres_b' => $request->addres_b]);
        if($request->mail)$contact->update(['mail' => $request->mail]);
        if($request->grafic)$contact->update(['grafic' => $request->grafic]);
        return redirect()->back()->with('success', 'Успешно обнавлена.');
    }

    public function update2(Request $request,Contact $contact){
        if($request->whatsapp)$contact->update(['whatsapp' => $request->whatsapp]);
        if($request->tel)$contact->update(['tel' => $request->tel]);
        return redirect()->back()->with('success', 'Успешно обнавлена.');
    }

    public function del1(Contact $contact){
        $contact->update(['whatsapp' => null]);
        $this->destroy();
        return redirect()->back()->with('success', 'Успешно удалена.');
    }

    public function del2(Contact $contact){
        $contact->update(['tel' => null]);
        $this->destroy();
        return redirect()->back()->with('success', 'Успешно удалена.');
    }

    public function destroy(){
        $contacts=Contact::get();
        foreach ($contacts as $contact) {
            if ($contact->addres_a==null && $contact->addres_b==null && $contact->whatsapp==null && $contact->mail==null && $contact->grafic==null && $contact->tel==null)$contact->delete();
        }

    }

}
