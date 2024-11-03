<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Attributes\Validate;
use Livewire\WithFileUploads;
use Livewire\Component;

class PostForm extends Component
{
    use WithFileUploads;

    #[Validate('required', message: 'Post title wajib di isi !')]
    #[Validate('min:3', message: 'Post title minimum 3 karakter')]
    #[Validate('max:150', message: 'Post title maximum 150 karakter')]
    public $title;

    #[Validate('required', message: 'Post content wajib di isi !')]
    #[Validate('min:3', message: 'Post content minimum 3 karakter')]
    #[Validate('max:150', message: 'Post content maximum 150 karakter')]
    public $content;

    #[Validate('required', message: 'Featured image wajib di isi !')]
    #[Validate('image', message: 'Featured image harus foto')]
    #[Validate('mimes:jpg,jpeg,png,svg,bmp,webp,gif', message: 'Featured image harus berformat jpg, jpeg, png')]
    #[Validate('max:2048', message: 'Featured image tidak boleh lebih dari 2MB')]
    public $featuredImage;

    public function savePost()
    {
        $this->validate();

        $imagePath = null;

        if ($this->featuredImage){
            $imageName = time().'.'.$this->featuredImage->extension();
            $imagePath = $this->featuredImage->storeAs('public/uploads', $imageName);
            $this->featuredImage->delete();
        }

        $post = Post::create([
            'title' => $this->title,
            'content' => $this->content,
            'featured_image' => $imagePath,
        ]);

        if ($post){
            session()->flash('success', 'Post dibuat');
        }
        else {
            session()->flash('error', 'Post gagal dibuat');
        }

        return $this->redirect('/posts', navigate:true);
    }

    public function render()
    {
        return view('livewire.post-form')->title('Create Post');
    }
}
