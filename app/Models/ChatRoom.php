<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatRoom extends Model
{
    protected $table = 'chat_room';
    protected $primaryKey = 'id_chat_room';

    protected $fillable = ['user1_id', 'user2_id'];

    public function chats()
    {
        return $this->hasMany(Chat::class, 'chat_room_id');
    }
}
