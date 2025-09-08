<?php

namespace App\Http\Controllers;

use App\Models\BillBorad;
use App\Models\Booking;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
class PaymentController extends Controller
{
    public function getFullStat(Request $request)
    {
        if (!Auth::check() || Auth::user()->type != "Billboard Owner") {
            abort(403, 'Unauthorized action.');
        }

        $range = $request->input('range', 'lifetime');
        $owner = Auth::id();

        $query = Booking::where('owner_id', $owner)->with('billboard');

        switch ($range) {
            case 'day':
                $query->whereDate('created_at', today());
                break;
            case 'week':
                $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
                break;
            case 'month':
                $query->whereMonth('created_at', now()->month)->whereYear('created_at', now()->year);
                break;
            case 'year':
                $query->whereYear('created_at', now()->year);
                break;
        }

        $booking = $query->get();

        $totalEarnings = $booking->sum('net_payment');
        $totalBookings = $booking->count();

        $bookingStatus = $booking->groupBy('admin_approval')->map->count();
        $paymentStatus = $booking->groupBy('payment_status')->map->count();
        $earningOverTime = $booking->groupBy(fn($b) => $b->created_at->format('Y-m-d'))->map->sum('net_payment');

       
        // 1. Average Booking Value
        $averageBookingValue = $totalBookings > 0 ? $totalEarnings / $totalBookings : 0;

        // 2. Peak Earning Day
        $peakEarningDay = $earningOverTime->sortDesc()->keys()->first();
        $peakEarningAmount = $earningOverTime->max();
        
        
        // 3. Most Common Booking Duration (in days)


        $bookingDurations = $booking->map(function ($b) {
            return Carbon::make($b->start_date)->diffInDays(Carbon::make($b->end_date));
        });

        $mostCommonDuration = $bookingDurations->countBy()->sortDesc()->keys()->first();

        // 4. Top 5 Billboards by Earnings (with billboard names)
        $earningsByBillboard = $booking->groupBy(fn($b) => $b->billboard->title ?? 'Unknown Billboard')
            ->map->sum('net_payment')
            ->sortDesc()
            ->take(5);

        // 5. Bookings by Weekday
        $bookingsByWeekday = $booking->groupBy(fn($b) => $b->created_at->format('l'))->map->count();

        $topBillboards = $earningsByBillboard;
        $weekdayBookings = $bookingsByWeekday;

        return view('ownerstat', compact(
            'totalEarnings',
            'totalBookings',
            'bookingStatus',
            'paymentStatus',
            'earningOverTime',
            'averageBookingValue',
            'peakEarningDay',
            'peakEarningAmount',
            'mostCommonDuration',
            'topBillboards',
            'weekdayBookings',
            'range'
        ));

    }
    public function getFullStatForSiteAdmin(Request $request)
    {
        if (!Auth::check() || Auth::user()->is_admin != "yes") {
            abort(403, 'Unauthorized action.');
        }

        $range = $request->input('range', 'lifetime');

        $query = Booking::with('billboard', 'billboard.owner');

        switch ($range) {
            case 'day':
                $query->whereDate('created_at', today());
                break;
            case 'week':
                $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
                break;
            case 'month':
                $query->whereMonth('created_at', now()->month)
                    ->whereYear('created_at', now()->year);
                break;
            case 'year':
                $query->whereYear('created_at', now()->year);
                break;
        }

        $bookings = $query->get();

        // Main analytics
        $totalEarnings = $bookings->sum('net_payment');
        $totalBookings = $bookings->count();
        $bookingStatus = $bookings->groupBy('admin_approval')->map->count();
        $paymentStatus = $bookings->groupBy('payment_status')->map->count();

        $earningOverTime = $bookings->groupBy(fn($b) => $b->created_at->format('Y-m-d'))
            ->map->sum('net_payment');

        $averageBookingValue = $totalBookings > 0 ? $totalEarnings / $totalBookings : 0;
        $peakEarningDay = $earningOverTime->sortDesc()->keys()->first();
        $peakEarningAmount = $earningOverTime->max();

        $bookingDurations = $bookings->map(function ($b) {
            return Carbon::make($b->start_date)->diffInDays(Carbon::make($b->end_date));
        });
        $mostCommonDuration = $bookingDurations->countBy()->sortDesc()->keys()->first();

        $topBillboards = $bookings->groupBy(fn($b) => $b->billboard->title ?? 'Unknown Billboard')
            ->map->sum('net_payment')
            ->sortDesc()
            ->take(5);

        $weekdayBookings = $bookings->groupBy(fn($b) => $b->created_at->format('l'))->map->count();

        // Totals
        $totalBillboards = Billborad::count(); // Note: Typo? Should be Billboard?
        $totalUsers = \App\Models\User::count();
        $totalAdvertisers = \App\Models\User::where('type', 'advertiser')->count();
        $totalOwners = \App\Models\User::where('type', 'Billboard Owner')->count();

        // Top Owners
        $topOwners = $bookings->groupBy('owner_id')
            ->map->sum('net_payment')
            ->sortDesc()
            ->take(5)
            ->mapWithKeys(function ($val, $ownerId) {
                $owner = \App\Models\User::find($ownerId);
                return [$owner->name ?? "Owner #$ownerId" => $val];
            });

        // Top Advertisers
        $topAdvertisers = $bookings->groupBy('advertiser_id')
            ->map->sum('net_payment')
            ->sortDesc()
            ->take(5)
            ->mapWithKeys(function ($val, $advId) {
                $adv = \App\Models\User::find($advId);
                return [$adv->name ?? "Advertiser #$advId" => $val];
            });

        $status = "stat";

        return view('admin', compact(
            'range',
            'totalEarnings',
            'totalBookings',
            'bookingStatus',
            'paymentStatus',
            'earningOverTime',
            'averageBookingValue',
            'peakEarningDay',
            'peakEarningAmount',
            'mostCommonDuration',
            'topBillboards',
            'weekdayBookings',
            'totalBillboards',
            'totalUsers',
            'totalAdvertisers',
            'totalOwners',
            'topOwners',
            'topAdvertisers',
            'status'
        ));
    }

}
