<?php

namespace App\Http\Controllers\vendor;

use App\Http\Controllers\Controller;
use App\Models\meserments;
use App\Models\product_color;
use App\Models\ProductImage;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class ProductController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('vendor.components.Products');
    }



    public function getProductData()
    {
        $userid = Auth::guard('vendor')->user()->id;

        $result = json_decode(Product::with(['getCategory', 'getBrand', 'image', 'vendor'])->where('products.vendor_id', $userid)->orderBy('id', 'desc')->get());

        return $result;
    }



    public function store(Request $request)
    {



        $data = json_decode($_POST['data']);
        $name = $data['0']->name;
        $description = $data['0']->description;
        $product_price = $data['0']->product_price;
        $product_selling_price = $data['0']->product_selling_price;
        $product_quantity = $data['0']->product_quantity;
        $category_id = $data['0']->category_id;
        $brand_id = $data['0']->brand_id;
        $stock = $data['0']->stock;
        $feture_products = $data['0']->feture_products;
        $status = $data['0']->status;
        $pdmesermentValue = $data['0']->pdmesermentValue;
        $product_colors = $data['0']->product_colors;
        $selectedmesermentId = $data['0']->selectedmesermentId;
        $userid = Auth::guard('vendor')->user()->id;

        $slug = Str::slug($name);
        $next = 2;
        while (Product::where('slug', '=', $slug)->first()) {
            $slug = $slug . "-" . $next;
            $next++;
        }

        $result = new Product();
        $result->name = $name;
        $result->description = $description;
        $result->product_price = $product_price;
        $result->product_selling_price = $product_selling_price;
        $result->product_quantity = $product_quantity;
        $result->category_id = $category_id;
        $result->brand_id = $brand_id;
        $result->stock = $stock;
        $result->feture_products = $feture_products;
        $result->product_meserment_type = $selectedmesermentId;
        $result->status = $status;
        $result->slug = $slug;
        $result->vendor_id = $userid;
        $result->save();
        $last_id = $result->id;


        if (count($request->images) > 0) {
            $i = 0;
            foreach ($request->images as $image) {

                $img = time() . $i . '.' . $image->getClientOriginalExtension();
                $image->move('storage', $img);
                $productImageOnehost = $_SERVER['HTTP_HOST'];
                $host = $_SERVER['HTTP_HOST'];
                $protocol = $_SERVER['PROTOCOL'] = isset($_SERVER['HTTPS']) && !empty($_SERVER['HTTPS']) ? 'https://' : 'http://';
                $productImageOnelocation = $protocol . $productImageOnehost .  "/public/storage/" . $img;
                $imagemodel = new ProductImage();
                $imagemodel->image_path = "$productImageOnelocation";
                $imagemodel->product_id = $last_id;
                $imagemodel->save();
                $i++;
            }
        }

        if (count($pdmesermentValue) > 0) {

            for ($mersement = 0; $mersement < count($pdmesermentValue); $mersement++) {
                $pdmeserment = new meserments();
                $pdmeserment->product_id = $last_id;
                $pdmeserment->meserment_value = $pdmesermentValue[$mersement];
                $pdmeserment->save();
            }
        }
        if (count($product_colors) > 0) {

            for ($color = 0; $color < count($product_colors); $color++) {
                $pdmeserment = new product_color();
                $pdmeserment->product_color_product_id = $last_id;
                $pdmeserment->product_color_code = $product_colors[$color];
                $pdmeserment->save();
            }
        }



        if ($result == true) {
            return 1;
        } else {
            return 0;
        }
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
    public function edit(Request $req)
    {
        $id = $req->input('id');
        $result = json_encode(Product::with(['getCategory', 'getBrand', 'image', 'vendor', 'maserment', 'color'])->where('id', '=', $id)->get());
        return $result;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {


        $data = json_decode($_POST['data']);
        $product_id_edit = $data['0']->product_id_edit;
        $pdEditName = $data['0']->pdEditName;
        $pdEditDescription = $data['0']->pdEditDescription;
        $pdEditPrice = $data['0']->pdEditPrice;
        $pdEditOffer = $data['0']->pdEditOffer;
        $pdEditQuantity = $data['0']->pdEditQuantity;
        $pdEditCategory = $data['0']->pdEditCategory;
        $pdEditBrand = $data['0']->pdEditBrand;
        $pdEditStock = $data['0']->pdEditStock;
        $pdEditFeature = $data['0']->pdEditFeature;
        $pdEditStatus = $data['0']->pdEditStatus;
        $pdmesermentValueEdit = $data['0']->pdmesermentValueEdit;
        $slelctedmesermentEdit = $data['0']->slelctedmesermentEdit;
        $editedValueOfColor = $data['0']->editedValueOfColor;




        if ($pdmesermentValueEdit !== null) {
            meserments::where('product_id', $product_id_edit)->delete();

            for ($meserments = 0; $meserments < count($pdmesermentValueEdit); $meserments++) {
                $data = new meserments();
                $data->product_id = $product_id_edit;
                $data->meserment_value = $pdmesermentValueEdit[$meserments];
                $data->save();
            }
        }

        if (isset($editedValueOfColor)) {
            product_color::where('product_color_product_id', $product_id_edit)->delete();

            for ($colors = 0; $colors < count($editedValueOfColor); $colors++) {
                $dataColor = new product_color();
                $dataColor->product_color_code = $editedValueOfColor[$colors];
                $dataColor->product_color_product_id = $product_id_edit;
                $dataColor->save();
            }
        }




        if ($request->has('images')) {

            $ProductImage = ProductImage::where('product_id', $product_id_edit)->get();
            foreach ($ProductImage as  $product_has_images_value) {
                $delete_old_file = ProductImage::where('id', '=', $product_has_images_value->id)->first();
                $delete_old_file_name = (explode('/', $delete_old_file->image_path))[4];
                Storage::delete("public/" . $delete_old_file_name);
                $delete_old_file->delete();
            }



            $i = 0;
            foreach ($request->images as $image) {
                $img = time() . $i . '.' . $image->getClientOriginalExtension();
                $image->move('storage', $img);
                $productImageOnehost = $_SERVER['HTTP_HOST'];
                $protocol = $_SERVER['PROTOCOL'] = isset($_SERVER['HTTPS']) && !empty($_SERVER['HTTPS']) ? 'https://' : 'http://';

                $productImageOnelocation = $protocol . $productImageOnehost .  "/public/storage/" . $img;
                $imagemodel = new ProductImage();
                $imagemodel->image_path = $productImageOnelocation;
                $imagemodel->product_id = $product_id_edit;
                $imagemodel->save();
                $i++;
            }


            $result = Product::where('id', '=', $product_id_edit)->first();
            $result->name = $pdEditName;
            $result->description = $pdEditDescription;
            $result->product_price = $pdEditPrice;
            $result->product_selling_price = $pdEditOffer;
            $result->product_quantity = $pdEditQuantity;
            $result->category_id = $pdEditCategory;
            $result->brand_id = $pdEditBrand;
            $result->stock = $pdEditStock;
            $result->feture_products = $pdEditFeature;
            $result->status = $pdEditStatus;
            $result->product_meserment_type = $slelctedmesermentEdit;
            $status = $result->save();

            if ($status == true) {
                return 1;
            } else {
                return 0;
            }
        } else {

            $result = Product::where('id', '=', $product_id_edit)->first();
            $result->name = $pdEditName;
            $result->description = $pdEditDescription;
            $result->product_price = $pdEditPrice;
            $result->product_selling_price = $pdEditOffer;
            $result->product_quantity = $pdEditQuantity;
            $result->category_id = $pdEditCategory;
            $result->brand_id = $pdEditBrand;
            $result->stock = $pdEditStock;
            $result->feture_products = $pdEditFeature;
            $result->status = $pdEditStatus;
            $result->product_meserment_type = $slelctedmesermentEdit;
            $status = $result->save();

            if ($status == true) {
                return 1;
            } else {
                return 0;
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->input('id');
        $ProductImage = ProductImage::where('product_id', $id)->get();

        foreach ($ProductImage as  $product_has_images_value) {

            $delete_old_file = ProductImage::where('id', '=', $product_has_images_value->id)->first();
            $delete_old_file_name = (explode('/', $delete_old_file->image_path))[4];

            Storage::delete("public/" . $delete_old_file_name);
            $result2 = $delete_old_file->delete();
        }

        $product_maserments = meserments::where('product_id', $id)->get();
        foreach ($product_maserments as  $product_maserment) {

            $delete_old_meserment_data = meserments::where('id', '=', $product_maserment->id)->first();

            $result3 = $delete_old_meserment_data->delete();
        }

        $product_colors = product_color::where('product_color_product_id', $id)->get();
        foreach ($product_colors as  $product_color) {

            $delete_old_color_data = product_color::where('id', '=', $product_color->id)->first();

            $result4 = $delete_old_color_data->delete();
        }

        $data = Product::where('id', '=', $id)->first();
        $result = $data->delete();
        if ($result == true) {
            return 1;
        } else {
            return 0;
        }
    }
}
