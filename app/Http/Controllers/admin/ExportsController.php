<?php

namespace App\Http\Controllers\admin;

use App\Enquiry;
use App\Exports\EnquiriesExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportsController extends Controller
{
    public function exportEnquiries()
    {
        return Excel::download(new EnquiriesExport(), 'enquiries.xlsx');
    }
}
