<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostStoreRequest;
use App\Models\ImageCrud;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class ImageController extends Controller
{
    //
    public function postImageProfile(PostStoreRequest $request)
    {
        // Create Post
        try {
            //path image
            $imageName = Str::random(32) . "." . $request->image->getClientOriginalExtension();
            $postImage = ImageCrud::create([
                'user_id' => $request->user_id,
                // 'user_name' => $request->user_name,
                'image' => $imageName,
            ]);

            // $postImage = new ImageCrud();
            // $postImage->user_id = $request->user_id;
            // $postImage->username = $request->username;
            // $postImage->image = $request->$imageName;

            //save Image in Stroge folder
            Storage::disk('public')->put($imageName, file_get_contents($request->image));

            return response()->json([
                'success' => true,
                'message' => $postImage,
            ], 200);

            //retur Json Data Response
            // if ($postImage->save()) {
            //     Storage::disk('public')->put($imageName, file_get_contents($request->image));
            //     return response()->json([
            //         'sussces' => true,
            //         'image' => $postImage,
            //     ]);
            // } else {
            //     return response()->json([
            //         'sussces' => false,
            //         'image' => $postImage,
            //     ]);
            // }

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => "Error!",
            ], 500);
        }
    }
    public function getImageUrl($id)
    {

        $image = ImageCrud::where('user_id', $id)->first();
        if ($image) {
            return response()->json([
                'succese' => true,
                'image' => $image,
                'message' => 'Image Succesefully fetched'

            ], 200);
        } else {
            return response()->json([
                'message' => 'Image not found'

            ], 400);
        }

    }
}
