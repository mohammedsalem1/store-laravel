<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Category;
use App\Exceptions\Handler;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\STR;
use Illuminate\Support\Facades\Storage;
use App\Models\Rules;
use App\Http\Requests\CategoryRequest;


class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $request = request();
        // $query = Category::query();
        // if ($name = $request->query('name')) {
        //     $query->where('name' , 'LIKE' , "%{$name}%");
        // }
        // if ($status = $request->query('status')) {
        //     $query->where('status' , '=' , $status);
        // }
        // $categories = $query->paginate(1);
        $categories = Category::leftJoin('categories as parents' , 'parents.id' , '=' , 'categories.parent_id')
        ->select([
            'categories.*' ,
            'parents.name as parent_name'
        ])
        ->filter($request->query())
        ->paginate();

        return view('dashboard.categories.index' , compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parents = Category::all();
        $category = new Category();
        return view('dashboard.categories.create', compact('category' , 'parents'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate(Category::rules());
        $request->merge([
            'slug' => Str::slug($request->post('name'))
        ]);

        $data = $request->except('image');

         $data['image'] = $this->uploadeImage($request);
        // this case we don't need make save and the name Mass assigment

        $category = Category::create($data);
        // PRG
        return redirect()->route('dashboard.categories.index')
        ->with('success' , 'created category!');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
           $category = Category::findOrFail($id);

        }catch(\Exception $e) {
            return redirect()->route('dashboard.categories.index')
            ->with('info' , 'Record not found!');
        }
        $parents  = Category::where('id' , '<>' , $id)
      //  ->where(function($query) use ($id)) {
       //     $query->whereNull('parent_id')
       //       ->orWhere('parent_id' , '<>' , $id)
     //   }


        ->get();
        return view ('dashboard.categories.edit' , compact('category','parents'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
       // $request->validate(Category::rules($id));

        $category = Category::findOrFail($id);


        $old_image = $category->image;

        $data = $request->except('image');

        $new_Image = $this->uploadeImage($request);
        if ($new_Image) {
          $data['image'] = $new_Image;
        }

        $category->update($data);

        if ($old_image && $new_Image) {
            Storage::disk('public')->delete($old_image);
        }

        return redirect()->route('dashboard.categories.index')
        ->with('success' , 'updated Category!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        // if ($category -> image) {
        //     Storage::disk('public') -> delete($category->image);
        // }
        return redirect()->route('dashboard.categories.index')
        -> with('success' , 'delete Category');
    }
    public function trash() {
        $categories = Category::onlyTrashed()->paginate();
        return view('dashboard.categories.trash' , compact('categories'));
    }

    public function restore(Request $request , $id) {
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->restore();
        return redirect()->route('dashboard.categories.trash')
        ->with('success' , "Category restored");
    }

    public function forceDelete($id) {
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->forceDelete();

        return redirect()->route('dashboard.categories.trash')
        ->with('success' , "Category Deleted forever");

    }


    protected function uploadeImage(Request $request) {
      if (!$request->hasFile('image')) {
        return;
      }
      $file = $request->file('image');
      $path = $file->store('uploads' , [
        'disk' => 'public'
      ]);
      return $path;
    }
}
