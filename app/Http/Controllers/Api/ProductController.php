<?php

namespace App\Http\Controllers\Api;

 use App\Http\Controllers\Controller;
use App\Http\Resources\ProductCollection;
 use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;
 use DB;
 use File;
 use Image;
 use URL;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
       $products=DB::table('product')
           ->select('folder','product.product_id','product_title','product_name','sku','purchase_price','product_stock','created_time','product_price','discount_price','feasured_image')
           ->join('product_relation','product.product_id','=','product_relation.product_id')
           ->orderBy('product_id','desc')->paginate(10);
       return new ProductCollection($products);

    }


    public function search($field,$query)
    {
        $products=DB::table('product')
            ->select('folder','product.product_id','product_title','product_name','sku','purchase_price','product_stock','created_time','product_price','discount_price','feasured_image')
            ->join('product_relation','product.product_id','=','product_relation.product_id')
            ->where($field,'LIKE',"%$query%")
            ->orderBy('product_id','desc')->paginate(10);
        return new ProductCollection($products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request,[
            'product_title' => 'required',
            'product_name' => 'required|unique:product',
            'product_price' => 'required',
            'product_price' => 'required',
            'sku' => 'required',



        ]);

        date_default_timezone_set('Asia/Dhaka');
        $data=array(); /// for product table
        $row_data=array(); /// for product relation table

        $media_path = 'uploads/' . $request->folder;
        $orginalpath = public_path() . '/uploads/' . $request->folder;
        $small = $orginalpath . '/' . 'small';
        $thumb = $orginalpath . '/' . 'thumb';


        File::makeDirectory($small, $mode = 0777, true, true);
        File::makeDirectory($thumb, $mode = 0777, true, true);

/// for product table
        $data['product_title'] = $request->product_title;
        $data['folder'] = $request->folder;
        $data['product_type'] = $request->product_type;
        $data['product_name'] = $request->product_name;
        $data['product_price'] = $request->product_price;
        $data['discount_price'] = $request->discount_price;
        $data['sku'] = $request->sku;
        $data['status'] = $request->status;
        $data['modified_time'] = date('Y-m-d H:i:s');

        /// for product relation table
        //$row_data['product_summary'] = $request->product_summary;
        // $row_data['product_terms'] = $request->product_terms;
        $row_data['purchase_price'] = $request->purchase_price;
        $row_data['delivery_in_dhaka'] = $request->delivery_in_dhaka;
        $row_data['delivery_out_dhaka'] = $request->delivery_out_dhaka;
        $row_data['product_description'] = $request->product_description;
        $row_data['product_stock'] = $request->product_stock;
        $row_data['product_video'] = $request->product_video;
        $row_data['website'] = $request->website;
        $row_data['created_time'] = date('Y-m-d H:i:s');
        $row_data['seo_title'] = $request->seo_title;
        $row_data['seo_keywords'] = $request->seo_keywords;
        $row_data['seo_description'] = $request->seo_description;

//        if ($request->discount_price) {
//            $price = $request->product_price - $request->discount_price;
//            $discount = round(($price * 100) / ($request->product_price));
//            $data['discount'] = $discount;
//        }


        $product_id = DB::table('product')->insertGetId($data);
        $featured_image_orgianal = $request->product_name.'-'.rand(1,500).'.' . explode('/', explode(':', substr($request->photo, 0, strpos($request->photo, ';')))[1])[1];
        $product_image1 = rand(1,5000).'.' . explode('/', explode(':', substr($request->photo1, 0, strpos($request->photo1, ';')))[1])[1];
        $product_image2 = rand(1,5000).'.' . explode('/', explode(':', substr($request->photo2, 0, strpos($request->photo2, ';')))[1])[1];
        $product_image3 = rand(1,5000).'.' . explode('/', explode(':', substr($request->photo3, 0, strpos($request->photo3, ';')))[1])[1];
        $product_image4 = rand(1,5000).'.' . explode('/', explode(':', substr($request->photo4, 0, strpos($request->photo4, ';')))[1])[1];
//        $product_image5 = rand(1,5000).'.' . explode('/', explode(':', substr($request->photo5, 0, strpos($request->photo5, ';')))[1])[1];

         



        if ($featured_image_orgianal) {
            $featured_image = $featured_image_orgianal;//$product_id . '.' . $featured_image_orgianal->getClientOriginalName();
            $destinationPath = $orginalpath;
            $resize_image = Image::make($request->photo);
            $resize_image->resize(700, 700, function ($constraint) {

            })->save($destinationPath . '/' . $featured_image);

            $resize_image->resize(200, 200, function ($constraint) {

            })->save($thumb . '/' . $featured_image);

            $resize_image->resize(50, 50, function ($constraint) {

            })->save($small . '/' . $featured_image);
            $image_row_data['feasured_image'] = $featured_image;
            $media_data['media_title'] = $request->product_title;
            $media_data['product_id'] = $product_id;
            $media_data['product_code'] = $request->sku;
            $media_data['created_time'] = date('Y-m-d H:i:s');
            $media_data['media_type'] = 'featured_image';
            $media_data['media_path'] = $media_path . '/' . $featured_image;
            DB::table('media')->insert($media_data);
            DB::table('product')->where('product_id', $product_id)->update($image_row_data);
        }

        if ($product_image1) {
            $featured_image = $product_image1;//$product_id . '.' . $featured_image_orgianal->getClientOriginalName();
            $destinationPath = $orginalpath;
            $resize_image = Image::make($request->photo1);
            $resize_image->resize(700, 700, function ($constraint) {

            })->save($destinationPath . '/' . $featured_image);

            $row_data['galary_image_1'] = $featured_image;
            $media_data['media_title'] = $request->product_title;
            $media_data['product_id'] = $product_id;
            $media_data['product_code'] = $request->sku;
            $media_data['created_time'] = date('Y-m-d H:i:s');
            $media_data['media_type'] = 'galary_image1';
            $media_data['media_path'] = $media_path . '/' . $featured_image;
            DB::table('media')->insert($media_data);
           // DB::table('product')->where('product_id', $product_id)->update($image_row_data);
        }

        if ($product_image2) {
            $featured_image = $product_image2;//$product_id . '.' . $featured_image_orgianal->getClientOriginalName();
            $destinationPath = $orginalpath;
            $resize_image = Image::make($request->photo2);
            $resize_image->resize(700, 700, function ($constraint) {

            })->save($destinationPath . '/' . $featured_image);

            $row_data['galary_image_2'] = $featured_image;
            $media_data['media_title'] = $request->product_title;
            $media_data['product_id'] = $product_id;
            $media_data['product_code'] = $request->sku;
            $media_data['created_time'] = date('Y-m-d H:i:s');
            $media_data['media_type'] = 'galary_image1';
            $media_data['media_path'] = $media_path . '/' . $featured_image;
            DB::table('media')->insert($media_data);
            // DB::table('product')->where('product_id', $product_id)->update($image_row_data);
        }
        if ($product_image3) {
            $featured_image = $product_image3;//$product_id . '.' . $featured_image_orgianal->getClientOriginalName();
            $destinationPath = $orginalpath;
            $resize_image = Image::make($request->photo3);
            $resize_image->resize(700, 700, function ($constraint) {

            })->save($destinationPath . '/' . $featured_image);

            $row_data['galary_image_3'] = $featured_image;
            $media_data['media_title'] = $request->product_title;
            $media_data['product_id'] = $product_id;
            $media_data['product_code'] = $request->sku;
            $media_data['created_time'] = date('Y-m-d H:i:s');
            $media_data['media_type'] = 'galary_image1';
            $media_data['media_path'] = $media_path . '/' . $featured_image;
            DB::table('media')->insert($media_data);
            // DB::table('product')->where('product_id', $product_id)->update($image_row_data);
        }
        if ($product_image4) {
            $featured_image = $product_image4;//$product_id . '.' . $featured_image_orgianal->getClientOriginalName();
            $destinationPath = $orginalpath;
            $resize_image = Image::make($request->photo4);
            $resize_image->resize(700, 700, function ($constraint) {

            })->save($destinationPath . '/' . $featured_image);

            $row_data['galary_image_4'] = $featured_image;
            $media_data['media_title'] = $request->product_title;
            $media_data['product_id'] = $product_id;
            $media_data['product_code'] = $request->sku;
            $media_data['created_time'] = date('Y-m-d H:i:s');
            $media_data['media_type'] = 'galary_image1';
            $media_data['media_path'] = $media_path . '/' . $featured_image;
            DB::table('media')->insert($media_data);
            // DB::table('product')->where('product_id', $product_id)->update($image_row_data);
        }
//        if ($product_image5) {
//            $featured_image = $product_image5;//$product_id . '.' . $featured_image_orgianal->getClientOriginalName();
//            $destinationPath = $orginalpath;
//            $resize_image = Image::make($request->photo5);
//            $resize_image->resize(700, 700, function ($constraint) {
//
//            })->save($destinationPath . '/' . $featured_image);
//
//            $row_data['galary_image_5'] = $featured_image;
//            $media_data['media_title'] = $request->product_title;
//            $media_data['product_id'] = $product_id;
//            $media_data['product_code'] = $request->sku;
//            $media_data['created_time'] = date('Y-m-d H:i:s');
//            $media_data['media_type'] = 'galary_image1';
//            $media_data['media_path'] = $media_path . '/' . $featured_image;
//            DB::table('media')->insert($media_data);
//            // DB::table('product')->where('product_id', $product_id)->update($image_row_data);
//        }
//        if ($product_image6) {
//            $featured_image = $product_image6;//$product_id . '.' . $featured_image_orgianal->getClientOriginalName();
//            $destinationPath = $orginalpath;
//            $resize_image = Image::make($request->photo6);
//            $resize_image->resize(700, 700, function ($constraint) {
//
//            })->save($destinationPath . '/' . $featured_image);
//
//            $row_data['galary_image_6'] = $featured_image;
//            $media_data['media_title'] = $request->product_title;
//            $media_data['product_id'] = $product_id;
//            $media_data['product_code'] = $request->sku;
//            $media_data['created_time'] = date('Y-m-d H:i:s');
//            $media_data['media_type'] = 'galary_image1';
//            $media_data['media_path'] = $media_path . '/' . $featured_image;
//            DB::table('media')->insert($media_data);
//            // DB::table('product')->where('product_id', $product_id)->update($image_row_data);
//        }


        $row_data['product_id']=$product_id;
        DB::table('product_relation')->insert($row_data);
        $category_id = $request->category_id;
        if($category_id) {
            foreach ($category_id as $key => $cat) {
                $category_data['product_id'] = $product_id;
                $category_data['category_id'] = $cat;
                DB::table('product_category_relation')->insert($category_data);

            }
        }
        if ($product_id) {
            return response()->json(['success'=>'created successfully']);
        } else {
            return response()->json(['error'=> 'Failded created successfully.']);
        }



    }


    public function show($product_id)
    {
       $data['data']= DB::table('product')
            ->join('product_relation','product_relation.product_id','=','product.product_id')
            ->where('product.product_id', $product_id)->first();
        return response()->json($data);
    }

    public function update(Request $request, $product_id)
    {

        $this->validate($request,[
            'product_title' => 'required',

            'product_price' => 'required',
            'product_price' => 'required',
            'sku' => 'required',

        ]);

        $product_row = DB::table('product')
            ->join('product_relation','product_relation.product_id','=','product.product_id')
            ->where('product.product_id', $product_id)
            ->first();



        $data=array();  /// for product table
        $row_data=array();  /// for product relation table
        date_default_timezone_set('Asia/Dhaka');

        $media_path = 'uploads/' . $request->folder;
        $orginalpath = public_path() . '/uploads/' . $request->folder;
        $small = $orginalpath . '/' . 'small';
        $thumb = $orginalpath . '/' . 'thumb';

        $data['product_title'] = $request->product_title;
        $data['folder'] = $request->folder;
        $data['product_name'] = $request->product_name;
        $data['product_price'] = $request->product_price;
        $data['product_type'] = $request->product_type;
        $data['discount_price'] = $request->discount_price;
        $data['sku'] = $request->sku;
        $data['modified_time'] = date('Y-m-d H:i:s');
        $data['status'] = $request->status;
        //   $data['product_summary'] = $request->product_summary;
        $row_data['purchase_price'] = $request->purchase_price;
        $row_data['website'] = $request->website;
        $row_data['delivery_in_dhaka'] = $request->delivery_in_dhaka;
        $row_data['delivery_out_dhaka'] = $request->delivery_out_dhaka;
        $row_data['product_description'] = $request->product_description;
        $row_data['product_stock'] = $request->product_stock;
        $row_data['product_video'] = $request->product_video;
        $row_data['created_time'] = date('Y-m-d H:i:s');
        $row_data['seo_title'] = $request->seo_title;
        $row_data['seo_keywords'] = $request->seo_keywords;
        $row_data['seo_description'] = $request->seo_description;

//        if ($request->discount_price) {
//            $price = $request->product_price - $request->discount_price;
//            $discount = round(($price * 100) / ($request->product_price));
//            $data['discount'] = $discount;
//        }

        DB::table('product')->where('product_id', $product_id)->update($data);

        if($request->photo) {

            $featured_image_orgianal = $request->product_name . '-' . rand(1, 500) . '.' . explode('/', explode(':', substr($request->photo, 0, strpos($request->photo, ';')))[1])[1];


            if ($featured_image_orgianal) {

                $old_feature=$product_row->feasured_image;
                if($old_feature){
                    $main_image=public_path().'/uploads/'.$product_row->folder.'/'.$old_feature;
                    $small_image=public_path().'/uploads/'.$product_row->folder.'/small/'.$old_feature;
                    $thumb_image=public_path().'/uploads/'.$product_row->folder.'/thumb/'.$old_feature;
                    if(file_exists($main_image)){

                        @unlink($main_image);
                        @unlink($small_image);
                        @unlink($thumb_image);
                    }

                }
                $featured_image = $featured_image_orgianal;//$product_id . '.' . $featured_image_orgianal->getClientOriginalName();
                $destinationPath = $orginalpath;
                $resize_image = Image::make($request->photo);
                $resize_image->resize(700, 700, function ($constraint) {

                })->save($destinationPath . '/' . $featured_image);

                $resize_image->resize(200, 200, function ($constraint) {

                })->save($thumb . '/' . $featured_image);

                $resize_image->resize(50, 50, function ($constraint) {

                })->save($small . '/' . $featured_image);
                $data['feasured_image'] = $featured_image;
                $media_data['media_title'] = $request->product_title;
                $media_data['product_id'] = $product_id;
                $media_data['product_code'] = $request->sku;
                $media_data['created_time'] = date('Y-m-d H:i:s');
                $media_data['media_type'] = 'featured_image';
                $media_data['media_path'] = $media_path . '/' . $featured_image;
                DB::table('media')->insert($media_data);
                DB::table('media')->where('product_id', $product_id)->where('media_type', 'featured_image')->update($media_data);

            }

        }
        //$featured_image_orgianal = $request->file('featured_image');
        $product_image1 = $request->file('product_image1');
        $product_image2 = $request->file('product_image2');
        $product_image3 = $request->file('product_image3');
        $product_image4 = $request->file('product_image4');
        $product_image5 = $request->file('product_image5');
        $product_image6 = $request->file('product_image6');

        if ($product_image1) {

            $old_feature=$product_row->galary_image_1;
            if($old_feature){
                $main_image=public_path().'/uploads/'.$product_row->folder.'/'.$old_feature;

                if(file_exists($main_image)){

                    @unlink($main_image);

                }

            }
            $random_number1 = rand(10, 100);
            $galary_image1 = $random_number1 . '.' . $product_image1->getClientOriginalName();
            $destinationPath = $orginalpath;
            $resize_galary_image1 = Image::make($product_image1->getRealPath());
            $resize_galary_image1->resize(700, 700, function ($constraint) {

            })->save($destinationPath . '/' . $galary_image1);
            $row_data['galary_image_1'] = $galary_image1;
            $media_data['media_title'] = $request->product_title;
            $media_data['product_id'] = $product_id;
            $media_data['product_code'] = $request->sku;
            $media_data['created_time'] = date('Y-m-d H:i:s');
            $media_data['modified_time'] = date('Y-m-d H:i:s');
            $media_data['media_path'] = $media_path . '/' . $galary_image1;
            $media_data['media_type'] = 'galary_image_1';
            DB::table('media')->where('product_id', $product_id)->where('media_type', 'galary_image_1')->update($media_data);


        }
        if ($product_image2) {


            $old_feature=$product_row->galary_image_2;
            if($old_feature){
                $main_image=public_path().'/uploads/'.$product_row->folder.'/'.$old_feature;

                if(file_exists($main_image)){

                    @unlink($main_image);

                }

            }
            $random_number2 = rand(10, 100);
            $galary_image2 = $random_number2 . '.' . $product_image2->getClientOriginalName();
            $destinationPath = $orginalpath;
            $resize_galary_image2 = Image::make($product_image2->getRealPath());
            $resize_galary_image2->resize(700, 700, function ($constraint) {

            })->save($destinationPath . '/' . $galary_image2);
            $row_data['galary_image_2'] = $galary_image2;

            $media_data['media_title'] = $request->product_title;
            $media_data['product_id'] = $product_id;
            $media_data['product_code'] = $request->sku;
            $media_data['created_time'] = date('Y-m-d H:i:s');
            $media_data['modified_time'] = date('Y-m-d H:i:s');
            $media_data['media_path'] = $media_path . '/' . $galary_image2;
            $media_data['media_type'] = 'galary_image_2';
            DB::table('media')->where('product_id', $product_id)->where('media_type', 'galary_image_2')->update($media_data);

        }
        if ($product_image3) {

            $old_feature=$product_row->galary_image_3;
            if($old_feature){
                $main_image=public_path().'/uploads/'.$product_row->folder.'/'.$old_feature;

                if(file_exists($main_image)){

                    @unlink($main_image);

                }

            }
            $random_number3 = rand(10, 100);
            $galary_image3 = $random_number3 . '.' . $product_image3->getClientOriginalName();
            $destinationPath = $orginalpath;
            $resize_galary_image3 = Image::make($product_image3->getRealPath());
            $resize_galary_image3->resize(700, 700, function ($constraint) {

            })->save($destinationPath . '/' . $galary_image3);
            $row_data['galary_image_3'] = $galary_image3;
            $media_data['media_title'] = $request->product_title;
            $media_data['product_id'] = $product_id;
            $media_data['product_code'] = $request->sku;
            $media_data['created_time'] = date('Y-m-d H:i:s');
            $media_data['modified_time'] = date('Y-m-d H:i:s');
            $media_data['media_path'] = $media_path . '/' . $galary_image3;
            $media_data['media_type'] = 'galary_image_3';
            DB::table('media')->where('product_id', $product_id)->where('media_type', 'galary_image_3')->update($media_data);

        }
        if ($product_image4) {
            $old_feature=$product_row->galary_image_4;
            if($old_feature){
                $main_image=public_path().'/uploads/'.$product_row->folder.'/'.$old_feature;

                if(file_exists($main_image)){

                    @unlink($main_image);

                }

            }
            $random_number4 = rand(10, 100);
            $galary_image4 = $random_number4 . '.' . $product_image4->getClientOriginalName();
            $destinationPath = $orginalpath;
            $resize_galary_image4 = Image::make($product_image4->getRealPath());
            $resize_galary_image4->resize(700, 700, function ($constraint) {

            })->save($destinationPath . '/' . $galary_image4);
            $row_data['galary_image_4'] = $galary_image4;
            $media_data['media_title'] = $request->product_title;
            $media_data['product_id'] = $product_id;
            $media_data['product_code'] = $request->sku;
            $media_data['created_time'] = date('Y-m-d H:i:s');
            $media_data['modified_time'] = date('Y-m-d H:i:s');
            $media_data['media_path'] = $media_path . '/' . $galary_image4;
            $media_data['media_type'] = 'galary_image_4';
            DB::table('media')->where('product_id', $product_id)->where('media_type', 'galary_image_4')->update($media_data);

        }
        if ($product_image5) {
            $old_feature=$product_row->galary_image_5;
            if($old_feature){
                $main_image=public_path().'/uploads/'.$product_row->folder.'/'.$old_feature;

                if(file_exists($main_image)){

                    @unlink($main_image);

                }

            }
            $random_number5 = rand(10, 100);
            $galary_image5 = $random_number5 . '.' . $product_image5->getClientOriginalName();
            $destinationPath = $orginalpath;
            $resize_galary_image5 = Image::make($product_image5->getRealPath());
            $resize_galary_image5->resize(700, 700, function ($constraint) {

            })->save($destinationPath . '/' . $galary_image5);
            $row_data['galary_image_5'] = $galary_image5;
            $media_data['media_title'] = $request->product_title;
            $media_data['product_id'] = $product_id;
            $media_data['product_code'] = $request->sku;
            $media_data['created_time'] = date('Y-m-d H:i:s');
            $media_data['modified_time'] = date('Y-m-d H:i:s');
            $media_data['media_path'] = $media_path . '/' . $galary_image5;
            $media_data['media_type'] = 'galary_image_5';
            DB::table('media')->where('product_id', $product_id)->where('media_type', 'galary_image_5')->update($media_data);

        }
        if ($product_image6) {

            $old_feature=$product_row->galary_image_6;
            if($old_feature){
                $main_image=public_path().'/uploads/'.$product_row->folder.'/'.$old_feature;

                if(file_exists($main_image)){

                    @unlink($main_image);

                }

            }
            $random_number6 = rand(10, 100);
            $galary_image6 = $random_number6 . '.' . $product_image6->getClientOriginalName();
            $destinationPath = $orginalpath;
            $resize_galary_image6 = Image::make($product_image6->getRealPath());
            $resize_galary_image6->resize(700, 700, function ($constraint) {

            })->save($destinationPath . '/' . $galary_image6);
            $row_data['galary_image_6'] = $galary_image6;
            $media_data['media_title'] = $request->product_title;
            $media_data['product_id'] = $product_id;
            $media_data['product_code'] = $request->sku;
            $media_data['created_time'] = date('Y-m-d H:i:s');
            $media_data['modified_time'] = date('Y-m-d H:i:s');
            $media_data['media_path'] = $media_path . '/' . $galary_image6;
            $media_data['media_type'] = 'galary_image_6';
            DB::table('media')->where('product_id', $product_id)->where('media_type', 'galary_image_6')->update($media_data);

        }

        DB::table('product')->where('product_id', $product_id)->update($data);
        DB::table('product_relation')->where('product_id', $product_id)->update($row_data);
        DB::table('product_category_relation')->where('product_id', $product_id)->delete();

//        $category_id = $request->category_id;
//        foreach ($category_id as $key => $cat) {
//            $category_data['product_id'] = $product_id;
//            $category_data['category_id'] = $cat;
//            DB::table('product_category_relation')->updateOrInsert($category_data);
//
//        }


        if ($product_id) {
            return response()->json(['success'=>'Updated successfully']);

        } else {
            return response()->json(['error'=>'Updated Faield']);
        }

    }



    public function FirstCategoryList(){
        $data['category']=DB::table('categories')
            ->select('category_id','category_title')
            ->where('parent_id',0)
            ->orderBy('category_id','desc')->get();
        return response()->json($data);

    }
    public function SecondCategoryList($id){
        $data['category']=DB::table('categories')
            ->select('category_id','category_title')
            ->where('parent_id',$id)
            ->orderBy('category_id','desc')->get();
        return response()->json($data);

    }
    public function folderCheck(){
        $product=DB::table('product')
            ->select('product_id')
            ->orderBy('product_id','desc')->first();
        if($product){
           $folder =$product->product_id+1;
        }else {
            $folder =1;
        }
        return response()->json(['folder'=>$folder]);
        

    }



    public function destroy($id)
    {
        $category = Category::findOrfail($id);
        $category->delete();
        return new CategoryResource($category);
    }

}
