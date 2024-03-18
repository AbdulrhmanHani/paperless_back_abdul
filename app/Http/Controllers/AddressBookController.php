<?php

namespace App\Http\Controllers;

use App\Models\PhoneBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AddressBookController extends Controller
{
    public function index()
    {
        $current_user = auth()->user();
        $phone_books = PhoneBook::where('user_id', '=', $current_user->id)
            ->select(['id as book_id', 'recommended_email'])
            ->orderBy('id', 'desc')
            ->paginate(10);
        return response()->json([
            'data' => $phone_books,
        ]);
    }

    public function edit(Request $request, $book_id)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:50',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ]);
        }
        $current_user = auth()->user();
        $phone_book = PhoneBook::find($book_id);

        if ($phone_book) {
            if ($current_user->id == $phone_book->user_id) {
                $phone_book->update([
                    'recommended_email' => $request->email,
                ]);
                return response()->json([
                    'message' => 'phone book updated successfully',
                    'data' => $phone_book->select([
                        'id as book_id',
                        'recommended_email'
                    ])->first(),
                ]);
            } else {
                return response()->json([
                    'error' => 'something went wrong',
                ]);
            }
        } else {
            return response()->json([
                'error' => 'something went wrong',
            ]);
        }
    }



    public function delete($book_id)
    {
        $current_user = auth()->user();
        $phone_book = PhoneBook::find($book_id);

        if ($phone_book) {
            if ($current_user->id == $phone_book->user_id) {
                $phone_book->delete();
                return response()->json([
                    'message' => 'phone book deleted successfully',
                    'data' => $phone_book->select([
                        'id as book_id',
                        'recommended_email',
                    ])->first(),
                ]);
            } else {
                return response()->json([
                    'error' => 'something went wrong',
                ]);
            }
        } else {
            return response()->json([
                'error' => 'something went wrong',
            ]);
        }
    }

}
