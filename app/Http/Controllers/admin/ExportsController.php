<?php

namespace App\Http\Controllers\admin;

use App\Enquiry;
use App\Exports\EnquiriesExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class ExportsController extends Controller
{
    public function exportEnquiries()
    {
        $this->authorize('viewAny', Enquiry::class);

        return Excel::download(new EnquiriesExport(), 'enquiries.xlsx');
    }
}
