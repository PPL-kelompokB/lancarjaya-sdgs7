namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::latest()->get();

        $avg = $reviews->avg('rating');

        return view('reviews.index', compact('reviews', 'avg'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'rating' => 'required',
            'category' => 'required',
            'review' => 'required',
        ]);

        Review::create($request->all());

        return redirect('/reviews')->with('success', 'Ulasan berhasil dikirim!');
    }
}