<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Attachments;
use Validate;

class File extends Controller
{
    public function uploadFile(Request $request){
        $att = new Attachments();
        if($request->hasFile('attachment'))
        {
            $attachment = $request->file('attachment');
            foreach($attachment as $attachment){
                $name = rand().'.'.$attachment->getClientOriginalExtension();
                $attachment->move(public_path('files'), $name);

                $att->insert([
                    'transcode' => $request->transcode,
                    'filename' => $name,
                    'created_at' => now(),
                    'filelocation' => public_path('files')
                ]);
            }
        }
        

        return back();
    }

    public function downloadFile(Request $request){
        $att = new Attachments();

        $file = $att->getAllWhere([
            'id' => $request->attachmentid
        ]);

        foreach($file as $f){
            $filename = $f->filename;
            $filelocation= $f->filelocation;
        }
        $headers = array(
            'Content-Type: application/pdf',
          );

        $fname = $filelocation.'\\'.$filename;

        return response()->download($fname, $filename, $headers);
    }
}
