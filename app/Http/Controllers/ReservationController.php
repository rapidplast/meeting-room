<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\Reservation as MailReservation;
use App\Models\Pegawai;
use App\Models\Meeting;
use App\Models\Plant;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use PDF;

class ReservationController extends Controller
{

    public function index(Request $request)
    {
        // Perbarui status reservasi berdasarkan waktu
        $now = Carbon::now();
        Reservation::where('reservation_time_out', '<', $now)->update(['status' => 0]);

        // Pesan untuk memberitahu pengguna untuk me-refresh halaman
        $message = 'Status Reservasi telah diperbarui';
        session(['refresh_message' => $message]);

        // Ambil data reservasi dari database
        $reservations = Reservation::with('plant')->where('id_plant', '=', $request->id_plant)->get();
        $meeting = Meeting::all();
        $plant = Plant::all();
        
        return view('admin.reservationIndex', compact('reservations', 'meeting', 'plant'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_plant' => 'required',
            'nama' => 'required',
            'meeting_id' => 'required',
            'date' => 'required',
            'reservation_time' => 'required',
            'reservation_time_out' => 'required',
            // 'ket' => 'required',
        ]);
    
        try {
            $datapost['id_plant'] = $request->id_plant;
            $datapost['nama'] = $request->nama;
            $datapost['meeting_id'] = $request->meeting_id;
            $datapost['reservation_code'] = rand(10000, 500000);
            $datapost['user_id'] = $request->user_id;
            $datapost['date'] = $request->date;
            $datapost['reservation_time'] = date('H:i:s', strtotime($request->reservation_time));
            $datapost['reservation_time_out'] = date('H:i:s', strtotime($request->reservation_time_out));
            $datapost['ket'] = $request->ket;
    
            // Mengambil tanggal dan waktu saat ini
            $now = Carbon::now();
    
            // Combine the date and time to create a datetime string
            $reservation_datetime = Carbon::parse($request->date . ' ' . $request->reservation_time_out);
            $now = Carbon::now();

            // Check if the reservation datetime is in the past
            if ($now > $reservation_datetime) {
                $status = 0; // Past datetime, status is "Done"
            } else {
                $status = 1; // Future or present datetime, status is "Used"
            }

            // dd($reservation_datetime, $now, $status);

            $datapost['status'] = $status;

            Reservation::create($datapost);
    
            // Mengarahkan pengguna kembali ke halaman reservation all sesuai dengan plantnya
            return redirect()->route('reservation.index', ['id_plant' => $request->id_plant])->with('success', 'New Reservation Added Successfully');
        } catch (\Exception $th) {
            return redirect()->back()->with('fail', $th->getMessage());
        }
    }
    

    //     public function store(Request $request)
    // {

    //     $reservation = Reservation::all();
    //     $meet = Meeting::all()->first();
    //     $nama = $request->get('nama');
    //     $service_id = $request->get('meeting_id');
    //     $user_id = $request->get('user_id');
    //     $date = $request->get('datee');
    //     $time_in = $request->get('reservation_time');
    //     $time_out = $request->get('reservation_time_out');
    //     $ket = $request->get('ket');
    //     $now = Carbon::now()->format('Y-m-d');

    //     if (empty($service_id)) {
    //         if ($request->get('pegawai')) {
    //             return redirect()->route('reservationCustomer')
    //                 ->with('failr', 'Check the service');
    //         } else {
    //             return redirect()->route('reservation.index')
    //                 ->with('fail', 'Check the service');
    //         }
    //     } else {
    //         foreach ($reservation as $data) {
    //             $meet = Reservation::where([['date', $now], ['status', 0]])->first();

    //             if (!empty($meet)) {
    //                 if (($date == $meet->date) && ($request->meeting_id == $meet->meeting_id)) {
    //                     if ($request->reservation_time >= $meet->reservation_time) {
    //                         if ($request->reservation_time <= $meet->reservation_time_out) {
    //                             // Meeting Time Out has not passed, create a new reservation with status "Dipakai"
    //                             $reservation_code = $this->checkIfAva();
    //                             $total = 0;
    //                             $reservation = new Reservation;
    //                             $customer = User::where('user_id', $user_id)->first();
    //                             $reservation->nama = $nama;
    //                             $reservation->user_id = 1;
    //                             $reservation->meeting_id = $request->meeting_id;
    //                             $reservation->date = $date;
    //                             $reservation->reservation_time = $time_in;
    //                             $reservation->reservation_time_out = $time_out;
    //                             $reservation->ket = $ket;
    //                             $reservation->status = 1; // Status "Dipakai"
    //                             $reservation->save();
    //                             return redirect()->route('reservation.index')->with('success', 'New Reservation Added Succesfully');
    //                         }
    //                     }
    //                 }
    //             }

    //             $reservation_code = $this->checkIfAva();
    //             $total = 0;
    //             $reservation = new Reservation;
    //             $customer = User::where('user_id', $user_id)->first();
    //             $reservation->nama = $nama;
    //             $reservation->user_id = 1;
    //             $reservation->meeting_id = $request->meeting_id;
    //             $reservation->date = $date;
    //             $reservation->reservation_time = $time_in;
    //             $reservation->reservation_time_out = $time_out;
    //             $reservation->ket = $ket;
    //             $reservation->status = 1;
    //             $reservation->save();
    //             return redirect()->route('reservation.index')->with('success', 'New Reservation Added Succesfully');
    //         }

