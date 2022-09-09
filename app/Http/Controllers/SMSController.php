<?php

namespace App\Http\Controllers;

use App\Models\SMSSent;
use App\Models\VWStaff;

// SMS
use App\Models\Customer;
use Illuminate\Http\Request;
use Zenoph\Notify\Enums\AuthModel;
use Zenoph\Notify\Request\SMSRequest;
use Illuminate\Support\Facades\Session;
use Zenoph\Notify\Enums\TextMessageType;
use Zenoph\Notify\Request\NotifyRequest;
use Zenoph\Notify\Enums\DestinationStatus;
use Zenoph\Notify\Request\CreditBalanceRequest;

class SMSController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sms = SMSSent::orderByDesc('sms_id')->get();
        return view('admin.sms', ['sms' => $sms]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        request()->validate([
            'message' => 'required|string',
            'phone_numbers' => 'required_without_all:all_guests,all_staff|array',
        ]);
        
        $sms = new SMSSent;
        
        $data = [];
        if(!empty($request->phone_numbers)){
            foreach ($request->name as $i => $name) {
                $data[] = ['name' => $name, 'phone' => $request->phone_numbers[$i]];
            }
        }

        if($request->has('all_guests')){
            $guests = Customer::select('name', 'phone')->get();
            foreach ($guests as $name) {
                $data[] = ['name' => $name->name, 'phone' => $name->phone];
            }
        }

        if($request->has('all_staff')){
            $staffs = VWStaff::select('fullname', 'phone')->get();
            foreach ($staffs as $name) {
                $data[] = ['name' => $name->fullname, 'phone' => $name->phone];
            }
        }

        $msg = 'Hello {$name}! '.$request->message;
        
        // dd($msg);
        $sms->message = $msg;
        $sms->phone_numbers = $data;
        $sms->sent_by = Auth()->user()->user_id;
        $sms->save();

        Session::flash('sms', $sms->sms_id);

        return redirect('sms')->with('success', 'SMS Created Successfully!!');

    }

    static function sendSMS($message, $data)
    {
        try {
            
            NotifyRequest::setHost('api.smsonlinegh.com');
            
            NotifyRequest::useSecureConnection(true);
            
            // initialise request
            $smsReq = new SMSRequest();
            $smsReq->setAuthModel(AuthModel::API_KEY);
            $smsReq->setAuthApiKey('f0fcd8c8b7aadf217e6a95793070eb68543029a2aec2ac5524ad4f519cbdf2d0');
            
            $smsReq->setSender('Sammav-TEST');    // message sender Id must be requested from account to be used
            $smsReq->setMessage($message);     // must be single quoted string
            $smsReq->setMessageType(TextMessageType::TEXT);
            
            // add personalised data to destinations
            foreach ($data as $clientData){
                $phone = $clientData['phone'];
                $name  = $clientData['name'];
                // $balance = $clientData['balance'];
                $values = array($name);
                
                $smsReq->addPersonalisedDestination($phone, false, $values);
            }
            
            // submit must be after the loop
            $msgResp = $smsReq->submit();
    
            // to get the report, we will need the collection in which it is stored
            $msgReptList = $msgResp->getReports();
    
            // iterate through the collection to retrieve any report object
            foreach ($msgReptList as $msgRept){
                // get the message destinations list
                $destsList = $msgRept->getDestinations();
    
                // iterate through the list for each destination information
                foreach ($destsList as $destInfo){
                    // get the phone number
                    $phoneNumber = $destInfo->getPhoneNumber();
    
                    // get the status which will indicate if message
                    // will be submitted to the destination or not
                    $status = $destInfo->getStatus();
    
                    if ($status == DestinationStatus::DS_SUBMIT_ENROUTE){
                        // message is being submitted to the destination
                        echo "Message is being submitted, $phoneNumber <br>";
                    }
                    else {
                        // destination not accepted. we can use a switch to determine the cause
                        echo "Not submitted to, $phoneNumber <br>";
                    }
                }
            }
    
            // Get SMS your credit balance
            $cr = new CreditBalanceRequest();
            $cr->setAuthModel(AuthModel::API_KEY);
            $cr->setAuthApiKey(env('APP_SMS_KEY'));
            
            /*
             * Submit the request for a response.
             * An object of CreditBalanceResponse will be returned
             */
            $br = $cr->submit();
            
            # get the balance
            $balance = $br->getBalance();
            
            echo "Balance is: <strong>{$balance}.</strong>";
    
        } 
        
        catch (\Exception $ex) {
            die (printf("Error: %s.",  $ex->getMessage()));
        }
    }

    static function checkSMSBalance()
    {
        try {
            /**
             * Replace [messaging_website_domain] with the website domain on which account exists
             * 
             * Eg, if website domain is thewebsite.com, then set host as api.thewebsite.com
             * 
             * For further information, read the documentation for what you should set as the host
             */
            NotifyRequest::setHost('api.smsonlinegh.com');
            
            
            /* By default, HTTPS connection is used to send requests. If you want to disable the use of HTTPS
             * and rather use HTTP connection, comment out the call to useSecureConnection below below this comment
             * block and pass false as argument to the function call.
             * 
             * When testing on local machine on which https connection does not work, you may encounter 
             * request submit error with status value zero (0). If you want to use HTTPS connection on local machine, 
             * then you can instruct that the Certificate Authority file (cacert.pem) which accompanies the SDK be 
             * used to be able to use HTTPS from your local machine by setting the second argument of the function call to 'true'.
             * That is:
             *         NotifyRequest::useSecureConnection(true, true);
             * 
             * You can download the current Certificates Authority file (cacert.pem) file from https://curl.se/docs/caextract.html
             * to replace the one in the main root directory of the SDK. Please maintain the file name as cacert.pem
             */
            NotifyRequest::useSecureConnection(true);    
            
            $cr = new CreditBalanceRequest();
            $cr->setAuthModel(AuthModel::API_KEY);
            $cr->setAuthApiKey(env('APP_SMS_KEY'));
            
            /*
             * Submit the request for a response.
             * An object of CreditBalanceResponse will be returned
             */
            $br = $cr->submit();
            
            # get the balance
            $balance = $br->getBalance();
            
            return $balance;
        } 
        
        catch (\Exception $ex) {
            die ($ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $loan = SMSSent::find($id);
        // if($loan->status === 0){
        //     $loan->delete();

        //     return redirect('loans')->with('success', 'Loan Deleted Successfully!!');
        // }
        // else {
        //     return back()->with('error', 'Loan Payment has Started or Completed. Cannot Delete!!!!');
        // }
    }
}
