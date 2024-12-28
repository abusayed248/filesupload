<?php

namespace App\Http\Controllers;

use Stripe\StripeClient;
use App\Models\TrackFile;
use App\Models\UserPlans;
use App\Models\FileUpload;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;
use Pion\Laravel\ChunkUpload\Exceptions\UploadFailedException;
use Pion\Laravel\ChunkUpload\Exceptions\UploadMissingFileException;

class UploadController extends Controller
{
    public function index()
    {
        return view('upload');
    }


    public function showPaymentPage()
    {
        $userPlan = UserPlans::query()->first();
        return view("payment", compact("userPlan"));
    }

    public function createSubscriptions(Request $request)
    {
        $stripe = new StripeClient(env('STRIPE_SECRET'));

        $user = Auth::user();


        $customer = $stripe->customers->create([
            'email' => $user->email,
            'name' => $user->name,
        ]);
        // Step 2: Attach payment method to the customer
        $stripe->paymentMethods->attach(
            $request->token, // Payment method from Stripe Elements
            ['customer' => $customer->id]
        );

        // Step 3: Set the default payment method for the customer
        $stripe->customers->update(
            $customer->id,
            ['invoice_settings' => ['default_payment_method' => $request->token]]
        );

        // Step 4: Create the subscription
        $subscription = $stripe->subscriptions->create([
            'customer' => $customer->id,
            'items' => [['price' => $request->plan]], // Use the price ID from the form
            'expand' => ['latest_invoice.payment_intent'], // Expand to get payment details
        ]);

        // Step 5: Check payment status
        $paymentIntent = $subscription->latest_invoice->payment_intent;

        if ($paymentIntent->status === 'succeeded') {
            $user->subscription_date = now();
            $user->save();
            return redirect()->route('payment.page')->with('success', 'Your payment was successful. Thank you for subscribing!');
        } else {

            return redirect()->route('payment.page')->with('error', 'Payment failed. Please try again.');
        }
    }

    /**
     * Handles the file upload
     *
     * @param Request $request
     *
     * @return JsonResponse
     *
     * @throws UploadMissingFileException
     * @throws UploadFailedException
     */
    public function store(Request $request)
    {

        $fileUpload = FileUpload::query()->where([
            'name' => $request->name,  // Compare based on the name
            'expires_at' => $request->expiry_date,
        ])->first();
        if (!$fileUpload) {
            $fileUpload = FileUpload::create([
                'name' => $request->name,
                'password' => $request->password ? $request->password : null,
                'expires_at' => $request->expiry_date,
            ]);
        }
        // create the file receiver
        $receiver = new FileReceiver("file", $request, HandlerFactory::classFromRequest($request));

        // check if the upload is success, throw exception or return response you need
        if ($receiver->isUploaded() === false) {
            throw new UploadMissingFileException();
        }

        // receive the file
        $save = $receiver->receive();

        // check if the upload has finished (in chunk mode it will send smaller files)
        if ($save->isFinished()) {
            return $this->saveFile($save->getFile(), $fileUpload);
        }



        // we are in chunk mode, lets send the current progress
        $handler = $save->handler();

        return response()->json([
            "done" => $handler->getPercentageDone(),
            'status' => true,
        ]);
    }

    public function check(Request $request)
    {
        $user = auth()->user();
        if ($user == null) {
            return response()->json(['isSubscribed' => false]);
        } else {
            if (!$user->subscription_date) {
                return response()->json(['isSubscribed' => false]);
            }

            // Calculate the expiration date (1 month after subscription_date)
            $expirationDate = \Carbon\Carbon::parse($user->subscription_date)->addMonth();

            // Check if the current date is before the expiration date
            $isSubscribed = now()->lt($expirationDate);
            // Example logic for checking subscription
            //   $isSubscribed = $user->subscription && $user->subscription->is_active;

            return response()->json(['isSubscribed' => $isSubscribed]);
        }

        // Check if the user has a subscription date

    }


    /**
     * Saves the file to S3 server
     *
     * @param UploadedFile $file
     *
     * @return JsonResponse
     */
    protected function saveFileToS3($file)
    {
        $fileName = $this->createFilename($file);
        $disk = Storage::disk('s3');

        // It's better to use streaming (laravel 5.4+)
        $disk->putFileAs('photos', $file, $fileName);

        // for older laravel
        // $disk->put($fileName, file_get_contents($file), 'public');

        $mime = str_replace('/', '-', $file->getMimeType());

        // We need to delete the file when uploaded to s3
        unlink($file->getPathname());

        return response()->json([
            'path' => $disk->url($fileName),
            'name' => $fileName,
            'mime_type' => $mime
        ]);
    }

    protected function saveFile(UploadedFile $file, $fileUpload)
    {

        $fileName = $this->createFilename($file);

        // Group files by mime type
        $mime = str_replace('/', '-', $file->getMimeType());

        // Group files by the date (week
        $dateFolder = date("Y-m-W");

        // Build the file path
        $filePath = "upload/{$mime}/{$dateFolder}";
        $finalPath = storage_path("app/public/" . $filePath);

        // move the file name
        $file->move($finalPath, $fileName);

        TrackFile::create([
            'filepath' => asset('storage/' . $filePath . '/' . $fileName),
            'file_upload_id' => $fileUpload->id,
        ]);

        return response()->json([
            'path' => asset('storage/' . $filePath),
            'name' => $fileName,
            'mime_type' => $mime,
            'fileUpload_name' => $fileUpload->name
        ]);
    }


    /**
     * Saves the file
     *
     * @param UploadedFile $file
     *
     * @return JsonResponse
     */
    protected function saveFile1(UploadedFile $file, $trackFile)
    {
        $fileName = $this->createFilename($file);

        $mime = str_replace('/', '-', $file->getMimeType());

        // Build the file path
        $filePath = "upload/{$trackFile->name}";
        $finalPath = storage_path("app/public/" . $filePath);

        // move the file name
        $file->move($finalPath, $fileName);

        // Retrieve the current list of uploaded files from the session
        $uploadedFiles = Session::get('uploaded_files', []);

        // Append the new file's name to the list
        if (!in_array($fileName, $uploadedFiles)) {
            $uploadedFiles[] = $fileName;
        }

        // Update the session with the new list
        Session::put('uploaded_files', $uploadedFiles);
        $uploadedFiles = Session::get('uploaded_files', []);
        // Update the TrackFile record with all file names as JSON
        $trackFile->update(['track_names' => json_encode($uploadedFiles)]);

        return response()->json([
            'path' => asset('storage/' . $filePath),
            'name' => $fileName,
            'mime_type' => $mime
        ]);
    }

    /**
     * Create unique filename for uploaded file
     * @param UploadedFile $file
     * @return string
     */
    protected function createFilename(UploadedFile $file)
    {
        $extension = $file->getClientOriginalExtension();
        $filename = str_replace("." . $extension, "", $file->getClientOriginalName()); // Filename without extension

        // Add timestamp hash to name of the file
        $filename .= "_" . md5(time()) . "." . $extension;

        return $filename;
    }
}
