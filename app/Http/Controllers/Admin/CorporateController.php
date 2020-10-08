<?php

namespace App\Http\Controllers\Admin;

use App\Corporate;
use App\Http\Controllers\Controller;
use App\Http\Service\CorporateService;
use Illuminate\Http\Request;

class CorporateController extends Controller{

    private $corporateService;

    public function __construct(){
        $this->corporateService = new CorporateService();
    }

    public function view($id) {
        $corporate = Corporate::find($id);
        $active = 'dashboard.corporate';

        if ($corporate != null) {
            $data = compact('corporate', 'active');

            return view('admin.corporate', $data);
        }else return redirect()->route('dashboard')->with('error', 'Corporate account not found');
    }

    public function approve($id) {
        $corporate = Corporate::find($id);

        if ($corporate != null) {
            $this->corporateService->updateApproval($corporate, true);
            return redirect()->back()->with('success', 'Status updated');
        }else return redirect()->back()->with('error', 'Driver not found');
    }

    public function rejectApproval($id) {
        $corporate = Corporate::find($id);

        if ($corporate != null) {
            $this->corporateService->updateApproval($corporate, false);
            return redirect()->back()->with('success', 'Status updated');
        }else return redirect()->back()->with('error', 'Driver not found');
    }

    public function revokeApproval($id) {
        $corporate = Corporate::find($id);

        if ($corporate != null) {
            $this->corporateService->updateApproval($corporate, false);
            return redirect()->back()->with('success', 'Status updated');
        }else return redirect()->back()->with('error', 'Driver not found');
    }
}
