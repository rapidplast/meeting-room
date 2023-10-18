<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ReservationController;
use App\Models\Reservation;
use App\Models\Meeting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Http;

class CalendarController extends Controller
{
    public function index(Request $request)
    {   

        // dd($request->input('id_plant'));
        // print_r($request::all());die;
        // Mengakses data reservation_id dari Session atau variabel statis yang sudah disimpan
        $usedReservationIds = Session::get('usedReservationIds', []);

        // Ambil tanggal dari form add
        $startDate = $request->input('datee');
        $endDate = $request->input('datee'); // Anda mungkin perlu menyesuaikan ini sesuai kebutuhan

        $id_plant = $request->input('id_plant');
        // Tambahkan validasi untuk hanya mengambil data reservasi yang setelah tanggal pembuatan
        $reservations = Reservation::with('meeting')
            ->whereBetween('date', [$startDate, $endDate])
            ->whereDate('date', '>=', now()) // Hanya ambil data dengan tanggal setelah tanggal pembuatan
            ->where(['status' => 1, 'id_plant' => $id_plant])
            ->get();

        $activeReservations = \App\Models\Reservation::where(['status' => 1, 'id_plant' => $id_plant])->get();
        $activeRooms = $activeReservations->isNotEmpty() ? "Meeting Rooms Currently in Use: " : 'No Meeting Rooms are Currently in Use.';

        if ($activeReservations->isNotEmpty()) {
            $activeRoomNumbers = $activeReservations->pluck('meeting.meeting_id')->unique();
            foreach ($activeRoomNumbers as $roomNumber) {
                $activeRooms .= "Meeting Room $roomNumber, ";
            }
            $activeRooms = rtrim($activeRooms, ', '); // Menghapus koma terakhir
        }
        // dd($activeReservations);die;
        $events = [];
        // dd($reservations);die;
        // print_r($reservations);die;
        foreach ($reservations as $reservation) {
            
            if ($reservation->status == 1) { // Hanya tambahkan jika statusnya adalah "digunakan"
                $roomStatus = 'Digunakan'; // Status ruangan
                $roomNumber = $reservation->meeting->meeting_id;
                $tooltip = "Ruang Pertemuan $roomNumber ($roomStatus)";

                $events[] = [
                    'title' => "Ruang Pertemuan $roomNumber",
                    // Tampilkan judul tanpa status
                    'start' => $reservation->date . 'T' . $reservation->reservation_time,
                    'end' => $reservation->date . 'T' . $reservation->reservation_time_out,
                    'tooltip' => $tooltip,
                    // Tambahkan informasi tooltip
                ];
            } else {
                // Debug: Tampilkan informasi reservasi yang tidak digunakan
                // ini hanya digunakan untuk debugging, hapus saat sudah selesai debugging
                dd($reservation);
            }
        }

        // dd($events);die;
        // Tampilkan tampilan (view) 'calendar.blade.php' dengan data yang diperlukan
        return view('layouts.calendar', compact('activeReservations', 'events'));
    }

}