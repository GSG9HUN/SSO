<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed $email
 * @property string $invitation_token
 * @property string $role_id
 */
class Invitation extends Model
{
    use HasFactory;

    protected $table = 'invitations';

    protected $fillable = [
        'email','invitation_token','role_id','registered_at'
    ];

    protected $primaryKey = 'id';

    public function generateInvitationToken(): void
    {
        $this->invitation_token = substr(md5(rand(0, 9) . $this->email . time()), 0, 32);
    }
}
