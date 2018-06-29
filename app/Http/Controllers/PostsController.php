<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function store(PostRequest $request){
        //        Post::create($request->all());
        $this->post = new Post();
        $this->post->fill($request->all());

        $tmp_post_id = $_POST['post_id'];
        if ( $tmp_post_id == '-1') { //新規作成
            $this->post->post_id = Post::max('post_id') + 1;
            $this->post->res_id = 0;
        } else {
            $this->post->post_id = $tmp_post_id;
            $this->post->res_id = Post::where('post_id', '=', $tmp_post_id)->max('res_id') + 1;
        }

        $image = Input::file('data');
        if(!empty($image)) {
            $this->post->fig_mime = $image->getMimeType();
            switch ($this->post->fig_mime) {
                case "image/png":$flag = TRUE; break;
                case "image/gif":$flag = TRUE; break;
            　　default: $flag = FALSE;
            }
            if ($flag == FALSE) {
                \Flash::error('アップロード可能な画像ファイルは jpg, png, gif のみです。');
                return redirect()->back();
            }

            $name = md5(sha1(uniqid(mt_rand(), true))).'.'.$image->getClientOriginalExtension();
            $upload = $image->move('media', $name);

            //サムネイルを作成し、public/media/mini に保存
            Image::make('media/'.$name)
                ->resize(400, 400)
                ->save('media/mini/'.$name);
            $this->post->fig_name = $name;
        }

        $this->post->save();
        \Flash::success('記事が投稿されました。');

        if ( $tmp_post_id == '-1') { //新規作成
            return redirect()->route('posts.index');
        }
        return redirect()->route('posts.show', [$tmp_post_id]);
    }
    
    public function index(){
        
    }
}