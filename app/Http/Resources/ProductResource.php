<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray($request)
    {
        // Get all the fields from the model
        $data = parent::toArray($request);

        // Append the full image URL with port
        $data['image'] = $this->imageUrl();

        // Append the full gallery image URLs with port
        $data['gallery'] = $this->galleryUrls();

        return $data;
    }

    private function imageUrl()
    {
        // Assuming you have a base URL defined in your configuration
        $baseUrl = config('app.url');

        // You can customize the path based on your actual storage setup
        $imagePath = asset('storage/' . $this->image);

        return $imagePath;
    }

    private function galleryUrls()
    {
        // Assuming the gallery attribute is an array of file paths
        $gallery = collect(json_decode($this->gallery, true));

        // Generate full URLs for each gallery image
        $galleryUrls = $gallery->map(function ($image) {
            // Assuming you have a base URL defined in your configuration
            $baseUrl = config('app.url');

            // You can customize the path based on your actual storage setup
            $imagePath = asset('storage/' . $image);

            // Construct the full image URL with port if available
            return $imagePath;
        });

        return $galleryUrls;
    }
}
