<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdatePost;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){

        $posts = Post::latest()->paginate(15);

        return view('admin.posts.index', compact('posts'));
    }

    public function create(){
        return view('admin.posts.create');
    }

    public function store(StoreUpdatePost $request){
        
        Post::create($request->all());
        
        return redirect()
                ->route('posts.index')
                ->with('message', 'Post criado com sucesso!');
    }

    public function show($id){
        
        if (!$post = Post::find($id))
           return redirect()->route('posts.index'); 

        return view('admin.posts.show', compact('post'));

    }

    public function destroy($id){
        if (!$post = Post::find($id))
            return redirect()->route('posts.index'); 
    
        $post->delete();
        return redirect()
                ->route('posts.index')
                ->with('message', 'Post deletado com sucesso!');

    }

    public function edit($id){
        
        if (!$post = Post::find($id))
           return redirect()->route('posts.index'); 

        return view('admin.posts.edit', compact('post'));

    }

    public function update(StoreUpdatePost $request, $id){
        
        if (!$post = Post::find($id))
           return redirect()->route('posts.index'); 

        $post->update($request->all());
        
        return redirect()
                ->route('posts.index')
                ->with('message', 'Post editado com sucesso!');

    }

    public function search(Request $request){

        $filters = $request->except('_token');

        $posts = Post::where('title', 'LIKE', "%{$request->search}%")
                        ->orWhere('content', 'LIKE', "%{$request->search}%")
                        ->paginate(15);
        return view('admin.posts.index', compact('posts', 'filters'));
    }

    public function rec(){
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

        if ($err) {
        echo "cURL Error #:" . $err;
        } else {
        echo $response;
        }
    }

}
