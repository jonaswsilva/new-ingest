<?php

namespace App\Http\Controllers;

use App\Models\Ingest;
use Illuminate\Http\Request;


class IngestController extends Controller
{
  
    public function scanAllDir($dir) {
        $result = [];
        foreach(scandir($dir) as $filename) {
          if ($filename[0] === '.') continue;
          $filePath = $dir . '/' . $filename;
          if (is_dir($filePath)) {
            foreach ($this->scanAllDir($filePath) as $childFilename) {
              $result[] = $filename . '/' . $childFilename;
            }
          } else {
            $result[] = $filename;
          }
        }
        return $result;
      }
    
    

    public function rec(Request $request){
    
        $pathDir = $this->scanAllDir('/xampp');

        dd($pathDir[3]);

        $name = strtoupper(str_replace(' ', '_', $request->input('name')));
        $path = $request->input('path');




        $curl = curl_init();

        curl_setopt_array($curl, [
        CURLOPT_URL => "http://192.168.45.118/config?action=set&paramid=eParamID_RecordingPathSDCard_1&value=$path",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => [
            "user-agent: vscode-restclient"
        ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
        
        $curl = curl_init();

        curl_setopt_array($curl, [
        CURLOPT_URL => "http://192.168.45.118/config?action=set&paramid=eParamID_ReplicatorCommand&value=1",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => [
        "user-agent: vscode-restclient"
        ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        $curl = curl_init();

        curl_setopt_array($curl, [
        CURLOPT_URL => "http://192.168.45.118/config?action=set&paramid=eParamID_FilenamePrefix&value=$name",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => [
            "user-agent: vscode-restclient"
        ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        return view('layouts.app');
    }

    
   
    public function stop(){
        $curl = curl_init();

        curl_setopt_array($curl, [
        CURLOPT_URL => "http://192.168.45.118/config?action=set&paramid=eParamID_ReplicatorCommand&value=2",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => [
            "user-agent: vscode-restclient"
        ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        return view('layouts.app');
    }

    
    public function show(Ingest $ingest)
    {
        //
    }

    
    public function edit(Ingest $ingest)
    {
        //
    }

   
    public function update(Request $request, Ingest $ingest)
    {
        //
    }

    
    public function destroy(Ingest $ingest)
    {
        //
    }
}
