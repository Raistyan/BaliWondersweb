<?php

namespace App\Http\Controllers\API;

use App\Models\Blog;
use App\Models\TravelPackage;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class TravelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $blogData = Blog::getBlog()->paginate(5);

        $blogData = Blog::with("category:id,name");

        $countBlogData = $blogData->count();

        $travelPackageData = TravelPackage::with("bookings", "galleries")->get();

        $data = isset($blogData) && isset($travelPackageData) ? [
            'blog_data' => $blogData->paginate($countBlogData),
            'travel_package_data' => $travelPackageData,
        ] : [];

        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validate fields
        $attrs = $request->validate([
            'deskripsi' => 'required|string',
            'created_date' => 'required'
        ]);

            $rembugdata = Meeting::create([
                'image' => "$request->image",
                'deskripsi' => $attrs['deskripsi'],
                'created_date' => $attrs['created_date'],
                'id_user' => auth()->user()->id
            ]);
   

        return response([
            'message' => 'Berhasil Upload.',
            'data' => $rembugdata,
            'users' => $rembugdata->id_user
        ], 200);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
