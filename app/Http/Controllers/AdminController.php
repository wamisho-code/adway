<?php

namespace App\Http\Controllers;
use App\Models\BillBorad;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{
    public function checkPermisson(){
        if (Auth::user()->is_admin != "yes") {
            abort(403, "Unauthorized action");
        }
    }
    private function searchAndFilter(Request $request, $baseQuery)
    {
        if ($request->filled('query')) {
            $search = $request->query('query');
            $baseQuery->where(function ($q) use ($search) {
                $q->whereHas('billboard', fn($q) => $q->where('title', 'like', "%{$search}%"))
                    ->orWhereHas('owner', fn($q) => $q->where('name', 'like', "%{$search}%"))
                    ->orWhereHas('advertiser', fn($q) => $q->where('name', 'like', "%{$search}%"))
                    ->orWhereHas('billboard', fn($q) => $q->where('location', 'like', "%{$search}%"));
            });
        }

        if ($request->filled('filter')) {
            switch ($request->filter) {
                case 'billboard':
                    $baseQuery->orderBy('created_at', 'desc');
                    break;
                case 'owner':
                    $baseQuery->orderBy('created_at', 'asc');
                    break;
                case 'advertiser':
                    $baseQuery->orderBy('net_payment', 'desc');
                    break;
                case 'location':
                    $baseQuery->orWhereHas('billboard', fn($q) => $q->where('location', 'like', "%{$search}%"));
                    break;
            }
        }

        return $baseQuery->paginate(15);
    }

    public function getAllBooking(Request $request)
    {
        $this->checkPermisson();

        $query = Booking::with(['billboard', 'owner', 'advertiser'])
            ->where("admin_approval", "pending");

        $bookings = $this->searchAndFilter($request, $query);

        return view('admin', [
            'bookings' => $bookings,
            'status' => 'pending',  
        ]);
    }
    public function deleteUser(Request $request,$id){
        $user=User::findOrFail($id);
        $user->delete();
        return redirect()->back()->with("success","Successfully deleted User!");
    }
    public function getAllApprovedBooking(Request $request)
    {
        $this->checkPermisson();

        $query = Booking::with(['billboard', 'owner', 'advertiser'])
            ->where("admin_approval", "approved");

        $bookings = $this->searchAndFilter($request, $query);

        return view('admin', [
            'bookings' => $bookings,
            'status' => 'approved',  
        ]);
    }

    public function getAllDeniedBooking(Request $request)
    {
        $this->checkPermisson();

        $query = Booking::with(['billboard', 'owner', 'advertiser'])
            ->where("admin_approval", "denied");

        $bookings = $this->searchAndFilter($request, $query);

        return view('admin', [
            'bookings' => $bookings,
            'status' => 'denied',  
        ]);
    }

    public function approveBooking(Request $request, $id)
    {
        $this->checkPermisson();
        $booking = Booking::findOrFail($id);
        $booking->net_payment = $booking->price - 100;
        $booking->admin_approval = "approved";
        $booking->save();
        return redirect()->back()->with('success', 'Booking approved!');
    }
    public function denieBooking(Request $request, $id)
    {
        $this->checkPermisson();
        $booking = Booking::findOrFail($id);
        $booking->admin_approval = "denied";
        $booking->save();
        return redirect()->back()->with('success', 'Booking denied!');
    }

    private function searchAndFilterUsers(Request $request, $baseQuery)
    {
        if ($request->filled('query')) {
            $search = $request->query('query');
            $baseQuery->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        if ($request->filled('filter')) {
            switch ($request->filter) {
                case 'latest':
                    $baseQuery->orderBy('created_at', 'desc');
                    break;
                case 'old':
                    $baseQuery->orderBy('created_at', 'asc');
                    break;
            }
        }

        return $baseQuery->paginate(15);
    }

    public function getAllOwners(Request $request)
    {
        $this->checkPermisson();

        $query = User::where('type', 'Billboard Owner')->withCount('billboards');
        $users = $this->searchAndFilterUsers($request, $query);

        return view('admin', ['users' => $users, 'status' => 'owners']);
    }

    public function getAllAdvertisers(Request $request)
    {
        $this->checkPermisson();

        $query = User::where('type', 'Advertiser')->withCount('bookings');
        $users = $this->searchAndFilterUsers($request, $query);

        return view('admin', ['users' => $users, 'status' => 'advertisers']);
    }
    public function searchAndFilterBillboards(Request $request, $baseQuery)
    {
        if ($request->filled('query')) {
            $search = $request->query('query');

            $baseQuery->where(function ($q) use ($search) {
                $q->where('price', 'like', "%{$search}%")
                ->orWhere('payment_status', 'like', "%{$search}%")
                ->orWhere('start_date', 'like', "%{$search}%")
                ->orWhere('end_date', 'like', "%{$search}%")
                ->orWhereHas('owner', function ($owner) use ($search) {
                    $owner->where('name', 'like', "%{$search}%");
                })
                ->orWhereHas('advertiser', function ($adv) use ($search) {
                    $adv->where('name', 'like', "%{$search}%");
                });
            });
        }

        if ($request->filled('filter')) {
            switch ($request->filter) {
                case 'latest':
                    $baseQuery->orderBy('created_at', 'desc');
                    break;
                case 'old':
                    $baseQuery->orderBy('created_at', 'asc');
                    break;
                case 'price-high':
                    $baseQuery->orderBy('price', 'desc');
                    break;
                case 'price-low':
                    $baseQuery->orderBy('price', 'asc');
                    break;
            }
        }

        return $baseQuery->paginate(15);
    }

    public function getBillboards(Request $request){
        $this->checkPermisson();
        $query =BillBorad::withCount('bookings');
        $query= $this->searchAndFilterBillboards($request,$query);
        return view('admin', ['billboards' => $query, 'status' => 'billboards']);
    }

}
