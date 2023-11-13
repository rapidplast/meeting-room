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
        $startDate = $request->input('datee');
        $endDate = $request->input('datee');
        $id_plant = $request->input('id_plant');
        $reservations = Reservation::with('meeting')
            ->whereBetween('date', [$startDate, $endDate])
            ->whereDate('date', '>=', now())
            ->where(['id_plant' => $id_plant])
            ->get();
    
        $activeReservations = \App\Models\Reservation::where(['id_plant' => $id_plant])->get();
        $activeRooms = $activeReservations->isNotEmpty() ? "Meeting Rooms Currently in Use: " : 'No Meeting Rooms are Currently in Use.';
    
        if ($activeReservations->isNotEmpty()) {
            $activeRoomNumbers = $activeReservations->pluck('meeting.meeting_id')->unique();
            foreach ($activeRoomNumbers as $roomNumber) {
                $activeRooms .= "Meeting Room $roomNumber, ";
            }
            $activeRooms = rtrim($activeRooms, ', ');
        }
        
        $events = [];
        foreach ($reservations as $reservation) {
            $roomStatus = $reservation->status == 1 ? 'Digunakan' : '';
            $roomNumber = $reservation->meeting->meeting_id;
            $tooltip = "Ruang Pertemuan $roomNumber ($roomStatus)";
            
            $eventBackgroundColor = $reservation->status == 0 ? '#cccccc' : 'Tidak Digunakan';
            
            $events[] = [
                'title' => "Ruang Pertemuan $roomNumber",
                'start' => $reservation->date . 'T' . $reservation->reservation_time,
                'end' => $reservation->date . 'T' . $reservation->reservation_time_out,
                'tooltip' => $tooltip,
                'backgroundColor' => $eventBackgroundColor,
                'nama' => $reservation->nama,  // Menambahkan informasi user
                'ket' => $reservation->ket,  // Menambahkan informasi deskripsi ruangan meeting
            ];
        }
        
        return view('layouts.calendar', compact('activeReservations', 'events'));
    }

}