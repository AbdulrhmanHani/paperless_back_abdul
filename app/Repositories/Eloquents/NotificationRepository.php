<?php

namespace App\Repositories\Eloquents;

use Exception;
use App\Models\User;
use App\Helpers\Helpers;
use Illuminate\Support\Facades\DB;
use App\GraphQL\Exceptions\ExceptionHandler;
use Prettus\Repository\Eloquent\BaseRepository;

class NotificationRepository extends BaseRepository
{

    protected $notification;

    function model()
    {
        return User::class;
    }

    public function markAsRead($request)
    {
        DB::beginTransaction();
        try {

            $user_id = Helpers::getCurrentUserId();
            $user = $this->model->findOrFail($user_id);
            $user->unreadNotifications->markAsRead();
            DB::commit();

            return $user->notifications()->paginate($request->paginate);

        } catch (Exception $e) {

            DB::rollback();
            throw new ExceptionHandler($e->getMessage(), $e->getCode());
        }
    }

    public function destroy($id)
    {
        try {

            $user_id = Helpers::getCurrentUserId();
            $user = $this->model->findOrFail($user_id)->first();
            return $user->notifications()->where('id', $id)->first()->destroy($id);

        } catch (Exception $e){

            throw new ExceptionHandler($e->getMessage(), $e->getCode());
        }
    }
}
