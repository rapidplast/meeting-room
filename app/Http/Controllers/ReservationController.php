<?php

namespace App\Http\Controllers;

use App\Mail\Reservation as MailReservation;
use App\Models\Pegawai;
use App\Models\Meeting;
use App\Models\Reservation;
// use App\Models\ReservationStatus;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use PDF;

class ReservationController extends Controller
{

    public function index(Request $request)
    {
        $now = Carbon::now()->format('Y-m-d');
        // $res = Reservation::with('meeting')->where([['date',$now],['status',0]])->get();
        

        $hour = Carbon::now()->format('H:i:s');
        $search = $request->get('search');
  
        if ($request->get('search')) {
            $reservation = Reservation::with('pegawai', 'meeting')->search(['reservation_code', 'reservation_time'], $search)->orderBy('reservation_time', 'desc')->groupBy('reservation_code')->get();
        } elseif($request->get('in')) {
            $reservation = Reservation::with('pegawai', 'meeting')->where('status',0)->whereBetween('date',[$request->get('in'),$request->get('out')])->groupBy('reservation_code')->orderBy('reservation_time', 'desc')->get();
        }else{
            $reservation = Reservation::with('meeting')->where([['date',$now],['status',0]])->orderBy('reservation_time', 'desc')->get();
        }        
        // return response()->json($reservation);
        // $reservationStatus = ReservationStatus::all();
        // $reservationStatus1 = ReservationStatus::with('reservation')->first();
        // $reservationServices = Reservation::with('service')->get();
        $meeting = Meeting::all();
        $user = User::all();
        $reser = Reservation::all();
        foreach($reser as $data){
            $res = Reservation::where('reservation_id',$data->reservation_id)->first();   
            if( $hour >= $res->reservation_time_out){
                $res    = Reservation::where('reservation_id',$data->reservation_id)->update([            
                'status'    => 1,
                ]);
            }     
        }
        
        return view('admin.reservationIndex', compact('reservation','reser', 'user',  'meeting'));
        // return view('admin.reservationIndex', compact('reservation','reser', 'user',  'meeting', 'reservationServices', 'reservationStatus','reservationStatus1'));
    
    }
    public function reservationCustomer()
    {
        $meeting = Meeting::all();
        return view('customer.reservation', compact('service'));
    }

    // public function searchByCustomer(Request $request)
    // {
    //     $search = $request->get('search');
    //     if ($request->get('search')) {
    //         $reservation = Reservation::with('customer', 'service')->search(['reservation_code'], $search)->groupBy('reservation_code')->first();
    //     } else {
    //         $reservation = "";
    //     }
    //     // $reservationStatus = ReservationStatus::all();
    //     $reservationServices = Reservation::with('service')->get();
    //     $service = Service::all();
    //     $r = $reservation;
    //     if ($reservation !== null) {
    //         $servicesReservation = Reservation::where('reservation_code', $reservation->reservation_code)->pluck('service_id');
    //         $servicesReservation = json_decode(json_encode($servicesReservation), true);
    //         return view('customer.searchResult', compact('r', 'service', 'reservationServices', 'reservationStatus', 'servicesReservation'));
    //     } else {
    //         return redirect()->route('reservationCustomer')
    //             ->with('fail', 'Reservation Code Not Found!!');
    //     }
    // }


    public function create()
    {
        //
    }




