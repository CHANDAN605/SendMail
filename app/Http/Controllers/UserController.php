<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Mail\CertificateMail;
use Mail;
use PDF;
class UserController extends Controller
{
    public function getAllUsers(){
       $users = User::get();
       return view('index',compact('users'));
    }

    public function sendEmail(Request $req){
    try {
        $dataArray = User::join('certificates', 'certificates.user_id', 'users.id')->where('users.id', $req->id)->get();
        $dataArray=$dataArray[0];
 
        // Data for the email body
        $emailData = [
            "email" => "test@gmail.com",
            "title" => "Atto InfoTech",
            "body" => "This is a test mail with an attachment",
            "name" => $dataArray->name,
            "organizer_name" => $dataArray->organizer_name,
            "certificate_number" => $dataArray->certificate_number,
            "website_url" => $dataArray->website_url,
            "head_name" => $dataArray->head_name,
        ];


        // Load the email view and pass email data
        PDF::loadView('email.certificateMail', $emailData);
        $emailData['pdf'] = PDF::loadHTML(UserController::createPDF($dataArray));

        // Send the email with the attached PDF
        Mail::to($emailData["email"])->send(new CertificateMail($emailData));


        // Update user email status
        User::where('id', $req->id)->update(['email_status' => 1]);
        // \Artisan::Call('optimize:clear');
        return response()->json(['message' => 'Success','status'=>200]);
    } catch (\Throwable $th) {
        throw $th;
    }
}


    public static function createPDF($dataArray){
        return '<!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8" />
                    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
                    <link rel="stylesheet" href="style.css" />
                    <title>Certificate</title>
                </head>
                <b
                <div style="width: 100%; height: 100%; text-align: center; padding: 20px;">
                <div style="width: 80%; margin: 0 auto; border: 1px solid #787878; padding: 20px;">
                    <h1 style="font-size: 36px; font-weight: bold;">Certificate of Completion</h1>
                    <p style="font-size: 18px;"><i>THE FOLLOWING AWARD IS GIVEN TO</i></p>
                    <p style="font-size: 24px;"><strong>'.$dataArray->name.'</strong> 
                    <p style="font-size: 18px;"><i>This certificate is given to '.$dataArray->name.' for his achivment in the held of education and proves that he is component in his field.</i></p>
                    <div style="display: flex; justify-content: space-between;">
                        <div style="border-top: 1px solid #000; flex-basis: 33.33%; padding-top: 10px;">
                            <p style="font-weight: bold;">'. $dataArray->head_name .'</p>
                            <p>Head of Event</p>
                        </div>
                        <div style="flex-basis: 33.33%; padding-top: 10px;">
                        </div>
                        <div style="border-top: 1px solid #000; flex-basis: 33.33%; padding-top: 10px;">
                            <p style="font-weight: bold;">'. $dataArray->head_name .'</p>
                            <p>Mentor</p>
                        </div>
                    </div>
                </div>
                </body>
                </html>';
             //return   view()->share('employee',$data);
    //    $pdf = PDF::loadHTML($data);
    //    return $pdf->output();
        //  return $pdf->download('certificate.pdf');
    }
}
