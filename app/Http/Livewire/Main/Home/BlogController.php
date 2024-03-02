<?php

namespace App\Http\Livewire\Main\Home;

use Livewire\Component;
use GuzzleHttp\Client;

class BlogComponent extends Component
{
    public $blogs;

    public function render()
    {
        $client = new Client();
        $response = $client->get('https://www.skillmonde.com/blog/wp-json/wp/v2/posts?per_page=4&_embed');
        $this->blogs = json_decode($response->getBody());

        foreach ($this->blogs as $blog) {
            $blog->image_url = $blog->_embedded->{'wp:featuredmedia'}[0]->source_url;
        }

        return view('livewire.main.layout.app');
    }
}
