<?php

namespace App\Http\Controllers\SSE;



use App\MSG91;

use Carbon\Carbon;

use App\Models\Complaint;

use Illuminate\Http\Request;

use App\Models\SSE\AllocateJob;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Storage;

use App\Http\Requests\SSE\FeedbackRequest;

use App\Http\Requests\SSE\ResolutionRequest;

use App\Http\Requests\SSE\AllocateJobRequest;



class AllocateJobController extends Controller

{

    public function allocateJob(AllocateJobRequest $request, $id)

    {   

        $request->validated();



        $complaint = Complaint::find($id);



        $aj = AllocateJob::create([

            'complaint_id' => $id,

            'sse_id' => auth()->user()->id,

            'complaint_priority' => $request->complaint_priority,

            'remark' => $request->remark,

            'vendor_id' => $request->vendor_id,

            'resource_id' => $request->resource_id,

            'estimated_days' => $request->estimated_days,

        ]);



        if ($aj) {

            $complaint = Complaint::find($id);

            $complaint->update([

                'job_allocation_id' => $aj->id,

                'status' => 'Allocated'

            ]);

            

            // $message = urlencode("GIKSINDIA: Your complaint ID - $complaint->comp_id is allocated by SSE. For more information visit to NRCMS App.");

            // $MSG91 = new MSG91();

            // $MSG91->sendSMS($complaint->user->mobileno, $message);

            

            $MSG91 = new MSG91();

            $MSG91->sendDltSms('6219fe2eb2f9a76c4f1f35c3', '91'.$complaint->user->mobileno, 'COM', [$complaint->comp_id]);

            

            return back()->with('success', 'Job allocated successfully.');

        }



        return back()->with('error', 'Something went wrong. Try again!');

    }

    

    public function resolveJob(ResolutionRequest $request, $id)

    {

        $request->validated();



        $complaint = Complaint::find($id);



        $images = [];

        if($request->hasfile('resolution_images')) {

            foreach($request->file('resolution_images') as $file) {

                $name = $file->getClientOriginalName();

                Storage::putFileAs('public/complaint-images/' . str_replace('/', '', $complaint->comp_id) .'/resolution-images', $file, $name);

                $images[] = $name;

            }

        }

        

        $complaint->update([

            'resolution' => $request->resolution,

            'resolution_images' => json_encode($images),

            'resolution_date' => Carbon::now(),

            'status' => 'Resolved'

        ]);



        if ($complaint) {

            // $message = urlencode("GIKSINDIA: Your complaint was resolved successfully with complaint ID $complaint->comp_id. Visit NRCMS App to give your feedback.");

            // $MSG91 = new MSG91();

            // $MSG91->sendSMS($complaint->user->mobileno, $message);

            

            $MSG91 = new MSG91();

            $MSG91->sendDltSms('6219ff182b5cc00d1d461357', '91'.$complaint->user->mobileno, 'COM', [$complaint->comp_id]);

            

            return back()->with('success', 'Complaint resolved successfully.');

        }



        return back()->with('error', 'Something went wrong. Try again!');

    }



    public function feedback($id)
    {

        $complaint = Complaint::find($id);

        return view('complaint.show', compact('complaint'));

    }



    public function submitFeedback(FeedbackRequest $request, $id)
    {

        // dd($id);

        $request->validated();



        $complaint = Complaint::find($id);



        $complaint->update([

            'feedback' => $request->feedback,

            'satisfaction_level' => $request->satisfaction_level

        ]);

        

        if ($complaint) {           

            return back()->with('success', 'Complaint feedback submitted successfully.');

        }



        return back()->with('error', 'Something went wrong. Try again!');

    }

}

