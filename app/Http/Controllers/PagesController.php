<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class PagesController extends Controller
{
    public function index()
    {
        $content = Storage::disk('public')->get('test_data.json');
        $content = json_decode($content);

        $photos = Storage::disk('public')->get('photos.json');
        $photos = json_decode($photos,true);


        return view("welcome")->with(compact("content","photos"));
    }

    public function uploadFile(Request $request)
    {
        if($request->hasFile("photos"))
        {
            $content = Storage::disk('public')->get('photos.json');
            if ($content) {
                $content = json_decode($content, true);
            } else {
                $content = [];
            }
            foreach ($request->file("photos") as $key => $photo) {
                $filename = $key . "." . $photo->getClientOriginalExtension();
                $photo->storeAs('public', $filename);
                $content[$key] = $filename;
            }
            Storage::disk('public')->put('photos.json', json_encode($content));
        }
        else
        {
            return redirect("/")->with("error","asdasda");
        }
        return redirect("/");
    }
}