    public function store(Request $request)
    {
        $reservation = Reservation::all();
        $meet = Meeting::all()->first();
        $nama       = $request->get('nama');
        $service_id = $request->get('meeting_id');    
        $user_id    = $request->get('user_id');
        $date       = $request->get('datee');
        $time_in    = $request->get('reservation_time');
        $time_out   = $request->get('reservation_time_out');
        $ket        = $request->get('ket'); 
        $now        = Carbon::now()->format('Y-m-d');
        // return response()->json($service_id);
        if (empty($service_id)) {
            if ($request->get('pegawai')) {
                return redirect()->route('reservationCustomer')
                    ->with('failr', 'Check the service');
            } else {
                return redirect()->route('reservation.index')
                    ->with('fail', 'Check the service');
            }
        } else {            

            foreach($reservation as $data){      

                    $meet = Reservation::where([['date', $now],['status',0]])->first();
             
                if(!empty($meet)){
            
                if(($date == $meet->date)){     
   
                if(($request->meeting_id == $meet->meeting_id   )){  
 
                        if($request->reservation_time >= $meet->reservation_time ){
                            if($request->reservation_time <= $meet->reservation_time_out){
                            return redirect()->route('reservation.index')
                    ->with('fail', 'Karena Sudah Ada yang Memakai ruang Meeting Di Jam Itu');
  
                            }else{
                                $reservation_code = $this->checkIfAva();
                                $total = 0;
                                $reservation = new Reservation;
                                $customer = User::where('user_id', $user_id)->first();
                                $reservation->nama = $nama;
                                $reservation->user_id = 2 ;                                
                                $reservation->meeting_id = $request->meeting_id;                                
                                $reservation->date = $date;
                                $reservation->date = $date;
                                $reservation->reservation_time = $time_in;
                                $reservation->reservation_time_out = $time_out;
                                $reservation->ket = $ket;
                                $reservation->status = 0;

                                // $reservation->reservation_code = $reservation_code;
                                // $svcprice = Meeting::where('meeting_id', $service_id)->first();
                                // $total += $svcprice->price;
                                $reservation->save();
                                return redirect()->route('reservation.index')->with('success', 'New Reservation Added Succesfully');
                            }
                            }else{
                                
                            $reservation_code = $this->checkIfAva();
           
                            $total = 0;
                           
                                $reservation = new Reservation;
                                $customer = User::where('user_id', $user_id)->first();
                                $reservation->nama = $nama;
                                $reservation->user_id = 2 ;                                
                                $reservation->meeting_id = $request->meeting_id;                                
                                $reservation->date = $date;
                                $reservation->date = $date;
                                $reservation->reservation_time = $time_in;
                                $reservation->reservation_time_out = $time_out;
                                $reservation->ket = $ket;
                                $reservation->status = 0;

                                // $reservation->reservation_code = $reservation_code;
                                // $svcprice = Meeting::where('meeting_id', $service_id)->first();
                                // $total += $svcprice->price;
                                $reservation->save();
                                return redirect()->route('reservation.index')->with('success', 'New Reservation Added Succesfully');
                        }
                    }
                    // return response()->json($meet);
                            $reservation_code = $this->checkIfAva();                         
                            $total = 0;                           
                                $reservation = new Reservation;                
                                $customer = User::where('user_id', $user_id)->first();                           

                                $reservation->nama = $nama;
                                $reservation->user_id = 2 ;
                                $reservation->meeting_id = $request->meeting_id;
       
                                $reservation->date = $date;
                                $reservation->date = $date;
                                $reservation->reservation_time = $time_in;
                                $reservation->reservation_time_out = $time_out;
                                $reservation->ket = $ket;
                                $reservation->status = 0;
                                // $reservation->reservation_code = $reservation_code;
                                // $svcprice = Meeting::where('meeting_id', $request->service_id)->first();
                                // $total += $svcprice->price;
                                $reservation->save();
                                return redirect()->route('reservation.index')->with('success', 'New Reservation Added Succesfully');
                }  
                
                // return response()->json($service_id);  
                            $reservation_code = $this->checkIfAva();                         
                            $total = 0;                           
                                $reservation = new Reservation;                
                                $customer = User::where('user_id', $user_id)->first();                                                           
                                $reservation->nama = $nama;
                                $reservation->user_id = 2 ;
                                $reservation->meeting_id = $request->meeting_id;
                                $reservation->date = $date;
                                $reservation->date = $date;
                                $reservation->reservation_time = $time_in;
                                $reservation->reservation_time_out = $time_out;
                                $reservation->ket = $ket;
                                $reservation->status = 0;
                                // $reservation->reservation_code = $reservation_code;
                                // $svcprice = Meeting::where('meeting_id', $request->service_id)->first();
                                // $total += $svcprice->price;
                                $reservation->save();
                                return redirect()->route('reservation.index')->with('success', 'New Reservation Added Succesfully');
    }
                            $reservation_code = $this->checkIfAva();                         
                            $total = 0;                           
                                $reservation = new Reservation;                
                                $customer = User::where('user_id', $user_id)->first();                                                           
                                $reservation->nama = $nama;
                                $reservation->user_id = 2 ;
                                $reservation->meeting_id = $request->meeting_id;
                                $reservation->date = $date;
                                $reservation->date = $date;
                                $reservation->reservation_time = $time_in;
                                $reservation->reservation_time_out = $time_out;
                                $reservation->ket = $ket;
                                $reservation->status = 0;
                                // $reservation->reservation_code = $reservation_code;
                                // $svcprice = Meeting::where('meeting_id', $request->service_id)->first();
                                // $total += $svcprice->price;
                                $reservation->save();
                                return redirect()->route('reservation.index')->with('success', 'New Reservation Added Succesfully');
            }
    return redirect()->route('reservation.index')->with('success', 'New Reservation Added Succesfully');
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
        // String of all alphanumeric character
        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        // Shufle the $str_result and returns substring
        // of specified length
        return substr(
            str_shuffle($str_result),
            0,
            $length_of_string
        );
    }

    public function show(Reservation $reservation)
    {
        //
    }


    // public function edit(Reservation $reservation)
    // {
    //     $reservationCustomer = Reservation::with('customer')->where('reservation_code', $reservation->reservation_code)->first();
    //     $reservationServices = Reservation::where('reservation_code', $reservation->reservation_code)->pluck('service_id');
    //     $reservationServices = json_decode(json_encode($reservationServices), true);
    //     $reservation = Reservation::where('reservation_code', $reservation->reservation_code)->get();
    //     $meeting = Service::all();
    //     return view('admin.reservationEdit', ['reservation' => $reservation, 'services' => $services, 'reservationServices' => $reservationServices, 'reservationCustomer' => $reservationCustomer]);
    // }


    // public function update(Request $request, Reservation $reservation)
    // {
    //     // dd($reservation->reservation_id );
    //     $reservationServices = Reservation::where('reservation_code', $reservation->reservation_code)->pluck('service_id');
    //     //  return response()->json($reservationServices);
    //     // $reservationServices->status = $request->get('status');
    //     // $reservationServices->save();
    //     $reservationServicesArray = json_decode(json_encode($reservationServices), true);
    //     // return response()->json($reservationServicesArray);
    //     $service_id = $request->get('service_id');
    //     // return response()->json($service_id);
    //     if (empty($service_id)) {
    //         $reservas = Reservation::where('reservation_id', $reservation->reservation_id)->first();
    //         $reservas->status = $request->get('status');
    //         $reservas->save();
    //         return redirect()->route('reservation.index', $reservation)->with('success', 'Updated Successfully');
    //         // return response()->json($reservas->status);
    //         // dd($reservas);
    //     } else {
    //         $resultToDelete = array_diff($reservationServicesArray, $service_id);
    //         $resultToAdd = array_diff($service_id, $reservationServicesArray);
    //         if (!empty($resultToDelete)) {
    //             foreach ($resultToDelete as $key) {
    //                 $reservationsToDelete = Reservation::where('reservation_code', $reservation->reservation_code)->where('service_id', $key)->first();
    //                 $reservationsToDelete->delete();
    //             }
    //         }
    //         $total = 0;
    //         $reservationCustomer = Reservation::with('customer')->where('reservation_code', $reservation->reservation_code)->first();
    //         if (!empty($resultToAdd)) {
    //             foreach ($resultToAdd as $key) {
    //                 $reservation = new Reservation;
    //                 $reservation->customer()->associate($reservationCustomer->customer);
    //                 $service = new Service;
    //                 $service->service_id = $key;
    //                 $reservation->service()->associate($service);
    //                 $reservation->reservation_time = $reservationCustomer->reservation_time;
    //                 $reservation->status  = $request->get('status');
    //                 $reservation->reservation_code = $reservationCustomer->reservation_code;
    //                 $svcprice = Service::where('service_id', $key)->first();
    //                 $total += $svcprice->price;
    //                 $reservation->save();
    //             }
    //         }
    //         $reservationStatus = ReservationStatus::where('reservation_code', $reservation->reservation_code)->first();
    //         if ($reservationStatus) {
    //             $reservationStatus->price = $reservationStatus->price + $total;
    //             $reservationStatus->save();
    //         } else {
    //             $totalNew = 0;
    //             foreach ($service_id as $key) {
    //                 $svcprice = Service::where('service_id', $key)->first();
    //                 $totalNew += $svcprice->price;
    //             }
    //             $reservationStatus = new ReservationStatus;
    //             $reservationStatus->reservation_code = $reservationCustomer->reservation_code;
    //             $reservationStatus->price = $totalNew;
    //             $reservationStatus->status = 0;
    //             $reservationStatus->save();
    //         }
    //         if ($request->get('reservation_time')) {
    //             $reservations = Reservation::where('reservation_code', $reservation->reservation_code)->get();
    //             foreach ($reservations as $key) {
    //                 $key->reservation_time = $request->get('reservation_time');
    //                 $key->save();
    //             }
    //         } else {
    //             return redirect()->route('reservation.edit', $reservation)->with('info', 'Cheack Reservation Time');
    //         }
    //         return redirect()->route('reservation.index', $reservation)->with('success', 'Updated Successfully');
    //     }
    // }

    // public function updatest(Request $request, Reservation $reservation)
    // {


    //     $reservationServices = Reservation::where('reservation_code', $reservation->reservation_code)->pluck('reservation_code');
    //     $reservationServices->status = $request->get('status');
    //     $reservationServices->save();

    //     return redirect()->route('reservationStatus.index')
    //         ->with('success', 'Status Successfully Updated');
    // }


//     public function updateByCustomer(Request $request, Reservation $reservation, User $customer)
//     {
//         $request->validate([
//             'name' => 'required',
//             'email' => 'required',
//             'phone' => 'required',
//             'image' => 'nullable',

//         ]);
//         if ($request->file('image')) {
//             if ($customer->image) {
//                 if ($customer->image !== 'images/userDefault.jpg') {
//                     Storage::delete('public/' . $customer->image);
//                 }
//             }
//             $image = $request->file('image')->store('images', 'public');
//             $customer->image = $image;
//         }
//         $customer->name = $request->get('name');
//         $customer->phone = $request->get('phone');
//         $customer->email = $request->get('email');
//         $customer->save();

//         $reservationServices = Reservation::where('reservation_code', $reservation->reservation_code)->pluck('service_id');
//         $reservationServicesArray = json_decode(json_encode($reservationServices), true);
//         $service_id = $request->get('service_id');
//         if (empty($service_id)) {
//             return redirect()->back()->with('fail', 'Nothing Changed From The Services');
//         } else {
//             $resultToDelete = array_diff($reservationServicesArray, $service_id);
//             $resultToAdd = array_diff($service_id, $reservationServicesArray);
//             if (!empty($resultToDelete)) {
//                 foreach ($resultToDelete as $key) {
//                     $reservationsToDelete = Reservation::where('reservation_code', $reservation->reservation_code)->where('service_id', $key)->first();
//                     $reservationsToDelete->delete();
//                 }
//             }
//             $total = 0;
//             $reservationCustomer = Reservation::with('customer')->where('reservation_code', $reservation->reservation_code)->first();
//             if (!empty($resultToAdd)) {
//                 foreach ($resultToAdd as $key) {
//                     $reservation = new Reservation;
//                     $reservation->customer()->associate($reservationCustomer->customer);
//                     $service = new Service;
//                     $service->service_id = $key;
//                     $reservation->service()->associate($service);
//                     $reservation->reservation_time = $reservationCustomer->reservation_time;
//                     $reservation->status = $request->get('status');
//                     $reservation->reservation_code = $reservationCustomer->reservation_code;
//                     $svcprice = Service::where('service_id', $key)->first();
//                     $total += $svcprice->price;
//                     $reservation->save();
//                 }
//             }
//             $reservationStatus = ReservationStatus::where('reservation_code', $reservation->reservation_code)->first();
//             if ($reservationStatus) {
//                 $reservationStatus->price = $reservationStatus->price + $total;
//                 $reservationStatus->save();
//             } else {
//                 $totalNew = 0;
//                 foreach ($service_id as $key) {
//                     $svcprice = Service::where('service_id', $key)->first();
//                     $totalNew += $svcprice->price;
//                 }
//                 $reservationStatus = new ReservationStatus;
//                 $reservationStatus->reservation_code = $reservationCustomer->reservation_code;
//                 $reservationStatus->price = $totalNew;
//                 $reservationStatus->status = 0;
//                 $reservationStatus->save();
//             }
//             if ($request->get('reservation_time')) {
//                 $reservations = Reservation::where('reservation_code', $reservation->reservation_code)->get();
//                 foreach ($reservations as $key) {
//                     $key->reservation_time = $request->get('reservation_time');
//                     $key->save();
//                 }
//             }
//             return redirect()->back()->with('success', 'Updated Successfully');
//         }
//     }
//     public function sendtoCustomer(Reservation $reservation)
//     {
//         echo $reservation;
//         $reservationStatus = ReservationStatus::all();
//         $reservationServices = Reservation::with('service')->get();
//         $r = $reservation;
//         Mail::to($reservation->customer->email)->send(new MailReservation($r, $reservationServices, $reservationStatus));
//         return redirect()->back()->with('success', 'Sent to your email Successfully');
//     }
//     public function destroy(Request $request, Reservation $reservation)
//     {
//         $reservations = Reservation::where('reservation_code', $reservation->reservation_code)->get();
//         foreach ($reservations as $r) {
//             $r->delete();
//         }
//         if ($request->get('customer')) {
//             return redirect()->route('reservationCustomer')
//                 ->with('success', 'Reservation seccesfully Deleted');
//         }
//         return redirect()->route('reservation.index')
//             ->with('success', 'Reservation seccesfully Deleted');
//     }

//     public function printReservationPDF(Reservation $reservation)
//     {
//         $reservationStatus = ReservationStatus::all();
//         $reservationServices = Reservation::with('service')->get();
//         $pdf = PDF::loadview('admin.printReservationPDF', ['r' => $reservation, 'reservationStatus' => $reservationStatus, 'reservationServices' => $reservationServices]);
//         return $pdf->stream();
//     }
}
