<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\Product;
use App\Models\Backend\Category;
use App\Models\Backend\Genre;
use App\Models\Backend\Cast;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;


class SerieController extends Controller
{
    public function Series()
    {
        $series = Product::where('type', 'serie')->latest()->get();
        $activeSeries = Product::where('type', 'serie')->where('status', 1)->latest()->get();
        $inActiveSeries = Product::where('type', 'serie')->where('status', 0)->latest()->get();
        return view('backend.series.series_index',compact('series','activeSeries','inActiveSeries'));
    }// End Method

    public function SerieInactive($id)
    {

        Product::findOrFail($id)->update(['status' => 0]);
        $notification = array(
            'message' => 'Product Inactive',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }// End Method

    public function SerieActive($id)
    {

        Product::findOrFail($id)->update(['status' => 1]);
        $notification = array(
            'message' => 'Product Active',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }// End Method

    public function SeriesCreate()
    {
        return view('backend.series.series_create');
    }// End Method

    public function SeriesStore(Request $request)
    {
        //Log::info($request->all());
        //dd($request->all());
        // Validate the request
        $validatedData = $request->validate([
            'code' => 'required',
            'title' => 'required',
            'description' => 'required',
            'short_descp' => 'required',
            'release_date' => 'required',
            'runtime' => 'required',
            'video_format' => 'required',
            'rating' => 'required',
            'trailer' => 'required',
            'selling_price' => 'required',
            'discount_price' => 'required',
            'category_id' => 'nullable|string',
            'genre_id' => 'nullable|string',
            'cast_id' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Check if product with the given code already exists
        $existingProduct = Product::where('code', $validatedData['code'])->first();
        if ($existingProduct) {
            return redirect()->back()->withInput()->withErrors([
                'message' => 'Series with the given code already exists.',
            ]);
        }

        // Handle file upload if photo is provided
        $imageName = null;
        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $imagePath = 'upload/product_images/' . $name_gen;
            Image::make($image)->resize(300, 450)->save(public_path($imagePath));
            $imageName = $name_gen;
        }

        // Create new product (movie)
        $serie = new Product();
        $serie->code = $validatedData['code'];
        $serie->title = $validatedData['title'];
        $serie->slug = strtolower(str_replace(' ', '-', $validatedData['title']));
        $serie->description = $validatedData['description'];
        $serie->short_descp = $validatedData['short_descp'];
        $serie->release_date = $validatedData['release_date'];
        $serie->runtime = $validatedData['runtime'];
        $serie->video_format = $validatedData['video_format'];
        $serie->rating = $validatedData['rating'];
        $serie->trailer = $validatedData['trailer'];
        $serie->selling_price = $validatedData['selling_price'];
        $serie->discount_price = $validatedData['discount_price'];
        $serie->photo = $imageName;
        $serie->user_id = auth()->user()->id;
        $serie->type = 'serie';
        $serie->status = 1;
        $serie->save();

        // Process categories
        if (!empty($validatedData['category_id'])) {
            $categoryArray = json_decode($validatedData['category_id'], true);
            foreach ($categoryArray as $categoryItem) {
                $categoryName = $categoryItem['value'];
                $category = Category::firstOrCreate(['name' => trim($categoryName)], [
                    'slug' => Str::slug($categoryName),
                    'type' => 'serie',
                ]);
                $serie->categories()->attach($category->id);
            }
        }

        // Process genres
        if (!empty($validatedData['genre_id'])) {
            $genreArray = json_decode($validatedData['genre_id'], true);
            foreach ($genreArray as $genreItem) {
                $genreName = $genreItem['value'];
                $genre = Genre::firstOrCreate(['name' => trim($genreName)], [
                    'slug' => Str::slug($genreName),
                    'type' => 'serie',
                ]);
                $serie->genres()->attach($genre->id);
            }
        }

        // Process casts
        if (!empty($validatedData['cast_id'])) {
            $castArray = json_decode($validatedData['cast_id'], true);
            foreach ($castArray as $castItem) {
                $castName = $castItem['value'];
                $cast = Cast::firstOrCreate(['name' => trim($castName)], [
                    'slug' => Str::slug($castName),
                ]);
                $serie->casts()->attach($cast->id);
            }
        }

        // Success notification
        return redirect()->route('series')->with([
            'message' => 'Movie Created Successfully',
            'alert-type' => 'success',
        ]);

    }// End Method

    public function SerieEdit($id)
    {
        $serie = Product::find($id);
        $categories = $serie->series_categories;
        $genres = $serie->series_genres;
        $casts = $serie->series_casts;
        return view('backend.series.series_edit', compact('id', 'serie', 'categories', 'genres','casts'));
    }// End Method

    public function SerieUpdate(Request $request)
    {
        $id = $request->id;
        $serie = Product::find($id);
        $serie->title = $request->title;
        $serie->code = $request->code;
        $serie->slug = strtolower(str_replace(' ', '-', $request->input('title')));
        $serie->description = $request->description;
        $serie->short_descp = $request->short_descp;
        $serie->release_date = $request->release_date;
        $serie->runtime = $request->runtime;
        $serie->video_format = $request->video_format;
        $serie->rating = $request->rating;
        $serie->trailer = $request->trailer;
        $serie->selling_price = $request->selling_price;
        $serie->discount_price = $request->discount_price;
        $serie->user_id = auth()->user()->id;
        $serie->type = 'serie';
        $serie->status = 1;

        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('upload/product_images/'.$data->photo));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/product_images'),$filename);
            $serie['photo'] = $filename;
        }

        $serie->save();

        // Update PostCategories
        $categoryNames = explode(',', $request->input('category_id'));
        $categoryIds = [];
        foreach ($categoryNames as $categoryName) {
            $category = Category::firstOrCreate(['name' => trim($categoryName)]);
            $category->slug = Str::slug($category->name);
            $category->type = 'serie';
            $category->save();
            $categoryIds[] = $category->id;
        }
        $serie->series_categories()->sync($categoryIds);

        // Update PostTags
        $genreNames = explode(',', $request->input('genre_id'));
        $genreIds = [];
        foreach ($genreNames as $genreName) {
            $genre = Genre::firstOrCreate(['name' => trim($genreName)]);
            $genre->slug = Str::slug($genre->name);
            $genre->type = 'serie';
            $genre->save();
            $genreIds[] = $genre->id;
        }
        $serie->series_genres()->sync($genreIds);

        // Update PostTags
        $castNames = explode(',', $request->input('cast_id'));
        $castIds = [];
        foreach ($castNames as $castName) {
            $cast = Cast::firstOrCreate(['name' => trim($castName)]);
            $cast->slug = Str::slug($cast->name);
            $cast->save();
            $castIds[] = $cast->id;
        }
        $serie->casts()->sync($castIds);

        $notification = array(
            'message' => 'Serie Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('series')->with($notification);
    }// End Method

    public function SerieDestroy($id)
    {
        $serie = Product::findOrFail($id);
        $imagePath = public_path('upload/product_images/' . $serie->photo);
        if (file_exists($imagePath) && is_file($imagePath)) {
            unlink($imagePath);
        }

        $serie->delete();

        $notification = array(
            'message' => 'Serie Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('series')->with($notification);
    }// End Method
}
