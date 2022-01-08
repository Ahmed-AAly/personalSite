<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicUsers\AboutMeController;
use App\Http\Controllers\PublicUsers\SkillsAndCertificatController;
use App\Http\Controllers\PublicUsers\EndUsersBlogController;
use App\Http\Controllers\PublicUsers\FrontEndContactMeController;
use App\Http\Controllers\Admin\BiographyController;
use App\Http\Controllers\Admin\SkillsController;
use App\Http\Controllers\Admin\CertificationsController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\ContactMeController;
use App\Http\Controllers\Admin\SiteSettingsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['visitorsMaintenanceMode'])->group(function () {
    Route::get('/', [AboutMeController::class, 'index'])->name('landingPage');
    Route::get('/skills-certifications', [SkillsAndCertificatController::class, 'index'])
    ->name('skillsAndCertifications');
    Route::get('/blog', [EndUsersBlogController::class, 'index'])
    ->name('frontEndBlog');
    Route::get('/blog/article/{id}', [EndUsersBlogController::class, 'show'])
    ->name('readPost')->where('id', '[0-9]+');
    Route::get('/blog/search', [EndUsersBlogController::class, 'search'])
    ->name('searchPost');
    Route::get('/contact', [FrontEndContactMeController::class, 'index'])
    ->name('frontEndContactMe');
    Route::post('/contact', [FrontEndContactMeController::class, 'store'])
    ->name('frontEndSubmitContactMe');
});

Auth::routes([
    'register' => false, // Register Routes...
    'reset' => false, // Reset Password Routes...
    'verify' => false, // Email Verification Routes...
  ]);

Route::middleware(['auth'])->group(function () {
    // Admin dashboard.
    Route::get('/admin/home', [App\Http\Controllers\HomeController::class, 'index'])
    ->name('home');
    Route::delete('/admin/home', [ContactMeController::class, 'destroy'])->name('destroyMessage');
    // Biography routes.
    Route::get('/admin/biography', [App\Http\Controllers\Admin\BiographyController::class, 'index'])->name('biography');
    Route::post('/admin/biography-update', [App\Http\Controllers\Admin\BiographyController::class, 'update'])
    ->name('updateBiography');
    // Skill routes.
    Route::get('/admin/skills', [SkillsController::class, 'index'])->name('skills');
    Route::post('/admin/skills', [SkillsController::class, 'store'])->name('storeNewSkill');
    Route::post('/admin/updateskills', [SkillsController::class, 'update'])->name('updateSkill');
    Route::delete('/admin/destroyskill', [SkillsController::class, 'destroy'])->name('destroySkill');
    // Certifications routes.
    Route::get('/admin/certifications', [CertificationsController::class, 'index'])->name('certifications');
    Route::post('/admin/certifications', [CertificationsController::class, 'store'])->name('storeNewCertificate');
    Route::post('/admin/updatecertificate', [CertificationsController::class, 'update'])->name('updateCertificate');
    Route::delete('/admin/destroycertificate', [CertificationsController::class, 'destroy'])
    ->name('destroyCertificate');
    // Blog routes.
    Route::get('/admin/blog/blog', [BlogController::class, 'index'])->name('blog');
    Route::get('/admin/blog/create', [BlogController::class, 'create'])->name('createBlog');
    Route::post('/admin/blog/store', [BlogController::class, 'store'])->name('storeBlog');
    Route::get('/admin/blog/edit', [BlogController::class, 'edit'])->name('editBlog');
    Route::put('/admin/blog/update', [BlogController::class, 'update'])->name('updateBlog');
    Route::delete('/admin/blog/delete', [BlogController::class, 'delete'])->name('deleteBlog');
    // Site settings
    Route::post('/admin/update-settings', [SiteSettingsController::class, 'update'])->name('updateSettings');
    // Change admin password.
    Route::post('/admin/change-pwd', [App\Http\Controllers\Auth\ChangeAdminPasswordController::class, 'update'])
    ->name('changePwd');
    // license & Attributes.
    Route::get('/admin/license-attributes', [App\Http\Controllers\Admin\LicenseAttributeController::class, 'index'])
    ->name('licenseAttributes');
    Route::put('/admin/update-lic-attrs/{id}', [App\Http\Controllers\Admin\LicenseAttributeController::class, 'update'])
    ->name('updateLicenseAttributes');
});
