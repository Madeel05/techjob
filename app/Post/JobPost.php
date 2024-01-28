<?php

namespace App\Post;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class JobPost
{

    protected $listing;
    protected $str;

    public function __construct(Listing $listing, Str $str)
    {
        $this->listing = $listing;
        $this->str = $str;
    }

    public function getImagePath($data)
    {
        return $data->file('feature_image')->store('images', 'public');
    }

    public function store(Request $data)
    {
        $image_path = $this->getImagePath($data);
        $this->listing->user_id = auth()->user()->id;
        $this->listing->feature_image = $image_path;
        $this->listing->title = $data->title;
        $this->listing->description = $data->description;
        $this->listing->roles = $data->roles;
        $this->listing->job_type = $data->job_type;
        $this->listing->address = $data->address;
        $this->listing->application_close_date = \Carbon\Carbon::createFromFormat('m/d/Y', $data->application_close_date)->format('Y-m-d');
        $this->listing->salary = $data->salary;
        $this->listing->slug = $this->str->slug($data->title) . '.' . $this->str->uuid();
        $this->listing->save();
    }

    public function updatePost(int $id, Request $data)
    {
        if ($data->hasFile('feature_image')) {
            $this->listing->find($id)->update(['feature_image', $this->getImagePath($data)]);
        }
        $this->listing->find($id)->update($data->except('feature_image'));
    }
}
