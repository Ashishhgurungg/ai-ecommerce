<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class ArticleController extends Controller
{
    

    public function articleForm(){
        return view('articles/article-form');
    }

    public function createArticle(Request $request){
        // 1️⃣ Validate form inputs
        $validated = $request->validate([
            'name' => 'required|string|max:200',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // 2️⃣ Handle image upload
        $imageName = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');

            // Generate a unique filename
            $imageName = time() . '_' . uniqid() . '.' . $image->extension();

            // Store the image in storage/app/public/services
            $image->storeAs('articles', $imageName, 'public');
        }

        // 3️⃣ Save service to database (only store image filename)
        Article::create([
            'title' => $validated['name'],
            'description' => $validated['description'] ?? '',
            'image_path' => $imageName ?? '', // only filename
        ]);

        // 4️⃣ Redirect with success message
        return redirect('/article-form')->with('success', 'Article added successfully!');
    }

    public function allArticles(){
        $articles = Article::paginate(3);
        return view('articles/all-articles', compact('articles'));
    }

    public function deleteArticle(Request $request){
        $id = $request->id;
        $article = Article::find($id);
        $article->delete();
        return redirect('/all-articles')->with("delete", "Deleted the Article successfully !!!");
    }

    public function showUpdateForm(Request $request){
        $id = $request->id;
        $article = Article::find($id);
        return view('articles/update-articles', compact('article'));
    }

    public function updateArticle (Request $request){
        // Validate inputs
        $validated = $request->validate([
            'id'          => 'required|exists:articles,id',
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'remove_image'=> 'nullable|boolean',
        ]);

        // Find the service
        $article = Article::findOrFail($validated['id']);

        // Handle image removal
        if ($request->remove_image == 1 && $article->image_path) {
            if (\Storage::disk('public')->exists('articles/' . $article->image_path)) {
                \Storage::disk('public')->delete('articles/' . $article->image_path);
            }
            $article->image_path = null;
        }

        // Handle new image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($article->image_path && \Storage::disk('public')->exists('articles/' . $article->image_path)) {
                \Storage::disk('public')->delete('articles/' . $article->image_path);
            }

            // Store new image
            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->extension();
            $image->storeAs('articles', $imageName, 'public');

            $article->image_path = $imageName ?? '';
        }

        // Update other details
        $article->title        = $validated['name'];
        $article->description = $validated['description'] ?? '';

        // Save changes
        $article->save();

        return redirect('/all-articles')->with('success', 'Article updated successfully!');
    }

    public function showArticleDetails(Request $request){
        $id = $request->id;
        $article = Article::find($id);
        return view('articles/article-detail', compact('article'));
    }

}
