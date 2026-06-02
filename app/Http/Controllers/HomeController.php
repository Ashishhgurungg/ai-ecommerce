<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Article;
use App\Models\Gallery;
use App\Models\Event;
use App\Models\EventRegistration;
use App\Models\Contact;

class HomeController extends Controller
{
    
    //Display page with services

    public function showServicePage()
    {
        $services = Service::orderBy('created_at', 'desc')->paginate(6);
        $message = $services->isEmpty() ? 'No services to display' : null;

        // Check if user already rated each service (by IP)
        $alreadyRatedForService = [];

        foreach ($services as $service) {
            $alreadyRatedForService[$service->id] = \App\Models\Rating::where('service_id', $service->id)
                                                    ->where('ip_address', request()->ip())
                                                    ->exists();
        }

    return view('services', compact('services', 'message', 'alreadyRatedForService'));
    }

    public function showArticlePage()
    {
        $articles = Article::orderBy('created_at', 'desc')->paginate(3);
        $message = $articles->isEmpty() ? 'No articles to show': null;

        return view('articles', compact(['articles', 'message']));
    }
    public function showGalleryPage()
    {
        $galleries = Gallery::orderBy('created_at', 'desc')->paginate(3);
        $message = $galleries->isEmpty() ? 'No galleries to show': null;

        return view('galleries', compact(['galleries', 'message']));
    }

    public function showEventPage()
    {
        $events = Event::orderBy('created_at', 'desc')->paginate(3);
        $message = $events->isEmpty() ? 'No events to show' : null;

        return view('event', compact(['events', 'message']));
    }

    public function showDashboard()
    {
        $attendeesCount = EventRegistration::count();
        $servicesCount = Service::count();
        $eventsCount = Event::count();
        $inquiriesCount = Contact::count();
        $galleriesCount = Gallery::count();
        $articlesCount = Article::count();

        return view('dashboard', compact(
            'attendeesCount',
            'servicesCount',
            'eventsCount',
            'inquiriesCount',
            'galleriesCount',
            'articlesCount'
        ));
    }

}
