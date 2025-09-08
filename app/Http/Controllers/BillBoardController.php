<?php

namespace App\Http\Controllers;

use App\Models\BillBorad;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Exception;
use Illuminate\Http\Request;
use Cloudinary\Configuration\Configuration;
use Cloudinary\Api\Upload\UploadApi;
use Log;
use function PHPUnit\Framework\returnValueMap;
use Cloudinary\Api\Admin\AdminApi;
use Illuminate\Support\Facades\Auth;
class BillBoardController extends Controller
{
    public function takeNewBillBoard()
    {
        return view('addbb');
    }

    public function addNewBillBoard(Request $request)
    {

        $validated = $request->validate([
            "title" => ["required", "string"],
            "description" => ['required', 'string'],
            "location" => ["required", "string"],
            "photo" => ["required", "image"],
            "available_from" => ["required", "date"],
            "available_to" => ["required", "date"],
            "price_per_day" => ["required", "numeric"],
            "price_per_month" => ["nullable", "numeric"],
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
            $upload = (new UploadApi())->upload($request->file('photo')->getRealPath());
            $imageUrl = $upload['secure_url'];
           
            $ownerId = Auth::user()->id ?? 1;

            $billboardData = [
                'owner_id' => $ownerId,
                'title' => $validated['title'],
                'description' => $validated['description'],
                'location' => $validated['location'],
                'photo_path' => $imageUrl,
                'available_from' => $validated['available_from'],
                'available_to' => $validated['available_to'],
                'price_per_day' => $validated['price_per_day'],
                'price_per_month' => $validated['price_per_month'],
                'status' => 'available',

            ];

            

            Log::info("Saving Billboard:", $billboardData);

            $billboard = Billborad::create($billboardData);

            if (!$billboard) {
                return back()->with('error', 'Billboard not saved!');
            }

            return back()->with('success', 'Billboard uploaded and saved successfully.');
        } catch (\Exception $e) {
            Log::error("Error saving billboard: " . $e->getMessage());
            return back()->with('error', 'Failed to save billboard: ' . $e->getMessage());
        }
    }
    public function fetchBillBoard()
    {
        $billboards = Billborad::where('owner_id', Auth::id())->latest()->paginate(6);

        // return redirect()->route('home')->with(['billboards'=>$billboards]);
        return view('home',["owner"=>true,'billboards'=>$billboards]);

    }
    public function fetchAllBillBoard(){
        $allbb=BillBorad::paginate(7);
        
        return view('home',["showallbb" => true, "allbb" => $allbb]);
    
    }
    public function billboards()
    {
        $allbb = BillBorad::paginate(7);

        return view('billboards.partials.allbb', compact([ "allbb"]));

    }
    public function deleteBillBoard($id)
    {
        $billboard = BillBorad::findOrFail($id);

        Configuration::instance([
            'cloud' => [
                'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                'api_key' => env('CLOUDINARY_API_KEY'),
                'api_secret' => env('CLOUDINARY_API_SECRET'),
            ],
            'url' => ['secure' => true]
        ]);

        try {
            if ($billboard->photo_path) {
                $publicId = $this->extractCloudinaryPublicId($billboard->photo_path);
                if ($publicId) {
                    $admin = new AdminApi();
                    $admin->deleteAssets([$publicId]);
                }
            }
        } catch (\Exception $e) {
            \Log::error("Cloudinary delete failed: " . $e->getMessage());
        }
        $billboard->delete();

        return back()->with('success', 'Billboard deleted successfully.');
    }

    public function updateBillBoard(Request $request, $id)
    {
        $billboard = BillBorad::findOrFail($id);

        $validated = $request->validate([
            "title" => ["required", "string"],
            "description" => ['required', 'string'],
            "location" => ["required", "string"],
            "photo" => ["nullable", "image"], 
            "available_from" => ["required", "date"],
            "available_to" => ["required", "date"],
            "price_per_day" => ["required", "numeric"],
            "price_per_month" => ["nullable", "numeric"],
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
            $billboardData = [
                'title' => $validated['title'],
                'description' => $validated['description'],
                'location' => $validated['location'],
                'available_from' => $validated['available_from'],
                'available_to' => $validated['available_to'],
                'price_per_day' => $validated['price_per_day'],
                'price_per_month' => $validated['price_per_month'],
                'status' => 'available',
            ];

           
            if ($request->hasFile('photo')) {
                if ($billboard->photo_path) {
                    $publicId = $this->extractCloudinaryPublicId($billboard->photo_path);
                    if ($publicId) {
                        (new AdminApi())->deleteAssets([$publicId]);
                    }
                }

                $upload = (new UploadApi())->upload($request->file('photo')->getRealPath());
                $billboardData['photo_path'] = $upload['secure_url'];
            }

            $billboard->update($billboardData);

            return back()->with('success', 'Billboard updated successfully.');
        } catch (\Exception $e) {
            \Log::error("Billboard update failed: " . $e->getMessage());
            return back()->with('error', 'Failed to update billboard: ' . $e->getMessage());
        }
    }

    private function extractCloudinaryPublicId(string $url): ?string
    {
        $path = parse_url($url, PHP_URL_PATH);
        if (!$path)
            return null;

        $publicIdWithFolders = ltrim($path, '/');
        $publicIdWithFolders = preg_replace('/\.[^.]+$/', '', $publicIdWithFolders);

        $segments = explode('/', $publicIdWithFolders);
        return end($segments);
    }
    public function editForm($id)
    {
        $billboard = BillBorad::findOrFail($id);

        if ($billboard->owner_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('billboards.partials.updatebb', compact('billboard'));
    }
    public function searchBillboard(Request $request){
        $query = BillBorad::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('location', 'like', "%{$search}%");
            });
        }

        if ($request->filled('filter')) {
            $query->where('status', $request->filter);
        }

        $allbb = $query->latest()->paginate(9); // paginate your results
        return view('billboards.partials.allbb', compact('allbb'));
    }

}
