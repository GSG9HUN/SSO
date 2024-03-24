<?php

namespace App\Http\Middleware;

use App\Models\Invitation;
use Closure;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class HasInvitation
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        if ($request->isMethod('get')) {


            if (!$request->has('invitationToken')) {
                return redirect(route('requestInvitation'));
            }

            $invitationToken = $request->get('invitationToken');

            try {
                $invitation = Invitation::query()
                    ->where('invitation_token', $invitationToken)
                    ->first();
            } catch (ModelNotFoundException $e) {
                return redirect(route('requestInvitation'))
                    ->with('error', 'Wrong invitation token!');
            }

            if (!is_null($invitation->registered_at)) {
                return redirect(route('login'))->with('error', 'The invitation link has already been used.');
            }
            $request->merge(array('email' => $invitation->email));
        }

        return $next($request);
    }
}
