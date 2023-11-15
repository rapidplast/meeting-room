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
    $now = Carbon::now();
    Reservation::where('reservation_time_out', '<', $now)->update(['status' => 0]);
    $message = 'Status Reservasi telah diperbarui';
    session(['refresh_message' => $message]);
    $reservationTimeout = Reservation::where('reservation_time_out', '<', $now)->max('reservation_time_out');

    $selectedPlant = Plant::find($request->id_plant);

    $reservations = Reservation::with('plant')
        ->where('id_plant', '=', $request->id_plant)
        ->orderBy('date', 'desc')
        ->orderBy('reservation_time', 'desc')
        ->get();
    $meeting = Meeting::all();
    $plant = Plant::all();

    return view('admin.reservationIndex', compact('reservations', 'meeting', 'plant', 'reservationTimeout', 'selectedPlant', 'request'));
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
        $reservation_time = date('H:i:s', strtotime($request->reservation_time));
        $reservation_time_out = date('H:i:s', strtotime($request->reservation_time_out));
        $datapost['reservation_time'] = $reservation_time;
        $datapost['reservation_time_out'] = $reservation_time_out;
        $datapost['ket'] = $request->ket;

        $overlappingReservations = Reservation::where('id_plant', $request->id_plant)
            ->where('meeting_id', $request->meeting_id)
            ->where('date', $request->date)
            ->where(function ($query) use ($reservation_time, $reservation_time_out) {
                $query->where(function ($q) use ($reservation_time, $reservation_time_out) {
                    $q->where('reservation_time', '<=', $reservation_time)
                        ->where('reservation_time_out', '>=', $reservation_time_out);
                })->orWhere(function ($q) use ($reservation_time, $reservation_time_out) {
                    $q->where('reservation_time', '>=', $reservation_time)
                        ->where('reservation_time_out', '<=', $reservation_time_out);
                });
            })
            ->count();

        if ($overlappingReservations > 0) {
            return redirect()->back()->with('fail', 'Ruangan pertemuan sudah dipesan untuk waktu yang dipilih.');
        }
        $now = Carbon::now();
        $currentReservations = Reservation::where('id_plant', $request->id_plant)
            ->where('meeting_id', $request->meeting_id)
            ->where('date', $request->date)
            ->where('reservation_time', '<=', $now)
            ->where('reservation_time_out', '>=', $now)
            ->count();

        if ($currentReservations > 0) {
            return redirect()->back()->with('warning', 'Ruangan pertemuan sedang digunakan saat ini.');
        }
        $reservation_datetime = Carbon::parse($request->date . ' ' . $request->reservation_time_out);
        if ($now > $reservation_datetime) {
            $status = 0;
        } else {
            $status = 1;
        }
        $datapost['status'] = $status;

        Reservation::create($datapost);

        return redirect()->route('reservation.index',
        ['id_plant' => $request->id_plant])->with('success', 'Reservasi Baru Ditambahkan dengan Sukses');
    } catch (\Exception $th) {
        return redirect()->back()->with('fail', $th->getMessage());
    }
}
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

        return view('admin.reservationEdit', compact('reservation', 'plant', 'meeting', 'reservation'));
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
                $status = 0;
            } else {
                $status = 1;
            }

            $datapost['status'] = $status;
            $datapost['nama'] = $request->nama;  // Menambahkan informasi user
            $datapost['ket'] = $request->ket;  // Menambahkan informasi deskripsi ruangan meeting

            Reservation::where(['reservation_id' => $reservation_id])->update($datapost);

            return redirect()->route('reservation.index',
            ['id_plant' => $request->id_plant])->with('success', 'Reservation Updated Successfully');
        } catch (\Exception $th) {
            return redirect()->back()->with('fail', $th->getMessage());
        }
    }
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

    public function showMeetingRoomReservations(Request $request)
    {
        $meetingRoomIsUsed = $this->checkMeetingRoomAvailability($request->id_plant,
        $request->meeting_id, $request->date, $request->reservation_time, $request->reservation_time_out);
        $meetingTimeIn = $request->reservation_time;
        $meetingTimeOut = $request->reservation_time_out;

        return view('meeting-room-reservations', compact('meetingRoomIsUsed', 'meetingTimeIn', 'meetingTimeOut'));
    }
    private function checkMeetingRoomAvailability($idPlant, $meetingId, $date, $reservationTime, $reservationTimeOut)
    {
        $reservationDateTime = Carbon::parse($date . ' ' . $reservationTime);
        $reservationDateTimeOut = Carbon::parse($date . ' ' . $reservationTimeOut);
        $overlappingReservations = Reservation::where('id_plant', $idPlant)
            ->where('meeting_id', $meetingId)
            ->where('date', $date)
            ->where(function ($query) use ($reservationDateTime, $reservationDateTimeOut) {
                $query->where(function ($q) use ($reservationDateTime, $reservationDateTimeOut) {
                    $q->where('reservation_time', '<=', $reservationDateTime)
                        ->where('reservation_time_out', '>=', $reservationDateTimeOut);
                })->orWhere(function ($q) use ($reservationDateTime, $reservationDateTimeOut) {
                    $q->where('reservation_time', '>=', $reservationDateTime)
                        ->where('reservation_time_out', '<=', $reservationDateTimeOut);
                });
            })
            ->count();

        if ($overlappingReservations > 0) {
            return false;
        }
        $now = Carbon::now();
        $currentReservations = Reservation::where('id_plant', $idPlant)
            ->where('meeting_id', $meetingId)
            ->where('date', $date)
            ->where('reservation_time', '<=', $now)
            ->where('reservation_time_out', '>=', $now)
            ->count();

        if ($currentReservations > 0) {
            return false;
        }

        return true;
    }
}