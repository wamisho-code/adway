<?php

namespace App\Http\Controllers;

use App\Models\BillBorad;
use App\Models\Booking;
use Carbon\Carbon;
use Cloudinary\Configuration\Configuration;
use App\Models\User;
use Illuminate\Http\Request;
use Cloudinary\Api\Upload\UploadApi;

use function PHPUnit\Framework\returnValueMap;
use Cloudinary\Api\Admin\AdminApi;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    
    public function bookingForm($id){
        $billboard=BillBorad::findOrFail($id);
        $owner =User::findOrFail($billboard->owner_id);
        return view('booking',compact('billboard','owner'));
    }
    public function saveBooking(Request $request){
        
            $data= $request->validate([
                "available_to"=> ["required", "date"],
                "available_from"=> ["required", "date"],
                "video" => ["required", "mimes:mp4,avi,mov,webm", "max:20000"],
                "billboard_id" => ["required"],
                "owner_id" => ["required", "exists:users,id"]
            ]);
            Configuration::instance([
                'cloud' => [
                    'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                    'api_key' => env('CLOUDINARY_API_KEY'),
                    'api_secret' => env('CLOUDINARY_API_SECRET'),
                ],
                'url' => ['secure' => true]
            ]);
    
            try {
                $upload = (new UploadApi())->upload(
                    $request->file('video')->getRealPath(),
                    [
                        'resource_type' => 'video',
                        'folder' => 'ad_videos'
                    ]
                );

                $videoUrl = $upload['secure_url'];
                $days = Carbon::parse($data["available_from"])->diffInDays(Carbon::parse($data["available_to"])) + 1;
                $billboard = Billborad::find($data['billboard_id']);
                $totalPrice = $days * $billboard->price_per_day;
            
                $bookingData=[
                    "billboard_id"=>$data["billboard_id"],
                    "advertiser_id"=>Auth::user()->id,
                    "owner_id"=>$data["owner_id"],
                    "video_path"=>$videoUrl,
                    "start_date"=>$data["available_from"],
                    "end_date"=>$data["available_to"],
                    "price"=>$totalPrice,
                    'payment_status'=>'pending'
                ];
                $booking = Booking::create($bookingData);
                if(!$booking){
                    return back()->with("error" ,"Bookinf Failed");
                }
                return back()->with("success","You have Booked your add Successfully!!!");
            }catch (\Exception $e) {
                return back()->with('error', 'Failed to save Booking: ' . $e->getMessage());
            }
    }
  
    public function getBookings(Request $request)
    {
        if (Auth::user()->type !== "Billboard Owner") {
            abort(403, 'Unauthorized action.');
        }

        $owner_id = Auth::id();
        $query = Booking::with(['billboard', 'advertiser'])  // eager load relationships
            ->where('owner_id', $owner_id)->where("admin_approval", "approved");

        if ($request->filled('status')) {
            $query->where('payment_status', $request->status);
        }

        $bookings = $query->latest()->get();

        return view('bookinglist', compact('bookings'));
    }
    

    public function seeBooked(){
        if (Auth::user()->type != "Advertiser") {
            abort(403, 'Unauthorized action.');
        }
        $adveriser_id=Auth::id();
        $bookings= Booking::where("advertiser_id",$adveriser_id)->latest()->get();
        return view('booked',compact("bookings")); 

    }
   
    public function deleteBooking($id){
        if (Auth::user()->type != "Advertiser") {
            abort(403, 'Unauthorized action.');
        }
        $booked =Booking::findOrFail($id);
        Configuration::instance([
            'cloud' => [
                'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                'api_key' => env('CLOUDINARY_API_KEY'),
                'api_secret' => env('CLOUDINARY_API_SECRET'),
            ],
            'url' => ['secure' => true]
        ]);

        try {
            if ($booked->video_path) {
                $publicId = $this->extractCloudinaryPublicId($booked->video_path);
                if ($publicId) {
                    (new UploadApi())->destroy($publicId, ['resource_type' => 'video']);
                }
            }
            $booked->delete();
            return back()->with("success", "Booking successully deleted");
        } catch (\Exception $e) {
             return back()-> with("error","Cloudinary delete failed: " . $e->getMessage());
        }
    
    }
    private function extractCloudinaryPublicId(string $url): ?string
    {
        $path = parse_url($url, PHP_URL_PATH);
        if (!$path)
            return null;

        // Remove leading slash
        $publicIdWithFolders = ltrim($path, '/');

        // Remove file extension (e.g., .mp4)
        $publicIdWithFolders = preg_replace('/\.[^.]+$/', '', $publicIdWithFolders);

        // Cloudinary URLs usually have '/upload/' segment, remove everything before and including that
        if (strpos($publicIdWithFolders, 'upload/') !== false) {
            $publicIdWithFolders = substr($publicIdWithFolders, strpos($publicIdWithFolders, 'upload/') + 7);
        }

        return $publicIdWithFolders;
    }



}
