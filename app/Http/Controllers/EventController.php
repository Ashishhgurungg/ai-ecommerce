<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\EVentRegistration;

class EventController extends Controller
{
      public function showAddEventForm()
    {
        return view('/events/add-event');
    }

    public function addEvent(Request $request)
    {
        // 1️⃣ Validate form inputs
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'price' => 'required|numeric|min:0|max:99999',
        ]);

        // 2️⃣ Handle image upload
        $imageName = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');

            // Generate a unique filename
            $imageName = time() . '_' . uniqid() . '.' . $image->extension();

            // Store the image in storage/app/public/events
            $image->storeAs('events', $imageName, 'public');
        }

        // 3️⃣ Save event to database (only store image filename)
        Event::create([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? '',
            'date' => $validated['date'] ?? '',
            'image_path' => $imageName ?? '', // only filename
            'price' => $validated['price'],
        ]);

        // 4️⃣ Redirect with success message
        return redirect('/add-events')->with('success', 'Event added successfully!');
    }

    public function listAllEvents()
    {
        $events = Event::paginate(3);
        return view('events/all-event', compact('events'));
    }

    public function deleteEvent($id)
    {
        $event = Event::findOrFail($id);

        // Delete associated image file if it exists
        if ($event->image_path && file_exists(storage_path('app/public/events/' . $event->image_path))) {
            unlink(storage_path('app/public/events/' . $event->image_path));
        }

        // Delete the event record from the database
        $event->delete();

        return redirect('/all-events')->with('success', 'Event deleted successfully!');
    }

    public function showEventDetails($id)
    {
        $event = Event::findOrFail($id);
        return view('events/register-event', compact('event'));
    }

    public function registerForEvent(Request $request, $id)
    {
        $event = Event::findOrFail($id);

        // Validate registration form inputs
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        // Create a new registration record
        EventRegistration::create([
            'event_id' => $event->id,
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        return redirect('/events/' . $event->id)->with('success', 'You have successfully registered for the event!');
    }

    public function listAttendees($id)
    {
        $event = Event::findOrFail($id);
        $attendees = $event->registrations; // Assuming you have a relationship defined in the Event model
        return view('events/attendees', compact('event', 'attendees'));
    }

    public function removeAttendee($id)
    {
        $attendee = EventRegistration::findOrFail($id);
        $attendee->delete();
        return redirect()->back()->with('success', 'Attendee removed successfully!');
    }
}
