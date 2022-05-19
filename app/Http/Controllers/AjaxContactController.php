<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Models\Contact;
 
 
class AjaxContactController extends Controller
{
    public function index()
    {
        return view('ajax-contact-us-form');
    }
 
    public function store(Request $request)
    {
        
        $validatedData = $request->validate([
          'name' => 'required',
          'email' => 'required|unique:contacts|max:255',
          'message' => 'required'
        ]);
 
        $contact = new Contact;
 
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->message = $request->message;
 
        $result = $contact->save();

        if ($result) {
            $res = [
                'status' => 200,
                'message' => 'Inserted'
            ];
            echo json_encode($res);
        }
        die;
        
 
        return redirect('form')->with('status', 'Ajax Form Data Has Been validated and store into database');
 
    }
}