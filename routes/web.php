<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ReviewController;

Route::get('/', [HomeController::class, 'showHomePage'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/dashboard', [HomeController::class, 'showDashboard'])->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';


Route::get('/about', function(){
    return view('about');
});

Route::get('/faq', function(){
    return view('faq');
});

Route::get('/services', [HomeController::class, 'showServicePage']);

Route::get('/add-services', [ServiceController::class, 'displayServiceForm']);
Route::post('/add-services', [ServiceController::class, 'addService']);
Route::get('/all-services', [ServiceController::class, 'listAllServices']);
Route::get('/update-services/{id}', [ServiceController::class, 'showUpdateForm']);
Route::post('/update-services', [ServiceController::class, 'updateService']);
Route::get('/delete-service/{id}', [ServiceController::class, 'deleteService'])->middleware(['auth', 'password.confirm']);

Route::post('/services/{id}/rate', [ServiceController::class, 'rate'])->name('services.rate');



Route::get('/articles', [HomeController::class, 'showArticlePage']);

Route::get('/article-form', [ArticleController::class, 'articleForm']);
Route::post('/article-form', [ArticleController::class, 'createArticle']);
Route::get('/all-articles', [ArticleController::class, 'allArticles']);
Route::get('/delete-article/{id}', [ArticleController::class, 'deleteArticle'])->middleware(['auth', 'password.confirm']);
Route::get('/update-articles/{id}', [ArticleController::class, 'showUpdateForm']);
Route::post('/update-articles', [ArticleController::class, 'updateArticle']);
Route::get('/article/{id}', [ArticleController::class, 'showArticleDetails']);

Route::get('/galleries', [HomeController::class, 'showGalleryPage']);

Route::get('/gallery-form', [GalleryController::class, 'galleryForm']);
Route::post('/gallery-form', [GalleryController::class, 'addGallery']);
Route::get('/all-galleries', [GalleryController::class, 'allGalleries']);
Route::get('/delete-gallery/{id}', [GalleryController::class, 'deleteGallery'])->middleware(['auth', 'password.confirm']);
Route::get('/update-galleries/{id}', [GalleryController::class, 'showUpdateForm']);
Route::post('/update-galleries', [GalleryController::class, 'updateGallery']);
Route::get('/galleries/{id}', [GalleryController::class, 'showGalleryDetails']);

Route::get('/contact', function(){
    return view('contact');
});
Route::post('/submit-contact', [ContactController::class, 'submitContactForm']);
Route::get('/inquiries', [ContactController::class, 'listInquiries'])->middleware('auth');
Route::get('/inquiries-delete/{id}', [ContactController::class, 'deleteInquiry'])->middleware('auth');

Route::get('/event', [HomeController::class, 'showEventPage']);
Route::get('/add-events', [EventController::class, 'showAddEventForm']);
Route::post('/add-events', [EventController::class, 'addEvent']);
Route::get('/all-events', [EventController::class, 'listAllEvents']);
Route::get('/delete-event/{id}', [EventController::class, 'deleteEvent'])->middleware(['auth', 'password.confirm']);

Route::get('/events/{id}', [EventController::class, 'showEventDetails']);
Route::post('/events/{id}/register', [EventController::class, 'registerForEvent'])->name('events.register');
Route::get('/events/{id}/attendees', [EventController::class, 'listAttendees'])->middleware('auth');
Route::get('/events/attendees/delete/{id}', [EventController::class, 'removeAttendee'])->middleware('auth');
Route::get('/update-event/{id}', [EventController::class, 'showUpdateEventForm']);
Route::post('/update-events', [EventController::class, 'updateEvent']);

Route::get('/review', [ReviewController::class, 'showReviewForm']);
Route::post('/submit-review', [ReviewController::class, 'submitReview'])->name('submit.review');
Route::get('reviews', [ReviewController::class, 'listReviews']);
Route::get('/delete-review/{id}', [ReviewController::class, 'destroyReview'])->middleware(['auth', 'password.confirm']);
Route::post('/reviews/{id}/status', [ReviewController::class, 'updateStatus'])->name('reviews.status');