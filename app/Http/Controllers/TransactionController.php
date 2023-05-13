<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Transaction2;

class TransactionController extends Controller
{
    public function completeTransaction(Request $request) 
{
    // Start a database transaction. This ensures that if something goes wrong,
    // none of the database changes are saved.
    DB::beginTransaction();

    try {
        // Create a new transaction and save it.
        $transaction = new Transaction2;
        $transaction->itemList = serialize($request->items); // Serialize the items array to store it in one database field.
        $transaction->total = $request->total;
        $transaction->totalDiscounted = $request->totalDiscounted;
        $transaction->userID = Auth::user()->id;
        $transaction->discountID = $request->discountID;
        $transaction->discountType = $request->discountType;
        $transaction->discountAmount = $request->discountAmount;
        $transaction->save();

        // Loop through the items and update the inventory quantities.
        foreach ($request->items as $item) {
            $product = Product::find($item['product_id']);
            $product->quantity -= $item['quantity'];
            $product->save();
        }

        // If everything goes well, commit the changes to the database.
        DB::commit();
    } catch (\Exception $e) {
        // If something goes wrong, rollback the transaction.
        DB::rollback();

        // Then redirect the user back with an error message.
        return back()->withErrors(['error' => 'Transaction could not be completed. Please try again.']);
    }

    // If the transaction was successful, redirect the user back with a success message.
    return back()->with('success', 'Transaction completed successfully.');
}

}
