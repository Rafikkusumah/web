<?php

use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\QuotationController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\Invoice2Controller;
use App\Http\Controllers\Admin\PdfController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Landing Page Routes
Route::get('/', [LandingPageController::class, 'index'])->name('home');
Route::get('/about', [LandingPageController::class, 'about'])->name('about');
Route::get('/our-projects', [LandingPageController::class, 'projects'])->name('our-projects');
Route::get('/our-projects/{id}', [LandingPageController::class, 'projectDetail'])->name('project.detail');
Route::get('/blog', [LandingPageController::class, 'blog'])->name('blog');
Route::get('/blog/{slug}', [LandingPageController::class, 'blogDetail'])->name('blog.detail');
Route::get('/contact', [LandingPageController::class, 'contact'])->name('contact');

// Admin Dashboard Routes
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Project Management
    Route::resource('projects', ProjectController::class);
    Route::post('projects/{project}/upload-media', [ProjectController::class, 'uploadMedia'])->name('projects.upload-media');
    Route::delete('projects/media/{media}', [ProjectController::class, 'deleteMedia'])->name('projects.delete-media');
    
    // Blog Management
    Route::resource('blogs', BlogController::class);
    
    // Quotation Management
    Route::get('quotations', [QuotationController::class, 'index'])->name('quotations.index');
    Route::get('quotations/create', [QuotationController::class, 'create'])->name('quotations.create');
    Route::post('quotations', [QuotationController::class, 'store'])->name('quotations.store');
    Route::get('quotations/{quotation}', [QuotationController::class, 'show'])->name('quotations.show');
    Route::get('quotations/{quotation}/edit', [QuotationController::class, 'edit'])->name('quotations.edit');
    Route::put('quotations/{quotation}', [QuotationController::class, 'update'])->name('quotations.update');
    Route::delete('quotations/{quotation}', [QuotationController::class, 'destroy'])->name('quotations.destroy');
    
    // Invoice Management
    Route::get('invoices', [InvoiceController::class, 'index'])->name('invoices.index');
    Route::get('invoices/create', [InvoiceController::class, 'create'])->name('invoices.create');
    Route::post('invoices', [InvoiceController::class, 'store'])->name('invoices.store');
    Route::get('invoices/{invoice}', [InvoiceController::class, 'show'])->name('invoices.show');
    Route::get('invoices/{invoice}/edit', [InvoiceController::class, 'edit'])->name('invoices.edit');
    Route::put('invoices/{invoice}', [InvoiceController::class, 'update'])->name('invoices.update');
    Route::delete('invoices/{invoice}', [InvoiceController::class, 'destroy'])->name('invoices.destroy');
    Route::get('invoices/from-quotation/{quotation}', [InvoiceController::class, 'createFromQuotation'])->name('invoices.from-quotation');
    Route::post('invoices/from-quotation/{quotation}', [InvoiceController::class, 'storeFromQuotation'])->name('invoices.store-from-quotation');

    // Invoice2 Management (Payment Stages)
    Route::get('invoice2', [Invoice2Controller::class, 'index'])->name('invoice2.index');
    Route::get('invoice2/create', [Invoice2Controller::class, 'create'])->name('invoice2.create');
    Route::post('invoice2', [Invoice2Controller::class, 'store'])->name('invoice2.store');
    Route::get('invoice2/{invoice2}', [Invoice2Controller::class, 'show'])->name('invoice2.show');
    Route::get('invoice2/{invoice2}/edit', [Invoice2Controller::class, 'edit'])->name('invoice2.edit');
    Route::put('invoice2/{invoice2}', [Invoice2Controller::class, 'update'])->name('invoice2.update');
    Route::delete('invoice2/{invoice2}', [Invoice2Controller::class, 'destroy'])->name('invoice2.destroy');
    Route::patch('invoice2/stages/{stage}/status', [Invoice2Controller::class, 'updateStageStatus'])->name('invoice2.stages.status');
    Route::get('invoice2/from-quotation/{quotation}', [Invoice2Controller::class, 'createFromQuotation'])->name('invoice2.from-quotation');
    Route::post('invoice2/from-quotation/{quotation}', [Invoice2Controller::class, 'storeFromQuotation'])->name('invoice2.store-from-quotation');
    
    // PDF Downloads
    Route::get('quotations/{quotation}/pdf', [PdfController::class, 'downloadQuotation'])->name('quotations.pdf');
    Route::get('invoices/{invoice}/pdf', [PdfController::class, 'downloadInvoice'])->name('invoices.pdf');
    Route::get('invoice2/{invoice2}/pdf', [PdfController::class, 'downloadInvoice2'])->name('invoice2.pdf');
});

Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