    //         return redirect()->route('reservation.index')->with('success', 'New Reservation Added Succesfully');
    //     }
    // }



    public function checkIfAva()
    {
        $reservations = Reservation::all();
        $reservation_code = "RBX" . "-" . $this->random_strings(8);
        $isAva = True;
        for ($i = 0; $i < count($reservations); $i++) {
            if ($reservations[$i]->reservation_code === $reservation_code) {
                $isAva = False;
            } else {
                $isAva = True;
            }
        }
        if ($isAva) {
            return $reservation_code;
        } else {
            $this->checkIfAva();
        }
        return $reservation_code;
    }
    public function random_strings($length_of_string)
    {
        // String of all alphanumeric character
        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        return substr(
            str_shuffle($str_result),
            0,
            $length_of_string
        );
    }

    public function edit($reservation_id)
    {
        $reservation = Reservation::with('plant')->find($reservation_id);
        $meeting = Meeting::all();
        $user = User::all();
        $plant = Plant::all();

        return view('admin.reservationEdit', compact('reservation', 'plant', 'meeting', 'reservation')); // Pastikan $reservations disertakan di sini
    }

    public function update(Request $request, $reservation_id)
    {
        $request->validate([
            'id_plant' => 'required',
            'nama' => 'required',
            'meeting_id' => 'required',
            'date' => 'required',
            'reservation_time' => 'required',
            'reservation_time_out' => 'required',
            // 'ket' => 'required',
        ]);

        try {
            $datapost['id_plant'] = $request->id_plant;
            $datapost['nama'] = $request->nama;
            $datapost['meeting_id'] = $request->meeting_id;
            $datapost['reservation_code'] = rand(10000, 500000);
            $datapost['user_id'] = $request->user_id;
            $datapost['date'] = $request->date;
            $datapost['reservation_time'] = date('H:i:s', strtotime($request->reservation_time));
            $datapost['reservation_time_out'] = date('H:i:s', strtotime($request->reservation_time_out));
            $datapost['ket'] = $request->ket;
            $reservation_datetime = $request->date . ' ' . $request->reservation_time_out;
            $now = Carbon::now();

            if ($now > $reservation_datetime) {
                $status = 0; // Past datetime, status is "Done"
            } else {
                $status = 1; // Future or present datetime, status is "Used"
            }

            $datapost['status'] = $status;

            Reservation::where(['reservation_id' => $reservation_id])->update($datapost);

            // Mengarahkan pengguna kembali ke halaman reservation all sesuai dengan plantnya
            return redirect()->route('reservation.index', ['id_plant' => $request->id_plant])->with('success', 'Reservation Updated Successfully');
        } catch (\Exception $th) {
            return redirect()->back()->with('fail', $th->getMessage());
        }
    }

    // public function update(Request $request, $reservation_id)
    // {
    //     $request->validate([
    //         'plant' => 'required',
    //         'nama' => 'required',
    //         'meeting_id' => 'required',
    //         'date' => 'required',
    //         'reservation_time' => 'required',
    //         'reservation_time_out' => 'required',
    //         // 'ket' => 'required',
    //     ]);  

    //     try {
    //         $reservation = Reservation::findOrFail($reservation_id);
    //         $reservation->nama = $request->nama;
    //         $reservation->meeting_id = $request->meeting_id;
    //         $reservation->date = $request->datee;
    //         $reservation->reservation_time = $request->reservation_time;
    //         $reservation->reservation_time_out = $request->reservation_time_out;
    //         $reservation->ket = $request->ket;
    //         $reservation->save();

    //         return redirect()->route('reservation.index')->with('success', 'Reservation updated successfully');
    //     } catch (\Exception $e) {
    //         // Tangani kesalahan yang terjadi selama pembaruan.
    //         return redirect()->back()->with('fail', 'Failed to update reservation. Please try again.');
    //     }
    // }

    public function destroy($reservation_id)
    {
        $reservation = Reservation::find($reservation_id);

        if (!$reservation) {
            return redirect()->back()->with('fail', 'Data reservasi tidak ditemukan.');
        }

        $reservation->delete();

        return redirect()->back()->with('success', 'Data reservasi berhasil dihapus.');
    }

    public function getReservationsByDate(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $reservations = Reservation::with('pegawai', 'meeting')
            ->whereBetween('date', [$startDate, $endDate])
            ->get();

        return response()->json($reservations, JsonResponse::HTTP_OK);
    }

    


    

    // public function calender(Request $request, $id_plant)
    // {
    //     $currentMeetingDate = $request->session()->get('currentMeetingDate');
        
    //     $reservations = Reservation::whereDate('reservation_time', '=', $currentMeetingDate)
    //         ->where('id_plant', $id_plant) // Filter berdasarkan id_plant
    //         ->get();

    //     $events = [];

    //     foreach ($reservations as $reservation) {
    //         if ($reservation->status == 1) {
    //             $roomStatus = 'Digunakan';
    //             $roomNumber = $reservation->meeting->meeting_id;
    //             $tooltip = "Meeting Room $roomNumber ($roomStatus)";

    //             $events[] = [
    //                 'title' => "Meeting Room $roomNumber",
    //                 'start' => $reservation->reservation_time,
    //                 'end' => $reservation->reservation_time_out,
    //                 'tooltip' => $tooltip,
    //             ];
    //         }
    //     }
    //     dd($reservations);
    //     return view('layouts.calendar', compact('currentMeetingDate', 'events'));
    // }

}