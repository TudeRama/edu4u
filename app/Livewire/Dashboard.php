<?php

namespace App\Livewire;

use App\Models\Admin;
use App\Models\Kategori;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class Dashboard extends Component
{
    use WithFileUploads;
    public $nama;
    public $author;
    public $deskripsi;
    public $kategori_id;
    public $gambar;
    public $file;
    public $book_id;
    public $kataKunci;
    public function render()
    {
        if ($this->kataKunci != null) {
            $data = Admin::where('nama','like','%'. $this->kataKunci .'%')->paginate(5);
        } else {
            $data = Admin::where('user_id',Auth::user()->id)->paginate(5);
        }
        $data2 = Kategori::all();
        return view('livewire.dashboard',['data'=>$data, 'data2'=>$data2]);
    }

    public function storeData(){
        $save = new Admin();
        $this->validate([
            'nama'=>'required',
            'author'=>'required',
            'deskripsi'=>'required',
            'kategori_id'=>'required',
            'gambar'=>'required|mimes:png,jpg|max:2048',
            'file'=>'required'
        ]);
        $save->nama = $this->nama;
        $save->author = $this->author;
        $save->deskripsi = $this->deskripsi;
        $save->kategori_id = $this->kategori_id;
        $save->gambar = $this->gambar->store('uploadGambar');
        $save->file = $this->file->store('uploadFile');
        $save->user_id = Auth::user()->id;
        $save->save();
        $this->clear();
        session()->flash('success','Data berhasil di tambahkan');
    }

    public function edit($id){
        $data = Admin::find($id);
            $this->nama = $data->nama;
            $this->author = $data->author;
            $this->deskripsi = $data->deskripsi;
            $this->gambar = $data->gambar;
            $this->kategori_id = $data->kategori_id;
            $this->file = $data->file;
            $this->book_id = $id;
    }

    public function clear(){
        $this->nama = '';
        $this->author = '';
        $this->deskripsi = '';
        $this->gambar = '';
        $this->file = '';
        $this->kategori_id = '';
    }

    public function updateData(){
        $save = Admin::find($this->book_id);

        $save->nama = $this->nama;
        $save->author = $this->author;
        $save->deskripsi = $this->deskripsi;
        $save->kategori_id = $this->kategori_id;
        if ($this->gambar) {
            $save->gambar = $this->gambar->store('uploadGambar');
        }
        if ($this->file) {
            $save->file = $this->file->store('uploadFile');
        } 

        $save->user_id = Auth::user()->id;
        $save->save();
        $this->clear();
        session()->flash('success','Data berhasil di update');
    }

    public function delConfirm($id){
        if ($id != '') {
            $this->book_id=$id;
        }
    }

    public function delete(){
        if ($this->book_id != '') {
            Admin::find($this->book_id)->delete();
        }
        session()->flash('success','Data berhasil di delete');
    }
}
