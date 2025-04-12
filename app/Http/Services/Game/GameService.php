<?php

namespace  App\Http\Services\Game;

use App\Models\Game;
use App\Models\GameImage;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;


class GameService
{

    public function store()
    {
        try {
            // Retrieve all necessary request data upfront
            $request = request();
            // dd($request->all());
            $adminId = auth()->guard('admin')->id();
            $gameName = $request->input('name');
            $gameSlug = Str::slug($gameName);
            $categoryId = $request->input('category_id');
            $url = $request->input('url');
            $description = $request->input('description');
            $status = $request->input('status', 1); // Default to 1 if null
            $sortOrder = request()->get('sort_order') == null ? 0 : request()->get('sort_order');
            if ($sortOrder === null || !is_numeric($sortOrder) || $sortOrder <= 0) {
                return redirect()->back()->withInput()->with('error', 'Invalid sort order. Please provide a positive integer.');
            }
            $keywords = $request->input('keyword');

            // Handle single image upload
            $imagePath = null;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $filename = generate_random_string() . time() . '.' . $image->getClientOriginalExtension();
                $imagePath = $image->storeAs('games', $filename, 'public');
            } else {
                $imagePath = 'no-image.png';
            }

            $verticalImagePath = null;
            if ($request->hasFile('vertical_image')) {
                $vertical_image = $request->file('vertical_image');
                $filename = generate_random_string() . time() . '.' . $vertical_image->getClientOriginalExtension();
                $vertical_imagePath = $vertical_image->storeAs('games', $filename, 'public');
            } else {
                $vertical_imagePath = 'no-vertical_image.png';
            }


            $gameData = [
                'admin_id' => $adminId,
                'category_id' => $categoryId,
                'slug' => $gameSlug,
                'name' => $gameName,
                'url' => $url,
                'description' => $description,
                'image' => $imagePath,
                'vertical_image' => $verticalImagePath,
                'status' => $status,
                'display_on_home' => $request->get('display_on_home', 0), // Default to 0 if null
                'sort_order' => $sortOrder,
                'flag' => $request->get('flag', 0),
            ];
            $strKeyword = "";
            $keywords = $request->get('keyword');
            foreach ($keywords as $keyword) {
                $strKeyword .= $keyword . ',';
            }

            $gameData['keyword'] = rtrim($strKeyword, ',');

            // Create the game
            $game = Game::create($gameData);
            // Store multiple images in the game_images table
            $gameId = $game->id;
            $gameImages = $request->file('game_images');
            $gameSortOrders = $request->get('game_sort_order');
            Log::alert($gameSortOrders);


            $displayOnHome = $request->input('display_on_home', 0); // Default to 0 if null

            if (!empty($gameImages)) {
                foreach ($gameImages as $index => $gameImage) {

                    if ($gameImage->isValid()) {
                        $filename =  generate_random_string() . time() . '.' . $gameImage->getClientOriginalExtension();
                        $imagePath = $gameImage->storeAs('games', $filename, 'public');
                        Log::alert('sort start');
                        Log::info($gameSortOrders);
                        Log::alert('sort end');
                        if (!empty($imagePath)) {
                            $sortOrder = $gameSortOrders[$index] ?? 0; // Default to 0 if not set
                            $gameImageData = [
                                'admin_id' => $adminId,
                                'game_id' => $gameId,
                                'image' => $imagePath,
                                'display_on_home' => $displayOnHome,
                                'sort_order' => $sortOrder,
                            ];
                            GameImage::create($gameImageData);
                        }
                    } else {
                        // Handle invalid file upload error appropriately
                        // You may want to log the error or return a user-friendly message
                        // For example: Log::error('Invalid file upload');
                    }
                }
            }
        } catch (\Throwable $th) {

            //throw $th;
        }
    }


    public function update($gameId)
    {
        // Fetch the authenticated admin ID and request data
        try {
            $adminId = auth()->guard('admin')->id();
            $request = request()->all();

            $game = Game::findOrFail($gameId);
            $updateGameData = [
                'name' => $request['name'],
                'category_id' => $request['category_id'],
                'admin_id' => $adminId,
                'url' => $request['url'],
                'description' => $request['description'],
                'status' => $request['status'],
                'display_on_home' => isset($request['display_on_home']) ?  (bool) $request['display_on_home'] : false,
                'sort_order' => $request['sort_order'],
                'flag' => isset($request['flag']) ?  (bool) $request['flag'] : false,
            ];

            // Use findOrFail for better error handling
            $strKeyword = "";
            $keywords = $request['keyword'];
            foreach ($keywords as $keyword) {
                $strKeyword .= $keyword . ',';
            }
            // $updateGameData['keyword'] = $strKeyword;
            $updateGameData['keyword'] = rtrim($strKeyword, ',');
            $game->update($updateGameData);

            // Handle image upload if present
            if (request()->hasFile('image')) {
                $image = request()->file('image');
                $filename = time() . '.' . $image->getClientOriginalExtension();
                $imagePath = $image->storeAs('games', $filename, 'public');
                $game->update(['image' => $imagePath]);
            }
             if (request()->hasFile('vertical_image')) {
                $verticalImage = request()->file('vertical_image');
                $filename = time() . '.' . $verticalImage->getClientOriginalExtension();
                $verticalImagePath = $verticalImage->storeAs('games', $filename, 'public');
                $game->update(['vertical_image' => $verticalImagePath]);
            }

            // Store game images
            $gameImages = request()->file('game_images', []);
            $gameImageIds = request()->get('game_image_id', []); // Default to an empty array

            foreach ($gameImages as $index => $gameImage) {
                if (!$gameImage->isValid()) {
                    continue; // Skip invalid images
                }

                $filename = time() . '.' . $gameImage->getClientOriginalExtension();
                $imagePath = $gameImage->storeAs('games', $filename, 'public');

                if ($imagePath) {
                    $sortOrder = request()->get('game_sort_order', [])[$index] ?? 0;
                    $gameImageId = $gameImageIds[$index] ?? null;

                    // Update existing game image
                    if ($gameImageId) {
                        GameImage::where('id', $gameImageId)->update([
                            'admin_id' => $adminId,
                            'game_id' => $gameId,
                            'image' => $imagePath,
                            'display_on_home' => $request['display_on_home'] ?? 0,
                            'sort_order' => $sortOrder,
                        ]);
                    }
                }
            }
        } catch (Exception $th) {
            // dd($th);
            //throw $th;
        }
    }





    public function getCarouselGames($searchTerm = "")
    {
        $searchTerm = request()->get('search');
        $carouselQueryBuilder = Game::select('id', 'image', 'name', 'slug', 'keyword', 'description','vertical_image')->orderBy('sort_order', 'desc')->where('status', 1)->where('display_on_home', 1);

        if (!empty($searchTerm)) {
            $carouselQueryBuilder = $carouselQueryBuilder->where('name', 'LIKE', "%{$searchTerm}%")->orwhere('keyword', 'LIKE', "%{$searchTerm}%")
                ->orwhere('description', 'LIKE', "%{$searchTerm}%");
        }
        $carouselGameSliders = $carouselQueryBuilder->limit(8)->get();
        return $carouselGameSliders;
    }
}
