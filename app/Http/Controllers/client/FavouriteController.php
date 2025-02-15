<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Favourite;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class FavouriteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($product)
    {
        $user = Auth::user();
        $isFavorite = $user->favorite_product()->where('product_id', $product)->count();

        if ($isFavorite == 0) {
            $user->favorite_product()->attach($product);

            return redirect()->back()->with('success', 'Product Successfully Added to Your Favorite List');
        } else {
            $user->favorite_product()->detach($product);
            return redirect()->back()->with('warning', 'Product Successfully Removed From Your Favorite List');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Favourite  $favourite
     * @return \Illuminate\Http\Response
     */
    public function show()
    {

        $data = [];
        $user = Auth::user();
        $data['favourites'] = $user->favorite_product()->with('img')->orderBy('id', 'desc')->paginate(15);

        $data['topRatedProducts'] = Product::orderBy('product_price', 'desc')->where('status', 1)->limit(4)->get();

        $data['recentProducts'] = Product::where('status', 1)->orderBy('id', 'asc')->limit(5)->get();
        return view('client.pages.Fovourite',  $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Favourite  $favourite
     * @return \Illuminate\Http\Response
     */
    public function edit(Favourite $favourite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Favourite  $favourite
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Favourite $favourite)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Favourite  $favourite
     * @return \Illuminate\Http\Response
     */
    public function destroy(Favourite $favourite)
    {
        //
    }
}
