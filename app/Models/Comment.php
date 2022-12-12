<?php

namespace App\Models;

use COM;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Comment extends Model
{
    use HasFactory;
    use Sortable;

    protected $fillable = [
        'content',
        'post_id',
        'user_id',
        'comment_date',
    ];

    public $sortable = [
        'comment_date',
        'approved_date',
        'content',
        'status'
    ];

    protected $casts = [
        'like_id' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function children()
    {
        return $this->hasMany(Comment::class, 'reply_id');
    }

    public function childrenComment()
    {
        $reply = Comment::where('reply_id', $this->id)
            ->join('users as u', 'u.id', 'comments.user_id')
            ->where('comments.status', 1)
            ->select('comments.*', 'u.name as replyName')
            ->get();
        return $reply;
    }

    public function parentComment()
    {
        $reply = Comment::where('id', $this->reply_id)->first();
        return $reply;
    }
}
