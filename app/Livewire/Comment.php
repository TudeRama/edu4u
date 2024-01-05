<?php

namespace App\Livewire;

use App\Models\Admin;
use App\Models\Comment as ModelsComment;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Comment extends Component
{
    public $body;
    public $article;
    public $edit_comment_id;
    public $body2;
    public $comment_id;

    public function mount($id){
        $this->article = Admin::find($id);
    }
    public function render()
    {
        return view('livewire.comment',['comment'=> ModelsComment::where('admins_id',$this->article->id)->whereNull('comment_id')->get(),'total_comment'=>ModelsComment::where('admins_id',$this->article->id)->count(),'article'=>Admin::where('nama',$this->article->nama)->first()]);
    }
    public function store(){
        $this->validate(['body'=>'required']);
        $comment = ModelsComment::create([
            'user_id'=> Auth::user()->id,
            'admins_id'=> $this->article->id,
            'body'=>$this->body
        ]);
        $this->body = NULL;
    }

    public function selectEdit($id){
        $comment = ModelsComment::find($id);
        $this->edit_comment_id = $comment->id;
        $this->body2 = $comment->body;
        $this->comment_id = NULL;
    }

    public function update(){
        $this->validate(['body2'=>'required']);
        $comment = ModelsComment::where('id',$this->edit_comment_id)->update([
            'user_id'=> Auth::user()->id,
            'admins_id'=> $this->article->id,
            'body'=>$this->body2
        ]);
        $this->body2=NULL;
        $this->edit_comment_id=NULL;


    }

    public function delete($id){
        $comment = ModelsComment::where('id',$id)->delete();
    }

    public function selectReply($id){
        $this->comment_id = $id;
        $this->edit_comment_id= NULL;
        $this->body2 = NULL;
    }

    public function reply(){
        $this->validate(['body2'=>'required']);
        $comment = ModelsComment::find($this->comment_id);
        $comment = ModelsComment::create([
            'user_id'=> Auth::user()->id,
            'admins_id'=> $this->article->id,
            'body'=>$this->body2,
            'comment_id'=> $comment->comment_id? $comment->comment_id : $comment->id
        ]);
        $this->body2 = NULL;
        $this->comment_id=NULL;
    }

    public function like($id){
        $data =[
            'admin_id'=>$id,
            'user_id'=>Auth::user()->id
        ];
        $like = Like::where($data);
        if($like->count()>0){
            $like->delete();
        }else{
            Like::create($data);
        }

        return NULL;
    }
}
