<?php

    namespace App\Http\Controllers;
    use Illuminate\Support\Facades\DB;
    use App\Models\Banner;
    use App\Models\Coupon;
    use App\Models\User;
    use App\Models\Order;
    use App\Models\Address;
    use App\Models\Role;
    use App\Models\CMS;
    use App\Models\Contact;
    use App\Models\Category;
use App\Models\ProductImage;
use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Support\Facades\Validator;
    use JWTAuth;
    use Tymon\JWTAuth\Exceptions\JWTException;

    class UserController extends Controller
    {
        public function authenticate(Request $request)
        {

            $credentials = $request->only('email', 'password');
            $email=$request['email'];
            try {
                if (! $token = JWTAuth::attempt($credentials)) {
                    return response()->json(['error' => 'invalid_credentials'], 400);
                }
            } catch (JWTException $e) {
                return response()->json(['error' => 'could_not_create_token'], 500);
            }
            $message="Logged in successfully";
            return response()->json(compact('token','message','email'));

        }

        public function register(Request $request)
        {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6|confirmed',
                'password_confirmation' => 'required|string|min:6',
            ]);

            if($validator->fails()){
                    return response()->json($validator->errors()->toJson(), 400);
            }

            $user = User::create([
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'password' => Hash::make($request->get('password')),
                'password_confirmation' => Hash::make($request->get('password')),
                
            ]);

            $token = JWTAuth::fromUser($user);

            return response()->json(compact('user','token'),201);
        }

        public function getAuthenticatedUser()
        {
            try {
                    if (! $user = JWTAuth::parseToken()->authenticate()) {
                        return response()->json(['user_not_found'], 404);
                    }

                    } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

                            return response()->json(['token_expired'], $e->getStatusCode());

                    } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

                            return response()->json(['token_invalid'], $e->getStatusCode());

                    } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

                            return response()->json(['token_absent'], $e->getStatusCode());

                    }
                    return response()->json(compact('user'));
        }
        public function logout() {
            JWTAuth::invalidate(JWTAuth::getToken());
            return response()->json(['message' => 'User successfully signed out']);
        }
        /* Api For contact us form */
        public function contactUs(Request $request){
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email'=>'required',
                'title' => 'required',
                'description' => 'required|min:10',
            ]);
            if($validator->fails()){
                return response()->json($validator->errors()->toJson(), 400);
            }
            $contact= new Contact;
            $contact->name=$request->get('name');
            $contact->email=$request->get('email');
            $contact->title=$request->get('title');
            $contact->description=$request->get('description');
            $contact->save();
            $message=["Contact Saved Successfully"];
            return response()->json(compact('message'));
        }
        /* Api for coupons */
        public function coupon(){
            $coupon=Coupon::all();
            return response()->json(compact('coupon'));
        }
        /* Api for categories rendering */
        public function category(){
            $category=Category::all();
            return response()->json(compact('category'));
        }
         /* Api for products rendering */
        public function product(){
            $productData = DB::select('SELECT products.id,products.name,products.description
                ,product_attributes.quantity,product_attributes.price,product_images.image_name,categories.id as category_id
                FROM categories JOIN products ON categories.id = products.category_id JOIN product_attributes
                ON product_attributes.product_id = products.id JOIN product_images ON product_images.product_id=products.id');
            //$images=ProductImage::all();
            $data=compact('productData');
            return response()->json(compact('data'));
        }
        /* Api for particular category products rendering */
        public function categoryProducts($id){
            $categoryProducts = DB::table('products')
            ->join('product_images', 'products.id', '=', 'product_images.product_id')
            ->join('product_attributes', 'products.id', '=', 'product_attributes.product_id')
            ->select('products.*', 'product_images.image_name', 'product_attributes.price', 'product_attributes.quantity')
            ->where('products.category_id', '=', $id)
            ->get();

        return response()->json(compact('categoryProducts'));
        }
        /* Api for cms rendering */
        public function cms(){
            $cms=CMS::all();
            return response()->json(compact('cms'));
        }
        /* Api for order  storing */
        public function order(Request $request){
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'pid'=>'required',
                'image' => 'required',
                'price' => 'required',
                'quantity' => 'required',
                'uid' => 'required',
            ]);
            if($validator->fails()){
                return response()->json($validator->errors()->toJson(), 400);
            }
            $order= new Order;
            $order->name=$request->get('name');
            $order->pid=$request->get('pid');
            $order->image=$request->get('image');
            $order->price=$request->get('price');
            $order->quantity=$request->get('quantity');
            $order->uid=$request->get('uid');
            if($order->save()){
                $message=["Order Saved Successfully"];
                return response()->json(compact('message'));
            }else{
                $message=["Unsuccessful"];
                return response()->json(compact('message'));
            }

        }
         /* Api for order  storing */
         public function address(Request $request){
            $validator = Validator::make($request->all(), [
                'first_name' => 'required',
                'last_name'=>'required',
                'email' => 'required',
                'postal' => 'required',
                'contact' => 'required',
                'address' => 'required',
                'payment_method' => 'required',
                'uid' => 'required',
            ]);
            if($validator->fails()){
                return response()->json($validator->errors()->toJson(), 400);
            }
            $address= new Address;
            $address->first_name=$request->get('first_name');
            $address->last_name=$request->get('last_name');
            $address->email=$request->get('email');
            $address->postal=$request->get('postal');
            $address->contact=$request->get('contact');
            $address->address=$request->get('address');
            $address->payment_method=$request->get('payment_method');
            $address->uid=$request->get('uid');
            if($address->save()){
                $message=["Address Saved Successfully"];
                return response()->json(compact('message'));
            }else{
                $message=["Unsuccessful"];
                return response()->json(compact('message'));
            }

        }
    }

   