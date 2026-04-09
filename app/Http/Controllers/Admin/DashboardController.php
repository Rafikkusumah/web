<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Blog;
use App\Models\Quotation;
use App\Models\Invoice;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProjects = Project::count();
        $totalBlogs = Blog::count();
        $totalQuotations = Quotation::count();
        $totalInvoices = Invoice::count();
        
        $recentProjects = Project::latest()->limit(5)->get();
        $recentQuotations = Quotation::latest()->limit(5)->get();
        
        return view('admin.dashboard', compact(
            'totalProjects',
            'totalBlogs',
            'totalQuotations',
            'totalInvoices',
            'recentProjects',
            'recentQuotations'
        ));
    }
}
