<?php

namespace App\Http\Controllers;

use App\Models\Spark;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SparkController extends Controller
{
    public function index(Request $request)
    {
        $query = Spark::with(['user', 'category', 'reactions'])->latest();

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        $sparks = $query->get();
        $categories = Category::all();

        return view('welcome', compact('sparks', 'categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'content' => 'required|string|max:280',
            'category_id' => 'required|exists:categories,id',
            'mood_score' => 'required|integer|min:1|max:10',
        ]);

        $spark = new Spark($validated);
        
        if (Auth::check()) {
            $spark->user_id = Auth::id();
            $spark->author = Auth::user()->name;
        }
        
        $category = Category::find($request->category_id);
        $spark->color = $category->color;
        
        $spark->save();

        return back()->with('success', 'Your spark has been added to the board!');
    }

    public function update(Request $request, Spark $spark)
    {
        // Only the owner can edit
        if ($spark->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'content' => 'required|string|max:280',
            'category_id' => 'required|exists:categories,id',
            'mood_score' => 'required|integer|min:1|max:10',
        ]);

        $category = Category::find($request->category_id);
        $validated['color'] = $category->color;

        $spark->update($validated);

        return back()->with('success', 'Reflection updated successfully!');
    }

    public function destroy(Spark $spark)
    {
        // Only the owner can delete
        if ($spark->user_id !== Auth::id()) {
            abort(403);
        }

        $spark->delete();

        return back()->with('success', 'Reflection deleted successfully.');
    }

    public function toggleReaction(Spark $spark)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $reaction = $spark->reactions()->where('user_id', Auth::id())->first();

        if ($reaction) {
            $reaction->delete();
            $status = 'removed';
        } else {
            $spark->reactions()->create(['user_id' => Auth::id()]);
            $status = 'added';
        }

        return back()->with('success', $status === 'added' ? 'Ignited! 🔥' : 'Extinguished.');
    }
}
